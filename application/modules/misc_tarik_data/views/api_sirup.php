<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA LOKAL - API SiRUP</h4>
        </div>
        <div class="card-block" style="float: left; width: 100%;">
            <div class="col-md-4">
                <a class="card" href="javascript:void(0)">
                    <div class="card-block clearfix">
                        <center>
                            <h4><i class="ion-bag" style="font-size: 50px;"></i></h4>
                            <h4>Penyedia Tayang</h4>
                            <button class="btn btn-primary btn-block misc-tarikdata-update-penyedia-tayang">
                                <i class="ion-android-download"></i>&nbsp;Tarik Data
                            </button>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="card" href="javascript:void(0)">
                    <div class="card-block clearfix">
                        <center>
                            <h4><i class="ion-clipboard" style="font-size: 50px;"></i></h4>
                            <h4>Penyedia Draft</h4>
                            <button class="btn btn-primary btn-block misc-tarikdata-update-penyedia-draft">
                                <i class="ion-android-download"></i>&nbsp;Tarik Data
                            </button>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="card" href="javascript:void(0)">
                    <div class="card-block clearfix">
                        <center>
                            <h4><i class="ion-bag" style="font-size: 50px;"></i></h4>
                            <h4>Swakelola Tayang</h4>
                            <button class="btn btn-primary btn-block misc-tarikdata-update-swakelola-tayang">
                                <i class="ion-android-download"></i>&nbsp;Tarik Data
                            </button>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="card" href="javascript:void(0)">
                    <div class="card-block clearfix">
                        <center>
                            <h4><i class="ion-clipboard" style="font-size: 50px;"></i></h4>
                            <h4>Swakelola Draft</h4>
                            <button class="btn btn-primary btn-block misc-tarikdata-update-swakelola-draft">
                                <i class="ion-android-download"></i>&nbsp;Tarik Data
                            </button>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="card" href="javascript:void(0)">
                    <div class="card-block clearfix">
                        <center>
                            <h4><i class="ion-ios-cart" style="font-size: 50px;"></i></h4>
                            <h4>E-Purchasing Draft</h4>
                            <button class="btn btn-primary btn-block misc-tarikdata-update-paket-epurchasing">
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
    //* Tarik Data - API SiRUP
    //*                                             
    //*****************************************************

    jQuery(document).on("click", ".misc-tarikdata-update-penyedia-tayang", function(){
        misc_tarik_data_penyedia_tayang(jQuery(".app-tahun-input").val());
        return false;
    });

    function misc_tarik_data_penyedia_tayang(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tarik-data/insert/penyedia-tayang/'+tahun,
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            var tipe_notif  = "info";
            var msg_notif   = "Sukses Import - Penyedia Tayang! Hasil Import : "+JSON.count+" Paket Telah Masuk";
            show_notification(tipe_notif, msg_notif);
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }



    jQuery(document).on("click", ".misc-tarikdata-update-penyedia-draft", function(){
        misc_tarik_data_penyedia_draft(jQuery(".app-tahun-input").val());
        return false;
    });

    function misc_tarik_data_penyedia_draft(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tarik-data/insert/penyedia-draft/'+tahun,
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            var tipe_notif  = "info";
            var msg_notif   = "Sukses Import - Penyedia Draft! Hasil Import : "+JSON.count+" Paket Telah Masuk";
            show_notification(tipe_notif, msg_notif);
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }



    jQuery(document).on("click", ".misc-tarikdata-update-swakelola-tayang", function(){
        misc_tarik_data_swakelola_tayang(jQuery(".app-tahun-input").val());
        return false;
    });

    function misc_tarik_data_swakelola_tayang(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tarik-data/insert/swakelola-tayang/'+tahun,
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            var tipe_notif  = "info";
            var msg_notif   = "Sukses Import - Swakelola Tayang! Hasil Import : "+JSON.count+" Paket Telah Masuk";
            show_notification(tipe_notif, msg_notif);
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }



    jQuery(document).on("click", ".misc-tarikdata-update-swakelola-draft", function(){
        misc_tarik_data_swakelola_draft(jQuery(".app-tahun-input").val());
        return false;
    });

    function misc_tarik_data_swakelola_draft(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tarik-data/insert/swakelola-draft/'+tahun,
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            var tipe_notif  = "info";
            var msg_notif   = "Sukses Import - Swakelola Draft! Hasil Import : "+JSON.count+" Paket Telah Masuk";
            show_notification(tipe_notif, msg_notif);
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }


    jQuery(document).on("click", ".misc-tarikdata-update-paket-epurchasing", function(){
        misc_tarik_data_paket_epurchasing(jQuery(".app-tahun-input").val());
        return false;
    });

    function misc_tarik_data_paket_epurchasing(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tarik-data/insert/data-epurchasing/'+tahun,
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            var tipe_notif  = "info";
            var msg_notif   = "Sukses Import - Paket E-Purchasing! Hasil Import : "+JSON.count+" Paket Telah Masuk";
            show_notification(tipe_notif, msg_notif);
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }
</script>