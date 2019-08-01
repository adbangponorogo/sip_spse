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
                        <select class="sirup-paket-pencarian-data-tahun js-select2 form-control"style="width: 100%;">
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
                        <button class="btn btn-primary btn-block sirup-paket-pencarian-data-btn">
                            <i class="fa fa-search"></i>&nbsp;Cari Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(".sirup-paket-pencarian-data-tahun").select2();

    jQuery(document).on("click", ".sirup-paket-pencarian-data-btn", function(){
        var tahun = jQuery(".sirup-paket-pencarian-data-tahun").val();
        refresh_sirup_paket_statistik_rekap(tahun);
        refresh_sirup_paket_rekapitulasi_rekap(tahun);
        refresh_sirup_paket_tender_seleksi(tahun);
        refresh_sirup_paket_rincian_paket(tahun);
        return false;
    });
</script>