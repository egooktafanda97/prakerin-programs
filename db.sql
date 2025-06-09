-- -------------------------------------------------------------
-- TablePlus 6.0.0(550)
--
-- https://tableplus.com/
--
-- Database: db_prakerin
-- Generation Time: 2025-06-09 15:59:46.6790
-- -------------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

CREATE TABLE `data_nilai_siswa` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `nama_dokumen` varchar(255) NOT NULL,
    `dokument` varchar(255) NOT NULL,
    `keterangan` text,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 9 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `failed_jobs` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `guru` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int DEFAULT NULL,
    `nip` varchar(20) DEFAULT NULL,
    `nama` varchar(255) DEFAULT NULL,
    `no_hp` varchar(20) DEFAULT NULL,
    `alamat` text,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `nip` (`nip`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `instruktur` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int DEFAULT NULL,
    `nama` varchar(255) DEFAULT NULL,
    `no_hp` varchar(20) DEFAULT NULL,
    `alamat` text,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `instruktur_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `logbook_prakerin` (
    `id` int NOT NULL AUTO_INCREMENT,
    `penempatan_id` int DEFAULT NULL,
    `tanggal` date DEFAULT NULL,
    `aktivitas` text,
    `validasi_instruktur` enum(
        'Belum Divalidasi',
        'Valid',
        'Tidak Valid'
    ) DEFAULT 'Belum Divalidasi',
    `validasi_instruktur_at` timestamp NULL DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `user_id` int DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `penempatan_id` (`penempatan_id`),
    CONSTRAINT `logbook_prakerin_ibfk_1` FOREIGN KEY (`penempatan_id`) REFERENCES `penempatan_prakerin` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `migrations` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `penempatan_prakerin` (
    `id` int NOT NULL AUTO_INCREMENT,
    `siswa_id` int DEFAULT NULL,
    `perusahaan_id` int DEFAULT NULL,
    `guru_id` int DEFAULT NULL,
    `instruktur_id` int DEFAULT NULL,
    `tanggal_mulai` date DEFAULT NULL,
    `tanggal_selesai` date DEFAULT NULL,
    `status` enum('aktif', 'selesai', 'batal') DEFAULT 'aktif',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `tahun_ajaran` varchar(10) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `siswa_id` (`siswa_id`),
    KEY `guru_id` (`guru_id`),
    KEY `instruktur_id` (`instruktur_id`),
    CONSTRAINT `penempatan_prakerin_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`),
    CONSTRAINT `penempatan_prakerin_ibfk_3` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`),
    CONSTRAINT `penempatan_prakerin_ibfk_4` FOREIGN KEY (`instruktur_id`) REFERENCES `instruktur` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `penilaian` (
    `id` int NOT NULL AUTO_INCREMENT,
    `penempatan_id` int DEFAULT NULL,
    `nilai_kehadiran` int DEFAULT NULL,
    `nilai_disiplin` int DEFAULT NULL,
    `nilai_kerjasama` int DEFAULT NULL,
    `nilai_inisiatif` int DEFAULT NULL,
    `nilai_akhir` int DEFAULT NULL,
    `catatan` text,
    `instruktur_id` int DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `siswa_id` int DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `penempatan_id` (`penempatan_id`),
    KEY `instruktur_id` (`instruktur_id`),
    CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`penempatan_id`) REFERENCES `penempatan_prakerin` (`id`),
    CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`instruktur_id`) REFERENCES `instruktur` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `personal_access_tokens` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `tokenable_id` bigint unsigned NOT NULL,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
    `abilities` text COLLATE utf8mb4_unicode_ci,
    `last_used_at` timestamp NULL DEFAULT NULL,
    `expires_at` timestamp NULL DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (
        `tokenable_type`,
        `tokenable_id`
    )
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `perusahaan` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nama_perusahaan` varchar(255) DEFAULT NULL,
    `alamat` text,
    `no_hp` varchar(20) DEFAULT NULL,
    `bidang_usaha` varchar(100) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `koordinat` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `siswa` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int DEFAULT NULL,
    `nis` varchar(20) DEFAULT NULL,
    `nama` varchar(255) DEFAULT NULL,
    `kelas` varchar(50) DEFAULT NULL,
    `jurusan` varchar(100) DEFAULT NULL,
    `no_hp` varchar(20) DEFAULT NULL,
    `alamat` text,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `nis` (`nis`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(50) DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
    `nama_lengkap` varchar(255) DEFAULT NULL,
    `role` enum(
        'admin',
        'siswa',
        'guru',
        'perusahaan',
        'instruktur'
    ) DEFAULT 'siswa',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
) ENGINE = InnoDB AUTO_INCREMENT = 14 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

INSERT INTO
    `data_nilai_siswa` (
        `id`,
        `nama_dokumen`,
        `dokument`,
        `keterangan`,
        `created_at`,
        `updated_at`
    )
VALUES (
        8,
        'Nilai siswa tahun ajaran 2024/2025',
        'uploads/nilai_siswa/1748987215_896-invoice-1650-1okk.pdf',
        '-',
        '2025-06-03 21:42:41',
        '2025-06-03 21:46:55'
    );

INSERT INTO
    `guru` (
        `id`,
        `user_id`,
        `nip`,
        `nama`,
        `no_hp`,
        `alamat`,
        `created_at`,
        `updated_at`
    )
VALUES (
        2,
        6,
        '123001',
        'igo',
        '082',
        'tess',
        '2025-05-07 07:36:43',
        '2025-05-07 07:36:43'
    );

INSERT INTO
    `instruktur` (
        `id`,
        `user_id`,
        `nama`,
        `no_hp`,
        `alamat`,
        `created_at`,
        `updated_at`
    )
VALUES (
        2,
        9,
        'igoX',
        '08',
        '-',
        '2025-05-19 15:01:40',
        '2025-05-19 15:01:40'
    );

INSERT INTO
    `logbook_prakerin` (
        `id`,
        `penempatan_id`,
        `tanggal`,
        `aktivitas`,
        `validasi_instruktur`,
        `validasi_instruktur_at`,
        `created_at`,
        `updated_at`,
        `user_id`
    )
VALUES (
        6,
        2,
        '2025-06-04',
        'main aja',
        'Valid',
        '2025-06-03 19:48:29',
        '2025-06-03 18:45:42',
        '2025-06-03 19:48:29',
        13
    ),
    (
        7,
        1,
        '2025-06-05',
        'pppp',
        'Belum Divalidasi',
        NULL,
        '2025-06-03 18:46:09',
        '2025-06-03 18:46:09',
        1
    );

INSERT INTO
    `migrations` (`id`, `migration`, `batch`)
VALUES (
        1,
        '2014_10_12_000000_create_users_table',
        1
    ),
    (
        2,
        '2014_10_12_100000_create_password_reset_tokens_table',
        1
    ),
    (
        3,
        '2019_08_19_000000_create_failed_jobs_table',
        1
    ),
    (
        4,
        '2019_12_14_000001_create_personal_access_tokens_table',
        1
    );

INSERT INTO
    `penempatan_prakerin` (
        `id`,
        `siswa_id`,
        `perusahaan_id`,
        `guru_id`,
        `instruktur_id`,
        `tanggal_mulai`,
        `tanggal_selesai`,
        `status`,
        `created_at`,
        `updated_at`,
        `tahun_ajaran`
    )
VALUES (
        1,
        1,
        2,
        2,
        2,
        '2025-05-01',
        '2025-06-30',
        'aktif',
        '2025-05-24 22:28:24',
        '2025-05-24 23:11:58',
        '2023/2025'
    ),
    (
        2,
        2,
        2,
        2,
        2,
        '2025-06-04',
        '2025-06-06',
        'aktif',
        '2025-06-03 17:43:52',
        '2025-06-03 17:43:52',
        '2025'
    );

INSERT INTO
    `penilaian` (
        `id`,
        `penempatan_id`,
        `nilai_kehadiran`,
        `nilai_disiplin`,
        `nilai_kerjasama`,
        `nilai_inisiatif`,
        `nilai_akhir`,
        `catatan`,
        `instruktur_id`,
        `created_at`,
        `updated_at`,
        `siswa_id`
    )
VALUES (
        2,
        1,
        20,
        40,
        50,
        10,
        30,
        'parah',
        2,
        '2025-06-03 09:57:21',
        '2025-06-03 17:47:20',
        1
    ),
    (
        3,
        2,
        10,
        10,
        10,
        10,
        10,
        '-',
        2,
        '2025-06-03 17:47:31',
        '2025-06-03 17:47:31',
        2
    );

INSERT INTO
    `perusahaan` (
        `id`,
        `nama_perusahaan`,
        `alamat`,
        `no_hp`,
        `bidang_usaha`,
        `created_at`,
        `updated_at`,
        `koordinat`
    )
VALUES (
        2,
        'PT RSX',
        'aksjbf',
        '0822',
        'IT',
        '2025-05-19 19:02:23',
        '2025-06-03 20:27:51',
        '0.2971720522360002, 102.27441055239692'
    );

INSERT INTO
    `siswa` (
        `id`,
        `user_id`,
        `nis`,
        `nama`,
        `kelas`,
        `jurusan`,
        `no_hp`,
        `alamat`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1,
        '1231412',
        'ego oktafanda x',
        'XII',
        'Tenik Informatika',
        '0822847333404',
        'sungailangsat',
        '2025-05-06 20:37:43',
        '2025-05-06 21:02:45'
    ),
    (
        2,
        13,
        '214124',
        'rrr',
        'XII1',
        'TI',
        '082',
        '-',
        '2025-06-03 17:43:27',
        '2025-06-03 17:43:27'
    );

INSERT INTO
    `users` (
        `id`,
        `username`,
        `password`,
        `nama_lengkap`,
        `role`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'siswax',
        '$2y$12$sDk2VxfRbqEcECqottVfDeCeJIHT5BOk7RaeGNWPw3gYiQ0580SfO',
        'ego oktafanda x',
        'siswa',
        '2025-05-06 20:37:43',
        '2025-05-06 21:02:45'
    ),
    (
        2,
        'admin',
        '$2y$12$Mo5tcscgqXx0wBOjG3ICW.G1YBtBnAH/xNSnPxtsWgWjL9addhYDe',
        NULL,
        'admin',
        '2025-05-07 06:58:02',
        '2025-06-04 01:43:02'
    ),
    (
        6,
        'igo',
        '$2y$12$XuvF9rkm0J4Ss9SXpeOgaulutXAgTeFdgDyCYQqQVGhU3ocI09A.W',
        'igo',
        'guru',
        '2025-05-07 07:36:43',
        '2025-06-04 01:42:56'
    ),
    (
        7,
        'Instruktur',
        '$2y$12$Naoj1a0rGIyvpdtzCdLdF.7VjfZjxa6hHdTRx6c1YwokbG6dDwQey',
        'Instruktur',
        'siswa',
        '2025-05-07 09:03:20',
        '2025-05-07 09:08:55'
    ),
    (
        9,
        'igoX',
        '$2y$12$WGpJo3gZM35InC6E2ssot.6E59KCnXtvnjXpu.LqoIEz4ltvqfHJ.',
        'igoX',
        'instruktur',
        '2025-05-19 15:01:40',
        '2025-05-19 15:01:40'
    ),
    (
        10,
        NULL,
        '$2y$12$VrtGCSRY7go3GEaltrqNEOi2d6T9sgj1p4najT5hfsCMrhAqRUt.S',
        NULL,
        'perusahaan',
        '2025-05-19 18:51:09',
        '2025-05-19 18:51:09'
    ),
    (
        11,
        NULL,
        '$2y$12$Yr6tLfU9AfmFCcpXdcFx1uh1VZ72hjXuWAFCOeIqwQC8C574YpDwe',
        NULL,
        'perusahaan',
        '2025-05-19 19:02:23',
        '2025-05-19 19:02:23'
    ),
    (
        13,
        'usx',
        '$2y$12$LCcQcjQH/f8GLo5nLNl7ju80BP7ydIxXef8pBH3U4S7VTGwag2D5C',
        'rrr',
        'siswa',
        '2025-06-03 17:43:27',
        '2025-06-03 17:43:27'
    );

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;