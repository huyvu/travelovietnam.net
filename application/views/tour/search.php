<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>vietnam.css">
<?
	if (isset($_GET['destination'])) {
		$destination = $this->m_tour_destination->load($_GET['destination']);
	}

	$things = $this->m_tour_category->getItems(1);
	if (isset($_GET['category'])) {
		$cat = $_GET['category'];
	}
?>
<div class="container">
	<div id="breadcrumbs" class="row">
		<div class="col-md-12">
			<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
			> Vietnam City > <?=isset($destination)?$destination->name:''?>	
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="title">
				<img src="<?=IMG_URL?>place-icon.png" alt="">
				<h2 class="title">Best Seller</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<? if (sizeof($items)) { ?>

					<div id="top-tours">
							<?
								$idx = 1;
								$row = 1;
								$rowidx = 1;
								foreach($items as $item) {
									$count = $this->m_review->getItemsCount(1,$item->id,1);
									$avg_rating = 0;
									$rev_info->category_id = 1;
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
							<div class="col-md-4 col<?=$idx?> row<?=$row?> <?=(($row>1)?"none":"")?>">
								<div class="thumb">
									<a title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>"><img alt="" src="<?=$item->thumbnail?>"/></a>
									<? if ($item->price < $item->original_price) { ?>
									<div class="promotion">Promotion Available!</div>
									<? } ?>
								</div>
								<div class="detail">
									<h3 class="tourname"><a title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>"><?=$item->name?></a></h3>
									<p class="reviews">
										<img style="vertical-align:text-top;" src="<?=IMG_URL?>tour/icon/star<?=$avg_rating?>.png" alt="rating" height="15">
										<a href="#"><?=$count->count?> <?=($count->count>1)?'Reviews':'Review'?></a>
									</p>
									<p class="duration"><?=($item->duration > 1) ? $item->duration." days - ".($item->duration-1)." nights" : $item->duration." day"?></p>
									<p class="price"><label>From:</label> $<?=$item->price?> <?=(($item->price < $item->original_price)?'<label class="original">$'.$item->original_price.'</label>':"")?></p>
									<p class="photo"></p>
									<p class="separator"></p>
									<?=$item->summary?>
								</div>
								<p class="booknow"><a title="Book Now" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>">Book Now</a></p>
							</div>
							<?
									$idx = ($idx%3) + 1;
									if ($rowidx == 6) {
										$row++;
									}
									$rowidx = ($rowidx%6) + 1;
								}
								$size = sizeof($items);
								while(($size++)%3) {
							?>
							<div class="hidden-col col-md-4 col<?=$idx?> row<?=$row?> <?=(($row>1)?"none":"")?> hidden-xs">
								<div class="thumb"></div>
								<h3 class="tourname"></h3>
								<p class="duration"></p>
								<p class="price"></p>
								<p class="photo"></p>
								<p class="separator" style="border: none;"></p>
								<p class="rating"></p>
								<p class="desc"></p>
								<p class="booknow"></p>
							</div>
							<?
									$idx = ($idx%3) + 1;
								}
							?>
					</div>
					<div class="clr"></div>

				<? } ?>
				<? if (($row) > 1 && sizeof($items) > 6) { ?>
				<div class="show-more-container">
					<a class="link more-destinations">Show more</a>
				</div>
				<? } ?>
		</div>
		<div id="right" class="col-md-3">

					<? require_once(APPPATH."views/module/insider_guide.php"); ?>

					<? require_once(APPPATH."views/module/tour/things_to_do.php"); ?>

					<? require_once(APPPATH."views/module/tour/top_attractions.php"); ?>

					<? require_once(APPPATH."views/module/need_help.php"); ?>

			</div>
		</div>
	</div>
</div>
<!-- end .container -->
<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/pagination.css"/>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.pagination.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.highlight.js"></script>
<script type="text/javascript">
	$(function() {
		var hashVal = window.location.hash;
		var curPage = ((hashVal != null && hashVal != "") ? hashVal.substr(-1,1) : 1);
		var numofitem = '<?=sizeof($items)?>';
		if ((numofitem / 10) > 1) {
			$("#light-pagination").pagination({
		        items: numofitem,
		        itemsOnPage: 10,
		        currentPage: curPage,
		        cssStyle: 'light-theme',
		        onPageClick: function(pageNumber){selectPage(pageNumber, numofitem);}
		    });
			if (curPage > 1) {
				selectPage(curPage, numofitem);
			}
		}
	});
	function selectPage(pageNumber, items) {
		for (var i=1; i<=items; i++) {
			$("#page-"+i).hide();
		}
		$("#page-"+pageNumber).show('fade');
	}
	$(document).ready(function() {
		var search_text = '<?=$search->search_text?>';
		var search_arr  = search_text.split(" ");
		for (var i=0; i<search_arr.length; i++) {
			$('.tour-name .name').highlight(search_arr[i]);
			$('.tour-code').highlight(search_arr[i]);
			$('.tour-summary').highlight(search_arr[i]);
		}
		$('.favorite-add').click(function() {
			var p = {};
			p['tour-id'] = $(this).attr('tourid');
			$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", p, function(){});
			$(this).hide();
			$('.favorite-remove'+$(this).attr('tourid')).show();
		});
		$('.favorite-remove').click(function() {
			var p = {};
			p['tour-id'] = $(this).attr('tourid');
			$('#tour-view-shortlist-loader').load("<?=site_url('tours/remove_shortlist')?>", p, function(){});
			$(this).hide();
			$('.favorite-add'+$(this).attr('tourid')).show();
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
