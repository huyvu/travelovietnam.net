<?
	$leaving_from	= isset($item->leaving_from) ? $item->leaving_from : "";
	$going_to		= isset($item->going_to) ? $item->going_to : "";
	$airline		= isset($item->airline) ? $item->airline : "";
	$flight 		= isset($item->flight) ? $item->flight : "";
	$aircraft 		= isset($item->aircraft) ? $item->aircraft : "";
	$stops 			= isset($item->stops) ? $item->stops : 0;
	$stop_detail 	= isset($item->stop_detail) ? $item->stop_detail : "";
	$departure_time = isset($item->departure_time) ? $item->departure_time : "";
	$arrival_time 	= isset($item->arrival_time) ? $item->arrival_time : "";
	$duration 		= isset($item->duration) ? $item->duration : "";
	$saverflex 		= isset($item->saverflex) ? $item->saverflex : 0;
	$economy 		= isset($item->economy) ? $item->economy : 0;
	$business 		= isset($item->business) ? $item->business : 0;
	$active			= isset($item->active) ? $item->active : 1;
?>

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
			Flight: <small><small>[ Edit ]</small></small>
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
					submitform( pressbutton );
					return;
				}
			
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_flight")?>">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="airport" value="<?=$airport->alias?>" />
			<? if (isset($item)) { ?>
				<input type="hidden" name="action" id="action" value="edit"/>
				<input type="hidden" name="id" id="id" value="<?=(isset($item->id)?$item->id:0)?>"/>
			<? } else { ?>
				<input type="hidden" name="action" id="action" value="new"/>
			<? } ?>
			
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tbody>
					<tr>
						<td valign="top">
							<table class="adminform">
								<tbody>
									<tr>
										<td width="10%">
											<label>From:</label>
										</td>
										<td width="100%">
											<select id="leaving_from" name="leaving_from" style="width: 200px">
												<? foreach ($airports as $airport) { ?>
												<option value="<?=$airport->code?>"><?=$airport->name?></option>
												<? } ?>
												<script> setValueHTML("leaving_from", '<?=$leaving_from?>'); </script>
											</select>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>To:</label>
										</td>
										<td width="100%">
											<select id="going_to" name="going_to" style="width: 200px">
												<? foreach ($airports as $airport) { ?>
												<option value="<?=$airport->code?>"><?=$airport->name?></option>
												<? } ?>
												<script> setValueHTML("going_to", '<?=$going_to?>'); </script>
											</select>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Airline:</label>
										</td>
										<td width="100%">
											<select id="airline" name="airline" style="width: 200px">
												<option value="Vietnam Airlines">Vietnam Airlines</option>
											</select>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Flight No.:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$flight?>" maxlength="255" id="flight" name="flight" class="inputbox" style="width: 100px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Aircraft:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$aircraft?>" maxlength="255" id="aircraft" name="aircraft" class="inputbox" style="width: 100px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Departure Time:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$departure_time?>" maxlength="255" id="departure_time" name="departure_time" class="inputbox" placeholder="8:30 am" style="width: 100px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Arrival Time:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$arrival_time?>" maxlength="255" id="arrival_time" name="arrival_time" class="inputbox" placeholder="10:30 am" style="width: 100px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Duration:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$duration?>" maxlength="255" id="duration" name="duration" class="inputbox" placeholder="2h" style="width: 100px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Saver Flex:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$saverflex?>" maxlength="255" id="saverflex" name="saverflex" class="inputbox" style="width: 100px; text-align: right;" /> USD
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Economy:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$economy?>" maxlength="255" id="economy" name="economy" class="inputbox" style="width: 100px; text-align: right;" /> USD
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Business:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$business?>" maxlength="255" id="business" name="business" class="inputbox" style="width: 100px; text-align: right;" /> USD
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Stops:</label>
										</td>
										<td width="100%">
											<select id="stops" name="stops" style="width: 100px">
												<option value="0">Non-Stop</option>
												<option value="1">1 stop</option>
												<option value="2">2 stops</option>
												<option value="3">3 stops</option>
											</select>
											<script> setValueHTML("stops", '<?=$stops?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%" valign="top">
											<label>Stop detailed:</label>
										</td>
										<td width="100%">
											<textarea id="stop_detail" name="stop_detail" style="width:100%; height:200px"><?=$stop_detail?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Published:</label>
										</td>
										<td width="100%">
											<input type="radio" value="0" id="state0" name="active" <?=(!$active) ? "checked='checked'" : ""?> />
											<label for="state0">No</label>
											<input type="radio" value="1" id="state1" name="active" <?=($active) ? "checked='checked'" : ""?> />
											<label for="state1">Yes</label>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
