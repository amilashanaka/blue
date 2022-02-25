<?php
 require_once("dbconnect_mysqli.php");
	require_once("functions.php");
	$id=$_POST['cb_id'];
	$user=$_POST['user'];
	
	
	
	 $stmt = "SELECT callback_id,lead_id,list_id,campaign_id,status,callback_time,user,recipient,user_group,lead_status,comments from vicidial_callbacks where callback_id='$id' order by callback_time;";
		 $rslt=mysql_to_mysqli($stmt, $link);
		 $Recall=mysqli_num_rows($rslt);
		 $rowx=mysqli_fetch_row($rslt);
		 
			$callback_id	= $rowx[0];
			$lead_id		= $rowx[1];
			$list_id        =$rowx[2];
			$campaign_id	= $rowx[3];
			$status		= $rowx[4];
			//~ $entry_time	= date("Y-m-d");;
			$callback_time	= $rowx[5];
			//~ $modify_date	=date("Y-m-d");;
			$user	=$rowx[6];
			$recipient	=$rowx[7];
			$user_group =$rowx[8];
			$comments		= $rowx[9];
			$stmt="Insert into vicidial_callbacks(lead_id,list_id,campaign_id,status,callback_time,user,recipient,user_group) values ('".$rowx[1]."','".$rowx[2]."','".$rowx[3]."','".$rowx[4]."','".$rowx[5]."','".$rowx[6]."','".$rowx[7]."','".$rowx[8]."') ";
			 $rslt=mysql_to_mysqli($stmt, $link);
			 $row=mysqli_fetch_row($rslt);
   
   
		  //~ if ($DB) {echo "$stmt\n";}
		   // $rslt=mysql_to_mysqli($stmt, $link);
		//~ $rows = mysqli_affected_rows($link);
 ?>
