<div class="modal fade misc-autentikasi-users-register-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-green bg-inverse">
                <h4>Register Data</h4>
                <ul class="card-actions">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                    </li>
                </ul>
            </div>
            <form action="#" method="POST" class="misc-autentikasi-users-form-register">
                <div class="card-block"> 
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control misc-autentikasi-register-input-nama">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control misc-autentikasi-register-input-email">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control misc-autentikasi-register-input-username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control misc-autentikasi-register-input-password">
                            <span class="input-group-addon misc-autentikasi-register-input-password-refunction" style="cursor: pointer;">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Re-type Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control misc-autentikasi-register-input-repassword">
                            <span class="input-group-addon misc-autentikasi-register-input-repassword-refunction" style="cursor: pointer;">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>OPD</label>
                        <select name="opd" class="form-control misc-autentikasi-register-input-opd" style="width: 100%;"></select>
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control misc-autentikasi-register-input-nip">
                    </div>
                    <div class="form-group">
                        <label>Pertanyaan Keamanan</label>
                        <select name="security_quest" class="form-control misc-autentikasi-register-input-tanya" style=";width: 100%;">
                            <option value="1">Apa jabatan anda saat anda mendaftar?</option>
                            <option value="2">Siapa nama Bupati yang menjabat saat anda mendaftar?</option>
                            <option value="3">Siapa nama Kepala Setda Bag. Adm. Pembangunan saat anda mendaftar?</option>
                            <option value="4">Siapa nama admin yang memperbolehkan anda mendaftar?</option>
                            <option value="5">Jika anda kehilangan akun, apa konsekuensi yang anda harapkan?</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jawaban Keamanan</label>
                        <input type="text" name="quest_answer" class="form-control misc-autentikasi-register-input-jawab">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="pull-left">
                                <button class="btn btn-primary misc-autentikasi-register-modal-upload-btn">
                                    <i class="fa fa-upload"></i>&nbsp;Upload
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-danger misc-autentikasi-register-modal-cancel-btn">
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
    // jQuery(".misc-autentikasi-register-select2").select2({
    //     dropdownParent  : jQuery(".misc-autentikasi-users-register-modal")
    // });

    create_misc_autentikasi_data_opd_register();
    function refresh_misc_autentikasi_data_opd_register(){
        create_misc_autentikasi_data_opd_register();
    }

    function data_misc_autentikasi_data_opd_register(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/autentikasi/data/data-opd',
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

    function create_misc_autentikasi_data_opd_register(){
        var get_data = data_misc_autentikasi_data_opd_register();
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data += "<option value='"+get_data.baris_data[i].kd_skpd+"'>"+
                        "["+get_data.baris_data[i].kd_skpd+"] - "+get_data.baris_data[i].nama_opd+
                    "</option>";
        }
        jQuery(".misc-autentikasi-register-input-opd").html(data);
        jQuery(".misc-autentikasi-register-input-opd").val(jQuery(".misc-autentikasi-register-input-opd option:first").val()).change();
    }

    jQuery(document).on("click", ".misc-autentikasi-register-input-password-refunction", function(){
        jQuery(".misc-autentikasi-register-input-password-refunction i").toggleClass("fa-eye-slash");
        var input_type = jQuery(".misc-autentikasi-register-input-password").prop('type');
        if (input_type == 'password') {
            jQuery(".misc-autentikasi-register-input-password").prop('type', 'text');
        }
        else{
            jQuery(".misc-autentikasi-register-input-password").prop('type', 'password');
        }
        return false;
    });

    jQuery(document).on("click", ".misc-autentikasi-register-input-repassword-refunction", function(){
        jQuery(".misc-autentikasi-register-input-repassword-refunction i").toggleClass("fa-eye-slash");
        var input_type = jQuery(".misc-autentikasi-register-input-repassword").prop('type');
        if (input_type == 'password') {
            jQuery(".misc-autentikasi-register-input-repassword").prop('type', 'text');
        }
        else{
            jQuery(".misc-autentikasi-register-input-repassword").prop('type', 'password');
        }
        return false;
    });




    // ******************************************
    // ------------- Process Upload -------------
    // ******************************************
    jQuery(document).on("click", ".misc-autentikasi-register-modal-upload-btn", function(){
        var nama        = jQuery(".misc-autentikasi-register-input-nama");
        var email       = jQuery(".misc-autentikasi-register-input-email");
        var username    = jQuery(".misc-autentikasi-register-input-username");
        var password    = jQuery(".misc-autentikasi-register-input-password");
        var repassword  = jQuery(".misc-autentikasi-register-input-repassword");
        var opd         = jQuery(".misc-autentikasi-register-input-opd");
        var nip         = jQuery(".misc-autentikasi-register-input-nip");
        var tanya       = jQuery(".misc-autentikasi-register-input-tanya");
        var jawab       = jQuery(".misc-autentikasi-register-input-jawab");

        if (nama.val() != ''&& nama.val().replace(/ /g,"").length >= 4) {
            if (email.val() != ''&& email.val().length >= 11) {
                if (username.val() != '' && username.val().replace(/ /g,"").length >= 4) {
                    if (password.val() != '' && password.val().replace(/ /g,"").length >= 6) {
                        if (repassword.val() != '' && repassword.val().replace(/ /g,"").length >= 6) {
                            if (password.val() == repassword.val()) {
                                if (nip.val() != '' && nip.val().replace(/ /g,"").length == 18) {
                                    if (jawab.val() != '' && jawab.val().replace(/ /g,"").length >= 4) {
                                        upload_misc_autentikasi_data_users();

                                    }
                                    else{
                                        jawab.focus();
                                        get_notification('register', 'danger', 'problem-value', 'Jawaban Keamanan');
                                    }
                                }
                                else{
                                    nip.focus();
                                    get_notification('register', 'danger', 'problem-value', 'NIP');
                                }
                            }
                            else{
                                repassword.focus();
                                get_notification('register', 'danger', 'create-value', "<p><strong>Peringatan !</strong> Inputan <b>Password & Re-type Password</b> harus sama.</p>");
                            }
                        }
                        else{
                            repassword.focus();
                            get_notification('register', 'danger', 'problem-value', 'Re-type Password');
                        }
                    }
                    else{
                        password.focus();
                        get_notification('register', 'danger', 'problem-value','Password');
                    }
                }
                else{
                    username.focus();
                    get_notification('register', 'danger', 'problem-value','Username');
                }
            }
            else{
                email.focus();
                get_notification('register', 'danger', 'problem-value','Email');
            }
        }
        else{
            nama.focus();
            get_notification('register', 'danger', 'problem-value','Nama');
        }
        return false;
    });


    function upload_misc_autentikasi_data_users(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'POST',
          url       : '../misc/autentikasi/insert/data-users',
          data      : jQuery(".misc-autentikasi-users-form-register").serialize(),
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                var tipe_notif  = "info";
                var msg_notif   = "Sukses Tambah Data - Users!";
                jQuery(".misc-autentikasi-users-form-register")[0].reset();
                create_misc_autentikasi_data_users();
                jQuery(".misc-autentikasi-users-register-modal").modal("hide");
                show_notification(tipe_notif, msg_notif);
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }

    jQuery(document).on("click", ".misc-autentikasi-register-modal-cancel-btn", function(){
        jQuery(".misc-autentikasi-users-register-modal").modal("hide");
        return false;
    });
</script>