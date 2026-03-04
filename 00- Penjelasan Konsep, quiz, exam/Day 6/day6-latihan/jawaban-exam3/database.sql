CREATE DATABASE IF NOT EXISTS db_latihan;
USE db_latihan;

CREATE TABLE IF NOT EXISTS tamu(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama varchar(50),
  pesan text,
  waktu_kirim datetime default current_timestamp
);