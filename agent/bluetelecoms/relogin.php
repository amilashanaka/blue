<!DOCTYPE html>
<html>
<head>
	<title>Agent Login | bluetelecoms</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<?php include 'btx-includes.php';?>
	<script>
	// function to check variables from http
	function getParameterByName(name, url) {
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	$(function(){
		/*
		on load check the url for the following variables: VD_login, VD_pass, phone_login and phone_pass if present then
		run an AJAX to vdc_db_query.php to check if it returns an error, if not then ... if error ...
		*/

		// if all inputs have been filled then run the code below
		$("input").on("change", function(){
			if(($("#btx_VD_login").val().length > 0) && ($("#btx_VD_pass").val().length > 0) && ($("#btx_phone_login").val().length > 0) && ($("#btx_phone_pass").val().length > 0)){
				$("#btx_refresh_button").click();
			}
		});

		$("#btx_login_button").on("click", function(){
			// get username and password
			var btx_login_user = $("#btx_VD_login").val();
			var btx_login_pass = $("#btx_VD_pass").val();

			$.ajax({
				url: "vdc_db_query.php",
				type: "post",
				data: { user : btx_login_user , pass : btx_login_pass , ACTION : "LogiNCamPaigns" },
				success: function(response) {
					//Do Something
					console.log(response);
					if(response.indexOf('USER LOGIN ERROR') > -1){
						console.log("error!!!!!");
					} else {
						btx_execute();

					}
				},
				error: function(xhr) {
					// Do Something to handle error
					console.log(xhr);
				}
			});
		});

		$("#btx_login_button").click();

		// check if there is a user login error on load and handle it
		console.log($("#VD_campaign option:selected").text());
		if($("#VD_campaign option:selected").text() == "-- USER LOGIN ERROR --"){
			$("#VD_campaign").hide();
		}

		function btx_execute(){
			// check if there is a user login error on load and handle it
			console.log($("#VD_campaign option:selected").text());
			if($("#VD_campaign option:selected").text() == "-- USER LOGIN ERROR --"){
				$("#VD_campaign").hide();
			}
			
			// disable login button if no campaign selected or any of the fields are empty
			$("#btx_login_button").prop('disabled', true);
			$("#btx_VD_campaign").on("change", function(){
				if((this.value.length > 0) && ($("#btx_VD_login").val().length > 0) && ($("#btx_VD_pass").val().length > 0) && ($("#btx_phone_login").val().length > 0) && ($("#btx_phone_pass").val().length > 0)){
					$("#btx_login_button").prop('disabled', false);
					console.log(this.value.length);
				} else {
					$("#btx_login_button").prop('disabled', true);
					console.log("no campaign selected!");
				}
			});

			$("#btx_login_button").on("click", function(){
				$('input[name=SUBMIT]').click();
				
			});
			// -- fill the details of the form by taking the data from the background form --
			// var btx_phone_login = $('input[name=phone_login]').val();
			// var btx_phone_pass = $('input[name=phone_pass]').val();
			// var btx_VD_login = $('input[name=VD_login]').val();
			// var btx_VD_pass = $('input[name=VD_pass]').val();

			// -- another way of getting the data is from the url by using the getParameterByName() function, only if it is a relogin --
			var btx_phone_login = getParameterByName("phone_login");
			var btx_phone_pass = getParameterByName("phone_pass");
			var btx_VD_login = getParameterByName("VD_login");
			var btx_VD_pass = getParameterByName("VD_pass");

			login_allowable_campaigns();

			setTimeout(function(){
				// getting the available campaigns is done by copying whatever campaigns are available in the background form
				$('#VD_campaign option').clone().appendTo('#btx_VD_campaign');
			},200);

			// assign the values of the background form to the new form
			$("#btx_phone_login").val(btx_phone_login);
			$("#btx_phone_pass").val(btx_phone_pass);
			$("#btx_VD_login").val(btx_VD_login);
			$("#btx_VD_pass").val(btx_VD_pass);

			// check for any updates on the new form and if any change the backgroun form as well
			$("input").on("change input", function(){
				var bg_form_name = this.id.slice(4);
				$('input[name='+bg_form_name+']').val(this.value);
				console.log(this.value);
			});
			$('body').on('change', '#btx_VD_campaign', function() {
				$('form #VD_campaign').val(this.value);
			});
			$('body').on('change', '#VD_campaign', function() {
				$('#btx_VD_campaign').val(this.value);
			});
			// handle the refresh button
			$("#btx_refresh_button").hover(function(){
				$(this).children("i").addClass("fa-spin");
			}, function(){
				$(this).children("i").removeClass("fa-spin");
			});
			$("body").on("click", '#btx_refresh_button', function(){
				login_allowable_campaigns();
				setTimeout(function(){
					console.log("wow");
					// clear the select on the new login
					$("#btx_VD_campaign").html('');
					$('#VD_campaign option').clone().appendTo('#btx_VD_campaign');
					//$("#btx_VD_campaign").find("option").eq(0).remove();
				},1000);

			});
		}
	});
</script>
</head>
<body>
	<div id="main-login-body">
		<div style="background-color: #0E2F44 !important; height: 100vh;">
			<br>
			<div class="container">
				<div class="row">
					<div class="col-2">
					</div>
					<div class="col-8 text-center">
						<img id="company_logo" src="bluetelecoms/btx-logo-sml.png" title="bluetelecoms" alt="bluetelecoms"><br><br><br>
						<div class="col-md-12">
							<div class="row text-left">
								<div class="col-md-6 mx-auto">
									<span class="anchor" id="formLogin"></span>
									<div class="card rounded-0">
										<div class="card-header">
											<div class="row">
												<div class="col-4">
													<i class="fa fa-3x fa-user-circle"></i>
												</div>
												<div class="col-8">
													<h5 class="mb-0">Agent Login</h5>
												</div>
											</div>
										</div>
										<div class="card-body">
											<form class="form" role="form" autocomplete="off" id="formLogin">

												<div class="row">
													<div class="col">
														<div class="form-group">
															<input type="text" class="form-control form-control-md rounded-0" name="btx_phone_login" id="btx_phone_login" required="" placeholder="Extension">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<input type="password" class="form-control form-control-md rounded-0" id="btx_phone_pass" required="" autocomplete="new-password" placeholder="Password">
														</div>
													</div>
												</div>

												<hr />

												<div class="row">
													<div class="col">
														<div class="form-group">
															<input type="text" class="form-control form-control-md rounded-0" name="btx_VD_login" id="btx_VD_login" required="" placeholder="Username">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<input type="password" class="form-control form-control-md rounded-0" id="btx_VD_pass" required="" autocomplete="new-password" placeholder="Passphrase">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col">
														<div class="form-group">
															<label>Campaign:</label>
															<select class="form-control form-control-md rounded-0" id="btx_VD_campaign">
																
															</select>
														</div>
													</div>
												</div>

												<hr />

												<div>	
													<div class="form-group">
														<div class="row">
															<div class="col">
																<button type="button" id="btx_refresh_button" class="btn btn-block btn-dark btn-md float-left"><i class="fa fa-refresh"></i>&nbsp;Refresh</button>
															</div>
															<div class="col">			
																<button type="button" id="btx_login_button" class="btn btn-block btn-primary btn-md float-right"><i class="fa fa-sign-in"></i>&nbsp;Login</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					<div class="col-2">
					</div>
				</div>
			</div>
		</div>

		<footer class="loginfooter">
			<div class="container">
				<span>&copy; <?php echo date("Y"); ?> Copyright. Direct Market Solutions T/A Blue Telecoms | Version: 8.0 | Release: 2018-02-02a | Licensed to:</span> <span class="licensee"><?php echo 'Blue Telecoms'; ?></span>
			</div>
		</footer>

	</div>

	<!--script src="bluetelecoms/part-files/particles.js"></script>
	<script src="bluetelecoms/part-files/app.js"></script>
	<script type="text/javascript">
		particlesJS.load('particles-js', 'bluetelecoms/particles.json', function() {
			console.log('particles.js loaded - callback');
		});
	</script-->

</body>
</html>
