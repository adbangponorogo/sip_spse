<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nontendering_kontrakopd_model extends CI_Model {

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

    public function lelang_resume($tahun){
        $this->pg_db->select("
            COUNT(a.lls_id) AS total_paket,
            COUNT(b.rkn_nama) AS paket_selesai,
            (COUNT(a.lls_id) - COUNT(b.lls_id))  AS paket_belum_selesai,
            SUM(CASE WHEN c.kontrak_id > 0 THEN 1 ELSE 0 END) AS total_kontrak
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->join("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->join("ekontrak.kontrak c", "b.lls_id = c.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("b.tahun", $tahun+0);
        }
        $data = $this->pg_db->get();
        return $data;
    }

    public function kontrak_opd($tahun){
        $this->pg_db->select("
            a.stk_nama,
            COUNT(a.lls_id) AS jml_kontrak, 
            SUM(a.pkt_hps) AS jml_hps,
            SUM(b.harga_terkoreksi) AS nilai_penawaran,
            SUM(c.kontrak_nilai) AS nilai_kontrak
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->join("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->join("ekontrak.kontrak c", "b.lls_id = c.lls_id");
        $this->pg_db->where("c.kontrak_id >", 0);
        if ($tahun != 'all') {
            $this->pg_db->where("b.tahun", $tahun+0);
        }
        $this->pg_db->group_by("a.stk_nama");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_kontrak_opd($tahun){
        $this->pg_db->select("
            COUNT(a.lls_id) AS jml_kontrak, 
            SUM(a.pkt_hps) AS jml_hps,
            SUM(b.harga_terkoreksi) AS nilai_penawaran,
            SUM(c.kontrak_nilai) AS nilai_kontrak
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->join("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->join("ekontrak.kontrak c", "b.lls_id = c.lls_id");
        $this->pg_db->where("c.kontrak_id >", 0);
        if ($tahun != 'all') {
            $this->pg_db->where("b.tahun", $tahun+0);
        }
        $data = $this->pg_db->get();
        return $data;
    }

    public function paket_kontrak($tahun){
        $this->pg_db->select("
            a.tahun, 
            a.bulan, 
            a.lls_id, 
            a.pkt_nama, 
            a.stk_nama, 
            d.rup_id,
            b.rkn_nama,
            b.kbp_nama,
            a.pkt_hps,
            b.harga_terkoreksi,
            c.kontrak_no,
            (
                CASE
                    WHEN a.lls_versi_lelang > 1::numeric THEN 'Lelang Ulang'::text
                ELSE ' '::text
                END
            ) AS status,    
            TO_CHAR(c.kontrak_tanggal, 'DD Mon YYYY') AS kontrak_tanggal,
            c.kontrak_nilai,
            TO_CHAR(c.kontrak_mulai, 'DD Mon YYYY') AS kontrak_mulai,
            TO_CHAR(c.kontrak_akhir, 'DD Mon YYYY') AS kontrak_akhir,
            b.sbd_ket
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->join("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->join("ekontrak.kontrak c", "b.lls_id = c.lls_id");
        $this->pg_db->join("narno_pl_rup d", "a.lls_id = d.lls_id");
        $this->pg_db->where("c.kontrak_id >", 0);
        if ($tahun != 'all') {
            $this->pg_db->where("b.tahun", $tahun+0);
        }
        $this->pg_db->order_by("b.tahun", "DESC");
        $this->pg_db->order_by("c.kontrak_no", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }
}