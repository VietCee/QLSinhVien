# Hướng dẫn deploy web lên AWS (Region N. Virginia (us-east-1))
## Bước 1: Tạo Virtual Private Cloud (VPC):
- Ở phần đầu AWS Management Console, tìm kiếm VPC và chọn
- Create VPC và cấu hình như sau:
   - Resources to create: Choose VPC only
   - Name tag: my-vpc-1
   - IPv4 CIDR: 10.0.0.0/26
   - Choose Create VPC
## Bước 2: Tạo các thành phần con của VPC
- NAT gateways:
     + Name - optional: mynat
     + Subnet: public-sb-1
     + Elastic IP allocation ID: Allocation Elastic IP
     + Create NAT gateways
- Subnets: VPC ID chọn my-vpc-1,tạo các subnets:
   - public-sb-1: 
      + Availability Zone: ap-south-1a
      + IPv4 subnet CIDR block: 10.0.0.0/28
   - public-sb-2:
      + Availability Zone: ap-south-1b
      + IPv4 subnet CIDR block: 10.0.0.16/28
   - private-sb-1:
      + Availability Zone: ap-south-1a
      + IPv4 subnet CIDR block: 10.0.0.32/28
   - private-sb-2:
      + Availability Zone: ap-south-1b
      + IPv4 subnet CIDR block: 10.0.0.48/28
- Route Tables: Tạo public-RT và private-RT
   - public-RT:
      + VPC: chọn my-vpc -1
      + Chọn Create route table
      + Sau khi tạo vào Subnet associations => edit subnet associations
      + Thêm public-sb-1 và public-sb-2
      + Save associations
      + Ở tab bên dưới, chọn Router => Edit router
      + Cài Destiation : 0.0.0.0/0 và Target : myIGW (internet gateway)
   - private-RT
      + VPC: chọn my-vpc -1
      + Chọn Create route table
      + Sau khi tạo vào Subnet associations => edit subnet associations
      + Thêm private-sb-1 và private-sb-2
      + Save associations
      + Ở tab bên dưới, chọn Router => Edit router
      + Cài Destiation : 0.0.0.0/0 và Target : mybat (Nat Gateway)
- Internet Gateway:
   - Chọn Create internet gateway
     + NameTag: myIGW
     + create internet gateway
   - Sau khi tạo ở thanh thông báo phía trên, chọn attach to VPC
     + Available VPCs: chọn my-vpc-1
## Bước 3: Tạo RDS và Setups
- Chọn Subnet groups:
     + Name: mysubnetgroup
     + Description: This is my Subnet groups
     + Add subnets: Availability Zone : ap-south-1a và ap-south-1b
     + Subnets: Chọn 10.0.0.32/28 và 10.0.0.48/28
- Chọn Databases:
     + Create database
     + Standard create
     + Engine options : MySQL
     + Templates: Free tier
     + Ở Settings: đặt DB = myRDS - set master user name và password
     + Ở Storage: bỏ tích Enable storage autoscaling
     + Ở Connectivity: VPC chọn my-vpc-1
     + VPC security group (firewall): chọn Create new => security group name = mySG1
     + Create database
## Bước 4: Tạo instance từ EC2
- Chọn AMI Catalog => Amazon Linux 2 AMI (HVM) - Kernel 5.10, SSD Volume Type
- Chọn SELECT => Launch instance with AMI
- Name and tags: Website QLSV
- Key pair: Vockey
- Network Settings => Edit
     + VPC : my-vpc-1
     + Subnet: public-sb-1
     + Auto-assign public IP: Enable
     + Firewall: Chọn Select existing security group
     + Common security groups: mySG1
- Chọn Launch instance
- Sau khi tạo xong EC2, chọn vào EC2 vừa tạo và chọn Security
- Ở Inbound rules, chọn mySG1 để mở security group => chọn inbound rules => edit inbound rules
- Ở phần MYSQL/Aurora , chuyển Source về địa chỉ IPv4 private instance của mình
- Add rule => Type: SSH => Source: 0.0.0.0/0
- Add rule => Type: HTTTP => Source: 0.0.0.0/0
- Save rules
## Bước 5: Kết nối database với instance của mình
- Chọn instance Website QLSV, sau đó ở phía góc trên chọn Connect, mở sang Terminal
- Từ đây ta sẽ setup các lệnh sau:
   ```
   // Các bước connect
   - EC2
    - sudo yum update -y
   - install php
    - sudo amazon-linux-extras | grep php
    - sudo amazon-linux-extras enable php8.0
    - sudo yum clean metadata
    - sudo yum install php-cli php-pdo php-fpm php-mysqlnd -y
    - php -v
   - Install Apache HTTP Sever
    - sudo yum install  httpd -y
    - sudo systemctl start httpd
    - sudo systemctl enable httpd
   - Set file permission for Apache webserver
    - sudo usermod -a -G apache ec2-user
    - exit
    - groups ( ec2-user adm wheel apache systemd-journal)
    - sudo chown -R ec2-user:apache /var/www
    - sudo chmod 2775 /var/www
    - find /var/www -type d -exec sudo chmod 2775 {} \;
    - find /var/www -type f -exec sudo chmod 0664 {} \;
   - Check connect to RDS from EC2
    - sudo yum install telnet -y
    - telnet + endpoint + 3306
   - creata database
    - sudo yum install mysql -y
    - truy cap dung : mysql -h end-point-database -u admin -p
   ```
- Import source code từ Github
   ```
   - mkdir aws_assg ( với aws_assg là folder tạo để lưu project, sau đó chuyển tất cả vào html sau)
   - cd aws_assg
   - wget https://github.com/VietCee/QLSinhVien.git
   - wget https://github.com/VietCee/QLSinhVien/archive/refs/heads/main.zip
   - ls -lrt
   - unzip main.zip
   - cd QLSinhVien-main ( chuyển đến file đã unzip)
   - mv * /var/www/html
   - systemctl enable httpd
   - systemctl start httpd
   ```
- Tạo database và dự án của tôi đã hoàn thành
