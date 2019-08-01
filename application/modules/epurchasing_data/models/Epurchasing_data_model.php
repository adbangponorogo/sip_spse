<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epurchasing_data_model extends CI_Model {

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

    public function get_total_pagu_apbd($tahun){
        $this->local_db->select("SUM(btl) AS btl, SUM(bl) AS bl");
        $this->local_db->from("rekap_apbd");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun);
        }
        $result = $this->local_db->get();
        $data = '';
        foreach ($result->result() as $rows) {
            $data = array('pagu_btl' => $rows->btl, 'pagu_bl' => $rows->bl);
        }
        return $data;
    }

    public function get_total_opd($tahun){
        $this->local_db->select("COUNT(id_satker) AS total_opd");
        $this->local_db->from("rekap_apbd");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun);
        }
        $result = $this->local_db->get();
        $data = '';
        foreach ($result->result() as $rows) {
            $data = array('total_opd' => $rows->total_opd);
        }
        return $data;
    }



    // ****************************************
    // ||
    // || APP FUNCTION
    // ||
    // ****************************************

    public function paket_opd($tahun){
        $this->local_db->select("
            satuan_kerja_nama,
            nama_ppk,
            nama_komoditas,
            no_paket,
            nama_paket,
            rup_id,
            nama_penyedia,
            nama_distributor,
            jml_jenis_produk,
            total,
            tanggal_buat_paket
        ");
        $this->local_db->from("tbl_pkt_epurchasing");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->order_by("YEAR(tanggal_buat_paket)", "DESC");
        $data = $this->local_db->get();
        return $data;
    }
}