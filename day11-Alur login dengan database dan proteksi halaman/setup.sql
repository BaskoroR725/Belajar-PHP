CREATE DATABASE IF NOT EXISTS login_php_day11;
USE login_php_day11;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Password untuk user 'admin' adalah: admin123
INSERT INTO users (username, password_hash)
VALUES ('admin', '$2y$10$twSXkU1E8WUfLM2Q0Z6TjOstI67lGk4es0sLhO4J4O0fYVn1w/PcC')
ON DUPLICATE KEY UPDATE username = VALUES(username);
