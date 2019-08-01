<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA PAKET NON TENDERING</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="nontendering-paketpengadaan-data-paket-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%">ID</th>
                            <th width="20%">Nama OPD</th>
                            <th width="20%">Nama Paket</th>
                            <th width="10%">Pagu Paket (Rp.)</th>
                            <th width="10%">HPS (Rp.)</th>
                            <th width="10%">Pemenang</th>
                            <th width="15%">Alamat</th>
                            <th width="10%">Penawaran (Rp.)</th>
                            <th width="10%">Efisiensi (Rp.)</th>
                            <th width="5%">Prosentase (%)</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-nontendering-paketpengadaan-data-paket-pertahun"></tbody>
                    <tfoot class="tfoot-paket-nontendering-paketpengadaan-data-paket-pertahun"></tfoot>
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
    create_nontendering_paketpengadaan_data_paket_pertahun(
                                                    jQuery(".nontender-paketpengadaan-pencarian-data-tahun").val()
                                                );
    function refresh_nontendering_paketpengadaan_data_paket_pertahun(tahun){
        create_nontendering_paketpengadaan_data_paket_pertahun(tahun);
    }

    function data_nontendering_paketpengadaan_data_paket_pertahun(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-non-tendering/paket-pengadaan/data/data-paket/'+tahun,
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

    function create_nontendering_paketpengadaan_data_paket_pertahun(tahun){
        var get_data = data_nontendering_paketpengadaan_data_paket_pertahun(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].id_paket,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].nama_paket,
                                get_data.baris_data[i].total_pagu,
                                get_data.baris_data[i].total_hps,
                                get_data.baris_data[i].pemenang,
                                get_data.baris_data[i].alamat,
                                get_data.baris_data[i].total_hasil_tawar,
                                get_data.baris_data[i].total_efisiensi,
                                get_data.baris_data[i].prosentase
                            ];
        }
        
        jQuery(".nontendering-paketpengadaan-data-paket-table").DataTable({
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

        // jQuery(".tbody-paket-nontendering-paketpengadaan-data-paket-pertahun tr").first().css("text-align", "center");
        jQuery(".tbody-paket-nontendering-paketpengadaan-data-paket-pertahun tr td").css("vertical-align", "middle");
    }
</script>