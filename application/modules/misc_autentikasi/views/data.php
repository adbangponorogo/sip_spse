<div class="row">
    <?php
        include_once 'table_users.php';
        include_once 'modal_register.php';
        include_once 'modal_security.php';
        include_once 'modal_edit.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Misc - Autentikasi");
    
    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });

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


    function get_notification(modal, type, qualified, msg){
        if (qualified == 'problem-value') {
            var get_message = "<p><strong>Peringatan !</strong> Inputan <b>"+msg+"</b> tidak boleh Kosong atau tidak memenuhi batas minimum jumlah karakter.</p>";
        }
        if (qualified == 'create-value') {
            var get_message = msg;
        }
        var create_msg =    "<div class='alert alert-"+type+" alert-dismissable'>"+
                                "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+
                                get_message+
                            "</div>";
        jQuery(".misc-autentikasi-users-"+modal+"-modal>.modal-dialog>.modal-content>form>.card-block").prepend(create_msg);
    }
</script>