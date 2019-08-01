<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA LOKAL - JSON SiRUP</h4>
        </div>
        <div class="card-block" style="float: left; width: 100%;">
            <div class="col-md-12">
                <a class="card" href="javascript:void(0)">
                    <div class="card-block clearfix">
                        <center>
                            <h4><i class="ion-social-buffer" style="font-size: 50px;"></i></h4>
                            <h4>JSON SiRUP</h4>
                            <select class="misc-tarikdata-json-sirup-tahun js-select2 form-control"style="width: 100%;">
                            <?php
                                $date = date('Y', strtotime("-1 year"));
                                for ($i=2013; $i <= $date ; $date--) {
                            ?>
                                  <option value="<?=$date?>">Tahun <?=$date?></option>
                            <?php
                                }
                            ?>
                            </select><br>
                            <button class="btn btn-primary btn-block misc-tarikdata-update-json-sirup">
                                <i class="ion-android-download"></i>&nbsp;Tarik Data
                            </button>
                        </center>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //*****************************************************
    //*                                             
    //* Tarik Data - JSON SiRUP
    //*                                             
    //*****************************************************
    jQuery(".misc-tarikdata-json-sirup-tahun").select2();


    jQuery(document).on("click", ".misc-tarikdata-update-json-sirup", function(){
        misc_tarik_data_json_sirup(jQuery(".misc-tarikdata-json-sirup-tahun").val());
        return false;
    });

    function misc_tarik_data_json_sirup(tahun){
      var data = null;
      jQuery.ajax({
        type      : 'AJAX',
        method    : 'GET',
        url       : '../misc/tarik-data/insert/json-sirup/'+tahun,
        async     : false,
        dataType  : 'JSON',
        success   : function(JSON){
          var tipe_notif  = "info";
          var msg_notif   = "Sukses Import - JSON SiRUP ("+tahun+")! Hasil Import : "+JSON.count+" Paket Telah Masuk";
          show_notification(tipe_notif, msg_notif);
        },
        error     : function(jqXHR, textStatus, errorThrown){
          console.log("error");
        }
      });
    }
</script>