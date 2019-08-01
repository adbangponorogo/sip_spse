<div class="col-md-12">
    <div class="card progres-tender-seleksi">
        <div class="card-header">
            <h4>GRAFIK PROGRES TENDER/SELEKSI</h4>
        </div>
        <div class="card-block">
            <div id="dashboard-progres-tender-seleksi" style="width: 100%; height: 350px;"></div>
            <p style="text-align: center;padding-top: 20px;"><b>Progres Hasil Tender/Seleksi Tahun 2012 - 2019</b></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    //**********************************************
    //*                                             
    //* GRAFIK PROGRES TENDER/SELEKSI
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

    function refresh_dashboard_progres_tender_seleksi(tahun){
        create_dashboard_progres_tender_seleksi(tahun);
    }


    create_dashboard_progres_tender_seleksi(jQuery(".dashboard-pencarian-data").val());
    function data_dashboard_progres_tender_seleksi(tahun){
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

    function create_dashboard_progres_tender_seleksi(tahun){
        var get_data                = data_dashboard_progres_tender_seleksi(tahun);
        var data_chart              = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i]  = {y: parseInt(get_data[i].total_paket), label: get_data[i].tahun};
        }

        var chart = new CanvasJS.Chart("dashboard-progres-tender-seleksi", {
            theme               : "light2",
            animationEnabled    : true,
            exportEnabled       : true,
            axisX               : {interval: 1},
            axisY               : {valueFormatString: "###0"},
            toolTip             : {shared: true},
            legend              : {
                                    cursor: "pointer",
                                    itemclick: toggleDataSeries
                                  },
            data                : [
                                    {
                                        type: "line",
                                        yValueFormatString: "###0 Paket",
                                        name: "Total Paket",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_chart
                                    }
                                  ]
        });
        chart.render();
    }
</script>