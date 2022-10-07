<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>i.Cater</title>
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url('assets/favicon.ico')?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url() ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="<?=base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url() ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url() ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url() ?>assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url() ?>assets/css/themes/theme-red.css" rel="stylesheet" />

    <!-- material icons css -->
    <link href="<?=base_url() ?>assets/plugins/material-design-icons-master/iconfont/material-icons.css" rel="stylesheet">

    <link href="<?=base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <?php if(!empty($page_css)): ?>
    <?php foreach($page_css as $css): ?>
    
    <link href="<?=$css ?>" rel="stylesheet">
    <?php endforeach;?>
    <?php endif;?>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand font-bold" href="javascript:void(0);">i.Cater</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right m-r-0">
                    <li>
                        <a href="<?=base_url()?>">
                            <span class="text-uppercase">Home</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle show-on-hover" data-toggle="dropdown">
                            <span class="text-uppercase">Categories</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu"> 
                            <?php foreach(categories() as $type => $label) {?>

                            <li><a href="<?=base_url()?>Booking/index/<?=$type?>"><?=$label->name?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <!-- Settings -->
                    <li class="dropdown pull-right">
                        <a href="javascript:void(0);" class="dropdown-toggle js-right-sidebar" data-toggle="dropdown" role="button">
                            <i class="material-icons">account_circle</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url()?>account"><i class="material-icons">person</i>My Account</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?=base_url()?>Login/sign_out"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </li>
                    <!-- #END# Settings -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <?php $user = get_user_data(); ?>
            <div class="user-info p-t-0 p-b-0">
                <div class="info-container">
                    <div class="image" style="display:inline-block">
                        <img class="profile-picture" src="<?=$user['avatar']?>" width="48" height="48" alt="User" />
                
                    </div>
                    <div style="display:inline-block">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$user['username']?></div>
                        <div class="email"><?=$user['email']?></div>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <?php if ($user['type'] == -1 || $user['type'] == 0) { // super?>
                    
                    <?php if ($user['type'] == -1) { // admin/asst. manager?>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'account_list') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>account/alist">
                            <i class="material-icons">supervisor_account</i>
                            <span>Accounts</span>
                        </a>
                    </li>

                    <li class="<?php if (isset($nav_active) && $nav_active == 'categories') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>categories/alist">
                            <i class="material-icons">list</i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_list') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/alist">
                            <i class="material-icons">card_giftcard</i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_requests') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/requests">
                            <i class="material-icons">shopping_basket</i>
                            <span>Seller’s Product Requests</span>
                        </a>
                    </li>
                    <!-- <li class="header">SERVICES</li> -->
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_ordered') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/ordered">
                            <i class="material-icons">shopping_cart</i>
                            <span>Ordered Services</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_cancelled') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/cancelled">
                            <i class="material-icons">remove_shopping_cart</i>
                            <span>Cancelled Services</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_booked') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/booked">
                            <i class="material-icons">add_shopping_cart</i>
                            <span>Booking Section</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'messages') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>messages">
                            <i class="material-icons">live_help</i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if ($user['type'] == 1) { // seller?>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_list') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/alist">
                            <i class="material-icons">shopping_basket</i>
                            <span>My Product Requests</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_booked') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/booked">
                            <i class="material-icons">shopping_cart</i>
                            <span>My Services</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if ($user['type'] == 2) { // customer?>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_ordered') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/ordered">
                            <i class="material-icons">shopping_cart</i>
                            <span>My Booked Services</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'product_cancelled') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>product/cancelled">
                            <i class="material-icons">remove_shopping_cart</i>
                            <span>My Ordered Services</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'messages') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>messages">
                            <i class="material-icons">live_help</i>
                            <span>Customer Service</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2 class="text-uppercase"><?php
                    echo (isset($page_title)) ? $page_title : '';
                ?></h2>
            </div>

            <!-- Body -->
            <?php
            echo (isset($body)) ? $body : '';
            ?>
            <!-- #END# Body -->

        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?=base_url() ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=base_url() ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?=base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?=base_url() ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url() ?>assets/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?=base_url() ?>assets/js/admin.js"></script>

    
    <script src="<?=base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?=base_url() ?>assets/plugins/axios.min.js"></script>
    <script src="<?=base_url() ?>assets/js/helpers.js"></script>
    
    <script>
        var base_url = "<?=base_url() ?>";

    </script>

    <?php if(!empty($page_js)): ?>
    <?php foreach($page_js as $js): ?>
    
    <script src="<?=$js ?>"></script>
    <?php endforeach;?>
    <?php endif;?>

    <!-- Demo Js -->
    <script src="<?=base_url() ?>assets/js/demo.js"></script>
    <script src="<?=base_url() ?>assets/js/afterall.js"></script>
</body>

</html>