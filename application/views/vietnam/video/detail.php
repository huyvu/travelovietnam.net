<div class="inner content-13x20">
	<div id="vietnam-moments">
		<div class="nav">
			<div class="left types">
				<ul>
					<li>
						<a title="Vietnam Photos" href="<?=site_url("vietnam/photos")?>">Photos</a>
					</li>
					<li class="on">
						<a title="Vietnam Video" href="<?=site_url("vietnam/video")?>">Video</a>
						<b class="caret"></b>
					</li>
				</ul>
			</div>
			<div class="clr"></div>
		</div>
		<div class="video-detail">
			<div class="left video">
				<div class="content">
					<div class="img">
						<?=$item->embeded_video?>
					</div>
					<div class="img-caption">
						<?=$item->name?>
					</div>
					<div class="hit-rate">
						<div class="left"><?=$item->hit?> views</div>
						<div class="right"><?=date('M/d/Y', strtotime($item->created_date))?></div>
						<div class="clr"></div>
					</div>
				</div>
				<div id="share-tools">
					<div class="addthis_toolbox addthis_default_style" style="height: 20px; margin-top: 5px; overflow: hidden;">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
						<a class="addthis_counter addthis_pill_style"></a>
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51bebb7f7f132dfb"></script>
				</div>
				<div id="review-tools">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<script type="text/javascript">
						function showTab(index) {
							var tabs  = new Array("tab1", "tab2", "tab3");
							var navs  = new Array("nav1", "nav2", "nav3");
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
					<ul class="tabs">
						<li><a id="nav1" href="javascript:void(0)" class="selected" onclick="showTab(0)">Comments</a></li>
						<li><a id="nav2" href="javascript:void(0)" onclick="showTab(1)">Reviews</a></li>
						<li><a id="nav3" href="javascript:void(0)" onclick="showTab(2)">Questions</a></li>
					</ul>
					<div class="clr"></div>
					<div id="tab1" class="tab-selected">
						<div class="fb-comments" data-href="<?=current_url()?>" data-width="644px" data-numposts="10" data-colorscheme="light"></div>
					</div>
					<div id="tab2" class="tab-content">
						<?=$reviews?>
					</div>
					<div id="tab3" class="tab-content">
						<?=$questions?>
					</div>
				</div>
			</div>
			<div class="right related">
				<? foreach ($related_items as $related) { ?>
				<div class="related-item">
					<div class="left img">
						<a title="" href="<?=site_url("vietnam/video/{$related->category_alias}/{$related->alias}")?>"><img alt="" src="<?=$related->thumbnail?>"></a>
					</div>
					<div class="img-caption">
						<a title="" href="<?=site_url("vietnam/video/{$related->category_alias}/{$related->alias}")?>"><?=$related->name?></a>
					</div>
					<div class="created-date">
						<?=date('M/d/Y', strtotime($related->created_date))?>
					</div>
					<div class="hit-rate">
						<?=$related->hit?> views
					</div>
					<div class="clr"></div>
				</div>
				<div class="related-item-div"></div>
				<? } ?>
			</div>
			<div class="clr"></div>
		</div>
	</div>
</div>