<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>ANALISIS RENCANA UMUM PENGADAAN (RUP)</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="sirup-rekapitulasi-analisis-rup-table table table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" width="5%">No</th>
                            <th rowspan="2" width="40%">Nama</th>
                            <th rowspan="2" width="15%">Pagu Belanja Langsung</th>
                            <th colspan="2">RUP Tayang</th>
                            <th colspan="2">RUP Draft</th>
                            <th rowspan="2" width="5%">Pagu Tayang</th>
                            <th rowspan="2" width="15%">Selisih</th>
                        </tr>
                        <tr>
                            <th width="5%">Penyedia</th>
                            <th width="5%">Swakelola</th>
                            <th width="5%">Penyedia</th>
                            <th width="5%">Swakelola</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-sirup-rekapitulasi-analisis-rup-pertahun"></tbody>
                    <tfoot class="tfoot-sirup-rekapitulasi-analisis-rup-pertahun"></tfoot>
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
    create_sirup_rekapitulasi_analisis_rup(
                                                    jQuery(".sirup-rekapitulasi-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_rekapitulasi_analisis_rup(tahun){
        create_sirup_rekapitulasi_analisis_rup(tahun);
    }

    function data_sirup_rekapitulasi_analisis_rup(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/rekapitulasi/data/analisis-rup/'+tahun,
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

    function create_sirup_rekapitulasi_analisis_rup(tahun){
        var get_data = data_sirup_rekapitulasi_analisis_rup(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].pagu_bl,
                                get_data.baris_data[i].rup_tayang_penyedia,
                                get_data.baris_data[i].rup_tayang_swakelola,
                                get_data.baris_data[i].rup_draft_penyedia,
                                get_data.baris_data[i].rup_draft_swakelola,
                                get_data.baris_data[i].pagu_tayang,
                                get_data.baris_data[i].selisih
                            ];
        }
        
        jQuery(".sirup-rekapitulasi-analisis-rup-table").DataTable({
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

        jQuery(".tbody-sirup-rekapitulasi-analisis-rup-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].pagu_bl+"</th>"+
                                "<th>"+get_data.total_data[j].rup_tayang_penyedia+"</th>"+
                                "<th>"+get_data.total_data[j].rup_tayang_swakelola+"</th>"+
                                "<th>"+get_data.total_data[j].rup_draft_penyedia+"</th>"+
                                "<th>"+get_data.total_data[j].rup_draft_swakelola+"</th>"+
                                "<th>"+get_data.total_data[j].pagu_tayang+"</th>"+
                                "<th>"+get_data.total_data[j].selisih+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-sirup-rekapitulasi-analisis-rup-pertahun").html(data_total);
        jQuery(".tfoot-sirup-rekapitulasi-analisis-rup-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-sirup-rekapitulasi-analisis-rup-pertahun tr th").css("vertical-align", "middle");
    }
</script>