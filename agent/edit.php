<?php
 require_once("dbconnect_mysqli.php");
	require_once("functions.php");
	$id=$_POST['cb_id'];
	$user=$_POST['user'];
	$callback_time=$_POST['callback_time'];
	//~ echo '<pre>';print_r($_POST);
	echo $stmt="UPDATE vicidial_callbacks SET callback_time='$callback_time;' where callback_id='$id' and user='$user' order by callback_time;";
	 if ($DB) {echo "$stmt\n";}
	 $rslt=mysql_to_mysqli($stmt, $link);
	 $row=mysqli_fetch_row($rslt);
	
	
	
 ?>
