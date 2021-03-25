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

$_sql = 'SELECT * FROM admin ORDER BY aid';

$_sort = '';


if (isset($_POST['filter']))
{
    if ($_POST['sort'] == 'Default')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY aid';
    }
    else if ($_POST['sort'] == 'DefaultDesc')
    {  
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY aid DESC';
    }
    else if ($_POST['sort'] == 'FullName')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY full_name';
    }
    else if ($_POST['sort'] == 'FullNameDesc')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY full_name DESC';
    }
    else if ($_POST['sort'] == 'UserName')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY username';
    }
    else if ($_POST['sort'] == 'UserNameDesc')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY username DESC';
    }
    else if ($_POST['sort'] == 'Contact')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY contact_num';
    }
    else if ($_POST['sort'] == 'ContactDesc')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY contact_num DESC';
    }
    else if ($_POST['sort'] == 'Email')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY email_address';
    }
    else if ($_POST['sort'] == 'EmailDesc')
    {
        $_sql = 'SELECT * FROM admin WHERE aid LIKE "%' . $_POST['filter'] . '%" or
                                    full_name LIKE "%' . $_POST['filter'] . '%" or
                                    username LIKE "%' . $_POST['filter'] . '%" or
                                    password LIKE "%' . $_POST['filter'] . '%" or
                                    contact_num LIKE "%' . $_POST['filter'] . '%" or
                                    email_address LIKE "%' . $_POST['filter'] . '%"
                                    ORDER BY email_address DESC';
    }
    
}

$_results = mysqli_query($_conn, $_sql);




?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>View Admin</title>
    <meta name="description" content="View list of registered administrators">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../assets/css/overwrite.css">
    <link rel="stylesheet" href="../../assets/css/Scroll-Effect.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>
    <main style="background-color: #FFEBC6;position: relative;min-height: 1000px;">
        <div style="background-color: #f15946;height: 200px;padding-top: 200px;">
            <div style="position: absolute;top: 35px;left: 35px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Administrator</h2>
            </div>
            <div style="position: absolute;top: 105px;left: 35px;">
                <h2 style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;">Administrator List</h2>
            </div>
            <div style="position: absolute;top: 25px;left: 965px;width: 900px;">
                <h2 class="text-right" style="color: rgb(255,255,255);font-family: Montserrat, sans-serif;font-weight: 500;font-size: 50px;"><?php echo $_admrow['full_name']; ?></h2>
            </div>
            <div style="position: absolute;top: 105px;left: 1310px;width: 350px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="adminregister.php">Add Admin</a></div>
            <div style="position: absolute;top: 105px;left: 1630px;width: 270px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="../../php/adminsignout.php">Sign Out</a></div>
            <div style="position: absolute;top: 105px;left: 610px;width: 360px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="adminviewam.php">View Manager</a></div>
            <div style="position: absolute;top: 105px;left: 990px;width: 360px;"><a class="btn btn-primary shadow" role="button" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;border-color: rgba(255,255,255, 0);"
                    href="adminviewuser.php">View Users</a></div>
        </div>
        <div style="height: 120px;">
            <form method="post" action="adminviewadmin.php">
                <div style="position: absolute;top: 240px;left: 40px;width: 930px;"><input class="border-white shadow form-control form-control-lg" type="text" size="25" style="font-family: Montserrat, sans-serif;font-size: 40px;border-radius: 30px;" placeholder="Filter keyword" name="filter"></div>
                <div
                        style="position: absolute;top: 240px;left: 1000px;width: 600px;"><select class="border-white shadow form-control form-control-lg" style="font-family: Montserrat, sans-serif;font-size: 40px; border-radius: 30px;" name="sort" required="">
                            <option value="Default" selected="">By User ID (Ascending)</option>
                            <option value="DefaultDesc">By User ID (Descending)</option>
                            <option value="FullName">By Full Name (Ascending)</option>
                            <option value="FullNameDesc">By Full Name (Descending)</option>
                            <option value="UserName">By Username (Ascending)</option>
                            <option value="UserNameDesc">By Username (Descending)</option>
                            <option value="Contact">By Contact (Ascending)</option>
                            <option value="ContactDesc">By Contact (Descending)</option>
                            <option value="Email">By Email (Ascending)</option>
                            <option value="EmailDesc">By Email (Descending)</option></select></div>

                <div style="position: absolute;top: 250px;left: 1620px;width: 200px;"><button class="btn btn-primary border-white shadow" type="submit" style="background-color: #ffffff;color: #f15946;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;padding-right: 50px;padding-left: 50px;border-radius: 30px;">Search</button></div>
            </form>
        </div>
        <div style="position: relative;padding-bottom: 50px;padding-left: 40px;padding-top: 30px;">
            <div style="width: 1830px;height: 1040px;background-color: #ffb100;border-radius: 60px;overflow-y: scroll;padding: 30px;">
                <div class="table-responsive table-borderless" style="font-family: Montserrat, sans-serif;font-size: 35px;">
                    <table style="width: 3500px;" class="table table-bordered table-hover">
                        <thead>
                            <tr style="color: rgb(255,255,255);">
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Admin ID</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Contact Number</th>
                                <th>Email Address</th>
                            </tr>
                        </thead>
                        <tbody style="color: rgb(255,255,255);">
                            <?php

                            if(mysqli_affected_rows($_conn)>0){
                                for($i = 0; $i<mysqli_num_rows($_results); $i++){
                                    $row = mysqli_fetch_assoc($_results);
                                    echo '<tr>';
                                    echo '<td><a href = "adminprofile.php?aid='.$row['aid'].'">
                                    <button class="btn btn-primary shadow" type="submit" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;border-radius: 30px;border-color: rgba(255,255,255, 0);">Edit</button></a></td>';
                                    echo '<td><a href = "../../php/admindeleteadmin.php?aid='.$row['aid'].'">
                                    <button class="btn btn-primary shadow" type="submit" style="background-color: #FFB100;color: #FFFFFF;font-family: Montserrat, sans-serif;font-size: 34px;font-weight: 600;border-radius: 30px;border-color: rgba(255,255,255, 0);">Delete</button></a></td>';
                                    echo '<td>'.sprintf('%05d', $row['aid']).'</td>';
                                    echo '<td>'.$row['full_name'].'</td>';
                                    echo '<td>'.$row['username'].'</td>';
                                    echo '<td>'.$row['password'].'</td>';
                                    echo '<td>'.$row['contact_num'].'</td>';
                                    echo '<td>'.$row['email_address'].'</td>';
                                    echo '</tr>';
                                }
                            }
                            else
                            {
                                echo '<tr>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '<td>Database is empty!</td>';
                                echo '</tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
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