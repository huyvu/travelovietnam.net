<script type="text/javascript">
	$(document).ready(function() {
		var $megamenu		= $('#megamenu');
		var $megamenu_items	= $megamenu.children('li');
		
		$megamenu_items.bind('mouseenter',function(){
			var $this = $(this);
			$this.addClass('slided selected');
			$this.children('div').css('z-index','9999').stop(true,true).slideDown(200,function(){
				$megamenu_items.not('.slided').children('div').hide();
				$this.removeClass('slided');
			});
		}).bind('mouseleave',function(){
			var $this = $(this);
			$this.removeClass('selected').children('div').css('z-index','1');
		});
		
		$megamenu.bind('mouseenter',function(){
			var $this = $(this);
			$this.addClass('hovered');
		}).bind('mouseleave',function(){
			var $this = $(this);
			$this.removeClass('hovered');
			$megamenu_items.children('div').hide();
		});
		
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

	<div id="slider">
	</div>
	<!--  end #slider -->
</header>
<!-- end header -->

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
	});
</script>