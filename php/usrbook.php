<?php

//Including conn.php
//Starting session

session_start();
include('conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Validate whether user has privilege to view the page

if (!isset($_SESSION['uid']))
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

            window.location.href = "../roles/user/login.php";

        </script>
    ');
}

//Validate whether the passport number entered is 

//Store SESSION value of booked flight
$_fid = $_SESSION['fid'];

//Store POST values for user details

$_firstname = mysqli_real_escape_string($_conn, $_POST['usrfirst']);
$_lastname = mysqli_real_escape_string($_conn, $_POST['usrlast']);
$_contact = mysqli_real_escape_string($_conn, $_POST['usrcontact']);
$_email = mysqli_real_escape_string($_conn, $_POST['usremail']);

//Store POST values for passenger details

$_fmname = mysqli_real_escape_string($_conn, $_POST['pgrfmname']);
$_lname = mysqli_real_escape_string($_conn, $_POST['pgrlname']);
$_dateofbirth = $_POST['pgrdob'];
$_gender = $_POST['pgrgender'];
$_nationality = mysqli_real_escape_string($_conn, $_POST['pgrnation']);
$_countryoforigin = mysqli_real_escape_string($_conn, $_POST['pgrorigin']);
$_passno = mysqli_real_escape_string($_conn, $_POST['pgrpass']);
$_passexp = $_POST['pgrexp'];

//Generate timestamp for booking placement

$_timestamp = date('H:i:s');

//Fetch flight information to transfer to user booking details via fid

$_sql = 'SELECT * FROM flight WHERE fid = "' . $_fid . '"';

$_fldetails = mysqli_query($_conn, $_sql);

//Storing fetched flight information into variables

$flrow = mysqli_fetch_assoc($_fldetails);

$_departcountry = $flrow['fdepartcty'];
$_arrivecountry = $flrow['farrcty'];
$_departairport = $flrow['fdepartair'];
$_arriveairport = $flrow['farrair'];
$_departdate = $flrow['fdepartdate'];
$_arrdate = $flrow['farrdate'];
$_departdatef = date('j F Y', strtotime($flrow['fdepartdate'])); //Changing departure date format for aesthetic purpose
$_class = $flrow['fclass'];
$_airline = $flrow['fairline'];
$_callsign = $flrow['fcallsign'];
$_model = $flrow['fmodel'];
$_eta = $flrow['feta'];
$_etaf = date('H:i', strtotime($flrow['feta'])); //Changing estimated time of arrival format for aesthetic purpose
$_departtime = $flrow['fdeparttime'];
$_departtimef = date('H:i', strtotime($flrow['fdeparttime'])); //Changing departure time format for aesthetic purpose
$_arrivetime = $flrow['farrtime'];
$_arrivetimef = date('H:i', strtotime($flrow['farrtime'])); //Changing arrival time format for aesthetic purpose
$_price = $flrow['fprice'];
$_pricef = number_format($flrow['fprice'], 2);
$_departcode = $flrow['fdctycode'];
$_arrivecode = $flrow['factycode'];

//Declaring tax and surcharge variables

$_tax = number_format($_price * 0.10, 2);
$_surcharge = number_format($_price * 0.20, 2);

//Adding price, tax and surcharge together

$_total = str_replace(',', '', (number_format($_price + $_tax + $_surcharge, 2)));
$_totalrnd = str_replace(',', '', (number_format(round($_price + $_tax + $_surcharge), 2)));

//Generating a randomised number for the ticket

$_tid = mt_rand(100000000, 999999999); //https://stackoverflow.com/questions/5464906/how-can-i-generate-a-6-digit-unique-number

//Submitting fetched information to the booking database

$_sql = 'INSERT INTO booking (uid, fid, tid, first_name, last_name, contact_number, email_address, fairline, fprice, ftax, fsurcharge, ftotal, ftotalrnd, fcallsign, fmodel, fclass, fdepartcty, farrcty, fdepartair, farrair, fdepartdate, farrdate, fdeparttime, farrtime, feta, fdctycode, factycode, fm_name, l_name, dateofbirth, gender, nationality, countryoforigin, pass_no, pass_exp, booktime, status) VALUES 
    ("' . $_SESSION['uid'] . '",
     "' . $_fid . '",
     "' . $_tid . '",
     "' . $_firstname . '", 
     "' . $_lastname . '",
     "' . $_contact . '",
     "' . $_email . '",
     "' . $_airline . '", 
     "' . $_price . '", 
     "' . $_tax . '",
     "' . $_surcharge . '",
     "' . $_total . '", 
     "' . $_totalrnd . '", 
     "' . $_callsign . '", 
     "' . $_model . '", 
     "' . $_class . '", 
     "' . $_departcountry . '", 
     "' . $_arrivecountry . '", 
     "' . $_departairport . '", 
     "' . $_arriveairport . '", 
     "' . $_departdate . '", 
     "' . $_arrdate . '", 
     "' . $_departtime . '", 
     "' . $_arrivetime . '", 
     "' . $_eta . '", 
     "' . $_departcode . '", 
     "' . $_arrivecode . '", 
     "' . $_fmname . '", 
     "' . $_lname . '", 
     "' . $_dateofbirth . '", 
     "' . $_gender . '", 
     "' . $_nationality . '", 
     "' . $_countryoforigin . '", 
     "' . $_passno . '", 
     "' . $_passexp . '", 
     "' . $_timestamp . '",
     "Unpaid")';

//Execute save query to booking table

mysqli_query($_conn, $_sql);

//Check if there is any error while inserting the booking information into the table

if (mysqli_affected_rows($_conn) <= 0)
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

            window.location.href = "../roles/user/search.php";

        </script>
    ');

}

//Fetch the newly booking id 

$_sql = 'SELECT bid FROM booking WHERE fid = "' . $_fid . '" and tid = "' . $_tid . '" and booktime = "' . $_timestamp . '"';

$_fetchbid = mysqli_query($_conn, $_sql);

$bid = mysqli_fetch_assoc($_fetchbid);

$_SESSION['bid'] = $bid['bid'];

//Redirect to payment (mock) page

echo
    '
        <script>

            window.location.href = "../roles/user/prepayment.php?bid=' . $_SESSION['bid'] . '";

        </script>
    ';

//Close ongoing connection and free up fetch memory
include('closeconn.php');

?>