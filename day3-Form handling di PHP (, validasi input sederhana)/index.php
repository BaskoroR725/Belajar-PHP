<?php
$name = '';
$email = '';
$message = '';
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') {
        $errors[] = 'Nama wajib diisi.';
    }

    if ($email === '') {
        $errors[] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    }

    if ($message === '') {
        $errors[] = 'Pesan wajib diisi.';
    }

    if (empty($errors)) {
        $success = 'Form berhasil dikirim.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 3 - Form Handling PHP</title>
</head>
<body>
    <h1>Day 3: Form Handling di PHP</h1>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success !== ''): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
        <h3>Data yang diterima:</h3>
        <ul>
            <li>Nama: <?= htmlspecialchars($name) ?></li>
            <li>Email: <?= htmlspecialchars($email) ?></li>
            <li>Pesan: <?= nl2br(htmlspecialchars($message)) ?></li>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="name">Nama:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>"><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

        <label for="message">Pesan:</label><br>
        <textarea id="message" name="message" rows="4" cols="40"><?= htmlspecialchars($message) ?></textarea><br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>
