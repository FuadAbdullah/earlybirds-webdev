<?php

//Starting session
//Including conn.php

session_start();
include('conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

if (isset($_POST['mgrpass'], $_POST['mgrreppass']))
{
    //Store POST values

    $_newpass = mysqli_escape_string($_conn, $_POST['mgrpass']);
    $_checknewpass = mysqli_escape_string($_conn, $_POST['mgrreppass']);

    //Check if the button was pressed without new password inserted

    if (empty($_newpass) || empty($_checknewpass))
    {
    echo 
        '
            <script>

                alert("New password cannot be empty!");

            </script>
        ';
    die 
        ('
            <script>

                window.location.href="../roles/admin/amprofile.php?amid=' . $_POST['amid'] . '";

            </script>
        ');
}   

    //Check if the inserted password is similar before updating

    if ($_newpass != $_checknewpass)
    {
        echo 
            '
                <script>

                    alert("New password do not match. Please try again.");

                </script>
            ';
        die 
            ('
                <script>

                window.location.href="../roles/admin/amprofile.php?amid=' . $_POST['amid'] . '";

                </script>
            ');
    }


    //Send a query to update the user's information

    $_sql = 'UPDATE airport_manager 
             SET password = "' . $_newpass . '" 
             WHERE amid = "' . $_POST['amid'] . '"';

    mysqli_query($_conn, $_sql);

    //Check if there is any row getting affected by the query. If it does, user password has been updated. If not, either there is no change required or system encountered some errors

    if (mysqli_affected_rows($_conn) <= 0)
    {
        echo 
        '
            <script>

                alert("Failed to update password. Please try again.");

            </script>
        ';
        die 
        ('
            <script>

                window.location.href="../roles/admin/amprofile.php?amid=' . $_POST['amid'] . '";

            </script>
        ');
    }

    else

    {
        echo 
        '
            <script>

                alert("Password updated successfully!");

            </script>
        ';
        echo 
        '
            <script>

                window.location.href="../roles/admin/amprofile.php?amid=' . $_POST['amid'] . '";

            </script>
        ';
    }

}


//Close ongoing connection and free up fetch memory
include('closeconn.php');


?>
