<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA REKAPITULASI PAKET RUP OPD</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="sirup-paket-rekapitulasi-paket-opd-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Satker</th>
                            <th width="20%">Paket <= 50 Jt</th>
                            <th width="20%">Paket > 50 Jt<br> <= 200 Jt</th>
                            <th width="15%">Paket Tender</th>
                            <th width="15%">Paket Seleksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-sirup-paket-rekapitulasi-paket-opd-pertahun"></tbody>
                    <tfoot class="tfoot-sirup-paket-rekapitulasi-paket-opd-pertahun"></tfoot>
                </table>
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
    create_sirup_paket_rekapitulasi_rekap(
                                                    jQuery(".sirup-paket-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_paket_rekapitulasi_rekap(tahun){
        create_sirup_paket_rekapitulasi_rekap(tahun);
    }

    function data_sirup_paket_rekapitulasi_rekap(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/paket/data/rekapitulasi-paket/'+tahun,
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

    function create_sirup_paket_rekapitulasi_rekap(tahun){
        var get_data = data_sirup_paket_rekapitulasi_rekap(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].paket_pencatatan_non_tender,
                                get_data.baris_data[i].paket_non_tender,
                                get_data.baris_data[i].paket_tender,
                                get_data.baris_data[i].paket_seleksi
                            ];
        }
        
        jQuery(".sirup-paket-rekapitulasi-paket-opd-table").DataTable({
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

        jQuery(".tbody-sirup-paket-rekapitulasi-paket-opd-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].paket_pencatatan_non_tender+"</th>"+
                                "<th>"+get_data.total_data[j].paket_non_tender+"</th>"+
                                "<th>"+get_data.total_data[j].paket_tender+"</th>"+
                                "<th>"+get_data.total_data[j].paket_seleksi+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-sirup-paket-rekapitulasi-paket-opd-pertahun").html(data_total);
        jQuery(".tfoot-sirup-paket-rekapitulasi-paket-opd-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-sirup-paket-rekapitulasi-paket-opd-pertahun tr th").css("vertical-align", "middle");
    }
</script>