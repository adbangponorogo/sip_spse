<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_paketopd_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tendering_paketopd_model', 'model');
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

	public function rekap_paket_opd($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->rekap_paket_opd($tahun, $satker);
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

		$result_total		= $this->model->total_rekap_paket_opd($tahun, $satker);
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

	public function hasil_paket_opd($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->hasil_paket_opd($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd"				=> $rows_data->stk_nama,
											"paket"					=> number_format($rows_data->t_paket),
											"pagu"					=> number_format($rows_data->t_pagu),
											"penawaran"				=> number_format($rows_data->terkoreksi),
											"efisiensi"				=> number_format($rows_data->selisih),
											"prosentase"			=> number_format($rows_data->t_pros)
									);
		}

		$result_total		= $this->model->total_hasil_paket_opd($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"paket"					=> number_format($rows_total->jml_satker_t_paket),
											"pagu"					=> number_format($rows_total->jml_satker_pagu),
											"penawaran"				=> number_format($rows_total->jml_satker_terkoreksi),
											"efisiensi"				=> number_format($rows_total->jml_satker_selisih),
											"prosentase"			=> number_format($rows_total->jml_satker_t_pros)
									);
		}
		echo json_encode($data);
	}
}
