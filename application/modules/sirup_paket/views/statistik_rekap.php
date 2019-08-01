<div class="col-sm-6 col-lg-3">
    <a class="card" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right">
                <p class="h6 text-muted m-t-0 m-b-xs">Pencatatan<br>Non Tender</p>
                <p class="h3 text-blue m-t-sm m-b-0 sirup-paket-rekap-box1"></p>
            </div>
            <div class="pull-left m-r">
                <span class="img-avatar img-avatar-48 bg-blue bg-inverse"><i class="ion-ios-bell fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-3">
    <a class="card bg-green bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right">
                <p class="h6 text-muted m-t-0 m-b-xs">Non Tender<br>&nbsp;</p>
                <p class="h3 m-t-sm m-b-0 sirup-paket-rekap-box2"></p>
            </div>
            <div class="pull-left m-r">
                <span class="img-avatar img-avatar-48 bg-gray-light-o"><i class="ion-ios-people fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-3">
    <a class="card bg-blue bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right">
                <p class="h6 text-muted m-t-0 m-b-xs">Tender<br>&nbsp;</p>
                <p class="h3 m-t-sm m-b-0 sirup-paket-rekap-box3"></p>
            </div>
            <div class="pull-left m-r">
                <span class="img-avatar img-avatar-48 bg-gray-light-o"><i class="ion-ios-speedometer fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-3">
    <a class="card bg-purple bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right">
                <p class="h6 text-muted m-t-0 m-b-xs">Seleksi<br>&nbsp;</p>
                <p class="h3 m-t-sm m-b-0 sirup-paket-rekap-box4"></p>
            </div>
            <div class="pull-left m-r">
                <span class="img-avatar img-avatar-48 bg-gray-light-o"><i class="ion-ios-email fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>

<script type="text/javascript">
    
    //**********************************************
    //*                                             
    //*     STATISTIK SIRUP PAKET
    //*                                             
    //**********************************************
    create_sirup_paket_statistik_rekap(
                                                    jQuery(".sirup-paket-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_paket_statistik_rekap(tahun){
        create_sirup_paket_statistik_rekap(tahun);
    }

    function data_sirup_paket_statistik_rekap(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/paket/data/rekap/'+tahun,
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

    function create_sirup_paket_statistik_rekap(tahun){
        var get_data = data_sirup_paket_statistik_rekap(tahun);
        jQuery(".sirup-paket-rekap-box1").html(get_data.baris_data[0].paket_pencatatan_non_tender+" Paket");
        jQuery(".sirup-paket-rekap-box2").html(get_data.baris_data[0].paket_non_tender+" Paket");
        jQuery(".sirup-paket-rekap-box3").html(get_data.baris_data[0].paket_tender+" Paket");
        jQuery(".sirup-paket-rekap-box4").html(get_data.baris_data[0].paket_seleksi+" Paket");
    }
</script>