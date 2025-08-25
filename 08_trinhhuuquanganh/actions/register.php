<?php
require_once '../includes/db.php';

if (!isset($_POST['username'], $_POST['password'], $_POST['mssv'])) {
  header('Location: ../register.html'); exit;
}

$username = trim($_POST['username']);
$mssv     = trim($_POST['mssv']);
$hash     = password_hash($_POST['password'], PASSWORD_BCRYPT);

// (tuỳ chọn) kiểm tra mssv có tồn tại trong bảng students không
$chk = $conn->prepare("SELECT 1 FROM students WHERE mssv=?");
$chk->bind_param('s', $mssv);
$chk->execute();
if (!$chk->get_result()->num_rows) {
  echo "<p style='font-family:sans-serif'>MSSV chưa có trong bảng students! Hãy thêm vào trước. <a href='../register.html'>Quay lại</a></p>";
  exit;
}

// kiểm tra username trùng
$chk2 = $conn->prepare("SELECT 1 FROM users WHERE username=?");
$chk2->bind_param('s', $username);
$chk2->execute();
if ($chk2->get_result()->num_rows) {
  echo "<p style='font-family:sans-serif'>Tên đăng nhập đã tồn tại! <a href='../register.html'>Quay lại</a></p>";
  exit;
}

$sql = "INSERT INTO users (username, password, mssv) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $username, $hash, $mssv);

if ($stmt->execute()) {
    echo "<p style='font-family:sans-serif'>Đăng ký thành công. <a href='../login.html'>Đăng nhập</a></p>";
} else {
    echo "<p style='font-family:sans-serif'>Lỗi đăng ký: " . htmlspecialchars($conn->error) . "</p>";
}
