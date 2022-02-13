<?php


include_once '../../conn.php';
include_once '../../inc/functions.php';

if (isset($_GET['a_id'])) {
    $a_id = base64_decode($_GET['a_id']);
} else {
    $a_type = 0;
}

if($a_id>0){
 session_start();
unset($_SESSION['login']);
unset($_SESSION['login_name']);
unset($_SESSION['login_type']); 
unset($_SESSION['SecKey'] );

session_destroy();

if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

if ($_SESSION['SecKey'] == '') {
    
                $_SESSION['login'] = $a_id;
                $_SESSION['login_name'] = getaAdminUserName($a_id, $conn);
                $_SESSION['login_type'] = getAdminTypeIdByid($a_id, $conn);
                $_SESSION['login_type_name'] = getAdminType($a_id, $conn);
                $_SESSION['SecKey'] = setSecKey($a_id, $conn);

                header('Location: ../index.php');
                exit();
            }else{
                 
                 header('Location: ../../inc/del_session.php');
                
  }
   
    
}else{
    
     header('Location: ../admin.php');
    
}


