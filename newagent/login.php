<!--

  _     _            _       _
 | |   | |          | |     | |
 | |__ | |_   _  ___| |_ ___| | ___  ___ ___  _ __ ___  ___
 | '_ \| | | | |/ _ \ __/ _ \ |/ _ \/ __/ _ \| '_ ` _ \/ __|
 | |_) | | |_| |  __/ ||  __/ |  __/ (_| (_) | | | | | \__ \
 |_.__/|_|\__,_|\___|\__\___|_|\___|\___\___/|_| |_| |_|___/

 support@bluetelecoms.com


-->

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

	<title>Agent Login</title>
<?php 


//////UPDATE THE VERSION HERE!!!!!!!!!!!!

$version = '6.1.17';

/////////////////////////////////////////


if (isset($_GET["phone_login"]))                {$phone_login=$_GET["phone_login"];}
        elseif (isset($_POST["phone_login"]))   {$phone_login=$_POST["phone_login"];}
if (isset($_GET["phone_pass"]))					{$phone_pass=$_GET["phone_pass"];}
        elseif (isset($_POST["phone_pass"]))    {$phone_pass=$_POST["phone_pass"];}
if (isset($_GET["VD_login"]))					{$VD_login=$_GET["VD_login"];}
        elseif (isset($_POST["VD_login"]))      {$VD_login=$_POST["VD_login"];}
if (isset($_GET["VD_pass"]))					{$VD_pass=$_GET["VD_pass"];}
        elseif (isset($_POST["VD_pass"]))       {$VD_pass=$_POST["VD_pass"];}
if (isset($_GET["VD_campaign"]))                {$VD_campaign=$_GET["VD_campaign"];}
        elseif (isset($_POST["VD_campaign"]))   {$VD_campaign=$_POST["VD_campaign"];}
if (isset($_GET["phone"]))                {$phone_login=$_GET["phone"];}
        elseif (isset($_POST["phone"]))   {$phone_login=$_POST["phone"];}
if (isset($_GET["pass"]))					{$phone_pass=$_GET["pass"];}
        elseif (isset($_POST["pass"]))    {$phone_pass=$_POST["pass"];}

?>


<style type="text/css">

@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,900");

html,body {
	background: #122333;
	background: -webkit-linear-gradient(to right, #122333, #122333);
	background: linear-gradient(to right, #122333, #122333);
	height: 100%;
	margin: 0;

	z-index:9000!important;
}

<?php $imageurl = 'https://cdn.bluetelecoms.com/img/clientbg.png?'.rand(1,10000); ?>
.back{
  background: url(<?php echo $imageurl; ?>);
  background-repeat: no-repeat;
  background-size: 100% 100%;
  opacity: 0.5;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
  z-index:8000!important;
  
     
}

.login-container{
	z-index:9001!important;
	margin: 0 auto;
	width: 346px; 
	padding-top: 50px;
}

.form-group {
	z-index:9001!important;
	margin-top: 15px;
}

.login-form {
	font-family: 'Source Sans Pro', sans-serif;
	width: 346px;
	text-align: center;
	z-index:90001!important;
/*	top: 30%;
left: 50%;
transform: translate(-50%, -50%);*/
margin: auto;
position: absolute;
}

.login-form .login-username,
.login-form .login-password,
.login-form .login-campaign,
.login-form .login-dropdown,
.login-form .login-submit {
	-webkit-appearance: none;
	height: 45px;
	border-radius: 4px;
	border: none;
	width: 301px;
	display: block;
	box-shadow: rgba(0, 0, 0, 0.1) 3px 3px 5px;
	font-size: 13px;
}

.login-form label {
	height: 45px;
	width: 45px;
	background: white;
	display: inline-block;
	border-radius: 0 4px 4px 0;
	margin-left: -2px;
}

.login-form label > i {
	width: 15px;
	height: 100%;
	text-align: center;
	fill: #2b5876;
	vertical-align: middle;
}

.login-icon{
	display:inline-block;
	font-size: 22px;
	margin-top: 10px;
	line-height: 22px;
	color: #2b5876;
	width: 22px;
	height: 22px;
	text-align: center;
	vertical-align: bottom;
}

.login-form .login-username, .login-form .login-password, .login-form .login-campaign {
	padding: 0 20px 0 20px;
	float: left;
	border-radius: 4px 0 0 4px;
	box-sizing: border-box;
}

.login-form .login-submit {
	color: white;
	background: #2ecc71;
	width: 100%;
	cursor: pointer;
	font-size: 14px;
	font-weight: bold;
}

.login-form .login-submit:hover, .login-form .login-submit:active {
	background: #27ae60;
	outline: none;
}

.login-form input:focus, .login-form input:focus {
	outline: 0;
}

.login-form h1, .login-form p, .login-form a {
	color: white;
	margin: 10px 0 10px 0;
	text-decoration: none;
}

.login-form h1 {
	font-weight: 100;
	margin-bottom: 20px;
	font-size: 42px;
	font-family: 'Source Sans Pro', sans-serif;

}

.login-form .login-motd {
	font-size: 14px;
	width: 300px;
	margin: 0 auto 20px auto;
}

.text-checkbox {
	color : #c1c1c1;
}



#footer {
		background-image: -moz-linear-gradient(top, rgba(0,0,0,0), rgba(0,0,0,0.5) 75%);
		background-image: -webkit-linear-gradient(top, rgba(0,0,0,0), rgba(0,0,0,0.5) 75%);
		background-image: -ms-linear-gradient(top, rgba(0,0,0,0), rgba(0,0,0,0.5) 75%);
		background-image: linear-gradient(top, rgba(0,0,0,0), rgba(0,0,0,0.5) 75%);
		bottom: 0;
		cursor: default;
		height: 6em;
		left: 0;
		line-height: 8em;
		position: absolute;
		text-align: center;
		width: 100%;
		color: white;
		font-family: 'Source Sans Pro', sans-serif;
		font-size: 17px;
}

</style>

<link rel="stylesheet" href="https://cdn.bluetelecoms.com/agent/static/fontawesome-5.10/css/all.css">

<script type="text/javascript" src="https://cdn.bluetelecoms.com/agent/static/jquery/jquery-3.2.1.min.js"></script>

<script>

function count(main_str, sub_str) 
    {
    main_str += '';
    sub_str += '';

    if (sub_str.length <= 0) 
    {
        return main_str.length + 1;
    }

       subStr = sub_str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
       return (main_str.match(new RegExp(subStr, 'gi')) || []).length;
    }

function versions(ver){
var url = "../bluetelecoms/get_data/login_data.php"; // This is the file that handles the request
     $.ajax({
             url: url,
             type: 'post',
             dataType : "html",
             data: {"action":"version_control","version":ver},

         });
 }

$( document ).ready(function() {


 versions('<?php echo $version; ?>');



$(document).on("keydown", "form", function(event) { 
    return event.key != "Enter";
});


$('.login_credentials').on('change',function(){
	update_campaigns();
});

$('#campagin_label').on('click',function(){
	update_campaigns();
});

$('#Campaign_placeholder').on('click',function(){
	update_campaigns();
});

///Function to populate the campaigns dropdown - occurs on update of user fields or if refresh button is pressed
function update_campaigns(){
$('#error_span').hide();
   	if (($('#VD_login').val() !='') && ($('#VD_pass').val() !=''))
   		{
   			var url = "../vdc_db_query.php"; // This is the file that handles the request
                $.ajax({
                        url: url,
                        type: 'post',
                        dataType : "html",
                        data: {"query":"callbacks_set","user":$('#VD_login').val(),"pass":$('#VD_pass').val(),"ACTION":'LogiNCamPaigns'},
                        success: function(data_)
                        {
                        
                                if(data_)  //This is returned from the PHP request
                                {
              							//console.log(data_)
   
   										///if theres campaigns avaliable
										if(data_.includes('-- PLEASE SELECT A CAMPAIGN --'))
										{

											if ($('#phone_login').val()=='')
												{
													get_user_phone();
												}

											data_ = data_.replace('', "<select size=1 name=VD_campaign id=VD_campaign>");
											data_ = data_.replace('', "</select>");

											///if theres no campaigns...
											if (count(data_,'</option>') == 1)
											{
												$('#Campaign_placeholder').attr('placeholder','No Active Campaigns');
											}
											///if theres only 1 campaign remove the select message and default to the campaign
											else if (count(data_,'</option>') == 2)
											{
												data_ = data_.replace('<option value="">-- PLEASE SELECT A CAMPAIGN --</option>','');

												//console.log('menu shoud be:' + data_)
												$('#Campaign_placeholder').hide();
												$('#VD_campaign').show();
												$('#VD_campaign').html(data_);
											}
											///if theres more than 1 reword the select message
											else if (count(data_,'</option>') > 2)
											{
												//console.log('menu shoud be:' + data_)
												data_ = data_.replace( '-- PLEASE SELECT A CAMPAIGN --','Please Select a Campaign');
												$('#Campaign_placeholder').hide();
												$('#VD_campaign').show();
												$('#VD_campaign').html(data_);
											}
											
										}

										///if the login details are incorrect
										if(data_.includes('-- USER LOGIN ERROR --'))
											{
												$('#Campaign_placeholder').attr('placeholder','Campaign');
												$('#Campaign_placeholder').show();
												$('#VD_campaign').hide();
												$('#VD_campaign').html('');
											}
                            	}

                               
                         }

                });
   		}


  }

$("#selectphone").change(function() {
	$('#error_span').hide();
    if(this.checked) {
        $('#dropdown_menu').show();
        get_all_phones();
    }
    else
    {
    	$('#dropdown_menu').hide();
    }
});

update_campaigns();

///Function to update the phone field if they are empty
function get_user_phone(login){

   	if (($('#VD_login').val() !='') && ($('#VD_pass').val() !=''))
   		{
   			var url = "../bluetelecoms/get_data/login_data.php"; // This is the file that handles the request
                $.ajax({
                        url: url,
                        type: 'post',
                        dataType : "html",
                        data: {"query":"get_phone_from_user","user":$('#VD_login').val()},
                        success: function(data_)
                        {
                        
                                if(data_)  //This is returned from the PHP request
                                {
              							//console.log(data_)

              							var listJson = JSON.parse(data_);

              							if (listJson.phone_pass)
              							{

							
													$('#phone_login').val(listJson.phone_login);
													$('#phone_pass').val(listJson.phone_pass);
												

													if (login =='login'){startlogin();}

              							}
              							else
              							{
              										if (login =='login'){startlogin();}
              							}
   

                            	}

                               
                         }

                });
   		}




  }




///Function to update the phone dropdown
function get_all_phones(){


    var url = "../bluetelecoms/get_data/login_data.php"; // This is the file that handles the request
        $.ajax({
                url: url,
                type: 'post',
                dataType : "html",
                data: {"query":"get_all_phones"},
                success: function(data_)
                {
                
                        if(data_)  //This is returned from the PHP request
                        {
      							//console.log(data_)

      							var listJson = JSON.parse(data_);
      							var dropdown = '<option value="">Please Select a Phone</option>';
                                $.each(listJson, function(i, item)
                                  {
                                  	dropdown += '<option value="'+item.login+'">Phone: '+item.login+'</option>';

                                  });
   
						$('#phone_login_dropdown').html(dropdown);
                    	}     
                 }
        });
   		



}



$("#phone_login_dropdown").change(function() {
	$('#error_span').hide();
    if(this.value != '') {
   			$('#phone_login').val(this.value);
   			var url = "../bluetelecoms/get_data/login_data.php"; // This is the file that handles the request
                $.ajax({
                        url: url,
                        type: 'post',
                        dataType : "html",
                        data: {"query":"update_phone_pass","phone":$('#phone_login').val()},
                        success: function(data_)
                        {
                        
                                if(data_)  //This is returned from the PHP request
                                {
              							//console.log(data_)

              							var listJson = JSON.parse(data_);
										$('#phone_pass').val(listJson.phone_pass);
              							
                            	}
                               
                         }

                });

    }

});


$(".login_credentials").keyup(function(event) {
    if (event.keyCode === 13) {
		$('#error_span').hide();
		get_user_phone('login');
    }
});


/// on login

$("#bluetelecoms_login").click(function() {
	$('#error_span').hide();
	get_user_phone('login');

});

function startlogin()
{
	    if(($('#VD_login').val() !='') && ($('#VD_pass').val() !='') && ($('#phone_login').val() !='') && ($('#phone_pass').val() !='') && ($('#VD_campaign').val() !='')) {

    		/////check login or error
    		//// check user - check phone is active 
    		//// check leads in hopper setting
    		//// check sessions!??!?!

    		var url = "../bluetelecoms/get_data/login_data.php"; // This is the file that handles the request
                $.ajax({
                        url: url,
                        type: 'post',
                        dataType : "html",
                        data: {"query":"login_attempt","phone":$('#phone_login').val(),"phone_pass":$('#phone_pass').val(),"user":$('#VD_login').val(),"user_pass":$('#VD_pass').val(),"campaign":$('#VD_campaign').val()},
                        success: function(data_)
                        {
                        
                                if(data_)  //This is returned from the PHP request
                                {
              							//console.log(data_)

              							var listJson = JSON.parse(data_);
										
										if (listJson.error=='')
										{
											$('#VD_login').val(listJson.usercase)
											//console.log('success');
											document.getElementById("SUBMIT").click();
										}
										else
										{
											$('#error_span').show().html(listJson.error)
										}

              							
                            	}
                               
                         }

                });
    }
    else
    {
    	if (($('#VD_login').val() =='') || ($('#VD_pass').val() ==''))
    		{
    			$('#error_span').show().html('ERROR : User Details Missing')
    		}
    	 else if ($('#VD_campaign').val() =='') 
    		{
    			$('#error_span').show().html('ERROR : Campaign Not Selected')
    		}
    	 else if (($('#phone_login').val() =='') || ($('#phone_pass').val() ==''))
    		{
    			$('#error_span').show().html('ERROR : No Phone Details Available')
    		}
    }
}

});

</script>
</head>

<body>
<div class='back'></div>
	<div class="login-container">

		<div class="login-form">

			<form method="POST" action="../bluetelecoms.php" id="myform">
				<div class="company-brand">
					<img src="btx-logo-sml.png">
				</div>
				<br>
				<p class="login-motd">Please enter your login credentials.</p>

				<!-- Phone login dropdown hidden until box checked-->
				<span id='dropdown_menu' style="display: none;">
					<select id='phone_login_dropdown' name='phone_login_dropdown'  class='login-campaign'>
					</select>
					<label for="phone_login_dropdown">
						<i class="fas fa-fw fa-phone login-icon"></i>
					</label>
				</span>

				<input type='hidden' id="phone_login" name="phone_login" class="login-username" type="test"  value="<?php echo $phone_login; ?>"/>						
				<input type='hidden' id="phone_pass" name="phone_pass" class="login-password" type="password"  value="<?php echo $phone_pass; ?>"/>

				<input type='hidden' id="btx_login_check_flag" name="btx_login_check_flag"   value="OK"/>			
				<br><br>

				<input id="VD_login" name="VD_login" class="login-username login_credentials" type="text" placeholder="Agent ID"  value="<?php echo $VD_login; ?>" />
				<label for="VD_login">
					<i class="fas fa-fw fa-user login-icon"></i>
				</label>

				<br><br>

				<input id="VD_pass" name="VD_pass" class="login-password login_credentials" type="password" placeholder="Agent Password"  value="<?php echo $VD_pass; ?>"/>
				<label for="VD_pass">
					<i class="fas fa-fw fa-lock login-icon"></i>
				</label>

				<br><br>

				<input id="Campaign_placeholder" class="login-password" placeholder="Campaign" disabled/>
				<select id="VD_campaign" name="VD_campaign" class="login-campaign" style="display: none;">				
				</select>
				<label for="VD_campaign">
					<i class="fas fa-sync login-icon" id='campagin_label'></i>
				</label>

				<br><br>	
				<!--TEMP LOGIN will use ajax to check login - if its ok I'll submit the form using javascript -->
				<input type="submit" class="login-submit"  id ='SUBMIT' name='SUBMIT' value='SUBMIT' style="display: none;" >
				<button type="button" class="login-submit" id='bluetelecoms_login'>Login</button>
				<br>
				<input type="checkbox" id='selectphone' name="selectphone" > <span class='text-checkbox'>Manually choose phone</span><br><br>
				<span id='error_span' style="color: white;display: none;"></span>
				<!-- End -->
			</form>

		</div>

	</div>

</body>

					<footer id="footer">
						<span class="copyright">&copy; <?php echo date("Y"); ?> bluetelecoms</span>
					</footer>

</html>