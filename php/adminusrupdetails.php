<?php

//Starting session
//Including conn.php

session_start();
include('conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Store POST values

$_firstname = $_POST['usrfirst'];
$_lastname = $_POST['usrlast'];
$_contact = $_POST['usrcontact'];
$_email = $_POST['usremail'];


//Check if contact number contains forbidden characters

if (!preg_match("/^[0-9]*$/", $_contact))
{
    echo 
    '
        <script>

            alert("Contact number must contain numbers only!");

        </script>
    ';
    die
    ('
    <script>

        window.location.href="../roles/admin/userprofile.php?uid=' . $_POST['uid'] . '";

    </script>
    ');
}


//Send a query to update the user's information

$_sql = 'UPDATE user 
		 SET first_name = "' . $_firstname . '",
		 	 last_name = "' . $_lastname . '",
		 	 contact_num = "' . $_contact . '",
		 	 email_address = "' . $_email . '"
		 	 WHERE uid = "' . $_POST['uid'] . '"';

mysqli_query($_conn, $_sql);

//Check if there is any row getting affected by the query. If it does, user information has been updated. If not, either there are no changes required or system encountered some errors

if (mysqli_affected_rows($_conn) <= 0)
{
	echo 
    '
        <script>

            alert("Failed to update details. Please try again.");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/admin/userprofile.php?uid=' . $_POST['uid'] . '";

        </script>
    ';
}

else

{
	echo 
    '
        <script>

            alert("Details updated successfully!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/admin/userprofile.php?uid=' . $_POST['uid'] . '";

        </script>
    ';
}


//Close ongoing connection and free up fetch memory
include('closeconn.php');

?>