<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misc_tentangkami_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Misc_tentangkami_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}




	// *************************************************
	// | *********************************************
	// | ------------  DATA TENTANG KAMI -------------
	// | *********************************************
	// *************************************************


	public function select_all_data_profile(){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;

		// Field
		$email 			= '';
		$nama_admin 	= '';
		
		// Get Data
		$result_data		= $this->model->get_all_data_kontak_kami();
		if ($result_data->num_rows() > 0) {
			foreach ($result_data->result() as $rows_data) {
				
				// Get Data Array
				foreach (unserialize($rows_data->engine) as $rows) {
					$email 			= $rows["email"];
				}
			}
		}

		$result_data		= $this->model->get_all_data_info_privasi();
		if ($result_data->num_rows() > 0) {
			foreach ($result_data->result() as $rows_data) {
				
				// Get Data Array
				foreach (unserialize($rows_data->engine) as $rows) {
					$nama_admin 	= $rows["nama_admin"];
				}
			}
		}

		// Create Array to Output Data
		$data["baris_data"][] = array(
										"email"			=> $email,
										"nama_admin"	=> $nama_admin,
									);
		echo json_encode($data);
	}






	public function select_all_data_tentang_kami(){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;

		// Field
		$description 		= '';
		
		// Get Data
		$result_data		= $this->model->get_all_data_tentang_kami();
		if ($result_data->num_rows() > 0) {
			foreach ($result_data->result() as $rows_data) {
				
				// Get Data Array
				foreach (unserialize($rows_data->engine) as $rows) {
					$description = $rows["description"];
				}

				// Create Array to Output Data
				$data["baris_data"][] = array(
												"description"				=> $description,
										);
			}
		}
		echo json_encode($data);
	}


	public function update_data_tentang_kami(){
		$description 	= $this->input->post("description");
		$status 		= FALSE;
		$engine[] 		= array("description" => $description);

		$result_data	= $this->model->get_all_data_tentang_kami();
		if ($result_data->num_rows() <= 0) {
			$data 		= array(
								"slug" 			=> "tentang_kami",
								"engine" 		=> serialize($engine)
							);
			$process 	= $this->model->insert_data_tentang_kami($data);
		}
		else{
			$data 		= array(
								"engine" 		=> serialize($engine)
							);
			$process 	= $this->model->update_data_tentang_kami($data);
		}
		echo json_encode(array("status" => $process));
	}

	// ------------------------------------------------------------------




	public function select_all_data_kontak_kami(){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;

		// Field
		$kontak_wa 		= '';
		$kontak_telp 	= '';
		$email 			= '';
		$alamat 		= '';
		
		// Get Data
		$result_data		= $this->model->get_all_data_kontak_kami();
		if ($result_data->num_rows() > 0) {
			foreach ($result_data->result() as $rows_data) {
				
				// Get Data Array
				foreach (unserialize($rows_data->engine) as $rows) {
					$kontak_wa 		= $rows["kontak_wa"];
					$kontak_telp 	= $rows["kontak_telp"];
					$email 			= $rows["email"];
					$alamat 		= $rows["alamat"];
				}

				// Create Array to Output Data
				$data["baris_data"][] = array(
												"telepon_wa"		=> $kontak_wa,
												"telepon_kantor"	=> $kontak_telp,
												"email"				=> $email,
												"alamat"			=> $alamat,
										);
			}
		}
		echo json_encode($data);
	}


	public function update_data_kontak_kami(){
		$kontak_wa 		= $this->input->post("telepon_wa");
		$kontak_telp 	= $this->input->post("telepon_kantor");
		$email 			= $this->input->post("email");
		$alamat 		= $this->input->post("alamat");
		$status 		= FALSE;
		$engine[] 		= array(
								"kontak_wa" => $kontak_wa,
								"kontak_telp" => $kontak_telp,
								"email" => $email,
								"alamat" => $alamat
							);

		$result_data	= $this->model->get_all_data_kontak_kami();
		if ($result_data->num_rows() <= 0) {
			$data 		= array(
								"slug" 			=> "kontak_kami",
								"engine" 		=> serialize($engine)
							);
			$process 	= $this->model->insert_data_kontak_kami($data);
		}
		else{
			$data 		= array(
								"engine" 		=> serialize($engine)
							);
			$process 	= $this->model->update_data_kontak_kami($data);
		}
		echo json_encode(array("status" => $process));
	}
	// ------------------------------------------------------------------




	public function select_all_data_info_privasi(){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;

		// Field
		$nama_kota 		= '';
		$nama_admin 	= '';
		$url_admin 		= '';
		$kode_sirup 	= '';
		
		// Get Data
		$result_data		= $this->model->get_all_data_info_privasi();
		if ($result_data->num_rows() > 0) {
			foreach ($result_data->result() as $rows_data) {
				
				// Get Data Array
				foreach (unserialize($rows_data->engine) as $rows) {
					$nama_kota 		= $rows["nama_kota"];
					$nama_admin 	= $rows["nama_admin"];
					$url_admin 		= $rows["url_admin"];
					$kode_sirup 	= $rows["kode_sirup"];
				}

				// Create Array to Output Data
				$data["baris_data"][] = array(
												"nama_kota"		=> $nama_kota,
												"nama_admin"	=> $nama_admin,
												"url_admin"		=> $url_admin,
												"kode_sirup"	=> $kode_sirup,
										);
			}
		}
		echo json_encode($data);
	}


	public function update_data_info_privasi(){
		$nama_kota 		= $this->input->post("nama_kota");
		$nama_admin 	= $this->input->post("nama_admin");
		$url_admin 		= $this->input->post("url_admin");
		$kode_sirup 	= $this->input->post("kode_sirup");
		$status 		= FALSE;

		$engine[] 		= array(
									"nama_kota" => $nama_kota,
									"nama_admin" => $nama_admin,
									"url_admin" => $url_admin,
									"kode_sirup" => $kode_sirup
							);

		$result_data	= $this->model->get_all_data_info_privasi();
		if ($result_data->num_rows() <= 0) {
			$data 		= array(
								"slug" 			=> "info_privasi",
								"engine" 		=> serialize($engine)
							);
			$process 	= $this->model->insert_data_info_privasi($data);
		}
		else{
			$data 		= array(
								"engine" 		=> serialize($engine)
							);
			$process 	= $this->model->update_data_info_privasi($data);
		}
		echo json_encode(array("status" => $process));
	}
	// ------------------------------------------------------------------
}