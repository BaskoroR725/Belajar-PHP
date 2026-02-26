<?php
require_once __DIR__ . '/koneksi.php';

$id = $_GET['id'] ?? '';
if (!ctype_digit($id)) {
    die('ID tidak valid.');
}

$stmt = $pdo->prepare('SELECT id, nama_barang, harga, stok FROM barang WHERE id = :id');
$stmt->execute([':id' => (int)$id]);
$barang = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$barang) {
    die('Data barang tidak ditemukan.');
}

$namaBarang = $barang['nama_barang'];
$harga = (string)$barang['harga'];
$stok = (string)$barang['stok'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaBarang = trim($_POST['nama_barang'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $stok = trim($_POST['stok'] ?? '');

    if ($namaBarang === '' || $harga === '' || $stok === '') {
        $error = 'Semua field wajib diisi.';
    } elseif (!ctype_digit($harga) || !ctype_digit($stok)) {
        $error = 'Harga dan stok harus angka bulat.';
    } else {
        $update = $pdo->prepare('UPDATE barang SET nama_barang = :nama, harga = :harga, stok = :stok WHERE id = :id');
        $update->execute([
            ':nama' => $namaBarang,
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
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Barang</h1>
    <p><a href="index.php">Kembali ke daftar</a></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="nama_barang">Nama Barang:</label><br>
        <input type="text" id="nama_barang" name="nama_barang" value="<?= htmlspecialchars($namaBarang) ?>"><br><br>

        <label for="harga">Harga:</label><br>
        <input type="text" id="harga" name="harga" value="<?= htmlspecialchars($harga) ?>"><br><br>

        <label for="stok">Stok:</label><br>
        <input type="text" id="stok" name="stok" value="<?= htmlspecialchars($stok) ?>"><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
