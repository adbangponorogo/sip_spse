<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'rekap_paket.php';
        include_once 'hasil_paket.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Paket Tendering - Daftar Paket OPD");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>