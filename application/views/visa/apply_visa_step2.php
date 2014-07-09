<?
$other_nations = 0;
$india_nations = 0;
if ($step1 != null) {
	foreach ($step1->nationality as $nation) {
		if ($nation == "India") {
			$india_nations ++;
		} else {
			$other_nations ++;
		}
	}
}
?>
<div id="view-container">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Visa" href="<?=site_url("visa")?>">Visa</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Apply Visa Online - Applicant Detail
	</div>
	<div class="tab-step">
		<h1 class="note">Vietnam Visa Application Form</h1>
		<ul class="style-step">
			<li><font class="number">1.</font> Applicant Detail</li>
			<li class="active"><font class="number">2.</font> Review &amp; Payment</li>
		</ul>
	</div>
	<div class="clr"></div>
	<div class="b-error <?=(($this->session->flashdata('error') != null)?"":"none")?>">
		<? if ($this->session->flashdata('error')) {?>
			<div class='marker'><?=$this->session->flashdata('error')?></div>
		<? } ?>
	</div>
	<div class="detailvisa">
		<form action="<?=BASE_URL_HTTPS."/visa/completed"?>" method="post">
			<div class="detailstep3">
				<h3>Please review your Visa application details !</h3>
				<table width="100%">
					<tr>
						<th>Type of Visa</th>
						<th>Date of Arrival</th>
						<th>Date of Exit</th>
						<th>Purpose of Visit</th>
						<th>Arrival Port</th>
						<th>Processing Time</th>
						<th>Flight Number</th>
					</tr>
					<tr>
						<? if ($step1->visa_type == "3mme") { ?>
						<td>Vietnam Visa at Consulate or Embassy - 3 months</td>
						<? } else { ?>
						<td>Visa on Arrival - <?=$this->util->getVisaType2String($step1->visa_type)?></td>
						<? } ?>
						<td><?=date("M d, Y", strtotime($step1->arrivalmonth."/".$step1->arrivaldate."/".$step1->arrivalyear))?></td>
						<td><?=date("M d, Y", strtotime($step1->exitmonth."/".$step1->exitdate."/".$step1->exityear))?></td>
						<td><?=$step1->visit_purpose?></td>
						<td><?=$step1->arrival_port?></td>
						<td><?=$step1->processing_time?></td>
						<td><?=$step1->flightnumber?> - <?=$step1->arrivaltime?></td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<th width="50" class="center">Applicant</th>
						<th width="200">Full Name</th>
						<th>Gender</th>
						<th>Date of Birth</th>
						<th>Nationality</th>
						<th width="120">Passport Number</th>
					</tr>
					<?
						for ($i=1; $i<=$step1->group_size; $i++) {
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td><?=$step1->fullname[$i]?></td>
								<td><?=$step1->gender[$i]?></td>
								<td><?=date("M d, Y", strtotime($step1->birthmonth[$i]."/".$step1->birthdate[$i]."/".$step1->birthyear[$i]))?></td>
								<td><?=$step1->nationality[$i]?></td>
								<td><?=$step1->passportnumber[$i]?></td>
							</tr>
							<?
						}
					?>
				</table>
				<h3>Service Fees:</h3>
				<table width="100%">
					<tr>
						<th class="center">Type of Service</th>
						<th class="center">Quantity</th>
						<th class="center">Unit Price</th>
						<th class="center">Fees</th>
					</tr>
					<tr>
						<? if ($step1->visa_type == "3mme") { ?>
						<td>Vietnam Visa at Consulate or Embassy - 3 months</td>
						<? } else { ?>
						<td>Visa on Arrival - <?=$this->util->getVisaType2String($step1->visa_type)?></td>
						<? } ?>
						<td class="center"><?=$step1->group_size?></td>
						<td class="center"><?=$step1->service_fee?> USD</td>
						<td class="center"><?=($step1->service_fee*$other_nations)+($this->util->calIndianFee($step1->visa_type)*$india_nations)?> USD <? if ($india_nations) { ?><a href="#" tooltip="sticky1"><b>[?]</b></a><? } ?></td>
					</tr>
					<tr>
						<td>Processing Time - <?=$step1->processing_time?></td>
						<td class="center"><?=$step1->group_size?></td>
						<td class="center"><?=$step1->rush_fee?> USD</td>
						<td class="center"><?=$step1->rush_fee*$step1->group_size?> USD</td>
					</tr>
					<?
						if ($step1->airport_fast_checkin) {
							?>
							<tr>
								<td><?=(($step1->airport_fast_checkin==2) ? "VIP" : "Airport")?> Fast Track</td>
								<td class="center"><?=$step1->group_size?></td>
								<td class="center"><?=$step1->airport_fast_checkin_fee?> USD</td>
								<td class="center"><?=$step1->airport_fast_checkin_total_fee?> USD</td>
							</tr>
							<?
						}
					?>
					<?
						if ($step1->car_pickup) {
							?>
							<tr>
								<td>Car Pick-up (<?=$step1->car_type?>, <?=$step1->num_seat?> seats)</td>
								<td class="center">1</td>
								<td class="center"><?=$step1->car_fee?> USD</td>
								<td class="center"><?=$step1->car_total_fee?> USD</td>
							</tr>
							<?
						}
					?>
					<tr>
						<td class="center total" colspan="3">Total</td>
						<td class="center total"><?=$step1->total_fee?> USD</td>
					</tr>
				</table>
				<?	if (!empty($promotion_code)) { ?>
					<div class="promotion">
						<label>Enter promotion code:</label>
						<input type="text" id="promotion_code" name="promotion_code" value="" />
						<span style="margin-left: 10px"><a href="<?=site_url("promotion")?>" target="_blank">Get more code?</a></span>
					</div>
				<?	} ?>
				<br><br>
				<h3>Payment Method:</h3>
				<div class="selectpayment">
					<label>Please select one of below payment method to proceed the visa registration:</label>
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
				</div>
			</div>
			<div class="clr"></div>
			<div class="center">
				<input class="red-btn" type="button" value="<< BACK" onclick="window.location='<?=BASE_URL_HTTPS."/visa/step1"?>'"/>
				<input class="red-btn" type="submit" value="NEXT >>" />
			</div>
		</form>
	</div>
	
	<div id="stickytooltip" class="stickytooltip">
		<div id="sticky1" class="none">
			<? if ($india_nations > 0) {
				$str = ($this->util->calIndianFee($step1->visa_type)*$india_nations)." USD for ".$india_nations." Indian(s)";
				if ($other_nations > 0) {
					$str .= " and ".($other_nations*$step1->service_fee)." USD for ".$other_nations." other(s)";
				}
				echo $str;
			} ?>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=JS_URL?>stickytooltip.js"></script>
<script>
	stickytooltip.init("*[tooltip]", "stickytooltip");
</script>