<!DOCTYPE HTML>
<html lang="app-ui">
<head>
    <?php
        include_once 'lib/head.php';
        include_once 'lib/style.php';
    ?>    
</head>
<body class="app-ui">
    <div class="app-layout-canvas">
        <div class="app-layout-container">
            <main class="app-layout-content">
                <div class="p-y-lg b-t text-center">
                    <h2 class="h1 display-2"><a href="<?=base_url()?>">SIP SPSE !</a></h2>
                    <p class="lead">Silahkan masukkan username dan password anda untuk proses login.</p>
                    <div class="row text-left">
                        <div class="col-md-6 col-md-offset-3">
                            <form action="#" method="POST" class="m-t-sm m-b-s app-authentication-form">
                                <div class="form-group">
                                    <label>Username</label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control auth-input-username">
                                        <span class="input-group-addon" style="cursor: pointer;">
                                            <i class="fa fa-envelope-o"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control auth-input-password">
                                        <span class="input-group-addon auth-input-password-refunction" style="cursor: pointer;">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-app btn-block auth-login-btn" type="submit">Proses Autentikasi</button>
                                </div>
                                <span class="help-block">2019 @ SIP SPSE <?php echo $misc['nama_admin'];?></span>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
    <?php
        include_once 'lib/js.php';
    ?>
</html>

<script type="text/javascript">
    function show_notification(notif_type, notif_msg){
        jQuery.notify({
                icon: '',
                message: notif_msg,
                url: ''
            }, {
                element: 'body',
                type: notif_type,
                allow_dismiss: true,
                newest_on_top: true,
                showProgressbar: false,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                animate: {
                    enter: 'animated fadeIn',
                    exit: 'animated fadeOutDown'
            }
        });
    }

    jQuery(document).on("click", ".auth-input-password-refunction", function(){
        jQuery(".auth-input-password-refunction i").toggleClass("fa-eye-slash");
        var input_type = jQuery(".auth-input-password").prop('type');
        if (input_type == 'password') {
            jQuery(".auth-input-password").prop('type', 'text');
        }
        else{
            jQuery(".auth-input-password").prop('type', 'password');
        }
        return false;
    });

    jQuery(document).on("click", ".auth-login-btn", function(){
        var username = jQuery(".auth-input-username");
        var password = jQuery(".auth-input-password");

        if (username.val() != '') {
            if (password.val() != '') {
                upload_autentikasi_data();
            }
            else{
                var tipe_notif  = "danger";
                var msg_notif   = "Inputan Tidak Boleh Kosong - Password !";
                show_notification(tipe_notif, msg_notif);
                password.focus();
            }
        }
        else{
            var tipe_notif  = "danger";
            var msg_notif   = "Inputan Tidak Boleh Kosong - Username !";
            show_notification(tipe_notif, msg_notif);
            username.focus();
        }
        return false;
    });


    function upload_autentikasi_data(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'POST',
          url       : '../../auth/process/login',
          data      : jQuery(".app-authentication-form").serialize(),
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                check_status_autentikasi_data();
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            location.href='';
          }
        });
    }

    function check_status_autentikasi_data(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../../auth/process/status',
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                var tipe_notif  = "info";
                var msg_notif   = "Sukses Melakukan Proses - Autentikasi!";
                jQuery(".app-authentication-form")[0].reset();
                show_notification(tipe_notif, msg_notif);

                location.href='../../app/main';
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            location.href='';
          }
        });
    }
</script>