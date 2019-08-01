<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

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
            $data = $rows->prp_id;
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



    // ****************************************
    // ||
    // || APP FUNCTION
    // ||
    // ****************************************

    public function lelang_resume($tahun){
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
    	$data = $this->pg_db->get();
    	return $data;
    }

    public function paket_sirup(){
    	$this->local_db->select("
    		nama_satker, 
    		SUM(total_pagu) AS total_pagu, 
    		SUM(CASE WHEN motode_str = 'Tender' THEN 1 ELSE 0 END) AS jml_tender,
    		SUM(CASE WHEN motode_str = 'Seleksi' THEN 1 ELSE 0 END) AS jml_seleksi
    	");
    	$this->local_db->from("tbl_pkt_penyedia");
    	$this->local_db->WHERE("motode_str IN('tender','seleksi')");
    	$this->local_db->group_by("nama_satker");
    	$data = $this->local_db->get();
    	return $data;
    }

    public function paket_penyedia(){
    	$this->local_db->select("
    		DISTINCT(motode_str) AS metode_str, 
		  	COUNT(CASE WHEN jenis_pengadaan_str IN ('Barang','Jasa Lainnya','Pekerjaan Konstruksi','Jasa Konsultansi') AND total_pagu < 50000000 THEN id END) AS pencatatan_non_tender,
		  	(COUNT(CASE WHEN jenis_pengadaan_str IN ('Barang','Jasa Lainnya','Pekerjaan Konstruksi') AND total_pagu BETWEEN 50000000 AND 200000000 THEN id END) + COUNT(CASE WHEN jenis_pengadaan_str IN ('Jasa Konsultansi') AND total_pagu BETWEEN 50000000 AND 100000000 THEN id END)) AS non_tender,
		  	COUNT(CASE WHEN motode_str = 'Tender' THEN motode_str END) AS tender,
		  	COUNT(CASE WHEN motode_str = 'Seleksi' THEN motode_str END) AS seleksi
    	");
    	$this->local_db->from("tbl_pkt_penyedia");
    	$this->local_db->group_by("motode_str");
    	$data = $this->local_db->get();
    	return $data;
    }

    public function paket_swakelola(){
        $this->local_db->select("DISTINCT (nama_satker) AS nama_satker, (SUM(total_pagu)/1000000000) as pagu");
        $this->local_db->from("tbl_pkt_penyedia");
        $this->local_db->group_by("nama_satker");
        $data = $this->local_db->get();
        return $data;
    }

    public function metode_tender_seleksi($tahun){
        $this->pg_db->select("metode, COUNT(tahun) AS jml_paket");
        $this->pg_db->from("narno_semua");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->group_by("metode");
        $data = $this->pg_db->get();
        return $data;
    }

    public function efisiensi_tender($tahun){
        $this->pg_db->select("
            a.tahun,
            COUNT(a.stk_id) AS jml_paket,
            (SUM((CASE WHEN b.pkt_pagu = 0 THEN b.harga_terkoreksi ELSE b.pkt_pagu END) - b.harga_terkoreksi) / 1000000000) AS efisiensi,
            (SUM(b.harga_terkoreksi) / 1000000000) AS penawaran,
            (SUM(a.pkt_hps) / 1000000000) AS pg_paket
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        $this->pg_db->where("b.harga_terkoreksi >", 0);
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $this->pg_db->order_by("a.tahun", "ASC");
        $this->pg_db->group_by("a.tahun");
        $data = $this->pg_db->get();
        return $data;
    }

    public function efisiensi_non_tender($tahun){
        $this->pg_db->select("
            a.tahun,
            (SUM(a.pkt_hps)/1000000) as hps,
            (SUM(b.harga_terkoreksi)/1000000) as kontrak,
            (SUM((CASE WHEN a.pkt_hps = 0 THEN b.harga_terkoreksi ELSE a.pkt_hps END) - b.harga_terkoreksi)/1000000) AS efisiensi
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->join("narno_pl_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $this->pg_db->order_by("a.tahun", "ASC");
        $this->pg_db->group_by("a.tahun");
        $data = $this->pg_db->get();
        return $data;
    }

    public function versi_lelang_spse($tahun){
        $this->pg_db->select("
            versi_lelang,
            (CASE WHEN versi_lelang = 'SPSE4'::text THEN count(versi_lelang) ELSE COUNT(versi_lelang) END) AS jml_spse4
        ");
        $this->pg_db->from("narno_semua");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->group_by("versi_lelang");
        $data = $this->pg_db->get();
        return $data;
    }

    public function paket_eprocurement($tahun){
        $this->pg_db->select("
            a.tahun,
            COUNT(a.lls_id) AS t_paket,
            count(b.lls_id) AS t_paket_selesai
        ");
        $this->pg_db->from("narno_semua a");
        $this->pg_db->join("narno_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $this->pg_db->order_by("a.tahun", "ASC");
        $this->pg_db->group_by("a.tahun");
        $data = $this->pg_db->get();
        return $data;
    }

    public function paket_non_tender($tahun){
        $this->pg_db->select("
            a.tahun,
            COUNT(a.lls_id) as jml_paket,
            COUNT(b.rkn_nama) as jml_paket_selesai
        ");
        $this->pg_db->from("narno_pl_semua a");
        $this->pg_db->join("narno_pl_menang b", "a.lls_id = b.lls_id");
        if ($tahun != 'all') {
            $this->pg_db->where("a.tahun", $tahun+0);
        }
        $this->pg_db->order_by("a.tahun", "ASC");
        $this->pg_db->group_by("a.tahun");
        $data = $this->pg_db->get();
        return $data;
    }

    public function pelaksanaan_pbj_lelang_ulang($tahun){
        $this->pg_db->select("tahun, COUNT(pkt_nama) as jumlah_paket");
        $this->pg_db->from("status_lelang");
        $this->pg_db->where("lls_diulang_karena IS NOT NULL");
        $this->pg_db->where("lls_versi_lelang >", 1);
        $this->pg_db->where("lls_status", 1);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->order_by("tahun", "ASC");
        $this->pg_db->group_by("tahun");
        $data = $this->pg_db->get();
        return $data;
    }

    public function pelaksanaan_pbj_lelang_gagal($tahun){
        $this->pg_db->select("tahun, COUNT(pkt_nama) as jumlah_paket");
        $this->pg_db->from("status_lelang");
        $this->pg_db->where("lls_diulang_karena IS NOT NULL");
        $this->pg_db->where("lls_versi_lelang >", 1);
        $this->pg_db->where("lls_status", 2);
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->order_by("tahun", "ASC");
        $this->pg_db->group_by("tahun");
        $data = $this->pg_db->get();
        return $data;
    }

    public function pelaksanaan_pbj_lelang_sanggah(){
        
        $data = $this->pg_db->query("
                    SELECT
                        date_part('year'::text, b.sgh_tanggal) AS tahun,
                        COUNT(d.lls_id) AS jumlah_paket
                    FROM
                        rekanan a
                    JOIN
                        peserta c ON a.rkn_id = c.rkn_id
                    JOIN
                        sanggahan b ON c.psr_id = b.psr_id
                    JOIN
                        lelang_seleksi d ON c.lls_id = d.lls_id
                    JOIN
                        paket e ON e.pkt_id = d.pkt_id
                    JOIN
                        satuan_kerja f ON f.stk_id = e.stk_id
                    WHERE
                        CASE WHEN b.peg_id > 0 THEN 1 ELSE 0 END < 1
                    GROUP BY
                        date_part('year'::text, b.sgh_tanggal)
                    ORDER BY
                        date_part('year'::text, b.sgh_tanggal)
                        ASC
                ");
        return $data;
    }

    public function aktifitas_rekanan_status_penyedia(){
        $id_repo        = $this->get_repo();
        $id_provinsi    = $this->get_provinsi(); 
        $this->pg_db->select("
            a.kbp_nama,
            COUNT(b.rkn_id) AS rkn,
            SUM(CASE WHEN b.rkn_status_verifikasi::text = '1111111'::text THEN 1 WHEN b.rkn_status_verifikasi::text = '1111'::text THEN 1 ELSE 0 END) AS sdh,
            SUM(CASE WHEN b.rkn_status_verifikasi::text = '0000000'::text THEN 1 ELSE 0 END) AS blm,
            SUM(CASE WHEN b.rkn_status = '-2' THEN 1 ELSE 0 END) AS tolak
        ");
        $this->pg_db->from("kabupaten a");
        $this->pg_db->join("rekanan b", "a.kbp_id = b.kbp_id");
        $this->pg_db->where("a.prp_id = ".$id_provinsi);
        $this->pg_db->where("b.repo_id = ".$id_repo);
        $this->pg_db->order_by("COUNT(b.rkn_id)", "DESC");
        $this->pg_db->group_by("a.kbp_nama");
        $data = $this->pg_db->get();
        return $data;

        $this->pg_db->select("*");
        $this->pg_db->from("kabupaten");
        $data = $this->pg_db->get();
        return $data;
    }

    public function aktifitas_rekanan_kategori_badan_usaha(){
        $id_provinsi = $this->get_provinsi();
        $this->pg_db->select("
            kbp_nama,
            COUNT(CASE WHEN btu_nama = 'CV' THEN kode_kualifikasi END) AS cv,
            COUNT(CASE WHEN btu_nama = 'PT' THEN kode_kualifikasi END) AS pt,
            COUNT(CASE WHEN btu_nama = 'UD' THEN kode_kualifikasi END) AS ud,
            COUNT(CASE WHEN btu_nama = 'Koperasi' THEN kode_kualifikasi END) AS kop,
            COUNT(CASE WHEN btu_nama = 'Perusahaan Dagang' THEN kode_kualifikasi END) AS pd,
            COUNT(CASE When kualifikasi = 'Perusahaan Kecil' THEN kode_kualifikasi END) AS kecil,
            COUNT(CASE WHEN kualifikasi = 'Perusahaan Non Kecil' THEN kode_kualifikasi END) AS non,
            COUNT(CASE WHEN kualifikasi = 'Gabungan' THEN kode_kualifikasi END) AS gab,
            COUNT(CASE WHEN kualifikasi = 'Belum Pilih Kualifikasi' THEN kode_kualifikasi END) AS blm
        ");
        $this->pg_db->from("narno_kualifikasi");
        $this->pg_db->where("prp_id", $id_provinsi);
        $this->pg_db->order_by("cv", "DESC");
        $this->pg_db->group_by("kbp_nama");
        $data = $this->pg_db->get();
        return $data;
    }

    public function aktifitas_rekanan_kualifikasi_badan_usaha(){
        $id_repo        = $this->get_repo();
        $id_kabupaten   = $this->get_kabupaten(); 
        $this->pg_db->select("
            kbp_nama,
            COUNT(CASE When kualifikasi = 'Perusahaan Kecil' THEN kode_kualifikasi END) AS kecil,
            COUNT(CASE WHEN kualifikasi = 'Perusahaan Non Kecil' THEN kode_kualifikasi END) AS non,
            COUNT(CASE WHEN kualifikasi = 'Gabungan' THEN kode_kualifikasi END) AS gab,
            COUNT(CASE WHEN kualifikasi = 'Belum Pilih Kualifikasi' THEN kode_kualifikasi END) AS blm
        ");
        $this->pg_db->from("narno_kualifikasi");
        $this->pg_db->where("repo_id", $id_repo);
        $this->pg_db->where("kbp_id", $id_kabupaten);
        $this->pg_db->group_by("kbp_nama");
        $data = $this->pg_db->get();
        return $data;
    }

    public function aktifitas_rekanan_top_tendering($tahun){
        $this->pg_db->select("
            rkn_nama,
            COUNT(lls_id) as jml_paket 
        ");
        $this->pg_db->from("narno_pl_menang");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->order_by("jml_paket", "DESC");
        $this->pg_db->group_by("rkn_nama");
        $this->pg_db->limit(10);
        $data = $this->pg_db->get();
        return $data;
    }

    public function aktifitas_rekanan_top_nontendering($tahun){
        $this->pg_db->select("
            rkn_nama,
            COUNT(lls_id) as jml_paket 
        ");
        $this->pg_db->from("narno_menang");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->order_by("jml_paket", "DESC");
        $this->pg_db->group_by("rkn_nama");
        $this->pg_db->limit(10);
        $data = $this->pg_db->get();
        return $data;
    }

    public function kelompok_tender($tahun){
        $this->pg_db->select("
            (CASE
                WHEN kgr_id = 0::numeric THEN 'Barang'::text
                WHEN kgr_id = 1::numeric THEN 'Jasa Konsultasi'::text
                WHEN kgr_id = 2::numeric THEN 'Pekerjaan Konstruksi'::text
                WHEN kgr_id = 3::numeric THEN 'Jasa Lainnya'::text
            ELSE
                'Jasa Konsultasi Perorangan'::text
            END
            )AS kategori,
            COUNT(mtd_pemilihan) AS jml_paket,
            (SUM(pkt_hps)/1000000000) AS jml_hps
        ");
        $this->pg_db->from("narno_semua");
        if ($tahun != 'all') {
            $this->pg_db->where("tahun", $tahun+0);
        }
        $this->pg_db->order_by("kgr_id", "ASC");
        $this->pg_db->group_by("kgr_id");
        $data = $this->pg_db->get();
        return $data;
    }
}