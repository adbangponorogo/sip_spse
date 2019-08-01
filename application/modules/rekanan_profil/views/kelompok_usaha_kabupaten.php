<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>DATA KELOMPOK USAHA REKANAN KABUPATEN</h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="rekanan-profil-kelompok-usaha-kabupaten-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="30%">Kabupaten</th>
                            <th width="5%">CV</th>
                            <th width="5%">PT</th>
                            <th width="5%">UD</th>
                            <th width="10%">KOPERASI</th>
                            <th width="5%">PD</th>
                            <th width="5%">Kecil</th>
                            <th width="10%">Non Kecil</th>
                            <th width="10%">Gabungan</th>
                            <th width="10%">Belum Pilih</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-rekanan-profil-kelompok-usaha-kabupaten-pertahun"></tbody>
                    <tfoot class="tfoot-rekanan-profil-kelompok-usaha-kabupaten-pertahun"></tfoot>
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
    create_rekanan_profil_kelompok_usaha_kabupaten(
                                                    jQuery(".rekanan-profil-pencarian-data-tahun").val()
                                                );
    function refresh_rekanan_profil_kelompok_usaha_kabupaten(tahun){
        create_rekanan_profil_kelompok_usaha_kabupaten(tahun);
    }

    function data_rekanan_profil_kelompok_usaha_kabupaten(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../rekanan/profil/data/kelompok-usaha-kabupaten/'+tahun,
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

    function create_rekanan_profil_kelompok_usaha_kabupaten(tahun){
        var get_data = data_rekanan_profil_kelompok_usaha_kabupaten(tahun);
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama_kabupaten,
                                get_data.baris_data[i].cv,
                                get_data.baris_data[i].pt,
                                get_data.baris_data[i].ud,
                                get_data.baris_data[i].kop,
                                get_data.baris_data[i].pd,
                                get_data.baris_data[i].kecil,
                                get_data.baris_data[i].non,
                                get_data.baris_data[i].gab,
                                get_data.baris_data[i].blm,
                            ];
        }
        
        jQuery(".rekanan-profil-kelompok-usaha-kabupaten-table").DataTable({
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

        jQuery(".tbody-rekanan-profil-kelompok-usaha-kabupaten-pertahun tr td").css("vertical-align", "middle");

        for (var j = 0; j < get_data.total_data.length; j++) {
            data_total +=   "<tr>"+
                                "<th colspan='2'>Jumlah</th>"+
                                "<th>"+get_data.total_data[j].cv+"</th>"+
                                "<th>"+get_data.total_data[j].pt+"</th>"+
                                "<th>"+get_data.total_data[j].ud+"</th>"+
                                "<th>"+get_data.total_data[j].kop+"</th>"+
                                "<th>"+get_data.total_data[j].pd+"</th>"+
                                "<th>"+get_data.total_data[j].kecil+"</th>"+
                                "<th>"+get_data.total_data[j].non+"</th>"+
                                "<th>"+get_data.total_data[j].gab+"</th>"+
                                "<th>"+get_data.total_data[j].blm+"</th>"+
                            "</tr>";
        }
        jQuery(".tfoot-rekanan-profil-kelompok-usaha-kabupaten-pertahun").html(data_total);
        jQuery(".tfoot-rekanan-profil-kelompok-usaha-kabupaten-pertahun tr th").css("text-align", "center");
        jQuery(".tfoot-rekanan-profil-kelompok-usaha-kabupaten-pertahun tr th").css("vertical-align", "middle");
    }
</script>