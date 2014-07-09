<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="header-title">
	   <h1 class="page-title"><?=$item->title?></h1>
	</div><!--/.header-title -->
	<div class="about">
		<div class="left about-content">
			<div class="main-banner">
				<img alt="" src="<?=IMG_URL?>about/about-banner.jpg">
			</div>
			<div style="padding: 0px 15px 15px;">
				<h2 class="about-header">Xin chao! Hello</h2>
				<p style="text-align: justify;">
					We are <b>TRAVELOVIETNAM™</b> - Proudly a member of Vietnam Travel. We are one of the leading travel companies with head office in Ho Chi Minh - the biggest city of Vietnam, we were born & grew up in Vietnam and we love our land.
				</p>
				<br>
				<p style="text-align: justify;">
					- To be local tour operator company working many years in Vietnam tourism with widely and deeply knowledge about our homeland (history, culture, geography...) All the tours and services, we are offering, are the things we have gained experiences and the good feedbacks from our customers. We are so self-confident to bring the authentic & unique experiences to travelers in Vietnam. 
				</p>
				<br>
				<p style="text-align: justify;">
					- We provide fully from package tours to private tours for small group, family, couple, single travelers to business and educational tours. We always design the tours that can match all your requirements.					
				</p>
				<div class="contact-box">
					<ul>
						<li><span>Company Registration & International Tour Operator License</span></li>
						<li>International Trading Name: <b>TRAVELOVIETNAM CO., LTD</b></li>
						<li>Company Name in Vietnamese: <b>CÔNG TY TNHH LỮ HÀNH TRAVELOVIETNAM</b></li>
						<li>Tax Identification Number: <b>0106078398</b></li>
						<li>International Tour Operator License: <b>01-551/TCDL-GPLHQT</b></li>
					</ul>
				</div><!-- .contact-box -->
				   
				<h2 class="about-header">Trust & Verified by D&B D-U-N-S</h2>
				<p style="text-align: justify;">
					<b>TRAVELOVIETNAM Co., LTD</b> is licensed by Vietnam National Administration of Tourism (VNAT) - the government department of Vietnam Tourism. The copy of our travel license will be shown in the below:
				</p>
				<img alt="" src="<?=IMG_URL?>about/licence.jpg" style="padding: 10px; margin-bottom: 20px">
				<h2 class="about-header">Our Concept</h2>
				<p style="text-align: justify;">
					We can say that Vietnam is one of the best destinations to visit in South East Asia. From the mountainous area to the peaceful beaches, all the tourism spots attract the travelers from adventure to relaxing.
					We understand why people want to travel outside their countries and why they choose Vietnam as a destination. With widely and deeply knowledge about our homeland (history, culture, people, etc) and the tourism infrastructure in Vietnam, we are so self-confident to provide you the best tours with best services.
				</p>
				<br>
				<p style="text-align: justify;">
					When you decide to book tours with us, all worries will be left behind. We prepare the detail programs with full necessary things for you. You travel - We care your trip, Just go & No Worry! Even you are a stranger in Vietnam, we will be the friendly host and you will feel like a home sweet home. Come as guests, Stay as family and leave as friends!
				</p>
				<br>
				<p style="text-align: justify;">
					Your smiles are our success! Travelling with the happiness, satisfaction and joyfulness are the most important things we want our customers have. Just tell us what you need, where you want to go, we believe that we can deliver the best options for you in Vietnam.					
				</p>
				<br>
				<p style="text-align: justify;">
					We are always here to listen and serve you!					
				</p>
				<br>
				<p style="text-align: justify;">
					Best Services, Best Supports, Best Offers, Local Experiences are our promises to all clients chosen us.
					<b><i>"We bring all the authentic & unique experiences to you in Vietnam! " </i></b>
				</p>
				<br>
				<p>
					Surely, You will feel satisfactory!
				</p>
				<? require_once(APPPATH."views/module/social.php"); ?>
			</div>
		</div>
		<div class="right" style="width: 280px;">
			<div id="about-view-nav">
				<ul>
					<li>
						<a class="about-us-selected" title="" href="<?=site_url("about")?>">ABOUT US</a>
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

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script>
!function(d,s,id){
	var js,fjs=d.getElementsByTagName(s)[0];
	if(!d.getElementById(id)){js=d.createElement(s);
		js.id=id;
		js.src="https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js,fjs);
	}}(document,"script","twitter-wjs");
</script>
