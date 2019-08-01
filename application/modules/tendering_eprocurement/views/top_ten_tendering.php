<div class="col-md-12">
    <div class="card tendering-eprocurement-top-ten-tender">
        <div class="card-header">
            <h4><i class="fa fa-bar-chart"></i>&nbsp;TOP 10 TENDERING</h4>
            <ul class="card-actions">
                <li>
                    <button type="button" data-toggle="card-action" data-action="content_toggle"></button>
                </li>
            </ul>
        </div>
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active">
                <a href="#tendering_eprocurement_tabs1_section1" class="open_tendering_eprocurement_tabs1_barang">BARANG</a>
            </li>
            <li>
                <a href="#tendering_eprocurement_tabs1_section2" class="open_tendering_eprocurement_tabs1_konsultasi">KONSULTASI</a>
            </li>
            <li>
                <a href="#tendering_eprocurement_tabs1_section3" class="open_tendering_eprocurement_tabs1_konstruksi">KONSTRUKSI</a>
            </li>
        </ul>
        <div class="card-block tab-content">
            <div class="tab-pane in active" id="tendering_eprocurement_tabs1_section1">
                <div class="table-responsive">
                    <table class="tendering-eprocurement-top-ten-tender-barang-table table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th width="40%">Nama Penyedia</th>
                                <th width="20%">Asal</th>
                                <th width="15%">Paket</th>
                                <th width="15%">Kontrak</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="tendering_eprocurement_tabs1_section2">
                <div class="table-responsive">
                    <table class="tendering-eprocurement-top-ten-tender-konsultasi-table table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th width="40%">Nama Penyedia</th>
                                <th width="20%">Asal</th>
                                <th width="15%">Paket</th>
                                <th width="15%">Kontrak</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="tendering_eprocurement_tabs1_section3">
                <div class="table-responsive">
                    <table class="tendering-eprocurement-top-ten-tender-konstruksi-table table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th width="40%">Nama Penyedia</th>
                                <th width="20%">Asal</th>
                                <th width="15%">Paket</th>
                                <th width="15%">Kontrak</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    //**********************************************
    //*                                             
    //* REPORT/EPROCUREMENT - TOP 10 TENDERING
    //*                                             
    //**********************************************
    create_tendering_eprocurement_top_ten_tendering_barang(
                                                    jQuery(".tender-eprocurement-pencarian-data-tahun").val(),
                                                    jQuery(".tender-eprocurement-pencarian-data-nama-satker").val()
                                                );
    function refresh_tendering_eprocurement_top_ten_tendering(tahun, satker){
        var get_id = jQuery(".tendering-eprocurement-top-ten-tender").children(".tab-content").find(".active").attr('id');

        if (get_id == 'tendering_eprocurement_tabs1_section1') {
            create_tendering_eprocurement_top_ten_tendering_barang(tahun, satker);
        }
        if (get_id == 'tendering_eprocurement_tabs1_section2') {
            create_tendering_eprocurement_top_ten_tendering_konsultasi(tahun, satker);
        }
        if (get_id == 'tendering_eprocurement_tabs1_section3') {
            create_tendering_eprocurement_top_ten_tendering_konstruksi(tahun, satker);
        }
        // console.log(get_id);
    }

    // *//////////////////////////////
    // * 
    // * ------- Tabs Barang -------
    // *
    // *//////////////////////////////

    jQuery(document).on("click", ".open_tendering_eprocurement_tabs1_barang", function(){
        create_tendering_eprocurement_top_ten_tendering_barang(
            jQuery(".tender-eprocurement-pencarian-data-tahun").val(),
            jQuery(".tender-eprocurement-pencarian-data-nama-satker").val()
        );
    });

    function data_tendering_eprocurement_top_ten_tendering_barang(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/e-procurement/data/top-ten-tender-barang/'+tahun+'/'+satker,
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

    function create_tendering_eprocurement_top_ten_tendering_barang(tahun, satker){
        var get_data = data_tendering_eprocurement_top_ten_tendering_barang(tahun, satker);
        var data_baris = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_rekanan,
                                get_data.baris_data[i].nama_kabupaten,
                                get_data.baris_data[i].total_paket,
                                get_data.baris_data[i].total_penawaran,
                            ];
        }
        
        jQuery(".tendering-eprocurement-top-ten-tender-barang-table").DataTable({
            destroy         : true,
            processing      : true,
            lengthMenu      : [10],
            dom             : 'Bfrtip',
            buttons         : {
                                buttons : [
                                            {
                                                extend : 'copy',
                                                text : '<i class="fa fa-copy"></i>&nbsp;Salin Data',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'csv',
                                                text : '<i class="fa fa-file-excel-o"></i>&nbsp;Export to CSV',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'excel',
                                                text : '<i class="fa fa-file-excel-o"></i>&nbsp;Export to Excel',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'pdf',
                                                text : '<i class="fa fa-file-pdf-o"></i>&nbsp;Export to PDF',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'print',
                                                text : '<i class="fa fa-print"></i>&nbsp;Print Table',
                                                className : 'btn btn-success'
                                            },
                                          ]
                              },
            data            : data_baris
        });
    }

    

    // *//////////////////////////////
    // * 
    // * ----- Tabs Konsultasi -----
    // *
    // *//////////////////////////////

    jQuery(document).on("click", ".open_tendering_eprocurement_tabs1_konsultasi", function(){
        create_tendering_eprocurement_top_ten_tendering_konsultasi(
            jQuery(".tender-eprocurement-pencarian-data-tahun").val(),
            jQuery(".tender-eprocurement-pencarian-data-nama-satker").val()
        );
    });

    function data_tendering_eprocurement_top_ten_tendering_konsultasi(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/e-procurement/data/top-ten-tender-konsultasi/'+tahun+'/'+satker,
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

    function create_tendering_eprocurement_top_ten_tendering_konsultasi(tahun, satker){
        var get_data = data_tendering_eprocurement_top_ten_tendering_konsultasi(tahun, satker);
        var data_baris = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_rekanan,
                                get_data.baris_data[i].nama_kabupaten,
                                get_data.baris_data[i].total_paket,
                                get_data.baris_data[i].total_penawaran,
                            ];
        }
        
        jQuery(".tendering-eprocurement-top-ten-tender-konsultasi-table").DataTable({
            destroy         : true,
            processing      : true,
            lengthMenu      : [10],
            dom             : 'Bfrtip',
            buttons         : {
                                buttons : [
                                            {
                                                extend : 'copy',
                                                text : '<i class="fa fa-copy"></i>&nbsp;Salin Data',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'csv',
                                                text : '<i class="fa fa-file-excel-o"></i>&nbsp;Export to CSV',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'excel',
                                                text : '<i class="fa fa-file-excel-o"></i>&nbsp;Export to Excel',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'pdf',
                                                text : '<i class="fa fa-file-pdf-o"></i>&nbsp;Export to PDF',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'print',
                                                text : '<i class="fa fa-print"></i>&nbsp;Print Table',
                                                className : 'btn btn-success'
                                            },
                                          ]
                              },
            data            : data_baris
        });
    }




    // *//////////////////////////////
    // * 
    // * ----- Tabs Konstruksi ------
    // *
    // *//////////////////////////////

    jQuery(document).on("click", ".open_tendering_eprocurement_tabs1_konstruksi", function(){
        create_tendering_eprocurement_top_ten_tendering_konstruksi(
            jQuery(".tender-eprocurement-pencarian-data-tahun").val(),
            jQuery(".tender-eprocurement-pencarian-data-nama-satker").val()
        );
    });

    function data_tendering_eprocurement_top_ten_tendering_konstruksi(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/e-procurement/data/top-ten-tender-konstruksi/'+tahun+'/'+satker,
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

    function create_tendering_eprocurement_top_ten_tendering_konstruksi(tahun, satker){
        var get_data = data_tendering_eprocurement_top_ten_tendering_konstruksi(tahun, satker);
        var data_baris = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_rekanan,
                                get_data.baris_data[i].nama_kabupaten,
                                get_data.baris_data[i].total_paket,
                                get_data.baris_data[i].total_penawaran,
                            ];
        }
        
        jQuery(".tendering-eprocurement-top-ten-tender-konstruksi-table").DataTable({
            destroy         : true,
            processing      : true,
            lengthMenu      : [10],
            dom             : 'Bfrtip',
            buttons         : {
                                buttons : [
                                            {
                                                extend : 'copy',
                                                text : '<i class="fa fa-copy"></i>&nbsp;Salin Data',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'csv',
                                                text : '<i class="fa fa-file-excel-o"></i>&nbsp;Export to CSV',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'excel',
                                                text : '<i class="fa fa-file-excel-o"></i>&nbsp;Export to Excel',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'pdf',
                                                text : '<i class="fa fa-file-pdf-o"></i>&nbsp;Export to PDF',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'print',
                                                text : '<i class="fa fa-print"></i>&nbsp;Print Table',
                                                className : 'btn btn-success'
                                            },
                                          ]
                              },
            data            : data_baris
        });
    }
</script>