<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>PERENCANAAN RENCANA UMUM PENGADAAN (RUP)</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="sirup-rekapitulasi-perencanaan-rup-table table table-hover">
                    <thead>
                        <tr>
                            <th rowspan="3">No</th>
                            <th rowspan="3">Jenis Pengadaan Barang/Jasa</th>
                            <th colspan="10">Penyedia</th>
                            <th rowspan="2" colspan="2">Swakelola</th>
                            <th colspan="2">Total</th>
                        </tr>
                        <tr>
                            <th colspan="2"><= Rp. 200 Jt</th>
                            <th colspan="2">> Rp. 200 Jt<br><= Rp. 2,5 M</th>
                            <th colspan="2">> Rp. 2,5 M<br><= Rp. 50 M</th>
                            <th colspan="2">> Rp. 50 M<br><= Rp. 100 M</th>
                            <th colspan="2">> Rp. 100 M</th>
                            <th colspan="2">Penyedia + Swakelola</th>
                        </tr>
                        <tr>
                            <th>Paket</th>
                            <th>Pagu</th>
                            <th>Paket</th>
                            <th>Pagu</th>
                            <th>Paket</th>
                            <th>Pagu</th>
                            <th>Paket</th>
                            <th>Pagu</th>
                            <th>Paket</th>
                            <th>Pagu</th>
                            <th>Paket</th>
                            <th>Pagu</th>
                            <th>Paket</th>
                            <th>Pagu</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-sirup-rekapitulasi-perencanaan-rup-pertahun"></tbody>
                    <tfoot class="tfoot-sirup-rekapitulasi-perencanaan-rup-pertahun"></tfoot>
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
    create_sirup_rekapitulasi_perencanaan_rup(
                                                    jQuery(".sirup-rekapitulasi-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_rekapitulasi_perencanaan_rup(tahun){
        create_sirup_rekapitulasi_perencanaan_rup(tahun);
    }

    function data_sirup_rekapitulasi_perencanaan_rup(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/rekapitulasi/data/tepra-rup/'+tahun,
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

    function create_sirup_rekapitulasi_perencanaan_rup(tahun){
        var get_data = data_sirup_rekapitulasi_perencanaan_rup(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].jenis_pengadaan,
                                get_data.baris_data[i].paket_krg_200jt,
                                get_data.baris_data[i].pagu_krg_200jt,
                                get_data.baris_data[i].paket_krg_2k5m,
                                get_data.baris_data[i].pagu_krg_2k5m,
                                get_data.baris_data[i].paket_krg_50m,
                                get_data.baris_data[i].pagu_krg_50m,
                                get_data.baris_data[i].paket_krg_100m,
                                get_data.baris_data[i].pagu_krg_100m,
                                get_data.baris_data[i].paket_lbh_100m,
                                get_data.baris_data[i].pagu_lbh_100m,
                                get_data.baris_data[i].paket_swakelola,
                                get_data.baris_data[i].pagu_swakelola,
                                get_data.baris_data[i].total_paket,
                                get_data.baris_data[i].total_pagu,
                            ];
        }
        
        jQuery(".sirup-rekapitulasi-perencanaan-rup-table").DataTable({
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

        jQuery(".tbody-sirup-rekapitulasi-perencanaan-rup-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].paket_krg_200jt+"</th>"+
                                "<th>"+get_data.total_data[j].pagu_krg_200jt+"</th>"+
                                "<th>"+get_data.total_data[j].paket_krg_2k5m+"</th>"+
                                "<th>"+get_data.total_data[j].pagu_krg_2k5m+"</th>"+
                                "<th>"+get_data.total_data[j].paket_krg_50m+"</th>"+
                                "<th>"+get_data.total_data[j].pagu_krg_50m+"</th>"+
                                "<th>"+get_data.total_data[j].paket_krg_100m+"</th>"+
                                "<th>"+get_data.total_data[j].pagu_krg_100m+"</th>"+
                                "<th>"+get_data.total_data[j].paket_lbh_100m+"</th>"+
                                "<th>"+get_data.total_data[j].pagu_lbh_100m+"</th>"+
                                "<th>"+get_data.total_data[j].paket_swakelola+"</th>"+
                                "<th>"+get_data.total_data[j].pagu_swakelola+"</th>"+
                                "<th>"+get_data.total_data[j].total_paket+"</th>"+
                                "<th>"+get_data.total_data[j].total_pagu+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-sirup-rekapitulasi-perencanaan-rup-pertahun").html(data_total);
        jQuery(".tfoot-sirup-rekapitulasi-perencanaan-rup-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-sirup-rekapitulasi-perencanaan-rup-pertahun tr th").css("vertical-align", "middle");
    }
</script>