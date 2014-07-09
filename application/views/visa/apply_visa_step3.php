<div class="tab-step">
	<h1 class="note">Vietnam-Evisa Application</h1>
	<ul class="style-step">
		<li><font class="number">1.</font> Applicant Detail</li>
		<li><font class="number">2.</font> Review &amp; Payment</li>
	</ul>
</div>
<div class="clr"></div>
<div class="detailvisa">
		<div class="detailstep4">
			<div class="thanksucc">
				<p>Dear <?=$client_name?>,</p>
				<p>Thanks for your supporting us!</p>
				<p>Your visa application is successful, and we will process the visa base on your request.</p>
				<p>Please check your registered email to get our final confirmation to know status.</p>
				<p>Some time this email come to your "<b>spam</b>" or "<b>junk mail</b>", please make sure you get our confirmation.<br/>If not, please contact us via email: <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> or hotline: <span class="red"><?=HOTLINE?></span></p>
			</div>
			<div class="nicetrip">
				<h3 class="red">Have a nice Trip !</h3>
				<strong>David La</strong> (Mr.) <br/>
				Director of Vietnam Visa Online Office. <br/>
				Add: 698/8 Truong Chinh street, Tan Binh dist, <br/>
				Ho Chi Minh city, Vietnam.<br/>
				Hotline: <?=HOTLINE?>
			</div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<div class="nextstep">
			<input class="finish" type="button" value="Finish" onclick="window.location='<?=BASE_URL?>'"/>
		</div>
</div>
