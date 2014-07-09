<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/shopping")?>">Shopping in Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title"><?=$item->title?></h1>
	<div id="vietnam-destinations">
		<div class="sight">
			<div class="left detailed" style="width: 680px; margin-top: 0px">
				<div>
					<div class="left" style="width: 380px; margin-right: 20px">
						<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
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
							$(document).ready(function() {
								var options = {
									zoom:15,
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
					<div class="left" style="width: 280px">
						<? if (!empty($item->address)) { ?>
							<div class="address"><span class="label">Address:</span> <?=$item->address?></div>
						<? } ?>
						<? if (!empty($item->area)) { ?>
							<div class="area"><span class="label">Area:</span> <?=$item->area?></div>
						<? } ?>
						<? if (!empty($item->open_time)) { ?>
							<div class="open-time"><span class="label">Open Time:</span> <?=$item->open_time?></div>
						<? } ?>
					</div>
					<div class="clr"></div>
				</div>
				<div class="description">
					<?=$item->content?>
					<div style="position:relative; margin: 10px 0; height: 30px">
						<? require(APPPATH."views/module/social.php"); ?>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<div class="right">
				<div id="vietnam-view-nav">
					<ul>
						<li>
							<a class="sight" title="" href="<?=site_url("vietnam/sights")?>">SIGHTS</a>
						</li>
						<li>
							<a class="entertainment" title="" href="<?=site_url("vietnam/entertainments")?>">ENTERTAINMENTS</a>
						</li>
						<li>
							<a class="restaurant" title="" href="<?=site_url("vietnam/restaurants")?>">RESTAURANTS</a>
						</li>
						<li>
							<a class="shopping-selected" title="" href="<?=site_url("vietnam/shopping")?>">SHOPPING</a>
						</li>
					</ul>
				</div>
				<? require_once(APPPATH."views/module/tour/customize.php"); ?>
				<? require_once(APPPATH."views/vietnam/module/need_to_know.php"); ?>
				<div id="tour-view-shortlist-loader"></div>
			</div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<? if (sizeof($tours)) { ?>
		<div class="related-tours">
			<div id="top-destination-tours">
				<? $destination = $this->m_tour_destination->load($item->city); ?>
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
							<p class="price"><label>From:</label> $<?=$tour->price?></p>
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
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
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
</script>