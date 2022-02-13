
function viewImg(sr) {
  
    $('#mimg').attr('src', sr);
    $('#myModal').modal('show');
}

function searchTrading() 
{
    
    var pdrawno = $("#drawno").val();
   $("#pdrawno").val(pdrawno);
   

    $("#winloto_search").submit();

}

function payTradingSelected(st) {

    if ($('#pay_trading input[type=checkbox]:checked').length) {

        var pstatus;
        pstatus = 1;


        if (pstatus !== null) {
            $("#pay_trading").submit();
        }

    } else {

        alert("Select at least one payout");
        return false;

    }

}


function toggle(source) {
    checkboxes = document.getElementsByName('trade[]');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}


function logout() {
	swal({
		title: "Are You Sure ",
		text: "Loging Out",
		icon: "warning",
		buttons: ['No Cancel It', 'I am Sure'],
		dangerMode: true
	}).then(function(isConfirm) {
		if(isConfirm) {
			swal({
				title: 'Log Out',
				text: 'Thank You',
				icon: 'success'
			}).then(function() {
				window.location = 'data/logout.php';
			});
		} else {
			swal('Cancelled', 'User Not Login Out', 'error');
		}
	});
}


function changeAdmin(a_id,type) {
      
	swal({
		title: "Are You Sure ",
		text: "Change The Admin User",
		icon: "warning",
		buttons: ['No Cancel It', 'I am Sure'],
		dangerMode: true
	}).then(function(isConfirm) {
		if(isConfirm) {
			swal({
				title: 'Change Admin User',
				text: 'Thank You',
				icon: 'success'
			}).then(function() {
                               
				window.location = 'data/action_change_admin.php?a_id='+a_id+'&type='+type;
			});
		} else {
			swal('Cancelled', 'User Not Login Out', 'error');
		}
	});
}


 