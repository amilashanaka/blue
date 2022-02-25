<!DOCTYPE html>
<html>
<head>
	<title>~/btx-agent</title>
	<?php include_once 'btx-includes.php';?>
	<?php include_once 'btx-functions.php';?>	
	<?php include_once 'btx-modals.php';?>
</head>

<body class="bt-overlay" style="overflow: hidden;">

<!-- //////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// - HEADER / NAV - //////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// -->


<div class="container-fluid navbar-dark fixed-top bg-dark blue-brand">

	<div class="row">

		<div class="col-1 nav-logo" style="padding-left:15px;padding-right:0px;padding-bottom:5px">
			<img src="./bluetelecoms/btx-logo-sml.png"  class="img-fluid"  style = "max-width: 100%;min-width: 80%; height: auto;min-height: 60%;max-height: 100%;display: block;">
		</div>

		<div class="col-9">

			<div class="btn-group nav-buttons" role="group">
				<button type="button" id="viewScript" class="btn btn-sm btn-white"><i class="fas fa-file-word"></i>&nbsp;Script</button>
				<button type="button" id="viewForm" class="btn btn-sm btn-white"><i class="fas fa-list-alt"></i>&nbsp;Capture</button>
				<button type="button" id="viewLeads" onclick="CalLBacKsLisTCheck('yes','','');return false;" class="btn btn-sm btn-white DisableWhenNotPaused"><i class="fas fa-hourglass"></i>&nbsp;Callbacks&nbsp;<span id='btx_callback_count_display' class="badge badge-danger"></span></button>
				<button type="button" id="viewLog" data-setting="btx_log_control" class="btn btn-sm btn-white DisableWhenNotPaused"><i class="fas fa-list"></i>&nbsp;Log</button>
				<button type="button" id="viewSearch" data-setting="btx_search_control" class="btn btn-sm btn-white DisableWhenNotPaused"><i class="fas fa-search"></i>&nbsp;Search</button>
				<button type="button" id="viewDial" class="btn btn-sm btn-white DisableWhenNotPaused"><i class="fas fa-phone"></i>&nbsp;Manual</button>
				<button type="button" id="viewDNC" data-setting="btx_DNC_control"  class="btn btn-sm btn-white"><i class="fas fa-exclamation-triangle"></i>&nbsp;DNC</button>
				&nbsp;&nbsp;<span class="text-white" id='btx_dialable_leads'></span>
			</div>

		</div>

		<div class="col-2">

			<div class='btx-agentstatus nav-status'>
				<button id="btx_agent_is_paused_button" class="btn btn-block btn-warning my-2 my-sm-0 btx_agent_status_buttons"><i class="fas fa-2x fa-pause faa-slow faa-flash animated"></i>&nbsp;<span id="btx_pause_dispo_button"></span>&nbsp;<span id="btx_pause_timer" data-setting="btx_timers_control">00:00:00</span></button>
				<button id="btx_agent_is_paused_exceed_button" class="btn btn-block btn-danger my-2 my-sm-0 btx_agent_status_buttons" style="display: none;"><i class="fas fa-2x fa-pause fa-exclamation-triangle faa-flash animated"></i>&nbsp;<span id="btx_pause_dispo_button"></span>&nbsp;Break Exceeded&nbsp;<span id="btx_pause_timer_exceed" data-setting="btx_timers_control">00:00:00</span></button>
				<button id="btx_agent_is_ready_button" class="btn btn-block btn-ready my-2 my-sm-0 btx_agent_status_buttons" style="display: none;"><i class="fas fa-3x fa-spinner faa-spin animated"></i></button>
				<button id="btx_agent_is_in_call_button" class="btn btn-block btn-success my-2 my-sm-0 btx_agent_status_buttons" style="display: none;"><i class="fas fa-2x fa-user-friends"></i>&nbsp;&nbsp;<span id="btx_call_timer" data-setting="btx_timers_control">00:00:00</span></button>
				<button id="btx_agent_is_in_inbound_call_button" class="btn btn-block btn-success my-2 my-sm-0 btx_agent_status_buttons" style="display: none;"><i class="fas fa-2x fa-sign-in-alt"></i>&nbsp;&nbsp;<span id="btx_call_timer_inbound" data-setting="btx_timers_control">00:00:00</span></button>
				<button id="btx_agent_is_in_dispo_button" class="btn btn-block btn-danger my-2 my-sm-0 btx_agent_status_buttons" style="display: none;"><i class="fas fa-2x fa-window-restore faa-flash animated"></i>&nbsp;&nbsp;<span id="btx_dispo_timer" data-setting="btx_timers_control">00:00:00</span></button>
				<button id="btx_agent_is_manual_dial_in_progress_button" class="btn btn-block btn-info my-2 my-sm-0 btx_agent_status_buttons" style="display: none;"><i class="fas fa-2x fa-sync-alt faa-spin animated"></i>&nbsp;&nbsp;<span id="btx_mandial_timer" data-setting="btx_timers_control">00:00:00</span></button>
				<button id="btx_agent_is_dead_button" class="btn btn-block btn-info my-2 my-sm-0 btx_agent_status_buttons" style="background-color: black; border-color: black;" style="display: none;"><i class="fas fa-2x fa-exclamation-triangle faa-flash animated"></i>&nbsp;&nbsp;</button>
				<button id="btx_agent_is_preview_button" class="btn btn-block btn-warning my-2 my-sm-0 btx_agent_status_buttons" style="display: none;"><i class="fas fa-2x fas fa-eye faa-slow faa-flash animated"></i>&nbsp;&nbsp;LEAD PREVIEW</button>
			</div>	

		</div>

	</div>

</div>




<audio id='ringing_in' src="bluetelecoms/inboundring.mp3" type="audio/mpeg" style="display:none;"></audio>


<div id='hotkeyspopups' class='hotkeyspopups' style="display:none;">
	<div class='row'>
		<div class='col text-center font-weight-bold'>Please Select a Number from Below to Quick Disposition Call:</div>
		<hr>
	</div>
	<div class='row'>
		<div class='col-4 text-center' id='hotkeyspopupsA'><?php echo $HKboxA ?></div>
		<div class='col-4 text-center' id='hotkeyspopupsB'><?php echo $HKboxB ?></div>
		<div class='col-4 text-center' id='hotkeyspopupsC'><?php echo $HKboxC ?></div>
	</div>
</div>






<!-- //////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////// -->

	<span id="LeaDInfOBox_log">
		<div class="modal fade" id="modal-default-info_log" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header blue-brand2">
						<h5 class="modal-title" id="exampleModalLabel">Lead Details</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>

					</div>
				
					<div class="modal-body">

						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab2" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" aria-expanded="true">Info</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab2" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" aria-expanded="false">Call History</a>
							</li>
						</ul>
					
						<span id="LeaDInfOSpan_log"> <?php echo _QXZ("Lead Info"); ?> </span>
					
						<br /><br /> &nbsp;

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>

					</div>

				</div>
			</div>
		</div>
	</span>


			<span style="" id="LeaDEditBox">
				<div class="modal fade" id="modal-default-edit" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content" style="">
							<div class="modal-header blue-brand2">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
									<h4><?php echo _QXZ('Select a CallBack ');?></h4>
								</div>
								<div class="modal-body">
								</button>

							</div>

							<div class="modal-body">
								<span id="CallBackDatE"></span>
								<?php
								if ($webphone_location == 'bar')
									{echo "<br /><img src=\"./images/"._QXZ("pixel.gif")."\" width=\"1px\" height=\"".$webphone_height."px\" /><br />\n";}
								?>

								<input type="hidden" name="CallBackTimESelectioE" id="CallBackTimESelectioE" />

								<span id="CallBackTimEPrinT"></span>
								<span id="CallBackDateContent">
									<div class='col-12'>
										<div class="form-group row">
											<label class="col-4">Select a Date:</label><div class='col-5'>
												<div class='input-group date'>
													<input type='text' class="form-control datepicker"  name="CallBackDatESelectioE" id="CallBackDatESelectioE" data-date-format="yyyy-mm-dd" />
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
													</div>
												</div> 
											</div>
										</div>
									</span>
									<div class='col-12'>

										<div class="form-group row">    
											<label class="col-4"><?php echo _QXZ("Hour:"); ?> </label><div class='col-5'>
												<select size="1" name="CBT_hours" id="CBT_hours_btx" class='form-control'>
													<?php
													if ($callback_time_24hour > 0)
													{
														?>
														<option>00</option>
														<?php
													}
													?>
													<option>01</option>
													<option>02</option>
													<option>03</option>
													<option>04</option>
													<option>05</option>
													<option>06</option>
													<option>07</option>
													<option>08</option>
													<option>09</option>
													<option>10</option>
													<option>11</option>
													<option>12</option>
													<?php
													if ($callback_time_24hour > 0)
													{
														?>
														<option>13</option>
														<option>14</option>
														<option>15</option>
														<option>16</option>
														<option>17</option>
														<option>18</option>
														<option>19</option>
														<option>20</option>
														<option>21</option>
														<option>22</option>
														<option>23</option>
														<?php
													}
													?>
												</select> </div>  </div>
												<div class="form-group row">   <label class="col-4">
													<?php echo _QXZ("Minutes:"); ?> </label><div class='col-5'>
														<select size="1" name="CBH_minutes" id="CBH_minutes" class='form-control'>
															<option>00</option>
															<option>05</option>
															<option>10</option>
															<option>15</option>
															<option>20</option>
															<option>25</option>
															<option>30</option>
															<option>35</option>
															<option>40</option>
															<option>45</option>
															<option>50</option>
															<option>55</option>
														</select> </div>

														<?php
														if ($callback_time_24hour < 1)
														{
															?>
															<select size="1" name="CBH_ampms" id="CBH_ampms"  class='form-control'>
																<option>AM</option>
																<option selected>PM</option>
															</select>
															<?php
														}
														?>
													</div>
													<!-- /.form group -->



													<div class='col-12'>
														<?php
														if ('x'=='x')
														{
															echo "<div class='form-group row'><label class='col-6' style='margin-left:-20px;'>"._QXZ("My Callback Only").": </label><div class='col-4' style='margin-left:-20px;margin-left: -52px;'>".'<input name="CallBackOnlyMe4546" class="onoffswitch-checkbox btn-sm" id="CallBackOnlyMe5465"'.(($status=='1')?"checked=''":'').' type="checkbox" value="1">
															<label class="onoffswitch-label" for="CallBackOnlyMe5464">
															<span class="onoffswitch-inner"></span>
															</label>'." 
															</div></div>\n";

														}

					?>
				</div>
			</div>

			<center>
				<a class='btn btn-info' href="#" onclick="CallBackUpdateDatE_submit();return false;" data-dismiss="modal" name='callback_submit'><?php echo _QXZ("SUBMIT"); ?></a>
			</center>
		</div>
	</div>
</div>
</div>
</span>

<div class="container-fluid bt-content" style="overflow: auto;display: block;height: 100%;">
	<div class="row">

		<div class="col-5">
			<div class="card" id="my_card" style="margin-bottom: 20%;">

				<div class="card-header blue-control">
					<div class ='row'>
						<div class='col-10'>
							<div class="btn-group" role="group">
								<div  id="btx_call_control_buttons" class="btx_call_control_buttons" style="margin-left:-5px;">
									<button id="start_button" type="button" class="btn btn-sm btn-success control-buttons btx_start_button" onclick="AutoDial_ReSume_PauSe('VDADready','','','','','','','YES');">
										<i class="fas fa-play"></i>&nbsp;Start
									</button>
									<button id='btx_pause_button' type="button" class="btx_pause_button btn btn-sm btn-warning control-buttons" >
										<i class="fas fa-pause"></i>&nbsp;Pause
									</button>
									<button type="button" class="btn btn-sm btn-outline-success control-buttons btx_dial_next_button123" id="dial_next_button123" onclick="ManualDialNext('','','','','','0','','','YES');">
										<i class="fas fa-step-forward"></i>&nbsp;Dial Next
									</button>
									<!--<button style="margin-left:5px;" id="hangup_button" type="button" class="btn btn-sm btn-danger control-buttons hangup_button hangup_and_show_dispo" onclick="dialedcall_send_hangup('','','','','YES');$('#modal-outcome').modal('show');">-->
									<button style="margin-left:5px;" id="hangup_button" type="button" class="btn btn-sm btn-danger control-buttons hangup_button hangup_and_show_dispo" onclick="dialedcall_send_hangup('','','','','YES');">
										<i class="fas fa-times"></i>&nbsp;Hangup
									</button>
									<button style="margin-left:5px;display:none;" id="hangup_again_button" type="button" class="btn btn-sm btn-danger control-buttons hangup_again_button">
										<i class="fas fa-times"></i>&nbsp;Dispo Call
									</button>				

									<div id="RecorDingFilename" style="display:none;"></div>
									<span style="display:none;">Recording ID: 
										<span id="RecorDID"></span>
									</span>

									<button style="margin-left:5px;" id="transfer_button" type="button" class="btn btn-sm btn-outline-primary control-buttons btx_transfer_button hidden">
										<i class="fas fa-exchange-alt"></i>&nbsp;Transfer
									</button>
								</div>

								<div id="mandialskipprev" class="mandialskipprev" style="margin-left:-5px; display:none;">
									<button id="btx_DIAL_LEAD" type="button" class="btn btn-sm btn-success control-buttons btx_DIAL_LEAD" >
										<i class="fas fa-play"></i>&nbsp;Dial Lead
									</button>
									<button id="btx_SKIP_LEAD" type="button" class="btn btn-sm btn-danger control-buttons btx_SKIP_LEAD" onclick="ManualDialSkip('YES');">
										<i class="fas fa-play"></i>&nbsp;Skip Lead
									</button>
									<button id="btx_DIAL_ALT" type="button" class="btn btn-sm btn-info control-buttons btx_DIAL_ALT" onclick="ManualDialOnly('ALTPhonE','YES');">
										<i class="fas fa-play"></i>&nbsp;Dial Alt
									</button>
								</div>

								<div  id="Alt_number_dialling_opts" class="Alt_number_dialling_opts" style="margin-left:-5px; display:none;">
									<button id="btx_DIALALT_Show_dispo" type="button" class="btn btn-sm btn-danger control-buttons btx_DIALALT_Show_dispo" onclick="ManualDialAltDonE('YES');">
										<i class="fas fa-times"></i>&nbsp;Dispo Call
									</button>
									<button id="btx_DIAL_Main_NUMber" type="button" class="btn btn-sm btn-info control-buttons btx_DIAL_Main_NUMber" onclick="ManualDialOnly('MaiNPhonE','YES');">
										<i class="fas fa-play"></i>&nbsp;Main Number
									</button>
									<button id="btx_DIAL_Alt_NUMber" type="button" class="btn btn-sm btn-info control-buttons btx_DIAL_Alt_NUMber" onclick="ManualDialOnly('ALTPhonE','YES');">
										<i class="fas fa-play"></i>&nbsp;Alt Number
									</button>
								</div>

								<div style="margin-left:5px;" id="ParkControl123" class="ParkControl123">
									<button type="button" id='ParkControl123_button' class="btn btn-sm btn-outline-primary control-buttons btx_ParkControl123_button">
									</button>
								</div>
								<div style="margin-left:5px;" id='viewcallback_diary_div' class='viewcallback_diary_div'>
								<button type="button" id="viewcallback_diary" class="btn btn-sm btn-outline-brand HideWhenNotInCall viewcallback_diary" data-setting="btx_diary_button_control" data-toggle="modal" data-target="#modal-pre-callbacks"><i class="far fa-calendar-alt"></i>&nbsp;Diary</button>
								</div>
							</div>
						</div>

						<div class='col-2'>

							<div class='row'>

								<div class="form-check form-check-inline" id="btx_DiaLLeaDPrevieW123_section">
									<input class="form-check-input" type="checkbox" name="btx_DiaLLeaDPrevieW123" id="btx_DiaLLeaDPrevieW123" size="1" value="0">
									<label class="form-check-label text-muted text-small" for="btx_DiaLLeaDPrevieW123">Preview</label>
								</div>

							</div>

							<div class='row'>

								<div class="form-check form-check-inline" id="btx_DiaLDiaLAltPhonE123_section">
									<input class="form-check-input" type="checkbox" name="btx_DiaLDiaLAltPhonE123" id="btx_DiaLDiaLAltPhonE123" size="1" value="0">
									<label class="form-check-label text-muted text-small" for="btx_DiaLDiaLAltPhonE123">Alt Dial</label>
								</div>			

							</div>			

						</div>

					</div>
				</div>


				<div class="card-body">

					<div class="form-group row">
						<div class="col-2">
							<input type="text" class="form-control" placeholder="Title" id="btx_input_title" name="btx_input_title">
						</div>
						<div class="col-4">
							<input type="text" class="form-control" placeholder="Forename" id="btx_input_first_name" name="btx_input_first_name">
						</div>
						<div class="col-6">
							<input type="text" class="form-control" placeholder="Surname" id="btx_input_last_name" name="btx_input_last_name">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-6">
							<input type="text" class="form-control" placeholder="Address 1" id="btx_input_address1" name="btx_input_address1">
						</div>
						<div class="col-6">
							<input type="text" class="form-control" placeholder="Address 2" id="btx_input_address2" name="btx_input_address2">
						</div>
					</div>		
					<div class="form-group row">				
						<div class="col-6" id="citycol">
							<input type="text" class="form-control" placeholder="City" id="btx_input_city" name="btx_input_city">
						</div>
						<div class="col-3" id="statecol" style="display:none;">
							<input type="text" class="form-control" placeholder="State" id="btx_input_state" name="btx_input_state">
						</div>
						<div class="col-4" id='pccol'>
							<input type="text" class="form-control" placeholder="Post Code" id="btx_input_postal_code" name="btx_input_postal_code">
						</div>
						<div class="col-2">
							<button type="button" id="viewMap" data-setting="btx_gmaps_weather" class="btn btn-lg btn-block btn-outline-brand"><i class="fas fa-map"></i></button>
						</div>
					</div>	
					<div class="form-group row">
						<div class="col-6">
							<input type="text" class="form-control" placeholder="Phone Number"  id="btx_input_phone_numberDISP" name="btx_input_phone_numberDISP">
						</div>
						<div class="col-6">
							<input type="text" class="form-control" placeholder="Alt. Phone" id="btx_input_alt_phone" name="btx_input_alt_phone">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-6">
							<input type="text" class="form-control" placeholder="Email Address" id="btx_input_email" name="btx_input_email">
						</div>
						<div class="col-6">
							<input type="text" class="form-control" placeholder="Unique ID" id="btx_input_vendor_lead_code" name="btx_input_vendor_lead_code" readonly>
						</div>
					</div>
					<div class="form-group row" id='comments_area_information'>
						<div class="col">
							<span class="text-left" id='switch_comments_box_span' style="display:none;">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-success btn-xs btn-square" id='btx_show_comments_button'><i class="fas fa-fw fa-comments"></i>&nbsp;Comments</button>
									<button type="button" class="btn btn-secondary btn-xs btn-square" id='btx_show_call_log_button'><i class="fas fa-fw fa-clipboard"></i>&nbsp;Call Notes</button>
									<button type="button" class="btn btn-outline-secondary btn-xs btn-square" id='btx_show_call_log_history' style="display:none;" data-toggle="modal" data-target="#modal-default-info" onclick='VieWLeaDInfO_btx();'><i class="fas fa-fw fa-history"></i>&nbsp;Log</button>		
								</div>
							</span>			
							<textarea class="form-control btn-square2" rows="4" placeholder="Comments" maxlength="254" id="btx_input_comments" name="btx_input_comments" readonly></textarea>
							<textarea class="form-control" rows="4" placeholder="Call Notes (Permanently Stored)" maxlength="254" id="btx_input_call_notes" style="display:none;"></textarea>
							<p class="text-muted text-small text-right"><span id="btx_count_chars_comments">0</span> / 254</p>
						</div>
					</div>

					<div class="form-group row" id='prevous_callback_notes' style="display:none;">
						<div class="col">
							<div class="card">
							  <div class="card-header">
							  	<div class = 'row'>
							  	<div class='col-7'>
							    	CALLBACK NOTES
							    </div>
							  	<div class='col-5 text-right'>
							    	<i class="fas fa-times-circle" onclick="$('#prevous_callback_notes').hide();hideDiv('CBcommentsBox');$('#comments_area_information').show();"></i>
							    </div>
							  </div>
							  </div>
							  <div class="card-body" id="callbacknotesbody">
					    
							  </div>
							</div>
							
						</div>
					</div>

					<div class = 'row'>
						<div class='col-7'>
							<div class="btn-group" role="group">
								<a type="button" id="btx_api_button_1" class="btn btn-sm btn-outline-info disabled" onclick="webform_click_log('webform1');" target="_blank"><i class="fas fa-plus-circle"></i>&nbsp; <span data-setname="btx_api_one_name">API 1</span></a>
								<a type="button" id="btx_api_button_2" class="btn btn-sm btn-outline-info disabled" onclick="webform_click_log('webform2');" target="_blank"><i class="fas fa-plus-circle"></i>&nbsp; <span data-setname="btx_api_two_name">API 2</span> </a>  
							</div>
						</div>
						<div class='col-5'>
							
							<div id="btx_RecorDControl_div" class="text-right">
								<button id='btx_RecorDControl' type="button" class="btn btn-sm  control-buttons">
									<i class="fas fa-microphone"></i>&nbsp;Start Record
								</button>
							</div>
							
						</div>

					</div>
				</div>
			</div>
		</div>


<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - SCRIPT - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff" id="btx-script" style="height: 300px;">

	<div class="card">

		<div class="card-header">

			<div id="btx_script_controls">
				<button class="btn btn-sm btn-outline-primary" id="btx_reduce_script_button"><i class="fas fa-arrow-circle-right"></i>&nbsp;Reduce</button>
				<button class="btn btn-sm btn-outline-primary" id="btx_expand_script_button" data-setting="btx_expand_script_control"><i class="fas fa-expand"></i>&nbsp;Expand</button>
				<span id="btx_script_head_customer_name"></span>&nbsp;
				<span id="btx_script_name"></span>
			</div>

		</div>

		<div class="card-body table-responsive" id="script_box_container" style="overflow:auto;height: 550px;display: block;">
			<p class="text-muted">No Script</p>
		</div>

	</div>

</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - CAPTURE - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff hidden" id="btx-form" style="height: 300px;">

	<div class="card">
		<div class="card-header">
			<i class="fas fa-pencil-alt"></i>&nbsp;Data Capture
		</div>
		<div class="card-body" style="overflow:auto;height: 550px;display: block;">
			<!-- <iframe src="" width="100%" height="600px"></iframe> -->
		</div>

	</div>

</div>




<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - CAPTURE - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->


<div class="col-7 stuff hidden" id="btx-dtmf" style="height: 300px;">
<div class='row'>
<div class='col-6'>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-th fa-fw"></i>&nbsp;BUTTONS
		</div>
		<div class="card-body">
		<div class="row">

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-1" onclick="document.vicidial_form.conf_dtmf.value=1;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">1</span><br>
				<span class="dtmf-text text-center">...</span>
			</div>

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-2" onclick="document.vicidial_form.conf_dtmf.value=2;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">2</span><br>
				<span class="dtmf-text text-center">ABC</span>
			</div>

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-3" onclick="document.vicidial_form.conf_dtmf.value=3;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">3</span><br>
				<span class="dtmf-text text-center">DEF</span>
			</div>

		</div>

		<div class="row">

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-4" onclick="document.vicidial_form.conf_dtmf.value=4;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">4</span><br>
				<span class="dtmf-text text-center">GHI</span>
			</div>

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-5" onclick="document.vicidial_form.conf_dtmf.value=5;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">5</span><br>
				<span class="dtmf-text text-center">JKL</span>
			</div>

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-6" onclick="document.vicidial_form.conf_dtmf.value=6;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">6</span><br>
				<span class="dtmf-text text-center">MNO</span>
			</div>

		</div>

		<div class="row">

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-7" onclick="document.vicidial_form.conf_dtmf.value=7;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">7</span><br>
				<span class="dtmf-text text-center">PQRS</span>
			</div>

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-8" onclick="document.vicidial_form.conf_dtmf.value=8;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">8</span><br>
				<span class="dtmf-text text-center">TUV</span>
			</div>

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-9" onclick="document.vicidial_form.conf_dtmf.value=9;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">9</span><br>
				<span class="dtmf-text text-center">WXYZ</span>
			</div>

		</div>

		<div class="row">

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-star" onclick="document.vicidial_form.conf_dtmf.value='*';SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">*</span><br>
				<span class="dtmf-text text-center">...</span>
			</div>

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-0" onclick="document.vicidial_form.conf_dtmf.value=0;SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">0</span><br>
				<span class="dtmf-text text-center">+</span>
			</div>

			<div class="col dtmf-button-inactive border border-dark dtmf-button" id="dtmf-hash" onclick="document.vicidial_form.conf_dtmf.value='#';SendConfDTMF(session_id,'YES');">
				<span class="dtmf-number text-center">#</span><br>
				<span class="dtmf-text text-center">...</span>
			</div>

		</div>
		</div>


	</div>
</div>
</div>

<br>
<div class='row'>
	<div class='col-6'>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-volume-up"></i>&nbsp;VOLUME CONTROL
		</div>
		<div class="card-body">
			<div class ='row'>
				<div class='col-4'>
					<small><b>AGENT:</b></small>
				</div>
				<div class='col-8' style="display: inline;">
						<div id='agentVOLup' style="display: inline;"></div>
						<div id='agentVOLdown' style="display: inline;"></div>
						<div id='agentVOLmute' style="display: inline;"></div>
				</div>
			</div>
			<div class ='row'>
				<div class='col-4'>
					<small><b>CLIENT:</b></small>
				</div>
				<div class='col-8' style="display: inline;">
						<div id='clientVOLup' style="display: inline;"></div>
						<div id='clientVOLdown' style="display: inline;"></div>
				</div>

			</div>

		</div>


	</div>
</div>
</div>


</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - LEADS - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->


<div class="col-7 stuff hidden" id="btx-leads">
	
	<div class="card">

		<div class="card-header">
			<i class="fas fa-file-text"></i>&nbsp;Leads / Callbacks
		</div>

		<div class="card-body">
			<div id="rand"></div>
			<div class="card text-center" id="callbacklist_refresh">
				<div class="card-header">
					<ul class="nav nav-pills card-header-pills">
						<li class="nav-item">
							<a class="nav-link" id="today" data-toggle="tab"  href="#" onclick="CalLBacKsLisTCheck('yes','','');return false;">Today</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="overdue" data-toggle="tab" href="#" onclick="CalLBacKsLisTCheck('','yes','');return false;">Overdue</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="future" data-toggle="tab" href="#" onclick="CalLBacKsLisTCheck('','','yes');return false;">Future</a>
						</li>
					</ul>
				</div>
				<div class="card-block" id="CallBacKsLisT123" style="overflow:auto;height: 300px;display: block;"></div>
			</div>

		</div>
	</div>
</div>
<!-- end-->



<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - LOG - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff hidden" id="btx-log">
	<div class="card">
		<div class="card-header">

			<div class='row'>
				<div class='col-5'>
					<i class="fas fa-list"></i>&nbsp;Log / Call History
				</div>
				<div class='col-5 text-right'>
					<span class='text-left'> <input type="date" id="history_search_date" max="<?php echo date("Y-m-d") ?>"  class="form-control"></span>
				</div>
				<div class='col-2 text-right'>
					<button type="button" class="btn btn-outline-primary"  id="change_history_date" onclick="VieWCalLLoG_custom($('#history_search_date').val(),'')"><i class="fas fa-calendar-check fa-fw"></i>&nbsp;Submit</button>
				</div>
			</div>

		</div>

		<div class="card-body" >
			<div class='row'>
				<div class='table-responsive' style="overflow: auto;height: 500px">
			<table id="call_log" class="table table-bordered table-sm">
				<thead>
					<tr>
						<th>Time</th>
						<th>Client Name</th>
						<th>Phone</th>
						<th>Length</th>
						<th>Status</th>
						<th colspan='2'>Actions</th>
					</tr>
				</thead>
				<tbody id='CallLogSpancustom'></tbody>
			</table>
			</div>
		</div>
		</div>
	</div>
</div>


<!-- //////////////////////////////////////////////////////////////////////////////////////
     /////////////////////////// - SEARCH - ////////////////////////////////////////////
     ////////////////////////////////////////////////////////////////////////////////////// -->
<div class="col-7 stuff hidden" id="btx-search-lead">
     
     	<div class="card">
     		<div class="card-header">
     			<i class="fas fa-search"></i>&nbsp;Lead Search
     		</div>
     		<div class="card-body">
     			<div class="row form-group">
     				<div class="col">
     					<input type="text" id="btx_search_phone" class="form-control" placeholder="Phone Number">
     				</div>
     				<div class="col">
     					<input type="text" id="btx_search_lead_id" class="form-control" placeholder="Lead ID">
     				</div>				
     			</div>
     			<div class="row form-group">
     				<div class="col-6">
     					<input type="text" id="btx_search_vlc" class="form-control" placeholder="Vendor ID">
     				</div>


     				<div class="col">
     					<button  class="btn btn-outline-primary btn-block" onclick='btx_LeadSearchSubmit()'><i class="fas fa-search DisableWhenNotPaused"></i>&nbsp;Search</button>
     				</div>				
     			</div>
     			
     			<span id='btx_search_res'>
    
			
     			</span>

     		</div>
     	</div>
   

</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - MANUAL DIAL - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->





<div class="col-7 stuff hidden" id="btx-dial">
	
	<div class="card">
		<div class="card-header">
			<i class="fas fa-phone"></i>&nbsp;Manual Dial
		</div>
		<div class="card-body">
			<div class="row form-group">
				
				<div class="col-2">
					<input type="text" class="form-control" id="MDDiaLCodE_prefix" name="MDDiaLCodE" value="<?php echo $default_phone_code; ?>"> <!-- *VICI - LOOKUP CAMPAIGN SETTINGS -->
				</div>

				<div class="col-4">
					<input type="text" class="form-control" maxlength="21" placeholder="Phone Number" id="btx_input_MDPhonENumbeR" 
					name="btx_input"> <!-- *TASK - Auto Remove '0' from number -->
				</div>

				<div class="col-3">
					<button href="#" id="btx_dial_now_button" class="btn btn-outline-success btn-block DisableWhenNotPaused man_dial_buttons" disabled>
						<i class="fas fa-phone"></i>&nbsp;Dial Now
					</button>
				</div>

				<div class="col-3">
					<button href="#" id="btx_preview_man_dial_button" class="btn btn-outline-primary btn-block DisableWhenNotPaused man_dial_buttons" disabled style="display:none;">
						<i class="fas fa-eye"></i>&nbsp;Preview Dial
					</button>
				</div>

			</div>



			<div class="row form-group">
				<div class="col-12" id='btx_man_lookup_text'>

					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="btx_LeadLookuP" id="btx_LeadLookuP" size="1" value="0">
						<label class="form-check-label text-muted text-small" for="btx_LeadLookuP">Search for record in database</label>
					</div>	
					
				</div>

			</div>					

		</div>
	</div>			
</div>



<!--//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - DNC - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff hidden" id="btx-dnc">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-exclamation-triangle"></i>&nbsp;DNC
		</div>
		<div class="card-body">
			Manually add a number to the system wide DNC list. All requests are logged.
			<br><br>
			<div class="row form-group">
				<div class="col-6">
					<input type="text" value="" name='DNC_phone_number1' id="DNC_phone_number1" class="form-control" placeholder="Phone Number" maxlength="15">
				</div>				
				<div class="col-6">
					<button class="btn btn-outline-danger btn-block" id="dnc_add"><i class="fas fa-exclamation-triangle"></i>&nbsp;Add to DNC</button>
				</div>
			</div>
			<div><p id="DNC-result"></p></div>		
		</div>	
	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - STATS - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff hidden" id="btx-stats">

	<div class="card">

		<div class="card-header">
			<i class="fas fa-trophy"></i>&nbsp;Stats
			<button class="btn float-right btn-outline-dark btn-sm HideWhenNotPaused" id='btx_edit_profile' onclick="$('#agent_upload_image_modal').modal('show');" data-setting="btx_edit_profile_control">Edit Profile</button>
		</div>

		<div class="card-body">

			<!-- LAYOUT -->

			<div class="row">
				<div class="col-4"  class="text-center">
					<span id='btx_user_profile_img_container' style="display: none"><img id='btx_user_profile_img' class='img-fluid rounded mx-auto d-block' style="max-height: 175px;"></span>
					<button id ='profile_image_placeholder' class="btn btn-block btn-dark" style="min-height: 75%;">
					
					<i class="fas fa-user fa-3x"></i>

					</button>
				</span>

				</div>
				<div class="col-5">
					<p class="font-weight-bold">Agent:&nbsp;<span class="font-weight-light" id='btx_stats_agent_name'></span></p>
					<p class="font-weight-bold">Campaign Successes:&nbsp;<span class="font-weight-light" id='btx_stats_campaign_sales'></span></p>
					<p class="font-weight-bold">Campaign Rank:&nbsp;<span class="font-weight-light" id='btx_stats_camapign_rank'></span></p>
					<p class="font-weight-bold" id='btx_stats_availabilty'> </p>
					
				</div>

				<div class="col-3 text-center">
						<img src="bluetelecoms/images/gold.png" class="img-fluid medals" id='gold_medal' style="max-height: 150px; display: none;">
						<img src="bluetelecoms/images/silver.png" class="img-fluid medals" id='silver_medal' style="max-height: 150px; display: none;">
						<img src="bluetelecoms/images/bronze.png" class="img-fluid medals" id='bronze_medal' style="max-height: 150px; display: none;">

					
				</div>


			</div>

			<!-- LAYOUT -->
<div class='row' id='pause_codes_stats'>
</div>
			<hr>

			<!-- LAYOUT -->

			<div class="row" style="overflow: auto;height: 250px">


				<div class="col">

				<table class="table table-sm table-hover" id="stats_table">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col">User</th>
      						<th scope="col">Successes</th>
      						<th scope="col">Avg Talk</th>
      						<th scope="col">Avg Dispo</th>
   						</tr>
  					</thead>
  					<tbody id='btx_agents_stats_table'>
    				</tbody>
				</table>

				</div>

			</div>



			<!-- LAYOUT -->

		</div>	

	</div>

</div>




<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - BTX TECH INFO - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff hidden" id="btx-tech-info">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-info-circle"></i>&nbsp;Technical Information
		</div>
		<div class="card-body">
			<div class='row'>
				<div class='col-2'>
					<i class="fas fa-user"></i>
				</div>
				<div class='col-4'>
					<b>User:</b>
				</div>
				<div class='col-6'>
					<?php echo"$VD_login";?>
				</div>				
			</div>
			<div class='row'>
				<div class='col-2'>
					<i class="fa fa-users" aria-hidden="true"></i>
				</div>
				<div class='col-4'>
					<b>User Group:</b>
				</div>
				<div class='col-6'>
					<?php echo"$VU_user_group";?>
				</div>				
			</div>
			<div class='row'>
				<div class='col-2'>
					<i class="fa fa-columns" aria-hidden="true"></i>
				</div>
				<div class='col-4'>
					<b>Campaign:</b>
				</div>
				<div class='col-6'>
					<?php echo"$VD_campaign";?>
				</div>				
			</div>
			<div class='row'>
				<div class='col-2'>
					<i class="fas fa-headset"></i>
				</div>
				<div class='col-4'>
					<b>Phone Extension:</b>
				</div>
				<div class='col-6'>
					<?php echo"$phone_login";?>
				</div>				
			</div>
			<div class='row'>
				<div class='col-2'>
					<i class="fas fa-laptop"></i>
				</div>
				<div class='col-4'>
					<b>Session ID:</b>
				</div>
				<div class='col-6'>
					<?php echo"$session_id";?>
				</div>				
			</div>
			<div class='row'>
				<div class='col-2'>
					<i class="fas fa-server"></i>
				</div>
				<div class='col-4'>
					<b>Server:</b>
				</div>
				<div class='col-6'>
					<?php echo $_SERVER['HTTP_HOST'];?>
				</div>				
			</div>
			<div class='row'>
				<div class='col-2'>
					<i class="fas fa-wifi"></i>
				</div>
				<div class='col-4'>
					<b>IP Address:</b>
				</div>
				<div class='col-6'>
					<?php echo $_SERVER['REMOTE_ADDR'];?>
				</div>				
			</div> 
			<hr>
			<div class='row'>

				<div class='col-6'>
					<img src="../agent/bluetelecoms/btx-logo-sml-dark.png">
				</div>		
				<div class='col-6'>
					<a href='https://join.zoho.eu/' target="_blank" class="btn btn-block btn-outline-dark"><i class="fas fas-fw fa-hands-helping"></i>&nbsp;REMOTE ASSISTANCE</a>
				</div>	
			</div>

		</div>	
	</div>
</br>


<!-- VERISON CONTROL -->

		<div class="card" >
		<div class="card-header">
			<i class="fas fa-code-branch"></i>&nbsp;&nbsp;Latest Features&nbsp;
		</div>
		<div class="card-body" style="overflow: auto;height: 200px">
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.17</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-primary">System</span>
				</div>
				<div class='col-11'>
					 Functions added to allow disposition from script
				</div>
			</div>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Added additional active/live callback notifications
				</div>
			</div>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 Improvements made to dial controls displayed in fullscreen mode
				</div>
			</div>	
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Option to display dialable leads on interface
				</div>
			</div>	
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 Problem resolved when using none WebRTC
				</div>
			</div>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Scripts now expand vertically as well as horizontally
				</div>
			</div>
			<br>	
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.16</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-primary">System</span>
				</div>
				<div class='col-11'>
					 Webphone can now be hosted on CDN or client server to prevent DTMF issues
				</div>
			</div>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 Status overides are now catagorised correctly
				</div>
			</div>	
			<br>	
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.15</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 Data Capture form reset after API button press
				</div>
			</div>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Company Logo update
				</div>
			</div>	
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Pressing enter on login screen now works
				</div>
			</div>	
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 Ability to remove manual dial via user setting
				</div>
			</div>	
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Added the ability to view callback status and notes at a glance
				</div>
			</div>	
			<br>
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.14</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Added seasonal backgrounds to login screen
				</div>
			</div>	
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 Bug causing login screen to error resolved
				</div>
			</div>
			<br>
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.13</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Ability to turn on ringing sound for inbound calls
				</div>
			</div>	
			<br>
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.12</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Agent stats now show top 6 pause times so agents can monitor break times
				</div>
			</div>	
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Changed Availability to show status breakdown within agent stats
				</div>
			</div>	
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Campaign ID added to the callback screen
				</div>
			</div>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 System setting 'Campaign Callback Lock' prevents users from accessing callbacks from different campaigns
				</div>
			</div>	
			<br>
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.11</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Font colour change on login screen
				</div>
			</div>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-primary">System</span>
				</div>
				<div class='col-11'>
					 Database table added to record Manual dial bug fix events
				</div>
			</div>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 Manual dial bug fix which stops call from being terminated
				</div>
			</div>
			<br>

		<div class='row'>
			<div class='col'>
				<b>Version 6.1.10</b> 
			</div>
		</div>
		<hr>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Ability to choose whether SPH targets include time in 'Pause' or not
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Admin to Agent / Agent to Agent chat now available 
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 No contact statuses moved to first column of dispo screen as more commonly used
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Added ability to edit / hide / disable phone number field (controlled via campaign)
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Search results clear when window is unfocused
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Inbound call merge lead functionality added 
				</div>
			</div>
			<br>
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.09</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Webphones set to work with server load balancing 
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 When 'My Callback' button is unchecked in diary it now remains unticked when confirming the callback
				</div>
			</div>
			<br>
		<div class='row'>
			<div class='col'>
				<b>Version 6.1.08</b> 
			</div>
		</div>
		<hr>
			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Ability to change target to Sales Per Hour
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 'Call Queue', 'Other Agents Avaliability' and 'Callback Notes' popups integrated into interface
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-info">New</span>
				</div>
				<div class='col-11'>
					 Volume control added to 'Controls' tab
				</div>
			</div>

			<div class='row'>
				<div class='col-1'>
					<span class="badge badge-success">Fix</span>
				</div>
				<div class='col-11'>
					 Outcome screen crashing interface bug fixed
				</div>
			</div>

		    <div class='row'>
				<div class='col-1'>
					<span class="badge badge-warning">Visual</span>
				</div>
				<div class='col-11'>
					 Change log added
				</div>
			</div>

		</div>	
	</div>
</div>
<!-- VERISON CONTROL -->

<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - COMPANY - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff hidden" id="btx-company">

	<div class="card">
		<div class="card-header">
			<i class="fas fa-building"></i>&nbsp;Company Info
		</div>

		<div class="card-body">

			<div class="container">

				<div class="row">

					<div class="col-6">

						<img id="licensee-logo" class="img-fluid" style="max-height: 175px;" src="./bluetelecoms/btx-logo-sml-dark.png">

						<hr>

						<div data-setname="btx_company_name" class='lead'>
							bluetelecoms
						</div>
						<br>
						<div id="licensee-telephone">
							<i class="fas fa-fw fa-phone"></i>&nbsp;<span data-setname="btx_company_telephone">+443334445558</span>
						</div>
						<div id="licensee-telephone2">
							<i class="fas fa-fw fa-phone"></i>&nbsp;<span data-setname="btx_company_telephone2">+443334445558</span>
						</div>
																		<br>
						<div id="licensee-openinghours">
							<i class="fas fa-clock"></i>&nbsp;<span data-setname="btx_company_openinghours">9-6 Mon to Fri / 10-4 Sat</span>
						</div>	
						
					</div>

					<div class="col-6">

						<div id="licensee-address">
							<i class="fas fa-fw fa-map"></i>&nbsp;<span data-setname="btx_company_address">Market Chambers, Neath, South Wales</span>
						</div>

						<div id="licensee-postcode">
							<i class="fas fa-fw fa-map-pin"></i>&nbsp;<span data-setname="btx_company_postcode">SA11 1PU</span>
						</div>

						<br>
		
						<div id="licensee-email">
							<i class="fas fa-fw fa-envelope"></i>&nbsp;<span data-setname="btx_company_email">info@bluetelecoms.com</span>
						</div>

						<div id="licensee-website">
							<i class="fas fa-fw fa-link"></i>&nbsp;<span data-setname="btx_company_website">https://bluetelecoms.com</span>
						</div>

						<br>
						<div id="licensee-reg1">
							<i class="fas fa-fw fa-registered"></i>&nbsp;<span data-setname="btx_company_reg1">1234</span>
						</div>

						<div id="licensee-reg2">
							<i class="fas fa-fw fa-registered"></i>&nbsp;<span data-setname="btx_company_reg2">1234</span>
						</div>

						<div id="licensee-reg3">
							<i class="fas fa-fw fa-registered"></i>&nbsp;<span data-setname="btx_company_reg3">1234</span>
						</div>

					</div>

				</div>

			</div>

		</div>	

	</div>
</div>

<div class="col-7 stuff hidden" id="lead_edit">

</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - TRANSFER OPTIONS SECION - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff hidden" id="btx_transfer_options">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-exchange-alt"></i>&nbsp;Transfer Call
			<button type="button" class="btn btn-warning btn-sm float-right" id='btx_transfer_restart_button'>Restart</button>
		</div>

		<div class="card-body">

			<div class="container">

				<p class="text-center" id='btx_transfer_extra_info'>Please select a transfer destination</p>

				<div class="row hide_transfers" id="btx_transfer_main">

					<div class='col-4 text-center'>
						<button type="button" class="btn btn-outline-dark btn-lg btn-block" id='btx_transfer_to_ingroup'>
							<i class="fas fa-5x fa-users"></i><br><hr>
													Queue
						</button>

					</div>

					<div class="col-4 text-center">
						<button type="button" class="btn btn-outline-dark btn-lg btn-block" id='btx_transfer_to_preset'>
							<i class="fas fa-5x fa-star"></i><br><hr>
													Preset	
						</button>

					</div>


					<div class="col-4 text-center">
						<button type="button" class="btn btn-outline-dark btn-lg btn-block" id='btx_transfer_to_num'>
							<i class="fas fa-5x fa-hashtag"></i><br><hr>
							External
						</button>
					</div>


				</div>

				<!-- ingroup -->
				<div class="row hide_transfers" id="btx_transfer_group_stage_1"  style="display: none;">

					<div class='col-8'>
						<select class="form-control" id="btx_transfer_ingroup_select">

						</select>
					</div>

					<div class="col-4">
						<button type="button" class="btn btn-success" id ='btx_transfer_ingroup_select_confirm'>Confirm</button>
					</div>

				</div>
				<!-- ingroup -->

				<!-- preset -->

				<div class="row hide_transfers" id="btx_transfer_preset_stage_1"  style="display: none;">
					<div class='row' id='btx_preset_list' style="width:100%"></div>
				</div>			

				<!--preset-->

				<!-- number -->

				<div class="row hide_transfers" id="btx_transfer_num_stage_1"  style="display: none;">

					<div class="col-2">
						<input type="text" class="form-control" id="btx_transfer_number_prefix" value="<?php echo $default_phone_code ?>"> <!-- *VICI - LOOKUP CAMPAIGN SETTINGS -->
					</div>

					<div class='col-6'>
						<input type="text" class="form-control" maxlength="12" placeholder="Phone Number" id="btx_transfer_number" > <!-- *TASK - Auto Remove '0' from number -->
					</div>

					<div class="col-4">
						<button type="button" class="btn btn-success" id ='btx_transfer_number_confirm' disabled>Confirm</button>
					</div>
				</div>

				<!-- number -->

				<div class="row hide_transfers" id="btx_transfer_stage_2"  style="display: none;">

					<div class="col-4 text-center">
						<!--<button type="button" class="btn btn-info hangup_and_show_dispo" id ='btx_transfer_blind'><i class="fas fa-eye-slash"></i>&nbsp;Blind Transfer</button>-->
						<button type="button" class="btn btn-outline-secondary btn-lg btn-block hangup_and_show_dispo" id ='btx_transfer_blind'>
							<i class="fas fa-5x fa-eye-slash"></i><br><hr>
							Blind Transfer
						</button>
					</div>

					<div class="col-4 text-center">
					<!--	<button type="button" class="btn btn-info" id ='btx_transfer_3way'><i class="fas fa-users"></i>&nbsp;3 Way Call</button> -->
						<button type="button" class="btn btn-outline-secondary btn-lg btn-block" id ='btx_transfer_3way'>
								<i class="fas fa-5x fa-users"></i><br><hr>
									3 Way Call
						</button>

					</div>

					<div class="col-4 text-center">
					<!--	<button type="button" class="btn btn-info" id ='btx_transfer_holdcall'><i class="fas fa-music"></i>&nbsp;Client Hold Call</button> -->
						<button type="button" class="btn btn-outline-secondary btn-lg btn-block" id ='btx_transfer_holdcall'>
							<i class="fas fa-5x fa-music"></i><br><hr>
							Client Hold Call
						</button>
					</div>

				</div>

				<div class="row hide_transfers" id="btx_transfer_stage_3"  style="display: none;">

					<div class="col-3 text-center">
						<!--<button type="button" class="btn btn-success hangup_and_show_dispo transfer_final_controls" id ='btx_transfer_leave'>Complete Transfer</button>-->
						<button type="button" class="btn btn-success btn-lg btn-block hangup_and_show_dispo transfer_final_controls" id ='btx_transfer_leave'>
							<i class="fas fa-5x fa-check-circle"></i><br><hr>
							Complete Transfer
						</button>
					</div>

					<div class="col-3 text-center">
					<!--	<button type="button" class="btn btn-info transfer_final_controls" id ='btx_transfer_hangup'>Hangup Transfer</button>-->
						<button type="button" class="btn btn-warning btn-lg btn-blocktransfer_final_controls" id ='btx_transfer_hangup'>
							<i class="fas fa-5x fa-hand-point-down"></i><br><hr>
							Hangup Transfer Line
						</button>
					</div>

					<div class="col-3 text-center">
						<!--<button type="button" class="btn btn-outline-primary" id ='btx_transfer_grab_call'><i class="far fa-hand-rock"></i>&nbsp;Grab Call</button>-->
						<button type="button" class="btn btn-primary btn-lg btn-block" id ='btx_transfer_grab_call'>
							<i class="far fa-5x  fa-hand-rock"></i><br><hr>
							Retrieve from Hold
						</button>
					</div>

					<div class="col-3 text-center">
						<!--<button type="button" class="btn btn-danger transfer_final_controls" id ='btx_transfer_go_back'><i class="fas fa-undo-alt"></i>&nbsp;Try Again</button>-->
						<button type="button" class="btn btn-danger btn-lg btn-block transfer_final_controls" id ='btx_transfer_go_back'>
							<i class="fas fa-5x fa-undo-alt"></i><br><hr>
							Try Again
						</button>
					</div>

				</div>

			</div>

		</div>	

	</div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - END OF OPTIONS SECION - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->


<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - MAP - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

<div class="col-7 stuff hidden" id="btx-map">

	<div class="card">

		<div class="card-header">
			<i class="fas fa-map"></i>&nbsp;Map
			<span style="float: right;" id="btx_weather_info"></span>
		</div>

		<div class="card-body" id="btx_google_map">
			<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCi3WoyO9hAHxyODl9tA3cuHRvS1CH-klE&q=55.3781,-3.4360&zoom=7" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>

	</div>

</div>

<!-- END -->
</div>

<!--  IMPORTANT THAT THIS IS LEFT HERE !!!!! -->
</div> <!-- AGAIN - IMPORTANT THIS IS LEFT HERE !!!! -->
<!--  IMPORTANT THAT THIS IS LEFT HERE !!!!! -->


<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - END MAIN CONTENT - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->

			<div id = 'sidebaroverlay' class="card bg-light text-dark sidebaroverlay" style="display: none;">

					<div class="card-body">
						<h6><i class="fas fa-times-circle" onclick="$('#sidebaroverlay').hide();show_calls_in_queue('HIDE');"></i>&nbsp;&nbsp;Calls Waiting</h6><hr>
					<div id='callsininboundqueue'>
					</div>
					</div>


				</div>


			<div id = 'sidebaroverlaychat' class="card bg-light text-dark sidebaroverlaychat" style="display: none;">

					<div class="card-body">
						<h6><i class="fas fa-times-circle" onclick="$('#sidebaroverlaychat').hide();"></i>&nbsp;&nbsp;Internal Comms</h6><hr>
					<div id='internalchatdiv'>
						<iframe src="./btx_agc_agent_manager_chat_interface.php?user=<?php echo $VD_login; ?>&pass=<?php echo $VD_pass; ?>" style="background-color:transparent;" scrolling="no" frameborder="0" allowtransparency="true" id="btx_InternalChatIFrame" name="btx_InternalChatIFrame" width="<?php echo $SDwidth ?>px" height="<?php echo $SSheight ?>px" STYLE="z-index:<?php $zi++; echo $zi ?>"> </iframe>
					</div>
					</div>


				</div>


			<div id = 'sidebaroverlayagents' class="card bg-light text-dark sidebaroverlay" style="display: none;">

					<div class="card-body">
						<h6><i class="fas fa-times-circle" onclick="$('#sidebaroverlayagents').hide();AgentsViewOpen('AgentViewSpan','close');"></i>&nbsp;&nbsp;Other Agents</h6><hr>
					<div id='otheragentsstatuses'>
					</div>
					</div>


				</div>


<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - CLOSER SELECT BOX - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->



<div id="CloserSelectBox_btx" class="container-fluid CloserStart text-center">

	<br />

	<i class="fas fa-headset fa-4x"></i>

	<br />
	<br />	

	<h4>Inbound Queue Selection</h4>
	
	<p class="text-muted">Please select any additional inbound queues to allow you to receive calls.</p>

	<hr>

	<div class="row">


		<div class="col">

		</div>

		<div class="col">

			<table class="table">

				<tr>
					<td>

						<span id="CloserSelectContent"> <?php echo _QXZ("Closer Inbound Group Selection"); ?> </span>

						<input type="hidden" name="CloserSelectList" id="CloserSelectList" />

						<?php
		
						if ( ($outbound_autodial_active > 0) and ($disable_blended_checkbox < 1) and ($dial_method != 'INBOUND_MAN') and ($VU_agent_choose_blended > 0) )

						{

							?>

							<input type="checkbox" name="btx_CloserSelectBlended" id="btx_CloserSelectBlended" size="1" value="0" /> <?php echo _QXZ("Activate Outbound Dialling"); ?>

							<?php
						}

						?>

					</td>
				</tr>

			</table>

			<a class="btn btn-sm btn-success" href="#" onclick="CloserSelect_submit('YES');hideDiv('CloserSelectBox_btx');return false;"><?php echo _QXZ("<i class='fas fa-check fa-fw'></i>&nbsp;SUBMIT"); ?></a>


		</div>

		<div class="col">

		</div>

	</div>

</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - footer - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->


<footer class="footer">

	<div class="container-fluid">

		<div class="row">

			<div class="col-3 footer-left">

				<div class="btn-group btn-group-sm">
					<span id='salesstar' style="display: none;"> <i class="fa fa-star fa-3x" id='salesstar' style='color:#ffd700' aria-hidden="true">&nbsp;</i></span>
					<button type="button" class="btn btn-sm btn-primary btx-stats_button" id = 'sales_label_button'><i class="fas fa-crosshairs"></i>&nbsp;<span id='sales_label'>Stats</span></button>
					<!--button type="button" class="btn btn-sm btn-success btx-stats_button"><i class="fas fa-phone fa-fw"></i>&nbsp;01:30 Avg talk</button-->
					<button type="button" id='show_calls_in_queue_button' class="btn btn-sm btn-secondary" title="Calls in Queue" ><i class="fas fa-phone"></i><span id="AgentStatusCalls123">&nbsp;Queue&nbsp;</span></button>
					<button type="button" id='requeue_call_button' class="btn btn-sm btn-warning" title="requeue" onclick="call_requeue_launch();" style="display: none;"><i class="fa fa-undo"></i>&nbsp;Requeue</button>

				</div>

			</div>
			<div class="col-3">
				<button type="button" class="btn btn-sm btn-outline-primary btn-block" id='hotkey_span' onmouseover="quickdispo_in();" onmouseleave="quickdispo_out();" style="display: none;"><i class="fas fa-forward"></i>&nbsp;Quick Dispo</button>
			</div>

			<div class="col-6 footer-right">

				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-sm btn-outline-secondary" id="btx-internal_chat_button" style="display: none;"><i class="fas fa-comments"></i>&nbsp;Comms</button>
					<button type="button" class="btn btn-sm btn-outline-secondary" id="btx-company_button"><i class="fas fa-bank fa-fw"></i>&nbsp;Company</button>
					<button type="button" class="btn btn-sm btn-outline-secondary" id='btx-view-agents'><i class="fas fa-users fa-fw"></i>&nbsp;Agents</button>
					<button type="button" class="btn btn-sm btn-outline-secondary" id="btx_dtmf_button"><i class="fas fa-th fa-fw"></i>&nbsp;Controls</button>
					<button type="button" class="btn btn-sm btn-outline-secondary" id="btx-tech-info_button"><i class="fas fa-support fa-fw"></i>&nbsp;Support</button>
					<button type="button" id="signOutButton" class="btn btn-sm btn-outline-danger DisableWhenNotPaused"><i class="fas fa-close"></i>&nbsp;Sign Out</button>  

				</div>

			</div>

		</div>

	</div>

</footer>

</body>
</html>
