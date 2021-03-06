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
                        <select class="epurchasing-data-pencarian-data-tahun js-select2 form-control"style="width: 100%;">
                            <?php
                                $date = date('Y');
                                if ($date > 2015) {
                            ?>
                                    <option value="all">:: Dari Tahun 2015 - <?=$date?> ::</option>
                            <?php
                                    for ($i=2015; $i <= $date ; $date--) {
                                ?>
                                        <option value="<?=$date?>">Tahun <?=$date?></option>
                                <?php
                                    }
                                }
                                else{
                            ?>
                                    <option value="2015">:: Tahun 2015 ::</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-select2">Pencarian Data</label>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block epurchasing-data-pencarian-data-btn">
                            <i class="fa fa-search"></i>&nbsp;Cari Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(".epurchasing-data-pencarian-data-tahun").select2();

    jQuery(document).on("click", ".epurchasing-data-pencarian-data-btn", function(){
        var tahun = jQuery(".epurchasing-data-pencarian-data-tahun").val();
        refresh_epurchasing_data_paket_opd(tahun);
        return false;
    });
</script>