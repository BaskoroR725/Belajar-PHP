<?php
require_once __DIR__ . '/koneksi.php';

$dataBarang = $pdo->query('SELECT id, nama_barang, harga, stok, created_at FROM barang ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 10 - CRUD PHP + MySQL</title>
</head>
<body>
    <h1>Day 10: CRUD di PHP + MySQL</h1>

    <p><a href="tambah.php">+ Tambah Barang</a></p>

    <?php if (empty($dataBarang)): ?>
        <p>Belum ada data barang.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataBarang as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td>Rp <?= htmlspecialchars((string)$row['harga']) ?></td>
                        <td><?= htmlspecialchars((string)$row['stok']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= urlencode((string)$row['id']) ?>">Edit</a> |
                            <a href="hapus.php?id=<?= urlencode((string)$row['id']) ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
