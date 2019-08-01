<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'statistik_rekap.php';
        include_once 'kontrak_opd.php';
        include_once 'paket_kontrak.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Paket Tendering - Data Kontrak OPD");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>