<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>help.css" rel="stylesheet" />
<style type="text/css">
	.subiz_online { cursor: pointer; visibility: hidden; height: 32px; width: 166px; line-height: 32px; color: white; z-index: -1}
	.subiz_offline { cursor: pointer; visibility: hidden; height: 32px; width: 166px; line-height: 32px; color: white; z-index: -1}
	.contact-options #subiz_status a{background: none}
</style>
<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Help Center" href="<?=site_url("help")?>">Help Center</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">My Tickets
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="help-center">
		<div class="left help-content">
			<div class="main-banner">
				<div class="support-banner"></div>
			</div>
			<div class="contact-options">
				<div class="left email-us">
					<a href="<?=site_url("help/emailus")?>"><div class="label">Email Us</div></a>
				</div>
				<div class="left new-ticket">
					<a class="selected" href="<?=site_url("help/newticket")?>"><div class="label">Submit Ticket</div></a>
				</div>
				<div class="left live-chat">
					<a><div class="label">Chat Online</div><div id="subiz_status"></div></a>
				</div>
				<div class="left call-us">
					<a><div class="label">Call Us</div></a>
					<div class="call-details">
						<div class="contact-tellocal">Tollfree: <?=TOLL_FREE?></div>
						<div class="contact-hotline">Hotline: <?=HOTLINE?></div>
					</div>
				</div>
				<div class="clr"></div>
			</div>
			<div style="padding: 10px;">
				<div class="help-box process-box">
					<div class="hd">
						<h3>My Tickets</h3>
					</div>
					<div class="clearfix">
						<? if (!empty($mytickets) && sizeof($mytickets)) { ?>
						<div class="tickettable">
							<table width="100%" cellspacing="0" cellpadding="0" border="0">
								<tbody>
									<tr class="th">
										<td class="first" align="center" width="20px">ID</td>
										<td>Subject</td>
										<td align="center" width="80px">Status</td>
										<td align="center" width="120px">Created</td>
										<td align="center" width="80px">Action</td>
									</tr>
									<? foreach ($mytickets as $ticket) { ?>
									<tr class="td">
										<td class="first" align="center"><?=$ticket->id?></td>
										<td><a title="<?=$ticket->title?>" href="<?=site_url("help/question/".$ticket->alias)?>"><?=$ticket->title?></a></td>
										<td align="center"><?=(($ticket->status == 0) ? "Open" : (($ticket->status == 1) ? "Resolved" : "Closed"))?></td>
										<td align="center"><?=$ticket->created_date?></td>
										<td align="center">
											<? if ($ticket->status != 0) { ?>
											<a href="<?=site_url("help/reopen/".$ticket->id)?>">Re-Open</a>
											<? } ?>
										</td>
									</tr>
									<? } ?>
								</tbody>
							</table>
						</div>
						<? } else { ?>
						<p style="margin-bottom: 10px">
							You have (0) tickets. Submit your case, we will help you now.
						</p>
						<? } ?>
					</div>
					<div class="clearfix">
						<a class="contact-button" title="Email Us" href="<?=site_url("help/emailus")?>">EMAIL US</a>
						<a class="contact-button" title="Submit a Ticket" href="<?=site_url("help/newticket")?>">SUBMIT TICKET</a>
					</div>
				</div>
			</div>
		</div>
		<div class="right" style="width: 280px;">
			<? require_once(APPPATH."views/help/categories.php"); ?>
		</div>
		<div class="clr"></div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$(".call-us a").click(function(e){
		e.stopPropagation();
		var display = $('.call-details').css('display');
		if (display == 'none') {
			$('.call-details').css('display','block');
		} else{
			$('.call-details').css('display','none');
		}

	});

	$(document).click(function(e){
		var container = $(".call-details");
		console.log(container.is(e.target));
	   if(container.has(e.target).length === 0 && !container.is(e.target)) 
	   		$('.call-details').css('display','none');
	   	else
	   		$('.call-details').css('display','block');
	});
});
</script>