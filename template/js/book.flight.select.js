$(document).ready(function() {
	$(".btn-next").click(function(){
		var err = 0;
		var msg = "";
		if ($("input[name='departclass']:checked", "#frmBooking").val() == undefined && $("input[name='returnclass']:checked", "#frmBooking").val() == undefined) {
			err++;
			msg = "Please select at least the Outbound-Flight and/or Return-Flight to continue.";
		}
		if (err == 0) {
			return true;
		}
		else {
			msgbox(msg);
			return false;
		}
	});
	$(".icon-map").click(function(){
		$('#flight-map').toggle('fade');
	});
});