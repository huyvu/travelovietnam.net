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

<div class="slideshow">
	<div id="ca-container" class="ca-container">
		<div class="ca-wrapper">
			<? foreach ($featured_tours as $item) {
				$photo_info = new stdClass();
				$photo_info->category_id = 1;
				$photo_info->ref_id = $item->id;
				$photos = $this->m_photo->getItems($photo_info, 1);
			?>
			<div class="ca-item">
				<div class="ca-item-main">
					<div class="ttpano">
						<span id="titlepano"><?=$item->name?></span>
						<span class="ttpano-help" id="formpano">
							<?=$item->summary?>
							<p class="link"><a title="Read more" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>" class="readmore">Read more</a></p>
						</span>
					</div>
					<img alt="<?=$item->name?>" title="<?=$item->name?>" src="<?=$photos[0]->file_path?>" />
				</div>
			</div>
			<? } ?>
		</div>
	</div>
	<script type="text/javascript">
		$('#ca-container').contentcarousel();
	</script>
</div>
<div class="windows">
	<div class="inner">
		<ul id="windows-ca">
			<li>
				<div id="support-online-widget">
					<div class="support-online-widget-title">SUPPORT ONLINE</div>
					<div class="support-online-widget-content">
						<table>
							<tr>
								<td>Toll free</td><td>:</td><td><?=TOLL_FREE?></td>
							</tr>
							<tr>
								<td>Hotline</td><td>:</td><td><?=HOTLINE?></td>
							</tr>
							<tr>
								<td colspan="3">
									<div id="subiz_status"></div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</li>
			<li>
				<div id="introducing-vietnam">
					<div class="introducing-vietnam-title"><a title="Introducing Vietnam" href="<?=site_url("vietnam/overview")?>">INTRODUCING VIETNAM</a></div>
					<div class="introducing-vietnam-content">
						Welcome to a world where the colours are more vivid, where the landscapes are bolder, the coastline more dramatic, where the history is more compelling, where the tastes are more divine, where life is lived in the fast lane.
						This world is Vietnam, the latest Asian dragon to awake from its slumber. Nature has blessed Vietnam with a bountiful harvest of soaring mountains, a killer coastline and radiant rice ...
					</div>
					<div class="introducing-vietnam-view-more">
						<a title="Explore the Vietnam" href="<?=site_url("vietnam/overview")?>">Explore the Vietnam &raquo;</a>
					</div>
				</div>
			</li>
			<li>
				<div id="tour-search-widget">
					<div class="container">
						<form action="<?=site_url("tours/search")?>" method="GET">
							<h1 class="widget-title">SEARCH TOURS</h1>
							<div class="widget-content">
								<div class="clearfix">
									<p class="text-form w180">
										<label>Depart from</label>
										<select id="tour-fromcity" name="fromcity">
											<option value="">Any Where</option>
											<?
												$tour_destinations = $this->m_tour_destination->getItems(1);
												$new_destinations = array();
												foreach ($tour_destinations as $destination) {
													if ($destination->name == 'Ha Noi') {
														$new_destinations[] = $destination;
														break;
													}
												}
												foreach ($tour_destinations as $destination) {
													if ($destination->name == 'Ho Chi Minh') {
														$new_destinations[] = $destination;
														break;
													}
												}
												foreach ($tour_destinations as $destination) {
													if (!in_array($destination->name, array('Ha Noi', 'Ho Chi Minh'))) {
														$new_destinations[] = $destination;
													}
												}
												$tours = $this->m_tour->getItems(NULL, 1);
												foreach ($new_destinations as $destination) {
													foreach ($tours as $tour) {
														if ($tour->depart_from == $destination->id) {
															echo '<option value="'.$destination->id.'">'.$destination->name.'</option>';
															break;
														}
													}
												}
											?>
										</select>
									</p>
								</div>
								<div class="clearfix">
									<p class="text-form w180">
										<label>To Destinations</label>
										<select id="tour-tocity" name="tocity">
											<option value="">All Destinations</option>
										</select>
									</p>
								</div>
								<div class="clearfix">
									<p class="text-form w180">
										<label>Duration</label>
										<select name="duration">
											<option value="">Any Lenght</option>
											<option value="1-2">1 - 2 days</option>
											<option value="3-4">3 - 4 days</option>
											<option value="5-8">5 - 8 days</option>
											<option value="9-14">9 - 14 days</option>
											<option value="15-20">15 - 20 days</option>
											<option value="21-30">21 - 30 days</option>
											<option value="31-365">Over 31 days</option>
										</select>
									</p>
								</div>
								<div class="clearfix">
									<p class="text-form">
										<label>Tour theme</label>
										<select id="tour-category" name="category">
											<option value="">All Themes</option>
											<? foreach($categories as $category) {
												echo '<option value="'.$category->id.'">'.$category->name.'</option>';
											} ?>
										</select>
									</p>
								</div>
								<div class="clearfix">
									<div class="text-form" style="text-align: right; padding: 0px 10px">
										<input type="submit" class="search-button" value="SEARCH"/>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</li>
			<li>
				<div id="vietnam-top-destination">
					<div class="metro_gallery flip horizontal">
						<div class="tile tile_1x2">
							<div class="tile_link"><a title="Vietnam Top Destinations" href="<?=site_url("vietnam/top-destinations")?>"><img src="<?=IMG_URL?>tour/vietnam-top-destinations.jpg" data-caption="" /></a></div>
						</div>
					</div>
					<div class="vietnam-top-destination-title">
						<a title="Vietnam Top Destinations" href="<?=site_url("vietnam/top-destinations")?>">
							<span class="supper">VIETNAM</span><br>TOP DESTINATIONS
						</a>
					</div>
				</div>
			</li>
			<li>
				<div id="vietnam-photo-widget">
					<a title="Vietnam Photos" href="<?=site_url("vietnam/photos")?>">
						<div class="vietnam-photo-widget-title">
							PHOTOS
						</div>
					</a>
				</div>
				<div id="vietnam-video-widget">
					<a title="Vietnam Video" href="<?=site_url("vietnam/video")?>">
						<div class="vietnam-video-widget-title">
							VIDEO
						</div>
					</a>
				</div>
			</li>
			<li>
				<div id="discount-tour-widget">
					<div class="metro_gallery flip horizontal">
						<div class="tile tile_2x2">
							<? foreach ($promotion_tours as $item) {
								$photo_info = new stdClass();
								$photo_info->category_id = 1;
								$photo_info->ref_id = $item->id;
								if (empty($item->promotion_image)) {
									$photos = $this->m_photo->getItems($photo_info, 1);
									$item->promotion_image = $photos[0]->file_path;
								}
							?>
							<div class="discount-flip-item">
								<a title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>">
									<img src="<?=$item->promotion_image?>" data-caption="" width="350px" height="340px"/>
									<div class="discount-flip-title">
										<div class="title"><?=$item->name?></div>
										<div class="price"><label>from</label> $<span class="num"><?=$item->price?></span></div>
									</div>
								</a>
							</div>
							<? } ?>
						</div>
					</div>
					<div class="discount-tour-widget-title">
						<a title="Promotions Tours" href="<?=site_url("tours/promotions")?>">
							PROMOTION TOURS
						</a>
					</div>
				</div>
			</li>
			<li>
				<div id="customize-tour-widget">
					<div class="metro_gallery flip horizontal">
						<div class="tile tile_1x1">
							<div class="tile_link"><a title="Plan Your Trips" href="<?=site_url("tours/planning")?>"><img src="<?=IMG_URL?>tour/customize-tour.jpg" data-caption="" /></a></div>
						</div>
					</div>
					<div class="customize-tour-widget-title">
						<a title="Plan Your Trips" href="<?=site_url("tours/planning")?>">
							<div class="caption">PLAN YOUR TRIPS</div>
							<div class="sub-title">in Your Own Way...</div>
						</a>
					</div>
				</div>
			</li>
			<li>
				<div id="popular-tour-widget">
					<div class="metro_gallery flip horizontal">
						<div class="tile tile_2x1">
							<?
							if (0 && sizeof($popular_tours)) {
								foreach ($popular_tours as $item) { ?>
							<div class="">
								<a title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>">
									<img src="<?=IMG_URL?>tour/popular-tour.jpg" data-caption="" width="348px" height="164px"/>
								</a>
							</div>
							<?	}
							} else {
							?>
							<div class="">
								<a title="Popular Tours" href="<?=site_url("tours/popular")?>">
									<img src="<?=IMG_URL?>tour/popular-tour.jpg" data-caption=""/>
								</a>
							</div>
							<? } ?>
						</div>
					</div>
					<div class="popular-tour-widget-title">
						<a title="Popular Tours" href="<?=site_url("tours/popular")?>">
							POPULAR TOURS
						</a>
					</div>
				</div>
			</li>
			<li>
				<div id="thing-todo-widget">
					<div class="thing-todo-widget-title">THINGS TO DO</div>
					<div class="thing-todo-widget-content">
						<ul>
							<li>
								<a class="ttodo-sights" title="Vietnam Sights" href="<?=site_url("vietnam/sights")?>">Sights</a>
							</li>
							<li>
								<a class="ttodo-entertainment" title="Entertainment in Vietnam" href="<?=site_url("vietnam/entertainments")?>">Entertainment</a>
							</li>
							<li>
								<a class="ttodo-tours" title="Vietnam Restaurants" href="<?=site_url("vietnam/restaurants")?>">Restaurants</a>
							</li>
							<li>
								<a class="ttodo-shopping" title="Shopping in Vietnam" href="<?=site_url("vietnam/shopping")?>">Shopping</a>
							</li>
						</ul>
					</div>
				</div>
			</li>
			<li>
				<div id="need-toknow-widget">
					<div class="need-toknow-widget-icon"></div>
					<div class="need-toknow-widget-title">NEED TO KNOW</div>
					<div class="need-toknow-widget-content">
						<ul>
							<li>
								<a title="Vietnam Travel Guide for Beginner" href="<?=site_url("vietnam/travel-guide-for-beginner")?>">Guide for Beginner</a>
							</li>
							<li>
								<a title="Vietnam Travel Tips" href="<?=site_url("vietnam/travel-tips")?>">Vietnam Travel Tips</a>
							</li>
							<li>
								<a title="Vietnam Travel Insurances" href="<?=site_url("vietnam/travel-insurances")?>">Travel Insurances</a>
							</li>
							<li>
								<a title="Vietnam Visa for Travel" href="<?=site_url("vietnam/travel-visa")?>">Visa on Arrival</a>
							</li>
							<li>
								<a title="Vietnam FAQ & Information" href="<?=site_url("vietnam/faqs")?>">FAQ & Information</a>
							</li>
						</ul>
					</div>
				</div>
			</li>
			<li>
				<div id="testimonial-widget">
					<div class="testimonial-widget-title">CLIENT'S TESTIMONIALS</div>
					<div class="testimonial-widget-content">
						"We had the most amazing honeymoon trip in Vietnam thanks to you. There is no question the trip far exceeded our expectation. Thanks for the marvelous trip you arranged for me.
					</div>
					<div class="testimonial-widget-author">
						<img src="http://www.vietnam-evisa.org/template/images/star5.png" style="float:left" alt="rating">
						<span style="float:left; padding-left:6px"> by <b>Gary Brown</b></span>
						<div class="clr"></div>
					</div>
					<div class="testimonial-widget-view-more">
						<a title="" href="<?=site_url("testimonial")?>">View more &raquo;</a>
					</div>
				</div>
			</li>
			<li>
				<div id="voa-widget">
					<a title="Vietnam Visa on Arrival" target="_blank" href="<?=site_url("visa")?>">
						<div class="voa-widget-title">
							VIETNAM VISA
						</div>
					</a>
				</div>
			</li>
			<li>
				<div id="flight-widget">
					<a title="Vietnam Domestic Flights" target="_blank" href="<?=site_url("flights")?>">
						<div class="flight-widget-title">
							FLIGHTS
						</div>
					</a>
				</div>
			</li>
			<li>
				<div id="hotel-widget">
					<a title="Vietnam Hotels" target="_blank" href="<?=site_url("hotels")?>">
						<div class="hotel-widget-title">
							HOTELS
						</div>
					</a>
				</div>
			</li>
		</ul>
	</div>
</div>

<div class="clr"></div>

<style type="text/css">
div.tile {
	margin: 0px;
}
div.tile_1x2 {
	width: 170px;
	height: 340px;
}
div.tile_2x2 {
	width: 350px;
	height: 340px;
}
div.tile_1x1 {
	width: 280px;
	height: 165px;
}
div.tile_2x1 {
	width: 330px;
	height: 165px;
}
div.tile div.img_container {
	top: 0px;
	right: 0px;
	left: 0px;
	bottom: 0px;
}
div.tile_link {
	overflow: hidden !important;
}
</style>

<script>
	$(document).ready(function() {
		var rotation	= ['flipped-vertical-bottom', 'flipped-vertical-top', 'flipped-horizontal-left', 'flipped-horizontal-right'];
		var flipitems	= ['support-online-widget', 'introducing-vietnam', 'tour-search-widget', 'vietnam-top-destination', 'vietnam-photo-widget', 'vietnam-video-widget', 'discount-tour-widget', 'customize-tour-widget', 'popular-tour-widget', 'thing-todo-widget', 'need-toknow-widget', 'testimonial-widget', 'voa-widget', 'flight-widget', 'hotel-widget'];
		for (var i = 0; i < flipitems.length; i++) {
			var flipitem	= $('#'+flipitems[i]);
			//flipitem.addClass('none');
		}
		for (var i = 0; i < flipitems.length; i++) {
			for (var r = 0; r < 3; r++) {
				var random		= Math.floor(Math.random() * (3 - 0 + 1));
				var animation	= rotation[random];
				var flipitem	= $('#'+flipitems[i]);
				//flipitem.removeClass('none');
				//flipitem.addClass('animated ' + animation);
				//flipitem.on('transitionend webkitTransitionEnd MSTransitionEnd oTransitionEnd', function() { 
				//	$(this).removeClass();
				//});
			}
		}
	});
</script>