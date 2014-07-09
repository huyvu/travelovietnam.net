<script type="text/javascript">
$(document).ready(function()
{
	$("#adults").change(function(){
		createEntries();
	});
	
	$("#children").change(function(){
		createEntries();
	});

	$("#infants").change(function(){
		createEntries();
	});

	$(".confirm-btn").click(function(){
		var err = 0;
		var travelers = $("#adults").val() + $("#children").val();
		
		for (var i=1; i<=travelers; i++) {
			if ($("#firstname_"+i).val() == "") {
				$("#firstname_"+i).addClass("error");
				err++;
			} else {
				$("#firstname_"+i).removeClass("error");
			}
			if ($("#lastname_"+i).val() == "") {
				$("#lastname_"+i).addClass("error");
				err++;
			} else {
				$("#lastname_"+i).removeClass("error");
			}
			if ($("#birthdate_"+i).val() == "") {
				$("#birthdate_"+i).parent().addClass("error");
				err++;
			} else {
				$("#birthdate_"+i).parent().removeClass("error");
			}
		}

		if ($("#fullname").val() == "") {
			$("#fullname").addClass("error");
			err++;
		} else {
			$("#fullname").removeClass("error");
		}
		if ($("#email").val() == "" || !isEmail($("#email").val())) {
			$("#email").addClass("error");
			err++;
		} else {
			$("#email").removeClass("error");
		}
		if ($("#phone").val() == "") {
			$("#phone").addClass("error");
			err++;
		} else {
			$("#phone").removeClass("error");
		}
		
		if (err == 0) {
			return true;
		}
		else {
			return false;
		}
	});
	
	createEntries();
});

function createEntries()
{
	var birthdateoptions = {
		changeMonth: true,
		changeYear: true
	};

	var startdateoptions = {
		numberOfMonths : 2,
		minDate: 0
	};
	
	var travelers = parseInt($("#adults").val()) + parseInt($("#children").val());
	var firstEntryHtml = $("#traveler_1").html();
	var child = $("#tbtraveler tr").length;
	if (child > travelers) {
		$("#tbtraveler tr").slice(travelers+1).remove();
	} else {
		for (var i=child; i<=travelers; i++) {
			var newEntry = firstEntryHtml.replace(/_1/g, "_"+i);
			$("#tbtraveler").append("<tr>"+newEntry+"</tr>");
			$("#travelerno_"+i).html(i);
		}
	}
	
	for (var i=1; i<=travelers; i++) {
		$("#birthdate_"+i).datepicker(birthdateoptions);
	}

	calFees();
}

function calFees()
{
	var travelers = parseInt($("#adults").val()) + parseInt($("#children").val());
	
	var p = {};
    p['adults']   = $('#adults').val();
    p['children'] = $('#children').val();
    for (var i=1; i<=travelers; i++) {
    	p['birthdate_'+i] = $('#birthdate_'+i).val();
	}
	
    $('.totalfee_txt').html("...");
	$('.totalfee_txt').load("<?=site_url('flights/cal_fees')?>", p, function(fee){
		$('.totalfee_txt').html("$"+fee);
	});
}
</script>

<div id="booking">
	<form action="<?=site_url("flights/checkout")?>" method="POST">
		<h1 class="headtitle">Check-out</h1>
		<div class="traveler-information">
			<div class="title">
				<h1>Traveler Information</h1>
			</div>
			<div class="left">
				<div class="thumbnail">
				</div>
			</div>
			<div class="left">
				<div class="flight-information">
					<h1></h1>
					<h3></h3>
				</div>
			</div>
			<div class="clr"></div>
			<div class="traveler">
				<div class="pricing">
					<div class="left">
						<b>Number of Travelers: </b>
						<span style="margin-left: 10px">Adults (> 12 yrs.)</span>
						<select id="adults" name="adults">
							<? for ($i=1; $i <= 20; $i++) { ?>
							<option value="<?=$i?>"><?=$i?></option>
							<? } ?>
						</select>
						<span style="margin-left: 10px">Children</span>
						<select id="children" name="children">
							<? for ($i=0; $i <= 20; $i++) { ?>
							<option value="<?=$i?>"><?=$i?></option>
							<? } ?>
						</select>
					</div>
					<div class="right totalfee"><strong>TOTAL: <span class="totalfee_txt">$100</span></strong></div>
					<div class="clr"></div>
				</div>
				<div class="detail">
					<table id="tbtraveler" width="100%" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th scope="col">
									No.
								</th>
								<th scope="col">
									First name
								</th>
								<th scope="col">
									Last name
								</th>
								<th scope="col">
									Gender
								</th>
								<th scope="col">
									Birth date
								</th>
								<th scope="col">
									Nationality
								</th>
							</tr>
						</thead>
						<tbody class="selected">
							<tr id="traveler_1">
								<td id="travelerno_1" class="center">
									1
								</td>
								<td>
									<input type="text" id="firstname_1" name="firstname_1" style="width: 120px">
								</td>
								<td>
									<input type="text" id="lastname_1" name="lastname_1" style="width: 120px">
								</td>
								<td>
									<select id="gender_1" name="gender_1" style="width: 80px">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</td>
								<td>
									<span class="calendar"><input type="text" id="birthdate_1" name="birthdate_1" placeholder="mm/dd/yyyy"></span>
								</td>
								<td>
									<select id="nationality_1" name="nationality_1" style="width: 150px">
										<? foreach ($nations as $nation) { ?>
											<option value="<?=$nation->name?>"><?=$nation->name?></option>
										<? } ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="clr"></div>
		</div>
		<div class="contact-information">
			<div class="title">
				<h1>Fill out Your Contact Information</h1>
			</div>
			<div class="content">
				<label>Who do we send a booking confirmation and receipt to?</label>
				<span class="clr col-fill-2">
					<b>Full Name :</b>
					<input type="text" name="fullname" id="fullname">
				</span>
				<div class="clr line-col-fill"> 
					<span class="col-fill">
						<b>Email Address :</b>
						<input type="text" name="email" id="email" value="">
					</span>
					<span class="col-fill">
						<b>Phone No. :</b>
						<input type="text" name="phone" id="phone" value="">
					</span>
				</div>
				<span class="clr col-fill-2">
					<b>Additional Requirements: (Optional)</b>
					<textarea rows="6" cols="34" name="message"></textarea>
				</span>
			</div>
			<div class="clr"></div>
		</div>
		<div class="payment-method">
			<div class="title">
				<h1>Payment Method</h1>
			</div>
			<div class="content">
				<label>Please select one of below payment methods:</label>
				<br /><br />
				<table width="100%">
					<tr>
						<td class="center">
							<label for="payment1"><img height="62px" src="<?=IMG_URL?>payment/onepay.png" alt="OnePay" /></label>
							<br />
							<input id="payment1" type="radio" name="payment" checked="checked" value="OnePay" />
							<label for="payment1">OnePay</label>
						</td>
						<td class="center">
							<label for="payment2"><img width="98px" height="62px" src="<?=IMG_URL?>payment/paypal.png" alt="Paypal" /></label>
							<br />
							<input id="payment2" type="radio" name="payment" value="Paypal" />
							<label for="payment2">Paypal</label>
						</td>
						<td class="center">
							<label for="payment3"><img width="98px" height="62px" src="<?=IMG_URL?>payment/western_union.png" alt="Western Union" /></label>
							<br />
							<input id="payment3" type="radio" name="payment" value="Western Union" />
							<label for="payment3">Western Union</label>
						</td>
						<td class="center">
							<label for="payment4"><img width="98px" height="62px" src="<?=IMG_URL?>payment/bank_tranfer_acb.png" alt="Bank Transfer" /></label>
							<br />
							<input id="payment4" type="radio" name="payment" value="Bank Transfer" />
							<label for="payment4">Bank Transfer</label>
						</td>
					</tr>
				</table>
				<br /><br />
				<div class="center">
					<input type="submit" class="red-btn confirm-btn" value="Confirm & Pay" />
				</div>
			</div>
		</div>
	</form>
</div>
<div class="clr"></div>
