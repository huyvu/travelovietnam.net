<?
	$title		= isset($item->title) ? $item->title : "";
	$content 	= isset($item->content) ? $item->content : "";
	$author 	= isset($item->author) ? $item->author : 0;
	$status 	= isset($item->status) ? $item->status : 0;
	$active		= isset($item->active) ? $item->active : 1;
	
	$info->parent_id = isset($item->id) ? $item->id : 0;
	$answers = $this->m_help_question->getItems($info);
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
						Ticket: <small><small>[ Edit ]</small></small>
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
					<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_help_ticket")?>">
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
														<label for="name">Title:</label>
													</td>
													<td width="100%">
														<input type="text" value="<?=$title?>" maxlength="255" id="title" name="title" class="inputbox" style="width: 50%; margin-left: 0px" />
													</td>
												</tr>
												<tr>
													<td width="10%">
														<label for="name">Author:</label>
													</td>
													<td width="100%">
														<?=$this->m_user->load($author)->fullname?>
													</td>
												</tr>
												<tr>
													<td width="10%">
														<label for="name">Status:</label>
													</td>
													<td width="100%">
														<select id="ticket-status" name="ticket-status">
															<option value="0">Open</option>
															<option value="1">Resolved</option>
															<option value="2">Closed</option>
														</select>
														<script> setValueHTML("ticket-status", '<?=$status?>'); </script>
													</td>
												</tr>
												<tr>
													<td width="10%" valign="top">
														<label for="content">Content:</label>
													</td>
													<td width="100%">
														<textarea name="content" style="width:100%; height:300px"><?=$content?></textarea>
													</td>
												</tr>
												<tr>
													<td width="10%" valign="top">
														<label for="answer">Answer(s):</label>
													</td>
													<td width="100%">
														<?
														for ($i=sizeof($answers)-1; $i>=0; $i--) {
															$answer = $answers[$i];
														?>
															<div style="background: none repeat scroll 0 0 #FFFEED; border: 1px dotted #FF0000; padding: 8px; margin-bottom: 8px;">
																<div>
				                                                    <?=$answer->content?>
				                                                </div>
				                                                <div style="padding-top: 8px;">
						                                        	Written by <b><?=$this->m_user->load($answer->author)->fullname?></b>, <?=$this->util->timesince($answer->created_date)?>
						                                        </div>
					                                        </div>
														<?
														}
														?>
														<textarea name="answer" style="width:100%; height:400px"></textarea>
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