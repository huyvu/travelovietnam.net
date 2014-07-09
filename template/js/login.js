$(document).ready( function() {
	//$('.register-content > div').equalHeights();
	$("#btnLogin").click(function() {
		var error = 0;
		if ($("#username").val() == "") {
			$("#username").addClass("error");
			error ++;
		} else {
			$("#username").removeClass("error");
		}
		if ($("#password").val() == "") {
			$("#password").addClass("error");
			error ++;
		} else {
			$("#password").removeClass("error");
		}
		if (error == 0) {
			$("#task").val("login");
			$("#frmSignUp").submit();
		}
	});
	// event on enter key press
	$("#password").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$("#btnLogin").trigger( "click" );
		}
	});



	$("#btnSignUp").click(function() {
		var error = 0;
		if ($("#newpassword").val() == "") {
			$("#newpassword").addClass("error");
			error ++;
		} else {
			$("#newpassword").removeClass("error");
		}
		if ($("#newpassword").val() != "") {
			if ($("#password_confirm").val() == "") {
				$("#password_confirm").addClass("error");
				error ++;
			} else {
				if ($("#password_confirm").val() != $("#newpassword").val()) {
					error ++;
				} else {
					$("#password_confirm").removeClass("error");
				}
			}   
		}
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
		if ($("#phone").val() == "") {
			$("#phone").addClass("error");
			error ++;
		} else {
			$("#phone").removeClass("error");
		}
		
		if (error == 0) {
			$("#task").val("register");
			$("#frmSignUp").submit();
		}
	});

	// event on enter key press
	$("#password_confirm").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$("#btnSignUp").trigger( "click" );
		}
	});
});