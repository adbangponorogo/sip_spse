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
                        <select class="tender-kontrakopd-pencarian-data-tahun js-select2 form-control"style="width: 100%;">
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
                    <label class="col-md-2 control-label" for="example-select2">Nama Satker</label>
                    <div class="col-md-10">
                        <select class="tender-kontrakopd-pencarian-data-nama-satker js-select2 form-control"style="width: 100%;"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-select2">Pencarian Data</label>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block tender-kontrakopd-pencarian-data-btn">
                            <i class="fa fa-search"></i>&nbsp;Cari Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    create_tendering_kontrakopd_data_agency();
    jQuery(".tender-kontrakopd-pencarian-data-tahun").select2();

    function data_tendering_kontrakopd_data_agency(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/kontrak-opd/data/data-agency',
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            data = JSON;
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
        return data;
    }

    function create_tendering_kontrakopd_data_agency(){
        var get_data = data_tendering_kontrakopd_data_agency();
        var option = "<option value='all'>:: Semua Agency ::</option>";
        for (var i = 0; i < get_data.length; i++) {
            option += "<option value='"+get_data[i].id+"'>"+get_data[i].nama_agency+"</option>";
        }
        jQuery(".tender-kontrakopd-pencarian-data-nama-satker").html(option);
        jQuery(".tender-kontrakopd-pencarian-data-nama-satker").val('all').change();
        jQuery(".tender-kontrakopd-pencarian-data-nama-satker").select2();
    }

    jQuery(document).on("click", ".tender-kontrakopd-pencarian-data-btn", function(){
        var tahun = jQuery(".tender-kontrakopd-pencarian-data-tahun").val();
        var satker = jQuery(".tender-kontrakopd-pencarian-data-nama-satker").val();

        refresh_tendering_kontrakopd_statistik_rekap(tahun, satker);
        refresh_tendering_kontrakopd_kontrak_opd_pertahun(tahun, satker);
        refresh_tendering_kontrakopd_paket_kontrak_pertahun(tahun, satker);
        return false;
    });
</script>