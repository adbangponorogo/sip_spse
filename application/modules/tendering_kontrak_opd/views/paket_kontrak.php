<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA PAKET KONTRAK OPD</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="tendering-kontrakopd-paket-kontrak-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama OPD</th>
                            <th width="20%">Nama Paket</th>
                            <th width="15%">Rekanan</th>
                            <th width="10%">Nilai Kontrak</th>
                            <th width="10%">No. Kontrak</th>
                            <th width="10%">Jangka Waktu</th>
                            <th width="10%">Kategori / Metode</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-tendering-kontrakopd-paket-kontrak-pertahun"></tbody>
                    <tfoot class="tfoot-paket-tendering-kontrakopd-paket-kontrak-pertahun"></tfoot>
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
    create_tendering_kontrakopd_paket_kontrak_pertahun(
                                                    jQuery(".tender-kontrakopd-pencarian-data-tahun").val(),
                                                    jQuery(".tender-kontrakopd-pencarian-data-nama-satker").val()
                                                );
    function refresh_tendering_kontrakopd_paket_kontrak_pertahun(tahun, satker){
        create_tendering_kontrakopd_paket_kontrak_pertahun(tahun, satker);
    }

    function data_tendering_kontrakopd_paket_kontrak_pertahun(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/kontrak-opd/data/paket-kontrak/'+tahun+'/'+satker,
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

    function create_tendering_kontrakopd_paket_kontrak_pertahun(tahun, satker){
        var get_data = data_tendering_kontrakopd_paket_kontrak_pertahun(tahun, satker);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].nama_paket,
                                get_data.baris_data[i].rekanan,
                                get_data.baris_data[i].total_nilai_kontrak,
                                get_data.baris_data[i].no_kontrak,
                                get_data.baris_data[i].jangka_waktu,
                                get_data.baris_data[i].kategori
                            ];
        }
        
        jQuery(".tendering-kontrakopd-paket-kontrak-table").DataTable({
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

        // jQuery(".tbody-paket-tendering-kontrakopd-paket-kontrak-pertahun tr").first().css("text-align", "center");
        jQuery(".tbody-paket-tendering-kontrakopd-paket-kontrak-pertahun tr td").css("vertical-align", "middle");
    }
</script>