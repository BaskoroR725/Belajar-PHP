<?php
require_once __DIR__ . '/middleware/auth.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/functions.php';

$nama = '';
$harga = '';
$stok = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_produk'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $stok = trim($_POST['stok'] ?? '');

    if ($nama === '' || $harga === '' || $stok === '') {
        $error = 'Nama, harga, dan stok wajib diisi.';
    } elseif (!ctype_digit($harga) || !ctype_digit($stok)) {
        $error = 'Harga dan stok harus angka bulat.';
    } else {
        $upload = uploadImage($_FILES['gambar'] ?? [], __DIR__ . '/uploads');

        if (!$upload['success']) {
            $error = $upload['error'];
        } else {
            $stmt = $pdo->prepare('INSERT INTO produk (nama_produk, harga, stok, gambar) VALUES (:nama, :harga, :stok, :gambar)');
            $stmt->execute([
                ':nama' => $nama,
                ':harga' => (int)$harga,
                ':stok' => (int)$stok,
                ':gambar' => $upload['filename'],
            ]);

            header('Location: dashboard.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>
    <p><a href="dashboard.php">Kembali ke dashboard</a></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="nama_produk">Nama Produk:</label><br>
        <input type="text" id="nama_produk" name="nama_produk" value="<?= e($nama) ?>"><br><br>

        <label for="harga">Harga:</label><br>
        <input type="text" id="harga" name="harga" value="<?= e($harga) ?>"><br><br>

        <label for="stok">Stok:</label><br>
        <input type="text" id="stok" name="stok" value="<?= e($stok) ?>"><br><br>

        <label for="gambar">Gambar (jpg/jpeg/png):</label><br>
        <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png"><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
