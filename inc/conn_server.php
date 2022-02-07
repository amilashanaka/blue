<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
error_reporting(0);
@ini_set('display_errors', 0);



define("DB_SERVER", "localhost");

define("DB_USER", "bay_db");
define("DB_PASS", "Bay@2021");
define("DB_NAME", "bay_db");
define('APP_NAME', 'Bay Wash');

$email_username = "admin@baywash.com.my";
$email_from_name = "Bay Wash";


$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

