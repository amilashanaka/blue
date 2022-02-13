<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
unset($_SESSION['login']);
unset($_SESSION['login_name']);
unset($_SESSION['login_type']);
unset($_SESSION['SecKey']);


session_destroy();
header('Location: ../../admin/login.php');
exit();
