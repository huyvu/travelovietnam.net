<?
	$hassupplement = false;
	if ($item->daily) {
		$rate_info = new stdClass();
		$rate_info->tour_id = $booking->tour_id;
		$rates = $this->m_tour_rate->getItems($rate_info, 1);
		foreach ($rates as $rate) {
			if ($rate->single_supplement) {
				$hassupplement = true;
			}
		}
	} else {
		if (!empty($booking->departure_id)) {
			$departure = $this->m_tour_departure->load($booking->departure_id);
			$hassupplement = (!empty($departure->supplement));
		}
	}
?>

<script type="text/javascript">
$(document).ready(function()
{
	$(".view-map").fancybox();

	$(".apply-code").click(function(){
		$('.promotion_error').hide();
		$('.promotion-error').show('fade');
		$('.promotion-input').addClass('error');
		$('.promotion-input').select();
	});
	
	$(".payment-option").change(function(){
		if ($(this).val() == "Pay later") {
			$(".payment-method-div").hide();
		} else {
			$(".payment-method-div").show();
		}
	});
	
	$(".confirm-btn").click(function(){
		var err = 0;
		
		if (!$("#information-confirm").is(":checked")) {
			$("#information-confirm").parent().addClass("error");
			err++;
		} else {
			$("#information-confirm").parent().removeClass("error");
		}
		if (!$("#terms-conditions-confirm").is(":checked")) {
			$("#terms-conditions-confirm").parent().addClass("error");
			err++;
		} else {
			$("#terms-conditions-confirm").parent().removeClass("error");
		}
		
		if (err == 0) {
			return true;
		}
		else {
			msgbox("Please fill-in all required fields(<span class='required'>*</span>) marked in red.");
			return false;
		}
	});
});
</script>
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Tours" href="<?=site_url("tours/search")?>">Vietnam Tours</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")?>"><?=$item->name?></a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Booking
	</div>
	<h1 class="page-title">STEP 2: REVIEW & PAYMENT</h1>
	<div>
		<form action="<?=PROTOCOL.$_SERVER['SERVER_NAME']."/tours/checkout.html"?>" method="POST">
			<div id="booking">
				<div class="booking-content">
					<div class="planning-information">
						<div class="planning-information-content" style="padding-left: 0px">
							<div style="background-color: #F5F5F5">
								<div class="left">
									<div class="thumbnail">
										<a class="view-map" title="<?=$item->name?>" href="<?=$item->map?>"><img width="185px" src="<?=$item->map?>"></a>
									</div>
								</div>
								<div class="left">
									<div class="tour-information" style="width: 730px">
										<div class="tour-name">
											<a target="_blank" title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")?>"><?=$item->name?></a>
										</div>
										<div class="sub-title"><?=$item->sub_title?></div>
										<ul class="tour-info">
											<li><b>Code:</b> <?=$item->code?></li>
											<li><b>Duration:</b> <?=($item->duration > 1) ? $item->duration." days - ".($item->duration-1)." nights" : $item->duration." day"?></li>
											<? if (!empty($booking->departure_id)) {
												$departure = $this->m_tour_departure->load($booking->departure_id);
											?>
											<li><b>Start:</b> <?=date('M d, Y', strtotime($departure->start))?></li>
											<li><b>Finish:</b> <?=date('M d, Y', strtotime($departure->finish))?></li>
											<? } ?>
										</ul>
										<div class="ref-link">
								    		<a title="" target="_blank" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")."#itinerary"?>">&raquo; Itinerary</a>
								    	</div>
								    	<div class="ref-link">
								    		<a title="" target="_blank" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}/tripnote")?>">&raquo; Trip notes</a>
								    	</div>
								    	<div class="ref-link">
								    		<a title="" target="_blank" href="<?=site_url("tours/booking-conditions")?>">&raquo; Booking conditions</a>
								    	</div>
									</div>
								</div>
								<div class="clr"></div>
							</div>
						</div>
					</div>
					
					<div class="planning-information">
						<div class="title">Tour Booking Information</div>
						<div class="planning-information-content">
							<table class="tbtraveler" width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<th>
										Code
									</th>
									<? if ($item->daily) { ?>
									<th>
										Departure Date
									</th>
									<th>
										Class
									</th>
									<? } ?>
									<? if (!empty($departure)) { ?>
									<th>
										Start
									</th>
									<th>
										Finish
									</th>
									<? } ?>
									<th>
										Adults
									</th>
									<th>
										Children
									</th>
									<th>
										Infants
									</th>
									<? if ($hassupplement) { ?>
									<th>
										Supplement
									</th>
									<? } ?>
									<th width="120px">
										Total Price
									</th>
									<th width="40px">
										Edit
									</th>
								</tr>
								<tr class="even">
									<td>
										<a target="_blank" title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")?>"><?=$item->code?></a>
									</td>
									<? if ($item->daily) { ?>
									<td>
										<?=date('M d, Y', strtotime($booking->departure_date))?>
									</td>
									<td>
										<?=$booking->classtype?>
									</td>
									<? } ?>
									<? if (!empty($departure)) { ?>
									<td>
										<?=date('M d, Y', strtotime($departure->start))?>
									</td>
									<td>
										<?=date('M d, Y', strtotime($departure->finish))?>
									</td>
									<? } ?>
									<td>
										<?=$booking->adults." x $".number_format($booking->tour_rate,2,'.',',')?>
									</td>
									<td>
										<?=$booking->children." x $".number_format(round($booking->tour_rate * 0.7),2,'.',',')?>
									</td>
									<td>
										<?=$booking->infants." x $0.00"?>
									</td>
									<? if ($hassupplement) { ?>
									<td>
										<?=$booking->supplements." x $".number_format($booking->supplement_rate,2,'.',',')?>
									</td>
									<? } ?>
									<td>
										<strong>$<?=number_format($booking->total_fee,2,'.',',')?></strong>
									</td>
									<td>
										<a class="edit-button" href="<?=site_url("tours/booking/planning")?>"></a>
									</td>
								</tr>
							</table>
							<div class="promotion-bar">
								<div class="left cell">
									<label>If you have a promotion code, enter it here:</label>
								</div>
								<div class="left cell">
									<input type="text" class="input promotion-input" value="">
									<div class="promotion-error">Promotion code is invalid. Please try again!</div>
								</div>
								<div class="left cell">
									<input type="button" class="button apply-code" value="APPLY">
								</div>
								<div class="right cell" style="width: 40px">&nbsp;</div>
								<div class="right cell" style="width: 120px">
									<label><span class="price">$0</span></label>
								</div>
								<div class="right cell">
									<label>Your discount:</label>
								</div>
								<div class="clr"></div>
							</div>
							<div class="summary-bar">
								<div class="right cell" style="width: 40px">&nbsp;</div>
								<div class="right cell" style="width: 120px">
									<label><span class="price">$<?=number_format($booking->total_fee,2,'.',',')?></span></label>
								</div>
								<div class="right cell">
									<label>TOTAL (USD):</label>
								</div>
								<div class="clr"></div>
							</div>
						</div>
					</div>
					
					<div class="planning-information">
						<div class="title">Traveller Information</div>
						<div class="planning-information-content">
							<table class="tbtraveler" width="100%" cellpadding="0" cellspacing="0">
								<thead>
									<tr>
										<th class="center" width="40">
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
										<? if ($hassupplement) { ?>
										<th class="center" width="80">
											Supplement
										</th>
										<? } ?>
										<th width="40px">
											Edit
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
											<?=$booking->paxs[$i]->fullname?>
										</td>
										<td>
											<?=$booking->paxs[$i]->gender?>
										</td>
										<td>
											<?=(!empty($booking->paxs[$i]->birthdate) ? date('M d, Y', strtotime($booking->paxs[$i]->birthdate)) : '')?>
										</td>
										<td>
											<?=$booking->paxs[$i]->nationality?>
										</td>
										<? if ($hassupplement) { ?>
										<td class="center">
											<?=(($booking->paxs[$i]->supplement)?"Yes":"No")?>
										</td>
										<? } ?>
										<td>
											<a class="edit-button" href="<?=site_url("tours/booking/planning")?>"></a>
										</td>
									</tr>
									<? } ?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="planning-information">
						<div class="title">Contact Information</div>
						<div class="planning-information-content">
							<table class="tbtraveler" width="100%" cellpadding="0" cellspacing="0">
								<thead>
									<tr>
										<th>
											Full name
										</th>
										<th>
											Email
										</th>
										<th>
											Phone No.
										</th>
										<th width="40px">
											Edit
										</th>
									</tr>
								</thead>
								<tbody class="selected">
									<tr>
										<td>
											<?=$booking->fullname?>
										</td>
										<td>
											<?=$booking->email?>
										</td>
										<td>
											<?=$booking->phone?>
										</td>
										<td>
											<a class="edit-button" href="<?=site_url("tours/booking/planning")?>"></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="planning-information">
						<div class="title">Payment Information</div>
						<div class="planning-information-content">
							<div class="booking-option" style="margin-top: 0px">
								<div class="option-label">Payment Options</div>
								<div class="option-content">
									<span><input type="radio" id="option1" name="payment-option" class="payment-option" value="Full charge 100%" checked="checked" /> <label for="option1">Full charge 100%</label></span>
									<span style="margin-left: 40px"><input type="radio" id="option2" class="payment-option" name="payment-option" value="Deposit 40%" /> <label for="option2">Deposit 40% <span class="red">($<?=number_format(round($booking->total_fee*0.4),2,'.',',')?>)</span></label></span>
									<span style="margin-left: 40px"><input type="radio" id="option3" class="payment-option" name="payment-option" value="Pay later" /> <label for="option3">Pay later</label></span>
								</div>
								<div class="payment-method-div">
									<div class="option-label">Payment Methods</div>
									<div class="option-content">
										<div class="left">
											<label for="payment1"><img src="<?=IMG_URL?>payment/onepay.png" alt="OnePay" /></label>
											<br />
											<input id="payment1" type="radio" name="payment-method" checked="checked" value="OnePay" /> <label for="payment1">Visa/Master/American Express/JCB Card</label>
										</div>
										<div class="left" style="margin-left: 50px">
											<label for="payment2"><img src="<?=IMG_URL?>payment/paypal.png" alt="Paypal" /></label>
											<br />
											<input id="payment2" type="radio" name="payment-method" value="Paypal" /> <label for="payment2">Paypal</label>
										</div>
										<div class="clr"></div>
									</div>
								</div>
								<div class="option-condition">
									<div>
										<input type="checkbox" id="information-confirm" name="information-confirm" checked="checked"><label for="information-confirm">I would like to confirm the above information is correct.</label>
									</div>
									<div>
										<input type="checkbox" id="terms-conditions-confirm" name="terms-conditions-confirm" checked="checked"><label for="terms-conditions-confirm">I have read and agreed with the <a target="_blank" href="<?=site_url("terms-and-conditions")?>">Terms and Condition</a>.</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="planning-button center">
					<a href="<?=PROTOCOL.$_SERVER['SERVER_NAME']."/tours/booking/planning.html"?>" style="text-decoration: none">
						<input type="button" class="button" value="&laquo; BACK" />
					</a>
					<input type="submit" class="button confirm-btn" value="PAY NOW &raquo;" />
				</div>
			</div>
		</form>
	</div>
</div>
