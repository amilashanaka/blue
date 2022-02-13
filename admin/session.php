<?php

if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
include_once '../inc/functions.php';

$today= date("Y-m-d H:i:s"); 


if ($_SESSION['SecKey'] != getSecKey($_SESSION['login'], $conn)) {

    include_once '../inc/del_session.php';
    header('Location: login.php');
    exit();
}

if ($_SESSION['login'] == '') {

    include_once '../inc/del_session.php';
    header('Location: login.php');
    exit();
}else{
    
    $user_act=$_SESSION['login'];
}

if ($_SESSION['site'] != $_SESSION['last_site']) {
    include_once '../inc/del_session.php';
    header('Location: login.php');
    exit();
}
 
