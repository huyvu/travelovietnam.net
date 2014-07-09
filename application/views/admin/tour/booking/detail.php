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
							<a class="toolbar" href="<?=site_url("administrator/tour_booking")?>">
								<span title="Cancel" class="icon-32-cancel"></span>Close
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="header icon-48-generic">
			TOUR BOOKING
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
						<div class="title">BOOKING #T<?=$item->id?></div>
						<table class="detail">
							<tbody>
								<tr>
									<td>Tour Name</td><td>:</td>
									<td><?=$this->m_tour->load($item->tour_id)->name?></td>
								</tr>
								<tr>
									<td>Class Type</td><td>:</td>
									<td><?=$item->classtype?></td>
								</tr>
								<tr>
									<td>Departure Date</td><td>:</td>
									<td><?=date("M/d/Y", strtotime($item->departure_date))?></td>
								</tr>
								<tr>
									<td>Return Date</td><td>:</td>
									<td><?=date("M/d/Y", strtotime($item->departure_date."+".($this->m_tour->load($item->tour_id)->duration-1)." days"))?></td>
								</tr>
								<tr>
									<td>Adults</td><td>:</td>
									<td><?=$item->adults?></td>
								</tr>
								<tr>
									<td>Children</td><td>:</td>
									<td><?=$item->children?></td>
								</tr>
								<tr>
									<td>Babies</td><td>:</td>
									<td><?=$item->infants?></td>
								</tr>
								<tr>
									<td>Supplements</td><td>:</td>
									<td><?=$item->supplements?></td>
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
									<td><?=$item->payment_option?></td>
								</tr>
								<tr>
									<td>Deposit</td><td>:</td>
									<td>$<?=$item->paid?></td>
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
									<th>Supplement</th>
								</tr>
								<?
									$paxs = $this->m_tour->getPaxs($item->id);
									foreach ($paxs as $pax) {
									?>
								<tr>
									<td><?=$pax->fullname?></td>
									<td align="center"><?=$pax->gender?></td>
									<td><?=date("M/d/Y", strtotime($pax->birthdate))?></td>
									<td><?=$pax->nationality?></td>
									<td align="center"><?=(($pax->supplement)?"Yes":"No")?></td>
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