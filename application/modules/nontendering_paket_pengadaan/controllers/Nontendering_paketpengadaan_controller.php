<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nontendering_paketpengadaan_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Nontendering_paketpengadaan_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}


	// *************************************************
	// | *********************************************
	// | ----------- SISTEM NON TENDERING ------------
	// | *********************************************
	// *************************************************

	public function data_paket($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->data_paket($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"						=> $no++,
											"id_paket"					=> $rows_data->lls_id,
											"nama_opd"					=> $rows_data->stk_nama,
											"nama_paket"				=>
																			"<b>Nama Paket : </b>".$rows_data->pkt_nama."<br>".
																			"<b>Asal Dana : </b>".str_replace(array('-', '_', ','), ' ', $rows_data->sbd_ket)."<br>".
																			"<b>Tahun : </b>".$rows_data->tahun."<br>".
																			"<b>Metode : </b>".$rows_data->metoda."<br>",
											"total_pagu"				=> number_format($rows_data->pkt_pagu),
											"total_hps"					=> number_format($rows_data->pkt_hps),
											"pemenang"					=> $rows_data->rkn_nama,
											"alamat"					=> $rows_data->kbp_nama,
											"total_hasil_tawar"			=> number_format($rows_data->harga_terkoreksi),
											"total_efisiensi"			=> number_format($rows_data->efisiensi),
											"prosentase"				=> number_format($rows_data->prosentase, 2),
									);
		}
		echo json_encode($data);
	}
}
