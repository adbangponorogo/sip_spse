<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misc_tarikdata_model extends CI_Model {

    public function __construct()
    {
        $this->local_db = $this->load->database('default', TRUE);
        $this->smep_db = $this->load->database('smep_database', TRUE);
        $this->pg_db = $this->load->database('pg_database', TRUE);
    }


    public function get_all_data_info_privasi(){
        $this->local_db->select("*");
        $this->local_db->from("tbl_misc");
        $this->local_db->where("slug", "info_privasi");
        $data = $this->local_db->get();
        return $data;
    }


    /* -----------------------------------
    * -------- Paket Penyedia -----------
    * --------------------------------- */
    public function delete_penyedia_tayang($tahun){
        $this->local_db->where("tahun", $tahun);
        $this->local_db->delete("tbl_pkt_penyedia");
        return TRUE;
    }

    public function insert_penyedia_tayang($data){
        $this->local_db->insert("tbl_pkt_penyedia", $data);
    }

    public function delete_penyedia_draft($tahun){
        $this->local_db->where("tahun", $tahun);
        $this->local_db->delete("tbl_pkt_penyedia_belum");
        return TRUE;
    }

    public function insert_penyedia_draft($data){
        $this->local_db->insert("tbl_pkt_penyedia_belum", $data);
    }


    /* -----------------------------------
    * -------- Paket Swakelola -----------
    * --------------------------------- */
    public function delete_swakelola_tayang($tahun){
        $this->local_db->where("tahun", $tahun);
        $this->local_db->delete("tbl_pkt_swakelola");
        return TRUE;
    }

    public function insert_swakelola_tayang($data){
        $this->local_db->insert("tbl_pkt_swakelola", $data);
    }

    public function delete_swakelola_draft($tahun){
        $this->local_db->where("tahun", $tahun);
        $this->local_db->delete("tbl_pkt_swakelola_belum");
        return TRUE;
    }

    public function insert_swakelola_draft($data){
        $this->local_db->insert("tbl_pkt_swakelola_belum", $data);
    }

    /* -----------------------------------
    * ------- Paket E-Purchasing ---------
    * --------------------------------- */
    public function select_epurchasing($no_paket, $rup_id, $nama_paket, $total){
        $this->local_db->select("*");
        $this->local_db->from("tbl_pkt_epurchasing");
        $this->local_db->where("no_paket", $no_paket);
        $this->local_db->where("rup_id", $rup_id);
        $this->local_db->where("nama_paket", $nama_paket);
        $this->local_db->where("total", $total);
        $data = $this->local_db->get();
        return $data;
    }    

    public function insert_epurchasing($data){
        $this->local_db->insert("tbl_pkt_epurchasing", $data);
    }

    public function update_epurchasing($id, $data){
        $this->local_db->where("no_paket", $id);
        $this->local_db->update("tbl_pkt_epurchasing", $data);
    }

    /* -----------------------------------
    * -------- JSON SiRUP ---------
    * --------------------------------- */
    public function delete_tbl_pkt_sirup($tahun){
        $this->local_db->where("tahun", $tahun);
        $this->local_db->delete('tbl_pkt_sirup');
    }

    public function insert_tbl_pkt_sirup($data){
        $this->local_db->insert('tbl_pkt_sirup', $data);
    }


    /* -----------------------------------
    * -------- Struktur Anggaran ---------
    * --------------------------------- */
    public function get_struktur_anggaran(){
        $this->smep_db->select("
            b.kd_skpd AS kd_skpd,
            b.nama_skpd AS nama_skpd,
            (a.btl1+a.btl2) AS pg_btl,
            (a.bl1+a.bl2+a.bl3) AS pg_bl
        ");
        $this->smep_db->from("sirup_struktur_anggaran a");
        $this->smep_db->join("simda_skpd b", "a.kd_skpd = b.kd_skpd");
        $data = $this->smep_db->get();
        return $data;
    }

    public function delete_struktur_anggaran($tahun){
        $this->local_db->where("tahun", $tahun);
        $process = $this->local_db->delete("table_apbd");
        if ($process) {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function insert_struktur_anggaran($data){
        $process = $this->local_db->insert("table_apbd", $data);
        if ($process) {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }


}