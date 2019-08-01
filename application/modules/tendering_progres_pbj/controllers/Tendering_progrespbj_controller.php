<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_progrespbj_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tendering_progrespbj_model', 'model');
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
							"id"					=> $rows->stk_id,
							"nama_agency"			=> $rows->stk_nama
						);
		}
		echo json_encode($data);
	}


	// *************************************************
	// | *********************************************
	// | -------------- SISTEM TENDERING -------------
	// | *********************************************
	// *************************************************

	public function kategori_tender($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->kategori_tender($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"						=> $no++,
											"nama_opd"					=> $rows_data->stk_nama,
											"jenis_pengadaan"			=> $rows_data->kategori,
											"jumlah_paket"				=> number_format($rows_data->t_paket),
											"jumlah_paket_selesai"		=> number_format($rows_data->t_paket_selesai),
											"jumlah_paket_belum_selesai"=> number_format($rows_data->t_paket_belum_selesai),
											"total_hps"					=> number_format($rows_data->t_hps),
											"total_hasil_tawar"			=> number_format($rows_data->t_tawar),
											"selisih"					=>
																			"<b>Efisiensi : </b>".number_format($rows_data->efisiensi)."<br>".
																			"<b>Prosentase : </b>".number_format($rows_data->prosentase, 2)." %<br>"
									);
		}
		echo json_encode($data);
	}
}
