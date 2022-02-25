<?php


require("../../dbconnect_mysqli.php");


if ($_REQUEST['action'] == 'version_control')
{

$linkx = mysqli_connect("127.0.0.1", "root", "", "asterisk"); // Force Create table
       

$tablecreate="CREATE TABLE IF NOT EXISTS btx_agent_version (version varchar(15) NOT NULL, first_use datetime, PRIMARY KEY (version));";
$docreatetable=mysqli_query($linkx,$tablecreate);

$rslt = mysqli_query($link,"insert ignore into btx_agent_version (version,first_use) values ('".$_REQUEST['version']."', now());");   


}


if ($_REQUEST['query'] == 'get_phone_from_user')
{

  $data = array();

  $rslt = mysqli_query($link,"select phone_login from vicidial_users where user = '".$_REQUEST['user']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {

    $data['phone_login']=$row['phone_login'];

    $rslt2 = mysqli_query($link,"select pass from phones where login = '".$row['phone_login']."';");
    while($row2 = mysqli_fetch_assoc($rslt2))
    {
      $data['phone_pass']=$row2['pass'];
    }
  
  }

print json_encode($data);
}


if ($_REQUEST['query'] == 'get_all_phones')
{

  $data = array();

  $rslt = mysqli_query($link,"select login from phones where active = 'Y' and login not in ('callin','gs102','gs102a','gs103','gs103a') and  concat('SIP/',extension) not in (select extension from vicidial_live_agents) and is_webphone='N';");
  while($row = mysqli_fetch_assoc($rslt))
  {

    $data[] = $row;
  
  }
    
print json_encode($data);
}



if ($_REQUEST['query'] == 'update_phone_pass')
{

  $data = array();

  $rslt = mysqli_query($link,"select pass from phones where active = 'Y' and login = '".$_REQUEST['phone']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {

    $data['phone_pass']=$row['pass'];
  
  }
    
print json_encode($data);
}



if ($_REQUEST['query'] == 'login_attempt')
{

  $data = array();

  $error = '';
  $alias = '';
  $rsltalias = mysqli_query($link,"select logins_list from phones_alias where alias_id = '".$_REQUEST['phone']."';");
  if (mysqli_num_rows($rsltalias)==0)
  {
    $rslt = mysqli_query($link,"select * from phones where active = 'Y' and login = '".$_REQUEST['phone']."' and pass= '".$_REQUEST['phone_pass']."';");
    if (mysqli_num_rows($rslt)==0)
    {
      $error .= 'Phone is not Active in the System';
    }
  }
  else
  {
    while ($row = mysqli_fetch_assoc($rsltalias))
    {
      $alias .= "'";
      $alias .= $row['logins_list'];
      $alias .= "',";

    }

    $alias = rtrim($alias,',');

     $rslt = mysqli_query($link,"select * from phones where active = 'Y' and login in (".$alias.") and pass= '".$_REQUEST['phone_pass']."';");
     if (mysqli_num_rows($rslt)==0)
     {
       $error .= 'Phone is not Active in the System';
     }
  

  }

  $rslt = mysqli_query($link,"select * from vicidial_users where active = 'Y' and user = '".$_REQUEST['user']."' and pass= '".$_REQUEST['user_pass']."';");
  if (mysqli_num_rows($rslt)==0)
  {
   if ($error != ''){$spacer=' and ';}
   $error .= $spacer.'User Account Authenication Error';
  }

  $rslt = mysqli_query($link,"select user from vicidial_users where active = 'Y' and user = '".$_REQUEST['user']."' and pass= '".$_REQUEST['user_pass']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $data['usercase'] = $row['user'];  
  } 

  $rslt = mysqli_query($link,"select allow_closers, dial_method, no_hopper_leads_logins from vicidial_campaigns where campaign_id = '".$_REQUEST['campaign']."';");
  while($row = mysqli_fetch_assoc($rslt))
  {

    $campaign_allow_inbound = $row['allow_closers'];
    $dial_method= $row['dial_method'];
    $no_hopper_leads_logins = $row['no_hopper_leads_logins'];
  
  }

  $rslt = mysqli_query($link,"SELECT count(*) as amount FROM vicidial_hopper where campaign_id = '".$_REQUEST['campaign']."' and status='READY';");
  while($row = mysqli_fetch_assoc($rslt))
  {
    $campaign_leads_to_call = $row['amount'];  
  } 
if ( ( ($campaign_allow_inbound == 'Y') and ($dial_method != 'MANUAL') ) || ($campaign_leads_to_call > 0) || (preg_match('/Y/',$no_hopper_leads_logins)) )
{}
else
{
  if ($error != ''){$spacer=' and ';}
  $error .= $spacer.'No Leads to be Dialled in this Campaign';
}

$data['error'] = $error;

print json_encode($data);
}


?>