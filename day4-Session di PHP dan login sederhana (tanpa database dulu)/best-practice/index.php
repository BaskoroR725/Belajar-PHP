<?php
require_once 'config.php';

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

// Konfirmasi logout
// Jika di URL ada kata 'logout' dan isinya 'success'
if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    echo '<p style="color: green;">Anda telah berhasil keluar dari sistem.</p>';
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and Get Input
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? ''; // Jangan di-trim password (spasi bisa jadi bagian pass)

    // Validasi Sederhana
    if (empty($username) && empty($password)) {
        $error = 'Mohon isi username dan password.';
    } elseif (empty($username)) {
        $error = 'Username tidak boleh kosong.';
    } elseif (empty($password)) {
        $error = 'Password tidak boleh kosong.';
    } elseif ($username === DEMO_USER && $password === DEMO_PASS) {
        // LOGIN BERHASIL
        
        // Proteksi Session Fixation: Regenerate ID setelah login
        session_regenerate_id(true);

        $_SESSION['user_id'] = 1; // ID user tiruan
        $_SESSION['username'] = $username;
        $_SESSION['login_at'] = date('Y-m-d H:i:s');
        
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
    <title>Best Practice Login</title>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 350px; }
        h2 { margin-top: 0; color: #333; }
        .error { color: #dc3545; background: #f8d7da; padding: 10px; border-radius: 6px; font-size: 0.9rem; margin-bottom: 1rem; border: 1px solid #f5c6cb; }
        input { width: 100%; padding: 10px; margin: 8px 0 16px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #007bff; border: none; color: white; border-radius: 6px; cursor: pointer; font-weight: 600; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>

<div class="card">
    <h2>Login Demo</h2>
    
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="userday4" value="<?= htmlspecialchars($username ?? '') ?>">
        
        <label>Password</label>
        <input type="password" name="password" placeholder="passday4">
        
        <button type="submit">Masuk</button>
    </form>
</div>

</body>
</html>
