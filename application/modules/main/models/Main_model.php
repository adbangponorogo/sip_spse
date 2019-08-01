<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct()
    {
        $this->local_db = $this->load->database('default', TRUE);
        $this->smep_db = $this->load->database('smep_database', TRUE);
        $this->pg_db = $this->load->database('pg_database', TRUE);
    }


    public function get_all_data_kontak_kami(){
        $this->local_db->select("*");
        $this->local_db->from("tbl_misc");
        $this->local_db->where("slug", "kontak_kami");
        $data = $this->local_db->get();
        return $data;
    }


    public function get_all_data_info_privasi(){
        $this->local_db->select("*");
        $this->local_db->from("tbl_misc");
        $this->local_db->where("slug", "info_privasi");
        $data = $this->local_db->get();
        return $data;
    }
}