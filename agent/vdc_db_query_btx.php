<?php 

$php_script = 'vdc_db_query.php';
$mel=1;					# Mysql Error Log enabled = 1
$mysql_log_count=787;
$one_mysql_log=0;
$DB=0;
$VD_login=0;
$SSagent_debug_logging=0;
$pause_to_code_jump=0;
$startMS = microtime();
$StarTtime = date("U");
$US='_';
$i = 0;

require_once("dbconnect_mysqli.php");
require_once("functions.php");

### If you have globals turned off uncomment these lines
if (isset($_GET["user"]))						{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))				{$user=$_POST["user"];}
if (isset($_GET["pass"]))						{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))				{$pass=$_POST["pass"];}
if (isset($_GET["server_ip"]))					{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))			{$server_ip=$_POST["server_ip"];}
if (isset($_GET["session_name"]))				{$session_name=$_GET["session_name"];}
	elseif (isset($_POST["session_name"]))		{$session_name=$_POST["session_name"];}
if (isset($_GET["format"]))						{$format=$_GET["format"];}
	elseif (isset($_POST["format"]))			{$format=$_POST["format"];}
if (isset($_GET["ACTION"]))						{$ACTION=$_GET["ACTION"];}
	elseif (isset($_POST["ACTION"]))			{$ACTION=$_POST["ACTION"];}
if (isset($_GET["stage"]))						{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))				{$stage=$_POST["stage"];}
if (isset($_GET["closer_choice"]))				{$closer_choice=$_GET["closer_choice"];}
	elseif (isset($_POST["closer_choice"]))		{$closer_choice=$_POST["closer_choice"];}
if (isset($_GET["conf_exten"]))					{$conf_exten=$_GET["conf_exten"];}
	elseif (isset($_POST["conf_exten"]))		{$conf_exten=$_POST["conf_exten"];}
if (isset($_GET["exten"]))						{$exten=$_GET["exten"];}
	elseif (isset($_POST["exten"]))				{$exten=$_POST["exten"];}
if (isset($_GET["ext_context"]))				{$ext_context=$_GET["ext_context"];}
	elseif (isset($_POST["ext_context"]))		{$ext_context=$_POST["ext_context"];}
if (isset($_GET["ext_priority"]))				{$ext_priority=$_GET["ext_priority"];}
	elseif (isset($_POST["ext_priority"]))		{$ext_priority=$_POST["ext_priority"];}
if (isset($_GET["campaign"]))					{$campaign=$_GET["campaign"];}
	elseif (isset($_POST["campaign"]))			{$campaign=$_POST["campaign"];}
if (isset($_GET["dial_timeout"]))				{$dial_timeout=$_GET["dial_timeout"];}
	elseif (isset($_POST["dial_timeout"]))		{$dial_timeout=$_POST["dial_timeout"];}
if (isset($_GET["dial_prefix"]))				{$dial_prefix=$_GET["dial_prefix"];}
	elseif (isset($_POST["dial_prefix"]))		{$dial_prefix=$_POST["dial_prefix"];}
if (isset($_GET["campaign_cid"]))				{$campaign_cid=$_GET["campaign_cid"];}
	elseif (isset($_POST["campaign_cid"]))		{$campaign_cid=$_POST["campaign_cid"];}
if (isset($_GET["MDnextCID"]))					{$MDnextCID=$_GET["MDnextCID"];}
	elseif (isset($_POST["MDnextCID"]))			{$MDnextCID=$_POST["MDnextCID"];}
if (isset($_GET["uniqueid"]))					{$uniqueid=$_GET["uniqueid"];}
	elseif (isset($_POST["uniqueid"]))			{$uniqueid=$_POST["uniqueid"];}
if (isset($_GET["lead_id"]))					{$lead_id=$_GET["lead_id"];}
	elseif (isset($_POST["lead_id"]))			{$lead_id=$_POST["lead_id"];}
if (isset($_GET["list_id"]))					{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))			{$list_id=$_POST["list_id"];}
if (isset($_GET["length_in_sec"]))				{$length_in_sec=$_GET["length_in_sec"];}
	elseif (isset($_POST["length_in_sec"]))		{$length_in_sec=$_POST["length_in_sec"];}
if (isset($_GET["phone_code"]))					{$phone_code=$_GET["phone_code"];}
	elseif (isset($_POST["phone_code"]))		{$phone_code=$_POST["phone_code"];}
if (isset($_GET["phone_number"]))				{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))		{$phone_number=$_POST["phone_number"];}
if (isset($_GET["channel"]))					{$channel=$_GET["channel"];}
	elseif (isset($_POST["channel"]))			{$channel=$_POST["channel"];}
if (isset($_GET["start_epoch"]))				{$start_epoch=$_GET["start_epoch"];}
	elseif (isset($_POST["start_epoch"]))		{$start_epoch=$_POST["start_epoch"];}
if (isset($_GET["dispo_choice"]))				{$dispo_choice=$_GET["dispo_choice"];}
	elseif (isset($_POST["dispo_choice"]))		{$dispo_choice=$_POST["dispo_choice"];}
if (isset($_GET["vendor_lead_code"]))			{$vendor_lead_code=$_GET["vendor_lead_code"];}
	elseif (isset($_POST["vendor_lead_code"]))	{$vendor_lead_code=$_POST["vendor_lead_code"];}
if (isset($_GET["title"]))						{$title=$_GET["title"];}
	elseif (isset($_POST["title"]))				{$title=$_POST["title"];}
if (isset($_GET["first_name"]))					{$first_name=$_GET["first_name"];}
	elseif (isset($_POST["first_name"]))		{$first_name=$_POST["first_name"];}
if (isset($_GET["middle_initial"]))				{$middle_initial=$_GET["middle_initial"];}
	elseif (isset($_POST["middle_initial"]))	{$middle_initial=$_POST["middle_initial"];}
if (isset($_GET["last_name"]))					{$last_name=$_GET["last_name"];}
	elseif (isset($_POST["last_name"]))			{$last_name=$_POST["last_name"];}
if (isset($_GET["address1"]))					{$address1=$_GET["address1"];}
	elseif (isset($_POST["address1"]))			{$address1=$_POST["address1"];}
if (isset($_GET["address2"]))					{$address2=$_GET["address2"];}
	elseif (isset($_POST["address2"]))			{$address2=$_POST["address2"];}
if (isset($_GET["address3"]))					{$address3=$_GET["address3"];}
	elseif (isset($_POST["address3"]))			{$address3=$_POST["address3"];}
if (isset($_GET["city"]))						{$city=$_GET["city"];}
	elseif (isset($_POST["city"]))				{$city=$_POST["city"];}
if (isset($_GET["state"]))						{$state=$_GET["state"];}
	elseif (isset($_POST["state"]))				{$state=$_POST["state"];}
if (isset($_GET["province"]))					{$province=$_GET["province"];}
	elseif (isset($_POST["province"]))			{$province=$_POST["province"];}
if (isset($_GET["postal_code"]))				{$postal_code=$_GET["postal_code"];}
	elseif (isset($_POST["postal_code"]))		{$postal_code=$_POST["postal_code"];}
if (isset($_GET["country_code"]))				{$country_code=$_GET["country_code"];}
	elseif (isset($_POST["country_code"]))		{$country_code=$_POST["country_code"];}
if (isset($_GET["gender"]))						{$gender=$_GET["gender"];}
	elseif (isset($_POST["gender"]))			{$gender=$_POST["gender"];}
if (isset($_GET["date_of_birth"]))				{$date_of_birth=$_GET["date_of_birth"];}
	elseif (isset($_POST["date_of_birth"]))		{$date_of_birth=$_POST["date_of_birth"];}
if (isset($_GET["alt_phone"]))					{$alt_phone=$_GET["alt_phone"];}
	elseif (isset($_POST["alt_phone"]))			{$alt_phone=$_POST["alt_phone"];}
if (isset($_GET["email"]))						{$email=$_GET["email"];}
	elseif (isset($_POST["email"]))				{$email=$_POST["email"];}
if (isset($_GET["security_phrase"]))			{$security_phrase=$_GET["security_phrase"];}
	elseif (isset($_POST["security_phrase"]))	{$security_phrase=$_POST["security_phrase"];}
if (isset($_GET["comments"]))					{$comments=$_GET["comments"];}
	elseif (isset($_POST["comments"]))			{$comments=$_POST["comments"];}
if (isset($_GET["auto_dial_level"]))			{$auto_dial_level=$_GET["auto_dial_level"];}
	elseif (isset($_POST["auto_dial_level"]))	{$auto_dial_level=$_POST["auto_dial_level"];}
if (isset($_GET["VDstop_rec_after_each_call"]))				{$VDstop_rec_after_each_call=$_GET["VDstop_rec_after_each_call"];}
	elseif (isset($_POST["VDstop_rec_after_each_call"]))		{$VDstop_rec_after_each_call=$_POST["VDstop_rec_after_each_call"];}
if (isset($_GET["conf_silent_prefix"]))				{$conf_silent_prefix=$_GET["conf_silent_prefix"];}
	elseif (isset($_POST["conf_silent_prefix"]))	{$conf_silent_prefix=$_POST["conf_silent_prefix"];}
if (isset($_GET["extension"]))					{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))			{$extension=$_POST["extension"];}
if (isset($_GET["protocol"]))					{$protocol=$_GET["protocol"];}
	elseif (isset($_POST["protocol"]))			{$protocol=$_POST["protocol"];}
if (isset($_GET["user_abb"]))					{$user_abb=$_GET["user_abb"];}
	elseif (isset($_POST["user_abb"]))			{$user_abb=$_POST["user_abb"];}
if (isset($_GET["preview"]))					{$preview=$_GET["preview"];}
	elseif (isset($_POST["preview"]))			{$preview=$_POST["preview"];}
if (isset($_GET["called_count"]))				{$called_count=$_GET["called_count"];}
	elseif (isset($_POST["called_count"]))		{$called_count=$_POST["called_count"];}
if (isset($_GET["agent_log_id"]))				{$agent_log_id=$_GET["agent_log_id"];}
	elseif (isset($_POST["agent_log_id"]))		{$agent_log_id=$_POST["agent_log_id"];}
if (isset($_GET["agent_log"]))					{$agent_log=$_GET["agent_log"];}
	elseif (isset($_POST["agent_log"]))			{$agent_log=$_POST["agent_log"];}
if (isset($_GET["favorites_list"]))				{$favorites_list=$_GET["favorites_list"];}
	elseif (isset($_POST["favorites_list"]))	{$favorites_list=$_POST["favorites_list"];}
if (isset($_GET["CallBackDatETimE"]))			{$CallBackDatETimE=$_GET["CallBackDatETimE"];}
	elseif (isset($_POST["CallBackDatETimE"]))	{$CallBackDatETimE=$_POST["CallBackDatETimE"];}
if (isset($_GET["recipient"]))					{$recipient=$_GET["recipient"];}
	elseif (isset($_POST["recipient"]))			{$recipient=$_POST["recipient"];}
if (isset($_GET["callback_id"]))				{$callback_id=$_GET["callback_id"];}
	elseif (isset($_POST["callback_id"]))		{$callback_id=$_POST["callback_id"];}
if (isset($_GET["callback_date"]))				{$callback_date=$_GET["callback_date"];}
	elseif (isset($_POST["callback_date"]))		{$callback_date=$_POST["callback_date"];}
if (isset($_GET["recipient"]))				{$recipient=$_GET["recipient"];}
	elseif (isset($_POST["recipient"]))		{$recipient=$_POST["recipient"];}
if (isset($_GET["use_internal_dnc"]))			{$use_internal_dnc=$_GET["use_internal_dnc"];}
	elseif (isset($_POST["use_internal_dnc"]))	{$use_internal_dnc=$_POST["use_internal_dnc"];}
if (isset($_GET["use_campaign_dnc"]))			{$use_campaign_dnc=$_GET["use_campaign_dnc"];}
	elseif (isset($_POST["use_campaign_dnc"]))	{$use_campaign_dnc=$_POST["use_campaign_dnc"];}
if (isset($_GET["omit_phone_code"]))			{$omit_phone_code=$_GET["omit_phone_code"];}
	elseif (isset($_POST["omit_phone_code"]))	{$omit_phone_code=$_POST["omit_phone_code"];}
if (isset($_GET["phone_ip"]))				{$phone_ip=$_GET["phone_ip"];}
	elseif (isset($_POST["phone_ip"]))		{$phone_ip=$_POST["phone_ip"];}
if (isset($_GET["enable_sipsak_messages"]))				{$enable_sipsak_messages=$_GET["enable_sipsak_messages"];}
	elseif (isset($_POST["enable_sipsak_messages"]))	{$enable_sipsak_messages=$_POST["enable_sipsak_messages"];}
if (isset($_GET["status"]))						{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))			{$status=$_POST["status"];}
if (isset($_GET["LogouTKicKAlL"]))				{$LogouTKicKAlL=$_GET["LogouTKicKAlL"];}
	elseif (isset($_POST["LogouTKicKAlL"]))		{$LogouTKicKAlL=$_POST["LogouTKicKAlL"];}
if (isset($_GET["closer_blended"]))				{$closer_blended=$_GET["closer_blended"];}
	elseif (isset($_POST["closer_blended"]))	{$closer_blended=$_POST["closer_blended"];}
if (isset($_GET["inOUT"]))						{$inOUT=$_GET["inOUT"];}
	elseif (isset($_POST["inOUT"]))				{$inOUT=$_POST["inOUT"];}
if (isset($_GET["manual_dial_filter"]))				{$manual_dial_filter=$_GET["manual_dial_filter"];}
	elseif (isset($_POST["manual_dial_filter"]))	{$manual_dial_filter=$_POST["manual_dial_filter"];}
if (isset($_GET["alt_dial"]))					{$alt_dial=$_GET["alt_dial"];}
	elseif (isset($_POST["alt_dial"]))			{$alt_dial=$_POST["alt_dial"];}
if (isset($_GET["agentchannel"]))				{$agentchannel=$_GET["agentchannel"];}
	elseif (isset($_POST["agentchannel"]))		{$agentchannel=$_POST["agentchannel"];}
if (isset($_GET["conf_dialed"]))				{$conf_dialed=$_GET["conf_dialed"];}
	elseif (isset($_POST["conf_dialed"]))		{$conf_dialed=$_POST["conf_dialed"];}
if (isset($_GET["leaving_threeway"]))			{$leaving_threeway=$_GET["leaving_threeway"];}
	elseif (isset($_POST["leaving_threeway"]))	{$leaving_threeway=$_POST["leaving_threeway"];}
if (isset($_GET["hangup_all_non_reserved"]))			{$hangup_all_non_reserved=$_GET["hangup_all_non_reserved"];}
	elseif (isset($_POST["hangup_all_non_reserved"]))	{$hangup_all_non_reserved=$_POST["hangup_all_non_reserved"];}
if (isset($_GET["blind_transfer"]))				{$blind_transfer=$_GET["blind_transfer"];}
	elseif (isset($_POST["blind_transfer"]))	{$blind_transfer=$_POST["blind_transfer"];}
if (isset($_GET["usegroupalias"]))			{$usegroupalias=$_GET["usegroupalias"];}
	elseif (isset($_POST["usegroupalias"]))	{$usegroupalias=$_POST["usegroupalias"];}
if (isset($_GET["account"]))				{$account=$_GET["account"];}
	elseif (isset($_POST["account"]))		{$account=$_POST["account"];}
if (isset($_GET["agent_dialed_number"]))			{$agent_dialed_number=$_GET["agent_dialed_number"];}
	elseif (isset($_POST["agent_dialed_number"]))	{$agent_dialed_number=$_POST["agent_dialed_number"];}
if (isset($_GET["agent_dialed_type"]))				{$agent_dialed_type=$_GET["agent_dialed_type"];}
	elseif (isset($_POST["agent_dialed_type"]))		{$agent_dialed_type=$_POST["agent_dialed_type"];}
if (isset($_GET["wrapup"]))					{$wrapup=$_GET["wrapup"];}
	elseif (isset($_POST["wrapup"]))		{$wrapup=$_POST["wrapup"];}
if (isset($_GET["vtiger_callback_id"]))				{$vtiger_callback_id=$_GET["vtiger_callback_id"];}
	elseif (isset($_POST["vtiger_callback_id"]))	{$vtiger_callback_id=$_POST["vtiger_callback_id"];}
if (isset($_GET["dial_method"]))				{$dial_method=$_GET["dial_method"];}
	elseif (isset($_POST["dial_method"]))		{$dial_method=$_POST["dial_method"];}
if (isset($_GET["no_delete_sessions"]))				{$no_delete_sessions=$_GET["no_delete_sessions"];}
	elseif (isset($_POST["no_delete_sessions"]))	{$no_delete_sessions=$_POST["no_delete_sessions"];}
if (isset($_GET["nodeletevdac"]))				{$nodeletevdac=$_GET["nodeletevdac"];}
	elseif (isset($_POST["nodeletevdac"]))		{$nodeletevdac=$_POST["nodeletevdac"];}
if (isset($_GET["agent_territories"]))			{$agent_territories=$_GET["agent_territories"];}
	elseif (isset($_POST["agent_territories"]))	{$agent_territories=$_POST["agent_territories"];}
if (isset($_GET["alt_num_status"]))				{$alt_num_status=$_GET["alt_num_status"];}
	elseif (isset($_POST["alt_num_status"]))	{$alt_num_status=$_POST["alt_num_status"];}
if (isset($_GET["DiaL_SecondS"]))				{$DiaL_SecondS=$_GET["DiaL_SecondS"];}
	elseif (isset($_POST["DiaL_SecondS"]))		{$DiaL_SecondS=$_POST["DiaL_SecondS"];}
if (isset($_GET["date"]))						{$date=$_GET["date"];}
	elseif (isset($_POST["date"]))				{$date=$_POST["date"];}
if (isset($_GET["custom_field_names"]))				{$FORMcustom_field_names=$_GET["custom_field_names"];}
	elseif (isset($_POST["custom_field_names"]))	{$FORMcustom_field_names=$_POST["custom_field_names"];}
if (isset($_GET["qm_phone"]))			{$qm_phone=$_GET["qm_phone"];}
	elseif (isset($_POST["qm_phone"]))	{$qm_phone=$_POST["qm_phone"];}
if (isset($_GET["manual_dial_call_time_check"]))			{$manual_dial_call_time_check=$_GET["manual_dial_call_time_check"];}
	elseif (isset($_POST["manual_dial_call_time_check"]))	{$manual_dial_call_time_check=$_POST["manual_dial_call_time_check"];}
if (isset($_GET["CallBackLeadStatus"]))				{$CallBackLeadStatus=$_GET["CallBackLeadStatus"];}
	elseif (isset($_POST["CallBackLeadStatus"]))	{$CallBackLeadStatus=$_POST["CallBackLeadStatus"];}
if (isset($_GET["call_notes"]))				{$call_notes=$_GET["call_notes"];}
	elseif (isset($_POST["call_notes"]))	{$call_notes=$_POST["call_notes"];}
if (isset($_GET["search"]))				{$search=$_GET["search"];}
	elseif (isset($_POST["search"]))	{$search=$_POST["search"];}
if (isset($_GET["sub_status"]))				{$sub_status=$_GET["sub_status"];}
	elseif (isset($_POST["sub_status"]))	{$sub_status=$_POST["sub_status"];}
if (isset($_GET["qm_extension"]))			{$qm_extension=$_GET["qm_extension"];}
	elseif (isset($_POST["qm_extension"]))	{$qm_extension=$_POST["qm_extension"];}
if (isset($_GET["disable_alter_custphone"]))			{$disable_alter_custphone=$_GET["disable_alter_custphone"];}
	elseif (isset($_POST["disable_alter_custphone"]))	{$disable_alter_custphone=$_POST["disable_alter_custphone"];}
if (isset($_GET["bu_name"]))			{$bu_name=$_GET["bu_name"];}
	elseif (isset($_POST["bu_name"]))	{$bu_name=$_POST["bu_name"];}
if (isset($_GET["department"]))				{$department=$_GET["department"];}
	elseif (isset($_POST["department"]))	{$department=$_POST["department"];}
if (isset($_GET["group_name"]))				{$group_name=$_GET["group_name"];}
	elseif (isset($_POST["group_name"]))	{$group_name=$_POST["group_name"];}
if (isset($_GET["job_title"]))			{$job_title=$_GET["job_title"];}
	elseif (isset($_POST["job_title"]))	{$job_title=$_POST["job_title"];}
if (isset($_GET["location"]))			{$location=$_GET["location"];}
	elseif (isset($_POST["location"]))	{$location=$_POST["location"];}
if (isset($_GET["old_CID"]))			{$old_CID=$_GET["old_CID"];}
	elseif (isset($_POST["old_CID"]))	{$old_CID=$_POST["old_CID"];}
if (isset($_GET["qm_dispo_code"]))			{$qm_dispo_code=$_GET["qm_dispo_code"];}
	elseif (isset($_POST["qm_dispo_code"]))	{$qm_dispo_code=$_POST["qm_dispo_code"];}
if (isset($_GET["dial_ingroup"]))			{$dial_ingroup=$_GET["dial_ingroup"];}
	elseif (isset($_POST["dial_ingroup"]))	{$dial_ingroup=$_POST["dial_ingroup"];}
if (isset($_GET["nocall_dial_flag"]))			{$nocall_dial_flag=$_GET["nocall_dial_flag"];}
	elseif (isset($_POST["nocall_dial_flag"]))	{$nocall_dial_flag=$_POST["nocall_dial_flag"];}
if (isset($_GET["inbound_lead_search"]))			{$inbound_lead_search=$_GET["inbound_lead_search"];}
	elseif (isset($_POST["inbound_lead_search"]))	{$inbound_lead_search=$_POST["inbound_lead_search"];}
if (isset($_GET["email_enabled"]))			{$email_enabled=$_GET["email_enabled"];}
	elseif (isset($_POST["email_enabled"]))	{$email_enabled=$_POST["email_enabled"];}
if (isset($_GET["email_row_id"]))			{$email_row_id=$_GET["email_row_id"];}
	elseif (isset($_POST["email_row_id"]))	{$email_row_id=$_POST["email_row_id"];}
if (isset($_GET["inbound_email_groups"]))			{$inbound_email_groups=$_GET["inbound_email_groups"];}
	elseif (isset($_POST["inbound_email_groups"]))	{$inbound_email_groups=$_POST["inbound_email_groups"];}
if (isset($_GET["inbound_chat_groups"]))			{$inbound_chat_groups=$_GET["inbound_chat_groups"];}
	elseif (isset($_POST["inbound_chat_groups"]))	{$inbound_chat_groups=$_POST["inbound_chat_groups"];}
if (isset($_GET["recording_id"]))			{$recording_id=$_GET["recording_id"];}
	elseif (isset($_POST["recording_id"]))	{$recording_id=$_POST["recording_id"];}
if (isset($_GET["recording_filename"]))				{$recording_filename=$_GET["recording_filename"];}
	elseif (isset($_POST["recording_filename"]))	{$recording_filename=$_POST["recording_filename"];}
if (isset($_GET["orig_pass"]))			{$orig_pass=$_GET["orig_pass"];}
	elseif (isset($_POST["orig_pass"]))	{$orig_pass=$_POST["orig_pass"];}
if (isset($_GET["cid_lock"]))			{$cid_lock=$_GET["cid_lock"];}
	elseif (isset($_POST["cid_lock"]))	{$cid_lock=$_POST["cid_lock"];}
if (isset($_GET["dispo_comments"]))				{$dispo_comments=$_GET["dispo_comments"];}
	elseif (isset($_POST["dispo_comments"]))	{$dispo_comments=$_POST["dispo_comments"];}
if (isset($_GET["cbcomment_comments"]))				{$cbcomment_comments=$_GET["cbcomment_comments"];}
	elseif (isset($_POST["cbcomment_comments"]))	{$cbcomment_comments=$_POST["cbcomment_comments"];}
if (isset($_GET["parked_hangup"]))			{$parked_hangup=$_GET["parked_hangup"];}
	elseif (isset($_POST["parked_hangup"]))	{$parked_hangup=$_POST["parked_hangup"];}
if (isset($_GET["pause_trigger"]))			{$pause_trigger=$_GET["pause_trigger"];}
	elseif (isset($_POST["pause_trigger"]))	{$pause_trigger=$_POST["pause_trigger"];}
if (isset($_GET["DB"]))					{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["in_script"]))			{$in_script=$_GET["in_script"];}
	elseif (isset($_POST["in_script"]))	{$in_script=$_POST["in_script"];}
if (isset($_GET["camp_script"]))			{$camp_script=$_GET["camp_script"];}
	elseif (isset($_POST["camp_script"]))	{$camp_script=$_POST["camp_script"];}
if (isset($_GET["manual_dial_search_filter"]))			{$manual_dial_search_filter=$_GET["manual_dial_search_filter"];}
	elseif (isset($_POST["manual_dial_search_filter"]))	{$manual_dial_search_filter=$_POST["manual_dial_search_filter"];}
if (isset($_GET["url_ids"]))			{$url_ids=$_GET["url_ids"];}
	elseif (isset($_POST["url_ids"]))	{$url_ids=$_POST["url_ids"];}
if (isset($_GET["phone_login"]))			{$phone_login=$_GET["phone_login"];}
	elseif (isset($_POST["phone_login"]))	{$phone_login=$_POST["phone_login"];}
if (isset($_GET["agent_email"]))	{$agent_email=$_GET["agent_email"];}
	elseif (isset($_POST["agent_email"]))	{$agent_email=$_POST["agent_email"];}
if (isset($_GET["original_phone_login"]))	{$original_phone_login=$_GET["original_phone_login"];}
	elseif (isset($_POST["original_phone_login"]))	{$original_phone_login=$_POST["original_phone_login"];}
if (isset($_GET["customer_zap_channel"]))	{$customer_zap_channel=$_GET["customer_zap_channel"];}
	elseif (isset($_POST["customer_zap_channel"]))	{$customer_zap_channel=$_POST["customer_zap_channel"];}
if (isset($_GET["customer_server_ip"]))	{$customer_server_ip=$_GET["customer_server_ip"];}
	elseif (isset($_POST["customer_server_ip"]))	{$customer_server_ip=$_POST["customer_server_ip"];}
if (isset($_GET["phone_pass"]))	{$phone_pass=$_GET["phone_pass"];}
	elseif (isset($_POST["phone_pass"]))	{$phone_pass=$_POST["phone_pass"];}
if (isset($_GET["VDRP_stage"]))	{$VDRP_stage=$_GET["VDRP_stage"];}
	elseif (isset($_POST["VDRP_stage"]))	{$VDRP_stage=$_POST["VDRP_stage"];}
if (isset($_GET["previous_agent_log_id"]))	{$previous_agent_log_id=$_GET["previous_agent_log_id"];}
	elseif (isset($_POST["previous_agent_log_id"]))	{$previous_agent_log_id=$_POST["previous_agent_log_id"];}
if (isset($_GET["last_VDRP_stage"]))	{$last_VDRP_stage=$_GET["last_VDRP_stage"];}
	elseif (isset($_POST["last_VDRP_stage"]))	{$last_VDRP_stage=$_POST["last_VDRP_stage"];}
if (isset($_GET["url_link"]))			{$url_link=$_GET["url_link"];}
	elseif (isset($_POST["url_link"]))	{$url_link=$_POST["url_link"];}
if (isset($_GET["user_group"]))				{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}
if (isset($_GET["MgrApr_user"]))			{$MgrApr_user=$_GET["MgrApr_user"];}
	elseif (isset($_POST["MgrApr_user"]))	{$MgrApr_user=$_POST["MgrApr_user"];}
if (isset($_GET["MgrApr_pass"]))			{$MgrApr_pass=$_GET["MgrApr_pass"];}
	elseif (isset($_POST["MgrApr_pass"]))	{$MgrApr_pass=$_POST["MgrApr_pass"];}
if (isset($_GET["routing_initiated_recording"]))			{$routing_initiated_recording=$_GET["routing_initiated_recording"];}
	elseif (isset($_POST["routing_initiated_recording"]))	{$routing_initiated_recording=$_POST["routing_initiated_recording"];}
if (isset($_GET["dead_time"]))			{$dead_time=$_GET["dead_time"];}
	elseif (isset($_POST["dead_time"]))	{$dead_time=$_POST["dead_time"];}
if (isset($_GET["callback_gmt_offset"]))			{$callback_gmt_offset=$_GET["callback_gmt_offset"];}
	elseif (isset($_POST["callback_gmt_offset"]))	{$callback_gmt_offset=$_POST["callback_gmt_offset"];}
if (isset($_GET["callback_timezone"]))			{$callback_timezone=$_GET["callback_timezone"];}
	elseif (isset($_POST["callback_timezone"]))	{$callback_timezone=$_POST["callback_timezone"];}

header ("Content-type: text/html; charset=utf-8");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0

$txt = '.txt';
$StarTtime = date("U");
$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$SQLdate = $NOW_TIME;
$CIDdate = date("mdHis");
$ENTRYdate = date("YmdHis");
$MT[0]='';
$agents='@agents';
$US='_';
while (strlen($CIDdate) > 9) {$CIDdate = substr("$CIDdate", 1);}
$check_time = ($StarTtime - 86400);

$secX = date("U");
$epoch = $secX;
$hour = date("H");
$min = date("i");
$sec = date("s");
$mon = date("m");
$mday = date("d");
$year = date("Y");
$isdst = date("I");
$Shour = date("H");
$Smin = date("i");
$Ssec = date("s");
$Smon = date("m");
$Smday = date("d");
$Syear = date("Y");

### Grab Server GMT value from the database
$stmt="SELECT local_gmt FROM servers where active='Y' limit 1;";
$rslt=mysql_to_mysqli($stmt, $link);
	if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00545',$user,$server_ip,$session_name,$one_mysql_log);}
$gmt_recs = mysqli_num_rows($rslt);
if ($gmt_recs > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$DBSERVER_GMT		=		$row[0];
	if (strlen($DBSERVER_GMT)>0)	{$SERVER_GMT = $DBSERVER_GMT;}
	if ($isdst) {$SERVER_GMT++;} 
	}
else
	{
	$SERVER_GMT = date("O");
	$SERVER_GMT = preg_replace("/\+/i","",$SERVER_GMT);
	$SERVER_GMT = ($SERVER_GMT + 0);
	$SERVER_GMT = ($SERVER_GMT / 100);
	}

$LOCAL_GMT_OFF = $SERVER_GMT;
$LOCAL_GMT_OFF_STD = $SERVER_GMT;

##### Hangup Cause Dictionary #####
$hangup_cause_dictionary = array(
0 => "Unspecified. No other cause codes applicable.",
1 => "Unallocated (unassigned) number.",
2 => "No route to specified transit network (national use).",
3 => "No route to destination.",
6 => "Channel unacceptable.",
7 => "Call awarded, being delivered in an established channel.",
16 => "Normal call clearing.",
17 => "User busy.",
18 => "No user responding.",
19 => "No answer from user (user alerted).",
20 => "Subscriber absent.",
21 => "Call rejected.",
22 => "Number changed.",
23 => "Redirection to new destination.",
25 => "Exchange routing error.",
27 => "Destination out of order.",
28 => "Invalid number format (address incomplete).",
29 => "Facilities rejected.",
30 => "Response to STATUS INQUIRY.",
31 => "Normal, unspecified.",
34 => "No circuit/channel available.",
38 => "Network out of order.",
41 => "Temporary failure.",
42 => "Switching equipment congestion.",
43 => "Access information discarded.",
44 => "Requested circuit/channel not available.",
50 => "Requested facility not subscribed.",
52 => "Outgoing calls barred.",
54 => "Incoming calls barred.",
57 => "Bearer capability not authorized.",
58 => "Bearer capability not presently available.",
63 => "Service or option not available, unspecified.",
65 => "Bearer capability not implemented.",
66 => "Channel type not implemented.",
69 => "Requested facility not implemented.",
79 => "Service or option not implemented, unspecified.",
81 => "Invalid call reference value.",
88 => "Incompatible destination.",
95 => "Invalid message, unspecified.",
96 => "Mandatory information element is missing.",
97 => "Message type non-existent or not implemented.",
98 => "Message not compatible with call state or message type non-existent or not implemented.",
99 => "Information element / parameter non-existent or not implemented.",
100 => "Invalid information element contents.",
101 => "Message not compatible with call state.",
102 => "Recovery on timer expiry.",
103 => "Parameter non-existent or not implemented - passed on (national use).",
111 => "Protocol error, unspecified.",
127 => "Interworking, unspecified."
);

##### SIP Hangup Cause Dictionary #####
$sip_hangup_cause_dictionary = array(
400 => "Bad Request.",
401 => "Unauthorized.",
402 => "Payment Required.",
403 => "Forbidden.",
404 => "Not Found.",
405 => "Method Not Allowed.",
406 => "Not Acceptable.",
407 => "Proxy Authentication Required.",
408 => "Request Timeout.",
409 => "Conflict.",
410 => "Gone.",
411 => "Length Required.",
412 => "Conditional Request Failed.",
413 => "Request Entity Too Large.",
414 => "Request-URI Too Long.",
415 => "Unsupported Media Type.",
416 => "Unsupported URI Scheme.",
417 => "Unknown Resource-Priority.",
420 => "Bad Extension.",
421 => "Extension Required.",
422 => "Session Interval Too Small.",
423 => "Interval Too Brief.",
424 => "Bad Location Information.",
428 => "Use Identity Header.",
429 => "Provide Referrer Identity.",
433 => "Anonymity Disallowed.",
436 => "Bad Identity-Info.",
437 => "Unsupported Certificate.",
438 => "Invalid Identity Header.",
470 => "Consent Needed.",
480 => "Temporarily Unavailable.",
481 => "Call/Transaction Does Not Exist.",
482 => "Loop Detected..",
483 => "Too Many Hops.",
484 => "Address Incomplete.",
485 => "Ambiguous.",
486 => "Busy Here.",
487 => "Request Terminated.",
488 => "Not Acceptable Here.",
489 => "Bad Event.",
491 => "Request Pending.",
493 => "Undecipherable.",
494 => "Security Agreement Required.",
500 => "Server Internal Error.",
501 => "Not Implemented.",
502 => "Bad Gateway.",
503 => "Service Unavailable.",
504 => "Server Time-out.",
505 => "Version Not Supported.",
513 => "Message Too Large.",
580 => "Precondition Failure.",
600 => "Busy Everywhere.",
603 => "Decline.",
604 => "Does Not Exist Anywhere.",
606 => "Not Acceptable."
);


#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,timeclock_end_of_day,agentonly_callback_campaign_lock,alt_log_server_ip,alt_log_dbname,alt_log_login,alt_log_pass,tables_use_alt_log_db,qc_features_active,allow_emails,callback_time_24hour,enable_languages,language_method,agent_debug_logging,default_language,active_modules,allow_chats,default_phone_code,user_new_lead_limit FROM system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
	if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00001',$user,$server_ip,$session_name,$one_mysql_log);}
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysqli_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$non_latin =							$row[0];
	$timeclock_end_of_day =					$row[1];
	$agentonly_callback_campaign_lock =		$row[2];
	$alt_log_server_ip =					$row[3];
	$alt_log_dbname =						$row[4];
	$alt_log_login =						$row[5];
	$alt_log_pass =							$row[6];
	$tables_use_alt_log_db =				$row[7];
	$qc_features_active =					$row[8];
	$allow_emails =							$row[9];
	$callback_time_24hour =					$row[10];
	$SSenable_languages =					$row[11];
	$SSlanguage_method =					$row[12];
	$SSagent_debug_logging =				$row[13];
	$SSdefault_language =					$row[14];
	$active_modules =						$row[15];
	$allow_chats =							$row[16];
	$default_phone_code =					$row[17];
	$SSuser_new_lead_limit =				$row[18];
	}
##### END SETTINGS LOOKUP #####
###########################################



################################################################################
### CALLSINQUEUEview - List calls in queue for the bottombar 228
################################################################################
if ($ACTION == 'CALLSINQUEUEview')
	{
	$stmt="SELECT view_calls_in_queue,grab_calls_in_queue from vicidial_campaigns where campaign_id='$campaign'";
	if ($non_latin > 0) {$rslt=mysql_to_mysqli("SET NAMES 'UTF8'", $link);}
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00228',$user,$server_ip,$session_name,$one_mysql_log);}
	$row=mysqli_fetch_row($rslt);
	$view_calls_in_queue =	$row[0];
	$grab_calls_in_queue =	$row[1];

	if (preg_match('/NONE/i',$view_calls_in_queue))
		{
		echo _QXZ("Calls in Queue View Disabled for this campaign")."\n";
		if ($SSagent_debug_logging > 0) {vicidial_ajax_log($NOW_TIME,$startMS,$link,$ACTION,$php_script,$user,$stage,$lead_id,$session_name,$stmt);}
		exit;
		}
	else
		{
		$view_calls_in_queue = preg_replace('/ALL/','99', $view_calls_in_queue);
	
		### grab the status and campaign/in-group information for this agent to display
		$ADsql='';
		$stmt="SELECT status,campaign_id,closer_campaigns from vicidial_live_agents where user='$user' and server_ip='$server_ip';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00229',$user,$server_ip,$session_name,$one_mysql_log);}
		$row=mysqli_fetch_row($rslt);
		$Alogin=$row[0];
		$Acampaign=$row[1];
		$AccampSQL=$row[2];
		$AccampSQL = preg_replace('/\s-/','', $AccampSQL);
		$AccampSQL = preg_replace('/\s/',"','", $AccampSQL);
		if (preg_match('/AGENTDIRECT/i', $AccampSQL))
			{
			$AccampSQL = preg_replace('/AGENTDIRECT/','', $AccampSQL);
			$ADsql = "or ( (campaign_id LIKE \"%AGENTDIRECT%\") and (agent_only='$user') )";
			}

		### grab the basic data on calls in the queue for this agent
		$stmt="SELECT lead_id,campaign_id,phone_number,uniqueid,UNIX_TIMESTAMP(call_time),call_type,auto_call_id from vicidial_auto_calls where status IN('LIVE') and ( (campaign_id='$Acampaign') or (campaign_id IN('$AccampSQL')) $ADsql) order by queue_priority,call_time;";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00230',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($rslt) {$calls_count = mysqli_num_rows($rslt);}
		$loop_count=0;
		while ($calls_count > $loop_count)
			{
			$row=mysqli_fetch_row($rslt);
			$CQlead_id[$loop_count] =		$row[0];
			$CQcampaign_id[$loop_count] =	$row[1];
			$CQphone_number[$loop_count] =	$row[2];
			$CQuniqueid[$loop_count] =		$row[3];
			$CQcall_time[$loop_count] =		$row[4];
			$CQcall_type[$loop_count] =		$row[5];
			$CQauto_call_id[$loop_count] =	$row[6];
			$loop_count++;
			}

		### re-order the calls to always make sure the AGENTDIRECT calls are first
		$loop_count=0;
		$o=0;
		while ($calls_count > $loop_count)
			{
			if (preg_match('/AGENTDIRECT/i', $CQcampaign_id[$loop_count]))
				{
				$OQlead_id[$o] =		$CQlead_id[$loop_count];
				$OQcampaign_id[$o] =	$CQcampaign_id[$loop_count];
				$OQphone_number[$o] =	$CQphone_number[$loop_count];
				$OQuniqueid[$o] =		$CQuniqueid[$loop_count];
				$OQcall_time[$o] =		$CQcall_time[$loop_count];
				$OQcall_type[$o] =		$CQcall_type[$loop_count];
				$OQauto_call_id[$o] =	$CQauto_call_id[$loop_count];
				$o++;
				}
			$loop_count++;
			}
		$loop_count=0;
		while ($calls_count > $loop_count)
			{
			if (!preg_match('/AGENTDIRECT/i', $CQcampaign_id[$loop_count]))
				{
				$OQlead_id[$o] =		$CQlead_id[$loop_count];
				$OQcampaign_id[$o] =	$CQcampaign_id[$loop_count];
				$OQphone_number[$o] =	$CQphone_number[$loop_count];
				$OQuniqueid[$o] =		$CQuniqueid[$loop_count];
				$OQcall_time[$o] =		$CQcall_time[$loop_count];
				$OQcall_type[$o] =		$CQcall_type[$loop_count];
				$OQauto_call_id[$o] =	$CQauto_call_id[$loop_count];
				$o++;
				}
			$loop_count++;
			}

		echo '<table class="table table-bordered table-sm table-responsive">';
		echo "<TR>";
		echo "<TH></TH>";
		echo "<TH style='text-align:center;padding:0px;vertical-align:middle;font-size:12px;'> &nbsp; "._QXZ("PHONE")." &nbsp; </TH>";
		echo "<TH style='text-align:center;padding:0px;vertical-align:middle;font-size:12px;'> &nbsp; "._QXZ("FULL NAME")." &nbsp; </TH>";
		echo "<TH style='text-align:center;padding:0px;vertical-align:middle;font-size:12px;'> &nbsp; "._QXZ("WAIT")." &nbsp; </TH>";
		echo "<TH style='text-align:center;padding:0px;vertical-align:middle;font-size:12px;'> &nbsp; "._QXZ("AGENT")." &nbsp; </TH>";
		echo "<TH></TH>";
		echo "<TH style='text-align:center;padding:0px;vertical-align:middle;font-size:12px;'> &nbsp; "._QXZ("CALL GROUP")." &nbsp; </TH>";
		echo "<TH style='text-align:center;padding:0px;vertical-align:middle;font-size:12px;'> &nbsp; "._QXZ("TYPE")." &nbsp; </TH>";
		echo "</TR>";

		### Print call information and gather more info on the calls as they are printed
		$loop_count=0;
		while ( ($calls_count > $loop_count) and ($view_calls_in_queue > $loop_count) )
			{
			$call_time = ($StarTtime - $OQcall_time[$loop_count]);
			$Fminutes_M = ($call_time / 60);
			$Fminutes_M_int = floor($Fminutes_M);
			$Fminutes_M_int = intval("$Fminutes_M_int");
			$Fminutes_S = ($Fminutes_M - $Fminutes_M_int);
			$Fminutes_S = ($Fminutes_S * 60);
			$Fminutes_S = round($Fminutes_S, 0);
			if ($Fminutes_S < 10) {$Fminutes_S = "0$Fminutes_S";}
			$call_time = "$Fminutes_M_int:$Fminutes_S";
			$call_handle_method='';

			if ($OQcall_type[$loop_count]=='IN')
				{
				$stmt="SELECT group_name,group_color from vicidial_inbound_groups where group_id='$OQcampaign_id[$loop_count]';";
				$rslt=mysql_to_mysqli($stmt, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00231',$user,$server_ip,$session_name,$one_mysql_log);}
				$row=mysqli_fetch_row($rslt);
				$group_name =			$row[0];
				$group_color =			$row[1];
				}
			$stmt="SELECT comments,user,first_name,last_name from vicidial_list where lead_id='$OQlead_id[$loop_count]'";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00232',$user,$server_ip,$session_name,$one_mysql_log);}
			$row=mysqli_fetch_row($rslt);
			$comments =		$row[0];
			$agent =		$row[1];
			$first_last_name =	"$row[2] $row[3]";
			$caller_name =	$first_last_name;

			$stmt="SELECT full_name from vicidial_users where user='$agent'";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00575',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($rslt) {$agent_name_count = mysqli_num_rows($rslt);}
			if ($agent_name_count > 0)
				{
				$row=mysqli_fetch_row($rslt);
				$agent_name =		$row[0];
				}
			else
				{$agent_name='';}

			if (strlen($caller_name)<2)
				{$caller_name =	$comments;}
			if (strlen($caller_name) > 30) {$caller_name = substr("$caller_name", 0, 30);}

			if (preg_match("/0$|2$|4$|6$|8$/i", $loop_count)) {$Qcolor='bgcolor="#FCFCFC"';} 
			else{$Qcolor='bgcolor="#ECECEC"';}

			if ( (preg_match('/Y/i',$grab_calls_in_queue)) and ($OQcall_type[$loop_count]=='IN') )
				{
				echo "<TR $Qcolor>";
				echo "<TD> <a href=\"#\" onclick=\"callinqueuegrab('$OQauto_call_id[$loop_count]');return false;\">"._QXZ("TAKE CALL")."</a> &nbsp; </TD>";
				echo "<TD> &nbsp; $OQphone_number[$loop_count] &nbsp; </TD>";
				echo "<TD> &nbsp; $caller_name &nbsp; </TD>";
				echo "<TD> &nbsp; $call_time &nbsp; </TD>";
				echo "<TD> &nbsp; $agent - $agent_name &nbsp; </TD>";
				echo "<TD bgcolor=\"$group_color\"> &nbsp; &nbsp; &nbsp; </TD>";
				echo "<TD> &nbsp; $OQcampaign_id[$loop_count] - $group_name &nbsp; </TD>";
				echo "<TD> &nbsp; $OQcall_type[$loop_count] &nbsp; </TD>";
				echo "</TR>";
				}
			else
				{
				echo "<TR>";
				
				echo "<TD> &nbsp; $OQphone_number[$loop_count] &nbsp; </TD>";
				echo "<TD> &nbsp; $caller_name &nbsp; </TD>";
				echo "<TD> &nbsp; $call_time &nbsp; </TD>";
				echo "<TD> &nbsp; $agent - $agent_name &nbsp; </TD>";
				echo "<TD bgcolor=\"$group_color\"> &nbsp; &nbsp; &nbsp; </TD>";
				echo "<TD> &nbsp; $OQcampaign_id[$loop_count] - $group_name &nbsp; </TD>";
				echo "<TD> &nbsp; $OQcall_type[$loop_count] &nbsp; </TD>";
				echo "</TR>";
				}
			$loop_count++;
			}
		echo "</TABLE><BR> &nbsp;\n";
		}
	}
	
	################################################################################
### LEADINFOview - display the information for a lead and logs for that lead
################################################################################
if ($ACTION == 'LEADINFOview')
	{
	if (strlen($lead_id) < 1)
		{echo "ERROR: "._QXZ("no Lead ID");}
	else
		{
		$hide_dial_links=0;
		echo "<CENTER>\n";

		if ($search == 'logfirst')
			{$hide_dial_links++;}

		if ($inbound_lead_search > 0)
			{$hide_dial_links++;}

		### BEGIN Display callback information ###
		$callback_id = preg_replace('/\D/','',$callback_id);
		if (strlen($callback_id) > 0)
			{
			$stmt="SELECT status,entry_time,callback_time,modify_date,user,recipient,comments,lead_status from vicidial_callbacks where lead_id='$lead_id' and callback_id='$callback_id' limit 1;";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00397',$user,$server_ip,$session_name,$one_mysql_log);}
			$cb_to_print = mysqli_num_rows($rslt);
			if ($format=='debug') {echo "|$cb_to_print|$stmt|";}
			if ($cb_to_print > 0)
				{
				$row=mysqli_fetch_row($rslt);
				//ishwari
				//18-july-2018
				//~ echo "<TABLE class=\"table table-striped table-sm table-responsive\">";
				//~ echo "<tr><td><font class='sb_text'>"._QXZ("0 Status:")." &nbsp; </td><td ALIGN=left><font class='sb_text'>"._QXZ("$row[0]")."</td></tr>";
				//~ echo "<tr bgcolor=white><td ALIGN=right><font class='sb_text'>"._QXZ("Callback Lead Status:")." &nbsp; </td><td ALIGN=left><font class='sb_text'>$row[7]</td></tr>";
				//~ echo "<tr bgcolor=white><td ALIGN=right><font class='sb_text'>"._QXZ("Callback Entry Time:")." &nbsp; </td><td ALIGN=left><font class='sb_text'>$row[1]</td></tr>";
				//~ echo "<tr bgcolor=white><td ALIGN=right><font class='sb_text'>"._QXZ("Callback Trigger Time:")." &nbsp; </td><td ALIGN=left><font class='sb_text'>$row[2]</td></tr>";
				//~ echo "<tr bgcolor=white><td ALIGN=right><font class='sb_text'>"._QXZ("Callback Comments:")." &nbsp; </td><td ALIGN=left><font class='sb_text'>$row[6]</td></tr>";
				//~ echo "<tr><td><font class='sb_text'>"._QXZ("Callback Status:")." &nbsp;"._QXZ("$row[0]")."</td>";
				//~ echo "<td><font class='sb_text'>"._QXZ("Callback Lead Status:")."  &nbsp; $row[7]</td>";
				//~ echo "<td><font class='sb_text'>"._QXZ("Callback Entry Time:")."  &nbsp; $row[1]</td></tr>";
				//~ echo "<tr><td><font class='sb_text'>"._QXZ("Callback Trigger Time:")." &nbsp; $row[2]</td>";
				//~ echo "<td><font class='sb_text'>"._QXZ("Callback Comments:")."  &nbsp;$row[6]</td></tr>";
				//~ echo "</TABLE>";
				//~ echo "<BR>";
				$callback_time_info = $row[2];
				$callback_comments_info =$row[6];
				$callback_priority_blob_colour = 'text-warning';
				if ($callback_comments_info[1] == '>')
				{
				if ($callback_comments_info[0] == '1') {$callback_priority_blob_colour = 'text-success';}
                if ($callback_comments_info[0] == '3') {$callback_priority_blob_colour = 'text-danger';}
                $callback_comments_info =  substr($callback_comments_info, 2);

				}

				$hide_dial_links++;
				}
			}
		### END Display callback information ###

		### find the screen_label for this campaign
		$stmt="SELECT screen_labels,hide_call_log_info from vicidial_campaigns where campaign_id='$campaign';";
		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00416',$user,$server_ip,$session_name,$one_mysql_log);}
		$csl_to_print = mysqli_num_rows($rslt);
		if ($format=='debug') {echo "|$csl_to_print|$stmt|";}
		if ($csl_to_print > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$screen_labels =		$row[0];
			$hide_call_log_info =	$row[1];
			}

		### BEGIN Display lead info and custom fields ###
		### BEGIN find any custom field labels ###
		$INFOout='';
		$label_title =				_QXZ(" Title");
		$label_first_name =			_QXZ("First");
		$label_middle_initial =		_QXZ("MI");
		$label_last_name =			_QXZ("Last ");
		$label_address1 =			_QXZ("Address1");
		$label_address2 =			_QXZ("Address2");
		$label_address3 =			_QXZ("Address3");
		$label_city =				_QXZ("City");
		$label_state =				_QXZ(" State");
		$label_province =			_QXZ("Province");
		$label_postal_code =		_QXZ("PostCode");
		$label_vendor_lead_code =	_QXZ("Vendor ID");
		$label_gender =				_QXZ(" Gender");
		$label_phone_number =		_QXZ("Phone");
		$label_phone_code =			_QXZ("DialCode");
		$label_alt_phone =			_QXZ("Alt. Phone");
		$label_security_phrase =	_QXZ("Show");
		$label_email =				_QXZ(" Email");
		$label_comments =			_QXZ(" Comments");

		$stmt="SELECT label_title,label_first_name,label_middle_initial,label_last_name,label_address1,label_address2,label_address3,label_city,label_state,label_province,label_postal_code,label_vendor_lead_code,label_gender,label_phone_number,label_phone_code,label_alt_phone,label_security_phrase,label_email,label_comments,label_hide_field_logs from system_settings;";
		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00417',$user,$server_ip,$session_name,$one_mysql_log);}
		$row=mysqli_fetch_row($rslt);
		if (strlen($row[0])>0)	{$label_title =				$row[0];}
		if (strlen($row[1])>0)	{$label_first_name =		$row[1];}
		if (strlen($row[2])>0)	{$label_middle_initial =	$row[2];}
		if (strlen($row[3])>0)	{$label_last_name =			$row[3];}
		if (strlen($row[4])>0)	{$label_address1 =			$row[4];}
		if (strlen($row[5])>0)	{$label_address2 =			$row[5];}
		if (strlen($row[6])>0)	{$label_address3 =			$row[6];}
		if (strlen($row[7])>0)	{$label_city =				$row[7];}
		if (strlen($row[8])>0)	{$label_state =				$row[8];}
		if (strlen($row[9])>0)	{$label_province =			$row[9];}
		if (strlen($row[10])>0) {$label_postal_code =		$row[10];}
		if (strlen($row[11])>0) {$label_vendor_lead_code =	$row[11];}
		if (strlen($row[12])>0) {$label_gender =			$row[12];}
		if (strlen($row[13])>0) {$label_phone_number =		$row[13];}
		if (strlen($row[14])>0) {$label_phone_code =		$row[14];}
		if (strlen($row[15])>0) {$label_alt_phone =			$row[15];}
		if (strlen($row[16])>0) {$label_security_phrase =	$row[16];}
		if (strlen($row[17])>0) {$label_email =				$row[17];}
		if (strlen($row[18])>0) {$label_comments =			$row[18];}
		$label_hide_field_logs =	$row[19];

		if ( ($screen_labels != '--SYSTEM-SETTINGS--') and (strlen($screen_labels)>1) )
			{
			$stmt="SELECT label_title,label_first_name,label_middle_initial,label_last_name,label_address1,label_address2,label_address3,label_city,label_state,label_province,label_postal_code,label_vendor_lead_code,label_gender,label_phone_number,label_phone_code,label_alt_phone,label_security_phrase,label_email,label_comments,label_hide_field_logs from vicidial_screen_labels where label_id='$screen_labels' and active='Y' limit 1;";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00418',$user,$server_ip,$session_name,$one_mysql_log);}
			$screenlabels_count = mysqli_num_rows($rslt);
			if ($screenlabels_count > 0)
				{
				$row=mysqli_fetch_row($rslt);
				if (strlen($row[0])>0)	{$label_title =				$row[0];}
				if (strlen($row[1])>0)	{$label_first_name =		$row[1];}
				if (strlen($row[2])>0)	{$label_middle_initial =	$row[2];}
				if (strlen($row[3])>0)	{$label_last_name =			$row[3];}
				if (strlen($row[4])>0)	{$label_address1 =			$row[4];}
				if (strlen($row[5])>0)	{$label_address2 =			$row[5];}
				if (strlen($row[6])>0)	{$label_address3 =			$row[6];}
				if (strlen($row[7])>0)	{$label_city =				$row[7];}
				if (strlen($row[8])>0)	{$label_state =				$row[8];}
				if (strlen($row[9])>0)	{$label_province =			$row[9];}
				if (strlen($row[10])>0) {$label_postal_code =		$row[10];}
				if (strlen($row[11])>0) {$label_vendor_lead_code =	$row[11];}
				if (strlen($row[12])>0) {$label_gender =			$row[12];}
				if (strlen($row[13])>0) {$label_phone_number =		$row[13];}
				if (strlen($row[14])>0) {$label_phone_code =		$row[14];}
				if (strlen($row[15])>0) {$label_alt_phone =			$row[15];}
				if (strlen($row[16])>0) {$label_security_phrase =	$row[16];}
				if (strlen($row[17])>0) {$label_email =				$row[17];}
				if (strlen($row[18])>0) {$label_comments =			$row[18];}
				$label_hide_field_logs =	$row[19];
				### END find any custom field labels ###
				$hide_gender=0;
				if ($label_gender == '---HIDE---')
					{$hide_gender=1;}
				}
			}
		### END find any custom field labels ###
		$lead_id = $_POST['lead_id'];
		$INFOout .= "<div class=\"tab-content\" id=\"pills-tabContent\">";
		$INFOout .= "<div class=\"tab-pane fade active show\" id=\"pills-home\" role=\"tabpanel\" aria-labelledby=\"pills-home-tab\" aria-expanded=\"true\">";

		$stmt="SELECT status,vendor_lead_code,list_id,gmt_offset_now,called_since_last_reset,phone_code,phone_number,title,first_name,middle_initial,last_name,address1,address2,address3,city,state,province,postal_code,country_code,gender,alt_phone,email,security_phrase,comments,called_count,last_local_call_time,rank,owner,entry_list_id from vicidial_list where lead_id='$lead_id' limit 1;";
		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00398',$user,$server_ip,$session_name,$one_mysql_log);}
		$info_to_print = mysqli_num_rows($rslt);
		if ($format=='debug') {$INFOout .= "|$out_logs_to_print|$stmt|";}

		if ($info_to_print > 0)
			{
			$row=mysqli_fetch_row($rslt);

			##### BEGIN check for postal_code and phone time zones if alert enabled
			$post_phone_time_diff_alert_message='';
			$stmt="SELECT post_phone_time_diff_alert,local_call_time FROM vicidial_campaigns where campaign_id='$campaign';";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00415',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$camp_pptda_ct = mysqli_num_rows($rslt);
			if ($camp_pptda_ct > 0)
				{
				$rowx=mysqli_fetch_row($rslt);
				$post_phone_time_diff_alert =	$rowx[0];
				$local_call_time =				$rowx[1];
				}
			if ( ($post_phone_time_diff_alert == 'ENABLED') or (preg_match("/OUTSIDE_CALLTIME/",$post_phone_time_diff_alert)) )
				{
				$lead_list_id = $row[2];
				$phone_code =	$row[5];
				$phone_number = $row[6];
				$state =		$row[15];
				$postal_code =	$row[17];

				### get current gmt_offset of the phone_number
				$postalgmtNOW = '';
				$USarea = substr($phone_number, 0, 3);
				$PHONEgmt_offset = lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear,$postalgmtNOW,$postal_code);

				$postalgmtNOW = 'POSTAL';
				$POSTgmt_offset = lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear,$postalgmtNOW,$postal_code);

				### Get local_call_time for list
				$stmt="SELECT local_call_time,list_description FROM vicidial_lists where list_id='$lead_list_id';";
				$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00610',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$rowy=mysqli_fetch_row($rslt);
				$list_local_call_time =	$rowy[0];
				$list_description =		$rowy[1];

				# check that call time exists
				if ($list_local_call_time != "campaign") 
					{
					$stmt="SELECT count(*) from vicidial_call_times where call_time_id='$list_local_call_time';";
					$rslt=mysql_to_mysqli($stmt, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00615',$user,$server_ip,$session_name,$one_mysql_log);}					
					$rowc=mysqli_fetch_row($rslt);
					$call_time_exists  =	$rowc[0];
					if ($call_time_exists < 1) 
						{$list_local_call_time = 'campaign';}
					}

				#Check if we are within the gmt for campaign for $PHONEdialable
				if ( (dialable_gmt($DB,$link,$local_call_time,$PHONEgmt_offset,$state) == 1) and ($list_local_call_time != "campaign") )
					{
					#Now check if we are with the GMT for the list local call time
					$PHONEdialable = dialable_gmt($DB,$link,$list_local_call_time,$PHONEgmt_offset,$state);
					}
				else 
					{
					$PHONEdialable = dialable_gmt($DB,$link,$local_call_time,$PHONEgmt_offset,$state);
					}

				#Check if we are with the gmt for campaign for $POSTdialable
				if ( (dialable_gmt($DB,$link,$local_call_time,$POSTgmt_offset,$state) == 1) and ($list_local_call_time != "campaign") )
					{
					#Now check if we are with the GMT for the list local call time
					$POSTdialable = dialable_gmt($DB,$link,$list_local_call_time,$POSTgmt_offset,$state);
					}
				else 
					{
					$POSTdialable = dialable_gmt($DB,$link,$local_call_time,$POSTgmt_offset,$state);
					}
			#	$post_phone_time_diff_alert_message = "$POSTgmt_offset|$POSTdialable|$postal_code   ---   $PHONEgmt_offset|$PHONEdialable|$USarea";
				$post_phone_time_diff_alert_message = '';

				if ($PHONEgmt_offset != $POSTgmt_offset)
					{
					$post_phone_time_diff_alert_message .= _QXZ("Phone and Post Code Time Zone Mismatch! ");

					if ($post_phone_time_diff_alert == 'OUTSIDE_CALLTIME_ONLY')
						{
						$post_phone_time_diff_alert_message='';
						if ($PHONEdialable < 1)
							{$post_phone_time_diff_alert_message .= _QXZ(" Phone Area Code Outside Dialable Zone")." $PHONEgmt_offset &nbsp; &nbsp; &nbsp; ";}
						if ($POSTdialable < 1)
							{$post_phone_time_diff_alert_message .= _QXZ(" Postal Code Outside Dialable Zone")." $POSTgmt_offset";}
						}
					}
				if ( ($post_phone_time_diff_alert == 'OUTSIDE_CALLTIME_PHONE') or ($post_phone_time_diff_alert == 'OUTSIDE_CALLTIME_POSTAL') or ($post_phone_time_diff_alert == 'OUTSIDE_CALLTIME_BOTH') )
					{$post_phone_time_diff_alert_message = '';}

				if ( ($post_phone_time_diff_alert == 'OUTSIDE_CALLTIME_PHONE') or ($post_phone_time_diff_alert == 'OUTSIDE_CALLTIME_BOTH') )
					{
					if ($PHONEdialable < 1)
						{$post_phone_time_diff_alert_message .= _QXZ(" Phone Area Code Outside Dialable Zone")." $PHONEgmt_offset &nbsp; &nbsp; &nbsp; ";}
					}
				if ( ($post_phone_time_diff_alert == 'OUTSIDE_CALLTIME_POSTAL') or ($post_phone_time_diff_alert == 'OUTSIDE_CALLTIME_BOTH') )
					{
					if ($POSTdialable < 1)
						{$post_phone_time_diff_alert_message .= _QXZ(" Postal Code Outside Dialable Zone ")."$POSTgmt_offset ";}
					}

				if (strlen($post_phone_time_diff_alert_message)>5)
					{$INFOout .= "<tr bgcolor=white><td colspan=2 align=centre><font size=2 color=red><b>$post_phone_time_diff_alert_message</b></font></td></tr>";}
				}
			##### END check for postal_code and phone time zones if alert enabled

				$INFOout.='<div class="container text-left text-small">';


				if ($callback_time_info){
				$INFOout .= "<div class='row'><div class='col font-weight-bold'>CallBack Priority:</div><div class='col'><i class='fas fa-dot-circle ".$callback_priority_blob_colour." \'></i></div></div>";
				$INFOout .= "<div class='row'><div class='col font-weight-bold'>CallBack Time:</div><div class='col'> $callback_time_info</div></div>";
				$INFOout .= "<div class='row'><div class='col font-weight-bold'>CallBack Comments:</div><div class='col'> $callback_comments_info</div></div>";

			}

				$INFOout .= "<div class='row'><div class='col font-weight-bold'>Status:</div><div class='col'> $row[0]</div></div>";
			//~ if ( ($label_vendor_lead_code!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<td>$label_vendor_lead_code: &nbsp; $row[1]</td>";}
				$INFOout .= "<div class='row'><div class='col font-weight-bold'>Lead ID:</div><div class='col'> $lead_id</div></div>";
				//$INFOout .= ""._QXZ("Lead ID:")."&nbsp; $lead_id<br>";
				
			//~ $INFOout .= "<p style='text-align:left;'>"._QXZ("List ID:")."&nbsp; $row[2]</p>";
			
			//~ $INFOout .= "<tr><td>"._QXZ("Timezone:")." &nbsp$row[3]</td>";
			
			//~ $INFOout .= "<p style='text-align:left;'>"._QXZ("Called Since Last Reset:")." &nbsp; $row[4] </p>";
			
			//~ if ( ($label_phone_code!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<p style='text-align:left;'>$label_phone_code: &nbsp; $row[5]</p><br>";}
			if ( ($label_phone_number!='---HIDE---') or ($label_hide_field_logs=='N') )
				{
				$INFOout .= "<div class='row'><div class='col font-weight-bold'>$label_phone_number</div><div class='col'> $row[6]</div></div>";
				
				//$INFOout .= "$label_phone_number: &nbsp; $row[6] ";
				if ($hide_dial_links < 1)
					{
					if ($manual_dial_filter > 0)
						{//MIKE REMOVE $INFOout .= "<a class='glyphicon glyphicon-earphone' href=\"#\" onclick=\"NeWManuaLDiaLCalL('CALLLOG',$row[5], $row[6], $lead_id,'','YES');return false;\"> </a>";
				}
					else
						{
							//~ $INFOout .= _QXZ(" DIAL ");
					   //MIKE REMOVE   $INFOout .= "<br>";
							}
					}
				}
			if ( ($label_alt_phone!='---HIDE---') or ($label_hide_field_logs=='N') )
				{
				$INFOout .= "<div class='row'><div class='col font-weight-bold'>$label_alt_phone:</div><div class='col'> $row[20]</div></div>";
		//		$INFOout .= "$label_alt_phone: &nbsp; $row[20]";
				if ($hide_dial_links < 1)
					{
					if ($manual_dial_filter > 0)
						{//MIKE REMOVE $INFOout .= "<a class='glyphicon glyphicon-earphone' href=\"#\" onclick=\"NeWManuaLDiaLCalL('CALLLOG',$row[5], $row[20], $lead_id, 'ALT','YES');return false;\">  </a>";
				}
					else
						{
							//~ $INFOout .= " DIAL ";
							}
					}
				//MIKE REMOVE	$INFOout .= "<br>";
				}
				
			if ( ($label_phone_number=='---HIDE---') and ($hide_dial_links < 1) )
				{
				if ($manual_dial_filter > 0)
					{//MIKE REMOVE $INFOout .= "<td>"._QXZ("Dial Link:")." &nbsp; <a class='glyphicon glyphicon-earphone' href=\"#\" onclick=\"NeWManuaLDiaLCalL('CALLLOG',$row[5], $row[6], $lead_id,'','YES');return false;\"> "._QXZ("DIAL")." </a>";
			}
				else
					{//MIKE REMOVE $INFOout .= ""._QXZ("Dial Link:")." &nbsp;"._QXZ(" DIAL ");
			}
				}
			// MIKE REMOVE $INFOout .= "</td></tr>";
			if ($inbound_lead_search > 0)
				{//MIKE REMOVE  $INFOout .= "<td><a href=\"#\" onclick=\"LeaDSearcHSelecT('$lead_id');return false;\">"._QXZ("SELECT THIS LEAD")."</a></td></tr>";
		}
			if ( ($label_title!='---HIDE---') or ($label_hide_field_logs=='N') )
				{$INFOout .= "<div class='row'><div class='col font-weight-bold'>Name:</div><div class='col'> $row[7] &nbsp $row[8] &nbsp $row[10]</div></div>";}

				//	$INFOout .= "Name: &nbsp $row[7] &nbsp $row[8] &nbsp $row[10]<br>";}
			//~ if ( ($label_first_name!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<td>$label_first_name: &nbsp;$row[8]</td>";}
				
			//~ if ( ($label_middle_initial!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<td>$label_middle_initial: &nbsp $row[9]</td></tr>";}
				
			//~ if ( ($label_last_name!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<tr><td>$label_last_name: &nbsp; $row[10]</td>";}
				
			if ( ($label_address1!='---HIDE---') or ($label_hide_field_logs=='N') )
				{$INFOout .= "<div class='row'><div class='col font-weight-bold'>Address:</div><div class='col'> $row[11] &nbsp; $row[12] &nbsp; $row[13] &nbsp; $row[17]</div></div>";}


				//	$INFOout .= "Address: &nbsp; $row[11] &nbsp; $row[12] &nbsp; $row[13] &nbsp; $row[17]<br>";}
				
			//~ if ( ($label_address2!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<td>$label_address2: &nbsp; $row[12]</td></tr>";}
				
			//~ if ( ($label_address3!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<tr><td>$label_address3: &nbsp; $row[13]</td>";}
				
			//~ if ( ($label_city!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<td >$label_city: &nbsp; $row[14]</td>";}
				
			//~ if ( ($label_state!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<td>$label_state: &nbsp; $row[15]</td></tr>";}
				
			//~ if ( ($label_province!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<tr><td>$label_province: &nbsp;$row[16]</td>";}
				
			//~ if ( ($label_postal_code!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<td>$label_postal_code: &nbsp;$row[17]</td>";}
				
			//~ $INFOout .= "<td>Country: &nbsp; $row[18]</td></tr>";
			//~ if ( ($label_gender!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<tr><td>$label_gender: &nbsp;$row[19]</td>";}
			
			
			
			if ( ($label_email!='---HIDE---') or ($label_hide_field_logs=='N') )
				{$INFOout .= "<div class='row'><div class='col font-weight-bold'>$label_email:</div><div class='col'> $row[21]</div></div>";

					//$INFOout .= "$label_email: &nbsp; $row[21]<br>";
		}
			//~ if ( ($label_security_phrase!='---HIDE---') or ($label_hide_field_logs=='N') )
				//~ {$INFOout .= "<tr><td>$label_security_phrase: &nbsp;$row[22]</td>";}
			if ( ($label_comments!='---HIDE---') or ($label_hide_field_logs=='N') )
				{ $INFOout .= "<div class='row'><div class='col font-weight-bold'>$label_comments:</div><div class='col'> $row[23]</div></div>";
				//	$INFOout .= "$label_comments: &nbsp; $row[23] <br>";
				}
			if ($hide_call_log_info=='N')
				{$INFOout .= "<div class='row'><div class='col font-weight-bold'>Called Count:</div><div class='col'> $row[24]</div></div>";
		}
			$INFOout .= "<div class='row'><div class='col font-weight-bold'>Last Call:</div><div class='col'> $row[25]</div></div>";


//					$INFOout .= ""._QXZ("Called Count:")." &nbsp; $row[24] <br>";
//			$INFOout .= ""._QXZ("Last Local Call Time123:")." &nbsp; $row[25]";
			
			//~ $INFOout .= "</div></div>":
			//end
			//ishwari
			//18-july-2018
	#		$INFOout .= "<tr bgcolor=white><td ALIGN=right><font class='sb_text'>Rank: &nbsp; </td><td ALIGN=left><font class='sb_text'>$row[26]</td></tr>";
	#		$INFOout .= "<tr bgcolor=white><td ALIGN=right><font class='sb_text'>Owner: &nbsp; </td><td ALIGN=left><font class='sb_text'>$row[27]</td></tr>";
	#		$INFOout .= "<tr bgcolor=white><td ALIGN=right><font class='sb_text'>Entry List ID: &nbsp; </td><td ALIGN=left><font class='sb_text'>$row[28]</td></tr>";

			$entry_list_id = $row[28];
			$CFoutput='';
			$stmt="SHOW TABLES LIKE \"custom_$entry_list_id\";";
			if ($DB>0) {$INFOout .= "$stmt";}
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00382',$user,$server_ip,$session_name,$one_mysql_log);}
			$tablecount_to_print = mysqli_num_rows($rslt);
			if ($tablecount_to_print > 0) 
				{
				$stmt="SELECT count(*) from custom_$entry_list_id where lead_id='$lead_id';";
				if ($DB>0) {$INFOout .= "$stmt";}
				$rslt=mysql_to_mysqli($stmt, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00383',$user,$server_ip,$session_name,$one_mysql_log);}
				$fieldscount_to_print = mysqli_num_rows($rslt);
				if ($fieldscount_to_print > 0) 
					{
					$rowx=mysqli_fetch_row($rslt);
					$custom_records_count =	$rowx[0];

					$select_SQL='';
					$stmt="SHOW COLUMNS FROM custom_$entry_list_id where Field != 'lead_id';";
					$rslt=mysql_to_mysqli($stmt, $link);
						if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00384',$user,$server_ip,$session_name,$one_mysql_log);}
					$fields_to_print = mysqli_num_rows($rslt);
					$select_SQL='';
					$o=0;
					while ($fields_to_print > $o) 
						{
						$rowx=mysqli_fetch_row($rslt);
						$select_SQL .= "$rowx[0],";
						$A_field_name[$o] = $rowx[0];
						$o++;
						}
					### gather encrypt and hide settings for custom fields
					$o=0;
					while ($fields_to_print > $o) 
						{
						$stmt="SELECT field_encrypt,field_show_hide FROM vicidial_lists_fields where list_id='$entry_list_id' and field_label='$A_field_name[$o]';";
						$rslt=mysql_to_mysqli($stmt, $link);
							if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00635',$user,$server_ip,$session_name,$one_mysql_log);}
						$fieldset_to_print = mysqli_num_rows($rslt);
						if ($fieldset_to_print > 0) 
							{
							$rowx=mysqli_fetch_row($rslt);
							$A_field_encrypt[$o] =		$rowx[0];
							$A_field_show_hide[$o] =	$rowx[1];
							}
						$o++;
						}
					$select_SQL = preg_replace("/.$/",'',$select_SQL);
					if (strlen($select_SQL) > 0)
						{
						$stmt="SELECT $select_SQL FROM custom_$entry_list_id where lead_id='$lead_id' LIMIT 1;";
						$rslt=mysql_to_mysqli($stmt, $link);
							if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00385',$user,$server_ip,$session_name,$one_mysql_log);}
						if ($DB) {$INFOout .= "$stmt\n";}
						$list_lead_ct = mysqli_num_rows($rslt);
						if ($list_lead_ct > 0)
							{
							$row=mysqli_fetch_row($rslt);
							$o=0;
							while ($fields_to_print > $o) 
								{
								$A_field_value		= trim("$row[$o]");
								if ($A_field_encrypt[$o] == 'Y')
									{$A_field_value = _QXZ("ENCRYPTED");}
								else
									{
									if ($A_field_show_hide[$o] != 'DISABLED')
										{
										$field_temp_val = $A_field_value;
										$A_field_value = preg_replace("/./",'X',$field_temp_val);
										}
									}
									$INFOout .= "<div class='row'><div class='col font-weight-bold'>$A_field_name[$o]:</div><div class='col'> $A_field_value</div></div>";
								//~ $INFOout .= "<tr bgcolor=white><td ALIGN=right><font class='sb_text'>$A_field_name[$o]: &nbsp; </td><td ALIGN=left><font class='sb_text'>$A_field_value</td></tr>";
								
								$o++;
								}
							}
						}
					}
				}
			}
			$INFOout .= "</div>";
		$INFOout .= "</p></div>";
		$INFOout .= "</div>";
		### END Display lead info and custom fields ###


		### BEGIN Gather Call Log and notes ###
		$NOTESout='';
		$NOTESout='<div style="display:none;" class="tab-pane fade active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" aria-expanded="false">';
						
		if ($hide_call_log_info=='N')
			{

			if ($search != 'logfirst')
				{$NOTESout .= "<b style='text-align:left;'>"._QXZ("CALL LOG FOR THIS LEAD:")."</b><br>\n";}
			// MIKE REMOVE $NOTESout .= "<div class=\"table-responsive\">";
			// MIKE REMOVE $NOTESout .= "<TABLE style='display: inline-block;overflow: scroll;' class=\"table table-striped table-sm table-responsive\">";
			// MIKE REMOVE $NOTESout .= "<TR>";
			// MIKE REMOVE $NOTESout .= "<TH > &nbsp; # &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center' > &nbsp; "._QXZ("DATE/TIME")." &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center'> &nbsp; "._QXZ("AGENT")." &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center'> &nbsp; "._QXZ("LENGTH")." &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center'> &nbsp; "._QXZ("STATUS")." &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center'> &nbsp; "._QXZ("PHONE")." &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center'> &nbsp; "._QXZ("CAMPAIGN")." &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center'> &nbsp; "._QXZ("IN/OUT")." &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center'> &nbsp; "._QXZ("ALT")." &nbsp; </TH>";
			// MIKE REMOVE $NOTESout .= "<TH style='font-size:12px; vertical-align:middle;' align='center'> &nbsp; "._QXZ("HANGUP")." &nbsp; </TH>";
		#	// MIKE REMOVE $NOTESout .= "</TR><TR>";
		#	// MIKE REMOVE $NOTESout .= "<TD BGCOLOR=\"#CCCCCC\" COLSPAN=9><font style=\"font-size:11px;font-family:sans-serif;\"><B> &nbsp; FULL NAME &nbsp; </font></TD>";
			// MIKE REMOVE $NOTESout .= "</TR>";
			

			$stmt="SELECT start_epoch,call_date,campaign_id,length_in_sec,status,phone_code,phone_number,lead_id,term_reason,alt_dial,comments,uniqueid,user from vicidial_log where lead_id='$lead_id' order by call_date desc limit 10000;";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00580',$user,$server_ip,$session_name,$one_mysql_log);}
			$out_logs_to_print = mysqli_num_rows($rslt);
			if ($format=='debug') {$NOTESout .= "|$out_logs_to_print|$stmt|";}

			$g=0;
			$u=0;
			while ($out_logs_to_print > $u) 
				{
				$row=mysqli_fetch_row($rslt);
				$ALLsort[$g] =			"$row[0]-----$g";
				$ALLstart_epoch[$g] =	$row[0];
				$ALLcall_date[$g] =		$row[1];
				$ALLcampaign_id[$g] =	$row[2];
				$ALLlength_in_sec[$g] =	$row[3];
				$ALLstatus[$g] =		$row[4];
				$ALLphone_code[$g] =	$row[5];
				$ALLphone_number[$g] =	$row[6];
				$ALLlead_id[$g] =		$row[7];
				$ALLhangup_reason[$g] =	$row[8];
				$ALLalt_dial[$g] =		$row[9];
				$ALLuniqueid[$g] =		$row[11];
				$ALLuser[$g] =			$row[12];
				$ALLin_out[$g] =		"OUT-AUTO";
				if ($row[10] == 'MANUAL') {$ALLin_out[$g] = "OUT-MANUAL";}

				$stmtA="SELECT call_notes FROM vicidial_call_notes WHERE lead_id='$ALLlead_id[$g]' and vicidial_id='$ALLuniqueid[$g]';";
				$rsltA=mysql_to_mysqli($stmtA, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00581',$user,$server_ip,$session_name,$one_mysql_log);}
				$out_notes_to_print = mysqli_num_rows($rslt);
				if ($out_notes_to_print > 0)
					{
					$rowA=mysqli_fetch_row($rsltA);
					$Allcall_notes[$g] =	$rowA[0];
					if (strlen($Allcall_notes[$g]) > 0)
						{$Allcall_notes[$g] =	"<b>NOTES: </b> $Allcall_notes[$g]";}
					}
				$stmtA="SELECT full_name FROM vicidial_users WHERE user='$ALLuser[$g]';";
				$rsltA=mysql_to_mysqli($stmtA, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00582',$user,$server_ip,$session_name,$one_mysql_log);}
				$users_to_print = mysqli_num_rows($rslt);
				if ($users_to_print > 0)
					{
					$rowA=mysqli_fetch_row($rsltA);
					$ALLuser[$g] .=	" - $rowA[0]";
					}

				$Allcounter[$g] =		$g;
				$g++;
				$u++;
				}

			$stmt="SELECT start_epoch,call_date,campaign_id,length_in_sec,status,phone_code,phone_number,lead_id,term_reason,queue_seconds,uniqueid,closecallid,user from vicidial_closer_log where lead_id='$lead_id' order by closecallid desc limit 10000;";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00583',$user,$server_ip,$session_name,$one_mysql_log);}
			$in_logs_to_print = mysqli_num_rows($rslt);
			if ($format=='debug') {$NOTESout .= "|$in_logs_to_print|$stmt|";}

			$u=0;
			while ($in_logs_to_print > $u) 
				{
				$row=mysqli_fetch_row($rslt);
				$ALLsort[$g] =			"$row[0]-----$g";
				$ALLstart_epoch[$g] =	$row[0];
				$ALLcall_date[$g] =		$row[1];
				$ALLcampaign_id[$g] =	$row[2];
				$ALLlength_in_sec[$g] =	($row[3] - $row[9]);
				if ($ALLlength_in_sec[$g] < 0) {$ALLlength_in_sec[$g]=0;}
				$ALLstatus[$g] =		$row[4];
				$ALLphone_code[$g] =	$row[5];
				$ALLphone_number[$g] =	$row[6];
				$ALLlead_id[$g] =		$row[7];
				$ALLhangup_reason[$g] =	$row[8];
				$ALLuniqueid[$g] =		$row[10];
				$ALLclosecallid[$g] =	$row[11];
				$ALLuser[$g] =			$row[12];
				$ALLalt_dial[$g] =		"MAIN";
				$ALLin_out[$g] =		"IN";

				$stmtA="SELECT call_notes FROM vicidial_call_notes WHERE lead_id='$ALLlead_id[$g]' and vicidial_id IN('$ALLuniqueid[$g]','$ALLclosecallid[$g]');";
				$rsltA=mysql_to_mysqli($stmtA, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00584',$user,$server_ip,$session_name,$one_mysql_log);}
				$in_notes_to_print = mysqli_num_rows($rslt);
				if ($in_notes_to_print > 0)
					{
					$rowA=mysqli_fetch_row($rsltA);
					$Allcall_notes[$g] =	$rowA[0];
					if (strlen($Allcall_notes[$g]) > 0)
						{$Allcall_notes[$g] =	"<b>"._QXZ("NOTES:")." </b> $Allcall_notes[$g]";}
					}
				$stmtA="SELECT full_name FROM vicidial_users WHERE user='$ALLuser[$g]';";
				$rsltA=mysql_to_mysqli($stmtA, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00585',$user,$server_ip,$session_name,$one_mysql_log);}
				$users_to_print = mysqli_num_rows($rslt);
				if ($users_to_print > 0)
					{
					$rowA=mysqli_fetch_row($rsltA);
					$ALLuser[$g] .=	" - $rowA[0]";
					}

				$Allcounter[$g] =		$g;

				$g++;
				$u++;
				}

			if ($g > 0)
				{rsort($ALLsort, SORT_NUMERIC);}
			else
				{$NOTESout .= "NO CALLS FOUND";}

			$u=0;
			$NOTESout .= '<div class="container text-left text-small">';
			while ($g > $u) 
				{
				$sort_split = explode("-----",$ALLsort[$u]);
				$i = $sort_split[1];

				if (preg_match("/1$|3$|5$|7$|9$/i", $u))
					{$bgcolor='bgcolor="#B9CBFD"';} 
				else
					{$bgcolor='bgcolor="#9BB9FB"';}

				$phone_number_display = $ALLphone_number[$i];
				if ($disable_alter_custphone == 'HIDE')
					{$phone_number_display = 'XXXXXXXXXX';}

				$u++;



			$NOTESout .= "<div class='row'>";
			$NOTESout .= "<div class='col-3'>$ALLcall_date[$i]</div>";
			$NOTESout .= "<div class='col-3'>$ALLuser[$i]</div>";
			$NOTESout .= "<div class='col-1'>$ALLlength_in_sec[$i]</div>";
			$NOTESout .= "<div class='col-1'>$ALLstatus[$i]</div>";
			$NOTESout .= "<div class='col-2'>$ALLphone_code[$i]$phone_number_display</div>";
			$NOTESout .= "<div class='col-2'>$ALLin_out[$i]</div>";
			$NOTESout .= '</div>';
			$NOTESout .= "<div class='row'>";
			$NOTESout .= "<div class='col'>$Allcall_notes[$i]</div>";
			
			$NOTESout .= '</div>';
			//	$NOTESout .= "<tr>";
			//	$NOTESout .= "<td><font size=1>$u</td>";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'>$ALLcall_date[$i]</td>";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'> $ALLuser[$i]</td>\n";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'> $ALLlength_in_sec[$i]</td>\n";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'> $ALLstatus[$i]</td>\n";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'> $ALLphone_code[$i]$phone_number_display </td>\n";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'> $ALLcampaign_id[$i] </td>\n";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'> $ALLin_out[$i] </td>\n";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'> $ALLalt_dial[$i] </td>\n";
			//	$NOTESout .= "<td align=center><font style='font-size:10px;' class='sb_text'> $ALLhangup_reason[$i] </td>\n";
			//	$NOTESout .= "</TR><TR>";
			//	$NOTESout .= "<td></td>";
			//	$NOTESout .= "<TD  COLSPAN=9 align=left><font style=\"font-size:11px;font-family:sans-serif;\"> $Allcall_notes[$i] </font></TD>";
			//	$NOTESout .= "</tr>\n";
				}
			$NOTESout .= '</div>';	
				$NOTESout .= '<br>';	
			$NOTESout .= "</TABLE>";
			$NOTESout .= "</div>";
			}
		### END Gather Call Log and notes ###

//mike block
			$allow_emails =0;
		### BEGIN Email log
		if ($allow_emails>0)
			{
			$NOTESout .= "<CENTER style='display:none;'>"._QXZ("EMAIL LOG FOR THIS LEAD:")."<br>\n";
			$NOTESout .= "<TABLE class=\"table table-striped table-sm table-responsive\">";
			$NOTESout .= "<TR>";
			$NOTESout .= "<td ><font style=\"font-size:10px;font-family:sans-serif;\"><B> # </B></font></td>";
			$NOTESout .= "<td  align=left><font style=\"font-size:11px;font-family:sans-serif;\"><B> &nbsp; "._QXZ("DATE/TIME")." </B></font></td>";
			$NOTESout .= "<td  align=left><font style=\"font-size:11px;font-family:sans-serif;\"><B> &nbsp; "._QXZ("AGENT")." </B></font></td>";
			$NOTESout .= "<td  align=left><font style=\"font-size:11px;font-family:sans-serif;\"><B> &nbsp; "._QXZ("CAMPAIGN")." </B></font></td>";
			$NOTESout .= "<td  align=left><font style=\"font-size:11px;font-family:sans-serif;\"><B> &nbsp; "._QXZ("EMAIL TO")." </B></font></td>";
			$NOTESout .= "<td  align=left><font style=\"font-size:11px;font-family:sans-serif;\"><B> &nbsp; "._QXZ("ATTACHMENTS")." </B></font></td>";
			$NOTESout .= "</tr>\n";


			$stmt="SELECT email_log_id,email_row_id,lead_id,email_date,user,email_to,message,campaign_id,attachments from vicidial_email_log where lead_id='$lead_id' order by email_date desc limit 500;";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00586',$user,$server_ip,$session_name,$one_mysql_log);}
			$logs_to_print = mysqli_num_rows($rslt);

			$u=0;
			while ($logs_to_print > $u) 
				{
				$row=mysqli_fetch_row($rslt);
				if (preg_match("/1$|3$|5$|7$|9$/i", $u))
					{$bgcolor='bgcolor="#B9CBFD"';} 
				else
					{$bgcolor='bgcolor="#9BB9FB"';}
				if (strlen($row[6])>400) {$row[6]=substr($row[6],0,400)."...";}
				$row[8]=preg_replace('/\|/', ', ', $row[8]);
				$row[8]=preg_replace('/,\s+$/', '', $row[8]);
				$u++;

				$NOTESout .= "<tr >";
				$NOTESout .= "<td><font size=1>$u</td>";
				$NOTESout .= "<td align=left><font class='sb_text'> &nbsp; $row[3]</td>";
				$NOTESout .= "<td align=left><font class='sb_text'> &nbsp; $row[4] </td>\n";
				$NOTESout .= "<td align=left><font class='sb_text'> &nbsp; $row[7]</td>\n";
				$NOTESout .= "<td align=left><font class='sb_text'> &nbsp; $row[5]</td>\n";
				$NOTESout .= "<td align=left><font size=1> &nbsp; $row[8] </td>\n";
				$NOTESout .= "</tr>\n";
				$NOTESout .= "<tr>";
				$NOTESout .= "<td><font size=1> &nbsp; </td>\n";
				$NOTESout .= "<td align=left colspan=5 ><font size=1> "._QXZ("MESSAGE:")." $row[6] </td>\n";
				$NOTESout .= "</tr>\n";
				}

			$NOTESout .= "</TABLE>";
			}
		### END Email Log ##

		if ($search == 'logfirst')
			{echo "$NOTESout\n$INFOout\n";}
		else
			{echo "$INFOout\n$NOTESout\n";}

		echo "</CENTER>";
		}
	}
	
################################################################################
### CalLBacKLisT - List the USERONLY callbacks for an agent
################################################################################
//ISHWARI
//30-july-2018
	
if (($ACTION == 'CalLBacKLisT_today') || ($ACTION =='CalLBacKLisT2') || ($ACTION =='CalLBacKLisT_future') || ($ACTION == 'LEADEditview') )
	{
	$campaignCBhoursSQL = '';
	$campaignCBdisplaydaysSQL = '';
	$stmt = "SELECT callback_hours_block,callback_list_calltime,local_call_time,callback_display_days from vicidial_campaigns where campaign_id='$campaign';";
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00437',$user,$server_ip,$session_name,$one_mysql_log);}
	if ($rslt) {$camp_count = mysqli_num_rows($rslt);}
	if ($camp_count > 0)
		{
		$row=mysqli_fetch_row($rslt);
		$callback_hours_block =		$row[0];
		$callback_list_calltime =	$row[1];
		$local_call_time =			$row[2];
		$callback_display_days =	$row[3];
		if ($callback_hours_block > 0)
			{
			$x_hours_ago = date("Y-m-d H:i:s", mktime(date("H")-$callback_hours_block,date("i"),date("s"),date("m"),date("d"),date("Y")));
			$campaignCBhoursSQL = "and entry_time < \"$x_hours_ago\"";
			}
		if ($callback_display_days > 0)
			{
			$x_days_from_now = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")+$callback_display_days,date("Y")));
			$campaignCBdisplaydaysSQL = "and callback_time < \"$x_days_from_now\"";
			}
		}
	$campaignCBsql = '';
	if ($agentonly_callback_campaign_lock > 0)
		{$campaignCBsql = "and vicidial_callbacks.campaign_id='$campaign'";}
	//ishwari
	$date_call =  date("Y-m-d");
	$yesterday = date("Y-m-d", strtotime("+1 day"));
	$tommorow = date("Y-m-d", strtotime("+1 day"));
	if($ACTION == 'CalLBacKLisT_today'){
	  $stmt = "SELECT callback_id,lead_id,campaign_id,status,entry_time,callback_time,comments,campaign_name, lead_status from vicidial_callbacks join vicidial_campaigns using (campaign_id) where recipient='USERONLY' and user='$user' $campaignCBsql $campaignCBhoursSQL $campaignCBdisplaydaysSQL and status NOT IN('INACTIVE','DEAD') and callback_time >='$date_call' and callback_time < '$yesterday' order by callback_time;";
	  }
	  
	 else if($ACTION == 'CalLBacKLisT2'){
	$date_call =  date("Y-m-d H:i:s");
	$stmt = "SELECT callback_id,lead_id,campaign_id,status,entry_time,callback_time,comments,campaign_name,lead_status from vicidial_callbacks join vicidial_campaigns using (campaign_id) where recipient='USERONLY' and user='$user' $campaignCBsql $campaignCBhoursSQL $campaignCBdisplaydaysSQL and status NOT IN('INACTIVE','DEAD')  and callback_time<'$date_call' order by callback_time;";
	 } else if($ACTION == 'CalLBacKLisT_future'){
	$stmt = "SELECT callback_id,lead_id,campaign_id,status,entry_time,callback_time,comments,campaign_name,lead_status from vicidial_callbacks join vicidial_campaigns using (campaign_id) where recipient='USERONLY' and user='$user' $campaignCBsql $campaignCBhoursSQL $campaignCBdisplaydaysSQL and status NOT IN('INACTIVE','DEAD') and callback_time > '$tommorow'  order by callback_time;";
	 }
	 else if($ACTION == 'LEADEditview'){
	 $stmt="UPDATE vicidial_callbacks SET modify_date= now(), callback_time='$callback_date', recipient = '$recipient' where callback_id='$callback_id' and user='$user' order by callback_time;";
	 if ($DB) {echo "$stmt\n";}
	 $rslt=mysql_to_mysqli($stmt, $link);
	 $row=mysqli_fetch_row($rslt);
	
	}
	 //~ else if($ACTION == 'LEADDelete'){
		//~ echo $stmt = "DELETE from vicidial_callbacks where callback_id='$callback_id' and user='$user';";
		//~ if ($DB) {echo "$stmt\n";}
		//~ $rslt=mysql_to_mysqli($stmt, $link);
		//~ $rows = mysqli_affected_rows($link);
	 //~ }
	 
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00178',$user,$server_ip,$session_name,$one_mysql_log);}
	if ($rslt) {$callbacks_count = mysqli_num_rows($rslt);}
	echo "$callbacks_count\n";
	$loop_count=0;
	while ($callbacks_count>$loop_count)
		{
		$row=mysqli_fetch_row($rslt);
		$callback_id[$loop_count]	= $row[0];
		$lead_id[$loop_count]		= $row[1];
		$campaign_id[$loop_count]	= $row[7];
		$status[$loop_count]		= $row[3];
		$entry_time[$loop_count]	= $row[4];
		$callback_time[$loop_count]	= $row[5];
		$comments[$loop_count]		= $row[6];
		$lead_status[$loop_count]	= $row[8];
		$loop_count++;
		}
	$loop_count=0;
	while ($callbacks_count>$loop_count)
		{
		$stmt = "SELECT first_name,last_name,phone_number,gmt_offset_now,state,list_id from vicidial_list where lead_id='$lead_id[$loop_count]';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00179',$user,$server_ip,$session_name,$one_mysql_log);}
		$row=mysqli_fetch_row($rslt);

		$PHONEdialable=1;
		if ($callback_list_calltime == 'ENABLED')
			{
			$state =		$row[4];
			$lead_list_id =	$row[5];
					
			### Get local_call_time for list
			$stmt="SELECT local_call_time,list_description FROM vicidial_lists where list_id='$lead_list_id';";
			$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00611',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$rslt_ct = mysqli_num_rows($rslt);
			if ($rslt_ct > 0)
				{
				$rowy=mysqli_fetch_row($rslt);
				$list_local_call_time =	$rowy[0];
				$list_description =		$rowy[1];
				}

			# check that call time exists
			if ($list_local_call_time != "campaign") 
				{
				$stmt="SELECT count(*) from vicidial_call_times where call_time_id='$list_local_call_time';";
				$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00616',$user,$server_ip,$session_name,$one_mysql_log);}					
				$row=mysqli_fetch_row($rslt);
				$call_time_exists  =	$row[0];
				if ($call_time_exists < 1) 
					{$list_local_call_time = 'campaign';}
				}

			#Check if we are with the gmt for campaign for $POSTdialable
			if ( (dialable_gmt($DB,$link,$local_call_time,$row[3],$row[4]) == 1) and ($list_local_call_time != "campaign") )
				{
				#Now check if we are with the GMT for the list local call time
				$PHONEdialable = dialable_gmt($DB,$link,$list_local_call_time,$row[3],$row[4]);
				}
			else
				{
				$PHONEdialable = dialable_gmt($DB,$link,$local_call_time,$row[3],$row[4]);
				}
			}
		$CBoutput = "$row[0]-!T-$row[1]-!T-$row[2]-!T-$callback_id[$loop_count]-!T-$lead_id[$loop_count]-!T-$campaign_id[$loop_count]-!T-"._QXZ("$status[$loop_count]")."-!T-$entry_time[$loop_count]-!T-$callback_time[$loop_count]-!T-$comments[$loop_count]-!T-$PHONEdialable-!T-$lead_status[$loop_count]";
		echo "$CBoutput\n";
		$loop_count++;
		}

	}

################################################################################
### SEARCHRESULTSview - display search results for lead search
################################################################################
if ($ACTION == 'SEARCHRESULTSview')
	{
	if (strlen($stage) < 3)
		{$stage = '670';}

	### find the screen_label for this campaign
	$stmt="SELECT screen_labels,hide_call_log_info from vicidial_campaigns where campaign_id='$campaign';";
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00727',$user,$server_ip,$session_name,$one_mysql_log);}
	$csl_to_print = mysqli_num_rows($rslt);
	if ($format=='debug') {echo "|$csl_to_print|$stmt|";}
	if ($csl_to_print > 0)
		{
		$row=mysqli_fetch_row($rslt);
		$screen_labels =		$row[0];
		$hide_call_log_info =	$row[1];
		}

	### BEGIN Display lead info and custom fields ###
	### BEGIN find any custom field labels ###
	$INFOout='';
	$label_title =				_QXZ(" Title");
	$label_first_name =			_QXZ("First");
	$label_middle_initial =		_QXZ("MI");
	$label_last_name =			_QXZ("Last ");
	$label_address1 =			_QXZ("Address1");
	$label_address2 =			_QXZ("Address2");
	$label_address3 =			_QXZ("Address3");
	$label_city =				_QXZ("City");
	$label_state =				_QXZ(" State");
	$label_province =			_QXZ("Province");
	$label_postal_code =		_QXZ("PostCode");
	$label_vendor_lead_code =	_QXZ("Vendor ID");
	$label_gender =				_QXZ(" Gender");
	$label_phone_number =		_QXZ("Phone");
	$label_phone_code =			_QXZ("DialCode");
	$label_alt_phone =			_QXZ("Alt. Phone");
	$label_security_phrase =	_QXZ("Show");
	$label_email =				_QXZ(" Email");
	$label_comments =			_QXZ(" Comments");

	$stmt="SELECT label_title,label_first_name,label_middle_initial,label_last_name,label_address1,label_address2,label_address3,label_city,label_state,label_province,label_postal_code,label_vendor_lead_code,label_gender,label_phone_number,label_phone_code,label_alt_phone,label_security_phrase,label_email,label_comments,label_hide_field_logs from system_settings;";
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00725',$user,$server_ip,$session_name,$one_mysql_log);}
	$row=mysqli_fetch_row($rslt);
	if (strlen($row[0])>0)	{$label_title =				$row[0];}
	if (strlen($row[1])>0)	{$label_first_name =		$row[1];}
	if (strlen($row[2])>0)	{$label_middle_initial =	$row[2];}
	if (strlen($row[3])>0)	{$label_last_name =			$row[3];}
	if (strlen($row[4])>0)	{$label_address1 =			$row[4];}
	if (strlen($row[5])>0)	{$label_address2 =			$row[5];}
	if (strlen($row[6])>0)	{$label_address3 =			$row[6];}
	if (strlen($row[7])>0)	{$label_city =				$row[7];}
	if (strlen($row[8])>0)	{$label_state =				$row[8];}
	if (strlen($row[9])>0)	{$label_province =			$row[9];}
	if (strlen($row[10])>0) {$label_postal_code =		$row[10];}
	if (strlen($row[11])>0) {$label_vendor_lead_code =	$row[11];}
	if (strlen($row[12])>0) {$label_gender =			$row[12];}
	if (strlen($row[13])>0) {$label_phone_number =		$row[13];}
	if (strlen($row[14])>0) {$label_phone_code =		$row[14];}
	if (strlen($row[15])>0) {$label_alt_phone =			$row[15];}
	if (strlen($row[16])>0) {$label_security_phrase =	$row[16];}
	if (strlen($row[17])>0) {$label_email =				$row[17];}
	if (strlen($row[18])>0) {$label_comments =			$row[18];}
	$label_hide_field_logs =	$row[19];

	if ( ($screen_labels != '--SYSTEM-SETTINGS--') and (strlen($screen_labels)>1) )
		{
		$stmt="SELECT label_title,label_first_name,label_middle_initial,label_last_name,label_address1,label_address2,label_address3,label_city,label_state,label_province,label_postal_code,label_vendor_lead_code,label_gender,label_phone_number,label_phone_code,label_alt_phone,label_security_phrase,label_email,label_comments,label_hide_field_logs from vicidial_screen_labels where label_id='$screen_labels' and active='Y' limit 1;";
		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00726',$user,$server_ip,$session_name,$one_mysql_log);}
		$screenlabels_count = mysqli_num_rows($rslt);
		if ($screenlabels_count > 0)
			{
			$row=mysqli_fetch_row($rslt);
			if (strlen($row[0])>0)	{$label_title =				$row[0];}
			if (strlen($row[1])>0)	{$label_first_name =		$row[1];}
			if (strlen($row[2])>0)	{$label_middle_initial =	$row[2];}
			if (strlen($row[3])>0)	{$label_last_name =			$row[3];}
			if (strlen($row[4])>0)	{$label_address1 =			$row[4];}
			if (strlen($row[5])>0)	{$label_address2 =			$row[5];}
			if (strlen($row[6])>0)	{$label_address3 =			$row[6];}
			if (strlen($row[7])>0)	{$label_city =				$row[7];}
			if (strlen($row[8])>0)	{$label_state =				$row[8];}
			if (strlen($row[9])>0)	{$label_province =			$row[9];}
			if (strlen($row[10])>0) {$label_postal_code =		$row[10];}
			if (strlen($row[11])>0) {$label_vendor_lead_code =	$row[11];}
			if (strlen($row[12])>0) {$label_gender =			$row[12];}
			if (strlen($row[13])>0) {$label_phone_number =		$row[13];}
			if (strlen($row[14])>0) {$label_phone_code =		$row[14];}
			if (strlen($row[15])>0) {$label_alt_phone =			$row[15];}
			if (strlen($row[16])>0) {$label_security_phrase =	$row[16];}
			if (strlen($row[17])>0) {$label_email =				$row[17];}
			if (strlen($row[18])>0) {$label_comments =			$row[18];}
			$label_hide_field_logs =	$row[19];
			### END find any custom field labels ###
			$hide_gender=0;
			if ($label_gender == '---HIDE---')
				{$hide_gender=1;}
			}
		}
	### END find any custom field labels ###
	
	$stmt="SELECT agent_lead_search_method,manual_dial_list_id from vicidial_campaigns where campaign_id='$campaign';";
	if ($non_latin > 0) {$rslt=mysql_to_mysqli("SET NAMES 'UTF8'", $link);}
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00374',$user,$server_ip,$session_name,$one_mysql_log);}
	$camps_to_print = mysqli_num_rows($rslt);
	if ($camps_to_print > 0) 
		{
		$row=mysqli_fetch_row($rslt);
		$agent_lead_search_method =		$row[0];
		$manual_dial_list_id =			$row[1];

		$searchSQL='';
		$searchmethodSQL='';
	
		$lead_id=preg_replace("/[^0-9]/","",$lead_id);
		$vendor_lead_code = preg_replace("/\"|\\\\|;/","",$vendor_lead_code);
		$last_name = preg_replace("/\"|\\\\|;/","",$last_name);
		$first_name = preg_replace("/\"|\\\\|;/","",$first_name);
		$city = preg_replace("/\"|\\\\|;/","",$city);
		$state = preg_replace("/\"|\\\\|;/","",$state);
		$postal_code = preg_replace("/\"|\\\\|;/","",$postal_code);

		if (strlen($lead_id) > 0)
			{
			### lead ID entered, search by this
			$searchSQL = "lead_id='$lead_id'";
			}
		elseif (strlen($vendor_lead_code) > 0)
			{
			### vendor ID entered, search by this
			$searchSQL = "vendor_lead_code=\"$vendor_lead_code\"";
			}
		elseif ( (strlen($phone_number) >= 6) and (strlen($search) > 2) )
			{
			### phone number entered, search by this
			if (preg_match('/MAIN|ALT|ADDR3/',$search))
				{$searchSQL = "(";}
			if (preg_match('/MAIN/',$search))
				{$searchSQL .= "phone_number='$phone_number'";}
			if (preg_match('/ALT/',$search))
				{
				if (strlen($searchSQL) > 10)
					{$searchSQL .= " or ";}
				$searchSQL .= "alt_phone='$phone_number'";
				}
			if (preg_match('/ADDR3/',$search))
				{
				if (strlen($searchSQL) > 10)
					{$searchSQL .= " or ";}
				$searchSQL .= "address3='$phone_number'";
				}
			if (strlen($searchSQL) > 10)
				{$searchSQL .= ")";}
			}
		elseif (strlen($last_name) > 0)
			{
			### last name entered, search by this and other fields
			$searchSQL = "last_name=\"$last_name\"";
			if (strlen($first_name) > 0)
				{
				if (strlen($searchSQL) > 10)
					{$searchSQL .= " and ";}
				$searchSQL .= "first_name=\"$first_name\"";
				}
			if (strlen($city) > 0)
				{
				if (strlen($searchSQL) > 10)
					{$searchSQL .= " and ";}
				$searchSQL .= "city=\"$city\"";
				}
			if (strlen($state) > 0)
				{
				if (strlen($searchSQL) > 10)
					{$searchSQL .= " and ";}
				$searchSQL .= "state=\"$state\"";
				}
			if (strlen($postal_code) > 0)
				{
				if (strlen($searchSQL) > 10)
					{$searchSQL .= " and ";}
				$searchSQL .= "postal_code=\"$postal_code\"";
				}
			}
		else
			{
			echo _QXZ("ERROR").": "._QXZ("You must enter a valid Lead ID, Vendor ID or Phone Number")."\n";

			if ($SSagent_debug_logging > 0) {vicidial_ajax_log($NOW_TIME,$startMS,$link,$ACTION,$php_script,$user,$stage,$lead_id,$session_name,$stmt);}
			exit;
			}

		$searchownerSQL='';
		### limit results to specified search method
		# USER_, GROUP_, TERRITORY_
		if (preg_match('/USER_/',$agent_lead_search_method))
			{$searchownerSQL=" and owner='$user'";}
		if (preg_match('/GROUP_/',$agent_lead_search_method))
			{
			$stmt="SELECT user_group from vicidial_users where user='$user';";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00386',$user,$server_ip,$session_name,$one_mysql_log);}
			$groups_to_parse = mysqli_num_rows($rslt);
			if ($groups_to_parse > 0) 
				{
				$rowx=mysqli_fetch_row($rslt);
				$searchownerSQL=" and owner='$rowx[0]'";
				}
			}
		if (preg_match('/TERRITORY_/',$agent_lead_search_method))
			{
			$agent_territories='';
			$agent_choose_territories=0;
			$stmt="SELECT agent_choose_territories from vicidial_users where user='$user';";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00404',$user,$server_ip,$session_name,$one_mysql_log);}
			$Uterrs_to_parse = mysqli_num_rows($rslt);
			if ($Uterrs_to_parse > 0) 
				{
				$rowx=mysqli_fetch_row($rslt);
				$agent_choose_territories = $rowx[0];
				}

			if ($agent_choose_territories < 1)
				{
				$stmt="SELECT territory from vicidial_user_territories where user='$user';";
				$rslt=mysql_to_mysqli($stmt, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00405',$user,$server_ip,$session_name,$one_mysql_log);}
				$vuts_to_parse = mysqli_num_rows($rslt);
				$o=0;
				while ($vuts_to_parse > $o) 
					{
					$rowx=mysqli_fetch_row($rslt);
					$agent_territories .= "'$rowx[0]',";
					$o++;
					}
				$agent_territories = preg_replace("/\,$/",'',$agent_territories);
				$searchownerSQL=" and owner IN($agent_territories)";
				if ($vuts_to_parse < 1)
					{$searchownerSQL=" and lead_id < 0";}
				}
			else
				{
				$stmt="SELECT agent_territories from vicidial_live_agents where user='$user';";
				$rslt=mysql_to_mysqli($stmt, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00387',$user,$server_ip,$session_name,$one_mysql_log);}
				$terrs_to_parse = mysqli_num_rows($rslt);
				if ($terrs_to_parse > 0) 
					{
					$rowx=mysqli_fetch_row($rslt);
					$agent_territories = $rowx[0];
					$agent_territories = preg_replace("/ -$|^ /",'',$agent_territories);
					$agent_territories = preg_replace("/ /","','",$agent_territories);
					$searchownerSQL=" and owner IN('$agent_territories')";
					}
				}
			}

		### limit results to specified search method
		# 'SYSTEM','CAMPAIGNLISTS','CAMPLISTS_ALL','LIST'
		if (preg_match('/SYSTEM/',$agent_lead_search_method))
			{$searchmethodSQL='';}
		if (preg_match('/LIST/',$agent_lead_search_method))
			{$searchmethodSQL=" and list_id='$manual_dial_list_id'";}
		if (preg_match('/CAMPLISTS_ALL/',$agent_lead_search_method))
			{
			$stmt="SELECT list_id from vicidial_lists where campaign_id='$campaign';";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00375',$user,$server_ip,$session_name,$one_mysql_log);}
			$lists_to_parse = mysqli_num_rows($rslt);
			$camp_lists='';
			$o=0;
			while ($lists_to_parse > $o) 
				{
				$rowx=mysqli_fetch_row($rslt);
				$camp_lists .= "'$rowx[0]',";
				$o++;
				}
			$camp_lists = preg_replace("/.$/i","",$camp_lists);
			if (strlen($camp_lists)<2) {$camp_lists="''";}
			$searchmethodSQL=" and list_id IN($camp_lists)";
			}
		if (preg_match('/CAMPAIGNLISTS/',$agent_lead_search_method))
			{
			$stmt="SELECT list_id,active from vicidial_lists where campaign_id='$campaign' and active='Y';";
			$rslt=mysql_to_mysqli($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00376',$user,$server_ip,$session_name,$one_mysql_log);}
			$lists_to_parse = mysqli_num_rows($rslt);
			$camp_lists='';
			$o=0;
			while ($lists_to_parse > $o) 
				{
				$rowx=mysqli_fetch_row($rslt);
				$camp_lists .= "'$rowx[0]',";
				$o++;
				}
			$camp_lists = preg_replace("/.$/i","",$camp_lists);
			if (strlen($camp_lists)<2) {$camp_lists="''";}
			$searchmethodSQL=" and list_id IN($camp_lists)";
			}


		##### BEGIN search queries and output #####
		$stmt="SELECT count(*) from vicidial_list where $searchSQL $searchownerSQL $searchmethodSQL;";

		### LOG INSERTION Search Log Table ###
		$SQL_log = "$stmt|";
		$SQL_log = preg_replace('/;/','',$SQL_log);
		$SQL_log = addslashes($SQL_log);
		$stmtL="INSERT INTO vicidial_lead_search_log set event_date='$NOW_TIME', user='$user', source='agent', results='0', search_query=\"$SQL_log\";";
		if ($DB) {echo "|$stmtL|\n";}
		$rslt=mysql_to_mysqli($stmtL, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00377',$user,$server_ip,$session_name,$one_mysql_log);}
		$search_log_id = mysqli_insert_id($link);

		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00378',$user,$server_ip,$session_name,$one_mysql_log);}
		$counts_to_print = mysqli_num_rows($rslt);
		if ($counts_to_print > 0) 
			{
			$row=mysqli_fetch_row($rslt);
			$search_result_count =		$row[0];

			$end_process_time = date("U");
			$search_seconds = ($end_process_time - $StarTtime);

			$stmtL="UPDATE vicidial_lead_search_log set results='$search_result_count',seconds='$search_seconds' where search_log_id='$search_log_id';";
			if ($DB) {echo "|$stmtL|\n";}
			$rslt=mysql_to_mysqli($stmtL, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00379',$user,$server_ip,$session_name,$one_mysql_log);}



			if ($search_result_count)
				{
				$stmt="SELECT first_name,last_name,phone_code,phone_number,status,last_local_call_time,lead_id,city,state,postal_code,vendor_lead_code from vicidial_list where $searchSQL $searchownerSQL $searchmethodSQL order by last_local_call_time desc limit 1000;";
				$rslt=mysql_to_mysqli($stmt, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00380',$user,$server_ip,$session_name,$one_mysql_log);}
				$out_logs_to_print = mysqli_num_rows($rslt);
				if ($format=='debug') {echo "|$out_logs_to_print|$stmt|";}

				$g=0;
				$u=0;
				while ($out_logs_to_print > $u) 
					{
					$row=mysqli_fetch_row($rslt);
					$ALLsort[$g] =				"$row[0]-----$g";
					$ALLname[$g] =				"$row[0] $row[1]";
					$ALLphone_code[$g] =		$row[2];
					$ALLphone_number[$g] =		$row[3];
					$ALLstatus[$g] =			$row[4];
					$ALLcall_date[$g] =			$row[5];
					$ALLlead_id[$g] =			$row[6];
					$ALLcity[$g] =				$row[7];
					$ALLstate[$g] =				$row[8];
					$ALLpostal_code[$g] =		$row[9];
					$ALLvendor_lead_code[$g] =	$row[10];

					$g++;
					$u++;
					}
 
///kieran
  $search_results .="<div class='table-responsive' style='overflow: auto;height: 400px'>";
  $search_results .='<table id="call_log" class="table table-bordered table-sm text-small" ><thead><tr>';
	 $search_results .='<th style="width:20%;">Client Name</th>';
		 $search_results .='<th>Phone</th>';
		 $search_results .='<th>Status</th>';
		 $search_results .='<th>Call Date</th>';
		 $search_results .='<th>Post Code</th>';
		 $search_results .='<th>Vendor Lead Code</th>';
		 $search_results .='<th colspan="2">Actions</th></tr></thead>';
				if ($g < 1)
				
					{echo _QXZ("ERROR").": "._QXZ("No results found")."\n";}

				$u=0;
				while ($g > $u) 
					{
					$sort_split = explode("-----",$ALLsort[$u]);
					$i = $sort_split[1];

					if (preg_match("/1$|3$|5$|7$|9$/i", $u))
						{$bgcolor='bgcolor="#B9CBFD"';} 
					else
						{$bgcolor='bgcolor="#9BB9FB"';}

					$u++;
					
                  					
					$search_results .= '<tr style="vertical-align: middle;">';
					$search_results .= "<td style='vertical-align: middle;'>$ALLname[$i] </td>";
					$search_results .= "<td style='vertical-align: middle;'> $ALLphone_code[$i] $ALLphone_number[$i] </td>";
					$search_results .= "<td style='vertical-align: middle;'> $ALLstatus[$i] </td>";
					$search_results .= "<td style='vertical-align: middle;'> $ALLcall_date[$i] </td>";
					$search_results .= "<td style='vertical-align: middle;'> $ALLpostal_code[$i] </td>";
					$search_results .= "<td style='vertical-align: middle;'> $ALLvendor_lead_code[$i] </td>";
					$search_results .= "<td> <a class='btn btn-sm btn-primary text-white' onclick=\"VieWLeaDInfO_btx($ALLlead_id[$i]);\" title='View Info'><i class='fas fa-search fa-fw'></i></a></td>";
					if ($inbound_lead_search < 1)
						{
						if ($manual_dial_filter > 0)
							{$search_results .= "<td> <a onclick=\"NeWManuaLDiaLCalL('LEADSEARCH','$ALLphone_code[$i]','$ALLphone_number[$i]','$ALLlead_id[$i]','','YES');\" class='btn btn-sm btn-success text-white' title='Dial Now' ><i class='fas fa-phone fa-fw'></i></a>

						</td>";}
						//else
						//	{echo "<div class='col'> "._QXZ("DIAL")." </div>";} 
						}
					else
						{
							$search_results .= "<td> <a onclick=\"LeaDSearcHSelecT('$ALLlead_id[$i]');$('#btx_search_res').html('');$('#btx_search_phone').val('');$('#btx_search_lead_id').val('');$('#btx_search_vlc').val('');\" class='btn btn-sm btn-success text-white' title='Merge' ><i class='fas fa-random fa-fw'></i></a></td>";
						}
					$search_results .= "</tr>";
					}

				$end_process_time = date("U");
				$search_seconds = ($end_process_time - $StarTtime);

				$stmtL="UPDATE vicidial_lead_search_log set seconds='$search_seconds' where search_log_id='$search_log_id';";
				if ($DB) {echo "|$stmtL|\n";}
				$rslt=mysql_to_mysqli($stmtL, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtL,'00381',$user,$server_ip,$session_name,$one_mysql_log);}
				}
			else
				
			     {echo _QXZ("ERROR").": "._QXZ("No results found")."\n";}


			}
		else
			{
			echo _QXZ("ERROR").": "._QXZ("There was a problem with your search terms")."\n";

			if ($SSagent_debug_logging > 0) {vicidial_ajax_log($NOW_TIME,$startMS,$link,$ACTION,$php_script,$user,$stage,$lead_id,$session_name,$stmt);}
			exit;
			}
				$search_results .= "</table></div>";
				echo $search_results ;
		##### END search queries and output #####
		}
	else
		{
		echo _QXZ("ERROR").": "._QXZ("Campaign not found")."\n";

		if ($SSagent_debug_logging > 0) {vicidial_ajax_log($NOW_TIME,$startMS,$link,$ACTION,$php_script,$user,$stage,$lead_id,$session_name,$stmt);}
		exit;
		}
	}


################################################################################
### AGENTSview - List statuses of other agents in sidebar or xfer frame
################################################################################
if ($ACTION == 'AGENTSview')
	{
	$stmt="SELECT user_group from vicidial_users where user='$user';";
	if ($non_latin > 0) {$rslt=mysql_to_mysqli("SET NAMES 'UTF8'", $link);}
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00573',$user,$server_ip,$session_name,$one_mysql_log);}
	$row=mysqli_fetch_row($rslt);
	$VU_user_group =	$row[0];

	$agent_status_viewable_groupsSQL='';
	### Gather timeclock and shift enforcement restriction settings
	$stmt="SELECT agent_status_viewable_groups,agent_status_view_time from vicidial_user_groups where user_group='$VU_user_group';";
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00574',$VD_login,$server_ip,$session_name,$one_mysql_log);}
	$row=mysqli_fetch_row($rslt);
	$agent_status_viewable_groups = $row[0];
	$agent_status_viewable_groupsSQL = preg_replace('/\s\s/i','',$agent_status_viewable_groups);
	$agent_status_viewable_groupsSQL = preg_replace('/\s/i',"','",$agent_status_viewable_groupsSQL);
	$agent_status_viewable_groupsSQL = "user_group IN('$agent_status_viewable_groupsSQL')";
	$agent_status_view = 0;
	if (strlen($agent_status_viewable_groups) > 2)
		{$agent_status_view = 1;}
	$agent_status_view_time=0;
	if ($row[1] == 'Y')
		{$agent_status_view_time=1;}
	$andSQL='';
	if (preg_match("/ALL-GROUPS/",$agent_status_viewable_groups))
		{$AGENTviewSQL = "";}
	else
		{
		$AGENTviewSQL = "($agent_status_viewable_groupsSQL)";

		if (preg_match("/CAMPAIGN-AGENTS/",$agent_status_viewable_groups))
			{$AGENTviewSQL = "($AGENTviewSQL or (campaign_id='$campaign'))";}
		$AGENTviewSQL = "and $AGENTviewSQL";
		}
	if ($comments=='AgentXferViewSelect') 
		{
		if ($status == 'Y')
			{
			$AGENTviewSQL .= " and (vla.closer_campaigns LIKE \"% $group_name %\")";
			}
		else
			{
			$AGENTviewSQL .= " and (vla.closer_campaigns LIKE \"%AGENTDIRECT%\")";
			}
		}


	echo "<TABLE CELLPADDING=0 CELLSPACING=1 STYLE='width:100%;'>";
	### Gather agents data and statuses
	$agentviewlistSQL='';
	$j=0;
	$stmt="SELECT vla.user,vla.status,vu.full_name,UNIX_TIMESTAMP(last_call_time),UNIX_TIMESTAMP(last_call_finish),UNIX_TIMESTAMP(last_state_change), custom_one from vicidial_live_agents vla,vicidial_users vu where vla.user=vu.user and vla.user != '$user' $AGENTviewSQL order by vu.full_name;";
	$rslt=mysql_to_mysqli($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00227',$VD_login,$server_ip,$session_name,$one_mysql_log);}
	if ($rslt) {$agents_count = mysqli_num_rows($rslt);}
	$loop_count=0;
	while ($agents_count > $loop_count)
		{
		$row=mysqli_fetch_row($rslt);
		$user =			$row[0];
		$status =		$row[1];
		$full_name =	substr($row[2], 0, 15);
		$call_start =	$row[3];
		$call_finish =	$row[4];
		$state_change = $row[5];
		$picture = $row[6];


		
		$agentviewlistSQL .= "'$user',";

		if ( ($status=='READY') or ($status=='CLOSER') ) 
			{
			$statuscolor='#0073b7';
			$call_time = ($StarTtime - $state_change);
			}
		if ( ($status=='QUEUE') or ($status=='INCALL') ) 
			{
			$statuscolor='#00a65a';
			$call_time = ($StarTtime - $state_change);
			}
		if ($status=='PAUSED') 
			{
			$statuscolor='#605ca8';
			$call_time = ($StarTtime - $state_change);
			}

		if ($call_time < 1)
			{
			$call_time = "0:00";
			echo $call_time;
			}
		else
			{

			$Fminutes_M = ($call_time / 60);
			$Fminutes_M_int = floor($Fminutes_M);
			$Fminutes_M_int = intval("$Fminutes_M_int");
			$Fminutes_S = ($Fminutes_M - $Fminutes_M_int);
			$Fminutes_S = ($Fminutes_S * 60);
			$Fminutes_S = round($Fminutes_S, 0);
			if ($Fminutes_S < 10) {$Fminutes_S = "0$Fminutes_S";}
			$call_time = "$Fminutes_M_int:$Fminutes_S";
			}

		if ($comments=='AgentXferViewSelect') 
			{
			$AXVSuserORDER[$j] =	"$full_name$US$j";
			$AXVSuser[$j] =			$user;
			$AXVSfull_name[$j] =	$full_name;
			$AXVScall_time[$j] =	$call_time;
			$AXVSstatuscolor[$j] =	$statuscolor;
			$AXVSpicture[$j] =	$picture;
			$j++;
			}
		else
			{
			echo "<TR BGCOLOR=\"$statuscolor\"><TD><font style=\"font-size: 12px;  font-family: sans-serif; color:#FFFFFF\"> &nbsp; ";
			echo substr($row[2], 0, 15);;
			echo "&nbsp;</font></TD>";
			if ($agent_status_view_time > 0)
				{echo "<TD><font style=\"font-size: 12px;  font-family: sans-serif; color:#FFFFFF\"> &nbsp; $call_time &nbsp;</font></TD>";}
			echo "</TR>";
			}
		$loop_count++;
		}
	$agentviewlistSQL = preg_replace("/.$/i","",$agentviewlistSQL);
	if (strlen($agentviewlistSQL)<3)
		{$agentviewlistSQL = "''";}

	if (preg_match("/NOT-LOGGED-IN-AGENTS/",$agent_status_viewable_groups))
		{
		$stmt="SELECT user,full_name from vicidial_users where user NOT IN($agentviewlistSQL) order by full_name;";
		$rslt=mysql_to_mysqli($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00301',$VD_login,$server_ip,$session_name,$one_mysql_log);}
		if ($rslt) {$agents_count = mysqli_num_rows($rslt);}
		$loop_count=0;
		while ($agents_count > $loop_count)
			{
			$row=mysqli_fetch_row($rslt);
			$user =			$row[0];
			$full_name =	$row[1];

			if ($comments=='AgentXferViewSelect') 
				{
				$AXVSuserORDER[$j] =	"$full_name$US$j";
				$AXVSuser[$j] =			$user;
				$AXVSfull_name[$j] =	$full_name;
				$AXVScall_time[$j] =	'0:00';
				$AXVSstatuscolor[$j] =	'white';
				$j++;
				}
			else
				{
				echo "<TR BGCOLOR=\"white\"><TD><font style=\"font-size: 12px;  font-family: sans-serif;\"> &nbsp; ";
				echo substr($full_name, 0, 15);
				echo "&nbsp;</font></TD>";
				if ($agent_status_view_time > 0)
					{echo "<TD><font style=\"font-size: 12px;  font-family: sans-serif;\">&nbsp; 0:00 &nbsp;</font></TD>";}
				echo "</TR>";
				}
			$loop_count++;
			}
		}

	### BEGIN Display the agent transfer select view ###
	$k=0;
	if ($comments=='AgentXferViewSelect') 
		{
		echo "<div class ='row'>";

		$AXVSrecords=100;
		$AXVScolumns=1;
		$AXVSfontsize='12px';
		if ($j > 30) {$AXVScolumns++;}
		if ($j > 60) {$AXVScolumns++;   $AXVSfontsize='11px';}
		if ($j > 90) {$AXVScolumns++;   $AXVSfontsize='10px';}
		if ($j > 120) {$AXVScolumns++;   $AXVSfontsize='9px';}
		$AXVSrecords = ($j / $AXVScolumns);
		$AXVSrecords = round($AXVSrecords, 0);
		$m=0;

		sort($AXVSuserORDER);


		while ($j > $k)
			{
				//echo $AXVSuserORDER[$k];
			$order_split = explode("_",$AXVSuserORDER[$k]);
			$i = $order_split[1];


//echo $AXVSpicture[0];
$picturebits = explode("-", $AXVSpicture[$i]);

//echo $picturebits[3];
//echo substr($AXVSpicture, 0, 2);

if (($picturebits[3]=='Y') && (substr($AXVSpicture[$i], 0, 3)=='BTX'))
{
	
	
echo "<div class='col-3 text-center m-1 rounded' style='background-color: $AXVSstatuscolor[$i]; color:white;'>";
echo "<br><button id ='profile_image_placeholder' class='btn btn-block  btn-dark' style='height: 90px;' onclick=\"AgentsXferSelect('$AXVSuser[$i]','AgentXferViewSelect');agent_transfer_option_clicked('".$AXVSfull_name[$i]."');\"><img id='btx_user_profile_img' class='img-fluid rounded mx-auto d-block' src='".$picturebits[2]."' style='height : 75px;'></button></br>".$AXVSfull_name[$i]."<br>".$AXVScall_time[$i];
echo "<br><br></div>";
}
else
{

echo "<div class='col-3 text-center m-1 rounded' style='background-color: $AXVSstatuscolor[$i]; color:white;'>";
echo "<br><button id ='profile_image_placeholder' class='btn btn-block  btn-dark' style='height: 90px;' onclick=\"AgentsXferSelect('$AXVSuser[$i]','AgentXferViewSelect');agent_transfer_option_clicked('".$AXVSfull_name[$i]."');\"><i class='fas fa-user fa-4x' style='vertical-align: middle !important;'></i></button></br>".$AXVSfull_name[$i]."<br>".$AXVScall_time[$i];
echo "<br><br></div>";


}
			$k++;
			$m++;

			}
		echo "</div>";
		}

	

	}
?>
