<!-- from here we can set the settings for the interface, such as switching the api on and off -->
<!-- but also we need to be able to get the current settings form the csv and accordingly update the screen here with the current settings -->
<!-- in order to create a new setting all you need to do is add a new checkbox with an id that will be used for the setting name and the value will -->
<!-- be based on the checkbox checked or unchecked property, so ON or OFF -->
<!DOCTYPE html>
<html>
<head>
	<title>Interface Settings</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<style>
	.success_msg{
		border-width: 1px;
		border-radius: 5px;
		background-color: green;
		padding-left: 10px;
		padding-right: 10px;
		color: white;
	}
	.error_msg{
		border-width: 1px;
		border-radius: 5px;
		background-color: red;
		padding-left: 10px;
		padding-right: 10px;
		color: white;
	}
	body{
		color: white;
		background-color: #122333;
		padding-top: 100px;
	}
	.label_set_name{
		display: inline;
		font-size: 18px;
		margin: 10px;
	}
</style>
<script>


function change_values(what,user)
{
if (what =='target'){var newtarget = $('#'+user+'_target').val();}else{var newtarget='NA'}

var url = "get_data/data.php"; // This is the file that handles the request
    $.ajax({
            url: url,
            type: 'post',
            data: {"query":"manager_update_agent","what":what,'user':user,'newtarget':newtarget},
            success: function(data_)
            {
  				
               if(data_)  //This is returned from the PHP request
               {
               	
    			 var listJson = JSON.parse(data_);


             	}

             }
    });

}

function get_agent_settings()
{
	var url = "get_data/data.php"; // This is the file that handles the request
    $.ajax({
            url: url,
            type: 'post',
            data: {"query":"get_agents_manager"},
            success: function(data_)
            {
  				var agents ='<font style="color:red;">Adding H after the target gives Sales per Hour - Adding D gives Sales per Dialled Hour (no pause)</font></br><table class="table table-hover">';
               if(data_)  //This is returned from the PHP request
               {
               	
    			 var listJson = JSON.parse(data_);

  				console.log(listJson);
  		         $.each(listJson, function(i, item)
                       {		
  				agents += "<tr style='color:black;'><td>";
    		    agents += item.full_name;		
    			agents += "</td>";

                if (item.custom_one.slice(0, 3) == 'BTX')
                	{
                		var userarray = item.custom_one.split("-");	
                        
                		agents += "<td>";
                		if (userarray[2])
                		{
    						agents += "<img src='"+userarray[2]+"' class='img-fluid rounded mx-auto d-block' style='max-height: 75px;'>";
                		}
    					agents += "</td><td>";
               			if (userarray[3]=='N')
               			{
    						agents += '<button type="button" onclick="change_values(\'approve\',\''+item.user+'\')" class="btn btn-success">Approve</button>';
    						agents += '<button type="button" onclick="change_values(\'remove\',\''+item.user+'\')" class="btn btn-danger">Decline</button>';
    					}
    					else if (userarray[3]=='Y')
    					{
    						agents += '<button type="button" onclick="change_values(\'remove\',\''+item.user+'\')" class="btn btn-primary">Remove</button>';
    					}
						agents += "</td><td>";
    					if (userarray[1]){var target=userarray[1];}else{var target=0;}
    					agents += '<input id="'+item.user+'_target" type="text" class="form-control" id="text" Placeholder="'+target+'">';
						agents += "</td><td>";
    						agents += '<button type="button"  class="btn btn-success" onclick="change_values(\'target\',\''+item.user+'\')">Change Target</button>';
    					agents += "</td>";

						
             		}
             		 else
                	{
                		                       
                        agents += "<td></td><td></td><td>";
    					    agents += '<input id="'+item.user+'_target" type="text" class="form-control" id="text" Placeholder="0">';
    					agents += "</td>";
    					agents += "<td>";
    						agents += '<button type="button" onclick="change_values(\'target\',\''+item.user+'\')" class="btn btn-success">Change Target</button>';
    					agents += "</td>";
						
             		 }
             		agents += "</tr>";
   
             		 });
             	}
     agents += "</div>";
  $('#agentcontrols').html(agents);
             }


    });
}

	var allowchanges ='NO';
	$(function(){



get_agent_settings();


// run the function to update the settings values on the screen
update_screen();
// two variables, one for the setting name and the second for the setting value
var btx_setting_name = '';
var btx_setting_value = '';

// change this to "this"
$(".settings_buttons").on("change", function(){
	if (allowchanges=='YES'){
	if($(this).is(":checked")){
		btx_setting_name = this.id;
		btx_setting_value = "on";
		console.log(btx_setting_name + " " + btx_setting_value);
		update_setting(btx_setting_name, btx_setting_value);
	} else {
		btx_setting_name = this.id;
		btx_setting_value = "off";
		console.log(btx_setting_name + " " + btx_setting_value);
		update_setting(btx_setting_name, btx_setting_value);
	}
}
});
// function to run a get ajax that will update the currently selected setting
function update_setting(name, value){
	$.ajax({
		url: "btx_settings_csv.php",
		type: "get",
		data: { setting_name : name, setting_value : value },
		success: function(response) {
//Do Something
response = JSON.parse(response);
console.log(response);
},
error: function(xhr) {
// Do Something to handle error
console.log(xhr);
}
});
}
// function to update the settings screen controls with the current values, such as ON or OFF for each setting
// this function needs to be ran as soon as the page has loaded
function update_screen(){
// the function will expect an array back from the ajax call which will have all the values for each setting. Based on the array content we update each setting value
$.ajax({
	url: "btx_settings_csv.php",
	type: "get",
	data: { get_screen_update : "true" },
	success: function(response) {
//Do Something
response = JSON.parse(response);
arraysize = response.length;
var counter = 0;
$.each(response, function(i, item){
// item[0] will return the name of the setting
// item[1] will return "on" or "off", which we can then use in the method call of $el.bootstrapToggle(item[1]);
$("#"+item[0]).bootstrapToggle(item[1]);
counter ++
if (counter == arraysize) {allowchanges='YES';}
});
},
error: function(xhr) {
// Do Something to handle error
console.log(xhr);
}
});


$.ajax({
	url: "btx_settings_csv.php",
	type: "get",
	data: { get_screen_names_update : "true" },
	success: function(response) {
//Do Something
response = JSON.parse(response);

$.each(response, function(i, item){
if (item[0] == 'btx_expandscript_input'){
	$('#'+item[0]).val(item[1]);
}
	else
	{
	$('#'+item[0]).attr("placeholder", item[1]);
	}
// item[0] will return the name of the setting
// item[1] will return "on" or "off", which we can then use in the method call of $el.bootstrapToggle(item[1]);

});
},
error: function(xhr) {
// Do Something to handle error
console.log(xhr);
}
});


}

/////////////////// setting the name of elements in the new interface /////////////////
$(".name_setting_buttons").on("click", function(){
	var id_of_element = (this.id).slice(0,-7)+"_input";
	var new_name_for_element = $("#"+id_of_element).val();

	update_name_of_el(id_of_element, new_name_for_element);
});

function update_name_of_el(id, el_name){
	$.ajax({
		url: "btx_settings_csv.php",
		type: "get",
		data: { id_of_el : id, new_name_of_el: el_name },
		success: function(response) {
//Do Something
console.log(response);
},
error: function(xhr) {
// Do Something to handle error
console.log(xhr);
}
});
}


});
</script>

</head>

<body>



<div id="agent_settings" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
		<div class='table-responsive' id='agentcontrols'>



    	</div>

    </div>
  </div>
</div>
<!-- End of No One In Your Session Modal -->








	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">

				<a class="navbar-brand" href="#">Interface Settings</a>

			</div>
		</div>
	</nav>

<div class="container">

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// - START Settings for disabling/removing elements in the new interface - ////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- The div below represents one setting, to implement more settings duplicate the code below with the new setting name/id -->





<div class="container">

	<h3>User Targets and profile images:</h3><br>

	<div class="row">

		<div class="col-xs-6">


				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agent_settings" onclick='get_agent_settings();'> Edit User Profile Images and Targets</button>



		</div>

	</div>

</div>

<hr>



<div class="container">



	<h3>Configurable Buttons:</h3><br>


	<div class="row">


		<div class="col-xs-6">


			<div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_gmaps_weather" class="settings_buttons"> Google Maps and Weather Info &nbsp;
				</label>
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_log_control" class="settings_buttons"> Agent Log Control &nbsp;
				</label>
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_DNC_control" class="settings_buttons"> Agent DNC Access Control &nbsp;
				</label>
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_search_control" class="settings_buttons"> Agent Search Records Control &nbsp;
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_extend_callback_display" class="settings_buttons"> Extend Callback Displays &nbsp;
				</label>
			</div>
		</div>


		<div class="col-xs-6">


			<div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_expand_script_control" class="settings_buttons"> Expand Script Control &nbsp;
				</label>
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_timers_control" class="settings_buttons"> Call Timers Control &nbsp;
				</label>
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_edit_profile_control" class="settings_buttons"> Edit Profile&nbsp; 
				</label>
			</div>

		  <div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_diary_button_control" class="settings_buttons"> Diary Button &nbsp;
				</label>
			</div>

		  <div class="checkbox">
				<label>
					<input type="checkbox" data-toggle="toggle" id="btx_ringing_control" class="settings_buttons"> Ringing on inbound &nbsp;
				</label>
			</div>


		</div>

		<div class='col-xs-6'>
			<div class="label_set_name">
				Expand Script By Default:<br>
				<label>
					<select class="form-control"  id="btx_expandscript_input">
					  <option value="No">No</option>
  						<option value="Yes">Yes</option>

  					</select>
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_expandscript_button">Set</a>
			</div>

		</div>
	</div>
</div>

</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// - START Settings for disabling/removing elements in the new interface - ////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<hr>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// - START Settings for changing the names of elements in the new interface - /////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<div class="container">


	<h3>API Settings:</h3><br>

	<div class="row">

		<div class="col">


			<div class="label_set_name">
				API 1 Name:
				<label>
					<input type="text" class="form-control" placeholder="Set New Name" id="btx_api_one_name_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_api_one_name_button">Set</a>
			</div>

			<div class="label_set_name">
				API 2 Name:
				<label>
					<input type="text" class="form-control" placeholder="Set New Name" id="btx_api_two_name_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_api_two_name_button">Set</a>
			</div>




		</div>
	</div>
</div>

<hr>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// - END Settings for changing the names of elements in the new interface - /////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<div class="container">

	<h3>Company Details:</h3><br>
	Please type a space and press 'Set' to blank any details from the agent interface

	<div class="row">

		<div class="col-xs-6">




			<div class="label_set_name">
				Logo:<br>
				<label>
					<input type="text" class="form-control" placeholder="Paste Logo address" id="btx_logo_address_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_logo_address_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Name:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Name" id="btx_company_name_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_name_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Address:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Address" id="btx_company_address_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_address_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Postcode:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Postcode" id="btx_company_postcode_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_postcode_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Tel:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Telephone" id="btx_company_telephone_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_telephone_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Tel2:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Telephone" id="btx_company_telephone2_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_telephone2_button">Set</a>
			</div>

			<br>

			<div class="label_set_opening_hours">
				Opening Hours:<br>
				<label>
					<input type="text" class="form-control" placeholder="Opening Hours" id="btx_company_openinghours_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_openinghours_button">Set</a>
			</div>

		</div>


		<div class="col-xs-6">


			<div class="label_set_name">
				Email:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Email" id="btx_company_email_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_email_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Website:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Website" id="btx_company_website_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_website_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Reg1:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Reg1" id="btx_company_reg1_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_reg1_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Reg2:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Reg2" id="btx_company_reg2_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_reg2_button">Set</a>
			</div>

			<br>

			<div class="label_set_name">
				Reg3:<br>
				<label>
					<input type="text" class="form-control" placeholder="Company Reg3" id="btx_company_reg3_input">
				</label>
				<a class="btn btn-primary name_setting_buttons" href="#" role="button" id="btx_company_reg3_button">Set</a>
			</div>


		</div>

	</div>

</div>

<hr>

</div>

</body>
</html>
