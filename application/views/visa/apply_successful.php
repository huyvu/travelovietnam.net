<div class="tab-step">
	<h1 class="note">Vietnam Visa Application Form</h1>
	<ul class="style-step">
		<li><font class="number">1.</font> Applicant Detail</li>
		<li><font class="number">2.</font> Review &amp; Payment</li>
	</ul>
</div>
<div class="clr"></div>
<div class="detailvisa">
	<form action="<?=BASE_URL."/visa/finish"?>" method="POST">
		<input type="hidden" id="key" name="key" value="<?=$key?>">
		<div class="detailstep4">
			<div class="thanksucc">
				<p>Dear <?=strtoupper($client_name)?>,</p>
				<p>Thanks for your supporting us!</p>
				<p>Your visa application is successful, and we will process the visa base on your request.</p>
				<p>Please check your registered email to get our final confirmation to know status.</p>
				<p>Some time this email come to your "<b>spam</b>" or "<b>junk mail</b>", please make sure you get our confirmation.<br/>If not, please contact us via email: <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> or hotline: <span class="red"><?=HOTLINE?></span></p>
			</div>
			<div class="service">
				<h4 class="red">DO YOU NEED OUR HELP FOR:</h4>
				<p><input type="checkbox" value="hotel" id="hotel-booking" name="hotel-booking"><label for="hotel-booking"> Hotel Booking</label></p>
				<p><input type="checkbox" value="tour" id="optional-tour" name="optional-tour"><label for="optional-tour"> Optional Tours</label></p>
				<p><input type="checkbox" value="flight" id="domestic-flight" name="domestic-flight"><label for="domestic-flight"> Domestic Flights</label></p>
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
			<input class="finish" type="submit" value="Finish" />
		</div>
	</form>
</div>

<!-- Google Code for Conversion 1 Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 949475947;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "Sale";
var google_conversion_value = <?=$total_fee?>;
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
	<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/949475947/?value=<?=$total_fee?>&label=Sale&guid=ON&script=0"/>
	</div>
</noscript>

