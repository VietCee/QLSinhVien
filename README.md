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
     + Standard create
     + Engine options : MySQL
  
