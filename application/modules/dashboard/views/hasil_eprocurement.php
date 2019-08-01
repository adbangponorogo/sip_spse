<div class="col-md-12">
    <div class="card dashboard-hasil-eprocurement">
        <div class="card-header">
            <h4>GRAFIK HASIL TENDER/SELEKSI E-PROCUREMENT</h4>
        </div>
        <div class="card-block">
            <div id="dashboard-hasil-eprocurement" style="width: 100%; height: 350px;"></div>
            <p style="text-align: center;padding-top: 20px;"><b>Jumlah Hasil Tender/Seleksi Tahun 2012 - 2019</b></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    //**********************************************
    //*                                             
    //* GRAFIK HASIL TENDER/SELEKSI E-PROCUREMENT
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

    function refresh_dashboard_hasil_eprocurement(tahun){
        create_dashboard_hasil_eprocurement(tahun);
    }


    create_dashboard_hasil_eprocurement(jQuery(".dashboard-pencarian-data").val());
    function data_dashboard_hasil_eprocurement(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/hasil_eprocurement/'+tahun,
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

    function create_dashboard_hasil_eprocurement(tahun){
        var get_data                = data_dashboard_hasil_eprocurement(tahun);
        var data_hps                = [];
        var data_kontrak            = [];
        var data_selisih            = [];
        for (var i = 0; i < get_data.length; i++) {
            data_hps[i]      = {y: parseInt(get_data[i].pg_paket), label: get_data[i].tahun};
            data_kontrak[i]  = {y: parseInt(get_data[i].penawaran), label: get_data[i].tahun};
            data_selisih[i]  = {y: parseInt(get_data[i].efisiensi), label: get_data[i].tahun};
        }

        var chart = new CanvasJS.Chart("dashboard-hasil-eprocurement", {
            theme               : "light2",
            animationEnabled    : true,
            exportEnabled       : true,
            title               : {text: "LPSE Kabupaten Ponorogo", fontSize: 20},
            axisX               : {interval: 1},
            axisY               : {valueFormatString: "###0 M"},
            toolTip             : {shared: true},
            legend              : {
                                    cursor: "pointer",
                                    itemclick: toggleDataSeries
                                  },
            data                : [
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 M",
                                        name: "Nilai HPS",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_hps
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 M",
                                        name: "Nilai Kontrak",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_kontrak
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 M",
                                        name: "Selesai Tender",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_selisih
                                    }
                                  ]
        });
        chart.render();
    }
</script>