<style>
.prss0 {
}
.prss1 {
	color: orange;
}
.prss2 {
	color: red;
}
.car_item {
	background-color: #ADA081;
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
						<a class="toolbar" href="<?=site_url("administrator/visa_booking")?>">
							<span title="Cancel" class="icon-32-cancel"></span>Cancel
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
		<div class="header icon-48-generic">
			VISA BOOKING
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
		<script type="text/javascript" language="javascript">
			function submitbutton(pressbutton)
			{
				var form = document.adminForm;
				if (pressbutton == 'cancel') 
				{
					submitform(pressbutton);
					return;
				}
			
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="index.php">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			    <tbody><tr>
			        <td valign="top">
			            <table>
			            	<tbody>
							<tr>
			        			<td width="100px" valign="top">
			        				<label for="description">Primary email:</label>
			        			</td>
			        			<td width="100%"><?=$item->primary_email?></td>
							</tr>
							<tr>
			        			<td width="10%" valign="top">
			        				<label for="description">Secondary email:</label>
			        			</td>
			        			<td width="100%"><?=$item->secondary_email?></td>
							</tr>
			            	<tr>
			        			<td width="10%" valign="top">
			        				<label for="description">Type of Visa:</label>
			        			</td>
			        			<td width="100%"><?=$item->visa_type?></td>
							</tr>
							<tr>
			        			<td width="10%" valign="top">
			        				<label for="description">Port of Arrival:</label>
			        			</td>
			        			<td width="100%"><?=$item->arrival_port?></td>
							</tr>
			                <tr>
			        			<td width="10%">
			        				<label for="name">Date of Arrival:</label>
			        			</td>
			        			<td width="100%"><?=date("M/d/Y", strtotime($item->arrival_date))?></td>
							</tr>	
							<tr>
			        			<td width="10%">
			        				<label for="name">Date of Departure:</label>
			        			</td>
			        			<td width="100%"><?=date("M/d/Y", strtotime($item->exit_date))?></td>
							</tr>		
							<tr>
							    <td width="10%" valign="top">
			        				<label>Applications:</label>
			        			</td>
			        			<td width="100%">
			        				<table bordercolor="#3D496B" border="1" width="100%" style="border-collapse: collapse;">
			        					<tbody><tr>
			        						<th>Full name</th>
			        						<th>Gender</th>
			        						<th>Date of birth</th>
			        						<th>Nationality</th>
			        						<th>Passport</th>
			        					</tr>
			        					<?
			        						$paxs = $this->m_visa->getTravelers($item->id);
			        						foreach ($paxs as $pax) {
			        					?>
			        					<tr>
			        						<td><?=$pax->fullname?></td>
			        						<td><?=$pax->gender?></td>
			        						<td><?=date("M/d/Y", strtotime($pax->birthday))?></td>
			        						<td><?=$pax->nationality?></td>
			        						<td><?=$pax->passport?></td>
			        						<!-- 
			        						<td><?=date("M/d/Y", strtotime($pax->passport_expiration_date))?></td>
			        						 -->
			        					</tr>
			        					<? } ?>
			        					</tbody>
			        				</table>
			        			</td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Number of entry:</label>
			        			</td>
			        			<td width="100%"><?=$item->group_size?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Processing time:</label>
			        			</td>
			        			<td width="100%"><?=($item->rush_type==0 ? "Normal" : ($item->rush_type==1 ? "Urgent" : "Emergency"))?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Flight number:</label>
			        			</td>
			        			<td width="100%"><?=$item->flight_number?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Arrival time:</label>
			        			</td>
			        			<td width="100%"><?=$item->arrival_time?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Stamping fee:</label>
			        			</td>
			        			<td width="100%">$<?=$item->stamp_fee?> x <?=$item->group_size?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Total Service fee:</label>
			        			</td>
			        			<td width="100%">$<?=$item->total_visa_fee?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Rush fee:</label>
			        			</td>
			        			<td width="100%">$<?=$item->rush_fee?> x <?=$item->group_size?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Discount:</label>
			        			</td>
			        			<td width="100%"><?=$item->discount?>%</td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Total amount:</label>
			        			</td>
			        			<td width="100%">$<?=$item->total_fee?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Payment method:</label>
			        			</td>
			        			<td width="100%"><?=$item->payment_method?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Special request:</label>
			        			</td>
			        			<td width="100%"><?=$item->special_request?></td>
							</tr>
							<tr>
			        			<td width="10%">
			        				<label for="name">Booking date:</label>
			        			</td>
			        			<td width="100%"><?=$item->booking_date?></td>
							</tr>
						</tbody></table>
			        </td>
			    </tr>
			</tbody></table>
			
			<input type="hidden" value="com_evisa" name="option">
			<input type="hidden" value="799096867" name="id">
			<input type="hidden" value="" name="task">
			<input type="hidden" value="booking" name="c">
			<input type="hidden" value="1" name="200b7250f2aa8b37d9607e2eb8248c29">
		</form>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
