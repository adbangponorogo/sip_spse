<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_paketgagal_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tendering_paketgagal_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}




	// *************************************************
	// | *********************************************
	// | ------------- PENCARIAN DATA ----------------
	// | *********************************************
	// *************************************************

	public function agency_data(){
		$result	= $this->model->get_agency();
		$data 	= array();
		foreach ($result->result() as $rows) {
			$data[] 	= array(
							"id"					=> $rows->agc_id,
							"nama_agency"			=> $rows->agc_nama
						);
		}
		echo json_encode($data);
	}


	// *************************************************
	// | *********************************************
	// | -------------- SISTEM TENDERING -------------
	// | *********************************************
	// *************************************************

	public function rekap_gagal($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->rekap_gagal($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"tahun"					=> $rows_data->tahun,
											"total_paket"			=> number_format($rows_data->jml_pkt_gagal),
											"total_pagu"			=> number_format($rows_data->jml_pagu_gagal),
											"total_hps"				=> number_format($rows_data->jml_hps_gagal)
									);
		}

		$result_total		= $this->model->total_rekap_gagal($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket"			=> number_format($rows_total->jml_pkt_gagal),
											"total_pagu"			=> number_format($rows_total->jml_pagu_gagal),
											"total_hps"				=> number_format($rows_total->jml_hps_gagal)
									);
		}
		echo json_encode($data);
	}

	public function data_gagal($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->data_gagal($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"tahun"					=> $rows_data->tahun,
											"nama_opd"				=> $rows_data->stk_nama,
											"kode_lelang"			=> $rows_data->lls_id,
											"nama_paket"			=> 
																		"<b>Nama Paket : </b>".$rows_data->pkt_nama."<br>".
																		"<b>Versi SPSE : </b>".$rows_data->versi_lelang."<br>",
											"total_pagu"			=> number_format($rows_data->pkt_pagu),
											"alasan"				=> $rows_data->alasan
									);
		}

		$result_total		= $this->model->total_data_gagal($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_pagu"			=> number_format($rows_total->pkt_pagu)
									);
		}
		echo json_encode($data);
	}
}
