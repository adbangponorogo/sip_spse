<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA REKAPITULASI PAKET TENDER GAGAL</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="nontendering-paketgagal-rekap-gagal-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Tahun</th>
                            <th width="15%">Total Paket (Paket)</th>
                            <th width="35%">Total Pagu (Rp.)</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-nontendering-paketgagal-rekap-gagal-pertahun"></tbody>
                    <tfoot class="tfoot-paket-nontendering-paketgagal-rekap-gagal-pertahun"></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //*****************************************************
    //*                                             
    //* Data Lelang Per Tahun
    //*                                             
    //*****************************************************
    create_nontendering_paketgagal_rekap_gagal_pertahun(
                                                    jQuery(".nontender-paketgagal-pencarian-data-tahun").val()
                                                );
    function refresh_nontendering_paketulang_rekap_retendering_pertahun(tahun){
        create_nontendering_paketgagal_rekap_gagal_pertahun(tahun);
    }

    function data_nontendering_paketgagal_rekap_gagal_pertahun(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-non-tendering/paket-gagal/data/rekap-gagal/'+tahun,
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

    function create_nontendering_paketgagal_rekap_gagal_pertahun(tahun){
        var get_data = data_nontendering_paketgagal_rekap_gagal_pertahun(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].tahun,
                                get_data.baris_data[i].total_paket,
                                get_data.baris_data[i].total_pagu
                            ];
        }
        
        jQuery(".nontendering-paketgagal-rekap-gagal-table").DataTable({
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

        // jQuery(".tbody-paket-nontendering-paketgagal-rekap-gagal-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].total_paket+"</th>"+
                                "<th>"+get_data.total_data[j].total_pagu+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-paket-nontendering-paketgagal-rekap-gagal-pertahun").html(data_total);
        jQuery(".tfoot-paket-nontendering-paketgagal-rekap-gagal-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-paket-nontendering-paketgagal-rekap-gagal-pertahun tr th").css("vertical-align", "middle");
    }
</script>