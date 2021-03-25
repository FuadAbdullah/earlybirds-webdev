<?php

//Starting session
//Including conn.php

session_start();
include('../../php/conn.php');

//Validate whether user has privilege to view the page

if (!isset($_SESSION['amid']))
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

            window.location.href = "amlogin.php";

        </script>
    ');
}

//Fetch today's date

$_todaydatetime = date('Y-m-d\TH:i');

//Add 1 year to today's date

$_yearadv = date('Y-m-d\TH:i', strtotime('+1 year', strtotime($_todaydatetime)));


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Flight to Schedule</title>
    <meta name="description" content="Adding flights to schedule">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../assets/css/overwrite.css">
    <link rel="stylesheet" href="../../assets/css/Scroll-Effect.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <form method = 'post' action = '../../php/amaddflight.php' >
    <main style="background-color: #FFEBC6;position: relative;min-height: 1000px;">
        <div style="background-color: #B7B5E4;height: 200px;padding-top: 200px;">
            <div style="position: absolute;top: 35px;left: 35px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Airport Management</h2>
            </div>
            <div style="position: absolute;top: 105px;left: 35px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Add Flight</h2>
            </div>
            <div style="position: absolute;top: 105px;left: 1290px;width: 320px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="amviewflight.php">View Flights</a></div>
            <div style="position: absolute;top: 105px;left: 1630px;width: 270px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="../../php/amsignout.php">Sign Out</a></div>
            <div style="position: absolute;top: 105px;left: 900px;width: 370px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="amviewbooking.php">View Bookings</a></div>
        </div>
        <div></div>
        <div style="position: relative;padding-bottom: 50px;padding-left: 240px;padding-top: 30px;">
            <div style="position: relative;width: 1400px;height: 1040px;background-color: #ffb100;border-radius: 60px;"></div>
            <form>
                <div style="position: absolute;top: 300px;left: 300px;width: 700px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "arrair" required="">
                    <option value="Kota Kinabalu International Airport">Kota Kinabalu International Airport</option>
                    <option value="Suvarnabhumi Airport">Suvarnabhumi Airport</option>
                    <option value="Dabolim Airport">Dabolim Airport</option>
                    <option value="Noi Bai International Airport">Noi Bai International Airport</option>
                    <option value="Jakarta International Airport">Jakarta International Airport</option>
                    <option value="Kuching International Airport">Kuching International Airport</option>
                    <option value="Kuala Lumpur International Airport" selected>Kuala Lumpur International Airport</option>
                    <option value="Ninoy Aquino International Airport">Ninoy Aquino International Airport</option>
                    <option value="Singapore Changi Airport">Singapore Changi Airport</option>
                    <option value="Tokyo International Airport">Tokyo International Airport</option>
                    </select>
                </div>

                <div style="position: absolute;top: 780px;left: 1020px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "callsign" placeholder="IATA" required=""></div>

                <div style="position: absolute;top: 140px;left: 300px;width: 700px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "deptair" required="">
                    <option value="Kota Kinabalu International Airport">Kota Kinabalu International Airport</option>
                    <option value="Suvarnabhumi Airport">Suvarnabhumi Airport</option>
                    <option value="Dabolim Airport">Dabolim Airport</option>
                    <option value="Noi Bai International Airport">Noi Bai International Airport</option>
                    <option value="Jakarta International Airport">Jakarta International Airport</option>
                    <option value="Kuching International Airport">Kuching International Airport</option>
                    <option value="Kuala Lumpur International Airport" selected>Kuala Lumpur International Airport</option>
                    <option value="Ninoy Aquino International Airport">Ninoy Aquino International Airport</option>
                    <option value="Singapore Changi Airport">Singapore Changi Airport</option>
                    <option value="Tokyo International Airport">Tokyo International Airport</option>
                    </select>
                </div>

                <div style="position: absolute;top: 460px;left: 1020px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="datetime-local" min="<?php echo $_todaydatetime; ?>" max="<?php echo $_yearadv; ?>" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "deptdatetime" required=""></div>
                <div style="position: absolute;top: 620px;left: 1020px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="datetime-local" min="<?php echo $_todaydatetime; ?>" max="<?php echo $_yearadv; ?>" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "arrdatetime" required=""></div>
                <!--<div style="position: absolute;top: 620px;left: 1380px;width: 200px;"><input class="border-white shadow form-control form-control-lg" type="time" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "arrtime" required=""></div>-->
                <div style="position: absolute;top: 460px;left: 300px;width: 550px;"><input class="border-white shadow form-control form-control-lg" type="number" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "price" required="" placeholder="No decimal required"></div>
                <div style="position: absolute;top: 780px;left: 300px;width: 550px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "airline" required="">
                    <option value="AirAsia">AirAsia</option>
                    <option value="All Nippon Airways">All Nippon Airways</option>
                    <option value="Emirates">Emirates</option>
                    <option value="Malaysia Airlines">Malaysia Airlines</option>
                    <option value="Singapore Airlines">Singapore Airlines</option>
                    <option value="Thai Airways">Thai Airways</option></select></div>
                <div
                    style="position: absolute;top: 620px;left: 300px;width: 550px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "model" required="">
                        <option value="A320" selected>A320</option>
                        <option value="A330">A330</option>
                        <option value="A340">A340</option>
                        <option value="A350">A350</option>
                        <option value="A380">A380</option>
                        <option value="B717">B717</option>
                        <option value="B727">B727</option>
                        <option value="B737">B737</option>
                        <option value="B747">B747</option>
                        <option value="B757">B757</option>
                        <option value="B767">B767</option>
                        <option value="B777">B777</option>
                        <option value="B787">B787</option></select></div>
        <div
            style="position: absolute;top: 930px;left: 300px;width: 550px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" name = "class" required="">
                <option value="Business">Business</option>
                <option value="Economy" selected>Economy</option>
                <option value="First Class">First Class</option></select></div>
            <div
                style="position: absolute;top: 930px;left: 1020px;width: 560px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffffff;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;">Add Flight</button></div>
                <div
                    style="position: absolute;top: 80px;left: 305px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Departure Airport</h2>
                    </div>
                    <div style="position: absolute;top: 390px;left: 1015px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Departure Date and Time</h2>
                    </div>
                    <div style="position: absolute;top: 550px;left: 1015px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Arrival Date and Time</h2>
                    </div>
                    <div style="position: absolute;top: 710px; left: 1015px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Callsign</h2>
                    </div>
                    <!--<div style="position: absolute;top: 550px;left: 1375px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Arrival</h2>
                    </div>-->
                    <div style="position: absolute;top: 230px;left: 305px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Arrival Airport</h2>
                    </div>
                    <div style="position: absolute;top: 390px;left: 305px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Price Per Pax (RM)</h2>
                    </div>
                    <!--<div style="position: absolute;top: 470px;left: 305px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">RM</h2>
                    </div>-->
                    <div style="position: absolute;top: 550px;left: 305px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Aircraft Model</h2>
                    </div>
                    <div style="position: absolute;top: 710px;left: 305px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Airline Company</h2>
                    </div>
                    <div style="position: absolute;top: 860px;left: 305px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Flight Class</h2>
                    </div>
                    </form>
                    </div>
    </main>
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
</form>
</body>

</html>