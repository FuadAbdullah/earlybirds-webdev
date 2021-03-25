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

$_sql = 'SELECT * FROM user WHERE uid = "' . $_GET['uid'] .  '"';

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

            window.location.href = "adminviewuser.php";

        </script>   
    ');
}

else

//Storing fetched data into group of variables to be displayed in the page

{
    $row = mysqli_fetch_assoc($_fetch);
    $_firstname = $row['first_name'];
    $_lastname = $row['last_name'];
    $_username = $row['username'];
    $_imgdir = $row['img_dir'];

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
    <title>User Profile</title>
    <meta name="description" content="Registered user profile information">
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
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">User Profile</h2>
        </div>
        <div style="position: absolute;top: 105px;left: 1630px;width: 270px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                href="adminviewuser.php">Return</a></div>
    </div>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1000px;">
        <div style="padding-top: 100px;padding-bottom: 30px;padding-left: 30px;"><img src="../../assets/img/profile-white/bgred.png" height="800px" width="800px" style="position: absolute;top: 100px;left: 100px;">
            <form style="position: absolute;top: 105px;left: 105px;" action="../../php/adminusrupdetails.php" method="post">
                <div style="position: absolute;top: 160px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="John" value="<?php echo $_firstname; ?>" name="usrfirst" minlength="3" maxlength="40"></div>
                <div style="position: absolute;top: 300px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="Arbuckle" value="<?php echo $_lastname; ?>" name="usrlast" minlength="3" maxlength="40"></div>
                <div style="position: absolute;top: 440px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="tel" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="0176503929" value="<?php echo $_contact; ?>" name="usrcontact" maxlength="14" minlength="3"></div>
                <div style="position: absolute;top: 580px;left: 50px;width: 690px;"><input class="shadow form-control form-control-lg" type="email" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="john_arbuckle@gmail.com" value="<?php echo $_email; ?>" name="usremail" minlength="3" maxlength="24"></div>
                <div style="position: absolute;top: 680px;left: 50px;width: 690px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;"><input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>"/>Save Changes</button></div>
            </form>
            <div style="position: absolute;top: 150px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Contact Details</h2>
            </div>
            <div style="position: absolute;top: 188px;left: 160px;">
                <h4 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 12px;">This information will be used to auto-fill Contact Details section of booking process</h4>
            </div>
            <div style="position: absolute;top: 190px;left: 160px;width: 680px;">
                <hr style="background-color: #ffffff;height: 2px;">
            </div>
            <div style="position: absolute;top: 220px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">First name</h2>
            </div>
            <div style="position: absolute;top: 360px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Last name</h2>
            </div>
            <div style="position: absolute;top: 500px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Contact Number</h2>
            </div>
            <div style="position: absolute;top: 640px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Email Address</h2>
            </div>
        </div>
        
        <div style="padding-top: 100px;padding-bottom: 30px;padding-left: 1000px;"><img src="../../assets/img/profile-white/bgmust.png" width="800px" height="800px" style="position: absolute;top: 100px;left: 1000px;">
            <form style="position: absolute;top: 105px;left: 1000px;" action="../../php/adminusrupimg.php" method="post" enctype="multipart/form-data">
                <div class="text-center" style="position: absolute;top: 0px;left: 125px;width: 300px;height: 250px;padding: 30px;"><img class="shadow" src="<?php echo $_imgdir; ?>" width="200px" style="border-radius: 40px;" height="200px"></div>
                <div class="text-center" style="position: absolute;top: 100px;left: 400px;"><input type="file" name="upload" style="width:" /><input type="hidden" name="max_file_size" value="3000000"/></div>
                 <div style="position: absolute;top: 150px;left: 400px;width: 220px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: spx;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;"><input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>"/>Upload Photo</button></div>
            </form>
            <form style="position: absolute;top: 105px;left: 1000px;" action="../../php/adminusrupcred.php" method="post">
                <div style="position: absolute;top: 300px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="johnbuckle23" value="<?php echo $_username ?>" name="usrname" readonly=""></div>
                <div style="position: absolute;top: 440px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="password" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="******" name="usrpass" minlength="6" maxlength="16"></div>
                <div style="position: absolute;top: 580px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="password" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="******" name="usrreppass" minlength="6" maxlength="16"></div>
                <div style="position: absolute;top: 680px;left: 50px;width: 690px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;"><input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>"/>Save Changes</button></div>
            </form>
        <div style="position: absolute;top: 360px;left: 1050px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Login username</h2>
        </div>
        <div style="position: absolute;top: 500px;left: 1050px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Create new password</h2>
        </div>
        <div style="position: absolute;top: 640px;left: 1050px;">
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