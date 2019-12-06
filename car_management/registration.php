<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['signup']))
{
    $fname=$_POST['fullname'];
    $email=$_POST['emailid'];
    $mobile=$_POST['mobileno'];
    $password=md5($_POST['password']);

    $sql="INSERT INTO  tblusers(FullName,EmailId,ContactNo,Password) VALUES(:fname,:email,:mobile,:password)";
    $query= $dbh -> prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo "<script>alert('Registration successfull. Now you can login');</script>";
    }
    else
    {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}

?>

<script>
    function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data:'emailid='+$("#emailid").val(),
            type: "POST",
            success:function(data){
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }
</script>
<script type="text/javascript">
    function valid()
    {
        if(document.signup.password.value!= document.signup.confirmpassword.value)
        {
            alert("Password and Confirm Password Field do not match  !!");
            document.signup.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>

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

<body class="loader-active" id="lgoin-page-wrap bk-img" style="position: relative;
    width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url(assets/img/login-bg.jpg);">
<!--== Login Page Content Start ==-->
<section id="signupform" class="section-padding" >
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-8 m-auto">
                <div class="login-page-content">
                    <div class="login-form">
                        <h3>REGISTRATION</h3>
                        <form  method="post" name="signup" onSubmit="return valid();">
                            <div class="name">
                                <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                            </div>
                            <div class="mobileno">
                            <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="12" required="required">
                            </div>
                            <div class="username">
                                <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                                <span id="user-availability-status" style="font-size:12px;"></span>
                            </div>
                            <div class="password">
                                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                            </div>
                            <div class="confirmpassword">
                                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                            </div>
                            <div class="log-btn">
                                <button type="submit" name="signup" id="submit"><i class="fa fa-check-square"></i> Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="create-ac">
                        <p>Have an account? <a href="login.php">Sign In</a></p>
                    </div>
                    <div class="login-menu">
                        <a href="about.php">About</a>
                        <span>|</span>
                        <a href="contact.php">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== Login Page Content End ==-->

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