<div class="row">
    <div class="col-md-4">
        <div class="card">
            <ul class="nav nav-tabs nav-stacked">
                <li class="active">
                    <a href="#misc-tentangkami-data-section1" data-toggle="tab">Tentang Kami</a>
                </li>
                <li>
                    <a href="#misc-tentangkami-data-section2" data-toggle="tab">Kontak Kami</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-block tab-content">
                <div class="tab-pane fade in active" id="misc-tentangkami-data-section1">
                    <h4 class="m-t-sm m-b">Info Umum</h4>
                    <div class="col-md-12">
                        <div class="row misc-tentangkami-data-generalinfo"></div>
                    </div>
                </div>
                <div class="tab-pane fade in" id="misc-tentangkami-data-section2">
                    <h4 class="m-t-sm m-b">Info Kontak</h4>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label>Telepon WA Admin</label>
                            <div class="input-group">
                                <input type="text" class="form-control misc-tentangkami-contactinfo-data-input-telpwa">
                                <span class="input-group-addon"><i class="ion-ipod"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label>Telepon Kantor</label>
                            <div class="input-group">
                                <input type="text" class="form-control misc-tentangkami-contactinfo-data-input-telpktr">
                                <span class="input-group-addon"><i class="ion-ios-telephone"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                            <div class="form-group row">
                                <label>Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control misc-tentangkami-contactinfo-data-input-email">
                                    <span class="input-group-addon"><i class="ion-social-googleplus"></i></span>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label>Alamat</label>
                            <textarea class="form-control misc-tentangkami-contactinfo-data-input-alamat" style="min-width: 100%;max-width: 100%;min-height: 100px;"></textarea>
                        </div>
                    </div>
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
    // ******************************************
    // ************* General Info ***************
    // ---------------- Get Data ----------------
    // ******************************************
    create_misc_tentangkami_generalinfo_profile();
    function refresh_misc_tentangkami_generalinfo_profile(){
        create_misc_tentangkami_generalinfo_profile();
    }

    function data_misc_tentangkami_generalinfo_profile(){
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

    function create_misc_tentangkami_generalinfo_profile(){
        var get_data = data_misc_tentangkami_generalinfo_profile();
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            jQuery(".misc-tentangkami-data-generalinfo").html(get_data.baris_data[i].description);
        }
    }



    // ******************************************
    // ************* Contact Info ***************
    // ---------------- Get Data ----------------
    // ******************************************
    create_misc_tentangkami_contactinfo_profile();
    function refresh_misc_tentangkami_contactinfo_profile(){
        create_misc_tentangkami_contactinfo_profile();
    }

    function data_misc_tentangkami_contactinfo_profile(){
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

    function create_misc_tentangkami_contactinfo_profile(){
        var get_data = data_misc_tentangkami_contactinfo_profile();
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            jQuery(".misc-tentangkami-contactinfo-data-input-telpwa").val(get_data.baris_data[i].telepon_wa);
            jQuery(".misc-tentangkami-contactinfo-data-input-telpktr").val(get_data.baris_data[i].telepon_kantor);
            jQuery(".misc-tentangkami-contactinfo-data-input-email").val(get_data.baris_data[i].email);
            jQuery(".misc-tentangkami-contactinfo-data-input-alamat").val(get_data.baris_data[i].alamat);
        }
    }
</script>