<?php
require_once __DIR__ . '/config/koneksi.php';

$id = $_GET['id'] ?? '';

if (!ctype_digit($id)) {
    die('ID tidak valid.');
}

$stmt = $pdo->prepare('SELECT id, nama_produk, harga, stok FROM produk WHERE id = :id');
$stmt->execute([':id' => (int)$id]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produk) {
    die('Data produk tidak ditemukan.');
}

$error = '';
$namaProduk = $produk['nama_produk'];
$harga = (string)$produk['harga'];
$stok = (string)$produk['stok'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaProduk = trim($_POST['nama_produk'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $stok = trim($_POST['stok'] ?? '');

    if ($namaProduk === '' || $harga === '' || $stok === '') {
        $error = 'Semua field wajib diisi.';
    } elseif (!ctype_digit($harga) || !ctype_digit($stok)) {
        $error = 'Harga dan stok harus berupa angka bulat.';
    } else {
        $update = $pdo->prepare('UPDATE produk SET nama_produk = :nama, harga = :harga, stok = :stok WHERE id = :id');
        $update->execute([
            ':nama' => $namaProduk,
            ':harga' => (int)$harga,
            ':stok' => (int)$stok,
            ':id' => (int)$id,
        ]);

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>
    <p><a href="index.php">Kembali ke daftar</a></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="nama_produk">Nama Produk:</label><br>
        <input type="text" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($namaProduk) ?>"><br><br>

        <label for="harga">Harga:</label><br>
        <input type="text" id="harga" name="harga" value="<?= htmlspecialchars($harga) ?>"><br><br>

        <label for="stok">Stok:</label><br>
        <input type="text" id="stok" name="stok" value="<?= htmlspecialchars($stok) ?>"><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
