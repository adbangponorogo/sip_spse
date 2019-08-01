<!-- Header -->
<header class="app-layout-header">

    <nav class="navbar navbar-default">

        <div class="container-fluid">
            
            <div class="navbar-header">
                <button class="pull-left hidden-lg hidden-md navbar-toggle" type="button" data-toggle="layout" data-action="sidebar_toggle">
                    <span class="sr-only">Toggle drawer</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-page-title"></span>
            </div>
            <div class="collapse navbar-collapse" id="header-navbar-collapse">
                <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">
                    <li class="dropdown dropdown-profile">
                        <a href="javascript:void(0)" data-toggle="dropdown">
                            <span class="m-r-sm">Data Log&nbsp;<span class="caret"></span></span>
                            <img class="img-avatar img-avatar-48" src="<?=base_url('assets/uploads/avatars/finger.png')?>" alt="Authentication" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <?php
                                if ($this->session->userdata('auth_id') == ''){
                            ?>
                                <li><a href="#" class="app-open-login-page">Masuk</a></li>
                            <?php
                                }
                                else{
                            ?>
                                <li><a href="#"  class="app-auth-logout-btn">Keluar</a></li>
                            <?php
                                }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        
        </div>
        <!-- .container-fluid -->

    </nav>
    <!-- .navbar-default -->

</header>
<!-- End header -->