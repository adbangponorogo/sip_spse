<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_paketopd_model extends CI_Model {

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
    
    public function rekap_paket_opd($tahun, $satker){
        $this->pg_db->select("
            DISTINCT(stk_nama) AS stk_nama,
            COUNT(CASE WHEN kgr_id ='0' THEN kgr_id END) AS pkt_barang,
            SUM(CASE WHEN kgr_id ='0' THEN pkt_hps/1000000 ELSE 0 END) AS hps_barang,
            COUNT(CASE WHEN kgr_id ='2' THEN kgr_id END) AS pkt_konstruksi,
            SUM(CASE WHEN kgr_id ='2' THEN pkt_hps/1000000 ELSE 0 END) AS hps_konstruksi,
            COUNT(CASE WHEN kgr_id ='1' THEN kgr_id END) AS pkt_konsultansi,
            SUM(CASE WHEN kgr_id ='1' THEN pkt_hps/1000000 ELSE 0 END) AS hps_konsultansi,
            COUNT(CASE WHEN kgr_id ='3' THEN kgr_id END) AS pkt_lainnya,
            SUM(CASE WHEN kgr_id ='3' THEN pkt_hps/1000000 ELSE 0 END) AS hps_lainnya,                  
            COUNT(lls_id) AS t_paket, 
            (SUM(pkt_hps)/1000000) AS t_hps
        ");
        $this->pg_db->from("narno_semua");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $this->pg_db->group_by("stk_nama");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_rekap_paket_opd($tahun, $satker){
        $this->pg_db->select("
            COUNT(CASE WHEN kgr_id ='0' THEN kgr_id END) AS pkt_barang,
            SUM(CASE WHEN kgr_id ='0' THEN pkt_hps/1000000 ELSE 0 END) AS hps_barang,
            COUNT(CASE WHEN kgr_id ='2' THEN kgr_id END) AS pkt_konstruksi,
            SUM(CASE WHEN kgr_id ='2' THEN pkt_hps/1000000 ELSE 0 END) AS hps_konstruksi,
            COUNT(CASE WHEN kgr_id ='1' THEN kgr_id END) AS pkt_konsultansi,
            SUM(CASE WHEN kgr_id ='1' THEN pkt_hps/1000000 ELSE 0 END) AS hps_konsultansi,
            COUNT(CASE WHEN kgr_id ='3' THEN kgr_id END) AS pkt_lainnya,
            SUM(CASE WHEN kgr_id ='3' THEN pkt_hps/1000000 ELSE 0 END) AS hps_lainnya,                  
            COUNT(lls_id) AS t_paket, 
            (SUM(pkt_hps)/1000000) AS t_hps
        ");
        $this->pg_db->from("narno_semua");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $data = $this->pg_db->get();
        return $data;
    }

    public function hasil_paket_opd($tahun, $satker){
        $this->pg_db->select("
            a.stk_nama,
            COUNT(a.lls_id) AS t_paket, 
            SUM(a.pkt_pagu) AS t_pagu, 
            SUM(a.pkt_hps) AS hps,
            SUM(b.harga_terkoreksi) AS terkoreksi, 
            SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS selisih,
            (
                SUM(
                    (
                        CASE
                            WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi
                        ELSE a.pkt_pagu
                        END
                    ) 
                        -
                    b.harga_terkoreksi
                ) 
                    / 
                SUM(
                    CASE
                        WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi
                    ELSE a.pkt_pagu
                    END
                ) *100
            ) AS t_pros,
            COUNT(b.rkn_nama) AS ts_paket,
            (COUNT(a.lls_id) - COUNT(b.rkn_nama)) AS tb_paket
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $this->pg_db->group_by("a.stk_nama");
        $this->pg_db->order_by("selisih", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_hasil_paket_opd($tahun, $satker){
        $this->pg_db->select("
            SUM(a.pkt_pagu) AS jml_satker_pagu, 
            SUM(a.pkt_hps) AS jml_satker_hps,
            SUM(b.harga_terkoreksi) AS jml_satker_terkoreksi, 
            SUM(
                (
                    CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END)
                        - 
                    b.harga_terkoreksi
                ) AS jml_satker_selisih,
            (
                SUM(
                    (
                        CASE
                            WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi
                        ELSE a.pkt_pagu
                        END
                    )
                        - 
                    b.harga_terkoreksi
                )
                        / 
                SUM(
                    CASE
                        WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi
                    ELSE a.pkt_pagu
                    END
                )
                * 100
            ) AS jml_satker_t_pros,
            COUNT(a.lls_id) AS jml_satker_t_paket,
            (COUNT(a.lls_id) - COUNT(b.rkn_nama)) AS jml_satker_tb_paket
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $data = $this->pg_db->get();
        return $data;
    }
    
}