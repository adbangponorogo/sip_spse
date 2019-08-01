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
                        <select class="nontender-kontrakopd-pencarian-data-tahun js-select2 form-control"style="width: 100%;">
                            <?php $date = date('Y');?>
                            <option value="all">:: Dari Tahun 2012 - <?=$date?> ::</option>
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
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-select2">Pencarian Data</label>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block nontender-kontrakopd-pencarian-data-btn">
                            <i class="fa fa-search"></i>&nbsp;Cari Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(".nontender-kontrakopd-pencarian-data-tahun").select2();

    jQuery(document).on("click", ".nontender-kontrakopd-pencarian-data-btn", function(){
        var tahun = jQuery(".nontender-kontrakopd-pencarian-data-tahun").val();
        refresh_nontendering_kontrakopd_statistik_rekap(tahun);
        refresh_nontendering_kontrakopd_kontrak_opd_pertahun(tahun);
        refresh_nontendering_kontrakopd_paket_kontrak_pertahun(tahun);
        return false;
    });
</script>