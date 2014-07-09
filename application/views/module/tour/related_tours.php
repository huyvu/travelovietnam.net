<script type="text/javascript">
	$(document).ready(function() {
		$(".related-tour-show-more").click(function() {
			$(".related-tour-extra").show('fade');
			$(".related-tour-show-more").hide();
			$(".related-tour-show-fewer").show();
		});
		$(".related-tour-show-fewer").click(function() {
			$(".related-tour-extra").hide('fade');
			$(".related-tour-show-more").show();
			$(".related-tour-show-fewer").hide();
		});
	});
</script>

<? if (!empty($more_tours) && sizeof($more_tours)) { ?>
<div id="tour-view-shortlist">
	<div class="shortlist-header">MORE TRIPS LIKE THIS...</div>
	<ul>
		<?
			$idx = 0;
			foreach ($more_tours as $item) {
				$idx++;
		?>
		<li class="<?=($idx>3)?"related-tour-extra none":""?>">
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
		<?
			}
		?>
	</ul>
	<? if ($idx > 3) { ?>
		<div class="clearfix">
			<a class="related-tour-show-more">Show more</a>
			<a class="related-tour-show-fewer" style="display: none;">Show fewer</a>
		</div>
	<? } ?>
</div>
<? } ?>