<?php
require_once __DIR__ . '/../config/database.php';

function getProducts(): array
{
    try {
        $pdo = getPDO();
        $stmt = $pdo->query('SELECT id, nama_barang, harga, stok FROM barang ORDER BY id DESC');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
        return [
            ['id' => 1, 'nama_barang' => 'Contoh Keyboard', 'harga' => 250000, 'stok' => 10],
            ['id' => 2, 'nama_barang' => 'Contoh Mouse', 'harga' => 150000, 'stok' => 15],
        ];
    }
}
