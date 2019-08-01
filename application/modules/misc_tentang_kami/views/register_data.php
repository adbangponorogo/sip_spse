<div class="row">
    <div class="col-md-4">
        <div class="card">
            <ul class="nav nav-tabs nav-stacked">
                <li class="active">
                    <a href="#misc-tentangkami-update-section1" data-toggle="tab">Tentang Kami</a>
                </li>
                <li>
                    <a href="#misc-tentangkami-update-section2" data-toggle="tab">Kontak Kami</a>
                </li>
                <li>
                    <a href="#misc-tentangkami-update-section3" data-toggle="tab">Info Privasi</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-block tab-content">
                <div class="tab-pane fade in active" id="misc-tentangkami-update-section1">
                    <form action="#" method="POST" class="fieldset misc-tentangkami-generalinfo-form-update">
                        <h4 class="m-t-sm m-b">Info Umum</h4>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Deskripsi</label>
                                <textarea name="description" class="misc-tentangkami-generalinfo-update-input-description" id="misc-tentangkami-generalinfo-update-input-description">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-xs-12">
                                <div class="row narrow-gutter">
                                    <button class="btn btn-app btn-block misc-tentangkami-generalinfo-update-btn">
                                        <i class="fa fa-upload"></i>&nbsp;Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade in" id="misc-tentangkami-update-section2">
                    <form action="#" method="POST" class="fieldset misc-tentangkami-contactinfo-form-update">
                        <h4 class="m-t-sm m-b">Info Kontak</h4>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Telepon WA Admin</label>
                                <div class="input-group">
                                    <input type="text" name="telepon_wa" class="form-control misc-tentangkami-contactinfo-update-input-telpwa">
                                    <span class="input-group-addon"><i class="ion-ipod"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Telepon Kantor</label>
                                <div class="input-group">
                                    <input type="text" name="telepon_kantor" class="form-control misc-tentangkami-contactinfo-update-input-telpktr">
                                    <span class="input-group-addon"><i class="ion-ios-telephone"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Email</label>
                                <div class="input-group">
                                    <input type="text" name="email" class="form-control misc-tentangkami-contactinfo-update-input-email">
                                    <span class="input-group-addon"><i class="ion-social-googleplus"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control misc-tentangkami-contactinfo-update-input-alamat" style="min-width: 100%;max-width: 100%;min-height: 100px;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-xs-12">
                                <div class="row narrow-gutter">
                                    <button class="btn btn-app btn-block misc-tentangkami-contactinfo-update-btn">
                                        <i class="fa fa-upload"></i>&nbsp;Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade in" id="misc-tentangkami-update-section3">
                    <form action="#" method="POST" class="fieldset misc-tentangkami-privacyinfo-form-update">
                        <h4 class="m-t-sm m-b">Info Privasi</h4>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Nama Kabupaten/Kota</label>
                                <input type="text" name="nama_kota" class="form-control misc-tentangkami-privacyinfo-update-input-namakota">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Admin APP</label>
                                <input type="text" name="nama_admin" class="form-control misc-tentangkami-privacyinfo-update-input-namaadmin">
                                <div class="input-group">
                                    <input type="text" name="url_admin" class="form-control misc-tentangkami-privacyinfo-update-input-urladmin">
                                    <span class="input-group-addon"><b>URL</b></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label>Kode Daerah - SiRUP</label>
                                <input type="text" name="kode_sirup" class="form-control misc-tentangkami-privacyinfo-update-input-kdsirup">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-xs-12">
                                <div class="row narrow-gutter">
                                    <button class="btn btn-app btn-block misc-tentangkami-privacyinfo-update-btn">
                                        <i class="fa fa-upload"></i>&nbsp;Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //*****************************************************
    //*                                             
    //* Misc - Tentang Kami
    //*                                             
    //*****************************************************
    jQuery(".misc-tentangkami-generalinfo-update-input-description").ckeditor();

    // ******************************************
    // ************* General Info ***************
    // ---------------- Get Data ----------------
    // ******************************************
    create_misc_tentangkami_generalinfo();
    function refresh_misc_tentangkami_generalinfo(){
        create_misc_tentangkami_generalinfo();
    }

    function data_misc_tentangkami_generalinfo(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tentang-kami/data/tentang-kami',
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

    function create_misc_tentangkami_generalinfo(){
        var get_data = data_misc_tentangkami_generalinfo();
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            jQuery(".misc-tentangkami-generalinfo-update-input-description").val(get_data.baris_data[i].description);
        }
    }




    // ******************************************
    // -------------- Update Data ---------------
    // ******************************************
    jQuery(document).on("click", ".misc-tentangkami-generalinfo-update-btn", function(){
        upload_misc_tentangkami_data_generalinfo();
        return false;
    });

    function upload_misc_tentangkami_data_generalinfo(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'POST',
          url       : '../misc/tentang-kami/update/tentang-kami',
          data      : jQuery(".misc-tentangkami-generalinfo-form-update").serialize(),
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                var tipe_notif  = "info";
                var msg_notif   = "Sukses Menyimpan Perubahan - General Info!";
                refresh_misc_tentangkami_generalinfo();
                show_notification(tipe_notif, msg_notif);
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }



    // ******************************************
    // ************* Contact Info ***************
    // ---------------- Get Data ----------------
    // ******************************************
    create_misc_tentangkami_contactinfo();
    function refresh_misc_tentangkami_contactinfo(){
        create_misc_tentangkami_contactinfo();
    }

    function data_misc_tentangkami_contactinfo(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tentang-kami/data/kontak-kami',
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

    function create_misc_tentangkami_contactinfo(){
        var get_data = data_misc_tentangkami_contactinfo();
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            jQuery(".misc-tentangkami-contactinfo-update-input-telpwa").val(get_data.baris_data[i].telepon_wa);
            jQuery(".misc-tentangkami-contactinfo-update-input-telpktr").val(get_data.baris_data[i].telepon_kantor);
            jQuery(".misc-tentangkami-contactinfo-update-input-email").val(get_data.baris_data[i].email);
            jQuery(".misc-tentangkami-contactinfo-update-input-alamat").val(get_data.baris_data[i].alamat);
        }
    }




    // ******************************************
    // -------------- Update Data ---------------
    // ******************************************
    jQuery(document).on("click", ".misc-tentangkami-contactinfo-update-btn", function(){
        upload_misc_tentangkami_data_contactinfo();
        return false;
    });

    function upload_misc_tentangkami_data_contactinfo(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'POST',
          url       : '../misc/tentang-kami/update/kontak-kami',
          data      : jQuery(".misc-tentangkami-contactinfo-form-update").serialize(),
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                var tipe_notif  = "info";
                var msg_notif   = "Sukses Menyimpan Perubahan - Info Kontak!";
                refresh_misc_tentangkami_contactinfo();
                show_notification(tipe_notif, msg_notif);
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }




    // ******************************************
    // ************* Info Privasi ***************
    // ---------------- Get Data ----------------
    // ******************************************
    create_misc_tentangkami_infoprivasi();
    function refresh_misc_tentangkami_infoprivasi(){
        create_misc_tentangkami_infoprivasi();
    }

    function data_misc_tentangkami_infoprivasi(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tentang-kami/data/info-privasi',
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

    function create_misc_tentangkami_infoprivasi(){
        var get_data = data_misc_tentangkami_infoprivasi();
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            jQuery(".misc-tentangkami-privacyinfo-update-input-namakota").val(get_data.baris_data[i].nama_kota);
            jQuery(".misc-tentangkami-privacyinfo-update-input-namaadmin").val(get_data.baris_data[i].nama_admin);
            jQuery(".misc-tentangkami-privacyinfo-update-input-urladmin").val(get_data.baris_data[i].url_admin);
            jQuery(".misc-tentangkami-privacyinfo-update-input-kdsirup").val(get_data.baris_data[i].kode_sirup);
        }
    }




    // ******************************************
    // -------------- Update Data ---------------
    // ******************************************
    jQuery(document).on("click", ".misc-tentangkami-privacyinfo-update-btn", function(){
        upload_misc_tentangkami_data_infoprivasi();
        return false;
    });

    function upload_misc_tentangkami_data_infoprivasi(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'POST',
          url       : '../misc/tentang-kami/update/info-privasi',
          data      : jQuery(".misc-tentangkami-privacyinfo-form-update").serialize(),
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                var tipe_notif  = "info";
                var msg_notif   = "Sukses Menyimpan Perubahan - Info Privasi!";
                refresh_misc_tentangkami_infoprivasi();
                show_notification(tipe_notif, msg_notif);
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
    }
</script>