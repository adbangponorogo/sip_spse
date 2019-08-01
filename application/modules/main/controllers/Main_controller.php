<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Main_model', 'model');
	}

	public function index()
	{
		redirect('app/main');
	}

	public function welcome_page(){
		$this->load->view('Welcome_view');
	}

	public function main_page(){
		// Field
		$email 			= '';
		$nama_kota 		= '';
		$nama_admin 	= '';
		$url_admin 		= '';

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
					$nama_kota 		= $rows["nama_kota"];
					$nama_admin 	= $rows["nama_admin"];
					$url_admin 		= $rows["url_admin"];
				}
			}
		}
		$data["misc"] 	= array("nama_kota" => $nama_kota, "nama_admin" => $nama_admin, "url_admin" => $url_admin);

		$this->load->view('Main_view', $data);
	}
}
