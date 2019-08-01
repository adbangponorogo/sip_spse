<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sirup_rekapitulasi_model extends CI_Model {

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

    public function statistik_rekap_paket_penyedia($tahun){
        $this->local_db->select("
            COUNT(CASE WHEN motode_str = 'Pengadaan Langsung' THEN motode_str END) AS pengadaan_langsung,
            COUNT(CASE WHEN motode_str = 'Tender Cepat' THEN motode_str END) AS tender_cepat,
            COUNT(CASE WHEN motode_str = 'Tender' THEN motode_str END) AS tender,
            COUNT(CASE WHEN motode_str = 'Seleksi' THEN motode_str END) AS seleksi,
            COUNT(CASE WHEN motode_str = 'Penunjukan Langsung' THEN motode_str END) AS penunjukan_langsung,
            COUNT(CASE WHEN motode_str = 'e-Purchasing' THEN motode_str END) AS e_purchasing,
            SUM(CASE WHEN motode_str =  'Pengadaan Langsung' THEN total_pagu END) AS pg_pl, 
            SUM(CASE WHEN motode_str =  'Tender Cepat' THEN total_pagu END) AS pg_tc, 
            SUM(CASE WHEN motode_str =  'Tender' THEN total_pagu END) AS pg_t, 
            SUM(CASE WHEN motode_str =  'Seleksi' THEN total_pagu END) AS pg_sl, 
            SUM(CASE WHEN motode_str =  'Penunjukan Langsung' THEN total_pagu END) AS pg_plg, 
            SUM(CASE WHEN motode_str =  'e-Purchasing' THEN total_pagu END) AS pg_ep
        ");
        $this->local_db->from("tbl_pkt_penyedia");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function perencanaan_belanja_pemda($tahun){
        $this->local_db->select("
            id_satker,
            nama_satker,
            btl AS btl,
            bl AS bl,
            (btl + bl) AS jml_pagu
        ");
        $this->local_db->from("rekap_apbd");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->group_by("id_satker");
        $this->local_db->group_by("nama_satker");
        $this->local_db->group_by("btl");
        $this->local_db->group_by("bl");
        $data = $this->local_db->get();
        return $data;
    }

    public function total_perencanaan_belanja_pemda($tahun){
        $this->local_db->select("
            SUM(btl) AS btl,
            SUM(bl) AS bl,
            (SUM(btl) + SUM(bl)) AS jml_pagu
        ");
        $this->local_db->from("rekap_apbd");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function analisis_rup($tahun){
        $this->local_db->select("
            a.id_satker, 
            a.nama_satker, 
            a.bl AS bl,
            IF(b.jml_pagu > 0, b.jml_pagu,0) AS pg_sudah_penyedia, 
            IF(c.jml_pagu > 0, c.jml_pagu,0) AS pg_belum_penyedia, 
            IF(d.jml_pagu > 0, d.jml_pagu,0) AS pg_sudah_swakelola,
            IF(e.jml_pagu > 0, e.jml_pagu,0) AS pg_belum_swakelola, 
            (IF(b.jml_pagu > 0, b.jml_pagu,0) + if(d.jml_pagu > 0, d.jml_pagu,0)) AS pg_rup_tayang,
            (a.bl - (IF(b.jml_pagu > 0, b.jml_pagu, 0) + IF(d.jml_pagu > 0, d.jml_pagu,0))) AS pg_selisih_rup_tayang 
        ");
        $this->local_db->from("rekap_apbd a");
        $this->local_db->join("rekap_penyedia b", "a.id_satker = b.id_satker");
        $this->local_db->join("rekap_swakelola c", "a.id_satker = c.id_satker");
        $this->local_db->join("rekap_penyedia_belum d", "a.id_satker = d.id_satker");
        $this->local_db->join("rekap_swakelola_belum e", "a.id_satker = e.id_satker");
        $this->local_db->where("a.bl >", 0);
        if ($tahun != 'all') {
            $this->local_db->where("a.tahun", $tahun+0);
        }
        $this->local_db->group_by("a.id_satker");
        $this->local_db->group_by("a.nama_satker");
        $data = $this->local_db->get();
        return $data;
    }

    public function total_analisis_rup($tahun){
        $this->local_db->select("
            SUM(a.bl) AS bl,
            IF(b.jml_pagu > 0, b.jml_pagu,0) AS pg_sudah_penyedia, 
            IF(c.jml_pagu > 0, c.jml_pagu,0) AS pg_belum_penyedia, 
            IF(d.jml_pagu > 0, d.jml_pagu,0) AS pg_sudah_swakelola,
            IF(e.jml_pagu > 0, e.jml_pagu,0) AS pg_belum_swakelola, 
            (IF(b.jml_pagu > 0, b.jml_pagu,0) + if(d.jml_pagu > 0, d.jml_pagu,0)) AS pg_rup_tayang,
            (a.bl - (IF(b.jml_pagu > 0, b.jml_pagu, 0) + IF(d.jml_pagu > 0, d.jml_pagu,0))) AS pg_selisih_rup_tayang 
        ");
        $this->local_db->from("rekap_apbd a");
        $this->local_db->join("rekap_penyedia b", "a.id_satker = b.id_satker");
        $this->local_db->join("rekap_swakelola c", "a.id_satker = c.id_satker");
        $this->local_db->join("rekap_penyedia_belum d", "a.id_satker = d.id_satker");
        $this->local_db->join("rekap_swakelola_belum e", "a.id_satker = e.id_satker");
        $this->local_db->where("a.bl >", 0);
        if ($tahun != 'all') {
            $this->local_db->where("a.tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }


    public function tepra_rup($tahun){
        $this->local_db->select("
            jenis_pengadaan_str, 
            (SUM(CASE WHEN total_pagu < 200000000 THEN total_pagu ELSE 0 END)/1000000) AS pg_kur_200, 
            COUNT(CASE WHEN total_pagu < 200000000 THEN 1 END) AS pkt_kur_200, 
            (SUM(CASE WHEN total_pagu BETWEEN 200000000 AND 2500000000 THEN total_pagu ELSE 0 END)/1000000)  AS pg_kur_25,
            COUNT(CASE WHEN total_pagu BETWEEN 200000000 AND 2500000000 THEN 1 END) AS pkt_kur_25,
            (SUM(CASE WHEN total_pagu BETWEEN 2500000000 AND 50000000000 THEN total_pagu ELSE 0 END)/1000000) AS pg_kur_50,
            COUNT(CASE WHEN total_pagu BETWEEN 2500000000 AND 50000000000 THEN 1 END)  AS pkt_kur_50,
            (SUM(CASE WHEN total_pagu BETWEEN 50000000000 AND 100000000000 THEN total_pagu ELSE 0 END)/1000000) AS pg_kur_100,
            COUNT(CASE WHEN total_pagu BETWEEN 50000000000 AND 100000000000 THEN 1 END) AS pkt_kur_100,
            (SUM(CASE WHEN total_pagu > 100000000000 THEN total_pagu ELSE 0 END)/1000000)  AS pg_bih_100,
            COUNT(CASE WHEN total_pagu > 100000000000 THEN 1 END) AS pkt_bih_100,
            COUNT(id) AS jumlah_paket,
            (SUM(total_pagu)/1000000) AS total_pagu
        ");
        $this->local_db->from("tbl_pkt_penyedia");
        if ($tahun != 'all') {
            $this->db->where("tahun", $tahun+0);
        }
        $this->local_db->group_by("jenis_pengadaan_str");
        $data = $this->local_db->get();
        return $data;
    }

    public function total_tepra_rup($tahun){
        $this->local_db->select("
            a.pg_kur_200, 
            a.pkt_kur_200,
            a.pg_kur_25,
            a.pkt_kur_25,
            a.pg_kur_50,
            a.pkt_kur_50,
            a.pg_kur_100,
            a.pkt_kur_100,
            a.pg_bih_100,
            a.pkt_bih_100,
            (a.jumlah_paket + b.pkt_swa) AS jumlah_paket,
            (a.total_pagu + b.pg_swa) AS total_pagu,
            b.pg_swa,
            b.pkt_swa
        ");
        $this->local_db->from("rekap_penyedia_tepra a");
        $this->local_db->join("rekap_swakelola_tepra b", "a.tahun = b.tahun");
        if ($tahun != 'all') {
            $this->local_db->where("a.tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function progres_identifikasi_paket($tahun){
        $this->local_db->select("
            (((SUM(IF(b.jml_pagu > 0, b.jml_pagu,0)) + SUM(IF(d.jml_pagu > 0, d.jml_pagu,0)))/SUM(a.bl)) * 100) AS pro_pagu,
            (((SUM(IF(b.jml_pagu > 0, b.jml_pagu,0)) + SUM(IF(d.jml_pagu > 0, d.jml_pagu,0)))/SUM(a.bl)) * 100) AS pro1_pagu 
        ");
        $this->local_db->from("rekap_apbd a");
        $this->local_db->join("rekap_penyedia b", "a.id_satker = b.id_satker");
        $this->local_db->join("rekap_swakelola c", "a.id_satker = c.id_satker");
        $this->local_db->join("rekap_penyedia_belum d", "a.id_satker = d.id_satker");
        $this->local_db->join("rekap_swakelola_belum e", "a.id_satker = e.id_satker");
        if ($tahun != 'all') {
            $this->local_db->where("a.tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_penyedia_tayang($tahun){
        $this->local_db->select("
            nama_satker, 
            COUNT(id) AS jml_paket, 
            SUM(total_pagu) AS jml_pagu 
        ");
        $this->local_db->from("tbl_pkt_penyedia");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->group_by("nama_satker");
        $data = $this->local_db->get();
        return $data;
    }

    public function total_paket_penyedia_tayang($tahun){
        $this->local_db->select("
            COUNT(id) AS jml_paket, 
            SUM(total_pagu) AS jml_pagu 
        ");
        $this->local_db->from("tbl_pkt_penyedia");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_penyedia_belum_tayang($tahun){
        $this->local_db->select("
            id_satker, 
            nama_satker, 
            COUNT(id) AS jml_paket, 
            SUM(total_pagu) AS jml_pagu 
        ");
        $this->local_db->from("tbl_pkt_penyedia_belum");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->group_by("id_satker");
        $this->local_db->group_by("nama_satker");
        $data = $this->local_db->get();
        return $data;
    }

    public function total_paket_penyedia_belum_tayang($tahun){
        $this->local_db->select("
            COUNT(id) AS jml_paket, 
            SUM(total_pagu) AS jml_pagu 
        ");
        $this->local_db->from("tbl_pkt_penyedia_belum");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_swakelola_tayang($tahun){
        $this->local_db->select("
            nama_satker, 
            COUNT(id) AS jml_paket, 
            SUM(total_pagu) AS jml_pagu 
        ");
        $this->local_db->from("tbl_pkt_swakelola");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->group_by("nama_satker");
        $data = $this->local_db->get();
        return $data;
    }

    public function total_paket_swakelola_tayang($tahun){
        $this->local_db->select("
            COUNT(id) AS jml_paket, 
            SUM(total_pagu) AS jml_pagu 
        ");
        $this->local_db->from("tbl_pkt_swakelola");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_swakelola_belum_tayang($tahun){
        $this->local_db->select("
            nama_satker, 
            COUNT(id) AS jml_paket, 
            SUM(total_pagu) AS jml_pagu 
        ");
        $this->local_db->from("tbl_pkt_swakelola_belum");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->group_by("nama_satker");
        $data = $this->local_db->get();
        return $data;
    }

    public function total_paket_swakelola_belum_tayang($tahun){
        $this->local_db->select("
            COUNT(id) AS jml_paket, 
            SUM(total_pagu) AS jml_pagu 
        ");
        $this->local_db->from("tbl_pkt_swakelola_belum");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_penyedia_statistik_rekap($tahun){
        $pagu_apbd = $this->get_total_pagu_apbd($tahun);
        $opd = $this->get_total_opd($tahun);
        $this->local_db->select("
            COUNT(id) AS jml_paket,
            (SUM(total_pagu)/1000000000) AS jml_pagu,
            COUNT(DISTINCT(id_satker)) AS jml_opd,
            (".$opd['total_opd']." - COUNT(DISTINCT(id_satker))) AS jml_opd_min, 
            ((SUM(total_pagu) / ".$pagu_apbd['pagu_bl'].") * 100) AS pro_pagu
        ");
        $this->local_db->from("tbl_pkt_penyedia");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_penyedia_rekapitulasi_progres($tahun){
        $pagu_apbd = $this->get_total_pagu_apbd($tahun);
        $opd = $this->get_total_opd($tahun);
        $this->local_db->select("
            COUNT(id) AS jml_paket,
            (SUM(total_pagu)/1000000000) AS jml_pagu, 
            COUNT(DISTINCT(id_satker)) AS jml_opd,
            (".$opd['total_opd']." - COUNT(DISTINCT(id_satker))) AS jml_opd_min, 
            ((SUM(total_pagu) / ".$pagu_apbd['pagu_bl'].") * 100) AS pro_pagu,
            ((".$opd['total_opd']." - COUNT(DISTINCT(id_satker))) / ".$opd['total_opd']." * 100) AS pro_opd_min, 
            (COUNT(DISTINCT(id_satker)) / ".$opd['total_opd']." * 100) AS pro_opd
        ");
        $this->local_db->from("tbl_pkt_penyedia_belum");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_penyedia_rekapitulasi_rup_opd($tahun){
        $this->local_db->select("
            nama_satker AS nama_satker,
            id_satker AS id_satker,
            COUNT(CASE WHEN motode_str = 'Pengadaan Langsung' THEN motode_str END) AS pengadaan_langsung,
            COUNT(CASE WHEN motode_str = 'Tender Cepat' THEN motode_str END) AS tender_cepat,
            COUNT(CASE WHEN motode_str = 'Tender' THEN motode_str END) AS tender,
            COUNT(CASE WHEN motode_str = 'Seleksi' THEN motode_str END) AS seleksi,
            COUNT(CASE WHEN motode_str = 'Penunjukan Langsung' THEN motode_str END) AS penunjukan_langsung,
            COUNT(CASE WHEN motode_str = 'e-Purchasing' THEN motode_str END) AS e_purchasing,
            SUM(CASE WHEN motode_str =  'Pengadaan Langsung' THEN total_pagu/1000000000 END) AS pg_pl, 
            SUM(CASE WHEN motode_str =  'Tender Cepat' THEN total_pagu/1000000000 END) AS pg_tc, 
            SUM(CASE WHEN motode_str =  'Tender' THEN total_pagu/1000000000 END) AS pg_t, 
            SUM(CASE WHEN motode_str =  'Seleksi' THEN total_pagu/1000000000 END) AS pg_sl, 
            SUM(CASE WHEN motode_str =  'Penunjukan Langsung' THEN total_pagu/1000000000 END) AS pg_plg, 
            SUM(CASE WHEN motode_str =  'e-Purchasing' THEN total_pagu/1000000000 END) AS pg_ep, 
            COUNT(id) AS jumlah_paket,
            SUM(total_pagu/1000000000) AS total_pagu
        ");
        $this->local_db->from("tbl_pkt_penyedia");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->group_by("nama_satker");
        $this->local_db->group_by("id_satker");
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_penyedia_total_rekapitulasi_rup_opd($tahun){
        $this->local_db->select("
            COUNT(CASE WHEN motode_str = 'Pengadaan Langsung' THEN motode_str END) AS pengadaan_langsung,
            COUNT(CASE WHEN motode_str = 'Tender Cepat' THEN motode_str END) AS tender_cepat,
            COUNT(CASE WHEN motode_str = 'Tender' THEN motode_str END) AS tender,
            COUNT(CASE WHEN motode_str = 'Seleksi' THEN motode_str END) AS seleksi,
            COUNT(CASE WHEN motode_str = 'Penunjukan Langsung' THEN motode_str END) AS penunjukan_langsung,
            COUNT(CASE WHEN motode_str = 'e-Purchasing' THEN motode_str END) AS e_purchasing,
            SUM(CASE WHEN motode_str =  'Pengadaan Langsung' THEN total_pagu/1000000000 END) AS pg_pl, 
            SUM(CASE WHEN motode_str =  'Tender Cepat' THEN total_pagu/1000000000 END) AS pg_tc, 
            SUM(CASE WHEN motode_str =  'Tender' THEN total_pagu/1000000000 END) AS pg_t, 
            SUM(CASE WHEN motode_str =  'Seleksi' THEN total_pagu/1000000000 END) AS pg_sl, 
            SUM(CASE WHEN motode_str =  'Penunjukan Langsung' THEN total_pagu/1000000000 END) AS pg_plg, 
            SUM(CASE WHEN motode_str =  'e-Purchasing' THEN total_pagu/1000000000 END) AS pg_ep, 
            COUNT(id) AS jumlah_paket,
            SUM(total_pagu/1000000000) AS total_pagu
        ");
        $this->local_db->from("tbl_pkt_penyedia");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_penyedia_data_rup($tahun){
        $this->local_db->select("*");
        $this->local_db->from("tbl_pkt_penyedia");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->order_by("id", "ASC");
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_swakelola_statistik_rekap($tahun){
        $pagu_apbd = $this->get_total_pagu_apbd($tahun);
        $opd = $this->get_total_opd($tahun);
        $this->local_db->select("
            COUNT(id) AS jml_paket,
            (SUM(total_pagu)/1000000000) AS jml_pagu,
            COUNT(DISTINCT(id_satker)) AS jml_opd,
            (".$opd['total_opd']." - COUNT(DISTINCT(id_satker))) AS jml_opd_min, 
            ((SUM(total_pagu) / ".$pagu_apbd['pagu_bl'].") * 100) AS pro_pagu
        ");
        $this->local_db->from("tbl_pkt_swakelola");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_swakelola_rekapitulasi_progres($tahun){
        $pagu_apbd = $this->get_total_pagu_apbd($tahun);
        $opd = $this->get_total_opd($tahun);
        $this->local_db->select("
            COUNT(id) AS jml_paket,
            (SUM(total_pagu)/1000000000) AS jml_pagu, 
            COUNT(DISTINCT(id_satker)) AS jml_opd,
            (".$opd['total_opd']." - COUNT(DISTINCT(id_satker))) AS jml_opd_min, 
            ((SUM(total_pagu) / ".$pagu_apbd['pagu_bl'].") * 100) AS pro_pagu,
            ((".$opd['total_opd']." - COUNT(DISTINCT(id_satker))) / ".$opd['total_opd']." * 100) AS pro_opd_min, 
            (COUNT(DISTINCT(id_satker)) / ".$opd['total_opd']." * 100) AS pro_opd
        ");
        $this->local_db->from("tbl_pkt_swakelola_belum");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_swakelola_rekapitulasi_rup_opd($tahun){
        $this->local_db->select("
            nama_satker AS nama_satker,
            id_satker AS id_satker,
            COUNT(id) AS jumlah_paket,
            SUM(total_pagu) AS total_pagu
        ");
        $this->local_db->from("tbl_pkt_swakelola");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->group_by("nama_satker");
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_swakelola_total_rekapitulasi_rup_opd($tahun){
        $this->local_db->select("
            COUNT(id) AS jumlah_paket,
            SUM(total_pagu) AS total_pagu
        ");
        $this->local_db->from("tbl_pkt_swakelola");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $data = $this->local_db->get();
        return $data;
    }

    public function paket_swakelola_data_rup($tahun){
        $this->local_db->select("*");
        $this->local_db->from("tbl_pkt_swakelola");
        if ($tahun != 'all') {
            $this->local_db->where("tahun", $tahun+0);
        }
        $this->local_db->order_by("id", "ASC");
        $data = $this->local_db->get();
        return $data;
    }
}