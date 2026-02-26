CREATE DATABASE IF NOT EXISTS project_php_day13;
USE project_php_day13;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    gambar VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- username: admin | password: admin123
INSERT INTO users (username, password_hash)
VALUES ('admin', '$2y$10$twSXkU1E8WUfLM2Q0Z6TjOstI67lGk4es0sLhO4J4O0fYVn1w/PcC')
ON DUPLICATE KEY UPDATE username = VALUES(username);
