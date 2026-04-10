-- Sistem Perpustakaan - Database Schema
-- Database: perpustakaan12

CREATE DATABASE IF NOT EXISTS perpustakaan12;
USE perpustakaan12;

-- Tabel users (anggota dan admin)
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel books (buku)
CREATE TABLE IF NOT EXISTS books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    isbn VARCHAR(20),
    tahun_terbit YEAR,
    kategori VARCHAR(50) NOT NULL,
    stok INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel borrows (peminjaman)
CREATE TABLE IF NOT EXISTS borrows (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    tanggal_peminjaman DATE NOT NULL,
    tanggal_kembali_target DATE NOT NULL,
    tanggal_dikembalikan DATE NULL,
    kondisi ENUM('baik', 'rusak_ringan', 'rusak_berat', 'hilang') NULL,
    status ENUM('active', 'returned') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

-- Insert admin user (password: admin123)
INSERT INTO users (nama, email, password, role) VALUES
('Administrator', 'admin@perpustakaan.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')
ON DUPLICATE KEY UPDATE id=id;

-- Insert sample books
INSERT INTO books (judul, pengarang, penerbit, isbn, tahun_terbit, kategori, stok) VALUES
('Belajar PHP dari Nol', 'John Doe', 'Penerbit Tech', '978-1234567890', 2023, 'Teknologi', 5),
('Pemrograman Web Modern', 'Jane Smith', 'Penerbit Edu', '978-0987654321', 2022, 'Teknologi', 3),
('Sejarah Indonesia', 'Ahmad Rahman', 'Penerbit Sejarah', '978-1122334455', 2021, 'Sejarah', 4),
('Matematika Dasar', 'Dr. Siti Aminah', 'Penerbit Pendidikan', '978-5566778899', 2020, 'Pendidikan', 6),
('Fiksi Ilmiah: Masa Depan', 'Budi Santoso', 'Penerbit Fiksi', '978-9988776655', 2023, 'Fiksi', 2)
ON DUPLICATE KEY UPDATE id=id;

-- Insert sample users
INSERT INTO users (nama, email, password, role) VALUES
('Ahmad Fauzi', 'ahmad@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Siti Nurhaliza', 'siti@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Rudi Hartono', 'rudi@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user')
ON DUPLICATE KEY UPDATE id=id;