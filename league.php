<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>league_tournament</title>
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
                <h1>
                <?php

                function main() {
                    ?>

                    <?php

                    require('db.php');
                    session_start();
                    $username=$_SESSION['username'];

                    $sq1 = mysqli_query($con, "select names from tournament where username='$username' and mode='league'");
                    while ($rw1 = mysqli_fetch_array($sq1))
                        if (! isset($rw1['teams']) && ! isset($rw1['names'])) {
                            print get_form();
                        } else {
                            print show_fixtures(isset($rw1['teams']) ?  nums(intval($rw1['teams'])) : explode("\n", trim($rw1['names'])));
                        }
                }

                function nums($n) {
                    $ns = array();
                    for ($i = 1; $i <= $n; $i++) {
                        $ns[] = $i;
                    }
                    return $ns;
                }

                function show_fixtures($names) {
                    $teams = sizeof($names);

                    print "<h1>Fixtures for $teams teams.</h1>";

                    $ghost = false;
                    if ($teams % 2 == 1) {
                        $teams++;
                        $ghost = true;
                    }

                    $totalRounds = $teams - 1;
                    $matchesPerRound = $teams / 2;
                    $rounds = array();
                    for ($i = 0; $i < $totalRounds; $i++) {
                        $rounds[$i] = array();
                    }

                    for ($round = 0; $round < $totalRounds; $round++) {
                        for ($match = 0; $match < $matchesPerRound; $match++) {
                            $home = ($round + $match) % ($teams - 1);
                            $away = ($teams - 1 - $match + $round) % ($teams - 1);

                            if ($match == 0) {
                                $away = $teams - 1;
                            }
                            $rounds[$round][$match] = team_name($home + 1, $names)
                                . "&nbsp&nbsp&nbsp VS &nbsp&nbsp&nbsp" . team_name($away + 1, $names);
                        }
                    }

                    // Interleave so that home and away games are fairly evenly dispersed.
                    $interleaved = array();
                    for ($i = 0; $i < $totalRounds; $i++) {
                        $interleaved[$i] = array();
                    }

                    $evn = 0;
                    $odd = ($teams / 2);
                    for ($i = 0; $i < sizeof($rounds); $i++) {
                        if ($i % 2 == 0) {
                            $interleaved[$i] = $rounds[$evn++];
                        } else {
                            $interleaved[$i] = $rounds[$odd++];
                        }
                    }

                    $rounds = $interleaved;

                    // Last team can't be away for every game so flip them
                    // to home on odd rounds.
                    for ($round = 0; $round < sizeof($rounds); $round++) {
                        if ($round % 2 == 1) {
                            $rounds[$round][0] = flip($rounds[$round][0]);
                        }
                    }

                    // Display the fixtures
                    for ($i = 0; $i < sizeof($rounds); $i++) {
                        print "<p>Round " . ($i + 1) . "</p>\n";
                        foreach ($rounds[$i] as $r) {
                            print $r . "<br />";
                        }
                        print "<br />";
                    }
                    print "<p>SECOND LEG</p>";
                    $round_counter = sizeof($rounds) + 1;
                    for ($i = sizeof($rounds) - 1; $i >= 0; $i--) {
                        print "<p>Round " . $round_counter . "</p>\n";
                        $round_counter += 1;
                        foreach ($rounds[$i] as $r) {
                            print flip($r) . "<br />";
                        }
                        print "<br />";
                    }
                    print "<br />";

                    if ($ghost) {
                        print "Matches against team " . $teams . " are byes.";
                    }
                }

                function flip($match) {
                    $components = explode('&nbsp&nbsp&nbsp VS &nbsp&nbsp&nbsp', $match);
                    return $components[1] . "&nbsp&nbsp&nbsp VS &nbsp&nbsp&nbsp" . $components[0];
                }

                function team_name($num, $names) {
                    $i = $num - 1;
                    if (sizeof($names) > $i && strlen(trim($names[$i])) > 0) {
                        return trim($names[$i]);
                    } else {
                        return $num;
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

    </div>
</section>



<section id="book-a-table" class="book-a-table">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <p></p>





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

        if (isset($_REQUEST['hometeam'])){

            $hometeam = stripslashes($_REQUEST['hometeam']);

            $hometeam = mysqli_real_escape_string($con,$hometeam);
            $tournamentid = stripslashes($_REQUEST['tournamentid']);

            $tournamentid = mysqli_real_escape_string($con,$tournamentid);

            $awayteam = stripslashes($_REQUEST['awayteam']);

            $awayteam = mysqli_real_escape_string($con,$awayteam);

            $homegoals = stripslashes($_REQUEST['homegoals']);

            $homegoals = mysqli_real_escape_string($con,$homegoals);

            $awaygoals = stripslashes($_REQUEST['awaygoals']);

            $awaygoals = mysqli_real_escape_string($con,$awaygoals);

            $datetime = stripslashes($_REQUEST['datetime']);

            $datetime = mysqli_real_escape_string($con,$datetime);


            $venue = stripslashes($_REQUEST['venue']);

            $venue = mysqli_real_escape_string($con,$venue);


            $query = "INSERT into `results` (tournamentid,username,hometeam,awayteam,datetime,venue,homegoals,awaygoals)
                VALUES ('$tournamentid','$username','$hometeam','$awayteam','$datetime','$venue','$homegoals','$awaygoals')";
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
                            <form name="hometeam" action="" method="post">
                                <table >

                                    <tr><td> Your Tournament ID: </td>
                                        <td><input readonly value="<?php echo $row["tournamentid"]; ?>"name="tournamentid"> </td>

                                    <tr><td>Date And Time of the match</td>
                                        <td>  <input type="datetime-local" name="datetime">
                                        </td></tr>
                                    <tr><td>Venue of the match</td>
                                        <td>  <input type="text" name="venue">
                                        </td></tr>
                                    <tr><td>Home Team</td>
                                          <td>  <input type="text" name="hometeam">
                                        </td></tr>
                                    <tr><td>Away Team</td>
                                        <td>  <input type="text" name="awayteam">
                                        </td></tr>
                                    <tr><td>Home Goals</td>
                                        <td>  <input type="number" name="homegoals">
                                        </td>
                                    <tr><td>Away Goals</td>
                                        <td>  <input type="number" name="awaygoals">
                                        </td></tr>
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

                        $hometeam1 = stripslashes($_REQUEST['hometeam1']);

                        $hometeam1 = mysqli_real_escape_string($con,$hometeam1);
                        $resultid = stripslashes($_REQUEST['resultid']);

                        $resultid = mysqli_real_escape_string($con,$resultid);
                        $awayteam1 = stripslashes($_REQUEST['awayteam1']);

                        $awayteam1 = mysqli_real_escape_string($con,$awayteam1);
                        $homegoals1 = stripslashes($_REQUEST['homegoals1']);

                        $homegoals1 = mysqli_real_escape_string($con,$homegoals1);
                        $awaygoals1 = stripslashes($_REQUEST['awaygoals1']);

                        $awaygoals1 = mysqli_real_escape_string($con,$awaygoals1);
                        $datetime1 = stripslashes($_REQUEST['datetime1']);

                        $datetime1 = mysqli_real_escape_string($con,$datetime1);


                        $venue1 = stripslashes($_REQUEST['venue1']);

                        $venue1 = mysqli_real_escape_string($con,$venue1);


                        $query1 = "UPDATE results SET datetime='$datetime1',venue='$venue1',hometeam='$hometeam1',awayteam='$awayteam1',homegoals='$homegoals1',awaygoals='$awaygoals1' WHERE resultid='$resultid'";

                        if ($con->query($query1) === TRUE) {
                            echo "Record updated successfully.  Click 
                         Here To <a href='knockout.php'>Update another</a>";
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
                    $result = mysqli_query($con,"SELECT * FROM results where username='$username'");

                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <table align="50%" border="2">

                            <tr>
                                <th>Update ID</th>
                                <th>Date And Time</th>
                                <th>Venue</th>
                                <th>Home Team</th>
                                <th>Away Team</th>
                                <th>Home Goals</th>
                                <th>Away Goals</th>
                            </tr>
                            <?php
                            $i=0;
                            while($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["resultid"]; ?></td>
                                    <td><?php echo $row["datetime"]; ?></td>
                                    <td><?php echo $row["venue"]; ?></td>
                                    <td><?php echo $row["hometeam"]; ?></td>
                                    <td><?php echo $row["awayteam"]; ?></td>
                                    <td><?php echo $row["homegoals"]; ?></td>
                                    <td><?php echo $row["awaygoals"]; ?></td>
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
                                    <td><h5>Update ID</h5></td>
                                    <td><input type="text" name="resultid"  required /> </td>
                                </tr>
                                <tr><td>Date And Time of the match</td>
                                    <td>  <input type="datetime-local" name="datetime1">
                                    </td></tr>
                                <tr><td>Venue of the match</td>
                                    <td>  <input type="text" name="venue1">
                                    </td></tr>
                                <tr>
                                    <td><h5>Home Team</h5></td>
                                    <td><input type="text" name="hometeam1"></td>
                                </tr>
                                <tr>
                                    <td><h5>Away Team</h5></td>
                                    <td><input type="text" name="awayteam1"></td>
                                </tr>
                                <tr>
                                    <td><h5>Home Goals</h5></td>
                                    <td><input type="text" name="homegoals1"></td>
                                </tr>
                                <tr>
                                    <td><h5>Away Goals</h5></td>
                                    <td><input type="text" name="awaygoals1"></td>
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


