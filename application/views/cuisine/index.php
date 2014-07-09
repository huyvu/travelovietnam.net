<script type="text/javascript">
	$(document).ready(function() {
		var leftHeight = $(".cuisines").height();
		var rightHeight = $(".categories").height();
		if (leftHeight < rightHeight){
			$(".cuisines").height(rightHeight);
		}
	});
</script>

<div id="home-wizban">
	<div id="main">
		<div class="metro_gallery flip vertical" style="width: 980px;">
			<div class="tile tile_1x1">
				<img src="<?=IMG_URL?>cuisine/meal1.jpg" data-caption="" />
				<img src="<?=IMG_URL?>cuisine/meal2.jpg" data-caption="" />
			</div>
			<div class="tile tile_1x2">
				<img src="<?=IMG_URL?>cuisine/meal3.jpg" data-caption="" />
			</div>
			<div class="tile tile_1x1">
				<img src="<?=IMG_URL?>cuisine/meal4.jpg" data-caption="" />
				<img src="<?=IMG_URL?>cuisine/meal5.jpg" data-caption="" />
			</div>
			<div class="tile tile_1x1">
				<img src="<?=IMG_URL?>cuisine/meal5.jpg" data-caption="" />
				<img src="<?=IMG_URL?>cuisine/meal7.jpg" data-caption="" />
			</div>
			<div class="tile tile_1x2">
				<img src="<?=IMG_URL?>cuisine/meal6.jpg" data-caption="" />
			</div>
			<div class="tile tile_1x1">
				<img src="<?=IMG_URL?>cuisine/meal1.jpg" data-caption="" />
				<img src="<?=IMG_URL?>cuisine/meal2.jpg" data-caption="" />
			</div>
			<div class="tile tile_1x1">
				<img src="<?=IMG_URL?>cuisine/meal1.jpg" data-caption="" />
				<img src="<?=IMG_URL?>cuisine/meal2.jpg" data-caption="" />
			</div>
			<div class="tile tile_1x1">
				<img src="<?=IMG_URL?>cuisine/meal1.jpg" data-caption="" />
				<img src="<?=IMG_URL?>cuisine/meal2.jpg" data-caption="" />
			</div>
		</div>
	</div>
	<div id="wizban-bottom-bar">
		<div class="chef-avatar"><img alt="" src="<?=IMG_URL?>cuisine/chef.jpg"></div>
		<div class="number-stat">
			<span class="">40</span>
			<span class="">posts</span>
		</div>
	</div>
</div>
<? if (!empty($cuisine_category)) { ?>
<div id="breadcrumbs">
	<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
	<img alt="" src="<?=IMG_URL?>arrow.png">
	<a class="pathway" title="Vietnam Cuisines" href="<?=site_url("cuisines/vietnam")?>">Vietnam Cuisines</a>
	<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$cuisine_category->name?>
	<? require_once(APPPATH."views/module/social.php"); ?>
</div>
<? } ?>
<div id="content">
	<div class="left cuisines">
		<div class="display-stat">
			All 12 dishes, 40 posts
		</div>
		<ul class="cuisine-list">
			<? foreach ($cuisines as $cuisine) { ?>
			<li class="cuisine">
				<div class="thumb"><a title="<?=$cuisine->title?>" href="<?=site_url("cuisines/vietnam/{$cuisine->category_alias}/{$cuisine->alias}")?>"><img alt="" src="<?=$cuisine->thumbnail?>"></a></div>
				<h3 class="name"><a title="<?=$cuisine->title?>" href="<?=site_url("cuisines/vietnam/{$cuisine->category_alias}/{$cuisine->alias}")?>"><?=$cuisine->title?></a></h3>
				<p><?=word_limiter(strip_tags($cuisine->summary), 14)?></p>
				<div class="readmore">
					<div class="left">100 comments</div>
					<div class="right"><a title="<?=$cuisine->title?>" href="<?=site_url("cuisines/vietnam/{$cuisine->category_alias}/{$cuisine->alias}")?>">Detail</a></div>
					<div class="clr"></div>
				</div>
			</li>
			<? } ?>
		</ul>
	</div>
	<div class="right categories">
		<div class="cusine-categories">
			<div class="title">VIETNAMESE FOODS</div>
			<ul>
				<li>
					<a class="<?=empty($cuisine_category) ? "selected" : ""?>" title="View all Vietnamese dishes" href="<?=site_url("cuisines/vietnam")?>">All Vietnamese dishes</a>
				</li>
				<? foreach ($cuisine_categories as $category) { ?>
				<li>
					<a class="<?=(!empty($cuisine_category) && ($category->id == $cuisine_category->id)) ? "selected" : ""?>" title="<?=$category->name?>" href="<?=site_url("cuisines/vietnam/{$category->alias}")?>"><?=$category->name?></a>
				</li>
				<? } ?>
			</ul>
		</div>
		<div class="most-popular">
			<div class="title">MOST POPULAR</div>
			<div class="content">
				<? foreach ($popular_cuisines as $cuisine) { ?>
				<div class="popular-item">
					<a title="<?=$cuisine->title?>" href="<?=site_url("cuisines/vietnam/{$cuisine->category_alias}/{$cuisine->alias}")?>" class="thumb_105_75">
						<img src="<?=$cuisine->thumbnail?>">
					</a>
					<div class="summary">
						<h3 class="name"><a title="<?=$cuisine->title?>" href="<?=site_url("cuisines/vietnam/{$cuisine->category_alias}/{$cuisine->alias}")?>"><?=$cuisine->title?></a></h3>
						<p><?=word_limiter(strip_tags($cuisine->summary), 10)?></p>
					</div>
					<div class="clr"></div>
				</div>
				<? } ?>
			</div>
		</div>
		<div class="featured">
			<div class="title">BEST OF VIETNAM</div>
			<div class="thumb">
				<img alt="" src="<?=IMG_URL?>cuisine/featured.jpg">
			</div>
		</div>
	</div>
	<div class="clr"></div>
</div>
<div class="clr"></div>

<style type="text/css">
div.tile {
	margin-top: 1px;
	margin-right: 1px;
	margin-bottom: 1px;
	margin-left: 0px;
}
div.tile_1x1 {
	width: 194px;
	height: 154px;
}
div.tile_1x2 {
	width: 194px;
	height: 310px;
}
div.tile div.img_container {
	top: 0px;
	right: 0px;
	left: 0px;
	bottom: 0px;
}
</style>