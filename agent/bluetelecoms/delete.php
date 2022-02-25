<?php
 require_once("../dbconnect_mysqli.php");
	require_once("../functions.php");
	$id=$_POST['cb_id'];
	$user=$_POST['user'];
	$stmt = "update vicidial_callbacks set recipient = 'ANYONE' where callback_id='$id' and user='$user';";
	$rslt=mysql_to_mysqli($stmt, $link);
 ?>
