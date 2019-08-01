<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA KATEGORI TENDER</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="tendering-progrespbj-kategori-tender-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama OPD</th>
                            <th width="15%">Jenis Pengadaan</th>
                            <th width="10%">Jumlah Paket</th>
                            <th width="10%">Jumlah Paket Selesai</th>
                            <th width="10%">Jumlah Paket Belum Selesai</th>
                            <th width="10%">Jumlah HPS</th>
                            <th width="10%">Jumlah Penawaran</th>
                            <th width="10%">Selisih</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-tendering-progrespbj-kategori-tender-pertahun"></tbody>
                    <tfoot class="tfoot-paket-tendering-progrespbj-kategori-tender-pertahun"></tfoot>
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
    create_tendering_progrespbj_kategori_tender_pertahun(
                                                    jQuery(".tender-progrespbj-pencarian-data-tahun").val(),
                                                    jQuery(".tender-progrespbj-pencarian-data-nama-satker").val()
                                                );
    function refresh_tendering_progrespbj_kategori_tender_pertahun(tahun, satker){
        create_tendering_progrespbj_kategori_tender_pertahun(tahun, satker);
    }

    function data_tendering_progrespbj_kategori_tender_pertahun(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/progres-pbj/data/kategori-tender/'+tahun+'/'+satker,
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

    function create_tendering_progrespbj_kategori_tender_pertahun(tahun, satker){
        var get_data = data_tendering_progrespbj_kategori_tender_pertahun(tahun, satker);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].jenis_pengadaan,
                                get_data.baris_data[i].jumlah_paket,
                                get_data.baris_data[i].jumlah_paket_selesai,
                                get_data.baris_data[i].jumlah_paket_belum_selesai,
                                get_data.baris_data[i].total_hps,
                                get_data.baris_data[i].total_hasil_tawar,
                                get_data.baris_data[i].selisih
                            ];
        }
        
        jQuery(".tendering-progrespbj-kategori-tender-table").DataTable({
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

        // jQuery(".tbody-paket-tendering-progrespbj-kategori-tender-pertahun tr").first().css("text-align", "center");
        jQuery(".tbody-paket-tendering-progrespbj-kategori-tender-pertahun tr td").css("vertical-align", "middle");
    }
</script>