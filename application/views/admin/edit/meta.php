<?
	$url			= isset($item->url) ? $item->url : "";
	$title			= isset($item->title) ? $item->title : "";
	$keywords 		= isset($item->keywords) ? $item->keywords : "";
	$description 	= isset($item->description) ? $item->description : "";
	$canonical 		= isset($item->canonical) ? $item->canonical : "";
	$addition_tags 	= isset($item->addition_tags) ? $item->addition_tags : "";
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
			Meta Data: <small><small>[ Edit ]</small></small>
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
			
				if (form.url.value == "")
				{
					alert( "PLEASE INPUT THE URL" );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_meta")?>">
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
											<label for="url">URL:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$url?>" maxlength="255" id="url" name="url" class="inputbox" style="width: 100%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="title">Title:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$title?>" maxlength="255" id="title" name="title" class="inputbox" style="width: 100%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="keywords">Keywords:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$keywords?>" maxlength="255" id="keywords" name="keywords" class="inputbox" style="width: 100%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="canonical">Canonical:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$canonical?>" maxlength="255" id="canonical" name="canonical" class="inputbox" style="width: 100%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%" valign="top">
											<label for="description">Description:</label>
										</td>
										<td width="90%">
											<textarea name="description" style="width:100%; height:200px"><?=$description?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%" valign="top">
											<label for="addition_tags">Additional meta tags:</label>
										</td>
										<td width="90%">
											<textarea name="addition_tags" style="width:100%; height:200px"><?=$addition_tags?></textarea>
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
