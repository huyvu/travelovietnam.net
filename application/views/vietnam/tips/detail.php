<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Travel Tips" href="<?=site_url("vietnam/travel-tips")?>">Vietnam Travel Tips</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="left" style="width: 680px">
		<h1 class="page-title"><?=$item->title?></h1>
		<div id="vietnam-view-detailed">
			<div class="overview-summary">
				<?=$item->content?>
				<div style="position:relative; margin: 10px 0; height: 30px">
					<? require(APPPATH."views/module/social.php"); ?>
				</div>
				<div class="clr"></div>
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