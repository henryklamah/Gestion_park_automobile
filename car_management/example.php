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
                    <h2>Our Cars</h2>
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
            <div class="col-lg-8">
                <div class="car-list-content">
                    <!-- Single Car Start -->
                    <?php

                    $page = (isset($_GET['page']) ? $_GET['page'] : 1);
                    $perPage = (isset($_GET['per-page']) && ($_GET['per-page']) <= 50 ? $_GET['per-page'] : 3);
                    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;


                    $sql1 = "SELECT id from tblvehicles ";
                    $query1 = $dbh->prepare($sql1);;
                    $query1->execute();
                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                    $total = $query1->rowCount();


                    $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand ORDER BY tblvehicles.id DESC limit ".$start." , ".$perPage." ";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                    $pages = ceil($total / $perPage);

                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                        foreach($results as $result)
                        {
                            ?>



                            <div class="single-car-wrap">
                            <div class="row">

                                <!-- Single Car Thumbnail -->
                                <div class="col-lg-5">
                                    <a href="car-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="car-list-thumb car-thumb-2" alt="image"></a>
                                </div>
                                <!-- Single Car Thumbnail -->
                                <!-- Single Car Info -->
                                <div class="col-lg-7">
                                    <div class="display-table">
                                        <div class="display-table-cell">
                                            <div class="car-list-info">
                                                <h2><a href="car-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> - <?php echo htmlentities($result->VehiclesTitle);?></a></h2>
                                                <h5>VND <?php echo htmlentities($result->PricePerDay);?> Rent / per a day</h5>
                                                <p>This vehicle is Carent product. 99% brand new! </p>
                                                <ul class="car-info-list">
                                                    <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                                                    <li><?php echo htmlentities($result->ModelYear);?> Model</li>
                                                    <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                                                </ul>
                                                <p class="rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star unmark"></i>
                                                </p>
                                                <a href="car-details.php?vhid=<?php echo htmlentities($result->id);?>" class="rent-btn">Book It</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Car info -->
                            </div>
                            </div><?php }}?>
                    <!-- Single Car End -->
                </div>

                <!-- Page Pagination Start -->
                <div class="page-pagi"  >
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" align="center">
                            <?php for($i = 1 ; $i <= $pages; $i++): ?>
                                <li class="page-item"><a class="page-link" href="?page=<?php echo $i;?>&per-page=<?php echo $perPage;?>"><?php echo $i; ?> </a></li>
                            <?php endfor; ?>
                        </ul>
                    </nav>

                </div>
                <!-- Page Pagination End -->
            </div>
            <!-- Car List Content End -->

            <!-- Sidebar Area Start -->
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
                        <h3>Rental Tips</h3>

                        <div class="sidebar-body">
                            <ul class="recent-tips">
                                <?php
                                $sql = "SELECT type,dateP,detail from tblpages where type='news'";
                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result)
                                    { ?>
                                        <li class="single-recent-tips">
                                            <div class="recent-tip-thum">
                                                <a><img src="assets/img/we-do/car_info.png" alt="JSOFT"></a>
                                            </div>
                                            <div class="recent-tip-body">
                                                <h4><a><?php echo htmlentities($result->detail); ?></a></h4>
                                                <span class="date"><?php echo ($result->dateP); ?> </span>
                                        </li>
                                    <?php } }?>
                            </ul>
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








<?php

require 'database.php';

$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";

if(!empty($_POST))
{
    $name               = checkInput($_POST['name']);
    $description        = checkInput($_POST['description']);
    $price              = checkInput($_POST['price']);
    $category           = checkInput($_POST['category']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = '../images/'. basename($image);
    $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
    $isSuccess          = true;
    $isUploadSuccess    = false;

    if(empty($name))
    {
        $nameError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if(empty($description))
    {
        $descriptionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if(empty($price))
    {
        $priceError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if(empty($category))
    {
        $categoryError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if(empty($image))
    {
        $imageError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    else
    {
        $isUploadSuccess = true;
        if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" )
        {
            $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if(file_exists($imagePath))
        {
            $imageError = "Le fichier existe deja";
            $isUploadSuccess = false;
        }
        if($_FILES["image"]["size"] > 500000)
        {
            $imageError = "Le fichier ne doit pas depasser les 500KB";
            $isUploadSuccess = false;
        }
        if($isUploadSuccess)
        {
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
            {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }

    if($isSuccess && $isUploadSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO items (name,description,price,category,image) values(?, ?, ?, ?, ?)");
        $statement->execute(array($name,$description,$price,$category,$image));
        Database::disconnect();
        header("Location: index.php");
    }
}

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Burger Code</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code <span class="glyphicon glyphicon-cutlery"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Ajouter un item</strong></h1>
        <br>
        <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                <span class="help-inline"><?php echo $nameError;?></span>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description;?>">
                <span class="help-inline"><?php echo $descriptionError;?></span>
            </div>
            <div class="form-group">
                <label for="price">Prix: (en €)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price;?>">
                <span class="help-inline"><?php echo $priceError;?></span>
            </div>
            <div class="form-group">
                <label for="category">Catégorie:</label>
                <select class="form-control" id="category" name="category">
                    <?php
                    $db = Database::connect();
                    foreach ($db->query('SELECT * FROM categories') as $row)
                    {
                        echo '<option value="'. $row['id'] .'">'. $row['name'] . '</option>';;
                    }
                    Database::disconnect();
                    ?>
                </select>
                <span class="help-inline"><?php echo $categoryError;?></span>
            </div>
            <div class="form-group">
                <label for="image">Sélectionner une image:</label>
                <input type="file" id="image" name="image">
                <span class="help-inline"><?php echo $imageError;?></span>
            </div>
            <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
