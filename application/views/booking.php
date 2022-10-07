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
    <style>
    html {
        height: 100%;
        height: 100vh;
    }
    .navbar .btn:hover {
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.16), 0 5px 20px rgba(0, 0, 0, 0.12);
    }
    .booking section.content {
        margin-left: 0!important;
    }
    </style>
</head>

<body class="theme-red Is-closed bg-white booking" style="position: relative;">
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
                <a class="navbar-brand font-bold m-l-0" href="javascript:void(0);">i.Cater</a>
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
                    
                    <?php if (not_logged_in()) { ?>
                    <li>
                        <a href="<?=base_url()?>Booking/sign_in" class="btn btn-default waves-effect p-r-20 p-l-20 p-t-5 p-b-5 col-black">
                            <i class="material-icons" style="vertical-align: baseline">account_circle</i>
                            <span class="text-uppercase col-black"> Sign In</span>
                        </a>
                    </li>
                    <?php } else { ?>
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
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

    <!-- Body -->
    <?php
    echo (isset($body)) ? $body : '';
    ?>
    <!-- #END# Body -->
    
    
    <footer style="background: #ccc; border-bottom: 20px solid #000;">
        <?php if (not_logged_in() && !isset($hide_register)) { ?>
        <section style="background: rgba(0, 0, 0, .5)">
            <div class="container text-center p-t-50 p-b-50">
                <div class="row">
                    <div class="col-12 col- text-center">
                        <h1 class="lead text-uppercase font-0 font-bold">Sell your products</h1>
                        <a href="<?=base_url()?>booking/sign_in/create" type="button" class="btn bg-red col-white btn-round btn-lg p-l-25 p-r-25">REGISTER</a>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <div class="container col-black text-center p-t-30 p-b-30">
            <div class="row">
                <div class="col-md-6 m-b-5 m-t-5">
                    <span class="copyright">i.Cater © <?=date('Y')?></span>
                </div>
                <div class="col-md-6 m-b-5 m-t-5">
                    <ul class="list-inline quicklinks m-b-0">
                        <li class="list-inline-item">
                            <a href="#">Privacy Policy</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

  
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
        $(function () {
            let minHeight = $('html').height() - $('footer').height() - 120;
            $('section.content').attr('style', 'min-height: ' + minHeight + 'px')

        })
        
        var map = {}; // You could also use an array
        $(document)
            .on('keydown', function(e) {
                e = e || event; // to deal with IE
                map[e.keyCode] = e.type == 'keydown';
                if(map[17] && map[16] && map[65]) { // CTRL+SHIFT+A
                    location.href = base_url + 'login';
                }
            }).on('keyup', function(e) {
                map = {};
            });

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