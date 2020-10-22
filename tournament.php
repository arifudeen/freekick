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
                <li><a href="">Notifications</a></li>

                <li><a href="#about">New tournament</a></li>
                <li><a href="">Tournament</a></li>
                <li><a href="">Set rules&regulations</a></li>
                <li><a href="">Complaints</a></li>
                <li class="book-a-table text-center"><a href="home.php">Logout</a></li>
            </ul>
        </nav>

    </div>
</header>


<section id="hero" class="d-flex align-items-center" >

    <div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-8">
                <h1>NEW  <span>TOURNAMENT</span></h1>
                <h2>Create a new Tournament here..</h2>

                <div class="btns">
                    <a href="#about" class="btn-book animated fadeInUp scrollto">Tournament</a>
                </div>
            </div>


        </div>
    </div>
</section>



<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">

            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" align="center">
                <h3>New Tournament.</h3>


            </div>
        </div>

    </div>
</section>



<section id="book-a-table" class="book-a-table">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2> New Tournament</h2>
            <p>
            <?php


            function main() {

                ?>

                <?php

                $name_array = explode(PHP_EOL,$team_num);

                $res = sortear_grelha($name_array);
                foreach ($res as $key => $value) {


                    $sql ="INSERT INTO fixture (team1,team2,tournament) VALUES (".$value[0].", ".$value[1].",".$tournmamnetid.")";
                    $stmt_insrt = $con->query($sql);


                }


                if (! isset($_GET['teams']) && ! isset($_GET['names'])) {
                    print get_form();
                } else {
                    print show_fixtures(isset($_GET['teams']) ?  nums(intval($_GET['teams'])) : explode("\n", trim($_GET['names'])));
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

                print "<p>Fixtures for $teams teams.</p>";

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
                            . "<input type='number' name='result1'> <input type='text' value='venue'><input type='button' value='VS' name='submit'><input type='datetime-local' value='date&time'><input type='number' name='result2'>   " . team_name($away + 1, $names);
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
                $components = explode("<input type='number' name='result1'> <input type='text' value='venue'><input type='button' value='VS' name='submit'><input type='datetime-local' value='date&time'><input type='number' name='result2'>  ", $match);
                return $components[1] . "<input type='number' name='result1'> <input type='text' value='venue'><input type='button' value='VS' name='submit'><input type='datetime-local' value='date&time'><input type='number' name='result2'>   " . $components[0];
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
                $s = '<p>Tournament Register</p>' . "\n";
                $s .= '<form action="' . $_SERVER['SCRIPT_NAME'] . '">' . "\n";
                $s .= '<label for="tournamentname">Name of tournament</label><input type="text" name="tournamentname" /><br>' . "\n";
                $s .= '<label for="mode">Tournament Mode&nbsp; &nbsp;League</label><input type="radio" name="mode" />Knockout<input type="radio" name="mode"><br>' . "\n";
                $s .= '<label for="teams">Number of Teams</label><input type="text" name="teams" /><br>' . "\n";
                $s .= '<input type="submit" value="Generate Fixtures" />' . "\n";
                $s .= '</form>' . "\n";

                $s .= '<form action="' . $_SERVER['SCRIPT_NAME'] . '">' . "\n";
                $s .= '<div><strong>OR</strong></div><br>' . "\n";
                $s .= '<label for="names">Names of Teams (one per line)</label>'
                    . '<textarea name="names" rows="8" cols="40"></textarea><br>' . "\n";
                $s .= '<input type="submit" value="Generate Fixtures" />' . "\n";
                $s .= "</form>\n";

                return $s;
            }

            main();

            ?>
                <?php
                session_start();
                $username=$_SESSION['username'];


                echo"$username";

                require('db.php');
                $teams = mysqli_query($con,"SELECT teams FROM tournament where id IN(SELECT id from register WHERE (username='$username'))");

                if (mysqli_num_rows($teams) > 0) {

                    $i=0;
                    while($row = mysqli_fetch_array($teams)) {
                        ?>
                        <tr>
                            <td><?php echo $row["teams"]; ?></td>
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
            </p>

        </div>

    </div>

</section>




<section id="gallery" class="gallery">

    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Rules and regulations</h2>
            <p>Set rules and regulation of tournament</p>
        </div>
        <?php
        require('db.php');
        if (isset($_REQUEST['rules'])){

            $rules = stripslashes($_REQUEST['rules']);

            $rules = mysqli_real_escape_string($con,$rules);


            $query = "INSERT into `rulesregulation` (rules)
                VALUES ('$rules')";
            $result = mysqli_query($con,$query);
            if($result){
                echo "<div class='form'>
                         <h3>Notification Is  Successfully Posted.</h3>
                             </div>";
            }
        }else{
            ?>
            <div class="form">
                <form name="rules" action="" method="post">
                    <table >
                        <tr>
                            <td><h5>Rules and Regulations</h5></td>
                            <td><textarea name="rules" rows="5" cols="30%"  required /></textarea> </td>
                        </tr>



                        <tr>
                            <td></td>
                            <td><h5><input type="submit" name="submit" value="post" /></h5></td>
                        </tr>
                    </table>
                </form>
            </div>
        <?php } ?>


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
