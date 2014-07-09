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
						<form method="POST" action="<?=site_url("administrator/ip_tracking")?>" name="searchForm">
							<label>From date:</label>
							<input type="text" name="fromdate" id="fromdate" value="<?=$fromdate?>" placeholder="yyyy-mm-dd">
							<label>To date:</label>
							<input type="text" name="todate" id="todate" value="<?=$todate?>" placeholder="yyyy-mm-dd">
							<input type="submit" name="report_btn" id="report_btn" value="Report">
						</form>
					</td>
					<td class="button" style="padding-right: 50px">
						<form method="POST" action="<?=site_url("administrator/ip_tracking")?>" name="searchForm">
							<input type="text" name="search_text" id="search_text" value="<?=$search_text?>">
							<input type="submit" name="search_btn" id="search_btn" value="Search">
						</form>
					</td>
					<td class="button" id="toolbar-publish">
						<a href="#" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('Please make a selection from the list to publish');}else{  submitbutton('publish')}" class="toolbar">
						<span class="icon-32-publish" title="Publish">
						</span>
						Unblock
						</a>
					</td>
					<td class="button" id="toolbar-unpublish">
						<a href="#" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('Please make a selection from the list to unpublish');}else{  submitbutton('unpublish')}" class="toolbar">
						<span class="icon-32-unpublish" title="Unpublish">
						</span>
						Block
						</a>
					</td>
					<td class="button" id="toolbar-DO YOU WANT TO DELETE THERE ITEMS?">
						<a href="#" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('Please make a selection from the list to delete');}else{if(confirm('DO YOU WANT TO DELETE THERE ITEMS?')){submitbutton('remove');}}" class="toolbar">
						<span class="icon-32-delete" title="Delete">
						</span>
						Delete
						</a>
					</td>
					<td class="button">
						<a href="#" onclick="javascript:if(confirm('DO YOU WANT TO CLEAN ALL IP IN LIST?')){submitbutton('cleanall');}" class="toolbar">
						<span class="icon-32-delete" title="Delete">
						</span>
						Clean All
						</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="header icon-48-generic">
			IP Tracking
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
		<form action="<?=site_url("administrator/ip_tracking")?>" method="post" name="adminForm">
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
							<th width="80" class="sortby" sortby="created_date">
								Date
							</th>
							<th class="sortby" sortby="ip">
								IP
							</th>
							<th class="sortby" sortby="ip">
								Nation
							</th>
							<th class="sortby" sortby="url">
								URL
							</th>
							<th class="sortby" sortby="open_time">
								Open
							</th>
							<th width="80" class="sortby" sortby="active">
								Accessible
							</th>
							<th width="20" class="sortby" sortby="id">
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
									<td align="center" width="80px">
										<?=date("M/d/Y H:i:s", strtotime($item->created_date))?>
									</td>
									<td width="100px">
										<?=$item->ip?>
									</td>
									<td width="30px" align="center">
										<a target="_blank" href="http://whatismyipaddress.com/ip/<?=$item->ip?>">
											<img width="16px" height="11px" src="http://api.hostip.info/flag.php?ip=<?=$item->ip?>" ALT="IP">
										</a>
									</td>
									<td>
										<?=$item->url?>
									</td>
									<td width="30px" align="right">
										<?=$item->open_time?>s
									</td>
									<td width="30px" align="center">
									<? if ($item->active) { ?>
										<a title="Block this IP" onclick="return listItemTask('cb<?=$idx?>','unpublish')" href="javascript:void(0);" />
											<img border="0" alt="" src="<?=IMG_URL?>admin/publish_g.png" /></a>
									<? } else { ?>
										<a title="Unblock this IP" onclick="return listItemTask('cb<?=$idx?>','publish')" href="javascript:void(0);" />
											<img border="0" alt="" src="<?=IMG_URL?>admin/publish_x.png" /></a>
									<? } ?>
									</td>
									<td align="right">
										<?=$item->id?>
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
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="sortby" value="" />
			<input type="hidden" name="orderby" value="<?=(!empty($orderby)?$orderby:"DESC")?>" />
			<input type="hidden" name="search_text" value="<?=$search_text?>">
			<input type="hidden" name="fromdate" value="<?=$fromdate?>" />
			<input type="hidden" name="todate" value="<?=$todate?>" />
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

<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/jquery.ui.css" />

<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.ui.min.js"></script>

<script type="text/javascript">
	jQuery.noConflict();
	(function($){
		var dateoptions = {
				dateFormat: 'yy-mm-dd'
			};
		
		$("#fromdate").datepicker(dateoptions);
		$("#todate").datepicker(dateoptions);

		var sortby  = "<?=(!empty($sortby)?$sortby:'created_date')?>";
		var orderby = "<?=(!empty($orderby)?$orderby:'DESC')?>";
		$(".sortby").each(function() {
			if ($(this).attr("sortby") == sortby) {
				$(this).addClass("selected");
				$(this).addClass(orderby);
			}
		});
		$(".sortby").click(function() {
			document.adminForm.sortby.value = $(this).attr("sortby");
			submitform("sort");
		});
	})(jQuery);

    function refresh() {
		window.location.href = "<?=current_url()?>";
		setTimeout(refresh, 30000);
    }
    setTimeout(refresh, 30000);
</script>