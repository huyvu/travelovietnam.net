<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Tours" href="<?=site_url("tours/search")?>">Vietnam Tours</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> My Shortlist
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title">MY SHORTLIST</h1>
	<div class="left">
		<div id="filters">
			<div class="filter-container">
				<div class="filter-controls">
					<div class="control-container left">
						<label>You have <?=sizeof($items)?> tour(s) in your list</label>
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
						?>
						<ul class="splitter left">
							<li class="segment-0 <?=(($sortby=="newest") ? "selected orderby-$orderby" : "")?>"><a title="newest tours" href="<?=site_url("tours/myshortlist")."?sortby=newest&orderby=$newest_nextorder"?>">Newest</a></li>
							<li class="segment-1 <?=(($sortby=="price") ? "selected orderby-$orderby" : "")?>"><a title="tour price" href="<?=site_url("tours/myshortlist")."?sortby=price&orderby=$price_nextorder"?>">Price</a></li>
							<li class="segment-1 <?=(($sortby=="duration") ? "selected orderby-$orderby" : "")?>"><a title="tour duration" href="<?=site_url("tours/myshortlist")."?sortby=duration&orderby=$duration_nextorder"?>">Duration</a></li>
							<li class="segment-2 <?=(($sortby=="name") ? "selected orderby-$orderby" : "")?>"><a title="tour name" href="<?=site_url("tours/myshortlist")."?sortby=name&orderby=$name_nextorder"?>">Name</a></li>
						</ul>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>
		<div id="hot-tour">
			<ul class="list">
				<? foreach ($items as $item) { ?>
				<li>
					<h1 class="tour-name">
						<a class="name" title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/".$item->alias)?>"><?=$item->name?></a>
						<p class="right"><a class="favorite-remove" tourid="<?=$item->id?>" href="<?=BASE_URL."/tours/myshortlist.html?sortby=".$sortby."&remove=".$item->id?>">Remove from Shortlist</a></p>
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
								<div class="info">$<?=number_format($item->price,2,'.',',')?></div>
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
										$destinations = array();
									    for ($i=0; $i < sizeof($arrdestination); $i++) {
									    	$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
									    }
							    		$destsize = sizeof($destinations);
							    		for ($i=0; $i < $destsize; $i++) {
							    			$destination = $destinations[$i];
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
		</div>
	</div>
	<div class="right">
		<? require_once(APPPATH."views/module/tour/search_widget.php"); ?>
	</div>
	<div class="clr"></div>
</div>
