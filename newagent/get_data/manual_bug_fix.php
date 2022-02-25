<?php
require("../../../vicidial/dbconnect_mysqli.php");

/// create the table if it doesn't exsist

$linkCUSTOM=mysqli_connect("$VARDB_server", "$VARDB_custom_user", "$VARDB_custom_pass", "$VARDB_database", "$VARDB_port");

$stmt = "CREATE TABLE IF NOT EXISTS btx_manual_bug_fix_log (event_time datetime, Lead_ID int(9), phone_number varchar(18), user varchar(20), extension varchar(20));";
$rslt = mysqli_query($linkCUSTOM,$stmt);


$stmt = "INSERT INTO btx_manual_bug_fix_log values (now(),'".$_REQUEST['lead_id']."','".$_REQUEST['phone_number']."','".$_REQUEST['user']."','".$_REQUEST['extension']."');";
$rslt = mysqli_query($link,$stmt);



?>


