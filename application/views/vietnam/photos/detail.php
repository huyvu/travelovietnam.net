<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=album_photo]").fancybox();
	});
</script>
<style type="text/css">
	#fancybox-right {
	    left: 300px;
	    right: auto;
	}
	#fancybox-right:hover span {
	    left: auto;
	    right: 15px;
	}
	#fancybox-left-ico, #fancybox-right-ico {
	    width: 23px;
	    height: 45px;
	}
	#fancybox-left-ico {
	    background: url("<?=IMG_URL?>vietnam/fancybox/fancybox-left-ico.png") no-repeat scroll 0 0 transparent;
	}
	#fancybox-right-ico {
	    background: url("<?=IMG_URL?>vietnam/fancybox/fancybox-right-ico.png") no-repeat scroll 0 0 transparent;
	}
	#fancybox-close {
	    background: url("<?=IMG_URL?>vietnam/fancybox/fancybox-close.png") no-repeat scroll 0 0 transparent;
	    height: 9px;
	    width: 9px;
	    right: 10px;
	    top: 10px;
	}
</style>
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
		<div class="photos">
			<? foreach ($photos as $photo) { ?>
			<div class="photo">
				<div class="content">
					<div class="img">
						<a rel="album_photo" href="<?=site_url("vietnam/photos/$selected_category->alias/$album->alias/$photo->alias")?>"><img alt="" src="<?=$photo->thumbnail?>"></a>
					</div>
					<div class="img-caption">
						<?=$photo->name?>
					</div>
				</div>
			</div>
			<? } ?>
			<div class="clr"></div>
		</div>
	</div>
</div>