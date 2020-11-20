<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>home_page</title>
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

        <h1 class="logo mr-auto"><a href=""><b>FREE KICK</b></a></h1>


        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="home.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="registration.php">Sign up</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li class="book-a-table text-center"><a href="#book-a-table">Search Tournament</a></li>
            </ul>
        </nav>

    </div>
</header>


<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-8">
                <h1>Welcome to <span>FREE KICK</span></h1>
                <h2>Football  Tournament  Management  System</h2>

                <div class="btns">
                    <a href="login.php" class="btn-menu animated fadeInUp scrollto">Login</a>
                    <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Search a Tournament</a>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-center justify-content-center" data-aos="zoom-in" data-aos-delay="200">
                <a href="https://www.youtube.com/watch?v=GlrxcuEDyF8" class="venobox play-btn" data-vbtype="video" data-autoplay="true"></a>
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
                <h3>Search Tournament</h3>
                <?php
                require('db.php');
                session_start();

                if (isset($_POST['tournamentid'])){

                    $tournamentid = stripslashes($_REQUEST['tournamentid']);

                    $tournamentid = mysqli_real_escape_string($con,$tournamentid);





                    $query = "SELECT * FROM `tournament` WHERE tournamentid='$tournamentid'";
                    $result = mysqli_query($con, $query) or die(mysql_error());
                    $rows = mysqli_num_rows($result);

                    $data = mysqli_fetch_assoc($result);

                    if ($rows == 1) {
                        $_SESSION['tournamentid'] = $tournamentid;
                        if($data['mode'] == 'league' ) {
                            header("Location: teamofficialsleague.php");
                        }
                        else {

                            header("Location: teamofficialsknock.php");
                        }
                    }



                    else {

                        echo "<div class='form'>
<h3>Your Tournament ID was Unavailable</h3>
<br/>Click here to <a href='home.php'>Try onesmore</a></div>";
                    }
                }else {


                    ?>
                    <div class="form">
                        <form action="" method="post" name="login">
                            <table >
                                <tr>
                                    <td><h5>Tournament ID</h5></td>
                                    <td><input type="text" name="tournamentid" placeholder="" required /></td>
                                    <td><h5><input name="submit" type="submit" value="GO" class="btn-danger" /></h5></td>
                                </tr>
                            </table>
                        </form>

                    </div>
                <?php } ?>

            </div></div></div></section>



<section id="book-a-table" class="book-a-table">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <p>Search  Tournament</p>
            <br> <br> <br> <br>
            <h1>Online tournment management system.</h1>
            <p class="font-italic">
                It is the first and multi interaction tournament management platform.
            </p>
            <ul>
                <li><i class="icofont-check-circled"></i> you can manage tournamnet here.</li>
                <li><i class="icofont-check-circled"></i> Easy fixture...</li>
                <li><i class="icofont-check-circled"></i> Easy scoreboard</li>
            </ul>
            <p>
                lets make your dream here.
            </p>
        </div></div></section>




<section id="gallery" class="gallery">

    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Gallery</h2>
            <p>Football lives here..</p>
        </div>
    </div>

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row no-gutters">

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                    <a href="assets/img/gallery/111.jpg" class="venobox" data-gall="gallery-item">
                        <img src="assets/img/gallery/111.jpg" alt="" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                    <a href="assets/img/gallery/112.jpg" class="venobox" data-gall="gallery-item">
                        <img src="assets/img/gallery/112.jpg" alt="" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                    <a href="assets/img/gallery/113.jpg" class="venobox" data-gall="gallery-item">
                        <img src="assets/img/gallery/113.jpg" alt="" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                    <a href="assets/img/gallery/114.jpg" class="venobox" data-gall="gallery-item">
                        <img src="assets/img/gallery/114.jpg" alt="" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                    <a href="assets/img/gallery/115.jpg" class="venobox" data-gall="gallery-item">
                        <img src="assets/img/gallery/115.jpg" alt="" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                    <a href="assets/img/gallery/119.jpg" class="venobox" data-gall="gallery-item">
                        <img src="assets/img/gallery/119.jpg" alt="" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                    <a href="assets/img/gallery/117.jpg" class="venobox" data-gall="gallery-item">
                        <img src="assets/img/gallery/117.jpg" alt="" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                    <a href="assets/img/gallery/118.jpg" class="venobox" data-gall="gallery-item">
                        <img src="assets/img/gallery/118.jpg" alt="" class="img-fluid">
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>




<footer id="footer">
    <div class="container">
        <div class="copyright">
             <strong><span>Free kick</span></strong>
        </div>
        <div class="credits">
            Football Tournament Manangement System

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
                </div>
        </div>
    </div></center>
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

