<?php

//Starting session
//Including conn.php

session_start();
include('conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Store POST values

$_fullname = mysqli_real_escape_string($_conn, $_POST['admname']);
$_contact = mysqli_real_escape_string($_conn, $_POST['admcontact']);
$_email = mysqli_real_escape_string($_conn, $_POST['admemail']);


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

        window.location.href="../roles/admin/adminprofile.php?aid=' . $_POST['aid'] . '";

    </script>
    ');
}


//Send a query to update the user's information

$_sql = 'UPDATE admin 
		 SET full_name = "' . $_fullname . '",
		 	 contact_num = "' . $_contact . '",
		 	 email_address = "' . $_email . '"
		 	 WHERE aid = "' . $_POST['aid'] . '"';

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

            window.location.href="../roles/admin/adminprofile.php?aid=' . $_POST['aid'] . '";

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

            window.location.href="../roles/admin/adminprofile.php?aid=' . $_POST['aid'] . '";

        </script>
    ';
}


//Close ongoing connection and free up fetch memory
include('closeconn.php');

?>