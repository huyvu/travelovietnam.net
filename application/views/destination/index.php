<div id="breadcrumbs">
	<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
	<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Travel Destinations
	<? require_once(APPPATH."views/module/social.php"); ?>
</div>
<div class="">
	<div class="ttattdirec">
		Vietnam Travel Destinations
		<div class="vnhotels arrowacti"><span></span></div>
	</div>
	<div class="desmap"></div>
	<ul class="bydest">
		<? 
		$size = sizeof($destinations);
		$cnt  = 0;
		foreach ($destinations as $destination) {
			$cnt_hotels = 0;
			$cnt_tours  = 0;
			foreach ($hotels as $hotel) {
				if ($hotel->city_alias == $destination->alias) {
					$cnt_hotels ++;
				}
			}
			foreach ($tours as $tour) {
				if ($tour->city_alias == $destination->alias) {
					$cnt_tours ++;
				}
			}
		?>
		<li>
			<span class="left"><a href="<?=site_url("destinations/vietnam/{$destination->alias}")?>" title="<?=$destination->name?>"><?=$destination->name?></a></span>
			<span class="right">(<?=$cnt_tours?> tours, <?=$cnt_hotels?> hotels)</span>
		</li>
		<?
			$cnt++;
			if ($cnt >= $size/3) {
				$cnt  = 0;
				?>
				</ul>
				<ul class="bydest">
				<?
			}
		} ?>
	</ul>
	<div class="ttattdirec">
		Vietnam Travel Directory
		<div class="vnhotels arrowacti"><span></span></div>
	</div>
	<ul class="tabanpha">
		<?
			$char = "A";
			do {
				?>
				<li class="bg1px"><a class="scroll" href="#<?=$char?>"><?=$char?></a></li>
				<?
			} while ($char++ < "Z");
		?>
	</ul>
	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="listatt">
		<tbody>
		<?
			$char = "A";
			do {
				?>
				<tr id="<?=$char?>">
					<td class="first">
						<div class="bgtab">
							<div class="bgtabin bg1px"><?=$char?></div>
							<div class="arrowtab vnhotels"><span></span></div>
						</div>
					</td>
					<td>
						<div>Tours & Vacations</div>
						<ul class="itematt">
							<? foreach ($tours as $tour) {
								if (substr(strtoupper($tour->name), 0, 1) == $char) { ?>
									<li><a title="<?=$tour->name?>" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/{$tour->alias}")?>"><?=$tour->name?></a></li>
							<? }
							} ?>
						</ul>
					</td>
					<td>
						<div>Hotels & Resorts</div>
						<ul class="itematt">
							<? foreach ($hotels as $hotel) {
								if (substr(strtoupper($hotel->name), 0, 1) == $char) { ?>
									<li><a title="<?=$hotel->name?>" href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>"><?=$hotel->name?></a></li>
							<? }
							} ?>
						</ul>
					</td>
				</tr>
				<?
			} while ($char++ < "Z");
		?>
		</tbody>
	</table>
</div>
