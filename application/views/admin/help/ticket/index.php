<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div class="toolbar" id="toolbar">
			<table class="toolbar">
				<tr>
					<td class="button" id="toolbar-publish">
						<a href="#" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('Please make a selection from the list to publish');}else{  submitbutton('publish')}" class="toolbar">
						<span class="icon-32-publish" title="Publish">
						</span>
						Approval
						</a>
					</td>
					<td class="button" id="toolbar-unpublish">
						<a href="#" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('Please make a selection from the list to unpublish');}else{  submitbutton('unpublish')}" class="toolbar">
						<span class="icon-32-unpublish" title="Unpublish">
						</span>
						Unapproval
						</a>
					</td>
					<td class="button" id="toolbar-DO YOU WANT TO DELETE THERE ITEMS?">
						<a href="#" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('Please make a selection from the list to delete');}else{if(confirm('DO YOU WANT TO DELETE THERE ITEMS?')){submitbutton('remove');}}" class="toolbar">
						<span class="icon-32-delete" title="Delete">
						</span>
						Delete
						</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="header icon-48-generic">
			Help Tickets
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
		<form action="<?=site_url("administrator/update_help_ticket")?>" method="post" name="adminForm">
			<div id="editcell">
				<table class="adminlist">
					<thead>
						<tr>
							<th width="5">
								#
							</th>
							<th width="20" align="center">
								<input type="checkbox" name="toggle" value="" onclick="checkAll(11);" />
							</th>
							<th>
								Title
							</th>
							<th>
								Content
							</th>
							<th>
								Fullname
							</th>
							<th>
								Email
							</th>
							<th width="80">
								Published
							</th>
							<th width="80">
								Status
							</th>
							<th>
								Created Date
							</th>
							<th width="5">
								ID
							</th>
						</tr>
					</thead>
					<?
						if (!empty($questions) && sizeof($questions)) {
							$idx = 0;
							$cnt = 0;
							foreach ($questions as $question) {
								//Answers
                                $info1->parent_id = $question->id;
                            	$answers = $this->m_help_question->getItems($info1);
								?>
								<tr class="row1">
									<td align="center">
										<?=$cnt?>
									</td>
									<td align="center">
										<input type="checkbox" id="cb<?=$idx?>" name="cid[]" value="<?=$question->id?>" onclick="isChecked(this.checked);" />    			
									</td>
									<td width="20%">
										<a href="<?=site_url("administrator/edit_help_ticket/".$question->id)?>"><?=$question->title?></a>
									</td>
									<td width="30%">
										<?=$question->content?>
									</td>
									<td width="10%">
										<?
											$author = $this->m_user->load($question->author);
											echo $author->fullname;
										?>
									</td>
									<td width="10%">
										<?
											echo $author->email;
										?>
									</td>
									<td align="center" width="30px">
									<? if ($item->active) { ?>
										<a title="Publish Item" onclick="return listItemTask('cb<?=$idx-1?>','unpublish')" href="javascript:void(0);" />
											<img border="0" alt="Unpublished" src="<?=IMG_URL?>admin/publish_g.png" /></a>
									<? } else { ?>
										<a title="Publish Item" onclick="return listItemTask('cb<?=$idx-1?>','publish')" href="javascript:void(0);" />
											<img border="0" alt="Published" src="<?=IMG_URL?>admin/publish_x.png" /></a>
									<? } ?>
									</td>
									<td align="center">
										<?
											switch ($question->status) {
												case 0: echo "Open"; break;
												case 1: echo "Resolved"; break;
												case 2: echo "Closed"; break;
											}
										?>
									</td>
									<td align="center" width="10%">
										<?=date("M/d/Y", strtotime($question->created_date))?>
									</td>
									<td align="center">
										<?=$question->id?>
									</td>
								</tr>
								<?
								$cnt ++;
								$idx ++;
								for ($i=sizeof($answers)-1; $i>=0; $i--) {
									$answer = $answers[$i];
								?>
									<tr class="row1">
										<td align="center">
										</td>
										<td align="center">
											<input type="checkbox" id="cb<?=$idx?>" name="cid[]" value="<?=$answer->id?>" onclick="isChecked(this.checked);" />    			
										</td>
										<td>
										</td>
										<td width="30%">
											<?=$answer->content?>
										</td>
										<td width="10%">
											<?
											$author = $this->m_user->load($answer->author);
											echo $author->fullname;
											?>
										</td>
										<td>
											<?=$author->email?>
										</td>
										<td align="center" width="30px">
										<? if ($answer->active) { ?>
											<a title="Publish Item" onclick="return listItemTask('cb<?=$idx?>','unpublish')" href="javascript:void(0);" />
												<img border="0" alt="Unpublished" src="<?=IMG_URL?>admin/publish_g.png" /></a>
										<? } else { ?>
											<a title="Publish Item" onclick="return listItemTask('cb<?=$idx?>','publish')" href="javascript:void(0);" />
												<img border="0" alt="Published" src="<?=IMG_URL?>admin/publish_x.png" /></a>
										<? } ?>
										</td>
										<td>
										</td>
										<td align="center" width="10%">
											<?=date("M/d/Y", strtotime($answer->created_date))?>
										</td>
										<td align="center">
											<?=$answer->id?>
										</td>
									</tr>
								<?
									$idx ++;
								}
							}
						}
					?>
					<tfoot>
						<tr>
							<td colspan="20">
								<div class="container">
									<div class="pagination">
										<div class="limit">
											Display #
											<select onchange="submitform();" size="1" class="inputbox" id="limit" name="limit">
												<option value="5">5</option>
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
												<option value="25">25</option>
												<option value="30">30</option>
												<option value="50">50</option>
												<option value="100">100</option>
												<option value="0">all</option>
											</select>
											<script> setValueHTML('limit', '<?=$limit?>'); </script>
										</div>
										<div class="button2-right">
											<div class="start"><a onclick="javascript: document.adminForm.limitstart.value=0; submitform();return false;" title="Start" href="#">Start</a></div>
										</div>
										<div class="button2-right">
											<div class="prev"><a onclick="javascript: document.adminForm.limitstart.value='<?=($pageidx-2)*$limit?>'; submitform();return false;" title="Previous" href="#">Prev</a></div>
										</div>
										<div class="button2-left">
											<div class="page">
											<?	$numpage = ceil($totalitems / $limit);
												for ($i=1; $i<=$numpage && $i<=20; $i++) { ?>
												<a onclick="javascript: document.adminForm.limitstart.value='<?=($i-1)*$limit?>'; submitform();return false;" title="<?=$i?>" href="#"><?=$i?></a>
											<? } ?>
											</div>
										</div>
										<div class="button2-left">
											<div class="next"><a onclick="javascript: document.adminForm.limitstart.value='<?=$pageidx*$limit?>'; submitform();return false;" title="Next" href="#">Next</a></div>
										</div>
										<div class="button2-left">
											<div class="end"><a onclick="javascript: document.adminForm.limitstart.value='<?=$numpage*$limit?>'; submitform();return false;" title="End" href="#">End</a></div>
										</div>
										<input type="hidden" value="0" name="limitstart" />
									</div>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>