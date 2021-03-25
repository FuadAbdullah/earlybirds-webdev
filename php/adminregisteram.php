<?php

//Starting session
//Including conn.php

session_start();
include('conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Store POST values

$_fullname = mysqli_real_escape_string($_conn, $_POST['mgrname']);
$_username = mysqli_real_escape_string($_conn, $_POST['mgrusr']);
$_password = mysqli_real_escape_string($_conn, $_POST['mgrpass']);
$_reppass = mysqli_real_escape_string($_conn, $_POST['mgrreppass']);
$_contact = mysqli_real_escape_string($_conn, $_POST['mgrcontact']);
$_email = mysqli_real_escape_string($_conn, $_POST['mgremail']);

//Check if username has already been registered into database

$_sql = 'SELECT * FROM airport_manager WHERE username = "' . $_username . '"';

$_chkusr = mysqli_query($_conn, $_sql);

$_row = mysqli_fetch_assoc($_chkusr);

if ($_username == $_row['username'])
{
    echo 
    '
        <script>

            alert("Username is already in use. Please choose a different username!");

        </script>
    ';
    die
    ('
    <script>

        window.history.back();

    </script>
    ');
}


//Check if username contains forbidden characters

if (!preg_match("/^[a-zA-Z0-9]*$/", $_username))
{
    echo 
    '
        <script>

            alert("Username must contain characters and numbers only!");

        </script>
    ';
    die
    ('
    <script>

        window.history.back();

    </script>
    ');
}


//Check if password is not matching

if ($_password != $_reppass)
{
    echo 
    '
        <script>

            alert("Password is not matching. Please try again!");

        </script>
    ';
    die
    ('
    <script>

        window.history.back();

    </script>
    ');
}


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

        window.history.back();

    </script>
    ');
}


//Send a query to add the user's information

$_sql = 'INSERT INTO airport_manager (full_name, username, password, contact_num, email_address) 
		 VALUES ("' . $_fullname . '", "' . $_username . '", "' . $_password . '", "' . $_contact . '", "' . $_email . '")';

mysqli_query($_conn, $_sql);

//Check if there is any row getting affected by the query. If it does, the user has been registered. If not, there must probably be error or duplication although very unlikely

if (mysqli_affected_rows($_conn) <= 0)
{
	echo 
    '
        <script>

            alert("Failed to register. Please try again.");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/admin/adminregisteram.php";

        </script>
    ';
}

else

{

	$_sql = 'SELECT * FROM airport_manager WHERE username = "' . $_username . '" and password = "' . $_password . '"';

	$_loginfo = mysqli_query($_conn, $_sql);

    $row = mysqli_fetch_assoc($_loginfo);

	echo 
    '
        <script>

            alert("Manager has been successfully registered!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/admin/adminviewam.php";

        </script>
    ';
}

//Close ongoing connection and free up loginfo memory

include('closeconn.php');


?>