<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>HASIL PAKET TENDER TENDER OPD</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="tendering-paketopd-hasil-paket-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="35%">Nama OPD</th>
                            <th width="10%">Paket</th>
                            <th width="15%">Pagu</th>
                            <th width="15%">Penawaran</th>
                            <th width="15%">Efisiensi</th>
                            <th width="5%">Prosentase</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-tendering-paketopd-hasil-paket-pertahun"></tbody>
                    <tfoot class="tfoot-paket-tendering-paketopd-hasil-paket-pertahun"></tfoot>
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
    create_tendering_paketopd_hasil_paket_pertahun(
                                                    jQuery(".tender-paketopd-pencarian-data-tahun").val(),
                                                    jQuery(".tender-paketopd-pencarian-data-nama-satker").val()
                                                );
    function refresh_tendering_paketopd_hasil_paket_pertahun(tahun, satker){
        create_tendering_paketopd_hasil_paket_pertahun(tahun, satker);
    }

    function data_tendering_paketopd_hasil_paket_pertahun(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/paket-opd/data/hasil-paket-opd/'+tahun+'/'+satker,
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

    function create_tendering_paketopd_hasil_paket_pertahun(tahun, satker){
        var get_data = data_tendering_paketopd_hasil_paket_pertahun(tahun, satker);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].paket,
                                get_data.baris_data[i].pagu,
                                get_data.baris_data[i].penawaran,
                                get_data.baris_data[i].efisiensi,
                                get_data.baris_data[i].prosentase
                            ];
        }
        
        jQuery(".tendering-paketopd-hasil-paket-table").DataTable({
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

        // jQuery(".tbody-paket-tendering-paketopd-hasil-paket-pertahun tr").first().css("text-align", "center");
        jQuery(".tbody-paket-tendering-paketopd-hasil-paket-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].paket+"</th>"+
                                "<th>"+get_data.total_data[j].pagu+"</th>"+
                                "<th>"+get_data.total_data[j].penawaran+"</th>"+
                                "<th>"+get_data.total_data[j].efisiensi+"</th>"+
                                "<th>"+get_data.total_data[j].prosentase+"</th>"
                            "</tr>";
        }
        jQuery(".tfoot-paket-tendering-paketopd-hasil-paket-pertahun").html(data_total);
        jQuery(".tfoot-paket-tendering-paketopd-hasil-paket-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-paket-tendering-paketopd-hasil-paket-pertahun tr th").css("vertical-align", "middle");
    }
</script>