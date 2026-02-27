<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>.</p>
    <p>Anda login pada tanggal, <strong><?= htmlspecialchars($_SESSION['login_time']) ?></strong>.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
