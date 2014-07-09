<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/gdl-custom-slider.css" rel="stylesheet" />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>

<style type="text/css">
.custom-slider-nav-outside {
	display: <?=sizeof($photos) > 1 ? "block" : "none"?>;
}
</style>
<script type="text/javascript">
	var map;
	var mapshown = false;

	function initialize() {
		var options = {
			zoom:12,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("mapcanvas"), options);
		geoclient = new google.maps.Geocoder();
	    geoclient.geocode({'address': '<?=$item->address?>'}, function(results, status){
	        if(status == google.maps.GeocoderStatus.OK){
	            map.setCenter(results[0].geometry.location);
	            var marker = new google.maps.Marker({
	                map: map,
	                position: results[0].geometry.location,
	                title : '<?=$item->address?>'
	            });
	        }
	    });
	}

	function showTab(index) {
		var tabs  = new Array("tab1", "tab2", "tab3", "tab4", "tab5");
		var navs  = new Array("nav1", "nav2", "nav3", "nav4", "nav5");
		for (var i=0; i<tabs.length; i++) {
			if (i == index){
				$("#"+navs[i]).addClass('selected');
				$("#"+tabs[i]).fadeIn("slow");
			} else {
				$("#"+navs[i]).removeClass('selected');
				$("#"+tabs[i]).hide();
			}
		}
		if (index == 1 && !mapshown) {
			initialize();
			mapshown = true;
		}
	}

	$(document).ready(function() {
		$("#showmap").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 700,
				height: 600
			});
			return false;
		});
		$("#reportus").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 700,
				height: 600
			});
			return false;
		});
		$("#invitefriend").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 700,
				height: 600
			});
			return false;
		});
		$("#addtowall").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 700,
				height: 400
			});
			return false;
		});
	});
</script>
<div id="breadcrumbs">
	<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
	<img alt="" src="<?=IMG_URL?>arrow.png">
	<a class="pathway" title="Visa" href="<?=site_url("hotels")?>">Hotels</a>
	<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->name?>
	<? require_once(APPPATH."views/module/social.php"); ?>
</div>
<div id="hotel-view">
	<div class="hotelname">
		<h1><?=$item->name?> <img src="<?=IMG_URL?>trans.gif" title="<?=$item->name?>" alt="<?=$item->name?>" class="starhotel star<?=$item->star?>"></h1>
	</div>
	<div class="address"><?=$item->address?> (<a href="<?=site_url("hotels/map/".$item->alias)?>" id="showmap">View map <img class="vnhotels imap" alt="" title="" src="<?=IMG_URL?>map-ticker-16.png"></a>)</div>
	<div>
		<div class="left">
			<div class="pricepanel">
				<div class="header">
					<div class="saleprice">From <span>$<?=$item->price?></span>/night</div>
					<div class="clr"></div>
				</div>
				<div class="content">
					<div class="values">
						<div class="left">
							<div class="label">Value</div>
							<div class="value">$<?=$item->price?></div>
						</div>
						<div class="right">
							<div class="label">You Save</div>
							<div class="value">$<?=$item->original_price-$item->price?></div>
						</div>
						<div class="right">
							<div class="label">Discount</div>
							<div class="value"><?=round((($item->original_price-$item->price)/$item->original_price)*100)?>%</div>
						</div>
						<div class="clr"></div>
					</div>
					<div class="separator"></div>
					<div class="requency">
						Availability : Daily
					</div>
					<div class="separator"></div>
					<div class="invite">
						<a title="Invite a friend" href="">Invite a friend</a>
					</div>
					<div class="separator"></div>
					<div class="share">
						<a title="Share a photo" href="">Share a photo</a>
					</div>
					<div class="separator"></div>
					<div class="rating">
						<div class="left">Overall rating :</div>
						<div class="left" style="margin-left: 6px"><img alt="" src="<?=IMG_URL?>star<?=$avg_rating?>.png"></div>
						<div class="clr"></div>
					</div>
					<div class="btnservice">
					</div>
					<div class="checkrate-button">
						<a title="Book Now" href="<?=site_url("hotels/booking/".$item->alias)?>">Book Now</a>
					</div>
				</div>
			</div>
			<div class="amenities">
				<div class="title">
					<div class="text">Amenities</div>
				</div>
				<?=$item->amenities?>
				<div class="clr"></div>
			</div>
		</div>
		<div class="right">
			<div class="b-images">
				<div id="gdl-custom-slider" >
					<ul class="slides">
						<? foreach ($photos as $photo) { ?>
						<li>
							<div class="custom-slider-image" style="background: url('<?=$photo->file_path?>') 50% 50% no-repeat;"></div>
							<div class="custom-slider-caption-wrapper container gdl-slider-font">
								<div class="columns">
									<? if (!empty($photo->description)) { ?>
									<div class="custom-slider-caption">
										<div><?=$photo->description?></div>
									</div>
									<? } ?>
									<? if (!empty($photo->name)) { ?>
									<div class="custom-slider-title">
										<div><?=$photo->name?></div>
									</div>
									<? } ?>
								</div>
							</div>
						</li>
						<? } ?>
					</ul>
					<div class="custom-slider-nav-outside">
						<div id="custom-slider-nav"></div>
						<div class="clr"></div>
					</div>
				</div>
			</div>
			<div class="personalization-bar">
				<div class="personalization-bar-container">
					<div class="button left"><a id="invitefriend" title="Invite a friend" href="<?=site_url("invite/hotel/".$item->alias)?>">Invite a friend</a></div>
					<div class="button left"><a id="addtowall" title="Add to your wall" href="https://www.facebook.com/sharer/sharer.php?u=<?=site_url("hotels/vietnam/{$item->city_alias}/{$item->alias}")?>">Add to your wall</a></div>
					<div class="right">
						<div class="addthis_toolbox addthis_default_style" style="height: 20px; margin-top: 5px; overflow: hidden;">
							<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
							<a class="addthis_button_tweet"></a>
							<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
							<a class="addthis_counter addthis_pill_style"></a>
						</div>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51bebb7f7f132dfb"></script>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<div id="hotel-view-detail">
				<ul class="tabs">
					<li><a id="nav1" href="javascript:void(0)" class="selected" onclick="showTab(0)">Summary</a></li>
					<li><a id="nav2" href="javascript:void(0)" onclick="showTab(1)">Map</a></li>
					<li><a id="nav3" href="javascript:void(0)" onclick="showTab(2)">Check Rates</a></li>
					<li><a id="nav4" href="javascript:void(0)" onclick="showTab(3)">Questions</a></li>
					<li><a id="nav5" href="javascript:void(0)" onclick="showTab(4)">Reviews</a></li>
				</ul>
				<div class="clr"></div>
				<div id="tab1" class="tab-selected">
					<div class="hotel-info-container">
						<div class="left">
							<div class="description"><?=$item->summary?></div>
							<div class="clr"></div>
						</div>
						<div class="right">
						    <div class="price">
						    	<? if($item->original_price != $item->price) { ?>
						    	Normal: <del>$<?=$item->original_price?></del><br>
						    	<? } ?>
								Our: only from <b>$<?=$item->price?></b>
							</div>
						    <div class="boxbook">
								<a title="Book Now" class="btnbook" href="<?=site_url("hotels/booking/".$item->alias)?>">Book Now</a>
							</div>
						</div>
						<div class="clr"></div>
					</div>
					<div class="box-highlight">
						<div class="top-highlight">Hotel features</div>
						<div id="info-highlight" class="info-highlight">
					        <?=$item->highlight?>
					        <div class="clr"></div>
					    </div>
					</div>
					<div class="hotel-detail">
						<?=$item->detail?>
						<div class="clr"></div>
					</div>
				</div>
				<div id="tab2" class="tab-content">
					<div class="googlemap">
						<div id="mapcanvas"></div>
					</div>
					<div class="clr"></div>
				</div>
				<div id="tab3" class="tab-content">
					<div class="con_pri_inc">
						<span class="tit_pri">Price Per Night in US Dollars&nbsp; <a class="low_price"><img class="png" src="<?=IMG_URL?>value-guarantee.png"></a></span> 
						<div class="pricetable">
							<table width="100%" cellspacing="0" cellpadding="0" border="0">
								<tbody>
									<tr class="th">
										<td class="first"><strong>Room Type</strong></td>
										<td><strong>Price</strong></td>
									</tr>
									<? foreach ($rooms as $room) { ?>
									<tr>
										<td class="first"><?=$room->name?> (<?=$room->room_type?>)</td>
										<td>$<?=$room->price?></td>
									</tr>
									<? } ?>
								</tbody>
							</table>
						</div>
						<? foreach ($rooms as $room) { ?>
						<div class="cont room-wrapper expanded interstitial-expanded">
							<div class="room">
								<div class="room-summary">
									<h3><span class="toggle"></span><?=$room->name?></h3>
								</div>
								<div class="room-content-wrapper">
									<div class="room-detail-rates">
										<div class="room-details">
											<ul class="room-images">
												<li>
													<span>
													<img width="160px" height="90px" alt="" src="<?=$room->thumbnail?>">
													</span>
												</li>
											</ul>
											<ul class="room-occupancy" title="">
												<li title="" class="title_tooltip" style="cursor: help;">
													<span class="icon adult"></span>
												<? if ($room->room_type != "Single") { ?>
													<span class="icon adult"></span>
												<? } ?>
												</li>
											</ul>
										</div>
										<div class="room-rates">
											<table class="" summary="Rate plans available for this room">
												<tbody>
													<tr class="rate_0">
														<td class="rate-features">
															<ul title="">
																<? if ($room->breakfast == 1) { ?>
																	<li title="" class="breakfast title_tooltip LCS-361" style="cursor: help;">
																		<span class="hint">Breakfast available</span>
																	</li>
																<? } else if ($room->breakfast == 2) { ?>
																	<li title="" class="breakfast title_tooltip LCS-361" style="cursor: help;">
																		<span class="hint">FREE breakfast</span>
																	</li>
																<? } ?>
																<? if ($room->wifi == 1) { ?>
																	<li title="" class="wifi title_tooltip LCS-2404" style="cursor: help;">
																		<span class="hint">WiFi available</span>
																	</li>
																<? } else if ($room->wifi == 2) { ?>
																	<li title="" class="wifi title_tooltip LCS-2404" style="cursor: help;">
																		<span class="hint">FREE WiFi</span>
																	</li>
																<? } ?>
															</ul>
														</td>
														<td class="rate-pricing">
															<div class="rate-pricing-wrapper has-old-price">
																<div class="current-price" style="text-align: right">
																	<? if ($room->original_price > $room->price) { ?>
																	<del class="old_price">$<?=$room->original_price?></del>
																	<? } ?>
																	<strong>$<?=$room->price?></strong>
																	<span class="icon_info"></span>
																	<div class="pricing-basis" style="text-align: right">
																	average nightly rate</div>
																</div>
																<div class="boxbook">
																	<a class="btnbook" title="Book Now" href="<?=site_url("hotels/booking/".$item->alias)?>">Book Now</a>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
											<div style="padding: 10px">
												<div>
													<a href="javascript:void(0)" onclick="$('#room-policies-<?=$room->id?>').toggle()">&raquo; Policies</a>
												</div>
												<div id="room-policies-<?=$room->id?>" class="room-policies">
													<div class="content">
														<?=$room->policies?>
													</div>
												</div>
											</div>
										</div>
										<div class="additional-details-cta">
											<a class="cta" href="javascript:void(0)" onclick="$('#room-information-<?=$room->id?>').toggle()">
											&raquo; Show room information</a>
										</div>
									</div>
									<div id="room-information-<?=$room->id?>" class="room-information">
										<div class="cont content">
											<?=$room->detail?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<? } ?>
					</div>
					<div class="clr"></div>	
				</div>
				<div id="tab4" class="tab-content">
					<?=$questions?>
				</div>
				<div id="tab5" class="tab-content">
					<?=$reviews?>
				</div>
			</div>
			
			<div class="opinionlab-bottom clr">
				<a id="reportus" title="Is the description of this hotel not correct? Tell us" href="<?=site_url("report/hotel/".$item->alias)?>">&raquo; Is the description of this hotel not correct? Tell us</a>
			</div>
			
			<div id="stand-behide">
				<h1>WE STAND BEHIDE YOUR JOURNEY</h1>
				<div class="arrow"></div>
				<div class="content">
					<div class="promise">
						<a href=""></a>
						<img src="<?=IMG_URL?>travelovietnam.png" alt="The TraveloVienam Promise">
						<p class="groupon_promise">We're confident in the businesses we feature on TraveloVietnam and back them with the TraveloVietnam Promise.</p>
					</div>
					<ul class="left">
						<li>
							<div class="checkmark"></div>
							<strong>Handpicked Destinations.</strong> Our travel experts and writers research every getaway for you.
							<div class="clr"></div>
						</li>
						<li>
							<div class="checkmark"></div>
							<strong>Unbeatable Deals.</strong> We negotiate directly with hotels and resorts to get you the deepest discount available &mdash; as only TraveloVietnam can.
							<div class="clr"></div>
						</li>
						<li>
							<div class="checkmark"></div>
							<strong>Booking Guarantee.</strong> If you're unable to book the stay you want, during the available dates and before the book-by date, we'll give you a refund.
							<div class="clr"></div>
						</li>
					</ul>
					<div class="clr"></div>
				</div>
			</div>
			<div id="more-items">
				<h1>More Great Hotels</h1>
				<div class="container">
					<div class="nav">
						<ul class="left">
							<li><strong>You may also like...</strong></li>
						</ul>
						<div class="right">
							<a class="viewmore" href="">View all &raquo;</a>
						</div>
						<div class="clr"></div>
					</div>
					<div class="list" id="agile_related_items"></div>
					<div class="clr"></div>
				</div>
			</div>
			<? require_once(APPPATH."views/module/hotel/quick_finder.php"); ?>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div class="clr"></div>

<script type='text/javascript'>
	var FLEX   = {"animation":"fade","pauseOnHover":"disable","controlNav":"enable","directionNav":"enable","animationDuration":"600","slideshowSpeed":"7000","pauseOnAction":"disable","controlsContainer":".flexslider"};
	var CUSTOM = {"speed":"600","timeout":"10000"};
</script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.custom-slider.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.cycle.js"></script>


<link rel="stylesheet" href="<?=TPL_URL?>jquery/css/agile-carousel.css" type='text/css'>
<script src="<?=TPL_URL?>jquery/js/agile-carousel.alpha.js"></script>
<script>
	$(document).ready(function(){
		var data = [];
        
        <?	for ($i=0; $i<sizeof($more_hotels); $i++) {
				$hotel = $more_hotels[$i];
		?>
				data[<?=$i?>] = {
					"content": "<div class='slide_inner'><p class='thumb'><a title='<?=$hotel->name?>' href='<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>'><img alt='<?=$hotel->name?>' src='<?=$hotel->thumbnail?>'/></a></p><h3 class='tourname'><a title='<?=$hotel->name?>' href='<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>'><?=$hotel->name?></a></h3><p class='price'><label>From:</label> $<?=$hotel->price?></p></div>",
					"content_button": "<p class='thumb'><a title='<?=$hotel->name?>' href='<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>'><img alt='<?=$hotel->name?>' src='<?=$hotel->thumbnail?>'/></a></p>"
				};
		<?	} ?>
		
		$("#agile_related_items").agile_carousel({
			carousel_data: data,
			carousel_outer_height: 210,
			carousel_height: 200,
			slide_width: 172,
			number_slides_visible: 4,
			transition_time: 330,
			control_set_1: "previous_button,next_button",
			control_set_2: "group_numbered_buttons"
		});
	});
</script>