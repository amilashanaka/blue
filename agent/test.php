<?php
	//~ include "vicidial.php";
	require_once("dbconnect_mysqli.php");
	require_once("functions.php");
	
	$phone_number = $_POST['phone_number'];
	
	$stmt = "select * from vicidial_dnc where phone_number = $phone_number";
	$rslt=mysql_to_mysqli($stmt, $link);
	
	 $row=mysqli_fetch_row($rslt);
	
	if($row > 0){
			echo "<b>This number is already in DNC list</b>";
	}
	else{
		
		$stmt="INSERT INTO vicidial_dnc (phone_number) values('$phone_number');";
		$rslt=mysql_to_mysqli($stmt, $link);
	
	echo '
					<B>Phone number has been successfully insert in DNC list</B>
		';
	}
	
	
	
    //~ $var = $_POST['phoneNumber'];

?>

