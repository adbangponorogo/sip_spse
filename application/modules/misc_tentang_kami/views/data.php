<div class="row">
    <?php
        include_once 'header_page.php';
        if (empty($this->session->userdata('auth_id'))) {
        	include_once 'page_data.php';
        }
        else{
        	include_once 'register_data.php';
        }
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Misc - Tentang Kami");
    
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
</script>