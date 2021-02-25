<?php


//Including conn.php
//Starting session

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

            window.location.href = "../roles/manager/amlogin.php";

        </script>
    ');
}

//Issuing deletion command

$_sql = 'DELETE FROM flight WHERE fid = ' . $_GET['fid'];

mysqli_query($_conn, $_sql);


//Check if the flight has been deleted

if (mysqli_affected_rows($_conn) <= 0)
{
	echo 
    '
        <script>

            alert("Failed to delete flight schedule!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/manager/amviewflight.php";

        </script>
    ';
}

else

{
	echo 
    '
        <script>

            alert("Flight schedule is deleted!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/manager/amviewflight.php";

        </script>
    ';
}

//Close ongoing connection and free up fetch memory
include('closeconn.php');

?>