$(document).ready(function() {
	$(".application").change(function(){
		updatePanel();
	});
	$(".type_of_vs").change(function(){
		updatePanel();
	});
	$(".purpose_vs").change(function(){
		$(".purpose_of_vs").html($(".purpose_vs :selected").text());
	});
	$(".arrival_port").change(function(){
		$(".arrival_port_t").html($(".arrival_port :selected").text());
		updatePanel();
	});
	$(".change_price").change(function(){
		updatePanel();
	});
	$(".change_price_click").change(function(){
		updatePanel();
	});
	$(".airport_fast_checkin").click(function(){
		if ($("#airport_fast_checkin_yes").is(':checked')) {
			$("#vip_fast_checkin_yes").attr("checked", false);
			$("#vip_fast_checkin_no").attr("checked", true);
		}
		updatePanel();
	});
	$(".vip_fast_checkin").click(function(){
		if ($("#vip_fast_checkin_yes").is(':checked')) {
			$("#airport_fast_checkin_yes").attr("checked", false);
			$("#airport_fast_checkin_no").attr("checked", true);
		}
		updatePanel();
	});
	$(".car_pickup").click(function(){
		updatePanel();
	});
	$(".car_type").click(function(){
		updatePanel();
	});
	$(".car_type").change(function(){
		if ($(".car_type").val() == "Taxi") {
			$(".num_seat").html('<option value="4">4 seats</option><option value="7">7 seats</option>');
		} else {
			$(".num_seat").html('<option value="4">4 seats</option><option value="7">7 seats</option><option value="16">16 seats</option><option value="24">24 seats</option>');
		}
		updatePanel();
	});
	$(".num_seat").click(function(){
		updatePanel();
	});	
	$(".btn_next").click(function(){
		var err = 0;
		var msg = new Array();
		if ($(".type_of_vs :selected").val() == "3mme" && $.trim($(".embassies").val()) == "") {
			$(".embassies").addClass("error");
			err++;
		} else {
			$(".embassies").removeClass("error");
		}
		if ($(".purpose_vs :selected").val() == "") {
			$(".purpose_vs").addClass("error");
			err++;
		} else {
			$(".purpose_vs").removeClass("error");
		}
		if ($(".arrival_port :selected").val() == "") {
			$(".arrival_port").addClass("error");
			err++;
		} else {
			$(".arrival_port").removeClass("error");
		}
		
		var applicants = $(".application").val();
		
		for (var i=1; i<=applicants; i++) {
			if ($("#fullname_"+i).val() == "") {
				$("#fullname_"+i).addClass("error");
				err++;
			} else {
				$("#fullname_"+i).removeClass("error");
			}
			if ($("#birthdate_"+i).val() == "") {
				$("#birthdate_"+i).addClass("error");
				err++;
			} else {
				$("#birthdate_"+i).removeClass("error");
			}
			if ($("#birthmonth_"+i).val() == "") {
				$("#birthmonth_"+i).addClass("error");
				err++;
			} else {
				$("#birthmonth_"+i).removeClass("error");
			}
			if ($("#birthyear_"+i).val() == "") {
				$("#birthyear_"+i).addClass("error");
				err++;
			} else {
				$("#birthyear_"+i).removeClass("error");
			}
			if ($("#nationality_"+i).val() == "") {
				$("#nationality_"+i).addClass("error");
				err++;
			} else {
				$("#nationality_"+i).removeClass("error");
			}
			if ($("#passportnumber_"+i).val() == "") {
				$("#passportnumber_"+i).addClass("error");
				err++;
			} else {
				$("#passportnumber_"+i).removeClass("error");
			}
		}
		
		if ($("#processtime_special").is(':checked')
				|| $("#airport_fast_checkin_yes").is(':checked')
				|| $("#vip_fast_checkin_yes").is(':checked')) {
			if ($("#flightnumber").val() == "") {
				$("#flightnumber").addClass("error");
				err++;
			} else {
				$("#flightnumber").removeClass("error");
			}
			if ($("#arrivaltime").val() == "") {
				$("#arrivaltime").addClass("error");
				err++;
			} else {
				$("#arrivaltime").removeClass("error");
			}
		} else {
			$("#flightnumber").removeClass("error");
			$("#arrivaltime").removeClass("error");
		}
		if ($("#arrivaldate").val() == "") {
			$("#arrivaldate").addClass("error");
			err++;
		} else {
			$("#arrivaldate").removeClass("error");
		}
		if ($("#arrivalmonth").val() == "") {
			$("#arrivalmonth").addClass("error");
			err++;
		} else {
			$("#arrivalmonth").removeClass("error");
		}
		if ($("#arrivalyear").val() == "") {
			$("#arrivalyear").addClass("error");
			err++;
		} else {
			$("#arrivalyear").removeClass("error");
		}
		if ($("#exitdate").val() == "") {
			$("#exitdate").addClass("error");
			err++;
		} else {
			$("#exitdate").removeClass("error");
		}
		if ($("#exitmonth").val() == "") {
			$("#exitmonth").addClass("error");
			err++;
		} else {
			$("#exitmonth").removeClass("error");
		}
		if ($("#exityear").val() == "") {
			$("#exityear").addClass("error");
			err++;
		} else {
			$("#exityear").removeClass("error");
		}
		if ($("#contact_email").val() == "" || !isEmail($("#contact_email").val())) {
			$("#contact_email").addClass("error");
			err++;
		} else {
			$("#contact_email").removeClass("error");
		}
		if ($("#confirm_contact_email").val() == "" || !isEmail($("#confirm_contact_email").val())) {
			$("#confirm_contact_email").addClass("error");
			err++;
		} else {
			if ($("#confirm_contact_email").val() != $("#contact_email").val()) {
				$("#confirm_contact_email").addClass("error");
				err++;
			} else {
				$("#confirm_contact_email").removeClass("error");
			}
		}
		if ($("#information_confirm").is(':checked')!=true) {
			$("#information_confirm").parent().addClass("error");
			err++;
		} else {
			$("#information_confirm").parent().removeClass("error");
		}
		if ($("#terms_conditions_confirm").is(':checked')!=true) {
			$("#terms_conditions_confirm").parent().addClass("error");
			err++;
		} else {
			$("#terms_conditions_confirm").parent().removeClass("error");
		}
		
		if (err == 0) {
			// Check datetime
			var date		= new Date();
			var currentDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate());
			var arrivalDate	= new Date($("#arrivalyear").val(),$("#arrivalmonth").val()-1,$("#arrivaldate").val());
			var exitDate	= new Date($("#exityear").val(),$("#exitmonth").val()-1,$("#exitdate").val());
			
			if (arrivalDate.getTime() < currentDate.getTime()) {
				$("#arrivaldate").addClass("error");
				$("#arrivalmonth").addClass("error");
				$("#arrivalyear").addClass("error");
				msg.push("Arrival date must be greater than current date!");
				err++;
			}
			if (exitDate.getTime() < currentDate.getTime()) {
				$("#exitdate").addClass("error");
				$("#exitmonth").addClass("error");
				$("#exityear").addClass("error");
				msg.push("Exit date must be greater than current date!");
				err++;
			}
			if (arrivalDate.getTime() >= exitDate.getTime()) {
				$("#arrivaldate").addClass("error");
				$("#arrivalmonth").addClass("error");
				$("#arrivalyear").addClass("error");
				msg.push("Exit date must be greater than Arrival date!");
				err++;
			}
		}
		
		if (err == 0) {
			$(".b-error").css("display","none");
			if (detectEmergencyCase()) {
				showEmergencyAlert();
				return false;
			}
			return true;
		}
		else {
			var errorMsg = "<div class='marker'>Unfortunately your information contained errors. Please review and correct the field(s) marked in red.";
			if (msg.length > 0) {
				errorMsg += "<ul>";
				for (var m=0; m<msg.length; m++) {
					errorMsg += "<li>"+(m+1)+". "+msg[m]+"</li>";
				}
				errorMsg += "</ul>";
			}
			errorMsg += "</div>";
			$(".b-error").html(errorMsg);
			$(".b-error").css("display","block");
			window.location.hash = '#error';
			return false;
		}
	});
	
	var $sidepanel = $(".feepanel"), 
    $window    = $(window),
    offset     = $sidepanel.offset(),
    topPadding = 10;
	
	$window.scroll(function() {
	    if ($window.scrollTop() > offset.top) {
	        $sidepanel.stop().animate({
	            marginTop: $window.scrollTop() - offset.top + topPadding
	        });
	    } else {
	        $sidepanel.stop().animate({
	            marginTop: 0
	        });
	    }
	});

	updatePanel();
});

function updatePanel() {
	onVisaTypeChanged();
	onApplicantChanged();
	onRushChanged();
	calVisaFee();
	calServiceFee();
	onDisplayFlightInfo();
}

function onDisplayFlightInfo()
{
	var canshow = ($("input[name='processtime']:checked").val() == "Emergency") ? true : false;
	
	if (!canshow) {
		if ($("#airport_fast_checkin_yes").is(':checked') || $("#vip_fast_checkin_yes").is(':checked')) {
			canshow = true;
		}
	}
	if (!canshow) {
		$("#flightinfo").hide();
	} else {
		$("#flightinfo").show();
	}
}

function onVisaTypeChanged()
{
	if($(".type_of_vs :selected").val() == "1ms")
	{
		$(".visa_type").html($(".type_of_vs :selected").text()+"<br/>(30 days stay, only 1 time entry/exit)");
	}
	if($(".type_of_vs :selected").val() == "3ms")
	{
		$(".visa_type").html($(".type_of_vs :selected").text()+"<br/>(90 days stay, only 1 time entry/exit)");
	}
	if($(".type_of_vs :selected").val() == "1mm")
	{
		$(".visa_type").html($(".type_of_vs :selected").text()+"<br/>(30 days stay, multiple entry/exit)");
	}
	if($(".type_of_vs :selected").val() == "3mm")
	{
		$(".visa_type").html($(".type_of_vs :selected").text()+"<br/>(90 days stay, multiple entry/exit)");
	}
	if($(".type_of_vs :selected").val() == "3mme")
	{
		$(".visa_at_embassies").show();
		$(".visa_type").html($(".type_of_vs :selected").text()+"<br/>(90 days stay, multiple entry/exit)");
	} else {
		$(".visa_at_embassies").hide();
	}
}

function onRushChanged()
{
	$(".processing_c").each(function(index) {
		if($(this).is(':checked') && $(this).val() == "Normal") {
			$(".processing_note_t").html("Normal (2 working days)");
		}
		if($(this).is(':checked') == true && $(this).val() == "Urgent") {
			$(".processing_note_t").html("Urgent (4 working hours)");
		}
		if($(this).is(':checked') == true && $(this).val() == "Emergency") {
			$(".processing_note_t").html("Emergency (maximum 30 minutes)");
		}
	});
}

function calServiceFee()
{
	var serviceList = "";
	if ($("#airport_fast_checkin_yes").is(':checked')) {
		var checkinFee = calFastCheckinServiceFee();
		serviceList += "<tr valign='top'><td>Airport fast check-in</td><td align='right'><label class='price'>"+checkinFee[0]+" USD</label><br />("+checkinFee[1]+"pax x "+checkinFee[2]+" USD)</td></tr>";
	}
	if ($("#vip_fast_checkin_yes").is(':checked')) {
		var vipCheckinFee = calFastCheckinServiceFee();
		serviceList += "<tr valign='top'><td>VIP fast check-in</td><td align='right'><label class='price'>"+vipCheckinFee[0]+" USD</label><br />("+vipCheckinFee[1]+"pax x "+vipCheckinFee[2]+" USD)</td></tr>";
	}
	if ($(".car_pickup:checked").val() == 1) {
		$(".car-select").show();
		var carFee = calCarServiceFee();
		serviceList += "<tr valign='top'><td>Car pick-up</td><td align='right'><label class='price'>"+carFee[0]+" USD</label><br />(Private Car, "+carFee[2]+" seats)</td></tr>";
	} else {
		$(".car-select").hide();
	}
	$(".extra_service").html(serviceList);
	if (serviceList != "") {
		$("#extra_service_li").show();
	} else {
		$("#extra_service_li").hide();
	}
}

function calVisaFee()
{
	var numofentry = parseInt($(".application").val());
	var typeofvisa = $(".type_of_vs").val();
	
	var original_servicefee = 0;
	var servicefee  = 0;
	var urgent      = 20;
	var superurgent = 50;
	
	switch (typeofvisa)
	{
		case"1ms": original_servicefee = 20;
			switch(numofentry)
			{
				case 1:servicefee=20;break;
				case 2:servicefee=18;break;
				case 3:servicefee=18;break;
				case 4:servicefee=16;break;
				case 5:servicefee=16;break;
				case 6:servicefee=14;break;
				case 7:servicefee=14;break;
				case 8:servicefee=14;break;
				case 9:servicefee=14;break;
				case 10:servicefee=12;break;
				default:servicefee=12;break;
			}
			break;
		case"1mm": original_servicefee = 25;
			switch(numofentry)
			{
				case 1:servicefee=25;break;
				case 2:servicefee=23;break;
				case 3:servicefee=23;break;
				case 4:servicefee=21;break;
				case 5:servicefee=21;break;
				case 6:servicefee=19;break;
				case 7:servicefee=19;break;
				case 8:servicefee=19;break;
				case 9:servicefee=19;break;
				case 10:servicefee=17;break;
				default:servicefee=17;break;
			}
			break;
		case"3ms": original_servicefee = 30;
			switch(numofentry)
			{
				case 1:servicefee=30;break;
				case 2:servicefee=28;break;
				case 3:servicefee=28;break;
				case 4:servicefee=26;break;
				case 5:servicefee=26;break;
				case 6:servicefee=24;break;
				case 7:servicefee=24;break;
				case 8:servicefee=24;break;
				case 9:servicefee=24;break;
				case 10:servicefee=22;break;
				default:servicefee=22;break;
			}
			break;
		case"3mm": original_servicefee = 60;
			switch(numofentry)
			{
				case 1:servicefee=60;break;
				case 2:servicefee=58;break;
				case 3:servicefee=58;break;
				case 4:servicefee=56;break;
				case 5:servicefee=56;break;
				case 6:servicefee=54;break;
				case 7:servicefee=54;break;
				case 8:servicefee=54;break;
				case 9:servicefee=54;break;
				case 10:servicefee=52;break;
				default:servicefee=52;break;
			}
			break;
		case"3mme": original_servicefee = 38;
			switch(numofentry)
			{
				case 1:servicefee=38;break;
				case 2:servicefee=36;break;
				case 3:servicefee=36;break;
				case 4:servicefee=34;break;
				case 5:servicefee=34;break;
				case 6:servicefee=32;break;
				case 7:servicefee=32;break;
				case 8:servicefee=32;break;
				case 9:servicefee=32;break;
				case 10:servicefee=30;break;
				default:servicefee=30;break;
			}
			break;
		default:break;
	}
	
	var yoursave = (original_servicefee*numofentry) - (servicefee*numofentry);
	var yoursavepercent = Math.round(((original_servicefee-servicefee)/servicefee)* 100);
	
	$(".total_visa_price").html(original_servicefee+" USD x "+numofentry+" = "+(original_servicefee*numofentry)+" USD");
	
	$("#processint_time_li").hide();
	$(".change_price_click").each(function(index) {
		if($(this).is(':checked') && $(this).val() == "Urgent") {
			$(".processing_t").html(urgent+" USD x "+numofentry+" = "+(urgent*numofentry)+" USD");
			$("#processint_time_li").show();
			servicefee = servicefee + urgent;
		}
		if($(this).is(':checked') == true && $(this).val() == "Emergency") {
			$(".processing_t").html(superurgent+" USD x "+numofentry+" = "+(superurgent*numofentry)+" USD");
			$("#processint_time_li").show();
			servicefee = servicefee + superurgent;
		}
	});
	
	var total = servicefee*numofentry + calFastCheckinServiceFee()[0] + calCarServiceFee()[0];
	
	if (numofentry > 1) {
		$(".yoursave_t").html("- "+yoursave+" USD");
		$(".yoursavepercent_t").html("("+yoursavepercent+"%)");
		$("#yoursave_li").css("display","block");
	} else {
		$("#yoursave_li").css("display","none");
	}
	
	$(".total_price").html(total+" USD");
	
	return servicefee * numofentry;
}

function calFastCheckinServiceFee()
{
	var ret = new Array();
	var servicefee = 0;
	var numofentry = parseInt($(".application").val());
	var arrivalport = "Ha Noi";
	
	if ($(".arrival_port").val() != "") {
		arrivalport = $(".arrival_port").val();
	}
	
	if ($("#airport_fast_checkin_yes").is(':checked')) {
		switch (arrivalport){
			case "Ha Noi":
				servicefee = ((numofentry<5) ? 20 : 15); break;
			case "Da Nang":
				servicefee = ((numofentry<5) ? 20 : 15); break;
			default:
				servicefee = ((numofentry<5) ? 15 : 12); break;
		}
	}
	
	if ($("#vip_fast_checkin_yes").is(':checked')) {
		servicefee = 40;
	}
	
	ret[0] = servicefee * numofentry;
	ret[1] = numofentry;
	ret[2] = servicefee;
	return ret;
}

function calCarServiceFee()
{
	var ret = new Array();
	var servicefee = 0;
	var cartype = $(".car_type").val();
	var seats = parseInt($(".num_seat").val());
	var arrivalport = "Ha Noi";
	
	if ($(".arrival_port").val() != "") {
		arrivalport = $(".arrival_port").val();
	}
	
	if ($(".car_pickup:checked").val() == 1) {
		if (arrivalport == "Ha Noi") {
			switch (seats) {
				case 4: servicefee = 30; break;
				case 7: servicefee = 35; break;
				case 16: servicefee = 60; break;
				case 24: servicefee = 90; break;
			}
		} else if (arrivalport == "Da Nang") {
			switch (seats) {
				case 4: servicefee = 25; break;
				case 7: servicefee = 30; break;
				case 16: servicefee = 50; break;
				case 24: servicefee = 85; break;
			}
		} else {
			switch (seats) {
				case 4: servicefee = 25; break;
				case 7: servicefee = 30; break;
				case 16: servicefee = 50; break;
				case 24: servicefee = 85; break;
			}
		}
	}
	ret[0] = servicefee;
	ret[1] = cartype;
	ret[2] = seats;
	return ret;
}

function onApplicantChanged()
{
	$(".number_of_vs").html($(".application :selected").text());
	createApplicationEntries();
}

function createApplicationEntries()
{
	var applications   = parseInt($(".application").val());
	var firstEntryHtml = $(".applicant_1").html();
	var child = $(".tbapplicant tr").length;
	if (child > applications) {
		$(".tbapplicant tr").slice(applications+1).remove();
	} else {
		for (var i=child; i<=applications; i++) {
			var newEntry = firstEntryHtml.replace(/_1/g, "_"+i);
			$(".tbapplicant").append("<tr>"+newEntry+"</tr>");
			$(".applicantnumber_"+i).html(i);
		}
	}
}

function detectEmergencyCase()
{
	var isEmergency = false;
	
	var date		= new Date();
	var currentDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate(), 23, 59, 0); // Evening
	var next1Date	= new Date(date.getFullYear(), date.getMonth(), date.getDate()+1, 23, 59, 0);
	var next2Date	= new Date(date.getFullYear(), date.getMonth(), date.getDate()+2, 23, 59, 0);
	var next3Date	= new Date(date.getFullYear(), date.getMonth(), date.getDate()+3, 23, 59, 0);
	var arrivalDate	= new Date($("#arrivalyear").val(),$("#arrivalmonth").val()-1,$("#arrivaldate").val(), 23, 59, 0);
	
	if ($("#processtime_special").is(':checked') != true)
	{
		var arrivalDay = arrivalDate.getDay();
		if (currentDate.getTime() == arrivalDate.getTime() || next1Date.getTime() == arrivalDate.getTime()) {
			isEmergency = true;
		} else if (arrivalDay == 6 && (arrivalDate.getTime() <= next1Date.getTime())) { // Saturday
			isEmergency = true;
		} else if (arrivalDay == 0 && (arrivalDate.getTime() <= next2Date.getTime())) { // Sunday
			isEmergency = true;
		} else if (arrivalDay == 1 && (arrivalDate.getTime() <= next2Date.getTime() || (arrivalDate.getTime() <= next3Date.getTime() && date.getDay() == 5 && date.getHours() > 12))) { // Monday
			isEmergency = true;
		}
	}
	
	return isEmergency;
}

function showEmergencyAlert()
{
	$("#flightnumber2").val($("#flightnumber").val());
	$("#arrivaltime2").val($("#arrivaltime").val());
	$('#emergencyOverlay').show();
	$('#paneEmergency').show();
}

function hideEmergencyAlert()
{
	$('#emergencyOverlay').hide();
	$('#paneEmergency').hide();
}

function checkEmergencyForm() {
	var err = 0;
	if ($("#flightnumber2").val() == "") {
		$("#flightnumber2").addClass("error");
		err++;
	} else {
		$("#flightnumber2").removeClass("error");
	}
	if ($("#arrivaltime2").val() == "") {
		$("#arrivaltime2").addClass("error");
		err++;
	} else {
		$("#arrivaltime2").removeClass("error");
	}
	if (err) {
		alert("Your information contained errors. Please review and correct the field(s) marked in red.");
	} else {
		$("#flightnumber").val($("#flightnumber2").val());
		$("#arrivaltime").val($("#arrivaltime2").val());
		$("#task").val("Emergency");
		$("#frmApply").submit();
	}
}
