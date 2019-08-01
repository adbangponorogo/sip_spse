<div class="col-sm-6 col-lg-3">
    <a class="card" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right">
                <p class="h6 text-muted m-t-0 m-b-xs">Total Paket<br>&nbsp;</p>
                <p class="h3 text-blue m-t-sm m-b-0 tender-kontrakopd-rekap-box1"></p>
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
                <p class="h6 text-muted m-t-0 m-b-xs">Total Paket Selesai<br>&nbsp;</p>
                <p class="h3 m-t-sm m-b-0 tender-kontrakopd-rekap-box2"></p>
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
                <p class="h6 text-muted m-t-0 m-b-xs">Total Paket Belum<br>Selesai</p>
                <p class="h3 m-t-sm m-b-0 tender-kontrakopd-rekap-box3"></p>
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
                <p class="h6 text-muted m-t-0 m-b-xs">Total Paket Ber-<br>Kontrak</p>
                <p class="h3 m-t-sm m-b-0 tender-kontrakopd-rekap-box4"></p>
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
    //*     STATISTIK REKAP DATA E-PROCUREMENT 
    //*                                             
    //**********************************************

    function refresh_tendering_kontrakopd_statistik_rekap(tahun, satker){
        create_tendering_kontrakopd_statistik_rekap(tahun, satker);
    }
    
    create_tendering_kontrakopd_statistik_rekap(
                                                    jQuery(".tender-kontrakopd-pencarian-data-tahun").val(),
                                                    jQuery(".tender-kontrakopd-pencarian-data-nama-satker").val()
                                                );

    function data_tendering_kontrakopd_statistik_rekap(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/kontrak-opd/data/rekap/'+tahun+'/'+satker,
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

    function create_tendering_kontrakopd_statistik_rekap(tahun, satker){
        var data = data_tendering_kontrakopd_statistik_rekap(tahun, satker);
        jQuery(".tender-kontrakopd-rekap-box1").html(data.total_paket+"&nbsp;<b style='font-size: 18px;'>Paket</b>");
        jQuery(".tender-kontrakopd-rekap-box2").html(data.total_paket_selesai+"&nbsp;<b style='font-size: 18px;'>Paket</b>");
        jQuery(".tender-kontrakopd-rekap-box3").html(data.total_paket_belum_selesai+"&nbsp;<b style='font-size: 18px;'>Paket</b>");
        jQuery(".tender-kontrakopd-rekap-box4").html(data.total_paket_berkontrak+"&nbsp;<b style='font-size: 18px;'>Paket</b>");
    }

</script>