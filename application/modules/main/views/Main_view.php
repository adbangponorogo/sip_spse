<!DOCTYPE HTML>
<html lang="app-ui">
<head>
    <?php
        include_once 'lib/head.php';
        include_once 'lib/style.php';
    ?>    
</head>
<body class="app-ui layout-has-drawer layout-has-fixed-header">
    <div class="app-layout-canvas">
        <div class="app-layout-container">
            <?php
                include_once 'default/sidebar.php';
                include_once 'default/header.php';
            ?>
            <input type="hidden" class="app-tahun-input" value="<?php echo date('Y');?>">
            <main class="app-layout-content">
                <div class="container-fluid p-y-md app-content"></div>
            </main>
            <div class="app-ui-mask-modal"></div>
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


    
    jQuery(document).on("click", ".app-open-login-page", function(){
        location.href = '../auth/page/login';
        return false;
    });

    jQuery(document).on("click", ".app-auth-logout-btn", function(){
        destroy_autentikasi_data();
        return false;
    });
    function destroy_autentikasi_data(){
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../auth/process/logout',
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            check_status_autentikasi_data();
            location.href='../auth/page/login';
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
          url       : '../auth/process/status',
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            if (JSON.status == true) {
                var tipe_notif  = "info";
                var msg_notif   = "Sukses Melakukan Proses - Destroy Session Autentikasi!";
                show_notification(tipe_notif, msg_notif);
            }
          },
          error     : function(jqXHR, textStatus, errorThrown){
            location.href='';
          }
        });
    }
</script>