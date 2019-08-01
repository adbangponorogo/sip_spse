<div class="col-md-12">
    <div class="card dashboard-paket-eprocurement">
        <div class="card-header">
            <h4>GRAFIK PAKET TENDER/SELEKSI E-PROCUREMENT</h4>
        </div>
        <div class="card-block">
            <div id="dashboard-paket-eprocurement" style="width: 100%; height: 350px;"></div>
            <p style="text-align: center;padding-top: 20px;"><b>Jumlah Paket Tender/Seleksi Tahun 2012 - 2019</b></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    //**********************************************
    //*                                             
    //* GRAFIK PAKET TENDER/SELEKSI E-PROCUREMENT
    //*                                             
    //**********************************************

    function dynamic_colors() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    }

    function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        }
        else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }

    function refresh_dashboard_paket_eprocurement(tahun){
        create_dashboard_paket_eprocurement(tahun);
    }


    create_dashboard_paket_eprocurement(jQuery(".dashboard-pencarian-data").val());
    function data_dashboard_paket_eprocurement(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/paket_eprocurement/'+tahun,
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

    function create_dashboard_paket_eprocurement(tahun){
        var get_data             = data_dashboard_paket_eprocurement(tahun);
        var data_total_paket     = [];
        var data_paket_selesai   = [];
        for (var i = 0; i < get_data.length; i++) {
            data_total_paket[i]     = {y: parseInt(get_data[i].total_paket), label: get_data[i].tahun};
            data_paket_selesai[i]   = {y: parseInt(get_data[i].paket_selesai), label: get_data[i].tahun};
        }
        
        var chart = new CanvasJS.Chart("dashboard-paket-eprocurement", {
            theme               : "light2",
            animationEnabled    : true,
            exportEnabled       : true,
            title               : {text: "LPSE Kabupaten Ponorogo", fontSize: 20},
            axisX               : {interval: 1},
            axisY               : {valueFormatString: "###0"},
            toolTip             : {shared: true},
            legend              : {
                                    cursor: "pointer",
                                    itemclick: toggleDataSeries
                                  },
            data                : [
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Paket",
                                        name: "Total Paket",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_total_paket
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Paket",
                                        name: "Paket Selesai",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_paket_selesai
                                    }
                                  ]
        });
        chart.render();
    }
</script>