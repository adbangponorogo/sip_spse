<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sirup_paket_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Sirup_paket_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}


	// *************************************************
	// | *********************************************
	// | ----------- SISTEM NON TENDERING ------------
	// | *********************************************
	// *************************************************

	public function statistik_rekap($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->statistik_rekap($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"paket_pencatatan_non_tender"	=> number_format($rows_data->pencatatan_non_tender+0),
											"paket_non_tender"				=> number_format($rows_data->non_tender+0),
											"paket_tender"					=> number_format($rows_data->tender+0),
											"paket_seleksi"					=> number_format($rows_data->seleksi+0),
									);
		}
		echo json_encode($data);
	}






	// *************************************************
	// | *********************************************
	// | -------- DATA RUP - REKAPITULASI PAKET --------
	// | *********************************************
	// *************************************************

	public function rekapitulasi_paket_opd($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->rekapitulasi_paket_opd($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"							=> $no++,
											"nama_opd" 						=> strtoupper($rows_data->nama_satker),
											"paket_pencatatan_non_tender"	=> number_format($rows_data->pencatatan_non_tender+0),
											"paket_non_tender"				=> number_format($rows_data->non_tender+0),
											"paket_tender"					=> number_format($rows_data->tender+0),
											"paket_seleksi"					=> number_format($rows_data->seleksi+0),
									);
		}

		$result_total		= $this->model->total_rekapitulasi_paket_opd($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"paket_pencatatan_non_tender"	=> number_format($rows_total->pencatatan_non_tender+0),
											"paket_non_tender"				=> number_format($rows_total->non_tender+0),
											"paket_tender"					=> number_format($rows_total->tender+0),
											"paket_seleksi"					=> number_format($rows_total->seleksi+0),
									);
		}
		echo json_encode($data);
	}





	// *************************************************
	// | *********************************************
	// | -------- DATA RUP - PAKET TENDER/SELEKSI --------
	// | *********************************************
	// *************************************************

	public function paket_tender_seleksi($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_tender_seleksi($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"							=> $no++,
											"nama_opd" 						=> strtoupper($rows_data->nama_satker),
											"kode_rup"						=> $rows_data->id+0,
											"nama_paket" 					=> strtoupper($rows_data->nama),
											"pagu_paket"					=> number_format($rows_data->total_pagu+0),
											"metode_pemilihan" 				=> $rows_data->motode_str,
											"sumber_dana" 					=> $rows_data->sumber_dana_string,
											"waktu_pemilihan" 				=> $this->date_month_year_string($rows_data->waktu_pemilihan),
											"akhir_pengadaan" 				=> $this->date_month_year_string($rows_data->akhir_pengadaan),
											"akhir_pekerjaan" 				=> $this->date_month_year_string($rows_data->akhir_pekerjaan),
											"tanggal_dibuat" 				=> $this->date_month_year_string($rows_data->create_time),
									);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | -------- DATA RUP - RINCIAN PAKET --------
	// | *********************************************
	// *************************************************

	public function rincian_paket($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->rincian_paket($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"							=> $no++,
											"nama_opd" 						=> strtoupper($rows_data->nama_satker),
											"kode_rup"						=> $rows_data->id+0,
											"nama_kagiatan" 				=> $rows_data->kegiatan,
											"nama_paket" 					=> strtoupper($rows_data->nama),
											"jenis_pengadaan" 				=> $rows_data->jenis_pengadaan_str,
											"pagu_paket"					=> number_format($rows_data->total_pagu+0),
											"metode_pemilihan" 				=> $rows_data->motode_str,
									);
		}
		echo json_encode($data);
	}









	// *************************************************
	// | *********************************************
	// | ------------------- MISC --------------------
	// | *********************************************
	// *************************************************

	public function date_month_year_string($date){
		$create_date = date_create($date);
		$get_month = date_format($create_date, 'm');
		$get_year = date_format($create_date, 'Y');
		$month = '-';
		if ($get_month == '01'){$month='Januari';}if ($get_month == '02'){$month='Februari';}
		if ($get_month == '03'){$month='Maret';}if ($get_month == '04'){$month='April';}
		if ($get_month == '05'){$month='Mei';}if ($get_month == '06'){$month='Juni';}
		if ($get_month == '07'){$month='Juli';}if ($get_month == '08'){$month='Agustus';}
		if ($get_month == '09'){$month='September';}if ($get_month == '10'){$month='Oktober';}
		if ($get_month == '11'){$month='November';}if ($get_month == '12'){$month='Desember';}

		return $month." ".$get_year;
	}
}
