<div class="card card-profile">
	<div class="card-profile-img bg-img" style="background-image: url('<?=base_url()?>assets/uploads/photos/reog-sewandono.jpg'); background-position : top; background-attachment: fixed;">
   <div style="float: left;width: 100%;height: 100%;background: rgba(92, 184, 92, 0.55);"></div> 
  </div>
	<div class="card-block card-profile-block text-xs-center text-sm-left">
		<img class="img-avatar img-avatar-96" src="<?=base_url()?>assets/uploads/logo/reog-vector-icon.png" style="background: #44cc68;">
		<div class="profile-info font-500">
			<b class="misc-tentangkami-profile-namaadmin"></b>
			<div class="small text-muted m-t-xs misc-tentangkami-profile-email"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// ******************************************
    // ************* General Info ***************
    // ---------------- Get Data ----------------
    // ******************************************
    create_misc_tentangkami_profile();
    function refresh_misc_tentangkami_profile(){
        create_misc_tentangkami_profile();
    }

    function data_misc_tentangkami_profile(){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../misc/tentang-kami/data/profile',
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

    function create_misc_tentangkami_profile(){
        var get_data = data_misc_tentangkami_profile();
        var data_baris = [];
        var data_total = [];
        var data = "";
        for (var i = 0; i < get_data.baris_data.length; i++) {
            jQuery(".misc-tentangkami-profile-namaadmin").html(get_data.baris_data[i].nama_admin);
            jQuery(".misc-tentangkami-profile-email").html(get_data.baris_data[i].email);
        }
    }
</script>