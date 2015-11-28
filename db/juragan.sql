-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Nov 2015 pada 08.20
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `juragan_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_answer`
--

CREATE TABLE IF NOT EXISTS `emp_answer` (
  `id` int(11) NOT NULL DEFAULT '0',
  `id_soal` int(11) NOT NULL,
  `jawaban` varchar(500) NOT NULL,
  `skor` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emp_answer`
--

INSERT INTO `emp_answer` (`id`, `id_soal`, `jawaban`, `skor`, `status`) VALUES
(19, 1, '<p>dsds</p>\r\n', 12, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_question`
--

CREATE TABLE IF NOT EXISTS `emp_question` (
  `id` int(11) NOT NULL DEFAULT '0',
  `soal` varchar(500) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `tipe` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emp_question`
--

INSERT INTO `emp_question` (`id`, `soal`, `id_posisi`, `tipe`, `status`) VALUES
(18, '<p>Kesesuaian Laporan Pembukuan Biaya Dan Pendapatan</p>\r\n', 1, 1, 1),
(19, '<p>Menjamin Berjalannya Dengan Baik Kinerja Karyawan Lain</p>\r\n', 1, 1, 1),
(20, '<p>Update Informasi Sosial Media Setiap Hari</p>\r\n', 1, 1, 1),
(21, '<p>Menjamin Order Yang Masuk Ditangani Tanpa Kesalahan</p>\r\n', 1, 1, 1),
(23, '<p>Produksi Perusahaan Dengan Target 50 Kaos Per Hari</p>\r\n', 2, 1, 1),
(24, '<p>Merawat Mesin Min. 6 Bulan Tanpa Kerusakan</p>\r\n', 2, 1, 1),
(25, '<p>Membuat Laporan Harian</p>\r\n', 2, 1, 1),
(26, '<p>Presensi</p>\r\n', 1, 2, 1),
(27, '<p>Tidak Ada Penolakan Perintah Atasan</p>\r\n', 1, 2, 1),
(28, '<p>Minimalisasi Error (Reject Kaos)</p>\r\n', 1, 2, 1),
(29, '<p>Menjaga Kerapihan Tempat Kerja</p>\r\n', 1, 2, 1),
(30, '<p>Membantu Kinerja Karyawan Lain</p>\r\n', 1, 2, 1),
(31, '<p>Mampu Mengajak / Menggerakan Karyawan Lain Untuk Proaktif</p>\r\n', 1, 2, 1),
(32, '<p>Presensi</p>\r\n', 2, 2, 1),
(33, '<p>Tidak Ada Penolakan Perintah Atasan</p>\r\n', 2, 2, 1),
(34, '<p>Minimalisasi Error (reject Kaos)</p>\r\n', 2, 2, 1),
(35, '<p>Menjaga Kerapihan Tempat Kerja</p>\r\n', 2, 2, 1),
(36, '<p>Efektifitas &amp; Efisiensi Bahan Baku</p>\r\n', 2, 2, 1),
(37, '<p>Membantu Kinerja Karyawan Lain</p>\r\n', 2, 2, 1),
(38, '<p>Mampu Mengajak / Meggerakan Karyawan Lain Untuk Proaktif</p>\r\n', 2, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inv_barang`
--

CREATE TABLE IF NOT EXISTS `inv_barang` (
`id` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `id_jenis_barang` int(11) NOT NULL,
  `id_warna` int(11) NOT NULL,
  `id_ukuran` int(11) NOT NULL,
  `min_stok` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

--
-- Dumping data untuk tabel `inv_barang`
--

INSERT INTO `inv_barang` (`id`, `kode`, `id_jenis_barang`, `id_warna`, `id_ukuran`, `min_stok`) VALUES
(1, 'CRW0101', 1, 4, 37, 25),
(2, 'CRW0102', 1, 5, 37, 25),
(3, 'CRW0103', 1, 6, 37, 25),
(4, 'CRW0104', 1, 7, 37, 25),
(5, 'CRW0105', 1, 8, 37, 25),
(6, 'CRW0106', 1, 9, 37, 25),
(7, 'CRW0107', 1, 10, 37, 25),
(8, 'CRW0108', 1, 11, 37, 25),
(9, 'CRW0109', 1, 12, 37, 25),
(10, 'CRW0110', 1, 13, 37, 25),
(11, 'CRW0111', 1, 14, 37, 25),
(12, 'CRW0112', 1, 15, 37, 25),
(13, 'CRW0113', 1, 16, 37, 25),
(14, 'CRW0114', 1, 17, 37, 25),
(15, 'CRW0115', 1, 18, 37, 25),
(16, 'CRW0116', 1, 19, 37, 25),
(17, 'CRW0117', 1, 20, 37, 25),
(18, 'CRW0118', 1, 21, 37, 25),
(19, 'CRW0119', 1, 22, 37, 25),
(20, 'CRW0120', 1, 23, 37, 25),
(21, 'CRW0121', 1, 24, 37, 25),
(22, 'CRW0122', 1, 25, 37, 25),
(23, 'CRW0123', 1, 26, 37, 25),
(24, 'CRW0124', 1, 27, 37, 25),
(25, 'CRW0125', 1, 28, 37, 25),
(26, 'CRW0201', 1, 4, 38, 25),
(27, 'CRW0202', 1, 5, 38, 25),
(28, 'CRW0203', 1, 6, 38, 25),
(29, 'CRW0204', 1, 7, 38, 25),
(30, 'CRW0205', 1, 8, 38, 25),
(31, 'CRW0206', 1, 9, 38, 25),
(32, 'CRW0207', 1, 10, 38, 25),
(33, 'CRW0208', 1, 11, 38, 25),
(34, 'CRW0209', 1, 12, 38, 25),
(35, 'CRW0210', 1, 13, 38, 25),
(36, 'CRW0211', 1, 14, 38, 25),
(37, 'CRW0212', 1, 15, 38, 25),
(38, 'CRW0213', 1, 16, 38, 25),
(39, 'CRW0214', 1, 17, 38, 25),
(40, 'CRW0215', 1, 18, 38, 25),
(41, 'CRW0216', 1, 19, 38, 25),
(42, 'CRW0217', 1, 20, 38, 25),
(43, 'CRW0218', 1, 21, 38, 25),
(44, 'CRW0219', 1, 22, 38, 25),
(45, 'CRW0220', 1, 23, 38, 25),
(46, 'CRW0221', 1, 24, 38, 25),
(47, 'CRW0222', 1, 25, 38, 25),
(48, 'CRW0223', 1, 26, 38, 25),
(49, 'CRW0224', 1, 27, 38, 25),
(50, 'CRW0225', 1, 28, 38, 25),
(51, 'CRW0301', 1, 4, 39, 25),
(52, 'CRW0302', 1, 5, 39, 25),
(53, 'CRW0303', 1, 6, 39, 25),
(54, 'CRW0304', 1, 7, 39, 25),
(55, 'CRW0305', 1, 8, 39, 25),
(56, 'CRW0306', 1, 9, 39, 25),
(57, 'CRW0307', 1, 10, 39, 25),
(58, 'CRW0308', 1, 11, 39, 25),
(59, 'CRW0309', 1, 12, 39, 25),
(60, 'CRW0310', 1, 13, 39, 25),
(61, 'CRW0311', 1, 14, 39, 25),
(62, 'CRW0312', 1, 15, 39, 25),
(63, 'CRW0313', 1, 16, 39, 25),
(64, 'CRW0314', 1, 17, 39, 25),
(65, 'CRW0315', 1, 18, 39, 25),
(66, 'CRW0316', 1, 19, 39, 25),
(67, 'CRW0317', 1, 20, 39, 25),
(68, 'CRW0318', 1, 21, 39, 25),
(69, 'CRW0319', 1, 22, 39, 25),
(70, 'CRW0320', 1, 23, 39, 25),
(71, 'CRW0321', 1, 24, 39, 25),
(72, 'CRW0322', 1, 25, 39, 25),
(73, 'CRW0323', 1, 26, 39, 25),
(74, 'CRW0324', 1, 27, 39, 25),
(75, 'CRW0325', 1, 28, 39, 25),
(76, 'CRW0401', 1, 4, 40, 25),
(77, 'CRW0402', 1, 5, 40, 25),
(78, 'CRW0403', 1, 6, 40, 25),
(79, 'CRW0404', 1, 7, 40, 25),
(80, 'CRW0405', 1, 8, 40, 25),
(81, 'CRW0406', 1, 9, 40, 25),
(82, 'CRW0407', 1, 10, 40, 25),
(83, 'CRW0408', 1, 11, 40, 25),
(84, 'CRW0409', 1, 12, 40, 25),
(85, 'CRW0410', 1, 13, 40, 25),
(86, 'CRW0411', 1, 14, 40, 25),
(87, 'CRW0412', 1, 15, 40, 25),
(88, 'CRW0413', 1, 16, 40, 25),
(89, 'CRW0414', 1, 17, 40, 25),
(90, 'CRW0415', 1, 18, 40, 25),
(91, 'CRW0416', 1, 19, 40, 25),
(92, 'CRW0417', 1, 20, 40, 25),
(93, 'CRW0418', 1, 21, 40, 25),
(94, 'CRW0419', 1, 22, 40, 25),
(95, 'CRW0420', 1, 23, 40, 25),
(96, 'CRW0421', 1, 24, 40, 25),
(97, 'CRW0422', 1, 25, 40, 25),
(98, 'CRW0423', 1, 26, 40, 25),
(99, 'CRW0424', 1, 27, 40, 25),
(100, 'CRW0425', 1, 28, 40, 25),
(101, 'CRW0501', 1, 4, 41, 25),
(102, 'CRW0502', 1, 5, 41, 25),
(103, 'CRW0503', 1, 6, 41, 25),
(104, 'CRW0504', 1, 7, 41, 25),
(105, 'CRW0505', 1, 8, 41, 25),
(106, 'CRW0506', 1, 9, 41, 25),
(107, 'CRW0507', 1, 10, 41, 25),
(108, 'CRW0508', 1, 11, 41, 25),
(109, 'CRW0509', 1, 12, 41, 25),
(110, 'CRW0510', 1, 13, 41, 25),
(111, 'CRW0511', 1, 14, 41, 25),
(112, 'CRW0512', 1, 15, 41, 25),
(113, 'CRW0513', 1, 16, 41, 25),
(114, 'CRW0514', 1, 17, 41, 25),
(115, 'CRW0515', 1, 18, 41, 25),
(116, 'CRW0516', 1, 19, 41, 25),
(117, 'CRW0517', 1, 20, 41, 25),
(118, 'CRW0518', 1, 21, 41, 25),
(119, 'CRW0519', 1, 22, 41, 25),
(120, 'CRW0520', 1, 23, 41, 25),
(121, 'CRW0521', 1, 24, 41, 25),
(122, 'CRW0522', 1, 25, 41, 25),
(123, 'CRW0523', 1, 26, 41, 25),
(124, 'CRW0524', 1, 27, 41, 25),
(125, 'CRW0525', 1, 28, 41, 25),
(126, 'CRW0601', 1, 4, 42, 25),
(127, 'CRW0602', 1, 5, 42, 25),
(128, 'CRW0603', 1, 6, 42, 25),
(129, 'CRW0604', 1, 7, 42, 25),
(130, 'CRW0605', 1, 8, 42, 25),
(131, 'CRW0606', 1, 9, 42, 25),
(132, 'CRW0607', 1, 10, 42, 25),
(133, 'CRW0608', 1, 11, 42, 25),
(134, 'CRW0609', 1, 12, 42, 25),
(135, 'CRW0610', 1, 13, 42, 25),
(136, 'CRW0611', 1, 14, 42, 25),
(137, 'CRW0612', 1, 15, 42, 25),
(138, 'CRW0613', 1, 16, 42, 25),
(139, 'CRW0614', 1, 17, 42, 25),
(140, 'CRW0615', 1, 18, 42, 25),
(141, 'CRW0616', 1, 19, 42, 25),
(142, 'CRW0617', 1, 20, 42, 25),
(143, 'CRW0618', 1, 21, 42, 25),
(144, 'CRW0619', 1, 22, 42, 25),
(145, 'CRW0620', 1, 23, 42, 25),
(146, 'CRW0621', 1, 24, 42, 25),
(147, 'CRW0622', 1, 25, 42, 25),
(148, 'CRW0623', 1, 26, 42, 25),
(149, 'CRW0624', 1, 27, 42, 25),
(150, 'CRW0625', 1, 28, 42, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inv_jenis_barang`
--

CREATE TABLE IF NOT EXISTS `inv_jenis_barang` (
`id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `min_stok` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `inv_jenis_barang`
--

INSERT INTO `inv_jenis_barang` (`id`, `kode`, `jenis_barang`, `warna`, `ukuran`, `min_stok`) VALUES
(1, 'CRW', 'Gildan Crewneck', '4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', '37,38,39,40,41,42', 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inv_kode_default`
--

CREATE TABLE IF NOT EXISTS `inv_kode_default` (
`id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kode_prefix` varchar(10) NOT NULL,
  `jumlah_digit` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` date NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `inv_kode_default`
--

INSERT INTO `inv_kode_default` (`id`, `keterangan`, `kode_prefix`, `jumlah_digit`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Kode Untuk Master', 'M', 5, 1, '0000-00-00', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inv_master`
--

CREATE TABLE IF NOT EXISTS `inv_master` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `kategori` varchar(65) NOT NULL,
  `keterangan` text NOT NULL,
  `icon` varchar(100) NOT NULL,
  `urutan` int(11) NOT NULL,
  `kode_prefix` varchar(20) NOT NULL,
  `jumlah_digit` int(11) NOT NULL,
  `kode` varchar(25) NOT NULL,
  `spesifik` tinyint(1) NOT NULL,
  `target` varchar(65) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_by` varchar(150) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` varchar(150) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data untuk tabel `inv_master`
--

INSERT INTO `inv_master` (`id`, `parent_id`, `kategori`, `keterangan`, `icon`, `urutan`, `kode_prefix`, `jumlah_digit`, `kode`, `spesifik`, `target`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 0, 'Color', '', '56528340da14cfdc9524b1fc7301e40ac53bc7b0eebd6.png', 1, '', 2, 'M00001', 0, '', 1, '1', '2015-11-23 10:08:53', '', '0000-00-00 00:00:00'),
(2, 0, 'Size', '', '5652af8ae9febd9458fd8e515ecb57f726b31f1c279b9.png', 3, '', 2, 'M00002', 0, '', 1, '1', '2015-11-23 13:17:54', '1', '2015-11-27 08:03:44'),
(3, 0, 'Product', '', '5657ac4eabdd44030a5e7b5c5b2706a82cdb702384264.png', 1, '', 0, 'M00003', 1, 'product', 1, '1', '2015-11-27 08:05:47', '', '0000-00-00 00:00:00'),
(4, 1, 'White', '', '', 1, '', 0, '01', 0, '', 1, '1', '2015-11-27 08:17:00', '', '0000-00-00 00:00:00'),
(5, 1, 'Black', '', '', 2, '', 0, '02', 0, '', 1, '1', '2015-11-27 08:17:08', '', '0000-00-00 00:00:00'),
(6, 1, 'Navy', '', '', 3, '', 0, '03', 0, '', 1, '1', '2015-11-27 08:17:31', '', '0000-00-00 00:00:00'),
(7, 1, 'Royal', '', '', 4, '', 0, '04', 0, '', 1, '1', '2015-11-27 08:17:39', '', '0000-00-00 00:00:00'),
(8, 1, 'Carolina', '', '', 5, '', 0, '05', 0, '', 1, '1', '2015-11-27 08:18:23', '', '0000-00-00 00:00:00'),
(9, 1, 'Charcoal', '', '', 6, '', 0, '06', 0, '', 1, '1', '2015-11-27 08:18:38', '', '0000-00-00 00:00:00'),
(10, 1, 'Sport', '', '', 7, '', 0, '07', 0, '', 1, '1', '2015-11-27 08:18:53', '', '0000-00-00 00:00:00'),
(11, 1, 'Pink', '', '', 8, '', 0, '08', 0, '', 1, '1', '2015-11-27 08:19:00', '', '0000-00-00 00:00:00'),
(12, 1, 'Maroon', '', '', 9, '', 0, '09', 0, '', 1, '1', '2015-11-27 08:19:24', '', '0000-00-00 00:00:00'),
(13, 1, 'Red', '', '', 10, '', 0, '10', 0, '', 1, '1', '2015-11-27 08:19:38', '', '0000-00-00 00:00:00'),
(14, 1, 'Daisy', '', '', 11, '', 0, '11', 0, '', 1, '1', '2015-11-27 08:19:51', '', '0000-00-00 00:00:00'),
(15, 1, 'Orange', '', '', 12, '', 0, '12', 0, '', 1, '1', '2015-11-27 08:20:01', '', '0000-00-00 00:00:00'),
(16, 1, 'Forest', '', '', 13, '', 0, '13', 0, '', 1, '1', '2015-11-27 08:20:17', '', '0000-00-00 00:00:00'),
(17, 1, 'Irish', '', '', 14, '', 0, '14', 0, '', 1, '1', '2015-11-27 08:20:44', '', '0000-00-00 00:00:00'),
(18, 1, 'Dark Choc', '', '', 15, '', 0, '15', 0, '', 1, '1', '2015-11-27 08:20:58', '', '0000-00-00 00:00:00'),
(19, 1, 'Gold', '', '', 16, '', 0, '16', 0, '', 1, '1', '2015-11-27 08:21:06', '', '0000-00-00 00:00:00'),
(20, 1, 'Satyr Orange', '', '', 17, '', 0, '17', 0, '', 1, '1', '2015-11-27 08:21:25', '', '0000-00-00 00:00:00'),
(21, 1, 'Lime', '', '', 18, '', 0, '18', 0, '', 1, '1', '2015-11-27 08:21:36', '', '0000-00-00 00:00:00'),
(22, 1, 'Purple', '', '', 19, '', 0, '19', 0, '', 1, '1', '2015-11-27 08:21:44', '', '0000-00-00 00:00:00'),
(23, 1, 'Saphire', '', '', 20, '', 0, '20', 0, '', 1, '1', '2015-11-27 08:21:59', '', '0000-00-00 00:00:00'),
(24, 1, 'Millitary', '', '', 21, '', 0, '21', 0, '', 1, '1', '2015-11-27 08:22:17', '', '0000-00-00 00:00:00'),
(25, 1, 'Cardinal', '', '', 22, '', 0, '22', 0, '', 1, '1', '2015-11-27 08:22:46', '', '0000-00-00 00:00:00'),
(26, 1, 'Light Blue', '', '', 23, '', 0, '23', 0, '', 1, '1', '2015-11-27 08:23:02', '', '0000-00-00 00:00:00'),
(27, 1, 'Sky Blue', '', '', 24, '', 0, '24', 0, '', 1, '1', '2015-11-27 08:23:15', '', '0000-00-00 00:00:00'),
(28, 1, 'Chestnut', '', '', 25, '', 0, '25', 0, '', 1, '1', '2015-11-27 08:23:39', '', '0000-00-00 00:00:00'),
(29, 1, 'Cream', '', '', 26, '', 0, '26', 0, '', 1, '1', '2015-11-27 08:27:43', '', '0000-00-00 00:00:00'),
(30, 1, 'Biru', '', '', 27, '', 0, '27', 0, '', 1, '1', '2015-11-27 08:27:55', '', '0000-00-00 00:00:00'),
(31, 1, 'Biru Muda', '', '', 28, '', 0, '28', 0, '', 1, '1', '2015-11-27 08:28:05', '', '0000-00-00 00:00:00'),
(32, 1, 'Kuning', '', '', 29, '', 0, '29', 0, '', 1, '1', '2015-11-27 08:28:17', '', '0000-00-00 00:00:00'),
(33, 1, 'Abu Muda', '', '', 30, '', 0, '30', 0, '', 1, '1', '2015-11-27 08:28:25', '', '0000-00-00 00:00:00'),
(34, 1, 'Abu Misty', '', '', 31, '', 0, '31', 0, '', 1, '1', '2015-11-27 08:28:52', '', '0000-00-00 00:00:00'),
(35, 1, 'Putih-Merah', '', '', 32, '', 0, '32', 0, '', 1, '1', '2015-11-27 08:30:35', '1', '2015-11-27 08:31:01'),
(36, 1, 'Hitam-Sport', '', '', 33, '', 0, '33', 0, '', 1, '1', '2015-11-27 08:30:52', '', '0000-00-00 00:00:00'),
(37, 2, 'XS', '', '', 1, '', 0, '01', 0, '', 1, '1', '2015-11-27 08:31:41', '1', '2015-11-27 08:32:34'),
(38, 2, 'S', '', '', 2, '', 0, '02', 0, '', 1, '1', '2015-11-27 08:31:46', '1', '2015-11-27 08:32:39'),
(39, 2, 'M', '', '', 3, '', 0, '03', 0, '', 1, '1', '2015-11-27 08:31:53', '1', '2015-11-27 08:32:45'),
(40, 2, 'L', '', '', 4, '', 0, '04', 0, '', 1, '1', '2015-11-27 08:31:58', '1', '2015-11-27 08:32:51'),
(41, 2, 'XL', '', '', 5, '', 0, '05', 0, '', 1, '1', '2015-11-27 08:32:05', '1', '2015-11-27 08:33:05'),
(42, 2, 'XXL', '', '', 6, '', 0, '06', 0, '', 1, '1', '2015-11-27 08:32:13', '1', '2015-11-27 08:33:13'),
(43, 2, 'XXXL', '', '', 7, '', 0, '07', 0, '', 1, '1', '2015-11-27 08:32:23', '1', '2015-11-27 08:33:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inv_setting_master`
--

CREATE TABLE IF NOT EXISTS `inv_setting_master` (
`id` int(11) NOT NULL,
  `attr` varchar(255) NOT NULL,
  `content` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `inv_setting_master`
--

INSERT INTO `inv_setting_master` (`id`, `attr`, `content`) VALUES
(1, 'Color', 1),
(2, 'Size', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
`id` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `target` varchar(150) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `akses_view` tinyint(1) NOT NULL,
  `akses_input` tinyint(1) NOT NULL,
  `akses_edit` tinyint(1) NOT NULL,
  `akses_delete` tinyint(1) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `urutan` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `id_modul`, `parent_id`, `nama`, `target`, `keterangan`, `akses_view`, `akses_input`, `akses_edit`, `akses_delete`, `icon`, `urutan`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 1, 0, 'User Management', 'user', '', 1, 0, 0, 0, 'user_management.png', 1, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 1, 1, 'User List', 'user_list', '', 1, 1, 1, 1, 'user_list.png', 1, 1, 0, '0000-00-00 00:00:00', 1, '2015-11-20 14:57:29'),
(3, 1, 1, 'User Groups', 'user_groups', '', 1, 1, 1, 1, 'user_groups.png', 2, 1, 0, '0000-00-00 00:00:00', 1, '2015-11-20 14:57:38'),
(4, 1, 0, 'Site', 'site', '', 1, 0, 0, 0, 'site.png', 2, 1, 0, '0000-00-00 00:00:00', 1, '2015-05-09 12:34:14'),
(5, 1, 4, 'Module', 'modul', '', 1, 1, 1, 1, 'module.png', 1, 1, 0, '0000-00-00 00:00:00', 1, '2015-11-21 11:39:38'),
(6, 1, 4, 'Menu', 'menu', '', 1, 1, 1, 1, 'menu.png', 2, 1, 0, '0000-00-00 00:00:00', 1, '2015-11-20 14:57:54'),
(7, 1, 4, 'Site Info', 'info', '', 1, 0, 1, 0, 'site_info.png', 3, 1, 0, '0000-00-00 00:00:00', 1, '2015-11-20 14:58:02'),
(8, 1, 4, 'Language', 'language', '', 1, 1, 1, 1, 'bahasa.png', 4, 1, 0, '0000-00-00 00:00:00', 1, '2015-11-21 11:43:44'),
(9, 2, 0, 'Dashboard', 'dashboard', '', 1, 0, 0, 0, '565277349faa6e2d0a3eb8ec49fe8bde534226409274e.png', 1, 1, 1, '2015-11-23 09:17:28', 0, '0000-00-00 00:00:00'),
(10, 2, 0, 'Master', 'master', '', 1, 1, 1, 1, '5652776922e90be40d18702bfd7b25740991faedb2162.png', 2, 1, 1, '2015-11-23 09:18:23', 0, '0000-00-00 00:00:00'),
(11, 2, 0, 'Stock', 'stock', '', 1, 0, 0, 0, '565277e4b5e663698b8568dbb174668f98fafe9db0488.png', 3, 1, 1, '2015-11-23 09:20:25', 0, '0000-00-00 00:00:00'),
(12, 2, 11, 'Stock In', 'stock_in', '', 1, 0, 0, 0, '5652785fb3f49d8593c4566c7b5beee8889bb88da5c43.png', 1, 1, 1, '2015-11-23 09:22:40', 0, '0000-00-00 00:00:00'),
(13, 2, 11, 'Stock Out', 'stock_out', '', 1, 0, 0, 0, '5652788bc3b517d02421655fe97432ff1cbf142157e4c.png', 2, 1, 1, '2015-11-23 09:23:11', 1, '2015-11-23 09:24:10'),
(14, 2, 0, 'Report', 'report', '', 1, 0, 0, 0, 'default.png', 4, 1, 1, '2015-11-23 09:24:03', 0, '0000-00-00 00:00:00'),
(15, 2, 14, 'Stock', 'stock', '', 1, 0, 0, 0, '565278dc7e85adf07e5fa64375c09f1e9e71f6566523d.png', 1, 1, 1, '2015-11-23 09:24:31', 0, '0000-00-00 00:00:00'),
(16, 2, 14, 'Stock In', 'stock_in', '', 1, 0, 0, 0, '565278f41755e8a5792ebd12bce42c5d40b0c6de6f3f0.png', 2, 1, 1, '2015-11-23 09:24:54', 0, '0000-00-00 00:00:00'),
(17, 2, 14, 'Stock Out', 'stock_out', '', 1, 0, 0, 0, '5652790a80a1121aa9e7f00572d697555425fd157073e.png', 3, 1, 1, '2015-11-23 09:25:23', 0, '0000-00-00 00:00:00'),
(18, 3, 0, 'Dashboard', 'dashboard', '', 1, 0, 0, 0, '56527a150083b909f28e27dfd35651e4d45964bca0bb6.png', 1, 1, 1, '2015-11-23 09:29:44', 0, '0000-00-00 00:00:00'),
(19, 3, 0, 'Transaction', 'transaction', '', 1, 0, 0, 0, '56527a464f15842f4da09aff02a81c03386ba509c9a3e.png', 2, 1, 1, '2015-11-23 09:30:34', 0, '0000-00-00 00:00:00'),
(20, 3, 0, 'Report', 'report', '', 1, 0, 0, 0, '56527a8fa83e47a2399eebdd86d2846ba4e66c0f4ed07.png', 3, 1, 1, '2015-11-23 09:31:47', 0, '0000-00-00 00:00:00'),
(21, 4, 0, 'Master', 'master', '', 1, 0, 0, 0, '56558f16a464e9c39024a3b870a0e37c56523e6164848.png', 1, 1, 1, '2015-11-25 17:36:14', 0, '0000-00-00 00:00:00'),
(22, 4, 21, 'Penilaian Khusus', 'standard_question/1', '', 1, 1, 1, 1, '56558f4daaa9b45d7526412b58025baf92055f904fc12.png', 1, 1, 1, '2015-11-25 17:37:07', 1, '2015-11-25 19:24:33'),
(23, 4, 21, 'Penilaian Umum', 'standard_question/2', '', 1, 1, 1, 1, '56558f702ceb08363201c5d86a770a73c03c0c1f23dab.png', 2, 1, 1, '2015-11-25 17:37:41', 0, '0000-00-00 00:00:00'),
(24, 4, 0, 'Questionnare', 'test', '', 1, 1, 1, 1, '56558f928448060e48cdfa06a0d95715f659227fb1872.png', 2, 1, 1, '2015-11-25 17:38:23', 0, '0000-00-00 00:00:00'),
(25, 4, 0, 'Monitoring', 'monitoring', '', 1, 1, 1, 1, '56558fbecc33c9aee1948aff55ed1561fa74ba18840fb.png', 3, 1, 1, '2015-11-25 17:39:16', 0, '0000-00-00 00:00:00'),
(26, 4, 0, 'Daily Report', 'report', '', 1, 0, 0, 0, '56558ff20b87a1ddfc95d2a0512f3664890c965df977e.jpg', 4, 1, 1, '2015-11-25 17:39:51', 1, '2015-11-25 18:41:57'),
(27, 4, 26, 'Khusus', 'khusus', '', 1, 1, 1, 1, '5655901ba46a634b5edac63add0c43915ad11d34425e2.jpg', 1, 1, 1, '2015-11-25 17:40:33', 0, '0000-00-00 00:00:00'),
(28, 4, 26, 'Umum', 'umum', '', 1, 1, 1, 1, 'default.png', 2, 1, 1, '2015-11-25 17:40:58', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_modul`
--

CREATE TABLE IF NOT EXISTS `tbl_modul` (
`id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `target` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `urutan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tbl_modul`
--

INSERT INTO `tbl_modul` (`id`, `nama`, `target`, `icon`, `urutan`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Setting', 'setting', 'setting.png', 3, 1, 0, '0000-00-00 00:00:00', 1, '2015-11-23 09:00:08'),
(2, 'Inventory', 'inventory', '565272626aff82dab7fc5b78a00639d7523c0c2bb75b9.png', 1, 1, 1, '2015-11-23 08:56:54', 0, '0000-00-00 00:00:00'),
(3, 'POS', 'pos', '5652731651ec25866a0d934c61986e353bf541e718fca.png', 2, 1, 1, '2015-11-23 08:59:57', 0, '0000-00-00 00:00:00'),
(4, 'Employee', 'employee', '56558e7da5cdd2937c372cedaa654b0b7f51f230a0979.png', 3, 1, 1, '2015-11-25 17:33:43', 1, '2015-11-25 18:26:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_notifikasi`
--

CREATE TABLE IF NOT EXISTS `tbl_notifikasi` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tanggal` datetime NOT NULL,
  `target` varchar(100) NOT NULL,
  `aksi` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_profile_site`
--

CREATE TABLE IF NOT EXISTS `tbl_profile_site` (
`id` int(11) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `inisial_perusahaan` varchar(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `logo_depan` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL,
  `session_expiration` int(11) NOT NULL DEFAULT '1000'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbl_profile_site`
--

INSERT INTO `tbl_profile_site` (`id`, `perusahaan`, `alamat`, `inisial_perusahaan`, `judul`, `logo`, `logo_depan`, `color`, `session_expiration`) VALUES
(1, 'PT. Rama Indonesia', '.', 'Juragandropship', 'Portal System', '5653fbf93415ebb7d9642522260a262805e5b5d9be7db.png', '0', '#342394', 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_zona` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `language` varchar(50) NOT NULL DEFAULT 'english',
  `pertanyaan` text NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `create_by` varchar(150) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` varchar(150) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `id_group`, `id_zona`, `id_area`, `nama`, `foto`, `thumb`, `username`, `password`, `status`, `last_login`, `language`, `pertanyaan`, `jawaban`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 1, 0, 0, 'Administrator', '55b71449371fb5a3d36caf44c9f20bd62066de3459a4b.jpg', '55b714627fbe2-thumb.jpg', '12345', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2015-11-27 08:02:10', 'english', '', '12345', '', '0000-00-00 00:00:00', '1', '2015-07-29 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_akses`
--

CREATE TABLE IF NOT EXISTS `tbl_user_akses` (
`id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `act_view` int(1) NOT NULL,
  `act_input` int(1) NOT NULL,
  `act_edit` int(1) NOT NULL,
  `act_delete` int(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data untuk tabel `tbl_user_akses`
--

INSERT INTO `tbl_user_akses` (`id`, `id_level`, `id_menu`, `act_view`, `act_input`, `act_edit`, `act_delete`) VALUES
(1, 1, 1, 1, 0, 0, 0),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 1, 0, 0, 0),
(5, 1, 5, 1, 1, 1, 1),
(6, 1, 6, 1, 1, 1, 1),
(7, 1, 7, 1, 0, 1, 0),
(8, 1, 8, 1, 1, 1, 1),
(9, 1, 9, 1, 0, 0, 0),
(10, 1, 10, 1, 1, 1, 1),
(11, 1, 11, 1, 0, 0, 0),
(12, 1, 12, 1, 0, 0, 0),
(13, 1, 13, 1, 0, 0, 0),
(14, 1, 14, 1, 0, 0, 0),
(15, 1, 15, 1, 0, 0, 0),
(16, 1, 16, 1, 0, 0, 0),
(17, 1, 17, 1, 0, 0, 0),
(18, 1, 18, 1, 0, 0, 0),
(19, 1, 19, 1, 0, 0, 0),
(20, 1, 20, 1, 0, 0, 0),
(21, 1, 21, 1, 0, 0, 0),
(22, 1, 22, 1, 1, 1, 1),
(23, 1, 23, 1, 1, 1, 1),
(24, 1, 24, 1, 1, 1, 1),
(25, 1, 25, 1, 1, 1, 1),
(26, 1, 26, 1, 0, 0, 0),
(27, 1, 27, 1, 1, 1, 1),
(28, 1, 28, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_group`
--

CREATE TABLE IF NOT EXISTS `tbl_user_group` (
`id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `create_by` varchar(150) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` varchar(150) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbl_user_group`
--

INSERT INTO `tbl_user_group` (`id`, `nama`, `keterangan`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, 'Root', 'Khusus Developer', 1, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inv_barang`
--
ALTER TABLE `inv_barang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_jenis_barang`
--
ALTER TABLE `inv_jenis_barang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_kode_default`
--
ALTER TABLE `inv_kode_default`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_master`
--
ALTER TABLE `inv_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_setting_master`
--
ALTER TABLE `inv_setting_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_modul`
--
ALTER TABLE `tbl_modul`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_profile_site`
--
ALTER TABLE `tbl_profile_site`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_akses`
--
ALTER TABLE `tbl_user_akses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inv_barang`
--
ALTER TABLE `inv_barang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `inv_jenis_barang`
--
ALTER TABLE `inv_jenis_barang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inv_kode_default`
--
ALTER TABLE `inv_kode_default`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inv_master`
--
ALTER TABLE `inv_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `inv_setting_master`
--
ALTER TABLE `inv_setting_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_modul`
--
ALTER TABLE `tbl_modul`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_profile_site`
--
ALTER TABLE `tbl_profile_site`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user_akses`
--
ALTER TABLE `tbl_user_akses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
