-- Setup Database Toko Kita
CREATE DATABASE IF NOT EXISTS toko_kita;
USE toko_kita;

CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data Awal
INSERT INTO produk (nama_produk, harga, stok) VALUES 
('Laptop ASUS', 12000000, 10),
('Mouse Logitech', 150000, 50),
('Keyboard Mechanical', 450000, 20);
