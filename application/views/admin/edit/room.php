<?
	$name				= isset($item->name) ? $item->name : "";
	$thumbnail			= isset($item->thumbnail) ? $item->thumbnail : "";
	$room_type			= isset($item->room_type) ? $item->room_type : "";
	$detail				= isset($item->detail) ? $item->detail : "";
	$original_price		= isset($item->original_price) ? $item->original_price : 0;
	$price				= isset($item->price) ? $item->price : 0;
	$extra_bed			= isset($item->extra_bed) ? $item->extra_bed : 0;
	$wifi				= isset($item->wifi) ? $item->wifi : 0;
	$breakfast			= isset($item->breakfast) ? $item->breakfast : 0;
	$policies			= isset($item->policies) ? $item->policies : "";
	$active				= isset($item->active) ? $item->active : 1;
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
			Room: <small><small>[ Edit ]</small></small>
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
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_rooms")?>">
			<input type="hidden" name="hotel_id" value="<?=$hotel_id?>" />
			<input type="hidden" name="task" value="" />
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
											<label for="name">Name:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$name?>" maxlength="255" id="name" name="name" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Thumbnail:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$thumbnail?>" maxlength="255" id="thumbnail" name="thumbnail" class="inputbox" style="width: 100%" onclick="openKCFinder4Textbox(this)" value="Click here and select a file double clicking on it"/>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Room Type:</label>
										</td>
										<td width="100%">
											<select id="room_type" name="room_type">
												<option value="Single">Single</option>
												<option value="Double">Double</option>
												<option value="Twin">Twin</option>
											</select>
											<script> setValueHTML("room_type", '<?=$room_type?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Original Price:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$original_price?>" maxlength="255" id="original_price" name="original_price" class="inputbox" style="width: 60px; text-align: right;" /> USD
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Sale Price:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$price?>" maxlength="255" id="price" name="price" class="inputbox" style="width: 60px; text-align: right;" /> USD
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Detail:</label>
										</td>
										<td width="100%">
											<textarea name="detail" style="width:100%; height:600px"><?=$detail?></textarea>
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Policies:</label>
										</td>
										<td width="100%">
											<textarea name="policies" style="width:100%; height:200px"><?=$policies?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Extra Bed:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="extra_bed0" name="extra_bed" <?=(!$extra_bed) ? "checked='checked'" : ""?> />
											<label for="extra_bed0">No</label>
											<input type="radio" value="1" id="extra_bed1" name="extra_bed" <?=($extra_bed) ? "checked='checked'" : ""?> />
											<label for="extra_bed1">Yes</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Breakfast:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="breakfast0" name="breakfast" <?=($breakfast == 0) ? "checked='checked'" : ""?> />
											<label for="breakfast0">No</label>
											<input type="radio" value="1" id="breakfast1" name="breakfast" <?=($breakfast == 1) ? "checked='checked'" : ""?> />
											<label for="breakfast1">Available</label>
											<input type="radio" value="2" id="breakfast2" name="breakfast" <?=($breakfast == 2) ? "checked='checked'" : ""?> />
											<label for="breakfast2">FREE</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>WiFi:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="wifi0" name="wifi" <?=($wifi == 0) ? "checked='checked'" : ""?> />
											<label for="wifi0">No</label>
											<input type="radio" value="1" id="wifi1" name="wifi" <?=($wifi == 1) ? "checked='checked'" : ""?> />
											<label for="wifi1">Available</label>
											<input type="radio" value="2" id="wifi2" name="wifi" <?=($wifi == 2) ? "checked='checked'" : ""?> />
											<label for="wifi2">FREE</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Published:</label>
										</td>
										<td width="90%">
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
<div class="clr"></div>
