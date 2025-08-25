<?php
session_start();
require_once '../includes/db.php';

if (!isset($_POST['username'], $_POST['password'])) {
  header('Location: ../login.html'); exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

$sql = "SELECT username, password, mssv, role FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['mssv'] = $user['mssv'];
    $_SESSION['role'] = $user['role'];
    header("Location: ../dashboard.php"); exit;
} else {
    echo "<p style='font-family:sans-serif'>Sai tên đăng nhập hoặc mật khẩu! <a href='../login.html'>Quay lại</a></p>";
}
