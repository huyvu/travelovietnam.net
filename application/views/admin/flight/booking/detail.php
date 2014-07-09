<style>
.title {
	font-size: 16px;
	font-weight: normal;
	padding: 10px 0px;
}
.detail {
	margin-left: 20px;
}
.detail tr td {
	padding: 4px;
}
.tbltraveler {
	width: 600px;
	margin-left: 20px;
	border-collapse: collapse;
}
.tbltraveler tr th {
	padding: 4px 10px;
	background-color: #F0F0F0;
	border: 1px solid #666666;
	font-weight: bold;
}
.tbltraveler tr td {
	padding: 4px 10px;
	border: 1px solid #666666;
}
</style>
<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div id="toolbar" class="toolbar">
			<table class="toolbar">
				<tbody>
					<tr>
						<td id="toolbar-cancel" class="button">
							<a class="toolbar" href="<?=site_url("administrator/flight_booking")?>">
								<span title="Cancel" class="icon-32-cancel"></span>Close
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="header icon-48-generic">
			FLIGHT BOOKING
		</div>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
<div class="clr"></div>
<div id="element-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tbody>
				<tr>
					<td valign="top">
						<div class="title">BOOKING #F<?=$item->id?></div>
						<table class="detail">
							<tbody>
								<tr>
									<td>Airline</td><td>:</td>
									<td>Vietnam Airline</td>
								</tr>
								<tr>
									<td>Round Trip</td><td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Departure</td><td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Arrival</td><td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Adults</td><td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Children</td><td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Babies</td><td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Total Amount</td><td>:</td>
									<td>$<?=$item->total_fee?></td>
								</tr>
								<tr>
									<td>Payment Method</td><td>:</td>
									<td><?=$item->payment_method?></td>
								</tr>
								<tr>
									<td>Payment Option</td><td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Deposit</td><td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Status</td><td>:</td>
									<td><?=(($item->status==1) ? "Paid" : "UnPaid")?></td>
								</tr>
							</tbody>
						</table>
						<br/>
						<div class="title">TRAVELER INFORMATION</div>
						<table class="tbltraveler">
							<tbody>
								<tr>
									<th>Fullname</th>
									<th>Gender</th>
									<th>Birth Date</th>
									<th>Nationality</th>
								</tr>
								<?
									$paxs = $this->m_flight->getPaxs($item->id);
									foreach ($paxs as $pax) {
									?>
								<tr>
									<td><?=$pax->fullname?></td>
									<td><?=$pax->gender?></td>
									<td><?=date("M/d/Y", strtotime($pax->birthdate))?></td>
									<td><?=$pax->nationality?></td>
								</tr>
								<? } ?>
							</tbody>
						</table>
						<br/>
						<div class="title">CONTACT INFORMATION</div>
						<table class="detail">
							<tbody>
								<tr>
									<td>Fullname</td><td>:</td>
									<td><?=$item->fullname?></td>
								</tr>
								<tr>
									<td>Email</td><td>:</td>
									<td><?=$item->email?></td>
								</tr>
								<tr>
									<td>Phone</td><td>:</td>
									<td><?=$item->phone?></td>
								</tr>
								<tr>
									<td>Special Request</td><td>:</td>
									<td><?=$item->message?></td>
								</tr>
								<tr>
									<td>Booking Date</td><td>:</td>
									<td><?=$item->booking_date?></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>