<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Our Community
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title">Our Community</h1>
	<div class="about">
		<div class="left about-content">
			<div style="padding: 0px 15px 15px;">
				<h2 class="about-header">Online community</h2>
				<p>
					A community of travelers that is forever growing and that stays at the heart of everything we do. Friends, couples and single travelers, our passengers come from all walks of life and they have one thing in common: they love to travel and want more than just a package vacation.
				</p>
				<br/>
				<p>
					We love to your feedback which continues to shape everything we do, from our itineraries, choice of hotels, as well as constantly reminding us of what we love about travel and Vietnam. Through our online community you can stay in touch with Travelovietnam, stay connected with other travelers from your journey and meet other travelers you may soon be traveling with.
				</p>
				<br/>
				<p>
					So, don't delay! Signup to our newsletter, find us on Facebook, follow us on Twitter or view our YouTube channel.
				</p>
				<div class="social-box">
					<a href="https://www.facebook.com/travelovietnam.services">
						<img src="<?=IMG_URL?>community/icon/icon-facebook.jpg">
						<p>Like us on facebook</p>
					</a>
					<a href="http://www.youtube.com/channel/UCWYDqjOcBXJ9SbWPe26Z82w">
						<img src="<?=IMG_URL?>community/icon/icon-youtube.jpg">
						<p>Watch on Youtube</p>
					</a>
					<a href="https://twitter.com/TraveloVietnam">
						<img src="<?=IMG_URL?>community/icon/icon-twitter.jpg">
						<p>Follow us on Twitter</p>
					</a>
					<a href="#">
						<img src="<?=IMG_URL?>community/icon/icon-pinterest.jpg">
						<p>Follow us on Pinterest</p>
					</a>
					<a href="https://plus.google.com/u/0/106910359919543854405/about?partnerid=gplp0">
						<img src="<?=IMG_URL?>community/icon/icon-googleplus.jpg">
						<p>Follow us on Google+</p>
					</a>      
				</div><!--/.social-box -->
				         
				<h2 class="about-header">Youtube channel</h2>
				<iframe width="660" height="393" src="//www.youtube.com/embed/7ehbhCFjWC8" frameborder="0" allowfullscreen></iframe>

				<h2 class="about-header">Find us on Facebook</h2>
					<div class="fb-like-box" data-href="https://www.facebook.com/travelovietnam.services" data-width="660" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" style="padding-bottom:10px;"></div>
				<h2 class="about-header">Share your story</h2>
				<p>
					We love to share our travelers' experiences in Vietnam. Let us know about your trip, 
					so we can share it with our community, and you can help future travelers to enjoy 
					the wonders of Asia too. Send us your story through our <a href="<?php echo site_url('tours/planning') ?>">online inquiry form</a> and we'll 
					be back in touch quick snap!
				</p>
			</div>
		</div>
		<div class="right" style="width: 280px;">
			<div id="about-view-nav">
				<ul>
					<li>
						<a class="about-us" title="" href="<?=site_url("about")?>">ABOUT US</a>
					</li>
					<li>
						<a class="why-us" title="" href="<?=site_url("whyus")?>">WHY CHOOSE US</a>
					</li>
					<li>
						<a class="our-team" title="" href="<?=site_url("team")?>">OUR TEAM</a>
					</li>
					<li>
						<a class="testimonial" title="" href="<?=site_url("testimonial")?>">TESTIMONIAL</a>
					</li>
					<li>
						<a class="community-selected" title="" href="<?=site_url("community")?>">OUR COMMUNITY</a>
					</li>
					<li>
						<a class="blog" title="" href="<?=site_url("blog")?>">OUR BLOG</a>
					</li>
				</ul>
			</div>
			<? require_once(APPPATH."views/module/about/customer_review.php"); ?>
			<? require_once(APPPATH."views/module/tour/customize.php"); ?>
			<? require_once(APPPATH."views/module/social/fb_like_box.php"); ?>
		</div><!-- .right -->
		<div class="clr"></div>
	</div>
</div>
