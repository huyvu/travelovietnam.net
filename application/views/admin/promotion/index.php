<script type="text/javascript" src="<?=JS_URL?>jquery.min.js"></script>
<script type="text/javascript">

	var pid  = 0;
	var interval = 0;
	var sent  = 0;
	var total = 0;
	
	function testmessage(id, t)
	{
		total = t;
		sent  = 0;
		pid   = id;
		
		$('.sending').html("...");
		$('.sent').html("Sent: " + sent);
		
		interval = setInterval(test, 5000);
	}
	
	function test()
	{
		var p = {};
		p['id'] = pid;
		p['offset'] = sent;
		$('.sending').load("<?=site_url('administrator/test_promotion_txt')?>", p, function(){
			sent++;
			$('.sent').html("Sent: " + sent + "/" + total);
			if (sent >= total) {
				clearTimeout(interval);
				$('.sent').html("Completed!");
				$('.sending').html("");
			}
		});
	}

	function send2emailmessage(id, t)
	{
		total = t;
		sent  = 0;
		pid   = id;
		
		$('.sending').html("...");
		$('.sent').html("Sent: " + sent);
		
		interval = setInterval(send2email, 5000);
	}

	function send2email()
	{
		var p = {};
		p['id'] = pid;
		p['offset'] = sent;
		$('.sending').load("<?=site_url('administrator/send2email_promotion_txt')?>", p, function(){
			sent++;
			$('.sent').html("Sent: " + sent + "/" + total);
			if (sent >= total) {
				clearTimeout(interval);
				$('.sent').html("Completed!");
				$('.sending').html("");
			}
		});
	}

	function send2usermessage(id, t)
	{
		total = t;
		sent  = 0;
		pid   = id;
		
		$('.sending').html("...");
		$('.sent').html("Sent: " + sent);
		
		interval = setInterval(send2user, 5000);
	}

	function send2user()
	{
		var p = {};
		p['id'] = pid;
		p['offset'] = sent;
		$('.sending').load("<?=site_url('administrator/send2user_promotion_txt')?>", p, function(){
			sent++;
			$('.sent').html("Sent: " + sent + "/" + total);
			if (sent >= total) {
				clearTimeout(interval);
				$('.sent').html("Completed!");
				$('.sending').html("");
			}
		});
	}
</script>
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
					<td style="padding-right: 50px" class="button">
						<div class="sent"></div>
						<div class="sending"></div>
					</td>
					<td class="button" id="toolbar-publish">
						<a href="#" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('Please make a selection from the list to publish');}else{  submitbutton('publish')}" class="toolbar">
						<span class="icon-32-publish" title="Publish">
						</span>
						Publish
						</a>
					</td>
					<td class="button" id="toolbar-unpublish">
						<a href="#" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('Please make a selection from the list to unpublish');}else{  submitbutton('unpublish')}" class="toolbar">
						<span class="icon-32-unpublish" title="Unpublish">
						</span>
						Unpublish
						</a>
					</td>
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
			Promotion Templates
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
		<form action="<?=site_url("administrator/update_promotion_txt")?>" method="post" name="adminForm">
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
								Subject
							</th>
							<th width="200">
								Send Message
							</th>
							<th width="80">
								Published
							</th>
						</tr>
					</thead>
					<?
						if (!empty($items) && sizeof($items)) {
							$idx = 0;
							$bookingEmails = $this->m_visa->getBookingEmails();
							foreach ($items as $item) {
								$item->emails = str_replace(array("\r\n", "\n", "\r"), "", $item->emails);
								$item->emails = str_replace(array(","), ";", $item->emails);
								?>
								<tr class="row1">
									<td align="center">
										<?=$idx?>
									</td>
									<td align="center">
										<input type="checkbox" id="cb<?=$idx?>" name="cid[]" value="<?=$item->id?>" onclick="isChecked(this.checked);" />    			
									</td>
									<td class="title" width="60%">
										<a href="<?=site_url("administrator/edit_promotion_txt/".$item->id)?>"><?=$item->subject?></a>
									</td>
									<td class="title" width="30px">
										<input type="button" value="Test" id="test_message" name="test_message" onclick="testmessage('<?=$item->id?>', 2)">
										<input type="button" value="To Custom Emails" id="send2email_message" name="send2email_message" onclick="send2emailmessage('<?=$item->id?>', '<?=sizeof(explode(";", $item->emails))?>')">
									</td>
									<td align="center" width="30px">
									<? if ($item->active) { ?>
										<a title="Publish Item" onclick="return listItemTask('cb<?=$idx?>','unpublish')" href="javascript:void(0);" />
											<img border="0" alt="Unpublished" src="<?=IMG_URL?>admin/publish_g.png" /></a>
									<? } else { ?>
										<a title="Publish Item" onclick="return listItemTask('cb<?=$idx?>','publish')" href="javascript:void(0);" />
											<img border="0" alt="Published" src="<?=IMG_URL?>admin/publish_x.png" /></a>
									<? } ?>
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