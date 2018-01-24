-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2017 at 12:02 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simkliniksat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(4) NOT NULL,
  `username` varchar(49) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` varchar(25) NOT NULL DEFAULT 'N',
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
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `id_diagnosa` int(11) NOT NULL,
  `nama_diagnosa` varchar(100) NOT NULL,
  `kode_icd` varchar(8) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`id_diagnosa`, `nama_diagnosa`, `kode_icd`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(4, 'Abdominal pain', 'R10.4', '2017-11-21 14:50:32', NULL, '2017-11-21 14:50:32', NULL),
(5, 'kejang', 'kk', '2017-11-21 14:50:32', NULL, '2017-11-21 14:50:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `kd_dokter` varchar(8) NOT NULL,
  `nama_dokter` varchar(40) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tmp_lahir` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gol_darah` enum('A','B','O','AB','-') NOT NULL,
  `agama` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `status_nikah` enum('MENIKAH','BELUM MENIKAH') NOT NULL,
  `alumni` varchar(60) NOT NULL,
  `no_izin_praktek` varchar(20) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `kd_dokter`, `nama_dokter`, `jenis_kelamin`, `tmp_lahir`, `tgl_lahir`, `gol_darah`, `agama`, `alamat`, `telepon`, `status_nikah`, `alumni`, `no_izin_praktek`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(4, '45665655', 'Thaufiq Umardi', 'L', 'Magelang', '2009-10-29', 'A', 'Islam', 'Jalanan', '085789898989', 'BELUM MENIKAH', 'Blababla', '1234567899', '2017-11-21 14:51:11', NULL, '2017-11-21 14:51:11', NULL),
(5, '44434343', 'Wawan', 'L', 'Jakarta', '1991-09-08', 'B', 'Islam', 'Bandung', '9237239472873', 'MENIKAH', 'UIN SGD BDG', '292992', '2017-11-21 14:51:11', NULL, '2017-11-21 14:51:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `d_jual`
--

CREATE TABLE `d_jual` (
  `idjual` smallint(6) NOT NULL,
  `kodejual` char(15) NOT NULL,
  `kode_barang` char(15) NOT NULL,
  `jmljual` int(11) NOT NULL,
  `hargajual` double NOT NULL,
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
  `update_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_jual`
--

CREATE TABLE `h_jual` (
  `kodejual` char(15) NOT NULL,
  `tgljual` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `jabatan_id` int(11) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `nama_jabatan`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(6, 'Direktur', '2017-11-21 15:05:10', NULL, '2017-11-21 15:05:10', NULL),
(11, 'Office Boy', '2017-11-21 15:05:10', NULL, '2017-11-21 15:05:10', NULL),
(15, 'dokter', '2017-11-21 15:05:10', NULL, '2017-11-21 15:05:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `kelas` int(1) NOT NULL,
  `tarif` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_ruangan`, `kelas`, `tarif`, `jumlah`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Bintang', 3, 200000, 2, '2017-11-21 15:05:50', NULL, '2017-11-21 15:05:50', NULL),
(5, '', 0, 0, 0, '2017-11-21 15:05:50', NULL, '2017-11-21 15:05:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(16, 'Salep Mataa', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(18, 'Syrup', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(17, 'Injeksi', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(13, 'Salep Kulit', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(22, 'No Category', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(20, 'Tablet', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(23, 'Syrup', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(24, 'Puyer', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(25, 'Suntikan', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL),
(31, 'dd', '2017-11-21 15:06:25', NULL, '2017-11-21 15:06:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(5) NOT NULL,
  `id_pasien` int(5) NOT NULL,
  `no_antri` varchar(15) NOT NULL,
  `waktu` date NOT NULL,
  `anamnese` text NOT NULL,
  `terapi` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `nama_dokter` varchar(25) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `id_pasien`, `no_antri`, `waktu`, `anamnese`, `terapi`, `status`, `nama_dokter`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(13, 914, '1', '2016-08-08', 'Panas<br>', 'Paracetamol <br>', 'selesai', 'Dr.Purnomo', '2017-11-21 15:07:39', NULL, '2017-11-21 15:07:39', NULL),
(14, 914, '2', '2016-08-08', 'sakit perut<br>', 'Pagoda <br>', 'selesai', 'Dr.Purnomo', '2017-11-21 15:07:39', NULL, '2017-11-21 15:07:39', NULL),
(15, 914, '3', '2016-08-08', 'sakit gigi<br>', 'tes<br>', 'selesai', 'Dr.Purnomo', '2017-11-21 15:07:39', NULL, '2017-11-21 15:07:39', NULL),
(16, 914, '4', '2016-08-08', 'sdfsdfs<br>', 'sdfsdf<br>', 'selesai', 'Dr.Purnomo', '2017-11-21 15:07:39', NULL, '2017-11-21 15:07:39', NULL),
(18, 911, '5', '2016-08-08', 'Mual<br>', 'Banyak Makan<br>', 'selesai', 'Dr.Purnomo', '2017-11-21 15:07:39', NULL, '2017-11-21 15:07:39', NULL),
(19, 928, '6', '2016-08-08', 'tes<br>', 'dsfsd<br>', 'selesai', 'Dr.Purnomo', '2017-11-21 15:07:39', NULL, '2017-11-21 15:07:39', NULL),
(20, 929, '7', '2016-08-08', 'Penyakit Sesak nafas<br>', 'Tes Obat1<br>', 'selesai', 'Dr.Purnomo', '2017-11-21 15:07:39', NULL, '2017-11-21 15:07:39', NULL),
(22, 917, '1', '2016-12-06', 'tes<br>', 'tes<br>', 'selesai', 'Dr.Purnomo', '2017-11-21 15:07:39', NULL, '2017-11-21 15:07:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama`, `tarif`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Umum', 50000, '2017-11-21 15:09:35', NULL, '2017-11-21 15:09:35', NULL),
(3, 'Operasi Besar ', 500000, '2017-11-21 15:09:35', NULL, '2017-11-21 15:09:35', NULL),
(5, 'Umum', 100000, '2017-11-21 15:09:35', NULL, '2017-11-21 15:09:35', NULL),
(11, 'Operasi Besar', 100000, '2017-11-21 15:09:35', NULL, '2017-11-21 15:09:35', NULL),
(12, 'THT', 200000, '2017-11-21 15:09:35', NULL, '2017-11-21 15:09:35', NULL),
(10, 'Spesialis Dalam', 250000, '2017-11-21 15:09:35', NULL, '2017-11-21 15:09:35', NULL),
(13, 'SDWD', 0, '2017-11-21 15:09:35', NULL, '2017-11-21 15:09:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(10) NOT NULL,
  `kode_header` varchar(10) NOT NULL,
  `kode_header_akun` varchar(10) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `kode_akun`, `kode_header`, `kode_header_akun`, `nama`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(7, '0', '11000', '0', 'Aktiva', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(8, '0', '11000', '11100', 'Aktiva Lancar', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(9, '11110', '11000', '11100', 'Kas', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(10, '11120', '11000', '11100', 'Bank', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(11, '11130', '11000', '11100', 'Persediaan', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(12, '0', '21000', '0', 'Hutang', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(13, '0', '21000', '21100', 'Hutang Lancar', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(14, '21110', '21000', '21100', 'Hutang Usaha', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(15, '11140', '11000', '11100', 'Obligasi', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(16, '0', '83838', '0', 'jssj', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL),
(17, '0', '', '1221', 'msam', '2017-11-21 15:10:34', NULL, '2017-11-21 15:10:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `title` varchar(30) NOT NULL,
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
(1, 'Beranda', 'Beranda', NULL, 'fa-home', NULL, 1, NULL, '2017-11-21 15:55:08', NULL, '2017-11-21 16:04:42', NULL),
(2, 'Pegawai', 'Pegawai', NULL, 'fa-users', NULL, 2, NULL, '2017-11-21 15:55:37', NULL, '2017-11-21 16:04:43', NULL),
(3, 'Jabatan', 'Jabatan', NULL, 'fa-black-tie', NULL, 3, NULL, '2017-11-21 15:56:17', NULL, '2017-11-21 16:04:43', NULL),
(4, 'Owner', 'Owner', NULL, 'fa-building', NULL, 4, NULL, '2017-11-21 16:00:38', NULL, '2017-11-21 16:04:45', NULL),
(5, 'Diagnosa', 'Diagnosa', NULL, 'fa-stethoscope', NULL, 5, NULL, '2017-11-21 16:06:32', NULL, '2017-11-21 16:06:58', NULL),
(6, 'Pasien', 'Pasien', NULL, 'fa-wheelchair', NULL, 6, NULL, '2017-11-21 16:07:33', NULL, '2017-11-21 16:07:33', NULL),
(7, 'PendaftaranPasien', 'Pendaftaran Pasien', NULL, 'fa-circle-o', NULL, 1, 6, '2017-11-21 16:08:15', NULL, '2017-11-21 16:08:15', NULL),
(8, 'PasienTerdaftar', 'Pasien Terdaftar', NULL, 'fa-circle-o', NULL, 2, 6, '2017-11-21 16:08:39', NULL, '2017-11-21 16:08:43', NULL),
(9, 'PasienBaru', 'Pasien Baru', NULL, 'fa-circle-o', NULL, 3, 6, '2017-11-21 16:09:52', NULL, '2017-11-21 16:09:59', NULL),
(10, 'Dokter', 'Dokter', NULL, 'fa-user-md', NULL, 7, NULL, '2017-11-21 16:10:24', NULL, '2017-11-21 16:10:24', NULL),
(11, 'Farmasi', 'Farmasi', NULL, 'fa-glass', NULL, 8, NULL, '2017-11-21 16:13:45', NULL, '2017-11-21 16:13:45', NULL),
(12, 'MasterObat', 'Master Obat', NULL, 'fa-circle-o', NULL, 1, 11, '2017-11-21 16:14:18', NULL, '2017-11-21 16:14:52', NULL),
(13, 'KategoriObat', 'Kategori Obat', NULL, 'fa-circle-o', NULL, 2, 11, '2017-11-21 16:14:40', NULL, '2017-11-21 16:14:53', NULL),
(14, 'Ledger', 'Ledger', NULL, 'fa-sort-numeric-asc', NULL, 9, NULL, '2017-11-21 16:15:15', NULL, '2017-11-21 16:15:15', NULL),
(15, 'Suplier', 'Suplier', NULL, 'fa-truck', NULL, 10, NULL, '2017-11-21 16:15:41', NULL, '2017-11-21 16:15:41', NULL),
(16, 'Menu', 'Menu', NULL, 'fa-list', NULL, 11, NULL, '2017-11-21 16:16:03', NULL, '2017-11-21 16:16:03', NULL),
(17, 'Layanan', 'Layanan', NULL, 'fa-heartbeat', NULL, 12, NULL, '2017-11-21 16:17:19', NULL, '2017-11-21 16:17:19', NULL),
(18, 'Kamar', 'Kamar', NULL, 'fa-hotel', NULL, 13, NULL, '2017-11-21 16:17:45', NULL, '2017-11-21 16:17:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(10) NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `stok` int(4) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `tanggal` varchar(15) NOT NULL,
  `expired` date NOT NULL,
  `terpakai` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `id_kategori`, `kode_obat`, `nama_obat`, `stok`, `satuan`, `tanggal`, `expired`, `terpakai`, `harga_beli`, `harga_jual`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(8, 20, '', 'Acyclovir 400 mg', 22, 'Tablet', '09/05/2016', '2017-11-06', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(9, 20, '', 'Allopurinol 100 mg', 20, 'Tablet', '09/05/2016', '2017-03-01', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(10, 20, '', 'Ambroxol 30 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(11, 20, '', 'Amlodipine 5 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(12, 20, '', 'Amlodipine 10 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(13, 20, '', 'Amoxicillin 500', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(14, 20, '', 'Antasida doen', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(15, 20, '', 'Asam Mefenamat 500', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(16, 20, '', 'Becefort', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(17, 20, '', 'Captopril 12,5 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(18, 20, '', 'Captopril 25 mg ', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(19, 20, '', 'Cefadroxil 500 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(20, 20, '', 'Chloramphenicl 250 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(21, 20, '', 'Ciprofloxacin 500 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(22, 20, '', 'Codein', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(23, 20, '', 'Cotrimoksazol', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(24, 20, '', 'CTM', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(25, 20, '', 'Dexanta', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(26, 20, '', 'Dextral', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(27, 20, '', 'DMP', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(28, 20, '', 'Dumin', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(29, 20, '', 'Elkana', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(30, 20, '', 'Extra-flu', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(31, 20, '', 'Fladex forte', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(32, 20, '', 'Forten 12.5 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(33, 20, '', 'Girabloc', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(34, 20, '', 'Grahabion', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(35, 20, '', 'Grathazon', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(36, 20, '', 'Hexavask 5 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(37, 20, '', 'Interhistin', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(38, 20, '', 'Kalk', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(39, 20, '', 'Kalmethason', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(40, 20, '', 'Ketokonazole', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(41, 20, '', 'Librocef 500', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(42, 20, '', 'Loratadine', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(43, 20, '', 'Meloxicam 7,5 mg', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(44, 20, '', 'Metoclopramide', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(45, 20, '', 'Molex flu', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(46, 20, '', 'Neurodex', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(47, 20, '', 'Neurovit E', 20, 'Tablet', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(48, 18, '', 'Actived flu & alergi pernafasan', 20, 'Syrup', '09/05/2016', '2018-07-29', 0, 17500, 25000, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(49, 18, '', 'Actived flu & batuk berdahak', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(50, 18, '', 'Actived flu & batuk kering', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(51, 18, '', 'Ambroxol ', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(52, 18, '', 'Amoxicillin 125 mg', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(53, 18, '', 'Antasida doen', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(54, 18, '', 'Chloramphenicol', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(55, 18, '', 'Citocetin', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(56, 18, '', 'Cotrimoxazole', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(57, 0, '', '', 0, '', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(58, 18, '', 'Mucera', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(59, 18, '', 'Neo Kaolana', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(60, 18, '', 'New Guanistrep', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(61, 18, '', 'OBH', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(62, 18, '', 'Paracetamol', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(63, 18, '', 'Sanmol', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(64, 18, '', 'Recovit', 20, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(65, 18, '', 'Tamanopan1', 201, 'Syrup', '09/05/2016', '0000-00-00', 0, 0, 0, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(69, 18, '', 'Ambroxol', 20, 'Syrup', '2017-11-20', '1212-12-22', 0, 2000, 2200, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL),
(70, 20, '', 'decolgen', 232, 'Tablet', '2017-11-20', '0000-00-00', 0, 3123121, 323123231, '2017-11-21 14:48:17', NULL, '2017-11-21 14:48:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(10) NOT NULL,
  `nama_owner` varchar(120) NOT NULL,
  `alamat_owner` text NOT NULL,
  `logo_owner` text NOT NULL,
  `no_telpon_owner` varchar(14) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `nama_owner`, `alamat_owner`, `logo_owner`, `no_telpon_owner`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(32, 'Nadra', 'Riung Bandung', 'gedung-sate-2.jpg', '087727111993', '2017-11-21 15:16:33', NULL, '2017-11-21 15:16:33', NULL),
(33, 'owner 3', 'jalanana', '', '08989898989', '2017-11-21 15:16:33', NULL, '2017-11-21 15:16:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(10) NOT NULL,
  `no_kartu` varchar(10) NOT NULL,
  `nip` varchar(40) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `istri` varchar(125) NOT NULL,
  `suami` varchar(125) NOT NULL,
  `umur` int(4) NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `no_askes` varchar(50) NOT NULL,
  `np_askes` varchar(100) NOT NULL,
  `unit_kerja` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(13) NOT NULL,
  `is_bpjs` int(1) DEFAULT NULL,
  `no_rekam_medik` varchar(11) NOT NULL,
  `pendidikan_pasien` varchar(128) NOT NULL,
  `status_antri` enum('periksa','obat','selesai','') DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_kartu`, `nip`, `nama_pasien`, `istri`, `suami`, `umur`, `tgl_lahir`, `agama`, `no_askes`, `np_askes`, `unit_kerja`, `alamat`, `telpon`, `is_bpjs`, `no_rekam_medik`, `pendidikan_pasien`, `status_antri`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(10, '001', '3273060507960005', 'Muhammad Thaufiq Umardi', '', '', 21, '05-07-1996', '', '0324238479', '23487394857394', 'asjdlfkj', 'sdfsdf', '0898989898989', NULL, '001', '', NULL, '2017-11-22 16:26:01', NULL, '2017-11-22 16:26:01', NULL),
(11, '002', '327292929928398', 'Mumun', '', '', 21, '09-08-1996', '', '0324238479', '74923472384', 'abccd', 'Jlanan', '0898989898989', NULL, '002', '', NULL, '2017-11-22 16:43:54', NULL, '2017-11-22 16:43:54', NULL),
(12, '003', '094203583495', 'Ujeng', '', '', 21, '09-08-1996', '', '0324238479', '23487394857394', 'asjdlfkj', 'dzvxcvxv', '0898989898989', NULL, '002', '', NULL, '2017-11-22 17:14:22', NULL, '2017-11-22 17:14:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `pegawai_id` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip_pegawai` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `mulai_bekerja` date NOT NULL,
  `jabatan_id` int(10) NOT NULL,
  `foto_pegawai` varchar(180) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `nama_pegawai`, `nip_pegawai`, `alamat`, `no_hp`, `mulai_bekerja`, `jabatan_id`, `foto_pegawai`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(9, 'Umardi Thaufiq', '12311231', 'Jlanajalan', '0898989898', '2016-11-30', 5, '', '2017-11-21 15:18:59', NULL, '2017-11-21 15:18:59', NULL),
(8, 'Thaufiq Umardi', '0000123', 'Jl. Jalan', '085723236512', '2017-07-08', 11, '', '2017-11-21 15:18:59', NULL, '2017-11-21 15:18:59', NULL),
(10, 'Nadra', '123456', 'Riung Bandung', '087727111993', '2016-09-11', 5, '', '2017-11-21 15:18:59', NULL, '2017-11-21 15:18:59', NULL),
(11, 'Thaufiq Umardi', '0000123', 'Alamat', '12345687', '0000-00-00', 12, '', '2017-11-21 15:18:59', NULL, '2017-11-21 15:18:59', NULL),
(12, 'Thaufiq', '12311231', 'jalajajaj', '0988798797', '2016-12-05', 11, '', '2017-11-21 15:18:59', NULL, '2017-11-21 15:18:59', NULL),
(13, 'Mamimumemomi', '329898098', 'Jljajajaja', '0851798659895', '2016-10-29', 6, '', '2017-11-21 15:18:59', NULL, '2017-11-21 15:18:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_kunjungan` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `biaya` int(11) NOT NULL,
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
-- Table structure for table `produsen_obat`
--

CREATE TABLE `produsen_obat` (
  `suplier_id` int(11) NOT NULL,
  `nama_sup` varchar(70) NOT NULL,
  `kode_sup` varchar(70) NOT NULL,
  `alamat_sup` text NOT NULL,
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
  `id_pasien` int(11) NOT NULL,
  `tgl_registrasi` varchar(10) NOT NULL,
  `jam_registrasi` varchar(8) NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `jenis_rawat` enum('RAWAT JALAN','RAWAT INAP') NOT NULL DEFAULT 'RAWAT JALAN',
  `jenis_pembayaran` enum('UMUM','BPJS') NOT NULL DEFAULT 'UMUM',
  `id_kamar` int(11) DEFAULT NULL,
  `status_registrasi` char(1) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrasi_pasien`
--

INSERT INTO `registrasi_pasien` (`id_registrasi`, `id_pasien`, `tgl_registrasi`, `jam_registrasi`, `no_antrian`, `jenis_rawat`, `jenis_pembayaran`, `id_kamar`, `status_registrasi`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(27, 12, '2017-11-22', '17:36:38', 3, 'RAWAT JALAN', 'BPJS', NULL, '0', '2017-11-22 17:36:38', 2, '2017-11-22 17:36:38', NULL),
(25, 10, '2017-11-22', '17:31:36', 1, 'RAWAT JALAN', 'UMUM', NULL, '0', '2017-11-22 17:31:36', 2, '2017-11-22 17:31:36', NULL),
(26, 11, '2017-11-22', '17:31:46', 2, 'RAWAT JALAN', 'BPJS', NULL, '0', '2017-11-22 17:31:46', 2, '2017-11-22 17:31:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medik_detail`
--

CREATE TABLE `rekam_medik_detail` (
  `rm_detail_id` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `tgl_persalinan` datetime NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `status_rawat` enum('Rawat Inap','Rawat Jalan') NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `tgl_keluar` datetime NOT NULL,
  `id_diagnosa_masuk` int(11) NOT NULL,
  `nama_diagnosa_masuk` varchar(75) NOT NULL,
  `id_diagnosa_akhir` int(11) NOT NULL,
  `nama_diagnosa_akhir` varchar(75) NOT NULL,
  `keadaan_keluar` enum('Sembuh','Perbaikan','Meninggal','Tidak Ada Perbaikan','Belum Terapi') NOT NULL,
  `catatan_keluar` varchar(125) NOT NULL,
  `cara_masuk` varchar(150) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekam_medik_detail`
--

INSERT INTO `rekam_medik_detail` (`rm_detail_id`, `id_layanan`, `tgl_persalinan`, `id_dokter`, `id_pasien`, `status_rawat`, `id_kamar`, `tgl_masuk`, `tgl_keluar`, `id_diagnosa_masuk`, `nama_diagnosa_masuk`, `id_diagnosa_akhir`, `nama_diagnosa_akhir`, `keadaan_keluar`, `catatan_keluar`, `cara_masuk`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(17, 1, '0000-00-00 00:00:00', 4, 3, 'Rawat Inap', 1, '2017-10-30 00:00:00', '2017-11-28 00:00:00', 4, '', 4, '', 'Tidak Ada Perbaikan', 'Diizinkan Pulang', 'Datang Sendiri', '2017-11-21 15:34:24', NULL, '2017-11-21 15:34:24', NULL),
(16, 10, '0000-00-00 00:00:00', 4, 1296, 'Rawat Inap', 1, '2017-11-30 00:00:00', '2017-12-31 00:00:00', 4, '', 3, '', 'Sembuh', 'Diizinkan Pulang', 'Datang Banyakan', '2017-11-21 15:34:24', NULL, '2017-11-21 15:34:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `menu` text NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `menu`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'owner', '', '2017-11-21 15:35:13', NULL, '2017-11-21 15:35:13', NULL),
(2, 'admin', 'a:1:{i:0;s:1:"3";}', '2017-11-21 15:35:13', NULL, '2017-11-21 15:35:13', NULL),
(3, 'Rekam Medik', '', '2017-11-21 15:35:13', NULL, '2017-11-21 15:35:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `nama_supplier` varchar(150) NOT NULL,
  `kode_supplier` varchar(100) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `no_telpon_supplier` varchar(12) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`id_diagnosa`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

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
-- Indexes for table `h_jual`
--
ALTER TABLE `h_jual`
  ADD PRIMARY KEY (`kodejual`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

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
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pegawai_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `rekam_medik_detail`
--
ALTER TABLE `rekam_medik_detail`
  ADD PRIMARY KEY (`rm_detail_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `id_diagnosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `d_jual`
--
ALTER TABLE `d_jual`
  MODIFY `idjual` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `pegawai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `produsen_obat`
--
ALTER TABLE `produsen_obat`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `registrasi_pasien`
--
ALTER TABLE `registrasi_pasien`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `rekam_medik_detail`
--
ALTER TABLE `rekam_medik_detail`
  MODIFY `rm_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
