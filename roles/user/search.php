<?php

//Starting session
//Including conn.php

session_start();
include('../../php/conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Validate whether user has privilege to view the page

if (!isset($_SESSION['uid']))
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

            window.location.href = "login.php";

        </script>
    ');
}

//Fetch today's date

$_todaydate = date('Y-m-d');

//Add 1 year to today's date

$_yearadv = date('Y-m-d', strtotime('+1 year', strtotime($_todaydate)));

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Search For Flight</title>
    <meta name="description" content="Search for your flight">
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
            <div class="collapse navbar-collapse" id="navcol-1" style="padding-left: 310px;">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;">
                        <a class="nav-link" href="../../general/landing.html" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/">
                            <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Landing</h3>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;">
                        <a class="nav-link" href="../../general/about.html" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/">
                            <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">About Us</h3>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 760px;">
                        <a class="nav-link" href="../../general/faqhelp.html" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/">
                            <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">FAQs</h3>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation"><img src="../../assets/img/loginpage-red/vertlinenavbar.png"></li>
                    <li class="nav-item" role="presentation" style="max-width: 210px;max-height: 80px;margin-top: -5px;"><a class="nav-link" href="profile.php" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/"><img src="../../assets/img/search-white/prof.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1000px;">
        <div style="padding-top: 100px;padding-bottom: 30px;padding-left: 30px;"><img src="../../assets/img/search-white/bg.png" height="1060px">
            <form style="position: absolute;top: 360px;left: 200px;" action="searchres.php" method="post">
                <div style="position: absolute;top: 100px;left: 50px;width: 620px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;border-radius: 30px;" placeholder="Local Airport" required="" name="deptair" minlength="3" maxlength="64"></div>

                <div style="position: absolute;top: 300px;left: 50px;width: 620px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;border-radius: 30px;" placeholder="Destination Airport" required="" minlength="3" maxlength="64" name="arrair"></div>

                <div style="position: absolute;top: 100px;left: 800px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="date" min="<?php echo $_todaydate; ?>" max="<?php echo $_yearadv; ?>"style="font-family: Montserrat, sans-serif;font-size: 40px;border-radius:30px;" required="" name="deptdate"></div>
                
                <div style="position: absolute;top: 300px;left: 800px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="time" style="font-family: Montserrat, sans-serif;font-size: 40px;border-radius: 30px;" required="" name="depttime"></div>
                <div style="position: absolute;top: 480px;left: 50px;width: 620px;"><select class="shadow custom-select custom-select-lg" style="font-family: Montserrat, sans-serif;font-size: 40px;border-radius: 30px;" required="" name="seatclass">
                    <option value="Business">Business</option>
                    <option value="First Class">First</option>
                    <option value="Economy" selected="">Economy</option></select></div>
                <div style="position: absolute;top: 460px;left: 778px;"><button class="btn btn-primary" type="submit" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;background-color: rgba(255,255,255,0);border-color: rgba(255,255,255,0);"><img src="../../assets/img/search-white/search.png" /></button></div>
        </form>
        <div style="position: absolute;top: 390px;left: 245px;">
            <h2 id="test123" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Departure Airport</h2>
        </div>
        <div style="position: absolute;top: 590px;left: 245px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Arrival Airport</h2>
        </div>
        <div style="position: absolute;top: 780px;left: 245px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Class</h2>
        </div>
        <div style="position: absolute;top: 390px;left: 1000px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Departure Date</h2>
        </div>
        <div style="position: absolute;top: 590px;left: 1000px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Departure Time</h2>
        </div>
        <div style="position: absolute;top: 590px;left: 1000px;"></div>
        </div>
    </main>
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

    //Close ongoing connection and free up variables
    include('../../php/closeconn.php');

    ?>


</body>

</html>