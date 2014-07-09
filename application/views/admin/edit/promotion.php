<?
	$code		= isset($item->code) ? $item->code : "";
	$visa_type	= isset($item->visa_type) ? $item->visa_type : "";
	$start_date = isset($item->start_date) ? $item->start_date : "mm/dd/yyyy";
	$end_date 	= isset($item->end_date) ? $item->end_date : "mm/dd/yyyy";
	$discount 	= isset($item->discount) ? $item->discount : 0;
	$description= isset($item->description) ? $item->description : "";
	$active		= isset($item->active) ? $item->active : 1;
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
			Promotion: <small><small>[ New ]</small></small>
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
			
				if (form.codes.value == "")
				{
					alert( "PLEASE INPUT THE NUMBER OF CODE" );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_promotion")?>">
			<input type="hidden" name="task" value="" />
			<? if (isset($item)) { ?>
				<input type="hidden" name="action" id="action" value="edit"/>
				<input type="hidden" name="id" id="id" value="<?=(isset($item->code)?$item->code:"")?>"/>
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
											<label for="codes">Numer of Code:</label>
										</td>
										<td width="100%">
											<input type="text" value="1" maxlength="255" id="codes" name="codes" class="inputbox" style="width: 120px; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="codes">Discount (%):</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$discount?>" maxlength="255" id="discount" name="discount" class="inputbox" style="width: 120px; margin-left: 0px" />%
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="codes">Type of Visa:</label>
										</td>
										<td width="100%">
											<select id="visa_type" name="visa_type" style="width: 120px; margin-left: 0px">
												<option value="1ms">1 month single</option>
												<option value="1mm">1 month multiple</option>
												<option value="3ms">3 months single</option>
												<option value="3mm">3 months multiple</option>
											</select>
											<script> setValueHTML('visa_type', '<?=$visa_type?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Start Date:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$start_date?>" maxlength="255" id="start_date" name="start_date" class="inputbox" style="width: 120px; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">End Date:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$end_date?>" maxlength="255" id="end_date" name="end_date" class="inputbox" style="width: 120px; margin-left: 0px" />
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label for="description">Description:</label>
										</td>
										<td width="100%">
											<textarea id="content" name="content" style="width:100%; height:200px"><?=$description?></textarea>
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
