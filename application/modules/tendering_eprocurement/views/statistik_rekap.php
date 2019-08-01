<div class="col-sm-6 col-lg-3">
    <a class="card" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right">
                <p class="h6 text-muted m-t-0 m-b-xs">Total Paket Lelang</p>
                <p class="h3 text-blue m-t-sm m-b-0 tendering-eprocurement-rekap-box1"></p>
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
                <p class="h6 text-muted m-t-0 m-b-xs">Total Pagu Lelang</p>
                <p class="h3 m-t-sm m-b-0 tendering-eprocurement-rekap-box2"></p>
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
                <p class="h6 text-muted m-t-0 m-b-xs">Total Selisih Lelang</p>
                <p class="h3 m-t-sm m-b-0 tendering-eprocurement-rekap-box3"></p>
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
                <p class="h6 text-muted m-t-0 m-b-xs">Prosentase</p>
                <p class="h3 m-t-sm m-b-0 tendering-eprocurement-rekap-box4"></p>
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

    function refresh_tendering_eprocurement_statistik_rekap(tahun, satker){
        create_tendering_eprocurement_rekap(tahun, satker);
    }
    
    create_tendering_eprocurement_rekap(
        jQuery(".tender-eprocurement-pencarian-data-tahun").val(),
        jQuery(".tender-eprocurement-pencarian-data-nama-satker").val()
    );

    function data_tendering_eprocurement_rekap(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/e-procurement/data/rekap/'+tahun+'/'+satker,
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

    function create_tendering_eprocurement_rekap(tahun, satker){
        var data = data_tendering_eprocurement_rekap(tahun, satker);
        jQuery(".tendering-eprocurement-rekap-box1").html(data.total_paket+"&nbsp;<b style='font-size: 18px;'>Paket</b>");
        jQuery(".tendering-eprocurement-rekap-box2").html("<b style='font-size: 18px;'>Rp.</b>&nbsp;"+data.total_pagu+"&nbsp;<b style='font-size: 18px;'>M.</b>");
        jQuery(".tendering-eprocurement-rekap-box3").html("<b style='font-size: 18px;'>Rp.</b>&nbsp;"+data.selisih+"&nbsp;<b style='font-size: 18px;'>M.</b>");
        jQuery(".tendering-eprocurement-rekap-box4").html(data.total_prosentase+"&nbsp;<b style='font-size: 18px;'>%</b>");
    }

</script>