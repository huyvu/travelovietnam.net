<?
	if (isset($dest)) {
		$destination = $this->m_tour_destination->load($dest->destination_id);
		$entertainment_info->destinations = array($dest->destination_id);
		$entertainments = $this->m_entertainment->getItems($entertainment_info,1);

		$shopping_info->destinations = array($dest->destination_id);
		$shoppings = $this->m_shopping->getItems($shopping_info,1);

		$sight_info->destinations = array($dest->destination_id);
		$sights = $this->m_sight->getItems($sight_info,1);

		$tour_info->going_to = $dest->destination_id;
		$tours = $this->m_tour->getItems($tour_info, 1);			
	}else{
		$entertainments = $this->m_entertainment->getItems(1);
		$shoppings = $this->m_shopping->getItems(1);
		$sights = $this->m_sight->getItems(1);
		$tours = $this->m_tour->getItems(NULL, 1);		
	}
		
?>
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Top Destinations" href="<?=site_url("vietnam/top-destinations")?>">Vietnam Top Destinations</a>
		<?if(isset($dest)) :?>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Top Destinations" href="<?=site_url("vietnam/top-destinations/{$destination->alias}")?>"><?=$dest->title?></a>
		<img alt="" src="<?=IMG_URL?>arrow.png">Restaurants of <?=$dest->title?>
		<?endif?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title"><?=(isset($dest))?strtoupper($dest->title)."'S RESTAURANTS":"RESTAURANTS IN VIETNAM"?></h1>
	<div class="left" style="width: 680px">
		<div id="things-todo">
			<div class="sights">
				<?
					$idx = 1;
					$row = 1;
					$rowidx = 1;
					foreach ($items as $item) {
						$city = $this->m_tour_destination->load($item->city);
						$count = $this->m_review->getItemsCount(11,$item->id,1);
						$avg_rating = 0;
						$rev_info->category_id = 11;
						$rev_info->ref_id = $item->id;
						$reviews = $this->m_review->getItems($rev_info,1);
						foreach ($reviews as $review) {
							$avg_rating += $review->rating;
						}
						if (sizeof($reviews)) {
							$avg_rating = round($avg_rating / sizeof($reviews));
						}else{
							$avg_rating = 4;
						}
				?>
				<div style="overflow: inherit;position: relative;float: left;">
					<?if($item->top_choice) :?>
					<div class="top-choice">
						<img alt="" src="<?=IMG_URL?>destination/top-choice.png">
					</div>
					<?endif?>
					<div class="destination destination<?=$idx?> row<?=$row?> <?=(($row>1)?"none":"")?>">
						<div class="flag">
							<img alt="" src="<?=IMG_URL?>vietnam/restaurant.png">
						</div>
						<div class="thumbnail">
							<a title="<?=$item->title?>" href="<?=site_url("vietnam/restaurants/{$item->alias}")?>">
								<img alt="<?=$item->title?>" src="<?=$item->thumbnail?>">
							</a>
						</div>
						<div class="content">
							<p style="font-style: italic;font-size: 13px;color: #cc6633">Out door</p>
							<h1 class="title">
								<a title="<?=$item->title?>" href="<?=site_url("vietnam/restaurants/{$item->alias}")?>"><?=$item->title?></a>
							</h1>
							<p class="reviews">
								<img src="<?=IMG_URL?>tour/icon/star<?=$avg_rating?>.png" alt="rating" height="15">
								<a href="#"><?=$count->count?> <?=($count->count>1)?'Reviews':'Review'?></a>
							</p>
							<div class="summary">
								<?=$item->summary?>
							</div>
						</div>
					</div>
				</div>
				<?
						$idx = ($idx%3) + 1;
						if ($rowidx == 12) {
							$row++;
						}
						$rowidx = ($rowidx%12) + 1;
					}
				?>
				<div class="clr"></div>
				<? if (($row) > 1 && sizeof($items) > 12) { ?>
				<div class="show-more-container">
					<a class="link more-destinations">Show more</a>
				</div>
				<? } ?>
			</div>
		</div>
	</div>
	<div class="right">
		<div class="destination-nav">
			<ul>
				<?if (isset($dest)) {?>
					<li><a href="<?=(sizeof($sights)!=0)?site_url("vietnam/sights/{$dest->alias}"):site_url("vietnam/sights")?>" class="attraction">Attractions <span>(<?=sizeof($sights)?>)</span></a></li>
					<li><a href="<?=(sizeof($items)!=0)?site_url("vietnam/restaurants/{$dest->alias}"):site_url("vietnam/restaurants")?>" class="restaurant">Restaurants <span>(<?=sizeof($items)?>)</span></a></li>
					<li><a href="<?=(sizeof($shoppings)!=0)?site_url("vietnam/shopping/{$dest->alias}"):site_url("vietnam/shopping")?>" class="shopping">Shopping <span>(<?=sizeof($shoppings)?>)</span></a></li>
					<li><a href="<?=(sizeof($items)!=0)?site_url("vietnam/entertainments/{$dest->alias}"):site_url("vietnam/entertainments")?>" class="entertainment">Entertainments <span>(<?=sizeof($items)?>)</span></a></li>
					<li><a href="<?=(sizeof($tours)!=0)?site_url("tours/vietnam/{$destination->alias}"):site_url("tours/search")?>" class="tours">Tours <span>(<?=sizeof($tours)?>)</span></a></li>
				<?}?>
				
			</ul>	
		</div>
		<!-- .destination-nav -->

		<select name="destination-select" id="destination-select">
			<option value="">Select Destination...</option>
			<?
				$vn_destinations = $this->m_vietnam_destination->getItems(NULL,1);
				foreach($vn_destinations as $dest) {
					$destination = $this->m_tour_destination->load($dest->destination_id);
			?>	
					<option value="<?=$destination->alias?>"><?=$dest->title?></option>
			<?}?>
		</select>
		<!-- #destination-select -->


		<div id="todo-filter-widget">
			<div class="container">
				<form id="filter-form" action="<?=site_url("vietnam/restaurants")?>" method="POST">
					<div class="widget-title">TYPES</div>
					<div class="widget-content">
						<?
							foreach ($categories as $category) {
								if (!$category->total_num) {
									continue;
								}
						?>
							<div class="clearfix text-form">
								<input type="checkbox" class="filter-option" id="category-<?=$category->id?>" name="category[]" value="<?=$category->id?>" <?=((!empty($search->categories) && in_array($category->id, $search->categories)) ? 'checked="checked"' : "")?>><label class="input" for="category-<?=$category->id?>"><?=$category->name?></label> <label class="total-number"><?="({$category->total_num})"?></label>
							</div>
						<? } ?>
					</div>
					<div class="widget-title">DESTINATIONS</div>
					<div class="widget-content">
						<?
							$idx = 0;
							foreach ($destinations as $destination) {
								if (!$destination->total_num) {
									continue;
								}
								$idx++;
						?>
							<div class="clearfix text-form <?=($idx>10)?"extra-destination none":""?>">
								<input type="checkbox" class="filter-option" id="destination-<?=$destination->id?>" name="destination[]" value="<?=$destination->id?>" <?=((!empty($search->destinations) && in_array($destination->id, $search->destinations)) ? 'checked="checked"' : "")?>><label class="input" for="destination-<?=$destination->id?>"><?=$destination->name?></label> <label class="total-number"><?="({$destination->total_num})"?></label>
							</div>
						<?	}
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
		<div id="vietnam-moment">
			<a title="View the Vietnam's moments" href="<?=site_url("vietnam/photos")?>"><img alt="" src="<?=IMG_URL?>vietnam-moment.jpg"></a>
		</div>
		<? require_once(APPPATH."views/vietnam/module/need_to_know.php"); ?>
		<div id="tour-view-shortlist-loader"></div>
	</div>
	<div class="clr"></div>
</div>

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
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
	});
</script>

<script type="text/javascript">
	var row = 2;
	var maxrow = '<?=$row?>';
	$(document).ready(function() {
		$('.more-destinations').click(function() {
			$('.row'+row).show('fade');
			row = row + 1;
			if (row > maxrow) {
				$('.show-more-container').hide();
			}
		});
	});

	//go to destination when select form dropdownbox
	$("#destination-select").change(function(event) {
		var url = "<?=base_url('vietnam/top-destinations/')?>/"+$(this).val()+".html";
		window.location = url;
	});
</script>