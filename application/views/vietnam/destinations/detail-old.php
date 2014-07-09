<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/jssor/css/gallery.css" />

<script type="text/javascript" src="<?=TPL_URL?>jquery/jssor/js/jssor.core.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/jssor/js/jssor.utils.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/jssor/js/jssor.slider.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {

	var _SlideshowTransitions = [
	//Fade in L
		{$Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
	//Fade out R
		, { $Duration: 1200, $SlideOut: true, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
	//Fade in R
		, { $Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
	//Fade out L
		, { $Duration: 1200, $SlideOut: true, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

	//Fade in T
		, { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
	//Fade out B
		, { $Duration: 1200, $SlideOut: true, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
	//Fade in B
		, { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
	//Fade out T
		, { $Duration: 1200, $SlideOut: true, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

	//Fade in LR
		, { $Duration: 1200, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
	//Fade out LR
		, { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
	//Fade in TB
		, { $Duration: 1200, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
	//Fade out TB
		, { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

	//Fade in LR Chess
		, { $Duration: 1200, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
	//Fade out LR Chess
		, { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 8, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
	//Fade in TB Chess
		, { $Duration: 1200, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
	//Fade out TB Chess
		, { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

	//Fade in Corners
		, { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }
	//Fade out Corners
		, { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }

	//Fade Clip in H
		, { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
	//Fade Clip out H
		, { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
	//Fade Clip in V
		, { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
	//Fade Clip out V
		, { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
		];

	var options = {
		$AutoPlay: true,
		$AutoPlayInterval: 5000,
		$PauseOnHover: 3,
		$DragOrientation: 3,
		$ArrowKeyNavigation: true,
		$SlideDuration: 800,

		$SlideshowOptions: {
			$Class: $JssorSlideshowRunner$,
			$Transitions: _SlideshowTransitions,
			$TransitionsOrder: 1,
			$ShowLink: true
		},

		$DirectionNavigatorOptions: {
			$Class: $JssorDirectionNavigator$,
			$ChanceToShow: 1
		},

		$ThumbnailNavigatorOptions: {
			$Class: $JssorThumbnailNavigator$,
			$ChanceToShow: 2,
			$ActionMode: 1,
			$SpacingX: 5,
			$DisplayPieces: 5,
			$ParkingPosition: 360
		}
	};

	var jssor_slider = new $JssorSlider$("slider_container", options);
	function ScaleSlider() {
		var parentWidth = jssor_slider.$Elmt.parentNode.clientWidth;
		if (parentWidth)
			jssor_slider.$SetScaleWidth(Math.max(Math.min(parentWidth, 680), 300));
		else
			window.setTimeout(ScaleSlider, 30);
	}
	
	ScaleSlider();
	
	if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
		$(window).bind('resize', ScaleSlider);
	}
});
</script>

<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/top-destinations")?>">Vietnam Top Destinations</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title"><?=$item->title?></h1>
	<div id="vietnam-destinations">
		<div class="destination">
			<div class="left slideshow">
				<div id="slider_container" style="position: relative; top: 0px; left: 0px; width: 680px; height: 445px; background: #191919; overflow: hidden;">
					<!-- Loading Screen -->
					<div u="loading" style="position: absolute; top: 0px; left: 0px;">
						<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color: #000000; top: 0px; left: 0px; width: 100%; height:100%;"></div>
						<div style="position: absolute; display: block; background: url(<?=TPL_URL?>jquery/jssor/img/loading.gif) no-repeat center center; top: 0px; left: 0px; width: 100%; height:100%;"></div>
					</div>
					<!-- Slides Container -->
					<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 680px; height: 350px; overflow: hidden;">
						<? for ($i=0; $i<sizeof($photos); $i++) { ?>
						<div class="slider_item">
							<img u="image" src="<?=$photos[$i]->file_path?>" />
							<img u="thumb" src="<?=$photos[$i]->file_path?>" />
							<div class="slider_text">
								<div class="title"><?=$photos[$i]->name?></div>
							</div>
						</div>
						<? } ?>
					</div>
					<!-- Arrow Left -->
					<span u="arrowleft" class="jssord05l" style="width: 40px; height: 40px; top: 158px; left: 8px;"></span>
					<!-- Arrow Right -->
					<span u="arrowright" class="jssord05r" style="width: 40px; height: 40px; top: 158px; right: 8px"></span>
					<!-- Direction Navigator Skin End -->
					<!-- Thumbnail Navigator Skin Begin -->
					<div u="thumbnavigator" class="jssort01" style="position: absolute; width: 680px; height: 100px; left:0px; bottom: 0px;">
						<div u="slides" style="cursor: move;">
							<div u="prototype" class="p" style="position: absolute; width: 140px; height: 74px; top: 0; left: 0;">
								<div class=w><thumbnailtemplate style="width: 100%; height: 100%; border: none; position: absolute; top: 0; left: 0;"></thumbnailtemplate></div>
								<div class=c></div>
							</div>
						</div>
					</div>
				</div>
				<img width=0 height=0 />
			</div>
			<div class="left highlights">
				<div class="title">OVERVIEW</div>
				<?=$item->highlight?>
			</div>
			<div class="clr"></div>
			<div style="margin-top: 20px">
				<div class="left detailed" style="width: 680px">
					<?=$item->content?>
					<div style="position:relative; margin: 10px 0; height: 30px">
						<? require(APPPATH."views/module/social.php"); ?>
					</div>
					<div class="clr"></div>
				</div>
				<div class="right">
					<div class="location">
						<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
						<script type="text/javascript">
							var map;
							$(document).ready(function() {
								var options = {
									zoom:10,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								};
								map = new google.maps.Map(document.getElementById("mapcanvas"), options);
								geoclient = new google.maps.Geocoder();
								geoclient.geocode({'address': '<?=$item->gmap_address?>'}, function(results, status){
									if(status == google.maps.GeocoderStatus.OK){
										map.setCenter(results[0].geometry.location);
										var marker = new google.maps.Marker({
											map: map,
											position: results[0].geometry.location,
											title : '<?=$item->gmap_address?>'
										});
									}
								});
							});
						</script>
						<script type="text/javascript">
							var map1;
							$(document).ready(function() {
								var options = {
									zoom:10,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								};
								map1 = new google.maps.Map(document.getElementById("mapcanvas-large"), options);
								geoclient = new google.maps.Geocoder();
								geoclient.geocode({'address': '<?=$item->gmap_address?>'}, function(results, status){
									if(status == google.maps.GeocoderStatus.OK){
										map1.setCenter(results[0].geometry.location);
										var marker = new google.maps.Marker({
											map: map1,
											position: results[0].geometry.location,
											title : '<?=$item->gmap_address?>'
										});
									}
								});
							});

						</script>
						<a href="#large-map"  class="large-map">
							<div class="googlemap">
								<div id="mapcanvas"></div>
							</div>
							<div class="map-mask"><img src="<?=IMG_URL?>icon-zoom.png"/><div></div></div>
						</a>
						<div style="display:none;">
							<div id="large-map" >
								<div id="mapcanvas-large" style="width:800px;height:560px"></div>
							</div><!--/#large-map -->
						</div>
						
					</div>
					<? require_once(APPPATH."views/module/tour/customize.php"); ?>
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
		<? if (sizeof($tours)) { ?>
		<div class="related-tours">
			<div id="top-destination-tours">
				<? $destination = $this->m_tour_destination->load($item->destination_id); ?>
				<div class="title"><?=ucwords($destination->name . " trips")?> <span class="right"><a class="viewmore" href="<?=site_url("tours/vietnam/{$destination->alias}")?>">&raquo; View all</a></span></div>
				<ul class="list">
					<?
						$idx = 1;
						$row = 1;
						$rowidx = 1;
						foreach($tours as $tour) {
					?>
					<li class="col<?=$idx?> row<?=$row?> <?=(($row>1)?"none":"")?>">
						<div class="thumb">
							<a title="<?=$tour->name?>" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/".$tour->alias)?>"><img alt="" src="<?=$tour->thumbnail?>"/></a>
							<? if ($tour->price < $tour->original_price) { ?>
							<div class="promotion">Promotion Available!</div>
							<? } ?>
						</div>
						<div class="detail">
							<h3 class="tourname"><a title="<?=$tour->name?>" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/".$tour->alias)?>"><?=$tour->name?></a></h3>
							<p class="duration"><?=($tour->duration > 1) ? $tour->duration." days - ".($tour->duration-1)." nights" : $tour->duration." day"?></p>
							<p class="price"><label>From:</label> $<?=$tour->price?> <?=(($tour->price < $tour->original_price)?'<label class="original">$'.$tour->original_price.'</label>':"")?></p>
							<p class="photo"></p>
							<p class="separator"></p>
							<?=$tour->summary?>
						</div>
						<p class="booknow"><a title="Book Now" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/".$tour->alias)?>">Book Now</a></p>
					</li>
					<?
							$idx = ($idx%4) + 1;
							if ($rowidx == 8) {
								$row++;
							}
							$rowidx = ($rowidx%8) + 1;
						}
						$size = sizeof($tours);
						while(($size++)%4) {
					?>
					<li class="hidden col<?=$idx?> row<?=$row?> <?=(($row>1)?"none":"")?>">
						<div class="thumb"></div>
						<h3 class="tourname"></h3>
						<p class="duration"></p>
						<p class="price"></p>
						<p class="photo"></p>
						<p class="separator" style="border: none;"></p>
						<p class="rating"></p>
						<p class="desc"></p>
						<p class="booknow"></p>
					</li>
					<?
							$idx = ($idx%4) + 1;
						}
					?>
				</ul>
				<div class="clr"></div>
				<? if (($row) > 1 && sizeof($tours) > 8) { ?>
				<div class="show-more-container">
					<a class="link more-destinations">Show more</a>
				</div>
				<? } ?>
			</div>
			<div class="clr"></div>
		</div>
		<? } ?>
	</div>
</div>

<script type="text/javascript">
	var row = 2;
	var maxrow = '<?=$row?>';
	$(document).ready(function() {
		$('.more-destinations').click(function() {
			$('.row'+row).show('fade');
			row = row + 1;
			if (row > maxrow) {
				$('.show-more-container').hide();
			}
		});

		$( "a.large-map" )
		.mouseenter(function() {
			$('div.map-mask').css('display','block');
		})
		.mouseleave(function() {
			$('div.map-mask').css('display','none');
		});

		$(".large-map").fancybox({
			'href'   : '#large-map',
			'width'      : '75%',
			'height'     : '75%',
			'autoScale'         : false,
			'transitionIn'      : 'none',
			'transitionOut'     : 'none',
			'onComplete': function(){
				var center = map1.getCenter();
				google.maps.event.trigger(map1, "resize");
				map1.setCenter(center);
			}
		});

		
	});
</script>