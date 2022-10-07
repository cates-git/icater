<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Online Catering</title>
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url() ?>assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"> -->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url() ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url() ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url() ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url() ?>assets/css/style.css" rel="stylesheet">

    <!-- material icons css -->
    <link href="<?=base_url() ?>assets/plugins/material-design-icons-master/iconfont/material-icons.css" rel="stylesheet">
    <link href="<?=base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <style>
        .input-group{
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">i.Cater</a>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="login">
                    <div class="msg"><!-- LOG IN --></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-block btn-lg btn-success waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?=base_url() ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=base_url() ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url() ?>assets/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?=base_url() ?>assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?=base_url() ?>assets/js/admin.js"></script>
    <script src="<?=base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?=base_url() ?>assets/plugins/axios.min.js"></script>
    <script src="<?=base_url() ?>assets/js/helpers.js"></script>

    <script>
    $(function () {
        base_url = "<?=base_url() ?>";
        $('#sign_in').submit(function(e) {
            e.preventDefault();

            showLoading();
                
            let url = base_url + 'Login/sign_in';
            let data = $(this).serialize();
            ajaxPost(url, data)
                .then(result => { window.location = base_url + 'account'; })
                .catch(error => { showNotice(error.message, false) })
        });
    })
    </script>
</body>

</html>