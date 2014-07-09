<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Our Team
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title">VIETNAM TRAVEL TEAM</h1>
	<div class="about">
		<div class="left about-content">
			<div id="our-team">
				<div class="header">
					<div class="title">BEHIND EVERY SUCCESSFUL PROJECT LIES A TEAM OF REALLY DEDICATED PEOPLE</div>
					<p class="desc">Travelovietnam is made up of an enthusiastic and dedicated team whose passion is to assist foreigners to Vietnam with Vietnam visa related services. All the staff at Travelovietnam are passionate about travel with heart. We love exploring the world around us. Because of our experience in travel and mission - especially the hard-to-reach places - we are able to identify and respond to your ever-changing travel needs.</p>
				</div>
				<div class="content">
					<div class="about">
						<div class="left" style="width: 310px">
							<div class="title">TRAVELOVIETNAM TEAM</div>
							<p class="desc">
								<img alt="" src="<?=IMG_URL?>quote.png" />
								With advantage of the most skillfull and talent online technological professional team, we support 24/7 arrange any tours for those who travel to Vietnam for different purpose: business, vacation or leisure. We have strived to introdce Vietnam as a beautiful country rich in history, culture and traditions along with stunning scenery and friendly and hospitable local people. We keep promise to offer you a memorable and deeply-impressed trip on our country.
							</p>
						</div>
						<div class="right">
							<div class="team-banner"></div>
						</div>
						<div class="clr"></div>
					</div>
					<div class="detail">
						<div class="label">Here, you will find a picture along with some information of each Travelovietnam member – the ones you will be directly in contact with via email and/or telephone.</div>
					</div>
					<div class="team">
						<? for ($i=0; $i<sizeof($team); $i++) { ?>
						<div class="member">
							<div class="<?=(($i%2)?"mright":"mleft")?>">
								<div class="thumbnail"><img alt="" src="<?=$team[$i]->thumbnail?>"></div>
								<div class="mcontent">
									<div class="title"><?=$team[$i]->title?></div>
									<div class="summary"><?=$team[$i]->description?></div>
								</div>
							</div>
							<div class="clr"></div>
						</div>
						<? } ?>
						<div class="clr"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="right" style="width: 280px">
			<div id="about-view-nav">
				<ul>
					<li>
						<a class="about-us" title="" href="<?=site_url("about")?>">ABOUT US</a>
					</li>
					<li>
						<a class="why-us" title="" href="<?=site_url("whyus")?>">WHY CHOOSE US</a>
					</li>
					<li>
						<a class="our-team-selected" title="" href="<?=site_url("team")?>">OUR TEAM</a>
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
		</div>
		<div class="clr"></div>
	</div>
</div>
