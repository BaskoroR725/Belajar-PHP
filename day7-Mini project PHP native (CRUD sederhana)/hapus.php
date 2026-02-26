<?php
require_once __DIR__ . '/config/koneksi.php';

$id = $_GET['id'] ?? '';

if (!ctype_digit($id)) {
    die('ID tidak valid.');
}

$stmt = $pdo->prepare('DELETE FROM produk WHERE id = :id');
$stmt->execute([':id' => (int)$id]);

header('Location: index.php');
exit;
