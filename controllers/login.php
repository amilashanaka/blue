<?php
//include_once '../inc/session.php';
include_once '../inc/functions.php';

$u_id  = $_POST['u_id'];
$u_pass = $_POST['u_pass'];

$api_user="admin@bluetelecoms.com";
$api_pass="admin@2021";




var_dump(user_login($u_id, $u_pass));
exit();

if(user_login($u_id, $u_pass)){
    $token=get_access_token($api_user,$api_pass);


//    if ($_SESSION['SecKey'] == '') {
//        $_SESSION['login'] = $res['a_id'];
//        $_SESSION['login_name'] = $res['a_username'];
//        $_SESSION['login_type'] = $res['a_type'];
//        $_SESSION['login_type_name'] = getAdminType($res['a_type'], $conn);
//        $_SESSION['SecKey'] = setSecKey($res['a_id'], $conn);
//
//        header('Location: ../index.php');
//    }

    $user_type=get_user_type($u_id,$token);

    if($user_type==1){



        header('Location: ../admin/index.php');
    }


}
