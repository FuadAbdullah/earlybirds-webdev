<?php

//this page will set the payment status of the current booking to paid and redirect to booking review page.

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

            window.location.href = "login.php";

        </script>
    ');
}

//Send a query to amend status of booking to paid

$_sql = 'UPDATE booking SET status = "Paid" WHERE bid = "' . $_SESSION['bid'] . '"';

mysqli_query($_conn, $_sql);

//Check if the query is successfully executed and amended the status

if (mysqli_affected_rows($_conn) <= 0)
{
	echo 
    '
        <script>

            alert("Payment verification failed! Please try again.");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "../roles/user/prepayment.php?bid=' . $_SESSION["bid"] . '";

        </script>
    ');
}

//Redirect to booking review page upon successful mock payment

echo 
    '
        <script>

            alert("Payment verified. You will be redirected to review page shortly!");

        </script>
    ';

echo
    '
        <script>

            window.location.href = "../roles/user/review.php?bid=' . $_SESSION["bid"] . '";

        </script>
    ';

//Unset bid and fid sessions

unset($_SESSION['bid']);
unset($_SESSION['fid']);

//Close ongoing connection and free up loginfo memory

include('closeconn.php');

?>