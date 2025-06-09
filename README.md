Siap! Aku akan bantu analisis **lengkap dan rapi** berdasarkan narasi latar belakangmu tentang **"Sistem Informasi Administrasi Prakerin Siswa SMK N 1 Benai"**.

Hasil analisis akan aku susun jadi tiga bagian:

1. **Alur Sistem**
2. **Menu pada Aplikasi**
3. **Susunan Database (SQL: create table)**

---

# 📈 1. Alur Sistem

Berikut **alur sistem sederhana** dari aplikasi administrasi Prakerin:

```
[Admin Input Data Prakerin]
    --> [Data Siswa]
    --> [Data Guru Pembimbing]
    --> [Data Perusahaan Mitra]
    --> [Penempatan Siswa ke Perusahaan]
    --> [Monitoring & Laporan Prakerin]

[Siswa Login]
    --> [Lihat Informasi Penempatan]
    --> [Update Progress Prakerin]

[Guru Pembimbing Login]
    --> [Monitoring Progress Siswa]
    --> [Input Penilaian dan Evaluasi]

[Perusahaan Login]
    --> [Konfirmasi Kehadiran Siswa]
    --> [Isi Penilaian Akhir]

[Admin]
    --> [Generate Laporan Prakerin]
    --> [Cetak Laporan Siswa/Guru/Perusahaan]
```

### Ringkasan Alur:

-   Admin mendata semua informasi siswa, guru, perusahaan, dan penempatan siswa.
-   Siswa login untuk melihat penempatan dan update aktivitas Prakerin.
-   Guru pembimbing memantau siswa dan mengisi nilai.
-   Perusahaan mengkonfirmasi dan memberi evaluasi siswa.
-   Admin mengelola laporan-laporan Prakerin.

---

# 🧩 2. Menu pada Aplikasi

**Menu untuk Admin:**

-   Dashboard
-   Master Data:
    -   Data Siswa (CRUD)
    -   Data Guru Pembimbing (CRUD)
    -   Data Perusahaan Mitra (CRUD)
-   Penempatan Siswa:
    -   Input Penempatan
    -   Edit Penempatan
-   Monitoring Prakerin:
    -   Lihat Progress
    -   Validasi Laporan Siswa
-   Laporan:
    -   Laporan Data Penempatan
    -   Laporan Monitoring Prakerin
    -   Cetak PDF/Excel

**Menu untuk Siswa:**

-   Dashboard
-   Informasi Penempatan
-   Update Aktivitas/Logbook Harian
-   Lihat Penilaian

**Menu untuk Guru Pembimbing:**

-   Dashboard
-   Data Siswa Bimbingan
-   Monitoring Aktivitas Siswa
-   Input Penilaian

**Menu untuk Perusahaan:**

-   Dashboard
-   Daftar Siswa Prakerin
-   Konfirmasi Kehadiran
-   Penilaian Akhir

**Menu Tambahan:**

-   Manajemen User (admin, siswa, guru, perusahaan)
-   Profil & Ganti Password

---

# 🛢️ 3. Susunan Database SQL (CREATE TABLE)

Berikut struktur database `mysql` untuk sistem ini:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    nama_lengkap VARCHAR(255),
    role ENUM('admin', 'siswa', 'guru', 'perusahaan') DEFAULT 'siswa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nis VARCHAR(20) UNIQUE,
    nama VARCHAR(255),
    kelas VARCHAR(50),
    jurusan VARCHAR(100),
    no_hp VARCHAR(20),
    alamat TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE guru (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nip VARCHAR(20) UNIQUE,
    nama VARCHAR(255),
    no_hp VARCHAR(20),
    alamat TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE perusahaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nama_perusahaan VARCHAR(255),
    alamat TEXT,
    kontak_person VARCHAR(100),
    no_hp VARCHAR(20),
    bidang_usaha VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE penempatan_prakerin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_id INT,
    perusahaan_id INT,
    guru_id INT,
    tanggal_mulai DATE,
    tanggal_selesai DATE,
    status ENUM('Aktif', 'Selesai', 'Batal') DEFAULT 'Aktif',
    FOREIGN KEY (siswa_id) REFERENCES siswa(id),
    FOREIGN KEY (perusahaan_id) REFERENCES perusahaan(id),
    FOREIGN KEY (guru_id) REFERENCES guru(id)
);

CREATE TABLE logbook_prakerin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    penempatan_id INT,
    tanggal DATE,
    aktivitas TEXT,
    validasi_guru ENUM('Belum Divalidasi', 'Valid', 'Tidak Valid') DEFAULT 'Belum Divalidasi',
    FOREIGN KEY (penempatan_id) REFERENCES penempatan_prakerin(id)
);

CREATE TABLE penilaian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    penempatan_id INT,
    nilai_kehadiran INT,
    nilai_disiplin INT,
    nilai_kerjasama INT,
    nilai_inisiatif INT,
    nilai_akhir INT,
    catatan TEXT,
    penilai ENUM('Guru', 'Perusahaan'),
    FOREIGN KEY (penempatan_id) REFERENCES penempatan_prakerin(id)
);
```

---

# ✨ Ringkasan Akhir

| Bagian        | Isi                                                                           |
| :------------ | :---------------------------------------------------------------------------- |
| Alur Sistem   | Admin input data → siswa lihat → guru & perusahaan monitoring → laporan       |
| Menu Aplikasi | Admin, Siswa, Guru, Perusahaan masing-masing punya dashboard dan fitur khusus |
| Database SQL  | 7 tabel: users, siswa, guru, perusahaan, penempatan, logbook, penilaian       |

---

Kalau mau sekalian aku buatkan:

-   **ERD (Entity Relationship Diagram)** visual
-   **Mockup UI** (contoh tampilan dashboard dan form)
-   **Flow input data hingga cetak laporan**

Mau sekalian aku buat lanjutannya? 🚀 Mau lanjut dari **ERD** atau **contoh tampilan menu** dulu? 🌟  
(tinggal pilih aja!)
