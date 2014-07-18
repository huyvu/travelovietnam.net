<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/layerslider/css/layerslider.css" />
<style>
	#things-to-do {
		padding: 12px 10px 12px 30px;
		background: rgba(255,255,255,0.8);
		overflow: hidden;
	}

	.ls-s-1 .form-group label {
		color: #000;
	}

	.ls-s-1 .form-group select {
		height: auto;
		padding: 5px 10px;
		color: #7f7f7f;
		font-weight: 100;
	}
	
	#things-to-do > .form-group {
		margin-bottom: 10px !important;
	}

	#things-to-do > .form-group:nth-child(2) {
		margin-bottom: 0;
	}

	#things-to-do button {
		border-radius: 0;
		font-size: 14px;
		font-weight: bold;
		background: #e36f22;
		padding: 4px 12px;
	}

	#header-testimonial div.avatar {
		float:left;
		height: 88px;
		width: 88px;
		overflow: hidden;
		border-radius: 50%;
		border: 2px solid #FFF;
	}

	#header-testimonial .content {
		float: left;
		padding: 15px 20px 15px 15px;
		background: rgba(0,0,0,.5);
		margin-left: 18px;
		border-radius: 5px; 
	}

	#header-testimonial .content .quote {
		font-family: "Segoe Print", Tahoma, sans-serif;
		font-weight: bold;
		margin-bottom: 10px;
		white-space: pre-line;
		width: 250px;
	}


</style>
<script type="text/javascript">
	$(document).ready(function() {
		// scroll-to-top button show and hide
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$('.scrollup').fadeIn();
			} else {
				$('.scrollup').fadeOut();
			}
		});
		
		// scroll-to-top animate
		$('.scrollup').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		});
	});
</script>

<?php  
	if($this->session->userdata('user')) {
		$user = $this->session->userdata('user');
	}
?>

<header>
	<div id="top-header">
		<div class="container">
			<div class="row">
				<div class="logo col-md-3 col-xs-12">
					<a title="travelovietnam.com" href="<?=BASE_URL?>"><img alt="vietnamamazing" src="<?=IMG_URL?>logo.png" /></a>
				</div>
				<div class="slogan col-md-4 col-xs-12">
					<h3>Discover Vietnam within a day</h3>
				</div>
				<!-- end .logo -->
				<div class="col-md-5 top-menu">
					<ul class="pull-right">
						<li><a href="<?=site_url('member/login')?>">Sign up</a></li>
						<li><a href="<?=site_url('member/login')?>">Log in</a></li>
						<li><a href="<?=site_url('help')?>">Help</a></li>
						<li><a class="favorite" href="#">0</a></li>
						<li><a class="cart" href="#">0</a></li>
					</ul>
					<div class="hotline pull-right">
						Hotline: <h4> (+84) 909.343.525</h4>
					</div>
				</div>
				<!-- end .top-menu -->
			</div>
		</div>
		<!-- end .container -->	
	</div>
	<!-- end #top-header -->
	<nav id="main-menu" class="navbar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			<div class="collapse navbar-collapse" id="bs-navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?=BASE_URL?>">HOME</a></li>
					<li><a href="#">VIETNAM CITY</a></li>
					<li><a href="#">CITY STYLES</a></li>
					<li><a href="#">DISCOVER VIETNAM</a></li>
					<li><a href="#">CITY MOMENTS</a></li>
					<li><a href="<?=site_url('blog')?>">TRAVEL BLOG</a></li>
					<li><a href="<?=site_url('contact')?>">CONTACT US</a></li>
				</ul>
			</div>
		</div>
		<!-- end container -->
	</nav>
	<!-- end nav -->

	<div class="slider" style="background: url('<?=IMG_URL?>slider/slider-1.jpg') repeat-x scroll center bottom transparent">
		<div id="layerslider" class="ls-wp-container" style="width: 100%; height: 406px; margin: 0px auto; ">
			<div class="ls-layer" style="slidedirection: right; slidedelay: 10000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; timeshift: 0; transition2d: all; ">
				<img class="ls-s-1" src="<?=IMG_URL?>slider/traveller.png" alt="image" style="position: absolute; top: 100px; left: 730px; slidedirection : bottom; slideoutdirection : bottom;  durationin : 1000; durationout : 1000; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 500; delayout : 0; showuntil : 0; ">
				<div class="ls-s-1" style="position: absolute; top:330px; left: 800px; slidedirection : top; slideoutdirection : top; durationin : 1000; durationout : 1000; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 800; delayout : 0; showuntil : 0; font-family: 'Open Sans'; font-size: 14px; font-weight: 600; color: #FFF; padding: 5px 10px; background: rgb(54, 54, 54); background: rgba(54, 54, 54, 0.8);  white-space: nowrap;"> 
					<a href="" style="font-weight:bold; color: #FFF; font-family: Helvetica, Tahoma, sans-serif;text-decoration: none;border-bottom: 2px solid #FFF;">All Vacation Tours</a>
				</div>
				<div class="ls-s-1" style="position: absolute; top:177px; left: 103px; slidedirection : top; slideoutdirection : top; durationin : 1000; durationout : 1000; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 800; delayout : 0; showuntil : 0; font-family: Tahoma,Helvetica sans-serif; font-size: 16px; font-weight: 600; color: #FFF; padding: 5px 20px 10px 20px;  white-space: nowrap;"> 
					<h1 style="display:inline-block;color: #e36f22;font-weight:bold;text-shadow: 0.5px 2px 8px #000;font-size:40px">Things to do,</h1><h1 style="font-size:40px;display:inline-block;color:#FFF;font-weight:bold;text-shadow: 0.5px 2px 8px #000;">all over Vietnam</h1>
					<form action="" id="things-to-do" class="form-horizontal" role="form">
						<div class="form-group">
							<div class="col-md-4">
								<label for="city">
									Where are you going ?
								</label>
							</div>
							<div class="col-md-4">
								<label for="city">
									Things to do ?
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">
								<select class="form-control">
									<option value="ho-chi-minh">Ho Chi Minh City</option>
								</select>
							</div>
							<div class="col-md-4">
								<select class="form-control">
									<option value="">All</option>
									<option value="">Cruises, Sailing & Water Tours</option>
									<option value="">Cultural & Theme Tours</option>
									<option value="">Day Trips & Excursions</option>
									<option value="">Food, Wine & Nightlife</option>
									<option value="">Walking & Biking Tours</option>
								</select>
							</div>
							<div class="col-md-2">
								<button type="button" id="letsgo-btn" class="btn">Let's go</button>		
							</div>
						</div>
					</form>
				</div>

				<div class="ls-s-1" style="position: absolute; top:35px; left: 0px; slidedirection : top; slideoutdirection : top; durationin : 1000; durationout : 1000; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 800; delayout : 0; showuntil : 0; font-family: 'Open Sans'; font-size: 14px; font-weight: 600; color: #FFF; padding: 5px 10px;  white-space: nowrap;"> 
					<div id="header-testimonial">
						<div class="avatar">
							<img src="<?=IMG_URL?>Carsten-Charlie-Okraglik.jpg" alt="">	
						</div>
						<div class="content">
							<div class="quote">"We had the most amazing honey moon trip"</div>
							<span><img height="15" src="<?=IMG_URL?>tour/icon/star5.png" alt="">Review by Eve from Berlin</span>
						</div>
					</div>
					<!-- end #header-testimonial -->
				</div>
			</div>
		</div>
	</div>

</header>
<!-- end header -->


<script type="text/javascript" src="<?=TPL_URL?>jquery/jquery.easing.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/jquery.transit.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/layerslider/js/layerslider.transitions.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#layerslider").layerSlider({
			width : '100%',
			height : '406px',
			responsive : true,
			responsiveUnder : 960,
			sublayerContainer : 960,
			autoStart : true,
			pauseOnHover : false,
			firstLayer : 1,
			animateFirstLayer : true,
			randomSlideshow : false,
			twoWaySlideshow : true,
			loops : 0,
			forceLoopNum : true,
			autoPlayVideos : true,
			autoPauseSlideshow : 'auto',
			youtubePreview : 'maxresdefault.jpg',
			keybNav : true,
			touchNav : true,
			skin : 'packagetour',
			skinsPath : 'http://themes.goodlayers2.com/tourpackage/wp-content/themes/packagetour/include/plugin/layerslider/skins/',
			globalBGColor : 'transparent',
			navPrevNext : true,
			navStartStop : true,
			navButtons : true,
			hoverPrevNext : true,
			hoverBottomNav : false,
			showBarTimer : false,
			showCircleTimer : true,
			thumbnailNavigation : 'disabled',
			tnWidth : 100,
			tnHeight : 60,
			tnContainerWidth : '60%',
			tnActiveOpacity : 35,
			tnInactiveOpacity : 100,
			imgPreload : true,
			yourLogo : false,
			yourLogoStyle : 'left: 10px; top: 10px;',
			yourLogoLink : false,
			yourLogoTarget : '_self',
			cbInit : function(element) { },
			cbStart : function(data) { },
			cbStop : function(data) { },
			cbPause : function(data) { },
			cbAnimStart : function(data) { },
			cbAnimStop : function(data) { },
			cbPrev : function(data) { },
			cbNext : function(data) { }
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function () {
		var click = false;
		$("#user-profile").click(function (e) {

			console.log(click);
			e.stopPropagation();
			var display = $('.profile-details').css('display');
			if (display == 'none') {
				$('.profile-details').css('display', 'block');
				click = true;

			} else {
				$('.profile-details').css('display', 'none');
				click = false;
			}
		});
		$(document).on('click', function (e) {
			var container = $(".profile-details");
			if (container.has(e.target).length === 0 && !container.is(e.target)) {
				if ($('.next').is(e.target) || $('.prev').is(e.target)) {
					if (click) {
						$('.profile-details').css('display', 'block');
					} else {
						$('.profile-details').css('display', 'none');
					}
				} else {
					$('.profile-details').css('display', 'none');
					click = false;
				}
			} else
				$('.profile-details').css('display', 'block');
		});

		$('#letsgo-btn').click(function() {
			window.location = "<?=site_url('tours/search')?>?smode=filter&destination[]=16";
		});

	});
</script>