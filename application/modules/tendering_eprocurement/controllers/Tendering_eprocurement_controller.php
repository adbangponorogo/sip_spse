<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_eprocurement_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tendering_eprocurement_model', 'model');
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
	// | --------------- REKAP DATA ------------------
	// | *********************************************
	// *************************************************

	public function rekap_data($tahun, $satker){
		$result	= $this->model->lelang_resume($tahun, $satker);
		$data 	= array();
		foreach ($result->result() as $rows) {
			$data 	= array(
							"total_paket"					=> number_format($rows->t_paket),
							"total_paket_selesai"			=> number_format($rows->t_paket_selesai),
							"total_paket_belum_selesai"		=> number_format($rows->t_paket_belum_selesai),
							"total_pagu"					=> number_format($rows->t_pagu),
							"total_pagu_selesai"			=> number_format($rows->t_pagu_selesai),
							"total_tawar"					=> number_format($rows->t_tawar),
							"selisih"						=> number_format($rows->selisih),
							"total_prosentase"				=> number_format($rows->ttl_pros, 2)
						);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | ------------ LELANG PER TAHUN ---------------
	// | *********************************************
	// *************************************************

	public function lelang_pertahun($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->lelang_pertahun($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"tahun" 						=> $rows_data->tahun,
										"total_paket" 					=> $rows_data->t_paket,
										"total_paket_selesai" 			=> $rows_data->t_paket_selesai,
										"total_paket_belum_selesai" 	=> $rows_data->t_paket_belum_selesai,
										"total_pagu" 					=> number_format($rows_data->t_pagu),
										"total_pagu_selesai" 			=> number_format($rows_data->t_pagu_selesai),
										"total_pagu_hasil_tawar" 		=> number_format($rows_data->t_tawar),
										"total_selisih_pagu" 			=> number_format($rows_data->selisih),
										"prosentase" 					=> number_format($rows_data->ttl_pros, 2)
									);
		}

		$result_total		= $this->model->total_lelang_pertahun($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
										"total_paket" 					=> $rows_total->t_paket,
										"total_paket_selesai" 			=> $rows_total->t_paket_selesai,
										"total_paket_belum_selesai" 	=> $rows_total->t_paket_belum_selesai,
										"total_pagu" 					=> number_format($rows_total->t_pagu),
										"total_pagu_selesai" 			=> number_format($rows_total->t_pagu_selesai),
										"total_pagu_hasil_tawar" 		=> number_format($rows_total->t_tawar),
										"total_selisih_pagu" 			=> number_format($rows_total->selisih),
										"prosentase" 					=> number_format($rows_total->ttl_pros, 2)
									);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | ------------ METODE PER TAHUN ---------------
	// | *********************************************
	// *************************************************

	public function metode_pertahun($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->metode_pertahun($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"metode" 						=> $rows_data->metode,
										"total_pagu" 					=> number_format($rows_data->total_pagu),
										"total_hasil_tawar" 			=> number_format($rows_data->t_tawar),
										"total_paket" 					=> $rows_data->total_paket,
										"total_paket_selesai" 			=> $rows_data->total_paket_selesai,
										"total_paket_belum_selesai" 	=> $rows_data->belum_selesai,
									);
		}

		$result_total		= $this->model->total_metode_pertahun($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
										"total_pagu" 					=> number_format($rows_total->total_pagu),
										"total_hasil_tawar" 			=> number_format($rows_total->t_tawar),
										"total_paket" 					=> $rows_total->total_paket,
										"total_paket_selesai" 			=> $rows_total->total_paket_selesai,
										"total_paket_belum_selesai" 	=> $rows_total->belum_selesai,
									);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | ----------- KELOMPOK PER TAHUN -------------
	// | *********************************************
	// *************************************************

	public function kelompok_pertahun($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->kelompok_pertahun($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"kategori" 						=> $rows_data->kategori,
										"paket_umum" 					=> $rows_data->pkt_umum,
										"pagu_umum" 					=> number_format($rows_data->pagu_umum),
										"paket_sederhana" 				=> $rows_data->pkt_sederhana,
										"pagu_sederhana" 				=> number_format($rows_data->pagu_sederhana),
										"paket_total" 					=> $rows_data->pkt_total,
										"pagu_total" 					=> number_format($rows_data->pagu_total),
									);
		}

		$result_total		= $this->model->total_kelompok_pertahun($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
										"total_paket_umum" 					=> $rows_total->pkt_umum,
										"total_pagu_umum" 					=> number_format($rows_total->pagu_umum),
										"total_paket_sederhana" 			=> $rows_total->pkt_sederhana,
										"total_pagu_sederhana" 				=> number_format($rows_total->pagu_sederhana),
										"total_paket_total" 				=> $rows_total->pkt_total,
										"total_pagu_total" 					=> number_format($rows_total->pagu_total),
									);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | ------------- AGENCY PER TAHUN --------------
	// | *********************************************
	// *************************************************

	public function agency_pertahun($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->agency_pertahun($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_agency" 					=> $rows_data->agc_nama,
										"total_paket" 					=> $rows_data->t_paket,
										"total_paket_selesai" 			=> $rows_data->t_paket_selesai,
										"total_paket_belum_selesai" 	=> $rows_data->t_paket_belum_selesai,
										"total_pagu" 					=> number_format($rows_data->t_pagu),
										"total_pagu_selesai" 			=> number_format($rows_data->t_pagu_selesai),
										"total_hasil_tawar" 			=> number_format($rows_data->t_tawar),
										"total_selisih" 				=> number_format($rows_data->selisih),
										"total_prosentase" 				=> number_format($rows_data->t_pros, 2),
									);
		}

		$result_total		= $this->model->total_agency_pertahun($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
										"total_paket" 					=> $rows_total->t_paket,
										"total_paket_selesai" 			=> $rows_total->t_paket_selesai,
										"total_paket_belum_selesai" 	=> $rows_total->t_paket_belum_selesai,
										"total_pagu" 					=> number_format($rows_total->t_pagu),
										"total_pagu_selesai" 			=> number_format($rows_total->t_pagu_selesai),
										"total_hasil_tawar" 			=> number_format($rows_total->t_tawar),
										"total_selisih" 				=> number_format($rows_total->selisih),
										"total_prosentase" 				=> number_format($rows_total->t_pros, 2),
									);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | ---------- ASAL PEMENANG PER TAHUN ----------
	// | *********************************************
	// *************************************************

	public function asal_pemenang_pertahun($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->asal_pemenang_pertahun($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_kota" 					=> $rows_data->nama_kota,
										"total_paket" 					=> $rows_data->t_paket,
										"total_pagu_paket" 				=> number_format($rows_data->pagu),
										"total_hps_paket" 				=> number_format($rows_data->hps),
										"total_hasil_tawar" 			=> number_format($rows_data->penawaran),
										"total_efisiensi" 				=> number_format($rows_data->efisiensi),
										"total_prosentase" 				=> number_format($rows_data->pro, 2),
									);
		}

		$result_total		= $this->model->total_asal_pemenang_pertahun($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
										"total_paket" 					=> $rows_total->t_paket,
										"total_pagu_paket" 				=> number_format($rows_total->pagu),
										"total_hps_paket" 				=> number_format($rows_total->hps),
										"total_hasil_tawar" 			=> number_format($rows_total->penawaran),
										"total_efisiensi" 				=> number_format($rows_total->efisiensi),
										"total_prosentase" 				=> number_format($rows_total->pro, 2),
									);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | ---------- SATUAN KERJA PER TAHUN ----------
	// | *********************************************
	// *************************************************

	public function satker_pertahun($tahun, $satker){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->satker_pertahun($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_satker" 					=> $rows_data->stk_nama,
										"total_paket" 					=> number_format($rows_data->t_paket),
										"total_paket_selesai" 			=> number_format($rows_data->t_paket_selesai),
										"total_paket_belum_selesai" 	=> number_format($rows_data->t_paket_belum_selesai),
										"total_pagu" 					=> number_format($rows_data->t_pagu),
										"total_pagu_selesai" 			=> number_format($rows_data->t_pagu_selesai),
										"total_hasil_tawar" 			=> number_format($rows_data->t_tawar),
										"total_selisih" 				=> number_format($rows_data->selisih),
										"total_prosentase" 				=> number_format($rows_data->t_pros, 2),
									);
		}

		$result_total		= $this->model->total_satker_pertahun($tahun, $satker);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
										"total_paket" 					=> number_format($rows_total->t_paket),
										"total_paket_selesai" 			=> number_format($rows_total->t_paket_selesai),
										"total_paket_belum_selesai" 	=> number_format($rows_total->t_paket_belum_selesai),
										"total_pagu" 					=> number_format($rows_total->t_pagu),
										"total_pagu_selesai" 			=> number_format($rows_total->t_pagu_selesai),
										"total_hasil_tawar" 			=> number_format($rows_total->t_tawar),
										"total_selisih" 				=> number_format($rows_total->selisih),
										"total_prosentase" 				=> number_format($rows_total->t_pros, 2),
									);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | ---------- TOP 10 TENDER PER TAHUN ----------
	// | *********************************************
	// *************************************************

	public function top_ten_tender_barang($tahun, $satker){
		$data["baris_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->top_ten_tender_barang($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_rekanan" 					=> $rows_data->rkn_nama,
										"nama_kabupaten" 				=> $rows_data->kbp_nama,
										"total_paket" 					=> number_format($rows_data->paket+0)." Pkt",
										"total_penawaran" 				=> number_format($rows_data->penawaran+0, 1)." M",
									);
		}
		echo json_encode($data);
	}

	public function top_ten_tender_konsultasi($tahun, $satker){
		$data["baris_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->top_ten_tender_konsultasi($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_rekanan" 					=> $rows_data->rkn_nama,
										"nama_kabupaten" 				=> $rows_data->kbp_nama,
										"total_paket" 					=> number_format($rows_data->paket+0)." Pkt",
										"total_penawaran" 				=> number_format($rows_data->penawaran+0, 1)." M",
									);
		}
		echo json_encode($data);
	}

	public function top_ten_tender_konstruksi($tahun, $satker){
		$data["baris_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->top_ten_tender_konstruksi($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_rekanan" 					=> $rows_data->rkn_nama,
										"nama_kabupaten" 				=> $rows_data->kbp_nama,
										"total_paket" 					=> number_format($rows_data->paket+0)." Pkt",
										"total_penawaran" 				=> number_format($rows_data->penawaran+0, 1)." M",
									);
		}
		echo json_encode($data);
	}




	// *************************************************
	// | *********************************************
	// | -------- TOP 10 NON TENDER PER TAHUN --------
	// | *********************************************
	// *************************************************

	public function top_ten_nontender_barang($tahun, $satker){
		$data["baris_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->top_ten_nontender_barang($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_rekanan" 					=> $rows_data->rkn_nama,
										"nama_kabupaten" 				=> $rows_data->kbp_nama,
										"total_paket" 					=> number_format($rows_data->paket+0)." Pkt",
										"total_penawaran" 				=> number_format($rows_data->penawaran+0, 1)." M",
									);
		}
		echo json_encode($data);
	}

	public function top_ten_nontender_konsultasi($tahun, $satker){
		$data["baris_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->top_ten_nontender_konsultasi($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_rekanan" 					=> $rows_data->rkn_nama,
										"nama_kabupaten" 				=> $rows_data->kbp_nama,
										"total_paket" 					=> number_format($rows_data->paket+0)." Pkt",
										"total_penawaran" 				=> number_format($rows_data->penawaran+0, 1)." M",
									);
		}
		echo json_encode($data);
	}

	public function top_ten_nontender_konstruksi($tahun, $satker){
		$data["baris_data"] = array();
		$no 				= 1;
		
		$result_data		= $this->model->top_ten_nontender_konstruksi($tahun, $satker);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
										"no" 							=> $no++,
										"nama_rekanan" 					=> $rows_data->rkn_nama,
										"nama_kabupaten" 				=> $rows_data->kbp_nama,
										"total_paket" 					=> number_format($rows_data->paket+0)." Pkt",
										"total_penawaran" 				=> number_format($rows_data->penawaran+0, 1)." M",
									);
		}
		echo json_encode($data);
	}
}
