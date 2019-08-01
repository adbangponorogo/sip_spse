<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA LELANG PER KELOMPOK</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="tendering-eprocurement-kelompok-pertahun-table table table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" width="5%">No</th>
                            <th rowspan="2" width="20%">Jenis Pengadaan Barang/Jasa Dan Modal</th>
                            <th colspan="2">Lelang Umum / Seleksi Umum / Lelang Terbatas</th>
                            <th colspan="2">Lelang Sederhana / Pemilihan Langsung / Seleksi Sederhanan</th>
                            <th colspan="2">Total</th>
                        </tr>
                        <tr>
                            <th width="5%">Pkt</th>
                            <th width="20%">Rp.</th>
                            <th width="5%">Pkt</th>
                            <th width="20%">Rp.</th>
                            <th width="5%">Pkt</th>
                            <th width="20%">Rp.</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-tendering-kelompok-pertahun"></tbody>
                    <tfoot class="tfoot-paket-tendering-kelompok-pertahun"></tfoot>
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
    create_tendering_eprocurement_kelompok_pertahun(
                                                    jQuery(".tender-eprocurement-pencarian-data-tahun").val(),
                                                    jQuery(".tender-eprocurement-pencarian-data-nama-satker").val()
                                                );
    function refresh_tendering_eprocurement_kelompok_pertahun(tahun, satker){
        create_tendering_eprocurement_kelompok_pertahun(tahun, satker);
    }

    function data_tendering_eprocurement_kelompok_pertahun(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/e-procurement/data/kelompok-pertahun/'+tahun+'/'+satker,
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

    function create_tendering_eprocurement_kelompok_pertahun(tahun, satker){
        var get_data = data_tendering_eprocurement_kelompok_pertahun(tahun, satker);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].kategori,
                                get_data.baris_data[i].paket_umum,
                                get_data.baris_data[i].pagu_umum,
                                get_data.baris_data[i].paket_sederhana,
                                get_data.baris_data[i].pagu_sederhana,
                                get_data.baris_data[i].paket_total,
                                get_data.baris_data[i].pagu_total
                            ];
        }
        jQuery(".tendering-eprocurement-kelompok-pertahun-table").DataTable({
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

        // jQuery(".tbody-paket-tendering-kelompok-pertahun tr").first().css("text-align", "left");
        jQuery(".tbody-paket-tendering-kelompok-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].total_paket_umum+"</th>"+
                                "<th>"+get_data.total_data[j].total_pagu_umum+"</th>"+
                                "<th>"+get_data.total_data[j].total_paket_sederhana+"</th>"+
                                "<th>"+get_data.total_data[j].total_pagu_sederhana+"</th>"+
                                "<th>"+get_data.total_data[j].total_paket_total+"</th>"+
                                "<th>"+get_data.total_data[j].total_pagu_total+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-paket-tendering-kelompok-pertahun").html(data_total);
        jQuery(".tfoot-paket-tendering-kelompok-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-paket-tendering-kelompok-pertahun tr th").css("vertical-align", "middle");
    }
</script>