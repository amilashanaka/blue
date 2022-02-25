<?php 
	require_once("dbconnect_mysqli.php");
	require_once("functions.php");
	
	//echo "<pre>"; print_r($_POST); 
	
	$phone = $_POST['phone'];
	$unique_id = $_POST['unique_id'];
	
	if ((!preg_match("/^[0-9]+$/i", $phone)) &&  $phone != "") {
        
        echo '<center><B style="color:red;">Please input valid phone</B></center>';
        
    }
    
    elseif ((!preg_match("/^[0-9]+$/i", $unique_id)) &&  $unique_id != "") {
        
        echo '<center><B style="color:red;">Please input valid unique ID</B></center>';
        
    }
	
	elseif(($phone == '') && ($unique_id == '')){
		
			echo "<center><b style='color:red;'>Please enter phone number or unique id</b></center>";
	}
	
	elseif (($phone != '') && ($unique_id == '')){
		$stmt = "SELECT lead_id,entry_date,modify_date,status,user,vendor_lead_code,source_id,list_id,gmt_offset_now,called_since_last_reset,phone_code,phone_number,title,first_name,middle_initial,last_name,address1,address2,address3,city,state,province,postal_code,country_code,gender,date_of_birth,alt_phone,email,security_phrase,comments,called_count,last_local_call_time,rank,owner from vicidial_list where phone_number=$phone"; 
		$rslt=mysql_to_mysqli($stmt, $link);
		
		$result = mysqli_num_rows($rslt);
		//echo "<pre>"; print_r($result); 
		$i= 1;
		
		if($result > 0){
			$row = mysqli_fetch_row($rslt);
			echo "<table class='table table-bordered table-sm table-responsive'><tr>
					<thead>
						<th style='padding:0;font-size:13px;'>#</th>
						<th style='padding:0;font-size:13px;'>Lead ID</th>
						<th style='padding:0;font-size:13px;'>Last call</th>
						<th style='padding:0;font-size:13px;'>Status</th>
						<th style='padding:0;font-size:13px;'>Agent</th>
						<th style='padding:0;font-size:13px;'>List ID</th>
						<th style='padding:0;font-size:13px;'>Phone</th>
						</thead></tr>";
				echo "<tr>
					  <td>$i</td>
					  <td>$row[0]</td>
					  <td>$row[2]</td>
					  <td>$row[3]</td>
					  <td>$row[4]</td>
					  <td>$row[7]</td>
					  <td>$row[11]</td>
					</tr>";
				echo "</table>";
			$i++;
			
		}
		else{
				echo "<center><b style='color:red;'>No data found</b></center>";
		}
		
		
	}
	
	elseif(($unique_id != '') && ($phone != '')){
	
	$stmt = "SELECT lead_id,entry_date,modify_date,status,user,vendor_lead_code,source_id,list_id,gmt_offset_now,called_since_last_reset,phone_code,phone_number,title,first_name,middle_initial,last_name,address1,address2,address3,city,state,province,postal_code,country_code,gender,date_of_birth,alt_phone,email,security_phrase,comments,called_count,last_local_call_time,rank,owner from vicidial_list where phone_number=$phone and lead_id=$unique_id";
	$rslt=mysql_to_mysqli($stmt, $link);
	
	$result = mysqli_num_rows($rslt);
		//echo "<pre>"; print_r($result); 
		$i= 1;
		
		if($result > 0){
			$row = mysqli_fetch_row($rslt);
			echo "<table class='table data-table stropped-table'><tr><thead><th>#</th><th>Lead ID</th><th>Last call</th><th>Status</th><th>Agent</th><th>List ID</th><th>Phone</th></thead></tr>";
				echo "<tr>
					  <td>$i</td>
					  <td>$row[0]</td>
					  <td>$row[2]</td>
					  <td>$row[3]</td>
					  <td>$row[4]</td>
					  <td>$row[7]</td>
					  <td>$row[11]</td>
					</tr>";
				echo "</table>";
			$i++;
			
		}
		else{
				echo "<center><b style='color:red;'>No data found</b></center>";
		}
	
	}
	
	else{
		$stmt = "SELECT lead_id,entry_date,modify_date,status,user,vendor_lead_code,source_id,list_id,gmt_offset_now,called_since_last_reset,phone_code,phone_number,title,first_name,middle_initial,last_name,address1,address2,address3,city,state,province,postal_code,country_code,gender,date_of_birth,alt_phone,email,security_phrase,comments,called_count,last_local_call_time,rank,owner from vicidial_list where lead_id=$unique_id";
		$rslt=mysql_to_mysqli($stmt, $link);
		
		$result = mysqli_num_rows($rslt);
		//echo "<pre>"; print_r($result); 
		$i= 1;
		
		if($result > 0){
			$row = mysqli_fetch_row($rslt);
			echo "<table class='table data-table stropped-table'><tr><thead><th>#</th><th>Lead ID</th><th>Last call</th><th>Status</th><th>Agent</th><th>List ID</th><th>Phone</th></thead></tr>";
				echo "<tr>
					  <td>$i</td>
					  <td>$row[0]</td>
					  <td>$row[2]</td>
					  <td>$row[3]</td>
					  <td>$row[4]</td>
					  <td>$row[7]</td>
					  <td>$row[11]</td>
					</tr>";
				echo "</table>";
			$i++;
			
		}
		else{
				echo "<center><b style='color:red;'>No data found</b></center>";
		}
		
	}
?>
