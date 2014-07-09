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
					<td class="button" id="toolbar-new">
						<a href="#" onclick="javascript:hideMainMenu(); submitbutton('add')" class="toolbar">
						<span class="icon-32-new" title="New">
						</span>
						New
						</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="header icon-48-generic">
			Redirections
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
		<form action="<?=site_url("administrator/update_redirect")?>" method="post" name="adminForm">
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
							<th width="45%">
								From URL
							</th>
							<th width="45%">
								To URL
							</th>
							<th width="5">
								ID
							</th>
						</tr>
					</thead>
					<?
						if (!empty($items) && sizeof($items)) {
							$idx = 0;
							foreach ($items as $item) {
								?>
								<tr class="row1">
									<td align="center">
										<?=$idx?>
									</td>
									<td align="center">
										<input type="checkbox" id="cb<?=$idx?>" name="cid[]" value="<?=$item->id?>" onclick="isChecked(this.checked);" />    			
									</td>
									<td class="title" width="45%">
										<a href="<?=site_url("administrator/edit_redirect/".$item->id)?>"><?=$item->from_url?></a>
									</td>
									<td class="title" width="45%">
										<a href="<?=site_url("administrator/edit_redirect/".$item->id)?>"><?=$item->to_url?></a>
									</td>
									<td align="center">
										<?=$item->id?>
									</td>
								</tr>
								<?
								$idx ++;
							}
						}
					?>
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