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
                        <select class="sirup-data-pencarian-data-tahun js-select2 form-control"style="width: 100%;">
                            <?php
                                $date = date('Y', strtotime("-1 year"));
                                if ($date > 2013) {
                            ?>
                                    <option value="all">:: Dari Tahun 2013 - <?=$date?> ::</option>
                            <?php
                                    for ($i=2013; $i <= $date ; $i++) {
                                ?>
                                        <option value="<?=$i?>">Tahun <?=$i?></option>
                                <?php
                                    }
                                }
                                else{
                            ?>
                                    <option value="2013">:: Tahun 2013 ::</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-select2">Pencarian Data</label>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block sirup-data-pencarian-data-btn">
                            <i class="fa fa-search"></i>&nbsp;Cari Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(".sirup-data-pencarian-data-tahun").select2();

    jQuery(document).on("click", ".sirup-data-pencarian-data-btn", function(){
        var tahun = jQuery(".sirup-data-pencarian-data-tahun").val();
        refresh_sirup_paket_tender_seleksi(tahun);
        return false;
    });
</script>