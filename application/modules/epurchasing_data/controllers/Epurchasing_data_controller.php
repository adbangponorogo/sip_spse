<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epurchasing_data_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Epurchasing_data_model', 'model');
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
			$data["baris_data"][] = array(
											"no"							=> $no++,
											"nama_satker" 					=> strtoupper($rows_data->satuan_kerja_nama),
											"nama_ppk" 						=> strtoupper($rows_data->nama_ppk),
											"nama_komoditas" 				=> 
																				"<b>Komoditas : </b>".$rows_data->nama_komoditas."<br>".
																				"<b>No. Paket : </b>".$rows_data->no_paket."<br>".
																				"<b>Nama Paket : </b>".$rows_data->nama_paket."<br>".
																				"<b>Kode RUP : </b>".$rows_data->rup_id."<br>",
											"nama_penyedia" 				=> $rows_data->nama_penyedia,
											"nama_distributor" 				=> $rows_data->nama_distributor,
											"jumlah_produk"					=> $rows_data->jml_jenis_produk." Bh/Unit",
											"total_pagu"					=> number_format($rows_data->total+0),
											"tanggal_buat"					=> $rows_data->tanggal_buat_paket
									);
		}
		echo json_encode($data);
	}
}
