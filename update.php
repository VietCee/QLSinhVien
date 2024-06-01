<?php
//nhan du lieu tu form


$mssv = $_POST['mssv'];
$hoten = $_POST['hoten'];
$lop = $_POST['lop'];
$id = $_POST['sid'];
$tgianhoc = $_POST['tgianhoc'];
$hocphi = $tgianhoc * 500000;
//ket noi csdl
require_once 'connect.php';
//viet lenh sql de them du lieu
$updatesql = "UPDATE tblsinhvien SET mssv='$mssv', hoten= '$hoten', lop='$lop',tgianhoc = '$tgianhoc',hocphi = '$hocphi' WHERE id=$id";
// echo $updatesql; exit;
//thuc thi cau lenh them
if (mysqli_query($conn, $updatesql)){
    header("Location: index.php?status=updated");
}

