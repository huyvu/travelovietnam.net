<div class="inner content-13x20">
	<div id="vietnam-moments">
		<div class="nav">
			<div class="left types">
				<ul>
					<li class="on">
						<a title="Vietnam Photos" href="<?=site_url("vietnam/photos")?>">Photos</a>
						<b class="caret"></b>
					</li>
					<li>
						<a title="Vietnam Video" href="<?=site_url("vietnam/video")?>">Video</a>
					</li>
				</ul>
			</div>
			<div class="right categories">
				<ul>
					<li class="<?=((empty($selected_category))?"on":"")?>"><a title="View all" href="<?=site_url("vietnam/photos")?>">View all</a></li>
					<? foreach ($categories as $category) { ?>
					<li class="<?=((!empty($selected_category) && $selected_category->id==$category->id)?"on":"")?>"><a title="<?=$category->name?>" href="<?=site_url("vietnam/photos/{$category->alias}")?>"><?=$category->name?></a></li>
					<? } ?>
				</ul>
			</div>
			<div class="clr"></div>
		</div>
		<div class="gallery">
			<? foreach ($items as $item) {
				$photo_info->album_id = $item->id;
				$photos = $this->m_album_photo->getItems($photo_info, 1);
			?>
			<div class="album">
				<div class="content">
					<div class="img">
						<a title="<?=$item->name?>" href="<?=site_url("vietnam/photos/{$item->category_alias}/{$item->alias}")?>"><img alt="<?=$item->name?>" src="<?=$item->thumbnail?>"></a>
					</div>
					<div class="img-caption">
						<a title="<?=$item->name?>" href="<?=site_url("vietnam/photos/{$item->category_alias}/{$item->alias}")?>"><?=$item->name?></a>
					</div>
					<div class="author">
						<div class="left"><?=$item->hit?> views</div>
						<div class="right"><?=sizeof($photos)?> photos</div>
						<div class="clr"></div>
					</div>
				</div>
			</div>
			<? } ?>
			<div class="clr"></div>
		</div>
	</div>
</div>