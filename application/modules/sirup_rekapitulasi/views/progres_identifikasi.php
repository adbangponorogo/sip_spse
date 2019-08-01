<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>PROGRES IDENTIFIKASI PAKET OLEH OPD&nbsp;<b class="sirup-rekapitulasi-progres-identifikasi-label"></b>&nbsp;COMPLETE</h4>
        </div>
        <div class="card-block">
            <div class="progress">
                <div class="progress-bar progress-bar-red sirup-rekapitulasi-progres-identifikasi-progres"></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //*****************************************************
    //*                                             
    //* Data SiRUP
    //*                                             
    //*****************************************************
    create_sirup_rekapitulasi_progres_identifikasi(
                                                    jQuery(".sirup-rekapitulasi-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_rekapitulasi_progres_identifikasi(tahun){
        create_sirup_rekapitulasi_progres_identifikasi(tahun);
    }

    function data_sirup_rekapitulasi_progres_identifikasi(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/rekapitulasi/data/progres-identifikasi-paket/'+tahun,
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

    function create_sirup_rekapitulasi_progres_identifikasi(tahun){
        var get_data = data_sirup_rekapitulasi_progres_identifikasi(tahun);
        jQuery(".sirup-rekapitulasi-progres-identifikasi-label").html(get_data.baris_data[0].prosentase_progres+"%");
        jQuery(".sirup-rekapitulasi-progres-identifikasi-progres").html(get_data.baris_data[0].prosentase_progres1+"%");
        jQuery(".sirup-rekapitulasi-progres-identifikasi-progres").attr("role", "progressbar");
        jQuery(".sirup-rekapitulasi-progres-identifikasi-progres").attr("aria-valuenow", get_data.baris_data[0].prosentase_progres);
        jQuery(".sirup-rekapitulasi-progres-identifikasi-progres").attr("aria-valuemin", get_data.baris_data[0].prosentase_progres);
        jQuery(".sirup-rekapitulasi-progres-identifikasi-progres").attr("aria-valuemax", 100);
        jQuery(".sirup-rekapitulasi-progres-identifikasi-progres").css("width", get_data.baris_data[0].prosentase_progres+"%");
    }
</script>