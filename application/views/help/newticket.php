<?php  
	if($this->session->userdata('user')) {
		$user = $this->session->userdata('user');
	}
?>

<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>help.css" rel="stylesheet" />
<style type="text/css">
	.subiz_online { cursor: pointer; visibility: hidden; height: 32px; width: 166px; line-height: 32px; color: white; z-index: -1}
	.subiz_offline { cursor: pointer; visibility: hidden; height: 32px; width: 166px; line-height: 32px; color: white; z-index: -1}
	.contact-options #subiz_status a{background: none}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$("#newticket-submit-btn").click(function() {
			var err = 0;
			if ($("#category_id").val() == "") {
				$("#category_id").addClass("error");
				err ++;
			} else {
				$("#category_id").removeClass("error");
			}
			if ($("#subject").val() == "") {
				$("#subject").addClass("error");
				err ++;
			} else {
				$("#subject").removeClass("error");
			}
			if ($("#ticket-content").val() == "") {
				$("#ticket-content").addClass("error");
				err ++;
			} else {
				$("#ticket-content").removeClass("error");
			}
			if ($("#security-code").val() == "" || $("#security-code").val().toUpperCase() != $(".security-code").html().toUpperCase()) {
				$("#security-code").addClass("error");
				err ++;
			} else {
				$("#security-code").removeClass("error");
			}
			if (!err) {
				$("#frmTicket").submit();
			} else {
				msgbox("Please fill-in all required fields(*) before submiting your message!");
			}
		});
	});
</script>

<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Help Center" href="<?=site_url("help")?>">Help Center</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="My Tickets" href="<?=site_url("help/mytickets")?>">My Tickets</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">New Ticket
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
						<p>We would like to help you, <strong><a href="<?=site_url("member")?>"><?=$user["fullname"]?></a></strong>. By submitting your ticket.</p>
					</div>
					<? if (!empty($send_status) && $send_status == "OK") { ?>
					<div class="messagebox">
						<div class="message-info">
							<div class="message-icon"></div>
							<div class="message-container">
								<div class="message-title">
									Your ticket's openned. Tickets typically posted within 24 hours, pending approval. 
								</div>
							</div>
							<div class="clr"></div>
						</div>
					</div>
					<? } ?>
					<div>
						<form id="frmTicket" name="frmTicket" action="<?=site_url("help/newticket")?>" method="POST">
							<div id="newticket-container">
								<div class="left">
									<div class="newticket-form">
										<table class="tbl-newticket" cellpadding="4" cellspacing="0" border="0">
											<tr>
												<td>
													<select id="category_id" name="category_id">
														<option value="">-- Select category --</option>
													<? foreach ($categories as $citem) { ?>
														<option value="<?=$citem->id?>"><?=$citem->name?></option>
													<? } ?>
													</select>
												</td>
											</tr>
											<tr>
												<td><input type="text" id="subject" name="subject" placeholder="Subject *" /></td>
											</tr>
											<tr>
												<td><textarea rows="" cols="" id="ticket-content" name="content" placeholder="Your message *"></textarea></td>
											</tr>
											<tr>
												<td><input type="text" id="security-code" name="security-code" placeholder="Captcha *" style="width: 80px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
											</tr>
											<tr>
												<td>
													<input type="button" id="newticket-submit-btn" name="newticket-btn" class="newticket-btn" value="SUBMIT TICKET" />
													<input type="button" id="cancel-btn" name="cancel-btn" class="newticket-btn" value="CANCEL" onclick="window.location='<?=site_url("help/mytickets")?>'" />
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="right">
									<div class="hotline-panel">
										<p>To find more about our services or to help us with your work and corporate identity, please fill in the form and click on submit. Alternatively, please email us at <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> or you can talk on phone:</p>
										<p>&nbsp;</p>
										<p><b>Toll-free:</b> <?=TOLL_FREE?></p>
										<p><b>Hotline:</b> <?=HOTLINE?></p>
										<p>&nbsp;</p>
										<p>Thank you!</p>
									</div>
								</div>
							</div>
						</form>
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