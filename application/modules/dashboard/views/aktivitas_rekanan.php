<div class="col-md-12">
    <div class="card dashboard-aktifitas-rekanan">
        <div class="card-header">
            <h4><i class="fa fa-bar-chart"></i>&nbsp;GRAFIK AKTIFITAS REKANAN TAHUN 2012-2019</h4>
            <ul class="card-actions">
                <li>
                    <button type="button" data-toggle="card-action" data-action="content_toggle"></button>
                </li>
            </ul>
        </div>
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active">
                <a href="#dashboard_tabs4_section1" class="open_dashboard_tabs4_status_penyedia">STATUS PENYEDIA</a>
            </li>
            <li>
                <a href="#dashboard_tabs4_section2" class="open_dashboard_tabs4_kategori_badan_usaha">KATEGORI BADAN USAHA</a>
            </li>
            <li>
                <a href="#dashboard_tabs4_section3" class="open_dashboard_tabs4_kualifikasi_badan_usaha">KUALIFIKASI BADAN USAHA</a>
            </li>
            <li>
                <a href="#dashboard_tabs4_section4" class="open_dashboard_tabs4_top_tendering">TOP TENDERING</a>
            </li>
            <li>
                <a href="#dashboard_tabs4_section5" class="open_dashboard_tabs4_top_non_tendering">TOP NON TENDERING</a>
            </li>
        </ul>
        <div class="card-block tab-content">
            <div class="tab-pane in active" id="dashboard_tabs4_section1">
                <div id="dashboard-aktifitas-rekanan-status-penyedia" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Aktifitas Rekanan - STATUS PENYEDIA</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs4_section2">
                <div id="dashboard-aktifitas-rekanan-kategori-badan-usaha" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Aktifitas Rekanan - KATEGORI BADAN USAHA</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs4_section3">
                <div id="dashboard-aktifitas-rekanan-kualifikasi-badan-usaha" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Aktifitas Rekanan - KUALIFIKASI BADAN USAHA</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs4_section4">
                <div id="dashboard-aktifitas-rekanan-top-tendering" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Aktifitas Rekanan - TOP TENDERING</b></p>
            </div>
            <div class="tab-pane" id="dashboard_tabs4_section5">
                <div id="dashboard-aktifitas-rekanan-top-non-tendering" style="width: 100%; height: 350px;"></div>
                <p style="text-align: center;padding-top: 20px;"><b>Aktifitas Rekanan - TOP NON TENDERING</b></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    //*****************************************************
    //*                                             
    //* GRAFIK AKTIFITAS REKANAN TAHUN 2012-2019
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

    function refresh_dashboard_aktivitas_rekanan(tahun){
        var get_id = jQuery(".dashboard-aktifitas-rekanan").children(".tab-content").find(".active").attr('id');

        if (get_id == 'dashboard_tabs4_section1') {
            create_dashboard_aktifitas_rekanan_status_penyedia();
        }
        if (get_id == 'dashboard_tabs4_section2') {
             create_dashboard_aktifitas_rekanan_kategori_badan_usaha();
        }
        if (get_id == 'dashboard_tabs4_section3') {
            create_dashboard_aktifitas_rekanan_kualifikasi_badan_usaha();
        }
        if (get_id == 'dashboard_tabs4_section4') {
            create_dashboard_aktifitas_rekanan_top_tendering(tahun);
        }
        if (get_id == 'dashboard_tabs4_section5') {
            create_dashboard_aktifitas_rekanan_top_nontendering(tahun);
        }
    }

    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs Status Penyedia -------
    // *
    // *///////////////////////////////////////////

    create_dashboard_aktifitas_rekanan_status_penyedia();
    jQuery(document).on("click", ".open_dashboard_tabs4_status_penyedia", function(){
        create_dashboard_aktifitas_rekanan_status_penyedia();
    });

    function data_dashboard_aktifitas_rekanan_status_penyedia(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/aktivitas-rekanan/status-penyedia',
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

    function create_dashboard_aktifitas_rekanan_status_penyedia(){
        var get_data        = data_dashboard_aktifitas_rekanan_status_penyedia();
        var data_rekanan    = [];
        var data_vrf_sudah  = [];
        var data_vrf_belum  = [];
        var data_vrf_tolak  = [];
        for (var i = 0; i < get_data.length; i++) {
            data_rekanan[i]     = {y: parseInt(get_data[i].rekanan), label: get_data[i].kbp_nama};
            data_vrf_sudah[i]   = {y: parseInt(get_data[i].sudah), label: get_data[i].kbp_nama};
            data_vrf_belum[i]   = {y: parseInt(get_data[i].belum), label: get_data[i].kbp_nama};
            data_vrf_tolak[i]   = {y: parseInt(get_data[i].tolak), label: get_data[i].kbp_nama};
        }
        
        var chart = new CanvasJS.Chart("dashboard-aktifitas-rekanan-status-penyedia", {
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
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Total Penyedia",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_rekanan
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Sudah Diverifikasi",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_vrf_sudah
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Belum Diverifikasi",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_vrf_belum
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Ditolak",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_vrf_tolak
                                    }
                                  ]
        });
        chart.render();
    }


    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs Kategori Badan Usaha -------
    // *
    // *///////////////////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs4_kategori_badan_usaha", function(){
        create_dashboard_aktifitas_rekanan_kategori_badan_usaha();
    });

    function data_dashboard_aktifitas_rekanan_kategori_badan_usaha(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/aktivitas-rekanan/kategori-badan-usaha',
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

    function create_dashboard_aktifitas_rekanan_kategori_badan_usaha(){
        var get_data        = data_dashboard_aktifitas_rekanan_kategori_badan_usaha();
        var data_cv         = [];
        var data_pt         = [];
        var data_ud         = [];
        var data_kop        = [];
        var data_pd         = [];
        var data_kecil      = [];
        var data_non        = [];
        var data_gab        = [];
        var data_blm        = [];
        for (var i = 0; i < get_data.length; i++) {
            data_cv[i]      = {y: parseInt(get_data[i].cv), label: get_data[i].kbp_nama};
            data_pt[i]      = {y: parseInt(get_data[i].pt), label: get_data[i].kbp_nama};
            data_ud[i]      = {y: parseInt(get_data[i].ud), label: get_data[i].kbp_nama};
            data_kop[i]     = {y: parseInt(get_data[i].kop), label: get_data[i].kbp_nama};
            data_pd[i]      = {y: parseInt(get_data[i].pd), label: get_data[i].kbp_nama};
            data_kecil[i]   = {y: parseInt(get_data[i].kecil), label: get_data[i].kbp_nama};
            data_non[i]     = {y: parseInt(get_data[i].non), label: get_data[i].kbp_nama};
            data_gab[i]     = {y: parseInt(get_data[i].gab), label: get_data[i].kbp_nama};
            data_blm[i]     = {y: parseInt(get_data[i].blm), label: get_data[i].kbp_nama};
        }
        
        var chart = new CanvasJS.Chart("dashboard-aktifitas-rekanan-kategori-badan-usaha", {
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
                                        yValueFormatString: "###0 Penyedia",
                                        name: "CV",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_cv
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "PT",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_pt
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "UD",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_ud
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Koperasi",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_kop
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Perusahaan Dagang",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_pd
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Kecil",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_kecil
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Non Kecil",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_non
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Gabungan",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_gab
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Belum Ditentukan",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_blm
                                    }
                                  ]
        });
        chart.render();
    }

    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs Kualifikasi Badan Usaha -------
    // *
    // *///////////////////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs4_kualifikasi_badan_usaha", function(){
        create_dashboard_aktifitas_rekanan_kualifikasi_badan_usaha();
    });

    function data_dashboard_aktifitas_rekanan_kualifikasi_badan_usaha(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/aktivitas-rekanan/kualifikasi-badan-usaha',
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

    function create_dashboard_aktifitas_rekanan_kualifikasi_badan_usaha(){
        var get_data        = data_dashboard_aktifitas_rekanan_kualifikasi_badan_usaha();
        var data_kecil      = [];
        var data_non        = [];
        var data_gab        = [];
        var data_blm        = [];
        for (var i = 0; i < get_data.length; i++) {
            data_kecil[i]   = {y: parseInt(get_data[i].kecil), label: get_data[i].kbp_nama};
            data_non[i]     = {y: parseInt(get_data[i].non), label: get_data[i].kbp_nama};
            data_gab[i]     = {y: parseInt(get_data[i].gab), label: get_data[i].kbp_nama};
            data_blm[i]     = {y: parseInt(get_data[i].blm), label: get_data[i].kbp_nama};
        }
        
        var chart = new CanvasJS.Chart("dashboard-aktifitas-rekanan-kualifikasi-badan-usaha", {
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
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Kecil",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_kecil
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Non Kecil",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_non
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Gabungan",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_gab
                                    },
                                    {
                                        type: "column",
                                        yValueFormatString: "###0 Penyedia",
                                        name: "Belum Ditentukan",
                                        showInLegend: true,
                                        indexLabelOrientation: "vertical",
                                        indexLabelFontColor: "black",
                                        dataPoints: data_blm
                                    }
                                  ]
        });
        chart.render();
    }

    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs TOP Tendering -------
    // *
    // *///////////////////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs4_top_tendering", function(){
        create_dashboard_aktifitas_rekanan_top_tendering(jQuery(".dashboard-pencarian-data").val());
    });

    function data_dashboard_aktifitas_rekanan_top_tendering(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/aktivitas-rekanan/top-tendering/'+tahun,
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

    function create_dashboard_aktifitas_rekanan_top_tendering(tahun){
        var get_data = data_dashboard_aktifitas_rekanan_top_tendering(tahun);
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i] = {
                                label: get_data[i].rkn_nama, 
                                y: get_data[i].jml_paket,
                                indexLabelFontSize : 14
                            };
        }

        var chart = new CanvasJS.Chart("dashboard-aktifitas-rekanan-top-tendering", {
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

    // *///////////////////////////////////////////
    // * 
    // * ------- Tabs TOP Non Tendering -------
    // *
    // *///////////////////////////////////////////

    jQuery(document).on("click", ".open_dashboard_tabs4_top_non_tendering", function(){
        create_dashboard_aktifitas_rekanan_top_nontendering(jQuery(".dashboard-pencarian-data").val());
    });

    function data_dashboard_aktifitas_rekanan_top_nontendering(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/aktivitas-rekanan/top-non-tendering/'+tahun,
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

    function create_dashboard_aktifitas_rekanan_top_nontendering(tahun){
        var get_data = data_dashboard_aktifitas_rekanan_top_nontendering(tahun);
        var data_chart = [];
        for (var i = 0; i < get_data.length; i++) {
            data_chart[i] = {
                                label: get_data[i].rkn_nama, 
                                y: get_data[i].jml_paket,
                                indexLabelFontSize : 14
                            };
        }

        var chart = new CanvasJS.Chart("dashboard-aktifitas-rekanan-top-non-tendering", {
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