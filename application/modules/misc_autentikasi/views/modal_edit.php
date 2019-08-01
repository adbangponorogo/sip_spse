<div class="modal fade misc-autentikasi-users-edit-modal" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: auto !important;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-green bg-inverse">
                <h4>Edit Data</h4>
                <ul class="card-actions">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                    </li>
                </ul>
            </div>
            <form action="#" method="POST" class="misc-autentikasi-users-form-edit">
                <div class="card-block"> 
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control misc-autentikasi-edit-input-nama">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control misc-autentikasi-edit-input-email">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control misc-autentikasi-edit-input-username">
                    </div>
                    <div class="form-group">
                        <label>Apakah anda akan merubah password ?</label>
                        <select name="qrespass" class="form-control misc-autentikasi-edit-input-qresetpass" style=";width: 100%;">
                            <option value="0" selected="selected">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-group misc-autentikasi-edit-fgroup-password hidden-show">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control misc-autentikasi-edit-input-password">
                            <span class="input-group-addon misc-autentikasi-edit-input-password-refunction" style="cursor: pointer;">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group misc-autentikasi-edit-fgroup-repassword hidden-show">
                        <label>Re-type Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control misc-autentikasi-edit-input-repassword">
                            <span class="input-group-addon misc-autentikasi-edit-input-repassword-refunction" style="cursor: pointer;">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>OPD</label>
                        <select name="opd" class="form-control misc-autentikasi-edit-input-opd" style="width: 100%;"></select>
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control misc-autentikasi-edit-input-nip">
                    </div>
                    <div class="form-group">
                        <label>Pertanyaan Keamanan</label>
                        <select name="security_quest" class="form-control misc-autentikasi-edit-input-tanya" style=";width: 100%;">
                            <option value="1">Apa jabatan anda saat anda mendaftar?</option>
                            <option value="2">Siapa nama Bupati yang menjabat saat anda mendaftar?</option>
                            <option value="3">Siapa nama Kepala Setda Bag. Adm. Pembangunan saat anda mendaftar?</option>
                            <option value="4">Siapa nama admin yang memperbolehkan anda mendaftar?</option>
                            <option value="5">Jika anda kehilangan akun, apa konsekuensi yang anda harapkan?</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jawaban Keamanan</label>
                        <input type="text" name="quest_answer" class="form-control misc-autentikasi-edit-input-jawab">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="pull-left">
                                <input type="hidden" name="token" class="misc-autentikasi-edit-input-id">
                                <button class="btn btn-primary misc-autentikasi-edit-modal-upload-btn">
                                    <i class="fa fa-upload"></i>&nbsp;Upload
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-danger misc-autentikasi-edit-modal-destroy-btn">
                                    <i class="fa fa-trash"></i>&nbsp;Hapus Akun Ini?
                                </button>
                                <button class="btn btn-danger misc-autentikasi-edit-modal-cancel-btn">
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
    // jQuery(".misc-autentikasi-edit-select2").select2({
    //     dropdownParent  : jQuery(".misc-autentikasi-users-edit-modal")
    // });

    create_misc_autentikasi_data_opd_edit();
    function refresh_misc_autentikasi_data_opd_edit(){
        create_misc_autentikasi_data_opd_edit();
    }

    function data_misc_autentikasi_data_opd_edit(){
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

    function create_misc_autentikasi_data_opd_edit(){
        var get_data = data_misc_autentikasi_data_opd_edit();
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            data += "<option value='"+get_data.baris_data[i].kd_skpd+"'>"+
                        "["+get_data.baris_data[i].kd_skpd+"] - "+get_data.baris_data[i].nama_opd+
                    "</option>";
        }
        jQuery(".misc-autentikasi-edit-input-opd").html(data);
        jQuery(".misc-autentikasi-edit-input-opd").val(jQuery(".misc-autentikasi-edit-input-opd option:first").val()).change();
    }

    jQuery(document).on("click", ".misc-autentikasi-edit-input-password-refunction", function(){
        jQuery(".misc-autentikasi-edit-input-password-refunction i").toggleClass("fa-eye-slash");
        var input_type = jQuery(".misc-autentikasi-edit-input-password").prop('type');
        if (input_type == 'password') {
            jQuery(".misc-autentikasi-edit-input-password").prop('type', 'text');
        }
        else{
            jQuery(".misc-autentikasi-edit-input-password").prop('type', 'password');
        }
        return false;
    });

    jQuery(document).on("click", ".misc-autentikasi-edit-input-repassword-refunction", function(){
        jQuery(".misc-autentikasi-edit-input-repassword-refunction i").toggleClass("fa-eye-slash");
        var input_type = jQuery(".misc-autentikasi-edit-input-repassword").prop('type');
        if (input_type == 'password') {
            jQuery(".misc-autentikasi-edit-input-repassword").prop('type', 'text');
        }
        else{
            jQuery(".misc-autentikasi-edit-input-repassword").prop('type', 'password');
        }
        return false;
    });



    // ******************************************
    // ---------------- Get Data ----------------
    // ******************************************
    function data_misc_autentikasi_data_users_edit(id){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/autentikasi/edit/data-users/'+id,
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

    function create_misc_autentikasi_data_users_edit(id){
        var get_data = data_misc_autentikasi_data_users_edit(id);
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            jQuery(".misc-autentikasi-edit-input-id").val(get_data.baris_data[i].id);
            jQuery(".misc-autentikasi-edit-input-nama").val(get_data.baris_data[i].nama);
            jQuery(".misc-autentikasi-edit-input-email").val(get_data.baris_data[i].email);
            jQuery(".misc-autentikasi-edit-input-username").val(get_data.baris_data[i].username);
            jQuery(".misc-autentikasi-edit-input-opd").val(get_data.baris_data[i].kd_skpd).change();
            jQuery(".misc-autentikasi-edit-input-nip").val(get_data.baris_data[i].nip);
            jQuery(".misc-autentikasi-edit-input-tanya").val(get_data.baris_data[i].security_quest).change();
            jQuery(".misc-autentikasi-edit-input-jawab").val(get_data.baris_data[i].security_answer);
        }

        jQuery(".misc-autentikasi-users-edit-modal").modal("show");
    }

    jQuery(document).on("change", ".misc-autentikasi-edit-input-qresetpass", function(){
        condition_misc_autentikasi_password(jQuery(this).val());
    });

    function condition_misc_autentikasi_password(condition){
        jQuery(".misc-autentikasi-edit-fgroup-password").removeClass("visible-show");
        jQuery(".misc-autentikasi-edit-fgroup-password").removeClass("hidden-show");
        jQuery(".misc-autentikasi-edit-fgroup-repassword").removeClass("visible-show");
        jQuery(".misc-autentikasi-edit-fgroup-repassword").removeClass("hidden-show");

        if (condition == 1) {
            jQuery(".misc-autentikasi-edit-fgroup-password").addClass("visible-show");
            jQuery(".misc-autentikasi-edit-fgroup-repassword").addClass("visible-show");
        }
        else{
            jQuery(".misc-autentikasi-edit-fgroup-password").addClass("hidden-show");
            jQuery(".misc-autentikasi-edit-fgroup-repassword").addClass("hidden-show");
        }
    }



    // ******************************************
    // ------------- Process Upload -------------
    // ******************************************
    jQuery(document).on("click", ".misc-autentikasi-edit-modal-upload-btn", function(){
        var id          = jQuery(".misc-autentikasi-edit-input-id");
        var nama        = jQuery(".misc-autentikasi-edit-input-nama");
        var email       = jQuery(".misc-autentikasi-edit-input-email");
        var username    = jQuery(".misc-autentikasi-edit-input-username");
        var qrespass    = jQuery(".misc-autentikasi-edit-input-qresetpass");
        var password    = jQuery(".misc-autentikasi-edit-input-password");
        var repassword  = jQuery(".misc-autentikasi-edit-input-repassword");
        var opd         = jQuery(".misc-autentikasi-edit-input-opd");
        var nip         = jQuery(".misc-autentikasi-edit-input-nip");
        var tanya       = jQuery(".misc-autentikasi-edit-input-tanya");
        var jawab       = jQuery(".misc-autentikasi-edit-input-jawab");

        if (nama.val() != ''&& nama.val().replace(/ /g,"").length >= 4) {
            if (email.val() != ''&& email.val().length >= 11) {
                if (nip.val() != '' && nip.val().replace(/ /g,"").length == 18) {
                    if (jawab.val() != '' && jawab.val().replace(/ /g,"").length >= 4) {
                        

                        if (qrespass.val() == 1) {
                            if (password.val() != '' && password.val().replace(/ /g,"").length >= 6) {
                                if (repassword.val() != '' && repassword.val().replace(/ /g,"").length >= 6) {
                                    if (password.val() == repassword.val()) {
                                        update_misc_autentikasi_data_users();
                                    }
                                    else{
                                        repassword.focus();
                                        get_notification('edit', 'danger', 'create-value', "<p><strong>Peringatan !</strong> Inputan <b>Password & Re-type Password</b> harus sama.</p>");
                                    }
                                }
                                else{
                                    repassword.focus();
                                    get_notification('edit', 'danger', 'problem-value', 'Re-type Password');
                                }
                            }
                            else{
                                password.focus();
                                get_notification('edit', 'danger', 'problem-value','Password');
                            }
                        }
                        else{
                            update_misc_autentikasi_data_users();
                        }



                    }
                    else{
                        jawab.focus();
                        get_notification('edit', 'danger', 'problem-value', 'Jawaban Keamanan');
                    }
                }
                else{
                    nip.focus();
                    get_notification('edit', 'danger', 'problem-value', 'NIP');
                }
            }
            else{
                email.focus();
                get_notification('edit', 'danger', 'problem-value','Email');
            }
        }
        else{
            nama.focus();
            get_notification('edit', 'danger', 'problem-value','Nama');
        }
        return false;
    });


    function update_misc_autentikasi_data_users(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'POST',
          url       : '../misc/autentikasi/update/data-users',
          data      : jQuery(".misc-autentikasi-users-form-edit").serialize(),
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                var tipe_notif  = "info";
                var msg_notif   = "Sukses Update Data - Users!";
                jQuery(".misc-autentikasi-users-form-edit")[0].reset();
                condition_misc_autentikasi_password(0);
                jQuery(".misc-autentikasi-users-edit-modal").modal("hide");
                create_misc_autentikasi_data_users();
                show_notification(tipe_notif, msg_notif);
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }





    // ******************************************
    // ------------- Process Destroy -------------
    // ******************************************

    jQuery(document).on("click", ".misc-autentikasi-edit-modal-destroy-btn", function(){
        if (confirm('Apakah anda yakin ingin menghapus akun ini?')) {
            delete_misc_autentikasi_data_users(jQuery(".misc-autentikasi-edit-input-id").val());
        }
        return false;
    });


    function delete_misc_autentikasi_data_users(id){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/autentikasi/delete/data-users/'+id,
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                var tipe_notif  = "info";
                var msg_notif   = "Sukses Hapus Data - Users!";
                jQuery(".misc-autentikasi-users-form-edit")[0].reset();
                condition_misc_autentikasi_password(0);
                jQuery(".misc-autentikasi-users-edit-modal").modal("hide");
                create_misc_autentikasi_data_users();
                show_notification(tipe_notif, msg_notif);
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }


    jQuery(document).on("click", ".misc-autentikasi-edit-modal-cancel-btn", function(){
        jQuery(".misc-autentikasi-users-edit-modal").modal("hide");
        return false;
    });
</script>