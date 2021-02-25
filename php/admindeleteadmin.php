<?php


//Including conn.php
//Starting session

session_start();
include('conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Validate whether user has privilege to view the page

if (!isset($_SESSION['aid']))
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

            window.location.href = "../roles/admin/adminlogin.php";

        </script>
    ');
}

//Check if admin is deleting super admin


if ($_GET['aid'] == 1)
{
    echo 
    '
        <script>

            alert("Deletion of super admin is impossible!");

        </script>
    ';
    die(
    '
        <script>

            window.location.href="../roles/admin/adminviewadmin.php";

        </script>
    ');
}



//Check if admin is deleting him or herself

if ($_GET['aid'] == $_SESSION['aid'])
{
    echo 
    '
        <script>

            alert("Deletion of your own account is impossible!\nPlease login with different administrator account to delete this one!");

        </script>
    ';
    die(
    '
        <script>

            window.location.href="../roles/admin/adminviewadmin.php";

        </script>
    ');
}


//Issuing deletion command

$_sql = 'DELETE FROM admin WHERE aid = ' . $_GET['aid'];

mysqli_query($_conn, $_sql);


//Check if the flight has been deleted

if (mysqli_affected_rows($_conn) <= 0)
{
	echo 
    '
        <script>

            alert("Failed to delete admin profile!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/admin/adminviewadmin.php";

        </script>
    ';
}

else

{
	echo 
    '
        <script>

            alert("Admin profile is deleted!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/admin/adminviewadmin.php";

        </script>
    ';
}

//Close ongoing connection and free up fetch memory
include('closeconn.php');

?>