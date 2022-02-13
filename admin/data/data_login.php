<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
include_once '../../conn.php';
include_once '../../inc/functions.php';

//Fetching Values from URL
$login_pass   = $_POST['a_password'];
$hash         = password_hash($login_pass, PASSWORD_DEFAULT);
$login_user   = $_POST['a_username'];

$captcha_code = $_POST["captcha_code"];

 

if ($login_pass != '' && $login_user != '')
{

    $sqlcheck     = "SELECT * FROM admins WHERE a_username='" . $login_user . "' AND a_status = 1 ";
    $result       = mysqli_query($conn, $sqlcheck);

    if (mysqli_num_rows($result) > 0)
    {
        $res          = mysqli_fetch_assoc($result);
        if ($captcha_code != $_SESSION["captcha_code"])
        {
            header('Location: ../login.php?error=5');
            exit();
        }
        if (password_verify($login_pass, $res['a_password']))
        {
            if ($_SESSION['SecKey'] == '') {
                $_SESSION['login'] = $res['a_id'];
                $_SESSION['login_name'] = $res['a_username'];
                $_SESSION['login_type'] = $res['a_type'];
                $_SESSION['login_type_name'] = getAdminType($res['a_type'], $conn);
                $_SESSION['SecKey'] = setSecKey($res['a_id'], $conn);

                header('Location: ../index.php');
            }else{
                 
                 header('Location: ../../inc/del_session.php');
                
            }
           
        }
        else
        {
            header('Location: ../login.php?error=1');
        }
    }
    else
    {
        header('Location: ../login.php?error=1');
    }

}
else
{
    header('Location: ../login.php?error=0');
}

