<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    $message=$_POST['message'];
    $useremail=$_SESSION['login'];
    $status=0;
    $vhid=$_GET['vhid'];

    $todateT = new DateTime($todate);
    $fromdateT = new DateTime($fromdate);
    $duree = (strtotime($todateT->format("Y/m/d")) - strtotime($fromdateT->format("Y/m/d")));
    $duree = $duree / 86400;

    if($duree < 0) {
        echo "<script>alert('La date de debut doit être inferieure a la date de fin.');</script>";
    } else {

        $sql2 = "SELECT DISTINCT VehicleId, FromDate, ToDate, count(VehicleId) as number FROM tblbooking WHERE (FromDate = :fromdate) AND (ToDate = :todate) AND (VehicleId = :vhid)";
        $query2 = $dbh->prepare($sql2);
        $query2->bindValue(':vhid', $vhid, PDO::PARAM_STR);
        $query2->bindValue(':fromdate', $fromdate, PDO::PARAM_STR);
        $query2->bindValue(':todate', $todate, PDO::PARAM_STR);
        $query2->execute();
        $results = $query2->fetchAll(PDO::FETCH_OBJ);
        foreach ($results as $result) {
            if (($result->number) > 0) {
                echo "<script>alert('Cette date n\'est pas disponible');</script>";
            } else {
                $sql = "INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
                $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
                $query->bindParam(':todate', $todate, PDO::PARAM_STR);
                $query->bindParam(':message', $message, PDO::PARAM_STR);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
                $query->execute();
                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    echo "<script>alert('Booking successfull.');</script>";
                }
            }

        }
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

    <title>CAR DETAILS - CARRENT</title>

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
                        <h2>Car Details</h2>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Car List Area Start ==-->
    <section id="car-list-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Car List Content Start -->
                <?php
                $vhid=intval($_GET['vhid']);
                $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
                $query = $dbh -> prepare($sql);
                $query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0)
                {
                    foreach($results as $result)
                    {
                        $_SESSION['brndid']=$result->bid;
                        ?>
                <div class="col-lg-8">

                    <div class="car-details-content">
                        <h2><?php echo htmlentities($result->BrandName);?> - <?php echo htmlentities($result->VehiclesTitle);?><span class="price">Rent: <b> VND <?php echo htmlentities($result->PricePerDay);?>K</b> / Day</span></h2>
                        <div class="car-preview-crousel">
                            <div class="single-car-preview">
                                <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="JSOFT" width="900px" height="260px">
                            </div>
                            <div class="single-car-preview">
                                <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="JSOFT" width="900px" height="260px">
                            </div>
                            <div class="single-car-preview">
                                <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="JSOFT" width="900px" height="5260px">
                            </div>
                        </div>
                        <div class="car-details-info">
                            <h4>Additional Info</h4>
                            <p><?php echo htmlentities($result->VehiclesOverview);?></p>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="choose-content-wrap">
                        <!-- Choose Area Tab Menu -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#popular_cars" role="tab" aria-selected="true">Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#newest_cars" role="tab" aria-selected="false">Accessories</a>
                            </li>
                        </ul>
                        <!-- Choose Area Tab Menu -->
                            
                        <!-- Choose Area Tab content -->
                        <div class="tab-content" id="myTabContent">
                            <!-- Popular Cars Tab Start -->
                            <div class="tab-pane fade show active" id="popular_cars" role="tabpanel" aria-labelledby="home-tab">
                                <!-- Popular Cars Content Wrapper Start -->
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <!-- Single Service Start -->
                                    <div class="service-item">
                                        <h3><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo htmlentities($result->ModelYear);?></h3>
                                        <p>REG. YEAR</p>
                                    </div>
                                    <!-- Single Service End -->
                                    </div>
                                <div class="col-lg-4 col-md-4">
                                    <!-- Single Service Start -->
                                    <div class="service-item">
                                        <h3><i class="fa fa-cogs" aria-hidden="true"></i> <?php echo htmlentities($result->FuelType);?></h3>
                                        <p>FUEL TYPE</p>
                                    </div>
                                    <!-- Single Service End -->
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <!-- Single Service Start -->
                                    <div class="service-item">
                                        <h3><i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo htmlentities($result->SeatingCapacity);?></h3>
                                        <p>SEATS</p>
                                    </div>
                                    <!-- Single Service End -->
                                </div>
                                <!-- Popular Cars Content Wrapper End -->
                            </div>
                            </div>
                            <!-- Popular Cars Tab End -->

                            <!-- Newest Cars Tab Start -->
                            <div class="tab-pane fade" id="newest_cars" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- Newest Cars Content Wrapper Start -->
                                <br>
                                <table class="table table-bordered">
                                                <tr>
                                                    <th>Air Conditioner</th>
                                                <?php if($result->AirConditioner==1)
                                            {
                                                ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <?php } else { ?>
                                                    <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                                <?php } ?> </tr>
                                                <tr>
                                                    <th>AntiLock Braking System</th>
                                                <?php if($result->AntiLockBrakingSystem==1)
                                            {
                                                ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <?php } else { ?>
                                                    <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                                <?php } ?></tr>
                                                <tr>
                                                    <th>Power Steering</th>
                                        <?php if($result->PowerSteering==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                            <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                                <?php } ?></tr>
                                                <tr>
                                                    <th>Power Windows</th>
                                        <?php if($result->PowerWindows==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                    <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                                <?php } ?></tr>
                                                <tr>
                                                    <th>CD Player</th>
                                        <?php if($result->CDPlayer==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                            <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></i></td>
                                                <?php } ?></tr>
                                                <tr>
                                                    <th>Leather Seats</th>
                                        <?php if($result->LeatherSeats==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                            <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                        <?php } ?></tr>
                                                <tr>
                                                    <th>Central Locking</th>
                                        <?php if($result->CentralLocking==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                            <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                        <?php } ?></tr>
                                                <tr>
                                                    <th>Power Door Locks</th>
                                        <?php if($result->PowerDoorLocks==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <?php } else { ?>
                                            <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                        <?php } ?></tr>
                                                <tr>
                                                    <th>Brake Assist</th>
                                        <?php if($result->BrakeAssist==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <?php } else { ?>
                                            <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                        <?php } ?></tr>
                                                <tr>
                                                    <th>Driver Airbag</th>
                                        <?php if($result->DriverAirbag==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <?php } else { ?>
                                            <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                        <?php } ?></tr>
                                                <tr>
                                                    <th>Passenger Airbag</th>
                                        <?php if($result->PassengerAirbag==1)
                                        {
                                            ?>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <?php } else { ?>
                                            <td><span style="color:red;" ><i class="fa fa-close" aria-hidden="true"></i></span></td>
                                        <?php } ?></tr>
                                    </table>
                                <!-- Newest Cars Content Wrapper End -->
                            </div>
                    
                        </div>
                    </div>
                </div>
                <?php }} ?>
                <div class="col-lg-4">
                    <div class="sidebar-content-wrap m-t-50">
                        
                        <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>For More Informations</h3>

                            <div class="sidebar-body">
                                <p><i class="fa fa-mobile"></i> +8801816 277 243</p>
                                <p><i class="fa fa-clock-o"></i> Mon - Sat 8.00 - 18.00</p>
                            </div>
                        </div>
                        <!-- Single Sidebar End -->

                        <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>Book Now</h3>

                            <div class="book-a-car">
                            <form method="post">

                                <!--== Pick Up Date ==-->
                                <div class="book-item">
                                    <h4>PICK-UP DATE:</h4>
                                    <input type="date" id="datefield" class="form-control" name="fromdate" required>
                                </div>
                                <!--== Pick Up Location ==-->
                                <div class="book-item">
                                    <h4>Return DATE:</h4>
                                    <input type="date" id="datefield1" class="form-control" name="todate" required >
                                </div>
                                <!--== Car Choose ==-->
                                <div class="book-item">
                                    <h4>NOTE:</h4>
                                    <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
                                </div>

                                <!--== Car Choose ==-->
                                <?php if($_SESSION['login'])
                                {?>
                                <div class="book-button text-center">
                                    <button class="book-now-btn" type="submit" class="btn"  name="submit">Book Now</button>
                                </div>
                                <?php } else { ?>
                                <div class="book-button text-center">
                                    <a class="book-now-btn" href="login.php">Login</a>
                                </div>
                                <?php } ?>
                            </form>
                            </div>
                        </div>
                        <!-- Single Sidebar End -->


                        <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>Connect with Us</h3>

                            <div class="sidebar-body">
                                <div class="social-icons text-center">
                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-behance"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-dribbble"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Sidebar End -->
                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
             <div class="row">
                <!-- Choose Area Content Start -->
                
                <!-- Choose Area Content End -->
            </div>
        </div>
    </section>
    <!--== Car List Area End ==-->

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
    <script type="text/javascript">
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }

        today = yyyy+'-'+mm+'-'+dd;
        document.getElementById("datefield").setAttribute("min", today);
    </script>

    <script type="text/javascript">
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }

        today = yyyy+'-'+mm+'-'+dd;
        document.getElementById("datefield1").setAttribute("min", today);
    </script>
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