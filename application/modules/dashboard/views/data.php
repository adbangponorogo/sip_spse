<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'statistik_rekap.php';
        include_once 'aktivitas_perencanaan_pbj.php';
        include_once 'aktivitas_pelaksanaan_pbj.php';
        include_once 'paket_eprocurement.php';
        include_once 'hasil_eprocurement.php';
        include_once 'paket_non_tender.php';
        include_once 'progres_tender_seleksi.php';
        include_once 'progres_aktivitas_pelaksanaan_pbj.php';
        include_once 'aktivitas_rekanan.php';
        include_once 'kategori_tender.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Halaman Utama");
    
    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>