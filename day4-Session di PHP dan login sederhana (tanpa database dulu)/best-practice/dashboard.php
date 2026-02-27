<?php
require_once 'config.php';

// Middleware Sederhana: Cek jika tidak ada session
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Area</title>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; background: #f4f7f6; padding: 2rem; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .logout { color: #dc3545; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

<div class="container">
    <h1>Halo, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>Selamat datang kembali di sistem latihan PHP Day 4.</p>
    <hr>
    <p><strong>Informasi Login:</strong></p>
    <ul>
        <li>Username: <?= htmlspecialchars($_SESSION['username']) ?></li>
        <li>Waktu Masuk: <?= htmlspecialchars($_SESSION['login_at']) ?></li>
    </ul>
    
    <br>
    <a href="logout.php" class="logout">Keluar dari Sistem</a>
</div>

</body>
</html>
