

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>registration</title>
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
                <li class="active"><a href="home.php">Home</a></li>

                <li class="book-a-table text-center"><a href="login.php">Login</a></li>
            </ul>
        </nav>

    </div>
</header>


<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-8">
                <h1>Welcome to <span>FREE KICK</span></h1>
                <h2>REGISTER</h2>
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
                <h3>Register</h3><br>
                <?php
                require('db.php');
                if (isset($_REQUEST['username'])){

                    $username = stripslashes($_REQUEST['username']);

                    $username = mysqli_real_escape_string($con,$username);
                    $email = stripslashes($_REQUEST['email']);
                    $email = mysqli_real_escape_string($con,$email);



                    $password = stripslashes($_REQUEST['password']);
                    $password2 = stripslashes($_REQUEST['password2']);
                    $password = stripslashes($_REQUEST['password']);


                    if ($password != $password2) {
                        echo  "<div class='form'>
                          <h3>Password Does Not Match.</h3>
                              <br/>Click here to <a href='registration.php'>register</a></div>";

                    }
                    else
                    {

                    $password = mysqli_real_escape_string($con,$password);


                    $mobile = stripslashes($_REQUEST['mobile']);
                    $mobile = mysqli_real_escape_string($con,$mobile);

                    $duplicate=mysqli_query($con,"select * from register where username='$username'");
if (mysqli_num_rows($duplicate)>0)
{
echo "User name is already exists.";
}
else{


                    $query = "INSERT into `register` (username, password, email, mobile)
VALUES ('$username', '".md5($password)."', '$email', '$mobile')";
                    $result = mysqli_query($con,$query);
                    if($result){
                        echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
                    }}}
                }else{
                    ?>
                    <div class="form">
                        <form name="registration" action="" method="post">
                            <table align="center">
                                <tr>
                                    <td><h5>User Name</h5></td>
                                    <td><input type="text" name="username" placeholder="" required /></td>
                                </tr>
                                <tr>
                                    <td><h5>Email</h5></td>
                                    <td><input type="email" name="email" placeholder="" required /></td>
                                </tr>
                                <tr>
                                    <td><h5>Mobile</h5></td>
                                    <td><input type="mobile" name="mobile" placeholder="" required /></td>
                                </tr>
                                <tr>
                                    <td><h5>Password</h5></td>
                                    <td><input type="password" name="password" placeholder="" required /></td>
                                </tr>

                                <tr>
                                    <td><h5>Confirm Password</h5></td>
                                    <td><input type="password" name="password2" placeholder="" required /></td>
                                </tr>


                                <tr>
                                    <td></td>
                                  <td><h5><input type="submit" name="submit" value="Register" /></h5></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                <?php } ?>


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