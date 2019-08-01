<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_paketulang_model extends CI_Model {

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

    public function rekap_retendering($tahun, $satker){
        $this->pg_db->select("
            tahun, 
            COUNT(pkt_nama) AS jml_pkt_ulang,
            SUM(pkt_hps) AS jml_hps_ulang,
            SUM(pkt_pagu) AS jml_pagu_ulang
        ");
        $this->pg_db->from("status_lelang");
        $this->pg_db->where("lls_diulang_karena IS NOT NULL");
        $this->pg_db->where("lls_versi_lelang >", 1);
        $this->pg_db->where("lls_status", 1);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $this->pg_db->group_by("tahun");
        $this->pg_db->order_by("tahun", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_rekap_retendering($tahun, $satker){
        $this->pg_db->select("
            COUNT(pkt_nama) AS jml_pkt_ulang,
            SUM(pkt_hps) AS jml_hps_ulang,
            SUM(pkt_pagu) AS jml_pagu_ulang
        ");
        $this->pg_db->from("status_lelang");
        $this->pg_db->where("lls_diulang_karena IS NOT NULL");
        $this->pg_db->where("lls_versi_lelang >", 1);
        $this->pg_db->where("lls_status", 1);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $data = $this->pg_db->get();
        return $data;
    }

    public function data_retendering($tahun, $satker){
        $this->pg_db->select("
            tahun, 
            stk_nama,
            lls_id,
            pkt_nama,
            versi_lelang, 
            pkt_pagu,
            (
                CASE
                    WHEN lls_versi_lelang = 2 THEN lls_ditutup_karena
                    WHEN lls_versi_lelang = 3 THEN lls_ditutup_karena
                ELSE lls_diulang_karena
                END
            ) AS alasan
        ");
        $this->pg_db->from("status_lelang");
        $this->pg_db->where("lls_diulang_karena IS NOT NULL");
        $this->pg_db->where("lls_versi_lelang >", 1);
        $this->pg_db->where("lls_status", 1);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $this->pg_db->order_by("tahun", "DESC");
        $this->pg_db->order_by("lls_id", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }
}