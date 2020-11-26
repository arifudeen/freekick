<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>login</title>
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

        <h1 class="logo mr-auto"><a href="index.html"><b>FREE KICK</b></a></h1>


        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="coordinator.php">home</a></li>
                <li><a href="league.php">League Tournament</a></li>
                <li class="book-a-table text-center"><a href="home.php">Logout</a></li>
            </ul>
        </nav>

    </div>
</header>




<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">

            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                <h3>POINT TABLE</h3><br><br><br>
                <h2>
                    <?php
                    session_start();

                    require('db.php');
                    $username=$_SESSION['username'];
                    $result1 = mysqli_query($con,"SELECT * FROM tournament where username='$username' and mode='league'");

                    if (mysqli_num_rows($result1) > 0) {
                    ?>
                    <table>

                        <?php
                        $i=0;
                        while($row = mysqli_fetch_array($result1)) {
                            $tournamentid2=$row["tournamentid"];
                            $i++;
                        }

                    }
                    else{
                        echo "No result found";
                    }



                    $result = mysqli_query($con,"select 
    team, 
    count(*) played, 
    count(case when homegoals > awaygoals then 1 end) wins, 
    count(case when awaygoals> homegoals then 1 end) lost, 
    count(case when homegoals = awaygoals then 1 end) draws, 
    sum(homegoals) homegoals, 
    sum(awaygoals) awaygoals, 
    sum(homegoals) - sum(awaygoals) goal_diff,
    sum(
          case when homegoals > awaygoals then 3 else 0 end 
        + case when homegoals = awaygoals then 1 else 0 end
    ) score 
from (
    select hometeam team, homegoals, awaygoals from results where tournamentid='$tournamentid2'
  union all
    select awayteam, awaygoals, homegoals from results where tournamentid='$tournamentid2'
) a 
group by team
order by score desc, goal_diff desc;");

                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <table align="center" border="5">

                            <tr>
                                <th>TEAM</th>
                                <th>MP</th>
                                <th>MW</th>
                                <th>ML</th>
                                <th>MD</th>
                                <th>GA</th>
                                <th>GC</th>
                                <th>GD</th>
                                <th>PTS</th>
                            </tr>
                            <?php
                            $i=0;
                            while($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["team"]; ?></td>
                                    <td><?php echo $row["played"]; ?></td>
                                    <td><?php echo $row["wins"]; ?></td>
                                    <td><?php echo $row["lost"]; ?></td>
                                    <td><?php echo $row["draws"]; ?></td>
                                    <td><?php echo $row["homegoals"]; ?></td>
                                    <td><?php echo $row["awaygoals"]; ?></td>
                                    <td><?php echo $row["goal_diff"]; ?></td>
                                    <td><?php echo $row["score"]; ?></td>
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
                </h2>



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
            </center>
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
