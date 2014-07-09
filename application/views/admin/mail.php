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
			MAIL BOX
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
		<form method="POST" action="<?=site_url("administrator/mail")?>" name="adminForm">
			<div id="editcell">
				<table class="adminlist">
					<thead>
						<tr>
							<th width="5">
								#			
							</th>
							<th width="20" align="center">
								<input type="checkbox" name="toggle" value="" onclick="checkAll('<?=sizeof($items)?>');" />
							</th>
							<th>
								Send Date			
							</th>
							<th>
								Sender			
							</th>
							<th>
								Receiver			
							</th>
							<th>
								Title			
							</th>
						</tr>
					</thead>
					<?
						if (!empty($items) && sizeof($items)) {
							$idx = 1;
							foreach ($items as $item) {
								?>
									<tr class="row0 prss0">
										<td width="2%" align="center">
											<?=$idx+(($pageidx-1)*$limit)?>
										</td>
										<td align="center">
											<input type="checkbox" id="cb<?=$idx-1?>" name="cid[]" value="<?=$item->id?>" onclick="isChecked(this.checked);" />    			
										</td>
										<td width="100px" align="center">
											<?=date("Y-m-d H:i:s", strtotime($item->created_date))?>
										</td>
										<td width="15%" class="title">
											<a href="<?=site_url("administrator/mail_detail/".$item->id)?>"><?=$item->sender?></a>
										</td>
										<td width="15%" class="title">
											<?=$item->receiver?>
										</td>
										<td class="title">
											<?=$item->title?>
										</td>
									</tr>
								<?
									$idx ++;
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
			<div class="clr"></div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
