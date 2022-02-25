<!-- //////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// - MODALS - ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// -->



<!-- Logout div -->

<div id="logout-div">
	<div style="background-color: #0E2F44 !important; height: 100vh;">
		<div class="container">
			<br><br><br><br>
			<div class="row text-center">
				<div class="col-3">
				</div>
				<div class="col-6">
					<div class="jumbotron logout1"><span id='logoutwave'>
						<h1 class="display-3"><i class="fa fa-hand-paper-o faa-shake animated fa-2x" aria-hidden="true"></i></h1>
						<h1 class="display-3">Goodbye!</h1></span>
						<h1 class="display-3" id='logouterror' style="display:none;"><i class="fas fa-exclamation fa-2x"></i><br><br></h1>
						<p class="lead" id='logout_reason'>Thank you for using <b>bluetelecoms</b> hosted dialler.</p>
						<hr class="my-4">
						<a id="return_to_login" class="btn btn-primary btn-block"><i class="fas fa-key"></i>&nbsp;Click here to return to login screen</a>
					</div>
				</div>
				<div class="col-3">
				</div>
			</div>
		</div>
	</div>
</div>


<!-- End Logout div -->



<!-- Start of No One In Your Session Modal -->
<div id="agent_upload_image_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">Select Profile image</h6>
			</div>
			<div class="modal-body">
				<div class = 'row'>
					<div class = 'col' class="text-center">
						<img id='btx_img_sample' class='img-fluid rounded mx-auto d-block' style="max-height: 175px;">
					</div>
				</div>
				<div class = 'row'>
					<div class = 'col'>
						<div id='ImageMessage' class="text-center" style="display:none;">Image Waiting Manager Approval</div>
					</div>
				</div>


				<div class = 'row'>
					<div class = 'col'>
						<hr>
						<div class="form-group">
							<label for="ProfileImageUploader">Paste Image Location below:</label>
							<input type="text" class="form-control" id="ProfileImageUploader">
						</div><br>
						<h6><small>Right click on an image and choose 'copy image address' then paste above</small></h6>
					</div>
				</div>				
				<div class="modal-footer">

					<button type="button" class="btn btn-success btn-sm" id = 'submit_profile_image_change'  onclick="change_profile_image();"><i class="fas fa-check fa-fw"></i>Submit Image for Approval</button>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of No One In Your Session Modal -->



<!-- Start of force callback Modal -->
<div id="force_callback_modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title"><i class="fas fa-clock"></i> CALLBACK DUE</h6>
			</div>
			<div class="modal-body">
				You have the following callback due to be called:
				<div class='container'>
					<hr>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>PRIORITY:</div>
						<div class = 'col' id='btx_callback_priority'></div>
					</div>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>CALLBACK TIME:</div>
						<div class = 'col' id='btx_callback_time'></div>
					</div>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>CALLBACK SET:</div>
						<div class = 'col' id='btx_callback_set_time'></div>
					</div>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>COMMENTS:</div>
						<div class = 'col' id='btx_callback_comments'></div>
					</div>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>CLIENT:</div>
						<div class = 'col' id='btx_callback_client_name'></div>
					</div>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>POSTCODE:</div>
						<div class = 'col' id='btx_callback_postcode'></div>
					</div>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>PHONE:</div>
						<div class = 'col' id='btx_callback_phone'></div>
					</div>
					<div class= 'row' id = 'cbk_popup_alt_phone_span'>
						<div class = 'col font-weight-bold'>ALT PHONE:</div>
						<div class = 'col' id='btx_callback_alt_phone'></div>
					</div>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>CURRENT STATUS:</div>
						<div class = 'col' id='btx_callback_current_status'></div>
					</div>
					<div class= 'row'>
						<div class = 'col font-weight-bold'>LEAD NOTES:</div>
						<div class = 'col' id='btx_callback_lead_comments'></div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" id='cbk_popup_dial_main' class="btn btn-success btn-sm btx_none_session" data-dismiss="modal">Dial Main</button>
					<button type="button" id='cbk_popup_dial_alt' class="btn btn-info btn-sm btx_none_session" data-dismiss="modal">Dial Alt</button>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- End of force callback Modal -->


<!-- Start of force callback Modal -->
<div id="confirm_callback_remove" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">CALLBACK REMOVAL</h6>
			</div>
			<div class="modal-body">
				Are you sure you would like to switch callback to 'ANYONE':
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
					<button type="button" id='cbk_remove_confirm_button' class="btn btn-danger" data-dismiss="modal">YES</button>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of force callback Modal -->







<!-- Start of No One In Your Session Modal -->
<div id="no-one-in-your-session" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">YOU ARE NOT CONNECTED TO A PHONE</h6>
			</div>
			<div class="modal-body">
				Your Unique Session ID: <span class="sessionID_val"></span>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning btn-sm btx_none_session" data-dismiss="modal" onclick="NoneInSessionOK();hideDiv('NoneInSessionBox');return false;">Cancel</button>
					<button type="button" class="btn btn-success btn-sm btx_none_session" id = 'redialphone_button' data-dismiss="modal" onclick="NoneInSessionCalL();hideDiv('NoneInSessionBox');return false;"><i class="fas fa-check fa-fw"></i>Redial Phone</button>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of No One In Your Session Modal -->

<!-- Start of Alert Modal -->
<div id="alert_modal_popup" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">AGENT NOTIFICATION</h6>
			</div>
			<div class="modal-body">
				<span id="alert_modal_popup_msg"></span>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning btn-sm btx_none_session" data-dismiss="modal" onclick="hideDiv('AlertBox');return false;">Dismiss</button>


				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of No One In Your Session Modal -->


<!-- Start of Alert Modal -->
<div id="btx_TimerSpan" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">AGENT NOTIFICATION</h6>
			</div>
			<div class="modal-body">
				<span id="btx_TimerSpan_popup_msg"></span>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning btn-sm btx_none_session" data-dismiss="modal" onclick="hideDiv('TimerSpan');return false;">Dismiss</button>


				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of No One In Your Session Modal -->


<!-- Start of No One In Your Session Modal -->
<div id="time_sync_error_popup" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">THERE IS A SYSTEM TIME SYNC ERROR</h6>
			</div>
			<div class="modal-body">
				Please contact your dialler manager.
				<div class="modal-footer">
					<button type="button" class="btn btn-warning btn-sm btx_none_session" data-dismiss="modal" onclick="hideDiv('SysteMDisablEBoX');$('#time_sync_error_popup').modal('hide');return false;">Go Back</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of No One In Your Session Modal -->



<!-- Start of Customer has gone Modal -->
<div id="btx_CustomerGoneBox" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">CLIENT HAS HUNG UP</h6>
			</div>
			<div class="modal-body">
				Please select an option:
				<div class="modal-footer">
					<button type="button" class="btn btn-warning btn-sm btx_none_session" data-dismiss="modal" onclick="CustomerGoneOK();hideDiv('CustomerGoneBox');return false;">Hide</button>
					<button type="button" class="btn btn-success btn-sm btx_none_session hangup_and_show_dispo" data-dismiss="modal"  onclick="dialedcall_send_hangup('','','','','YES');hideDiv('CustomerGoneBox');$('#modal-outcome').modal('show');return false;"><i class="fas fa-check fa-fw"></i>Disposition Call</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of Customer has gone Modal -->


<!-- Start Pause Codes Modal -->
<div id="modal-pause-codes" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content" id="pause_width">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">Please select a pause reason:</h6>
			</div>
			<div class="modal-body">
				<div class="row text-center" id="btx_pause_codes">

				</div>
				<br>
				<div class="modal-footer">
					<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" id="btx_submit_pause_button" disabled><i class="fas fa-check fa-fw"></i>Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Pause Codes Modal -->

<!-- Start of Dispo Modal -->
<div id="modal-outcome" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content" id="dispos_width">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">Please select an outcome:</h6>
			</div>
			<div id="autodispo-modal-outcome" class="modal-body" style="display:none;">
				Auto disposition selected please wait ...
			</div>
			<div id="normal-modal-outcome" class="modal-body">
				<div class="form-group row" style="display:none;" id="btx_input_call_notes_dispo_area">
					<div class="col">
						<textarea class="form-control" rows="4" placeholder="Call Notes (Permanently Stored)" maxlength="254" id="btx_input_call_notes_dispo"></textarea>
					</div>
				</div>

	<input type="hidden" name="DispoSelection" id="DispoSelection" /> 
	<!--end-->
	<div class="row text-center" id="btx_the_dispos"></div>
	<br>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id='dispohidebutton'><i class="fas fa-minus fa-fw"></i>Hide</button>
		<button id="submit_and_pause_button" type="button" class="btn btn-warning btn-sm" data-dismiss="modal" disabled><i class="fas fa-pause fa-fw"></i>Submit &amp; Pause</button>
		<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" id="btx_submit_and_continue" disabled><i class="fas fa-check fa-fw"></i>Submit &amp; Continue</button>
	</div>
</div>
</div>
</div>
</div>
<!-- End of Dispo Modal -->



<!-- Start of Dispo Modal -->
<div id="modal-new-callbacks" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content" id="dispos_width">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">Callback Details:</h6>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class='col'>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><span class="fa fa-calendar"></span></div>
							</div>
							<input type='text' class="form-control" id='datetimepicker1' />
						</div> 
					</div>
				</div>
				<br>
				<div class = "row">
					<div class='col-6'>
						<div class="form-check mb-2 mr-sm-2">
							<input class="form-check-input" type="checkbox" id="mycallbackonly">
							<label class="form-check-label" for="mycallbackonly">
								My Callback Only
							</label>
						</div>
					</div>
					<div class='col' id='callbackpriority'>
						<div class="form-check-inline">
							<div class="radio radio-success">
								<input type="radio" class="form-check-input" name="CBKpriority" id="CBKpriorityHigh"><span class='badge badge-success'>High</span>
							</div>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="CBKpriority" id="CBKpriorityMed" checked><span class='badge badge-warning'>Med</span>
							</label>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="CBKpriority" id="CBKpriorityLow"><span class='badge badge-danger'>Low</span>
							</label>
						</div>

					</div>
				</div>
				<br>
				<div clas='row' id='callbacknotesection' style="display:none;">
					<div class='col'>
						<div class="form-group">
							<label for="callbacknotes">Callback Notes</label>
							<textarea class="form-control" id="callbacknotes" rows="3"  maxlength="255"></textarea>
						</div>
					</div>
				</div>
				<br>
				<div class ="row">
					<div class='col'>
						<table class="table table-sm" id='callbacks_set_so_far'>

						</table>
					</div>
				</div>



			</div>
			<div class="modal-footer">
<!-- buttons need sorting out 
	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-minus fa-fw"></i>Close</button-->
		<button id="call_back_submit_and_pause_button" type="button" class="btn btn-success btn-sm" data-dismiss="modal" disabled><i class="fas fa-pause fa-fw"></i>Confirm Callback &amp; Pause</button>
		<button id="call_back_submit_button" type="button" class="btn btn-success btn-sm" data-dismiss="modal" disabled><i class="fas fa-pause fa-fw"></i>Confirm Callback</button>		
	</div>
</div>
</div>

</div>
<!-- End of Dispo Modal -->



<!-- Start of Pre callback Modal -->
<div id="modal-pre-callbacks" class="modal fade" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content" id="dispos_width">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title">Callback Diary View</h6>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class='col'>
						<small>Details entered here will be saved for use within the callback window for this call</small>
					</div>
				</div>
				<br>
				<div class="row">
					<div class='col'>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><span class="fa fa-calendar"></span></div>
							</div>
							<input type='text' class="form-control" id='datetimepicker2' />
						</div> 
					</div>
				</div>
				<br>
				<div class = "row">
					<div class='col-6'>
						<div class="form-check mb-2 mr-sm-2">
							<input class="form-check-input" type="checkbox" id="pre_mycallbackonly">
							<label class="form-check-label" for="pre_mycallbackonly">
								My Callback Only
							</label>
						</div>
					</div>
					<div class='col' id='pre_callbackpriority'>
						<div class="form-check-inline">
							<div class="radio radio-success">
								<input type="radio" class="form-check-input" name="pre_CBKpriority" id="pre_CBKpriorityHigh"><span class='badge badge-success'>High</span>
							</div>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="pre_CBKpriority" id="pre_CBKpriorityMed" checked><span class='badge badge-warning'>Med</span>
							</label>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="pre_CBKpriority" id="pre_CBKpriorityLow"><span class='badge badge-danger'>Low</span>
							</label>
						</div>

					</div>
				</div>
				<br>
				<div clas='row' id='pre_callbacknotesection' style="display:none;">
					<div class='col'>
						<div class="form-group">
							<label for="pre_callbacknotes">Callback Notes</label>
							<textarea class="form-control" id="pre_callbacknotes" rows="3"  maxlength="255"></textarea>
						</div>
					</div>
				</div>
				<br>
				<div class ="row">
					<div class='col'>
						<table class="table table-sm" id='pre_callbacks_set_so_far'>

						</table>
					</div>
				</div>



			</div>
			<div class="modal-footer">
		
		<button  type="button" class="btn btn-success btn-sm" data-dismiss="modal"><i class="fas fa-save fa-fw"></i>&nbsp;Save</button>		
	</div>
</div>
</div>

</div>
<!-- End of Pre callback  -->






<div id="preset-modal" class="modal fade" data-dismiss="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header blue-brand2">
				<h6 class="modal-title"><i class="fas fa-exchange-alt"></i>&nbsp;SELECT A PRESET</h6>
			</div>
			<div class="modal-body">
				<span id="PresetsSelectBoxContent"> <?php echo _QXZ("Presets Selection"); ?> </span>
			</div></div></div></div>


			<span style="" id="LeaDInfOBox">
				<div class="modal fade bd-example-modal-lg" id="modal-default-info" role="dialog" id = 'lead_info_modal'>
					<div class="modal-dialog modal-lg" role="document">
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
										<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" aria-expanded="true">Info</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" aria-expanded="false">Call History</a>
									</li>
								</ul>

								<span id="LeaDInfOSpan_btx" style="overflow: auto;display: block;height: 450px;"> <?php echo _QXZ("Lead Info"); ?> </span>

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</font>

						</div>
					</div></div></div>
				</span>



