<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Login';
$route['translate_uri_dashes'] = FALSE;
$route['404_override'] = 'Myerror';
$route['antrian']='Antrian';
$route['antrianpasien']='Antrian/antrianpasien';

/* BERANDA */
$route['beranda']="Master/home";
/* BERANDA */

/* PENDAFTARAN PASIEN */
$route['pendaftaran_pasien']='Pasien/pendaftaran_pasien';
/* PENDAFTARAN PASIEN */

/* BERANDA */
$route['kasir']="Kasir";
$route['kasir/cetak']='Kasir/cetak';
/* BERANDA */

/* PEMERIKSAAN */
$route['pemeriksaan']='Pemeriksaan';
$route['pemeriksaan/add_pemeriksaan']='Pemeriksaan/add_pemeriksaan';
$route['pemeriksaan/update/(:any)']='Pemeriksaan/update/$1';
$route['pemeriksaan/edit/(:any)']='Pemeriksaan/edit/$1';
$route['pemeriksaan/cetak']='Pemeriksaan/cetak';
$route['pemeriksaan/doexport']='Pemeriksaan/doexport';
/* PEMERIKSAAN */

/* KEUANGAN */
$route['ledger']='Ledger';
$route['ledger/add']='Ledger/add';
$route['ledger/update/(:any)']='Ledger/update/$1';
$route['ledger/edit/(:any)']='Ledger/edit/$1';
$route['ledger/cetak']='Ledger/cetak';
$route['ledger/doexport']='Ledger/doexport';
$route['keuangan/datapengeluaran']='Keuangan/datapengeluaran';
$route['keuangan/add_pengeluaran']='Keuangan/add_pengeluaran';
$route['keuangan/update_pengeluaran/(:any)']='Keuangan/update_pengeluaran/$1';
$route['keuangan/edit_pengeluaran/(:any)']='Keuangan/edit_pengeluaran/$1';
$route['keuangan/cetak_pengeluaran']='Keuangan/cetak_pengeluaran';
$route['keuangan/doexport_pengeluaran']='Keuangan/doexport_pengeluaran';
$route['keuangan/cetak_datapengeluaran']='Keuangan/cetak_datapengeluaran';
$route['keuangan/laporanpendapatan']='Keuangan/laporanpendapatan';
$route['keuangan/cetak_laporanpendapatan']='Keuangan/cetak_laporanpendapatan';
$route['keuangan/laporanpengeluaran']='Keuangan/laporanpengeluaran';
$route['keuangan/cetak_laporanpengeluaran']='Keuangan/cetak_laporanpengeluaran';
$route['keuangan/pembayaranpasien']='Keuangan/pembayaranpasien';
$route['keuangan/cetak_laporanpembayaranpasien']='Keuangan/cetak_laporanpembayaranpasien';
$route['keuangan/laporanpiutang']='Keuangan/laporanpiutang';
$route['keuangan/cetak_laporanpiutang']='Keuangan/cetak_laporanpiutang';
$route['keuangan/laporanlabarugi']='Keuangan/laporanlabarugi';
$route['keuangan/cetak_laporanlabarugi']='Keuangan/cetak_laporanlabarugi';
$route['keuangan/jurnalpendapatan']='Keuangan/jurnalpendapatan';
$route['keuangan/cetak_laporanjurnalpendapatan']='Keuangan/cetak_laporanjurnalpendapatan';
$route['keuangan/jurnalpengeluaran']='Keuangan/jurnalpengeluaran';
$route['keuangan/cetak_laporanjurnalpengeluaran']='Keuangan/cetak_laporanjurnalpengeluaran';
/* KEUANGAN */

/* MASTER PASIEN */
$route['pasien/antrian/(:any)']='Pasien/antrian/$1';
$route['pasien/hapus/(:any)']='Pasien/hapus/$1';
$route['pasien/update_pasien/(:any)']='Pasien/update_pasien/$1';
$route['pasien/edit/(:any)']='Pasien/edit/$1';
$route['pasien/form']='Pasien/form';
$route['pasien/antrian']='Pasien/antrian';
$route['pasien/(:any)']='Pasien/index/$1';
$route['pasien']='Pasien';
$route['pasien/tambah']='Pasien/form';
$route['pasien/cetak']='Pasien/cetak';
$route['pasien/doexport']='Pasien/doexport';
$route['pasien/cetak_detail/(:any)']='Pasien/cetak_detail/$1';
/* MASTER PASIEN */

/* MASTER PEGAWAI */
$route['jabatan']='Jabatan';
$route['jabatan/add_kamar']='Jabatan/add_jabatan';
$route['jabatan/update/(:any)']='Jabatan/update/$1';
$route['jabatan/edit/(:any)']='Jabatan/edit/$1';
$route['jabatan/cetak']='Jabatan/cetak';
$route['jabatan/doexport']='Jabatan/doexport';

$route['pegawai']='Pegawai';
$route['pegawai/update/(:any)']='Pegawai/update/$1';
$route['pegawai/edit/(:any)']='Pegawai/edit/$1';
$route['pegawai/hapus/(:any)']='Pegawai/hapus/$1';
$route['pegawai/simpan_pegawai/(:any)']='Pegawai/simpan_pegawai/$1';
$route['pegawai/form']='Pegawai/form';
$route['pegawai/logout']='Pegawai/logout';
$route['pegawai/cetak']='Pegawai/cetak';
$route['pegawai/doexport']='Pegawai/doexport';

$route['dokter/hapus/(:any)']='Dokter/hapus/$1';
$route['dokter/update/(:any)']='Dokter/update/$1';
$route['dokter/edit/(:any)']='Dokter/edit/$1';
$route['dokter/form']='Dokter/form';
$route['dokter/simpan']='Dokter/simpan';
$route['dokter/simpan/(:any)']='Dokter/simpan/$1';
$route['dokter']='Dokter';
$route['dokter/cetak']='Dokter/cetak';
$route['dokter/doexport']='Dokter/doexport';
/* MASTER PEGAWAI */

/* MASTER LAYANAN */
$route['layanan']='Layanan';
$route['layanan/add_layanan']='Layanan/add_layanan';
$route['layanan/update/(:any)']='Layanan/update/$1';
$route['layanan/edit/(:any)']='Layanan/edit/$1';
$route['layanan/cetak']='Layanan/cetak';
$route['layanan/doexport']='Layanan/doexport';
/* MASTER LAYANAN */

/* MASTER RUANGAN */
$route['kamar']='Kamar';
$route['kamar/add_kamar']='Kamar/add_kamar';
$route['kamar/update/(:any)']='Kamar/update/$1';
$route['kamar/edit/(:any)']='Kamar/edit/$1';
$route['kamar/cetak']='Kamar/cetak';
$route['kamar/doexport']='Kamar/doexport';

$route['bed']='Bed';
$route['bed/add_bed']='Bed/add_bed';
$route['bed/update/(:any)']='Bed/update/$1';
$route['bed/edit/(:any)']='Bed/edit/$1';
$route['bed/cetak']='Bed/cetak';
$route['bed/doexport']='Bed/doexport';
/* MASTER RUANGAN */

/* MASTER OBAT DAN ALKES */
$route['satuan']='Satuan';
$route['satuan/add_satuan']='Satuan/add_satuan';
$route['satuan/update/(:any)']='Satuan/update/$1';
$route['satuan/edit/(:any)']='Satuan/edit/$1';
$route['satuan/cetak']='Satuan/cetak';
$route['satuan/doexport']='Satuan/doexport';

$route['merk']='Merk';
$route['merk/add_merk']='Merk/add_merk';
$route['merk/update/(:any)']='Merk/update/$1';
$route['merk/edit/(:any)']='Merk/edit/$1';
$route['merk/cetak']='Merk/cetak';
$route['merk/doexport']='Merk/doexport';

$route['obat']='Obat';
$route['obat/form']='Obat/form';
$route['obat/form/(:any)']='Obat/form/$1';
$route['obat/cetak']='Obat/cetak';
$route['obat/doexport']='Obat/doexport';
$route['obat/simpan']='Obat/simpan';
$route['obat/update/(:any)']='Obat/update/$1';

$route['kategoriobat']='Kategoriobat';
$route['kategoriobat/add_kategoriobat']='Kategoriobat/add_kategoriobat';
$route['kategoriobat/update/(:any)']='Kategoriobat/update/$1';
$route['kategoriobat/edit/(:any)']='Kategoriobat/edit/$1';
$route['kategoriobat/cetak']='Kategoriobat/cetak';
$route['kategoriobat/doexport']='Kategoriobat/doexport';

$route['hargaobat/update/(:any)']='Hargaobat/update/$1';
$route['hargaobat/hapus/(:any)']='Hargaobat/hapus/$1';
$route['hargaobat/form/(:any)']='Hargaobat/form/$1';
$route['hargaobat/form']='Hargaobat/form';
$route['hargaobat']='Hargaobat';
$route['hargaobat/cetak']='Hargaobat/cetak';
$route['hargaobat/doexport']='Hargaobat/doexport';
$route['hargaobat/simpan']='Hargaobat/simpan';
/* MASTER OBAT DAN ALKES */

/* MASTER REKAM MEDIK */
$route['diagnosa']='Diagnosa';
$route['diagnosa/add_diagnosa']='Diagnosa/add_diagnosa';
$route['diagnosa/update/(:any)']='Diagnosa/update/$1';
$route['diagnosa/edit/(:any)']='Diagnosa/edit/$1';
$route['diagnosa/cetak']='Diagnosa/cetak';
$route['diagnosa/doexport']='Diagnosa/doexport';

$route['rekammedik/cetak/(:any)']='Rekammedik/cetak/$1';
$route['rekammedik/simpan']='Rekammedik/simpan';
$route['rekammedik/hapus/(:any)']='Rekammedik/hapus/$1';
$route['rekammedik/edit/(:any)']='Rekammedik/edit/$1';
$route['rekammedik/update/(:any)']='Rekammedik/update/$1';
$route['rekammedik/detail/(:any)']='Rekammedik/detail/$1';
$route['rekammedik/tambah']='Rekammedik/tambah';
$route['rekammedik']='Rekammedik';
/* MASTER REKAM MEDIK */

/* PENGATURAN */
$route['menu']='Menu';
$route['menu/add_menu']='Menu/add_menu';
$route['menu/update/(:any)']='Menu/update/$1';
$route['menu/edit_menu/(:any)']='Menu/edit_menu/$1';
$route['menu/cetak']='Menu/cetak';
$route['menu/doexport']='Menu/doexport';

$route['role']='Role';
$route['role/add_role']='Role/add_role';
$route['role/update/(:any)']='Role/update/$1';
$route['role/edit/(:any)']='Role/edit/$1';
$route['role/cetak']='Role/cetak';
$route['role/doexport']='Role/doexport';

$route['owner/simpan']='Owner/simpan';
$route['owner/tambah']='Owner/tambah';
$route['owner/hapus/(:any)']='Owner/hapus/$1';
$route['owner/update/(:any)']='Owner/update/$1';
$route['owner/edit/(:any)']='Owner/edit/$1';
$route['owner']='Owner';

$route['previlleges']='Previlleges';
$route['previlleges/add_previlleges']='Previlleges/add_previlleges';
$route['previlleges/update/(:any)']='Previlleges/update/$1';
$route['previlleges/edit/(:any)']='Previlleges/edit/$1';
$route['previlleges/cetak']='Previlleges/cetak';
$route['previlleges/doexport']='Previlleges/doexport';

$route['users']='Users';
$route['users/add_users']='Users/add_users';
$route['users/update/(:any)']='Users/update/$1';
$route['users/edit/(:any)']='Users/edit/$1';
$route['users/users_profile/(:any)']='Users/users_profile/$1';
$route['users/update_profile/(:any)']='Users/update_profile/$1';
$route['users/cetak']='Users/cetak';
$route['users/doexport']='Users/doexport';
/* MENU PENGATURAN */

/* MENU SUPPLIER */
$route['suplier']='Suplier';
$route['suplier/add_suplier']='Suplier/add_suplier';
$route['suplier/update/(:any)']='Suplier/update/$1';
$route['suplier/edit/(:any)']='Suplier/edit/$1';
$route['suplier/cetak']='Suplier/cetak';
$route['suplier/doexport']='Suplier/doexport';
/* MENU SUPPLIER */

/* MENU PAKET LAYANAN */
$route['paket']='Paket';
$route['paket/tambah']='Paket/tambah';
$route['paket/hapus/(:any)']='Paket/hapus/$1';
$route['paket/update/(:any)']='Paket/update/$1';
$route['paket/edit/(:any)']='Paket/edit/$1';
$route['paket/cetak']='Paket/cetak';
$route['paket/doexport']='Paket/doexport';
/* MENU PAKET LAYANAN */
