<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA LOKAL - SMEP</h4>
        </div>
        <div class="card-block" style="float: left; width: 100%;">
            <div class="col-md-12">
                <a class="card" href="javascript:void(0)">
                    <div class="card-block clearfix">
                        <center>
                            <h4><i class="ion-usb" style="font-size: 50px;"></i></h4>
                            <h4>Struktur Anggaran</h4>
                            <button class="btn btn-primary btn-block misc-tarikdata-smep-struktur-anggaran">
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
    //* Tarik Data - SMEP
    //*                                             
    //*****************************************************
    jQuery(document).on("click", ".misc-tarikdata-smep-struktur-anggaran", function(){
        misc_tarik_data_smep_struktur_anggaran(jQuery(".app-tahun-input").val());
        return false;
    });

    function misc_tarik_data_smep_struktur_anggaran(tahun){
      var data = null;
      jQuery.ajax({
        type      : 'AJAX',
        method    : 'GET',
        url       : '../misc/tarik-data/insert/struktur-anggaran/'+tahun,
        async     : false,
        dataType  : 'JSON',
        success   : function(JSON){
          var tipe_notif  = "info";
          var msg_notif   = "Sukses Import - Struktur Anggaran! Hasil Import : "+JSON.count+" Paket Telah Masuk";
          show_notification(tipe_notif, msg_notif);
        },
        error     : function(jqXHR, textStatus, errorThrown){
          console.log("error");
        }
      });
    }
</script>