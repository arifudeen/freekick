<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>coordinator_home</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">


    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">


    <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>


<div id="topbar" class="d-flex align-items-center fixed-top">

</div>


<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="coordinator.php"><b>FREE KICK</b></a></h1>


        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="coordinator.php">Home</a></li>
                <li><a href="#about">Notification</a></li>
                <script>
                    function myfunction()
                    {
                        alert("Are you sure you want to create new tournament? your existing data will be restore.");
                    }
                </script>


                <li><a href="newtournament.php" onclick="myfunction()">New tournament</a></li>
                <li><a href="league.php">League Tournament</a></li>
                <li><a href="knockout.php" onclick=alert("are you")>Knockout Tournament</a></li>
                <li><a href="#book-a-table">Set rules&regulations</a></li>
                <li><a href="complaints.php">Complaints</a></li>
                <li class="book-a-table text-center"><a href="home.php">Logout</a></li>
            </ul>
        </nav>

    </div>
</header>


<section id="hero" class="d-flex align-items-center" >

    <div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-8">
                <?php
                require('db.php');
                session_start();
                $username=$_SESSION['username'];
                ?>
                <h1>WELCOME:  <span> <?php echo "$username"; ?></span></h1>
                <h2>Lets   make   your   dream...</h2>

                <div class="btns">
                    <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Tournament</a>
                </div>
            </div>


        </div>
    </div>
</section>



<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
                <div class="about-img">
                    <img src="assets/img/A1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                <h3>Notifications.</h3>
                <?php
                require('db.php');
                $result = mysqli_query($con,"SELECT * FROM notification order by notificationid desc ");

                if (mysqli_num_rows($result) > 0) {

                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                        ?>
                        <ul>
                            <li><i class="icofont-check-circled"></i><?php echo $row["date"]; ?>:&nbsp<?php echo $row["notification"]; ?></li>
                        </ul>
                        <?php
                        $i++;
                    }
                    ?>
                    </table><br><br><br>
                    <?php
                }
                else{

                }
                ?>




            </div>
        </div>

    </div>
</section>



<section id="book-a-table" class="book-a-table">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Rules and regulations</h2>
            <p>Set rules and regulation of tournament</p>
            <?php
            require('db.php');
            $username=$_SESSION['username'];


            if (isset($_REQUEST['rules'])){

                $rules = stripslashes($_REQUEST['rules']);

                $rules = mysqli_real_escape_string($con,$rules);
                $tournamentid = stripslashes($_REQUEST['tournamentid']);

                $tournamentid = mysqli_real_escape_string($con,$tournamentid);

                $query = "INSERT into `rulesregulation` (rules,tournamentid)
                VALUES ('$rules','$tournamentid')";
                $result = mysqli_query($con,$query);
                if($result){
                    echo "<div class='form'>
                         <h3>Complaint Is  Successfully Posted.</h3>
                             </div>";
                }
            }else{
                ?>
                <div>
                    <?php
                    $username=$_SESSION['username'];

                    require('db.php');
                    $tournamentid = mysqli_query($con,"SELECT tournamentid FROM tournament where username='$username'");

                    if (mysqli_num_rows($tournamentid) > 0) {

                        $i=0;
                        while($row = mysqli_fetch_array($tournamentid)) {
                            ?>
                            <div class="form">
                                <form name="rules" action="" method="post">
                                    <table >
                                        <tr>
                                            <td><h5>Rules and Regulations</h5></td>
                                            <td><textarea name="rules" rows="5" cols="30%"  required /></textarea> </td>
                                        </tr>
                                        <tr><td> Your Tournament ID: </td>
                                            <td><input readonly value="<?php echo $row["tournamentid"]; ?>"name="tournamentid"> </td>
                                        </tr>



                                        <tr>
                                            <td></td>
                                            <td><h5><input type="submit" name="submit" value="post" /></h5></td>
                                        </tr>
                                    </table>
                                </form>

                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                        </table><br><br><br>
                        <?php
                    }
                    else{
                        echo "No result found";
                    }
                    ?>
                </div>


            <?php } ?>


        </div>
    </div>
</section>






<footer id="footer">
    <div class="container">
        <div class="copyright">
            Free <strong><span>Kick</span></strong>
        </div>
        <div class="credits">
            Football Tournament Management System
            <center>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">

                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div></center>
        </div>
    </div>
</footer>

<div id="preloader"></div>
<a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>


<script src="assets/js/main.js"></script>

</body>

</html>
