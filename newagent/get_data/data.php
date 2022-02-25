<?php

function get_tiny_url($url)  {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
}



function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}




require("../../dbconnect_mysqli.php");





if ($_REQUEST['query'] == 'dispo_cat')
{

  $data = array();



  $rslt = mysqli_query($link,"select lower(status) as 'status' from vicidial_statuses where  scheduled_callback = 'Y' union select lower(status) as 'status' from vicidial_campaign_statuses where scheduled_callback = 'Y' and (campaign_id ='".$_REQUEST['camp']."' or campaign_id in (select status_group_id from vicidial_status_groups));");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['CBK'][]=$row;

  }

  $rslt = mysqli_query($link,"select lower(status) as 'status' from vicidial_statuses where sale = 'Y' union select lower(status) as 'status' from vicidial_campaign_statuses where sale = 'Y' and (campaign_id ='".$_REQUEST['camp']."' or campaign_id in (select status_group_id from vicidial_status_groups));");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['SALES'][]=$row;

  }
  
  $rslt = mysqli_query($link,"select lower(status) as 'status' from vicidial_statuses where dnc = 'Y' or not_interested = 'Y' or unworkable = 'Y' union select lower(status) as 'status' from vicidial_campaign_statuses where (dnc = 'Y' or not_interested = 'Y' or unworkable = 'Y') and (campaign_id ='".$_REQUEST['camp']."' or campaign_id in (select status_group_id from vicidial_status_groups));");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['BAD'][]=$row;

  }

 $rslt = mysqli_query($link,"select lower(status) as 'status' from vicidial_statuses where customer_contact = 'Y' union select lower(status) as 'status' from vicidial_campaign_statuses where customer_contact = 'Y' and (campaign_id ='".$_REQUEST['camp']."' or campaign_id in (select status_group_id from vicidial_status_groups));");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['CONTACT'][]=$row;

  }
  print json_encode($data);


}



if ($_REQUEST['query'] == 'pause_limit_active')
{

  $data = array();

  $rslt = mysqli_query($link,"select enable_pause_code_limits from system_settings;");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['enable_pause_code_limits']=$row['enable_pause_code_limits'];

  }  
print json_encode($data);
}



if ($_REQUEST['query'] == 'find_agent_custom1_data')
{

  $data = array();

  $rslt = mysqli_query($link,"select custom_one from vicidial_users where user = '".$_REQUEST['user']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['custom_one']=$row['custom_one'];

  }  
print json_encode($data);
}



if ($_REQUEST['query'] == 'upload_profile_image')
{
$new_url=get_tiny_url($_REQUEST['img']);

$new_url = substr_replace( $new_url, 's', 4, 0 ); 

  $data = array();
  $rslt = mysqli_query($link,"select custom_one from vicidial_users where user = '".$_REQUEST['user']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $cur = explode("-",$row['custom_one']);

  }  

  if ($cur[0]!='BTX')
  {
    $newcustomone = 'BTX-0-'.$new_url.'-N';

  }
  else
  {
    $newcustomone =  $cur[0].'-'.$cur[1].'-'.$new_url.'-N';
  }

 $rslt = mysqli_query($link,"update vicidial_users set custom_one = '".$newcustomone."' where user = '".$_REQUEST['user']."';");

 $data['test']="update vicidial_users set custom_one = '".$newcustomone."' where user = '".$_REQUEST['user']."';";

  $data['newcustomone'] =$newcustomone;

print json_encode($data);
}


if ($_REQUEST['query'] == 'get_sales_total')
{

  $data = array();

  $rslt = mysqli_query($link,"select count(distinct lead_id) as sales from vicidial_agent_log where event_time > date(now()) and user = '".$_REQUEST['user']."' and status in (select status from vicidial_statuses where sale = 'Y' union select status from vicidial_campaign_statuses where campaign_id ='".$_REQUEST['camp']."' and sale = 'Y');");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['sales']=$row['sales'];

  }  

print json_encode($data);
}

if ($_REQUEST['query'] == 'get_sales_total_SPH')
{
$data = array();

  $rslt = mysqli_query($link,"select count(distinct lead_id) as sales from vicidial_agent_log where event_time > date(now()) and user = '".$_REQUEST['user']."' and status in (select status from vicidial_statuses where sale = 'Y' union select status from vicidial_campaign_statuses where campaign_id ='".$_REQUEST['camp']."' and sale = 'Y');");
  while($row = mysqli_fetch_assoc($rslt))
  {
      $SALES=$row['sales'];

  }  


  $rslt = mysqli_query($link,"select (sum(talk_sec)+sum(wait_sec)+sum(pause_sec)+sum(dispo_sec)) as hours from vicidial_agent_log where event_time > date(now()) and user = '".$_REQUEST['user']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {
      $HOURS=$row['hours']/60/60;

  }  

$data['sales']=$SALES / $HOURS;

print json_encode($data);
}

if ($_REQUEST['query'] == 'get_sales_total_SPDH')
{
$data = array();

  $rslt = mysqli_query($link,"select count(distinct lead_id) as sales from vicidial_agent_log where event_time > date(now()) and user = '".$_REQUEST['user']."' and status in (select status from vicidial_statuses where sale = 'Y' union select status from vicidial_campaign_statuses where campaign_id ='".$_REQUEST['camp']."' and sale = 'Y');");
  while($row = mysqli_fetch_assoc($rslt))
  {
      $SALES=$row['sales'];

  }  


  $rslt = mysqli_query($link,"select (sum(talk_sec)+sum(wait_sec)+sum(dispo_sec)) as hours from vicidial_agent_log where event_time > date(now()) and user = '".$_REQUEST['user']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {
      $HOURS=$row['hours']/60/60;

  }  

$data['sales']=$SALES / $HOURS;

print json_encode($data);
}


if ($_REQUEST['query'] == 'find_pause_limit')
{

  $data = array();

  $rslt = mysqli_query($link,"select time_limit from vicidial_pause_codes where campaign_id = '".$_REQUEST['camp']."' and pause_code = '".$_REQUEST['pause']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['pause_time_limit']=$row['time_limit'];

  }  
print json_encode($data);
}




if ($_REQUEST['query'] == 'add_to_dispo')
{

  $data = array();

  $phone_number_dnc = $_REQUEST['phone_number_dnc'];
  $rslt = mysqli_query($link,"insert into vicidial_dnc values ('".$phone_number_dnc."');");

  $phone_number_dnc2 = $phone_number_dnc * 1;
  $rslt = mysqli_query($link,"insert into vicidial_dnc values ('".$phone_number_dnc2."');");  


  $rslt = mysqli_query($link,"insert into vicidial_dnc_log values ('".$phone_number_dnc2."','-SYSINT-','add',now(),'".$_REQUEST['user']."');");  

  $data = "success";
  print json_encode($data);


}




if ($_REQUEST['query'] == 'callbacks_set')
{

  $data = array();

  $rslt = mysqli_query($link,"select date_format(callback_time, '%H:%i') as t,count(*) as amount from vicidial_callbacks where callback_time = date_sub('".$_REQUEST['newcallbacktime'].":00', interval 10 minute) and user ='".$_REQUEST['user']."' and recipient ='USERONLY' and status != 'INACTIVE' group by t;");
  if (mysqli_num_rows ( $rslt ) > 0){
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[$row['t']]=$row['amount'];
  
  }
  }
  else
  {
    $data[date('H:i',strtotime('-10 minutes',strtotime($_REQUEST['newcallbacktime'])))] ='0';

  }

  $rslt = mysqli_query($link,"select date_format(callback_time, '%H:%i') as t, count(*) as amount from vicidial_callbacks where callback_time = date_sub('".$_REQUEST['newcallbacktime'].":00', interval 5 minute) and user ='".$_REQUEST['user']."' and recipient ='USERONLY' and status != 'INACTIVE' group by t;");
   if (mysqli_num_rows ( $rslt ) > 0){
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[$row['t']]=$row['amount'];
  
  }
  }
  else
  {
    $data[date('H:i',strtotime('-5 minutes',strtotime($_REQUEST['newcallbacktime'])))] ='0';

  }

    $rslt = mysqli_query($link,"select date_format(callback_time, '%H:%i') as t, count(*) as amount from vicidial_callbacks where callback_time = '".$_REQUEST['newcallbacktime'].":00' and user ='".$_REQUEST['user']."' and recipient ='USERONLY' and status != 'INACTIVE' group by t;");
  if (mysqli_num_rows ( $rslt ) > 0){
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[$row['t']]=$row['amount'];
  
  }
  }
  else
  {
    $data[date('H:i',strtotime($_REQUEST['newcallbacktime']))] ='0';

  }

    $rslt = mysqli_query($link,"select date_format(callback_time, '%H:%i') as t, count(*) as amount from vicidial_callbacks where callback_time = date_add('".$_REQUEST['newcallbacktime'].":00', interval 5 minute) and user ='".$_REQUEST['user']."' and recipient ='USERONLY' and status != 'INACTIVE' group by t;");
  if (mysqli_num_rows ( $rslt ) > 0){
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[$row['t']]=$row['amount'];
  
  }
  }
  else
  {
    $data[date('H:i',strtotime('+5 minutes',strtotime($_REQUEST['newcallbacktime'])))] ='0';

  }

    $rslt = mysqli_query($link,"select date_format(callback_time, '%H:%i') as t, count(*) as amount from vicidial_callbacks where callback_time = date_add('".$_REQUEST['newcallbacktime'].":00', interval 10 minute) and user ='".$_REQUEST['user']."' and recipient ='USERONLY' and status != 'INACTIVE' group by t;");
  if (mysqli_num_rows ( $rslt ) > 0){
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[$row['t']]=$row['amount'];
  
  }
  }
  else
  {
    $data[date('H:i',strtotime('+10 minutes',strtotime($_REQUEST['newcallbacktime'])))] ='0';

  }


  print json_encode($data);


}




if ($_REQUEST['query'] == 'find_all_data_stats')
{

  $data = array();


  $stmt2="select count(distinct lead_id) as salecount from vicidial_agent_log where user='".$_REQUEST['user']."' and campaign_id = '".$_REQUEST['camp']."' and event_time > date(now()) and status in (SELECT status FROM vicidial_campaign_statuses WHERE sale='Y' and campaign_id = '".$_REQUEST['camp']."' UNION SELECT status FROM vicidial_statuses WHERE sale='Y') ;";
  $rslt2=mysqli_query($link,$stmt2);
  $row2=mysqli_fetch_assoc($rslt2);
if ($row2['salecount']=='') {$row2['salecount']='0';}

$data['campsales']=$row2['salecount'];

$pos=0;
$count=1;
$prev=0;
$joint=0;


//get rank
 $stmt3="select count(distinct lead_id) as totalsalecount from vicidial_agent_log where status in (SELECT status FROM vicidial_campaign_statuses WHERE sale='Y' and campaign_id = '".$_REQUEST['camp']."' UNION SELECT status FROM vicidial_statuses WHERE sale='Y') and campaign_id = '".$_REQUEST['camp']."' and event_time > date(now()) group by user order by totalsalecount desc;";
  $rslt3=mysqli_query($link,$stmt3);
 while ($row3 = mysqli_fetch_assoc($rslt3)) {

if ($row3['totalsalecount']<>$prev) { $pos++; $prev=$row3['totalsalecount'];}

if ($row3['totalsalecount']==$row2['salecount']) {$agentrank=$pos; $joint++;}   

}

$arank = ordinal($agentrank);

if($joint>1) {$jlabel = 'Joint ';}

$camprank = $jlabel."".$arank;
if ($row2['salecount']==0){$camprank='N/A';}
 $data['camprank']=$camprank;

 $stmt="select sum(talk_sec)-sum(dead_sec) as talk,  sum(wait_sec) as wait, sum(pause_sec) as pause, sum(dispo_sec)+sum(dead_sec) as wrap from vicidial_agent_log where user='".$_REQUEST['user']."' and event_time > date(now());";
  $rslt=mysqli_query($link,$stmt);
  $row=mysqli_fetch_assoc($rslt);
 $avail=$row['talk'] + $row['wait'];
  $data['avail']=gmdate("H:i:s", (int)$avail);
  $data['notavail']= gmdate("H:i:s", (int)$row[pause]);
  $data['wrap']= gmdate("H:i:s", (int)$row[wrap]);
  
print json_encode($data);
}




if ($_REQUEST['query'] == 'build_agent_stats_table')
{

  $data = array();

$stmt="SELECT agent_status_viewable_groups from vicidial_user_groups join vicidial_users using (user_group) where user='".$_REQUEST['user']."';";
  $rslt=mysqli_query($link,$stmt);
  $row=mysqli_fetch_row($rslt);
  $agent_status_viewable_groups = $row[0];
  $agent_status_viewable_groupsSQL = preg_replace('/\s\s/i','',$agent_status_viewable_groups);
  $agent_status_viewable_groupsSQL = preg_replace('/\s/i',"','",$agent_status_viewable_groupsSQL);
  $agent_status_viewable_groupsSQL = "vicidial_agent_log.user_group IN('$agent_status_viewable_groupsSQL')";
    if (preg_match("/ALL-GROUPS/",$agent_status_viewable_groups))
    {$AGENTviewSQL = "";}
  else
    {
    $AGENTviewSQL = "($agent_status_viewable_groupsSQL)";

    if (preg_match("/CAMPAIGN-AGENTS/",$agent_status_viewable_groups))
      {$AGENTviewSQL = "";}
    $AGENTviewSQL = "and $AGENTviewSQL";
    }




  $rslt = mysqli_query($link,"select user, left(full_name,15) as name, ifnull(count(distinct lead_id),'0') as sales from vicidial_agent_log join vicidial_users using (user) where status in (SELECT status FROM vicidial_campaign_statuses WHERE sale='Y' and campaign_id = '".$_REQUEST['camp']."' UNION SELECT status FROM vicidial_statuses WHERE sale='Y') and campaign_id = '".$_REQUEST['camp']."' ".$AGENTviewSQL." and event_time > date(now()) group by user order by sales desc;");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[] = $row;

  }  

print json_encode($data);
}




if ($_REQUEST['query'] == 'add_wrap_and_talk_to_agent_stats_table')
{

  $data = array();

$stmt="SELECT agent_status_viewable_groups from vicidial_user_groups join vicidial_users using (user_group) where user='".$_REQUEST['user']."';";
  $rslt=mysqli_query($link,$stmt);
  $row=mysqli_fetch_row($rslt);
  $agent_status_viewable_groups = $row[0];
  $agent_status_viewable_groupsSQL = preg_replace('/\s\s/i','',$agent_status_viewable_groups);
  $agent_status_viewable_groupsSQL = preg_replace('/\s/i',"','",$agent_status_viewable_groupsSQL);
  $agent_status_viewable_groupsSQL = "vicidial_agent_log.user_group IN('$agent_status_viewable_groupsSQL')";
    if (preg_match("/ALL-GROUPS/",$agent_status_viewable_groups))
    {$AGENTviewSQL = "";}
  else
    {
    $AGENTviewSQL = "($agent_status_viewable_groupsSQL)";

    if (preg_match("/CAMPAIGN-AGENTS/",$agent_status_viewable_groups))
      {$AGENTviewSQL = "";}
    $AGENTviewSQL = "and $AGENTviewSQL";
    }


  $rslt = mysqli_query($link,"select user, left(full_name,15) as name,sum(talk_sec) as talk,  sum(dispo_sec) as dispo, SUM(CASE WHEN dispo_sec > 0 then 1 else 0 end) as countofdispo,  SUM(CASE WHEN talk_sec > 0 then 1 else 0 end) as countoftalk from vicidial_agent_log join vicidial_users using (user) where campaign_id = '".$_REQUEST['camp']."' ".$AGENTviewSQL." and event_time > date(now()) group by user;");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[] = $row;

  }  
  

print json_encode($data);
}


if ($_REQUEST['query'] == 'get_pause_breakdown')
{

  $data = array();


  $rslt = mysqli_query($link,"select sub_status, SEC_TO_TIME(sum(pause_sec)) as sec from vicidial_agent_log where user = '".$_REQUEST['user']."' and sub_status not in ('NULL','LAGGED') and event_time > date(now()) group by sub_status order by sec desc limit 6;");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[] = $row;

  }  
  

print json_encode($data);
}



if ($_REQUEST['query'] == 'get_agents_manager')
{

  $data = array();

  $rslt = mysqli_query($link,"select user,full_name, custom_one from vicidial_users where active ='Y' and user_level < '9';");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data[] = $row;

  }  
print json_encode($data);
}




if ($_REQUEST['query'] == 'manager_update_agent')
{
  $data = array();
  $rslt = mysqli_query($link,"select custom_one from vicidial_users where user = '".$_REQUEST['user']."'");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $cur = explode("-",$row['custom_one']);

  }  

if ($_REQUEST['what']=='approve')
{
$newcustomone =  'BTX-'.$cur[1].'-'.$cur[2].'-Y';
$rslt = mysqli_query($link,"update vicidial_users set custom_one = '".$newcustomone."' where user = '".$_REQUEST['user']."';");
}

if ($_REQUEST['what']=='remove')
{
$newcustomone =  'BTX-'.$cur[1].'- - ';
$rslt = mysqli_query($link,"update vicidial_users set custom_one = '".$newcustomone."' where user = '".$_REQUEST['user']."';");
}

if ($_REQUEST['what']=='target')
{
$newcustomone =  'BTX-'.$_REQUEST['newtarget'].'-'.$cur[2].'-'.$cur[3];
$rslt = mysqli_query($link,"update vicidial_users set custom_one = '".$newcustomone."' where user = '".$_REQUEST['user']."';");
}



print json_encode($data);
}


mysqli_close($link); 

?>

