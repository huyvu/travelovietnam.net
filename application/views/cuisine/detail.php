<script type="text/javascript">
	function showTab(index) {
		var tabs  = new Array("tab1", "tab2");
		var navs  = new Array("nav1", "nav2");
		for (var i=0; i<tabs.length; i++) {
			if (i == index){
				$("#"+navs[i]).addClass('selected');
				$("#"+tabs[i]).fadeIn("slow");
			} else {
				$("#"+navs[i]).removeClass('selected');
				$("#"+tabs[i]).hide();
			}
		}
		var leftHeight = $(".cuisines").height();
		var rightHeight = $(".categories").height();
		if (leftHeight < rightHeight){
			$(".cuisines").height(rightHeight);
		}
	}
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
<div id="breadcrumbs">
	<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
	<img alt="" src="<?=IMG_URL?>arrow.png">
	<a class="pathway" title="Vietnam Cuisines" href="<?=site_url("cuisines/vietnam")?>">Vietnam Cuisines</a>
	<img alt="" src="<?=IMG_URL?>arrow.png">
	<a class="pathway" title="<?=$item->category_name?>" href="<?=site_url("cuisines/vietnam/{$item->category_alias}")?>"><?=$item->category_name?></a>
	<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
	<? require_once(APPPATH."views/module/social.php"); ?>
</div>
<div id="content">
	<div class="left cuisines">
		<div class="detailed-cuisine-title">
			<h1><?=$item->title?></h1>
		</div>
		<div class="detailed-cuisine-content">
			<?=$item->content?>
		</div>
		<div id="cuisine-share-tools">
			<div class="addthis_toolbox addthis_default_style" style="height: 20px; margin-top: 5px; overflow: hidden;">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
				<a class="addthis_counter addthis_pill_style"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51bebb7f7f132dfb"></script>
		</div>
		<div id="cuisine-view-detail">
			<ul class="tabs">
				<li><a id="nav1" href="javascript:void(0)" class="selected" onclick="showTab(0)">Questions</a></li>
				<li><a id="nav2" href="javascript:void(0)" onclick="showTab(1)">Reviews</a></li>
			</ul>
			<div class="clr"></div>
			<div id="tab1" class="tab-selected">
				<?=$questions?>
			</div>
			<div id="tab2" class="tab-content">
				<?=$reviews?>
			</div>
		</div>
	</div>
	<div class="right categories">
		<div class="cusine-categories">
			<div class="title">VIETNAMESE FOODS</div>
			<ul>
				<li>
					<a title="View all Vietnamese dishes" href="<?=site_url("cuisines/vietnam")?>">All Vietnamese dishes</a>
				</li>
				<? foreach ($cuisine_categories as $category) { ?>
				<li>
					<a class="<?=($category->alias == $item->category_alias) ? "selected" : ""?>" title="<?=$category->name?>" href="<?=site_url("cuisines/vietnam/{$category->alias}")?>"><?=$category->name?></a>
				</li>
				<? } ?>
			</ul>
		</div>
		<div class="most-popular">
			<div class="title">RELATED FOODS</div>
			<div class="content">
				<? foreach ($related_cuisines as $cuisine) { ?>
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