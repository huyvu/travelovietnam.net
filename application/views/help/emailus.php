<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>help.css" rel="stylesheet" />
<style type="text/css">
	.subiz_online { cursor: pointer; visibility: hidden; height: 32px; width: 166px; line-height: 32px; color: white; z-index: -1}
	.subiz_offline { cursor: pointer; visibility: hidden; height: 32px; width: 166px; line-height: 32px; color: white; z-index: -1}
	.contact-options #subiz_status a{background: none}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$("#email-submit-btn").click(function() {
			var err = 0;
			if ($("#fullname").val() == "") {
				$("#fullname").addClass("error");
				err ++;
			} else {
				$("#fullname").removeClass("error");
			}
			if ($("#email").val() == "" || !isEmail($("#email").val())) {
				$("#email").addClass("error");
				err ++;
			} else {
				$("#email").removeClass("error");
			}
			if ($("#subject").val() == "") {
				$("#subject").addClass("error");
				err ++;
			} else {
				$("#subject").removeClass("error");
			}
			if ($("#contact-message").val() == "") {
				$("#contact-message").addClass("error");
				err ++;
			} else {
				$("#contact-message").removeClass("error");
			}
			if ($("#security-code").val() == "" || $("#security-code").val().toUpperCase() != $(".security-code").html().toUpperCase()) {
				$("#security-code").addClass("error");
				err ++;
			} else {
				$("#security-code").removeClass("error");
			}
			if (!err) {
				$("#frmEmail").submit();
			} else {
				msgbox("Please fill-in all required fields(*) before submiting your message!");
			}
		});
	});
</script>

<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">Help Center
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="help-center">
		<div class="left help-content">
			<div class="main-banner">
				<div class="support-banner"></div>
			</div>
			<div class="contact-options">
				<div class="left email-us">
					<a class="selected" href="<?=site_url("help/emailus")?>"><div class="label">Email Us</div></a>
				</div>
				<div class="left new-ticket">
					<a href="<?=site_url("help/newticket")?>"><div class="label">Submit Ticket</div></a>
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
						<p>We welcome questions... and we rely on feedback. We are constantly working to provide the best possible visitor experience. Your feedback is very important to us.</p>
					</div>
					<? if (!empty($send_status) && $send_status == "OK") { ?>
					<div class="messagebox">
						<div class="message-info">
							<div class="message-icon"></div>
							<div class="message-container">
								<div class="message-title">
									Your message have been sent successful.
								</div>
							</div>
							<div class="clr"></div>
						</div>
					</div>
					<? } ?>
					<div>
						<form id="frmEmail" name="frmEmail" action="<?=site_url("help/emailus")?>" method="POST">
							<div id="email-container">
								<div class="left">
									<div class="email-form">
										<table class="tbl-email" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td><input type="text" id="fullname" name="fullname" placeholder="Name *"/></td>
											</tr>
											<tr>
												<td><input type="text" id="email" name="email" placeholder="Email *"/></td>
											</tr>
											<tr>
												<td><input type="text" id="subject" name="subject" placeholder="Subject *"/></td>
											</tr>
											<tr>
												<td><textarea rows="" cols="" id="contact-message" name="content" placeholder="Your message *"></textarea></td>
											</tr>
											<tr>
												<td><input type="text" id="security-code" name="security-code" placeholder="Captcha *" style="width: 80px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
											</tr>
											<tr>
												<td>
													<input type="button" id="email-submit-btn" name="email-btn" class="email-btn" value="SEND MAIL" />
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