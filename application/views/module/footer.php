<div id="footer">
	<div class="search-bar">
		<div class="site-search">
			<span>SITE SEARCH</span>
			<form action="<?=site_url("search")?>" method="get">
				<input type="text" class="search-text" name="searchCriteria" />
				<input type="submit" class="search-button" value=""/>
			</form>
		</div>
		<div class="deal-signup">
			<span>GET DEALS IN YOUR INBOX</span>
			<input type="text" id="subscribe-email" class="search-text" placeholder="Sign up your email"/>
			<input type="button" id="subscribe-button" class="search-button" value=""/>
		</div>
		<div class="clr"></div>
	</div>
	<div class="info-area">
		<div class="links">
			<h2>VIETNAM HOTELS</h2>
			<ul>
				<li><a title="Vietnam Cheap Hotels" href="<?=site_url("hotels/vietnam")?>">Vietnam Cheap Hotels</a></li>
				<li><a title="Vietnam Luxury Hotels" href="<?=site_url("hotels/vietnam")?>">Vietnam Luxury Hotels</a></li>
				<li><a title="Vietnam Featured Hotels" href="<?=site_url("hotels/vietnam")?>">Vietnam Featured Hotels</a></li>
				<li><a title="Vietnam Top Deals Hotels" href="<?=site_url("hotels/vietnam")?>">Vietnam Top Deals Hotels</a></li>
				<li><a title="Hotels in Ha Noi" href="<?=site_url("hotels/vietnam")?>">Hotels in Ha Noi</a></li>
				<li><a title="Hotels in Ho Chi Minh" href="<?=site_url("hotels/vietnam")?>">Hotels in Ho Chi Minh</a></li>
			</ul>
		</div>
		<div class="links">
			<h2>VIETNAM TOURS</h2>
			<ul>
				<li><a title="Vietnam Package Tours" href="<?=site_url("tours/vietnam")?>">Vietnam Package Tours</a></li>
				<li><a title="Vietnam Trending Tours" href="<?=site_url("tours/vietnam")?>">Vietnam Trending Tours</a></li>
				<li><a title="Vietnam Daily Tours" href="<?=site_url("tours/vietnam")?>">Vietnam Daily Tours</a></li>
				<li><a title="Vietnam Ha Long Tours" href="<?=site_url("tours/vietnam")?>">Vietnam Ha Long Tours</a></li>
				<li><a title="Vietnam Mekong Delta Tours" href="<?=site_url("tours/vietnam")?>">Vietnam Mekong Delta Tours</a></li>
				<li><a title="Vietnam Top Deals Tours" href="<?=site_url("tours/vietnam")?>">Vietnam Top Deals Tours</a></li>
			</ul>
		</div>
		<div class="links">
			<h2>OTHER SERVICES</h2>
			<ul>
				<li><a title="Vietnam Visa Services" href="<?=site_url("visa")?>">Vietnam Visa Services</a></li>
				<li><a title="Car Rental in Vietnam" href="<?=site_url("cars")?>">Car Rental in Vietnam</a></li>
				<li><a title="Vietnam Cuisines" href="<?=site_url("cuisines")?>">Vietnam Cuisines</a></li>
				<li><a title="Vietnam Domestic Flights" href="<?=site_url("flights")?>">Vietnam Domestic Flights</a></li>
			</ul>
		</div>
		<div class="links">
			<h2>TERMS OF USE</h2>
			<ul>
				<li><a title="Terms of Use" href="<?=site_url("terms-and-conditions")?>">Terms & Conditions</a></li>
				<li><a title="Privacy Policy" href="<?=site_url("privacy-policy")?>">Privacy Policy</a></li>
			</ul>
		</div>
		<div class="links">
			<h2>OUR COMPANY</h2>
			<ul>
				<li><a title="About Us" href="<?=site_url("about")?>">About Us</a></li>
				<li><a title="Why Us" href="<?=site_url("whyus")?>">Why Us</a></li>
				<li><a title="Contact Us" href="<?=site_url("contact")?>">Contact Us</a></li>
			</ul>
		</div>
		<div class="clr"></div>
	</div>
	<div class="company-info">
		<div class="aboutus">
			<h3>A few words about us</h3>
			<p>TraveloVietnam.Com is a company business travel services, specialized in organizing travel itineraries to domestic and international. We are a Professional Inbound Tour Operator, based in Ho Chi Minh – Vietnam, with special style for worldwide travelers for years. As a trustworthy Vietnam Tour operator, can always work with you to create the memorable trips for you at the cost that suits your budget.</p>
		</div>
		<div class="followus">
			<h3>LIKE, SHARE & FOLLOW</h3>
			<p>Follow us for great travel news for your vacation to Vietnam. We're offers about Vietnam tours, Vietnam hotels, Vietnam domestic flights and get Vietnam visa online - Full circle travel services. </p>
			<div class="follow-icons">
				<a target="_blank" rel="nofollow" title="TraveloVietnam on Facebook" href="<?=FACEBOOK?>"><img src="<?=IMG_URL?>icon-facebook.jpg" /></a>
				<a target="_blank" rel="nofollow" title="TraveloVietnam on Google+" href="<?=GOOGLEPLUS?>"><img src="<?=IMG_URL?>icon-gplus.jpg" /></a>
				<a target="_blank" rel="nofollow" title="TraveloVietnam on Twitter" href="<?=TWITTER?>"><img src="<?=IMG_URL?>icon-twistter.jpg" /></a>
				<a target="_blank" rel="nofollow" title="TraveloVietnam on Youtube" href="" class="last"><img src="<?=IMG_URL?>icon-youtube.jpg" /></a>
				<div class="clr"></div>
			</div>
		</div>
		<div class="copyright">
			<div class="left">Address: 184/1A Le Van Sy street, Phu Nhuan district, Ho Chi Minh city, Vietnam.</div>
			<div class="right">&copy; 2010-<?=date('Y')?> TraveloVietNam.com. All rights reserved.</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$("#subscribe-button").click(function() {
		var p = {};
		p["email"] = $("#subscribe-email").val();
		$.post("<?=site_url("deal/subscribe")?>", p, function(result) {
			msgbox(result);
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
