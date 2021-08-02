<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Sistem Informasi Atlet Panahan Banjarmasin</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/') ?>plugins/images/favicon.png">
    
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/') ?>plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/') ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- VIEW -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

        <?php $this->load->view($page); ?>

        <!-- ============================================================== -->
        <!-- VIEW -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?= base_url('assets/') ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('assets/') ?>bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('assets/') ?>js/app-style-switcher.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('assets/') ?>js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url('assets/') ?>js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('assets/') ?>js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="<?= base_url('assets/') ?>plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/pages/dashboards/dashboard1.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader").fadeOut();
    </script>
</body>

</html>