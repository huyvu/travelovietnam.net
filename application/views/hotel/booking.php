<script type="text/javascript">
$(document).ready(function()
{
	$("#rooms").change(function(){
		createEntries();
	});
	
	$("#adults").change(function(){
		createEntries();
	});
	
	$("#children").change(function(){
		createEntries();
	});
	
	$("#checkin").change(function(){
		calFees();
	});
	
	$("#checkout").change(function(){
		calFees();
	});
	
	var chekindateoptions = {
			numberOfMonths : 2,
			minDate: 0
		};
	
	$("#checkin").datepicker({
			numberOfMonths : 2,
			minDate: 0,
			onClose: function( selectedDate ) {
				var minDate = $(this).datepicker('getDate');
				if (minDate) {
					minDate.setDate(minDate.getDate() + 1);
					$( "#checkout" ).datepicker( "option", "minDate", minDate );
					calFees();
				}
			}
		}
	);
	$("#checkout").datepicker(chekindateoptions);
	
	$(".confirm-btn").click(function(){
		var err = 0;
		var travelers = parseInt($("#adults").val()) + parseInt($("#children").val());
		
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
	var i = 0;
	var rooms = parseInt($("#rooms").val());
	var firstRoom = $("#room_1").html();
	var roomChild = $("#tbrooms tr").length;
	if (roomChild > rooms) {
		$("#tbrooms tr").slice(rooms).remove();
	} else {
		for (i=roomChild+1; i<=rooms; i++) {
			var room = firstRoom.replace(/_1/g, "_"+i);
			$("#tbrooms").append("<tr>"+room+"</tr>");
			$("#roomnumber_"+i).html(i);
		}
	}

	var travelers = parseInt($("#adults").val()) + parseInt($("#children").val());
	var firstTraveler = $("#traveler_1").html();
	var travelerChild = $("#tbtraveler tr").length;
	if (travelerChild > travelers) {
		$("#tbtraveler tr").slice(travelers+1).remove();
	} else {
		for (i=travelerChild; i<=travelers; i++) {
			var traveler = firstTraveler.replace(/_1/g, "_"+i);
			$("#tbtraveler").append("<tr>"+traveler+"</tr>");
			$("#travelerno_"+i).html(i);
		}
	}
	
	var birthdateoptions = {
			changeMonth: true,
			changeYear: true,
			yearRange: '1910:'+(new Date()).getFullYear()
		};

	for (var r=1; r<=rooms; r++) {
		$("#roomtype_"+r).change(function(){
			calFees();
		});
	}

	for (var t=1; t<=travelers; t++) {
		$("#birthdate_"+t).datepicker(birthdateoptions);
	}
	
	calFees();
}

function calFees()
{
	var rooms = parseInt($("#rooms").val());
	
	var p = {};
	p['hotel_id']	= $('#hotel_id').val();
	p['rooms']		= $('#rooms').val();
	p['checkin']	= $('#checkin').val();
	p['checkout']	= $('#checkout').val();
	
	for (var i=1; i<=rooms; i++) {
		p['roomtype_'+i] = $('#roomtype_'+i).val();
	}
	
    $('.totalfee_txt').html("...");
	$('.totalfee_txt').load("<?=site_url('hotels/cal_fees')?>", p, function(fee){
		$('.totalfee_txt').html("$"+fee);
	});
}
</script>

<div id="booking">
	<form action="<?=site_url("hotels/checkout")?>" method="POST">
		<h1 class="headtitle">Check-out</h1>
		<div class="traveler-information">
			<div class="title">
				<h1>Traveler Information</h1>
			</div>
			<div class="left">
				<div class="thumbnail">
					<img width="155px" height="120px" src="<?=$item->thumbnail?>">
				</div>
			</div>
			<div class="left">
				<div class="hotel-information">
					<h1><?=$item->name?></h1>
					<h3><?=$item->address?></h3>
				</div>
			</div>
			<div class="clr"></div>
			<div class="traveler">
				<div class="pricing">
					<div class="left">
						<b>Number of Rooms: </b>
						<select id="rooms" name="rooms">
							<? for ($i=1; $i <= 20; $i++) { ?>
							<option value="<?=$i?>"><?=$i?></option>
							<? } ?>
						</select>
					</div>
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
					<span style="margin-left: 10px">Check-in date</span>
					<span class="calendar"><input type="text" id="checkin" name="checkin" value="<?=date('m/d/Y')?>" placeholder="mm/dd/yyyy"></span>
					<span style="margin-left: 10px">Check-out date</span>
					<span class="calendar"><input type="text" id="checkout" name="checkout" value="<?=date('m/d/Y', strtotime(' +1 day'))?>" placeholder="mm/dd/yyyy"></span>
					<div class="right totalfee"><strong>TOTAL: <span class="totalfee_txt"></span></strong></div>
					<div class="clr"></div>
				</div>
				<div class="detail">
					<table id="tbrooms" cellpadding="0" cellspacing="0">
						<tr id="room_1">
							<td style="margin: 10px 0px 10px 0px">
								<span style="width: 100px; display: inline-table;"><b>ROOM <span id="roomnumber_1">1</span>:</b></span>
								<span>Room type</span>
								<select id="roomtype_1" name="roomtype_1">
									<?
										$roomnames = array();
										foreach ($rooms as $room) {
											if (!in_array($room->name, $roomnames)) {
												$roomnames[] = $room->name;
												?>
												<option value="<?=$room->id?>"><?=$room->name." (".$room->room_type.")"?></option>
												<?
											}
										}
									?>
								</select>
								<div class="none">
									<span style="margin-left: 10px">Extra bed ?</span>
									<input type="radio" id="extra-bed-y_1" name="extra-bed_1" value="1" checked="checked"><label for="extra-bed-y_1">Yes</label>
									<input type="radio" id="extra-bed-n_1" name="extra-bed_1" value="0"><label for="extra-bed-n_1">No</label>
									<span style="margin-left: 10px"><a>&raquo; Price detail</a></span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="detail">
					<span style="width: 100px; display: inline-table;"><b>TRAVELER:</b></span>
					<table id="tbtraveler" cellpadding="0" cellspacing="0" style="display: inline-table;">
						<thead>
							<tr>
								<th scope="col">No.</th>
								<th scope="col">First name</th>
								<th scope="col">Last name</th>
								<th scope="col">Gender</th>
								<th scope="col">Birth date</th>
								<th scope="col">Nationality</th>
							</tr>
						</thead>
						<tbody class="selected">
							<tr id="traveler_1">
								<td id="travelerno_1" class="center">1</td>
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
		<input type="hidden" name="hotel_id" id="hotel_id" value="<?=$item->id?>" />
	</form>
</div>
<div class="clr"></div>
