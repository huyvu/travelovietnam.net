<style type="text/css">
	.status1 { }
	.status0 { color: red; }
</style>

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
					<td class="button" style="padding-right: 20px">
						<div style="float: left">
							<div style="float: left">
								<div style="font-size: 14px; font-weight: bold;">OnePay</div>
								<div style="font-size: 20px; font-weight: bold;">$<?=$sum_op?></div>
							</div>
							<div style="float: left; margin-left: 20px">
								<div style="font-size: 14px; font-weight: bold;">Paypal</div>
								<div style="font-size: 20px; font-weight: bold;">$<?=$sum_pp?></div>
							</div>
							<div style="float: left; margin-left: 20px">
								<div style="font-size: 14px; font-weight: bold;">G2S</div>
								<div style="font-size: 20px; font-weight: bold;">$<?=$sum_g2s?></div>
							</div>
							<div style="float: left; margin-left: 20px">
								<div style="font-size: 14px; font-weight: bold;">Western</div>
								<div style="font-size: 20px; font-weight: bold;">$<?=$sum_wu?></div>
							</div>
							<div style="float: left; margin-left: 20px">
								<div style="font-size: 14px; font-weight: bold;">Bank</div>
								<div style="font-size: 20px; font-weight: bold;">$<?=$sum_bt?></div>
							</div>
						</div>
						<div style="float: left; margin-left: 60px">
							<form method="POST" action="<?=site_url("administrator/payment_report")?>" name="searchForm">
								<label>From date:</label>
								<input type="text" name="fromdate" id="fromdate" value="<?=$fromdate?>" placeholder="yyyy-mm-dd">
								<label>To date:</label>
								<input type="text" name="todate" id="todate" value="<?=$todate?>" placeholder="yyyy-mm-dd">
								<label>Method:</label>
								<select name="payment_method" id="payment_method">
									<option value="">All</option>
									<option value="OnePay">OnePay</option>
									<option value="Paypal">Paypal</option>
									<option value="Credit Card">G2S</option>
									<option value="Western Union">Western Union</option>
									<option value="Bank Transfer">Bank Transfer</option>
								</select>
								<script> setValueHTML("payment_method", '<?=$payment_method?>'); </script>
								<input type="submit" name="report_btn" id="report_btn" value="Report">
							</form>
						</div>
						<div style="clear: both;"></div>
					</td>
				</tr>
			</table>
		</div>
		<div class="header icon-48-generic">
			PAYMENT REPORT
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
		<form method="POST" action="<?=site_url("administrator/payment_report")?>" name="adminForm">
			<div id="editcell">
				<table class="adminlist">
					<thead>
						<tr>
							<th width="5">
								#
							</th>
							<th width="30">
								Details
							</th>
							<th>
								Date
							</th>
							<th>
								Type
							</th>
							<th>
								Payment Method
							</th>
							<th>
								Status
							</th>
							<th>
								Fullname
							</th>
							<th>
								Email
							</th>
							<th>
								Amount			
							</th>
							<th>
								Customer ID			
							</th>
							<th>
								Order ID
							</th>
						</tr>
					</thead>
					<?
						if (!empty($items) && sizeof($items)) {
							$idx = 1;
							foreach ($items as $item) {
								?>
									<tr class="row0 status<?=$item->status?>">
										<td width="20" align="center">
											<?=$idx+(($pageidx-1)*$limit)?>
										</td>
										<td width="20px" align="center">
										<? if ($item->payment_method == "OnePay") { ?>
											<a class="op-detail" title="Click to check the payment in detailed" href="<?=site_url("administrator/check_payment_detail/".$item->key)?>"><img alt="" src="<?=IMG_URL?>admin/i-comment.gif"></a>
										<? } ?>
										</td>
										<td width="120px" align="center">
											<?=date("Y-m-d H:i:s", strtotime($item->payment_date))?>
										</td>
										<td width="100px" align="center">
											<?=$item->payment_type?>
										</td>
										<td width="100px" align="center">
											<?=$item->payment_method?>
										</td>
										<td width="60px" align="center">
											<?=($item->status ? "Paid" : "UnPaid")?>
											<? if ($item->payment_method == "OnePay") { ?>
											<a class="op-status" title="Click to check the payment status" href="<?=site_url("administrator/check_payment/".$item->key)?>"><img alt="" src="<?=IMG_URL?>admin/i-refresh.gif" width="10px" height="10px"></a>
											<? } ?>
										</td>
										<td>
											<?=$item->fullname?>
										</td>
										<td width="200px">
											<?=$item->primary_email?>
										</td>
										<td width="80px" align="right">
											$<?=number_format($item->amount,2,'.',',')?>
										</td>
										<td width="80px" align="center">
											<a href="<?=site_url("administrator/user/".$item->customer_id)?>"><?=$item->customer_id?></a>
										</td>
										<td width="80px" align="center">
											<?
											if ($item->payment_type == "Apply Visa") {
												echo "EVS".$item->order_id;
											} else if ($item->payment_type == "Tour Booking") {
												echo "T".$item->order_id;
											} else if ($item->payment_type == "Extra Service") {
												echo "EX".$item->order_id;
											} else {
												echo "PO".$item->order_id;
											}
											?>
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
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			<div class="clr"></div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="fromdate" value="<?=$fromdate?>" />
			<input type="hidden" name="todate" value="<?=$todate?>" />
			<input type="hidden" name="payment_method" value="<?=$payment_method?>" />
		</form>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/jquery.ui.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/fancybox.css" />

<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.fancybox.js"></script>

<script type="text/javascript">
	jQuery.noConflict();
	(function($){
		var dateoptions = {
				dateFormat: 'yy-mm-dd'
			};
		
		$("#fromdate").datepicker(dateoptions);
		$("#todate").datepicker(dateoptions);
		
		$(".op-status").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 480,
				height: 200
			});
			return false;
		});
		$(".op-detail").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 480,
				height: 500
			});
			return false;
		});
	})(jQuery);
</script>