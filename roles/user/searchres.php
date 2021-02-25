<?php

//Including conn.php
//Starting session

session_start();
include('../../php/conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

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


//Declaring variables to contain user-inserted search values

$_localair = $_POST['deptair'];
$_desair = $_POST['arrair'];
$_deptdate = $_POST['deptdate'];
$_depttime = $_POST['depttime'];
$_seating = $_POST['seatclass'];

//Check if inserted date and time is earlier than current time

$_sdt = new datetime($_POST['deptdate'] . ' ' . $_POST['depttime']); //searchdatetime
$_cdt = new datetime(); //currentdatetime
$_cdtf = $_cdt->format('Y-m-d H:i'); //currentdatetimeformatted

if ($_sdt < $_cdt)
{
    echo 
    '
        <script>

            alert("You cannot book past flights. Departure time must be beyond current time.");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "search.php";

        </script>
    ');
}

//Adding and subtracting 30 minutes from the specified time 
//ref: https://dcblog.dev/quick-way-to-add-hours-and-minutes-with-php

$_advthirty = date('H:i', strtotime('+1 hour', strtotime($_depttime)));
$_redthirty = date('H:i', strtotime('-1 hour', strtotime($_depttime)));

//Adding 1 day extra to the specified date
$_advday = date('Y-m-d', strtotime('+1 day', strtotime($_deptdate)));

//Declaring filtered variable to prevent error pop

$_filtered = '';

if (isset($_POST['filter']))
{
    if($_POST['filter'] == 'Default')
    {
        $_sql = 'SELECT * FROM flight WHERE ( fdepartair LIKE "%' . $_localair . '%" or
                                        fdepartcty LIKE "%' . $_localair . '%" or
                                        fdctycode LIKE "%' . $_localair . '%" )
                                    and ( farrair LIKE "%' . $_desair . '%" or
                                        farrcty LIKE "%' . $_desair . '%" or
                                        factycode LIKE "%' . $_desair . '%" )
                                    and fdepartdate BETWEEN "' . $_deptdate . '"
                                    and "' . $_advday . '" 
                                    and ( fdeparttime >= "' . $_redthirty . '" or fdeparttime <= "' . $_advthirty . '" )
                                    and fclass = "' . $_seating . '"
                                    ORDER BY fid';
        $_filtered = 'Default';
    }
    else if ($_POST['filter'] == 'Price')
    {
        $_sql = 'SELECT * FROM flight WHERE ( fdepartair LIKE "%' . $_localair . '%" or
                                        fdepartcty LIKE "%' . $_localair . '%" or
                                        fdctycode LIKE "%' . $_localair . '%" )
                                    and ( farrair LIKE "%' . $_desair . '%" or
                                        farrcty LIKE "%' . $_desair . '%" or
                                        factycode LIKE "%' . $_desair . '%" )
                                    and fdepartdate BETWEEN "' . $_deptdate . '"
                                    and "' . $_advday . '" 
                                    and ( fdeparttime >= "' . $_redthirty . '" or fdeparttime <= "' . $_advthirty . '" )
                                    and fclass = "' . $_seating . '"
                                    ORDER BY fprice';
        $_filtered = 'Price';
    }
    else if ($_POST['filter'] == 'PriceDesc')
    {
        $_sql = 'SELECT * FROM flight WHERE ( fdepartair LIKE "%' . $_localair . '%" or
                                        fdepartcty LIKE "%' . $_localair . '%" or
                                        fdctycode LIKE "%' . $_localair . '%" )
                                    and ( farrair LIKE "%' . $_desair . '%" or
                                        farrcty LIKE "%' . $_desair . '%" or
                                        factycode LIKE "%' . $_desair . '%" )
                                    and fdepartdate BETWEEN "' . $_deptdate . '"
                                    and "' . $_advday . '" 
                                    and ( fdeparttime >= "' . $_redthirty . '" or fdeparttime <= "' . $_advthirty . '" )
                                    and fclass = "' . $_seating . '"
                                    ORDER BY fprice DESC';
        $_filtered = 'PriceDesc';
    }
    else if ($_POST['filter'] == 'ETA')
    {
        $_sql = 'SELECT * FROM flight WHERE ( fdepartair LIKE "%' . $_localair . '%" or
                                        fdepartcty LIKE "%' . $_localair . '%" or
                                        fdctycode LIKE "%' . $_localair . '%" )
                                    and ( farrair LIKE "%' . $_desair . '%" or
                                        farrcty LIKE "%' . $_desair . '%" or
                                        factycode LIKE "%' . $_desair . '%" )
                                    and fdepartdate BETWEEN "' . $_deptdate . '"
                                    and "' . $_advday . '" 
                                    and ( fdeparttime >= "' . $_redthirty . '" or fdeparttime <= "' . $_advthirty . '" )
                                    and fclass = "' . $_seating . '"
                                    ORDER BY feta';
        $_filtered = 'ETA';
    }
    else if ($_POST['filter'] == 'ETADesc')
    {
        $_sql = 'SELECT * FROM flight WHERE ( fdepartair LIKE "%' . $_localair . '%" or
                                        fdepartcty LIKE "%' . $_localair . '%" or
                                        fdctycode LIKE "%' . $_localair . '%" )
                                    and ( farrair LIKE "%' . $_desair . '%" or
                                        farrcty LIKE "%' . $_desair . '%" or
                                        factycode LIKE "%' . $_desair . '%" )
                                    and fdepartdate BETWEEN "' . $_deptdate . '"
                                    and "' . $_advday . '" 
                                    and ( fdeparttime >= "' . $_redthirty . '" or fdeparttime <= "' . $_advthirty . '" )
                                    and fclass = "' . $_seating . '"
                                    ORDER BY feta DESC';
        $_filtered = 'ETADesc';
    }
}
else
{
        $_sql = 'SELECT * FROM flight WHERE ( fdepartair LIKE "%' . $_localair . '%" or
                                        fdepartcty LIKE "%' . $_localair . '%" or
                                        fdctycode LIKE "%' . $_localair . '%" )
                                    and ( farrair LIKE "%' . $_desair . '%" or
                                        farrcty LIKE "%' . $_desair . '%" or
                                        factycode LIKE "%' . $_desair . '%" )
                                    and fdepartdate BETWEEN "' . $_deptdate . '"
                                    and "' . $_advday . '" 
                                    and ( fdeparttime >= "' . $_redthirty . '" or fdeparttime <= "' . $_advthirty . '" )
                                    and fclass = "' . $_seating . '"
                                    ORDER BY fid';
}

//Creating a function to handle filter status

function filtersearch($_args)
{
    if ($_args == 'Default')
    {
        echo '. Sorted by default';
    }
    else if ($_args == 'Price')
    {
        echo '. Sorted by price in ascending order';
    }
    else if ($_args == 'PriceDesc')
    {
        echo '. Sorted by price in descending order';
    }
    else if ($_args == 'ETA')
    {
        echo '. Sorted by ETA in ascending order';
    }
    else if ($_args == 'ETADesc')
    {
        echo '. Sorted by ETA in descending order';
    }
}

/*
//Fetch available flights based on the given constraints

$_sql = 'SELECT * FROM flight WHERE fdepartair LIKE "%' . $_localair . '%" and farrair LIKE "%' . $_desair . '%" and fdepartdate BETWEEN "' . $_deptdate . '" and "' . $_advday . '" and fdeparttime BETWEEN "' . $_redthirty . '" and "' . $_advthirty . '" and fclass = "' . $_seating . '"';
*/

$_search = mysqli_query($_conn, $_sql);

//Check whether or not the search returned any result

$_totalfetch = mysqli_num_rows($_search);

//Fetch today's date

$_todaydate = date('Y-m-d');

//Add 1 year to today's date

$_yearadv = date('Y-m-d', strtotime('+1 year', strtotime($_todaydate)));

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Flight Results</title>
    <meta name="description" content="Flights fetched from schedule">
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
                        <a class="nav-link" href="../../general/landing.html" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/">
                            <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Landing</h3>
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
                    <li class="nav-item" role="presentation" style="max-width: 210px;max-height: 80px;margin-top: -5px;"><a class="nav-link" href="profile.php" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;/*width: 150px;*/"><img src="../../assets/img/search-white/prof.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1000px;">
        <div style="background-color: #B7B5E4;height: 400px;padding-top: 200px;">
            <div style="background-color: #FFB100;height: 200px;">
                <form action="searchres.php" method="post">
                    

                    <div style="position: absolute;top: 220px;left: 50px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" placeholder="Local Airport" required="" name="deptair" minlength="3" maxlength="64" value="<?php echo $_localair;?>"></div> 
                    <div style="position: absolute;top: 310px;left: 50px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" placeholder="Destination Airport" required="" minlength="3" maxlength="64" name="arrair" value="<?php echo $_desair;?>"></div>
                    <div style="position: absolute;top: 220px;left: 650px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="date" min="<?php echo $_todaydate; ?>" max="<?php echo $_yearadv; ?>"style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius:30px;" required="" name="deptdate" value="<?php echo $_deptdate;?>"></div>
                    <div style="position: absolute;top: 310px;left: 650px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="time" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" required="" name="depttime" value="<?php echo $_depttime;?>"></div>    
                    <div style="position: absolute;top: 220px;left: 1250px;width: 400px;"><select class="shadow custom-select custom-select-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" required="" name="seatclass">
                    <option value="<?php echo $_seating;?>" selected><?php echo $_seating;?></option>
                    <option value="Business">Business</option>
                    <option value="First Class">First</option>
                    <option value="Economy">Economy</option></select></div>   
                            
                    <!--<div style="position: absolute;top: 220px;left: 50px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" placeholder="Local Airport" value="<?php echo $_localair;?>" readonly="" name="deptair" minlength="3"
                            maxlength="40" required=""></div>
                    <div style="position: absolute;top: 310px;left: 50px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" placeholder="Destination Airport" value="<?php echo $_desair;?>" readonly="" name="arrair" minlength="3"
                            maxlength="40" required=""></div>
                    <div style="position: absolute;top: 220px;left: 650px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" placeholder="Departure Date" value="<?php echo $_deptdate;?>" readonly="" name="deptdate" required=""></div>
                    <div style="position: absolute;top: 310px;left: 650px;width: 560px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" placeholder="Departure Time" value="<?php echo $_depttime;?>" readonly="" name="depttime" required=""></div>
                    <div style="position: absolute;top: 220px;left: 1250px;width: 400px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;border-radius: 30px;" placeholder="Class" value="<?php echo $_seating;?>" readonly="" name="seatclass" required=""></div>
                    -->
                    
                    
                    
                    <div
                        style="position: absolute;top: 310px;left: 1250px;width: 400px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;" name="filter" required="">
                            <option value="Default" selected="">Filter</option>
                            <option value="Price">By Price (Ascending)</option>
                            <option value="PriceDesc">By Price (Descending)</option>
                            <option value="ETA">By ETA (Ascending)</option>
                            <option value="ETADesc">By ETA (Descending)</option></select></div>
            <div
                style="position: absolute;top: 310px;left: 1670px;width: 200px;"><button class="btn btn-primary border-white shadow" type="submit" style="background-color: #ffffff;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;">Search</button></div>
        </form>
        </div>
        <div style="position: absolute;top: 125px;left: 245px;">
            <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Fetched <?php echo $_totalfetch; ?> result(s)<?php filtersearch($_filtered); ?></h2>
        </div>
        <div style="position: absolute;top: 115px;left: 1670px;width: 200px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                href="search.php">Return</a></div>
        </div>
        <?php

        if (mysqli_num_rows($_search) > 0)

        {
            while ($row = mysqli_fetch_assoc($_search))
            {
                $_airlogo = $row['fairline'];
                switch ($_airlogo)
                {
                    case 'AirAsia':
                        $_logodir = '../../assets/img/airlines-emblem/airasia.png';
                        break;
                    case 'All Nippon Airways':
                        $_logodir = '../../assets/img/airlines-emblem/ana.png';
                        break;
                    case 'Emirates':
                        $_logodir = '../../assets/img/airlines-emblem/emi.png';
                        break;
                    case 'Malaysia Airlines':
                        $_logodir = '../../assets/img/airlines-emblem/mas.png';
                        break;
                    case 'Singapore Airlines':
                        $_logodir = '../../assets/img/airlines-emblem/sgair.png';
                        break;
                    case 'Thai Airways':
                        $_logodir = '../../assets/img/airlines-emblem/thai.png';
                        break;
                    default:
                        $_logodir = '../../assets/img/airlines-emblem/default.png';
                }

                //Check if flight ETA is beyond a day/24hrs

                $_ddate = new datetime($row['fdepartdate'] . ' ' . $row['fdeparttime']);
                $_adate = new datetime($row['farrdate'] . ' ' . $row['farrtime']);
                $_diff = $_adate->diff($_ddate);
                $_daycnt = $_diff->format('%d');

                $_etadisplay = '';

                if ($_daycnt > 0 )
                {
                    $_etadisplay = $_daycnt . ' Day(s) Flight';
                }
                else
                {
                    $_etadisplay = ' Same Day Flight';
                }

                echo 
                '<div>
                        <div style="margin-top: 15px;margin-left: 8px;position: relative;"><img src="../../assets/img/searchres-white/resbg.png">
                            <div style="position: absolute;top: 8px;left: 10px;"><img src="' . $_logodir . '" width="300px" height="300px"></div>
                            <div style="position: absolute;top: 10px;left: 345px;">
                                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 600;font-size: 50px;">' . $row['fairline'] . ' | RM' . $row['fprice'] . ' | ' . $_etadisplay . '</h2>
                            </div>
                            <div style="position: absolute;top: 100px;left: 345px;width: 1200px;">
                                <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 50px;">' . $row['fcallsign'] . '&nbsp; &nbsp; &nbsp;|&nbsp; &nbsp; &nbsp;' . $row['fmodel'] . '&nbsp; &nbsp; &nbsp;|&nbsp; &nbsp; &nbsp;' . $row['fclass'] . '</h2>
                            </div>
                            <div style="position: absolute;top: 190px;left: 444px;width: 300px;">
                                <h2 class="text-right" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 50px;">' . date('H:i', strtotime($row['fdeparttime'])) . ' ' . $row['fdctycode'] . '</h2>
                            </div>
                            <div style="position: absolute;top: 190px;left: 1130px;width: 300px;">
                                <h2 class="text-left" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 50px;">' . $row['factycode'] . ' ' . date('H:i', strtotime($row['farrtime'])) . '</h2>
                            </div>
                            <div style="position: absolute;top: 205px;left: 776px;width: 300px;"><img src="../../assets/img/searchres-white/length.png"></div>
                            <div style="position: absolute;top: 180px;left: 780px;width: 300px;">
                                <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 25px;">' . date('H:i', strtotime($row['feta'])) .' hour(s)</h2>
                            </div>
                            <div style="position: absolute;top: 190px;left: 1515px;width: 300px;"><a class="btn btn-primary border-white shadow" role="button" style="background-color: #ffffff;color: #f15946;font-family: Montserrat, sans-serif;font-size: 50px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;" href="selected.php?fid=' . $row['fid'] . '" >SELECT</a></div>
                        </div>';
            }
    
        }   
        ?>
        
        </div>
        <div>
            <div class="text-center" style="padding-top: 80px;">
                <h2 style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">End of Search</h2>
            </div>
            <div class="text-center" style="padding-bottom: 80px;">
                <h2 style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 25px;">Couldn't find the best deal? Try refining your search using filter or reschedule your time</h2>
            </div>
        </div>
    </main>
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

    //Close ongoing connection and free up variables memory

    include('../../php/closeconn.php');


    ?>
</body>

</html>