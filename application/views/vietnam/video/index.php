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
		<div class="videos">
			<? foreach ($items as $item) { ?>
			<div class="video">
				<div class="content">
					<div class="img">
						<a title="" href="<?=site_url("vietnam/video/{$item->category_alias}/{$item->alias}")?>">
							<img alt="<?=$item->name?>" src="<?=$item->thumbnail?>">
							<div class="play-icon">
								<img alt="" src="<?=IMG_URL?>play-icon.png">
							</div>
						</a>
					</div>
					<div class="img-caption">
						<a title="" href="<?=site_url("vietnam/video/{$item->category_alias}/{$item->alias}")?>"><?=$item->name?></a>
					</div>
					<div class="author">
						<div class="left"><?=$item->hit?> views</div>
						<div class="right"><?=date('M/d/Y', strtotime($item->created_date))?></div>
						<div class="clr"></div>
					</div>
				</div>
			</div>
			<? } ?>
			<div class="clr"></div>
		</div>
	</div>
</div>