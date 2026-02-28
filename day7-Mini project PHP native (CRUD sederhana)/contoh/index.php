<?php
// index.php
require_once 'koneksi.php';

// Ambil data produk
$stmt = $pdo->query("SELECT * FROM produk ORDER BY id DESC");
$produk = $stmt->fetchAll();

// Cek status dari URL (untuk notifikasi)
$status = $_GET['status'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Manajemen Produk - Toko Kita</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 20px;
      max-width: 900px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .btn {
      padding: 8px 15px;
      text-decoration: none;
      border-radius: 4px;
      color: white;
      display: inline-block;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .btn-add {
      background: #22c55e;
    }

    .btn-edit {
      background: #eab308;
      color: black;
      font-size: 12px;
    }

    .btn-delete {
      background: #ef4444;
      font-size: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: left;
    }

    th {
      background: #f8fafc;
    }

    .alert {
      padding: 10px;
      background: #dcfce7;
      color: #166534;
      border-radius: 4px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <h1>📦 Manajemen Produk Toko Kita</h1>

  <?php if ($status === 'success'): ?>
    <div class="alert">Berhasil memproses data!</div>
  <?php endif; ?>

  <a href="tambah.php" class="btn btn-add">+ Tambah Produk</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($produk as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><strong><?= htmlspecialchars($p['nama_produk']) ?></strong></td>
          <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
          <td><?= $p['stok'] ?></td>
          <td>
            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-edit">Edit</a>
            <a href="hapus.php?id=<?= $p['id'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($produk)): ?>
        <tr>
          <td colspan="5" style="text-align:center;">Produk kosong.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>

</html>