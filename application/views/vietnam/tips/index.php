<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Travel Tips
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="left" style="width: 680px">
		<h1 class="page-title">VIETNAM TRAVEL TIPS</h1>
		<div id="vietnam-view-detailed">
			<div class="overview-desc">
				The TraveloVietnam Foundation provides travellers with an opportunity to give something back to the many wonderful communities we travel to. By donating to The TraveloVietnam Foundation you can make a difference in local communities - in health care, education, human rights, child welfare and the protection of wildlife and the environment.
			</div>
			<div class="vietnam-view-itineraries">
				<? foreach ($items as $item) { ?>
					<div class="vietnam-view-itinerary">
						<div class="more-detail" style="display: block">
							<div class="itinerary-content" style="padding: 10px">
								<div class="thumbnail">
									<a title="<?=$item->title?>" href="<?=site_url("vietnam/travel-tips/{$item->alias}")?>"><img alt="" src="<?=$item->thumbnail?>"></a>
								</div>
								<div class="itinerary-detail">
									<div class="itinerary-title">
										<a title="<?=$item->title?>" href="<?=site_url("vietnam/travel-tips/{$item->alias}")?>"><?=$item->title?></a>
									</div>
									<div style="margin-top: 6px">
										<?=$item->summary?>
									</div>
									<div class="view-more">
										<a title="<?=$item->title?>" href="<?=site_url("vietnam/travel-tips/{$item->alias}")?>">View more</a>
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
					<a class="guide4beginner" title="" href="<?=site_url("vietnam/travel-guide-for-beginner")?>">GUIDE FOR BEGINNER</a>
				</li>
				<li>
					<a class="traveltip-selected" title="" href="<?=site_url("vietnam/travel-tips")?>">VIETNAM TRAVEL TIPS</a>
				</li>
				<li>
					<a class="insurance" title="" href="<?=site_url("vietnam/travel-insurances")?>">TRAVEL INSURANCES</a>
				</li>
				<li>
					<a class="travelvisa" title="" href="<?=site_url("vietnam/travel-visa")?>">VISA FOR TRAVEL</a>
				</li>
				<li>
					<a class="faq" title="" href="<?=site_url("vietnam/faqs")?>">VIETNAM FAQ</a>
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