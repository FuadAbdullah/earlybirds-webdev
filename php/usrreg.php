<?php

//Starting session
//Including conn.php

session_start();
include('conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Store POST values

$_firstname = mysqli_real_escape_string($_conn, $_POST['usrfirst']);
$_lastname = mysqli_real_escape_string($_conn, $_POST['usrlast']);
$_username = mysqli_real_escape_string($_conn, $_POST['usrname']);
$_password = mysqli_real_escape_string($_conn, $_POST['usrpass']);

//Check if username has already been registered into database

$_sql = 'SELECT * FROM user WHERE username = "' . $_username . '"';

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

//Send a query to add the user's information

$_sql = 'INSERT INTO user (first_name, last_name, username, password) 
		 VALUES ("' . $_firstname . '", "' . $_lastname . '", "' . $_username . '", "' . $_password . '")';

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

            window.location.href="../roles/user/register.html";

        </script>
    ';
}

else

{

	$_sql = 'SELECT * FROM user WHERE username = "' . $_username . '" and password = "' . $_password . '"';

	$_loginfo = mysqli_query($_conn, $_sql);

    $row = mysqli_fetch_assoc($_loginfo);

    if (isset($_SESSION['aid']))
    {
        die
        ('
        <script>

            window.location.href="../roles/admin/userprofile.php?uid=' . $row['uid'] . '";

        </script>
        ');
    }

	if (mysqli_num_rows($_loginfo) == 1)
	{
		$_SESSION['uid'] = $row['uid'];
	}

	echo 
    '
        <script>

            alert("You have been successfully registered!");

        </script>
    ';
    echo 
    '
        <script>

            window.location.href="../roles/user/login.php";

        </script>
    ';
}

//Close ongoing connection and free up loginfo memory

include('closeconn.php');


?>