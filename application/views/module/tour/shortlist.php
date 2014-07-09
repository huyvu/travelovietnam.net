<?
	if (!empty($shortlist) && sizeof($shortlist)) {
?>
<div id="tour-view-shortlist">
	<div class="shortlist-header">SHORTLIST</div>
	<ul>
		<? foreach ($shortlist as $item) { ?>
		<li>
			<div class="left">
				<div class="shortlist-tour-thumbnail">
					<a title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>"><img alt="<?=$item->name?>" src="<?=$item->thumbnail?>"/></a>
				</div>
			</div>
			<div class="right" style="width: 150px;">
				<div class="shortlist-tour-name"><a title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>"><?=$item->name?></a></div>
				<div class="shortlist-tour-duration"><?=($item->duration > 1) ? $item->duration." days - ".($item->duration-1)." nights" : $item->duration." day"?></div>
				<div class="shortlist-tour-price">from <label>$<?=number_format($item->price,2,'.',',')?></label></div>
			</div>
			<div class="clr"></div>
			<div class="shortlist-tour-type">
				Theme: <a title="" href=""><?=$this->m_tour_category->load($item->category_id)->name?></a>
			</div>
		</li>
		<? } ?>
	</ul>
	<div style="text-align: right;">
		<a title="View all my shortlist" href="<?=site_url("tours/myshortlist")?>">View all &raquo;</a>
	</div>
</div>
<?
	}
?>

