<?php
session_start();

$error = '';

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';

    } elseif($username === ''){
        $error = 'Username wajib diisi.';
    } elseif($password === ''){
        $error = 'Password wajib diisi.';
    }elseif ($username === 'Baskoro' && $password === 'phpexpert') {
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
    <title>Day 4 - Login Session</title>
</head>
<body>
    <h1>Day 4: Login Sederhana dengan Session</h1>
    <p>Gunakan akun demo: <strong>admin / 12345</strong></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?>Something wrong!!!</p>
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
