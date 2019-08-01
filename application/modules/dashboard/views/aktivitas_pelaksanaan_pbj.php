<div class="col-md-12">
    <div class="card dashboard-pelaksanaan-pbj">
        <div class="card-header">
            <h4><i class="fa fa-bar-chart"></i>&nbsp;GRAFIK AKTIVITAS PELAKSANAAN PBJ TAHUN 2012-2019</h4>
            <ul class="card-actions">
                <li>
                    <button type="button" data-toggle="card-action" data-action="content_toggle"></button>
                </li>
            </ul>
        </div>
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active">
                <a href="#dashboard_tabs2_section1" class="open_dashboard_tabs2_metode_tender_seleksi">METODE TENDER SELEKSI</a>
            </li>
            <li>
                <a href="#dashboard_tabs2_section2" class="open_dashboard_tabs2_efisiensi_tender">EFISIENSI TENDER</a>
            </li>
            <li>
                <a href="#dashboard_tabs2_section3" class="open_dashboard_tabs2_efisiensi_non_tender">EFISIENSI NON TENDER</a>
            </li>
            <li>
                <a href="#dashboard_tabs2_section4" class="open_dashboard_tabs2_versi_lelang_spse">VERSI LELANG SPSE</a>
            </li>
        </ul>
        <div class="card-block tab-content">
            <div class="tab-pane in active" id="dashboard_tabs2_section1">
                <div id="dashboard-pelaksanaan-pbj-metode-tender-seleksi" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Pelaksanaan PBJ - METODE TENDER/SELEKSI</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs2_section2">
                <div id="dashboard-pelaksanaan-pbj-efisiensi-tender" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Pelaksanaan PBJ - EFISIENSI TENDER</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs2_section3">
                <div id="dashboard-pelaksanaan-pbj-efisiensi-non-tender" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Pelaksanaan PBJ - EFISIEN NON TENDER</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs2_section4">
                <div id="dashboard-pelaksanaan-pbj-versi-lelang-spse" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Pelaksanaan PBJ - VERSI LELANG SPSE</b></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    //**********************************************
    //*                                             
    //* GRAFIK AKTIVITAS PELAKSANAAN PBJ TAHUN 2012-2019
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

    function refresh_dashboard_pelaksanaan_pbj(tahun){
        var get_id = jQuery(".dashboard-pelaksanaan-pbj").children(".tab-content").find(".active").attr('id');

        if (get_id == 'dashboard_tabs2_section1') {
            create_dashboard_pelaksanaan_pbj_tabs1(tahun);
        }
        if (get_id == 'dashboard_tabs2_section2') {
            create_dashboard_pelaksanaan_pbj_tabs2(tahun);
        }
        if (get_id == 'dashboard_tabs2_section3') {
            create_dashboard_pelaksanaan_pbj_tabs3(tahun);
        }
        if (get_id == 'dashboard_tabs2_section4') {
            create_dashboard_pelaksanaan_pbj_tabs4(tahun);
        }
    }

    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs Metode Tender Seleksi -------
    // *
    // *///////////////////////////////////////////

    create_dashboard_pelaksanaan_pbj_tabs1(jQuery(".dashboard-pencarian-data").val());
    jQuery(document).on("click", ".open_dashboard_tabs2_metode_tender_seleksi", function(){
        create_dashboard_pelaksanaan_pbj_tabs1(jQuery(".dashboard-pencarian-data").val());
    });

    function data_dashboard_pelaksanaan_pbj_tabs1(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/pelaksanaan_pbj/metode-tender-seleksi/'+tahun,
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

    function create_dashboard_pelaksanaan_pbj_tabs1(tahun){
        var get_data = data_dashboard_pelaksanaan_pbj_tabs1(tahun);
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i]   = {y: parseInt(get_data[i].jml_paket), label: get_data[i].metode};
        }
        
        var chart = new CanvasJS.Chart("dashboard-pelaksanaan-pbj-metode-tender-seleksi", {
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
                                        type: "column",
                                        yValueFormatString: "###0",
                                        name: "Jumlah",
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
    // * --------- Tabs Efisiensi Tender ----------
    // *
    // *///////////////////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs2_efisiensi_tender", function(){
        create_dashboard_pelaksanaan_pbj_tabs2(jQuery(".dashboard-pencarian-data").val());
    });

    function data_dashboard_pelaksanaan_pbj_tabs2(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/pelaksanaan_pbj/efisiensi-tender/'+tahun,
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

    function create_dashboard_pelaksanaan_pbj_tabs2(tahun){
        var get_data = data_dashboard_pelaksanaan_pbj_tabs2(tahun);
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i]   = {y: get_data[i].efisiensi, label: get_data[i].tahun};
        }
        
        var chart = new CanvasJS.Chart("dashboard-pelaksanaan-pbj-efisiensi-tender", {
            theme               : "light2",
            animationEnabled    : true,
            exportEnabled       : true,
            axisX               : {interval: 1},
            axisY               : {valueFormatString: "##0.#0 M"},
            toolTip             : {shared: true},
            legend              : {
                                    cursor: "pointer",
                                    itemclick: toggleDataSeries
                                  },
            data                : [
                                    {
                                        type: "column",
                                        yValueFormatString: "##0.#0 M",
                                        name: "Jumlah",
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
    // * ------- Tabs Efisiensi Non Tender -------
    // *
    // *///////////////////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs2_efisiensi_non_tender", function(){
        create_dashboard_pelaksanaan_pbj_tabs3(jQuery(".dashboard-pencarian-data").val());
    });

    function data_dashboard_pelaksanaan_pbj_tabs3(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/pelaksanaan_pbj/efisiensi-non-tender/'+tahun,
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

    function create_dashboard_pelaksanaan_pbj_tabs3(tahun){
        var get_data                = data_dashboard_pelaksanaan_pbj_tabs3(tahun);
        var data_hps_non_tender     = [];
        var data_kontrak_non_tender = [];
        var data_selisih_non_tender = [];
        for (var i = 0; i < get_data.length; i++) {
            data_hps_non_tender[i]      = {y: get_data[i].hps, label: get_data[i].tahun};
            data_kontrak_non_tender[i]  = {y: get_data[i].kontrak, label: get_data[i].tahun};
            data_selisih_non_tender[i]  = {y: get_data[i].efisiensi, label: get_data[i].tahun};
        }
        
        var chart = new CanvasJS.Chart("dashboard-pelaksanaan-pbj-efisiensi-non-tender", {
            theme               : "light2",
            animationEnabled    : true,
            exportEnabled       : true,
            axisX               : {interval: 1},
            axisY               : {valueFormatString: "#0,#00 Jt."},
            toolTip             : {shared: true},
            legend              : {
                                    cursor: "pointer",
                                    itemclick: toggleDataSeries
                                  },
            data                : [
                                    {
                                        type: "column",
                                        yValueFormatString: "#,#00.#0 Jt.",
                                        name: "HPS",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_hps_non_tender
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "#,#00.#0 Jt.",
                                        name: "Kontrak",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_kontrak_non_tender
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "#,#00.#0 Jt.",
                                        name: "Selisih",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_selisih_non_tender
                                    }
                                  ]
        });
        chart.render();
    }

    // *//////////////////////////////
    // * 
    // * -- Tabs Versi Lelang SPSE --
    // *
    // *//////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs2_versi_lelang_spse", function(){
        create_dashboard_pelaksanaan_pbj_tabs4(jQuery(".dashboard-pencarian-data").val());
    });

    function data_dashboard_pelaksanaan_pbj_tabs4(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/pelaksanaan_pbj/versi-lelang-spse/'+tahun,
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

    function create_dashboard_pelaksanaan_pbj_tabs4(tahun){
        var get_data = data_dashboard_pelaksanaan_pbj_tabs4(tahun);
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i] = {
                                label: get_data[i].versi_lelang, 
                                y: get_data[i].jml_spse4,
                                indexLabelFontSize : 14
                            };
        }

        var chart = new CanvasJS.Chart("dashboard-pelaksanaan-pbj-versi-lelang-spse", {
            animationEnabled: true,
            data: [{
                type                : "doughnut",
                startAngle          : 60,
                exportEnabled       : true,
                innerRadius         : 60,
                indexLabelFontSize  : 17,
                indexLabel          : "{label} - {y} Paket",
                toolTipContent      : "<b>{label} :</b> {y} Paket",
                dataPoints          : data_chart
            }]
        });
        chart.render();
    }
</script>