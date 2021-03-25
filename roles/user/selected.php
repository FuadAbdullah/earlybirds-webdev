<?php

//Including conn.php
//Starting session

session_start();
include('../../php/conn.php');

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

//Validate whether user has privilege to view the page

if (!isset($_SESSION['uid'], $_GET['fid']))
{
    echo 
    '
        <script>

            alert("You do not have proper authorisation to view this page!");

        </script>
    ';

    die(
    '
        <script>

            window.location.href = "login.php";

        </script>
    ');
}

//Declaring a variable to get flight and user ids

$_fid = $_GET['fid'];
$_uid = $_SESSION['uid'];

//Create session for the current flight

$_SESSION['fid'] = $_fid;

//Fetch user details from database via uid

$_sql = 'SELECT * FROM user WHERE uid = "' . $_uid . '"';

$_usrdetails = mysqli_query($_conn, $_sql);

//Fetch selected flight information from database via fid

$_sql = 'SELECT * FROM flight WHERE fid = "' . $_fid . '"';

$_fldetails = mysqli_query($_conn, $_sql);

//Storing fetched user details into variables

$usrrow = mysqli_fetch_assoc($_usrdetails);

$_firstname = $usrrow['first_name'];
$_lastname = $usrrow['last_name'];
$_contact = $usrrow['contact_num'];
$_email = $usrrow['email_address'];

//Storing fetched flight information into variables

$flrow = mysqli_fetch_assoc($_fldetails);

$_departcountry = $flrow['fdepartcty'];
$_arrivecountry = $flrow['farrcty'];
$_departdate = $flrow['fdepartdate'];
$_departdatef = date('j F Y', strtotime($flrow['fdepartdate'])); //Changing departure date format for aesthetic purpose
$_class = $flrow['fclass'];
$_airline = $flrow['fairline'];
$_callsign = $flrow['fcallsign'];
$_model = $flrow['fmodel'];
$_eta = $flrow['feta'];
$_etaf = date('H:i', strtotime($flrow['feta'])); //Changing estimated time of arrival format for aesthetic purpose
$_departtime = $flrow['fdeparttime'];
$_departtimef = date('H:i', strtotime($flrow['fdeparttime'])); //Changing departure time format for aesthetic purpose
$_arrivetime = $flrow['farrtime'];
$_arrivetimef = date('H:i', strtotime($flrow['farrtime'])); //Changing arrival time format for aesthetic purpose
$_price = $flrow['fprice'];
$_pricef = number_format($flrow['fprice'], 2);
$_departcode = $flrow['fdctycode'];
$_arrivecode = $flrow['factycode'];

//Declaring tax and surcharge variables

$_tax = number_format($_price * 0.10, 2);
$_surcharge = number_format($_price * 0.20, 2);

//Adding price, tax and surcharge together

$_total = number_format($_price + $_tax + $_surcharge, 2);
$_totalrnd = number_format(round($_price + $_tax + $_surcharge), 2);

//echo 'RM' . number_format($_tax, 2); https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places
//echo 'RM' . number_format($_surcharge, 2);

//Check if flight ETA is beyond a day/24hrs

$_ddate = new datetime($flrow['fdepartdate'] . ' ' . $flrow['fdeparttime']);
$_adate = new datetime($flrow['farrdate'] . ' ' . $flrow['farrtime']);
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


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Passenger Details</title>
    <meta name="description" content="Inserting information about the passenger">
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
                <ul class="nav navbar-nav text-center">
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;margin-left: 190px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #000000;">Customer Information<img src="../../assets/img/selection-white/red.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 40px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #d0c7b7;">Payment<img src="../../assets/img/selection-white/yel.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="margin-top: 15px;margin-right: 298px;">
                        <h3 style="font-family: Montserrat, sans-serif;font-size: 30px;color: #d0c7b7;">Review<img src="../../assets/img/selection-white/white.png"></h3>
                    </li>
                    <li class="nav-item" role="presentation" style="max-width: 210px;max-height: 80px;margin-top: 2px;">
                        <div style="width: 200px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                                href="search.php">Cancel</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main style="background-color: #FFEBC6;position: relative;min-height: 2180px;">
        <form style="position: relative;width: 1100px;padding-top: 180px;padding-bottom: 40px;padding-left: 40px;" action="../../php/usrbook.php" method="post">
            <div style="position: relative;width: 1100px;"><img src="../../assets/img/selection-white/bg.png" height="850px">
                <div style="position: absolute;top: 220px;left: 75px;width: 900px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="John" value="<?php echo $_firstname; ?>" required="" name="usrfirst" minlength="3" maxlength="40"></div>
                <div style="position: absolute;top: 370px;left: 75px;width: 900px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="Arbuckle" value="<?php echo $_lastname; ?>" required="" name="usrlast" minlength="3" maxlength="40"></div>
                <div
                    style="position: absolute;top: 530px;left: 75px;width: 900px;"><input class="border-white shadow form-control form-control-lg" type="tel" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="0176503929" value="<?php echo $_contact; ?>" required="" name="usrcontact" minlength="3" maxlength="14"></div>
            <div style="position: absolute;top: 680px;left: 75px;width: 900px;"><input class="shadow form-control form-control-lg" type="email" style="font-family: Montserrat, sans-serif;font-size: 40px;" placeholder="john_arbuckle@gmail.com" value="<?php echo $_email; ?>" required="" name="usremail" minlength="3" maxlength="32"></div>
            <div style="position: absolute;top: 30px;left: 90px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Contact Details</h2>
            </div>
            <div style="position: absolute;top: 80px;left: 90px;">
                <h4 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 18px;">This information is required for the e-ticket to be delivered</h4>
            </div>
            <div style="position: absolute;top: 100px;left: 40px;width: 1000px;">
                <hr style="background-color: #ffffff;height: 2px;">
            </div>
            <div style="position: absolute;top: 155px;left: 80px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">First name</h2>
            </div>
            <div style="position: absolute;top: 312px;left: 80px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Last name</h2>
            </div>
            <div style="position: absolute;top: 470px;left: 80px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Contact Number</h2>
            </div>
            <div style="position: absolute;top: 620px;left: 80px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Email Address</h2>
            </div>
            </div>
            <div style="position: relative;width: 1100px;padding-top: 40px;"><img src="../../assets/img/selection-white/bg.png" height="850px">
                <div style="position: absolute;top: 240px;left: 75px;width: 400px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;" placeholder="John Q." required="" name="pgrfmname" minlength="3" maxlength="40"></div>
                <div
                style="position: absolute;top: 240px;left: 550px;width: 400px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;" placeholder="Arbuckle" required="" name="pgrlname" minlength="3" maxlength="40"></div>
                <div
                    style="position: absolute;top: 380px;left: 75px;width: 400px;"><input class="border-white shadow form-control form-control-lg" type="date" style="font-family: Montserrat, sans-serif;font-size: 30px;" required="" name="pgrdob" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>"></div>
                    <div style="position: absolute;top: 380px;left: 550px;width: 400px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;" required="" name="pgrgender"><option value="Male">Male</option><option value="Female">Female</option><option value="Other">Other</option></select></div>
                    <div
                style="position: absolute;top: 530px;left: 75px;width: 400px;">
                <select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;" required="" name="pgrnation">
                    <option value="Afganistan">Afghanistan</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bonaire">Bonaire</option>
                    <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Canary Islands">Canary Islands</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Channel Islands">Channel Islands</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos Island">Cocos Island</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote DIvoire">Cote DIvoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curaco">Curacao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="East Timor">East Timor</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands">Falkland Islands</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Ter">French Southern Ter</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Great Britain">Great Britain</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="India">India</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea North">Korea North</option>
                    <option value="Korea Sout">Korea South</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macau">Macau</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malaysia" selected="">Malaysia</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Midway Islands">Midway Islands</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Nambia">Nambia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherland Antilles">Netherland Antilles</option>
                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                    <option value="Nevis">Nevis</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau Island">Palau Island</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Phillipines">Philippines</option>
                    <option value="Pitcairn Island">Pitcairn Island</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                    <option value="Republic of Serbia">Republic of Serbia</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="St Barthelemy">St Barthelemy</option>
                    <option value="St Eustatius">St Eustatius</option>
                    <option value="St Helena">St Helena</option>
                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                    <option value="St Lucia">St Lucia</option>
                    <option value="St Maarten">St Maarten</option>
                    <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                    <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                    <option value="Saipan">Saipan</option>
                    <option value="Samoa">Samoa</option>
                    <option value="Samoa American">Samoa American</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syria</option>
                    <option value="Tahiti">Tahiti</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Erimates">United Arab Emirates</option>
                    <option value="United States of America">United States of America</option>
                    <option value="Uraguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican City State">Vatican City State</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                    <option value="Wake Island">Wake Island</option>
                    <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zaire">Zaire</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option></select></div>
                    <div
                style="position: absolute;top: 530px;left: 550px;width: 400px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 30px;" required="" name="pgrorigin">
                    <option value="Afganistan">Afghanistan</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bonaire">Bonaire</option>
                    <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Canary Islands">Canary Islands</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Channel Islands">Channel Islands</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos Island">Cocos Island</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote DIvoire">Cote DIvoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curaco">Curacao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="East Timor">East Timor</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands">Falkland Islands</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Ter">French Southern Ter</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Great Britain">Great Britain</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="India">India</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea North">Korea North</option>
                    <option value="Korea Sout">Korea South</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macau">Macau</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malaysia" selected="">Malaysia</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Midway Islands">Midway Islands</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Nambia">Nambia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherland Antilles">Netherland Antilles</option>
                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                    <option value="Nevis">Nevis</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau Island">Palau Island</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Phillipines">Philippines</option>
                    <option value="Pitcairn Island">Pitcairn Island</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                    <option value="Republic of Serbia">Republic of Serbia</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="St Barthelemy">St Barthelemy</option>
                    <option value="St Eustatius">St Eustatius</option>
                    <option value="St Helena">St Helena</option>
                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                    <option value="St Lucia">St Lucia</option>
                    <option value="St Maarten">St Maarten</option>
                    <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                    <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                    <option value="Saipan">Saipan</option>
                    <option value="Samoa">Samoa</option>
                    <option value="Samoa American">Samoa American</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syria</option>
                    <option value="Tahiti">Tahiti</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Erimates">United Arab Emirates</option>
                    <option value="United States of America">United States of America</option>
                    <option value="Uraguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican City State">Vatican City State</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                    <option value="Wake Island">Wake Island</option>
                    <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zaire">Zaire</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option></select></div>
                    <div
                style="position: absolute;top: 700px;left: 75px;width: 400px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 30px;" placeholder="X00000000" required="" name="pgrpass" minlength="3" maxlength="14"></div>
                <div style="position: absolute;top: 700px;left: 550px;width: 400px;"><input class="border-white shadow form-control form-control-lg" type="date" style="font-family: Montserrat, sans-serif;font-size: 30px;" required="" name="pgrexp" min="<?php echo date('Y-m-d', strtotime('+1 week')); ?>" max="2100-12-31"></div>
                <div
                style="position: absolute;top: 80px;left: 90px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 40px;">Passenger Details</h2>
                </div>
                <div style="position: absolute;top: 135px;left: 90px;">
                    <h4 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 14px;">This information is required for the official boarding pass. Please ensure inserted information is exactly matched the passport's </h4>
                </div>
                <div style="position: absolute;top: 145px;left: 40px;width: 1000px;">
                    <hr style="background-color: #ffffff;height: 2px;">
                </div>
                <div style="position: absolute;top: 185px;left: 80px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">First and middle name</h2>
                </div>
                <div style="position: absolute;top: 330px;left: 80px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Date of birth</h2>
                </div>
                <div style="position: absolute;top: 330px;left: 550px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Gender</h2>
                </div>
                <div style="position: absolute;top: 480px;left: 80px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Nationality</h2>
                </div>
                <div style="position: absolute;top: 640px;left: 80px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Passport number</h2>
                </div>
                <div style="position: absolute;top: 480px;left: 550px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Country of origin</h2>
                </div>
                <div style="position: absolute;top: 640px;left: 550px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Passport expiry date</h2>
                </div>
                <div style="position: absolute;top: 185px;left: 550px;">
                    <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 30px;">Last name</h2>
                </div>
                </div>
                <div style="position: relative;width: 1150px;">
                <div style="position: relative;width: 1100px;padding-top: 30px;"><img src="../../assets/img/selection-white/paymentfloat.png">
                <div style="position: absolute;top: 40px;left: 60px;">
                    <h6 class="text-center" style="font-family: Montserrat, sans-serif;font-size: 18px;color: rgb(255,255,255);">By proceeding, I agree to EarlyBirds' <a class="text-center" href="../../general/terms.html" style="color: #C500FF;"><span>Terms of Use</span></a><span>&nbsp;and&nbsp;</span><a class="text-center" href="../../general/privacy.html"
                            style="color: #C500FF;padding-right: 59px;"><span>Privacy Policy</span></a><button class="btn btn-primary" type="submit" style="font-family: Montserrat, sans-serif;font-weight: normal;font-style: normal;font-size: 24px;background-color: rgba(0,123,255,0);border-color: rgba(255,255,255,0);"><img src="../../assets/img/selection-white/topayment.png"></button></h6>
                    </div>
                    </div>
                </div>
        </form>
        <div style="position: absolute;top: 180px;left: 1100px;padding-left: 80px;">
            <div style="position: relative;"><img src="../../assets/img/selection-white/onewayinfo.png">
                <div class="text-center" style="position: absolute;top: 150px;left: -80px;width: 800px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 32px;"><?php echo strtoupper($_departcountry); ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 200px;left: 270px;width: 100px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 32px;">to</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 250px;left: -80px;width: 800px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 32px;"><?php echo strtoupper($_arrivecountry); ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 300px;left: 65px;width: 500px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 32px;"><?php echo $_departdatef; ?> | <?php echo $_class; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 390px;left: 380px;width: 220px;">
                    <h2 class="text-right" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo $_departdate; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 390px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo strtoupper($_departcountry) . ' to ' . strtoupper($_arrivecountry); ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 424px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo $_airline; ?> | <?php echo $_callsign; ?> | <?php echo $_model; ?> | <?php echo $_etaf; ?> hour(s)</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 460px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo $_departcode; ?> <?php echo $_departtimef; ?> - <?php echo $_arrivetimef; ?> <?php echo $_arrivecode; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 495px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 20px;"><?php echo strtoupper($_etadisplay); ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 570px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 30px;">Base fare</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 625px;left: 50px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">Ticket&nbsp;</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 732px;left: 50px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">Taxes</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 770px;left: 50px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">Surcharges</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 810px;left: 50px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">Total (unrounded)</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 625px;left: 360px;width: 250px;">
                    <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_pricef; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 732px;left: 360px;width: 250px;">
                    <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_tax; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 770px;left: 360px;width: 250px;">
                    <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_surcharge; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 810px;left: 360px;width: 250px;">
                    <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_total; ?></h2>
                </div>
                <div class="text-center" style="position: absolute;top: 690px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 30px;">Taxes and surcharges</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 880px;left: 45px;">
                    <h2 class="text-center" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 400;font-size: 30px;">Total (rounded)</h2>
                </div>
                <div class="text-center" style="position: absolute;top: 880px;left: 360px;width: 250px;">
                    <h2 class="text-right" style="color: rgb(0,0,0);font-family: Montserrat, sans-serif;font-weight: 200;font-size: 30px;">RM<?php echo $_totalrnd; ?></h2>
                </div>
                <div style="position: absolute;top: 845px;left: 40px;width: 560px;">
                    <hr style="background-color: #b7b5e4;height: 2px;">
                </div>
            </div>
            <div style="position: relative;"><img src="../../assets/img/selection-white/headsup.png">
                <div class="shadow" style="position: absolute;top: 110px;left: 35px;background-color: #ffffff;width: 580px;height: 290px;padding: 20px;border-radius: 40px;">
                    <p style="font-family: Montserrat, sans-serif;font-size: 30px;width: 550px;height: 250px;overflow-y: scroll;overflow-x: hidden;">Booking may seems to be a simple task but did you know some bookings ended up with dispute? That is true when the booking form is filled in with inaccurate or falsified information. Make sure to avoid having to file for dispute by filling in the required information accordingly!<br></p>
                </div>
            </div>
            <div style="position: relative;"><img src="../../assets/img/selection-white/cond.png">
                <div class="shadow" style="position: absolute;top: 110px;left: 35px;background-color: #ffffff;width: 580px;height: 370px;padding: 20px;border-radius: 40px;">
                    <p style="font-family: Montserrat, sans-serif;font-size: 30px;width: 550px;height: 330px;overflow-y: scroll;overflow-x: hidden;">• Price and total cost displayed are calculated by machine with no human intervention.<br>
                    • Flights availability is subjected to official schedule information feed.<br>
                    • Passenger details are subjected to international data acquisition procedure.<br>
                    • Inaccurate and falsified information provided by the user may result in legal suit.<br></p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <nav class="navbar navbar-light navbar-expand-md" style="background-color: #32161f;border-radius: 0px;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navcol-1" style="background-color: #32161f;/*margin-left: -28px;*/">
                    <div style="width: 1830px;">
                        <hr style="background-color: #ffffff;height: 2px;"><img src="../../assets/img/landingpage-red/©%202020%20EarlyBirds,%20Inc.%20All%20rights%20reserved.png" style="margin-right: 10px;"></div>
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