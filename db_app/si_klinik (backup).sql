-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 Feb 2018 pada 05.15
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

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
-- Struktur dari tabel `admins`
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
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `level`, `role_id`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'operator', 2, '2017-11-21 14:49:15', NULL, '2017-11-21 14:49:15', NULL),
(2, 'owner', '72122ce96bfec66e2396d2e25225d70a', 'N', 1, '2017-11-21 14:49:15', NULL, '2017-11-21 14:49:15', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bed`
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
-- Dumping data untuk tabel `bed`
--

INSERT INTO `bed` (`id_bed`, `id_kamar`, `nama_bed`, `status_isi`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(19, 1, '1', 'Isi', 2, '2017-12-27 06:31:54', NULL, '2017-12-27 06:31:54'),
(16, 11, '2', 'Kosong', 2, '2017-12-27 06:25:40', 2, '2017-12-27 06:29:49'),
(18, 1, '2', 'Isi', 2, '2017-12-27 06:31:36', NULL, '2017-12-27 06:31:36'),
(15, 8, '2', 'ISI', 2, '2017-12-27 06:22:30', 2, '2018-01-04 03:40:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembiayaan`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `kd_dokter` varchar(8) DEFAULT NULL,
  `nama_dokter` varchar(40) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `tmp_lahir` varchar(15) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `gol_darah` enum('A','B','O','AB','-') DEFAULT NULL,
  `agama` varchar(12) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(20) DEFAULT NULL,
  `status_nikah` enum('Kawin','Belum Kawin','Janda','Duda') DEFAULT NULL,
  `alumni` varchar(60) DEFAULT NULL,
  `no_izin_praktek` varchar(20) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `kd_dokter`, `nama_dokter`, `jenis_kelamin`, `tmp_lahir`, `tgl_lahir`, `gol_darah`, `agama`, `alamat`, `telepon`, `status_nikah`, `alumni`, `no_izin_praktek`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, NULL, 'Dokter Test 1', 'Laki-Laki', 'Bandung', '1996-06-27', NULL, 'Islam', 'CIrebon', '898-9666-50__', 'Belum Kawin', NULL, '123', 'Aktif', '2018-02-02 01:27:20', 2, '2018-02-02 01:27:20', NULL),
(2, NULL, 'Dokter Test 2', 'Perempuan', 'Jakarta', '2018-02-23', NULL, 'Kristen', 'Jakarta', '892-9123-1331', 'Belum Kawin', NULL, '321', 'Aktif', '2018-02-02 01:28:01', 2, '2018-02-02 01:28:01', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `d_jual`
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
-- Struktur dari tabel `hak_akses`
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
-- Dumping data untuk tabel `hak_akses`
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
(44, 24, 69, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(45, 2, 70, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(46, 2, 52, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(47, 2, 71, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(48, 25, 1, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(49, 25, 70, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(50, 25, 33, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(51, 25, 28, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(52, 25, 3, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(53, 25, 26, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(54, 25, 11, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(55, 25, 7, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(56, 25, 31, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(57, 25, 38, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(58, 25, 27, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(59, 25, 16, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(60, 25, 15, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(61, 25, 2, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(62, 25, 14, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(63, 25, 71, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(64, 25, 37, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(65, 25, 13, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(66, 25, 32, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(67, 26, 1, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(68, 26, 7, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(69, 26, 16, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(70, 26, 15, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(71, 26, 2, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(72, 27, 3, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_obat`
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
-- Dumping data untuk tabel `harga_obat`
--

INSERT INTO `harga_obat` (`harga_obat_id`, `id_obat`, `harga_beli`, `harga_jual1`, `harga_jual2`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, '1000000.00', '10000.00', '0.00', 2, '2018-02-02 01:33:43', 2, '2018-02-02 01:34:23'),
(2, 2, '500000.00', '5000.00', '0.00', 2, '2018-02-02 01:33:57', NULL, '2018-02-02 01:33:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_jual`
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
-- Struktur dari tabel `kategori`
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
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Demam', '2018-02-02 01:29:04', 2, '2018-02-02 01:29:04', NULL),
(2, 'Batuk', '2018-02-02 01:29:10', 2, '2018-02-02 01:29:10', NULL),
(3, 'Batuk, Pilek', '2018-02-02 01:29:26', 2, '2018-02-02 01:29:26', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
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
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `name`, `title`, `url`, `icon`, `ref`, `urutan`, `parent`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Beranda', 'Beranda', 'beranda', 'fa-home', 'mnBeranda', 1, 0, '2017-11-21 15:55:08', NULL, '2017-11-26 20:39:05', NULL),
(7, 'MasterPasien', 'Master Pasien', '#', 'fa-wheelchair', 'mnMasterPasien', 4, 0, '2017-11-21 16:07:33', NULL, '2018-01-27 20:11:30', 2),
(11, 'MasterObat', 'Master Obat dan Alkes', '#', 'fa-glass', 'mnMasterObat', 4, 0, '2017-11-21 16:13:45', NULL, '2018-02-02 01:30:47', 2),
(13, 'Supplier', 'Supplier', 'suplier', 'fa-truck', 'mnSupplier', 3, 0, '2017-11-21 16:14:40', NULL, '2018-02-02 01:30:31', 2),
(14, 'Pengaturan', 'Pengaturan', '#', 'fa-cog', 'mnPengaturan', 13, 0, '2017-11-21 16:15:15', NULL, '2017-12-08 07:43:33', NULL),
(15, 'TambahPasien', 'Pendaftaran Baru', 'pasien/form', 'fa-vcard-o', 'mnTambahPasien', 5, 0, '2017-11-21 16:15:41', NULL, '2018-01-27 20:11:43', 2),
(16, 'DataPasien', 'Pasien Terdaftar', 'pasien', 'fa-circle-o', 'mnPasienTerdaftar', 2, 7, '2017-11-21 16:16:03', NULL, '2017-11-26 08:46:43', NULL),
(2, 'PendaftaranPasien', 'Pendaftaran Pemeriksaan', 'pendaftaran_pasien', 'fa-plus', 'mnPendaftaranPasien', 6, 0, '2017-11-21 15:55:08', NULL, '2018-01-27 20:11:51', 2),
(3, 'Kasir', 'Kasir', 'kasir', 'fa-shopping-cart', 'mnKasir', 8, 0, '2017-11-21 15:55:08', NULL, '2018-01-27 20:12:24', 2),
(71, 'rekammedik', 'Rekam Medik', 'rekammedik', 'fa-stethoscope', 'mnrekammedik', 7, 0, '2018-01-28 22:47:46', NULL, '2018-01-28 22:51:10', 2),
(6, 'Keuangan', 'Keuangan', '#', 'fa-money', 'mnKeuangan', 10, NULL, '2017-11-21 15:55:08', NULL, '2018-02-02 01:16:36', 2),
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
(70, 'dokter', 'Dokter', 'dokter', 'fa-black-tie', 'dokter', 2, 0, '2018-01-27 20:01:24', NULL, '2018-02-02 01:31:08', 2),
(52, 'AntrianPasien', 'Antrian Pasien', 'antrianpasien', 'fa-circle-o', 'mnAntrianPasien', 1, 4, '2018-01-03 02:11:34', NULL, '2018-01-03 02:11:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
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
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`merk_id`, `merk_nama`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Mixagrip', 2, '2018-02-02 01:28:47', NULL, '2018-02-02 01:28:47'),
(2, 'Sanaflu', 2, '2018-02-02 01:28:55', NULL, '2018-02-02 01:28:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
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
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `id_kategori`, `id_satuan`, `id_merk`, `id_supplier`, `kode_obat`, `nama_obat`, `stok`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 3, 2, 1, 2, 'KD0001', 'Mixagrip', 17, '2018-02-02 01:33:04', 2, '2018-02-02 02:17:08', NULL),
(2, 1, 1, 2, 1, 'KD0002', 'Sanaflu', 48, '2018-02-02 01:33:25', 2, '2018-02-02 01:44:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `owner`
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
-- Dumping data untuk tabel `owner`
--

INSERT INTO `owner` (`owner_id`, `nama_owner`, `alamat_owner`, `logo_owner`, `no_telpon_owner`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Jasa Prima', '', '', '087727111993', '2017-11-21 15:16:33', NULL, '2018-02-02 00:42:14', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `no_rm` varchar(8) DEFAULT '0',
  `no_kartu` varchar(8) DEFAULT '0',
  `nama_pasien` varchar(125) DEFAULT NULL,
  `nik_pasien` varchar(16) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `umur` int(2) NOT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `pekerjaan_pasien` varchar(120) DEFAULT NULL,
  `gol_darah` enum('A','B','AB','O') DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `no_telp_rumah` varchar(20) DEFAULT NULL,
  `no_handphone` varchar(20) DEFAULT NULL,
  `jalan` varchar(75) DEFAULT NULL,
  `rtrw` varchar(7) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `status_pasien` enum('LAMA','BARU') DEFAULT 'BARU',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_rm`, `no_kartu`, `nama_pasien`, `nik_pasien`, `tempat_lahir`, `tgl_lahir`, `umur`, `agama`, `pekerjaan_pasien`, `gol_darah`, `jenis_kelamin`, `no_telp_rumah`, `no_handphone`, `jalan`, `rtrw`, `kelurahan`, `kecamatan`, `kota`, `status_pasien`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '18000001', '00000001', 'Pasien Test 1', '231231312312', 'Bandung', '2010-07-15', 8, 'Islam', 'Mahasiswa', 'AB', 'Laki-Laki', '', '', 'adadad', '04/04', 'Pasirkaliki', 'CIcendo', 'Bandung', 'BARU', '2018-02-02 01:36:43', 2, '2018-02-02 01:36:43', NULL),
(2, '18000002', '00000002', 'Pasien Test 2', '34343', 'Jakarta', '1996-03-06', 22, 'Hindu', 'Mahasiswa', 'B', 'Perempuan', '', '', 'asdas', '02/02', 'pasir impun', 'gorogoro', 'CIrebon', 'BARU', '2018-02-02 01:37:52', 2, '2018-02-02 01:37:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `pemasukan_id` int(11) NOT NULL,
  `no_kuitansi` varchar(12) DEFAULT NULL,
  `no_registrasi` varchar(10) DEFAULT NULL,
  `tgl_pemasukan` datetime DEFAULT CURRENT_TIMESTAMP,
  `nama_pemasukan` varchar(100) DEFAULT NULL,
  `jenis_pemasukan` enum('Pendaftaran','Layanan','Obat','Lain-Lain','Paket') DEFAULT NULL,
  `harga_pemasukan` decimal(10,2) DEFAULT NULL,
  `qty_pemasukan` decimal(10,2) DEFAULT NULL,
  `total_pemasukan` decimal(10,2) DEFAULT NULL,
  `uang_bayar` decimal(10,2) NOT NULL,
  `uang_kembalian` decimal(10,2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`pemasukan_id`, `no_kuitansi`, `no_registrasi`, `tgl_pemasukan`, `nama_pemasukan`, `jenis_pemasukan`, `harga_pemasukan`, `qty_pemasukan`, `total_pemasukan`, `uang_bayar`, `uang_kembalian`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '00000001', NULL, '2018-02-02 01:45:12', 'Transaksi Obat Apotek', 'Obat', '30000.00', '1.00', '30000.00', '40000.00', '10000.00', 2, '2018-02-02 01:45:12', NULL, '2018-02-02 01:45:12'),
(2, '00000002', NULL, '2018-02-02 01:46:31', 'Transaksi Obat Apotek', 'Obat', '200000.00', '1.00', '200000.00', '300000.00', '100000.00', 2, '2018-02-02 01:46:31', NULL, '2018-02-02 01:46:31'),
(3, '00000003', NULL, '2018-02-02 02:17:14', 'Transaksi Obat Apotek', 'Obat', '10000.00', '1.00', '10000.00', '20000.00', '10000.00', 2, '2018-02-02 02:17:14', NULL, '2018-02-02 02:17:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
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
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_kunjungan`, `waktu`, `biaya`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(3, 13, '2016-08-08', 4000000, '2017-11-21 15:19:51', NULL, '2017-11-21 15:19:51', NULL),
(4, 14, '2016-08-08', 4000000, '2017-11-21 15:19:51', NULL, '2017-11-21 15:19:51', NULL),
(5, 15, '2016-08-08', 20000, '2017-11-21 15:19:51', NULL, '2017-11-21 15:19:51', NULL),
(7, 16, '2016-12-06', 30000, '2017-11-21 15:19:51', NULL, '2017-11-21 15:19:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penanggung_pasien`
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
-- Dumping data untuk tabel `penanggung_pasien`
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
(23, 40, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-08 22:01:42', 90, '2018-01-08 22:01:42', NULL),
(24, 41, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-27 20:26:59', 2, '2018-01-27 20:26:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `piutang`
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
-- Dumping data untuk tabel `piutang`
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
-- Struktur dari tabel `produsen_obat`
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
-- Dumping data untuk tabel `produsen_obat`
--

INSERT INTO `produsen_obat` (`suplier_id`, `nama_sup`, `kode_sup`, `alamat_sup`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Kimia Farma', 'A0001', 'Jl Burangrang no.7 Bandung', '2017-11-21 15:31:24', NULL, '2017-11-21 15:31:24', NULL),
(2, 'Biofarma', 'A0002', 'Jl Pasteur', '2017-11-21 15:31:24', NULL, '2017-11-21 15:31:24', NULL),
(5, '3232', 'lala', 'jakarta\r\n', '2017-11-21 15:31:24', NULL, '2017-11-21 15:31:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi_pasien`
--

CREATE TABLE `registrasi_pasien` (
  `id_registrasi` int(11) NOT NULL,
  `no_registrasi` int(11) NOT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `tgl_registrasi` date DEFAULT NULL,
  `jam_registrasi` time DEFAULT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `status_registrasi` char(1) DEFAULT '0',
  `status_antrian` char(1) DEFAULT '0',
  `status_pembayaran` char(1) NOT NULL,
  `play_sound` char(1) DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `registrasi_pasien`
--

INSERT INTO `registrasi_pasien` (`id_registrasi`, `no_registrasi`, `id_dokter`, `id_pasien`, `tgl_registrasi`, `jam_registrasi`, `no_antrian`, `status_registrasi`, `status_antrian`, `status_pembayaran`, `play_sound`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1801300001, 7, 1, '2018-01-30', '22:32:18', 1, '0', '1', '', '0', '2018-01-30 22:32:18', NULL, '2018-01-30 22:35:37', NULL),
(2, 1802010001, 5, 1, '2018-02-01', '22:45:26', 1, '0', '0', '', '0', '2018-02-01 22:45:26', NULL, '2018-02-01 22:45:26', NULL),
(3, 1802010002, 5, 2, '2018-02-01', '22:46:55', 2, '0', '0', '', '0', '2018-02-01 22:46:55', NULL, '2018-02-01 22:46:55', NULL),
(4, 1802020001, 1, 1, '2018-02-02', '01:36:57', 1, '0', '1', '', '0', '2018-02-02 01:36:57', NULL, '2018-02-02 01:38:15', NULL),
(5, 1802020002, 2, 2, '2018-02-02', '01:38:08', 2, '0', '1', '', '0', '2018-02-02 01:38:08', NULL, '2018-02-02 01:40:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medik`
--

CREATE TABLE `rekam_medik` (
  `id_rekam_medik` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tgl_rekam_medik` date NOT NULL,
  `keluhan` text NOT NULL,
  `anamnesa` text NOT NULL,
  `diagnosa` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekam_medik`
--

INSERT INTO `rekam_medik` (`id_rekam_medik`, `id_pasien`, `id_dokter`, `tgl_rekam_medik`, `keluhan`, `anamnesa`, `diagnosa`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 37, 5, '2018-01-30', '', '', 'asdf', '2018-01-30 12:59:13', 0, '2018-01-30 12:59:13', 0),
(17, 39, 7, '2018-01-31', '', '', 'asdfasdf', '2018-01-31 13:24:35', 0, '2018-01-31 13:24:35', 0),
(18, 39, 7, '2018-01-31', '', '', '1231231', '2018-01-31 13:24:41', 0, '2018-01-31 13:24:41', 0),
(19, 39, 7, '2018-01-31', '', '', 'xzxcxc', '2018-01-31 13:24:56', 0, '2018-01-31 13:24:56', 0),
(21, 46, 7, '2018-01-31', '', '', 'jl', '2018-01-31 14:33:25', 0, '2018-01-31 14:33:25', 0),
(24, 1, 7, '2018-01-30', '', '', 'kkkk', '2018-01-30 15:36:48', 0, '2018-01-30 15:36:48', 0),
(25, 1, 1, '2018-02-02', '', '', 'Maag', '2018-02-01 18:39:49', 0, '2018-02-01 18:39:49', 0),
(27, 2, 2, '2018-02-02', '', '', 'Patah Tulang', '2018-02-01 18:40:50', 0, '2018-02-01 18:40:50', 0),
(28, 1, 1, '2018-02-05', '', '', 'liper', '2018-02-05 12:47:04', 0, '2018-02-05 12:47:04', 0),
(30, 2, 2, '2018-02-06', 'pusing', 'sangat pusing', 'pusing sekali', '2018-02-06 09:10:07', 0, '2018-02-06 09:10:07', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rm_resep`
--

CREATE TABLE `rm_resep` (
  `id_resep` int(11) NOT NULL,
  `id_obat` int(10) NOT NULL,
  `id_registrasi` int(11) NOT NULL,
  `no_registrasi` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `qty_resep` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
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
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 'Admin', '2017-11-21 15:35:13', NULL, '2018-02-02 01:11:59', 2),
(1, 'Super Admin', '2017-11-23 13:43:25', NULL, '2017-11-23 13:43:25', NULL),
(27, 'Kasir', '2018-02-02 01:52:57', 2, '2018-02-02 01:52:57', NULL),
(26, 'Pendaftaran', '2018-02-02 01:49:04', 2, '2018-02-02 01:49:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
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
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`satuan_id`, `satuan_nama`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Tablet', 2, '2018-02-02 01:28:25', NULL, '2018-02-02 01:28:25'),
(2, 'Pcs', 2, '2018-02-02 01:28:35', NULL, '2018-02-02 01:28:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
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
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `nama_supplier`, `kode_supplier`, `alamat_supplier`, `no_telpon_supplier`, `contact_person`, `no_telp_cp`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Kimia Farma', NULL, 'Pasteur', '0821313', 'Aang', NULL, '2018-02-02 01:31:51', 2, '2018-02-02 01:31:51', NULL),
(2, 'Biofarma', NULL, 'Cihampelas', '0123123', 'Maman', NULL, '2018-02-02 01:32:24', 2, '2018-02-02 01:32:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_kasir`
--

CREATE TABLE `transaksi_kasir` (
  `id_transaksi` int(11) NOT NULL,
  `no_kuitansi` varchar(18) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `harga_barang` decimal(10,2) NOT NULL,
  `qty_barang` int(3) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_kasir`
--

INSERT INTO `transaksi_kasir` (`id_transaksi`, `no_kuitansi`, `id_barang`, `id_satuan`, `harga_barang`, `qty_barang`, `total_harga`, `created_by`, `created_at`) VALUES
(1, '00000001', 1, 2, '10000.00', 2, '20000.00', 0, '2018-02-02 01:44:10'),
(2, '00000001', 2, 1, '5000.00', 2, '10000.00', 0, '2018-02-02 01:44:46'),
(5, '00000003', 1, 2, '10000.00', 1, '10000.00', 0, '2018-02-02 02:17:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `is_admin`, `role_id`, `username`, `password`, `user_photo`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 1, 2, 'admin', 'f36beb89ac5e7a861e74aecbbf7a3ff467d1cd5cd07bf47e593364f8e34c35c0c846595ba432de70bc793d275de8d0da3a2a4081f43fbfe055075bbbc0c43c15', '1513246611.png', 'Aktif', '2017-11-25 23:25:47', NULL, '2018-02-02 01:12:50', 2),
(94, 0, 26, 'admin daftar', 'c172312aa567eaa1f57b2c29601ae9bf4a2562aafb51b844faa71f601552a7fce33a664849bfed5ebbbe2d0b04d5ada875a15e9d5d7549977f59d2ff4ba35323', NULL, 'Aktif', '2018-02-02 01:52:00', 2, '2018-02-02 01:52:00', NULL),
(95, 0, 27, 'admin kasir', 'a50e52dcaa3104a84de41324549cca89b8989ea6a2a0389fe7138d8c24ae43d7f7f802ddbc19fa9fcbd4259c297c7034147be2b212b629e1ee204161cb4c23a4', NULL, 'Aktif', '2018-02-02 01:54:15', 2, '2018-02-02 01:54:15', NULL);

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
-- Indexes for table `rekam_medik`
--
ALTER TABLE `rekam_medik`
  ADD PRIMARY KEY (`id_rekam_medik`);

--
-- Indexes for table `rm_resep`
--
ALTER TABLE `rm_resep`
  ADD PRIMARY KEY (`id_resep`);

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
-- Indexes for table `transaksi_kasir`
--
ALTER TABLE `transaksi_kasir`
  ADD PRIMARY KEY (`id_transaksi`);

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
  MODIFY `id_pembiayaan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `d_jual`
--
ALTER TABLE `d_jual`
  MODIFY `idjual` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `harga_obat`
--
ALTER TABLE `harga_obat`
  MODIFY `harga_obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `pemasukan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `penanggung_pasien`
--
ALTER TABLE `penanggung_pasien`
  MODIFY `id_penanggung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rekam_medik`
--
ALTER TABLE `rekam_medik`
  MODIFY `id_rekam_medik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `rm_resep`
--
ALTER TABLE `rm_resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi_kasir`
--
ALTER TABLE `transaksi_kasir`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
