<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'rekap_tendering.php';
        include_once 'data_tendering.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Paket Non Tendering - Data Paket Ulang");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>