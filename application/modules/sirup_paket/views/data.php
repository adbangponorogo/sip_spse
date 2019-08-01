<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'statistik_rekap.php';
        include_once 'rekapitulasi_paket.php';
        include_once 'paket_tender_seleksi.php';
        include_once 'rincian_paket.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Data SiRUP - Paket");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>