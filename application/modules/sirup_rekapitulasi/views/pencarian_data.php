<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>PENCARIAN DATA</h4>
        </div>
        <div class="card-block">
            <form action="#" method="GET" class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-select2">Tahun Data</label>
                    <div class="col-md-10">
                        <select class="sirup-rekapitulasi-pencarian-data-tahun js-select2 form-control"style="width: 100%;">
                            <?php
                                $date = date('Y');
                                if ($date > 2019) {
                            ?>
                                    <option value="all">:: Dari Tahun 2019 - <?=$date?> ::</option>
                            <?php
                                    for ($i=2019; $i <= $date ; $i++) {
                                ?>
                                        <option value="<?=$i?>">Tahun <?=$i?></option>
                                <?php
                                    }
                                }
                                else{
                            ?>
                                    <option value="2019">:: Tahun 2019 ::</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-select2">Pencarian Data</label>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block sirup-rekapitulasi-pencarian-data-btn">
                            <i class="fa fa-search"></i>&nbsp;Cari Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(".sirup-rekapitulasi-pencarian-data-tahun").select2();

    jQuery(document).on("click", ".sirup-rekapitulasi-pencarian-data-btn", function(){
        var tahun = jQuery(".sirup-rekapitulasi-pencarian-data-tahun").val();
        refresh_sirup_rekapitulasi_statistik_rekap(tahun);
        refresh_sirup_rekapitulasi_perencanaan_belanja(tahun);
        refresh_sirup_rekapitulasi_analisis_rup(tahun);
        refresh_sirup_rekapitulasi_perencanaan_rup(tahun);
        refresh_sirup_rekapitulasi_progres_identifikasi(tahun);
        refresh_sirup_rekapitulasi_data_rup(tahun);
        return false;
    });
</script>