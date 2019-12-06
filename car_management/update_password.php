<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{
    header('location:index.php');

} else
    if(isset($_POST['update'])) {
    $password=md5($_POST['password']);
    $newpassword=md5($_POST['newpassword']);
    $email=$_SESSION['login'];
    $sql ="SELECT Password FROM tblusers WHERE EmailId=:email and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0)
    {
        $con="update tblusers set Password=:newpassword where EmailId=:email";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        $msg="Your Password succesfully changed";
    }
    else {
        $error="Your current password is wrong";
    }
}

?>
<style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap{
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
</style>

<script type="text/javascript">
    function valid()
    {
        if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
        {
            alert("New Password and Confirm Password Field do not match  !!");
            document.chngpwd.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>

<style>
    .btn{border-radius: 0;}
    .btn-md {
        border-width: 0;
        outline: none;
        border-radius: 0;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, .6);
        cursor: pointer;
    }
    h3 {text-align: center;margin:40px;}
</style>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>My count - CarRent</title>

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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


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
                    <h2>ACCOUNT SETTING</h2>
                </div>
            </div>
            <!-- Page Title End -->
        </div>
    </div>
</section>
<!--== Choose Car Area Start ==-->
<section id="choose-car" class="section-padding">
    <div class="container">

        <div class="row">
            <!-- Choose Area Content Start -->
            <div class="col-lg-12">
                <div class="choose-ur-cars">
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- Choose Filtering Menu Start -->

                                <?php include('includes/left_menu.php') ?>

                            <!-- Choose Filtering Menu End -->
                        </div>

                    <!-- Single Popular Car Start -->
                    <div class="col-lg-8">
                        <div class=" hat">
                        <?php
                        $useremail=$_SESSION['login'];
                        $sql = "SELECT * from tblusers where EmailId=:useremail";
                        $query = $dbh -> prepare($sql);
                        $query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                        foreach($results as $result)
                        { ?>
                        <section class="user_profile inner_pages">
                            <div class="container">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-inverse" style="background-color: #333; border-color: #8BF9D9; border-width: medium;">
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-8">
                                                            <h2 class="card-title"><?php echo htmlentities($result->FullName);?></h2>
                                                            <p class="card-text"><strong>Address: </strong><?php echo htmlentities($result->Address);?></p>
                                                            <p class="card-text"><strong><?php echo htmlentities($result->City);?></strong> <?php echo htmlentities($result->Country);}}?></p>
                                                            <p class="card-text"><strong>Reg Date - </strong><?php echo htmlentities($result->RegDate);?> </p>
                                                            <?php if($result->UpdationDate!=""){?>
                                                                <p class="card-text"><strong>Last Update at  - </strong><?php echo htmlentities($result->UpdationDate);?></p>
                                                            <?php } ?>


                                                        </div>
                                                        <div class="col-md-4 col-sm-4 text-center">
                                                            <img class="btn-md" src="assets/img/logo_h.png" alt="" style="border-radius:50%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<br>
<br>
                                <div class="profile_wrap">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 align="left">UPDATE YOUR PASSWORD</h6>
                                        </div>
                                        <div class="card-body">
                                    <form name="chngpwd" method="post" onSubmit="return valid();">
                                        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                                        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input class="form-control white_bg" id="password" name="password"  type="password" required>
                                        </div>
                                        <div cl
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input class="form-control white_bg" id="newpassword" type="password" name="newpassword" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input class="form-control white_bg" id="confirmpassword" type="password" name="confirmpassword"  required>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="book-now-btn" value="Update" name="update" id="submit" class="btn btn-block">
                                        </div>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                        </section>
                    </div>
            </div>
        </div>
    </div>
    <!-- Choose Cars Content-wrap -->
    </div>
    </div>
    </div>
    </div>
    <!-- Choose Area Content End -->
    </div>
    </div>
</section>
<?php  ?>
<!--== Choose Car Area End ==-->
<!--== Page Title Area End ==-->

<!--== Contact Page Area Start ==-->
<div class="contact-page-wrao section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">

            </div>
        </div>
    </div>
</div>
<!--== Contact Page Area End ==-->

<!--== Footer Area Start ==-->
<?php include('includes/footer.php');?>
<!--== Footer Area End ==-->

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