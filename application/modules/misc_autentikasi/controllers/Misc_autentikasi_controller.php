<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misc_autentikasi_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Misc_autentikasi_model', 'model');
	}

	public function main_page(){
		$this->load->view('data');
	}




	// *************************************************
	// | *********************************************
	// | ------------  DATA AUTENTIKASI -------------
	// | *********************************************
	// *************************************************

	public function select_all_data(){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->select_tbl_users();
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"no"				=> $no++,
											"nama"				=> "<a href='#' class='misc-autentikasi-security-modal-open-btn'".
																	"data-id='".$rows_data->id."'>".
																		$rows_data->nama.
																	"</a>",
											"nip"				=> $rows_data->nip,
											"email"				=> $rows_data->email,
											"nama_opd"			=> $rows_data->nama_skpd,
											"tanggal_buat"		=> $rows_data->tanggal_buat
									);
		}
		echo json_encode($data);
	}

	public function select_all_data_opd(){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->select_tbl_apbd();
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"kd_skpd"			=> $rows_data->kd_skpd,
											"nama_opd"			=> $rows_data->nama_satker,
									);
		}
		echo json_encode($data);
	}


	public function insert_data(){
		$nama       = $this->input->post("nama");
		$email      = $this->input->post("email");
		$username   = $this->input->post("username");
		$password   = $this->input->post("password");
		$opd 		= $this->input->post("opd");
		$nip        = $this->input->post("nip");
		$tanya      = $this->input->post("security_quest");
		$jawab      = $this->input->post("quest_answer");
		$status  	= FALSE;
		if ($nama != '') {
			if ($email != '') {
				if ($username != '') {
					if ($password != '') {
						if ($opd != '') {
							if ($nip != '') {
								if ($tanya != '') {
									if ($jawab != '') {
										$data = array(
													"nama" 				=> strtoupper($nama),
													"email" 			=> $email,
													"username" 			=> strtolower($username),
													"password" 			=> password_hash(
																							$password,
																							PASSWORD_BCRYPT,
																							array('cost' == 9)
																			),
													"kd_skpd" 			=> $opd,
													"nip" 				=> $nip,
													"security_quest" 	=> $tanya,
													"security_answer" 	=> $jawab,
													"tanggal_update" 	=> date("Y:m:d H:i:s"),
												);
										$upload = $this->model->insert_tbl_users($data);
										$status = $upload;
									}	
								}	
							}	
						}	
					}	
				}	
			}
		}

		echo json_encode(array("status" => $status));
	}


	public function select_all_data_by_detail(){
		$id 			= $this->input->post("token");
		$security_quest = $this->input->post("security_quest");
		$quest_answer 	= $this->input->post("quest_answer");
		$result_data	= $this->model->select_tbl_users_by_detail($id, $security_quest, $quest_answer);
		$status			= FALSE;
		if ($result_data->num_rows() > 0) {
			$status  	= TRUE;
		}

		echo json_encode(array("status" => $status));
	}


	public function select_all_data_by_id($id){
		$data["baris_data"] = array();
		$data["total_data"] = array();
		$no 	= 1;


		$result_data		= $this->model->select_tbl_users_by_id($id, 1, TRUE);
		foreach ($result_data->result() as $rows_data) {
			$data["baris_data"][] = array(
											"id"				=> $rows_data->id,
											"nama"				=> $rows_data->nama,
											"email"				=> $rows_data->email,
											"username"			=> $rows_data->username,
											"kd_skpd"			=> $rows_data->kd_skpd,
											"nip"				=> $rows_data->nip,
											"security_quest"	=> $rows_data->security_quest,
											"security_answer"	=> $rows_data->security_answer
									);
		}
		echo json_encode($data);
	}


	public function update_data(){
		$id       	= $this->input->post("token");
		$nama       = $this->input->post("nama");
		$email      = $this->input->post("email");
		$resetpass  = $this->input->post("qrespass");
		$password   = $this->input->post("password");
		$opd 		= $this->input->post("opd");
		$nip        = $this->input->post("nip");
		$tanya      = $this->input->post("security_quest");
		$jawab      = $this->input->post("quest_answer");
		$status  	= FALSE;
		if ($nama != '') {
			if ($email != '') {
				if ($opd != '') {
					if ($nip != '') {
						if ($tanya != '') {
							if ($jawab != '') {
								if ($resetpass == 1) {
									if ($password != '') {
										$data = array(
														"nama" 				=> strtoupper($nama),
														"email" 			=> $email,
														"password" 			=> password_hash(
																								$password,
																								PASSWORD_BCRYPT,
																								array('cost' == 9)
																				),
														"kd_skpd" 			=> $opd,
														"nip" 				=> $nip,
														"security_quest" 	=> $tanya,
														"security_answer" 	=> $jawab,
														"tanggal_update" 	=> date("Y:m:d H:i:s"),
												);
									}
								}
								else{
									$data = array(
													"nama" 				=> strtoupper($nama),
													"email" 			=> $email,
													"kd_skpd" 			=> $opd,
													"nip" 				=> $nip,
													"security_quest" 	=> $tanya,
													"security_answer" 	=> $jawab,
													"tanggal_update" 	=> date("Y:m:d H:i:s"),
											);
								}
								
								$upload = $this->model->update_tbl_users($id, $data);
								$status = $upload;
							}	
						}	
					}	
				}	
			}
		}

		echo json_encode(array("status" => $status));
	}



	public function delete_data($id){
		$status  			= FALSE;
		$result_data		= $this->model->delete_tbl_users($id);
		$status 			= $result_data;
		echo json_encode(array("status" => $status));
	}
}