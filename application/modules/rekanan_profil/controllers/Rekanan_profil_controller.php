<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan_profil_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Rekanan_profil_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}




	// *************************************************
	// | *********************************************
	// | -------- DATA RUP - DATA PAKET OPD --------
	// | *********************************************
	// *************************************************

	public function rekanan_provinsi($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->rekanan_provinsi($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"							=> $no++,
											"nama_provinsi" 				=> strtoupper($rows_data->prp_nama),
											"terdaftar" 					=> number_format($rows_data->rkn+0),
											"terverifikasi" 				=> number_format($rows_data->sdh+0),
											"belum_verifikasi" 				=> number_format($rows_data->blm+0),
											"tertolak" 						=> number_format($rows_data->tolak+0)
									);
		}


		$result_total		= $this->model->total_rekanan_provinsi($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"terdaftar"						=> number_format($rows_total->rkn+0),
											"terverifikasi"					=> number_format($rows_total->sdh+0),
											"belum_verifikasi"				=> number_format($rows_total->blm+0),
											"tertolak"						=> number_format($rows_total->tolak+0)
									);
		}
		echo json_encode($data);
	}


	public function rekanan_kabupaten($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->rekanan_kabupaten($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"							=> $no++,
											"nama_kabupaten" 				=> strtoupper($rows_data->kbp_nama),
											"terdaftar" 					=> number_format($rows_data->rkn+0),
											"terverifikasi" 				=> number_format($rows_data->sdh+0),
											"belum_verifikasi" 				=> number_format($rows_data->blm+0),
											"tertolak" 						=> number_format($rows_data->tolak+0)
									);
		}


		$result_total		= $this->model->total_rekanan_kabupaten($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"terdaftar"						=> number_format($rows_total->rkn+0),
											"terverifikasi"					=> number_format($rows_total->sdh+0),
											"belum_verifikasi"				=> number_format($rows_total->blm+0),
											"tertolak"						=> number_format($rows_total->tolak+0)
									);
		}
		echo json_encode($data);
	}


	public function kelompok_usaha_kabupaten($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->kelompok_usaha_kabupaten($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"							=> $no++,
											"nama_kabupaten" 				=> strtoupper($rows_data->kbp_nama),
											"cv" 							=> number_format($rows_data->cv+0),
											"pt" 							=> number_format($rows_data->pt+0),
											"ud" 							=> number_format($rows_data->ud+0),
											"kop" 							=> number_format($rows_data->kop+0),
											"pd" 							=> number_format($rows_data->pd+0),
											"kecil" 						=> number_format($rows_data->kecil+0),
											"non" 							=> number_format($rows_data->non+0),
											"gab" 							=> number_format($rows_data->gab+0),
											"blm" 							=> number_format($rows_data->blm+0)
									);
		}


		$result_total		= $this->model->total_kelompok_usaha_kabupaten($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"cv" 							=> number_format($rows_total->cv+0),
											"pt" 							=> number_format($rows_total->pt+0),
											"ud" 							=> number_format($rows_total->ud+0),
											"kop" 							=> number_format($rows_total->kop+0),
											"pd" 							=> number_format($rows_total->pd+0),
											"kecil" 						=> number_format($rows_total->kecil+0),
											"non" 							=> number_format($rows_total->non+0),
											"gab" 							=> number_format($rows_total->gab+0),
											"blm" 							=> number_format($rows_total->blm+0)
									);
		}
		echo json_encode($data);
	}
}
