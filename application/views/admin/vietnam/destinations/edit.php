<?
	$destination_id = isset($item->destination_id) ? $item->destination_id : 0;
	$gmap_address	= isset($item->gmap_address) ? $item->gmap_address : "";
	$title			= isset($item->title) ? $item->title : "";
	$alias			= isset($item->alias) ? $item->alias : "";
	$thumbnail		= isset($item->thumbnail) ? $item->thumbnail : "";
	$meta_title 	= isset($item->meta_title) ? $item->meta_title : "";
	$meta_key 		= isset($item->meta_key) ? $item->meta_key : "";
	$meta_desc 		= isset($item->meta_desc) ? $item->meta_desc : "";
	$summary 		= isset($item->summary) ? $item->summary : "";
	$highlight 		= isset($item->highlight) ? $item->highlight : "";
	$content 		= isset($item->content) ? $item->content : "";
	$area 			= isset($item->area) ? $item->area : "";
	$video 			= isset($item->video) ? $item->video : "";
	$population		= isset($item->population)? $item->population : "";
	$location		= isset($item->location)? $item->location : "";
	$whentogo		= isset($item->whentogo)? $item->whentogo : "";
	$lang 			= isset($item->lang) ? $item->lang : "EN";
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
			Vietnam Destination: <small><small>[ Edit ]</small></small>
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
			
				if (form.title.value == "")
				{
					alert( "PLEASE INPUT TITLE" );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_vietnam_destinations")?>">
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
											<label>Title:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$title?>" maxlength="255" id="title" name="title" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Alias:</label>
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
											<label>Destination:</label>
										</td>
										<td width="100%">
											<select id="destination_id" name="destination_id">
												<? foreach($destinations as $destination) { ?>
												<option value="<?=$destination->id?>"><?=$destination->name?></option>
												<? } ?>
											</select>
											<script> setValueHTML("destination_id", '<?=$destination_id?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>GMap Address:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$gmap_address?>" maxlength="255" id="gmap_address" name="gmap_address" class="inputbox" style="width: 100%"/>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Meta Title (for SEO):</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$meta_title?>" maxlength="255" id="meta_title" name="meta_title" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Keywords:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$meta_key?>" maxlength="255" id="meta_key" name="meta_key" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Page description:</label>
										</td>
										<td width="100%">
											<textarea name="meta_desc" style="width:100%; height:120px"><?=$meta_desc?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Language:</label>
										</td>
										<td width="100%">
											<select id="lang" name="lang">
												<option value="EN">English</option>
												<option value="FR">French</option>
												<option value="ES">Spanish</option>
												<option value="VN">Tiếng Việt</option>
											</select>
											<script> setValueHTML("lang", '<?=$lang?>'); </script>
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
									<tr>
										<td width="10%">
											<label>Area:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$area?>" maxlength="255" id="area" name="area" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Video URL:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$video?>" id="video" name="video" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Population:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$population?>" maxlength="255" id="population" name="population" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Location:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$location?>" maxlength="255" id="location" name="location" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>When to go:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$whentogo?>" maxlength="255" id="whentogo" name="whentogo" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%" valign="top">
											<label>Description:</label>
										</td>
										<td width="100%">
											<textarea name="summary" style="width:100%; height:200px"><?=$summary?></textarea>
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
									<tr>
										<td width="10%" valign="top">
											<label>Content:</label>
										</td>
										<td width="100%">
											<textarea name="content" style="width:100%; height:600px"><?=$content?></textarea>
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
