-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Bulan Mei 2025 pada 22.15
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esurat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval`
--

CREATE TABLE `approval` (
  `id_approval` int NOT NULL,
  `id_surat` int NOT NULL,
  `id_atasan` int NOT NULL,
  `status` enum('approved','rejected') DEFAULT NULL,
  `komentar` text,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip_surat`
--

CREATE TABLE `arsip_surat` (
  `id_arsip` int NOT NULL,
  `id_surat` int NOT NULL,
  `tanggal_arsip` datetime DEFAULT NULL,
  `lokasi_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id_jenis` int NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `template_surat` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_surat`
--

INSERT INTO `jenis_surat` (`id_jenis`, `nama_jenis`, `template_surat`) VALUES
(1, 'izin', ''),
(2, 'pengunduran diri', ''),
(3, 'keterangan kerja\r\n', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` int NOT NULL,
  `id_user` int NOT NULL,
  `role` enum('pegawai','direktur') DEFAULT NULL,
  `aktivitas` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_activity`
--

INSERT INTO `log_activity` (`id_log`, `id_user`, `role`, `aktivitas`, `waktu`) VALUES
(1, 2, 'pegawai', 'Login ke sistem', '2025-05-14 14:01:29'),
(2, 2, 'pegawai', 'Login ke sistem', '2025-05-14 15:18:02'),
(3, 2, 'pegawai', 'Login ke sistem', '2025-05-14 15:25:21'),
(4, 2, 'pegawai', 'Login ke sistem', '2025-05-14 15:25:55'),
(5, 2, 'pegawai', 'Login ke sistem', '2025-05-14 15:27:32'),
(6, 3, 'direktur', 'Login ke sistem', '2025-05-14 15:27:48'),
(7, 2, 'pegawai', 'Login ke sistem', '2025-05-14 15:31:59'),
(8, 2, 'pegawai', 'Login ke sistem', '2025-05-14 15:42:44'),
(9, 2, 'pegawai', 'Login ke sistem', '2025-05-14 15:45:22'),
(10, 2, 'pegawai', 'Menambahkan surat: 1', '2025-05-14 15:54:47'),
(11, 2, 'pegawai', 'Login ke sistem', '2025-05-14 16:18:10'),
(12, 2, 'pegawai', 'Menambahkan surat: 1', '2025-05-14 16:30:07'),
(13, 2, 'pegawai', 'Menambahkan surat: 3', '2025-05-14 16:35:07'),
(14, 3, 'direktur', 'Login ke sistem', '2025-05-14 16:35:48'),
(15, 2, 'pegawai', 'Login ke sistem', '2025-05-14 16:52:21'),
(16, 5, 'pegawai', 'Login ke sistem', '2025-05-14 16:54:43'),
(17, 2, 'pegawai', 'Login ke sistem', '2025-05-14 16:57:42'),
(18, 2, 'pegawai', 'Login ke sistem', '2025-05-14 18:23:29'),
(19, 2, 'pegawai', 'Login ke sistem', '2025-05-14 18:26:28'),
(20, 3, 'direktur', 'Login ke sistem', '2025-05-14 18:45:24'),
(21, 3, 'direktur', 'Login ke sistem', '2025-05-14 20:23:59'),
(22, 3, 'direktur', 'Login ke sistem', '2025-05-14 20:35:15'),
(23, 3, 'direktur', 'Login ke sistem', '2025-05-14 20:39:57'),
(24, 2, 'pegawai', 'Login ke sistem', '2025-05-14 20:56:18'),
(25, 2, 'pegawai', 'Menambahkan surat: 1', '2025-05-14 20:58:31'),
(26, 2, 'pegawai', 'Menambahkan surat: 3', '2025-05-14 21:00:31'),
(27, 2, 'pegawai', 'Menambahkan surat: 12', '2025-05-14 21:01:51'),
(28, 2, 'pegawai', 'Menambahkan surat: 1', '2025-05-14 21:28:38'),
(29, 2, 'pegawai', 'Login ke sistem', '2025-05-14 21:32:43'),
(30, 2, 'pegawai', 'Login ke sistem', '2025-05-14 21:33:18'),
(31, 3, 'direktur', 'Login ke sistem', '2025-05-14 21:44:09'),
(32, 2, 'pegawai', 'Login ke sistem', '2025-05-14 21:50:51'),
(33, 3, 'direktur', 'Login ke sistem', '2025-05-14 21:52:26'),
(34, 2, 'pegawai', 'Login ke sistem', '2025-05-14 22:11:12'),
(35, 3, 'direktur', 'Login ke sistem', '2025-05-14 22:11:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `id_surat` int NOT NULL,
  `id_user` int NOT NULL,
  `id_jenis` int NOT NULL,
  `no_surat` int DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `perihal` text,
  `tanggal_buat` date DEFAULT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `status_approval` enum('pending','approved','rejected') DEFAULT NULL,
  `catatan` text,
  `tanggal_kirim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`id_surat`, `id_user`, `id_jenis`, `no_surat`, `nama`, `jenis_surat`, `perihal`, `tanggal_buat`, `file_pdf`, `status_approval`, `catatan`, `tanggal_kirim`) VALUES
(37, 2, 1, 1, 'mali', 'surat izin sakit', 'flu', '2025-05-14', NULL, 'approved', 'ok', '2025-05-14 16:30:07'),
(38, 2, 1, 2, 'mala', 'kerja ', 'abcd', '2025-05-01', NULL, 'rejected', 'caca', '2025-05-14 16:35:07'),
(39, 2, 2, 1, 'tin', 'izin', 'tidak betah', '2025-05-01', NULL, 'approved', 'ok', '2025-05-14 20:58:31'),
(40, 2, 1, 3, 'caris', 'izin sakit', 'demam', '2025-05-01', NULL, 'rejected', 'no', '2025-05-14 21:00:31'),
(41, 2, 3, 12, 'hore', 'kerja', 'kerja', '2025-05-01', NULL, 'pending', '', '2025-05-14 21:01:51'),
(42, 2, 2, 1, 'lal', 'pengunduran diri', 'tidak betal', '2025-05-01', NULL, 'pending', '', '2025-05-14 21:28:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `role` enum('admin','pegawai','direktur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `status`, `role`) VALUES
(1, 'admin', 'admin123', 'aktif', 'admin'),
(2, 'pegawai', 'pegawai123', 'aktif', 'pegawai'),
(3, 'direktur', 'direktur123', 'suspend', 'direktur'),
(5, 'pegawai 2', 'pegawai321', 'aktif', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id_approval`),
  ADD KEY `id_surat` (`id_surat`),
  ADD KEY `id_atasan` (`id_atasan`);

--
-- Indeks untuk tabel `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `id_surat` (`id_surat`);

--
-- Indeks untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `approval`
--
ALTER TABLE `approval`
  MODIFY `id_approval` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `arsip_surat`
--
ALTER TABLE `arsip_surat`
  MODIFY `id_arsip` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `approval`
--
ALTER TABLE `approval`
  ADD CONSTRAINT `approval_ibfk_1` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id_surat`),
  ADD CONSTRAINT `approval_ibfk_2` FOREIGN KEY (`id_atasan`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD CONSTRAINT `arsip_surat_ibfk_1` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id_surat`);

--
-- Ketidakleluasaan untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD CONSTRAINT `log_activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `surat_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_surat` (`id_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
