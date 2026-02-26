<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 12 - Kode PHP Terstruktur</title>
</head>
<body>
    <h1>Daftar Produk (Tampilan/View)</h1>

    <?php if (empty($products)): ?>
        <p>Belum ada data.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $row): ?>
                    <tr>
                        <td><?= e((string)$row['id']) ?></td>
                        <td><?= e($row['nama_barang']) ?></td>
                        <td><?= e(formatRupiah((int)$row['harga'])) ?></td>
                        <td><?= e((string)$row['stok']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
