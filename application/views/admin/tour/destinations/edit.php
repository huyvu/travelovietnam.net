<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>jquery.tagit.css">
<?
	$name			= isset($item->name) ? $item->name : "";
	$alias			= isset($item->alias) ? $item->alias : "";
	$thumbnail		= isset($item->thumbnail) ? $item->thumbnail : "";
	$region			= isset($item->region) ? $item->region : "";
	$glat			= isset($item->glat) ? $item->glat : NULL;
	$glong			= isset($item->glong) ? $item->glong : NULL;
	$tags			= isset($item->tags) ? $item->tags : "";
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
			Tour Destination: <small><small>[ Edit ]</small></small>
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
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_tour_destinations")?>">
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
											<label>Region:</label>
										</td>
										<td width="100%">
											<select id="region" name="region">
												<option value="">Select...</option>
												<option value="Northern">Northern of Vietnam</option>
												<option value="Central">Central of Vietnam</option>
												<option value="Southern">Southern of Vietnam</option>
											</select>
											<script> setValueHTML("region", '<?=$region?>'); </script>
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
									<tr>
										<td width="10%">
											<label for="tags">Tags:</label>
										</td>
										<td width="100%">
											<input type="hidden" name="destinationTags" id="destinationTags" disable="true">
											<ul id="myTags">
												<!-- Existing list items will be pre-added to the tags -->
												<?
													if (!empty($tags)) {
														$Tags = explode(",", $tags);
														foreach ($Tags as $tag) {
															echo "<li>$tag</li>";
														}
													}
												?>
												<!-- <li>Tag1</li>
												<li>Tag2</li> -->
											</ul>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?=JS_URL?>tag-it.min.js"></script>
<script type="text/javascript">
	jQuery.noConflict();
	(function($){
		var tags = "<?=$tags?>".split(",");
		$('#destinationTags').val(tags);
		$("#myTags").tagit();
		 $('#myTags').tagit({
		 	availableTags: tags,
			// This will make Tag-it submit a single form value, as a comma-delimited field.
			singleField: true,
			singleFieldNode: $('#destinationTags'),
			tagLimit : 10,
		});
	})(jQuery);
</script>
