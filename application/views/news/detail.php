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
	}
</script>

<div id="view-container">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <a class="pathway" title="Vietnam Travel News" href="<?=site_url("news")?>">Vietnam Travel News</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="view-content">
		<div class="left news">
			<div class="detail">
				<h1 class="title"><?=$item->title?></h1>
				<?=$item->content?>
				<div id="news-share-tools">
					<div class="addthis_toolbox addthis_default_style" style="height: 20px; margin-top: 5px; overflow: hidden;">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
						<a class="addthis_counter addthis_pill_style"></a>
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51bebb7f7f132dfb"></script>
				</div>
				<div id="news-view-detail">
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
				<?	$others = $this->m_content->getRelatedItems($item->id);
					if (!empty($others) && sizeof($others) > 0) { ?>
					<h2 class="title">Related Information</h2>
					<ul class="others">
						<? foreach ($others as $other) { ?>
						<li><h4 class="title"><a title="<?=$other->title?>" href="<?=site_url("news/view/".$other->alias)?>" class="link-othernews"><?=$other->title?></a></h4></li>
						<? } ?>
					</ul>
				<? } ?>
			</div>
		</div>
		<div class="right categories">
			<div class="news-categories">
				<div class="title">CATEGORIES</div>
				<ul>
				</ul>
			</div>
			<div class="most-popular">
				<div class="title">RELATED NEWS</div>
				<div class="content">
				</div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
</div>