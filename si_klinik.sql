-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2018 at 03:16 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(4) NOT NULL,
  `username` varchar(49) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `level` varchar(25) DEFAULT 'N',
  `role_id` int(10) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `level`, `role_id`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'operator', 2, '2017-11-21 14:49:15', NULL, '2017-11-21 14:49:15', NULL),
(2, 'owner', '72122ce96bfec66e2396d2e25225d70a', 'N', 1, '2017-11-21 14:49:15', NULL, '2017-11-21 14:49:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id_bed` int(11) NOT NULL,
  `id_kamar` int(11) DEFAULT NULL,
  `nama_bed` varchar(20) DEFAULT NULL,
  `status_isi` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id_bed`, `id_kamar`, `nama_bed`, `status_isi`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(19, 1, '1', 'Isi', 2, '2017-12-27 06:31:54', NULL, '2017-12-27 06:31:54'),
(16, 11, '2', 'Kosong', 2, '2017-12-27 06:25:40', 2, '2017-12-27 06:29:49'),
(18, 1, '2', 'Isi', 2, '2017-12-27 06:31:36', NULL, '2017-12-27 06:31:36'),
(15, 8, '2', 'ISI', 2, '2017-12-27 06:22:30', 2, '2018-01-04 03:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembiayaan`
--

CREATE TABLE `detail_pembiayaan` (
  `id_pembiayaan` int(11) NOT NULL,
  `id_registrasi` int(11) DEFAULT NULL,
  `no_registrasi` varchar(10) DEFAULT NULL,
  `tgl_registrasi` datetime DEFAULT NULL,
  `nama_item` varchar(100) DEFAULT NULL,
  `jenis_item` enum('Pendaftaran','Layanan','Obat','Lain-Lain','Paket') DEFAULT 'Pendaftaran',
  `item_id` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `qty` decimal(10,2) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `status_bayar` char(1) DEFAULT '0',
  `satuan` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembiayaan`
--

INSERT INTO `detail_pembiayaan` (`id_pembiayaan`, `id_registrasi`, `no_registrasi`, `tgl_registrasi`, `nama_item`, `jenis_item`, `item_id`, `harga`, `qty`, `total_harga`, `status_bayar`, `satuan`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 6, '1712260001', '2017-12-26 00:00:00', 'vaksin', 'Layanan', 15, '200000.00', '1.00', '200000.00', '0', NULL, 2, '2017-12-26 04:10:07', NULL, '2017-12-26 04:10:07'),
(2, 6, '1712260001', '2017-12-26 00:00:00', 'Biaya Pendaftaran Pasien Baru', 'Pendaftaran', 0, '15000.00', '1.00', '15000.00', '0', NULL, 2, '2017-12-26 04:10:07', NULL, '2017-12-26 04:10:07'),
(3, 7, '1712260002', '2017-12-26 00:00:00', NULL, 'Paket', NULL, NULL, '1.00', '0.00', '0', NULL, 2, '2017-12-26 04:10:55', NULL, '2017-12-26 04:10:55'),
(4, 7, '1712260002', '2017-12-26 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 2, '2017-12-26 04:10:55', NULL, '2017-12-26 04:10:55'),
(5, 8, '1712260003', '2017-12-26 00:00:00', 'Biaya Pendaftaran Pasien Baru', 'Pendaftaran', 0, '15000.00', '1.00', '15000.00', '0', NULL, 2, '2017-12-26 04:18:37', NULL, '2017-12-26 04:18:37'),
(6, 9, '1712260004', '2017-12-26 00:00:00', 'Biaya Pendaftaran Pasien Baru', 'Pendaftaran', 0, '15000.00', '1.00', '15000.00', '0', NULL, 2, '2017-12-26 04:21:04', NULL, '2017-12-26 04:21:04'),
(7, 10, '1712280001', '2017-12-28 00:00:00', 'Umum', 'Layanan', 5, '100000.00', '1.00', '100000.00', '0', NULL, 2, '2017-12-28 09:20:54', NULL, '2017-12-28 09:20:54'),
(8, 10, '1712280001', '2017-12-28 00:00:00', 'Operasi Besar', 'Layanan', 11, '100000.00', '1.00', '100000.00', '0', NULL, 2, '2017-12-28 09:20:54', NULL, '2017-12-28 09:20:54'),
(9, 10, '1712280001', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 2, '2017-12-28 09:20:54', NULL, '2017-12-28 09:20:54'),
(10, 11, '1712280002', '2017-12-28 00:00:00', 'Keluarga Berencana', 'Layanan', 14, '20000.00', '1.00', '20000.00', '0', NULL, 2, '2017-12-28 09:22:55', NULL, '2017-12-28 09:22:55'),
(11, 11, '1712280002', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Baru', 'Pendaftaran', 0, '15000.00', '1.00', '15000.00', '0', NULL, 2, '2017-12-28 09:22:55', NULL, '2017-12-28 09:22:55'),
(12, 12, '1712280003', '2017-12-28 00:00:00', NULL, 'Paket', NULL, NULL, '1.00', '0.00', '1', NULL, 2, '2017-12-28 09:23:10', 2, '2017-12-28 09:44:13'),
(13, 12, '1712280003', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '1', NULL, 2, '2017-12-28 09:23:10', 2, '2017-12-28 09:44:13'),
(14, 13, '1712280004', '2017-12-28 00:00:00', 'Spesialis Dalam', 'Layanan', 10, '250000.00', '1.00', '250000.00', '1', NULL, 2, '2017-12-28 09:23:36', 2, '2017-12-28 10:10:19'),
(15, 13, '1712280004', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '1', NULL, 2, '2017-12-28 09:23:36', 2, '2017-12-28 10:10:19'),
(16, 14, '1712280005', '2017-12-28 00:00:00', NULL, 'Paket', NULL, NULL, '1.00', '0.00', '1', NULL, 2, '2017-12-28 09:24:57', 2, '2017-12-28 10:36:18'),
(17, 14, '1712280005', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '1', NULL, 2, '2017-12-28 09:24:57', 2, '2017-12-28 10:36:18'),
(18, 15, '1712280006', '2017-12-28 00:00:00', NULL, 'Paket', NULL, NULL, '1.00', '0.00', '0', NULL, 2, '2017-12-28 09:25:28', NULL, '2017-12-28 09:25:28'),
(19, 15, '1712280006', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 2, '2017-12-28 09:25:28', NULL, '2017-12-28 09:25:28'),
(20, 16, '1712290001', '2017-12-29 00:00:00', 'Operasi Besar', 'Layanan', 11, '100000.00', '1.00', '100000.00', '1', NULL, 86, '2017-12-29 03:26:54', 2, '2017-12-29 03:34:59'),
(21, 16, '1712290001', '2017-12-29 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '1', NULL, 86, '2017-12-29 03:26:54', 2, '2017-12-29 03:34:59'),
(22, 17, '1712290002', '2017-12-29 00:00:00', NULL, 'Paket', NULL, NULL, '1.00', '0.00', '0', NULL, 87, '2017-12-29 03:27:32', NULL, '2017-12-29 03:27:32'),
(23, 17, '1712290002', '2017-12-29 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 87, '2017-12-29 03:27:32', NULL, '2017-12-29 03:27:32'),
(24, 18, '1712290002', '2017-12-29 00:00:00', 'Spesialis Dalam', 'Layanan', 10, '250000.00', '1.00', '250000.00', '1', NULL, 2, '2017-12-29 03:59:00', 2, '2017-12-29 03:59:46'),
(25, 18, '1712290002', '2017-12-29 00:00:00', 'Keluarga Berencana', 'Layanan', 14, '20000.00', '1.00', '20000.00', '1', NULL, 2, '2017-12-29 03:59:00', 2, '2017-12-29 03:59:46'),
(26, 18, '1712290002', '2017-12-29 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '1', NULL, 2, '2017-12-29 03:59:00', 2, '2017-12-29 03:59:46'),
(27, 16, '1712290001', '2017-12-29 00:00:00', 'AMOXICILLIN', 'Obat', 9, '5000.00', '1.00', '5000.00', '1', NULL, NULL, '2017-12-29 04:31:19', 2, '2017-12-29 05:14:29'),
(28, 16, '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', 10, '2000.00', '2.00', '4000.00', '1', NULL, NULL, '2017-12-29 04:31:20', 2, '2017-12-29 05:14:29'),
(29, 16, '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', 10, '2000.00', '3.00', '6000.00', '1', NULL, NULL, '2017-12-29 04:31:20', 2, '2017-12-29 05:14:29'),
(30, 16, '1712290001', '2017-12-29 00:00:00', 'ANTASIDA DOEN', 'Obat', 13, '2000.00', '1.00', '2000.00', '1', NULL, NULL, '2017-12-29 05:11:51', 2, '2017-12-29 05:14:29'),
(31, 16, '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', 10, '2000.00', '2.00', '4000.00', '1', NULL, NULL, '2017-12-29 05:11:51', 2, '2017-12-29 05:14:29'),
(32, 16, '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', 10, '2000.00', '1.00', '2000.00', '1', NULL, NULL, '2017-12-29 05:25:43', 2, '2017-12-29 05:27:52'),
(33, 16, '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', 10, '2000.00', '1.00', '2000.00', '1', NULL, NULL, '2017-12-29 05:25:43', 2, '2017-12-29 05:27:52'),
(34, 19, '1801020001', '2018-01-02 00:00:00', 'Spesialis Dalam', 'Layanan', 10, '250000.00', '1.00', '250000.00', '0', NULL, 2, '2018-01-02 06:15:03', NULL, '2018-01-02 06:15:03'),
(35, 19, '1801020001', '2018-01-02 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 2, '2018-01-02 06:15:03', NULL, '2018-01-02 06:15:03'),
(36, 20, '1801030001', '2018-01-03 00:00:00', 'Operasi Besar', 'Layanan', 11, '100000.00', '1.00', '100000.00', '1', NULL, 2, '2018-01-03 04:48:25', 2, '2018-01-03 04:53:00'),
(37, 20, '1801030001', '2018-01-03 00:00:00', 'Biaya Pendaftaran Pasien Baru', 'Pendaftaran', 0, '15000.00', '1.00', '15000.00', '1', NULL, 2, '2018-01-03 04:48:25', 2, '2018-01-03 04:53:00'),
(38, 21, '1801030002', '2018-01-03 00:00:00', 'Persalinan ', 'Paket', 2, '912.00', '1.00', '912.00', '0', NULL, 2, '2018-01-03 04:48:40', NULL, '2018-01-03 04:48:40'),
(39, 21, '1801030002', '2018-01-03 00:00:00', 'Biaya Pendaftaran Pasien Baru', 'Pendaftaran', 0, '15000.00', '1.00', '15000.00', '0', NULL, 2, '2018-01-03 04:48:40', NULL, '2018-01-03 04:48:40'),
(40, 22, '1801040001', '2018-01-04 00:00:00', 'Umum', 'Layanan', 5, '100000.00', '1.00', '100000.00', '0', NULL, 2, '2018-01-04 03:38:51', NULL, '2018-01-04 03:38:51'),
(41, 22, '1801040001', '2018-01-04 00:00:00', 'Operasi Besar', 'Layanan', 11, '100000.00', '1.00', '100000.00', '0', NULL, 2, '2018-01-04 03:38:51', NULL, '2018-01-04 03:38:51'),
(42, 22, '1801040001', '2018-01-04 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 2, '2018-01-04 03:38:51', NULL, '2018-01-04 03:38:51'),
(43, 23, '1801040002', '2018-01-04 00:00:00', 'Medical Check Up', 'Paket', 1, '1110000.00', '1.00', '1110000.00', '0', NULL, 2, '2018-01-04 03:40:41', NULL, '2018-01-04 03:40:41'),
(44, 23, '1801040002', '2018-01-04 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 2, '2018-01-04 03:40:41', NULL, '2018-01-04 03:40:41'),
(45, 24, '1801040003', '2018-01-04 00:00:00', 'Keluarga Berencana', 'Layanan', 14, '20000.00', '1.00', '20000.00', '0', NULL, 2, '2018-01-04 04:16:35', NULL, '2018-01-04 04:16:35'),
(46, 24, '1801040003', '2018-01-04 00:00:00', 'Biaya Pendaftaran Pasien Baru', 'Pendaftaran', 0, '15000.00', '1.00', '15000.00', '0', NULL, 2, '2018-01-04 04:16:35', NULL, '2018-01-04 04:16:35'),
(47, 25, '1801070001', '2018-01-07 00:00:00', 'Operasi Besar', 'Layanan', 11, '100000.00', '1.00', '100000.00', '0', NULL, 2, '2018-01-07 13:17:44', NULL, '2018-01-07 13:17:44'),
(48, 25, '1801070001', '2018-01-07 00:00:00', 'Keluarga Berencana', 'Layanan', 14, '20000.00', '1.00', '20000.00', '0', NULL, 2, '2018-01-07 13:17:44', NULL, '2018-01-07 13:17:44'),
(49, 25, '1801070001', '2018-01-07 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 2, '2018-01-07 13:17:44', NULL, '2018-01-07 13:17:44'),
(50, 26, '1801080001', '2018-01-08 00:00:00', 'Umum', 'Layanan', 5, '100000.00', '1.00', '100000.00', '0', NULL, 2, '2018-01-08 14:12:53', NULL, '2018-01-08 14:12:53'),
(51, 26, '1801080001', '2018-01-08 00:00:00', 'Operasi Besar', 'Layanan', 11, '100000.00', '1.00', '100000.00', '0', NULL, 2, '2018-01-08 14:12:53', NULL, '2018-01-08 14:12:53'),
(52, 26, '1801080001', '2018-01-08 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '0', NULL, 2, '2018-01-08 14:12:53', NULL, '2018-01-08 14:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `d_jual`
--

CREATE TABLE `d_jual` (
  `idjual` smallint(6) NOT NULL,
  `kodejual` char(15) DEFAULT NULL,
  `kode_barang` char(15) DEFAULT NULL,
  `jmljual` int(11) DEFAULT NULL,
  `hargajual` double DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_hak_akses` int(11) UNSIGNED NOT NULL,
  `hak_akses_role` int(11) DEFAULT NULL,
  `hak_akses_menu` int(11) DEFAULT NULL,
  `hak_akses_create` int(1) DEFAULT NULL,
  `hak_akses_retrive` int(1) DEFAULT NULL,
  `hak_akses_update` int(1) DEFAULT NULL,
  `hak_akses_delete` int(1) DEFAULT NULL,
  `hak_akses_search` int(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `hak_akses_role`, `hak_akses_menu`, `hak_akses_create`, `hak_akses_retrive`, `hak_akses_update`, `hak_akses_delete`, `hak_akses_search`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(36, 24, 28, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(5, 2, 2, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(32, 22, 15, 1, 1, 0, 0, 1, NULL, NULL, 2, NULL),
(30, 2, 31, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(10, 2, 33, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(33, 22, 2, 1, 1, 0, 0, 1, NULL, NULL, 2, NULL),
(35, 24, 38, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(13, 2, 9, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(14, 2, 7, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(40, 24, 11, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(18, 2, 34, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(17, 2, 25, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(37, 24, 26, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(38, 24, 37, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(31, 22, 1, 0, 1, 0, 0, 1, NULL, NULL, 2, NULL),
(41, 24, 27, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(44, 24, 69, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `harga_obat`
--

CREATE TABLE `harga_obat` (
  `harga_obat_id` int(11) NOT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `harga_beli` decimal(10,2) DEFAULT NULL,
  `harga_jual1` decimal(10,2) DEFAULT NULL,
  `harga_jual2` decimal(10,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_obat`
--

INSERT INTO `harga_obat` (`harga_obat_id`, `id_obat`, `harga_beli`, `harga_jual1`, `harga_jual2`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 8, '9000.00', '13000.00', '0.00', NULL, '2017-12-03 06:13:47', NULL, '2017-12-03 06:16:23'),
(2, 9, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 06:16:44', NULL, '2017-12-03 06:16:44'),
(3, 10, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 06:17:09', NULL, '2017-12-03 06:17:09'),
(4, 11, '6000.00', '8000.00', '0.00', NULL, '2017-12-03 06:20:31', NULL, '2017-12-03 06:20:31'),
(5, 12, '11250.00', '15000.00', '0.00', NULL, '2017-12-03 06:21:53', NULL, '2017-12-03 06:21:53'),
(6, 34, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:09:20', NULL, '2017-12-03 07:09:20'),
(7, 13, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 07:13:06', NULL, '2017-12-03 07:13:06'),
(8, 14, '1875.00', '2500.00', '0.00', NULL, '2017-12-03 07:14:10', NULL, '2017-12-03 07:14:10'),
(9, 15, '15000.00', '20000.00', '0.00', NULL, '2017-12-03 07:15:36', NULL, '2017-12-03 07:15:36'),
(10, 16, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:16:34', NULL, '2017-12-03 07:16:34'),
(11, 17, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:16:52', NULL, '2017-12-03 07:16:52'),
(12, 18, '4500.00', '6000.00', '0.00', NULL, '2017-12-03 07:17:10', NULL, '2017-12-03 07:17:10'),
(13, 19, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 07:17:28', NULL, '2017-12-03 07:17:28'),
(14, 20, '5250.00', '7000.00', '0.00', NULL, '2017-12-03 07:17:44', NULL, '2017-12-03 07:17:44'),
(15, 21, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:17:58', NULL, '2017-12-03 07:17:58'),
(16, 22, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 07:18:17', NULL, '2017-12-03 07:18:17'),
(17, 23, '9000.00', '12000.00', '0.00', NULL, '2017-12-03 07:18:31', NULL, '2017-12-03 07:18:31'),
(18, 24, '1875.00', '2500.00', '0.00', NULL, '2017-12-03 07:18:43', NULL, '2017-12-03 07:18:43'),
(19, 25, '5250.00', '7000.00', '0.00', NULL, '2017-12-03 07:19:01', NULL, '2017-12-03 07:19:01'),
(20, 26, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:19:20', NULL, '2017-12-03 07:19:20'),
(21, 27, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 07:19:34', NULL, '2017-12-03 07:19:34'),
(22, 28, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 07:19:47', NULL, '2017-12-03 07:19:47'),
(23, 29, '2250.00', '3000.00', '0.00', NULL, '2017-12-03 07:20:07', NULL, '2017-12-03 07:20:07'),
(24, 30, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:20:27', NULL, '2017-12-03 07:20:27'),
(25, 31, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 07:20:45', NULL, '2017-12-03 07:20:45'),
(26, 32, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 07:20:58', NULL, '2017-12-03 07:20:58'),
(27, 33, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:21:19', NULL, '2017-12-03 07:21:19'),
(28, 35, '75.00', '100.00', '0.00', NULL, '2017-12-03 07:21:35', NULL, '2017-12-03 07:21:35'),
(29, 36, '9000.00', '12000.00', '0.00', NULL, '2017-12-03 07:21:49', NULL, '2017-12-03 07:21:49'),
(30, 37, '4875.00', '6000.00', '0.00', NULL, '2017-12-03 07:22:03', NULL, '2017-12-03 07:22:03'),
(31, 48, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:22:26', NULL, '2017-12-03 07:22:26'),
(32, 49, '2250.00', '3000.00', '0.00', NULL, '2017-12-03 07:26:42', NULL, '2017-12-03 07:26:42'),
(33, 50, '6000.00', '8000.00', '0.00', NULL, '2017-12-03 07:26:54', NULL, '2017-12-03 07:26:54'),
(34, 69, '12000.00', '16000.00', '0.00', NULL, '2017-12-03 07:27:07', NULL, '2017-12-03 07:27:07'),
(35, 70, '7500.00', '10000.00', '0.00', NULL, '2017-12-03 07:27:20', NULL, '2017-12-03 07:27:20'),
(36, 38, '15000.00', '20000.00', '0.00', NULL, '2017-12-03 07:27:35', NULL, '2017-12-03 07:27:35'),
(37, 39, '1350.00', '1800.00', '0.00', NULL, '2017-12-03 07:27:58', NULL, '2017-12-03 07:27:58'),
(38, 40, '5250.00', '7000.00', '0.00', NULL, '2017-12-03 07:28:11', NULL, '2017-12-03 07:28:11'),
(39, 41, '8025.00', '10700.00', '0.00', NULL, '2017-12-03 07:28:27', NULL, '2017-12-03 07:28:27'),
(40, 42, '1125.00', '1500.00', '0.00', NULL, '2017-12-03 07:28:40', NULL, '2017-12-03 07:28:40'),
(41, 43, '1125.00', '1500.00', '0.00', NULL, '2017-12-03 07:28:55', NULL, '2017-12-03 07:28:55'),
(42, 44, '17250.00', '23000.00', '0.00', NULL, '2017-12-03 07:29:10', NULL, '2017-12-03 07:29:10'),
(43, 45, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:29:26', NULL, '2017-12-03 07:29:26'),
(44, 46, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:29:40', NULL, '2017-12-03 07:29:40'),
(45, 47, '6750.00', '9000.00', '0.00', NULL, '2017-12-03 07:29:54', NULL, '2017-12-03 07:29:54'),
(46, 71, '6750.00', '9000.00', '0.00', NULL, '2017-12-03 07:30:06', NULL, '2017-12-03 07:30:06'),
(47, 72, '1500.00', '2000.00', '0.00', NULL, '2017-12-03 07:30:19', NULL, '2017-12-03 07:30:19'),
(48, 73, '5750.00', '7000.00', '0.00', NULL, '2017-12-03 07:30:31', NULL, '2017-12-03 07:30:31'),
(49, 74, '17000.00', '20000.00', '0.00', NULL, '2017-12-03 07:30:50', NULL, '2017-12-03 07:30:50'),
(50, 75, '8500.00', '10000.00', '0.00', NULL, '2017-12-03 07:31:27', NULL, '2017-12-03 07:31:27'),
(51, 76, '6800.00', '8000.00', '0.00', NULL, '2017-12-03 07:31:40', NULL, '2017-12-03 07:31:40'),
(52, 77, '12325.00', '14500.00', '0.00', NULL, '2017-12-03 07:31:55', NULL, '2017-12-03 07:31:55'),
(53, 78, '6375.00', '7500.00', '0.00', NULL, '2017-12-03 07:32:11', NULL, '2017-12-03 07:32:11'),
(54, 79, '8075.00', '9500.00', '0.00', NULL, '2017-12-03 07:32:24', NULL, '2017-12-03 07:32:24'),
(55, 80, '8500.00', '10000.00', '0.00', NULL, '2017-12-03 07:32:36', NULL, '2017-12-03 07:32:36'),
(56, 81, '5100.00', '6000.00', '0.00', NULL, '2017-12-03 07:32:49', NULL, '2017-12-03 07:32:49'),
(57, 82, '1275.00', '1500.00', '0.00', NULL, '2017-12-03 07:33:03', NULL, '2017-12-03 07:33:03'),
(58, 83, '12750.00', '12750.00', '0.00', NULL, '2017-12-03 07:33:24', NULL, '2017-12-03 07:33:24'),
(59, 84, '15300.00', '18000.00', '0.00', NULL, '2017-12-03 07:34:17', NULL, '2017-12-03 07:34:17'),
(60, 85, '5525.00', '6500.00', '0.00', NULL, '2017-12-03 07:34:31', NULL, '2017-12-03 07:34:31'),
(61, 86, '9775.00', '11500.00', '0.00', NULL, '2017-12-03 07:34:45', NULL, '2017-12-03 07:34:45'),
(62, 87, '24000.00', '32000.00', '0.00', NULL, '2017-12-03 07:34:56', NULL, '2017-12-03 07:34:56'),
(63, 88, '30500.00', '35000.00', '0.00', NULL, '2017-12-03 07:35:13', NULL, '2017-12-03 07:35:13'),
(64, 89, '16200.00', '18500.00', '0.00', NULL, '2017-12-03 07:35:24', NULL, '2017-12-03 07:35:24'),
(65, 90, '8500.00', '9800.00', '0.00', NULL, '2017-12-03 07:35:36', NULL, '2017-12-03 07:35:36'),
(66, 91, '6100.00', '7500.00', '0.00', NULL, '2017-12-03 07:35:50', NULL, '2017-12-03 07:35:50'),
(67, 92, '29000.00', '33500.00', '0.00', NULL, '2017-12-03 07:36:27', NULL, '2017-12-03 07:36:27'),
(68, 93, '13600.00', '16000.00', '0.00', NULL, '2017-12-03 07:36:40', NULL, '2017-12-03 07:36:40'),
(69, 94, '17000.00', '20000.00', '0.00', NULL, '2017-12-03 07:36:59', NULL, '2017-12-03 07:36:59'),
(70, 95, '8900.00', '10500.00', '0.00', NULL, '2017-12-03 07:37:21', NULL, '2017-12-03 07:37:21'),
(71, 96, '4400.00', '5500.00', '0.00', NULL, '2017-12-03 07:37:32', NULL, '2017-12-03 07:37:32'),
(72, 97, '3750.00', '5000.00', '0.00', NULL, '2017-12-03 07:37:46', NULL, '2017-12-03 07:37:46'),
(73, 98, '6550.00', '7500.00', '0.00', NULL, '2017-12-03 07:38:01', NULL, '2017-12-03 07:38:01'),
(74, 99, '2350.00', '3000.00', '0.00', NULL, '2017-12-03 07:38:15', NULL, '2017-12-03 07:38:15'),
(75, 100, '3850.00', '4500.00', '0.00', NULL, '2017-12-03 07:38:26', NULL, '2017-12-03 07:38:26'),
(76, 101, '13200.00', '15500.00', '0.00', NULL, '2017-12-03 07:38:41', NULL, '2017-12-03 07:38:41'),
(77, 102, '4250.00', '5000.00', '0.00', NULL, '2017-12-03 07:39:01', NULL, '2017-12-03 07:39:01'),
(78, 103, '9200.00', '11500.00', '0.00', NULL, '2017-12-03 07:39:14', NULL, '2017-12-03 07:39:14'),
(79, 104, '27500.00', '34500.00', '0.00', NULL, '2017-12-03 07:39:41', NULL, '2017-12-03 07:39:41'),
(80, 105, '4200.00', '5500.00', '0.00', NULL, '2017-12-03 07:39:59', NULL, '2017-12-03 07:39:59'),
(81, 106, '24750.00', '31000.00', '0.00', NULL, '2017-12-03 07:40:12', NULL, '2017-12-03 07:40:12'),
(82, 107, '33275.00', '38500.00', '0.00', NULL, '2017-12-03 07:40:25', NULL, '2017-12-03 07:40:25'),
(83, 108, '39900.00', '46000.00', '0.00', NULL, '2017-12-03 07:40:40', NULL, '2017-12-03 07:40:40'),
(84, 109, '12300.00', '14200.00', '0.00', NULL, '2017-12-03 07:40:53', NULL, '2017-12-03 07:40:53'),
(85, 110, '7200.00', '8300.00', '0.00', NULL, '2017-12-03 07:41:06', NULL, '2017-12-03 07:41:06'),
(86, 111, '18200.00', '21000.00', '0.00', NULL, '2017-12-03 07:41:18', NULL, '2017-12-03 07:41:18'),
(87, 112, '9500.00', '11000.00', '0.00', NULL, '2017-12-03 07:41:31', NULL, '2017-12-03 07:41:31'),
(88, 113, '15400.00', '18000.00', '0.00', NULL, '2017-12-03 07:41:51', NULL, '2017-12-03 07:41:51'),
(89, 114, '4250.00', '5000.00', '0.00', NULL, '2017-12-03 07:42:10', NULL, '2017-12-03 07:42:10'),
(90, 115, '11000.00', '12700.00', '0.00', NULL, '2017-12-03 07:42:21', NULL, '2017-12-03 07:42:21'),
(91, 116, '500.00', '1000.00', '0.00', NULL, '2017-12-03 07:42:37', NULL, '2017-12-03 07:42:37'),
(92, 117, '500.00', '1000.00', '0.00', NULL, '2017-12-03 07:42:52', NULL, '2017-12-03 07:42:52'),
(93, 118, '4300.00', '5000.00', '0.00', NULL, '2017-12-03 07:43:05', NULL, '2017-12-03 07:43:05'),
(94, 119, '11700.00', '13500.00', '0.00', NULL, '2017-12-03 07:43:20', NULL, '2017-12-03 07:43:20'),
(95, 120, '7700.00', '9000.00', '0.00', NULL, '2017-12-03 07:43:48', NULL, '2017-12-03 07:43:48'),
(96, 121, '14000.00', '16000.00', '0.00', NULL, '2017-12-03 07:43:59', NULL, '2017-12-03 07:43:59'),
(97, 122, '12000.00', '14000.00', '0.00', NULL, '2017-12-03 07:44:14', NULL, '2017-12-03 07:44:14'),
(98, 123, '12000.00', '14000.00', '0.00', NULL, '2017-12-03 07:44:27', NULL, '2017-12-03 07:44:27'),
(101, 133, '100000.00', '110000.00', '0.00', 2, '2017-12-27 15:08:22', 2, '2017-12-28 12:59:39'),
(103, 2, '200000.00', '2000.00', '0.00', 2, '2018-01-24 21:13:28', NULL, '2018-01-24 21:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `h_jual`
--

CREATE TABLE `h_jual` (
  `kodejual` char(15) NOT NULL,
  `tgljual` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(16, 'SESAK', '2017-11-21 15:06:25', NULL, '2017-11-28 11:06:06', NULL),
(46, 'BEBAS', '2017-12-03 00:20:02', NULL, '2017-12-03 00:20:02', NULL),
(17, 'DALAM', '2017-11-21 15:06:25', NULL, '2017-11-28 11:04:27', NULL),
(13, 'DIABETES', '2017-11-21 15:06:25', NULL, '2017-11-28 11:05:58', NULL),
(22, 'EDEMA', '2017-11-21 15:06:25', NULL, '2017-11-28 11:05:27', NULL),
(20, 'ANTIBIOTIK', '2017-11-21 15:06:25', NULL, '2017-11-28 11:06:44', NULL),
(23, 'SALEP MATA', '2017-11-21 15:06:25', NULL, '2017-11-28 11:06:22', NULL),
(24, 'JAMUR', '2017-11-21 15:06:25', NULL, '2017-11-28 11:05:35', NULL),
(25, 'VITAMIN', '2017-11-21 15:06:25', NULL, '2017-11-28 11:06:14', NULL),
(34, 'PUSING', '2017-11-28 11:04:33', NULL, '2017-11-28 11:04:33', NULL),
(36, 'GATAL', '2017-11-28 11:04:47', NULL, '2017-11-28 11:04:47', NULL),
(37, 'LAMBUNG', '2017-11-28 11:04:55', NULL, '2017-11-28 11:04:55', NULL),
(38, 'ANTI NYERI 2', '2017-11-28 11:05:03', NULL, '2018-01-24 21:31:34', 92),
(39, 'ANTI PENDARAHAN', '2017-11-28 11:05:08', NULL, '2017-11-28 11:05:08', NULL),
(40, 'MUAL', '2017-11-28 11:05:14', NULL, '2017-11-28 11:05:14', NULL),
(41, 'HIPERTENSI', '2017-11-28 11:06:54', NULL, '2017-11-28 11:06:54', NULL),
(43, 'BATUK', '2017-12-02 23:50:53', NULL, '2017-12-03 06:19:28', NULL),
(44, 'GENERIK', '2017-12-02 23:55:13', NULL, '2017-12-02 23:55:13', NULL),
(50, 'Sakit Perut', '2018-01-24 21:03:57', 2, '2018-01-24 21:03:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `url` varchar(30) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `name`, `title`, `url`, `icon`, `ref`, `urutan`, `parent`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Beranda', 'Beranda', 'beranda', 'fa-home', 'mnBeranda', 1, 0, '2017-11-21 15:55:08', NULL, '2017-11-26 20:39:05', NULL),
(7, 'MasterPasien', 'Master Pasien', '#', 'fa-wheelchair', 'mnMasterPasien', 7, 0, '2017-11-21 16:07:33', NULL, '2018-01-08 21:29:46', NULL),
(11, 'MasterObat', 'Master Obat dan Alkes', '#', 'fa-glass', 'mnMasterObat', 21, 0, '2017-11-21 16:13:45', NULL, '2018-01-24 22:21:13', 2),
(13, 'Supplier', 'Supplier', 'suplier', 'fa-truck', 'mnSupplier', 14, 0, '2017-11-21 16:14:40', NULL, '2017-12-08 07:43:30', NULL),
(14, 'Pengaturan', 'Pengaturan', '#', 'fa-cog', 'mnPengaturan', 13, 0, '2017-11-21 16:15:15', NULL, '2017-12-08 07:43:33', NULL),
(15, 'TambahPasien', 'Pendaftaran Baru', 'pasien/form', 'fa-vcard-o', 'mnTambahPasien', 1, 0, '2017-11-21 16:15:41', NULL, '2018-01-08 21:31:51', 2),
(16, 'DataPasien', 'Pasien Terdaftar', 'pasien', 'fa-circle-o', 'mnPasienTerdaftar', 2, 7, '2017-11-21 16:16:03', NULL, '2017-11-26 08:46:43', NULL),
(2, 'PendaftaranPasien', 'Pendaftaran Pemeriksaan', 'pendaftaran_pasien', 'fa-plus', 'mnPendaftaranPasien', 2, 0, '2017-11-21 15:55:08', NULL, '2018-01-08 21:31:20', NULL),
(3, 'Kasir', 'Kasir', 'kasir', 'fa-shopping-cart', 'mnKasir', 3, 0, '2017-11-21 15:55:08', NULL, '2017-11-26 08:48:07', NULL),
(6, 'Keuangan', 'Keuangan', '#', 'fa-money', 'mnKeuangan', 6, 0, '2017-11-21 15:55:08', NULL, '2017-12-08 07:52:12', NULL),
(26, 'KategoriObat', 'Kategori', 'kategoriobat', 'fa-circle-o', 'mnKategoriObat', 3, 11, '2017-11-26 07:09:34', NULL, '2017-11-27 13:44:58', NULL),
(27, 'Obat', 'Obat dan Alkes', 'obat', 'fa-circle-o', 'mnObat', 4, 11, '2017-11-26 07:10:43', NULL, '2017-12-02 23:36:28', NULL),
(28, 'HargaObat', 'Harga', 'hargaobat', 'fa-circle-o', 'mnHargaObat', 5, 11, '2017-11-26 07:11:19', NULL, '2017-12-02 23:36:06', NULL),
(31, 'Menu', 'Menu', 'menu', 'fa-circle-o', 'mnMenu', 1, 14, '2017-11-26 07:13:08', NULL, '2017-11-26 08:49:15', NULL),
(32, 'TipeAkses', 'Tipe Akses', 'role', 'fa-circle-o', 'mnRole', 2, 14, '2017-11-26 07:13:36', NULL, '2017-11-26 08:49:25', NULL),
(33, 'HakAkses', 'Hak Akses', 'previlleges', 'fa-circle-o', 'mnHakAkses', 3, 14, '2017-11-26 07:14:15', NULL, '2017-11-26 09:41:48', NULL),
(34, 'Owner', 'Informasi Aplikasi', 'owner', 'fa-circle-o', 'mnOwner', 5, 14, '2017-11-26 07:14:33', NULL, '2017-12-20 09:14:39', NULL),
(47, 'LaporanJurnalPendapatan', 'Laporan Jurnal Pendapatan', 'keuangan/jurnalpendapatan', 'fa-circle-o', 'mnLaporanJurnalPendapatan', 8, 6, '2017-12-08 07:49:42', NULL, '2017-12-28 13:21:53', NULL),
(36, 'Users', 'Pengguna', 'users', 'fa-circle-o', 'mnUsers', 4, 14, '2017-11-26 10:25:48', NULL, '2017-12-20 09:14:41', NULL),
(37, 'Satuan', 'Satuan', 'satuan', 'fa-circle-o', 'mnSatuan', 1, 11, '2017-11-26 21:54:09', NULL, '2017-11-27 11:24:29', NULL),
(38, 'Merk', 'Merk', 'merk', 'fa-circle-o', 'mnMerk', 2, 11, '2017-11-27 07:19:15', NULL, '2017-11-27 07:19:15', NULL),
(39, 'DataPengeluaran', 'Data Pengeluaran', 'keuangan/datapengeluaran', 'fa-circle-o', 'mnDataPengeluaran', 2, 6, '2017-12-08 07:54:21', NULL, '2017-12-28 13:21:45', NULL),
(41, 'LaporanPendapatan', 'Laporan Pendapatan', 'keuangan/laporanpendapatan', 'fa-circle-o', 'mnLaporanPendapatan', 3, 6, '2017-12-05 13:45:38', NULL, '2017-12-28 13:21:46', NULL),
(42, 'LaporanPengeluaran', 'Laporan Pengeluaran', 'keuangan/laporanpengeluaran', 'fa-circle-o', 'mnLaporanPengeluaran', 4, 6, '2017-12-05 13:46:43', NULL, '2017-12-28 13:21:47', NULL),
(43, 'LaporanPembayaranPasien', 'Laporan Pembayaran Pasien', 'keuangan/pembayaranpasien', 'fa-circle-o', 'mnLaporanPembayaranPasien', 5, 6, '2017-12-05 13:47:50', NULL, '2017-12-28 13:21:49', NULL),
(44, 'LaporanPiutang', 'Laporan Piutang', 'keuangan/laporanpiutang', 'fa-circle-o', 'mnLaporanPiutang', 6, 6, '2017-12-05 13:48:46', NULL, '2017-12-28 13:21:51', NULL),
(45, 'LaporanLabaRugi', 'Laporan Laba Rugi', 'keuangan/laporanlabarugi', 'fa-circle-o', 'mnLaporanLabaRugi', 7, 6, '2017-12-05 13:49:20', NULL, '2017-12-28 13:21:52', NULL),
(48, 'LaporanJurnalPengeluaran', 'Laporan Jurnal Pengeluaran', 'keuangan/jurnalpengeluaran', 'fa-circle-o', 'mnLaporanJurnalPengeluaran', 9, 6, '2017-12-08 07:50:35', NULL, '2017-12-28 13:21:54', NULL),
(49, 'KodeAkun', 'Kode Akun', 'ledger', 'fa-circle-o', 'mnKodeAkun', 1, 6, '2017-12-28 13:21:44', NULL, '2017-12-28 13:21:44', NULL),
(69, 'BerandaGudang', 'Dashboard Obat', 'Berandagudang', 'fa-home', 'mnBerandaGudang', 20, 0, '2018-01-24 22:16:33', NULL, '2018-01-24 22:20:14', NULL),
(52, 'AntrianPasien', 'Antrian Pasien', 'antrianpasien', 'fa-circle-o', 'mnAntrianPasien', 1, 4, '2018-01-03 02:11:34', NULL, '2018-01-03 02:11:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `merk_id` int(11) NOT NULL,
  `merk_nama` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`merk_id`, `merk_nama`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(70, 'BETADIN', 2, '2017-12-27 13:57:54', NULL, '2017-12-27 13:57:54'),
(68, 'MIXAGRIP', NULL, '2017-12-11 11:33:58', 2, '2017-12-27 13:59:29'),
(71, 'Intunal', 2, '2018-01-24 21:03:44', NULL, '2018-01-24 21:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(10) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `id_merk` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `kode_obat` varchar(8) NOT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `id_kategori`, `id_satuan`, `id_merk`, `id_supplier`, `kode_obat`, `nama_obat`, `stok`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 34, 5, 68, 14, '0', 'Bodrexin', 0, '2018-01-24 20:26:17', 2, '2018-01-24 20:26:17', NULL),
(2, 50, 67, 71, 14, 'KD0001', 'Intunal Kuning', 90, '2018-01-24 21:04:27', 2, '2018-01-24 21:04:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(10) NOT NULL,
  `nama_owner` varchar(120) DEFAULT NULL,
  `alamat_owner` text,
  `logo_owner` text,
  `no_telpon_owner` varchar(14) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `nama_owner`, `alamat_owner`, `logo_owner`, `no_telpon_owner`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Nadra Zat Silmi', '', '', '087727111993', '2017-11-21 15:16:33', NULL, '2017-12-28 11:09:10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `no_rm` varchar(8) DEFAULT '0',
  `no_kartu` varchar(8) DEFAULT '0',
  `nama_pasien` varchar(125) DEFAULT NULL,
  `nik_pasien` varchar(16) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `pendidikan_pasien` varchar(120) DEFAULT NULL,
  `pekerjaan_pasien` varchar(120) DEFAULT NULL,
  `warga_negara` enum('Indonesia','Asing') DEFAULT NULL,
  `gol_darah` enum('A','B','AB','O') DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `status_perkawinan` enum('Kawin','Belum Kawin','Janda','Duda') DEFAULT NULL,
  `no_telp_rumah` varchar(20) DEFAULT NULL,
  `no_handphone` varchar(20) DEFAULT NULL,
  `jalan` varchar(75) DEFAULT NULL,
  `rtrw` varchar(7) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `status_pasien` enum('LAMA','BARU') DEFAULT 'BARU',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_rm`, `no_kartu`, `nama_pasien`, `nik_pasien`, `tempat_lahir`, `tgl_lahir`, `agama`, `pendidikan_pasien`, `pekerjaan_pasien`, `warga_negara`, `gol_darah`, `jenis_kelamin`, `status_perkawinan`, `no_telp_rumah`, `no_handphone`, `jalan`, `rtrw`, `kelurahan`, `kecamatan`, `kota`, `email`, `status_pasien`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(38, '18000002', '00000002', 'Taufik Umardi', '1212121212121212', 'Jakarta', '2018-01-01', 'Islam', 'S1', 'Programer', 'Indonesia', 'B', NULL, 'Kawin', '(021) 2222-2222', '222-2222-2222', 'kp.melayu', '09/09', 'jatinegara', 'kiarapayung', 'jakarta', 't@gmail.com', 'LAMA', '2018-01-02 13:48:34', 2, '2018-01-03 11:48:40', 2),
(37, '18000001', '00000001', 'Nadra ', '1234567890', 'Bandung', '1993-11-27', 'Islam', 'S1', 'Programer', 'Indonesia', 'O', NULL, 'Kawin', '(022) 1111-1111', '111-1111-1111', 'Jl. Saluyu A-XV No. 277', '04/07', 'Cipamokolan', 'Rancasari', 'Bandung', 'nadra.zata27@gmail.com', 'LAMA', '2018-01-02 13:43:48', 2, '2018-01-03 11:48:25', 2),
(39, '18000003', '00000003', 'Muhammad Thaufiq Umardi', '3273060507960005', 'Cicacap', '1996-07-05', 'Islam', 'SSS', 'Pengangguran', 'Indonesia', 'A', NULL, 'Belum Kawin', '(022) 2222-2222', '898-9898-9898', 'Jl. Dr Abdul Rivai ', '03/03', 'Pasirkaliki', 'Cicendo', 'Bandung', 'thaufiqumardi@gmail.com', 'LAMA', '2018-01-04 11:16:12', 2, '2018-01-04 11:16:35', 2),
(40, '18000004', '00000004', 'Asep Sumpena', '2392389282394802', 'Bandung', '1991-07-17', 'Islam', 'qwer', '', 'Indonesia', 'A', NULL, NULL, '', '123-1231-2312', 'asdf', '12/31', 'ASD', 'asdf', 'asdf', '', 'BARU', '2018-01-08 22:01:42', 90, '2018-01-08 22:01:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `pemasukan_id` int(11) NOT NULL,
  `no_kuitansi` varchar(12) DEFAULT NULL,
  `no_registrasi` varchar(10) DEFAULT NULL,
  `tgl_pemasukan` datetime DEFAULT NULL,
  `nama_pemasukan` varchar(100) DEFAULT NULL,
  `jenis_pemasukan` enum('Pendaftaran','Layanan','Obat','Lain-Lain','Paket') DEFAULT NULL,
  `harga_pemasukan` decimal(10,2) DEFAULT NULL,
  `qty_pemasukan` decimal(10,2) DEFAULT NULL,
  `total_pemasukan` decimal(10,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`pemasukan_id`, `no_kuitansi`, `no_registrasi`, `tgl_pemasukan`, `nama_pemasukan`, `jenis_pemasukan`, `harga_pemasukan`, `qty_pemasukan`, `total_pemasukan`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '00000001', '1712280003', '2017-12-28 00:00:00', NULL, 'Paket', NULL, '1.00', '0.00', 2, '2017-12-28 16:44:13', NULL, '2017-12-28 16:44:13'),
(2, '00000001', '1712280003', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', '10000.00', '1.00', '10000.00', 2, '2017-12-28 16:44:13', NULL, '2017-12-28 16:44:13'),
(3, '00000002', '1712280004', '2017-12-28 00:00:00', 'Spesialis Dalam', 'Layanan', '250000.00', '1.00', '250000.00', 2, '2017-12-28 17:10:19', NULL, '2017-12-28 17:10:19'),
(4, '00000002', '1712280004', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', '10000.00', '1.00', '10000.00', 2, '2017-12-28 17:10:19', NULL, '2017-12-28 17:10:19'),
(5, '00000003', '1712280005', '2017-12-28 00:00:00', NULL, 'Paket', NULL, '1.00', '0.00', 2, '2017-12-28 17:36:18', NULL, '2017-12-28 17:36:18'),
(6, '00000003', '1712280005', '2017-12-28 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', '10000.00', '1.00', '10000.00', 2, '2017-12-28 17:36:18', NULL, '2017-12-28 17:36:18'),
(7, '00000004', '1712290001', '2017-12-29 00:00:00', 'Operasi Besar', 'Layanan', '100000.00', '1.00', '100000.00', 2, '2017-12-29 10:34:59', NULL, '2017-12-29 10:34:59'),
(8, '00000004', '1712290001', '2017-12-29 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', '10000.00', '1.00', '10000.00', 2, '2017-12-29 10:34:59', NULL, '2017-12-29 10:34:59'),
(9, '00000005', '1712290002', '2017-12-29 00:00:00', NULL, 'Paket', NULL, '1.00', '0.00', 2, '2017-12-29 10:59:46', NULL, '2017-12-29 10:59:46'),
(10, '00000005', '1712290002', '2017-12-29 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', '10000.00', '1.00', '10000.00', 2, '2017-12-29 10:59:46', NULL, '2017-12-29 10:59:46'),
(11, '00000005', '1712290002', '2017-12-29 00:00:00', 'Spesialis Dalam', 'Layanan', '250000.00', '1.00', '250000.00', 2, '2017-12-29 10:59:46', NULL, '2017-12-29 10:59:46'),
(12, '00000005', '1712290002', '2017-12-29 00:00:00', 'Keluarga Berencana', 'Layanan', '20000.00', '1.00', '20000.00', 2, '2017-12-29 10:59:46', NULL, '2017-12-29 10:59:46'),
(13, '00000005', '1712290002', '2017-12-29 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', '10000.00', '1.00', '10000.00', 2, '2017-12-29 10:59:46', NULL, '2017-12-29 10:59:46'),
(14, '00000006', '1712290001', '2017-12-29 00:00:00', 'AMOXICILLIN', 'Obat', '5000.00', '1.00', '5000.00', 2, '2017-12-29 12:14:29', NULL, '2017-12-29 12:14:29'),
(15, '00000006', '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', '2000.00', '2.00', '4000.00', 2, '2017-12-29 12:14:29', NULL, '2017-12-29 12:14:29'),
(16, '00000006', '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', '2000.00', '3.00', '6000.00', 2, '2017-12-29 12:14:29', NULL, '2017-12-29 12:14:29'),
(17, '00000006', '1712290001', '2017-12-29 00:00:00', 'ANTASIDA DOEN', 'Obat', '2000.00', '1.00', '2000.00', 2, '2017-12-29 12:14:29', NULL, '2017-12-29 12:14:29'),
(18, '00000006', '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', '2000.00', '2.00', '4000.00', 2, '2017-12-29 12:14:29', NULL, '2017-12-29 12:14:29'),
(19, '00000007', '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', '2000.00', '1.00', '2000.00', 2, '2017-12-29 12:27:52', NULL, '2017-12-29 12:27:52'),
(20, '00000007', '1712290001', '2017-12-29 00:00:00', 'AMBROXOL', 'Obat', '2000.00', '1.00', '2000.00', 2, '2017-12-29 12:27:52', NULL, '2017-12-29 12:27:52'),
(21, '00000008', '1712290002', '2017-12-29 00:00:00', NULL, 'Paket', NULL, '1.00', '0.00', 2, '2017-12-29 14:34:51', NULL, '2017-12-29 14:34:51'),
(22, '00000008', '1712290002', '2017-12-29 00:00:00', 'Biaya Pendaftaran Pasien Lama', 'Pendaftaran', '10000.00', '1.00', '10000.00', 2, '2017-12-29 14:34:51', NULL, '2017-12-29 14:34:51'),
(23, '00000009', '1801030001', '2018-01-03 00:00:00', 'Operasi Besar', 'Layanan', '100000.00', '1.00', '100000.00', 2, '2018-01-03 11:53:00', NULL, '2018-01-03 11:53:00'),
(24, '00000009', '1801030001', '2018-01-03 00:00:00', 'Biaya Pendaftaran Pasien Baru', 'Pendaftaran', '15000.00', '1.00', '15000.00', 2, '2018-01-03 11:53:00', NULL, '2018-01-03 11:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_kunjungan` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_kunjungan`, `waktu`, `biaya`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(3, 13, '2016-08-08', 4000000, '2017-11-21 15:19:51', NULL, '2017-11-21 15:19:51', NULL),
(4, 14, '2016-08-08', 4000000, '2017-11-21 15:19:51', NULL, '2017-11-21 15:19:51', NULL),
(5, 15, '2016-08-08', 20000, '2017-11-21 15:19:51', NULL, '2017-11-21 15:19:51', NULL),
(7, 16, '2016-12-06', 30000, '2017-11-21 15:19:51', NULL, '2017-11-21 15:19:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penanggung_pasien`
--

CREATE TABLE `penanggung_pasien` (
  `id_penanggung` int(11) NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `nama_penanggung` varchar(125) DEFAULT NULL,
  `nik_penanggung` varchar(16) DEFAULT NULL,
  `tempat_lahir_penanggung` varchar(50) DEFAULT NULL,
  `tgl_lahir_penanggung` date DEFAULT NULL,
  `hubungan_pasien` varchar(75) DEFAULT NULL,
  `pendidikan_penanggung` varchar(50) DEFAULT NULL,
  `pekerjaan_penanggung` varchar(75) DEFAULT NULL,
  `no_telp_penanggung` varchar(20) DEFAULT NULL,
  `no_hp_penanggung` varchar(20) DEFAULT NULL,
  `jalan` varchar(75) DEFAULT NULL,
  `rtrw` varchar(7) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `cara_pembayaran` enum('Pribadi','Kantor','Asuransi') DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penanggung_pasien`
--

INSERT INTO `penanggung_pasien` (`id_penanggung`, `id_pasien`, `nama_penanggung`, `nik_penanggung`, `tempat_lahir_penanggung`, `tgl_lahir_penanggung`, `hubungan_pasien`, `pendidikan_penanggung`, `pekerjaan_penanggung`, `no_telp_penanggung`, `no_hp_penanggung`, `jalan`, `rtrw`, `kelurahan`, `kecamatan`, `kota`, `email`, `cara_pembayaran`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 18, 'Penanggung 1', '2324987329857298', 'jakarta', '1970-01-01', 'Saudara', 'sd', 'Direktur', '(022) 9898-9898', '857-8789-8743', 'Jl. Penanggung1', '03/03', 'Kelp1', 'kecp1', 'Bandung', 'penanggung1@gmail.com', 'Kantor', '2017-11-28 15:03:34', 0, '2017-12-26 11:33:17', 2),
(7, 19, 'Penanggung2', '2324987329857298', 'Bandung', '1970-01-01', 'Saudara', 'S3', 'Direktur', '', '', '', '', 'cibiru', 'cicici', 'Bandung', 'reza@gmail.com', 'Pribadi', '2017-11-28 15:30:41', 0, '2017-11-28 16:02:16', 0),
(8, 20, 'Penanggung 3', '3275969183398476', '', '1970-01-01', 'Bapak', '', 'abcd', '(022) 9893-4899', '857-3643-6436', 'Jl. blabla', '30/30', 'lasdkfj', 'djsfk', 'jdsfk', 'penanggung3@gmail.co', 'Pribadi', '2017-11-29 09:13:41', 0, '2017-12-08 12:46:07', 0),
(9, 21, 'Mutia Zata Yumni', '3273236711930001', 'Bandung', '1991-08-25', 'Kakak', 'S1', 'Guru', '', '329-3823-8299', 'JL. Saluyu A XV No.277', '04/07', 'Cipamokolan ', 'Rancasari', 'Bandung', 'mutia.zata@gmail.com', 'Pribadi', '2017-11-29 15:11:01', 0, '2017-11-29 15:11:01', 0),
(10, 27, 'Kaka', '21424234232', NULL, '1970-01-01', 'Kakak', NULL, 'Mahasiswa', '(022) 4444-4444', '454-5454-5454', 'Jl. Kebon Sawo', '09/09', 'Kelor', 'Wetan', 'Jakarta', 'kaka@gmail.com', 'Kantor', '2017-12-13 10:17:11', 2, '2017-12-13 10:47:31', 2),
(11, 28, 'Mutia ', '12649846786', NULL, '1970-01-01', 'Kakak', NULL, 'Mahasiswa', '(974) 9810-8932', '893-6254-7649', 'Kp. Pulo', '08/08', 'Cimande', 'Citapen', 'Surabaya', 'mutia.zata@gmail.com', 'Asuransi', '2017-12-13 10:29:00', 2, '2017-12-13 10:29:00', NULL),
(12, 29, 'aaaa', '33333333333333', 'Jakarta', '2017-12-03', 'aaa', 'aaa', 'aaa', '(022) 3332-3232', '232-3232-2323', 'aaa', '09/09', 'aa', 'aa', 'aa', 'aa@gmail.com', 'Kantor', '2017-12-18 10:42:19', 2, '2017-12-18 10:42:19', NULL),
(13, 30, 'dddd', 'ddd', 'ddddd', '2017-12-05', 'dddd', 'dddd', 'dddd', '(022) 2222-2222', '323-2323-2323', 'eee', '08/08', 'dddd', 'dddd', 'ddd', 'eee@eee.com', NULL, '2017-12-18 10:57:29', 2, '2017-12-18 10:57:29', NULL),
(14, 31, 'wqwqwqwqw', 'wqwq', 'eeee', '2017-12-06', 'eee', 'eee', 'eee', '(022) 2222-2222', '444-4443-3333', 'www', '32/32', 'www', 'ww', 'lalala', 'www@ww.com', 'Kantor', '2017-12-18 11:16:38', 2, '2017-12-26 11:34:49', 2),
(15, 32, 'aaa', '1234567890', 'aaa', '2017-12-01', 'aaa', 'aaa', 'aaa', '(022) 1111-1111', '111-1111-1111', 'aaa', '11/11', 'aaa', 'aaa', 'aaa', 'aaa', 'Pribadi', '2017-12-26 11:07:45', 2, '2017-12-26 11:07:45', NULL),
(16, 33, 'sasa', '222', '', '1970-01-01', 'ibu', '', '', '', '434-3434-3434', 'xexe', '33/33', 'xexe', 'xexe', 'xexe', '', 'Asuransi', '2017-12-26 11:18:06', 2, '2017-12-26 11:18:06', NULL),
(17, 34, 'ref', '2343423', '', '1970-01-01', '344f', '', '', '', '244-4444-4444', 'frfr', '34/34', 'frfrf', 'frfrf', 'frfrfr', '', 'Kantor', '2017-12-26 11:22:42', 2, '2017-12-26 11:22:42', NULL),
(18, 35, 'aaaa', '33333333333333', '', '1970-01-01', 'aaa', 'aaa', 'aaa', '(222) 2222-2222', '222-2222-2222', 'aaa', '09/09', 'aaa', 'aaa', 'aaa', 'aaa@aaa.com', 'Pribadi', '2017-12-26 11:40:46', 2, '2017-12-26 11:42:52', 2),
(19, 36, 'Tafsir', '123412341234', 'Jakarta', '1958-08-12', 'Suami', 'SMK', 'Pegawai Swasta', '(022) 2929-2929', '399-3939-3939', 'Jl. Saluyu A XV no.277', '04/07', 'Cipamokolan', 'Rancasari', 'Bandung', 'muchtar.tafsir@gmail.com', 'Kantor', '2017-12-27 10:04:55', 2, '2017-12-27 10:14:07', 2),
(20, 37, 'Mutia Zata Yumni', '0987654321', 'Bandung', '1991-08-25', 'Kakak', 'S1', 'Guru', '(021) 1111-1111', '111-1111-1111', 'JL. Saluyu A XV No.277', '04/07', 'Cipamokolan ', 'Rancasari', 'Bandung', 'mutia.zata@gmail.com', 'Pribadi', '2018-01-02 13:43:48', 2, '2018-01-03 11:33:55', 2),
(21, 38, 'Jajat Ismail', '21212121212121', 'Jakarta', '1999-10-21', 'Kakak', 'S1', 'Pegawai Swasta', '(021) 0000-0000', '000-0000-0000', 'kp.melayu', '09/09', 'jongol', 'Kirana', 'Bandung', 'jajat@gmail.com', 'Kantor', '2018-01-02 13:48:34', 2, '2018-01-02 13:48:34', NULL),
(22, 39, 'Dadang', '3203060507964761', 'Bandung', '2018-01-05', 'Saudara', 'Pendidik', 'Pencuri', '(022) 2222-2222', '898-9989-8989', 'Jl. Dr. Ciairam', '03/03', 'Paspasan', 'Mandiri', 'Bahagia', 'Email@gmail.com', 'Pribadi', '2018-01-04 11:16:12', 2, '2018-01-04 11:16:12', NULL),
(23, 40, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-08 22:01:42', 90, '2018-01-08 22:01:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `piutang_id` int(11) NOT NULL,
  `no_registrasi` varchar(10) DEFAULT NULL,
  `tgl_registrasi` datetime DEFAULT NULL,
  `no_rm` varchar(100) DEFAULT NULL,
  `nama_pasien` varchar(100) DEFAULT NULL,
  `total_biaya` decimal(10,2) DEFAULT NULL,
  `total_bayar` decimal(10,2) DEFAULT NULL,
  `sisa_bayar` decimal(10,2) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`piutang_id`, `no_registrasi`, `tgl_registrasi`, `no_rm`, `nama_pasien`, `total_biaya`, `total_bayar`, `sisa_bayar`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '1712260001', '2017-12-26 00:00:00', '17000013', 'qqq', '215000.00', '0.00', '215000.00', 0, 2, '2017-12-26 11:10:07', NULL, '2017-12-26 11:10:07'),
(2, '1712260002', '2017-12-26 00:00:00', '17000002', 'Jajat Ismail', '10000.00', '0.00', '10000.00', 0, 2, '2017-12-26 11:10:55', NULL, '2017-12-26 11:10:55'),
(3, '1712260003', '2017-12-26 00:00:00', '17000014', 'dede', '15000.00', '0.00', '15000.00', 0, 2, '2017-12-26 11:18:37', NULL, '2017-12-26 11:18:37'),
(4, '1712260004', '2017-12-26 00:00:00', '17000005', 'Nadra Zata Silmi', '15000.00', '0.00', '15000.00', 0, 2, '2017-12-26 11:21:04', NULL, '2017-12-26 11:21:04'),
(5, '1712280001', '2017-12-28 00:00:00', '17000002', 'Jajat Ismail', '210000.00', '0.00', '210000.00', 0, 2, '2017-12-28 16:20:54', NULL, '2017-12-28 16:20:54'),
(6, '1712280002', '2017-12-28 00:00:00', '17000004', 'Pasien 3', '35000.00', '0.00', '35000.00', 0, 2, '2017-12-28 16:22:55', NULL, '2017-12-28 16:22:55'),
(7, '1712280003', '2017-12-28 00:00:00', '17000003', 'Pasien5', '10000.00', '10000.00', '0.00', 1, 2, '2017-12-28 16:23:10', 2, '2017-12-28 16:44:13'),
(8, '1712280004', '2017-12-28 00:00:00', '17000003', 'Pasien5', '260000.00', '260000.00', '0.00', 1, 2, '2017-12-28 16:23:36', 2, '2017-12-28 17:10:19'),
(9, '1712280005', '2017-12-28 00:00:00', '17000002', 'Jajat Ismail', '10000.00', '10000.00', '0.00', 1, 2, '2017-12-28 16:24:57', 2, '2017-12-28 17:36:18'),
(10, '1712280006', '2017-12-28 00:00:00', '17000004', 'Pasien 3', '10000.00', '0.00', '10000.00', 0, 2, '2017-12-28 16:25:28', NULL, '2017-12-28 16:25:28'),
(11, '1712290001', '2017-12-29 00:00:00', '17000002', 'Jajat Ismail', '135000.00', '135000.00', '0.00', 1, 86, '2017-12-29 10:26:54', 2, '2017-12-29 12:27:52'),
(12, '1712290002', '2017-12-29 00:00:00', '17000003', 'Pasien5', '10000.00', '300000.00', '-290000.00', 1, 87, '2017-12-29 10:27:32', 2, '2017-12-29 14:34:51'),
(13, '1712290002', '2017-12-29 00:00:00', '17000005', 'Nadra Zata Silmi', '280000.00', '0.00', '280000.00', 0, 2, '2017-12-29 10:59:00', NULL, '2017-12-29 10:59:00'),
(14, '1801020001', '2018-01-02 00:00:00', '17000004', 'Pasien 3', '260000.00', '0.00', '260000.00', 0, 2, '2018-01-02 13:15:03', NULL, '2018-01-02 13:15:03'),
(15, '1801030001', '2018-01-03 00:00:00', '18000001', 'Nadra ', '115000.00', '115000.00', '0.00', 1, 2, '2018-01-03 11:48:25', 2, '2018-01-03 11:53:00'),
(16, '1801030002', '2018-01-03 00:00:00', '18000002', 'Taufik Umardi', '15912.00', '0.00', '15912.00', 0, 2, '2018-01-03 11:48:40', NULL, '2018-01-03 11:48:40'),
(17, '1801040001', '2018-01-04 00:00:00', '18000002', 'Taufik Umardi', '210000.00', '0.00', '210000.00', 0, 2, '2018-01-04 10:38:51', NULL, '2018-01-04 10:38:51'),
(18, '1801040002', '2018-01-04 00:00:00', '18000001', 'Nadra ', '1120000.00', '0.00', '1120000.00', 0, 2, '2018-01-04 10:40:41', NULL, '2018-01-04 10:40:41'),
(19, '1801040003', '2018-01-04 00:00:00', '18000003', 'Muhammad Thaufiq Umardi', '35000.00', '0.00', '35000.00', 0, 2, '2018-01-04 11:16:35', NULL, '2018-01-04 11:16:35'),
(20, '1801070001', '2018-01-07 00:00:00', '18000003', 'Muhammad Thaufiq Umardi', '130000.00', '0.00', '130000.00', 0, 2, '2018-01-07 20:17:44', NULL, '2018-01-07 20:17:44'),
(21, '1801080001', '2018-01-08 00:00:00', '18000003', 'Muhammad Thaufiq Umardi', '210000.00', '0.00', '210000.00', 0, 2, '2018-01-08 21:12:53', NULL, '2018-01-08 21:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `produsen_obat`
--

CREATE TABLE `produsen_obat` (
  `suplier_id` int(11) NOT NULL,
  `nama_sup` varchar(70) DEFAULT NULL,
  `kode_sup` varchar(70) DEFAULT NULL,
  `alamat_sup` text,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produsen_obat`
--

INSERT INTO `produsen_obat` (`suplier_id`, `nama_sup`, `kode_sup`, `alamat_sup`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Kimia Farma', 'A0001', 'Jl Burangrang no.7 Bandung', '2017-11-21 15:31:24', NULL, '2017-11-21 15:31:24', NULL),
(2, 'Biofarma', 'A0002', 'Jl Pasteur', '2017-11-21 15:31:24', NULL, '2017-11-21 15:31:24', NULL),
(5, '3232', 'lala', 'jakarta\r\n', '2017-11-21 15:31:24', NULL, '2017-11-21 15:31:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrasi_pasien`
--

CREATE TABLE `registrasi_pasien` (
  `id_registrasi` int(11) NOT NULL,
  `no_registrasi` varchar(10) DEFAULT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_bed` int(11) DEFAULT NULL,
  `tgl_registrasi` date DEFAULT NULL,
  `jam_registrasi` time DEFAULT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `jenis_rawat` enum('RAWAT JALAN','RAWAT INAP') DEFAULT 'RAWAT JALAN',
  `jenis_pembayaran` enum('UMUM','BPJS') DEFAULT 'UMUM',
  `status_registrasi` char(1) DEFAULT '0',
  `status_antrian` char(1) DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 'Dewa Admin', '2017-11-21 15:35:13', NULL, '2018-01-08 20:58:05', 2),
(1, 'Super Admin', '2017-11-23 13:43:25', NULL, '2017-11-23 13:43:25', NULL),
(22, 'Admin Pendaftaran', '2018-01-08 20:59:12', 2, '2018-01-08 20:59:12', NULL),
(23, 'Kasir', '2018-01-24 20:07:02', 2, '2018-01-24 20:07:02', NULL),
(24, 'Gudang', '2018-01-24 21:18:07', 2, '2018-01-24 21:18:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`satuan_id`, `satuan_nama`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'PCS', NULL, '2017-11-27 13:26:07', NULL, '2017-11-28 11:00:10'),
(2, 'TABLET', NULL, '2017-11-27 13:26:30', NULL, '2017-11-28 11:00:21'),
(3, 'PAK', NULL, '2017-11-28 11:00:29', NULL, '2017-11-28 11:00:29'),
(67, 'BOX', 2, '2018-01-24 21:03:23', NULL, '2018-01-24 21:03:23'),
(5, 'STRIP', NULL, '2017-11-28 11:00:42', NULL, '2017-11-28 11:00:42'),
(6, 'GRAM', NULL, '2017-11-28 11:00:49', NULL, '2017-11-28 11:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `nama_supplier` varchar(150) DEFAULT NULL,
  `kode_supplier` varchar(100) DEFAULT NULL,
  `alamat_supplier` text,
  `no_telpon_supplier` varchar(20) DEFAULT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `no_telp_cp` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `nama_supplier`, `kode_supplier`, `alamat_supplier`, `no_telpon_supplier`, `contact_person`, `no_telp_cp`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'ABCD', '1', 'ALAMAT', '12345678', 'Contact Person', NULL, '2017-11-28 14:09:06', NULL, '2017-11-28 14:09:06', NULL),
(17, 'ABC', NULL, 'Jl. Saluyu A XV no.277', '08711271993', 'dede', NULL, '2017-12-28 11:42:46', 2, '2017-12-28 11:42:46', NULL),
(14, 'Kimia Farma', '2', 'bANDUNG', '022989898', 'Jaja', NULL, '2017-12-13 17:33:20', 2, '2017-12-13 17:33:20', NULL),
(15, 'Nana Sumirat', 'Lucas Djaja', 'Bandung', '0228984948', '089734647323', NULL, '2017-12-13 17:39:30', 2, '2017-12-13 18:00:41', 2),
(16, 'AB', NULL, 'Bandung ', '32323289', '098887', NULL, '2017-12-13 17:50:07', 2, '2017-12-28 11:45:49', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `role_id` int(11) DEFAULT '0',
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `user_photo` longtext,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `is_admin`, `role_id`, `username`, `password`, `user_photo`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 1, 2, 'dewa', '7904fcbbdaa02226eefcf425d11691f74f6995e6cbedd7eb64ccdcbf31c0b17ce52f7cdb3299932b854beb4689f3472ca8b1c52c389291866dbc6a7b631bcb12', '1513246611.png', 'Aktif', '2017-11-25 23:25:47', NULL, '2018-01-26 21:14:03', 2),
(90, 0, 22, 'Petugas Pendaftar', '7904fcbbdaa02226eefcf425d11691f74f6995e6cbedd7eb64ccdcbf31c0b17ce52f7cdb3299932b854beb4689f3472ca8b1c52c389291866dbc6a7b631bcb12', NULL, 'Aktif', '2018-01-08 21:00:26', 2, '2018-01-26 21:14:30', 2),
(91, 0, 23, 'kasino', '7904fcbbdaa02226eefcf425d11691f74f6995e6cbedd7eb64ccdcbf31c0b17ce52f7cdb3299932b854beb4689f3472ca8b1c52c389291866dbc6a7b631bcb12', NULL, 'Aktif', '2018-01-24 20:08:17', 2, '2018-01-26 21:14:12', 2),
(92, 0, 24, 'Pergudangan', '7904fcbbdaa02226eefcf425d11691f74f6995e6cbedd7eb64ccdcbf31c0b17ce52f7cdb3299932b854beb4689f3472ca8b1c52c389291866dbc6a7b631bcb12', NULL, 'Aktif', '2018-01-24 21:19:53', 2, '2018-01-26 21:14:22', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id_bed`);

--
-- Indexes for table `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  ADD PRIMARY KEY (`id_pembiayaan`);

--
-- Indexes for table `d_jual`
--
ALTER TABLE `d_jual`
  ADD PRIMARY KEY (`idjual`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kodejual` (`kodejual`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`);

--
-- Indexes for table `harga_obat`
--
ALTER TABLE `harga_obat`
  ADD PRIMARY KEY (`harga_obat_id`);

--
-- Indexes for table `h_jual`
--
ALTER TABLE `h_jual`
  ADD PRIMARY KEY (`kodejual`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`merk_id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`pemasukan_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penanggung_pasien`
--
ALTER TABLE `penanggung_pasien`
  ADD PRIMARY KEY (`id_penanggung`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`piutang_id`);

--
-- Indexes for table `produsen_obat`
--
ALTER TABLE `produsen_obat`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `registrasi_pasien`
--
ALTER TABLE `registrasi_pasien`
  ADD PRIMARY KEY (`id_registrasi`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id_bed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  MODIFY `id_pembiayaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `d_jual`
--
ALTER TABLE `d_jual`
  MODIFY `idjual` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `harga_obat`
--
ALTER TABLE `harga_obat`
  MODIFY `harga_obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `pemasukan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `penanggung_pasien`
--
ALTER TABLE `penanggung_pasien`
  MODIFY `id_penanggung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `piutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `produsen_obat`
--
ALTER TABLE `produsen_obat`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `registrasi_pasien`
--
ALTER TABLE `registrasi_pasien`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
