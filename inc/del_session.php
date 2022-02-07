<?php

/* 
Amila : clear Session
 */

 

session_start();
unset($_SESSION['login']);
unset($_SESSION['login_name']);
unset($_SESSION['login_type']); 
unset($_SESSION['SecKey'] );


session_destroy();

header('Location: ../admin/login.php?error=6');
 