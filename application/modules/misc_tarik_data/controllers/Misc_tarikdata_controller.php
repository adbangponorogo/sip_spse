<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misc_tarikdata_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Misc_tarikdata_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}


	public function select_all_data_info_privasi(){
		// Variable
		$kode_sirup 		= 'D196';
		
		// Get Data
		$result_data		= $this->model->get_all_data_info_privasi();
		if ($result_data->num_rows() > 0) {
			foreach ($result_data->result() as $rows_data) {
				
				// Get Data Array
				foreach (unserialize($rows_data->engine) as $rows) {
					$kode_sirup 	= $rows["kode_sirup"];
				}

			}
		}

		return $kode_sirup;
	}




	// *************************************************
	// | *********************************************
	// | --------------  DATA PENYEDIA ---------------
	// | *********************************************
	// *************************************************

	public function penyedia_tayang($tahun){
		$data 			= array();
		$kode_daerah	= $this->select_all_data_info_privasi();
		$count 			= 0;

		$delete = $this->model->delete_penyedia_tayang($tahun);
		if ($delete == TRUE) {
			$result	= json_decode(file_get_contents('https://inaproc.lkpp.go.id/isb/api/08fdd093-4cb2-4549-8a00-d53c000880ef/json/13034705/pengumumanruptahunan/tipe/4:12/parameter/'.$tahun.':'.$kode_daerah));
			foreach ($result as $rows) {
				$data 	= array(
								"tahun" 					=> $tahun,
								"id_satker" 				=> $rows->id_satker,
								"nama_satker" 				=> $rows->nama_satker,
								"id" 						=> $rows->id,
								"namaprogram"				=> $rows->namaprogram,
								"kegiatan" 					=> $rows->kegiatan,
								"nama"						=> $rows->nama,
								"lokasi_pekerjaan" 			=> $rows->lokasi_pekerjaan,
								"jenis_belanja_str" 		=> $rows->jenis_belanja_str,
								"jenis_pengadaan_str" 		=> $rows->jenis_pengadaan_str,
								"volume" 					=> $rows->volume,
								"motode_str" 				=> $rows->motode_str,
								"tanggal_awal_pengadaan" 	=> $rows->tanggal_awal_pengadaan,
								"tanggal_akhir_pengadaan" 	=> $rows->tanggal_akhir_pengadaan,
								"tanggal_awal_pekerjaan" 	=> $rows->tanggal_awal_pekerjaan,
								"tanggal_akhir_pekerjaan" 	=> $rows->tanggal_akhir_pekerjaan,
								"sumber_dana_string" 		=> $rows->sumber_dana_string,
								"mak" 						=> $rows->mak,
								"pagu_mak" 					=> $rows->pagu_mak,
								"create_time" 				=> $rows->create_time,
								"total_pagu" 				=> $rows->total_pagu,
								"deskripsi" 				=> $rows->deskripsi,
								"id_swakelola" 				=> $rows->id_swakelola,
							);
				$this->model->insert_penyedia_tayang($data);
				$count += 1;
			}
		}
		echo json_encode(array("status"=>TRUE, "count"=>$count));
	}


	public function penyedia_draft($tahun){
		$data 			= array();
		$kode_daerah	= $this->select_all_data_info_privasi();
		$count 			= 0;

		
		$delete = $this->model->delete_penyedia_draft($tahun);
		if ($delete == TRUE) {
			$result	= json_decode(file_get_contents('https://inaproc.lkpp.go.id/isb/api/12261545-50fd-4e89-bdbc-c09694ac7c1f/json/15529019/blmdiumumkanruptahunan/tipe/4:12/parameter/'.$tahun.':'.$kode_daerah));
			foreach ($result as $rows) {
				$data 	= array(
								"tahun" 					=> $tahun,
								"id_satker" 				=> $rows->id_satker,
								"nama_satker" 				=> $rows->nama_satker,
								"id" 						=> $rows->id,
								"namaprogram"				=> $rows->namaprogram,
								"kegiatan" 					=> $rows->kegiatan,
								"nama"						=> $rows->nama,
								"lokasi" 					=> $rows->lokasi,
								"jenis_belanja_str" 		=> $rows->jenis_belanja_str,
								"jenis_pengadaan_str" 		=> $rows->jenis_pengadaan_str,
								"volume" 					=> $rows->volume,
								"motode_str" 				=> $rows->motode_str,
								"tanggal_awal_pengadaan" 	=> $rows->tanggal_awal_pengadaan,
								"tanggal_akhir_pengadaan" 	=> $rows->tanggal_akhir_pengadaan,
								"tanggal_awal_pekerjaan" 	=> $rows->tanggal_awal_pekerjaan,
								"tanggal_akhir_pekerjaan" 	=> $rows->tanggal_akhir_pekerjaan,
								"sumber_dana_string" 		=> $rows->sumber_dana_string,
								"mak" 						=> $rows->mak,
								"pagu" 						=> $rows->pagu,
								"total_pagu" 				=> $rows->total_pagu,
								"deskripsi" 				=> $rows->deskripsi,
								"id_swakelola" 				=> $rows->id_swakelola,
							);
				$this->model->insert_penyedia_draft($data);
				$count += 1;
			}
		}
		echo json_encode(array("status"=>TRUE, "count"=>$count));
	}



	// *************************************************
	// | *********************************************
	// | -------------  DATA SWAKELOLA --------------
	// | *********************************************
	// *************************************************

	public function swakelola_tayang($tahun){
		$data 			= array();
		$kode_daerah	= $this->select_all_data_info_privasi();
		$count 			= 0;

		
		$delete = $this->model->delete_swakelola_tayang($tahun);
		if ($delete == TRUE) {
			$result	= json_decode(file_get_contents('https://inaproc.lkpp.go.id/isb/api/f9c44c94-e70b-4908-8589-061dc0e9cf68/json/13034684/pengumumanruptahunanswakelola/tipe/4:12/parameter/'.$tahun.':'.$kode_daerah));
			foreach ($result as $rows) {
				$data 	= array(
								"tahun" 					=> $tahun,
								"id_satker" 				=> $rows->id_satker,
								"nama_satker" 				=> $rows->nama_satker,
								"id" 						=> $rows->id,
								"nama_paket"				=> $rows->nama_paket,
								"lokasi_pekerjaan" 			=> $rows->lokasi_pekerjaan,
								"tanggal_awal_pekerjaan"	=> $rows->tanggal_awal_pekerjaan,
								"tanggal_akhir_pekerjaan" 	=> $rows->tanggal_akhir_pekerjaan,
								"sumber_dana_string" 		=> $rows->sumber_dana_string,
								"create_time" 				=> $rows->create_time,
								"total_pagu" 				=> $rows->total_pagu,
								"di_umumkan" 				=> $rows->di_umumkan,
							);
				$this->model->insert_swakelola_tayang($data);
				$count += 1;
			}
		}
		echo json_encode(array("status"=>TRUE, "count"=>$count));
	}


	public function swakelola_draft($tahun){
		$data 			= array();
		$kode_daerah	= $this->select_all_data_info_privasi();
		$count 			= 0;

		$delete = $this->model->delete_swakelola_draft($tahun);
		if ($delete == TRUE) {
			$result	= json_decode(file_get_contents('https://inaproc.lkpp.go.id/isb/api/14e4e50d-0f78-4af0-a8fd-6899cc702f44/json/15529005/blmdiumumkanrupthnswakelola/tipe/4:12/parameter/'.$tahun.':'.$kode_daerah));
			foreach ($result as $rows) {
				$data 	= array(
								"tahun" 					=> $tahun,
								"id_satker" 				=> $rows->id_satker,
								"nama_satker" 				=> $rows->nama_satker,
								"id" 						=> $rows->id,
								"kegiatan"					=> $rows->kegiatan,
								"lokasi" 					=> $rows->lokasi,
								"tanggal_awal_pekerjaan"	=> $rows->tanggal_awal_pekerjaan,
								"tanggal_akhir_pekerjaan" 	=> $rows->tanggal_akhir_pekerjaan,
								"sumber_dana_string" 		=> $rows->sumber_dana_string,
								"total_pagu" 				=> $rows->total_pagu,
								"deskripsi" 				=> $rows->deskripsi,
							);
				$this->model->insert_swakelola_draft($data);
				$count += 1;
			}
		}
		echo json_encode(array("status"=>TRUE, "count"=>$count));
	}



	// *************************************************
	// | *********************************************
	// | -----------  DATA E-PURCHASING ------------
	// | *********************************************
	// *************************************************

	public function data_epurchasing($tahun){
		$data 			= array();
		$kode_daerah	= $this->select_all_data_info_privasi();
		$count 			= 0;

		$result	= json_decode(file_get_contents('https://inaproc.lkpp.go.id/isb/api/cbd2ba54-8f09-4e6e-812c-7b4ab93e47ff/json/13423200/InformasiUtamaPaket/tipe/12/parameter/'.$kode_daerah));
		if ($result) {
			foreach ($result as $rows) {
				$data = array(
									"tahun" 					=> $tahun,
									"no_paket" 					=> $rows->no_paket,
									"nama_komoditas" 			=> $rows->nama_komoditas,
									"nama_paket" 				=> $rows->nama_paket,
									"rup_id"					=> $rows->rup_id,
									"nama_sumber_dana" 			=> $rows->nama_sumber_dana,
									"kode_anggaran"				=> $rows->kode_anggaran,
									"jenis_instansi" 			=> $rows->jenis_instansi,
									"nama_instansi" 			=> $rows->nama_instansi,
									"satuan_kerja_nama" 		=> $rows->satuan_kerja_nama,
									"satuan_kerja_alamat" 		=> $rows->satuan_kerja_alamat,
									"satuan_kerja_npwp" 		=> $rows->satuan_kerja_npwp,
									"tanggal_buat_paket" 		=> $rows->tanggal_buat_paket,
									"tanggal_edit_paket" 		=> $rows->tanggal_edit_paket,
									"nama_pembuat_paket" 		=> $rows->nama_pembuat_paket,
									"no_telp_pembuat_paket" 	=> $rows->no_telp_pembuat_paket,
									"email_pembuat_paket" 		=> $rows->email_pembuat_paket,
									"nama_ppk" 					=> $rows->nama_ppk,
									"jabatan_ppk" 				=> $rows->jabatan_ppk,
									"ppk_nip" 					=> $rows->ppk_nip,
									"nama_penyedia" 			=> $rows->nama_penyedia,
									"alamat_penyedia" 			=> $rows->alamat_penyedia,
									"email_penyedia" 			=> $rows->email_penyedia,
									"no_telp_penyedia" 			=> $rows->no_telp_penyedia,
									"nama_distributor" 			=> $rows->nama_distributor,
									"alamat_distributor" 		=> $rows->alamat_distributor,
									"email_distributor" 		=> $rows->email_distributor,
									"no_telp_distributor" 		=> $rows->no_telp_distributor,
									"jml_jenis_produk" 			=> $rows->jml_jenis_produk,
									"total" 					=> $rows->total,
							);



				$result_table = $this->model->select_epurchasing($rows->no_paket, $rows->rup_id, $rows->nama_paket, $rows->total);
				if ($result_table->num_rows() <= 0) {
					$this->model->insert_epurchasing($data);
				}
				else{
					$this->model->update_epurchasing($rows->no_paket, $data);
				}
				$count += 1;
			}
		}
		echo json_encode(array("status"=>TRUE, "count"=>$count));
	}



	// *************************************************
	// | *********************************************
	// | -------------  DATA JSON SiRUP --------------
	// | *********************************************
	// *************************************************

	public function json_sirup($tahun){
		$count = 0;
		$this->model->delete_tbl_pkt_sirup($tahun);
		$get_json = json_decode(file_get_contents('./assets/js/json/data'.$tahun.'.json'));
		foreach ($get_json as $rows) {
			$data = array(
								"tahun" 					=> $tahun,
								"id_rup" 					=> $rows->id,
								"id_swakelola" 				=> $rows->id_swakelola,
								"id_satker" 				=> $rows->id_satker,
								"nama_satker"				=> $rows->nama_satker,
								"id_program" 				=> $rows->id_program,
								"nama_program"				=> $rows->namaprogram,
								"kode_kegiatan" 			=> $rows->kode_kegiatan,
								"id_kegiatan" 				=> $rows->id_kegiatan,
								"nama_kegiatan" 			=> $rows->kegiatan,
								"kode_mak" 					=> $rows->mak,
								"pagu_mak" 					=> $rows->pagu_mak,
								"nama_paket" 				=> $rows->nama,
								"volume_paket" 				=> $rows->volume,
								"jenis_pengadaan" 			=> $rows->jenis_pengadaan,
								"jenis_pengadaan_str" 		=> $rows->jenis_pengadaan_str,
								"lokasi_pekerjaan" 			=> $rows->lokasi_pekerjaan,
								"deskripsi" 				=> $rows->deskripsi,
								"lokasi" 					=> $rows->lokasi,
								"total_pagu" 				=> $rows->total_pagu,
								"sumber_dana" 				=> $rows->sumber_dana,
								"sumber_dana_str" 			=> $rows->sumber_dana_string,
								"asal_dana" 				=> $rows->asal_dana,
								"asal_dana_satker" 			=> $rows->asal_dana_satker,
								"status_tkdn" 				=> $rows->status_tkdn,
								"status_pradipa" 			=> $rows->status_pradipa,
								"umumkan_paket" 			=> $rows->umumkan,
								"jenis_belanja" 			=> $rows->jenis_belanja,
								"jenis_belanja_str" 		=> $rows->jenis_belanja_str,
								"metode_pemilihan_penyedia" => $rows->metode_pemilihan_penyedia,
								"metode_pemilihan_str" 		=> $rows->motode_str,
								"tanggal_pemilihan_awal" 	=> $rows->tanggal_awal_pengadaan,
								"tanggal_pemilihan_akhir" 	=> $rows->tanggal_akhir_pengadaan,
								"tanggal_kontrak_awal" 		=> $rows->tanggal_awal_pekerjaan,
								"tanggal_kontrak_akhir" 	=> $rows->tanggal_akhir_pekerjaan,
								"tanggal_buat" 				=> $rows->create_time,
								"tanggal_update" 			=> $rows->last_update_time,
								"is_aktif" 					=> $rows->aktif,

					);
			$this->model->insert_tbl_pkt_sirup($data);
			$count += 1;
		}
		echo json_encode(array("status"=>TRUE, "count"=>$count));
	}



	// *************************************************
	// | *********************************************
	// | -------  DATA STRUKTUR ANGGARAN PEMDA -------
	// | *********************************************
	// *************************************************

	public function struktur_anggaran($tahun){
		$count = 0;
		$delete_data = $this->model->delete_struktur_anggaran($tahun);
		$result	= $this->model->get_struktur_anggaran();
		foreach ($result->result() as $rows) {
			$data = array(
							"tahun"					=> $tahun,
							"id_satker"				=> 0,
							"kd_skpd"				=> $rows->kd_skpd,
							"nama_satker"			=> $rows->nama_skpd,
							"pg_btl"				=> $rows->pg_btl,
							"pg_bl"					=> $rows->pg_bl
						);
			$this->model->insert_struktur_anggaran($data);
			$count += 1;
		}
		echo json_encode(array("status"=>TRUE, "count"=>$count));
	}
}
