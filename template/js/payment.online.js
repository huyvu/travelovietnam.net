$(document).ready(function()
{
	$("#proceed").click(function()
	{
		if ($("#fullname").val()=="") {
			$("#fullname").addClass("error");
			msgbox("Please fill the Full Name!");
			return false;
		}
		else
		{
			$("#fullname").removeClass("error");
		}
		
		if ($("#email").val()=="")
		{
			$("#email").addClass("error");
			msgbox("Please fill the Email!");
			return false;
		}
		else
		{
			if (!isEmail($("#email").val()))
			{
				$("#email").addClass("error");
				msgbox("Invalid Email! Please recheck or input the other email address.");
				return false;
			} else {
				$("#email").removeClass("error");
			}
		}
		
		if ($("input[type='checkbox']:checked").length == 0)
		{
			msgbox("Please select at least one of Pay for <span class='required'>*</span> option!");
			return false;
		}
		
		if ($("#amount").val()=="")
		{
			$("#amount").addClass("error");
			msgbox("Please fill the Amount <span class='required'>*</span> to pay!");
			return false;
		}
		else
		{
			$("#amount").removeClass("error");
		}
		
		if($("#note").val()=="")
		{
			$("#note").addClass("error");
			msgbox("Please fill the Payment description <span class='required'>*</span> for payment!");
			return false;
		}
		else
		{
			$("#note").removeClass("error");
		}
		
		if ($("#security_code").val() == "" || $("#security_code").val().toUpperCase() != $(".security-code").html().toUpperCase()) {
			$("#security_code").addClass("error");
			msgbox("The security code was not matched!");
			return false;
		} else {
			$("#security_code").removeClass("error");
		}
		
		return true;
	});
});

function isEmail(emailStr)
{
	var emailPat = /^(.+)@(.+)$/;
	var matchArray = emailStr.match(emailPat);
	if (matchArray == null) {
		return false;
	}
	return true;
}

function checkNumber(input)
{
	var pattern="0123456789";
	var len = input.value.length;
	if (len != 0) {
		var index = 0;
		if (!$.isNumeric(input.value)) {
			while ((index < len) && (len != 0)) {
				if (pattern.indexOf(input.value.charAt(index)) == -1)
				{
					if (index == len-1) {
						input.value=input.value.substring(0,len-1);
					} else if(index == 0) {
						input.value=input.value.substring(1,len);
					} else {
						input.value=input.value.substring(0,index)+input.value.substring(index+1,len);index=0;len=input.value.length;
					}
				}
				else {
					index++;
				}
			}
		}
	}
}

