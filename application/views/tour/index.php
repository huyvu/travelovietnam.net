<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/panorama.css" />
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/droplist.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.easing.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.contentcarousel.js"></script>

<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/metro-gallery.css" />
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/hammer.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/metro-gallery.min.js"></script>

<style type="text/css">
	.subiz_online { cursor: pointer; display: block; height: 32px; width: 166px; line-height: 32px; text-indent: -99999px; background: url(template/images/tour/icon/support-online.png) no-repeat scroll left center transparent; }
	.subiz_offline { cursor: pointer; display: block; height: 32px; width: 166px; line-height: 32px; text-indent: -99999px; background: url(template/images/tour/icon/support-offline.png) no-repeat scroll left center transparent; }
</style>

<style type="text/css">
	.carousel-inner .item {
		padding: 10px;
		width: 290px;
		overflow: hidden;
		box-sizing: content-box;
	}

	.carousel-inner .item .reviews {
		margin-bottom: 10px;
	}

	.carousel-inner .item .tourname {
		margin: 10px 0 5px 0;
	}

	.carousel-inner .item .tourname a {
		color: #0072BC;
		font-size: 16px;
		font-weight: normal;
		line-height: 18px;
	}

	.carousel-inner .item .tourname a:hover {
		text-decoration: none;
	}

	.carousel-inner .item .reviews img {
		margin-top: 2px;
		display: block;
		float: left;
		margin-right: 10px;
	}

	.carousel-inner .item .reviews a {
		text-decoration: none;
		font-size: 12px;
		color: #2075c2;
		border-bottom: 2px solid #c0d2e9;
	}

	.carousel-inner .item .detail {
		color: #535353;
	}
	
	.carousel-inner .item {
		background: #eaeaea;
	}

	#vietnam-tour .col-md-4 {
		padding: 0 15px 0 0;
	}

	#vietnam-tour .col-md-4:nth-child(3) {
		padding: 0 0 0 30px;
	}

	.carousel-indicators {
		position: relative;
		margin-top: 30px;
	}

	.carousel-indicators li {
		background: #cacaca;
		height: 12px;
		width: 12px;
		border: none;
		margin: 0;
	}

	.carousel-indicators .active {
		background: #e36f22;
	}

	#home.container {
		padding: 0;
	}

</style>


<script type="text/javascript">
	$(document).ready(function() {
		$("#tour-fromcity").change(function() {
			get_destinations();
		});
		get_destinations();
	});
	function get_destinations() {
		var p = {};
		p['fromcity'] = $("#tour-fromcity").val();
		$("#tour-tocity").load("<?= site_url('tours/ajax_get_destinations') ?>", p, function() {});
	}
</script>

<div id="guarantee">
	<div class="container">
		<ul>
			<li>Travelovietnam gives you :</li>
			<li class="guarantee-check">
				<h5>THE BEST SELECTION</h5>
				<p>More than 24700 things to do</p>
			</li>
			<li class="guarantee-check">
				<h5>THE LOWEST PRICE</h5>
				<p>We guarantee it !</p>
			</li>
			<li class="guarantee-check">
				<h5>FAST & SECURED BOOKING</h5>
				<p>Book online to start your trip easily</p>
			</li>
		</ul>
	</div>
</div>
<!-- end #guarantee -->

<div id="home" class="container">
	<div class="title row">
		<img src="<?=IMG_URL?>flight-icon.png" alt="">
		<h2 class="title">Tour By Destination</h2>
	</div>
	<div id="tour-destination" class="row">
		<?foreach($vietnam_destinations as $destination) :?>
		<div class="col-md-4">
			<a href="#" class="thumbnail">
				<img src="<?=IMG_URL?>thumbnail.jpg" alt="">
				<span class="img-caption"><?=$destination->title?></span>
			</a>
		</div>
		<?endforeach?>
	</div>
	<!-- end #tour-destination -->

	<div id="vietnam-tour" class="row">
		<div class="col-md-4">
			<div class="title">
				<img src="<?=IMG_URL?>favorite-icon.png" alt="">
				<h2 class="title">Vietnam Festival</h2>
			</div>
			<div id="vietnam-festival" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<?$active = 1?>
					<?foreach($blogs as $blog) :?>
					<div class="item <?=($active)?'active':''?>">
						<div class="thumb">
							<a title="" href="<?=site_url("blog/{$blog->alias}")?>">
								<img width="290" alt="<?=$blog->title?>" src="<?=$blog->thumbnail?>">
							</a>
						</div>
						<div class="detail">
							<h3 class="tourname"><a title="" href="<?=site_url("blog/{$blog->alias}")?>"><?=$blog->title?></a></h3>
							<p style="text-align: justify;">
								<?=$this->util->truncate($blog->content,120, BASE_URL)?>
								<a class="viewmore" href="<?=site_url("blog/{$blog->alias}")?>"> View More</a>
							</p>						
						</div>
					</div>
					<?
					$active = 0;
					endforeach
					?>
				</div>
				<!-- end carousel-inner -->

				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#vietnam-festival" data-slide-to="0" class="active"></li>
					<li data-target="#vietnam-festival" data-slide-to="1"></li>
					<li data-target="#vietnam-festival" data-slide-to="2"></li>
				</ol>
			</div>
		</div>
		<div class="col-md-4">
			<div class="title">
				<img src="<?=IMG_URL?>place-icon.png" alt="">
				<h2 class="title">Best Seller</h2>
			</div>
			<div id="best-seller" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<div class="thumb">
							<a title="" href="<?=site_url("vietnam/sights/abc")?>">
								<img alt="" src="<?=IMG_URL?>thumb.jpg">
							</a>
						</div>
						<div class="detail">
							<h3 class="tourname"><a title="" href="<?=site_url("vietnam/sights")?>">Halong Bay ...</a></h3>
							<p class="reviews">
								<img src="<?=IMG_URL?>tour/icon/star5.png" alt="rating" height="15">
								<a href="#">200 Reviews</a>
							</p>
							<p style="text-align: justify;">
								<?=$this->util->truncate("Ha Long bay is an UNESCO World Heritage Site and one of the world's 
								most spectacular natural wonders, and one of the world's 
								most spectacular natural wonders",120)?>
							</p>						
						</div>
					</div>
					<div class="item">
						<div class="thumb">
							<a title="" href="<?=site_url("vietnam/sights/abc")?>">
								<img alt="" src="<?=IMG_URL?>thumb.jpg">
							</a>
						</div>
						<div class="detail">
							<h3 class="tourname"><a title="" href="<?=site_url("vietnam/sights")?>">Halong Bay ...</a></h3>
							<p class="reviews">
								<img src="<?=IMG_URL?>tour/icon/star5.png" alt="rating" height="15">
								<a href="#">200 Reviews</a>
							</p>
							<p style="text-align: justify;">
								<?=$this->util->truncate("Ha Long bay is an UNESCO World Heritage Site and one of the world's 
								most spectacular natural wonders, and one of the world's 
								most spectacular natural wonders",120)?>
							</p>						
						</div>
					</div>
				</div>
				<!-- end carousel-inner -->

				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>
			</div>
		</div>
		<div class="col-md-4">
			<div class="title" style="height:35px">
				<h2 class="title" style="padding-top:10px">Get Travel Brochure</h2>
			</div>
			<div>
				<p>Subscribe to our email newsletter & get 
				the eBook <strong>"Vietnam travel handbook" </strong>
				for <strong style="font-size: 16px;color:#03599b">FREE</strong>.
				</p>
				<img src="<?=IMG_URL?>brochure.jpg" alt="">
			</div>
			<form action="" role="form">
				<div class="form-group">
					<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email">	
				</div>
				<button id="subcribe-btn" class="btn">Subcribe</button>
			</form>
		</div>
	</div>
	<!-- end #vietnam-tour -->
</div>

<div id="deal">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<h2>Deal & Discount</h2>
				<span>Subcribe to receive our discount, promotion information</span>	
			</div>
			<div class="col-md-5">
				<form class="form-inline pull-right" rol="form">
					<div class="form-group">
						<label class="sr-only" for="deal-email">Email address</label>
						<input type="email" class="form-control" id="deal-email" placeholder="Enter Your Email Address">
					</div>
					<button type="button" class="btn" id="signup-btn">SIGN UP</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#vietnam-festival').carousel({
		  interval: 50000
		})
		$('#best-seller').carousel({
		  interval: 55000
		})
	});
</script>




