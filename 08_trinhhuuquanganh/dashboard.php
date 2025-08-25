<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.html'); exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Bảng điều khiển</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h2>Xin chào, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <ul class="student-list">
      <li><a href="pages/information.html">Giới thiệu</a></li>
      <li><a href="pages/score.html">Bảng điểm</a></li>
      <li><a href="pages/curriculum_vitae.html">Lý lịch</a></li>
      <li><a href="pages/trangtin.html">Trang tin</a></li>
      <li><a href="actions/logout.php">Đăng xuất</a></li>
    </ul>
  </div>
</body>
</html>
