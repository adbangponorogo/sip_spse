<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sirup_data_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Sirup_data_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}




	// *************************************************
	// | *********************************************
	// | -------- DATA RUP - DATA PAKET OPD --------
	// | *********************************************
	// *************************************************

	public function paket_opd($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_opd($tahun);
		foreach ($result_data->result() as $rows_data) {
			if (!is_null($rows_data->nama_kegiatan) || $rows_data->nama_kegiatan != '') {
				$nama_kegiatan = $rows_data->nama_kegiatan;
			}
			if (is_null($rows_data->nama_kegiatan) || $rows_data->nama_kegiatan == '') {
				$nama_kegiatan = '-';
			}
			$data["baris_data"][] = array(
											"no"							=> $no++,
											"id_rup"						=> $rows_data->id_rup+0,
											"nama_satker" 					=> strtoupper($rows_data->nama_satker),
											"nama_kegiatan" 				=> strtoupper($nama_kegiatan),
											"nama_paket" 					=> strtoupper($rows_data->nama_paket),
											"jenis_pengadaan" 				=> strtoupper($rows_data->jenis_pengadaan_str),
											"metode_pemilihan" 				=> strtoupper($rows_data->metode_pemilihan_str),
											"sumber_dana"					=> strtoupper($rows_data->sumber_dana_str),
											"total_pagu"					=> number_format($rows_data->total_pagu+0),
											"tanggal_buat"					=> $rows_data->tanggal_buat
									);
		}
		echo json_encode($data);
	}
}
