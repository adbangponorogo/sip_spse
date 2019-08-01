<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA RINCIAN PAKET RUP</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="sirup-paket-rincian-paket-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nama Satker</th>
                            <th width="10%">Kode RUP</th>
                            <th width="20%">Nama Kegiatan</th>
                            <th width="20%">Nama Paket</th>
                            <th width="7%">Jenis Pengadaan</th>
                            <th width="15%">Pagu Dana</th>
                            <th width="8%">Metode Pemilihan</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-sirup-paket-rincian-paket-pertahun"></tbody>
                    <tfoot class="tfoot-sirup-paket-rincian-paket-pertahun"></tfoot>
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
    create_sirup_paket_rincian_paket(
                                                    jQuery(".sirup-paket-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_paket_rincian_paket(tahun){
        create_sirup_paket_rincian_paket(tahun);
    }

    function data_sirup_paket_rincian_paket(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/paket/data/rincian-paket/'+tahun,
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

    function create_sirup_paket_rincian_paket(tahun){
        var get_data = data_sirup_paket_rincian_paket(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].kode_rup,
                                get_data.baris_data[i].nama_kagiatan,
                                get_data.baris_data[i].nama_paket,
                                get_data.baris_data[i].jenis_pengadaan,
                                get_data.baris_data[i].pagu_paket,
                                get_data.baris_data[i].metode_pemilihan
                            ];
        }
        
        jQuery(".sirup-paket-rincian-paket-table").DataTable({
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

        jQuery(".tbody-sirup-paket-rincian-paket-pertahun tr td").css("vertical-align", "middle");
    }
</script>