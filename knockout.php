<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Knockout tournament</title>
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
                <li class="active"><a href="coordinator.php">Home</a></li>
                <li><a href="#about">Fixture</a></li>
                <li><a href="#gallery">Result updates</a></li>
                <li><a href="#why-us">Match updates</a></li>
                <li><a href="#book-a-table">Point Table</a></li>
            </ul>
        </nav>

    </div>
</header>


<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-8">
                <?php
                session_start();
                require('db.php');
                $username=$_SESSION['username'];
                $result = mysqli_query($con,"SELECT * FROM tournament where username='$username' and mode='knockout'");

                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <table>

                        <?php
                        $i=0;
                        while($row = mysqli_fetch_array($result)) {
                            ?>
                            <h1>TOURNAMENT NAME: <span> <?php echo $row["tournamentname"]; ?></span></h1>
                            <h1>TOURNAMENT ID: <span> <?php echo $row["tournamentid"]; ?></span></h1>

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
                    <a href="#about" class="btn-menu animated fadeInUp scrollto">Fixture</a>
                    <a href="#gallery" class="btn-book animated fadeInUp scrollto">Result update</a>
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
                <h1>Fixture Of Knockout Tournamnet</h1>
                <h3>

                <?php



                function main() {
                    ?>
                    <?php

                    require('db.php');
                    $username=$_SESSION['username'];


                    $sq1 = mysqli_query($con, "select names from tournament where username='$username' and mode='knockout'");
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
                </h3>


            </div>
        </div>

    </div>
</section>






<section id="gallery" class="gallery">

    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Result updates</h2>
            <p>Post match result here</p>

        </div>
        <?php
        $username=$_SESSION['username'];
        ?>

        <?php
        require('db.php');

        if (isset($_REQUEST['winteam'])){

            $winteam = stripslashes($_REQUEST['winteam']);

            $winteam = mysqli_real_escape_string($con,$winteam);
            $tournamentid = stripslashes($_REQUEST['tournamentid']);

            $tournamentid = mysqli_real_escape_string($con,$tournamentid);



            $datetime = stripslashes($_REQUEST['datetime']);

            $datetime = mysqli_real_escape_string($con,$datetime);


            $venue = stripslashes($_REQUEST['venue']);

            $venue = mysqli_real_escape_string($con,$venue);


            $query = "INSERT into `knockout` (tournamentid,username,winteam,datetime,venue)
                VALUES ('$tournamentid','$username','$winteam','$datetime','$venue')";
            $result = mysqli_query($con,$query);
            if($result){
                echo "<div class='form'>
                         <h3>Result Is  Successfully Posted. Click 
                         Here To <a href='knockout.php'>Update another</a></h3>
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
                            <form name="winteam" action="" method="post">
                                <table >

                                    <tr><td> Your Tournament ID: </td>
                                        <td><input readonly value="<?php echo $row["tournamentid"]; ?>"name="tournamentid"> </td>

                                    <tr><td>Date And Time of the match</td>
                                        <td>  <input type="datetime-local" name="datetime">
                                        </td></tr>
                                    <tr><td>Venue of the match</td>
                                        <td>  <input type="text" name="venue">
                                        </td></tr>
                                    <tr><td>Qualfied Team</td>
                                        <td>  <input type="text" name="winteam">
                                        </td></tr><tr>
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
</section>

<!-- ======= Why Us Section ======= -->
<section id="why-us" class="why-us">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Match update</h2>
            <p>please fill all the colomn while updating.</p>
        </div>

        <div class="row">

            <div class="col-lg-4">
                <?php
                require('db.php');
                if (isset($_REQUEST['update'])){

                    $winteam1 = stripslashes($_REQUEST['winteam1']);

                    $winteam1 = mysqli_real_escape_string($con,$winteam1);
                    $knockid = stripslashes($_REQUEST['knockid']);

                    $knockid = mysqli_real_escape_string($con,$knockid);

                    $datetime1 = stripslashes($_REQUEST['datetime1']);

                    $datetime1 = mysqli_real_escape_string($con,$datetime1);


                    $venue1 = stripslashes($_REQUEST['venue1']);

                    $venue1 = mysqli_real_escape_string($con,$venue1);


                    $query1 = "UPDATE knockout SET datetime='$datetime1',venue='$venue1',winteam='$winteam1' WHERE knockid='$knockid'";

                    if ($con->query($query1) === TRUE) {
                        echo "Record updated successfully Click here to <a href='knockout.php'>update another</a>";
                    } else {
                        echo "Error updating record: " . $con->error;
                    }

                    $con->close();



                }else{
                ?>

            </div>

        </div>
    </div>

    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="box" data-aos="zoom-in" data-aos-delay="200">
            <span>Update results</span>
            <?php
            require('db.php');
            $result = mysqli_query($con,"SELECT * FROM knockout where username='$username'");

            if (mysqli_num_rows($result) > 0) {
                ?>
                <table align="50%" border="2">

                    <tr>
                        <th>Match no</th>
                        <th>Date And Time</th>
                        <th>Venue</th>
                        <th>Qualified Team</th>
                    </tr>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row["knockid"]; ?></td>
                            <td><?php echo $row["datetime"]; ?></td>
                            <td><?php echo $row["venue"]; ?></td>
                            <td><?php echo $row["winteam"]; ?></td>
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


            <div class="form">
                <form name="update" action="" method="post">
                    <table >
                        <tr>
                            <td><h5>Match no</h5></td>
                            <td><input type="text" name="knockid"  required /> </td>
                        </tr>
                        <tr><td>Date And Time of the match</td>
                            <td>  <input type="datetime-local" name="datetime1">
                            </td></tr>
                        <tr><td>Venue of the match</td>
                            <td>  <input type="text" name="venue1">
                            </td></tr>
                        <tr>
                            <td><h5>Qualified Team</h5></td>
                            <td><input type="text" name="winteam1"></td>
                        </tr>



                        <tr>
                            <td></td>
                            <td><h5><input type="submit" name="update" value="update" /></h5></td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php } ?>

        </div>
    </div>


    </div>

    </div>
</section><!-- End Why Us Section -->



<section id="book-a-table" class="book-a-table">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <p></p>
            <?php
            require('db.php');
            if (isset($_REQUEST['names'])){

                $names = stripslashes($_REQUEST['names']);

                $names = mysqli_real_escape_string($con,$names);


                $query = "UPDATE tournament SET names='$names' WHERE username='$username'";

                if ($con->query($query) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $con->error;
                }

                $con->close();



            }else{
            ?>

        </div>

        <div class="form">
            <form name="names" action="" method="post">
                <table >

                    <tr>
                        <td><h5>NEXT ROUND TEAMS</h5></td>
                        <td><textarea name="names" rows="5" cols="30%"  required /></textarea> </td>
                    </tr>




                    <tr>
                        <td>LOAD NEXT ROUND</td>
                        <td><h5><input type="submit" name="submit" value="NEXT ROUND" /></h5></td>
                    </tr>
                </table>
            </form>
        </div>
        <?php } ?>




    </div></div></div></section>



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


