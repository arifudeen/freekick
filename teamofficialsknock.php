<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Teamofficials</title>
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
                <li class="active"><a href="teamofficialsleague.php">Home</a></li>
                <li><a href="#book-a-table">Notifications</a></li>
                <li><a href="#about">Fixture</a></li>
                <li><a href="#gallery">Scheduled date&time of Tournament</a></li>
                <li><a href="#specials">Rules & Regulations</a></li>
                <li><a href="#why-us">Score board</a></li>
                <li class="book-a-table text-center"><a href="home.php">Back</a></li>
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
                $tournamentid=$_SESSION['tournamentid'];
                $result = mysqli_query($con,"SELECT tournamentname FROM tournament where tournamentid='$tournamentid'");

                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <table>

                        <?php
                        $i=0;
                        while($row = mysqli_fetch_array($result)) {
                            ?>
                            <h1>TOURNAMENT NAME: <span> <?php echo $row["tournamentname"]; ?></span></h1>
                            <h1>TOURNAMENT ID: <span> <?php echo "$tournamentid"; ?></span></h1>

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


                <div class="btns">
                    <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Score Board</a>
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
                <h1><?php



                function main() {
                    ?>
                    <?php

                    require('db.php');
                    $tournamentid=$_SESSION['tournamentid'];


                    $sq1 = mysqli_query($con, "select names from tournament where tournamentid='$tournamentid' and mode='knockout'");
                    while ($rw1 = mysqli_fetch_array($sq1))

                        if(! isset($rw1['teams']) && ! isset($rw1['names'])) {

                            print get_form();
                        }else if(isset($rw1['teams']) && !empty($rw1['teams'])){

                            $team_num = $rw1['teams'];

                            getpaired($team_num);

                        }else if(isset($rw1['names']) && !empty($rw1['names'])){

                            $team_name =$rw1['names'];
                            // var_dump($team_name);

                            getpaired($team_name);
                        }


                }



                function sortear_grelha($atletas) {
                    shuffle($atletas);
                    $result = array_chunk($atletas, 2);

                    if(array_map('array_unique', $result) != $result) {
                        return sortear_grelha($atletas);
                    }
                    return $result;
                }

                function getpaired( $team_num ){

                    if(is_numeric( $team_num)){
                        if($team_num % 2 == 0 ){
                            // $team_num is even
                        }else{
                            $team_num = $team_num - 1;
                        }

                        for ($i=1; $i <=$team_num ; $i++) {
                            $team_array[] =$i;
                        }
                        $res = sortear_grelha($team_array);

                        foreach ($res as $key => $value) {

                            $res_array = $value[0].'&nbsp&nbsp&nbsp Vs &nbsp&nbsp&nbsp'.$value[1];
                            echo $res_array .'<br>';

                        }

                    }else{
                        $name_array = explode(PHP_EOL,$team_num);

                        $res = sortear_grelha($name_array);
                        foreach ($res as $key => $value) {

                            $res_array = $value[0].'&nbsp&nbsp&nbsp Vs &nbsp&nbsp&nbsp'.$value[1];
                            echo $res_array .'<br>';

                        }
                    }
                }


                function get_form() {
                    $s = '';
                    $s = '<p>Enter number of teams OR team names</p>' . "\n";
                    $s .= '<form action="' . $_SERVER['SCRIPT_NAME'] . '">' . "\n";
                    $s .= '<label for="teams">Number of Teams</label><input type="text" name="teams" />' . "\n";
                    $s .= '<input type="submit" value="Generate Fixtures" />' . "\n";
                    $s .= '</form>' . "\n";

                    $s .= '<form action="' . $_SERVER['SCRIPT_NAME'] . '">' . "\n";
                    $s .= '<div><strong>OR</strong></div>' . "\n";
                    $s .= '<label for="names">Names of Teams (one per line)</label>'
                        . '<textarea name="names" rows="8" cols="40"></textarea>' . "\n";
                    $s .= '<input type="submit" value="Generate Fixtures" />' . "\n";
                    $s .= "</form>\n";
                    return $s;
                }

                main();

                ?>
                </h1>

            </div>

        </div>
</section>



<section id="book-a-table" class="book-a-table">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <p>Notifications</p>
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


<section id="specials" class="specials">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Rules And Regulations</h2>
            <p></p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab-1">Rules and Regulations</a>
                    </li>

                </ul>
            </div>
            <div class="col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-1">
                        <div class="row">
                            <div class="col-lg-8 details order-2 order-lg-1">
                                <h3><?php echo"$tournamentid"?></h3>
                                <?php
                                require('db.php');
                                $result = mysqli_query($con,"SELECT * FROM rulesregulation");

                                if (mysqli_num_rows($result) > 0) {

                                    $i=0;
                                    while($row = mysqli_fetch_array($result)) {
                                        ?>

                                        <p>  <?php echo $row["rules"]; ?></p>

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
                            <div class="col-lg-4 text-center order-1 order-lg-2">
                                <img src="assets/img/red.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div></div></div></div>
</section>


<section id="gallery" class="gallery">

    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <p>Scheduled date and time of the matches</p>


        </div>

        <?php
        require('db.php');
        $result = mysqli_query($con,"SELECT * FROM results where tournamentid='$tournamentid'");

        if (mysqli_num_rows($result) > 0) {
            ?>
            <table align="50%" border="2">

                <tr>


                    <th>Home Team</th>
                    <th>Away Team</th>
                    <th>Date And Time</th>
                    <th>Venue</th>
                </tr>
                <?php
                $i=0;
                while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["hometeam"]; ?></td>
                        <td><?php echo $row["awayteam"]; ?></td>
                        <td><?php echo $row["datetime"]; ?></td>
                        <td><?php echo $row["venue"]; ?></td>


                    </tr>
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


