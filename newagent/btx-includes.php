
<!-- jQuery Assets -->
<script src="https://cdn.bluetelecoms.com/agent/static/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="https://cdn.bluetelecoms.com/agent/static/moment/moment.js" type="text/javascript"></script>
<script src="https://cdn.bluetelecoms.com/agent/static/popper/popper.min.js" type="text/javascript"> </script>
<script src="https://cdn.bluetelecoms.com/agent/static/notify/notify.min.js" type="text/javascript"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdn.bluetelecoms.com/agent/static/jquery-ui-1.12.1/jquery-ui.css">
<script src="https://cdn.bluetelecoms.com/agent/static/jquery-ui-1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.bluetelecoms.com/agent/static/bootstrap-4.3.1/js/bootstrap.min.js"></script>
<link href="https://cdn.bluetelecoms.com/agent/static/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" >

<!-- Fontawesome -->
<link href="https://cdn.bluetelecoms.com/agent/static/fontawesome-5.10/css/all.css" rel="stylesheet" >
<link href="https://cdn.bluetelecoms.com/agent/static/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Datepicker -->
<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="bower_components/Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css">
<script src="bower_components/Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js"></script>

<!-- Custom Style -->
<link rel="stylesheet" type="text/css" href="bluetelecoms/btx-style.css">

<!-- Fontawesome Animation -->
<link rel="stylesheet" type="text/css" href="bluetelecoms/font_awesome_animation.css">

<script type="text/javascript">
	$(function () {
		$('.datepicker').datepicker();
		$('.datepicker').on("change",function(){

			var selected = $(this).val();
			$('#CallBackDatEPrinT').html(selected);
		});

	});
</script>

<!-- OFFLINE NOTIFICATIONS - Removed 21/08/19 KD
<script src="bluetelecoms/offline/offline.js"></script>
<link rel="stylesheet" href="bluetelecoms/offline/themes/offline-theme-chrome.css" />
<link rel="stylesheet" href="bluetelecoms/offline/themes/offline-language-english.css" />
-->
