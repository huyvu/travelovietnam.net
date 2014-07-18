<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Tour Search
	</div>
	<h1 class="page-title">TOURS IN VIETNAM</h1>
	<div class="left">
		<div id="filters">
			<div class="filter-container">
				<div class="filter-controls">
					<div class="control-container left">
						<label>Your search has returned <?=sizeof($items)?> tours in Vietnam</label>
					</div>
					<div class="control-container right">
						<label class="left">Sort by:</label>
						<?
							$default_order = "asc";
							$sortby  = (!empty($_GET["sortby"]) ? $_GET["sortby"] : "newest");
							$orderby = ((empty($_GET["orderby"]) || $_GET["orderby"]=="asc") ? "asc" : "desc");
							
							$newest_nextorder	= $default_order;
							$price_nextorder	= $default_order;
							$duration_nextorder	= $default_order;
							$name_nextorder		= $default_order;
							
							switch ($sortby) {
								case "newest":
									$newest_nextorder	= (($orderby=="asc") ? "desc" : "asc");
									break;
								case "price":
									$price_nextorder	= (($orderby=="asc") ? "desc" : "asc");
									break;
								case "duration":
									$duration_nextorder	= (($orderby=="asc") ? "desc" : "asc");
									break;
								case "name":
									$name_nextorder		= (($orderby=="asc") ? "desc" : "asc");
									break;
							}
							
							$query = "";
							
							unset($_GET["sortby"]);
							unset($_GET["orderby"]);
							
							foreach ($_GET as $k => $v) {
								if (is_array($v)) {
									foreach ($v as $v2) {
										$query .= "&".$k."[]=".$v2;
									}
								} else {
									$query .= "&".$k."=".$v;
								}
							}
						?>
						<ul class="splitter left">
							<li class="segment-0 <?=(($sortby=="newest") ? "selected orderby-$orderby" : "")?>"><a title="newest tours" href="<?=site_url("tours/search")."?sortby=newest&orderby=$newest_nextorder".$query?>">Newest</a></li>
							<li class="segment-1 <?=(($sortby=="price") ? "selected orderby-$orderby" : "")?>"><a title="tour price" href="<?=site_url("tours/search")."?sortby=price&orderby=$price_nextorder".$query?>">Price</a></li>
							<li class="segment-1 <?=(($sortby=="duration") ? "selected orderby-$orderby" : "")?>"><a title="tour duration" href="<?=site_url("tours/search")."?sortby=duration&orderby=$duration_nextorder".$query?>">Duration</a></li>
							<li class="segment-2 <?=(($sortby=="name") ? "selected orderby-$orderby" : "")?>"><a title="tour name" href="<?=site_url("tours/search")."?sortby=name&orderby=$name_nextorder".$query?>">Name</a></li>
						</ul>
					</div>
					<div class="clr"></div>
				</div>
				<?
				function search_url($k, $v) {
					$query_string = str_replace("&&","&",str_replace("$k=$v","",urldecode($_SERVER['QUERY_STRING'])));
					if (substr($query_string, -1) == "&") {
						$query_string = substr($query_string, 0, strlen($query_string)-1);
					}
					if (strlen($query_string)) {
						return current_url()."?".$query_string;
					}
					return current_url();
				}
				$tags = array();
				if (!empty($search->search_text)) {
					$tag = new stdClass();
					$tag->text = $search->search_text;
					$tag->uri = search_url("q", $search->search_text);
					$tags[] = $tag;
				}
				if (!empty($search->depart_from)) {
					$tag = new stdClass();
					$tag->text = $this->m_tour_destination->load($search->depart_from)->name;
					$tag->uri = search_url("fromcity", $search->depart_from);
					$tags[] = $tag;
				}
				if (!empty($search->going_to)) {
					$tag = new stdClass();
					$tag->text = $this->m_tour_destination->load($search->going_to)->name;
					$tag->uri = search_url("tocity", $search->going_to);
					$tags[] = $tag;
				}
				if (!empty($search->category_id)) {
					$tag = new stdClass();
					$tag->text = $this->m_tour_category->load($search->category_id)->name;
					$tag->uri = search_url("category", $search->category_id);
					$tags[] = $tag;
				}
				if (!empty($search->price)) {
					$tag = new stdClass();
					$tag->text = "$".$search->price;
					$tag->uri = search_url("price", $search->price);
					$tags[] = $tag;
				}
				if (!empty($search->duration)) {
					$tag = new stdClass();
					$tag->text = $search->duration."d";
					$tag->uri = search_url("duration", $search->duration);
					$tags[] = $tag;
				}
				if (!empty($search->best_seller)) {
					$tag = new stdClass();
					$tag->text = "Best seller";
					$tag->uri = search_url("bestseller", $search->best_seller);
					$tags[] = $tag;
				}
				if (!empty($search->promotion)) {
					$tag = new stdClass();
					$tag->text = "Promotion";
					$tag->uri = search_url("promotion", $search->promotion);
					$tags[] = $tag;
				}
				if (!empty($search->popular)) {
					$tag = new stdClass();
					$tag->text = "Popular";
					$tag->uri = search_url("popular", $search->popular);
					$tags[] = $tag;
				}
				if (!empty($search->types)) {
					foreach ($search->types as $type) {
						$tag = new stdClass();
						$tag->text = ucfirst($type);
						$tag->uri = search_url("type[]", $type);
						$tags[] = $tag;
					}
				}
				if (!empty($search->categories)) {
					foreach ($search->categories as $category) {
						$tag = new stdClass();
						$tag->text = $this->m_tour_category->load($category)->name;
						$tag->uri = search_url("category[]", $category);
						$tags[] = $tag;
					}
				}
				if (!empty($search->regions)) {
					foreach ($search->regions as $region) {
						$tag = new stdClass();
						$tag->text = $region;
						$tag->uri = search_url("region[]", $region);
						$tags[] = $tag;
					}
				}
				if (!empty($search->destinations)) {
					foreach ($search->destinations as $destination) {
						$tag = new stdClass();
						$tag->text = $this->m_tour_destination->load($destination)->name;
						$tag->uri = search_url("destination[]", $destination);
						$tags[] = $tag;
					}
				}
				?>
				<? if (sizeof($tags)) { ?>
				<div class="search-tags">
					<? foreach ($tags as $tag) { ?>
					<span class="tag">
						<?=$tag->text?> <a class="icon" href="<?=$tag->uri?>"></a>
					</span>
					<? } ?>
				</div>
				<? } ?>
			</div>
		</div>
		<div id="hot-tour">
			<ul id="page-1" class="list">
			<?
				$shortlist = $this->session->userdata("tour_shortlist");
				if (empty($shortlist)) {
					$shortlist = array();
				}
				
				$cnt  = 0;
				$page = 1;
				foreach ($items as $item) {
					if ($cnt != 0 && ($cnt % 10) == 0) {
						$page++;
						$cnt = 0;
			?>
			</ul>
			<ul id="page-<?=$page?>" class="list none">
			<?
					}
				$cnt++;
			?>
				<li>
					<h1 class="tour-name">
						<a class="name" title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>"><?=$item->name?></a>
						<p class="right">
							<a class="favorite-add favorite-add<?=$item->id?> <?=(array_key_exists($item->id, $shortlist) ? "none" : "")?>" tourid="<?=$item->id?>">Add to Shortlist</a>
							<a class="favorite-remove favorite-remove<?=$item->id?> <?=(array_key_exists($item->id, $shortlist) ? "" : "none")?>" tourid="<?=$item->id?>">Remove from Shortlist</a>
						</p>
					</h1>
					<div class="list-detailed">
						<div class="list-header">
							<div class="left tour-code">
								<div class="label">CODE</div>
								<div class="info"><?=$item->code?></div>
							</div>
							<div class="left tour-duration">
								<div class="label">DURATION</div>
								<div class="info"><?=($item->duration > 1) ? $item->duration." days - ".($item->duration-1)." nights" : $item->duration." day"?></div>
							</div>
							<div class="left tour-type">
								<div class="label">TYPE</div>
								<div class="info"><?=($item->throughout) ? "Throughout" : "Daily"?></div>
							</div>
							<div class="right tour-price">
								<div class="label">PRICE FROM</div>
								<div class="info">
									<? if ($item->price < $item->original_price) { ?>
									<span class="original">$<?=number_format($item->original_price,2,'.',',')?></span>
									<? } ?>
									$<?=number_format($item->price,2,'.',',')?>
								</div>
							</div>
							<? if ($item->best_deal) { ?>
							<div class="top-seller"></div>
							<? } ?>
							<div class="clr"></div>
						</div>
						<div class="list-summary">
							<div class="left">
								<div class="thumb">
									<a title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>"><img alt="<?=$item->name?>" src="<?=$item->thumbnail?>"/></a>
									<? if ($item->price < $item->original_price) { ?>
									<div class="promotion">Promotion Available!</div>
									<? } ?>
								</div>
							</div>
							<div class="left" style="margin-left: 10px; width: 490px">
								<div class="tour-summary"><?=word_limiter($item->summary, 40)?></div>
								<div class="tour-destination">
									<label class="tour-destination-label">Itinerary :</label>
									<?
										$arrdestination = explode(';', $item->destinations);
										$tour_destinations = array();
									    for ($i=0; $i < sizeof($arrdestination); $i++) {
									    	$tour_destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
									    }
							    		$destsize = sizeof($tour_destinations);
							    		for ($i=0; $i < $destsize; $i++) {
							    			$destination = $tour_destinations[$i];
							    			echo '<a target="_blank" title="'.$destination->name.', '.$destination->name.' Vietnam, '.$destination->name.' travel guide" href="'.site_url("vietnam/top-destinations/".$destination->alias).'">'.$destination->name.'</a>';
							    			if ($i < $destsize-1) {
							    				echo '&nbsp;<img src="'.IMG_URL.'destination-arrow.gif'.'">&nbsp;';
							    			}
							    		}
							    	?>
								</div>
								<?
									$arrcategory = explode(';', $item->categories);
									$tour_categories = array();
								    for ($i=0; $i < sizeof($arrcategory); $i++) {
								    	$tour_categories[] = $this->m_tour_category->load($arrcategory[$i]);
								    }
						    		$catsize = sizeof($tour_categories);
						    		if ($catsize > 1) {
						    			?>
						    			<div class="tour-destination">
			    						<label class="tour-destination-label">Themes :</label>
						    			<?
							    		for ($i=0; $i < $catsize; $i++) {
							    			$category = $tour_categories[$i];
							    			echo $category->name;
							    			if ($i < $catsize-1) {
							    				echo ', ';
							    			}
							    		}
							    		?>
							    		</div>
							    		<?
						    		}
						    	?>
								<?
									$arractivity = explode(';', $item->activities);
									$tour_activities = array();
								    for ($i=0; $i < sizeof($arractivity); $i++) {
								    	$tour_activities[] = $this->m_tour_activity->load($arractivity[$i]);
								    }
						    		$catsize = sizeof($tour_activities);
						    		if ($catsize > 1) {
						    			?>
						    			<div class="tour-destination">
			    						<label class="tour-destination-label">Activities :</label>
						    			<?
							    		for ($i=0; $i < $catsize; $i++) {
							    			$activity = $tour_activities[$i];
							    			echo $activity->name;
							    			if ($i < $catsize-1) {
							    				echo ', ';
							    			}
							    		}
							    		?>
							    		</div>
							    		<?
						    		}
						    	?>
						    	<? if (!empty($item->note)) :?>
						    		<div class="tour-destination red">
						    			<label class="tour-destination-label">Departure date : </label><?=$item->note?>
						    		</div>
						    	<? endif ?>
								<div class="button-bar">
									<div class="left">
										<div class="bookcondition"><a target="_blank" href="<?=site_url("tours/booking-conditions")?>">* Refer to booking conditions</a></div>
									</div>
									<div class="right">
										<div class="booknow"><a href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>">DETAILS & BOOKING</a></div>
									</div>
									<div class="clr"></div>
								</div>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				</li>
				<? } ?>
			</ul>
			<? if ($page > 1) { ?>
			<div style="margin-top: 15px; padding: 15px 0px; border-top: 1px solid #D2D9DB">
				<div id="light-pagination" class="pagination clr"></div>
			</div>
			<? } ?>
		</div>
	</div>
	<div class="right">
		<? require_once(APPPATH."views/module/tour/search_widget.php"); ?>
		<? require_once(APPPATH."views/module/tour/filter_widget.php"); ?>
		<div id="tour-view-shortlist-loader"></div>
	</div>
	<div class="clr"></div>
</div>

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
