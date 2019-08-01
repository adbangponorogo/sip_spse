<!-- Drawer -->
<aside class="app-layout-drawer">

    <!-- Drawer scroll area -->
    <div class="app-layout-drawer-scroll">

        <!-- Drawer logo -->
        <div id="logo" class="drawer-header">
            <a href="index.html">
                <img class="img-responsive" src="<?=base_url('assets/uploads/logo/logo.png')?>" title="SIP SPSE!" alt="SIP SPSE!" style="width: 200px;height: 40px;margin: 10px; margin-bottom: 0px;">
            </a>
        </div>

        <!-- Drawer navigation -->
        <nav class="drawer-main">
            <ul class="nav nav-drawer">
                <li class="nav-item nav-drawer-header">Apps</li>
                <li class="nav-item active">
                    <a href="#" class="open-dashboard"><i class="fa fa-home"></i>&nbsp;Halaman Utama</a>
                </li>

                <li class="nav-item nav-drawer-header">Data Reporting</li>
                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="fa fa-database"></i>&nbsp;Paket Tendering</a>
                    <ul class="nav nav-subnav">
                        <li><a href="#" class="open-paket-tendering-eprocurement">E-Procurement</a></li>
                        <li><a href="#" class="open-paket-tendering-paketpengadaan">Data Paket Pengadaan</a></li>
                        <li><a href="#" class="open-paket-tendering-paketopd">Daftar Paket OPD</a></li>
                        <li><a href="#" class="open-paket-tendering-kontrakopd">Data Kontrak OPD</a></li>
                        <li><a href="#" class="open-paket-tendering-paketulang">Daftar Paket Ulang</a></li>
                        <li><a href="#" class="open-paket-tendering-paketgagal">Daftar Paket Gagal</a></li>
                        <li><a href="#" class="open-paket-tendering-progrespbj">Progres PBJ</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="fa fa-database"></i>&nbsp;Paket Non-Tendering</a>
                    <ul class="nav nav-subnav">
                        <li><a href="#" class="open-paket-nontendering-paketpengadaan">Paket Pengadaan</a></li>
                        <li><a href="#" class="open-paket-nontendering-paketopd">Daftar Paket OPD</a></li>
                        <li><a href="#" class="open-paket-nontendering-kontrakopd">Data Kontrak OPD</a></li>
                        <li><a href="#" class="open-paket-nontendering-paketulang">Daftar Paket Ulang</a></li>
                        <li><a href="#" class="open-paket-nontendering-paketgagal">Daftar Paket Gagal</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="fa fa-database"></i>&nbsp;Data Paket SiRUP</a>
                    <ul class="nav nav-subnav">
                        <li><a href="#" class="open-sirup-rekapitulasi-sirup">Rekapitulasi SiRUP</a></li>
                        <li><a href="#" class="open-sirup-paket-sirup">Paket SiRUP</a></li>
                        <li><a href="#" class="open-sirup-data-sirup">Data SiRUP</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="fa fa-database"></i>&nbsp;Data Paket E-Purchasing</a>
                    <ul class="nav nav-subnav">
                        <li><a href="#" class="open-epurchasing-data">E-Katalog</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-subnav">
                    <a href="javascript:void(0)"><i class="fa fa-database"></i>&nbsp;Rekanan</a>
                    <ul class="nav nav-subnav">
                        <li><a href="#" class="open-rekanan-profil-data">Profil</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-drawer-header">Misc</li>
                <li class="nav-item active">
                    <a href="#" class="open-misc-tentangkami"><i class="fa fa-users"></i>&nbsp;Tentang Kami</a>
                </li>
                <?php
                    if (!empty($this->session->userdata('auth_id'))) {
                ?>
                        <li class="nav-item active">
                            <a href="#" class="open-misc-autentikasi"><i class="fa fa-eye"></i>&nbsp;Data Autentikasi</a>
                        </li>
                        <li class="nav-item active">
                            <a href="#" class="open-misc-tarik-data"><i class="fa fa-cloud-download"></i>&nbsp;Tarik Data</a>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </nav>

        <!-- End drawer navigation -->
        <?php
            include_once 'footer.php';
        ?>

    </div>
    <!-- End drawer scroll area -->
</aside>
<!-- End drawer -->