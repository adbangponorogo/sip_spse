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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'main/Main_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/*
| -------------------------------------------------------------------
| Routes = APPLICATION
| -------------------------------------------------------------------
*/

$route['app/welcome'] = 'main/Main_controller/welcome_page';
$route['app/main'] = 'main/Main_controller/main_page';


/*
| -------------------------------------------------------------------
| Routes = AUTENTIKASI
| -------------------------------------------------------------------
*/
$route['auth/page/login'] = 'autentikasi/Autentikasi_controller/main_page';
$route['auth/process/login'] = 'autentikasi/Autentikasi_controller/process_login';
$route['auth/process/status'] = 'autentikasi/Autentikasi_controller/login_status';
$route['auth/process/logout'] = 'autentikasi/Autentikasi_controller/process_logout';


/*
| -------------------------------------------------------------------
| ------------------------------
| Routes = DASHBOARD
| ------------------------------
| -------------------------------------------------------------------
*/

$route['dashboard/page/main'] = 'dashboard/Dashboard_controller/main_page';
$route['dashboard/data/rekap/(:any)'] = 'dashboard/Dashboard_controller/rekap_data/$1';
$route['dashboard/data/perencanaan_pbj/tender'] = 'dashboard/Dashboard_controller/perencanaan_pbj_tender';
$route['dashboard/data/perencanaan_pbj/seleksi'] = 'dashboard/Dashboard_controller/perencanaan_pbj_seleksi';
$route['dashboard/data/perencanaan_pbj/penyedia'] = 'dashboard/Dashboard_controller/perencanaan_pbj_penyedia';
$route['dashboard/data/perencanaan_pbj/swakelola'] = 'dashboard/Dashboard_controller/perencanaan_pbj_swakelola';
$route['dashboard/data/pelaksanaan_pbj/metode-tender-seleksi/(:any)'] = 'dashboard/Dashboard_controller/pelaksanaan_pbj_metode_tender_seleksi/$1';
$route['dashboard/data/pelaksanaan_pbj/efisiensi-tender/(:any)'] = 'dashboard/Dashboard_controller/pelaksanaan_pbj_efisiensi_tender/$1';
$route['dashboard/data/pelaksanaan_pbj/efisiensi-non-tender/(:any)'] = 'dashboard/Dashboard_controller/pelaksanaan_pbj_efisiensi_non_tender/$1';
$route['dashboard/data/pelaksanaan_pbj/versi-lelang-spse/(:any)'] = 'dashboard/Dashboard_controller/pelaksanaan_pbj_versi_lelang_spse/$1';
$route['dashboard/data/paket_eprocurement/(:any)'] = 'dashboard/Dashboard_controller/paket_eprocurement/$1';
$route['dashboard/data/hasil_eprocurement/(:any)'] = 'dashboard/Dashboard_controller/hasil_eprocurement/$1';
$route['dashboard/data/paket_non_tender/(:any)'] = 'dashboard/Dashboard_controller/paket_non_tender/$1';
$route['dashboard/data/pelaksanaan_pbj/lelang-ulang/(:any)'] = 'dashboard/Dashboard_controller/pelaksanaan_pbj_lelang_ulang/$1';
$route['dashboard/data/pelaksanaan_pbj/lelang-gagal/(:any)'] = 'dashboard/Dashboard_controller/pelaksanaan_pbj_lelang_gagal/$1';
$route['dashboard/data/pelaksanaan_pbj/lelang-sanggah'] = 'dashboard/Dashboard_controller/pelaksanaan_pbj_lelang_sanggah';
$route['dashboard/data/aktivitas-rekanan/status-penyedia'] = 'dashboard/Dashboard_controller/aktifitas_rekanan_status_penyedia';
$route['dashboard/data/aktivitas-rekanan/kategori-badan-usaha'] = 'dashboard/Dashboard_controller/aktifitas_rekanan_kategori_badan_usaha';
$route['dashboard/data/aktivitas-rekanan/kualifikasi-badan-usaha'] = 'dashboard/Dashboard_controller/aktifitas_rekanan_kualifikasi_badan_usaha';
$route['dashboard/data/aktivitas-rekanan/top-tendering/(:any)'] = 'dashboard/Dashboard_controller/aktifitas_rekanan_top_tendering/$1';
$route['dashboard/data/aktivitas-rekanan/top-non-tendering/(:any)'] = 'dashboard/Dashboard_controller/aktifitas_rekanan_top_nontendering/$1';
$route['dashboard/data/kelompok-tender/data-kategori/(:any)'] = 'dashboard/Dashboard_controller/kelompok_tender/$1';



/*
| -------------------------------------------------------------------
| ------------------------------
| Routes = REPORT/PAKET TENDERING
| ------------------------------
| -------------------------------------------------------------------
*/
/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET-TENDERING/E-PROCUREMENT
| -------------------------------------------------------------------
*/
$route['paket-tendering/e-procurement/page/main'] = 'tendering_eprocurement/Tendering_eprocurement_controller/main_page';
$route['paket-tendering/e-procurement/data/data-agency'] = 'tendering_eprocurement/Tendering_eprocurement_controller/agency_data';
$route['paket-tendering/e-procurement/data/rekap/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/rekap_data/$1/$2';
$route['paket-tendering/e-procurement/data/lelang-pertahun/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/lelang_pertahun/$1/$2';
$route['paket-tendering/e-procurement/data/metode-pertahun/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/metode_pertahun/$1/$2';
$route['paket-tendering/e-procurement/data/kelompok-pertahun/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/kelompok_pertahun/$1/$2';
$route['paket-tendering/e-procurement/data/agency-pertahun/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/agency_pertahun/$1/$2';
$route['paket-tendering/e-procurement/data/asal-pemenang-pertahun/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/asal_pemenang_pertahun/$1/$2';
$route['paket-tendering/e-procurement/data/satker-pertahun/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/satker_pertahun/$1/$2';
$route['paket-tendering/e-procurement/data/top-ten-tender-barang/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/top_ten_tender_barang/$1/$2';
$route['paket-tendering/e-procurement/data/top-ten-tender-konsultasi/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/top_ten_tender_konsultasi/$1/$2';
$route['paket-tendering/e-procurement/data/top-ten-tender-konstruksi/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/top_ten_tender_konstruksi/$1/$2';
$route['paket-tendering/e-procurement/data/top-ten-non-tender-barang/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/top_ten_nontender_barang/$1/$2';
$route['paket-tendering/e-procurement/data/top-ten-non-tender-konsultasi/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/top_ten_nontender_konsultasi/$1/$2';
$route['paket-tendering/e-procurement/data/top-ten-non-tender-konstruksi/(:any)/(:any)'] = 'tendering_eprocurement/Tendering_eprocurement_controller/top_ten_nontender_konstruksi/$1/$2';



/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET-TENDERING/DATA PAKET PENGADAAN
| -------------------------------------------------------------------
*/
$route['paket-tendering/data-pengadaan/page/main'] = 'tendering_paket_pengadaan/Tendering_paketpengadaan_controller/main_page';
$route['paket-tendering/data-pengadaan/data/data-agency'] = 'tendering_paket_pengadaan/Tendering_paketpengadaan_controller/agency_data';
$route['paket-tendering/data-pengadaan/data/sistem-tender/(:any)/(:any)'] = 'tendering_paket_pengadaan/Tendering_paketpengadaan_controller/sistem_tender/$1/$2';
$route['paket-tendering/data-pengadaan/data/partisipasi-penawaran/(:any)/(:any)'] = 'tendering_paket_pengadaan/Tendering_paketpengadaan_controller/partisipasi_penawaran/$1/$2';
$route['paket-tendering/data-pengadaan/data/partisipasi-rekanan/(:any)/(:any)'] = 'tendering_paket_pengadaan/Tendering_paketpengadaan_controller/partisipasi_rekanan/$1/$2';



/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET-TENDERING/DAFTAR PAKET OPD
| -------------------------------------------------------------------
*/
$route['paket-tendering/paket-opd/page/main'] = 'tendering_paket_opd/Tendering_paketopd_controller/main_page';
$route['paket-tendering/paket-opd/data/data-agency'] = 'tendering_paket_opd/Tendering_paketopd_controller/agency_data';
$route['paket-tendering/paket-opd/data/rekap-paket-opd/(:any)/(:any)'] = 'tendering_paket_opd/Tendering_paketopd_controller/rekap_paket_opd/$1/$2';
$route['paket-tendering/paket-opd/data/hasil-paket-opd/(:any)/(:any)'] = 'tendering_paket_opd/Tendering_paketopd_controller/hasil_paket_opd/$1/$2';



/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET-TENDERING/DATA KONTRAK OPD
| -------------------------------------------------------------------
*/
$route['paket-tendering/kontrak-opd/page/main'] = 'tendering_kontrak_opd/Tendering_kontrakopd_controller/main_page';
$route['paket-tendering/kontrak-opd/data/data-agency'] = 'tendering_kontrak_opd/Tendering_kontrakopd_controller/agency_data';
$route['paket-tendering/kontrak-opd/data/rekap/(:any)/(:any)'] = 'tendering_kontrak_opd/Tendering_kontrakopd_controller/rekap_data/$1/$2';
$route['paket-tendering/kontrak-opd/data/kontrak-opd/(:any)/(:any)'] = 'tendering_kontrak_opd/Tendering_kontrakopd_controller/kontrak_opd/$1/$2';
$route['paket-tendering/kontrak-opd/data/paket-kontrak/(:any)/(:any)'] = 'tendering_kontrak_opd/Tendering_kontrakopd_controller/paket_kontrak/$1/$2';


/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET-TENDERING/DATA PAKET ULANG
| -------------------------------------------------------------------
*/
$route['paket-tendering/paket-ulang/page/main'] = 'tendering_paket_ulang/Tendering_paketulang_controller/main_page';
$route['paket-tendering/paket-ulang/data/data-agency'] = 'tendering_paket_ulang/Tendering_paketulang_controller/agency_data';
$route['paket-tendering/paket-ulang/data/rekap-retendering/(:any)/(:any)'] = 'tendering_paket_ulang/Tendering_paketulang_controller/rekap_retendering/$1/$2';
$route['paket-tendering/paket-ulang/data/data-retendering/(:any)/(:any)'] = 'tendering_paket_ulang/Tendering_paketulang_controller/data_retendering/$1/$2';


/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET-TENDERING/DATA PAKET GAGAL
| -------------------------------------------------------------------
*/
$route['paket-tendering/paket-gagal/page/main'] = 'tendering_paket_gagal/Tendering_paketgagal_controller/main_page';
$route['paket-tendering/paket-gagal/data/data-agency'] = 'tendering_paket_gagal/Tendering_paketgagal_controller/agency_data';
$route['paket-tendering/paket-gagal/data/rekap-gagal/(:any)/(:any)'] = 'tendering_paket_gagal/Tendering_paketgagal_controller/rekap_gagal/$1/$2';
$route['paket-tendering/paket-gagal/data/data-gagal/(:any)/(:any)'] = 'tendering_paket_gagal/Tendering_paketgagal_controller/data_gagal/$1/$2';


/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET-TENDERING/DATA PROGRES PBJ
| -------------------------------------------------------------------
*/
$route['paket-tendering/progres-pbj/page/main'] = 'tendering_progres_pbj/Tendering_progrespbj_controller/main_page';
$route['paket-tendering/progres-pbj/data/data-agency'] = 'tendering_progres_pbj/Tendering_progrespbj_controller/agency_data';
$route['paket-tendering/progres-pbj/data/kategori-tender/(:any)/(:any)'] = 'tendering_progres_pbj/Tendering_progrespbj_controller/kategori_tender/$1/$2';



/*
| -------------------------------------------------------------------
| ------------------------------
| Routes = REPORT/PAKET NON-TENDERING
| ------------------------------
| -------------------------------------------------------------------
*/
/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET NON-TENDERING/PAKET PENGADAAN
| -------------------------------------------------------------------
*/
$route['paket-non-tendering/paket-pengadaan/page/main'] = 'nontendering_paket_pengadaan/Nontendering_paketpengadaan_controller/main_page';
$route['paket-non-tendering/paket-pengadaan/data/data-paket/(:any)'] = 'nontendering_paket_pengadaan/Nontendering_paketpengadaan_controller/data_paket/$1';


/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET NON-TENDERING/DAFTAR PAKET OPD
| -------------------------------------------------------------------
*/
$route['paket-non-tendering/paket-opd/page/main'] = 'nontendering_paket_opd/Nontendering_paketopd_controller/main_page';
$route['paket-non-tendering/paket-opd/data/rekap-paket/(:any)'] = 'nontendering_paket_opd/Nontendering_paketopd_controller/rekap_paket/$1';
$route['paket-non-tendering/paket-opd/data/hasil-paket/(:any)'] = 'nontendering_paket_opd/Nontendering_paketopd_controller/hasil_paket/$1';


/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET NON-TENDERING/DATA KONTRAK OPD
| -------------------------------------------------------------------
*/
$route['paket-non-tendering/kontrak-opd/page/main'] = 'nontendering_kontrak_opd/Nontendering_kontrakopd_controller/main_page';
$route['paket-non-tendering/kontrak-opd/data/rekap/(:any)'] = 'nontendering_kontrak_opd/Nontendering_kontrakopd_controller/rekap_data/$1';
$route['paket-non-tendering/kontrak-opd/data/kontrak-opd/(:any)'] = 'nontendering_kontrak_opd/Nontendering_kontrakopd_controller/kontrak_opd/$1';
$route['paket-non-tendering/kontrak-opd/data/paket-kontrak/(:any)'] = 'nontendering_kontrak_opd/Nontendering_kontrakopd_controller/paket_kontrak/$1';


/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET NON-TENDERING/DATA PAKET ULANG
| -------------------------------------------------------------------
*/
$route['paket-non-tendering/paket-ulang/page/main'] = 'nontendering_paket_ulang/Nontendering_paketulang_controller/main_page';
$route['paket-non-tendering/paket-ulang/data/rekap-retendering/(:any)'] = 'nontendering_paket_ulang/Nontendering_paketulang_controller/rekap_retendering/$1';
$route['paket-non-tendering/paket-ulang/data/data-retendering/(:any)'] = 'nontendering_paket_ulang/Nontendering_paketulang_controller/data_retendering/$1';


/*
| -------------------------------------------------------------------
| Routes = REPORT/PAKET NON-TENDERING/DATA PAKET GAGAL
| -------------------------------------------------------------------
*/
$route['paket-non-tendering/paket-gagal/page/main'] = 'nontendering_paket_gagal/Nontendering_paketgagal_controller/main_page';
$route['paket-non-tendering/paket-gagal/data/rekap-gagal/(:any)'] = 'nontendering_paket_gagal/Nontendering_paketgagal_controller/rekap_gagal/$1';
$route['paket-non-tendering/paket-gagal/data/data-gagal/(:any)'] = 'nontendering_paket_gagal/Nontendering_paketgagal_controller/data_gagal/$1';





/*
| -------------------------------------------------------------------
| ------------------------------
| Routes = SiRUP
| ------------------------------
| -------------------------------------------------------------------
*/
/*
| -------------------------------------------------------------------
| Routes = SiRUP/REKAPITULASI
| -------------------------------------------------------------------
*/
$route['paket-sirup/rekapitulasi/page/main'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/main_page';
$route['paket-sirup/rekapitulasi/data/rekap-rup-penyedia/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/statistik_rekap_paket_penyedia/$1';
$route['paket-sirup/rekapitulasi/data/perencanaan-belanja-pemda/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/perencanaan_belanja_pemda/$1';
$route['paket-sirup/rekapitulasi/data/analisis-rup/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/analisis_rup/$1';
$route['paket-sirup/rekapitulasi/data/tepra-rup/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/tepra_rup/$1';
$route['paket-sirup/rekapitulasi/data/progres-identifikasi-paket/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/progres_identifikasi_paket/$1';

$route['paket-sirup/rekapitulasi/data/status-rup/penyedia-tayang/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_penyedia_tayang/$1';
$route['paket-sirup/rekapitulasi/data/status-rup/penyedia-belum-tayang/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_penyedia_belum_tayang/$1';
$route['paket-sirup/rekapitulasi/data/status-rup/swakelola-tayang/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_swakelola_tayang/$1';
$route['paket-sirup/rekapitulasi/data/status-rup/swakelola-belum-tayang/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_swakelola_belum_tayang/$1';

$route['paket-sirup/rekapitulasi/data/paket-penyedia/statistik-rekap/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_penyedia_statistik_rekap/$1';
$route['paket-sirup/rekapitulasi/data/paket-penyedia/progres-rekap/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_penyedia_rekapitulasi_progres/$1';
$route['paket-sirup/rekapitulasi/data/paket-penyedia/rekapitulasi-rup/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_penyedia_rekapitulasi_rup_opd/$1';
$route['paket-sirup/rekapitulasi/data/paket-penyedia/data-rup/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_penyedia_data_rup/$1';

$route['paket-sirup/rekapitulasi/data/paket-swakelola/statistik-rekap/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_swakelola_statistik_rekap/$1';
$route['paket-sirup/rekapitulasi/data/paket-swakelola/progres-rekap/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_swakelola_rekapitulasi_progres/$1';
$route['paket-sirup/rekapitulasi/data/paket-swakelola/rekapitulasi-rup/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_swakelola_rekapitulasi_rup_opd/$1';
$route['paket-sirup/rekapitulasi/data/paket-swakelola/data-rup/(:any)'] = 'sirup_rekapitulasi/Sirup_rekapitulasi_controller/paket_swakelola_data_rup/$1';



/*
| -------------------------------------------------------------------
| Routes = SiRUP/PAKET
| -------------------------------------------------------------------
*/
$route['paket-sirup/paket/page/main'] = 'sirup_paket/Sirup_paket_controller/main_page';
$route['paket-sirup/paket/data/rekap/(:any)'] = 'sirup_paket/Sirup_paket_controller/statistik_rekap/$1';
$route['paket-sirup/paket/data/rekapitulasi-paket/(:any)'] = 'sirup_paket/Sirup_paket_controller/rekapitulasi_paket_opd/$1';
$route['paket-sirup/paket/data/paket-tender-seleksi/(:any)'] = 'sirup_paket/Sirup_paket_controller/paket_tender_seleksi/$1';
$route['paket-sirup/paket/data/rincian-paket/(:any)'] = 'sirup_paket/Sirup_paket_controller/rincian_paket/$1';




/*
| -------------------------------------------------------------------
| Routes = SiRUP/DATA
| -------------------------------------------------------------------
*/
$route['paket-sirup/data/page/main'] = 'sirup_data/Sirup_data_controller/main_page';
$route['paket-sirup/data/data/paket-opd/(:any)'] = 'sirup_data/Sirup_data_controller/paket_opd/$1';





/*
| -------------------------------------------------------------------
| ------------------------------
| Routes = E-Purchasing
| ------------------------------
| -------------------------------------------------------------------
*/
/*
| -------------------------------------------------------------------
| Routes = E-Purchasing/Data
| -------------------------------------------------------------------
*/
$route['e-purchasing/data/page/main'] = 'epurchasing_data/Epurchasing_data_controller/main_page';
$route['e-purchasing/data/data/paket-opd/(:any)'] = 'epurchasing_data/Epurchasing_data_controller/paket_opd/$1';




/*
| -------------------------------------------------------------------
| ------------------------------
| Routes = Rekanan
| ------------------------------
| -------------------------------------------------------------------
*/
/*
| -------------------------------------------------------------------
| Routes = Rekanan/Profil
| -------------------------------------------------------------------
*/
$route['rekanan/profil/data/page/main'] = 'rekanan_profil/Rekanan_profil_controller/main_page';
$route['rekanan/profil/data/rekanan-provinsi/(:any)'] = 'rekanan_profil/Rekanan_profil_controller/rekanan_provinsi/$1';
$route['rekanan/profil/data/rekanan-kabupaten/(:any)'] = 'rekanan_profil/Rekanan_profil_controller/rekanan_kabupaten/$1';
$route['rekanan/profil/data/kelompok-usaha-kabupaten/(:any)'] = 'rekanan_profil/Rekanan_profil_controller/kelompok_usaha_kabupaten/$1';



/*
| -------------------------------------------------------------------
| ------------------------------
| Routes = MISC
| ------------------------------
| -------------------------------------------------------------------
*/
/*
| -------------------------------------------------------------------
| Routes = MISC/TENTANG KAMI
| -------------------------------------------------------------------
*/
$route['misc/tentang-kami/page/main'] = 'misc_tentang_kami/Misc_tentangkami_controller/main_page';
$route['misc/tentang-kami/data/profile'] = 'misc_tentang_kami/Misc_tentangkami_controller/select_all_data_profile';
$route['misc/tentang-kami/data/tentang-kami'] = 'misc_tentang_kami/Misc_tentangkami_controller/select_all_data_tentang_kami';
$route['misc/tentang-kami/update/tentang-kami'] = 'misc_tentang_kami/Misc_tentangkami_controller/update_data_tentang_kami';
$route['misc/tentang-kami/data/kontak-kami'] = 'misc_tentang_kami/Misc_tentangkami_controller/select_all_data_kontak_kami';
$route['misc/tentang-kami/update/kontak-kami'] = 'misc_tentang_kami/Misc_tentangkami_controller/update_data_kontak_kami';
$route['misc/tentang-kami/data/info-privasi'] = 'misc_tentang_kami/Misc_tentangkami_controller/select_all_data_info_privasi';
$route['misc/tentang-kami/update/info-privasi'] = 'misc_tentang_kami/Misc_tentangkami_controller/update_data_info_privasi';


/*
| -------------------------------------------------------------------
| Routes = MISC/AUTENTIKASI
| -------------------------------------------------------------------
*/
$route['misc/autentikasi/page/main'] = 'misc_autentikasi/Misc_autentikasi_controller/main_page';
$route['misc/autentikasi/data/data-users'] = 'misc_autentikasi/Misc_autentikasi_controller/select_all_data';
$route['misc/autentikasi/data/data-opd'] = 'misc_autentikasi/Misc_autentikasi_controller/select_all_data_opd';
$route['misc/autentikasi/insert/data-users'] = 'misc_autentikasi/Misc_autentikasi_controller/insert_data';
$route['misc/autentikasi/edit/data-users'] = 'misc_autentikasi/Misc_autentikasi_controller/select_all_data_by_detail';
$route['misc/autentikasi/edit/data-users/(:any)'] = 'misc_autentikasi/Misc_autentikasi_controller/select_all_data_by_id/$1';
$route['misc/autentikasi/update/data-users'] = 'misc_autentikasi/Misc_autentikasi_controller/update_data';
$route['misc/autentikasi/delete/data-users/(:any)'] = 'misc_autentikasi/Misc_autentikasi_controller/delete_data/$1';


/*
| -------------------------------------------------------------------
| Routes = MISC/STRUKTUR ANGGARAN
| -------------------------------------------------------------------
*/
$route['misc/tarik-data/page/main'] = 'misc_tarik_data/Misc_tarikdata_controller/main_page';
$route['misc/tarik-data/insert/penyedia-tayang/(:any)'] = 'misc_tarik_data/Misc_tarikdata_controller/penyedia_tayang/$1';
$route['misc/tarik-data/insert/penyedia-draft/(:any)'] = 'misc_tarik_data/Misc_tarikdata_controller/penyedia_draft/$1';
$route['misc/tarik-data/insert/swakelola-tayang/(:any)'] = 'misc_tarik_data/Misc_tarikdata_controller/swakelola_tayang/$1';
$route['misc/tarik-data/insert/swakelola-draft/(:any)'] = 'misc_tarik_data/Misc_tarikdata_controller/swakelola_draft/$1';
$route['misc/tarik-data/insert/data-epurchasing/(:any)'] = 'misc_tarik_data/Misc_tarikdata_controller/data_epurchasing/$1';
$route['misc/tarik-data/insert/json-sirup/(:any)'] = 'misc_tarik_data/Misc_tarikdata_controller/json_sirup/$1';
$route['misc/tarik-data/insert/struktur-anggaran/(:any)'] = 'misc_tarik_data/Misc_tarikdata_controller/struktur_anggaran/$1';

