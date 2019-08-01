<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_kontrakopd_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tendering_kontrakopd_model', 'model');
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

	public function rekap_data($tahun, $satker){
		$result	= $this->model->lelang_resume($tahun, $satker);
		$data 	= array();
		foreach ($result->result() as $rows) {
			$data 	= array(
							"total_paket"					=> number_format($rows->total_paket),
							"total_paket_selesai"			=> number_format($rows->paket_selesai),
							"total_paket_belum_selesai"		=> number_format($rows->paket_belum_selesai),
							"total_paket_berkontrak"		=> number_format($rows->total_kontrak)
						);
		}
		echo json_encode($data);
	}

	public function kontrak_opd($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->kontrak_opd($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd"				=> $rows_data->stk_nama,
											"jumlah_kontrak"		=> number_format($rows_data->jml_kontrak),
											"total_hps"				=> number_format($rows_data->jml_hps),
											"total_penawaran"		=> number_format($rows_data->nilai_penawaran),
											"total_nilai_kontrak"	=> number_format($rows_data->nilai_kontrak)
									);
		}

		$result_total		= $this->model->total_kontrak_opd($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"jumlah_kontrak"		=> number_format($rows_total->jml_kontrak),
											"total_hps"				=> number_format($rows_total->jml_hps),
											"total_penawaran"		=> number_format($rows_total->nilai_penawaran),
											"total_nilai_kontrak"	=> number_format($rows_total->nilai_kontrak)
									);
		}
		echo json_encode($data);
	}

	public function paket_kontrak($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_kontrak($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd"				=> $rows_data->stk_nama,
											"nama_paket"			=> 
																		"<b>Nama Paket : </b>".$rows_data->pkt_nama."<br>".
																		"<b>Asal Dana : </b>".str_replace(array('-', '_', ','), ' ', $rows_data->sbd_ket)."<br>".
																		"<b>Kode Tender : </b>".$rows_data->lls_id."<br>".
																		"<b>Kode RUP : </b>".$rows_data->rup_id."<br>",
											"rekanan"				=> $rows_data->rkn_nama,
											"total_nilai_kontrak"		=> number_format($rows_data->kontrak_nilai),
											"no_kontrak"			=> 
																		"<b>No. Kontrak : </b>".$rows_data->kontrak_no."<br>".
																		"<b>Tanggal Kontrak : </b>".$rows_data->kontrak_tanggal,
											"jangka_waktu"			=> 
																		"<b>Mulai : </b>".$rows_data->kontrak_mulai."<br>".
																		"<b>Akhir : </b>".$rows_data->kontrak_akhir,
											"kategori"				=> 
																		"<b>Jenis Pengadaan : </b>".$rows_data->kategori."<br>".
																		"<b>Metode Pemilihan : </b>".$rows_data->metode
									);
		}
		echo json_encode($data);
	}
}
