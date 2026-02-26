<?php
require_once __DIR__ . '/middleware/auth.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/functions.php';

$id = $_GET['id'] ?? '';
if (!ctype_digit($id)) {
    die('ID tidak valid.');
}

$stmt = $pdo->prepare('SELECT id, nama_produk, harga, stok, gambar FROM produk WHERE id = :id');
$stmt->execute([':id' => (int)$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die('Data tidak ditemukan.');
}

$nama = $item['nama_produk'];
$harga = (string)$item['harga'];
$stok = (string)$item['stok'];
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
        $gambarBaru = $item['gambar'];
        $upload = uploadImage($_FILES['gambar'] ?? [], __DIR__ . '/uploads');

        if (!$upload['success']) {
            $error = $upload['error'];
        } else {
            if ($upload['filename'] !== null) {
                $gambarBaru = $upload['filename'];
                if (!empty($item['gambar'])) {
                    $oldPath = __DIR__ . '/uploads/' . $item['gambar'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            $update = $pdo->prepare('UPDATE produk SET nama_produk = :nama, harga = :harga, stok = :stok, gambar = :gambar WHERE id = :id');
            $update->execute([
                ':nama' => $nama,
                ':harga' => (int)$harga,
                ':stok' => (int)$stok,
                ':gambar' => $gambarBaru,
                ':id' => (int)$id,
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
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>
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

        <p>Gambar saat ini:</p>
        <?php if (!empty($item['gambar'])): ?>
            <img src="uploads/<?= e($item['gambar']) ?>" alt="Gambar" width="100"><br><br>
        <?php else: ?>
            <p>-</p>
        <?php endif; ?>

        <label for="gambar">Ganti gambar (opsional):</label><br>
        <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png"><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
