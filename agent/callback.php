<?php
	//~ include "vicidial.php";
	require_once("dbconnect_mysqli.php");
	require_once("functions.php");
	
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
	
################################################################################
### CALLLOGview - display one day calls for an agent
################################################################################
if (($date) == 'undefined'){

$NOW_DATE = date("Y-m-d");
	$date = $NOW_DATE;
}
	$stmt="SELECT start_epoch,call_date,campaign_id,length_in_sec,status,phone_code,phone_number,lead_id,term_reason,alt_dial,comments from vicidial_log where user='$user' and call_date >= '$date 0:00:00'  and call_date <= '$date 23:59:59' order by call_date desc limit 10000;";
	$rslt=mysql_to_mysqli($stmt, $link);
		//if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00576',$user,$server_ip,$session_name,$one_mysql_log);}
	$out_logs_to_print = mysqli_num_rows($rslt);
	//if ($format=='debug') {echo "|$out_logs_to_print|$stmt|";}

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
		$ALLin_out[$g] =		"OUT-AUTO";
		if ($row[10] == 'MANUAL') {$ALLin_out[$g] = "OUT-MANUAL";}

		$stmtA="SELECT first_name,last_name FROM vicidial_list WHERE lead_id='$ALLlead_id[$g]';";
		$rsltA=mysql_to_mysqli($stmtA, $link);
			//if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00577',$user,$server_ip,$session_name,$one_mysql_log);}
		$rowA=mysqli_fetch_row($rsltA);
		$Allfirst_name[$g] =	$rowA[0];
		$Alllast_name[$g] =		$rowA[1];

		$g++;
		$u++;
		}

	$stmt="SELECT start_epoch,call_date,campaign_id,length_in_sec,status,phone_code,phone_number,lead_id,term_reason,queue_seconds from vicidial_closer_log where user='$user' and call_date >= '$date 0:00:00'  and call_date <= '$date 23:59:59' order by call_date desc limit 10000;";
	$rslt=mysql_to_mysqli($stmt, $link);
		//if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00578',$user,$server_ip,$session_name,$one_mysql_log);}
	$in_logs_to_print = mysqli_num_rows($rslt);
	//if ($format=='debug') {echo "|$in_logs_to_print|$stmt|";}

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
		$ALLalt_dial[$g] =		"MAIN";
		$ALLin_out[$g] =		"IN";

		$stmtA="SELECT first_name,last_name FROM vicidial_list WHERE lead_id='$ALLlead_id[$g]';";
		$rsltA=mysql_to_mysqli($stmtA, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00579',$user,$server_ip,$session_name,$one_mysql_log);}
		$rowA=mysqli_fetch_row($rsltA);
		$Allfirst_name[$g] =	$rowA[0];
		$Alllast_name[$g] =		$rowA[1];

		$g++;
		$u++;
		}

	if ($g > 0)
		{sort($ALLsort, SORT_NUMERIC);}
	else
		//{echo "<tr bgcolor=white><td colspan=11 align=center>"._QXZ("No calls on this day")."</td></tr>";}
		{echo "<tr><td colspan=11 align=center>"._QXZ("No calls on this day")."</td></tr>";}

	$u=0;
	$i=0;
	while ($g > $u) 
		{
		$ALLsort[$u];
		$sort_split = explode("-----",$ALLsort[$u]);
		//~ $i = $sort_split[1];

		$phone_number_display = $ALLphone_number[$i];
		if ($disable_alter_custphone == 'HIDE')
			{$phone_number_display = 'XXXXXXXXXX';}
		$u++;
	echo 	"<tr>";
						echo "<td>$ALLcall_date[$i]</td>";
						echo "<td>$Allfirst_name[$i] $Alllast_name[$i]</td>";
						echo "<td>$ALLphone_code[$i] $phone_number_display</td>";
						echo "<td>$ALLlength_in_sec[$i]</td>";
						echo "<td>$ALLstatus[$i]</td>";
						echo "<td>
							<a class='btn btn-sm btn-primary text-white' title='View Info' onclick=\"VieWLeaDInfO_btx($ALLlead_id[$i]);\"><i class='fas fa-search fa-fw'></i></a></td><td>
							<a onclick=\"NeWManuaLDiaLCalL('CALLLOG','$ALLphone_code[$i]','$ALLphone_number[$i]','$ALLlead_id[$i]','','YES');\" class='btn btn-sm btn-success text-white' title='Dial Now' ><i class='fas fa-phone fa-fw'></i></a>
							
						</td>";
					echo '</tr>';	
		$i++;
		
		 } ?>									
