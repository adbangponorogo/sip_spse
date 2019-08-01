<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA PAKET MELALUI SISTEM TENDERING</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="tendering-paketpengadaan-sistem-tendering-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">ID</th>
                            <th width="20%">Nama OPD</th>
                            <th>Nama Paket</th>
                            <th>HPS (Rp.)</th>
                            <th>Pemenang</th>
                            <th>Alamat</th>
                            <th>Penawaran</th>
                            <th>Efisiensi (Rp)</th>
                            <th width="5%">Prosentase (%)</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-paket-tendering-paketpengadaan-sistem-tendering-pertahun"></tbody>
                    <tfoot class="tfoot-paket-tendering-paketpengadaan-sistem-tendering-pertahun"></tfoot>
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
    create_tendering_paketpengadaan_sistem_tender_pertahun(
                                                    jQuery(".tender-paketpengadaan-pencarian-data-tahun").val(),
                                                    jQuery(".tender-paketpengadaan-pencarian-data-nama-satker").val()
                                                );
    function refresh_tendering_paketpengadaan_sistem_tender_pertahun(tahun, satker){
        create_tendering_paketpengadaan_sistem_tender_pertahun(tahun, satker);
    }

    function data_tendering_paketpengadaan_sistem_tender_pertahun(tahun, satker){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../paket-tendering/data-pengadaan/data/sistem-tender/'+tahun+'/'+satker,
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

    function create_tendering_paketpengadaan_sistem_tender_pertahun(tahun, satker){
        var get_data = data_tendering_paketpengadaan_sistem_tender_pertahun(tahun, satker);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].id,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].nama_paket,
                                get_data.baris_data[i].hps,
                                get_data.baris_data[i].pemenang,
                                get_data.baris_data[i].alamat,
                                get_data.baris_data[i].penawaran,
                                get_data.baris_data[i].efisiensi,
                                get_data.baris_data[i].prosentase,
                            ];
        }
        
        jQuery(".tendering-paketpengadaan-sistem-tendering-table").DataTable({
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

        // jQuery(".tbody-paket-tendering-paketpengadaan-sistem-tendering-pertahun tr").first().css("text-align", "center");
        jQuery(".tbody-paket-tendering-paketpengadaan-sistem-tendering-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='4'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].hps+"</th>"+
                                "<th></th>"+
                                "<th></th>"+
                                "<th>"+get_data.total_data[j].penawaran+"</th>"+
                                "<th>"+get_data.total_data[j].efisiensi+"</th>"+
                                "<th>"+get_data.total_data[j].prosentase+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-paket-tendering-paketpengadaan-sistem-tendering-pertahun").html(data_total);
        jQuery(".tfoot-paket-tendering-paketpengadaan-sistem-tendering-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-paket-tendering-paketpengadaan-sistem-tendering-pertahun tr th").css("vertical-align", "middle");
    }
</script>