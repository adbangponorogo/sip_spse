-- REKAP APBD --
CREATE VIEW rekap_apbd AS
select
	a.tahun AS tahun,
	(case when (a.id_satker > 0) then a.id_satker else b.id_satker end) AS id_satker,
	a.kd_skpd AS kd_skpd,
	a.nama_satker AS nama_satker,
	a.pg_btl AS btl,
	a.pg_bl AS bl,
	(a.pg_btl+a.pg_bl) AS jml_pagu
from
table_apbd a
join table_idsatker_sirup b on a.kd_skpd = b.kd_skpd






-- REKAP PENYEDIA --
CREATE VIEW rekap_penyedia AS
SELECT
	tahun AS tahun,
	id_satker AS id_satker,
	nama_satker AS nama_satker,
	COUNT(id) AS jml_pkt,
	SUM(total_pagu) AS jml_pagu 
FROM
	tbl_pkt_penyedia
group by
	id_satker,
	nama_satker
;






-- REKAP PENYEDIA BELUM --
CREATE VIEW rekap_penyedia_belum AS
SELECT
	tahun AS tahun,
	id_satker AS id_satker,
	nama_satker AS nama_satker,
	COUNT(id) AS jml_pkt,
	SUM(total_pagu) AS jml_pagu
FROM
	tbl_pkt_penyedia_belum
GROUP BY
	id_satker,
	nama_satker
;






-- REKAP PENYEDIA TEPRA --
CREATE VIEW rekap_penyedia_tepra AS
SELECT
	tahun AS tahun,
	(
		SUM((
				CASE
					WHEN(total_pagu < 200000000) THEN total_pagu
				ELSE 0
				END
			))
				/
			1000000
	) AS pg_kur_200,
	COUNT((CASE WHEN (total_pagu < 200000000) THEN 1 END)) AS pkt_kur_200,
	(SUM((
			CASE
				WHEN (total_pagu BETWEEN 200000000 AND 2500000000) THEN total_pagu
			ELSE 0
			END
		))
			/
		1000000
	) AS pg_kur_25,
	COUNT((CASE WHEN (total_pagu BETWEEN 200000000 AND 2500000000) THEN 1 END)) AS pkt_kur_25,
	(SUM((CASE WHEN (total_pagu between 2500000000 and 50000000000) then total_pagu else 0 end)) / 1000000) AS pg_kur_50,
	count((case when (total_pagu between 2500000000 and 50000000000) then 1 end)) AS pkt_kur_50,
	(sum((case when (total_pagu between 50000000000 and 100000000000) then total_pagu else 0 end)) / 1000000) AS pg_kur_100,
	count((case when (total_pagu between 50000000000 and 100000000000) then 1 end)) AS pkt_kur_100,
	(sum((case when (total_pagu > 100000000000) then total_pagu else 0 end)) / 1000000) AS pg_bih_100,
	count((case when (total_pagu > 100000000000) then 1 end)) AS pkt_bih_100,
	count(id) AS jumlah_paket,
	(sum(total_pagu) / 1000000) AS total_pagu
from tbl_pkt_penyedia
group by tahun ;







-- REKAP SWAKELOLA --
CREATE VIEW rekap_swakelola AS
select
	tahun AS tahun,
	id_satker AS id_satker,
	nama_satker AS nama_satker,
	count(id) AS jml_pkt,
	sum(total_pagu) AS jml_pagu
from tbl_pkt_swakelola 
group by 
id_satker,nama_satker ;







-- REKAP SWAKELOLA BELUM --
CREATE VIEW rekap_swakelola_belum AS
select
	tahun AS tahun,
	id_satker AS id_satker,
	nama_satker AS nama_satker,
	count(id) AS jml_pkt,
	sum(total_pagu) AS jml_pagu 
from tbl_pkt_swakelola_belum 
group by 
	id_satker,
	nama_satker ;








-- REKAP SWAKELOLA TEPRA --
CREATE VIEW rekap_swakelola_tepra AS
select
	tahun AS tahun,
	(sum(total_pagu) / 1000000) AS pg_swa,
	count(id) AS pkt_swa 
from tbl_pkt_swakelola 
group by tahun ;
