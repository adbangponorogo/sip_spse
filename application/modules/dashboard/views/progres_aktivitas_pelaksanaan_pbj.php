<div class="col-md-12">
    <div class="card dasboard-progres-aktivitas-pelaksanaan-pbj">
        <div class="card-header">
            <h4><i class="fa fa-bar-chart"></i>&nbsp;GRAFIK PROGRES AKTIVITAS PELAKSANAAN PBJ TAHUN 2012-2019</h4>
            <ul class="card-actions">
                <li>
                    <button type="button" data-toggle="card-action" data-action="content_toggle"></button>
                </li>
            </ul>
        </div>
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active">
                <a href="#dashboard_tabs3_section1" class="open_dashboard_tabs3_trend_tender_seleksi_ulang">TREND TENDER/SELEKSI ULANG</a>
            </li>
            <li>
                <a href="#dashboard_tabs3_section2" class="open_dashboard_tabs3_trend_tender_seleksi_gagal">TREND TENDER/SELEKSI GAGAL</a>
            </li>
            <li>
                <a href="#dashboard_tabs3_section3" class="open_dashboard_tabs3_trend_sanggah_tender_seleksi">TREND SANGGAH TENDER/SELEKSI</a>
            </li>
        </ul>
        <div class="card-block tab-content">
            <div class="tab-pane in active" id="dashboard_tabs3_section1">
                <div id="dashboard-progres-pelaksanaan-pbj-ulang" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Progress - TREND TENDER/SELEKSI ULANG</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs3_section2">
                <div id="dashboard-progres-pelaksanaan-pbj-gagal" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Progress - TREND TENDER/SELEKSI GAGAL</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs3_section3">
                <div id="dashboard-progres-pelaksanaan-pbj-sanggah" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Progress - TREND SANGGAH TENDER/SELEKSI</b></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    //*****************************************************
    //*                                             
    //* GRAFIK PROGRES AKTIVITAS PELAKSANAAN PBJ TAHUN 2019 
    //*                                             
    //*****************************************************

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

    function refresh_dashboard_progres_pelaksanaan_pbj(tahun){
        var get_id = jQuery(".dasboard-progres-aktivitas-pelaksanaan-pbj").children(".tab-content").find(".active").attr('id');

        if (get_id == 'dashboard_tabs3_section1') {
            create_dashboard_progres_pelaksanaan_pbj_tabs1(tahun);
        }
        if (get_id == 'dashboard_tabs3_section2') {
            create_dashboard_progres_pelaksanaan_pbj_tabs2(tahun);
        }
        if (get_id == 'dashboard_tabs3_section3') {
            create_dashboard_progres_pelaksanaan_pbj_tabs3(tahun);
        }
    }

    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs Trend/Seleksi Ulang -------
    // *
    // *///////////////////////////////////////////

    create_dashboard_progres_pelaksanaan_pbj_tabs1(jQuery(".dashboard-pencarian-data").val());
    jQuery(document).on("click", ".open_dashboard_tabs3_trend_tender_seleksi_ulang", function(){
        create_dashboard_progres_pelaksanaan_pbj_tabs1(jQuery(".dashboard-pencarian-data").val());
    });

    function data_dashboard_progres_pelaksanaan_pbj_tabs1(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/pelaksanaan_pbj/lelang-ulang/'+tahun,
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

    function create_dashboard_progres_pelaksanaan_pbj_tabs1(tahun){
        var get_data = data_dashboard_progres_pelaksanaan_pbj_tabs1(tahun);
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i]   = {y: parseInt(get_data[i].total_paket), label: get_data[i].tahun};
        }
        
        var chart = new CanvasJS.Chart("dashboard-progres-pelaksanaan-pbj-ulang", {
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
                                        name: "Total Paket Ulang",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_chart
                                    }
                                  ]
        });
        chart.render();
    }

    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs Trend/Seleksi Gagal -------
    // *
    // *///////////////////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs3_trend_tender_seleksi_gagal", function(){
        create_dashboard_progres_pelaksanaan_pbj_tabs2(jQuery(".dashboard-pencarian-data").val());
    });

    function data_dashboard_progres_pelaksanaan_pbj_tabs2(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/pelaksanaan_pbj/lelang-gagal/'+tahun,
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

    function create_dashboard_progres_pelaksanaan_pbj_tabs2(tahun){
        var get_data = data_dashboard_progres_pelaksanaan_pbj_tabs2(tahun);
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i]   = {y: parseInt(get_data[i].total_paket), label: get_data[i].tahun};
        }
        
        var chart = new CanvasJS.Chart("dashboard-progres-pelaksanaan-pbj-gagal", {
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
                                        name: "Total Paket Gagal",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_chart
                                    }
                                  ]
        });
        chart.render();
    }

    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs Trend/Seleksi Sanggah -------
    // *
    // *///////////////////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs3_trend_sanggah_tender_seleksi", function(){
        create_dashboard_progres_pelaksanaan_pbj_tabs3();
    });

    function data_dashboard_progres_pelaksanaan_pbj_tabs3(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/pelaksanaan_pbj/lelang-sanggah/',
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

    function create_dashboard_progres_pelaksanaan_pbj_tabs3(){
        var get_data = data_dashboard_progres_pelaksanaan_pbj_tabs3();
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i]   = {y: parseInt(get_data[i].total_paket), label: get_data[i].tahun};
        }
        
        var chart = new CanvasJS.Chart("dashboard-progres-pelaksanaan-pbj-sanggah", {
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
                                        name: "Total Paket Sanggah",
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