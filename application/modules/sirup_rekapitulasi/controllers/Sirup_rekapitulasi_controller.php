<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sirup_rekapitulasi_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Sirup_rekapitulasi_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}


	// *************************************************
	// | *********************************************
	// | ----------- SISTEM NON TENDERING ------------
	// | *********************************************
	// *************************************************

	public function statistik_rekap_paket_penyedia($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->statistik_rekap_paket_penyedia($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"paket_pengadaan_langsung"	=> number_format($rows_data->pengadaan_langsung+0),
											"paket_tender_cepat"		=> number_format($rows_data->tender_cepat+0),
											"paket_tender"				=> number_format($rows_data->tender+0),
											"paket_seleksi"				=> number_format($rows_data->seleksi+0),
											"paket_penunjukan_langsung"	=> number_format($rows_data->penunjukan_langsung+0),
											"paket_epurchasing"			=> number_format($rows_data->e_purchasing+0),
											"pagu_pengadaan_langsung"	=> number_format($rows_data->pg_pl+0),
											"pagu_tender_cepat"			=> number_format($rows_data->pg_tc+0),
											"pagu_tender"				=> number_format($rows_data->pg_t+0),
											"pagu_seleksi"				=> number_format($rows_data->pg_sl+0),
											"pagu_penunjukan_langsung"	=> number_format($rows_data->pg_plg+0),
											"pagu_epurchasing"			=> number_format($rows_data->pg_ep+0),
									);
		}
		echo json_encode($data);
	}

	public function perencanaan_belanja_pemda($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->perencanaan_belanja_pemda($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd"				=> $rows_data->nama_satker,
											"total_btl"				=> number_format($rows_data->btl),
											"total_bl"				=> number_format($rows_data->bl),
											"total_anggaran"		=> number_format($rows_data->jml_pagu)
									);
		}

		$result_total		= $this->model->total_perencanaan_belanja_pemda($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_btl"				=> number_format($rows_total->btl),
											"total_bl"				=> number_format($rows_total->bl),
											"total_anggaran"		=> number_format($rows_total->jml_pagu)
									);
		}
		echo json_encode($data);
	}

	public function analisis_rup($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->analisis_rup($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd"				=> $rows_data->nama_satker,
											"pagu_bl"				=> number_format($rows_data->bl),
											"rup_tayang_penyedia"	=> number_format($rows_data->pg_sudah_penyedia),
											"rup_tayang_swakelola"	=> number_format($rows_data->pg_sudah_swakelola),
											"rup_draft_penyedia"	=> number_format($rows_data->pg_belum_penyedia),
											"rup_draft_swakelola"	=> number_format($rows_data->pg_belum_swakelola),
											"pagu_tayang"			=> number_format($rows_data->pg_rup_tayang),
											"selisih"				=> number_format($rows_data->pg_selisih_rup_tayang)
									);
		}

		$result_total		= $this->model->total_analisis_rup($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"pagu_bl"				=> number_format($rows_total->bl),
											"rup_tayang_penyedia"	=> number_format($rows_total->pg_sudah_penyedia),
											"rup_tayang_swakelola"	=> number_format($rows_total->pg_sudah_swakelola),
											"rup_draft_penyedia"	=> number_format($rows_total->pg_belum_penyedia),
											"rup_draft_swakelola"	=> number_format($rows_total->pg_belum_swakelola),
											"pagu_tayang"			=> number_format($rows_total->pg_rup_tayang),
											"selisih"				=> number_format($rows_total->pg_selisih_rup_tayang)
									);
		}
		echo json_encode($data);
	}

	public function tepra_rup($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->tepra_rup($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"jenis_pengadaan" 		=> $rows_data->jenis_pengadaan_str,
											"paket_krg_200jt" 		=> number_format($rows_data->pkt_kur_200),
											"pagu_krg_200jt" 		=> number_format($rows_data->pg_kur_200),
											"paket_krg_2k5m" 		=> number_format($rows_data->pkt_kur_25),
											"pagu_krg_2k5m" 		=> number_format($rows_data->pg_kur_25),
											"paket_krg_50m" 		=> number_format($rows_data->pkt_kur_50),
											"pagu_krg_50m" 			=> number_format($rows_data->pg_kur_50),
											"paket_krg_100m" 		=> number_format($rows_data->pkt_kur_100),
											"pagu_krg_100m" 		=> number_format($rows_data->pg_kur_100),
											"paket_lbh_100m" 		=> number_format($rows_data->pkt_bih_100),
											"pagu_lbh_100m" 		=> number_format($rows_data->pg_bih_100),
											"paket_swakelola" 		=> "-",
											"pagu_swakelola" 		=> "-",
											"total_paket" 			=> number_format($rows_data->jumlah_paket),
											"total_pagu" 			=> number_format($rows_data->total_pagu),
									);
		}

		$result_total		= $this->model->total_tepra_rup($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"paket_krg_200jt" 		=> number_format($rows_total->pkt_kur_200),
											"pagu_krg_200jt" 		=> number_format($rows_total->pg_kur_200),
											"paket_krg_2k5m" 		=> number_format($rows_total->pkt_kur_25),
											"pagu_krg_2k5m" 		=> number_format($rows_total->pg_kur_25),
											"paket_krg_50m" 		=> number_format($rows_total->pkt_kur_50),
											"pagu_krg_50m" 			=> number_format($rows_total->pg_kur_50),
											"paket_krg_100m" 		=> number_format($rows_total->pkt_kur_100),
											"pagu_krg_100m" 		=> number_format($rows_total->pg_kur_100),
											"paket_lbh_100m" 		=> number_format($rows_total->pkt_bih_100),
											"pagu_lbh_100m" 		=> number_format($rows_total->pg_bih_100),
											"paket_swakelola" 		=> number_format($rows_total->pkt_swa),
											"pagu_swakelola" 		=> number_format($rows_total->pg_swa),
											"total_paket" 			=> number_format($rows_total->jumlah_paket),
											"total_pagu" 			=> number_format($rows_total->total_pagu),
									);
		}
		echo json_encode($data);
	}

	public function progres_identifikasi_paket($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->progres_identifikasi_paket($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"prosentase_progres"	=> number_format($rows_data->pro_pagu+0, 2),
											"prosentase_progres1"	=> number_format($rows_data->pro1_pagu+0, 2),
									);
		}
		echo json_encode($data);
	}






	// *************************************************
	// | *********************************************
	// | -------- DATA RUP - STATUS RUP --------
	// | *********************************************
	// *************************************************

	public function paket_penyedia_tayang($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_penyedia_tayang($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd" 				=> strtoupper($rows_data->nama_satker),
											"total_paket" 			=> number_format($rows_data->jml_paket),
											"total_pagu" 			=> number_format($rows_data->jml_pagu),
									);
		}

		$result_total		= $this->model->total_paket_penyedia_tayang($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket" 			=> number_format($rows_total->jml_paket),
											"total_pagu" 			=> number_format($rows_total->jml_pagu),
									);
		}
		echo json_encode($data);
	}

	public function paket_penyedia_belum_tayang($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_penyedia_belum_tayang($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd" 				=> strtoupper($rows_data->nama_satker),
											"total_paket" 			=> number_format($rows_data->jml_paket),
											"total_pagu" 			=> number_format($rows_data->jml_pagu),
									);
		}

		$result_total		= $this->model->total_paket_penyedia_belum_tayang($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket" 			=> number_format($rows_total->jml_paket),
											"total_pagu" 			=> number_format($rows_total->jml_pagu),
									);
		}
		echo json_encode($data);
	}

	public function paket_swakelola_tayang($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_swakelola_tayang($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd" 				=> strtoupper($rows_data->nama_satker),
											"total_paket" 			=> number_format($rows_data->jml_paket),
											"total_pagu" 			=> number_format($rows_data->jml_pagu),
									);
		}

		$result_total		= $this->model->total_paket_swakelola_tayang($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket" 			=> number_format($rows_total->jml_paket),
											"total_pagu" 			=> number_format($rows_total->jml_pagu),
									);
		}
		echo json_encode($data);
	}

	public function paket_swakelola_belum_tayang($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_swakelola_belum_tayang($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd" 				=> strtoupper($rows_data->nama_satker),
											"total_paket" 			=> number_format($rows_data->jml_paket),
											"total_pagu" 			=> number_format($rows_data->jml_pagu),
									);
		}

		$result_total		= $this->model->total_paket_swakelola_belum_tayang($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket" 			=> number_format($rows_total->jml_paket),
											"total_pagu" 			=> number_format($rows_total->jml_pagu),
									);
		}
		echo json_encode($data);
	}





	// *************************************************
	// | *********************************************
	// | -------- DATA RUP - PAKET PENYEDIA --------
	// | *********************************************
	// *************************************************

	public function paket_penyedia_statistik_rekap($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_penyedia_statistik_rekap($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"jml_paket"				=> number_format($rows_data->jml_paket),
											"jml_pagu" 				=> number_format($rows_data->jml_pagu),
											"jml_opd" 				=> number_format($rows_data->jml_opd),
											"jml_opd_min" 			=> number_format($rows_data->jml_opd_min),
											"pro_pagu" 				=> number_format($rows_data->pro_pagu),
									);
		}
		echo json_encode($data);
	}

	public function paket_penyedia_rekapitulasi_progres($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_penyedia_rekapitulasi_progres($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"jml_paket"				=> number_format($rows_data->jml_paket),
											"jml_pagu" 				=> number_format($rows_data->jml_pagu),
											"jml_opd" 				=> number_format($rows_data->jml_opd),
											"jml_opd_min" 			=> number_format($rows_data->jml_opd_min),
											"pro_pagu" 				=> number_format($rows_data->pro_pagu),
											"pro_opd_min" 			=> number_format($rows_data->pro_opd_min),
											"pro_opd" 				=> number_format($rows_data->pro_opd),
									);
		}
		echo json_encode($data);
	}

	public function paket_penyedia_rekapitulasi_rup_opd($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_penyedia_rekapitulasi_rup_opd($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd" 				=> strtoupper($rows_data->nama_satker),
											"total_paket_pl" 		=> number_format($rows_data->pengadaan_langsung),
											"total_pagu_pl" 		=> number_format($rows_data->pg_pl),
											"total_paket_t" 		=> number_format($rows_data->tender),
											"total_pagu_t" 			=> number_format($rows_data->pg_t),
											"total_paket_tc" 		=> number_format($rows_data->tender_cepat),
											"total_pagu_tc" 		=> number_format($rows_data->pg_tc),
											"total_paket_sl" 		=> number_format($rows_data->seleksi),
											"total_pagu_sl" 		=> number_format($rows_data->pg_sl),
											"total_paket_plg" 		=> number_format($rows_data->penunjukan_langsung),
											"total_pagu_plg" 		=> number_format($rows_data->pg_plg),
											"total_paket_ep" 		=> number_format($rows_data->e_purchasing),
											"total_pagu_ep" 		=> number_format($rows_data->pg_ep),
											"total_paket" 			=> number_format($rows_data->jumlah_paket),
											"total_pagu" 			=> number_format($rows_data->total_pagu)
									);
		}

		$result_total		= $this->model->paket_penyedia_total_rekapitulasi_rup_opd($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket_pl" 		=> number_format($rows_total->pengadaan_langsung),
											"total_pagu_pl" 		=> number_format($rows_total->pg_pl),
											"total_paket_t" 		=> number_format($rows_total->tender),
											"total_pagu_t" 			=> number_format($rows_total->pg_t),
											"total_paket_tc" 		=> number_format($rows_total->tender_cepat),
											"total_pagu_tc" 		=> number_format($rows_total->pg_tc),
											"total_paket_sl" 		=> number_format($rows_total->seleksi),
											"total_pagu_sl" 		=> number_format($rows_total->pg_sl),
											"total_paket_plg" 		=> number_format($rows_total->penunjukan_langsung),
											"total_pagu_plg" 		=> number_format($rows_total->pg_plg),
											"total_paket_ep" 		=> number_format($rows_total->e_purchasing),
											"total_pagu_ep" 		=> number_format($rows_total->pg_ep),
											"total_paket" 			=> number_format($rows_total->jumlah_paket),
											"total_pagu" 			=> number_format($rows_total->total_pagu)
									);
		}
		echo json_encode($data);
	}

	public function paket_penyedia_data_rup($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_penyedia_data_rup($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"id_rup" 				=> $rows_data->id,
											"nama_opd" 				=> strtoupper($rows_data->nama_satker),
											"nama_kegiatan" 		=> $rows_data->kegiatan,
											"nama_paket" 			=> $rows_data->nama,
											"jenis_pengadaan" 		=> $rows_data->jenis_pengadaan_str,
											"metode_pemilihan" 		=> $rows_data->motode_str,
											"sumber_dana" 			=> $rows_data->sumber_dana_string,
											"total_pagu" 			=> number_format($rows_data->total_pagu),
											"tgl_buat" 				=> $rows_data->create_time,
									);
		}
		echo json_encode($data);
	}





	// *************************************************
	// | *********************************************
	// | ------- DATA RUP - PAKET SWAKELOLA -------
	// | *********************************************
	// *************************************************


	public function paket_swakelola_statistik_rekap($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_swakelola_statistik_rekap($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"jml_paket"				=> number_format($rows_data->jml_paket),
											"jml_pagu" 				=> number_format($rows_data->jml_pagu),
											"jml_opd" 				=> number_format($rows_data->jml_opd),
											"jml_opd_min" 			=> number_format($rows_data->jml_opd_min),
											"pro_pagu" 				=> number_format($rows_data->pro_pagu),
									);
		}
		echo json_encode($data);
	}

	public function paket_swakelola_rekapitulasi_progres($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_swakelola_rekapitulasi_progres($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"jml_paket"				=> number_format($rows_data->jml_paket),
											"jml_pagu" 				=> number_format($rows_data->jml_pagu),
											"jml_opd" 				=> number_format($rows_data->jml_opd),
											"jml_opd_min" 			=> number_format($rows_data->jml_opd_min),
											"pro_pagu" 				=> number_format($rows_data->pro_pagu),
											"pro_opd_min" 			=> number_format($rows_data->pro_opd_min),
											"pro_opd" 				=> number_format($rows_data->pro_opd),
									);
		}
		echo json_encode($data);
	}

	public function paket_swakelola_rekapitulasi_rup_opd($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_swakelola_rekapitulasi_rup_opd($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"nama_opd" 				=> strtoupper($rows_data->nama_satker),
											"total_paket" 			=> number_format($rows_data->jumlah_paket),
											"total_pagu" 			=> number_format($rows_data->total_pagu)
									);
		}

		$result_total		= $this->model->paket_swakelola_total_rekapitulasi_rup_opd($tahun);
		foreach ($result_total->result() as $rows_total) {
			$data["total_data"][] = array(
											"total_paket" 			=> number_format($rows_total->jumlah_paket),
											"total_pagu" 			=> number_format($rows_total->total_pagu)
									);
		}
		echo json_encode($data);
	}

	public function paket_swakelola_data_rup($tahun){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->paket_swakelola_data_rup($tahun);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"					=> $no++,
											"id_rup" 				=> $rows_data->id,
											"nama_opd" 				=> strtoupper($rows_data->nama_satker),
											"nama_paket" 			=> $rows_data->nama_paket,
											"sumber_dana" 			=> $rows_data->sumber_dana_string,
											"total_pagu" 			=> number_format($rows_data->total_pagu),
											"tgl_buat" 				=> $rows_data->create_time,
									);
		}
		echo json_encode($data);
	}
}
