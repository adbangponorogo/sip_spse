<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Autentikasi_model', 'model');
	}

	public function main_page(){
		if (empty($this->session->userdata('auth_id'))) {
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
		else{
			redirect(base_url());
		}
	}

	public function process_login(){
		if (empty($this->session->userdata('auth_id'))) {
			$username = strtolower($this->input->post("username"));
			$password = $this->input->post("password");
			$result = $this->model->get_all_data_tbl_users_by_username($username);
			$process = FALSE;
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $rows) {
					$verify_password = password_verify($password, $rows->password);
					if ($verify_password == TRUE) {
						// Insert To Temporary
						$data = array(
									"id_user" 		=> $rows->id,
									"status" 		=> "auth",
									"kode" 			=> "login",
									"ip_address"	=> $this->getIPClient(),
									"keterangan"	=> "User ".$rows->nama." telah melakukan login.",
								);
						$process = $this->model->insert_tbl_temporary($data);


						// Create Season
						$this->session->set_userdata(array(
							"auth_id" => $rows->id
							));
					}
				}
			}
			echo json_encode(array("status"=>$process));
		}
		else{
			redirect(base_url());
		}
	}

	public function login_status(){
		if (!empty($this->session->userdata('auth_id'))) {
			$status = TRUE;
		}
		else{
			$status = FALSE;
		}

		echo json_encode(array("status"=>$status));
	}


	public function process_logout(){
		if (!empty($this->session->userdata('auth_id'))) {
			$this->session->unset_userdata(array('auth_id'));
			echo json_encode(array("status" => TRUE));
		}
		else{
			redirect(base_url());
		}
	}


	public function getIPClient(){
		// Get real visitor IP behind CloudFlare network
	    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
	              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	    }
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];

	    if(filter_var($client, FILTER_VALIDATE_IP))
	    {
	        $ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
	    {
	        $ip = $forward;
	    }
	    else
	    {
	        $ip = $remote;
	    }

	    return $ip;
	}
}
