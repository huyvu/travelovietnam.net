<?
	$name				= isset($item->name) ? $item->name : "";
	$alias				= isset($item->alias) ? $item->alias : "";
	$meta_title 		= isset($item->meta_title) ? $item->meta_title : "";
	$meta_key 			= isset($item->meta_key) ? $item->meta_key : "";
	$meta_desc 			= isset($item->meta_desc) ? $item->meta_desc : "";
	$thumbnail			= isset($item->thumbnail) ? $item->thumbnail : "";
	$accommodation_type	= isset($item->accommodation_type) ? $item->accommodation_type : 1;
	$category_id		= isset($item->category_id) ? $item->category_id : 0;
	$star				= isset($item->star) ? $item->star : 1;
	$city				= isset($item->city) ? $item->city : 0;
	$address			= isset($item->address) ? $item->address : "";
	$story				= isset($item->story) ? $item->story : "";
	$original_price		= isset($item->original_price) ? $item->original_price : 0;
	$price				= isset($item->price) ? $item->price : 0;
	$summary			= isset($item->summary) ? $item->summary : "";
	$amenities			= isset($item->amenities) ? $item->amenities : "";
	$highlight			= isset($item->highlight) ? $item->highlight : "";
	$detail				= isset($item->detail) ? $item->detail : "";
	$featured			= isset($item->featured) ? $item->featured : 0;
	$wifi				= isset($item->wifi) ? $item->wifi : 0;
	$breakfast			= isset($item->breakfast) ? $item->breakfast : 0;
	$active				= isset($item->active) ? $item->active : 1;
	
	$hotel_categories	= $this->m_hotel_category->getItems();
	$hotel_destinations	= $this->m_hotel_destination->getItems();
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
			Vietnam Hotel: <small><small>[ Edit ]</small></small>
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
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_hotels")?>">
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
											<label>URL Alias:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$alias?>" maxlength="255" id="alias" name="alias" class="inputbox" style="width: 100%" />
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
											<label for="name">Meta Title (for SEO):</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$meta_title?>" maxlength="255" id="meta_title" name="meta_title" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Keywords:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$meta_key?>" maxlength="255" id="meta_key" name="meta_key" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label for="name">Page description:</label>
										</td>
										<td width="100%">
											<textarea name="meta_desc" style="width:100%; height:120px"><?=$meta_desc?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Accommodation Type:</label>
										</td>
										<td width="100%">
											<input type="radio" value="1" id="accommodation_type0" name="accommodation_type" <?=($accommodation_type == 1) ? "checked='checked'" : ""?> />
											<label for="accommodation_type0">Hotel</label>
											<input type="radio" value="2" id="accommodation_type1" name="accommodation_type" <?=($accommodation_type == 2) ? "checked='checked'" : ""?> />
											<label for="accommodation_type1">Resort</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Category:</label>
										</td>
										<td width="100%">
											<select id="category" name="category">
												<? foreach($hotel_categories as $c) { ?>
												<option value="<?=$c->id?>"><?=$c->name?></option>
												<? } ?>
											</select>
											<script> setValueHTML("category", '<?=$category_id?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Star:</label>
										</td>
										<td width="100%">
											<select id="star" name="star">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
											<script> setValueHTML("star", '<?=$star?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Featured Hotel:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="featured0" name="featured" <?=(!$featured) ? "checked='checked'" : ""?> />
											<label for="featured0">No</label>
											<input type="radio" value="1" id="featured1" name="featured" <?=($featured) ? "checked='checked'" : ""?> />
											<label for="featured1">Yes</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>City:</label>
										</td>
										<td width="100%">
											<select id="city" name="city">
												<? foreach($hotel_destinations as $d) { ?>
												<option value="<?=$d->id?>"><?=$d->name?></option>
												<? } ?>
											</select>
											<script> setValueHTML("city", '<?=$city?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Address:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$address?>" maxlength="255" id="address" name="address" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Orginal Price:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$original_price?>" id="original_price" name="original_price" style="width: 60px; text-align: right"/> USD
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Sale Price:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$price?>" id="price" name="price" style="width: 60px; text-align: right"/> USD
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Summary:</label>
										</td>
										<td width="100%">
											<textarea name="summary" style="width:100%; height:200px"><?=$summary?></textarea>
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Amenities:</label>
										</td>
										<td width="100%">
											<textarea name="amenities" style="width:100%; height:200px"><?=$amenities?></textarea>
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Highlight:</label>
										</td>
										<td width="100%">
											<textarea name="highlight" style="width:100%; height:200px"><?=$highlight?></textarea>
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
