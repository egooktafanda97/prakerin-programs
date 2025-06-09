-- Tabel users yang menyimpan informasi login dan peran
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    nama_lengkap VARCHAR(255),
    role ENUM('admin', 'siswa', 'guru', 'perusahaan', 'instruktur') DEFAULT 'siswa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel siswa yang merujuk pada tabel users untuk data login
CREATE TABLE siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Referensi ke tabel users
    nis VARCHAR(20) UNIQUE,
    nama VARCHAR(255),
    kelas VARCHAR(50),
    jurusan VARCHAR(100),
    no_hp VARCHAR(20),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) -- Menyambungkan ke users
);

-- Tabel guru yang merujuk pada tabel users untuk data login
CREATE TABLE guru (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Referensi ke tabel users
    nip VARCHAR(20) UNIQUE,
    nama VARCHAR(255),
    no_hp VARCHAR(20),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) -- Menyambungkan ke users
);

-- Tabel perusahaan yang merujuk pada tabel users untuk data login
CREATE TABLE perusahaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Referensi ke tabel users
    nama_perusahaan VARCHAR(255),
    alamat TEXT,
    kontak_person VARCHAR(100),
    no_hp VARCHAR(20),
    bidang_usaha VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) -- Menyambungkan ke users
);

-- Tabel instruktur yang merujuk pada tabel users untuk data login
CREATE TABLE instruktur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Referensi ke tabel users
    nama VARCHAR(255),
    no_hp VARCHAR(20),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) -- Menyambungkan ke users
);

-- Tabel penempatan prakerin yang menghubungkan siswa, guru, perusahaan, dan instruktur
CREATE TABLE penempatan_prakerin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_id INT,
    perusahaan_id INT,
    guru_id INT,
    instruktur_id INT, -- Menambahkan kolom instruktur_id untuk merujuk pada instruktur
    tanggal_mulai DATE,
    tanggal_selesai DATE,
    status ENUM('Aktif', 'Selesai', 'Batal') DEFAULT 'Aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id),
    FOREIGN KEY (perusahaan_id) REFERENCES perusahaan(id),
    FOREIGN KEY (guru_id) REFERENCES guru(id),
    FOREIGN KEY (instruktur_id) REFERENCES instruktur(id) -- Menyambungkan ke instruktur
);

-- Tabel logbook prakerin yang mencatat aktivitas siswa selama prakerin
CREATE TABLE logbook_prakerin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    penempatan_id INT,
    tanggal DATE,
    aktivitas TEXT,
    validasi_instruktur ENUM('Belum Divalidasi', 'Valid', 'Tidak Valid') DEFAULT 'Belum Divalidasi', -- Validasi oleh instruktur
    validasi_instruktur_at TIMESTAMP NULL, -- Waktu validasi oleh instruktur
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (penempatan_id) REFERENCES penempatan_prakerin(id)
);

-- Tabel penilaian yang mencatat nilai siswa dari instruktur dan guru
CREATE TABLE penilaian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    penempatan_id INT,
    nilai_kehadiran INT,
    nilai_disiplin INT,
    nilai_kerjasama INT,
    nilai_inisiatif INT,
    nilai_akhir INT,
    catatan TEXT,
    instruktur_id INT, -- Mengganti kolom penilai dengan instruktur_id untuk merujuk ke instruktur yang memberi penilaian
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (penempatan_id) REFERENCES penempatan_prakerin(id),
    FOREIGN KEY (instruktur_id) REFERENCES instruktur(id) -- Menyambungkan ke instruktur
);
