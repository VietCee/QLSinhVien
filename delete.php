<?php
//lay du lieu id can xoa
$svid = $_GET['sid'];
// echo $id;
//ket noi
require_once 'connect.php';
//cau lenh sql 
$xoa_sql = "DELETE FROM tblsinhvien WHERE id=$svid";

if(mysqli_query($conn, $xoa_sql)){
    header("Location: index.php");
}

