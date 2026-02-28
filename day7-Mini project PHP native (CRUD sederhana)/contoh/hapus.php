<?php
// hapus.php
require_once 'koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
  // Gunakan Prepared Statement demi keamanan
  $sql = "DELETE FROM produk WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':id' => $id]);
}

// Apapun yang terjadi, balik ke index
header("Location: index.php?status=success");
exit;
