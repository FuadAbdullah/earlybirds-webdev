<?php


//Starting session
//Including conn.php

//Defining timezone

date_default_timezone_set('Asia/Kuala_Lumpur');

session_start();
include('conn.php');

if (isset($_FILES['upload']))
{
    if ($_FILES['upload']['error'] > 0)
    {
        echo
        '
            <script>
                alert("Error encountered while uploading the image!");
            </script>
        ';
        die
        ('
            <script>
                window.location.href="../roles/admin/userprofile.php?uid=' . $_POST['uid'] . '";
            </script>
        ');
    }
    else
    {
        $_allfiletype = array('image/png', 'image/jpg', 'image/jpeg', 'image/bmp');
        if (in_array($_FILES['upload']['type'], $_allfiletype))
        {
            switch($_FILES['upload']['type'])
            {
                case 'image/png':
                    $_ext = '.png';
                break;
                case 'image/jpg':
                    $_ext = '.jpg';
                break;
                case 'image/jpeg':
                    $_ext = '.jpeg';
                break;
                case 'image/bmp':
                    $_ext = '.bmp';
                break;
                default:
                    $_ext = '.jpg';
            }
            $_randname = mt_rand(100000000, 999999999);
            $_tmp = $_FILES['upload']['tmp_name'];
            $_dst = '../assets/upload/' . $_randname . $_ext;
            $_reldst = '../../assets/upload/' . $_randname . $_ext;

            if (move_uploaded_file($_tmp, $_dst))
            {
                $_sql = 'UPDATE user SET img_dir = "' . $_reldst . '" WHERE uid = "' . $_POST['uid'] . '"';

                mysqli_query($_conn, $_sql);

                if (mysqli_affected_rows($_conn) <= 0)
                {
                    echo
                '
                    <script>
                        alert("Failed to upload image to database!");
                    </script>
                ';
                }

                if (file_exists($_tmp) && is_file($_tmp))
                {
                    unlink($_tmp);
                }   

                echo
                '
                    <script>
                        alert("Image uploaded successfully!");
                    </script>
                ';
                echo
                '
                    <script>
                        window.location.href="../roles/admin/userprofile.php?uid=' . $_POST['uid'] . '";
                    </script>
                ';

            }
            else
            {
                echo
                '
                    <script>
                        alert("Image upload failed!");
                    </script>
                ';
                die
                ('
                    <script>
                        window.location.href="../roles/admin/userprofile.php?uid=' . $_POST['uid'] . '";
                    </script>
                ');
            }

        }
        else
        {
            
            echo
            '
                <script>
                    alert("Unsupported file type!");
                </script>
            ';
            die
            ('
                <script>
                    window.location.href="../roles/admin/userprofile.php?uid=' . $_POST['uid'] . '";
                </script>
            ');
        }
    }
}

//Close ongoing connection
include('closeconn.php');

?>