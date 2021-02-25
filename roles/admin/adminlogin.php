
<?php

//Starting session
//Including conn.php

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

session_start();
include('../../php/conn.php');

//Check if user has already logged in

if (isset($_SESSION['aid']))
{
    die(
    '
        <script>

            window.location.href = "adminviewuser.php";

        </script>
    ');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Administrator Login</title>
    <meta name="description" content="Login to administrator account">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../assets/css/overwrite.css">
    <link rel="stylesheet" href="../../assets/css/Scroll-Effect.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <div class="card">
        <div class="card-body" style="background-color: #F15946;height: 1000px;">
            <div class="container" style="position: absolute;top: 110px;left: 400px;width: 1000px;padding-left: 60px;"><img src="../../assets/img/loginpage-red/loginbg.png"></div>
            <div class="container" style="position: absolute;top: 200px;left: 425px;width: 1000px;padding-left: 60px;">
                <h1 class="text-center" style="font-family: Montserrat, sans-serif;">Administrator Login Interface</h1>
            </div>
            <div class="container" style="position: absolute;top: 500px;left: 595px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 200px;">Password</h2>
            </div>
            <div class="container" style="position: absolute;top: 330px;left: 595px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 200px;">Username</h2>
            </div>
            <form style="position: absolute;top: 170px;left: 640px;min-width: 620px;" method = 'POST' action = '../../php/adminlogin.php'>
                <input class="border-white shadow form-control form-control-lg" type="text" style="font-family: Montserrat, sans-serif;font-size: 40px;position: absolute;top: 220px;left: 0px;" placeholder="johnbuckle" required="" name="admusr">
                <input class="shadow form-control form-control-lg" type="password" style="position: absolute;top: 390px;left: 0px;font-family: Montserrat, sans-serif;font-size: 40px;" size="25" placeholder="********" required="" name="admpass">
                <button
                    class="btn btn-primary" type="submit" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;position: absolute;top: 490px;left: -35px;background-color: rgba(0,123,255,0);border-color: rgba(255,255,255,0);" ><img src="../../assets/img/loginpage-red/signinmain.png"></button>
            </form>
        </div>
    </div>
    <footer>
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

    //Close ongoing connection and free up variables
    include('../../php/closeconn.php');

    ?>
</body>

</html>