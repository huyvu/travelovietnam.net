<?
	$citizen	= isset($item->citizen) ? $item->citizen : "";
	$title 		= isset($item->title) ? $item->title : "";
	$status 	= isset($item->status) ? $item->status : "";
	$content 	= isset($item->content) ? $item->content : "";
	$active		= isset($item->active) ? $item->active : 1;
	$nations	= $this->m_nation->getItems();
?>

<div id="content-box">
	<div class="border">
		<div class="padding">
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
						Requirement: <small><small>[ Edit ]</small></small>
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
					<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_requirement")?>">
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
														<label>Citizen:</label>
													</td>
													<td width="100%">
														<select id="citizen" name="citizen" style="width: 50%">
															<option value="">Select a nationality</option>
                 				     		 				<? foreach($nations as $n) {
																echo "<option value='{$n->name}'>{$n->name}</option>";
															} ?>
														</select>
														<script> setValueHTML('citizen', '<?=$citizen?>'); </script>
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
													<td width="10%" valign="top">
														<label for="status">Status:</label>
													</td>
													<td width="100%">
														<textarea name="status" style="width:100%; height:200px"><?=$status?></textarea>
													</td>
												</tr>
												<tr>
													<td width="10%" valign="top">
														<label for="description">Content:</label>
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
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
</div>
