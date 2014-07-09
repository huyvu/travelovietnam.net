<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
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