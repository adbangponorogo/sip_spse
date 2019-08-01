<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nontendering_paketgagal_model extends CI_Model {

    public function __construct()
    {
        $this->local_db = $this->load->database('default', TRUE);
        $this->pg_db = $this->load->database('pg_database', TRUE);
    }


    // ****************************************
    // ||
    // || GLOBAL FUNCTION
    // ||
    // ****************************************

    public function get_repo(){
        $this->pg_db->select("cfg_value");
        $this->pg_db->from("configuration");
        $this->pg_db->where("cfg_sub_category", "ppe.id");
        $result = $this->pg_db->get();
        $data = '';
        foreach ($result->result() as $rows) {
            $data = $rows->cfg_value;
        }
        return $data;
    }

    public function get_provinsi(){
        $this->pg_db->select("DISTINCT(a.prp_id) prp_id, a.prp_nama");
        $this->pg_db->from("propinsi a");
        $this->pg_db->join("kabupaten b", "a.prp_id = b.prp_id");
        $this->pg_db->join("agency c", "b.kbp_id = c.kbp_id");
        $this->pg_db->limit(1);
        $result = $this->pg_db->get();
        $data = '';
        foreach ($result->result() as $rows) {
            $data = array('id_provinsi' => $rows->prp_id, 'nama_provinsi' => $rows->prp_nama);
        }
        return $data;
    }

    public function get_kabupaten(){
        $this->pg_db->select("DISTINCT(b.kbp_id) kbp_id, b.kbp_nama");
        $this->pg_db->from("propinsi a");
        $this->pg_db->join("kabupaten b", "a.prp_id = b.prp_id");
        $this->pg_db->join("agency c", "b.kbp_id = c.kbp_id");
        $this->pg_db->limit(1);
        $result = $this->pg_db->get();
        $data = '';
        foreach ($result->result() as $rows) {
            $data = $rows->kbp_id;
        }
        return $data;
    }

    public function get_agency(){
        $this->pg_db->select("agc_id, agc_nama");
        $this->pg_db->from("agency");
        $this->pg_db->order_by("agc_id", "ASC");
        $data = $this->pg_db->get();
        return $data;
    }



    // ****************************************
    // ||
    // || APP FUNCTION
    // ||
    // ****************************************

    // public function rekap_retendering($tahun){
    //     $this->pg_db->select("
    //         a.tahun, 
    //         COUNT(a.pkt_nama) AS jml_pkt_ulang,
    //         SUM(a.pkt_pagu) AS jml_pagu_ulang
    //     ");
    //     $this->pg_db->from("narno_pl_semua a");
    //     $this->pg_db->join("narno_pl_menang b", "a.lls_id = b.lls_id");
    //     $this->pg_db->where("b.lls_diulang_karena IS NOT NULL");
    //     $this->pg_db->where("b.lls_versi_lelang >", 1);
    //     $this->pg_db->where("b.lls_status", 1);
    //     if ($tahun != 'all') {
    //         $this->pg_db->where("b.tahun", $tahun+0);
    //     }
    //     $this->pg_db->group_by("a.tahun");
    //     $this->pg_db->order_by("a.tahun", "DESC");
    //     $data = $this->pg_db->get();
    //     return $data;
    // }

     public function rekap_gagal($tahun){
        $this->pg_db->select("
            a.tahun, 
            COUNT(a.pkt_nama) AS jml_pkt_gagal,
            SUM(a.pkt_pagu) AS jml_pagu_gagal
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->from("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->where("b.lls_ditutup_karena IS NOT NULL");
        $this->pg_db->where("b.lls_versi_lelang >", 1);
        $this->pg_db->where("b.lls_status", 2);
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $this->pg_db->group_by("a.tahun");
        $this->pg_db->order_by("a.tahun", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_rekap_gagal($tahun){
        $this->pg_db->select("
            COUNT(a.pkt_nama) AS jml_pkt_gagal,
            SUM(a.pkt_pagu) AS jml_pagu_gagal
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->from("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->where("b.lls_ditutup_karena IS NOT NULL");
        $this->pg_db->where("b.lls_versi_lelang >", 1);
        $this->pg_db->where("b.lls_status", 2);
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $data = $this->pg_db->get();
        return $data;
    }

    public function data_gagal($tahun){
        $this->pg_db->select("
            a.tahun, 
            a.stk_nama,
            a.lls_id,
            a.pkt_nama,
            a.pkt_pagu, 
            b.lls_ditutup_karena as alasan
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->from("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->where("b.lls_ditutup_karena IS NOT NULL");
        $this->pg_db->where("b.lls_versi_lelang >", 1);
        $this->pg_db->where("b.lls_status", 2);
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $this->pg_db->order_by("a.tahun", "DESC");
        $this->pg_db->order_by("a.lls_id", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_data_gagal($tahun){
        $this->pg_db->select("SUM(a.pkt_pagu) AS pkt_pagu");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->from("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->where("b.lls_ditutup_karena IS NOT NULL");
        $this->pg_db->where("b.lls_versi_lelang >", 1);
        $this->pg_db->where("b.lls_status", 2);
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $data = $this->pg_db->get();
        return $data;
    }
}