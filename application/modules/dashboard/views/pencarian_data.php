<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>PENCARIAN DATA</h4>
        </div>
        <div class="card-block">
            <form class="form-horizontal">
            <div class="form-group">
                <label class="col-md-2 control-label" for="example-select2">Tahun Data</label>
                <div class="col-md-10">
                    <select class="dashboard-pencarian-data js-select2 form-control"style="width: 100%;">
                        <?php $date = date('Y');?>
                        <option value="all">Dari Tahun 2012 - <?=$date?></option>
                        <?php
                            for ($i=2012; $i <= $date ; $i++) {
                        ?>
                                <option value="<?=$i?>">Tahun <?=$i?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(".dashboard-pencarian-data").select2();

    jQuery(document).on("change", ".dashboard-pencarian-data", function(){
        refresh_dashboard_statistik_rekap(jQuery(this).val());
        refresh_dashboard_perencanaan_pbj();
        refresh_dashboard_pelaksanaan_pbj(jQuery(this).val());
        refresh_dashboard_paket_eprocurement(jQuery(this).val());
        refresh_dashboard_hasil_eprocurement(jQuery(this).val());
        refresh_dashboard_paket_non_tender(jQuery(this).val());
        refresh_dashboard_progres_tender_seleksi(jQuery(this).val());
        refresh_dashboard_progres_pelaksanaan_pbj(jQuery(this).val());
        refresh_dashboard_aktivitas_rekanan(jQuery(this).val());
        refresh_dashboard_kategori_tender(jQuery(this).val());
    });
</script>