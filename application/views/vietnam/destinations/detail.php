<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/jssor/css/gallery.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/photobox.css">
<script type="text/javascript" src='<?=TPL_URL?>jquery/js/jquery.photobox.js'></script>
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
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title"><?=$item->title?></h1>
	<div id="vietnam-destinations">
		<div class="destination">
			<div style="width: 680px;float: left">
				<div style="padding: 10px; background: #FFF; overflow: hidden">
					<div class="left slideshow">
						<div id="slider_container" style="position: relative; top: 0px; left: 0px; width: 660px; height: 523px;  overflow: hidden;">
							<!-- Loading Screen -->
							<div u="loading" style="position: absolute; top: 0px; left: 0px;">
								<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color: #000000; top: 0px; left: 0px; width: 100%; height:100%;"></div>
								<div style="position: absolute; display: block; background: url(<?=TPL_URL?>jquery/jssor/img/loading.gif) no-repeat center center; top: 0px; left: 0px; width: 100%; height:100%;"></div>
							</div>
							<!-- Slides Container -->
							<div class="slides_content" u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 660px; height: 420px; overflow: hidden;">
								<? for ($i=0; $i<sizeof($photos); $i++) { ?>
								<div class="slider_item">
									<a href="<?=$photos[$i]->file_path?>">
										<img title="<?=$photos[$i]->name?>" u="image" src="<?=$photos[$i]->file_path?>" height="420"/>
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
							<li><span>Area :</span> <?=$item->area?></li>
							<li><span>Population :</span> <?=$item->population?></li>
							<li><span>Location :</span> <?=$item->location?></li>
							<li><span>When to go :</span> <?=$item->whentogo?></li>
							<li><a href="#large-map" class="large-map">Explore <?=$item->title?>'s Map</a></li>
						</ul>
					</div>					
				</div>

				<div class="left detailed">
					<div class="title"><?=$item->title?> Highlight</div>
					<?=$item->content?>
				</div>

				<div id="destination-attractions">
					<ul class="tabs">
						<li><a id="nav1" href="javascript:void(0)" class="active" onclick="showTab(0)">Top Attractions</a></li>
						<li><a id="nav2" href="javascript:void(0)" onclick="showTab(1)">Top Restaurants</a></li>
						<li><a id="nav3" href="javascript:void(0)" onclick="showTab(2)">Top Shopping</a></li>
						<li><a id="nav4" href="javascript:void(0)" onclick="showTab(3)">Top Entertainments</a></li>
					</ul>
					
					<!-- TOP ATTRACTIONS LIST -->
					<div id="tab1" class="destination-list tab-selected">
						<? if (sizeof($top_sights)) { ?>
						<ul class="list">
							<?
								$idx = 1;
								$row = 1;
								$rowidx = 1;
								foreach($top_sights as $sight) {
									//count reviews of attraction
									$count = $this->m_review->getItemsCount(11,$sight->id,1);
									$avg_rating = 0;
									$rev_info->category_id = 11;
									$rev_info->ref_id = $item->id;
									$reviews = $this->m_review->getItems($rev_info,1);
									foreach ($reviews as $review) {
										$avg_rating += $review->rating;
									}
									if (sizeof($reviews)) {
										$avg_rating = round($avg_rating / sizeof($reviews));
									}else{
										$avg_rating = 4;
									}
							?>
							<div style="overflow: inherit;position: relative;float: left;">
							<div class="top-choice">
								<img alt="" src="<?=IMG_URL?>destination/top-choice.png">
							</div>
							<li class="col<?=$idx?> row1">
								
								<div class="flag">
									<img alt="" src="<?=IMG_URL?>vietnam/sight.png">
								</div>
								<div class="thumb">
									<a title="<?=$sight->title?>" href="<?=site_url("vietnam/sights/{$sight->alias}")?>">
										<img alt="<?=$sight->alias?>" src="<?=$sight->thumbnail?>">
									</a>
								</div>
								<div class="detail">
									<p style="font-style: italic;font-size: 13px;color: #cc6633">Out door</p>
									<h3 class="tourname"><a title="<?=$sight->title?>" href="<?=site_url("vietnam/sights/{$sight->alias}")?>"><?=$sight->title?></a></h3>
									<p class="reviews">
										<img src="<?=IMG_URL?>tour/icon/star<?=$avg_rating?>.png" alt="rating" height="15">
										<a href="#"><?=$count->count?> <?=($count->count>1)?'Reviews':'Review'?></a>
									</p>
									<p style="text-align: justify;">
										<?=$sight->summary?>
									</p>						
								</div>
							</li>
							</div>
							<?
									$idx = ($idx%3) + 1;
								}
								$size = sizeof($top_sights);
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
						<span class="right"><a class="viewmore" href="<?=site_url("vietnam/sights/{$item->alias}")?>">View all &raquo;</a></span>
						<? }else {?>
							<div style="padding: 30px 0;text-align: center;background: #FFFFFF;margin-top:15px">Attractions of this destination will be updated soon. Thanks for your interest.</div>
						<?}?>
												
					</div>
					
					<!-- TOP RESTAURANT LIST -->
					<div id="tab2" class="destination-list tab-content">
						<? if (sizeof($top_restaurants)) { ?>
						<ul class="list">
							<?
								$idx = 1;
								$row = 1;
								$rowidx = 1;
								foreach($top_restaurants as $restaurant) {
							?>
							<div style="overflow: inherit;position: relative;float: left;">
							<div class="top-choice">
								<img alt="" src="<?=IMG_URL?>destination/top-choice.png">
							</div>
							<li class="col<?=$idx?> row1">
								
								<div class="flag">
									<img alt="" src="<?=IMG_URL?>vietnam/sight.png">
								</div>
								<div class="thumb">
									<a title="<?=$restaurant->title?>" href="<?=site_url("vietnam/restaurants/{$restaurant->alias}")?>">
										<img alt="<?=$restaurant->alias?>" src="<?=$restaurant->thumbnail?>">
									</a>
								</div>
								<div class="detail">
									<p style="font-style: italic;font-size: 13px;color: #cc6633">Out door</p>
									<h3 class="tourname"><a title="<?=$restaurant->title?>" href="<?=site_url("vietnam/restaurants/{$restaurant->alias}")?>"><?=$restaurant->title?></a></h3>
									<p class="reviews">
										<img src="<?=IMG_URL?>tour/icon/star5.png" alt="rating" height="15">
										<a href="#">210 Reviews</a>
									</p>
									<p style="text-align: justify;">
										<?=$restaurant->summary?>
									</p>						
								</div>
							</li>
							</div>
							<?
									$idx = ($idx%3) + 1;
								}
								$size = sizeof($top_restaurants);
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
						<span class="right"><a class="viewmore" href="<?=site_url("vietnam/restaurants")?>">View all &raquo;</a></span>
						<? }else {?>
							<div style="padding: 30px 0;text-align: center;background: #FFFFFF;margin-top:15px">Restaurants of this destination will be updated soon. Thanks for your interest.</div>
						<?}?>
						
					</div>
					
					<!-- TOP SHOPPING LIST -->
					<div id="tab3" class="destination-list tab-content">
						<? if (sizeof($top_shoppings)) { ?>
						<ul class="list">
							<?
								$idx = 1;
								$row = 1;
								$rowidx = 1;
								foreach($top_shoppings as $shopping) {
							?>
							<div style="overflow: inherit;position: relative;float: left;">
							<div class="top-choice">
								<img alt="" src="<?=IMG_URL?>destination/top-choice.png">
							</div>
							<li class="col<?=$idx?> row1">
								
								<div class="flag">
									<img alt="" src="<?=IMG_URL?>vietnam/sight.png">
								</div>
								<div class="thumb">
									<a title="<?=$shopping->title?>" href="<?=site_url("vietnam/shopping/{$shopping->alias}")?>">
										<img alt="<?=$shopping->alias?>" src="<?=$shopping->thumbnail?>">
									</a>
								</div>
								<div class="detail">
									<p style="font-style: italic;font-size: 13px;color: #cc6633">Out door</p>
									<h3 class="tourname"><a title="<?=$shopping->title?>" href="<?=site_url("vietnam/shopping/{$shopping->alias}")?>"><?=$shopping->title?></a></h3>
									<p class="reviews">
										<img src="<?=IMG_URL?>tour/icon/star5.png" alt="rating" height="15">
										<a href="#">210 Reviews</a>
									</p>
									<p style="text-align: justify;">
										<?=$shopping->summary?>
									</p>						
								</div>
							</li>
							</div>
							<?
									$idx = ($idx%3) + 1;
								}
								$size = sizeof($top_shoppings);
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
						<span class="right"><a class="viewmore" href="<?=site_url("vietnam/shopping")?>">View all &raquo;</a></span>
						<? }else {?>
							<div style="padding: 30px 0;text-align: center;background: #FFFFFF;margin-top:15px">Shoppings of this destination will be updated soon. Thanks for your interest.</div>
						<?}?>
						
					</div>
					
					<!-- TOP ENTERTAINMENT LIST  -->
					<div id="tab4" class="destination-list tab-content">
						<? if (sizeof($top_entertainments)) { ?>
						<ul class="list">
							<?
								$idx = 1;
								$row = 1;
								$rowidx = 1;
								foreach($top_entertainments as $entertainment) {
							?>
							<div style="overflow: inherit;position: relative;float: left;">
							<div class="top-choice">
								<img alt="" src="<?=IMG_URL?>destination/top-choice.png">
							</div>
							<li class="col<?=$idx?> row1">
								
								<div class="flag">
									<img alt="" src="<?=IMG_URL?>vietnam/sight.png">
								</div>
								<div class="thumb">
									<a title="<?=$entertainment->title?>" href="<?=site_url("vietnam/entertainments/{$entertainment->alias}")?>">
										<img alt="<?=$entertainment->alias?>" src="<?=$entertainment->thumbnail?>">
									</a>
								</div>
								<div class="detail">
									<p style="font-style: italic;font-size: 13px;color: #cc6633">Out door</p>
									<h3 class="tourname"><a title="<?=$entertainment->title?>" href="<?=site_url("vietnam/entertainments/{$entertainment->alias}")?>"><?=$entertainment->title?></a></h3>
									<p class="reviews">
										<img src="<?=IMG_URL?>tour/icon/star5.png" alt="rating" height="15">
										<a href="#">210 Reviews</a>
									</p>
									<p style="text-align: justify;">
										<?=$entertainment->summary?>
									</p>						
								</div>
							</li>
							</div>
							<?
									$idx = ($idx%3) + 1;
									
								}
								$size = sizeof($top_entertainments);
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
						<span class="right"><a class="viewmore" href="<?=site_url("vietnam/entertainments")?>">View all &raquo;</a></span>
						<? }else {?>
							<div style="padding: 30px 0;text-align: center;background: #FFFFFF;margin-top:15px">Entertainments of this destination will be updated soon. Thanks for your interest.</div>
						<?}?>
						
					</div>

				</div>
				<!-- #destination-attractions -->

				<? if (sizeof($popular_tours)) { ?>
				<div class="related-tours">
					<div id="top-destination-tours">
						<? $destination = $this->m_tour_destination->load($item->destination_id); ?>
						<div class="title">Popular Tours</div>
						<ul class="list">
							<?
								$idx = 1;
								$row = 1;
								$rowidx = 1;
								foreach($popular_tours as $tour) {
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
									$idx = ($idx%3) + 1;
									if ($rowidx == 6) {
										$row++;
									}
									$rowidx = ($rowidx%6) + 1;
								}
								$size = sizeof($popular_tours);
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
				<div class="destination-nav">
					<ul>
						<li><a href="<?=(sizeof($sights)!=0)?site_url("vietnam/sights/{$item->alias}"):site_url("vietnam/sights")?>" class="attraction">Attractions <span>(<?=sizeof($sights)?>)</span></a></li>
						<li><a href="<?=(sizeof($restaurants)!=0)?site_url("vietnam/restaurants/{$item->alias}"):site_url("vietnam/restaurants")?>" class="restaurant">Restaurants <span>(<?=sizeof($restaurants)?>)</span></a></li>
						<li><a href="<?=(sizeof($shoppings)!=0)?site_url("vietnam/shopping/{$item->alias}"):site_url("vietnam/shopping")?>" class="shopping">Shopping <span>(<?=sizeof($shoppings)?>)</span></a></li>
						<li><a href="<?=(sizeof($entertainments)!=0)?site_url("vietnam/entertainments/{$item->alias}"):site_url("vietnam/entertainments")?>" class="entertainment">Entertainments <span>(<?=sizeof($entertainments)?>)</span></a></li>
						<li><a href="<?=(sizeof($tours)!=0)?site_url("tours/vietnam/{$destination->alias}"):site_url("tours/search")?>" class="tours">Tours <span>(<?=sizeof($tours)?>)</span></a></li>
					</ul>	
				</div>
				<!-- .destination-nav -->
				
				<select name="destination-select" id="destination-select">
					<option value="">Select Destination...</option>
					<?
						$vn_destinations = $this->m_vietnam_destination->getItems(NULL,1);
						foreach($vn_destinations as $dest) {
							$destination = $this->m_tour_destination->load($dest->destination_id);
					?>	
							<option value="<?=$destination->alias?>"><?=$dest->title?></option>
					<?}?>
				</select>
				<!-- #destination-select -->
				
				<?php if (!empty($item->video)): ?>
					<div id="destination-video">
						<?=$item->video?>
					</div>
					<!-- End #destination-video -->	
				<?php endif ?>

				<div class="location">
					<a href="#large-map"  class="large-map" style="display:none;">
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
				<div id="vietnam-moment">
					<a title="View the Vietnam's moments" href="<?=site_url("vietnam/photos")?>"><img alt="" src="<?=IMG_URL?>vietnam-moment.jpg"></a>
				</div>
				<?
					$dest = $this->m_tour_destination->load($item->destination_id);
					$blogs = $this->m_blog->getByTag($dest->alias,1);
					if (sizeof($blogs)) {
				?>
					<div id="related-post">
						<div class="related-title">
							<h2>Related Post</h2>
							<span class="right"><a class="viewmore" href="<?=site_url("blog/tags/{$dest->alias}")?>">View all &raquo;</a></span>
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
			<!-- end .right -->
			<div class="clr"></div>
			
			<div class="clr"></div>
		</div>
		
	</div>
</div>



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

		//go to destination when select form dropdownbox
		$("#destination-select").change(function(event) {
			var url = "<?=base_url('vietnam/top-destinations/')?>/"+$(this).val()+".html";
			window.location = url;
		});

		$('.slides_content[debug-id=slide-board]').photobox('a');
	});
</script>

