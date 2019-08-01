<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'statistik_rekap.php';
        include_once 'lelang_pertahun.php';
        include_once 'metode_pertahun.php';
        include_once 'kelompok_pertahun.php';
        include_once 'agency_pertahun.php';
        include_once 'asal_pemenang_pertahun.php';
        include_once 'satuan_kerja.php';  
        include_once 'top_ten_tendering.php';  
        include_once 'top_ten_non_tendering.php';  
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Paket Tendering - E-Procurement");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>