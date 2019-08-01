<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA EPURCHASING OPD</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="epurchasing-data-paket-opd-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nama Satker</th>
                            <th width="10%">Nama PPK</th>
                            <th width="20%">Komoditas/No.Paket/Paket</th>
                            <th width="10%">Penyedia</th>
                            <th width="10%">Distributor</th>
                            <th width="10%">Jumlah Produk</th>
                            <th width="10%">Anggaran</th>
                            <th width="10%">Tanggal Buat</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-epurchasing-data-paket-opd-pertahun"></tbody>
                    <tfoot class="tfoot-epurchasing-data-paket-opd-pertahun"></tfoot>
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
    create_epurchasing_data_paket_opd(
                                                    jQuery(".epurchasing-data-pencarian-data-tahun").val()
                                                );
    function refresh_epurchasing_data_paket_opd(tahun){
        create_epurchasing_data_paket_opd(tahun);
    }

    function data_epurchasing_data_paket_opd(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../e-purchasing/data/data/paket-opd/'+tahun,
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

    function create_epurchasing_data_paket_opd(tahun){
        var get_data = data_epurchasing_data_paket_opd(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_satker,
                                get_data.baris_data[i].nama_ppk,
                                get_data.baris_data[i].nama_komoditas,
                                get_data.baris_data[i].nama_penyedia,
                                get_data.baris_data[i].nama_distributor,
                                get_data.baris_data[i].jumlah_produk,
                                get_data.baris_data[i].total_pagu,
                                get_data.baris_data[i].tanggal_buat
                            ];
        }
        
        jQuery(".epurchasing-data-paket-opd-table").DataTable({
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

        jQuery(".tbody-epurchasing-data-paket-opd-pertahun tr td").css("vertical-align", "middle");
    }
</script>