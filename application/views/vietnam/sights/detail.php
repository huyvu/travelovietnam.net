<?php
if ($this->session->userdata('user')) {
	$user = $this->session->userdata('user');
}
?>
<?
	$sight_category = $this->m_sight_category->load($item->catid);
	//Set destination where current attraction is located
	$destination = $this->m_tour_destination->load($item->city); 

	$rest = $this->m_restaurant->getGmapAddress($destination->id,1);
	$ent  = $this->m_entertainment->getGmapAddress($destination->id,1);
	$shop = $this->m_shopping->getGmapAddress($destination->id,1);
	// $rest = array(implode($rest, ','));
	// $rest = json_encode($rest);


?>
<style>
	.gm-style-iw{
		overflow: hidden !important;
		width: 350px;
		height: 105px;
	}
	.map-thumbnail {
		margin-right: 10px;
	}
	.map-info {
		width: 230px;
	}
</style>
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/jssor/css/gallery.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/photobox.css">
<script type="text/javascript" src='<?=TPL_URL?>jquery/js/jquery.photobox.js'></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/jssor/js/jssor.core.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/jssor/js/jssor.utils.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/jssor/js/jssor.slider.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places"></script>
<script type="text/javascript">
	var map;
	$(document).ready(function() {
		var options = {
			zoom:15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("mapcanvas"), options);
		geoclient = new google.maps.Geocoder();
		geoclient.geocode({'address': "<?=$item->gmap_address?>"}, function(results, status){
			if(status == google.maps.GeocoderStatus.OK){
				map.setCenter(results[0].geometry.location);

				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title : "<?=$item->gmap_address?>"
				});
			}
		});
	});
</script>
<script type="text/javascript">
	var map1;
	var bounds = new google.maps.LatLngBounds();

	$(document).ready(function () {
		var myOptions = {
			zoom:15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map1 = new google.maps.Map(document.getElementById("restaurant-large"), myOptions);
		
		var markers = <?=json_encode($rest)?>;
		var infoWindow = new google.maps.InfoWindow(), marker, i;
		//restaurants marker image
		var image = "<?=IMG_URL?>vietnam/restaurant.png";
		if (markers.length) {
			for( i = 0; i < markers.length; i++ ) {
				var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
				bounds.extend(position);
				marker = new google.maps.Marker({
					position: position,
					map: map1,
					title: markers[i][0],
					icon: image
				});
				

				// Allow each marker to have an info window    
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						var url = "<?=site_url()?>"+"vietnam/restaurants/"+markers[i][4];
						var infoContent = "<div><div class='left map-thumbnail'><img width='100' alt='"+markers[i][4]+"' src='"+markers[i][3]+"'/></div><div class='left map-info'><p>"+markers[i][0]+"</p><p><a target='blank' href='"+url+"'>» Explore "+markers[i][5]+" </a></p></div></div>" ;
						infoWindow.setContent(infoContent);
						infoWindow.open(map1, marker);
					}
				})(marker, i));

				// Automatically center the map fitting all markers on the screen
				map1.fitBounds(bounds);
			}
			// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
			var boundsListener = google.maps.event.addListener((map1), 'bounds_changed', function(event) {
				this.setZoom(13);
				google.maps.event.removeListener(boundsListener);
			});
		}else{
			geoclient = new google.maps.Geocoder();
			geoclient.geocode({'address': "<?=$item->gmap_address?>"}, function(results, status){
				if(status == google.maps.GeocoderStatus.OK){
					map1.setCenter(results[0].geometry.location);

					var marker = new google.maps.Marker({
						map: map1,
						position: results[0].geometry.location,
						title : "<?=$item->gmap_address?>"
					});
				}
			});
		}
	});

</script>
<script type="text/javascript">
	var map2;
	var bounds = new google.maps.LatLngBounds();

	$(document).ready(function () {
		var myOptions = {
			zoom:15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map2 = new google.maps.Map(document.getElementById("entertainment-large"), myOptions);
		var infoWindow = new google.maps.InfoWindow(), marker, i;
		var markers = <?=json_encode($rest)?>;
		//restaurants marker image
		var image = "<?=IMG_URL?>vietnam/entertainment.png";
		if (markers.length) {
			for( i = 0; i < markers.length; i++ ) {
				var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
				bounds.extend(position);
				marker = new google.maps.Marker({
					position: position,
					map: map2,
					title: markers[i][0],
					icon: image
				});
				
				// Allow each marker to have an info window    
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						var url = "<?=site_url()?>"+"vietnam/entertainments/"+markers[i][4];
						var infoContent = "<div><div class='left map-thumbnail'><img width='100' alt='"+markers[i][4]+"' src='"+markers[i][3]+"'/></div><div class='left map-info'><p>"+markers[i][0]+"</p><p><a target='blank' href='"+url+"'>» Explore "+markers[i][5]+" >></a></p></div></div>";
						infoWindow.setContent(infoContent);
						infoWindow.open(map2, marker);
					}
				})(marker, i));

				// Automatically center the map fitting all markers on the screen
				map2.fitBounds(bounds);
			}
			// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
			var boundsListener = google.maps.event.addListener((map2), 'bounds_changed', function(event) {
				this.setZoom(14);
				google.maps.event.removeListener(boundsListener);
			});
		}else{
			geoclient = new google.maps.Geocoder();
			geoclient.geocode({'address': "<?=$item->gmap_address?>"}, function(results, status){
				if(status == google.maps.GeocoderStatus.OK){
					map2.setCenter(results[0].geometry.location);

					var marker = new google.maps.Marker({
						map: map2,
						position: results[0].geometry.location,
						title : "<?=$item->gmap_address?>"
					});
				}
			});
		}
	});

</script>
<script type="text/javascript">
	var map3;
	var bounds = new google.maps.LatLngBounds();

	$(document).ready(function () {
		var myOptions = {
			zoom:15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map3 = new google.maps.Map(document.getElementById("shopping-large"), myOptions);
		var infoWindow = new google.maps.InfoWindow(), marker, i;
		var markers = <?=json_encode($rest)?>;
		//restaurants marker image
		var image = "<?=IMG_URL?>vietnam/shopping.png";
		if (markers.length) {
			for( i = 0; i < markers.length; i++ ) {
				var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
				bounds.extend(position);
				marker = new google.maps.Marker({
					position: position,
					map: map3,
					title: markers[i][0],
					icon: image
				});
				
				// Allow each marker to have an info window    
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						var url = "<?=site_url()?>"+"vietnam/shopping/"+markers[i][4];
						var infoContent = "<div><div class='left map-thumbnail'><img width='100' alt='"+markers[i][4]+"' src='"+markers[i][3]+"'/></div><div class='left map-info'><p>"+markers[i][0]+"</p><p><a target='blank' href='"+url+"'>» Explore "+markers[i][5]+" >></a></p></div></div>";
						infoWindow.setContent(infoContent);
						infoWindow.open(map3, marker);
					}
				})(marker, i));

				// Automatically center the map fitting all markers on the screen
				map3.fitBounds(bounds);
			}
			// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
			var boundsListener = google.maps.event.addListener((map3), 'bounds_changed', function(event) {
				this.setZoom(14);
				google.maps.event.removeListener(boundsListener);
			});
		}else{
			geoclient = new google.maps.Geocoder();
			geoclient.geocode({'address': "<?=$item->gmap_address?>"}, function(results, status){
				if(status == google.maps.GeocoderStatus.OK){
					map3.setCenter(results[0].geometry.location);

					var marker = new google.maps.Marker({
						map: map3,
						position: results[0].geometry.location,
						title : "<?=$item->gmap_address?>"
					});
				}
			});
		}
	});

</script>
<script>
	function showTab(index) {
		var tabs  = new Array("tab1", "tab2", "tab3", "tab4");
		var navs  = new Array("nav1", "nav2", "nav3", "nav4");
		for (var i=0; i<tabs.length; i++) {
			if (i == index){
				$("#"+navs[i]).addClass('active');
				$("#"+tabs[i]).fadeIn();
			} else {
				$("#"+navs[i]).removeClass('active');
				$("#"+tabs[i]).hide();
			}
		}
	}
</script>


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

	function showTab(index) {
		var tabs  = new Array("tab1", "tab2", "tab3", "tab4");
		var navs  = new Array("nav1", "nav2", "nav3", "nav4");
		for (var i=0; i<tabs.length; i++) {
			if (i == index){
				$("#"+navs[i]).addClass('active');
				$("#"+tabs[i]).fadeIn();
			} else {
				$("#"+navs[i]).removeClass('active');
				$("#"+tabs[i]).hide();
			}
		}
	}

</script>

<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/top-destinations")?>">Vietnam Top Destinations</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/top-destinations/{$destination->alias}")?>"><?=$destination->name?></a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/sights/{$dest->alias}")?>">Attraction of <?=$destination->name?></a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title"><?=$item->title?></h1>
	<div id="vietnam-destinations">
		<div class="sight">
			<div style="width: 680px;float: left">
				<div style="padding: 10px; background: #FFF; overflow: hidden">
					<div class="left slideshow">
						<div id="slider_container" style="position: relative; top: 0px; left: 0px; width: 660px; height: 445px; background: #191919; overflow: hidden;">
							<!-- Loading Screen -->
							<div u="loading" style="position: absolute; top: 0px; left: 0px;">
								<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color: #000000; top: 0px; left: 0px; width: 100%; height:100%;"></div>
								<div style="position: absolute; display: block; background: url(<?=TPL_URL?>jquery/jssor/img/loading.gif) no-repeat center center; top: 0px; left: 0px; width: 100%; height:100%;"></div>
							</div>
							<!-- Slides Container -->
							<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 680px; height: 350px; overflow: hidden;">
								<? for ($i=0; $i<sizeof($photos); $i++) { ?>
								<div class="slider_item">
									<a href="<?=$photos[$i]->file_path?>">
										<img u="image" src="<?=$photos[$i]->file_path?>" />
									</a>
									
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
						<ul>
							<li><span>Address :</span> <?=$item->address?></li>
							<li><span>Type :</span> <?=$sight_category->name?></li>
							<li><span>Destination :</span> <a href="<?=site_url("vietnam/top-destinations/{$destination->alias}")?>"><?=$destination->name?></a></li>
							<li><span>Useful Information : </span><?=$item->meta_desc?></li>
						</ul>
					</div>					
				</div>
				<div class="left detailed">
					<div class="title"><?=$item->title?> Highlights</div>
					<div class="description">
						<?=$item->content?>
						<div style="position:relative; margin: 10px 0; height: 30px">
							<? require(APPPATH."views/module/social.php"); ?>
						</div>
						<div class="clr"></div>
					</div>
				</div>
				<div class="clr"></div>
				
				<!-- ATTRACTION REVIEWS -->
				<div id="attraction-reviews">
					<div class="title">Traveller Reviews</div>
					<ul id="page-1">
					<?
					$cnt  = 0;
					$page = 1;
					for ($i=0; $i<sizeof($reviews); $i++) {
						if ($cnt != 0 && ($cnt % 4) == 0) {
							$page++;
							$cnt = 0;

					?>
					</ul>
					<ul id="page-<?=$page?>" class="none">
					<?
							}
						$cnt++;
						//option for gavatar
							$default = "mm";
							$size = 88;
							$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $reviews[$i]->email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
					?>
						<li>
							<div class="left user-info">
								<div class="img-circle">
									<img alt="<?=$reviews[$i]->author?>" src="<?=$grav_url?>">	
								</div>
								<p class="user-name">
									<span><?=$reviews[$i]->author?></span><br/>
									<?=$reviews[$i]->nationality?>
								</p>
							</div>
							<!-- end .user-info -->
							<div class="right review-content">
								<h2>"<?=$item->title?>"</h2>
								<p>
									<img src="<?=IMG_URL?>star<?=$reviews[$i]->rating?>.png" alt="rating">&nbsp;<?=date('F Y', strtotime($reviews[$i]->created_date))?>
								</p>
								<div class="main-content">
									<p>
										<?=$reviews[$i]->content?>
									</p>
								</div>
							</div>
							<!-- end .review-content -->
						</li>
					<? } ?>
					</ul>
					<div class="clr"></div>
					<? if ($page > 1) { ?>
					<div style="margin-top: 15px; text-align: center">
						<div class="left page-range" style="font-weight:bold">1 - 4 of <?=sizeof($reviews)?> Reviews</div>
						<div id="light-pagination" class="right pagination"></div>
					</div>
					<? } ?>
				</div>
				<!-- end #attraction-reviews -->
				
				<!-- NEW REVIEW POPUP -->
				<div id="new-review">
					<h1>Been to <?=$item->title?> ? Share Your Experience</h1>
					<a href="#review-box">Write a Review</a>
				</div>
				<!-- end #new-review -->

				<!-- RELATED TOUR -->
				<? if (sizeof($tours)) { ?>
				<div class="related-tours">
					<div id="top-destination-tours">
						<div class="title">Recommended Tours</div>
						<ul class="list">
							<?
								$idx = 1;
								$row = 1;
								$rowidx = 1;
								foreach($tours as $tour) {
							?>
							<li class="col<?=$idx?> row<?=$row?> <?=(($row>1)?"none":"")?>">
								<div class="thumb">
									<a title="<?=$tour->name?>" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/".$tour->alias)?>"><img alt="<?=$tour->alias?>" src="<?=$tour->thumbnail?>"/></a>
									<? if ($tour->price < $tour->original_price) { ?>
									<div class="promotion">Promotion Available!</div>
									<? } ?>
								</div>
								<div class="detail">
									<h3 class="tourname"><a title="<?=$tour->name?>" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/".$tour->alias)?>"><?=$tour->name?></a></h3>
									<p class="duration"><?=($tour->duration > 1) ? $tour->duration." days - ".($tour->duration-1)." nights" : $tour->duration." day"?></p>
									<p class="price"><label>From:</label> $<?=$tour->price?></p>
									<p class="photo"></p>
									<p class="separator"></p>
									<?=$tour->summary?>
								</div>
								<p class="booknow"><a title="Book Now" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/".$tour->alias)?>">Book Now</a></p>
								
							</li>
							<?
									$idx = ($idx%3) + 1;
								}
								$size = sizeof($tours);
								while(($size++)%3) {
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
									$idx = ($idx%3) + 1;
								}
							?>
						</ul>
						<div class="clr"></div>
					</div>
					<div class="clr"></div>
				</div>
				<div>
					<span class="right"><a class="viewmore" href="<?=site_url("tours/vietnam/{$destination->alias}")?>">View all &raquo;</a></span>
				</div>
				<? } ?>				
			</div>

			<div class="right">
				<div id="popular-attractions">
					<div class="title">
						<h2>Popular <?=$destination->name?> Attractions</h2>
					</div>
					<ul>
						<?
						$idx = 0;
						foreach($sights as $sight) {
							$idx++
						?>
							<li class="<?=($idx>7)?'extra-attraction none':''?>"><a href="<?=site_url("vietnam/sights/{$sight->alias}")?>"><?=$sight->title?></a></li>
						<? } ?>
					</ul>
					<?if(sizeof($sights) > 7) :?>
						<span>
							<a class="viewmore" href="javascript:void(0)">Show more &raquo;</a>
							<a class="viewfewer none">Show fewer &raquo;</a>
						</span>
					<?endif?>					
				</div>
				<!-- end #popular-attractions -->
				<div class="clr"></div>

				<div id="attraction-nearby">
					<div class="title">
						<h2>Thing To Do Nearby</h2>
					</div>
					<ul>
						<li><a href="#large-map" class="nearby-place restaurant-map">Restaurant</a>(<?=sizeof($rest)?>)</li>
						<li><a href="" class="nearby-place entertainment-map">Entertainment</a>(<?=sizeof($ent)?>)</li>
						<li><a href="" class="nearby-place shopping-map">Shopping</a>(<?=sizeof($shop)?>)</li>
					</ul>
					<div class="location">
						<a href="#large-map"  class="large-map">
							<div class="googlemap">
								<div id="mapcanvas"></div>
							</div>
						</a>
						<div style="display:none;">
							<div id="restaurant-map" >
								<div id="restaurant-large" style="width:800px;height:560px"></div>
							</div><!--/#restaurant-map -->
						</div>

						<div style="display:none;">
							<div id="entertainment-map" >
								<div id="entertainment-large" style="width:800px;height:560px"></div>
							</div><!--/#entertainment-map -->
						</div>

						<div style="display:none;">
							<div id="shopping-map" >
								<div id="shopping-large" style="width:800px;height:560px"></div>
							</div><!--/#shopping-map -->
						</div>
						
					</div>
				</div>
				<!-- End #attraction-nearby -->
				
				<? require_once(APPPATH."views/module/tour/customize.php"); ?>
				<div id="vietnam-moment">
					<a title="View the Vietnam's moments" href="<?=site_url("vietnam/photos")?>"><img alt="" src="<?=IMG_URL?>vietnam-moment.jpg"></a>
				</div>
				<div id="tour-view-shortlist-loader"></div>
				<?
					$blogs = $this->m_blog->getByTag($destination->alias,1);
					if (sizeof($blogs)) {
				?>
					<div id="related-post">
						<div class="related-title">
							<h2>Related Post</h2>
							<span class="right"><a class="viewmore" href="<?=site_url("blog/tags/{$destination->alias}")?>">View all &raquo;</a></span>
							<div class="clr"></div>
						</div>
						<ul>
						<?foreach($blogs as $blog) :?>
							<li><span>&raquo;</span><a href="<?=site_url("blog/{$blog->alias}")?>"><?=$blog->title?></a></li>
						<?endforeach?>
						</ul>
					</div>
					<!-- end #related-post -->

				<?}?>
			</div>
			<div class="clr"></div>
		</div>
		
		
	</div>
</div>

<!-- Review box for attraction -->
<div style="display:none">
	<div id="review-box" >
		<div class="header">
			<h1>Share Your Travel Experiences</h1>	
		</div>
		<!-- end #review-box-header -->
		<div class="title">
			<h1><?=$item->title?></h1>
			<h3><?=$destination->name?></h3>
		</div>
		<p style="font-weight: bold; font-size:18px">Share your travel insights & expertise!</p>
		<p style="color:#7e7e7e; font-size:14px">The fields marked<span style="color:red;vertical-align:top">*</span> are mandatory and must be completed.</p>
		<p style="font-size:16px; margin-top:15px"><span style="color:red;">*</span> Rate it</p>
		<p style="font-size:14px;color:#7e7e7e; margin-top:15px; line-height:24px"><div id="star"></div>  Roll over and click on the star to make a selection</p>
		<p style="font-size:16px; margin-top:15px;"><span style="color:red;">*</span> Submit your review or leave a reply</p>
		<form action="">
			<p>
				<textarea name="content" id="txt_content" rows="10"></textarea>
			</p>
			<p>
				<a class="right btn-review">Submit</a>
				<a  onclick="openInfoPopup();" href="#review-info" id="btt-info" style="visibility:hidden">Submit</a>
				<input type="hidden" id="attraction_id" value="<?=$item->id?>">
				<input type="hidden" id="ip" value="">
				<input type="hidden" id="category_id" value="11">
			</p>
		</form>
	</div>
	<!-- end #review-box -->
</div>


<!-- Popup for user to login to post a review  -->
<div style="display:none">
	<div id="review-info">
		<div class="left">
			<p class="info-title" style="text-align:right">Review with</p>
			<p class="p-social"><a rel="facebook" href="javascript:void(0)" onClick="fbReview('<?php echo site_url("vietnam/insertReview");?>','<?=$item->id?>');" class="login-social lg-facebook"></a></p>
			<p class="p-social"><a rel="google" href="javascript:void(0)" onClick="gpReview();" class="login-social lg-google"></a></p>
		</div>

		<div class="right">
			<p class="info-title">Or review with your information</p>
			<p class="login-txt">
				<input id="txt_email" type="text" class="txt-login" placeholder="Your Email">
				<span class="errormsg"></span>
			</p>
			<p class="login-txt">
				<input id="txt_fullname" type="text" class="txt-login" placeholder="Your Fullname">
				<span class="errormsg"></span>
			</p>
			<a  class="btt-complete">Submit</a>
			<a  onclick="openSuccessPopup();" href="#review-success" id="btt-success" style="visibility:hidden">Submit</a>
		</div>
	</div>
	<!-- end #review-info -->
</div>

<!-- Successful dialog popup when user submitted review successfully -->
<div style="display:none">
	<div id="review-success">
		That's great ! Your review has been sent successfully.<br/>
		Reviews are typically posted within 24 hours, pending approval.
	</div>
	<!-- end #review-success -->
</div>


<script type="text/javascript" src = "<?=JS_URL?>facebook.js"></script>
<script type="text/javascript" src = "<?=JS_URL?>google-plus.js"></script>
<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery.raty.css"/>
<script src="<?=JS_URL?>jquery.raty.js"></script>
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
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
	});

	$( "a.large-map" )
	.mouseenter(function() {
		$('div.map-mask').css('display','block');
	})
	.mouseleave(function() {
		$('div.map-mask').css('display','none');
	});

	//Show all restaurants of current destination on the map
	$(".restaurant-map").fancybox({
		'href'   : '#restaurant-map',
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

	//Show all entertainments of current destination on the map
	$(".entertainment-map").fancybox({
		'href'   : '#entertainment-map',
		'width'      : '75%',
		'height'     : '75%',
		'autoScale'         : false,
		'transitionIn'      : 'none',
		'transitionOut'     : 'none',
			'onComplete': function(){
				var center = map2.getCenter();
				google.maps.event.trigger(map2, "resize");
				map2.setCenter(center);
			}
	});

	//Show all shoppings of current destination on the map
	$(".shopping-map").fancybox({
		'href'   : '#shopping-map',
		'width'      : '75%',
		'height'     : '75%',
		'autoScale'         : false,
		'transitionIn'      : 'none',
		'transitionOut'     : 'none',
			'onComplete': function(){
				var center = map3.getCenter();
				google.maps.event.trigger(map3, "resize");
				map3.setCenter(center);
			}
	});


	//Open a popup when click review button
	$("#new-review a").fancybox({
		'href'   : '#review-box',
		'width'      : '75%',
		'height'     : '75%',
		'autoScale'         : false,
		'transitionIn'      : 'none',
		'transitionOut'     : 'none',
	})

	//Open popup for user to enter their information when click submit button in review box
	function openInfoPopup(){
		$("a#btt-info").fancybox({
			'width'      : '75%',
			'height'     : '75%',
			'autoScale'         : false,
			'transitionIn'      : 'fadeIn',
			'transitionOut'     : 'fadeOut',
			'hideOnOverlayClick': false
		}).trigger('click');
	}

	function openSuccessPopup(){
		$("a#btt-success").fancybox({
			'width'      : '75%',
			'height'     : '75%',
			'autoScale'         : false,
			'transitionIn'      : 'fadeIn',
			'transitionOut'     : 'fadeOut',
		}).trigger('click');
	}

	//Review box's textarea validation
	$("a.btn-review").click(function(event) {
		var error = 0;
		if ($('#txt_content').val() == '') {
			$('#txt_content').addClass('error');
			error++;
		}else{
			$('#txt_content').removeClass('error');
		}

		if (error ==0 ) {
			//Check if user is logged in, then insert data to database and display success popup
			var user = "<?=(isset($user))?$user['fullname']:''?>";
			if (user === '') {
				openInfoPopup();
			}else{
				var p = {};
				p['content'] = $('#txt_content').val();
				p['author'] = "<?=(isset($user))?$user['fullname']:''?>";
				p['email'] = "<?=(isset($user))?$user['email']:''?>";
				p['rating'] = $('input[name=rating]').val();
				p['ref_id'] = "<?=$item->id?>";
				p['nationality'] = $('input#ip').val();
				p['category_id'] = $('#category_id').val();

				$.ajax({
					type: "POST",
					url: "<?=site_url('vietnam/insertReview')?>",
					data: p,
					dataType: 'json',
					success: function(result){
						console.log(result);
						if (result[0]) {
							$('#txt_content').val('');
							$('#txt_fullname').val('');
							$('#txt_email').val('');
							openSuccessPopup();	
						}
					},async:false
				});	
			}
		}
	});


	//Review info box validation
	$("a.btt-complete").click(function(event) {
		var error = 0;
		if ($('#txt_email').val() == '') {
			$('#txt_email').addClass('error');
			$('#txt_email').next('.errormsg').text("You can't leave this empty");
			error++;
		}else if(!isEmail($('#txt_email').val())){
			$('#txt_email').addClass('error');
			$('#txt_email').next('.errormsg').text("The input is not a valid email address.");
			error++;
		}else{
			$('#txt_email').removeClass('error');
			$('#txt_email').next('.errormsg').text("");
		}

		if ($('#txt_fullname').val() == '') {
			$('#txt_fullname').addClass('error');
			$('#txt_fullname').next('.errormsg').text("You can't leave this empty");
			error++;
		}else{
			$('#txt_fullname').removeClass('error');
			$('#txt_fullname').next('.errormsg').text("");
		}

		if (error ==0 ) {
			var p = {};
			p['content'] = $('#txt_content').val();
			p['author'] = $('#txt_fullname').val();
			p['email'] = $('#txt_email').val();
			p['rating'] = $('input[name=rating]').val();
			p['ref_id'] = "<?=$item->id?>";
			p['nationality'] = $('input#ip').val();
			p['category_id'] = $('#category_id').val();

			$.ajax({
				type: "POST",
				url: "<?=site_url('vietnam/insertReview')?>",
				data: p,
				dataType: 'json',
				success: function(result){
					console.log(result);
					if (result[0]) {
						$('#txt_content').val('');
						$('#txt_fullname').val('');
						$('#txt_email').val('');
						openSuccessPopup();	
					}
				},async:false
			});
		}
	});


	//Star rating jquery plugin
	$("#star").raty({
		path: "<?=IMG_URL?>",
		score: 4,
		starOff     : 'star-off.png',
		starOn      : 'star-on.png',
		scoreName   : 'rating' 
	});

	//Get client ip address and assign to hidden field
	$.getJSON("http://ip-api.com/json/?callback=?", function(data) {
		$('input#ip').val(data['country']);
	});

	// Show more & show fewer Attractions
	$(".viewmore").click(function() {
			$(".extra-attraction").show('fade');
			$(".viewmore").hide();
			$(".viewfewer").show();
		});
	$(".viewfewer").click(function() {
		$(".extra-attraction").hide('fade');
		$(".viewmore").show();
		$(".viewfewer").hide();
	});

	$('#gallery').photobox('a');

</script>

<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/pagination.css"/>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.pagination.js"></script>
<script type="text/javascript">
	$(function() {
		var hashVal = window.location.hash;
		var curPage = ((hashVal != null && hashVal != "") ? hashVal.substr(-1,1) : 1);
		var numofitem = '<?=sizeof($reviews)?>';
		if ((numofitem / 4) > 1) {
			$("#light-pagination").pagination({
				items: numofitem,
				itemsOnPage: 4,
				currentPage: curPage,
				cssStyle: 'light-theme',
				onPageClick: function(pageNumber){selectPage(pageNumber, numofitem);}
			});
			if (curPage > 1) {
				selectPage(curPage, numofitem);
			}
		}
	});
	
	function selectPage(pageNumber, items) {
		for (var i=1; i<=items; i++) {
			$("#page-"+i).hide();
		}
		$("#page-"+pageNumber).show('fade');
		var from 	= ((pageNumber-1)*4)+1;
		var to 		= ((items-((pageNumber-1)*4))%4)+((pageNumber-1)*4);
		if ((pageNumber*4) < items ) {
			to = pageNumber * 4;
		}
		var str 	= from + " - " + to + " of " + items + " Reviews";
		$(".page-range").html(str);
		console.log(from);
		console.log(to);
	}
</script>


