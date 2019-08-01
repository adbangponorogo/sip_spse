<div class="modal fade misc-autentikasi-users-security-modal" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: auto !important;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-green bg-inverse">
                <h4>Security Data</h4>
                <ul class="card-actions">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                    </li>
                </ul>
            </div>
            <form action="#" method="POST" class="misc-autentikasi-users-form-security">
                <div class="card-block">
                    <div class="form-group">
                        <label>Pertanyaan Keamanan</label>
                        <select name="security_quest" class="form-control misc-autentikasi-security-input-tanya" style=";width: 100%;">
                            <option value="1">Apa jabatan anda saat anda mendaftar?</option>
                            <option value="2">Siapa nama Bupati yang menjabat saat anda mendaftar?</option>
                            <option value="3">Siapa nama Kepala Setda Bag. Adm. Pembangunan saat anda mendaftar?</option>
                            <option value="4">Siapa nama admin yang memperbolehkan anda mendaftar?</option>
                            <option value="5">Jika anda kehilangan akun, apa konsekuensi yang anda harapkan?</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jawaban Keamanan</label>
                        <input type="text" name="quest_answer" class="form-control misc-autentikasi-security-input-jawab">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="pull-left">
                                <input type="hidden" name="token" class="misc-autentikasi-security-input-id">
                                <button class="btn btn-primary misc-autentikasi-security-modal-upload-btn">
                                    <i class="fa fa-upload"></i>&nbsp;Check
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-danger misc-autentikasi-security-modal-cancel-btn">
                                    <i class="fa fa-close"></i>&nbsp;Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    //*****************************************************
    //*                                             
    //* Misc - Data Autentikasi
    //*                                             
    //*****************************************************
    // jQuery(".misc-autentikasi-security-select2").select2({
    //     dropdownParent  : jQuery(".misc-autentikasi-users-security-modal")
    // });

    jQuery(document).on("click", ".misc-autentikasi-security-modal-upload-btn", function(){
        upload_misc_autentikasi_security_data_users();
        return false;
    });

    jQuery(document).on("click", ".misc-autentikasi-security-modal-cancel-btn", function(){
        jQuery(".misc-autentikasi-users-security-modal").modal("hide");
        return false;
    });


    function upload_misc_autentikasi_security_data_users(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'POST',
          url       : '../misc/autentikasi/edit/data-users',
          data      : jQuery(".misc-autentikasi-users-form-security").serialize(),
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == false) {
                var tipe_notif  = "danger";
                var msg_notif   = "Gagal Autentikasi Data - Users!";
                get_notification('security', tipe_notif, 'create-value', "<p><strong>Peringatan !</strong> "+msg_notif+"</p>");
            }
            else{
                var id = jQuery(".misc-autentikasi-security-input-id").val();
                jQuery(".misc-autentikasi-users-form-security")[0].reset();
                jQuery(".misc-autentikasi-users-security-modal").modal("hide");
                create_misc_autentikasi_data_users_edit(id);
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }
</script>