<?php
require_once __DIR__ . '/config/koneksi.php';

$data = $pdo->query('SELECT id, nama_produk, harga, stok, created_at FROM produk ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini CRUD PHP Native</title>
</head>
<body>
    <h1>Mini Project PHP Native - CRUD Sederhana</h1>

    <p><a href="tambah.php">+ Tambah Produk</a></p>

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
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td>Rp <?= htmlspecialchars((string)$row['harga']) ?></td>
                        <td><?= htmlspecialchars((string)$row['stok']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
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
