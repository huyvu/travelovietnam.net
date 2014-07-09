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

<div id="header">
	<div id="banner">
		<div id="logo">
			<a title="travelovietnam.com" href="<?=BASE_URL?>"><img alt="travelovietnam" src="<?=IMG_URL?>travelovietnam.png" /></a>
		</div>
		<div id="slogan">
			<img src="<?=IMG_URL?>slogan.png" />
		</div>
		<div id="topmenu">
			<ul>
				<li>Welcome!</li>
				<li>|</li>
				<li><a title="Sign In" href="<?=site_url("member/login")?>">Sign Up</a></li>
				<li>|</li>
				<li><a title="My Account" href="<?=site_url("member/myaccount")?>">My Account</a></li>
				<li>|</li>
				<li><a title="Customer Support" href="<?=site_url("contact")?>">Customer Support</a></li>
				<li>|</li>
				<li class="phone last"><a title="Toll Free" href="tel:<?=TOLL_FREE?>"><?=TOLL_FREE?></a></li>
			</ul>
		</div>
	</div>
	<div id="mainmenu">
		<ul id="megamenu" class="megamenu">
			<li class="first">
				<a href="<?=BASE_URL?>">HOME</a>
				<div class="empty"></div>
			</li>
			<li>
				<a href="<?=site_url("tours")?>">TOURS</a>
				<div class="empty"></div>
			</li>
			<li>
				<a href="<?=site_url("flights")?>">FLIGHTS</a>
				<div class="empty"></div>
			</li>
			<li>
				<a href="<?=site_url("hotels")?>">HOTELS</a>
				<div class="empty"></div>
			</li>
			<li>
				<a href="<?=site_url("visa")?>">VISA</a>
				<div class="megasubmenu" style="left:-108px;">
					<ul>
						<li class="megaheading">Visa on Arrival</li>
						<li>
							<ul>
								<li><a title="Vietnam Visa" href="<?=site_url("visa")?>">Vietnam Visa</a></li>
								<li><a title="Apply Visa Online" href="<?=site_url("visa/apply")?>">Apply Visa Online</a></li>
								<li><a title="Rush Visa" href="<?=site_url("visa/rush")?>">Rush Visa</a></li>
								<li><a title="Vietnam Visa Processing" href="<?=site_url("visa/processing")?>">Visa Processing</a></li>
								<li><a title="Vietnam Visa Fees" href="<?=site_url("visa/fees")?>">Visa Fees</a></li>
								<li><a title="Extra Services" href="<?=site_url("visa/services")?>">Extra Services</a></li>
								<li><a title="Vietnam Visa News" href="<?=site_url("visa/news")?>">Vietnam Visa News</a></li>
								<li><a title="Vietnam Embassies" href="<?=site_url("visa/vietnam-embassies")?>">Vietnam Embassies</a></li>
								<li><a title="Vietnam Visa Tips" href="<?=site_url("visa/tips")?>">Vietnam Visa Tips</a></li>
							</ul>
						</li>
					</ul>
					<ul>
						<li class="megaheading">Visa Extension</li>
						<li>
							<ul>
								<li><a title="Visa Extension" href="<?=site_url("visa/extension")?>">How to Extend the Visa ?</a></li>
								<li><a title="Visa Extension" href="<?=site_url("visa/extension")?>">Who Need to Extend ?</a></li>
								<li><a title="Visa Extension" href="<?=site_url("visa/extension")?>">Extend Visa Fees</a></li>
							</ul>
						</li>
					</ul>
					<ul>
						<li class="megaheading">Help Center</li>
						<li>
							<ul>
								<li><a title="FAQs" href="<?=site_url("visa/faqs")?>">FAQs</a></li>
								<li><a title="Question & Answers" href="<?=site_url("visa/answers")?>">Question &amp; Answers</a></li>
								<li><a title="Download Application Form" href="<?=site_url("visa/download-application-from")?>">Download Application Form</a></li>
								<li><a title="Payment Online" href="<?=site_url("visa/payment-online")?>">Payment Online</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</li>
			<li class="last">
				<a href="<?=site_url("contact")?>">CONTACT US</a>
				<div class="empty"></div>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>