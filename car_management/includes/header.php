<?php
//session_start();

?>

<header id="header-area" class="fixed-top">
    <!--== Header Top Start ==-->
    <div id="header-top" class="d-none d-xl-block">
        <div class="container">
            <div class="row">
                <!--== Single HeaderTop Start ==-->
                <div class="col-lg-3 text-left">
                    <i class="fa fa-map-marker"></i> 802/2, Hanoi, Vietnam
                </div>
                <!--== Single HeaderTop End ==-->

                <!--== Single HeaderTop Start ==-->
                <div class="col-lg-3 text-center">
                    <i class="fa fa-mobile"></i> +84 334 701 187
                </div>
                <!--== Single HeaderTop End ==-->

                <!--== Single HeaderTop Start ==-->
                <div class="col-lg-3 text-center">
                    <i class="fa fa-clock-o"></i> Mon-Fri 09.00 - 17.00
                </div>
                <!--== Single HeaderTop End ==-->

                <!--== Social Icons Start ==-->
                <div class="col-lg-3 text-right">
                    <div class="header-social-icons">
                        <a href="#"><i class="fa fa-behance"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <!--== Social Icons End ==-->
            </div>
        </div>
    </div>
    <!--== Header Top End ==-->

    <!--== Header Bottom Start ==-->
    <div id="header-bottom">
        <div class="container">
            <div class="row">
                <!--== Logo Start ==-->
                <div class="col-lg-4">
                    <a href="index.php" class="logo">
                        <img src="assets/img/logo.png" alt="JSOFT">
                    </a>
                </div>
                <!--== Logo End ==-->

                <!--== Main Menu Start ==-->
                <div class="col-lg-12 d-none d-xl-block">
                    <nav class="mainmenu alignright">
                        <ul>

                            <?php if(strlen($_SESSION['login']))
                            {   ?>
                                <li><a href="#"><MARQUEE> Welcome to you
                                        <?php
$email=$_SESSION['login'];
$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{
	    echo htmlentities($result->FullName);}}?></MARQUEE></a></li>
                                <li><a href="my_account.php">My Account</a></li>
                            <?php } ?>
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="services.php">services</a></li>
                            <li><a href="car_list.php">Cars</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <?php if(strlen($_SESSION['login'])==0)
                            {   ?>
                                <li><a href="login.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
                            <?php }
                            else{ ?>

                                <li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
                            <?php } ?>

                        </ul>
                    </nav>
                </div>
                <!--== Main Menu End ==-->
            </div>
        </div>
    </div>
    <!--== Header Bottom End ==-->
</header>