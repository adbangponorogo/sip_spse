<div class="col-md-12">
    <div class="card dashboard-perencanaan-pbj">
        <div class="card-header">
            <h4><i class="fa fa-bar-chart"></i>&nbsp;GRAFIK AKTIVITAS PERENCANAAN PBJ TAHUN 2019</h4>
            <ul class="card-actions">
                <li>
                    <button type="button" data-toggle="card-action" data-action="content_toggle"></button>
                </li>
            </ul>
        </div>
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active">
                <a href="#dashboard_tabs1_section1" class="open_dashboard_tabs1_tender">TENDER</a>
            </li>
            <li>
                <a href="#dashboard_tabs1_section2" class="open_dashboard_tabs1_seleksi">SELEKSI</a>
            </li>
            <li>
                <a href="#dashboard_tabs1_section3" class="open_dashboard_tabs1_penyedia">PENYEDIA</a>
            </li>
            <li>
                <a href="#dashboard_tabs1_section4" class="open_dashboard_tabs1_swakelola">SWAKELOLA</a>
            </li>
        </ul>
        <div class="card-block tab-content">
            <div class="tab-pane in active" id="dashboard_tabs1_section1">
                <div id="dashboard-perencanaan-pbj-tender" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Perencanaan PBJ - TENDER</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs1_section2">
                <div id="dashboard-perencanaan-pbj-seleksi" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Perencanaan PBJ - SELEKSI</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs1_section3">
                <div id="dashboard-perencanaan-pbj-penyedia" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Perencanaan PBJ - PENYEDIA</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs1_section4">
                <div id="dashboard-perencanaan-pbj-swakelola" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Grafik Perencanaan PBJ - SWAKELOLA</b></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    //**********************************************
    //*                                             
    //* GRAFIK AKTIVITAS PERENCANAAN PBJ TAHUN 2019 
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

    function refresh_dashboard_perencanaan_pbj(){
        var get_id = jQuery(".dashboard-perencanaan-pbj").children(".tab-content").find(".active").attr('id');

        if (get_id == 'dashboard_tabs1_section1') {
            create_dashboard_perencanaan_pbj_tabs1();
        }
        if (get_id == 'dashboard_tabs1_section1') {
            create_dashboard_perencanaan_pbj_tabs2();
        }
        if (get_id == 'dashboard_tabs1_section1') {
            create_dashboard_perencanaan_pbj_tabs3();
        }
        if (get_id == 'dashboard_tabs1_section1') {
            create_dashboard_perencanaan_pbj_tabs4();
        }
    }

    // *//////////////////////////////
    // * 
    // * ------- Tabs Tender -------
    // *
    // *//////////////////////////////

    create_dashboard_perencanaan_pbj_tabs1();

    jQuery(document).on("click", ".open_dashboard_tabs1_tender", function(){
        create_dashboard_perencanaan_pbj_tabs1();
    });

    function data_dashboard_perencanaan_pbj_tabs1(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/perencanaan_pbj/tender',
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

    function create_dashboard_perencanaan_pbj_tabs1(){
        var get_data = data_dashboard_perencanaan_pbj_tabs1();
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i] = {
                                label: get_data[i].nama_satker, 
                                y: get_data[i].jumlah_tender,
                                indexLabelFontSize : 14
                            };
        }

        var chart = new CanvasJS.Chart("dashboard-perencanaan-pbj-tender", {
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

    // *//////////////////////////////
    // * 
    // * ------- Tabs Seleksi -------
    // *
    // *//////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs1_seleksi", function(){
        create_dashboard_perencanaan_pbj_tabs2();
    });

    function data_dashboard_perencanaan_pbj_tabs2(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/perencanaan_pbj/seleksi',
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

    function create_dashboard_perencanaan_pbj_tabs2(){
        var get_data = data_dashboard_perencanaan_pbj_tabs2();
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i] = {
                                label: get_data[i].nama_satker, 
                                y: get_data[i].jumlah_tender,
                                indexLabelFontSize : 14
                            };
        }

        var chart = new CanvasJS.Chart("dashboard-perencanaan-pbj-seleksi", {
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


    // *//////////////////////////////
    // * 
    // * ------- Tabs Penyedia -------
    // *
    // *//////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs1_penyedia", function(){
        create_dashboard_perencanaan_pbj_tabs3();
    });

    function data_dashboard_perencanaan_pbj_tabs3(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/perencanaan_pbj/penyedia',
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

    function create_dashboard_perencanaan_pbj_tabs3(){
        var get_data = data_dashboard_perencanaan_pbj_tabs3();
        var data_pencatatan_non_tender = [];
        var data_non_tender = [];
        var data_tender = [];
        var data_seleksi = [];
        for (var i = 0; i < get_data.length; i++) {
            data_pencatatan_non_tender[i]   = {y: parseInt(get_data[i].pencatatan_non_tender), label: get_data[i].nama_metode};
            data_non_tender[i]              = {y: parseInt(get_data[i].paket_non_tender), label: get_data[i].nama_metode};
            data_tender[i]                  = {y: parseInt(get_data[i].paket_tender), label: get_data[i].nama_metode};
            data_seleksi[i]                 = {y: parseInt(get_data[i].paket_seleksi), label: get_data[i].nama_metode};
        }
        
        var chart = new CanvasJS.Chart("dashboard-perencanaan-pbj-penyedia", {
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
                                        name: "Pencatatan Non Tender",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_pencatatan_non_tender
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0",
                                        name: "Non Tender",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_non_tender
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0",
                                        name: "Tender",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_tender
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0",
                                        name: "Seleksi",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_seleksi
                                    }
                                  ]
        });
        chart.render();
    }
    


    // *//////////////////////////////
    // * 
    // * ------- Tabs Swakelola -------
    // *
    // *//////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs1_swakelola", function(){
        create_dashboard_perencanaan_pbj_tabs4();
    });

    function data_dashboard_perencanaan_pbj_tabs4(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/perencanaan_pbj/swakelola',
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

    function create_dashboard_perencanaan_pbj_tabs4(){
        var get_data = data_dashboard_perencanaan_pbj_tabs4();
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i] = {
                                label: get_data[i].nama_satker, 
                                y: get_data[i].pagu,
                                indexLabelFontSize : 12
                            };
        }

        var chart = new CanvasJS.Chart("dashboard-perencanaan-pbj-swakelola", {
            animationEnabled: true,
            data: [{
                type                : "doughnut",
                startAngle          : 60,
                innerRadius         : 60,
                exportEnabled       : true,
                indexLabelFontSize  : 17,
                indexLabel          : "{label} - {y} M",
                toolTipContent      : "<b>{label} :</b> {y} M",
                dataPoints          : data_chart
            }]
        });
        chart.render();
    }
    
    //*
    //* =====================================================================================================================
    //*


</script>