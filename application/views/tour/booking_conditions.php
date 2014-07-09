<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Tours" href="<?=site_url("tours/search")?>">Vietnam Tours</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title"><?=$item->title?></h1>
	<div style="margin-top: 10px">
		<div class="left" style="width: 680px">
			<div id="tour-booking-condition">
				<div class="content">
					<?=$item->content?>
				</div>
			</div>
		</div>
		<div class="right">
			<? require_once(APPPATH."views/module/tour/search_widget.php"); ?>
			<? require_once(APPPATH."views/module/tour/customize.php"); ?>
			<div id="tour-view-shortlist-loader"></div>
		</div>
		<div class="clr"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
	});
</script>