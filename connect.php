<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'qlsv';

// Tạo kết nối
$conn = mysqli_connect($host, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die('Kết nối thất bại: ' . mysqli_connect_error());
}
?>
