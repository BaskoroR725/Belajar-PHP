<?php
session_start();

/*
Tugas Day 4:
1. Ubah username/password login (jangan admin/12345).
2. Tambahkan pesan error berbeda jika username kosong vs password kosong.
3. Setelah login berhasil, simpan juga waktu login ke session (contoh: $_SESSION['login_time']).
4. Di dashboard, tampilkan waktu login tersebut.
5. Tambahkan tombol logout (sudah disediakan di contoh utama).
*/

$error = '';

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' && $password === '') {
        $error = 'Username dan password wajib diisi.';
    } elseif ($username === '') {
        $error = 'Username wajib diisi.';
    } elseif ($password === '') {
        $error = 'Password wajib diisi.';
    } elseif ($username === 'userday4' && $password === 'passday4') {
        $_SESSION['username'] = $username;
        $_SESSION['login_time'] = date('Y-m-d H:i:s');
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Day 4</title>
</head>
<body>
    <h1>Tugas Day 4 - Session Login</h1>
    <p>Akun latihan: <strong>userday4 / passday4</strong></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
