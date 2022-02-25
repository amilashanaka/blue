<?php
	//~ include "vicidial.php";
	require_once("dbconnect_mysqli.php");
	require_once("functions.php");
	
	$phone_number = $_POST['phone_number'];
	
	if (!preg_match("/^[0-9]+$/i", $phone_number)) {
        $errorMSG = 'Invalid Number!';
        echo '<center><B style="color:red;">Please input valid number</B></center>';
        
    }
	else{
	$stmt = "select * from vicidial_dnc where phone_number = $phone_number";
	$rslt=mysql_to_mysqli($stmt, $link);
	
	$row=mysqli_fetch_row($rslt);
	
	if($row > 0){
			echo "<center><b style='color:red;'>This number is already exist</b></center>";
	}
	else{
		
		$stmt="INSERT INTO vicidial_dnc (phone_number) values('$phone_number');";
		$rslt=mysql_to_mysqli($stmt, $link);
	
	echo '<center><B style="color:green;">Phone number has been added</B></center>';
		
	}
}
?>

