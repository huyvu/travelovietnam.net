$(document).ready( function() {
	//Datetime picker for birthday
	$("#birthday").datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1910:'+(new Date()).getFullYear()
	});

	$("#btnEdit").click(function() {
		var error = 0;
		if ($("#fullname").val() == "") {
			$("#fullname").addClass("error");
			error ++;
		} else {
			$("#fullname").removeClass("error");
		}
		if ($("#email").val() == "") {
			$("#email").addClass("error");
			error ++;
		}else if(!validateEmail($("#email").val())){ // Call validateEmail function from Util.js
			$("#email").addClass("error");
			error ++;
		} else {
			$("#email").removeClass("error");
		}
		if ($("#nationality").val() == "") {
			$("#nationality").addClass("error");
			error ++;
		} else {
			$("#nationality").removeClass("error");
		}
		if ($("#country_code").val() == "") {
			$("#country_code").addClass("error");
			error ++;
		} else {
			$("#country_code").removeClass("error");
		}
		if ($("#phone").val() == "") {
			$("#phone").addClass("error");
			error ++;
		} else {
			$("#phone").removeClass("error");
		}
		if ($("#birthday").val() == "") {
			$("#birthday").addClass("error");
			error ++;
		} else {
			$("#birthday").removeClass("error");
		}
		if (error == 0) {
			$("#frmUpdateProfile").submit();
		} else {
			msgbox("Please fill-in all required fields(*) before submiting your change!");
		}
	});


	$("#btnChangePassword").click(function() {
		var error = 0;
		var err_msg = '';
		if ($("#old-pass").val() == "") {
			$("#old-pass").addClass("error");
			error ++;
		} else {
			$("#old-pass").removeClass("error");
		}
		if ($("#new-pass").val() == "") {
			$("#new-pass").addClass("error");
			error ++;
		} else {
			$("#new-pass").removeClass("error");
		}
		
		if ($("#new-pass").val() != "") {
			if ($("#passconf").val() == "") {
				$("#passconf").addClass("error");
				error ++;
			} else {
				if ($("#passconf").val() != $("#new-pass").val()) {
					var tr = $('#passconf').parent().parent();
					//$("<tr><td colspan=2 style='height:10px;padding:0;'><p style='color:red;text-align=center'>Password comfirm does not match!</p></td></tr>").insertBefore(tr);
					$('td.error-message').text('Please retype your new password. Confirm field is not matched.');
					error ++;
				} else {
					$("#passconf").removeClass("error");
				}
			}	
		}
		if (error == 0) {
			$("#frmChangePassword").submit();
		} else {
			msgbox("Please fill-in all required fields(*) before submiting your change!");
		}
	});

	/**Show successful change password message then fadeOut*/
	setTimeout(function() {
	 $('.msgbox-success').fadeOut('slow');
	}, 5000 );


});