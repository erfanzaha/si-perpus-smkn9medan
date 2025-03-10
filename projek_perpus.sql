-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2024 at 12:59 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya_denda`
--

DROP TABLE IF EXISTS `tbl_biaya_denda`;
CREATE TABLE IF NOT EXISTS `tbl_biaya_denda` (
  `id_biaya_denda` int(11) NOT NULL AUTO_INCREMENT,
  `harga_denda` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  `tgl_tetap` varchar(255) NOT NULL,
  PRIMARY KEY (`id_biaya_denda`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_biaya_denda`
--

INSERT INTO `tbl_biaya_denda` (`id_biaya_denda`, `harga_denda`, `stat`, `tgl_tetap`) VALUES
(2, '500', 'Tidak Aktif', '2023-08-10'),
(3, '1000', 'Aktif', '2024-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

DROP TABLE IF EXISTS `tbl_buku`;
CREATE TABLE IF NOT EXISTS `tbl_buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `buku_id` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `thn_buku` varchar(255) DEFAULT NULL,
  `isi` text,
  `jml` int(11) DEFAULT NULL,
  `tgl_masuk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `buku_id`, `id_kategori`, `id_rak`, `sampul`, `isbn`, `lampiran`, `title`, `penerbit`, `pengarang`, `thn_buku`, `isi`, `jml`, `tgl_masuk`) VALUES
(8, 'BK008', 2, 1, '0', '132-123-234-231', '0', 'CARA MUDAH BELAJAR PEMROGRAMAN C++', 'INFORMATIKA BANDUNG', 'BUDI RAHARJO ', '2012', '<table class=\"table table-bordered\" style=\"background-color: rgb(255, 255, 255); width: 653px; color: rgb(51, 51, 51);\"><tbody><tr><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Tipe Buku</td><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Kertas</td></tr><tr><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Bahasa</td><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Indonesia</td></tr></tbody></table>', 23, '2019-11-23 11:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_denda`
--

DROP TABLE IF EXISTS `tbl_denda`;
CREATE TABLE IF NOT EXISTS `tbl_denda` (
  `id_denda` int(11) NOT NULL AUTO_INCREMENT,
  `pinjam_id` varchar(255) NOT NULL,
  `denda` varchar(255) NOT NULL,
  `lama_waktu` int(11) NOT NULL,
  `tgl_denda` varchar(255) NOT NULL,
  PRIMARY KEY (`id_denda`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_denda`
--

INSERT INTO `tbl_denda` (`id_denda`, `pinjam_id`, `denda`, `lama_waktu`, `tgl_denda`) VALUES
(3, 'PJ001', '0', 0, '2020-05-20'),
(5, 'PJ009', '0', 0, '2020-05-20'),
(6, 'PJ0011', '0', 0, '2022-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

DROP TABLE IF EXISTS `tbl_kategori`;
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Pemrograman'),
(3, 'Jaringan'),
(4, 'Buku Produktif'),
(5, 'Buku Bacaan'),
(6, 'Buku Guru'),
(7, 'Kamus'),
(8, 'Pendalaman Materi'),
(9, 'Seni'),
(10, 'Agama'),
(11, 'Umum'),
(12, 'Novel'),
(13, 'Sastra');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

DROP TABLE IF EXISTS `tbl_login`;
CREATE TABLE IF NOT EXISTS `tbl_login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `anggota_id` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tgl_bergabung` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `anggota_id`, `user`, `pass`, `level`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenkel`, `alamat`, `telepon`, `email`, `tgl_bergabung`, `foto`) VALUES
(1, 'AG001', 'zidan16', '17c4520f6cfd1ab53d8745e84681eb49', 'Petugas', 'Zidan', 'Medan', '2000-02-16', 'Laki-Laki', 'Helvetia', '082261093369', 'zaidanhamdany@gmail.com', '2022-10-05', 'IMG_0066.jpg'),
(2, 'AG002', 'user', '5f4dcc3b5aa765d61d8327deb882cf99', 'Anggota', 'Anggota 1', 'Medan', '1999-08-01', 'Perempuan', 'Kp. Lalang', '081212312316', 'user@mail.com', '2022-10-06', 'user_1722261166.jpg'),
(3, 'AG003', 'siswa', '5f4dcc3b5aa765d61d8327deb882cf99', 'Anggota', 'siswa', 'Medan', '2008-08-24', 'Laki-Laki', 'Medan', '089675849038', 'siswa1@mail.com', '2024-07-29', 'user_1722260888.jpg'),
(4, 'AG004', 'admin123', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Petugas', 'Admin', 'Medan', '1995-05-20', 'Perempuan', 'Sunggal', '081324536748', 'admin1@mail.com', '2024-07-29', 'user_1722261003.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

DROP TABLE IF EXISTS `tbl_pinjam`;
CREATE TABLE IF NOT EXISTS `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `pinjam_id` varchar(255) NOT NULL,
  `anggota_id` varchar(255) NOT NULL,
  `buku_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `lama_pinjam` int(11) NOT NULL,
  `tgl_balik` varchar(255) NOT NULL,
  `tgl_kembali` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pinjam`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `pinjam_id`, `anggota_id`, `buku_id`, `status`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali`) VALUES
(8, 'PJ001', 'AG002', 'BK008', 'Di Kembalikan', '2020-05-19', 1, '2020-05-20', '2020-05-20'),
(10, 'PJ009', 'AG002', 'BK008', 'Di Kembalikan', '2020-05-20', 1, '2020-05-21', '2020-05-20'),
(11, 'PJ0011', 'AG002', 'BK008', 'Di Kembalikan', '2022-10-06', 1, '2022-10-07', '2022-10-06'),
(14, 'PJ0014', 'AG002', 'BK008', 'Dipinjam', '2024-02-03', 2, '2024-02-05', '0'),
(15, 'PJ0015', 'AG002', 'BK008', 'Dipinjam', '2024-06-03', 2, '2024-06-05', '0'),
(16, 'PJ0016', 'AG002', 'BK008', 'Dipinjam', '2024-06-26', 7, '2024-07-03', '0'),
(17, 'PJ0017', 'AG002', 'BK008', 'Dipinjam', '2024-07-07', 5, '2024-07-12', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rak`
--

DROP TABLE IF EXISTS `tbl_rak`;
CREATE TABLE IF NOT EXISTS `tbl_rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rak`
--

INSERT INTO `tbl_rak` (`id_rak`, `nama_rak`) VALUES
(1, 'Rak Buku 1'),
(2, 'Rak Buku 2'),
(3, 'Rak Buku 3'),
(4, 'Rak Buku 4'),
(5, 'Rak Buku 5'),
(6, 'Rak Buku 6'),
(7, 'Rak Buku 7'),
(8, 'Rak Buku 8'),
(9, 'Rak Buku 9'),
(10, 'Rak Buku 10'),
(11, 'Rak Buku 11'),
(12, 'Rak Buku 12'),
(13, 'Rak Buku 13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservasi`
--

DROP TABLE IF EXISTS `tbl_reservasi`;
CREATE TABLE IF NOT EXISTS `tbl_reservasi` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `tgl_pengajuan` date NOT NULL,
  `anggota_id` varchar(255) NOT NULL,
  `buku_id` int(15) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan_anggota` text NOT NULL,
  `keterangan_petugas` text NOT NULL,
  `id_respon` varchar(255) NOT NULL,
  `respon_date` date NOT NULL,
  `durasi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reservasi`
--

INSERT INTO `tbl_reservasi` (`id`, `tgl_pengajuan`, `anggota_id`, `buku_id`, `tgl_pinjam`, `tgl_kembali`, `status`, `keterangan_anggota`, `keterangan_petugas`, `id_respon`, `respon_date`, `durasi`) VALUES
(1, '2024-07-07', 'AG002', 8, '2024-07-07', '2024-07-12', 'Ditolak', 'untuk uas', 'uasnya sudah lewat', 'AG001', '2024-07-07', '5'),
(2, '2024-07-07', 'AG002', 8, '2024-07-07', '2024-07-12', 'Diterima', 'buat penelitian', 'oh mahasiswa', 'AG001', '2024-07-07', '5'),
(3, '2024-07-30', 'AG003', 8, '2024-07-30', '2025-07-30', 'Ditolak', 'untuk pembelajaran', 'masa peminjaman sudah lewat', 'AG004', '2024-07-30', '365'),
(4, '2024-07-30', 'AG003', 8, '2024-07-30', '2024-08-29', 'Sedang Diperiksa', 'untuk praktek', '', '', '0000-00-00', '30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruang_literasi`
--

DROP TABLE IF EXISTS `tbl_ruang_literasi`;
CREATE TABLE IF NOT EXISTS `tbl_ruang_literasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` text NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ruang_literasi`
--

INSERT INTO `tbl_ruang_literasi` (`id`, `kelas`, `tanggal`, `jam_mulai`, `jam_akhir`, `created_at`, `updated_at`) VALUES
(1, 'Tata Boga', '2022-11-29', '15:33:29', '04:35:00', '2022-11-29', NULL),
(3, 'Elektro', '2022-11-27', '17:17:44', '22:00:00', '2022-11-27', '2022-11-27'),
(4, 'Kelas FMIPA', '2022-11-28', '15:30:11', '18:40:00', '2022-11-27', '2022-11-29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
