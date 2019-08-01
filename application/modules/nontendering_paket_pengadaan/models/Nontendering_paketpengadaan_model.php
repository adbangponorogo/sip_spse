<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nontendering_paketpengadaan_model extends CI_Model {

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
    
    public function data_paket($tahun){
        $this->pg_db->select("
            a.lls_id,
            a.tahun,
            a.bulan,
            a.pkt_nama,
            a.stk_nama,
            c.rup_id,
            a.stk_id,
            a.lls_versi_lelang,
            a.pkt_pagu,
            a.pkt_hps,
            a.mtd_pemilihan,
            a.metoda,
            b.sbd_ket,
            b.rkn_nama,
            b.kbp_nama,
            b.prp_nama,
            b.harga_terkoreksi,
            (
                (
                    CASE
                        WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi
                    ELSE a.pkt_pagu
                    END
                )
                    -
                b.harga_terkoreksi
            ) AS efisiensi,
            (
                (
                    (
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
                    (
                        CASE
                            WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi
                        ELSE a.pkt_pagu
                        END
                    )
                        *
                    100
                )
            ) as prosentase
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->join("narno_pl_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->join("narno_pl_rup c", "a.lls_id = c.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $this->pg_db->order_by("a.tahun", "DESC");
        $this->pg_db->order_by("a.bulan", "ASC");
        $data = $this->pg_db->get();
        return $data;
    }
}