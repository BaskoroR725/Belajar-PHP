<?php
// edit.php
require_once 'koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  header("Location: index.php");
  exit;
}

// Ambil data lama
$stmt = $pdo->prepare("SELECT * FROM produk WHERE id = :id");
$stmt->execute([':id' => $id]);
$p = $stmt->fetch();

if (!$p) {
  die("Data tidak ditemukan!");
}

// Proses Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama  = trim($_POST['nama_produk']);
  $harga = (int)$_POST['harga'];
  $stok  = (int)$_POST['stok'];

  if ($nama && $harga >= 0 && $stok >= 0) {
    $sql = "UPDATE produk SET nama_produk = :nama, harga = :harga, stok = :stok WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':nama'  => $nama,
      ':harga' => $harga,
      ':stok'  => $stok,
      ':id'    => $id
    ]);

    header("Location: index.php?status=success");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 20px;
      max-width: 500px;
      margin: 0 auto;
    }

    form {
      background: #fef3c7;
      padding: 20px;
      border-radius: 8px;
      border: 1px solid #fbbf24;
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
      background: #eab308;
      color: black;
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
  <h1>✏️ Edit Produk</h1>
  <form method="POST">
    <label>Nama Produk:</label>
    <input type="text" name="nama_produk" value="<?= htmlspecialchars($p['nama_produk']) ?>" required>

    <label>Harga (Rp):</label>
    <input type="number" name="harga" value="<?= $p['harga'] ?>" required>

    <label>Stok:</label>
    <input type="number" name="stok" value="<?= $p['stok'] ?>" required>

    <button type="submit">Update Produk</button>
  </form>
  <a href="index.php" class="back">← Batal dan Kembali</a>
</body>

</html>