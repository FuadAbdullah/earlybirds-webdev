<?php

//Including conn.php
//Starting session

session_start();
include('../../php/conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Validate whether user has privilege to view the page

if (!isset($_SESSION['uid'], $_GET['bid']))
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

//Fetch required information for display via booking id

$_bid = $_GET['bid'];

$_sql = 'SELECT * FROM booking WHERE bid = "' . $_bid . '"';

$_bdetails = mysqli_query($_conn, $_sql);

//Check if nothing is fetched

if (mysqli_num_rows($_bdetails) <= 0)
{
    echo 
    '
        <script>

            alert("A problem occurred while retrieving your booking information!");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "profile.php";

        </script>
    ');

}

//Extracting fetched information into variables

$brow = mysqli_fetch_assoc($_bdetails);

$_airline = $brow['fairline'];
$_departcountry = $brow['fdepartcty'];
$_arrivecountry = $brow['farrcty'];
$_departcode = $brow['fdctycode'];
$_arrivecode = $brow['factycode'];
$_departdate = $brow['fdepartdate'];
$_arrdate = $brow['farrdate'];
$_callsign = $brow['fcallsign'];
$_model = $brow['fmodel'];
$_class = $brow['fclass'];
$_status = $brow['status'];
$_departtime = $brow['fdeparttime'];
$_arrivetime = $brow['farrtime'];
$_tixno = $brow['tid'];
$_fmname = mysqli_real_escape_string($_conn, $brow['fm_name']);
$_lname = mysqli_real_escape_string($_conn, $brow['l_name']);
$_gender = $brow['gender'];
$_tax = number_format($brow['ftax'], 2);
$_surcharge = number_format($brow['fsurcharge'], 2);
$_totalrnd = number_format($brow['ftotalrnd'], 2);

//Decide whether the passenger is male, female or others for honorifics

if ($_gender == "Male")
{
    $_honor = "MR";
}
else if ($_gender == "Female")
{
    $_honor = "MRS";
}
else
{
    $_honor = "";
}

//Rewriting some variables for display purpose

$_bidf = sprintf('%05d', $_bid); //https://stackoverflow.com/questions/324358/zero-pad-digits-in-string
$_departdatef = date('l, j F Y', strtotime($brow['fdepartdate']));
$_departdatef2 = date('d/m/Y', strtotime($brow['fdepartdate']));
$_arrdatef = date('d/m/Y', strtotime($brow['farrdate']));
$_departtimef = date('H:i', strtotime($brow['fdeparttime']));
$_arrivecountryf = strtoupper($brow['farrcty']);
$_departcountryf = strtoupper($brow['fdepartcty']);
$_arrivetimef = date('H:i', strtotime($brow['farrtime']));
$_etaf = date('H:i', strtotime($brow['feta']));
$_classf = strtoupper($_class);
$_statusf = strtoupper($_status);
$_fmnamef = strtoupper($_fmname);
$_lnamef = strtoupper($_lname);

//Check if flight ETA is beyond a day/24hrs

$_ddate = new datetime($_departdate . ' ' . $_departtime);
$_adate = new datetime($_arrdate . ' ' . $_arrivetime);
$_diff = $_adate->diff($_ddate);
$_daycnt = $_diff->format('%d');

$_etadisplay = '';

if ($_daycnt > 0 )
{
    $_etadisplay = $_daycnt . ' DAY(S) ' . $_etaf . ' HOUR(S)';
}
else
{
    $_etadisplay = $_etaf . ' HOUR(S)';
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Flight Review</title>
    <meta name="description" content="Review your book flights">
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
                <ul class="nav navbar-nav text-center">
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;margin-left: 190px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Customer Information<img src="../../assets/img/selection-white/red.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Payment<img src="../../assets/img/selection-white/yel.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 298px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Review<img src="../../assets/img/selection-white/white.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="max-width: 210px;max-height: 80px;margin-top: 2px;">
                        <div style="width: 200px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                                href="search.php">Return</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main style="background-color: #FFEBC6;position: relative;min-height: 830px;">
        <div style="position: relative;">
            <div style="position: absolute;top: 150px;left: 500px;">
                <h1 style="color: rgb(0,0,0);font-size: 50px;font-family: Montserrat, sans-serif;font-weight: 500;">E-Ticket Receipt and Travel Itenary</h1>
            </div>
            <div style="position: absolute;top: 220px;left: 160px;width: 1580px;">
                <hr style="background-color: #000000;height: 2px;">
            </div>
            <div class="text-center" style="position: absolute;top: 260px;left: 500px;">
                <h1 style="color: rgb(0,0,0);font-size: 22px;font-family: Montserrat, sans-serif;font-weight: 500;">A copy of this ticket is sent to the email address specified in contact details</h1>
                <h6 class="text-center" style="color: rgb(0,0,0);font-size: 22px;font-family: Montserrat, sans-serif;font-weight: 500;">This booking is saved to your booking history.&nbsp;<a class="text-center" href="profile.php" style="color: #C500FF;"><span>Click here to go to your profile.</span></a></h6>
            </div>
        </div>
        <div style="position: relative;top: 350px;padding-left: 120px;height: 1650px;">
            <div style="position: relative;height: 1300px;"><img src="../../assets/img/review-white/bg.png" height="1200px">
                <div style="position: absolute;top: 50px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 50px;font-family: Montserrat, sans-serif;font-weight: 600;"><?php echo $_airline; ?></h1>
                </div>
                <div style="position: absolute;top: 50px;left: 930px;width: 650px;">
                    <h1 class="text-right" style="color: rgb(255,255,255);font-size: 50px;font-family: Montserrat, sans-serif;font-weight: 600;">Booking no: <?php echo $_bidf; ?></h1>
                </div>
                <div style="position: absolute;top: 160px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 25px;font-family: Montserrat, sans-serif;font-weight: 400;"><?php echo $_departcountryf; ?>/<?php echo $_departcode; ?> to <?php echo $_arrivecountryf; ?>/<?php echo $_arrivecode; ?> departing on <?php echo $_departdatef; ?></h1>
                </div>
                <div style="position: absolute;top: 280px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 500;"><?php echo $_callsign; ?> - <?php echo $_model; ?> - <?php echo $_classf; ?> - ETA <?php echo $_etadisplay; ?> - <?php echo $_statusf; ?></h1>
                </div>
                <div style="position: absolute;top: 340px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 500;">Departure</h1>
                </div>
                <div style="position: absolute;top: 460px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 500;">Arrival</h1>
                </div>
                <div style="position: absolute;top: 630px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 500;">Ticket Details</h1>
                </div>
                <div style="position: absolute;top: 880px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 500;">Total Paid</h1>
                </div>
                <div style="position: absolute;top: 400px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 300;"><?php echo $_departcountryf; ?>/<?php echo $_departcode; ?> | <?php echo $_departdatef2; ?> <?php echo $_departtimef; ?> hours</h1>
                </div>
                <div style="position: absolute;top: 520px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 300;"><?php echo $_arrivecountryf; ?>/<?php echo $_arrivecode; ?> | <?php echo $_arrdatef; ?> <?php echo $_arrivetimef; ?> hours</h1>
                </div>
                <div style="position: absolute;top: 690px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 300;">Ticket no: <?php echo $_tixno; ?></h1>
                </div>
                <div style="position: absolute;top: 750px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 300;"><?php echo $_fmnamef; ?>/<?php echo $_lnamef; ?>, <?php echo $_honor; ?></h1>
                </div>
                <div style="position: absolute;top: 1040px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 300;">Total: RM<?php echo $_totalrnd; ?></h1>
                </div>
                <div style="position: absolute;top: 990px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 300;">Surcharge: RM<?php echo $_surcharge; ?></h1>
                </div>
                <div style="position: absolute;top: 940px;left: 80px;">
                    <h1 style="color: rgb(255,255,255);font-size: 35px;font-family: Montserrat, sans-serif;font-weight: 300;">Tax: RM<?php echo $_tax
                    ; ?></h1>
                </div>
                <div style="position: absolute;top: 220px;left: 10px;width: 1630px;">
                    <hr style="background-color: #ffffff;height: 2px;">
                </div>
                <div style="position: absolute;top: 580px;left: 10px;width: 1630px;">
                    <hr style="background-color: #ffffff;height: 2px;">
                </div>
                <div style="position: absolute;top: 820px;left: 10px;width: 1630px;">
                    <hr style="background-color: #ffffff;height: 2px;">
                </div>
            </div>
        </div>
        <div style="position: relative;padding-top: 310px;">
            <div class="text-center" style="position: absolute;top: 30px;left: 740px;">
                <h1 class="text-center" style="color: rgb(0,0,0);font-size: 50px;font-family: Montserrat, sans-serif;font-weight: 500;">End of Review</h1>
            </div>
            <div class="text-center" style="position: absolute;top: 100px;left: 460px;">
                <h1 style="color: rgb(0,0,0);font-size: 22px;font-family: Montserrat, sans-serif;font-weight: 500;">Thank you for choosing EarlyBirds as your online booking platform! Have a safe flight</h1>
            </div>
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
    
    //Close ongoing connection and free up fetch memory
    include('../../php/closeconn.php');

    ?>
</body>

</html>