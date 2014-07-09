<div id="breadcrumbs">
	<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
	<img alt="" src="<?=IMG_URL?>arrow.png"> <a class="pathway" title="Vietnam Travel Destinations" href="<?=site_url("destinations/vietnam")?>">Vietnam Travel Destinations</a>
	<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$destination->name?>
	<? require_once(APPPATH."views/module/social.php"); ?>
</div>
<div class="">
	<div class="ttattdirec">
		<a class="pathway" title="Vietnam Travel Destinations" href="<?=site_url("destinations/vietnam")?>">Vietnam Travel Destinations</a> &raquo; <?=$destination->name?>
		<div class="vnhotels arrowacti"><span></span></div>
	</div>
	<div class="desmap"></div>
	<ul class="bydest">
		<? foreach ($tours as $tour) { ?>
			<li>
				<span><a href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/{$tour->alias}")?>" title="<?=$tour->name?>"><?=$tour->name?></a></span>
			</li>
		<? } ?>
	</ul>
	<ul class="bydest">
		<? foreach ($hotels as $hotel) { ?>
			<li>
				<span><a href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>" title="<?=$hotel->name?>"><?=$hotel->name?></a></span>
			</li>
		<? } ?>
	</ul>
</div>
