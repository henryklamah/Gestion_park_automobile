<?php
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>Cardoor - Car Rental HTML Template</title>

    <!--=== Bootstrap CSS ===-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Vegas Min CSS ===-->
    <link href="assets/css/plugins/vegas.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="assets/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="assets/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="assets/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="style.css" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="assets/css/responsive.css" rel="stylesheet">


    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loader-active">

    <!--== Header Area Start ==-->
    <?php include('includes/header.php');?>
    <!--== Header Area End ==-->

    <!--== Page Title Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Our Services</h2>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Service Page Content Start ==-->
    <section id="service-page-wrapper" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Single Services Start -->
                    <div class="single-service-item">
                        <div class="service-item-thumb ser-thumb-bg-1"></div>
                        <div class="service-item-content">
                            <h3>RENTAL CAR</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicingedsedsis elited. Necessitatibus aliquid, architecto ullam esdefugiat quasi! Doloribus eaque quam soluta quae porro reprehenderit edsconsequuntur hic ducimus consequatur, dicta officia excepturi quos, quis voluptatum optio deserunt sit. Totam ab dolorum at, labore quisquamn earum, magni reiciendis officiis dolores nemo nostrum perspiciatis!</p>
                        </div>
                    </div>
                    <!-- Single Services End -->

                    <!-- Single Services Start -->
                    <div class="single-service-item">
                        <div class="service-item-thumb ser-thumb-bg-2 d-lg-none d-md-block"></div>
                        <div class="service-item-content">
                            <h3>LIFE INSURANCE</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicingedsedsis elited. Necessitatibus aliquid, architecto ullam esdefugiat quasi! Doloribus eaque quam soluta quae porro reprehenderit edsconsequuntur hic ducimus consequatur, dicta officia excepturi quos, quis voluptatum optio deserunt sit. Totam ab dolorum at, labore quisquamn earum, magni reiciendis officiis dolores nemo nostrum perspiciatis!</p>
                        </div>
                        <div class="service-item-thumb ser-thumb-bg-2 d-none d-lg-block d-md-none"></div>
                    </div>
                    <!-- Single Services End -->

                    <!-- Single Services Start -->
                    <div class="single-service-item">
                        <div class="service-item-thumb ser-thumb-bg-3"></div>
                        <div class="service-item-content">
                            <h3>CAR REPAIR</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicingedsedsis elited. Necessitatibus aliquid, architecto ullam esdefugiat quasi! Doloribus eaque quam soluta quae porro reprehenderit edsconsequuntur hic ducimus consequatur, dicta officia excepturi quos, quis voluptatum optio deserunt sit. Totam ab dolorum at, labore quisquamn earum, magni reiciendis officiis dolores nemo nostrum perspiciatis!</p>
                        </div>
                    </div>
                    <!-- Single Services End -->

                    <!-- Single Services Start -->
                    <div class="single-service-item">
                        <div class="service-item-thumb ser-thumb-bg-4 d-lg-none d-md-block"></div>
                        <div class="service-item-content">
                            <h3>CALL DRIVER</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicingedsedsis elited. Necessitatibus aliquid, architecto ullam esdefugiat quasi! Doloribus eaque quam soluta quae porro reprehenderit edsconsequuntur hic ducimus consequatur, dicta officia excepturi quos, quis voluptatum optio deserunt sit. Totam ab dolorum at, labore quisquamn earum, magni reiciendis officiis dolores nemo nostrum perspiciatis!</p>
                        </div>
                        <div class="service-item-thumb ser-thumb-bg-2 d-none d-lg-block d-md-none"></div>
                    </div>
                    <!-- Single Services End -->

                    <!-- Single Services Start -->
                    <div class="single-service-item">
                        <div class="service-item-thumb ser-thumb-bg-3"></div>
                        <div class="service-item-content">
                            <h3>CAR WASH</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicingedsedsis elited. Necessitatibus aliquid, architecto ullam esdefugiat quasi! Doloribus eaque quam soluta quae porro reprehenderit edsconsequuntur hic ducimus consequatur, dicta officia excepturi quos, quis voluptatum optio deserunt sit. Totam ab dolorum at, labore quisquamn earum, magni reiciendis officiis dolores nemo nostrum perspiciatis!</p>
                        </div>
                    </div>
                    <!-- Single Services End -->
                </div>
            </div>
        </div>
    </section>
    <!--== Service Page Content End ==-->


    <!--== Footer Area Start ==-->
    <?php include('includes/footer.php');?>
    <!--== Footer Area End ==-->

    <!--Login-Form -->
    <?php include('includes/login.php');?>
    <!--/Login-Form -->

    <!--Register-Form -->
    <?php include('includes/registration.php');?>

    <!--/Register-Form -->

    <!--Forgot-password-Form -->
    <?php include('includes/forgotpassword.php');?>
    <!--/Forgot-password-Form -->

    <!--== Scroll Top Area Start ==-->
    <div class="scroll-top">
        <img src="assets/img/scroll-top.png" alt="JSOFT">
    </div>
    <!--== Scroll Top Area End ==-->

    <!--=======================Javascript============================-->
    <!--=== Jquery Min Js ===-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!--=== Jquery Migrate Min Js ===-->
    <script src="assets/js/jquery-migrate.min.js"></script>
    <!--=== Popper Min Js ===-->
    <script src="assets/js/popper.min.js"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--=== Gijgo Min Js ===-->
    <script src="assets/js/plugins/gijgo.js"></script>
    <!--=== Vegas Min Js ===-->
    <script src="assets/js/plugins/vegas.min.js"></script>
    <!--=== Isotope Min Js ===-->
    <script src="assets/js/plugins/isotope.min.js"></script>
    <!--=== Owl Caousel Min Js ===-->
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <!--=== Waypoint Min Js ===-->
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <!--=== CounTotop Min Js ===-->
    <script src="assets/js/plugins/counterup.min.js"></script>
    <!--=== YtPlayer Min Js ===-->
    <script src="assets/js/plugins/mb.YTPlayer.js"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="assets/js/plugins/magnific-popup.min.js"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="assets/js/plugins/slicknav.min.js"></script>

    <!--=== Mian Js ===-->
    <script src="assets/js/main.js"></script>

</body>

</html>
