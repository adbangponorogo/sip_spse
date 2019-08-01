<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan_profil_model extends CI_Model {

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

    public function rekanan_provinsi($tahun){
        $this->pg_db->select("
            a.prp_nama,
            COUNT(c.rkn_id) AS rkn,
            sum(
                CASE
                WHEN c.rkn_status_verifikasi::text = '0000000'::text THEN 1
                ELSE 0
                END) AS blm,                
            sum(
              CASE
              WHEN c.rkn_status = '-2' THEN 1
              ELSE 0
              END) AS tolak,
            sum(
              CASE
              WHEN c.rkn_status_verifikasi::text = '1111111'::text THEN 1
              WHEN c.rkn_status_verifikasi::text = '1111'::text THEN 1
              ELSE 0
              END) AS sdh
        ");
        $this->pg_db->from("propinsi a");
        $this->pg_db->join("kabupaten b", "a.prp_id=b.prp_id");
        $this->pg_db->join("rekanan c", "b.kbp_id=c.kbp_id");
        if ($tahun != 'all') {
            $this->pg_db->where("DATE_PART('year'::text, c.rkn_tgl_daftar) =", $tahun+0);
        }
        $this->pg_db->group_by("a.prp_nama");
        $this->pg_db->order_by("COUNT(c.rkn_id)", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }

    public function total_rekanan_provinsi($tahun){
        $this->pg_db->select("
            COUNT(c.rkn_id) AS rkn,
            SUM(
                CASE
                    WHEN c.rkn_status_verifikasi::text = '0000000'::text THEN 1
                ELSE 0
                END
            ) AS blm,                
            SUM(
              CASE
                WHEN c.rkn_status = '-2' THEN 1
                ELSE 0
                END
            ) AS tolak,
            SUM(
              CASE
                WHEN c.rkn_status_verifikasi::text = '1111111'::text THEN 1
                WHEN c.rkn_status_verifikasi::text = '1111'::text THEN 1
              ELSE 0
              END
            ) AS sdh
        ");
        $this->pg_db->from("propinsi a");
        $this->pg_db->join("kabupaten b", "a.prp_id=b.prp_id");
        $this->pg_db->join("rekanan c", "b.kbp_id=c.kbp_id");
        if ($tahun != 'all') {
            $this->pg_db->where("DATE_PART('year'::text, c.rkn_tgl_daftar) =", $tahun+0);
        }
        $data = $this->pg_db->get();
        return $data;
    }



    public function rekanan_kabupaten($tahun){
        $this->pg_db->select("
            a.kbp_nama,
            COUNT(b.rkn_id) AS rkn,
            SUM(
                CASE
                    WHEN b.rkn_status_verifikasi::text = '0000000'::text THEN 1
                ELSE 0
                END
            ) AS blm,                
            SUM(
              CASE
                WHEN b.rkn_status = '-2' THEN 1
                ELSE 0
              END
            ) AS tolak,
            SUM(
              CASE
                WHEN b.rkn_status_verifikasi::text = '1111111'::text THEN 1
                WHEN b.rkn_status_verifikasi::text = '1111'::text THEN 1
              ELSE 0
              END
            ) AS sdh
        ");
        $this->pg_db->from("kabupaten a");
        $this->pg_db->join("rekanan b", "a.kbp_id=b.kbp_id");
        if ($tahun != 'all') {
            $this->pg_db->where("DATE_PART('year'::text, b.rkn_tgl_daftar) =", $tahun+0);
        }
        $this->pg_db->group_by("a.kbp_nama");
        $this->pg_db->order_by("COUNT(b.rkn_id)", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }


    public function total_rekanan_kabupaten($tahun){
        $this->pg_db->select("
            COUNT(b.rkn_id) AS rkn,
            SUM(
                CASE
                    WHEN b.rkn_status_verifikasi::text = '0000000'::text THEN 1
                ELSE 0
                END
            ) AS blm,                
            SUM(
              CASE
                WHEN b.rkn_status = '-2' THEN 1
                ELSE 0
              END
            ) AS tolak,
            SUM(
              CASE
                WHEN b.rkn_status_verifikasi::text = '1111111'::text THEN 1
                WHEN b.rkn_status_verifikasi::text = '1111'::text THEN 1
              ELSE 0
              END
            ) AS sdh
        ");
        $this->pg_db->from("kabupaten a");
        $this->pg_db->join("rekanan b", "a.kbp_id=b.kbp_id");
        if ($tahun != 'all') {
            $this->pg_db->where("DATE_PART('year'::text, b.rkn_tgl_daftar) =", $tahun+0);
        }
        $data = $this->pg_db->get();
        return $data;
    }


    public function kelompok_usaha_kabupaten($tahun){
        $this->pg_db->select("
            kbp_nama, 
            COUNT(CASE WHEN btu_nama = 'CV' THEN kode_kualifikasi END) AS cv,
            COUNT(CASE WHEN btu_nama = 'PT' THEN kode_kualifikasi END) AS pt,
            COUNT(CASE WHEN btu_nama = 'UD' THEN kode_kualifikasi END) AS ud,
            COUNT(CASE WHEN btu_nama = 'Koperasi' THEN kode_kualifikasi END) AS kop,
            COUNT(CASE WHEN btu_nama = 'Perusahaan Dagang' THEN kode_kualifikasi END) AS pd,
            COUNT(CASE WHEN kualifikasi = 'Perusahaan Kecil' THEN kode_kualifikasi END) AS kecil,
            COUNT(CASE WHEN kualifikasi = 'Perusahaan Non Kecil' THEN kode_kualifikasi END) AS non,
            COUNT(CASE WHEN kualifikasi = 'Gabungan' THEN kode_kualifikasi END) AS gab,
            COUNT(CASE WHEN kualifikasi = 'Belum Pilih Kualifikasi' THEN kode_kualifikasi END) AS blm
        ");
        $this->pg_db->from("narno_kualifikasi");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->group_by("kbp_nama");
        $this->pg_db->order_by("kbp_nama", "DESC");
        $data = $this->pg_db->get();
        return $data;
    }


    public function total_kelompok_usaha_kabupaten($tahun){
        $this->pg_db->select("
            COUNT(CASE WHEN btu_nama = 'CV' THEN kode_kualifikasi END) AS cv,
            COUNT(CASE WHEN btu_nama = 'PT' THEN kode_kualifikasi END) AS pt,
            COUNT(CASE WHEN btu_nama = 'UD' THEN kode_kualifikasi END) AS ud,
            COUNT(CASE WHEN btu_nama = 'Koperasi' THEN kode_kualifikasi END) AS kop,
            COUNT(CASE WHEN btu_nama = 'Perusahaan Dagang' THEN kode_kualifikasi END) AS pd,
            COUNT(CASE WHEN kualifikasi = 'Perusahaan Kecil' THEN kode_kualifikasi END) AS kecil,
            COUNT(CASE WHEN kualifikasi = 'Perusahaan Non Kecil' THEN kode_kualifikasi END) AS non,
            COUNT(CASE WHEN kualifikasi = 'Gabungan' THEN kode_kualifikasi END) AS gab,
            COUNT(CASE WHEN kualifikasi = 'Belum Pilih Kualifikasi' THEN kode_kualifikasi END) AS blm
        ");
        $this->pg_db->from("narno_kualifikasi");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $data = $this->pg_db->get();
        return $data;
    }
}