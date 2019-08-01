<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'statistik_rekap.php';
        include_once 'perencanaan_belanja.php';
        include_once 'analisis_rup.php';
        include_once 'perencanaan_rup.php';
        include_once 'progres_identifikasi.php';
        include_once 'data_rup.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Data SiRUP - Rekapitulasi");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>