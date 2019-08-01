<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Dashboard_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}

	// *************************************************
	// | *********************************************
	// | --------------- REKAP DATA ------------------
	// | *********************************************
	// *************************************************

	public function rekap_data($tahun){
		$result	= $this->model->lelang_resume($tahun);
		$data 	= array();
		foreach ($result->result() as $rows) {
			$data 	= array(
							"total_paket"					=> number_format($rows->t_paket),
							"total_paket_selesai"			=> number_format($rows->t_paket_selesai),
							"total_paket_belum_selesai"		=> number_format($rows->t_paket_belum_selesai),
							"total_pagu"					=> number_format($rows->t_pagu),
							"total_pagu_selesai"			=> number_format($rows->t_pagu_selesai),
							"total_tawar"					=> number_format($rows->t_tawar),
							"selisih"						=> number_format($rows->selisih),
							"total_prosentase"				=> number_format($rows->ttl_pros, 2)
						);
		}
		echo json_encode($data);
	}





	// *************************************************
	// | *********************************************
	// | ------------- PERENCANAAN PBJ ---------------
	// | *********************************************
	// *************************************************


	public function perencanaan_pbj_tender(){
		$result = $this->model->paket_sirup();
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"nama_satker"			=> $rows->nama_satker,
							"jumlah_tender"			=> $rows->jml_tender
						);
		}
		echo json_encode($data);
	}

	public function perencanaan_pbj_seleksi(){
		$result = $this->model->paket_sirup();
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"nama_satker"			=> $rows->nama_satker,
							"jumlah_tender"			=> $rows->jml_seleksi
						);
		}
		echo json_encode($data);
	}

	public function perencanaan_pbj_penyedia(){
		$result = $this->model->paket_penyedia();
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"nama_metode"			=> $rows->metode_str,
							"pencatatan_non_tender"	=> $rows->pencatatan_non_tender,
							"paket_non_tender"		=> $rows->non_tender,
							"paket_tender"			=> $rows->tender,
							"paket_seleksi"			=> $rows->seleksi
						);
		}
		echo json_encode($data);
	}

	public function perencanaan_pbj_swakelola(){
		$result = $this->model->paket_swakelola();
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"nama_satker"			=> $rows->nama_satker,
							"pagu"					=> round($rows->pagu, 2),
						);
		}
		echo json_encode($data);
	}





	// *************************************************
	// | *********************************************
	// | ------------- PELAKSANAAN PBJ ---------------
	// | *********************************************
	// *************************************************

	public function pelaksanaan_pbj_metode_tender_seleksi($tahun){
		$result = $this->model->metode_tender_seleksi($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"metode"			=> $rows->metode,
							"jml_paket"			=> $rows->jml_paket,
						);
		}
		echo json_encode($data);
	}

	public function pelaksanaan_pbj_efisiensi_tender($tahun){
		$result = $this->model->efisiensi_tender($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"tahun"				=> $rows->tahun,
							"pg_paket"			=> $rows->pg_paket,
							"penawaran"			=> $rows->penawaran,
							"efisiensi"			=> round($rows->efisiensi, 2),
						);
		}
		echo json_encode($data);
	}

	public function pelaksanaan_pbj_efisiensi_non_tender($tahun){
		$result = $this->model->efisiensi_non_tender($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"tahun"				=> $rows->tahun,
							"hps"				=> round($rows->hps, 2),
							"kontrak"			=> round($rows->kontrak, 2),
							"efisiensi"			=> round($rows->efisiensi, 2)
						);
		}
		echo json_encode($data);
	}

	public function pelaksanaan_pbj_versi_lelang_spse($tahun){
		$result = $this->model->versi_lelang_spse($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"versi_lelang"		=> $rows->versi_lelang,
							"jml_spse4"			=> $rows->jml_spse4,
						);
		}
		echo json_encode($data);
	}





	// *************************************************
	// | *********************************************
	// | ----------- PAKET E-PROCUREMENT -------------
	// | *********************************************
	// *************************************************

	public function paket_eprocurement($tahun){
		$result = $this->model->paket_eprocurement($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"tahun"					=> $rows->tahun,
							"total_paket"			=> $rows->t_paket,
							"paket_selesai"			=> $rows->t_paket_selesai,
						);
		}
		echo json_encode($data);
	}
	public function hasil_eprocurement($tahun){
		$result = $this->model->efisiensi_tender($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"tahun"				=> $rows->tahun,
							"pg_paket"			=> round($rows->pg_paket, 0),
							"penawaran"			=> round($rows->penawaran, 0),
							"efisiensi"			=> round(($rows->pg_paket - $rows->penawaran), 0),
						);
		}
		echo json_encode($data);
	}






	// *************************************************
	// | *********************************************
	// | ------------- PAKET NON TENDER --------------
	// | *********************************************
	// *************************************************

	public function paket_non_tender($tahun){
		$result = $this->model->paket_non_tender($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"tahun"					=> $rows->tahun,
							"total_paket"			=> $rows->jml_paket,
							"paket_selesai"			=> $rows->jml_paket_selesai,
						);
		}
		echo json_encode($data);
	}






	// *************************************************
	// | *********************************************
	// | ---------- PROGRES TENDER/SELEKSI -----------
	// | *********************************************
	// *************************************************

	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	// Menggunakan Function Paket E-Procurement
	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!





	// *************************************************
	// | *********************************************
	// | ---------- PROGRES PELAKSANAAN PBJ ----------
	// | *********************************************
	// *************************************************

	public function pelaksanaan_pbj_lelang_ulang($tahun){
		$result = $this->model->pelaksanaan_pbj_lelang_ulang($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"tahun"					=> $rows->tahun,
							"total_paket"			=> $rows->jumlah_paket,
						);
		}
		echo json_encode($data);
	}

	public function pelaksanaan_pbj_lelang_gagal($tahun){
		$result = $this->model->pelaksanaan_pbj_lelang_gagal($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"tahun"					=> $rows->tahun,
							"total_paket"			=> $rows->jumlah_paket,
						);
		}
		echo json_encode($data);
	}

	public function pelaksanaan_pbj_lelang_sanggah(){
		$result = $this->model->pelaksanaan_pbj_lelang_sanggah();
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"tahun"					=> $rows->tahun,
							"total_paket"			=> $rows->jumlah_paket,
						);
		}
		echo json_encode($data);
	}






	// *************************************************
	// | *********************************************
	// | ------------- AKTIFITAS REKANAN -------------
	// | *********************************************
	// *************************************************

	public function aktifitas_rekanan_status_penyedia(){
		$result = $this->model->aktifitas_rekanan_status_penyedia();
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"kbp_nama"				=> $rows->kbp_nama,
							"rekanan"				=> $rows->rkn,
							"sudah"					=> $rows->sdh,
							"belum"					=> $rows->blm,
							"tolak"					=> $rows->tolak,
						);
		}
		echo json_encode($data);
	}

	public function aktifitas_rekanan_kategori_badan_usaha(){
		$result = $this->model->aktifitas_rekanan_kategori_badan_usaha();
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"kbp_nama"				=> $rows->kbp_nama,
							"cv"					=> $rows->cv,
							"pt"					=> $rows->pt,
							"ud"					=> $rows->ud,
							"kop"					=> $rows->kop,
							"pd"					=> $rows->pd,
							"kecil"					=> $rows->kecil,
							"non"					=> $rows->non,
							"gab"					=> $rows->gab,
							"blm"					=> $rows->blm,
						);
		}
		echo json_encode($data);
	}

	public function aktifitas_rekanan_kualifikasi_badan_usaha(){
		$result = $this->model->aktifitas_rekanan_kualifikasi_badan_usaha();
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"kbp_nama"				=> $rows->kbp_nama,
							"kecil"					=> $rows->kecil,
							"non"					=> $rows->non,
							"gab"					=> $rows->gab,
							"blm"					=> $rows->blm,
						);
		}
		echo json_encode($data);
	}

	public function aktifitas_rekanan_top_tendering($tahun){
		$result = $this->model->aktifitas_rekanan_top_tendering($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"rkn_nama"				=> $rows->rkn_nama,
							"jml_paket"				=> $rows->jml_paket,
						);
		}
		echo json_encode($data);
	}

	public function aktifitas_rekanan_top_nontendering($tahun){
		$result = $this->model->aktifitas_rekanan_top_nontendering($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"rkn_nama"				=> $rows->rkn_nama,
							"jml_paket"				=> $rows->jml_paket,
						);
		}
		echo json_encode($data);
	}

	public function kelompok_tender($tahun){
		$result = $this->model->kelompok_tender($tahun);
		$data = array();
		foreach ($result->result() as $rows) {
			$data[]	= array(
							"kategori"				=> $rows->kategori,
							"jml_paket"				=> $rows->jml_paket,
							"jml_hps"				=> $rows->jml_hps,
						);
		}
		echo json_encode($data);
	}
}
