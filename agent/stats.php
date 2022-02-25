<?php
	require_once("dbconnect_mysqli.php");
	require_once("functions.php");
	?>
	<link href="css/style.css" rel="stylesheet" />
	<link href="css/polar_white/color.css" rel="stylesheet" />	
	<link href="js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	   <link href='//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
	   <link href='https://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>
	   <script type='text/javascript'>
	 var width = screen.width;
    	 var height = screen.height;
//alert(height);
	 jQuery(document).ready(function() {
	 	if(width>=1201){
	  		jQuery('head').append('<link rel="stylesheet" type="text/css" href="css/1920*1080.css">');
		}else if(width>=993 && width<=1200){
			jQuery('head').append('<link rel="stylesheet" type="text/css" href="css/993*1200.css">');
		}else if(width>=768 && width<=1024){
			jQuery('head').append('<link rel="stylesheet" type="text/css" href="css/style768_1024.css">');
		}else if(width>=481 && width<=767){
			//here we need to show full screen using only scroll property
			jQuery('head').append('<link rel="stylesheet" type="text/css" href="css/style_481*768.css">');
		}else if(width>=321 && width<=480){
			//here we need to show full screen using only scroll property
			jQuery('head').append('<link rel="stylesheet" type="text/css" href="css/style321_480.css">');
		}else if(width>=20 && width<=320){
			//here we need to show full screen using only scroll property
			jQuery('head').append('<link rel="stylesheet" type="text/css" href="css/style20_320.css">');
		}
	  });
	
	</script>
<div class="col-lg-11 col-xs-11">
<div class="col-lg-12 container-fluid">
   <!-- TOP NAVBAR -->
   
	<div class="cl-mcont" style="background:#fff;">
    		<div class="row">    
      			<div class="side_space1" >
        		<div class="block-flat">
		
		

	<!--<table border="1" bgcolor="#CCFFCC" ><tr><td align="center" valign="top"> &nbsp; &nbsp; &nbsp;<center><div class="head_title" style="width:100%;"> <?php echo _QXZ("AGENT CALL LOG:"); ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <<?php echo _QXZ("close"); ?> [X]</a></div></center><br />-->
	
	<?php
	if ($webphone_location == 'bar')
		{echo "<br /><img src=\"./images/"._QXZ("pixel.gif")."\" width=\"1px\" height=\"".$webphone_height."px\" /><br />\n";}
	?>
	<div class="content no-padding">
		
		<div class="col-lg-6 space"  style="overflow:scroll;height:300px;"> 
			<div class="header no-border box-shadow" style="border-top: 1px solid #8a9084;">							
            <h3><center><?php echo _QXZ("My Daily Stats"); ?></center></h3>
          </div>
            
          
          <div class="row">
			<?php 

	$phone_login = $_REQUEST['phone_login'];
	$phone_pass = $_REQUEST['phone_pass'];
	$user_login = $_REQUEST['VD_login'];
	$user_pass = $_REQUEST['VD_pass'];
	$campaign = $_REQUEST['VD_campaign'];
	$ingroups=$_REQUEST['closer_campaigns'];
	$ingroups=str_replace(" ","','",trim($ingroups));
	$ingroups=trim($ingroups,",'-");
	$ingroups="'".$ingroups."'";

	$today_date = date('Y-m-d');
	
	 $get_total_call_query = "select count(*) as calls,sum(talk_sec) as duration from vicidial_agent_log where event_time <= '$today_date 23:59:59' and event_time >= '$today_date 00:00:00' and pause_sec<65000 and wait_sec<65000 and talk_sec<65000 and dispo_sec<65000 and campaign_id='$campaign' and user='$phone_login'";
	 $get_rslt=mysql_to_mysqli($get_total_call_query, $link); 
	 $rows_to_print = mysqli_fetch_row($get_rslt);
	 $total_calls = sprintf("%5s", $rows_to_print[0]);
	 $duration = sprintf("%5s", $rows_to_print[1]);
	 
	 $get_total_call_query = "select count(*) as calls from vicidial_agent_log where event_time <= '$today_date 23:59:59' and event_time >= '$today_date 00:00:00' and pause_sec<65000 and wait_sec<65000 and talk_sec<65000 and dispo_sec<65000 and campaign_id='$campaign' and user='$phone_login' and status='SALE'";
     $get_rslt=mysql_to_mysqli($get_total_call_query, $link); 
	 $rows_to_print = mysqli_fetch_row($get_rslt);
	 $sales = sprintf("%5s", $rows_to_print[0]);


	//~ $get_outbound_call_query = "";
	//~ $get_out_rslt=mysql_to_mysqli($get_outbound_call_query, $link); 
	//~ $rows_to_print_out = mysqli_fetch_row($get_out_rslt);
	//~ $outbound_calls = sprintf("%10s", $rows_to_print_out[0]);
	
	$vicidial_log_table="vicidial_log";
	 $get_outbound_call_query="select count(*),term_reason from ".$vicidial_log_table." where call_date >= '$today_date 00:00:00 ' and call_date <= '$today_date 23:59:59 ' and campaign_id='$campaign';";
	 $get_rslt=mysql_to_mysqli($get_outbound_call_query, $link);
	 $reasons_to_print = mysqli_fetch_row($get_rslt);
	$outbound_calls =sprintf("%10s", $reasons_to_print[0]);
	
	$stmt="select group_id from vicidial_inbound_groups";
	$rslt=mysql_to_mysqli($stmt, $link);
	$groups_print=mysqli_num_rows($rslt);
	$i=0;
	while ($i < $groups_print)
			  {
				$row=mysqli_fetch_row($rslt);
				$group_list[$i]=$row[0];
				$group_names[$i]=$row[1];
				$i++;
				
	}
	
	$vicidial_closer_log_table="vicidial_closer_log";
	$stmt="select count(*),term_reason from ".$vicidial_closer_log_table." where call_date >= '$today_date 00:00:00' and call_date <= '$today_date 23:59:59' and campaign_id IN('$row[0]');";
	$rslt=mysql_to_mysqli($stmt, $link);
	$closer_to_print = mysqli_fetch_row($rslt);
	$REASONcount =	sprintf("%10s", $closer_to_print[0]);
	
	
	$inbound_calls="0";
	if(trim($ingroups)!=""){
			$stmt="select count(*) from vicidial_closer_log where call_date >= '$today_date 00:00:00' and call_date <= '$today_date 23:59:59' and campaign_id IN($ingroups) and user='$user_login';";
			$rslt=mysql_to_mysqli($stmt, $link);
			$closer_to_print = mysqli_fetch_row($rslt);
	        $inbound_calls =	sprintf("%10s", $closer_to_print[0]);
	}

	

	
	
	
	
	
?>

<div class="col-md-3 col-sm-6 col-xs-12" style='width:32%;float: left;position: relative;min-height: 1px;margin-bottom: 1%;margin-top: 3%;'>
          <div class="info-box" style='background-color:#fff;'>
            <span class="info-box-icon bg-aqua" style="background-color: #3c8dbc;"><i class="fa fa-phone"></i></span>

            <div class="info-box-content" >
				<span class="info-box-text" style="color:#000;">total calls</span>
              
              <span class="info-box-number" style="color:#000;"><?php echo $outbound_calls+$inbound_calls;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        
          
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12" style='width:32%;float: left;position: relative;min-height: 1px;margin-bottom: 1%;margin-top: 3%;'>
          <div class="info-box" style='background-color:#fff;'>
            <span class="info-box-icon bg-aqua" style="background-color: rgb(147, 42, 182);"><i class="fa fa-phone"></i></span>

            <div class="info-box-content">
				<span class="info-box-text" style="color:#000;">Outbound callls</span>
              
              <span class="info-box-number" style="color:#000;"><?php echo $outbound_calls ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        
          <div class="col-md-3 col-sm-6 col-xs-12" style='width:32%;float: left;position: relative;min-height: 1px;margin-bottom: 1%;margin-top: 3%;'>
          <div class="info-box" style='background-color:#fff;'>
            <span class="info-box-icon bg-aqua" style="background-color: #dd4b39 !important;"><i class="fa fa-signal"></i></span>

            <div class="info-box-content">
				<span class="info-box-text" style="color:#000;">Inbound calls</span>
              
              <span class="info-box-number" style="color:#000;"><?php echo $inbound_calls ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        
        </div>
        
         <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12" style='width:32%;float: left;position: relative;min-height: 1px;margin-bottom: 1%;margin-top: 3%;'>
          <div class="info-box" style='background-color:#fff;'>
            <span class="info-box-icon bg-aqua" style="background-color:#00c0ef; !important;"><i class="fa fa-check"></i></span>

            <div class="info-box-content" >
				<span class="info-box-text" style="color:#000;">sales</span>
              
              <span class="info-box-number" style="color:#000;"><?php echo $sales ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12" style='width:32%;float: left;position: relative;min-height: 1px;margin-bottom: 1%;margin-top: 3%;'>
          <div class="info-box" style='background-color:#fff;'>
            <span class="info-box-icon bg-aqua" style="background-color: #00a65a !important;"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content" >
				<span class="info-box-text" style="color:#000;">close rate(%)</span>
              
              <span class="info-box-number" style="color:#000;"><?php echo round($outbound_calls/$sales,2);?><small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12" style='width:32%;float: left;position: relative;min-height: 1px;margin-bottom: 1%;margin-top: 3%;'>
          <div class="info-box" style='background-color:#fff;'>
            <span class="info-box-icon bg-aqua" style="background-color: #f39c12 !important;"><i class="fa fa-tag"></i></span>

            <div class="info-box-content" >
				<span class="info-box-text" style="color:#000;">avarage handle time</span>
              
              <span class="info-box-number" style="color:#000;"><?php echo sec_convert($duration/($outbound_calls+$inbound_calls),'M'); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </div>
          
          
          </div>
        
        
       </div>
		<div class="col-lg-6 space"  style="overflow:scroll;height:300px;"> 
			<div class="header no-border box-shadow" style="margin-bottom: 3%;border-top: 1px solid #8a9084;">							
            <h3><center><?php echo _QXZ("Daily Leaderboard"); ?></center></h3>
       </div>
   
     <table class='table table-striped' style='padding:24px;padding-top:20px;'>
		 <?php
			  $stmt="SELECT user, full_name from vicidial_users $whereLOGadmin_viewable_groupsSQL order by user";
			  $rslt=mysql_to_mysqli($stmt, $link);
			  $users_to_print =  mysqli_num_rows($rslt);
	          $i=0;
	          $today_date = date('Y-m-d');
	         
			  while ($i < $users_to_print)
			  {
				$row=mysqli_fetch_row($rslt);
				$user_list[$i]=$row[0];
				$user_names[$i]=$row[1];
				if ($all_users) {$user_list[$i]=$row[0];}
				$i++;
				
				//~ $get_total_call_query = "select count(*) as calls from vicidial_agent_log where event_time <= '$today_date 23:59:59' and event_time >= '$today_date 00:00:00' and pause_sec<65000 and wait_sec<65000 and talk_sec<65000 and dispo_sec<65000  and user='$row[0]'";
			   //~ $get_total_call_query = "select count(*) as calls from vicidial_agent_log where event_time <= '$today_date 23:59:59' and event_time >= '$today_date 00:00:00' and pause_sec<65000 and wait_sec<65000 and talk_sec<65000 and dispo_sec<65000 and campaign_id='$campaign' and user='$row[0]'";
			   //~ $get_rslt=mysql_to_mysqli($get_total_call_query, $link); 
			   //~ $rows_to_print = mysqli_fetch_row($get_rslt);
			   //~ $calls = sprintf("%5s", $rows_to_print[0]);
			   
			   $vicidial_log_table="vicidial_log";
				$get_outbound_call_query="select count(*),term_reason from ".$vicidial_log_table." where call_date >= '$today_date 00:00:00 ' and call_date <= '$today_date 23:59:59 ' and campaign_id='$campaign' and user='$row[0]';";
				$get_rslt=mysql_to_mysqli($get_outbound_call_query, $link);
				$reasons_to_print = mysqli_fetch_row($get_rslt);
				$outbound_calls =sprintf("%10s", $reasons_to_print[0]);
			   
			   $get_total_call_query = "select count(*) as calls from vicidial_agent_log where event_time <= '$today_date 23:59:59' and event_time >= '$today_date 00:00:00' and pause_sec<65000 and wait_sec<65000 and talk_sec<65000 and dispo_sec<65000 and campaign_id='$campaign' and user='$row[0]' and status='SALE'";
			   $get_rslt=mysql_to_mysqli($get_total_call_query, $link); 
			   $rows_to_print = mysqli_fetch_row($get_rslt);
			   $sales = sprintf("%5s", $rows_to_print[0]);
			   ?>
				<tr  style='padding:24px;'>
			  
			  
			   
			 <td style='padding:24px;'><i class="fa fa-user" style="font-size:20px;"></i><?php echo $row[0]; ?></td>
			 <td style='padding:24px;'><?php echo $outbound_calls ?><br>calls</td>
			 <td style='padding:24px;'><?php echo $sales ?><br> Sales</td>
		 </tr>
		 <?php }?>
		 
       </table>
       
			
			 </div>
			 
		
		<!--ishwari
		27-june-2018-->
<!--
	<div class="col-lg-12 space middleheight" id="CallLogSpan" style="overflow:scroll;height:436px;"> <?php echo _QXZ("Call log List"); ?> </div>
-->
	
	
	<!--end-->
	</div>
	
	</div></div></div></div></div></div>
