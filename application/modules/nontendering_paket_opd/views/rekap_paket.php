<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA PAKET NON TENDERING</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="nontendering-paketopd-rekap-paket-table table table-hover">
                    <thead>
                        <tr>
                            <th rowspan="3">No</th>
                            <th rowspan="3">Nama</th>
                            <th colspan="10">Paket Pengadaan Melalui Penyedia</th>
                        </tr>
                        <tr>
                            <th colspan="2">Barang</th>
                            <th colspan="2">Konstruksi</th>
                            <th colspan="2">Konsultasi</th>
                            <th colspan="2">Jasa Lainnya</th>
                            <th colspan="2">Total</th>
                        </tr>
                        <tr>
                            <th>Paket</th>
                            <th>HPS (Juta)</th>
                            <th>Paket</th>
                            <th>HPS (Juta)</th>
                            <th>Paket</th>
                            <th>HPS (Juta)</th>
                            <th>Paket</th>
                            <th>HPS (Juta)</th>
                            <th>Paket</th>
                            <th>HPS (Juta)</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-nontendering-paketopd-rekap-paket-pertahun"></tbody>
                    <tfoot class="tfoot-paket-nontendering-paketopd-rekap-paket-pertahun"></tfoot>
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
    create_nontendering_paketopd_rekap_paket_pertahun(
                                                    jQuery(".nontender-paketopd-pencarian-data-tahun").val()
                                                );
    function refresh_nontendering_paketopd_rekap_paket_pertahun(tahun){
        create_nontendering_paketopd_rekap_paket_pertahun(tahun);
    }

    function data_nontendering_paketopd_rekap_paket_pertahun(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-non-tendering/paket-opd/data/rekap-paket/'+tahun,
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

    function create_nontendering_paketopd_rekap_paket_pertahun(tahun){
        var get_data = data_nontendering_paketopd_rekap_paket_pertahun(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].paket_barang,
                                get_data.baris_data[i].hps_barang,
                                get_data.baris_data[i].paket_konstruksi,
                                get_data.baris_data[i].hps_konstruksi,
                                get_data.baris_data[i].paket_konsultasi,
                                get_data.baris_data[i].hps_konsultasi,
                                get_data.baris_data[i].paket_jasa_lainnya,
                                get_data.baris_data[i].hps_jasa_lainnya,
                                get_data.baris_data[i].total_paket,
                                get_data.baris_data[i].total_hps
                            ];
        }
        
        jQuery(".nontendering-paketopd-rekap-paket-table").DataTable({
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

        // jQuery(".tbody-paket-nontendering-paketopd-rekap-paket-pertahun tr").first().css("text-align", "center");
        jQuery(".tbody-paket-nontendering-paketopd-rekap-paket-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].paket_barang+"</th>"+
                                "<th>"+get_data.total_data[j].hps_barang+"</th>"+
                                "<th>"+get_data.total_data[j].paket_konstruksi+"</th>"+
                                "<th>"+get_data.total_data[j].hps_konstruksi+"</th>"+
                                "<th>"+get_data.total_data[j].paket_konsultasi+"</th>"+
                                "<th>"+get_data.total_data[j].hps_konsultasi+"</th>"+
                                "<th>"+get_data.total_data[j].paket_jasa_lainnya+"</th>"+
                                "<th>"+get_data.total_data[j].hps_jasa_lainnya+"</th>"+
                                "<th>"+get_data.total_data[j].total_paket+"</th>"+
                                "<th>"+get_data.total_data[j].total_hps+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-paket-nontendering-paketopd-rekap-paket-pertahun").html(data_total);
        jQuery(".tfoot-paket-nontendering-paketopd-rekap-paket-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-paket-nontendering-paketopd-rekap-paket-pertahun tr th").css("vertical-align", "middle");
    }
</script>