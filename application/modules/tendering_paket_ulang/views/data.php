<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'rekap_retendering.php';
        include_once 'data_retendering.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Paket Tendering - Data Paket Ulang");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>