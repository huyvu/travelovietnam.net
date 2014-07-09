<?
	$author			= isset($item->author) ? $item->author : "";
	$avatar			= isset($item->avatar) ? $item->avatar : "";
	$title			= isset($item->title) ? $item->title : "";
	$content		= isset($item->content) ? $item->content : "";
	$email			= isset($item->email) ? $item->email : "";
	$nationality	= isset($item->nationality) ? $item->nationality : "";
	$rating			= isset($item->rating) ? $item->rating : 1;
	$active			= isset($item->active) ? $item->active : 1;
	
	$nationalities	= $this->m_nation->getItems();
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
			Testimonial: <small><small>[ Edit ]</small></small>
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
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_testimonial")?>">
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
											<label>Full name:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$author?>" maxlength="255" id="author" name="author" class="inputbox" style="width: 50%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Avatar:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$avatar?>" maxlength="255" id="avatar" name="avatar" class="inputbox" style="width: 50%; margin-left: 0px" onclick="openKCFinder4Textbox(this)" value="Click here and select a file double clicking on it" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Email:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$email?>" maxlength="255" id="email" name="email" class="inputbox" style="width: 50%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Nationality:</label>
										</td>
										<td width="100%">
											<select id="nationality" name="nationality">
												<? foreach($nationalities as $nation) { ?>
												<option value="<?=$nation->name?>"><?=$nation->name?></option>
												<? } ?>
											</select>
											<script> setValueHTML("nationality", '<?=$nationality?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Title:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$title?>" maxlength="255" id="title" name="title" class="inputbox" style="width: 50%; margin-left: 0px" />
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
									<tr>
										<td width="10%">
											<label>Rating:</label>
										</td>
										<td width="100%">
											<select id="rating" name="rating">
												<option value="1">Dissatified</option>
												<option value="2">Need Improve</option>
												<option value="3">Normal</option>
												<option value="4">Satified</option>
												<option value="5">Very Satified</option>
											</select>
											<script> setValueHTML("rating", '<?=$rating?>'); </script>
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
