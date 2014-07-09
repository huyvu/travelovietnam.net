<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>reveal.css" />
<script type="text/javascript" src="<?=JS_URL?>jquery.reveal.js"></script>
<div id="footer">
	<div class="association">
		<div class="association-info">
			<div class="inner">
				<div class="copyright">
					<div class="left text">IN ASSOCIATION WITH</div>
					<div class="right icons">
						<a><img alt="" src="<?=IMG_URL?>association/foodprint.png"></a>
						<a><img alt="" src="<?=IMG_URL?>association/tripadvisor.png"></a>
						<a><img alt="" src="<?=IMG_URL?>association/lonelyplanet.png"></a>
						<a><img alt="" src="<?=IMG_URL?>association/travelcompensationfund.png"></a>
						<a><img alt="" src="<?=IMG_URL?>association/adventuretravel.png"></a>
						<a><img alt="" src="<?=IMG_URL?>association/pata.png"></a>
						<a><img alt="" src="<?=IMG_URL?>association/abta.png"></a>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="info-area">
		<div class="inner">
			<div class="links">
				<h2>WHO ARE WE?</h2>
				<ul>
					<li><a title="About Us" href="<?=site_url("about")?>">About Us</a></li>
					<li><a title="Why Us" href="<?=site_url("whyus")?>">Why Us</a></li>
					<li><a title="Meet Our Team" href="<?=site_url("team")?>">Meet Our Team</a></li>
					<li><a title="Contact Us" href="<?=site_url("contact")?>">Contact Us</a></li>
				</ul>
			</div>
			<div class="links">
				<h2>TRAVEL BOOKING</h2>
				<ul>
					<li><a title="Vietnam Tours Booking" target="_blank" href="<?=site_url("tours")?>">Vietnam Tours</a></li>
					<li><a title="Vietnam Hotels Booking" target="_blank" href="<?=site_url("hotels")?>">Vietnam Hotels</a></li>
					<li><a title="Vietnam Flights Booking" target="_blank" href="<?=site_url("flights")?>">Vietnam Flights</a></li>
					<li><a title="Vietnam Visa on Arrival" target="_blank" href="<?=site_url("visa")?>">Vietnam Visa on Arrival</a></li>
				</ul>
			</div>
			<div class="links">
				<h2>TRAVEL GUIDE</h2>
				<ul>
					<li><a title="Vietnam Overview" href="<?=site_url("vietnam/overview")?>">Vietnam Overview</a></li>
					<li><a title="Best Time to Visit Vietnam" href="<?=site_url("vietnam/snapshot")?>">Best Time to Visit</a></li>
					<li><a title="Vietnam Culture & History" href="<?=site_url("vietnam/culture-geography-history")?>">Culture & History</a></li>
					<li><a title="Vietnam Travel Tips" href="<?=site_url("vietnam/travel-tips")?>">Travel Tips</a></li>
					<li><a title="Vietnam FAQ & Information" href="<?=site_url("vietnam/faqs")?>">FAQ & Information</a></li>
				</ul>
			</div>
			<div class="links">
				<h2>LEGAL</h2>
				<ul>
					<li><a title="Terms & Conditions" href="<?=site_url("terms-and-conditions")?>">Terms & Conditions</a></li>
					<li><a title="Privacy Policy" href="<?=site_url("privacy-policy")?>">Privacy Policy</a></li>
					<li><a title="Cancel & Refund" href="<?=site_url("cancel-and-refund")?>">Cancel & Refund</a></li>
					<li><a title="Money Back Guarantee" href="<?=site_url("money-back-guarantee")?>">Money Back Guarantee</a></li>
					<li><a title="Safety Payment" href="<?=site_url("safety-payment")?>">Safety Payment</a></li>
				</ul>
			</div>
			<div class="right newsletter-signup">
				<h2>NEWSLETTER SIGN UP</h2>
				<div class="label">Sign up to keep up-to-date on the latest travel news</div>
				<div class="newsletter-signup-form">
					<div class="left">
						<input type="text" id="signup-email" class="signup-email" placeholder="Sign up your email"/>
					</div>
					
					<div class="right">
						<input type="button" id="signup-button" class="signup-button" value="SIGN UP" data-reveal-id="myModal"/>
					</div>
					<div class="clr"></div>
				</div>
				<h2>LIKE, SHARE & FOLLOW</h2>
				<div class="follow-icons">
					<a target="_blank" rel="nofollow" title="TraveloVietnam on Facebook" href="<?=FACEBOOK?>"><img src="<?=IMG_URL?>icon-facebook.png" /></a>
					<a target="_blank" rel="nofollow" title="TraveloVietnam on Google+" href="<?=GOOGLEPLUS?>"><img src="<?=IMG_URL?>icon-gplus.png" /></a>
					<a target="_blank" rel="nofollow" title="TraveloVietnam on Twitter" href="<?=TWITTER?>"><img src="<?=IMG_URL?>icon-twistter.png" /></a>
					<div class="clr"></div>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
	<div class="company-info">
		<div class="inner">
			<div class="copyright">
				<div class="left">Address: 184/1A Le Van Sy street, Phu Nhuan district, Ho Chi Minh city, Vietnam.</div>
				<div class="right">&copy; 2010-<?=date('Y')?> TraveloVietNam.com. All rights reserved.</div>
				<div class="clr"></div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$("#signup-button").click(function() {
		var p = {};
		p["email"] = $("#signup-email").val();
		var link = ("https:" == document.location.protocol ? "https://" : "http://") + "www.travelovietnam.com/newsletter/signup";
		$.ajax({
			type: "POST",
			url: link,
			data: p,
			dataType: 'json',
			cache: false,
			success: function(result) {
				var title	= result[0];
				var message	= result[1];
				msgbox(message,title);
			},
			async:false
		});
	});
});
</script>

<script type="text/javascript">var subiz_account_id = "4845";(function() { var sbz = document.createElement("script"); sbz.type = "text/javascript"; sbz.async = true; sbz.src = ("https:" == document.location.protocol ? "https://" : "http://") + "widget.subiz.com/static/js/loader.js?v="+ (new Date()).getFullYear() + ("0" + ((new Date()).getMonth() + 1)).slice(-2) + ("0" + (new Date()).getDate()).slice(-2); var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(sbz, s);})();</script>

<a href="http://www.instantssl.com" id="comodoTL">SSL Certificate Provider</a>
<script language="JavaScript" type="text/javascript">
COT("<?=IMG_URL?>cot_evssl.gif", "SC2", "none");
</script>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 972591696;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/972591696/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("img.lazy").lazy({
			// general 
			bind : "load",
			threshold : 500,
			fallbackHeight : 2000,
			visibleOnly : false,
			appendScroll : window,
			// delay 
			delay : -1,
			combined : false,
			// attribute 
			attribute : "data-src",
			removeAttribute : true,
			// effect 
			effect : "fadeIn",
			effectTime : 500
		}); 
	});
</script>