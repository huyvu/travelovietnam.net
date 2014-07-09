<style>
.pricetable {
	margin-top: 20px;
	border-collapse: collapse;
}
.pricetable td {
	padding-top: 5px;
	padding-right: 5px;
}
.pricetable input[type="text"] {
	text-align: right;
	width: 60px;
}
.pricetable input.red {
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
						<td id="toolbar-save" class="button">
							<a class="toolbar" onclick="javascript: submitbutton('save')" href="#">
							<span title="Save" class="icon-32-save">
							</span>
							Save
							</a>
						</td>
						<td id="toolbar-cancel" class="button">
							<a class="toolbar" onclick="javascript: submitbutton('cancel')" href="#">
							<span title="Cancel" class="icon-32-cancel">
							</span>
							Cancel
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="header icon-48-generic">
			Room Rates: <small><small>[ Edit ]</small></small>
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
		<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
		<script type="text/javascript" language="javascript">
			function submitbutton(pressbutton)
			{
				var form = document.adminForm;
				if (pressbutton == 'cancel') 
				{
					submitform( pressbutton );
					return;
				}
			
				submitform( pressbutton );
			}
			$(document).ready(function() {
				$("#applyall").click(function(){
					var normal_price = $("#normal_price").val();
					if (isNumeric(normal_price) && normal_price >= 0) {
						for (var w=1; w<=53; w++) {
							$("#"+w+"_MON").val(normal_price);
							$("#"+w+"_TUE").val(normal_price);
							$("#"+w+"_WED").val(normal_price);
							$("#"+w+"_THU").val(normal_price);
							$("#"+w+"_FRI").val(normal_price);
							$("#"+w+"_SAT").val(normal_price);
							$("#"+w+"_SUN").val(normal_price);
						}
					}
				});

				$("#MON").click(function(){
					var price = $("#1_MON").val();
					if (isNumeric(price) && price >= 0) {
						for (var w=2; w<=53; w++) {
							$("#"+w+"_MON").val(price);
						}
					}
				});
				$("#TUE").click(function(){
					var price = $("#1_TUE").val();
					if (isNumeric(price) && price >= 0) {
						for (var w=2; w<=53; w++) {
							$("#"+w+"_TUE").val(price);
						}
					}
				});
				$("#WED").click(function(){
					var price = $("#1_WED").val();
					if (isNumeric(price) && price >= 0) {
						for (var w=2; w<=53; w++) {
							$("#"+w+"_WED").val(price);
						}
					}
				});
				$("#THU").click(function(){
					var price = $("#1_THU").val();
					if (isNumeric(price) && price >= 0) {
						for (var w=2; w<=53; w++) {
							$("#"+w+"_THU").val(price);
						}
					}
				});
				$("#FRI").click(function(){
					var price = $("#1_FRI").val();
					if (isNumeric(price) && price >= 0) {
						for (var w=2; w<=53; w++) {
							$("#"+w+"_FRI").val(price);
						}
					}
				});
				$("#SAT").click(function(){
					var price = $("#1_SAT").val();
					if (isNumeric(price) && price >= 0) {
						for (var w=2; w<=53; w++) {
							$("#"+w+"_SAT").val(price);
						}
					}
				});
				$("#SUN").click(function(){
					var price = $("#1_SUN").val();
					if (isNumeric(price) && price >= 0) {
						for (var w=2; w<=53; w++) {
							$("#"+w+"_SUN").val(price);
						}
					}
				});
			});
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_room_rates")?>">
			<input type="hidden" name="room_id" value="<?=$room_id?>" />
			<input type="hidden" name="task" value="" />
			
			<div>Normal Price: <input type="text" name="normal_price" id="normal_price" style="text-align: right" value=""/> USD <input type="button" id="applyall" value="Apply for all"/></div>
			
			<div style="float: left">
				<table class="pricetable">
					<tr>
						<td style="color: red">ANNUAL</td>
						<td>MON <a id="MON" href="javascript:void(0)" style="padding-left: 10px">Fill &darr;</a></td>
						<td>TUE <a id="TUE" href="javascript:void(0)" style="padding-left: 10px">Fill &darr;</a></td>
						<td>WED <a id="WED" href="javascript:void(0)" style="padding-left: 10px">Fill &darr;</a></td>
						<td>THU <a id="THU" href="javascript:void(0)" style="padding-left: 10px">Fill &darr;</a></td>
						<td>FRI <a id="FRI" href="javascript:void(0)" style="padding-left: 10px">Fill &darr;</a></td>
						<td>SAT <a id="SAT" href="javascript:void(0)" style="padding-left: 10px">Fill &darr;</a></td>
						<td>SUN <a id="SUN" href="javascript:void(0)" style="padding-left: 10px">Fill &darr;</a></td>
					</tr>
					<?
					$holiday = array('1_TUE','7_SUN','7_MON','7_TUE','15_TUE','18_TUE','18_WED','22_SAT','30_MON','38_THU','52_WED');
					for ($w=1; $w<=53; $w++) {
						$mon = 0;
						$tue = 0;
						$wed = 0;
						$thu = 0;
						$fri = 0;
						$sat = 0;
						$sun = 0;
						foreach ($rates as $rate) {
							if ($rate->rate_date == $w.'_MON') {
								$mon = $rate->price;
							}
							else if ($rate->rate_date == $w.'_TUE') {
								$tue = $rate->price;
							}
							else if ($rate->rate_date == $w.'_WED') {
								$wed = $rate->price;
							}
							else if ($rate->rate_date == $w.'_THU') {
								$thu = $rate->price;
							}
							else if ($rate->rate_date == $w.'_FRI') {
								$fri = $rate->price;
							}
							else if ($rate->rate_date == $w.'_SAT') {
								$sat = $rate->price;
							}
							else if ($rate->rate_date == $w.'_SUN') {
								$sun = $rate->price;
							}
						}
					?>
					<tr>
						<td width="50px">W<?=$w?></td>
						<td><input type="text" name="<?=$w?>_MON" id="<?=$w?>_MON" class="<?=(in_array($w.'_MON', $holiday)?'red':'')?>" value="<?=$mon?>"/></td>
						<td><input type="text" name="<?=$w?>_TUE" id="<?=$w?>_TUE" class="<?=(in_array($w.'_TUE', $holiday)?'red':'')?>" value="<?=$tue?>"/></td>
						<td><input type="text" name="<?=$w?>_WED" id="<?=$w?>_WED" class="<?=(in_array($w.'_WED', $holiday)?'red':'')?>" value="<?=$wed?>"/></td>
						<td><input type="text" name="<?=$w?>_THU" id="<?=$w?>_THU" class="<?=(in_array($w.'_THU', $holiday)?'red':'')?>" value="<?=$thu?>"/></td>
						<td><input type="text" name="<?=$w?>_FRI" id="<?=$w?>_FRI" class="<?=(in_array($w.'_FRI', $holiday)?'red':'')?>" value="<?=$fri?>"/></td>
						<td><input type="text" name="<?=$w?>_SAT" id="<?=$w?>_SAT" class="<?=(in_array($w.'_SAT', $holiday)?'red':'')?>" value="<?=$sat?>"/></td>
						<td><input type="text" name="<?=$w?>_SUN" id="<?=$w?>_SUN" class="<?=(in_array($w.'_SUN', $holiday)?'red':'')?>" value="<?=$sun?>"/></td>
					</tr>
					<? } ?>
				</table>
			</div>
			<div style="float: left; margin-left: 40px">
				<table class="pricetable">
					<tr>
						<td colspan="3" style="color: red">SOLAR SPECIAL DAYS</td>
					</tr>
					<?
						$w = 1;
						foreach ($solar_rates as $rate) {
					?>
					<tr>
						<td>
							<select id="S_D_<?=$w?>" name="S_D_<?=$w?>">
								<option value="">-</option>
								<? for ($d=1; $d<=31; $d++) { ?>
								<option value="<?=$d?>"><?=$d?></option>
								<? } ?>
							</select>
							<script> setValueHTML("S_D_<?=$w?>", '<?=$rate->rate_day?>'); </script>
						</td>
						<td>
							<select id="S_M_<?=$w?>" name="S_M_<?=$w?>">
								<option value="">-</option>
								<? for ($m=1; $m<=12; $m++) { ?>
								<option value="<?=$m?>"><?=date('M', mktime(0, 0, 0, $m, 1, 2013))?></option>
								<? } ?>
							</select>
							<script> setValueHTML("S_M_<?=$w?>", '<?=$rate->rate_month?>'); </script>
						</td>
						<td>
							<input type="text" id="S_P_<?=$w?>" name="S_P_<?=$w?>" value="<?=$rate->price?>">
						</td>
					</tr>
					<?
							$w ++;
						}
					?>
					<? for (; $w<=53; $w++) { ?>
					<tr>
						<td>
							<select id="S_D_<?=$w?>" name="S_D_<?=$w?>">
								<option value="">-</option>
								<? for ($d=1; $d<=31; $d++) { ?>
								<option value="<?=$d?>"><?=$d?></option>
								<? } ?>
							</select>
							<script> setValueHTML("S_D_<?=$w?>", '<?=$room_type?>'); </script>
						</td>
						<td>
							<select id="S_M_<?=$w?>" name="S_M_<?=$w?>">
								<option value="">-</option>
								<? for ($m=1; $m<=12; $m++) { ?>
								<option value="<?=$m?>"><?=date('M', mktime(0, 0, 0, $m, 1, 2013))?></option>
								<? } ?>
							</select>
						</td>
						<td>
							<input type="text" id="S_P_<?=$w?>" name="S_P_<?=$w?>" value="">
						</td>
					</tr>
					<? } ?>
				</table>
			</div>
			<div style="float: left; margin-left: 40px">
				<table class="pricetable">
					<tr>
						<td colspan="3" style="color: red">LUNAR SPECIAL DAYS</td>
					</tr>
					<?
						$w = 1;
						foreach ($lunar_rates as $rate) {
					?>
					<tr>
						<td>
							<select id="L_D_<?=$w?>" name="L_D_<?=$w?>">
								<option value="">-</option>
								<? for ($d=1; $d<=31; $d++) { ?>
								<option value="<?=$d?>"><?=$d?></option>
								<? } ?>
							</select>
							<script> setValueHTML("L_D_<?=$w?>", '<?=$rate->rate_day?>'); </script>
						</td>
						<td>
							<select id="L_M_<?=$w?>" name="L_M_<?=$w?>">
								<option value="">-</option>
								<? for ($m=1; $m<=12; $m++) { ?>
								<option value="<?=$m?>"><?=date('M', mktime(0, 0, 0, $m, 1, 2013))?></option>
								<? } ?>
							</select>
							<script> setValueHTML("L_M_<?=$w?>", '<?=$rate->rate_month?>'); </script>
						</td>
						<td>
							<input type="text" id="L_P_<?=$w?>" name="L_P_<?=$w?>" value="<?=$rate->price?>">
						</td>
					</tr>
					<?
							$w ++;
						}
					?>
					<? for (; $w<=53; $w++) { ?>
					<tr>
						<td>
							<select id="L_D_<?=$w?>" name="L_D_<?=$w?>">
								<option value="">-</option>
								<? for ($d=1; $d<=31; $d++) { ?>
								<option value="<?=$d?>"><?=$d?></option>
								<? } ?>
							</select>
							<script> setValueHTML("L_D_<?=$w?>", '<?=$room_type?>'); </script>
						</td>
						<td>
							<select id="L_M_<?=$w?>" name="L_M_<?=$w?>">
								<option value="">-</option>
								<? for ($m=1; $m<=12; $m++) { ?>
								<option value="<?=$m?>"><?=date('M', mktime(0, 0, 0, $m, 1, 2013))?></option>
								<? } ?>
							</select>
						</td>
						<td>
							<input type="text" id="L_P_<?=$w?>" name="L_P_<?=$w?>" value="">
						</td>
					</tr>
					<? } ?>
				</table>
			</div>
		</form>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
<div class="clr"></div>
