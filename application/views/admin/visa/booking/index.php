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
						<form method="POST" action="<?=site_url("administrator/search_booking")?>" name="searchForm">
							<input type="text" name="search_text" id="search_text" value="">
							<select name="search_by" id="search_by">
								<option value="email">Email</option>
								<option value="name">Name</option>
								<option value="passport">Passport</option>
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
			VISA BOOKING
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
		<form method="POST" action="<?=site_url("administrator/visa_booking")?>" name="adminForm">
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
								Type of Visa			
							</th>
							<th>
								Payment			
							</th>
							<th width="80">
								Arrival		 	
							</th>
							<th>
								Departure			
							</th>
							<th>
								Port			
							</th>
							<th>
								Entries			
							</th>
							<th>
								Service fee			
							</th>
							<th>
								Discount			
							</th>
							<th>
								Stamp fee			
							</th>
							<th>
								Rush fee			
							</th>
							<th>
								Fast checkin			
							</th>
							<th>
								Car type			
							</th>
							<th>
								Seats		
							</th>
							<th>
								Car fee		
							</th>
							<th>
								Total amount			
							</th>
							<th width="5">
								Status			
							</th>
						</tr>
					</thead>
					<?
						if (!empty($items) && sizeof($items)) {
							$idx = 1;
							foreach ($items as $item) {
								?>
									<tr class="row0 prss<?=$item->rush_type?>">
										<td width="2%" align="center">
											<?=$idx+(($pageidx-1)*$limit)?>
										</td>
										<td align="center">
											<input type="checkbox" id="cb<?=$idx-1?>" name="cid[]" value="<?=$item->id?>" onclick="isChecked(this.checked);" />    			
										</td>
										<td width="70" align="center">
											<a href="<?=site_url("administrator/visa_booking_detail/".$item->id)?>"><?="V".$item->id?></a>
										</td>
										<td width="80" align="center">
											<?=date("Y-m-d H:i:s", strtotime($item->booking_date))?>
										</td>
										<td width="15%" class="title">
											<?=$item->primary_email?>
										</td>
										<td width="8%" class="title">
											<?=$item->visa_type?>
										</td>
										<td width="8%" class="title">
											<?=$item->payment_method?>
										</td>
										<td width="6%" align="center">
											<?=date("M/d/Y", strtotime($item->arrival_date))?>
										</td>
										<td width="6%" align="center">
											<?=date("M/d/Y", strtotime($item->exit_date))?>
										</td>
										<td width="10%" align="center">
											<?=$item->arrival_port?>
										</td>
										<td width="3%" align="center">
											<?=$item->group_size?>
										</td>
										<td width="3%" align="center">
											$<?=$item->visa_fee?>    			
										</td>
										<td width="3%" align="center">
											<?=$item->discount?>%
										</td>
										<td width="3%" align="center">
											$<?=$item->stamp_fee?>    			
										</td>
										<td width="3%" align="center">
											$<?=$item->rush_fee?>
										</td>
										<td width="3%" align="center">
											$<?=$item->fast_checkin_fee?>
										</td>
										<td width="3%" align="center">
											<?=($item->car_pickup==1?$item->car_type:"")?>
										</td>
										<td width="3%" align="center">
											<?=($item->car_pickup==1?$item->seats:"")?>
										</td>
										<td width="3%" align="center">
											$<?=$item->car_fee?>
										</td>
										<td width="3%" align="center">
											$<?=$item->total_fee?>
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
								<td colspan="21">
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
