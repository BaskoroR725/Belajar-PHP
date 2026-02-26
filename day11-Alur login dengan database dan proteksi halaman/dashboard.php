<?php
require_once __DIR__ . '/auth_check.php';
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
    <p>Halaman ini diproteksi middleware manual: <code>auth_check.php</code>.</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
