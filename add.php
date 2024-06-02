<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mssv =$_POST['mssv'];
    $hoten =$_POST['hoten'];
    $lop =$_POST['lop'];
    $tgianhoc = $_POST['tgianhoc'];
    $hocphi = $tgianhoc * 500000;

    if (empty($mssv) || empty($hoten) || empty($lop) || empty($tgianhoc)) {
        echo 'Vui lòng điền đầy đủ thông tin.';
        exit;
    }

    require_once('connect.php');
    
    $sql = "INSERT INTO tblsinhvien (mssv, hoten, lop,tgianhoc,hocphi) VALUES ('$mssv', '$hoten', '$lop','$tgianhoc','$hocphi')";
    if (mysqli_query($conn, $sql)) {
        echo 'Thêm sinh viên thành công';
        header("Location: index.php");
    } else {
        echo 'Lỗi: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
    } else {
    echo 'Phương thức không hợp lệ.';
}
?>
