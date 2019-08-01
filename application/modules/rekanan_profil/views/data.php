<div class="row">
    <?php
        include_once 'pencarian_data.php';
        include_once 'rekanan_provinsi.php';
        include_once 'rekanan_kabupaten.php';
        include_once 'kelompok_usaha_kabupaten.php';
    ?>
    
</div>


<script type="text/javascript">
    jQuery(".navbar-page-title").html("Data Rekanan - Profil Rekanan");

    // Initialize Bootstrap Tabs
    jQuery( '[data-toggle="tabs"] a, .js-tabs a' ).click( function(e) {
        e.preventDefault();
        jQuery( this ).tab( 'show' );
    });
</script>