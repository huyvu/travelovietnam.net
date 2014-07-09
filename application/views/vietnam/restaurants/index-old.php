<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Restaurants in Vietnam
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title">RESTAURANTS IN VIETNAM</h1>
	<div class="left" style="width: 680px">
		<div id="things-todo">
			<div class="sights">
				<?
					$idx = 1;
					$row = 1;
					$rowidx = 1;
					foreach ($items as $item) {
						$city = $this->m_tour_destination->load($item->city);
				?>
				<div class="destination destination<?=$idx?> row<?=$row?> <?=(($row>1)?"none":"")?>">
					<div class="flag">
						<img alt="" src="<?=IMG_URL?>vietnam/restaurant.png">
					</div>
					<div class="thumbnail">
						<a title="<?=$item->title?>" href="<?=site_url("vietnam/restaurants/".$item->alias)?>">
							<img alt="<?=$item->title?>" src="<?=$item->thumbnail?>">
						</a>
					</div>
					<div class="content">
						<h1 class="title">
							<a title="<?=$item->title?>" href="<?=site_url("vietnam/restaurants/".$item->alias)?>"><?=$item->title?></a>
						</h1>
						<div class="summary">
							<?=$item->summary?>
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
		<div id="vietnam-view-nav">
			<ul>
				<li>
					<a class="sight" title="" href="<?=site_url("vietnam/sights")?>">SIGHTS</a>
				</li>
				<li>
					<a class="entertainment" title="" href="<?=site_url("vietnam/entertainments")?>">ENTERTAINMENTS</a>
				</li>
				<li>
					<a class="restaurant-selected" title="" href="<?=site_url("vietnam/restaurants")?>">RESTAURANTS</a>
				</li>
				<li>
					<a class="shopping" title="" href="<?=site_url("vietnam/shopping")?>">SHOPPING</a>
				</li>
			</ul>
		</div>
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
</script>