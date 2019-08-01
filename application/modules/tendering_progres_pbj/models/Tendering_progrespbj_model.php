<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_progrespbj_model extends CI_Model {

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
        $this->pg_db->select("stk_id, stk_nama");
        $this->pg_db->from("narno_semua");
        $this->pg_db->group_by("stk_id");
        $this->pg_db->group_by("stk_nama");
        $this->pg_db->order_by("stk_id", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }



    // ****************************************
    // ||
    // || APP FUNCTION
    // ||
    // ****************************************

    public function kategori_tender($tahun, $satker){
        $this->pg_db->select("
            a.stk_nama,
            (
                CASE
                    WHEN a.kgr_id = 0::numeric THEN 'Barang'::text
                    WHEN a.kgr_id = 1::numeric THEN 'Jasa Konsultasi'::text
                    WHEN a.kgr_id = 2::numeric THEN 'Pekerjaan Konstruksi'::text
                    WHEN a.kgr_id = 3::numeric THEN 'Jasa Lainnya'::text
                ELSE 'Jasa Konsultasi Perorangan'::text
                END
            ) AS kategori,
            COUNT(a.pkt_nama) AS t_paket,
            COUNT(b.rkn_nama) AS t_paket_selesai,
            COUNT(a.pkt_nama) - COUNT(b.rkn_nama) AS t_paket_belum_selesai,
            SUM(a.pkt_hps) AS t_hps,
            SUM(b.harga_terkoreksi) as t_tawar,
            SUM(
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
                )
                    *
                100
            ) AS prosentase
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.stk_id", $satker);
        }
        $this->pg_db->group_by("a.kgr_id");
        $this->pg_db->group_by("a.stk_nama");
        $this->pg_db->order_by("a.stk_nama", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }
}