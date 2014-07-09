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
			Tour Departure Rate: <small><small>[ Edit ]</small></small>
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
			
				if (form.name.value == "")
				{
					alert( "PLEASE INPUT THE NAME" );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<div style="line-height: 30px">
			<? $tour = $this->m_tour->load($departure->tour_id); ?>
			<a href="<?=site_url("administrator/tour_departure_rates/".$departure->id)?>"><?=date('Y-m-d', strtotime($departure->start)).' > '.date('Y-m-d', strtotime($departure->finish))?></a> : <?=$tour->name?>
		</div>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_tour_departure_rates_advanced")?>">
			<input type="hidden" name="departure_id" value="<?=$departure->id?>" />
			<input type="hidden" name="type" value="<?=$type?>" />
			<input type="hidden" name="task" value="" />
			<? if (!empty($type)) { ?>
				<input type="hidden" name="action" id="action" value="edit"/>
			<? } else { ?>
				<input type="hidden" name="action" id="action" value="new"/>
			<? } ?>
			
			<?
				$type = "";
				$arrduration = array();
				$hassupplement = false;
				foreach ($items as $rate) {
					if ($rate->single_supplement) {
						$hassupplement = true;
						continue;
					}
					$arrduration[$rate->id] = $rate->group_size;
					$type = $rate->name;
				}
			?>
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tbody>
					<tr>
						<td valign="top">
							<table class="adminform">
								<tbody>
									<tr>
										<td width="10%">
											<label for="name">Name:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$type?>" maxlength="255" id="name" name="name" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Group Size:</label>
										</td>
										<td width="100%">
											<? foreach ($arrduration as $key => $val) { ?>
												<input type="text" value="<?=$val?>" maxlength="255" name="group_size_<?=$key?>" class="inputbox" style="width: 60px; text-align: right;" />
											<? } ?>
											<? for ($i=sizeof($arrduration); $i<12; $i++) { ?>
												<input type="text" value="" maxlength="255" name="group_size_-<?=$i?>" class="inputbox" style="width: 60px; text-align: right;" />
											<? } ?>
											<label>Supplement</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Price:</label>
										</td>
										<td width="100%">
											<?
												foreach ($arrduration as $key => $val) {
													foreach ($items as $rate) {
														if ($rate->name == $type && $rate->group_size == $val && !$rate->single_supplement) {
															echo '<input type="text" value="'.$rate->price.'" maxlength="255" name="price_'.$key.'" class="inputbox" style="width: 60px; text-align: right;" />';
														}
													}
												}
											?>
											<? for ($i=sizeof($arrduration); $i<12; $i++) { ?>
												<input type="text" value="" maxlength="255" name="price_-<?=$i?>" class="inputbox" style="width: 60px; text-align: right;" />
											<? } ?>
											<?
												if ($hassupplement) {
													foreach ($items as $rate) {
														if ($rate->name == $type && $rate->single_supplement) {
															echo '<input type="text" value="'.$rate->price.'" maxlength="255" name="single_supplement" class="inputbox" style="width: 60px; text-align: right;" />';
														}
													}
												}
												else {
													echo '<input type="text" value="" maxlength="255" name="single_supplement" class="inputbox" style="width: 60px; text-align: right;" />';
												}
											?>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Published:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="state0" name="active" />
											<label for="state0">No</label>
											<input type="radio" value="1" id="state1" name="active" checked="checked" />
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
<div class="clr"></div>
