<?php

//Starting session
//Including conn.php

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

session_start();
include('../../php/conn.php');

//Check if user has already logged in

if (isset($_SESSION['uid']))
{
    die(
    '
        <script>

            window.location.href = "search.php";

        </script>
    ');
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Earlybirds - Login to account</title>
    <meta name="description" content="Login to account">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../assets/css/overwrite.css">
    <link rel="stylesheet" href="../../assets/css/Scroll-Effect.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top bg-white" style="-webkit-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);-moz-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-md fixed-top" style="/*-webkit-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*//*-moz-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*//*box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*/height: 200px;width: 200px;position: absolute;top: -50px;left: -50px;">
                <div class="container-fluid"><img src="../../assets/img/landingpage-red/Overhd3.png"></div>
            </nav><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="padding-left: 1430px;">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><img src="../../assets/img/loginpage-red/vertlinenavbar.png"></li>
                    <li class="nav-item" role="presentation" style="max-width: 196px;max-height: 80px;margin-top: -5px;margin-right: -15px;"><a class="nav-link" href="login.php" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/"><img src="../../assets/img/loginpage-red/signinnavbar.png"></a></li>
                    <li class="nav-item" role="presentation"
                        style="max-width: 210px;max-height: 80px;margin-top: -5px;"><a class="nav-link" href="register.html" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/"><img src="../../assets/img/loginpage-red/registernavbar.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="card">
        <div class="card-body" style="background-color: #F15946;height: 1000px;">
            <div class="container" style="position: absolute;top: 150px;left: 400px;width: 1000px;padding-left: 60px;"><img src="../../assets/img/loginpage-red/loginbg.png"></div>
            <div class="container" style="position: absolute;top: 230px;left: 435px;width: 1000px;padding-left: 60px;">
                <h1 class="text-center" style="font-family: Montserrat, sans-serif;">Sign in to your account to<br>keep track of your bookings</h1>
            </div>
            <div class="container" style="position: absolute;top: 510px;left: 615px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 200px;">Password</h2>
            </div>
            <div class="container" style="position: absolute;top: 340px;left: 615px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 300px;">Username</h2>
            </div>
            <div class="container" style="position: absolute;top: 670px;left: 615px;width: 500px;padding-left: 60px;"><a href="#" style="color: #C500FF;"></a></div>

            <form style="position: absolute;top: 170px;left: 640px;min-width: 620px;" action="../../php/usrlogin.php" method="post"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;position: absolute;top: 230px;left: 10px;" placeholder="johnarbuckle23" name="usrname" required=""
                    minlength="3" maxlength="24"><input class="shadow form-control form-control-lg" type="password" style="position: absolute;top: 400px;left: 10px;font-family: Montserrat, sans-serif;font-size: 40px;" size="25" placeholder="********" required=""
                    name="usrpass" minlength="6" maxlength="16"><a href="#start" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;position: absolute;top: 530px;left: -10px;"></a><button class="btn btn-primary" type="submit" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;position: absolute;top: 520px;left: -25px;background-color: rgba(0,123,255,0);border-color: rgba(255,255,255,0);"><img src="../../assets/img/loginpage-red/signinmain.png" /></button></form>

            <div
                class="container text-center" style="position: absolute;top: 810px;left: 640px;width: 680px;">
                <h6 class="text-center" style="font-family: Montserrat, sans-serif;max-width: 600px;font-size: 14px;color: rgb(0,0,0);">By signing in, I agree to EarlyBirds'&nbsp;<a class="text-center" href="../../general/terms.html" style="color: #C500FF;"><span>Terms of Use</span></a><span>&nbsp;and&nbsp;</span><a class="text-center" href="../../general/privacy.html" style="color: #C500FF;"><span>Privacy Policy</span></a>
                    
                </h6>
        </div>
        <div class="container text-center" style="position: absolute;top: 890px;left: 640px;width: 680px;">
            <h6 class="text-center" style="font-family: Montserrat, sans-serif;max-width: 600px;font-size: 14px;color: rgb(0,0,0);">No account?&nbsp;<a class="text-center" href="register.html" style="color: #C500FF;"><span>Create one here</span></a></h6>
        </div>
    </div>
    </div>
    <footer>
        <nav class="navbar navbar-light navbar-expand-md" style="background-color: #32161f;border-radius: 0px;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse text-left" id="navcol-1" style="background-color: #32161f;">
                    <div style="padding-left: 365px;padding-top: 40px;padding-bottom: 40px;">
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="register.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Register an account</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="login.php" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Sign in to account</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="profile.php" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Go to profile</span></a></div>
                        <div style="margin-top: 5px;max-width: 290px;"><a class="text-left" href="profile.php" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Review booking history</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="search.php" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Search for a flight</span></a></div>
                    </div>
                    <div style="margin-top: -40px;padding-left: 205px;padding-top: 0px;padding-bottom: 40px;">
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/faqhelp.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">FAQs</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/faqhelp.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Help</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/privacy.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Privacy Policy</span></a></div>
                        
                    </div>
                    <div style="margin-top: -80px;padding-left: 205px;padding-top: 40px;padding-bottom: 40px;">
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/terms.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Terms of Use</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/about.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">About Us</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/landing.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Landing Page</span></a></div>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-light navbar-expand-md" style="background-color: #32161f;border-radius: 0px;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navcol-1" style="background-color: #32161f;/*margin-left: -28px;*/">
                    <div>
                    <hr style="background-color: #ffffff;height: 2px;">
                    <img src="../../assets/img/landingpage-red/©%202020%20EarlyBirds,%20Inc.%20All%20rights%20reserved.png" style="margin-right: 10px;">
                    <a class="text-center" href="../../general/faqhelp.html" style="color: #C500FF;"><img src="../../assets/img/landingpage-red/FAQ.png" style="margin-right: 10px;"></a>
                    <a class="text-center" href="../../general/privacy.html" style="color: #C500FF;"><img src="../../assets/img/landingpage-red/Privacy.png" style="margin-right: 10px;"></a>
                    <a class="text-center" href="../../general/terms.html" style="color: #C500FF;"><img src="../../assets/img/landingpage-red/Terms.png" style="margin-right: 10px;"></a>
                    <a class="text-center" href="../../general/about.html" style="color: #C500FF;"><img src="../../assets/img/landingpage-red/About.png" style="margin-right: 620px;"></a>
                        </div>
            </div>
        </nav>
    </footer>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/Scroll-Effect.js"></script>
    <?php
    
    //Close ongoing connection and free up fetch memory
    include('../../php/closeconn.php');

    ?>
</body>

</html>