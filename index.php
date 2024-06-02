<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý học viên</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Danh sách sinh viên</h1>
            <form action="add.php" method="post">
                <div class="form-group">
                    <label for="mssv">MSSV:</label>
                    <input type="text" class="form-control"  id="mssv" name="mssv">
                </div>

                <div class="form-group">
                <label for="hoten">Họ tên:</label>
                <input type="text" class="form-control" id="hoten" name="hoten">
                </div>
                
                <div class="form-group">
                    <label for="lop">Lớp:</label>
                    <input type="text" class="form-control" id="lop" name="lop">
                </div>  
                <div class="form-group">
                    <label for="tgianhoc">Thời gian học (năm):</label>
                    <input type="number" class="form-control" id="tgianhoc" name="tgianhoc">
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            <br>
            <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Mã sinh viên</th>
        <th>Họ tên</th>
        <th>Lớp</th>
        <th>Thời gian học</th>
        <th>Học phí</th>
        <th>Thao tác</th>
        
      </tr>
    </thead>
    <tbody>
    <?php
        // kết nối
        require_once 'connect.php';
        // lệnh
        $lietke_sql = "SELECT * FROM tblsinhvien";
        // thực thi lệnh
        $result = mysqli_query($conn,$lietke_sql);
        // duyệt qua result và in ra màn
        while ($r = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                <td><?php echo $r['mssv'];?></td>
                <td><?php echo $r['hoten'];?></td>
                <td><?php echo $r['lop'];?></td>
                <td><?php echo $r['tgianhoc'];?></td>
                <td><?php echo $r['hocphi'];?></td>
                <td>
                <a href="edit.php?sid=<?php echo $r['id']; ?>" class="btn btn-info">Sửa</a>
                <a onclick="return confirm('Bạn có muốn xoá sinh viên này không?');" href="delete.php?sid=<?php echo $r['id']; ?>" class="btn btn-danger">Xoá</a>
              </tr>
            <?php
            }   
    ?>
    </tbody>
  </table>



    </div>




</body>
</html>