<?php

//Including conn.php
//Starting session

session_start();
include('conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Declaring variables to contain user-inserted username and password

$_username = mysqli_real_escape_string($_conn, $_POST['mgruname']);
$_password = mysqli_real_escape_string($_conn, $_POST['mgrpassword']);

//Fetch registered accounts credentials from database

$_sql = 'SELECT * FROM airport_manager WHERE username = "' . $_username . '" and password = "' . $_password . '"';
$_loginfo = mysqli_query($_conn, $_sql);


//Validate with fetched registered accounts credentials

if (mysqli_num_rows($_loginfo) == 1)
{
	$row = mysqli_fetch_assoc($_loginfo);
	$_SESSION['amid'] = $row['amid'];
	echo 
	'
		<script>

			alert("Logged in successfully!");

		</script>
	';

	echo 
	'
		<script>

			window.location.href = "../roles/manager/amaddflight.php";

		</script>
	';

}
else
{
	echo 
	'
		<script>

			alert("Invalid credentials inserted! Please try again.");

		</script>
	';

	echo 
	'
		<script>

			window.location.href = "../roles/manager/amlogin.php";

		</script>
	';
}

//Close ongoing connection and free up loginfo memory

include('closeconn.php');

?>