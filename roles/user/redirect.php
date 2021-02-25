<?php

//Including conn.php
//Starting session

session_start();
include('../../php/conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur'); //https://www.php.net/manual/en/timezones.asia.php

//Validate whether user has privilege to view the page

if (!isset($_SESSION['uid'], $_SESSION['bid']))
{
    echo 
    '
        <script>

            alert("You do not have proper authorisation to view this page!");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "login.php";

        </script>
    ');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Redirecting to secured gateway...</title>
    <meta name="description" content="Securing your transaction">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../assets/css/overwrite.css">
    <link rel="stylesheet" href="../../assets/css/Scroll-Effect.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <meta http-equiv="refresh" content="5;url=../../php/usrredirect.php">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top bg-white" style="-webkit-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);-moz-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-md fixed-top" style="/*-webkit-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*//*-moz-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*//*box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*/height: 200px;width: 200px;position: absolute;top: -50px;left: -50px;">
                <div class="container-fluid"><img src="../../assets/img/landingpage-red/Overhd3.png"></div>
            </nav><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="padding-left: 310px;">
                <ul class="nav navbar-nav text-center">
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;margin-left: 190px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Customer Information<img src="../../assets/img/selection-white/red.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Payment<img src="../../assets/img/selection-white/yel.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 298px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #d0c7b7;">Review<img src="../../assets/img/selection-white/white.png"></h3>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1280px;">
        <div style="width: 1100px;position: absolute;top: 150px;left: 280px;"><img src="../../assets/img/selection-white/bg.png" height="880px" width="1400px">
            <div style="position: absolute;top: 360px;left: 200px;width: 1000px;">
                <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Redirecting to payment site</h2>
            </div>
            <div class="text-center" style="position: absolute;top: 410px;left: 200px;width: 1000px;"><a class="text-center" href="../../php/usrredirect.php" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 25px;"><br>Click here if your browser does not redirect you<br><br></a></div>
        </div>
    </main>
    <footer>
        <nav class="navbar navbar-light navbar-expand-md" style="background-color: #32161f;border-radius: 0px;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navcol-1" style="background-color: #32161f;/*margin-left: -28px;*/">
                    <div style="width: 1830px;">
                        <hr style="background-color: #ffffff;height: 2px;"><img src="../../assets/img/landingpage-red/©%202020%20EarlyBirds,%20Inc.%20All%20rights%20reserved.png" style="margin-right: 10px;"></div>
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