<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>site.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#invite-submit-btn").click(function(){
				var err = 0;

				if ($("#from").val() == "") {
					$("#from").addClass("error");
					err ++;
				} else {
					$("#from").removeClass("error");
				}

				if ($("#to").val() == "") {
					$("#to").addClass("error");
					err ++;
				} else {
					$("#to").removeClass("error");
				}

				if ($("#subject").val() == "") {
					$("#subject").addClass("error");
					err ++;
				} else {
					$("#subject").removeClass("error");
				}
				
				if ($("#security-code").val() == "" || $("#security-code").val() != $(".security-code").html()) {
					$("#security-code").addClass("error");
					err ++;
				} else {
					$("#security-code").removeClass("error");
				}
				
				if (err == 0) {
					$("#frmInvite").submit();
				}
			});
		});
		</script>
</head>
<body style="background: none">
	<div id="popup-map-container">
		<h1>Invite a Friend</h1>
		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div id="report-header">
			<div>Invite your friends on... </div>
			<div class="fb-send" data-href="<?=site_url("hotels/vietnam/{$item->city_alias}/$item->alias")?>"></div>
		</div>
		<form id="frmInvite" name="frmInvite" action="<?=site_url("invite/hotel/".$item->alias)?>" method="POST">
			<div id="report-header">
				OR write some text to invite your friend now...
			</div>
			<div id="invite-container">
				<div class="invite-form">
					<table class="tbl-invite" cellpadding="4" cellspacing="0" border="0">
						<tr>
							<td>Your email</td><td>:</td>
							<td><input type="text" id="from" name="from" /></td>
						</tr>
						<tr>
							<td>To email</td><td>:</td>
							<td><input type="text" id="to" name="to" /></td>
						</tr>
						<tr>
							<td>Subject</td><td>:</td>
							<td><input type="text" id="subject" name="subject" value="<?=$item->name?>"/></td>
						</tr>
						<tr>
							<td>Message</td><td>:</td>
							<td><textarea rows="" cols="" id="message" name="message"></textarea></td>
						</tr>
						<tr>
							<td>URL</td><td>:</td>
							<td><?=site_url("hotels/vietnam/{$item->city_alias}/$item->alias")?></td>
						</tr>
						<tr>
							<td>Captcha<span class="required">*</span></td><td>:</td>
							<td><input type="text" id="security-code" name="security-code" style="width: 60px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>
								<input type="button" id="invite-submit-btn" name="invite-btn" class="invite-btn" value="Send Email" />
							</td>
						</tr>
					</table>
				</div>
			</div>
			<input type="hidden" name="alias" value="<?=$item->alias?>">
		</form>
		<div class="clr"></div>
	</div>
</body>
</html>