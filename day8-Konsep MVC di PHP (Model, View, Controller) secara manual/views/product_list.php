<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk (MVC Manual)</title>
</head>
<body>
    <h1>Daftar Produk - MVC Manual</h1>

    <?php if (empty($products)): ?>
        <p>Tidak ada data produk.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$product['id']) ?></td>
                        <td><?= htmlspecialchars($product['nama']) ?></td>
                        <td>Rp <?= htmlspecialchars((string)$product['harga']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
