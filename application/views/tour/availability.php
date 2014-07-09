<?
	$depart_from = $this->m_tour_destination->load($item->depart_from);
	$going_to = $this->m_tour_destination->load($item->going_to);
	
	$arrdestination = explode(';', $item->destinations);
	$destinations = array();
    for ($i=0; $i < sizeof($arrdestination); $i++) {
    	$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
    }
	
	$glocations = array();
	foreach ($destinations as $destination) {
		if ($destination->name != $depart_from->name && $destination->name != $going_to->name) {
			$glocations[] = '{location: "'.$destination->name.'"}';
		}
	}
?>

<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/panorama.css" />
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/droplist.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.easing.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.contentcarousel.js"></script>

<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/gdl-custom-slider.css" rel="stylesheet" />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
	var map;
	var mapshown = false;
	var directionsDisplay = new google.maps.DirectionsRenderer();
	var directionsService = new google.maps.DirectionsService();

	function initialize() {
		var options = {
			zoom:5,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("mapcanvas"), options);
	}
	
	function calcRoute(start, end, mode) {
		var request = {
			origin:start,
			destination:end,
			waypoints:[<?=implode(',', $glocations)?>],
			travelMode: google.maps.TravelMode[mode]
		};
		directionsService.route(request, function(result, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(result);
			}
		});
		directionsDisplay.setMap(map);
	}

	function checkAvailability() {
		var p = {};
		p["tour-id"] = '<?=$item->id?>';
		p["start"]   = $("#tour-fromdate").val();
		p["finish"]  = $("#tour-todate").val();

		$('.availability-itinerary').html("Loading...");
		$.ajax({
			type: "POST",
			url: "<?=site_url('tours/check_availability')?>",
			data: p,
			success: function(result) {
				$('.availability-itinerary').html(result);
			},
			async:false
		});
	}

	$(document).ready(function() {
		var dateoptions = {
				numberOfMonths : 2
			};
		
		$("#tour-fromdate").datepicker(dateoptions);
		$("#tour-todate").datepicker(dateoptions);
		
		$(".view-map").fancybox();

		$(".search-button").click(function() {
			checkAvailability();
		});
	});
</script>

<div class="slideshow">
	<div id="ca-container" class="ca-container">
		<div class="ca-wrapper">
			<? for ($i=0; $i<sizeof($photos); $i++) { ?>
			<div class="ca-item">
				<div class="ca-item-main">
					<img alt="<?=$photos[$i]->name?>" title="<?=$photos[$i]->name?>" src="<?=$photos[$i]->file_path?>" width="426px" height="308px" />
					<div class="ttpano-img-name">
						<label class="number"><?=substr("0".($i+1), -2)?></label>
						<span class="name"><h2><?=$photos[$i]->name?></h2></span>
					</div>
				</div>
			</div>
			<? } ?>
		</div>
	</div>
	<script type="text/javascript">
		$('#ca-container').contentcarousel();
	</script>
</div>

<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Tours" href="<?=site_url("tours/search")?>">Vietnam Tours</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->name?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div id="tour-view">
		<h1><?=$item->name?></h1>
		<h2><?=$item->sub_title?></h2>
	</div>
	<div class="left" style="width: 680px">
		<div id="tour-view-detailed">
			<h2 class="summary-name">SUMMARY</h2>
			<div class="tour-view-summary">
				<div class="summary-header">
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
						<div class="label">PRICE FROM <img class="help" alt="" src="<?=IMG_URL?>tour/icon/info.png" title="<?=$this->m_tooltip->load("[Tour][Detail][Price]")->content?>" rel="tooltip"></div>
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
				<div class="summary-content">
					<div class="tour-validity">
						<label class="tour-validity-label">Trip validity</label> : 
						<? if (0) { ?>
						<label class="date">Daily</label>
						<? } else { ?>
						<label class="date"><?=date('d-M-Y', strtotime($item->start))?></label> to <label class="date"><?=date('d-M-Y', strtotime($item->finish))?></label>
						<? } ?>
					</div>
					<div class="tour-destination">
						<label class="tour-destination-label">Itinerary</label> : 
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
    						<label class="tour-destination-label">Themes</label> :
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
    						<label class="tour-destination-label">Activities</label> :
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
			    			<label class="tour-destination-label">Departure date</label><span> : </span><?=$item->note?>
			    		</div>
			    	<? endif ?>
					<div class="button-link">
						<div class="bookcondition"><a target="_blank" href="<?=site_url("tours/booking-conditions")?>">* Refer to booking conditions</a></div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			
			<div class="tour-view-div"></div>
			
			<h2 class="summary-name">WHEN DO YOU WANT TO TRAVEL?</h2>
			<div id="tour-view-availabilities">
				<div class="availability-departure-date">
					<div class="left">
						<label class="">Date From: </label>
						<span class="calendar">
							<input type="text" id="tour-fromdate" name="tour-fromdate" value="<?=(!empty($search->fromdate) ? $search->fromdate : "")?>" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="filter-option calendar">
						</span>
					</div>
					<div class="left" style="margin-left: 20px">
						<label class="">Date To: </label>
						<span class="calendar">
							<input type="text" id="tour-todate" name="tour-todate" value="<?=(!empty($search->todate) ? $search->todate : "")?>" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="filter-option calendar">
						</span>
					</div>
					<div class="right">
						<a id="" name="" class="search-button">FIND DEPARTURE <span class="next-arrow"></span></a>
					</div>
					<div class="clr"></div>
				</div>
				<div class="availability-itinerary">
					<? if (empty($departures) || !sizeof($departures)) { ?>
						<div class="availability-departure-noresult">No departures found.</div>
					<? } else { ?>
					<table class="availability-pricing-table">
						<tr>
							<th width="65px">START</th>
							<th width="65px">FINISH</th>
							<th width="65px">PLACES</th>
							<th class="pricing-explained">PRICE<div>Our pricing explained <img class="help" alt="" src="<?=IMG_URL?>tour/icon/info.png" title="<?=$this->m_tooltip->load("[Tour][Detail][Price]")->content?>" rel="tooltip"></div></th>
							<th class="pricing-total">TOTAL PRICE FROM</th>
							<th width="95px"></th>
						</tr>
						<? foreach ($departures as $departure) { ?>
						<tr class="availability">
							<td>
								<span class="day"><?=date('D', strtotime($departure->start))?></span>
								<span class="date"><?=date('d', strtotime($departure->start))?></span>
								<span class="month"><?=date('M Y', strtotime($departure->start))?></span>
							</td>
							<td>
								<span class="day"><?=date('D', strtotime($departure->finish))?></span>
								<span class="date"><?=date('d', strtotime($departure->finish))?></span>
								<span class="month"><?=date('M Y', strtotime($departure->finish))?></span>
							</td>
							<td>
								<div class="place"><?=$departure->places?>+ Available</div>
							</td>
							<td colspan="2" class="pricing-total">
								<span class="price">USD $<?=number_format($departure->price,2,'.',',')?></span>
							</td>
							<td align="center">
								<div class="booknow">
									<? if (strtotime($departure->start) <= strtotime(date('Y-m-d'))) { ?>
									<b>CLOSED</b>
									<? } else if ($departure->places <= 0) { ?>
									<b>SOLD OUT</b>
									<? } else { ?>
									<a title="" href="<?=site_url("tours/booking/{$item->alias}/{$departure->id}")?>">BOOK <span class="next-arrow"></span></a>
									<? } ?>
								</div>
							</td>
						</tr>
						<? } ?>
					</table>
					<? } ?>
				</div>
			</div>
		</div>
		<div>
			<? require_once(APPPATH."views/module/tour/quick_finder.php"); ?>
		</div>
	</div>
	<div class="right">
		<div id="tour-view-nav">
			<ul>
				<li>
					<a class="overview" title="" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")?>">OVERVIEW</a>
				</li>
				<li>
					<a class="availability-selected" title="" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}/availability")?>">CHECK AVAILABILITY</a>
				</li>
				<li>
					<a class="tripnote" title="" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}/tripnote")?>">TRIP NOTES</a>
				</li>
				<? if (!empty($item->brochure)) { ?>
				<li>
					<a class="download" title="" href="<?=$item->brochure?>">DOWNLOAD BROCHURE</a>
				</li>
				<? } ?>
			</ul>
		</div>
		<div id="tour-view-review">
			<div class="content">
				<p class="p1">Travellers who experienced this trip have rated it... <a title="" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}/reviews")?>">See reviews</a></p>
				<p class="rating"><img alt="" src="<?=IMG_URL?>tour/icon/star<?=$avg_rating?>.png"></p>
				<p class="p2">99% of travellers say they would travel with us again.</p>
			</div>
		</div>
		<div id="tour-view-map">
			<a class="view-map" href="<?=$item->map?>">
				<img alt="" src="<?=$item->map?>">
				<div class="map-sub-title">Click to enlarge</div>
			</a>
		</div>
		<? require_once(APPPATH."views/module/tour/customize.php"); ?>
		<? require_once(APPPATH."views/module/tour/related_tours.php"); ?>
		<div id="tour-view-shortlist-loader"></div>
	</div>
	<div class="clr"></div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
	});
</script>

<?php //$this->session->set_userdata('comeback_link',current_url()) ?>