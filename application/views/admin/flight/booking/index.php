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
					<td class="button" style="padding-right: 50px">
						<form method="POST" action="<?=site_url("administrator/search_flight_booking")?>" name="searchForm">
							<input type="text" name="search_text" id="search_text" value="">
							<select name="search_by" id="search_by">
								<option value="">All</option>
								<option value="email">Email</option>
								<option value="name">Name</option>
								<option value="id">Booking ID</option>
							</select>
							<input type="submit" name="search_btn" id="search_btn" value="Search">
						</form>
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
			FLIGHT BOOKING
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
		<form method="POST" action="<?=site_url("administrator/flight_booking")?>" name="adminForm">
			<div id="editcell">
				<table class="adminlist">
					<thead>
						<tr>
							<th width="5">
								#
							</th>
							<th width="20" align="center">
								<input type="checkbox" name="toggle" value="" onclick="checkAll(<?=sizeof($items)?>);" />
							</th>
							<th>
								ID
							</th>
							<th>
								Booking Date
							</th>
							<th>
								E-mail
							</th>
							<th>
								Airline
							</th>
							<th>
								Round Trip
							</th>
							<th>
								Departure
							</th>
							<th>
								Arrival
							</th>
							<th>
								Adults
							</th>
							<th>
								Children
							</th>
							<th>
								Babies
							</th>
							<th>
								Method
							</th>
							<th>
								Option
							</th>
							<th>
								Total
							</th>
							<th>
								Deposit
							</th>
							<th>
								Status
							</th>
						</tr>
					</thead>
					<?
						if (!empty($items) && sizeof($items)) {
							$idx = 1;
							foreach ($items as $item) {
								?>
									<tr class="row0">
										<td width="2%" align="center">
											<?=$idx+(($pageidx-1)*$limit)?>
										</td>
										<td align="center">
											<input type="checkbox" id="cb<?=$idx-1?>" name="cid[]" value="<?=$item->id?>" onclick="isChecked(this.checked);" />    			
										</td>
										<td width="70" align="center">
											<a href="<?=site_url("administrator/flight_booking_detail/".$item->id)?>"><?="F".$item->id?></a>
										</td>
										<td width="80" align="center">
											<?=date("Y-m-d H:i:s", strtotime($item->booking_date))?>
										</td>
										<td>
											<?=$item->email?>
										</td>
										<td align="center">
											Vietnam Airline
										</td>
										<td width="10%" align="center">
											<?=$item->direction?>
										</td>
										<td width="6%" align="center">
										</td>
										<td width="6%" align="center">
										</td>
										<td width="4%" align="center">
										</td>
										<td width="4%" align="center">
										</td>
										<td width="4%" align="center">
										</td>
										<td width="8%" align="center">
											<?=$item->payment_method?>
										</td>
										<td width="8%">
										</td>
										<td width="3%" align="center">
											$<?=$item->total_fee?>
										</td>
										<td width="3%" align="center">
										</td>
										<td width="3%" align="center">
											<font style="color:green;"><strong><?=(($item->status==1) ? "Paid" : "UnPaid")?></strong></font>
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
									<del class="container">
									<? if (empty($isSearching)) { ?>
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
									</del>
									<? } ?>
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
