-- Script SQL untuk Day 6: Belajar PHP + MySQL (PDO)
-- Kamu bisa menjalankan script ini di phpMyAdmin atau SQL Terminal.

-- 1. Buat Database jika belum ada
CREATE DATABASE IF NOT EXISTS belajar_php;
USE belajar_php;

-- 2. Buat Tabel guestbook (Buku Tamu)
CREATE TABLE IF NOT EXISTS guestbook (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Masukkan data awal (opsional)
INSERT INTO guestbook (name, message) VALUES 
('Antigravity', 'Halo! Ini adalah data awal untuk mencoba script SELECT.'),
('Baskoro', 'Sedang belajar PHP PDO hari ini, sangat seru!');
