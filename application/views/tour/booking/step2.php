<script type="text/javascript">
$(document).ready(function()
{
	var birthdateoptions = {
			changeMonth: true,
			changeYear: true,
			yearRange: '1910:'+(new Date()).getFullYear()
		};

	var travelers = $("#travelers").val();
	
	for (var i=0; i<travelers; i++) {
		$("#birthdate_"+i).datepicker(birthdateoptions);
	}
	
	$(".confirm-btn").click(function(){
		var err = 0;
		
		for (i=0; i<travelers; i++) {
			if ($("#fullname_"+i).val() == "") {
				$("#fullname_"+i).addClass("error");
				err++;
			} else {
				$("#fullname_"+i).removeClass("error");
			}
			if ($("#birthdate_"+i).val() == "") {
				$("#birthdate_"+i).parent().addClass("error");
				err++;
			} else {
				$("#birthdate_"+i).parent().removeClass("error");
			}
		}

		if (err == 0) {
			return true;
		}
		else {
			return false;
		}
	});

	calFees();
});

function calFees()
{
	var p = {};
	p['tour_id']		= $('#tour_id').val();
	p['departure_id']	= $('#departure_id').val();
	p['classtype']		= $('#classtype').val();
    p['adults']			= $('#adults').val();
    p['children']		= $('#children').val();
    p['infants']		= $('#infants').val();

    $('.totalfee-txt').html("...");
	$('.totalfee-txt').load("<?=site_url('tours/cal_fees')?>", p, function(fee){
		var adults		= $('#adults').val();
		var children	= $('#children').val();
		var total_fee	= fee * adults + Math.round(fee * children * 0.7);
		$('.totalfee-txt').html("$"+(total_fee));
	});
}
</script>

<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Tours" href="<?=site_url("tours/search")?>">Vietnam Tours</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")?>"><?=$item->name?></a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Booking
	</div>
	<h1 class="page-title">STEP 2: PASSENGERS</h1>
	<div class="left" style="width: 680px">
		<div id="booking">
			<form action="<?=site_url("tours/booking/review")?>" method="POST">
				<div class="planning-information">
					<div class="title">Passenger Information</div>
					<div class="planning-information-content">
						<table class="tbtraveler" width="100%" cellpadding="0" cellspacing="0">
							<thead>
								<tr>
									<th>
										No.
									</th>
									<th>
										Full name
									</th>
									<th>
										Gender
									</th>
									<th>
										Birth date
									</th>
									<th>
										Nationality
									</th>
									<th>
										Supplement
									</th>
								</tr>
							</thead>
							<tbody class="selected">
								<? for ($i = 0; $i < $booking->travelers; $i++) { ?>
								<tr class="<?=(($i%2)?"even":"")?>">
									<td class="center">
										<?=$i+1?>
									</td>
									<td>
										<input type="text" id="fullname_<?=$i?>" name="fullname_<?=$i?>" value="<?=(!empty($booking->paxs[$i]->fullname) ? $booking->paxs[$i]->fullname : '')?>" style="width: 120px">
									</td>
									<td>
										<select id="gender_<?=$i?>" name="gender_<?=$i?>" style="width: 80px">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
										<script>$("#gender_<?=$i?>").val("<?=(!empty($booking->paxs[$i]->gender) ? $booking->paxs[$i]->gender : '')?>");</script>
									</td>
									<td>
										<span class="calendar"><input type="text" id="birthdate_<?=$i?>" name="birthdate_<?=$i?>" value="<?=(!empty($booking->paxs[$i]->birthdate) ? date('m/d/Y', strtotime($booking->paxs[$i]->birthdate)) : '')?>" placeholder="mm/dd/yyyy"></span>
									</td>
									<td>
										<select id="nationality_<?=$i?>" name="nationality_<?=$i?>" style="width: 150px">
											<? foreach ($nations as $nation) { ?>
												<option value="<?=$nation->name?>"><?=$nation->name?></option>
											<? } ?>
										</select>
										<script>$("#nationality_<?=$i?>").val("<?=(!empty($booking->paxs[$i]->nationality) ? $booking->paxs[$i]->nationality : '')?>");</script>
									</td>
									<td class="center">
										<input type="checkbox" id="supplement_<?=$i?>" name="supplement_<?=$i?>">
									</td>
								</tr>
								<? } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="center">
					<a class="button" title="Back" href="<?=site_url("tours/booking/planning")?>">&laquo; BACK</a>
					<input type="submit" class="button confirm-btn" value="NEXT &raquo;" />
					<a class="button" title="Skip this step" href="<?=site_url("tours/booking/review")?>">SKIP THIS STEP &raquo;</a>
				</div>
				<input type="hidden" name="tour_id" id="tour_id" value="<?=$booking->tour_id?>" />
				<input type="hidden" name="departure_id" id="departure_id" value="<?=$booking->departure_id?>" />
				<input type="hidden" name="adults" id="adults" value="<?=$booking->adults?>" />
				<input type="hidden" name="children" id="children" value="<?=$booking->children?>" />
				<input type="hidden" name="infants" id="infants" value="<?=$booking->infants?>" />
				<input type="hidden" name="travelers" id="travelers" value="<?=$booking->travelers?>" />
				<input type="hidden" name="classtype" id="classtype" value="<?=$booking->classtype?>" />
			</form>
		</div>
	</div>
	<div class="right">
		<div id="booking-summary-panel">
			<div class="summary-panel-title">SUMMARY</div>
			<div class="summary-panel-detail">
				<ul>
					<li>
						<div class="left">Tour code:</div>
						<div class="right"><?=$item->code?></div>
						<div class="clr"></div>
					</li>
					<li>
						<div class="left">Class type:</div>
						<div class="right"><span class="price classtype-txt"><?=$booking->classtype?></span></div>
						<div class="clr"></div>
					</li>
					<li>
						<div class="left">Departure date:</div>
						<div class="right">
							<span class="departure-date-txt">
							<?=date('D, M d, Y', strtotime($booking->departure_date))?>
							</span>
						</div>
						<div class="clr"></div>
					</li>
					<li>
						<div class="left">No. of Adults:</div>
						<div class="right"><span class="price adultfee-txt"><?=($booking->adults." x $".$booking->tour_rate." = $".round($booking->tour_rate*$booking->adults))?></span></div>
						<div class="clr"></div>
					</li>
					<li>
						<div class="left">No. of Children:</div>
						<div class="right"><span class="price childrenfee-txt"><?=($booking->children." x $".round($booking->tour_rate*0.7)." = $".round($booking->tour_rate*0.7*$booking->children))?></span></div>
						<div class="clr"></div>
					</li>
					<li>
						<div class="left">No. of Infants:</div>
						<div class="right"><span class="price infantfee-txt">Free of charge</span></div>
						<div class="clr"></div>
					</li>
					<li class="summary-panel-total">
						<div class="left">TOTAL:</div>
						<div class="right"><span class="price red totalfee-txt"><?=$booking->total_fee?></span></div>
						<div class="clr"></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>