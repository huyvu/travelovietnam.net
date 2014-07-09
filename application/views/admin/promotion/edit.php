<?
	$sender			= isset($item->sender) ? $item->sender : "";
	$sender_email	= isset($item->sender_email) ? $item->sender_email : "";
	$emails			= isset($item->emails) ? $item->emails : "";
	$subject		= isset($item->subject) ? $item->subject : "";
	$content		= isset($item->content) ? $item->content : "";
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
			Promotion Template: <small><small>[ New ]</small></small>
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
			
				if (form.subject.value == "")
				{
					alert( "PLEASE INPUT THE SUBJECT" );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_promotion_txt")?>">
			<input type="hidden" name="task" value="" />
			<? if (isset($item)) { ?>
				<input type="hidden" name="action" id="action" value="edit"/>
				<input type="hidden" name="id" id="id" value="<?=(isset($item->id)?$item->id:"")?>"/>
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
											<label>Sender Name:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$sender?>" maxlength="255" id="sender" name="sender" class="inputbox" style="width: 100%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Sender Email:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$sender_email?>" maxlength="255" id="sender_email" name="sender_email" class="inputbox" style="width: 100%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>To Emails (delimiter by ';'):</label>
										</td>
										<td width="100%">
											<textarea id="emails" name="emails" style="width:100%; height:200px"><?=$emails?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Subject:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$subject?>" maxlength="255" id="subject" name="subject" class="inputbox" style="width: 100%; margin-left: 0px" />
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Message:</label>
										</td>
										<td width="100%">
											<textarea id="content" name="content" style="width:100%; height:400px"><?=$content?></textarea>
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
