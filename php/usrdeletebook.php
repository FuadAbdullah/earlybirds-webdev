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

            alert("You do not have proper authorisation to view this page. Please login before continuing.");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "../roles/user/login.php";

        </script>
    ');
}

//Issuing deletion command

$_sql = 'DELETE FROM booking WHERE bid = ' . $_GET['bid'];

mysqli_query($_conn, $_sql);

//Check if the account has been deleted

if (mysqli_affected_rows($_conn) <= 0)
{
	echo 
    '
        <script>

            alert("Failed to delete booking history!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/user/profile.php";

        </script>
    ';
}

else

{
	echo 
    '
        <script>

            alert("Booking history is deleted!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/user/profile.php";

        </script>
    ';
}

//Close ongoing connection and free up fetch memory
include('closeconn.php');

?>