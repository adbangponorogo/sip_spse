<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_paketpengadaan_model extends CI_Model {

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
    
    public function sistem_tender($tahun, $satker){
        $this->pg_db->select("
            a.lls_id,
            a.stk_nama, 
            a.pkt_nama,
            a.pkt_hps,
            a.tahun,
            a.bulan,
            b.rkn_nama,
            b.sbd_ket,
            a.versi_lelang,
            b.kbp_nama,
            b.harga_terkoreksi,
            ((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS efisiensi,  
            (((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) / (CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) * 100) AS prosentase
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $this->pg_db->order_by("a.lls_id", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_sistem_tender($tahun, $satker){
        $this->pg_db->select("
            SUM(a.pkt_hps) AS pkt_hps,
            SUM(b.harga_terkoreksi) AS penawaran,
            SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS efisiensi,  
            (SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) / SUM(CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) * 100 ) AS prosentase
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

    public function partisipasi_penawaran($tahun, $satker){
        $this->pg_db->select("
            a.lls_id,
            e.rup_id,
            a.tahun,
            a.bulan,
            a.pkt_nama,
            a.kategori,
            a.metode,
            a.stk_nama,
            b.sbd_ket,
            a.pkt_pagu,
            a.pnt_nama,
            a.versi_lelang,
            a.pkt_hps,
            b.rkn_nama,
            b.rkn_npwp,
            b.psr_harga,
            b.kbp_nama,
            b.prp_nama,
            b.harga_terkoreksi AS pen,
            (
                CASE
                    WHEN a.lls_versi_lelang > 1::numeric THEN 'Lelang Ulang'::text
                ELSE ' '::text
                END
            ) AS status,
            b.harga_terkoreksi,
            (
                CASE
                    WHEN a.pkt_pagu = 0::numeric THEN b.harga_terkoreksi
                ELSE a.pkt_pagu
                END
            ) - b.harga_terkoreksi AS efisiensi,
            (
                CASE
                    WHEN a.pkt_pagu = 0::numeric THEN b.harga_terkoreksi
                ELSE a.pkt_pagu
                END - b.harga_terkoreksi
            )
                /
            (
                CASE
                    WHEN a.pkt_pagu = 0::numeric THEN b.harga_terkoreksi
                ELSE a.pkt_pagu
                END
            ) * 100::numeric AS prosentase,
            c.jml_peserta,
            d.jml_rkn_nawar
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->join("narno_peserta c", "a.lls_id = c.lls_id");
        $this->pg_db->join("narno_nawar d", "a.lls_id = d.lls_id");
        $this->pg_db->join("narno_rup e", "a.lls_id = e.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $this->pg_db->order_by("a.tahun", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function partisipasi_rekanan($tahun, $satker){
        $this->pg_db->select("
            b.lls_id, 
            b.pkt_nama, 
            a.agc_id,
            b.tahun,
            b.bulan,
            b.stk_nama,
            b.instansi_id,
            b.pkt_hps,
            b.psr_harga,
            b.rkn_nama,
            b.rkn_alamat,
            b.dok_tgljam,
            b.status,
            b.efisiensi,
            b.metode,
            b.kategori,
            b.sbd_id
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_rekap b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("b.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $this->pg_db->order_by("a.lls_id", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }
    
}