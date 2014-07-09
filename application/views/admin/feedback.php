<style>
.prss0 {
}
.prss1 {
	color: orange;
}
.prss2 {
	color: red;
}
.car_item {
	background-color: #ADA081;
}
</style>

<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div class="header icon-48-generic">
			Feedback
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
										<td width="*">
											<?=$item->content?>
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
							<td colspan="18">
								<del class="container">
									<div class="pagination">
										<div class="limit">
											Display #
											<select onchange="submitform();" size="1" class="inputbox" id="limit" name="limit">
												<option value="5">5</option>
												<option value="10">10</option>
												<option value="15">15</option>
												<option selected="selected" value="20">20</option>
												<option value="25">25</option>
												<option value="30">30</option>
												<option value="50">50</option>
												<option value="100">100</option>
												<option value="0">all</option>
											</select>
										</div>
										<div class="button2-right off">
											<div class="start"><span>Start</span></div>
										</div>
										<div class="button2-right off">
											<div class="prev"><span>Prev</span></div>
										</div>
										<div class="button2-left">
											<div class="page"><span>1</span><a onclick="javascript: document.adminForm.limitstart.value=20; submitform();return false;" title="2" href="#">2</a><a onclick="javascript: document.adminForm.limitstart.value=40; submitform();return false;" title="3" href="#">3</a><a onclick="javascript: document.adminForm.limitstart.value=60; submitform();return false;" title="4" href="#">4</a><a onclick="javascript: document.adminForm.limitstart.value=80; submitform();return false;" title="5" href="#">5</a><a onclick="javascript: document.adminForm.limitstart.value=100; submitform();return false;" title="6" href="#">6</a><a onclick="javascript: document.adminForm.limitstart.value=120; submitform();return false;" title="7" href="#">7</a><a onclick="javascript: document.adminForm.limitstart.value=140; submitform();return false;" title="8" href="#">8</a><a onclick="javascript: document.adminForm.limitstart.value=160; submitform();return false;" title="9" href="#">9</a><a onclick="javascript: document.adminForm.limitstart.value=180; submitform();return false;" title="10" href="#">10</a></div>
										</div>
										<div class="button2-left">
											<div class="next"><a onclick="javascript: document.adminForm.limitstart.value=20; submitform();return false;" title="Next" href="#">Next</a></div>
										</div>
										<div class="button2-left">
											<div class="end"><a onclick="javascript: document.adminForm.limitstart.value=240; submitform();return false;" title="End" href="#">End</a></div>
										</div>
										<input type="hidden" value="0" name="limitstart" />
									</div>
								</del>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
