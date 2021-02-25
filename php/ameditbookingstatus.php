<?php

//Starting session
//Including conn.php

session_start();
include('conn.php');

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

//Fetch the current status of the booking

$_sql = 'SELECT status FROM booking WHERE bid = ' . $_GET['bid'];

$_status = mysqli_query($_conn, $_sql);

//Handling if there was an error while fetching record with the booking id

if (!mysqli_num_rows($_status) == 1)
{
     echo 
    '
        <script>

            alert("A problem occurred while fetching status of this booking!");

        </script>
    ';
    die(
    '
        <script>

            window.location.href = "../roles/manager/amviewbooking.php";

        </script>
    ');
}

//Storing the status into an accessible variable

$_row = mysqli_fetch_assoc($_status);

$_stat = $_row['status'];
$_newstat = '';

//Check the current status of the booking

if ($_stat == 'Unpaid')
{
    $_newstat = 'Paid';
}
else
{
    $_newstat = 'Unpaid';
}

//Updating the status with latest switch

$_sql = 'UPDATE booking SET status = "' . $_newstat . '" WHERE bid = ' . $_GET['bid'];

mysqli_query($_conn, $_sql);

//Check if the status update encountered any error

if (mysqli_affected_rows($_conn) <= 0)
{
    echo 
    '
        <script>

            alert("A problem occurred while updating the status of this booking!");

        </script>
    ';
    die(
    '
        <script>

            window.location.href = "../roles/manager/amviewbooking.php";

        </script>
    ');
}

//Return to booking view page

echo 
    '
        <script>

            window.location.href = "../roles/manager/amviewbooking.php?focus=' . $_GET['bid'] . '";

        </script>
    ';

//Close ongoing connection and free up fetch memory
include('closeconn.php');

?>