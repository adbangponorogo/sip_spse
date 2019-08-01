<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_paketpengadaan_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tendering_paketpengadaan_model', 'model');
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

	public function sistem_tender($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->sistem_tender($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"id"					=> $rows_data->lls_id,
											"nama_opd"				=> $rows_data->stk_nama,
											"nama_paket"			=> 
																		"<b>Nama Paket : </b>".$rows_data->pkt_nama."<br>".
																		"<b>Asal Dana : </b>".str_replace(array('-', '_', ','), ' ', $rows_data->sbd_ket)."<br>".
																		"<b>Tahun : </b>".$rows_data->tahun."<br>".
																		"<b>Versi SPSE : </b>".$rows_data->versi_lelang."<br>",
											"hps"					=> number_format($rows_data->pkt_hps),
											"pemenang"				=> $rows_data->rkn_nama,
											"alamat"				=> $rows_data->kbp_nama,
											"penawaran"				=> number_format($rows_data->harga_terkoreksi),
											"efisiensi"				=> number_format($rows_data->efisiensi),
											"prosentase"			=> number_format($rows_data->prosentase, 2)
									);
		}

		$result_total		= $this->model->total_sistem_tender($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"hps"					=> number_format($rows_total->pkt_hps),
											"penawaran"				=> number_format($rows_total->penawaran),
											"efisiensi"				=> number_format($rows_total->efisiensi),
											"prosentase"			=> number_format($rows_total->prosentase, 2)
									);
		}
		echo json_encode($data);
	}

	public function partisipasi_penawaran($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->partisipasi_penawaran($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> 	$no++,
											"nama_paket"			=> 
																		"<b>Nama Paket : </b>".$rows_data->pkt_nama."<br>".
																		"<b>Asal Dana : </b>".str_replace(array('-', '_', ','), ' ', $rows_data->sbd_ket)."<br>".
																		"<b>Tahun : </b>".$rows_data->tahun."<br>".
																		"<b>Versi SPSE : </b>".$rows_data->versi_lelang."<br>".
																		"<b>Status : </b>".$rows_data->status."<br>".
																		"<b>ID RUP : </b>".$rows_data->rup_id."<br>".
																		"<b>ID Lelang : </b>".$rows_data->lls_id."<br>",
											"nama_opd"				=> 	$rows_data->stk_nama,
											"hps"					=> 	number_format($rows_data->pkt_hps),
											"peserta"				=> 	number_format($rows_data->jml_peserta)." Penyedia<br>".
																		number_format($rows_data->jml_rkn_nawar)." Penawar<br>",
											"pemenang"				=> 	$rows_data->rkn_nama,
											"nilai_kontrak"			=> 	number_format($rows_data->pen),
											"selisih"				=>
																		number_format($rows_data->efisiensi)."<br>".
																		number_format($rows_data->prosentase, 2)
									);
		}
		echo json_encode($data);
	}
	
	public function partisipasi_rekanan($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->partisipasi_rekanan($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> 	$no++,
											"nama_opd"				=> 	$rows_data->stk_nama,
											"nama_paket"			=> 
																		"<b>Nama Paket : </b>".$rows_data->pkt_nama."<br>".
																		"<b>ID Lelang : </b>".$rows_data->lls_id."<br>",
											"hps"					=> 	number_format($rows_data->pkt_hps),
											"pemenang"				=> 	
																		"<b>Nama Penyedia : </b>".$rows_data->rkn_nama."<br>".
																		"<b>Status : </b>".$rows_data->status."<br>",
											"penawaran"				=> 	number_format($rows_data->psr_harga)
									);
		}
		echo json_encode($data);
	}
}
