<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendering_eprocurement_model extends CI_Model {

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

    public function lelang_resume($tahun, $satker){
        $this->pg_db->select("
            COUNT(a.pkt_nama) AS t_paket,
            COUNT(b.rkn_nama) AS t_paket_selesai,
            (COUNT(a.pkt_nama) - COUNT(b.rkn_nama)) AS t_paket_belum_selesai,
            (SUM(a.pkt_pagu)/1000000000) AS t_pagu,
            (SUM(CASE WHEN b.harga_terkoreksi > 0 then a.pkt_pagu/1000000000 ELSE 0 END)) AS t_pagu_selesai,
            SUM(b.harga_terkoreksi/1000000000) AS t_tawar,
            (SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi/1000000000 ELSE a.pkt_pagu/1000000000 END) - b.harga_terkoreksi/1000000000)) AS selisih,
            ((SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) / SUM(CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) * 100 )) AS ttl_pros
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

    public function lelang_pertahun($tahun, $satker){
        $this->pg_db->select("
            a.tahun,
            COUNT(a.pkt_nama) AS t_paket,
            COUNT(b.rkn_nama) AS t_paket_selesai,
            COUNT(a.pkt_nama) - COUNT(b.rkn_nama) AS t_paket_belum_selesai,   
            SUM(a.pkt_pagu) AS t_pagu,
            SUM(CASE WHEN b.harga_terkoreksi > 0 THEN a.pkt_pagu ELSE 0 END) AS t_pagu_selesai, 
            SUM(b.harga_terkoreksi) AS t_tawar,   
            SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS selisih,  
            (SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) / SUM(CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) * 100 ) AS ttl_pros
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $this->pg_db->group_by("a.tahun");
        $this->pg_db->order_by("a.tahun", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_lelang_pertahun($tahun, $satker){
        $this->pg_db->select("
            COUNT(a.pkt_nama) AS t_paket,
            COUNT(b.rkn_nama) AS t_paket_selesai,
            COUNT(a.pkt_nama) - COUNT(b.rkn_nama) AS t_paket_belum_selesai,   
            SUM(a.pkt_pagu) AS t_pagu,
            SUM(CASE WHEN b.harga_terkoreksi > 0 THEN a.pkt_pagu ELSE 0 END) AS t_pagu_selesai, 
            SUM(b.harga_terkoreksi) AS t_tawar,   
            SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS selisih,  
            (SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) / SUM(CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) * 100 ) AS ttl_pros
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


    public function metode_pertahun($tahun, $satker){
        $this->pg_db->select("
            a.metode,
            COUNT(a.lls_id) AS total_paket,
            SUM(a.pkt_pagu) AS total_pagu,
            COUNT(b.rkn_nama) AS total_paket_selesai,
            (COUNT(a.lls_id) - COUNT(b.rkn_nama) ) AS belum_selesai,
            SUM(b.harga_terkoreksi) AS t_tawar
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $this->pg_db->group_by("a.metode");
        $this->pg_db->order_by("total_paket", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_metode_pertahun($tahun, $satker){
        $this->pg_db->select("
            COUNT(a.lls_id) AS total_paket,
            SUM(a.pkt_pagu) AS total_pagu,
            COUNT(b.rkn_nama) AS total_paket_selesai,
            (COUNT(a.lls_id) - COUNT(b.rkn_nama) ) AS belum_selesai,
            SUM(b.harga_terkoreksi) AS t_tawar
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

    public function kelompok_pertahun($tahun, $satker){
        $this->pg_db->select("
            (
                CASE
                    WHEN kgr_id = 0::numeric THEN 'Barang'::text
                    WHEN kgr_id = 1::numeric THEN 'Jasa Konsultasi'::text
                    WHEN kgr_id = 2::numeric THEN 'Pekerjaan Konstruksi'::text
                    WHEN kgr_id = 3::numeric THEN 'Jasa Lainnya'::text
                ELSE 'Jasa Konsultasi Perorangan'::text
                END
            ) AS kategori,
            SUM(
                CASE
                    WHEN mtd_pemilihan = 0::numeric THEN 1::bigint
                    WHEN mtd_pemilihan = 3::numeric THEN 1::bigint
                ELSE 0::bigint
                END
            ) AS pkt_umum,
            SUM(
                CASE
                    WHEN mtd_pemilihan = 0::numeric THEN pkt_pagu
                    WHEN mtd_pemilihan = 3::numeric THEN pkt_pagu
                ELSE 0::bigint::numeric
                END
            ) AS pagu_umum,
            SUM(
                CASE
                    WHEN mtd_pemilihan = 1::numeric THEN 1::bigint
                    WHEN mtd_pemilihan = 2::numeric THEN 1::bigint
                    WHEN mtd_pemilihan = 4::numeric THEN 1::bigint
                    WHEN mtd_pemilihan = 9::numeric THEN 1::bigint
                ELSE 0::bigint
                END
            ) AS pkt_sederhana,
            SUM(
                CASE
                    WHEN mtd_pemilihan = 1::numeric THEN pkt_pagu
                    WHEN mtd_pemilihan = 2::numeric THEN pkt_pagu
                    WHEN mtd_pemilihan = 4::numeric THEN pkt_pagu
                    WHEN mtd_pemilihan = 9::numeric THEN pkt_pagu
                ELSE 0::bigint::numeric
                END
            ) AS pagu_sederhana,
            (
                SUM(
                    CASE
                        WHEN mtd_pemilihan = 0::numeric THEN 1::bigint
                        WHEN mtd_pemilihan = 3::numeric THEN 1::bigint
                    ELSE 0::bigint
                    END
                    )
                +
                SUM(
                    CASE
                        WHEN mtd_pemilihan = 1::numeric THEN 1::bigint
                        WHEN mtd_pemilihan = 2::numeric THEN 1::bigint
                        WHEN mtd_pemilihan = 4::numeric THEN 1::bigint
                        WHEN mtd_pemilihan = 9::numeric THEN 1::bigint
                    ELSE 0::bigint
                    END
                    )
            ) AS pkt_total,
            SUM(
                CASE
                    WHEN mtd_pemilihan < 12::numeric THEN pkt_pagu
                ELSE 0::bigint::numeric
                END
            ) AS pagu_total
        ");
        $this->pg_db->from("narno_semua");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $this->pg_db->group_by("kgr_id");
        $this->pg_db->order_by("kgr_id", "ASC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_kelompok_pertahun($tahun, $satker){
        $this->pg_db->select("
            SUM(
                CASE
                    WHEN mtd_pemilihan = 0::numeric THEN 1::bigint
                    WHEN mtd_pemilihan = 3::numeric THEN 1::bigint
                ELSE 0::bigint
                END
            ) AS pkt_umum,
            SUM(
                CASE
                    WHEN mtd_pemilihan = 0::numeric THEN pkt_pagu
                    WHEN mtd_pemilihan = 3::numeric THEN pkt_pagu
                ELSE 0::bigint::numeric
                END
            ) AS pagu_umum,
            SUM(
                CASE
                    WHEN mtd_pemilihan = 1::numeric THEN 1::bigint
                    WHEN mtd_pemilihan = 2::numeric THEN 1::bigint
                    WHEN mtd_pemilihan = 4::numeric THEN 1::bigint
                    WHEN mtd_pemilihan = 9::numeric THEN 1::bigint
                ELSE 0::bigint
                END
            ) AS pkt_sederhana,
            SUM(
                CASE
                    WHEN mtd_pemilihan = 1::numeric THEN pkt_pagu
                    WHEN mtd_pemilihan = 2::numeric THEN pkt_pagu
                    WHEN mtd_pemilihan = 4::numeric THEN pkt_pagu
                    WHEN mtd_pemilihan = 9::numeric THEN pkt_pagu
                ELSE 0::bigint::numeric
                END
            ) AS pagu_sederhana,
            (
                SUM(
                    CASE
                        WHEN mtd_pemilihan = 0::numeric THEN 1::bigint
                        WHEN mtd_pemilihan = 3::numeric THEN 1::bigint
                    ELSE 0::bigint
                    END
                    )
                +
                SUM(
                    CASE
                        WHEN mtd_pemilihan = 1::numeric THEN 1::bigint
                        WHEN mtd_pemilihan = 2::numeric THEN 1::bigint
                        WHEN mtd_pemilihan = 4::numeric THEN 1::bigint
                        WHEN mtd_pemilihan = 9::numeric THEN 1::bigint
                    ELSE 0::bigint
                    END
                    )
            ) AS pkt_total,
            SUM(
                CASE
                    WHEN mtd_pemilihan < 12::numeric THEN pkt_pagu
                ELSE 0::bigint::numeric
                END
            ) AS pagu_total
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

    public function agency_pertahun($tahun, $satker){
        $this->pg_db->select("
            a.agc_nama,
            COUNT(a.pkt_nama) AS t_paket,
            COUNT(b.rkn_nama) AS t_paket_selesai,
            (COUNT(a.pkt_nama) - COUNT(b.rkn_nama)) AS t_paket_belum_selesai,   
            SUM(a.pkt_pagu) AS t_pagu,
            (SUM(a.pkt_pagu) - SUM(CASE WHEN b.harga_terkoreksi > 0 THEN a.pkt_pagu ELSE 0 END)) AS t_pagu_belum_selesai,
            SUM(CASE WHEN b.harga_terkoreksi > 0 THEN a.pkt_pagu ELSE 0 END) AS t_pagu_selesai, 
            SUM(b.harga_terkoreksi) AS t_tawar,   
            SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS selisih,  
            (SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) / SUM(CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) *100 ) AS t_pros
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $this->pg_db->group_by("a.agc_nama");
        $this->pg_db->order_by("selisih", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_agency_pertahun($tahun, $satker){
        $this->pg_db->select("
            COUNT(a.pkt_nama) AS t_paket,
            COUNT(b.rkn_nama) AS t_paket_selesai,
            (COUNT(a.pkt_nama) - COUNT(b.rkn_nama)) AS t_paket_belum_selesai,   
            SUM(a.pkt_pagu) AS t_pagu,
            (SUM(a.pkt_pagu) - SUM(CASE WHEN b.harga_terkoreksi > 0 THEN a.pkt_pagu ELSE 0 END)) AS t_pagu_belum_selesai,
            SUM(CASE WHEN b.harga_terkoreksi > 0 THEN a.pkt_pagu ELSE 0 END) AS t_pagu_selesai, 
            SUM(b.harga_terkoreksi) AS t_tawar,   
            SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS selisih,  
            (SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) / SUM(CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) *100 ) AS t_pros
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

    public function asal_pemenang_pertahun($tahun, $satker){
        $provinsi = $this->get_provinsi();

        $this->pg_db->select("
            (
                CASE
                    WHEN prp_id = ".intval($provinsi['id_provinsi'])."::numeric THEN kbp_nama
                    ELSE 'Luar Provinsi ".strval($provinsi['nama_provinsi'])."'::character varying
                END
            )AS nama_kota,
            COUNT(lls_id) AS t_paket,
            SUM(pkt_pagu) AS pagu,
            SUM(pkt_hps) AS hps,
            SUM(harga_terkoreksi) AS penawaran,
            SUM((CASE WHEN pkt_pagu = 0 THEN harga_terkoreksi ELSE pkt_pagu END) - harga_terkoreksi) AS efisiensi,  
            (SUM((CASE WHEN pkt_pagu = 0 THEN harga_terkoreksi ELSE pkt_pagu END) - harga_terkoreksi) / SUM(CASE WHEN pkt_pagu = 0 THEN harga_terkoreksi ELSE pkt_pagu END) *100 ) AS pro
        ");
        $this->pg_db->from("narno_menang");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $this->pg_db->group_by("nama_kota");
        $this->pg_db->order_by("COUNT(lls_id)", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_asal_pemenang_pertahun($tahun, $satker){
        $provinsi = $this->get_provinsi();

        $this->pg_db->select("
            COUNT(lls_id) AS t_paket,
            SUM(pkt_pagu) AS pagu,
            SUM(pkt_hps) AS hps,
            SUM(harga_terkoreksi) AS penawaran,
            SUM((CASE WHEN pkt_pagu = 0 THEN harga_terkoreksi ELSE pkt_pagu END) - harga_terkoreksi) AS efisiensi,  
            (SUM((CASE WHEN pkt_pagu = 0 THEN harga_terkoreksi ELSE pkt_pagu END) - harga_terkoreksi) / SUM(CASE WHEN pkt_pagu = 0 THEN harga_terkoreksi ELSE pkt_pagu END) *100 ) AS pro
        ");
        $this->pg_db->from("narno_menang");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $data = $this->pg_db->get();
        return $data;
    }

    public function satker_pertahun($tahun, $satker){
        $this->pg_db->select("
            a.stk_nama,
            COUNT(a.pkt_nama) AS t_paket,
            COUNT(b.rkn_nama) AS t_paket_selesai,   
            SUM(a.pkt_pagu) AS t_pagu,
            (COUNT(a.lls_id) - COUNT(b.lls_id)) AS t_paket_belum_selesai,
            SUM(CASE WHEN b.harga_terkoreksi > 0 THEN a.pkt_pagu ELSE 0 END) AS t_pagu_selesai, 
            SUM(b.harga_terkoreksi) AS t_tawar,   
            SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS selisih,  
            (
                SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi)
                /
                SUM(CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) *100
            ) AS t_pros
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
        $this->pg_db->order_by("t_paket_selesai", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_satker_pertahun($tahun, $satker){
        $this->pg_db->select("
            COUNT(a.pkt_nama) AS t_paket,
            COUNT(b.rkn_nama) AS t_paket_selesai,   
            SUM(a.pkt_pagu) AS t_pagu,
            (COUNT(a.lls_id) - COUNT(b.lls_id)) AS t_paket_belum_selesai,
            SUM(CASE WHEN b.harga_terkoreksi > 0 THEN a.pkt_pagu ELSE 0 END) AS t_pagu_selesai, 
            SUM(b.harga_terkoreksi) AS t_tawar,   
            SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi) AS selisih,  
            (
                SUM((CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) - b.harga_terkoreksi)
                /
                SUM(CASE WHEN a.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE a.pkt_pagu END) *100
            ) AS t_pros
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("a.agc_id", $satker);
        }
        $this->pg_db->order_by("t_paket_selesai", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function top_ten_tender_barang($tahun, $satker){
        $this->pg_db->select("rkn_nama, kbp_nama, COUNT(lls_id) AS paket, (SUM(harga_terkoreksi)/1000000000) AS penawaran");
        $this->pg_db->from("narno_menang");
        $this->pg_db->where("kgr_id", 0);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $this->pg_db->group_by("rkn_nama, kbp_nama");
        $this->pg_db->order_by("paket", "DESC");
        $this->pg_db->limit(10);
        $data = $this->pg_db->get();
        return $data;
    }

    public function top_ten_tender_konsultasi($tahun, $satker){
        $this->pg_db->select("rkn_nama, kbp_nama, COUNT(lls_id) AS paket, (SUM(harga_terkoreksi)/1000000000) AS penawaran");
        $this->pg_db->from("narno_menang");
        $this->pg_db->where("kgr_id", 1);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $this->pg_db->group_by("rkn_nama, kbp_nama");
        $this->pg_db->order_by("paket", "DESC");
        $this->pg_db->limit(10);
        $data = $this->pg_db->get();
        return $data;
    }

    public function top_ten_tender_konstruksi($tahun, $satker){
        $this->pg_db->select("rkn_nama, kbp_nama, COUNT(lls_id) AS paket, (SUM(harga_terkoreksi)/1000000000) AS penawaran");
        $this->pg_db->from("narno_menang");
        $this->pg_db->where("kgr_id", 2);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        if ($satker != 'all') {
            $this->pg_db->where("agc_id", $satker);
        }
        $this->pg_db->group_by("rkn_nama, kbp_nama");
        $this->pg_db->order_by("paket", "DESC");
        $this->pg_db->limit(10);
        $data = $this->pg_db->get();
        return $data;
    }

    public function top_ten_nontender_barang($tahun, $satker){
        $this->pg_db->select("rkn_nama, kbp_nama, COUNT(lls_id) AS paket, (SUM(harga_terkoreksi)/1000000) AS penawaran");
        $this->pg_db->from("narno_pl_menang");
        $this->pg_db->where("kgr_id", 0);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->group_by("rkn_nama, kbp_nama");
        $this->pg_db->order_by("paket", "DESC");
        $this->pg_db->limit(10);
        $data = $this->pg_db->get();
        return $data;
    }

    public function top_ten_nontender_konsultasi($tahun, $satker){
        $this->pg_db->select("rkn_nama, kbp_nama, COUNT(lls_id) AS paket, (SUM(harga_terkoreksi)/1000000) AS penawaran");
        $this->pg_db->from("narno_pl_menang");
        $this->pg_db->where("kgr_id", 1);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->group_by("rkn_nama, kbp_nama");
        $this->pg_db->order_by("paket", "DESC");
        $this->pg_db->limit(10);
        $data = $this->pg_db->get();
        return $data;
    }

    public function top_ten_nontender_konstruksi($tahun, $satker){
        $this->pg_db->select("rkn_nama, kbp_nama, COUNT(lls_id) AS paket, (SUM(harga_terkoreksi)/1000000000) AS penawaran");
        $this->pg_db->from("narno_pl_menang");
        $this->pg_db->where("kgr_id", 2);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->group_by("rkn_nama, kbp_nama");
        $this->pg_db->order_by("paket", "DESC");
        $this->pg_db->limit(10);
        $data = $this->pg_db->get();
        return $data;
    }
}