<?php

//Including conn.php
//Starting session

session_start();
include('../../php/conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur'); //https://www.php.net/manual/en/timezones.asia.php

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

//Fetching the booking information via bid

$_sql = 'SELECT * FROM booking WHERE bid = "' . $_SESSION['bid'] . '"';

$_bdetails = mysqli_query($_conn, $_sql);

//Check if nothing is fetched

if (mysqli_num_rows($_bdetails) <= 0)
{
    echo 
    '
        <script>

            alert("A problem occurred while reserving your booking. Please try again later.");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "search.php";

        </script>
    ');

}

//Extracting fetched information into variables

$brow = mysqli_fetch_assoc($_bdetails);

$_departcountry = $brow['fdepartcty'];
$_arrivecountry = $brow['farrcty'];
$_departdate = $brow['fdepartdate'];
$_departdatef = date('j F Y', strtotime($brow['fdepartdate'])); //Changing departure date format for aesthetic purpose
$_airline = $brow['fairline'];
$_callsign = $brow['fcallsign'];
$_model = $brow['fmodel'];
$_class = $brow['fclass'];
$_departtime = $brow['fdeparttime'];
$_departtimef = date('H:i', strtotime($brow['fdeparttime'])); //Changing departure time format for aesthetic purpose
$_arrivetime = $brow['farrtime'];
$_arrivetimef = date('H:i', strtotime($brow['farrtime'])); //Changing arrival time format for aesthetic purpose
$_etaf = date('H:i', strtotime($brow['feta'])); //Changing estimated time of arrival format for aesthetic purpose
$_departcode = $brow['fdctycode'];
$_arrivecode = $brow['factycode'];
$_price = number_format($brow['fprice'], 2);
$_tax = number_format($brow['ftax'], 2);
$_surcharge = number_format($brow['fsurcharge'], 2);
$_total = number_format($brow['ftotal'], 2);
$_totalrnd = number_format($brow['ftotalrnd'], 2);


//Check if flight ETA is beyond a day/24hrs

$_ddate = new datetime($brow['fdepartdate'] . ' ' . $brow['fdeparttime']);
$_adate = new datetime($brow['farrdate'] . ' ' . $brow['farrtime']);
$_diff = $_adate->diff($_ddate);
$_daycnt = $_diff->format('%d');

$_etadisplay = '';

if ($_daycnt > 0 )
{
    $_etadisplay = $_daycnt . ' Day(s) Flight';
}
else
{
    $_etadisplay = ' Same Day Flight';
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Select Payment Method</title>
    <meta name="description" content="Selecting payment method for booking">
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
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #d0c7b7;">Review<img src="../../assets/img/selection-white/white.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="max-width: 210px;max-height: 80px;margin-top: 2px;">
                        <div style="width: 200px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                                href="search.php">Cancel</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1280px;">
        <div style="width: 1100px;position: absolute;top: 180px;left: 40px;"><img src="../../assets/img/selection-white/bg.png" height="600px" width="1100px">
            <div style="position: absolute;top: 30px;left: 90px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Select your payment method</h2>
            </div>
            <div style="position: absolute;top: 80px;left: 90px;">
                <h4 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 18px;">This is to ensure you pay using your most preferred method of transaction</h4>
            </div>
            <div style="position: absolute;top: 100px;left: 40px;width: 1000px;">
                <hr style="background-color: #ffffff;height: 2px;">
            </div>
            <div style="position: absolute;top: 190px;left: 40px;width: 1000px;"><a class="btn btn-primary btn-block shadow" role="button" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;background-color: rgb(241,89,70);border-color: rgba(255,255,255,0);" href="redirect.php">Credit/Debit Card</a></div>
            <div
                style="position: absolute;top: 300px;left: 40px;width: 1000px;"><a class="btn btn-primary btn-block shadow" role="button" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;background-color: rgb(241,89,70);border-color: rgba(255,255,255,0);" href="redirect.php">Online Banking</a></div>
        <div
            style="position: absolute;top: 410px;left: 40px;width: 1000px;"><a class="btn btn-primary btn-block shadow" role="button" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;background-color: rgb(241,89,70);border-color: rgba(255,255,255,0);" href="redirect.php">e-Wallet</a></div>
            </div>
            <div style="position: absolute;top: 180px;left: 1100px;padding-left: 80px;">
                <div style="position: relative;"><img src="../../assets/img/selection-white/onewayinfo.png">
                    <div class="text-center" style="position: absolute;top: 150px;left: -80px;width: 800px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 32px;"><?php echo strtoupper($_departcountry); ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 200px;left: 270px;width: 100px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 32px;">to</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 250px;left: -80px;width: 800px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 32px;"><?php echo strtoupper($_arrivecountry); ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 300px;left: 65px;width: 500px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 32px;"><?php echo $_departdatef; ?> | <?php echo $_class; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 390px;left: 380px;width: 220px;">
                    <h2 class="text-right" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo $_departdate; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 390px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo strtoupper($_departcountry) . ' to ' . strtoupper($_arrivecountry); ?></h2>
                </div>
                    <div class="text-center" style="position: absolute;top: 424px;left: 45px;">
                        <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo $_airline; ?> | <?php echo $_callsign; ?> | <?php echo $_model; ?> | <?php echo $_etaf; ?> hour(s)</h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 460px;left: 45px;">
                        <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo $_departcode; ?> <?php echo $_departtimef; ?> - <?php echo $_arrivetimef; ?> <?php echo $_arrivecode; ?></h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 495px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo strtoupper($_etadisplay); ?></h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 570px;left: 45px;">
                        <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 30px;">Base fare</h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 625px;left: 50px;">
                        <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">Ticket</h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 732px;left: 50px;">
                        <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">Taxes</h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 770px;left: 50px;">
                        <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">Surcharges</h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 810px;left: 50px;">
                        <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">Total (unrounded)</h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 625px;left: 360px;width: 250px;">
                        <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_price; ?></h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 732px;left: 360px;width: 250px;">
                        <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_tax; ?></h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 770px;left: 360px;width: 250px;">
                        <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_surcharge; ?></h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 810px;left: 360px;width: 250px;">
                        <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_total; ?></h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 690px;left: 45px;">
                        <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 30px;">Taxes and surcharges</h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 880px;left: 45px;">
                        <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 30px;">Total (rounded)</h2>
                    </div>
                    <div class="text-center" style="position: absolute;top: 880px;left: 360px;width: 250px;">
                        <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_totalrnd; ?></h2>
                    </div>
                    <div style="position: absolute;top: 845px;left: 40px;width: 560px;">
                        <hr style="background-color: #b7b5e4;height: 2px;">
                    </div>
                </div>
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