<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>PERENCANAAN BELANJA PEMERINTAH KABUPATEN PONOROGO</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="sirup-rekapitulasi-perencanaan-belanja-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="35%">Nama Satker</th>
                            <th width="20%">Belanja Tidak Langsung</th>
                            <th width="20%">Belanja Langsung</th>
                            <th width="20%">Total Anggaran</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-sirup-rekapitulasi-perencanaan-belanja-pertahun"></tbody>
                    <tfoot class="tfoot-sirup-rekapitulasi-perencanaan-belanja-pertahun"></tfoot>
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
    create_sirup_rekapitulasi_perencanaan_belanja(
                                                    jQuery(".sirup-rekapitulasi-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_rekapitulasi_perencanaan_belanja(tahun){
        create_sirup_rekapitulasi_perencanaan_belanja(tahun);
    }

    function data_sirup_rekapitulasi_perencanaan_belanja(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/rekapitulasi/data/perencanaan-belanja-pemda/'+tahun,
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

    function create_sirup_rekapitulasi_perencanaan_belanja(tahun){
        var get_data = data_sirup_rekapitulasi_perencanaan_belanja(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].total_btl,
                                get_data.baris_data[i].total_bl,
                                get_data.baris_data[i].total_anggaran
                            ];
        }
        
        jQuery(".sirup-rekapitulasi-perencanaan-belanja-table").DataTable({
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

        jQuery(".tbody-sirup-rekapitulasi-perencanaan-belanja-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].total_btl+"</th>"+
                                "<th>"+get_data.total_data[j].total_bl+"</th>"+
                                "<th>"+get_data.total_data[j].total_anggaran+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-sirup-rekapitulasi-perencanaan-belanja-pertahun").html(data_total);
        jQuery(".tfoot-sirup-rekapitulasi-perencanaan-belanja-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-sirup-rekapitulasi-perencanaan-belanja-pertahun tr th").css("vertical-align", "middle");
    }
</script>