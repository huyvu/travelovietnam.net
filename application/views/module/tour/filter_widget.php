<?
	$arrtooltips = array();
	$tooltips = $this->m_tooltip->getItems(1);
	foreach ($tooltips as $tooltip) {
		$arrtooltips[$tooltip->name] = $tooltip;
	}
?>

<script type="text/javascript">
	$(document).ready(function() {
		$(".filter-option").change(function() {
			$("#filter-form").submit();
		});
		$(".show-more").click(function() {
			$(".extra-destination").show('fade');
			$(".show-more").hide();
			$(".show-fewer").show();
		});
		$(".show-fewer").click(function() {
			$(".extra-destination").hide('fade');
			$(".show-more").show();
			$(".show-fewer").hide();
		});
	});
</script>

<div id="tour-filter-widget">
	<div class="container">
		<form id="filter-form" action="<?=site_url("tours/search")?>" method="GET">
			<input type="hidden" id="search-type" name="smode" value="filter">
			<div class="widget-title">PRICE <span class="help"><img class="help" alt="" src="<?=IMG_URL?>tour/icon/white-icon-info.png" title="<?=$arrtooltips["[Tour][Search][Filter][Price]"]->content?>" rel="tooltip"></span></div>
			<div class="widget-content">
				<div class="clearfix text-form">
					<select class="filter-option" id="filter-tour-price" name="price">
						<option value="">Any Amount</option>
						<option value="0-500">$0 - 500</option>
						<option value="500-1000">$500 - 1,000</option>
						<option value="1000-2000">$1,000 - 2,000</option>
						<option value="2000-3000">$2,000 - 3,000</option>
						<option value="3000-4000">$3,000 - 4,000</option>
						<option value="4000-10000">more than $4,000</option>
					</select>
					<script>$("#filter-tour-price").val('<?=$search->price?>');</script>
				</div>
			</div>
			<div class="widget-title">DURATION <span class="help"><img class="help" alt="" src="<?=IMG_URL?>tour/icon/white-icon-info.png" title="<?=$arrtooltips["[Tour][Search][Filter][Duration]"]->content?>" rel="tooltip"></span></div>
			<div class="widget-content">
				<div class="clearfix text-form">
					<select class="filter-option" id="filter-tour-duration" name="duration">
						<option value="">Any Lenght</option>
						<option value="1-2">1 - 2 days</option>
						<option value="3-4">3 - 4 days</option>
						<option value="5-8">5 - 8 days</option>
						<option value="9-14">9 - 14 days</option>
						<option value="15-20">15 - 20 days</option>
						<option value="21-30">21 - 30 days</option>
						<option value="31-365">Over 31 days</option>
					</select>
					<script>$("#filter-tour-duration").val('<?=$search->duration?>');</script>
				</div>
			</div>
			<div class="widget-title">SPECIAL OFFER <span class="help"><img class="help" alt="" src="<?=IMG_URL?>tour/icon/white-icon-info.png" title="<?=$arrtooltips["[Tour][Search][Filter][SpecialOffer]"]->content?>" rel="tooltip"></span></div>
			<div class="widget-content">
				<div class="clearfix text-form">
					<?
						$info = new stdClass();
						$info->best_seller = 1;
						$tour_num = sizeof($this->m_tour->getItems($info, 1));
					?>
					<input type="checkbox" class="filter-option" id="best-seller" name="bestseller" value="1" <?=(!empty($search->best_seller) ? 'checked="checked"' : "")?>><label class="input" for="best-seller">Best seller</label> <label class="total-number"><?="($tour_num)"?></label>
				</div>
				<div class="clearfix text-form">
					<?
						$info = new stdClass();
						$info->promotion = 1;
						$tour_num = sizeof($this->m_tour->getItems($info, 1));
					?>
					<input type="checkbox" class="filter-option" id="promotion" name="promotion" value="1" <?=(!empty($search->promotion) ? 'checked="checked"' : "")?>><label class="input" for="promotion">Promotion tours</label> <label class="total-number"><?="($tour_num)"?></label>
				</div>
				<div class="clearfix text-form">
					<?
						$info = new stdClass();
						$info->popular = 1;
						$tour_num = sizeof($this->m_tour->getItems($info, 1));
					?>
					<input type="checkbox" class="filter-option" id="popular" name="popular" value="1" <?=(!empty($search->popular) ? 'checked="checked"' : "")?>><label class="input" for="popular">Popular tours</label> <label class="total-number"><?="($tour_num)"?></label>
				</div>
			</div>
			<div class="widget-title">TYPES <span class="help"><img class="help" alt="" src="<?=IMG_URL?>tour/icon/white-icon-info.png" title="<?=$arrtooltips["[Tour][Search][Filter][TourType]"]->content?>" rel="tooltip"></span></div>
			<div class="widget-content">
				<div class="clearfix text-form">
					<?
						$info = new stdClass();
						$info->daily = 1;
						$tour_num = sizeof($this->m_tour->getItems($info, 1));
					?>
					<input type="checkbox" class="filter-option" id="daily" name="type[]" value="daily" <?=((!empty($search->types) && in_array("daily", $search->types)) ? 'checked="checked"' : "")?>><label class="input" for="daily">Daily tours</label> <label class="total-number"><?="($tour_num)"?></label>
				</div>
				<div class="clearfix text-form">
					<?
						$info = new stdClass();
						$info->throughout = 1;
						$tour_num = sizeof($this->m_tour->getItems($info, 1));
					?>
					<input type="checkbox" class="filter-option" id="throughout" name="type[]" value="throughout" <?=((!empty($search->types) && in_array("throughout", $search->types)) ? 'checked="checked"' : "")?>><label class="input" for="throughout">Throughout tours</label> <label class="total-number"><?="($tour_num)"?></label>
				</div>
			</div>
			<div class="widget-title">THEMES <span class="help"><img class="help" alt="" src="<?=IMG_URL?>tour/icon/white-icon-info.png" title="<?=$arrtooltips["[Tour][Search][Filter][TourTheme]"]->content?>" rel="tooltip"></span></div>
			<div class="widget-content">
				<?
					foreach ($categories as $category) {
						if (!$category->tour_num) {
							continue;
						}
				?>
					<div class="clearfix text-form">
						<input type="checkbox" class="filter-option" id="category-<?=$category->id?>" name="category[]" value="<?=$category->id?>" <?=((!empty($search->categories) && in_array($category->id, $search->categories)) ? 'checked="checked"' : "")?>><label class="input" for="category-<?=$category->id?>"><?=$category->name?></label> <label class="total-number"><?="({$category->tour_num})"?></label>
					</div>
				<? } ?>
			</div>
			<div class="widget-title">REGIONS <span class="help"><img class="help" alt="" src="<?=IMG_URL?>tour/icon/white-icon-info.png" title="<?=$arrtooltips["[Tour][Search][Filter][Region]"]->content?>" rel="tooltip"></span></div>
			<div class="widget-content">
				<div class="clearfix text-form">
					<?
						$info = new stdClass();
						$info->regions = array("Northern");
						$tour_num = sizeof($this->m_tour->getItems($info, 1));
					?>
					<input type="checkbox" class="filter-option" id="northern-vietnam" name="region[]" value="Northern" <?=((!empty($search->regions) && in_array("Northern", $search->regions)) ? 'checked="checked"' : "")?>><label class="input" for="northern-vietnam">Northern of Vietnam</label> <label class="total-number"><?="($tour_num)"?></label>
				</div>
				<div class="clearfix text-form">
					<?
						$info = new stdClass();
						$info->regions = array("Central");
						$tour_num = sizeof($this->m_tour->getItems($info, 1));
					?>
					<input type="checkbox" class="filter-option" id="central-vietnam" name="region[]" value="Central" <?=((!empty($search->regions) && in_array("Central", $search->regions)) ? 'checked="checked"' : "")?>><label class="input" for="central-vietnam">Central of Vietnam</label> <label class="total-number"><?="($tour_num)"?></label>
				</div>
				<div class="clearfix text-form">
					<?
						$info = new stdClass();
						$info->regions = array("Southern");
						$tour_num = sizeof($this->m_tour->getItems($info, 1));
					?>
					<input type="checkbox" class="filter-option" id="southern-vietnam" name="region[]" value="Southern" <?=((!empty($search->regions) && in_array("Southern", $search->regions)) ? 'checked="checked"' : "")?>><label class="input" for="southern-vietnam">Southern of Vietnam</label> <label class="total-number"><?="($tour_num)"?></label>
				</div>
			</div>
			<div class="widget-title">DESTINATIONS <span class="help"><img class="help" alt="" src="<?=IMG_URL?>tour/icon/white-icon-info.png" title="<?=$arrtooltips["[Tour][Search][Filter][Destination]"]->content?>" rel="tooltip"></span></div>
			<div class="widget-content">
				<?
					$regions = !empty($search->regions) ? $search->regions : array();
					$idx = 0;
					foreach ($destinations as $destination) {
						if (!$destination->tour_num) {
							continue;
						}
						if (!sizeof($regions) || in_array("Throughout", $regions) || in_array($destination->region, $regions)) {
							$idx++;
				?>
					<div class="clearfix text-form <?=($idx>10)?"extra-destination none":""?>">
						<input type="checkbox" class="filter-option" id="destination-<?=$destination->id?>" name="destination[]" value="<?=$destination->id?>" <?=((!empty($search->destinations) && in_array($destination->id, $search->destinations)) ? 'checked="checked"' : "")?>><label class="input" for="destination-<?=$destination->id?>"><?=$destination->name?></label> <label class="total-number"><?="({$destination->tour_num})"?></label>
					</div>
				<?		}
					}
					if ($idx > 10) {
				?>
					<div class="clearfix" style="margin-top: 5px">
						<a class="show-more">Show more</a>
						<a class="show-fewer none">Show fewer</a>
					</div>
				<?
					}
				?>
			</div>
		</form>
	</div>
</div>