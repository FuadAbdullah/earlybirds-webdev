
<?php

//Starting session
//Including conn.php

session_start();
include('../../php/conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

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

$_sql = 'SELECT * FROM booking ORDER BY bid';
$_focused = '';


if (isset($_GET['focus']) && !empty($_GET['focus']))
{
    $_sql = 'SELECT * FROM booking WHERE bid = ' . $_GET['focus'];
    $_focused = $_GET['focus'];
}
else
{
    if (isset($_POST['filter']))
    {
        if ($_POST['sort'] == 'Default')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY bid';
        }
        else if ($_POST['sort'] == 'DefaultDesc')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY bid DESC';
        }
        else if ($_POST['sort'] == 'UID')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY uid';
        }
        else if ($_POST['sort'] == 'UIDDesc')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY uid DESC';
        }
        else if ($_POST['sort'] == 'FID')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY fid';
        }
        else if ($_POST['sort'] == 'FIDDesc')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY fid DESC';
        }
        else if ($_POST['sort'] == 'Price')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY fprice';
        }
        else if ($_POST['sort'] == 'PriceDesc')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY fprice DESC';
        }
        else if ($_POST['sort'] == 'ETA')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY feta';
        }
        else if ($_POST['sort'] == 'ETADesc')
        {
            $_sql = 'SELECT * FROM booking WHERE bid LIKE "%' . $_POST['filter'] . '%" or
                                        uid LIKE "%' . $_POST['filter'] . '%" or
                                        fid LIKE "%' . $_POST['filter'] . '%" or
                                        tid LIKE "%' . $_POST['filter'] . '%" or
                                        first_name LIKE "%' . $_POST['filter'] . '%" or
                                        last_name LIKE "%' . $_POST['filter'] . '%" or
                                        contact_number LIKE "%' . $_POST['filter'] . '%" or
                                        email_address LIKE "%' . $_POST['filter'] . '%" or
                                        fairline LIKE "%' . $_POST['filter'] . '%" or
                                        fprice LIKE "%' . $_POST['filter'] . '%" or
                                        fcallsign LIKE "%' . $_POST['filter'] . '%" or
                                        fmodel LIKE "%' . $_POST['filter'] . '%" or
                                        fclass LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartcty LIKE "%' . $_POST['filter'] . '%" or
                                        farrcty LIKE "%' . $_POST['filter'] . '%" or
                                        fdepartdate LIKE "%' . $_POST['filter'] . '%" or
                                        farrdate LIKE "%' . $_POST['filter'] . '%" or
                                        fdeparttime LIKE "%' . $_POST['filter'] . '%" or
                                        farrtime LIKE "%' . $_POST['filter'] . '%" or
                                        feta LIKE "%' . $_POST['filter'] . '%" or
                                        fdctycode LIKE "%' . $_POST['filter'] . '%" or
                                        factycode LIKE "%' . $_POST['filter'] . '%" or
                                        fm_name LIKE "%' . $_POST['filter'] . '%" or
                                        l_name LIKE "%' . $_POST['filter'] . '%" or
                                        dateofbirth LIKE "%' . $_POST['filter'] . '%" or
                                        gender LIKE "%' . $_POST['filter'] . '%" or
                                        nationality LIKE "%' . $_POST['filter'] . '%" or
                                        countryoforigin LIKE "%' . $_POST['filter'] . '%" or
                                        pass_no LIKE "%' . $_POST['filter'] . '%" or
                                        pass_exp LIKE "%' . $_POST['filter'] . '%" or
                                        booktime LIKE "%' . $_POST['filter'] . '%" or
                                        status LIKE "%' . $_POST['filter'] . '%"
                                        ORDER BY feta DESC';
        }
        
    }
}

$_results = mysqli_query($_conn, $_sql);

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>View Bookings</title>
    <meta name="description" content="View bookings by customers">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../assets/css/overwrite.css">
    <link rel="stylesheet" href="../../assets/css/Scroll-Effect.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1000px;">
        <div style="background-color: #B7B5E4;height: 200px;padding-top: 200px;">
            <div style="position: absolute;top: 35px;left: 35px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Airport Management</h2>
            </div>
            <div style="position: absolute;top: 105px;left: 35px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">User Bookings</h2>
            </div>
            <div style="position: absolute;top: 105px;left: 1320px;width: 320px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="amaddflight.php">Add Flight</a></div>
            <div style="position: absolute;top: 105px;left: 980px;width: 320px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="amviewflight.php">View Flights</a></div>
            <div style="position: absolute;top: 105px;left: 1630px;width: 270px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="../../php/amsignout.php">Sign Out</a></div>
        </div>
        <div style="height: 120px;">
            <form method="post" action="amviewbooking.php">
                <div style="position: absolute;top: 240px;left: 40px;width: 930px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;border-radius: 30px;" placeholder="Filter keyword" name="filter" value="<?php echo $_focused; ?>"></div>
                <div
                        style="position: absolute;top: 240px;left: 1000px;width: 600px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 40px; border-radius: 30px;" name="sort" required="">
                            <option value="Default" selected="">By Booking ID (Ascending)</option>
                            <option value="DefaultDesc">By Booking ID (Descending)</option>
                            <option value="UID">By User ID (Ascending)</option>
                            <option value="UIDesc">By User ID (Descending)</option>
                            <option value="FID">By Flight ID (Ascending)</option>
                            <option value="FIDDesc">By Flight ID (Descending)</option>
                            <option value="Price">By Price (Ascending)</option>
                            <option value="PriceDesc">By Price (Descending)</option>
                            <option value="ETA">By ETA (Ascending)</option>
                            <option value="ETADesc">By ETA (Descending)</option></select></div>

                <div style="position: absolute;top: 250px;left: 1620px;width: 200px;"><button class="btn btn-primary border-white shadow" type="submit" style="background-color: #ffffff;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;">Search</button></div>
            </form>
        </div>
        <div style="position: relative;padding-bottom: 50px;padding-left: 40px;padding-top: 30px;">
            <div style="width: 1830px;height: 1040px;background-color: #ffb100;border-radius: 60px;overflow-y: scroll;padding: 30px;">
                <div class="table-responsive table-borderless" style="font-family: Montserrat, sans-serif;font-size: 35px;">
                    <table style="width: 15000px;"class="table table-bordered table-hover">
                        <thead>
                            <tr style="color: rgb(255,255,255);">
                                <th>Delete</th>
                                <th>Booking No.</th>
                                <th>User ID</th>
                                <th>Flight ID</th>
                                <th>Ticket ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Contact Number</th>
                                <th>Email Address</th>
                                <th>Airline</th>
                                <th>Price</th>
                                <th>Flight Tax</th>
                                <th>Flight Surcharge</th>
                                <th>Flight Total</th>
                                <th>Callsign</th>
                                <th>Model</th>
                                <th>Class</th>
                                <th>Departure City</th>
                                <th>Arrival City</th>
                                <th>Departure Airport</th>
                                <th>Arrival Airport</th>
                                <th>Departure Date</th>
                                <th>Arrival Date</th>
                                <th>Departure Time</th>
                                <th>Arrival Time</th>
                                <th>ETA</th>
                                <th>Departure Code</th>
                                <th>Arrival Code</th>
                                <th>First and Middle Name</th>
                                <th>Last Name</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Nationality</th>
                                <th>Country of Origin</th>
                                <th>Passport No.</th>
                                <th>Passport expiry</th>
                                <th>Booktime</th>
                                <th>Status</th>
                                <th>Change Status To</th>
                            </tr>
                        </thead>
                        <tbody style="color: rgb(255,255,255);">
                            <?php
                            $_statusdesc = '';
                            if(mysqli_affected_rows($_conn)>0){
                                for($i = 0; $i<mysqli_num_rows($_results); $i++){
                                    $row = mysqli_fetch_assoc($_results);
                                    if ($row['status'] == 'Paid')
                                    {
                                        $_statusdesc = 'Unpaid';
                                    }
                                    else
                                    {
                                        $_statusdesc = 'Paid';
                                    }
                                    echo '<tr>';
                                    echo '<td><a href = "../../php/amdeletebooking.php?bid='.$row['bid'].'">
                                    <button class="btn btn-primary shadow" type="submit" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;border-radius: 30px;border-color: rgba(255,255,255, 0);">Delete</button></a></td>';
                                    echo '<td>'.sprintf('%05d', $row['bid']).'</td>';
                                    echo '<td>'.sprintf('%05d', $row['uid']).'</td>';
                                    echo '<td>'.sprintf('%05d', $row['fid']).'</td>';
                                    echo '<td>'.$row['tid'].'</td>';
                                    echo '<td>'.$row['first_name'].'</td>';
                                    echo '<td>'.$row['last_name'].'</td>';
                                    echo '<td>'.$row['contact_number'].'</td>';
                                    echo '<td>'.$row['email_address'].'</td>';
                                    echo '<td>'.$row['fairline'].'</td>';
                                    echo '<td>'.$row['fprice'].'</td>';
                                    echo '<td>'.$row['ftax'].'</td>';
                                    echo '<td>'.$row['ftotal'].'</td>';
                                    echo '<td>'.$row['ftotalrnd'].'</td>';
                                    echo '<td>'.$row['fcallsign'].'</td>';
                                    echo '<td>'.$row['fmodel'].'</td>';
                                    echo '<td>'.$row['fclass'].'</td>';
                                    echo '<td>'.$row['fdepartcty'].'</td>';
                                    echo '<td>'.$row['farrcty'].'</td>';
                                    echo '<td>'.$row['fdepartair'].'</td>';
                                    echo '<td>'.$row['farrair'].'</td>';
                                    echo '<td>'.$row['fdepartdate'].'</td>';
                                    echo '<td>'.$row['farrdate'].'</td>';
                                    echo '<td>'.$row['fdeparttime'].'</td>';
                                    echo '<td>'.$row['farrtime'].'</td>';
                                    echo '<td>'.$row['feta'].'</td>';
                                    echo '<td>'.$row['fdctycode'].'</td>';
                                    echo '<td>'.$row['factycode'].'</td>';
                                    echo '<td>'.$row['fm_name'].'</td>';
                                    echo '<td>'.$row['l_name'].'</td>';
                                    echo '<td>'.$row['dateofbirth'].'</td>';
                                    echo '<td>'.$row['gender'].'</td>';
                                    echo '<td>'.$row['nationality'].'</td>';
                                    echo '<td>'.$row['countryoforigin'].'</td>';
                                    echo '<td>'.$row['pass_no'].'</td>';
                                    echo '<td>'.$row['pass_exp'].'</td>';
                                    echo '<td>'.$row['booktime'].'</td>';
                                    echo '<td>'.$row['status'].'</td>';
                                    echo '<td><a href = "../../php/ameditbookingstatus.php?bid='.$row['bid'].'">
                                    <button class="btn btn-primary shadow" type="submit" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;border-radius: 30px;border-color: rgba(255,255,255, 0); width: 300px;">' . $_statusdesc . '</button></a></td>';
                                    echo '</tr>';
                                }
                            }
                            else
                            {
                                echo '<tr>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '</tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
</body>

</html>