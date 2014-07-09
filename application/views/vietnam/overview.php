<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Overview
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="left" style="width: 680px">
		<h1 class="page-title">VIETNAM OVERVIEW</h1>
		<div id="vietnam-view-detailed">
			<h2 class="overview-name">Vietnam Top Highlights</h2>
			<div class="overview-destmap">
				<style>
					#highlights {
						list-style-type: none;
						background-color: #FFFFFF;
						margin: 10px 0px 0px !important;
					}
					#highlights li {
						border-bottom: 1px solid #EFEFEF;
						overflow: hidden;
					}
					#highlights li a {
						width: 100%;
						height: 100%;
						padding: 10px;
						background-color: #FFFFFF;
						color: #333333;
						font-size: 12px;
						cursor: pointer;
						display: inline-table;
						text-decoration: none;
					}
					#highlights li a:hover, #highlights li a.active {
						background-color: #FF9900;
						color: #FFFFFF;
					}
					#destmap {
						border: 5px solid #FFFFFF;
						width: 670px;
						height: 370px;
					}
					.mapinfo-thumbnail {
						margin-right: 10px;
					}
					.mapinfo-content-title {
						font-size: 16px;
					}
					.mapinfo-content a {
						margin-top: 30px;
					}
				</style>
				<div id="destmap"></div>
				<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
				<script>
					var visibleInfoWindow = null;
					function generateMarkers() {
						var markers = new Array();
						markers[0]  = new Array(['Explore the evocative old quarter of Hanoi'],[21.0333333],[105.8500000],[0],["<div><div class=\"left mapinfo-thumbnail\"><img src=\"http:\/\/d3oxn90f3yphmd.cloudfront.net\/sites\/default\/files\/styles\/thumbnail\/public\/elements\/destination\/highlight\/vietnam_hanoi_oldtown.jpg\" width=\"100\" height=\"80\" alt=\"\"></div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Explore the evocative old quarter of Hanoi</div><div><a title=\"View all trips in Hanoi\" href=\"http://www.travelovietnam.com\/tours\/vietnam\/ha-noi.html\">&raquo; View all trips in Hanoi</a></div></div><div class=\"clr\"></div></div>"]);
						markers[1]  = new Array(['Relax on Nha Trang&#039;s stunning beaches'],[12.2387911],[109.1967488],[1],["<div><div class=\"left mapinfo-thumbnail\"><img src=\"http:\/\/d3oxn90f3yphmd.cloudfront.net\/sites\/default\/files\/styles\/thumbnail\/public\/elements\/destination\/highlight\/vietnam_beach_deckchairs.jpg\" width=\"100\" height=\"80\" alt=\"\"></div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Relax on Nha Trang&#039;s stunning beaches</div><div><a title=\"View all trips in Nha Trang\" href=\"http://www.travelovietnam.com\/tours\/vietnam\/nha-trang.html\">&raquo; View all trips in Nha Trang</a></div></div><div class=\"clr\"></div></div>"]);
						markers[2]  = new Array(['Cruise the sparkling waters of Halong Bay'],[20.8500000],[107.2333000],[2],["<div><div class=\"left mapinfo-thumbnail\"><img src=\"http:\/\/d3oxn90f3yphmd.cloudfront.net\/sites\/default\/files\/styles\/thumbnail\/public\/elements\/destination\/highlight\/vietnam_halong_bay_boat.jpg\" width=\"100\" height=\"80\" alt=\"\"></div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Cruise the sparkling waters of Halong Bay</div><div><a title=\"View all trips in Halong Bay\" href=\"http://www.travelovietnam.com\/tours\/vietnam\/ha-long.html\">&raquo; View all trips in Halong Bay</a></div></div><div class=\"clr\"></div></div>"]);
						markers[3]  = new Array(['Enjoy genuine hospitality on a Mekong Delta farmstay'],[10.2330301],[106.3765061],[3],["<div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Enjoy genuine hospitality on a Mekong Delta farmstay</div></div><div class=\"clr\"></div></div>"]);
						markers[4]  = new Array(['Take a ride on the famed Reunification Express'],[21.0333333],[105.8500000],[4],["<div><div class=\"left mapinfo-thumbnail\"><img src=\"http:\/\/d3oxn90f3yphmd.cloudfront.net\/sites\/default\/files\/styles\/thumbnail\/public\/elements\/destination\/highlight\/vietnam_reunification_express_train.jpg\" width=\"100\" height=\"80\" alt=\"\"></div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Take a ride on the famed Reunification Express</div></div><div class=\"clr\"></div></div>"]);
						markers[5]  = new Array(['Soak up the energy of Ho Chi Minh City'],[10.8230989],[106.6296638],[5],["<div><div class=\"left mapinfo-thumbnail\"><img src=\"http:\/\/d3oxn90f3yphmd.cloudfront.net\/sites\/default\/files\/styles\/thumbnail\/public\/elements\/destination\/highlight\/vietnam_ho_chi_minh_city_cyclo_tour.jpg\" width=\"100\" height=\"80\" alt=\"\"></div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Soak up the energy of Ho Chi Minh City</div><div><a title=\"View all trips in Ho Chi Minh city\" href=\"http://www.travelovietnam.com\/tours\/vietnam\/ho-chi-minh.html\">&raquo; View all trips in Ho Chi Minh city</a></div></div><div class=\"clr\"></div></div>"]);
						markers[6]  = new Array(['Admire ancient royal relics in Hue'],[16.4634610],[107.5847020],[6],["<div><div class=\"left mapinfo-thumbnail\"><img src=\"http:\/\/d3oxn90f3yphmd.cloudfront.net\/sites\/default\/files\/styles\/thumbnail\/public\/elements\/destination\/highlight\/vietnam_hue_temple_doorway.jpg\" width=\"100\" height=\"80\" alt=\"\"></div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Admire ancient royal relics in Hue</div><div><a title=\"View all trips in Hue\" href=\"http://www.travelovietnam.com\/tours\/vietnam\/hue.html\">&raquo; View all trips in Hue</a></div></div><div class=\"clr\"></div></div>"]);
						markers[7]  = new Array(['Experience life underground in the Cu Chi Tunnels'],[10.9700500],[106.4934400],[7],["<div><div class=\"left mapinfo-thumbnail\"><img src=\"http:\/\/d3oxn90f3yphmd.cloudfront.net\/sites\/default\/files\/styles\/thumbnail\/public\/elements\/destination\/highlight\/vietnam_cu_chi_tunnels.jpg\" width=\"100\" height=\"80\" alt=\"\"></div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Experience life underground in the Cu Chi Tunnels</div><div><div class=\"clr\"></div></div>"]);
						markers[8]  = new Array(['Learn the secrets to Vietnamese cuisine in a cooking class'],[15.8800700],[108.3380500],[8],["<div><div class=\"left mapinfo-thumbnail\"><img src=\"http:\/\/d3oxn90f3yphmd.cloudfront.net\/sites\/default\/files\/styles\/thumbnail\/public\/elements\/destination\/highlight\/vietnam_cooking-lesson.jpg\" width=\"100\" height=\"80\" alt=\"\"></div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Learn the secrets to Vietnamese cuisine in a cooking class</div></div><div class=\"clr\"></div></div>"]);
						markers[9]  = new Array(['Ride a bike past rice paddies and hillside villages'],[15.8800700],[108.3380500],[9],["<div><div class=\"left mapinfo-content\"><div class=\"mapinfo-content-title\">Ride a bike past rice paddies and hillside villages</div></div><div class=\"clr\"></div></div>"]);
						
						for (var i = 0; i < markers.length; i++) {
							var LatLng = new google.maps.LatLng(markers[i][1], markers[i][2]);
							var marker = new google.maps.Marker({
								map: map,
								title: 'Marker ' + markers[i][0],
								position: LatLng,
								draggable: true
							});
							
							// Create marker info window.
							var infoWindow = new google.maps.InfoWindow({
								content: markers[i][4] + "",
								size: new google.maps.Size(200, 80)
							});
							
							// Add marker click event listener.
							google.maps.event.addListener(marker, 'click', (function(marker, infoWindow, info) {
								return function() {
									if (visibleInfoWindow) {
										visibleInfoWindow.close();
									}
									visibleInfoWindow = infoWindow;
									infoWindow.open(map, marker);
									// Remove all class active use Jquery
									for (var m = 0; m < markers.length; m++) {
										var highlight = $('#highlight_'+markers[m][3]);
										highlight.removeClass("active");
									}
									var active = $('#highlight_'+info[3]);
									active.addClass("active");
								};
							})(marker, infoWindow, markers[i]));
							
							// Add li trigger click
							var highlight = document.getElementById('highlight_'+markers[i][3]);
							highlight.onclick = (function(object, eventType) {
								return function() {
									google.maps.event.trigger(object, eventType);
								};
							})(marker, 'click');
						}
					}
					
					var map;
					
					function initialize() {
						var mapOptions = {
							zoom: 4,
							center: new google.maps.LatLng(16.4634610, 107.5847020),
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						map = new google.maps.Map(document.getElementById('destmap'), mapOptions);
						
						generateMarkers();
					}
			
					google.maps.event.addDomListener(window, 'load', initialize);
			    </script>
				<ul id="highlights" class="left" style="width: 320px; margin: 10px 0px 0px !important;">
					<li><a id="highlight_0">Explore the evocative old quarter of Hanoi</a></li>
					<li><a id="highlight_1">Relax on Nha Trang's stunning beaches</a></li>
					<li><a id="highlight_2">Cruise the sparkling waters of Halong Bay</a></li>
					<li><a id="highlight_3">Enjoy genuine hospitality on a Mekong Delta farmstay</a></li>
					<li><a id="highlight_4">Take a ride on the famed Reunification Express</a></li>
				</ul>
				<ul id="highlights" class="right" style="width: 350px; margin: 10px 0px 0px !important;">
					<li><a id="highlight_5">Soak up the energy of Ho Chi Minh City</a></li>
					<li><a id="highlight_6">Admire ancient royal relics in Hue</a></li>
					<li><a id="highlight_7">Experience life underground in the Cu Chi Tunnels</a></li>
					<li><a id="highlight_8">Learn the secrets to Vietnamese cuisine in a cooking class</a></li>
					<li><a id="highlight_9">Ride a bike past rice paddies and hillside villages</a></li>
				</ul>
				<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
				<script type="text/javascript">
				</script>
				<div class="clr"></div>
			</div>
			<br/>
			<h2 class="overview-name">
				General Information
				<span class="right">
					<a class="expand-all">Expand All</a><a class="close-all">Close All</a>
				</span>
			</h2>
			<div class="vietnam-view-itineraries">
				<? foreach ($items as $item) { ?>
					<div class="vietnam-view-itinerary">
						<div class="less-detail less-detail-<?=$item->id?>">
							<div class="itinerary-header" onclick="$('.less-detail-<?=$item->id?>').hide(); $('.more-detail-<?=$item->id?>').show('fade')">
								<div class="left itinerary-title">
									<?=$item->title?>
								</div>
								<div class="right collapsed">
									<a title="View more"></a>
								</div>
								<div class="clr"></div>
							</div>
						</div>
						<div class="more-detail more-detail-<?=$item->id?>">
							<div class="itinerary-header" onclick="$('.more-detail-<?=$item->id?>').hide(); $('.less-detail-<?=$item->id?>').show('fade')">
								<div class="left itinerary-title">
									<?=$item->title?>
								</div>
								<div class="right expanded">
									<a title="View less"></a>
								</div>
								<div class="clr"></div>
							</div>
							<div class="left itinerary-content">
								<div class="itinerary-detail"><?=$item->summary?></div>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
	</div>
	<div class="right">
		<div id="vietnam-view-nav">
			<ul>
				<li>
					<a class="overview-selected" title="" href="">VIETNAM OVERVIEW</a>
				</li>
				<li>
					<a class="snapshot" title="" href="<?=site_url("vietnam/snapshot")?>">BEST TIME TO VISIT</a>
				</li>
				<li>
					<a class="culture" title="" href="<?=site_url("vietnam/culture-geography-history")?>">CULTURE & HISTORY</a>
				</li>
				<li>
					<a class="event" title="" href="<?=site_url("vietnam/festivals-events")?>">FESTIVALS & EVENTS</a>
				</li>
				<li>
					<a class="lifestyle" title="" href="<?=site_url("vietnam/life-style")?>">VIETNAM LIFE STYLE</a>
				</li>
				<li>
					<a class="overview" title="" href="<?=site_url("tours/vietnam")?>">VIEW ALL VIETNAM TRIPS</a>
				</li>
			</ul>
		</div>
		<? require_once(APPPATH."views/module/vietnam/glance.php"); ?>
		<div id="vietnam-moment">
			<a title="View the Vietnam's moments" href="<?=site_url("vietnam/photos")?>"><img alt="" src="<?=IMG_URL?>vietnam-moment.jpg"></a>
		</div>
		<div id="tour-view-shortlist-loader"></div>
	</div>
	<div class="clr"></div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".expand-all").click(function() {
			$(".less-detail").hide();
			$(".more-detail").show('fade');
		});
		$(".close-all").click(function() {
			$(".less-detail").show('fade');
			$(".more-detail").hide();
		});
		
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
	});
</script>