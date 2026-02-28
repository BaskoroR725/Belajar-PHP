<?php
// tambah.php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama  = trim($_POST['nama_produk']);
  $harga = (int)$_POST['harga'];
  $stok  = (int)$_POST['stok'];

  if ($nama && $harga >= 0 && $stok >= 0) {
    $sql = "INSERT INTO produk (nama_produk, harga, stok) VALUES (:nama, :harga, :stok)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nama' => $nama, ':harga' => $harga, ':stok' => $stok]);

    // Redirect setelah sukses (PRG Pattern)
    header("Location: index.php?status=success");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 20px;
      max-width: 500px;
      margin: 0 auto;
    }

    form {
      background: #f4f4f4;
      padding: 20px;
      border-radius: 8px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 4px;
      border: 1px solid #ddd;
      box-sizing: border-box;
    }

    button {
      background: #22c55e;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-weight: bold;
    }

    .back {
      display: block;
      margin-top: 15px;
      text-align: center;
      color: #666;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <h1>🆕 Tambah Produk Baru</h1>
  <form method="POST">
    <label>Nama Produk:</label>
    <input type="text" name="nama_produk" required placeholder="Contoh: SSD 500GB">

    <label>Harga (Rp):</label>
    <input type="number" name="harga" required placeholder="Contoh: 850000">

    <label>Stok:</label>
    <input type="number" name="stok" required placeholder="Contoh: 15">

    <button type="submit">Simpan Produk</button>
  </form>
  <a href="index.php" class="back">← Kembali ke Daftar</a>
</body>

</html>