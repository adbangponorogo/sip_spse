<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>
                DATA USERS&nbsp;
                <button class="btn btn-primary misc-autentikasi-register-modal-open-btn">
                    <i class="fa fa-plus"></i>&nbsp;Tambah Data
                </button>
            </h4>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="misc-autentikasi-data-users-table table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama</th>
                            <th width="20%">NIP</th>
                            <th width="15%">Email</th>
                            <th width="25%">Nama OPD</th>
                            <th width="10%">Tanggal Buat</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-misc-autentikasi-data-users"></tbody>
                    <tfoot class="tfoot-misc-autentikasi-data-users"></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //*****************************************************
    //*                                             
    //* Misc - Data Autentikasi
    //*                                             
    //*****************************************************
    create_misc_autentikasi_data_users();
    function refresh_misc_autentikasi_data_users(){
        create_misc_autentikasi_data_users();
    }

    function data_misc_autentikasi_data_users(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/autentikasi/data/data-users',
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

    function create_misc_autentikasi_data_users(){
        var get_data = data_misc_autentikasi_data_users();
        var data_baris = [];
        var data_total = [];
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data_baris[i] =  [
                                get_data.baris_data[i].no,
                                get_data.baris_data[i].nama,
                                get_data.baris_data[i].nip,
                                get_data.baris_data[i].email,
                                get_data.baris_data[i].nama_opd,
                                get_data.baris_data[i].tanggal_buat
                            ];
        }
        
        jQuery(".misc-autentikasi-data-users-table").DataTable({
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

        jQuery(".tbody-misc-autentikasi-data-users tr td").css("vertical-align", "middle");
    }




    jQuery(document).on("click", ".misc-autentikasi-register-modal-open-btn", function(){
        jQuery(".misc-autentikasi-users-register-modal").modal("show");
        return false;
    });

    jQuery(document).on("click", ".misc-autentikasi-security-modal-open-btn", function(){
        jQuery(".misc-autentikasi-security-input-id").val(jQuery(this).data("id"));
        jQuery(".misc-autentikasi-users-security-modal").modal("show");
        return false;
    });
</script>