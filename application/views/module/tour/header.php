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
<div id="header">
	<div id="banner">
		<div class="inner">
			<div id="logo">
				<a title="travelovietnam.com" href="<?=BASE_URL?>"><img alt="travelovietnam" src="<?=IMG_URL?>travelovietnam.png" /></a>
			</div>
			<div id="topmenu">
				<ul>
					<? if (isset($user)) { ?> 
					<li>Hi,</li>
					<li class="user-profile">
						<a id="user-profile"><div><?=isset($user)?$user['fullname']:''?></div></a>
						<div class="profile-details">
							<div class="profile-content">
								<a href="<?=site_url('member/myaccount')?>">
									<div class="profile-image">
										<img src="<?=!empty($user['avatar'])?str_replace("http://", PROTOCOL, $user['avatar']):IMG_URL.'member/user-picture.png'?>" alt="<?=$user['fullname']?>">
									</div>
								</a>
								<div class="profile-info">
									<div class="profile-fullname"><?=$user['fullname']?></div>
									<div class="profile-email"><?=$user['email']?></div>
									<div class="profile-button"><a href="<?=site_url('member/myprofile')?>">View Profile</a></div>
								</div><!-- .profile-info -->
							</div><!-- .profile-content -->
							<div class="profile-footer">
								<a href="<?=site_url('member/logout')?>">
									<img src="<?=IMG_URL?>member/profile-icon/logout.png">
									<span>Sign out</span>									
								</a>								
								<a class="btn-ticket" href="<?=site_url('help/mytickets')?>">
									<img src="<?=IMG_URL?>member/profile-icon/ticket.png">
									<span>My Tickets</span>
								</a>
								<a class="btn-order" href="<?=site_url('member/myaccount')?>">
									<img src="<?=IMG_URL?>member/profile-icon/order.png">
									<span>My Orders</span>
								</a>
							</div><!-- .profile-footer -->
						</div><!-- .profile-details -->
					</li>
					<!-- <li>|</li>
					<li><a title="My Account" href="<?=site_url("member/myaccount")?>">My Account</a></li> -->
					<? } else { ?>
						<li><a title="Sign In" href="<?=site_url("member/login")?>">Sign In</a></li>
					<? } ?>
					<li>|</li>
					<li><a title="Customer Support" href="<?=site_url("help")?>">Customer Support</a></li>
					<li>|</li>
					<li class="phone last"><a title="Toll Free" href="tel:<?=TOLL_FREE?>"><?=TOLL_FREE?></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="mainmenu">
		<div class="inner">
			<ul id="megamenu" class="megamenu">
				<li class="first <?=((empty($tabindex) || $tabindex == "tour")?"active":"")?>">
					<a href="<?=site_url("tours/search")?>">VIETNAM TOURS</a>
					<div id="regions-submenu" class="submenu">
						<div class="regions">
							<div class="region">
								<a title="Throughout Vietnam" href="<?=site_url("tours/vietnam/throughout-vietnam")?>">
									<div class="label">Throughout Vietnam Tours</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/throughout-vietnam.jpg">
									</div>
								</a>
							</div>
							<div class="region">
								<a title="Northern Vietnam" href="<?=site_url("tours/vietnam/northern-vietnam")?>">
									<div class="label">Northern Vietnam Tours</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/northern-vietnam.jpg">
									</div>
								</a>
							</div>
							<div class="region">
								<a title="Central Vietnam" href="<?=site_url("tours/vietnam/central-vietnam")?>">
									<div class="label">Central Vietnam Tours</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/central-vietnam.jpg">
									</div>
								</a>
							</div>
							<div class="region last">
								<a title="Southern Vietnam" href="<?=site_url("tours/vietnam/southern-vietnam")?>">
									<div class="label">Southern Vietnam Tours</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/southern-vietnam.jpg">
									</div>
								</a>
							</div>
							<div class="clr"></div>
						</div>
						<div class="tourtypes">
							<div class="title">Themes</div>
							<div class="tourtype first">
								<a title="Signtseeing" href="<?=site_url("tours/vietnam/style/sightseeing")?>">
									<div class="img sightseeing"></div>
									<div class="label">Sightseeing</div>
								</a>
							</div>
							<div class="tourtype">
								<a title="Culture" href="<?=site_url("tours/vietnam/style/culture")?>">
									<div class="img culture"></div>
									<div class="label">Culture</div>
								</a>
							</div>
							<div class="tourtype">
								<a title="History" href="<?=site_url("tours/vietnam/style/history")?>">
									<div class="img historic"></div>
									<div class="label">History</div>
								</a>
							</div>
							<div class="tourtype">
								<a title="Nature" href="<?=site_url("tours/vietnam/style/nature")?>">
									<div class="img nature"></div>
									<div class="label">Nature</div>
								</a>
							</div>
							<div class="tourtype">
								<a title="Beach" href="<?=site_url("tours/vietnam/style/beach")?>">
									<div class="img beach"></div>
									<div class="label">Beach</div>
								</a>
							</div>
							<div class="tourtype">
								<a title="Trekking" href="<?=site_url("tours/vietnam/style/trekking")?>">
									<div class="img trekking"></div>
									<div class="label">Trekking</div>
								</a>
							</div>
							<div class="tourtype">
								<a title="Gastronomy" href="<?=site_url("tours/vietnam/style/gastronomy")?>">
									<div class="img gastronomy"></div>
									<div class="label">Gastronomy</div>
								</a>
							</div>
							<div class="tourtype">
								<a title="Cruise" href="<?=site_url("tours/vietnam/style/cruise")?>">
									<div class="img cruise"></div>
									<div class="label">Cruise</div>
								</a>
							</div>
							<div class="tourtype">
								<a title="Family" href="<?=site_url("tours/vietnam/style/family")?>">
									<div class="img family"></div>
									<div class="label">Family</div>
								</a>
							</div>
							<div class="tourtype last">
								<a title="Homestay" href="<?=site_url("tours/vietnam/style/homestay")?>">
									<div class="img homestay"></div>
									<div class="label">Homestay</div>
								</a>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				</li>
				<li class="<?=((!empty($tabindex) && $tabindex == "destination")?"active":"")?>">
					<a title="Vietnam Top Destinations" href="<?=site_url("vietnam/top-destinations")?>">DESTINATIONS</a>
					<div id="destinations-submenu" class="submenu">
						<div class="destinations">
							<a title="Hanoi" href="<?=site_url("vietnam/top-destinations/ha-noi")?>">
								<div class="des-hanoi">
									<img title="Hanoi" alt="Hanoi" src="<?=IMG_URL?>tour/destination/hanoi.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Hanoi &amp; Vicinity</span>
								</div>
							</a>
							<a title="Mai Chau" href="<?=site_url("vietnam/top-destinations/mai-chau")?>">
								<div class="des-nwne">
									<img title="Mai Chau" alt="Mai Chau" src="<?=IMG_URL?>tour/destination/mucangchai.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Mai Chau</span>
								</div>
							</a>
							<a title="Sapa" href="<?=site_url("vietnam/top-destinations/sapa")?>">
								<div class="des-nhatrang">
									<img title="Sapa" alt="Sapa" src="<?=IMG_URL?>tour/destination/sapa.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Sapa</span>
								</div>
							</a>
							<a title="HaLong bay" href="<?=site_url("vietnam/top-destinations/ha-long")?>">
								<div class="des-halong">
									<img titile="HaLong bay" alt="HaLong bay" src="<?=IMG_URL?>tour/destination/halong.jpg">
									<span class="bgblack"></span>
									<span class="namedes">HaLong bay</span>
								</div>
							</a>
							<a title="Hue" href="<?=site_url("vietnam/top-destinations/hue")?>">
								<div class="des-hue">
									<img title="Hue" alt="Hue" src="<?=IMG_URL?>tour/destination/hue.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Hue</span>
								</div>
							</a>
							<a title="Da Nang" href="<?=site_url("vietnam/top-destinations/da-nang")?>">
								<div class="des-sapa">
									<img title="Da Nang" alt="Da Nang" src="<?=IMG_URL?>tour/destination/danang.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Da Nang</span>
								</div>
							</a>
							<a title="Hoian" href="<?=site_url("vietnam/top-destinations/hoi-an")?>">
								<div class="des-hoian">
									<img title="Hoian" alt="Hoian" src="<?=IMG_URL?>tour/destination/hoian.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Hoi An</span>
								</div>
							</a>
							<a title="Nha Trang" href="<?=site_url("vietnam/top-destinations/nha-trang")?>">
								<div class="des-mekong">
									<img title="Nha Trang" alt="Nha Trang" src="<?=IMG_URL?>tour/destination/nhatrang.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Nha Trang</span>
								</div>
							</a>
							<a title="Phan Thiet" href="<?=site_url("vietnam/top-destinations/phan-thiet")?>">
								<div class="des-cambodia">
									<img title="Phan Thiet" alt="Phan Thiet" src="<?=IMG_URL?>tour/destination/phanthiet.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Phan Thiet</span>
								</div>
							</a>
							<a title="Cu Chi Tunnel" href="<?=site_url("vietnam/top-destinations/cu-chi")?>">
								<div class="des-lao">
									<img title="Cu Chi Tunnel" alt="Cu Chi Tunnel" src="<?=IMG_URL?>tour/destination/cuchi.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Cu Chi Tunnel</span>
								</div>
							</a>
							<a title="Mekong Delta" href="<?=site_url("vietnam/top-destinations/mekong-delta")?>">
								<div class="des-burmar">
									<img title="Mekong Delta" alt="Mekong Delta" src="<?=IMG_URL?>tour/destination/mekong.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Mekong Delta</span>
								</div>
							</a>
							<a title="Ho Chi Minh city" href="<?=site_url("vietnam/top-destinations/ho-chi-minh")?>">
								<div class="des-hcm">
									<img title="Ho Chi Minh city" alt="Ho Chi Minh city" src="<?=IMG_URL?>tour/destination/hochiminh.jpg">
									<span class="bgblack"></span>
									<span class="namedes">Ho Chi Minh City &amp; Vicinity</span>
								</div>
							</a>
						</div>
						<div class="clr"></div>
						<div class="all-destination">
							<a title="View all trips" href="<?=site_url("vietnam/top-destinations")?>">Explore all destinations</a>
						</div>
					</div>
				</li>
				<li class="<?=((!empty($tabindex) && $tabindex == "planning")?"active":"")?>">
					<a href="<?=site_url("tours/planning")?>">PLANNING</a>
					<div class="empty"></div>
				</li>
				<li class="<?=((!empty($tabindex) && $tabindex == "travel-guide")?"active":"")?>">
					<a>TRAVEL GUIDE</a>
					<div class="handbook-submenu">
						<div style="padding: 20px;">
							<ul>
								<li class="megaheading">About Vietnam</li>
								<li>
									<ul>
										<li><a title="Vietnam Overview" href="<?=site_url("vietnam/overview")?>">Vietnam Overview</a></li>
										<li><a title="Best Time to Visit Vietnam" href="<?=site_url("vietnam/snapshot")?>">Best Time to Visit Vietnam</a></li>
										<li><a title="Vietnam Culture & History" href="<?=site_url("vietnam/culture-geography-history")?>">Vietnam Culture & History</a></li>
										<li><a title="Vietnam Festivals & Events" href="<?=site_url("vietnam/festivals-events")?>">Vietnam Festivals & Events</a></li>
										<li><a title="Vietnam Life Style" href="<?=site_url("vietnam/life-style")?>">Vietnam Life Style</a></li>
									</ul>
								</li>
							</ul>
							<ul>
								<li class="megaheading">Need To Know</li>
								<li>
									<ul>
										<li><a title="Vietnam Travel Guide for Beginner" href="<?=site_url("vietnam/travel-guide-for-beginner")?>">Travel Guide for Beginner</a></li>
										<li><a title="Vietnam Travel Tips" href="<?=site_url("vietnam/travel-tips")?>">Vietnam Travel Tips</a></li>
										<li><a title="Vietnam Travel Insurances" href="<?=site_url("vietnam/travel-insurances")?>">Travel Insurances</a></li>
										<li><a title="Vietnam Visa for Travel" href="<?=site_url("vietnam/travel-visa")?>">Vietnam Visa for Travel</a></li>
										<li><a title="Vietnam FAQ & Information" href="<?=site_url("vietnam/faqs")?>">FAQ & Information</a></li>
									</ul>
								</li>
							</ul>
							<ul>
								<li class="megaheading">Things To Do</li>
								<li>
									<ul>
										<li><a title="Sights" href="<?=site_url("vietnam/sights")?>">Sights</a></li>
										<li><a title="Entertainment" href="<?=site_url("vietnam/entertainments")?>">Entertainment</a></li>
										<li><a title="Restaurants" href="<?=site_url("vietnam/restaurants")?>">Restaurants</a></li>
										<li><a title="Shopping" href="<?=site_url("vietnam/shopping")?>">Shopping</a></li>
									</ul>
								</li>
							</ul>
							<div class="clr"></div>
						</div>
					</div>
				</li>
				<li>
					<a>EXTRA SERVICES</a>
					<div id="ex-service-submenu" class="submenu">
						<div class="ex-service-submenu-content">
							<div class="ex-service">
								<a title="Vietnam Hotel Booking" target="_blank" href="<?=site_url("hotels")?>">
									<div class="label">Hotel Booking</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/hotel.jpg">
									</div>
								</a>
							</div>
							<div class="ex-service">
								<a title="Vietnam Flight Booking" target="_blank" href="<?=site_url("flights")?>">
									<div class="label">Flight Booking</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/flight.jpg">
									</div>
								</a>
							</div>
							<div class="ex-service">
								<a title="Vietnam Visa on Arrival" target="_blank" href="<?=site_url("visa")?>">
									<div class="label">Visa on Arrival</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/visa.jpg">
									</div>
								</a>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				</li>
				<li class="<?=((!empty($tabindex) && $tabindex == "blog")?"active":"")?>">
					<a href="<?=site_url("blog")?>">BLOG</a>
					<div class="empty"></div>
				</li>
				<li class="<?=((!empty($tabindex) && $tabindex == "support")?"active":"")?>">
					<a href="<?=site_url("help")?>">CONTACT</a>
					<div id="support-submenu" class="submenu">
						<div class="support-submenu-content">
							<div class="support">
								<a title="About travelovietnam" href="<?=site_url("about")?>">
									<div class="label">About travelovietnam</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/about-travelovietnam.jpg">
									</div>
								</a>
							</div>
							<div class="support">
								<a title="Contact information" href="<?=site_url("help")?>">
									<div class="label">Contact information</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/contact.jpg">
									</div>
								</a>
							</div>
							<div class="support">
								<a title="Support center" href="<?=site_url("help/support")?>">
									<div class="label">Support center</div>
									<div class="img">
										<img title="" alt="" src="<?=IMG_URL?>tour/menu/support.jpg">
									</div>
								</a>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="clr"></div>
	</div>
</div>

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