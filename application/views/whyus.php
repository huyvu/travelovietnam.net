<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title"><?=$item->title?></h1>
	<div class="about">
		<div class="left about-content">
			<div class="main-banner">
				<img alt="" src="<?=IMG_URL?>whyus/whyus-banner.jpg">
			</div>
			<div id="whyus-content">
				<ul>
					<li>
						<img src="<?=IMG_URL?>whyus/travel.jpg">
						<h2>A diffirent way to travel</h2>
						<p>
							At Travelovietnam, you will be in a 
							heaven with UNESCO heritage 
							sites of the world accompanied 
							with many interesting things from 
							cultures, customs and wildlife. It 
							will be a good experience for you 
							when coming to Vietnam
						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/value.jpg">
						<h2>Price and value</h2>
						<p>
							You will be happier with the reasonable 
							tours from us. Not only an exciting tour 
							but it is also a wide choice with many 
							reasonable prices for you.

						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/support.jpg">
						<h2>Support 24/7</h2>
						<p>
							We are always ready to receive your feedback as well 
							as your questions to assist for you at anywhere 
							and at any time. We serve 24/7 for a week.
						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/guarantee.jpg">
						<h2>Money Back Guarantee</h2>
						<p>
							We guarantee that you will have a great trip with 
							not only quality, but with assured fun. 
							If you are not happy with a product (service) that 
							you booked on TraveloVietnam.com, for any reason, 
							you can ask to us to have refund within 30 days of the order date. 
						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/vietnam-biking.jpg">
						<h2>Life time deposit <sup>TM</sup></h2>
						<p>
							The lifetime deposit will protect you 
							from unpredictable and unexpected things 
							that your trip may be delayed or cancelled. 
							There may be a reason for to cancel a booking, 
							you can if you use lifetime deposit.
						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/compass.jpg">
						<h2>100% Guaranteed departures</h2>
						<p>
							Once you book and paid for your tour, 
							your tour will not automatically be cancelled 
							by us for any reason (accepting weather and safety issues)
						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/xichlo.jpg">
						<h2>Transportation</h2>
						<p>
							We offer a variety of choices of transportation 
							for your tour. There will be a suitable 
							transportation with your destination in your trip.
						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/explore.jpg">
						<h2>Flexibility & independent</h2>
						<p>
							You can have a time to explore in 
							your own way besides our must see highlights 
							on most of trips.
						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/vietnam-homestay.jpg">
						<h2>Accommodation</h2>
						<p>
							We ensure you will have a good sleep at cruise, 
							hotel or even if homestay. 
						</p>
					</li>
					<li>
						<img src="<?=IMG_URL?>whyus/motorbike-tour.jpg">
						<h2>No Single supplement</h2>
						<p>
							Single travelers would be enjoyed the same 
							advantages as others in their group. 
							You will be in a room with a person same 
							sex with you to ensure the same price. 
						</p>
					</li>
				</ul>   
			</div><!--/#whyus-content -->
		</div>
		<div class="right" style="width: 280px;">
			<div id="about-view-nav">
				<ul>
					<li>
						<a class="about-us" title="" href="<?=site_url("about")?>">ABOUT US</a>
					</li>
					<li>
						<a class="why-us-selected" title="" href="<?=site_url("whyus")?>">WHY CHOOSE US</a>
					</li>
					<li>
						<a class="our-team" title="" href="<?=site_url("team")?>">OUR TEAM</a>
					</li>
					<li>
						<a class="testimonial" title="" href="<?=site_url("testimonial")?>">TESTIMONIAL</a>
					</li>
					<li>
						<a class="community" title="" href="<?=site_url("community")?>">OUR COMMUNITY</a>
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
