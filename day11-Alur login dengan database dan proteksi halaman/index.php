<?php
session_start();
require_once __DIR__ . '/koneksi.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$usernameInput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameInput = trim($_POST['username'] ?? '');
    $passwordInput = trim($_POST['password'] ?? '');

    if ($usernameInput === '' || $passwordInput === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $usernameInput]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($passwordInput, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header('Location: dashboard.php');
            exit;
        }

        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Day 11</title>
</head>
<body>
    <h1>Login Dengan Database</h1>
    <p>Akun contoh: <strong>admin / admin123</strong></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($usernameInput) ?>"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
