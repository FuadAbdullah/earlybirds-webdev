<?php

//Starting session
//Including conn.php

session_start();
include('../../php/conn.php');

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

            window.location.href = "adminlogin.php";

        </script>
    ');
}

$_sql = 'SELECT * FROM admin WHERE aid = ' . $_SESSION['aid'];

$_adminfo = mysqli_query($_conn, $_sql);

$_admrow = mysqli_fetch_assoc($_adminfo);

//Fetch the user's information from user DB

$_sql = 'SELECT * FROM airport_manager WHERE amid = "' . $_GET['amid'] .  '"';

$_fetch = mysqli_query($_conn, $_sql);

//Check if the user's information is fetched correctly - one and only one row with the uid exist!

if (!mysqli_num_rows($_fetch) == 1)
{
    //include killsession.php aka logout
    echo
    '
        <script>

            alert("An error occured while retrieving information from database!");

        </script>
    ';
    die
    ('
        <script>

            window.location.href = "adminviewam.php";

        </script>   
    ');
}

else

//Storing fetched data into group of variables to be displayed in the page

{
    $row = mysqli_fetch_assoc($_fetch);
    $_fullname = $row['full_name'];
    $_username = $row['username'];

    if (empty($row['contact_num']))
    {
        $_contact = 'No information';
    }
    else
    {
        $_contact = $row['contact_num'];
    }

    if (empty($row['email_address']))
    {
        $_email = 'No information';
    }
    else
    {
        $_email = $row['email_address'];
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Airport Manager Profile</title>
    <meta name="description" content="Registered Airport Manager Profile">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../assets/css/overwrite.css">
    <link rel="stylesheet" href="../../assets/css/Scroll-Effect.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <div style="background-color: #f15946;height: 200px;padding-top: 200px;">
        <div style="position: absolute;top: 35px;left: 35px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Administrator</h2>
        </div>
        <div style="position: absolute;top: 25px;left: 965px;width: 900px;">
            <h2 class="text-right" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;"><?php echo $_admrow['full_name']; ?></h2>
        </div>
        <div style="position: absolute;top: 105px;left: 35px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Airport Manager Profile</h2>
        </div>
        <div style="position: absolute;top: 105px;left: 1630px;width: 270px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                href="adminviewam.php">Return</a></div>
    </div>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1000px;">
        <div style="padding-top: 100px;padding-bottom: 30px;padding-left: 30px;"><img src="../../assets/img/profile-white/bgred.png" height="800px" width="800px" style="position: absolute;top: 100px;left: 100px;height: 750px;width: 810px;">
            <form style="position: absolute;top: 165px;left: 105px;" action="../../php/adminamupdetails.php" method="post">
                <div style="position: absolute;top: 100px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" value="<?php echo $_fullname; ?>" placeholder="John Arbuckle" name="mgrname" minlength="3" maxlength="40"></div>
                <div style="position: absolute;top: 240px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="tel" style="font-family: Montserrat, sans-serif;font-size: 40px;" value="<?php echo $_contact; ?>" placeholder="0176503929" name="mgrcontact" maxlength="14" minlength="3"></div>
                <div style="position: absolute;top: 400px;left: 50px;width: 690px;"><input class="shadow form-control form-control-lg" type="email" style="font-family: Montserrat, sans-serif;font-size: 40px;" value="<?php echo $_email; ?>" placeholder="john_arbuckle@gmail.com" name="mgremail" minlength="3" maxlength="24"></div>
                <div style="position: absolute;top: 530px;left: 50px;width: 690px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;"><input type="hidden" name="amid" value="<?php echo $_GET['amid']; ?>"/>Save Changes</button></div>
            </form>
            <div style="position: absolute;top: 125px;left: 320px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Profile Details</h2>
            </div>
            <div style="position: absolute;top: 180px;left: 160px;width: 680px;">
                <hr style="background-color: #ffffff;height: 2px;">
            </div>
            <div style="position: absolute;top: 220px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Full Name</h2>
            </div>
            <div style="position: absolute;top: 360px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Contact Number</h2>
            </div>
            <div style="position: absolute;top: 510px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Email Address</h2>
            </div>
        </div>
        <div style="padding-top: 100px;padding-bottom: 30px;padding-left: 1000px;"><img src="../../assets/img/profile-white/bgmust.png" width="800px" height="800px" style="position: absolute;top: 100px;left: 990px;height: 750px;width: 810px;">
            <div style="position: absolute;top: 125px;left: 1110px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Account Login Details</h2>
            </div>
            <div style="position: absolute;top: 180px;left: 1050px;width: 680px;">
                <hr style="background-color: #ffffff;height: 2px;">
            </div>
            <form style="position: absolute;top: 165px;left: 1000px;" action="../../php/adminamupcred.php" method="post">
                <div style="position: absolute;top: 100px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" value="<?php echo $_username ?>" name="mgrusr" placeholder="johnbuckle" readonly=""></div>
                <div style="position: absolute;top: 240px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="password" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="******" name="mgrpass" maxlength="16" minlength="6"></div>
                <div style="position: absolute;top: 400px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="password" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="******" required="" name="mgrreppass" maxlength="16" minlength="6"></div>
                <div style="position: absolute;top: 530px;left: 50px;width: 690px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;"><input type="hidden" name="amid" value="<?php echo $_GET['amid']; ?>"/>Save Changes</button></div>
                <div
                    class="text-center" style="position: absolute;top: 160px;left: 420px;"></div>
        </form>
        <div style="position: absolute;top: 222px;left: 1050px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Username</h2>
        </div>
        <div style="position: absolute;top: 360px;left: 1050px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Create new password</h2>
        </div>
        <div style="position: absolute;top: 510px;left: 1050px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Repeat new password</h2>
        </div>
        </div>
    </main>
    <ul class="nav nav-tabs"></ul>
    <footer>
        <nav class="navbar navbar-light navbar-expand-md" style="background-color: #32161f;border-radius: 0px;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navcol-1" style="background-color: #32161f;/*margin-left: -28px;*/">
                    <div>
                    <hr style="background-color: #ffffff;height: 2px;">
                    <img src="../../assets/img/landingpage-red/©%202020%20EarlyBirds,%20Inc.%20All%20rights%20reserved.png" style="margin-right: 10px;">
                    <a class="text-center" href="../../general/faqhelp.html" style="color: #C500FF;"><img src="../../assets/img/landingpage-red/FAQ.png" style="margin-right: 10px;"></a>
                    <a class="text-center" href="../../general/privacy.html" style="color: #C500FF;"><img src="../../assets/img/landingpage-red/Privacy.png" style="margin-right: 10px;"></a>
                    <a class="text-center" href="../../general/terms.html" style="color: #C500FF;"><img src="../../assets/img/landingpage-red/Terms.png" style="margin-right: 10px;"></a>
                    <a class="text-center" href="../../general/about.html" style="color: #C500FF;"><img src="../../assets/img/landingpage-red/About.png" style="margin-right: 620px;"></a>
                        </div>
            </div>
        </nav>
    </footer>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/Scroll-Effect.js"></script>
    <?php

    //Close ongoing connection and free up fetch memory
    include('../../php/closeconn.php');
    ?>
</body>

</html>