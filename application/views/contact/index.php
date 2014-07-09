<div class="left">
	<div class="contact-info">
		<div class="promise">
			<img src="<?=IMG_URL?>travelovietnam.png" alt="The TraveloVienam Promise">
			<p class="groupon_promise">We're confident in the businesses we feature on TraveloVietnam and back them with the TraveloVietnam Promise.</p>
		</div>
		<div class="head-office">
			<h3>TRAVELOVIETNAM™ Head Office</h3>
			<div>Adress: 184/1A Le Van Sy Street, Ward 10, Phu Nhuan Dist, Ho Chi Minh, Vietnam</div>
			<div>Hotline: <?=HOTLINE?></div>
			<div>Email: <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a></div>
		</div>
	</div>
	<div class="clr"></div>
</div>
<div class="right" style="width: 710px">
	<div class="contact-form">
		<h1>ONLINE CONTACT FORM</h1>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="100%" valign="top">
					<div style="margin:0 20px;">
						<p>For any complaints, comments, information,...</p>
						<p>Please send us by email: <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> or fill in the form bellow:</p>
					</div>
					<div style="margin:20px 15px;">
						<form id="frmContact" action="<?=site_url("contact/message")?>" method="POST">
							<table width="100%" cellpadding="5">
								<tbody>
									<tr valign="top">
										<td width="100px">Your Name<span class="required">*</span></td><td>:</td>
										<td><input type="text" value="" name="fullname" class="clstext" style="width: 400px" /></td>
									</tr>
									<tr valign="top">
										<td>Email<span class="required">*</span></td><td>:</td>
										<td><input type="text" value="" name="email" class="clstext" style="width: 400px" /></td>
									</tr>
									<tr valign="top">
										<td>Phone Number</td><td>:</td>
										<td><input type="text" value="" name="phone" class="clstext" style="width: 400px" /></td>
									</tr>
									<tr valign="top">
										<td>Message<span class="required">*</span></td><td>:</td>
										<td><textarea name="content" rows="10" style="width: 400px"></textarea></td>
									</tr>
									<tr valign="top">
										<td>Captcha<span class="required">*</span></td><td>:</td>
										<td><input type="text" id="security_code" name="security_code" class="clstext" style="width: 60px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
										<td><input class="red-btn" type="submit" value="Submit" name="sbtContact" /></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="clr"></div>
