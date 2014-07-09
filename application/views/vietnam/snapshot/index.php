<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Best Time to Visit Vietnam
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="left" style="width: 680px">
		<h1 class="page-title">BEST TIME TO VISIT VIETNAM</h1>
		<div id="vietnam-view-detailed">
			<div class="overview-summary">
				Generally, there's no 'best' time for travelling in Vietnam as the seasons are a little vague and vary considerably from north to south, and within regions. <br>
				<br>
				In the south, the dry season generally runs from December to June with March to May being particularly hot and humid. Temperatures usually range from 27°C to 36°C during this time. The wet season brings short and heavy rain showers from July to November, with temperatures averaging between 22°C and 27°C.<br>
				<br>
				Unlike the South, the northern regions of Vietnam have four seasons. Winter is from December to February - it can be extremely cold in Hanoi and the mountainous regions, with overnight temperatures of 4°C and daytime highs between 10°C and 20°C. Summer is June to August - expect hot and humid conditions at this time, with temperatures averaging between 27°C to 30°C and high humidity.<br>	
				<br>
				<div class="item-list" style="overflow: hidden;">
					<ul>
						<div id="slideInner" style="float: left;">
							<div class="slide"><img width="630" height="180" title="Hanoi weather chart" alt="Hanoi weather chart" src="http://d3oxn90f3yphmd.cloudfront.net/sites/default/files/styles/full_size/public/elements/destination/timestogo/Hanoi_weather-chart.gif"></div>
							<div class="slide"><img width="630" height="180" title="Ho Chi Minh weather chart" alt="Ho Chi Minh weather chart" src="http://d3oxn90f3yphmd.cloudfront.net/sites/default/files/styles/full_size/public/elements/destination/timestogo/ho-chi_weather-charts.gif"></div>
						</div>
					</ul>
				</div>
			</div>
			<div class="vietnam-view-itineraries">
				<? foreach ($items as $item) { ?>
					<div class="vietnam-view-itinerary">
						<div class="more-detail" style="display: block">
							<div class="itinerary-content" style="padding: 10px">
								<div class="thumbnail">
									<a title="<?=$item->title?>" href="<?=site_url("vietnam/snapshot/{$item->alias}")?>"><img alt="" src="<?=$item->thumbnail?>"></a>
								</div>
								<div class="itinerary-detail">
									<div class="itinerary-title">
										<a title="<?=$item->title?>" href="<?=site_url("vietnam/snapshot/{$item->alias}")?>"><?=$item->title?></a>
									</div>
									<div style="margin-top: 6px">
										<?=$item->summary?>
									</div>
									<div class="view-more">
										<a title="<?=$item->title?>" href="<?=site_url("vietnam/snapshot/{$item->alias}")?>">View more</a>
									</div>
								</div>
								<div class="clr"></div>
							</div>
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
					<a class="overview" title="" href="<?=site_url("vietnam/overview")?>">VIETNAM OVERVIEW</a>
				</li>
				<li>
					<a class="snapshot-selected" title="" href="<?=site_url("vietnam/snapshot")?>">BEST TIME TO VISIT</a>
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
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
	});
</script>