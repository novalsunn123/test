<?php
$host = 'localhost';
$dbname = 'students';
$user = 'webuser';
$pass = '123456';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
