<?php

//Starting session
//Including conn.php

session_start();
include('../../php/conn.php');

//Validate whether user has privilege to view the page

if (!isset($_SESSION['uid']))
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

            window.location.href = "login.php";

        </script>
    ');
}

//Fetch the user's information from user DB

$_sql = 'SELECT * FROM user WHERE uid = "' . $_SESSION['uid'] .  '"';

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

            window.location.href="login.php";

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


    <nav class="navbar navbar-light navbar-expand-md fixed-top bg-white" style="-webkit-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);-moz-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-md fixed-top" style="/*-webkit-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*//*-moz-box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*//*box-shadow: 0px 5px 15px -5px rgba(0,0,0,0.75);*/height: 200px;width: 200px;position: absolute;top: -50px;left: -50px;">
                <div class="container-fluid"><img src="../../assets/img/landingpage-red/Overhd3.png"></div>
            </nav><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="padding-left: 310px;">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;">
                        <a class="nav-link" href="search.php" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/">
                            <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Search</h3>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;">
                        <a class="nav-link" href="../../general/about.html" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/">
                            <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">About Us</h3>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 760px;">
                        <a class="nav-link" href="../../general/faqhelp.html" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/">
                            <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">FAQs</h3>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation"><img src="../../assets/img/loginpage-red/vertlinenavbar.png"></li>
                    <li class="nav-item" role="presentation" style="max-width: 210px;max-height: 80px;margin-top: -5px;"><a class="nav-link" href="../../php/usrsignout.php" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/"><img src="../../assets/img/profile-white/signout.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1000px;">
        <div style="padding-top: 100px;padding-bottom: 30px;padding-left: 30px;"><img src="../../assets/img/profile-white/bgred.png" height="800px" width="800px" style="position: absolute;top: 160px;left: 100px;">
            <form style="position: absolute;top: 165px;left: 105px;" action="../../php/usrupdetails.php" method="post">
                <div style="position: absolute;top: 160px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="John" value="<?php echo $_firstname; ?>" name="usrfirst" minlength="3" maxlength="40"></div>
                <div style="position: absolute;top: 300px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="Arbuckle" value="<?php echo $_lastname; ?>" name="usrlast" minlength="3" maxlength="40"></div>
                <div style="position: absolute;top: 440px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="tel" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="0176503929" value="<?php echo $_contact; ?>" name="usrcontact" maxlength="14" minlength="3"></div>
                <div style="position: absolute;top: 580px;left: 50px;width: 690px;"><input class="shadow form-control form-control-lg" type="email" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="john_arbuckle@gmail.com" value="<?php echo $_email; ?>" name="usremail" minlength="3" maxlength="24"></div>
                <div style="position: absolute;top: 680px;left: 50px;width: 690px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;">Save Changes</button></div>
            </form>
            <div style="position: absolute;top: 210px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Contact Details</h2>
            </div>
            <div style="position: absolute;top: 248px;left: 160px;">
                <h4 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 12px;">This information will be used to auto-fill Contact Details section of booking process</h4>
            </div>
            <div style="position: absolute;top: 250px;left: 160px;width: 680px;">
                <hr style="background-color: #ffffff;height: 2px;">
            </div>
            <div style="position: absolute;top: 280px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">First name</h2>
            </div>
            <div style="position: absolute;top: 420px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Last name</h2>
            </div>
            <div style="position: absolute;top: 560px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Contact Number</h2>
            </div>
            <div style="position: absolute;top: 700px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Email Address</h2>
            </div>
        </div>
        
        <div style="padding-top: 100px;padding-bottom: 30px;padding-left: 1000px;"><img src="../../assets/img/profile-white/bgmust.png" width="800px" height="800px" style="position: absolute;top: 160px;left: 1000px;">
            <form style="position: absolute;top: 165px;left: 1000px;" action="../../php/usrupimg.php" method="post" enctype="multipart/form-data">
                <div class="text-center" style="position: absolute;top: 0px;left: 125px;width: 300px;height: 250px;padding: 30px;"><img class="shadow" src="<?php echo $_imgdir; ?>" width="200px" style="border-radius: 40px;" height="200px"></div>
                <div class="text-center" style="position: absolute;top: 100px;left: 400px;"><input type="file" name="upload"/><input type="hidden" name="max_file_size" value="3000000"/></div>
                 <div style="position: absolute;top: 150px;left: 400px;width: 220px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: spx;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;">Upload Photo</button></div>
            </form>
            <form style="position: absolute;top: 165px;left: 1000px;" action="../../php/usrupcred.php" method="post">
                <div style="position: absolute;top: 300px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="johnbuckle23" value="<?php echo $_username ?>" name="usrname" readonly=""></div>
                <div style="position: absolute;top: 440px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="password" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="******" name="usrpass" minlength="6" maxlength="16"></div>
                <div style="position: absolute;top: 580px;left: 50px;width: 690px;"><input class="border-white shadow form-control form-control-lg" type="password" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="******" name="usrreppass" minlength="6" maxlength="16"></div>
                <div style="position: absolute;top: 680px;left: 50px;width: 690px;"><button class="btn btn-primary btn-block border-white shadow" type="submit" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;">Save Changes</button></div>
            </form>
        <div style="position: absolute;top: 420px;left: 1050px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Login username</h2>
        </div>
        <div style="position: absolute;top: 560px;left: 1050px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Create new password</h2>
        </div>
        <div style="position: absolute;top: 700px;left: 1050px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Repeat new password</h2>
        </div>
        </div>
        <div style="padding-top: 1000px;padding-bottom: 600px;padding-left: 30px;"><img src="../../assets/img/profile-white/bgblue.png" style="position: absolute;top: 1000px;left: 100px;" height="780px" width="1700px">
            <div style="position: absolute;top: 1050px;left: 160px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Booking History</h2>
            </div>
            <div style="position: absolute;top: 1090px;left: 160px;">
                <h4 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 12px;">Here are the list of flight bookings done by you</h4>
            </div>
            <div style="position: absolute;top: 1100px;left: 160px;width: 1580px;">
                <hr style="background-color: #ffffff;height: 2px;">
            </div>
            <div style="position: absolute;top: 1150px;left: 160px;width: 1575px;height: 550px;overflow-y: scroll;overflow-x: hidden;">
                <?php


                //Fetching booking information to be loaded under booking history

                $_sql = 'SELECT * FROM booking WHERE uid = "' . $_SESSION['uid'] . '" ORDER BY bid DESC';

                $_bdetails = mysqli_query($_conn, $_sql);

                //Handling empty booking record

                if (mysqli_num_rows($_bdetails) <= 0)
                {
                    echo 
                    '<div style="position: relative;"><img src="../../assets/img/profile-white/recentcard.png" width="1540px" height="250px">
                    <div style="position: absolute;top: 80px;left: 440px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 600;font-size: 30px;">Uh oh, seems like you never booked a flight</h2>
                    </div>
                    <div style="position: absolute;top: 120px;left: 550px;">
                        <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 600;font-size: 30px;">Don&rsquo;t fret, book one today!</h2>
                    </div>
                    </div>'; 
                }

                else
                {
                    while ($row = mysqli_fetch_assoc($_bdetails))
                    {
                        $_bid = $row['bid'];
                        $_airline = $row['fairline'];
                        $_fmname = strtoupper($row['fm_name']);
                        $_lname = strtoupper($row['l_name']);
                        $_gender = $row['gender'];
                        $_bidf = sprintf('%05', $row['bid']);
                        $_departcode = $row['fdctycode'];
                        $_arrivecode = $row['factycode'];
                        $_departdate = date('l, j F Y', strtotime($row['fdepartdate']));
                        $_callsign = $row['fcallsign'];
                        $_model = $row['fmodel'];
                        $_class = strtoupper($row['fclass']);
                        $_status = strtoupper($row['status']);


                        if ($_gender == "Male")
                        {
                            $_honor = "MR";
                        }
                        else if ($_gender == "Female")
                        {
                            $_honor = "MRS";
                        }
                        else
                        {
                            $_honor = "";
                        }

                        echo '
                        <div style="position: relative;"><img src="../../assets/img/profile-white/recentcard.png" width="1540px" height="250px">
                            <div style="position: absolute;top: 20px;left: 60px;">
                                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 600;font-size: 30px;">' . $_airline. ' - ' . $_honor . ' ' . $_fmname . ' ' . $_lname . '</h2>
                            </div>
                            <div style="position: absolute;top: 20px;left: 1030px;">
                                <h2 class="text-right" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 600;font-size: 30px;">' . $_bidf . '</h2>
                            </div>
                            <div class="text-left" style="position: absolute;top: 80px;left: 60px;">
                                <h2 class="text-left" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 300;font-size: 34px;">' . $_departcode . ' to ' . $_arrivecode . ' departing on ' . $_departdate . '</h2>
                            </div>
                            <div class="text-left" style="position: absolute;top: 150px;left: 60px;">
                                <h2 class="text-left" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 600;font-size: 34px;">' . $_callsign . ' - ' . $_model . ' - ' . $_class . ' - ' . $_status . '</h2>
                            </div>
                            <div style="position: absolute;top: 140px;left: 960px;width: 260px;"><a class="btn btn-primary btn-block border-white shadow" role="button" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;"
                                    href="../../php/usrdeletebook.php?bid=' . $_bid . '" ">Delete</a></div>
                            <div style="position: absolute;top: 140px;left: 1240px;width: 260px;"><a class="btn btn-primary btn-block border-white shadow" role="button" style="background-color: #ffebc6;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;"
                                    href="review.php?bid=' . $_bid . '" target="_blank">Review</a></div>
                        </div>';
                    };
                }


                ?>

                

                </div>
            </div>
            <div style="position: relative;padding-top: 150px;padding-bottom: 150px;">
            <div class="text-center" style="position: absolute;top: 10px;left: 680px;">
                <h1 class="text-center" style="color: rgb(0,0,0);font-size: 50px;font-family: Montserrat, sans-serif;font-weight: 500;">Delete your account</h1>
            </div>
            <div class="text-center" style="position: absolute;top: 80px;left: 670px;">
                <h1 style="color: #F15946;font-size: 22px;font-family: Montserrat, sans-serif;font-weight: 500;">Warning! Deleted account cannot be recovered!</h1>
            </div>
            <div style="position: absolute;top: 140px;left: 685px;width: 500px;"><a class="btn btn-primary btn-block border-white shadow" role="button" style="background-color: #FFB100;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;"
                                    href="../../php/usrdeleteacc.php?uid=<?php echo $_SESSION['uid']; ?>">Delete account</a></div>
                        </div>
        </div>
        </div>
    </main>
    <ul class="nav nav-tabs"></ul>
    <footer>
        <nav class="navbar navbar-light navbar-expand-md" style="background-color: #32161f;border-radius: 0px;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse text-left" id="navcol-1" style="background-color: #32161f;">
                    <div style="padding-left: 365px;padding-top: 40px;padding-bottom: 40px;">
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="register.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Register an account</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="login.php" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Sign in to account</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="profile.php" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Go to profile</span></a></div>
                        <div style="margin-top: 5px;max-width: 290px;"><a class="text-left" href="profile.php" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Review booking history</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="search.php" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Search for a flight</span></a></div>
                    </div>
                    <div style="margin-top: -40px;padding-left: 205px;padding-top: 0px;padding-bottom: 40px;">
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/faqhelp.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">FAQs</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/faqhelp.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Help</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/privacy.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Privacy Policy</span></a></div>
                        
                    </div>
                    <div style="margin-top: -80px;padding-left: 205px;padding-top: 40px;padding-bottom: 40px;">
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/terms.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Terms of Use</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/about.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">About Us</span></a></div>
                        <div style="margin-top: 5px;max-width: 280px;"><a class="text-left" href="../../general/landing.html" style="color: #C500FF;"><span style="color: #c8adad;font-family: Montserrat, sans-serif;font-size: 24px;">Landing Page</span></a></div>
                    </div>
                </div>
            </div>
        </nav>
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