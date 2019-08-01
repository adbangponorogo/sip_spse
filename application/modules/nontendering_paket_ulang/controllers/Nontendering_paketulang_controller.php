<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nontendering_paketulang_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Nontendering_paketulang_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}


	// *************************************************
	// | *********************************************
	// | ----------- SISTEM NON TENDERING ------------
	// | *********************************************
	// *************************************************

	public function rekap_retendering($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->rekap_retendering($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"tahun"					=> $rows_data->tahun,
											"total_paket"			=> number_format($rows_data->jml_pkt_ulang),
											"total_pagu"			=> number_format($rows_data->jml_pagu_ulang)
									);
		}

		$result_total		= $this->model->total_rekap_retendering($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket"			=> number_format($rows_total->jml_pkt_ulang),
											"total_pagu"			=> number_format($rows_total->jml_pagu_ulang)
									);
		}
		echo json_encode($data);
	}

	public function data_retendering($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->data_retendering($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"tahun"					=> $rows_data->tahun,
											"nama_opd"				=> $rows_data->stk_nama,
											"kode_lelang"			=> $rows_data->lls_id,
											"nama_paket"			=> $rows_data->pkt_nama,
											"total_pagu"			=> number_format($rows_data->pkt_pagu),
											"alasan"				=> $rows_data->alasan
									);

		}

		$result_total		= $this->model->total_data_retendering($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_pagu"			=> number_format($rows_data->pkt_pagu)
									);
		}
		echo json_encode($data);
	}
}
