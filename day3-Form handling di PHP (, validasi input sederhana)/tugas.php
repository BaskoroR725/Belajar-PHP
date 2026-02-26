<?php
// Tugas Day 3: Form Handling + Validasi Input
// 1. Buat form dengan field: nama, umur, dan hobi.
// 2. Semua field wajib diisi.
// 3. Umur harus angka dan minimal 10.
// 4. Jika valid, tampilkan data hasil input.

/*
// CONTOH JAWABAN (DINONAKTIFKAN) - tidak akan dieksekusi
$nama = '';
$umur = '';
$hobi = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $umur = trim($_POST['umur'] ?? '');
    $hobi = trim($_POST['hobi'] ?? '');

    if ($nama === '') {
        $errors[] = 'Nama wajib diisi.';
    }

    if ($umur === '') {
        $errors[] = 'Umur wajib diisi.';
    } elseif (!is_numeric($umur) || (int)$umur < 10) {
        $errors[] = 'Umur harus angka dan minimal 10.';
    }

    if ($hobi === '') {
        $errors[] = 'Hobi wajib diisi.';
    }
}
*/

// Tulis jawabanmu di bawah ini:
$nama = '';
$umur = '';
$hobi = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $umur = trim($_POST['umur'] ?? '');
    $hobi = trim($_POST['hobi'] ?? '');

    if ($nama === '') {
        $errors[] = 'Nama wajib diisi.';
    }

    if ($umur === '') {
        $errors[] = 'Umur wajib diisi.';
    } elseif (!ctype_digit($umur) || (int)$umur < 10) {
        $errors[] = 'Umur harus angka dan minimal 10.';
    }

    if ($hobi === '') {
        $errors[] = 'Hobi wajib diisi.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Day 3</title>
</head>
<body>
    <h1>Tugas Day 3 - Form Handling</h1>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p style="color: green;">Input valid.</p>
        <ul>
            <li>Nama: <?= htmlspecialchars($nama) ?></li>
            <li>Umur: <?= htmlspecialchars($umur) ?></li>
            <li>Hobi: <?= htmlspecialchars($hobi) ?></li>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>"><br><br>

        <label for="umur">Umur:</label><br>
        <input type="text" id="umur" name="umur" value="<?= htmlspecialchars($umur) ?>"><br><br>

        <label for="hobi">Hobi:</label><br>
        <input type="text" id="hobi" name="hobi" value="<?= htmlspecialchars($hobi) ?>"><br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>
