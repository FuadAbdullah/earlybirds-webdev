<?php

//Starting session
//Including conn.php

session_start();
include('conn.php');

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


//Declaring variables to contain user-inserted search values

$_deptair = mysqli_escape_string($_conn, $_POST['deptair']);
$_arrair = mysqli_escape_string($_conn, $_POST['arrair']);
$_price = $_POST['price'];
$_model = strtoupper($_POST['model']);
$_airline = $_POST['airline'];
$_class = $_POST['class'];
$_deptdatetime = new datetime($_POST['deptdatetime']);
$_arrdatetime = new datetime($_POST['arrdatetime']);
$_callsign = strtoupper($_POST['callsign']);
$_deptcty = '';
$_arrcty = '';
$_dctycode = '';
$_actycode = '';
/*
$_deptdate = $_POST['deptdate'];
$_depttime = $_POST['depttime'];
$_arrtime = $_POST['arrtime'];
*/

//Declaring date and time related records

$_diff = $_arrdatetime->diff($_deptdatetime);
$_deptdate = $_deptdatetime->format('Y-m-d');
$_arrdate = $_arrdatetime->format('Y-m-d');
$_depttime = $_deptdatetime->format('H:i');
$_arrtime = $_arrdatetime->format('H:i');
$_eta = $_diff->format('%H:%I');


//Check if arrival date time is earlier than departure date time

if ($_deptdatetime >= $_arrdatetime)
{
	echo 
    '
        <script>

            alert("Departure date and time cannot be later than arrival date and time! \nPlease correct the input and try again.");

        </script>
    ';
    die(
    '
        <script>

            window.location.href = "../roles/manager/ameditflight.php?fid=' . $_POST['fid'] . '";

        </script>
    ');
}

//Creating a function to handle airport code selection

function aptcodecty(&$_air, &$_code, &$_cty)
{
	switch ($_air)
	{
		case 'Kota Kinabalu International Airport':
		$_code = 'BKI';
		$_cty = 'Kota Kinabalu';
		break;
		case 'Suvarnabhumi Airport':
		$_code = 'BKK';
		$_cty = 'Bangkok';
		break;	
		case 'Dabolim Airport':
		$_code = 'GOA';
		$_cty = 'Goa';
		break;	
		case 'Noi Bai International Airport':
		$_code = 'HAN';
		$_cty = 'Hanoi';
		break;	
		case 'Jakarta International Airport':
		$_code = 'JKT';
		$_cty = 'Jakarta';
		break;
		case 'Kuching International Airport':
		$_code = 'KCH';
		$_cty = 'Kuching';
		break;		
		case 'Kuala Lumpur International Airport':
		$_code = 'KUL';
		$_cty = 'Kuala Lumpur';
		break;	
		case 'Ninoy Aquino International Airport':
		$_code = 'MNL';
		$_cty = 'Manila';
		break;	
		case 'Singapore Changi Airport':
		$_code = 'SIN';
		$_cty = 'Singapore';
		break;	
		case 'Tokyo International Airport':
		$_code = 'HND';
		$_cty = 'Tokyo';
		break;	
		default:
		$_code = 'NAN';
		$_cty = 'Not Available';
	}
}

//Defining full and coded city name based on inserted country

aptcodecty($_deptair, $_dctycode, $_deptcty);
aptcodecty($_arrair, $_actycode, $_arrcty);

//step 3 - Execute the query

$_sql = 'UPDATE flight SET fairline = "' . $_airline . '", 
						   fprice = "' . $_price . '",
						   fcallsign = "' . $_callsign . '",
						   fmodel = "' . $_model . '",
						   fclass = "' . $_class . '",
						   fdepartcty = "' . $_deptcty . '",
						   farrcty = "' . $_arrcty . '",
						   fdepartair = "' . $_deptair . '",
						   farrair = "' . $_arrair . '",
						   fdepartdate = "' . $_deptdate . '",
						   farrdate = "' . $_arrdate . '",
						   fdeparttime = "' . $_depttime . '",
						   farrtime = "' . $_arrtime . '",
						   feta = "' . $_eta . '",
						   fdctycode = "' . $_dctycode . '",
						   factycode = "' . $_actycode . '"
		WHERE fid = "' . $_POST['fid'] . '"';


mysqli_query($_conn, $_sql);

if (mysqli_affected_rows($_conn) <= 0)
{
    echo 
    '
        <script>

            alert("A problem occurred while applying changes to this flight schedule. Please try again.");

        </script>
    ';
    die(
    '
        <script>

            window.location.href = "../roles/manager/ameditflight.php?fid=' . $_POST['fid'] . '";

        </script>
    ');

}
else
{
	echo 
    '
        <script>

            alert("Changes have been applied to the flight schedule successfully!");

        </script>
    ';
    echo
    '
        <script>

            window.location.href = "../roles/manager/amviewflight.php";

        </script>
    ';
}

//Close ongoing connection and free up fetch memory
include('closeconn.php');


?>