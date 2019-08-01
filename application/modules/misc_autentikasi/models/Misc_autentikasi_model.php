<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misc_autentikasi_model extends CI_Model {

    public function __construct()
    {
        $this->local_db = $this->load->database('default', TRUE);
        $this->smep_db = $this->load->database('smep_database', TRUE);
        $this->pg_db = $this->load->database('pg_database', TRUE);
    }


    /* -----------------------------------
    * ---------- App Function ------------
    * --------------------------------- */
    public function select_tbl_users(){
        $this->local_db->select("a.*, b.nama_satker as nama_skpd");
        $this->local_db->from("tbl_users a");
        $this->local_db->join("rekap_apbd b", "a.kd_skpd = b.kd_skpd");
        $data = $this->local_db->get();
        return $data;
    }

    public function select_tbl_users_by_id($id, $limit, $get_limit = FALSE){
        $this->local_db->select("*");
        $this->local_db->from("tbl_users");
        $this->local_db->where("id", $id);
        if ($get_limit == TRUE) {
            $this->local_db->limit($limit);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function select_tbl_users_by_detail($id, $security_quest, $security_answer){
        $this->local_db->select("*");
        $this->local_db->from("tbl_users");
        $this->local_db->where("id", $id);
        $this->local_db->where("security_quest", $security_quest);
        $this->local_db->where("security_answer", $security_answer);
        $data = $this->local_db->get();
        return $data;
    }

    public function select_tbl_apbd(){
        $this->local_db->select("*");
        $this->local_db->from("rekap_apbd");
        $data = $this->local_db->get();
        return $data;
    }

    public function insert_tbl_users($data){
        $this->local_db->insert('tbl_users', $data);
        return TRUE;
    }

    public function update_tbl_users($id, $data){
        $this->local_db->where("id", $id);
        $this->local_db->update('tbl_users', $data);
        return TRUE;
    }

    public function delete_tbl_users($id){
        $this->local_db->where("id", $id);
        $this->local_db->delete('tbl_users');
        return TRUE;
    }
}