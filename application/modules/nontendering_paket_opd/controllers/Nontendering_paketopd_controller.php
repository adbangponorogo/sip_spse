<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nontendering_paketopd_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Nontendering_paketopd_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}


	// *************************************************
	// | *********************************************
	// | ----------- SISTEM NON TENDERING ------------
	// | *********************************************
	// *************************************************

	public function rekap_paket($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->rekap_paket($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd"				=> $rows_data->stk_nama,
											"paket_barang"			=> number_format($rows_data->pkt_barang),
											"hps_barang"			=> number_format($rows_data->hps_barang),
											"paket_konstruksi"		=> number_format($rows_data->pkt_konstruksi),
											"hps_konstruksi"		=> number_format($rows_data->hps_konstruksi),
											"paket_konsultasi"		=> number_format($rows_data->pkt_konsultansi),
											"hps_konsultasi"		=> number_format($rows_data->hps_konsultansi),
											"paket_jasa_lainnya"	=> number_format($rows_data->pkt_lainnya),
											"hps_jasa_lainnya"		=> number_format($rows_data->hps_lainnya),
											"total_paket"			=> number_format($rows_data->t_paket),
											"total_hps"				=> number_format($rows_data->t_hps),
									);
		}

		$result_total		= $this->model->total_rekap_paket($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"paket_barang"			=> number_format($rows_total->pkt_barang),
											"hps_barang"			=> number_format($rows_total->hps_barang),
											"paket_konstruksi"		=> number_format($rows_total->pkt_konstruksi),
											"hps_konstruksi"		=> number_format($rows_total->hps_konstruksi),
											"paket_konsultasi"		=> number_format($rows_total->pkt_konsultansi),
											"hps_konsultasi"		=> number_format($rows_total->hps_konsultansi),
											"paket_jasa_lainnya"	=> number_format($rows_total->pkt_lainnya),
											"hps_jasa_lainnya"		=> number_format($rows_total->hps_lainnya),
											"total_paket"			=> number_format($rows_total->t_paket),
											"total_hps"				=> number_format($rows_total->t_hps),
									);
		}
		echo json_encode($data);
	}

	public function hasil_paket($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->hasil_paket($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd"				=> $rows_data->stk_nama,
											"total_paket"			=> number_format($rows_data->total_paket),
											"total_pagu"			=> number_format($rows_data->total_pagu),
											"total_hasil_tawar"		=> number_format($rows_data->penawaran),
											"efisiensi"				=> number_format($rows_data->efisiensi),
											"prosentase"			=> number_format($rows_data->pro, 2)." %"
									);
		}

		$result_total		= $this->model->total_hasil_paket($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket"			=> number_format($rows_total->total_paket),
											"total_pagu"			=> number_format($rows_total->total_pagu),
											"total_hasil_tawar"		=> number_format($rows_total->penawaran),
											"efisiensi"				=> number_format($rows_total->efisiensi),
											"prosentase"			=> number_format($rows_total->pro, 2)." %"
									);
		}
		echo json_encode($data);
	}
}
