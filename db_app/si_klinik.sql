-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 Feb 2018 pada 18.32
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

--
-- Dumping data untuk tabel `detail_pembiayaan`
--

INSERT INTO `detail_pembiayaan` (`id_pembiayaan`, `id_registrasi`, `no_registrasi`, `tgl_registrasi`, `nama_item`, `jenis_item`, `item_id`, `harga`, `qty`, `total_harga`, `status_bayar`, `satuan`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, '1802190001', '2018-02-19 00:00:00', 'Biaya Pendaftaran', 'Pendaftaran', 0, '10000.00', '1.00', '10000.00', '1', NULL, NULL, '2018-02-18 17:05:17', NULL, '2018-02-18 17:14:46'),
(2, 1, NULL, NULL, 'Inzana Anak', 'Obat', 2, '1000.00', '3.00', '3000.00', '1', NULL, NULL, '2018-02-18 17:13:02', NULL, '2018-02-18 17:14:46');

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
(1, NULL, 'dr. Agus Salim', 'Laki-Laki', 'Bandung', '1989-07-20', NULL, 'Islam', 'Jalan Pajajran Gg.Kina', '823-2931-3133', 'Kawin', NULL, '312564', 'Aktif', '2018-02-18 23:59:17', 2, '2018-02-18 23:59:17', NULL),
(2, NULL, 'dr. ade', 'Laki-Laki', 'Jakarta', '1989-02-21', NULL, 'Islam', 'adada', '913-1233-1312', 'Belum Kawin', NULL, '13123', 'Aktif', '2018-02-19 00:00:08', 2, '2018-02-19 00:00:08', NULL);

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
(1, 2, 1, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(2, 2, 14, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(3, 2, 36, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(4, 2, 52, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(5, 2, 70, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(6, 2, 3, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(7, 2, 15, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(8, 26, 7, 0, 1, 0, 0, 1, NULL, NULL, 2, NULL),
(9, 26, 16, 0, 1, 0, 0, 1, NULL, NULL, 2, NULL),
(10, 26, 15, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(11, 26, 2, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(12, 28, 73, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(13, 28, 71, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(14, 27, 3, 1, 1, 1, 1, 1, NULL, NULL, 2, NULL),
(15, 28, 1, 0, 1, 0, 0, 1, NULL, NULL, 2, NULL),
(16, 27, 1, 0, 1, 0, 0, 1, NULL, NULL, 2, NULL),
(17, 26, 1, 0, 1, 0, 0, 1, NULL, NULL, 2, NULL);

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
(1, 1, '5000000.00', '12500.00', '0.00', 2, '2018-02-19 00:03:55', NULL, '2018-02-19 00:03:55'),
(2, 2, '1000000.00', '1000.00', '0.00', 2, '2018-02-19 00:04:07', NULL, '2018-02-19 00:04:07');

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
(1, 'Vitamin', '2018-02-19 00:02:41', 2, '2018-02-19 00:02:41', NULL),
(2, 'Demam', '2018-02-19 00:02:46', 2, '2018-02-19 00:02:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(128) NOT NULL,
  `tarif_layanan` decimal(10,2) NOT NULL,
  `tarif_khusus` decimal(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `tarif_layanan`, `tarif_khusus`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Suntik', '20000.00', '0.00', 2, '2018-02-19 00:01:49', 0, '2018-02-19 00:01:49'),
(2, 'Oksigen', '5000.00', '0.00', 2, '2018-02-19 00:02:01', 0, '2018-02-19 00:02:01');

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
(71, 'rekammedik', 'Rekammedik', 'rekammedik', 'fa-list-alt', 'mnrekammedik', 7, 0, '2018-01-28 22:47:46', NULL, '2018-02-08 20:53:05', 2),
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
(52, 'AntrianPasien', 'Antrian Pasien', 'antrianpasien', 'fa-circle-o', 'mnAntrianPasien', 1, 4, '2018-01-03 02:11:34', NULL, '2018-01-03 02:11:34', NULL),
(72, 'layanan', 'Layanan', 'layanan', 'fa-medkit', 'mnLayanan', 6, 0, '2018-02-08 15:57:29', NULL, '2018-02-14 13:42:39', 2),
(73, 'pemeriksaan', 'Pemeriksaan', 'pemeriksaan', 'fa-stethoscope', 'mnPemeriksaan', 6, 0, '2018-02-08 20:50:34', NULL, '2018-02-08 20:51:58', 2);

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
(1, 'Inzana', 2, '2018-02-19 00:02:25', NULL, '2018-02-19 00:02:25'),
(2, 'Cerebrovit', 2, '2018-02-19 00:02:31', NULL, '2018-02-19 00:02:31');

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
(1, 1, 1, 2, 2, 'kd001', 'Cerebrovit grow', 20, '2018-02-19 00:03:15', 2, '2018-02-19 00:03:15', NULL),
(2, 2, 2, 1, 1, 'kd002', 'Inzana Anak', 27, '2018-02-19 00:03:37', 2, '2018-02-19 00:14:46', NULL);

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
(1, 'Prima Jasa', 'Jl. Pilang Raya No. 100 ', '', '087727111993', '2017-11-21 15:16:33', NULL, '2018-02-08 14:17:40', 96);

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
(1, '18000001', '00000001', 'Muhammad Thaufiq ', '3273060507960005', 'Cilacap', '1996-07-05', 22, 'Islam', 'Pengangguran', 'O', 'Laki-Laki', '', '857-2323-6512', 'Jl. Dr Abdul Rivai ', '03/03', 'Pasirkaliki', 'Cicendo', 'Bandung', 'BARU', '2018-02-18 23:56:57', 100, '2018-02-18 23:56:57', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `pemasukan_id` int(11) NOT NULL,
  `no_kuitansi` varchar(12) DEFAULT NULL,
  `id_registrasi` int(11) DEFAULT NULL,
  `no_registrasi` varchar(10) DEFAULT NULL,
  `tgl_pemasukan` datetime DEFAULT CURRENT_TIMESTAMP,
  `nama_pemasukan` varchar(100) DEFAULT NULL,
  `jenis_pemasukan` enum('Pendaftaran','Layanan','Obat','Lain-Lain','Pasien Berobat') DEFAULT NULL,
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

INSERT INTO `pemasukan` (`pemasukan_id`, `no_kuitansi`, `id_registrasi`, `no_registrasi`, `tgl_pemasukan`, `nama_pemasukan`, `jenis_pemasukan`, `harga_pemasukan`, `qty_pemasukan`, `total_pemasukan`, `uang_bayar`, `uang_kembalian`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '00000001', 1, NULL, '2018-02-19 00:14:46', 'Pasien Berobat', 'Pasien Berobat', '13000.00', '1.00', '13000.00', '15000.00', '2000.00', 102, '2018-02-19 00:14:46', NULL, '2018-02-19 00:14:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id_pemeriksaan` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_registrasi` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tgl_pemeriksaan` date NOT NULL,
  `tensi` varchar(8) DEFAULT NULL,
  `berat_badan` int(3) DEFAULT NULL,
  `tinggi_badan` int(3) DEFAULT NULL,
  `keluhan` text NOT NULL,
  `anamnesa` text NOT NULL,
  `diagnosa` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id_pemeriksaan`, `id_pasien`, `id_registrasi`, `id_dokter`, `tgl_pemeriksaan`, `tensi`, `berat_badan`, `tinggi_badan`, `keluhan`, `anamnesa`, `diagnosa`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, '2018-02-19', '180/30', 75, 130, 'sakit perut', 'cairan lambung', 'maag', '2018-02-18 17:12:45', 0, '2018-02-18 17:12:45', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan_resep`
--

CREATE TABLE `pemeriksaan_resep` (
  `id_pemeriksaan_resep` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_registrasi` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tgl_pemeriksaan` date NOT NULL,
  `id_obat` int(11) NOT NULL,
  `qty_obat` decimal(10,0) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemeriksaan_resep`
--

INSERT INTO `pemeriksaan_resep` (`id_pemeriksaan_resep`, `id_pasien`, `id_registrasi`, `id_dokter`, `tgl_pemeriksaan`, `id_obat`, `qty_obat`, `id_satuan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 1, 1, '2018-02-19', 2, '3', 2, '2018-02-18 17:13:02', 101, '2018-02-18 17:13:02', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan_tindakan`
--

CREATE TABLE `pemeriksaan_tindakan` (
  `id_pemeriksaan_tindakan` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_registrasi` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tgl_pemeriksaan` date NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status_bayar` tinyint(1) DEFAULT '0',
  `play_sound` char(1) DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `registrasi_pasien`
--

INSERT INTO `registrasi_pasien` (`id_registrasi`, `no_registrasi`, `id_dokter`, `id_pasien`, `tgl_registrasi`, `jam_registrasi`, `no_antrian`, `status_registrasi`, `status_antrian`, `status_bayar`, `play_sound`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1802190001, 1, 1, '2018-02-19', '00:05:17', 1, '0', '1', 1, '0', '2018-02-19 00:05:17', NULL, '2018-02-19 00:14:46', NULL);

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
(26, 'Pendaftaran', '2018-02-02 01:49:04', 2, '2018-02-02 01:49:04', NULL),
(28, 'Dokter', '2018-02-18 23:48:02', 2, '2018-02-18 23:48:02', NULL);

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
(1, 'Botol', 2, '2018-02-19 00:02:10', NULL, '2018-02-19 00:02:10'),
(2, 'Tablet', 2, '2018-02-19 00:02:17', NULL, '2018-02-19 00:02:17');

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
(1, 'Kimia Farma', NULL, 'cihampelas', '0222343434', 'usep  cahyat', NULL, '2018-02-19 00:00:40', 2, '2018-02-19 00:00:40', NULL),
(2, 'Biofarma', NULL, 'paster', '123121', 'cahyat usep', NULL, '2018-02-19 00:01:02', 2, '2018-02-19 00:01:02', NULL);

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `role_id` int(11) DEFAULT '0',
  `name` varchar(128) NOT NULL,
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

INSERT INTO `users` (`user_id`, `is_admin`, `role_id`, `name`, `username`, `password`, `user_photo`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 1, 2, 'Developer', 'SuperAdmin', 'f36beb89ac5e7a861e74aecbbf7a3ff467d1cd5cd07bf47e593364f8e34c35c0c846595ba432de70bc793d275de8d0da3a2a4081f43fbfe055075bbbc0c43c15', '1513246611.png', 'Aktif', '2017-11-25 23:25:47', NULL, '2018-02-08 15:34:00', 2),
(100, 0, 26, 'Hasanudin MZ', 'Hasan', '59558a01a08474d399b33fd724f0cbfbef862791af10c28eae885a5200b3c9646d6ec798f8178ff864ca6dbae4a8d25daf2beba9c8672dff7eab9b70b993011b', NULL, 'Aktif', '2018-02-18 23:53:41', 2, '2018-02-18 23:53:41', NULL),
(101, 0, 28, 'dr. Agus Salim', 'agus', '59558a01a08474d399b33fd724f0cbfbef862791af10c28eae885a5200b3c9646d6ec798f8178ff864ca6dbae4a8d25daf2beba9c8672dff7eab9b70b993011b', NULL, 'Aktif', '2018-02-18 23:54:19', 2, '2018-02-18 23:54:19', NULL),
(102, 0, 27, 'Kusirudin', 'kusir', '59558a01a08474d399b33fd724f0cbfbef862791af10c28eae885a5200b3c9646d6ec798f8178ff864ca6dbae4a8d25daf2beba9c8672dff7eab9b70b993011b', NULL, 'Aktif', '2018-02-18 23:54:43', 2, '2018-02-18 23:54:43', NULL),
(103, 0, 2, 'Admin', 'admin', '59558a01a08474d399b33fd724f0cbfbef862791af10c28eae885a5200b3c9646d6ec798f8178ff864ca6dbae4a8d25daf2beba9c8672dff7eab9b70b993011b', NULL, 'Aktif', '2018-02-19 00:16:53', 2, '2018-02-19 00:16:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

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
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`);

--
-- Indexes for table `pemeriksaan_resep`
--
ALTER TABLE `pemeriksaan_resep`
  ADD PRIMARY KEY (`id_pemeriksaan_resep`);

--
-- Indexes for table `pemeriksaan_tindakan`
--
ALTER TABLE `pemeriksaan_tindakan`
  ADD PRIMARY KEY (`id_pemeriksaan_tindakan`);

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
-- AUTO_INCREMENT for table `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  MODIFY `id_pembiayaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `harga_obat`
--
ALTER TABLE `harga_obat`
  MODIFY `harga_obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
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
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `pemasukan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pemeriksaan_resep`
--
ALTER TABLE `pemeriksaan_resep`
  MODIFY `id_pemeriksaan_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pemeriksaan_tindakan`
--
ALTER TABLE `pemeriksaan_tindakan`
  MODIFY `id_pemeriksaan_tindakan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produsen_obat`
--
ALTER TABLE `produsen_obat`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registrasi_pasien`
--
ALTER TABLE `registrasi_pasien`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
