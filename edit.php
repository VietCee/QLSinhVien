<?php
//lay id cua edit
$id = $_GET['sid'];

//ket noi
require_once 'connect.php';

//cau lenh de lay thong ve ve sinh vien co id = $id
$edit_sql = "SELECT * FROM tblsinhvien WHERE id=$id";

$result = mysqli_query($conn, $edit_sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit sinh vien</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Form sửa sinh viên</h1>
        <form action="update.php" method="post">
            <input type="hidden" name="sid" value="<?php echo $id;?>" id="">
            <div class="form-group">
                <label for="masv">Mã sinh viên</label>
                <input type="text" name="mssv" id="mssv" class="form-control"  value="<?php echo $row['mssv']?>">
            </div>
            <div class="form-group">
                <label for="hoten">Họ tên</label>
                <input type="text" id="hoten" class="form-control" name="hoten" value="<?php echo $row['hoten']?>">
            </div>
            
            <div class="form-group">
                <label for="lop">Lớp</label>
                <input type="text" id="lop" name="lop" class="form-control"  value="<?php echo $row['lop']?>">
            </div>
            <div class="form-group">
                <label for="tgianhoc">Thời gian học (năm):</label>
                <input type="number" class="form-control" id="tgianhoc" name="tgianhoc" value="<?php echo $row['tgianhoc']?>">
            </div>
            <button class="btn btn-success">Cập nhật thông tin</button>
        </form>
    </div>
</body>

</html>