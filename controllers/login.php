<?php
include_once '../inc/conn.php';
include_once '../inc/functions.php';

$u_id  = $_POST['u_id'];
$u_pass = $_POST['u_pass'];

$api_user="admin@bluetelecoms.com";
$api_pass="admin@2021";




if(user_login($u_id, $u_pass)){
    $token=get_access_token($api_user,$api_pass);
    $user_type=get_user_type($u_id,$token);

    var_dump($user_type);
    exit();
    if($user_type==1){



        header('Location: admin/index.php');
    }


}
