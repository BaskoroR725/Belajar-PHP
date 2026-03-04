<?php
$host = 'localhost';
$db = 'db_latihan';
$user = 'root';
$pass = '';
$charset = "utf8mb4";

$data_source_net = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => FALSE
];

try {
  $pdo = new PDO($data_source_net, $user, $pass, $options);
} catch (PDOException $e) {
  die("Error Koneksi Database: " . $e->getMessage());
}
