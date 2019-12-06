<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{
    header('location:index.php');
}else {
if(isset($_POST['updateprofile'])) {
    $name=$_POST['fullname'];
    $mobileno=$_POST['mobilenumber'];
    $dob=$_POST['dob'];
    $adress=$_POST['address'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $email=$_SESSION['login'];
    $active = false;
    $sql="update tblusers set FullName=:name,ContactNo=:mobileno,dob=:dob,Address=:adress,City=:city,Country=:country where EmailId=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
    $query->bindParam(':dob',$dob,PDO::PARAM_STR);
    $query->bindParam(':adress',$adress,PDO::PARAM_STR);
    $query->bindParam(':city',$city,PDO::PARAM_STR);
    $query->bindParam(':country',$country,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    if ($query->execute() && ($active=true)) {
        $msg="Profile Updated Successfully";
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

                                <?php include('includes/left_menu.php') ?>

                        </div>

                        <div class="col-lg-8">
                            <!-- Choose Cars Content-wrap -->
                                <div class="con">
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
                                                <?php include('includes/user_card.php') ?>
                                            </div>

                                            <br>
                                            <br>
                                            <?php
                                            if($active == true ){?>
                                                <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                            <?php }?>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 align="left">GENERAL SETTINGS</h6>
                                                </div>
                                                <div class="card-body">
                                            <form  method="post">
                                                <div class="form-group">
                                                    <label class="control-label">Full Name</label>
                                                    <input class="form-control white_bg" name="fullname" value="<?php echo htmlentities($result->FullName);?>" id="fullname" type="text"  required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Email Address</label>
                                                    <input class="form-control white_bg" value="<?php echo htmlentities($result->EmailId);?>" name="emailid" id="email" type="email" required readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Phone Number</label>
                                                    <input class="form-control white_bg" name="mobilenumber" value="<?php echo htmlentities($result->ContactNo);?>" id="phone-number" type="text" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Date of Birth&nbsp;(dd/mm/yyyy)</label>
                                                    <input class="form-control white_bg" value="<?php echo htmlentities($result->dob);?>" name="dob" placeholder="dd/mm/yyyy" id="birth-date" type="text" >
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Your Address</label>
                                                    <textarea class="form-control white_bg" name="address" rows="4" ><?php echo htmlentities($result->Address);?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Country</label>
                                                    <input class="form-control white_bg"  id="country" name="country" value="<?php echo htmlentities($result->City);?>" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">City</label>
                                                    <input class="form-control white_bg" id="city" name="city" value="<?php echo htmlentities($result->City);?>" type="text">
                                                </div>
                                                <?php }} ?>

                                                <div class="book-button text-center">
                                                    <button type="submit" class="book-now-btn" name="updateprofile" class="btn">Save Changes <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                                                </div>

                                            </form>
                                            </div>
                                            </div>
                                    </section>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

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