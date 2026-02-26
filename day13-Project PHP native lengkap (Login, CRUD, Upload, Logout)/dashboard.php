<?php
require_once __DIR__ . '/middleware/auth.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/functions.php';

$data = $pdo->query('SELECT id, nama_produk, harga, stok, gambar, created_at FROM produk ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Login sebagai: <strong><?= e($_SESSION['username']) ?></strong></p>
    <p>
        <a href="tambah.php">+ Tambah Produk</a> |
        <a href="logout.php">Logout</a>
    </p>

    <?php if (empty($data)): ?>
        <p>Belum ada data produk.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= e((string)$row['id']) ?></td>
                        <td><?= e($row['nama_produk']) ?></td>
                        <td><?= e((string)$row['harga']) ?></td>
                        <td><?= e((string)$row['stok']) ?></td>
                        <td>
                            <?php if (!empty($row['gambar'])): ?>
                                <img src="uploads/<?= e($row['gambar']) ?>" alt="Gambar" width="80">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= e($row['created_at']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= urlencode((string)$row['id']) ?>">Edit</a> |
                            <a href="hapus.php?id=<?= urlencode((string)$row['id']) ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
