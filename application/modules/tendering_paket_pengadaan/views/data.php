<div class="row">
    <?php
        include_once 'pencarian_data.php'; 
        include_once 'sistem_tendering.php'; 
        include_once 'partisipasi_penawaran.php'; 
        include_once 'partisipasi_rekanan.php'; 
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Paket Tendering - Data Paket Pengadaan");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>