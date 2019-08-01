<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA KONTRAK OPD</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="nontendering-kontrakopd-kontrak-opd-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="35%">Nama OPD</th>
                            <th width="10%">Jumlah Kontrak (Paket)</th>
                            <th width="15%">Total HPS (Rp.)</th>
                            <th width="15%">Total Penawaran (Rp.)</th>
                            <th width="20%">Total Nilai Kontrak (Rp.)</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-nontendering-kontrakopd-kontrak-opd-pertahun"></tbody>
                    <tfoot class="tfoot-paket-nontendering-kontrakopd-kontrak-opd-pertahun"></tfoot>
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
    create_nontendering_kontrakopd_kontrak_opd_pertahun(
                                                    jQuery(".nontender-kontrakopd-pencarian-data-tahun").val()
                                                );
    function refresh_nontendering_kontrakopd_kontrak_opd_pertahun(tahun){
        create_nontendering_kontrakopd_kontrak_opd_pertahun(tahun);
    }

    function data_nontendering_kontrakopd_kontrak_opd_pertahun(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-non-tendering/kontrak-opd/data/kontrak-opd/'+tahun,
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

    function create_nontendering_kontrakopd_kontrak_opd_pertahun(tahun){
        var get_data = data_nontendering_kontrakopd_kontrak_opd_pertahun(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].jumlah_kontrak,
                                get_data.baris_data[i].total_hps,
                                get_data.baris_data[i].total_penawaran,
                                get_data.baris_data[i].total_nilai_kontrak
                            ];
        }
        
        jQuery(".nontendering-kontrakopd-kontrak-opd-table").DataTable({
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

        // jQuery(".tbody-paket-nontendering-kontrakopd-kontrak-opd-pertahun tr").first().css("text-align", "center");
        jQuery(".tbody-paket-nontendering-kontrakopd-kontrak-opd-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].jumlah_kontrak+"</th>"+
                                "<th>"+get_data.total_data[j].total_hps+"</th>"+
                                "<th>"+get_data.total_data[j].total_penawaran+"</th>"+
                                "<th>"+get_data.total_data[j].total_nilai_kontrak+"</th>"
                            "</tr>";
        }
        jQuery(".tfoot-paket-nontendering-kontrakopd-kontrak-opd-pertahun").html(data_total);
        jQuery(".tfoot-paket-nontendering-kontrakopd-kontrak-opd-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-paket-nontendering-kontrakopd-kontrak-opd-pertahun tr th").css("vertical-align", "middle");
    }
</script>