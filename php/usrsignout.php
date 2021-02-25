<?php

//Starting session
//Including conn.php

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

            alert("You are never logged in. Please login before being logging out");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "../roles/user/login.php";

        </script>
    ');
}

//Killing session
session_destroy();

echo 
	'
		<script>

			alert("Logged out successfully!");

		</script>
	';
	
echo 
	'
		<script>

			window.location.href = "../roles/user/login.php";

		</script>
	';

//Close ongoing connection and free up loginfo memory

include('closeconn.php');

?>