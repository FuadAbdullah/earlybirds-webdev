<?php

//Starting session
//Including conn.php

session_start();
include('../../php/conn.php');

//Validate whether user has privilege to view the page

if (!isset($_SESSION['aid']))
{
    echo 
    '
        <script>

            alert("You do not have proper authorisation to view this page. Please login before continuing.");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "adminlogin.php";

        </script>
    ');
}

$_sql = 'SELECT * FROM admin WHERE aid = ' . $_SESSION['aid'];

$_adminfo = mysqli_query($_conn, $_sql);

$_admrow = mysqli_fetch_assoc($_adminfo);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register an Admin</title>
    <meta name="description" content="Registering an administrator account">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../assets/css/overwrite.css">
    <link rel="stylesheet" href="../../assets/css/Scroll-Effect.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <div style="background-color: #f15946;height: 200px;padding-top: 200px;">
        <div style="position: absolute;top: 35px;left: 35px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Administrator</h2>
        </div>
        <div style="position: absolute;top: 25px;left: 965px;width: 900px;">
            <h2 class="text-right" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;"><?php echo $_admrow['full_name']; ?></h2>
        </div>
        <div style="position: absolute;top: 105px;left: 35px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Register Administrator</h2>
        </div>
        <div style="position: absolute;top: 105px;left: 1630px;width: 270px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                href="adminviewadmin.php">Return</a></div>
    </div>
    <div class="card">
        <div class="card-body" style="background-color: #B7B5E4;height: 1600px;">
            <div class="container" style="position: absolute;top: 60px;left: 400px;width: 1000px;padding-left: 60px;"><img src="../../assets/img/registerpage-blue/regbg.png" style="height: 1550px;width: 960px;"></div>
            <div class="container" style="position: absolute;top: 140px;left: 430px;width: 1000px;padding-left: 60px;">
                <h1 class="text-center" style="font-family: Montserrat, sans-serif;">Register Administrator</h1>
            </div>
            <div class="container" style="position: absolute;top: 275px;left: 595px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 190px;">Full name<span style="color: #f15946;">*</span></h2>
            </div>
            <div class="container" style="position: absolute;top: 445px;left: 595px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 200px;">Username<span style="color: #f15946;">*</span></h2>
            </div>
            <div class="container" style="position: absolute;top: 610px;left: 595px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 270px;">Password<span style="color: #f15946;">*</span></h2>
            </div>
            <div class="container" style="position: absolute;top: 775px;left: 595px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 330px;">Confirm Password<span style="color: #f15946;">*</span></h2>
            </div>
            <div class="container" style="position: absolute;top: 940px;left: 595px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 310px;">Contact Number<span style="color: #f15946;">*</span></h2>
            </div>
            <div class="container" style="position: absolute;top: 1110px;left: 595px;width: 500px;padding-left: 60px;">
                <h2 class="text-left" style="font-family: Montserrat, sans-serif;max-width: 310px;">Email Address<span style="color: #f15946;">*</span></h2>
            </div>
            <form method="post" action="../../php/adminregister.php" style="position: absolute;top: 170px;left: 640px;min-width: 620px;">
                <input class="border-white shadow form-control form-control-lg" type="text" style="font-family: Montserrat, sans-serif;font-size: 40px;position: absolute;top: 160px;left: 10px;" placeholder="John Arbuckle" required="" name="admname" minlength="3"
                    maxlength="40">
                    <input class="border-white shadow form-control form-control-lg" type="text" style="font-family: Montserrat, sans-serif;font-size: 40px;position: absolute;top: 330px;left: 10px;" placeholder="johnbuckle" required="" name="admusr"
                    minlength="6" maxlength="24">
                    <input class="shadow form-control form-control-lg" type="password" style="position: absolute;top: 495px;left: 10px;font-family: Montserrat, sans-serif;font-size: 40px;" size="25" placeholder="********" required=""
                    name="admpass" maxlength="16" minlength="6">
                    <input class="shadow form-control form-control-lg" type="password" style="position: absolute;top: 665px;left: 10px;font-family: Montserrat, sans-serif;font-size: 40px;" size="25" placeholder="********"
                    required="" name="admreppass" maxlength="16" minlength="6">
                    <input class="border-white shadow form-control form-control-lg" type="tel" style="position: absolute;top: 825px;left: 10px;font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="0176503929" required="" name="admcontact" minlength="5"
                    maxlength="14">
                    <input class="border-white shadow form-control form-control-lg" type="email" style="position: absolute;top: 1000px;left: 10px;font-family: Montserrat, sans-serif;font-size: 40px;" required="" placeholder="johnarbuckle@gmail.com" name="admemail"
                        minlength="3" maxlength="32">
                    <button class="btn btn-primary" type="submit" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;position: absolute;top: 1115px;left: -30px;background-color: rgba(255,255,255,0);border-color: rgba(255,255,255,0);"><img src="../../assets/img/registerpage-blue/createmain.png"></button>
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

    //Close ongoing connection and free up fetch memory
    include('../../php/closeconn.php');
    ?>
</body>

</html>