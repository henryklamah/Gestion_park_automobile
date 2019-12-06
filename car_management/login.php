<?php
session_start();
include('includes/config.php');
error_reporting(0);
// Code user Registration
if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $sql ="SELECT EmailId,Password,FullName FROM tblusers WHERE EmailId=:email and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        $extra="my_account.php";
        $_SESSION['login']=$_POST['email'];
        $_SESSION['fname']=$results->FullName;
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=1;
       // $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
    else
    {
        $extra="login.php";
        $email=$_POST['email'];
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=0;
      //  $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        $_SESSION['errmsg']="Invalid email id or Password";
        exit();

    }

}

?>


<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>Login - CarRent</title>

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
<section  class="section-padding" >
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-8 m-auto">
                <div class="login-page-content">
                    <div class="login-form">
                        <h3>Welcome Back!</h3>
                        <span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']);
?>
<?php
echo htmlentities($_SESSION['errmsg']="");
?>
	</span>
                        <form method="post">
                            <div class="username">
                                <input type="email" class="form-control" name="email" placeholder="Email or Username">
                            </div>
                            <div class="password">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="log-btn">
                                <button type="submit" name="login" value="Login"><i class="fa fa-sign-in"></i> Log In</button>
                            </div>
                        </form>
                    </div>

                    <div class="create-ac">
                        <p>Don't have an account? <a href="registration.php" name="signupform">Sign Up</a></p>
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

<script type="text/javascript">
    function valid()
    {
        if(document.register.password.value!= document.register.confirmpassword.value)
        {
            alert("Password and Confirm Password Field do not match  !!");
            document.register.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>

</body>

</html>