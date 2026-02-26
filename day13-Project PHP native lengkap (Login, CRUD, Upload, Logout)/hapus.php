<?php
require_once __DIR__ . '/middleware/auth.php';
require_once __DIR__ . '/config/database.php';

$id = $_GET['id'] ?? '';
if (!ctype_digit($id)) {
    die('ID tidak valid.');
}

$stmt = $pdo->prepare('SELECT gambar FROM produk WHERE id = :id');
$stmt->execute([':id' => (int)$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($item) {
    if (!empty($item['gambar'])) {
        $path = __DIR__ . '/uploads/' . $item['gambar'];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    $delete = $pdo->prepare('DELETE FROM produk WHERE id = :id');
    $delete->execute([':id' => (int)$id]);
}

header('Location: dashboard.php');
exit;
