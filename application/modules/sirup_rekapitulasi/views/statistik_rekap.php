<div class="col-sm-6 col-lg-4">
    <a class="card bg-orange bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right" style="width: 75%">
                <p class="h6 text-muted m-t-0 m-b-xs">Tender</p>
                <p class="h3 m-t-sm m-b-0 sirup-rekapitulasi-rekap-box1" style="text-align: left; font-size: 20px"></p>
            </div>
            <div class="pull-left" style="width: 25%">
                <span class="img-avatar img-avatar-48 bg-orange-light-o"><i class="fa fa-shopping-cart fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4">
    <a class="card bg-green bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right" style="width: 75%">
                <p class="h6 text-muted m-t-0 m-b-xs">Tender Cepat</p>
                <p class="h3 m-t-sm m-b-0 sirup-rekapitulasi-rekap-box2" style="text-align: left; font-size: 20px"></p>
            </div>
            <div class="pull-left" style="width: 25%">
                <span class="img-avatar img-avatar-48 bg-green-light-o"><i class="fa fa-shopping-cart fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4">
    <a class="card bg-blue bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right" style="width: 75%">
                <p class="h6 text-muted m-t-0 m-b-xs">Seleksi</p>
                <p class="h3 m-t-sm m-b-0 sirup-rekapitulasi-rekap-box3" style="text-align: left; font-size: 20px"></p>
            </div>
            <div class="pull-left" style="width: 25%">
                <span class="img-avatar img-avatar-48 bg-blue-light-o"><i class="fa fa-shopping-cart fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4">
    <a class="card bg-purple bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right" style="width: 75%">
                <p class="h6 text-muted m-t-0 m-b-xs">E-Purchasing</p>
                <p class="h3 m-t-sm m-b-0 sirup-rekapitulasi-rekap-box4" style="text-align: left; font-size: 20px"></p>
            </div>
            <div class="pull-left" style="width: 25%">
                <span class="img-avatar img-avatar-48 bg-purple-light-o"><i class="fa fa-shopping-cart fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4">
    <a class="card bg-teal bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right" style="width: 75%">
                <p class="h6 text-muted m-t-0 m-b-xs">Penunjukan Langsung</p>
                <p class="h3 m-t-sm m-b-0 sirup-rekapitulasi-rekap-box5" style="text-align: left; font-size: 20px"></p>
            </div>
            <div class="pull-left" style="width: 25%">
                <span class="img-avatar img-avatar-48 bg-teal-light-o"><i class="fa fa-shopping-cart fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>
<div class="col-sm-6 col-lg-4">
    <a class="card bg-red bg-inverse" href="javascript:void(0)">
        <div class="card-block clearfix">
            <div class="pull-right" style="width: 75%">
                <p class="h6 text-muted m-t-0 m-b-xs">Pengadaan Langsung</p>
                <p class="h3 m-t-sm m-b-0 sirup-rekapitulasi-rekap-box6" style="text-align: left; font-size: 20px"></p>
            </div>
            <div class="pull-left" style="width: 25%">
                <span class="img-avatar img-avatar-48 bg-red-light-o"><i class="fa fa-shopping-cart fa-1-5x"></i></span>
            </div>
        </div>
    </a>
</div>

<script type="text/javascript">
    
    //**********************************************
    //*                                             
    //*     STATISTIK REKAPITULASI SIRUP
    //*                                             
    //**********************************************
    create_sirup_rekapitulasi_statistik_rekap(
                                                    jQuery(".sirup-rekapitulasi-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_rekapitulasi_statistik_rekap(tahun){
        create_sirup_rekapitulasi_statistik_rekap(tahun);
    }

    function data_sirup_rekapitulasi_statistik_rekap(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/rekapitulasi/data/rekap-rup-penyedia/'+tahun,
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

    function create_sirup_rekapitulasi_statistik_rekap(tahun){
        var get_data = data_sirup_rekapitulasi_statistik_rekap(tahun);
        jQuery(".sirup-rekapitulasi-rekap-box1").html(
                                                        get_data.baris_data[0].paket_pengadaan_langsung+" Paket<br>"+
                                                        "Rp. "+get_data.baris_data[0].pagu_pengadaan_langsung
                                                    );
        jQuery(".sirup-rekapitulasi-rekap-box2").html(
                                                        get_data.baris_data[0].paket_tender_cepat+" Paket<br>"+
                                                        "Rp. "+get_data.baris_data[0].pagu_tender_cepat
                                                    );
        jQuery(".sirup-rekapitulasi-rekap-box3").html(
                                                        get_data.baris_data[0].paket_tender+" Paket<br>"+
                                                        "Rp. "+get_data.baris_data[0].pagu_tender
                                                    );
        jQuery(".sirup-rekapitulasi-rekap-box4").html(
                                                        get_data.baris_data[0].paket_seleksi+" Paket<br>"+
                                                        "Rp. "+get_data.baris_data[0].pagu_seleksi
                                                    );
        jQuery(".sirup-rekapitulasi-rekap-box5").html(
                                                        get_data.baris_data[0].paket_penunjukan_langsung+" Paket<br>"+
                                                        "Rp. "+get_data.baris_data[0].pagu_penunjukan_langsung
                                                    );
        jQuery(".sirup-rekapitulasi-rekap-box6").html(
                                                        get_data.baris_data[0].paket_epurchasing+" Paket<br>"+
                                                        "Rp. "+get_data.baris_data[0].pagu_epurchasing
                                                    );
    }
</script>