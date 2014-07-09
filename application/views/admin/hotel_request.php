<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div class="header icon-48-generic">
			Hotel Request
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
		<form method="POST" action="<?=site_url("administrator/hotel_request")?>" name="adminForm">
			<div id="editcell">
				<table class="adminlist">
					<thead>
						<tr>
							<th width="5">
								#			
							</th>
							<th>
								Name
							</th>
							<th>
								E-mail
							</th>
							<th>
								Phone
							</th>
							<th>
								From Date
							</th>
							<th>
								To Date
							</th>
							<th>
								Adults
							</th>
							<th>
								Children
							</th>
							<th>
								Content
							</th>
							<th>
								Date
							</th>
						</tr>
					</thead>
					<?
						if (!empty($items) && sizeof($items)) {
							$idx = 0;
							foreach ($items as $item) {
								?>
									<tr>
										<td width="2%" align="center">
											<?=$idx?>
										</td>
										<td width="15%" class="title">
											<?=$item->fullname?>
										</td>
										<td width="8%" class="title">
											<?=$item->email?>
										</td>
										<td width="100px" align="center">
											<?=$item->phone?>
										</td>
										<td width="100px" align="center">
											<?=$item->fromdate?>
										</td>
										<td width="100px" align="center">
											<?=$item->todate?>
										</td>
										<td width="80px" align="center">
											<?=$item->adults?>
										</td>
										<td width="80px" align="center">
											<?=$item->children?>
										</td>
										<td width="*">
											<?=$item->message?>
										</td>
										<td width="6%" align="center">
											<?=date("M/d/Y", strtotime($item->created_date))?>
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
