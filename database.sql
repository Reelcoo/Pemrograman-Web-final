-- =========================
-- 1. DATABASE
-- =========================
CREATE DATABASE web_wisata;
USE web_wisata;

-- =========================
-- 2. TABEL USERS (login)
-- =========================
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(50) NOT NULL,
  role ENUM('admin','user') NOT NULL
);

-- Akun default
INSERT INTO users (username,password,role) VALUES
('admin','admin123','admin'),
('user','user123','user');

-- =========================
-- 3. TABEL DESTINASI WISATA
-- =========================
CREATE TABLE destinasi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  lokasi VARCHAR(100) NOT NULL,
  kategori VARCHAR(50) NOT NULL,
  deskripsi TEXT,
  gambar VARCHAR(150),
  harga_domestik INT NOT NULL,
  harga_mancanegara INT NOT NULL,
  parkir_motor INT NOT NULL,
  parkir_mobil INT NOT NULL
);

-- data destinasi 
INSERT INTO destinasi
(nama,lokasi,kategori,deskripsi,gambar,
 harga_domestik,harga_mancanegara,parkir_motor,parkir_mobil)
VALUES
('Pantai Pelabuhan Ratu','Sukabumi','Pantai','Pantai populer di Sukabumi','pantai.jpg',25000,100000,5000,10000),
('Curug Cikaso','Sukabumi','Air Terjun','Air terjun alami','curug.jpg',20000,75000,3000,8000),
('Geopark Ciletuh','Sukabumi','Alam','Geopark dunia','ciletuh.jpg',30000,120000,5000,12000);
-- DISESUAIKAN DENGAN FILE YG DIMAKSUD
-- =========================
-- 4. TABEL PEMESANAN
-- =========================
CREATE TABLE pemesanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_wisata INT NOT NULL,
  nama VARCHAR(100) NOT NULL,
  no_hp VARCHAR(20) NOT NULL,
  jumlah INT NOT NULL,
  tipe VARCHAR(20) NOT NULL,
  total_harga INT NOT NULL,
  metode_pembayaran VARCHAR(30) NOT NULL,
  tanggal_pesan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_wisata) REFERENCES destinasi(id)
    ON DELETE CASCADE
);

-- =========================
-- 5. TABEL PEMBAYARAN
-- =========================
CREATE TABLE pembayaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_pemesanan INT UNIQUE,
  status ENUM('Menunggu','Lunas','Ditolak') DEFAULT 'Menunggu',
  FOREIGN KEY (id_pemesanan) REFERENCES pemesanan(id)
    ON DELETE CASCADE
);
