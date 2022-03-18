<?php

date_default_timezone_set("Europe/London");
error_reporting(0);
@ini_set('display_errors', 0);



define("DB_SERVER", "localhost");

define("DB_USER", "cron");
define("DB_PASS", "Yabradru0rig");
define("DB_NAME", "blue");
define('APP_NAME', 'Blue Telecoms');

$email_username = "admin@baywash.com.my";
$email_from_name = "Bay Wash";


$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

