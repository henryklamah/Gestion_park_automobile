<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="2";
$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Booking Successfully Cancelled";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

        $sql = "SELECT tblvehicles.VehiclesTitle,tblvehicles.id, tblvehicles.PricePerDay, tblbrands.BrandName, tblbooking.ToDate, tblbooking.FromDate, tblbooking.ToDate,tblbooking.userEmail, tblbooking.message,tblbooking.Status, tblusers.FullName from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand join tblusers on tblusers.EmailId=tblbooking.userEmail where tblbooking.Id=:aeid";
        $query = $dbh -> prepare($sql);
        $query->bindValue(':aeid', $aeid, PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

        function NbJours($debut, $fin)
        {
            $tDeb = explode("-", $debut);
            $tFin = explode("-", $fin);
            $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
                mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
            return (($diff / 86400) + 1);
        }

        foreach($results as $result) {

                $fname = ($result->FullName);
                $name = ($result->BrandName);
                $title_of_vehic = ($result->VehiclesTitle);
                $dd = ($result->FromDate);
                $df = ($result->ToDate);
                $email = ($result->userEmail);
                $pricePerDad = ($result->PricePerDay);

                $duree = NbJours($dd, $df);
                if ($duree = 1) {
                    $prix_net = $pricePerDad * 1;
                    $jour_net = 1;
                }else {
                    $prix_net = $pricePerDad * $duree;
                    $jour_net = $duree;
                }

               //  $to ="henryleck91@gmail.com"; // Receiver Email ID, Replace with your email ID
              //   $subject='Confirmation Email';
                 $message="Mr ".$fname."\n"." here is the confirmation of your booking on CARENT, you booked for ".$jour_net."\n"." day(s) from the ".$dd."\n"." to ".$df."\n"." and the total rate is ".$prix_net."\n"." for : ".$name."\n"."-".$title_of_vehic."\n\n";
                 $headers="From: lamahhenryleck18@gmail.com";

            // mail("henryleck91@gmail.com", "Salut tout le monde !", $message, $headers);

                if(mail("henryleck91@gmail.com", "Salut tout le monde !", $message, $headers)){


                $sql = "UPDATE tblbooking SET Status=:status WHERE  id=:aeid";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':status',$status, PDO::PARAM_STR);
                $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
                $query -> execute();

                $msg="Booking Successfully Confirmed";

                }
                else{
                    echo "Something went wrong!";
                }
        }
	}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="theme-color" content="#3e454c">

<title>Carent | Admin Manage testimonials</title>

<!-- Font awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Sandstone Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Bootstrap Datatables -->
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<!-- Bootstrap social button library -->
<link rel="stylesheet" href="css/bootstrap-social.css">
<!-- Bootstrap select -->
<link rel="stylesheet" href="css/bootstrap-select.css">
<!-- Bootstrap file input -->
<link rel="stylesheet" href="css/fileinput.min.css">
<!-- Awesome Bootstrap checkbox -->
<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
<!-- Admin Stye -->
<link rel="stylesheet" href="css/style.css">
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

</head>

<body>
<?php include('includes/header.php');?>

<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">Manage Bookings</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">Bookings Info</div>
                    <div class="panel-body">
                    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th>#</th>
                                    <th>Name</th>
                                    <th>Vehicle</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Status</th>
                                    <th>Posting date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                <th>Name</th>
                                    <th>Vehicle</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Status</th>
                                    <th>Posting date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            <?php $sql = "SELECT tblusers.FullName,tblbrands.BrandName,tblvehicles.VehiclesTitle,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.VehicleId as vid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id  from tblbooking join tblvehicles on tblvehicles.id=tblbooking.VehicleId join tblusers on tblusers.EmailId=tblbooking.userEmail join tblbrands on tblvehicles.VehiclesBrand=tblbrands.id  ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>
                                <tr>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php echo htmlentities($result->FullName);?></td>
                                    <td><a href="edit-vehicle.php?id=<?php echo htmlentities($result->vid);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></td>
                                    <td><?php echo htmlentities($result->FromDate);?></td>
                                    <td><?php echo htmlentities($result->ToDate);?></td>
                                    <td><?php
if($result->Status==0)
{
echo htmlentities('Not Confirmed yet');
} else if ($result->Status==1) {
echo htmlentities('Confirmed');
}
else{
echo htmlentities('Cancelled');
}
                                ?></td>
                                    <td><?php echo htmlentities($result->PostingDate);?></td>
                                <td><a href="22manage-bookings.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Confirm this booking')"> Confirm</a> /


<a href="22manage-bookings.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Cancel this Booking')"> Cancel</a>
</td>

                                </tr>
                                <?php $cnt=$cnt+1; }} ?>

                            </tbody>
                        </table>



                    </div>
                </div>



            </div>
        </div>

    </div>
</div>
</div>

<!-- Loading Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/chartData.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<?php } ?>
