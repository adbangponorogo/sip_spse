<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA SIRUP OPD</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="sirup-data-paket-opd-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%">Kode RUP</th>
                            <th width="15%">Nama Satker</th>
                            <th width="15%">Nama Kegiatan</th>
                            <th width="20%">Nama Paket</th>
                            <th width="8%">Jenis Pengadaan</th>
                            <th width="8%">Metode Pemilihan</th>
                            <th width="8%">Sumber Dana</th>
                            <th width="8%">Pagu Paket</th>
                            <th width="8%">Tanggal Diumumkan</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-sirup-data-paket-opd-pertahun"></tbody>
                    <tfoot class="tfoot-sirup-data-paket-opd-pertahun"></tfoot>
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
    create_sirup_data_paket_opd(
                                                    jQuery(".sirup-data-pencarian-data-tahun").val()
                                                );
    function refresh_sirup_paket_tender_seleksi(tahun){
        create_sirup_data_paket_opd(tahun);
    }

    function data_sirup_data_paket_opd(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-sirup/data/data/paket-opd/'+tahun,
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

    function create_sirup_data_paket_opd(tahun){
        var get_data = data_sirup_data_paket_opd(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].id_rup,
                                get_data.baris_data[i].nama_satker,
                                get_data.baris_data[i].nama_kegiatan,
                                get_data.baris_data[i].nama_paket,
                                get_data.baris_data[i].jenis_pengadaan,
                                get_data.baris_data[i].metode_pemilihan,
                                get_data.baris_data[i].sumber_dana,
                                get_data.baris_data[i].total_pagu,
                                get_data.baris_data[i].tanggal_buat
                            ];
        }
        
        jQuery(".sirup-data-paket-opd-table").DataTable({
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

        jQuery(".tbody-sirup-data-paket-opd-pertahun tr td").css("vertical-align", "middle");
    }
</script>