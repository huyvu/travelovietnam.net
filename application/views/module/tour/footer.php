<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>reveal.css" />
<script type="text/javascript" src="<?=JS_URL?>jquery.reveal.js"></script>
<footer class="pull-left">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xs-12">
				<img src="<?=IMG_URL?>logo.png" alt="">
				<p>
					TraveloVietnam is the Vietnam's <br/>
					leading resource for researching, <br/>
					finding and booking the best travel <br/>
					experiences Vietnam.
				</p>
			</div>
			<div class="col-md-2 hidden-xs">
				<h3 class="footer-heading">COMPANY</h3>
				<ul>
					<li><a title="About Us" href="<?=site_url("about")?>">About Us</a></li>
					<li><a href="#">Corporate Info</a></li>
					<li><a href="#">Media Center</a></li>
					<li><a href="#">Careers</a></li>
					<li><a href="#">Site Map</a></li>
					<li><a href="#">Free Newsletter</a></li>
				</ul>
			</div>
			<div class="col-md-2 hidden-xs">
				<h3 class="footer-heading">SUPPORT</h3>
				<ul>
					<li><a href="#">Customer Care</a></li>
					<li><a title="Privacy Policy" href="<?=site_url("privacy-policy")?>">Privacy Policy</a></li>
					<li><a href="#">Low Price Guarantee</a></li>
					<li><a href="#">Group Services</a></li>
					<li><a href="#">Mileage Program</a></li>
					<li><a href="#">Gift Certificates</a></li>
				</ul>
			</div>
			<div class="col-md-2 hidden-xs">
				<h3 class="footer-heading">SOCIAL</h3>
				<div class="social">
					<a target="_blank" rel="nofollow" title="TraveloVietnam on Facebook" href="<?=FACEBOOK?>"><img src="<?=IMG_URL?>facebook.png" alt=""></a>
					<a target="_blank" rel="nofollow" title="TraveloVietnam on Twitter" href="<?=TWITTER?>"><img src="<?=IMG_URL?>twitter.png" alt=""></a>
					<a href=""><img src="<?=IMG_URL?>youtube.png" alt=""></a>
					<a target="_blank" rel="nofollow" title="TraveloVietnam on Google+" href="<?=GOOGLEPLUS?>"><img src="<?=IMG_URL?>google-plus.png" alt=""></a>	
				</div>
				
			</div>
			<div class="col-md-2 hidden-xs">
				<h3 class="footer-heading">QUICK LINK</h3>
				<ul class="quick-link">
					<li><a title="Terms & Conditions" href="<?=site_url("terms-and-conditions")?>">Term of Use</a></li>
					<li><a href="<?=site_url("vietnam/travel-tips")?>">Travel Guides</a></li>
					<li><a href="<?=site_url("contact")?>">Contact us</a></li>
					<li><a href="title="Contact Us"">Sitemap</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- end .container -->
</footer>
<!-- end footer -->
<div class="footer-bottom">
	<h5>2010 - 2014 Travelovietnam.net All Reserved</h5>
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
<!-- <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script> -->
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