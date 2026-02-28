<?php
$host   = "localhost";
$db     = "db_latihan";
$user   = "root"; // Default XAMPP/Laragon
$pass   = "";     // Default XAMPP/Laragon biasanya kosong
$charset = "utf8mb4";

// DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opsi PDO untuk keamanan dan kemudahan debugging
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lempar error sebagai exception
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Hasil fetch berupa array asosiatif
  PDO::ATTR_EMULATE_PREPARES   => false,                  // Gunakan prepared statement asli
];

try {
  // Membuat instance PDO
  $pdo = new PDO($dsn, $user, $pass, $options);
  // echo "Koneksi Berhasil!"; // Matikan kalau sudah di production
} catch (PDOException $e) {
  // Jika gagal, hentikan script dan tampilkan pesan error
  die("Error Koneksi Database: " . $e->getMessage());
}
?>