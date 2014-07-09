<?
	$arrtourdestination = array();
	foreach ($tour_destinations as $destination) {
		$arrtourdestination[] = $destination->name;
	}
	
	$arrhoteldestination = array();
	foreach ($hotel_destinations as $destination) {
		$arrhoteldestination[] = $destination->name;
	}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#travelslide').oneByOne({
			className: 'travelads',	             
			easeType: 'random',
			slideShow: true,
			pauseByHover: true,
			delay: 1000,
			slideShowDelay: 5000
		});
		
		var options = {
				numberOfMonths : 2,
				minDate: 0
		};
		$("#tour-fromdate").datepicker(options);
		$("#tour-todate").datepicker(options);

		var availableTourTags = [<?="\"".implode("\",\"", $arrtourdestination)."\"";?>];
		$( "#tour-fromcity" ).autocomplete({
			source: availableTourTags,
			minLength: 0
		}).bind('focus', function(){
			$(this).autocomplete("search");
		});
		$( "#tour-tocity" ).autocomplete({
			source: availableTourTags,
			minLength: 0
		}).bind('focus', function(){
			$(this).autocomplete("search");
		});

		$(".viewmap").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 500,
				height: 600
			});
			return false;
		});

		$("a.youtube").click(function() {
			$.fancybox({
	        	'title'        		: this.title,
				'overlayColor'		: '#000000',
				'overlayOpacity'	: 0.8,
				'transitionIn'		: 'none',
				'transitionOut'		: 'fade',
				'width'             : 620,
				'height'            : 380,
				'href'              : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'              : 'swf',    
				'swf'               : {'allowfullscreen':'true'} 
			});
			return false;
		});
		
		$("#flight-departuredate").datepicker(options);
		$("#flight-returndate").datepicker(options);
		
		$(".direction").click(function(){
			if ($('input[name=direction]:checked').val() == "oneway") {
				$(".flight-returndate").hide();
			} else {
				$(".flight-returndate").show();
			}
		});
		
		$("#flight-fromcity").change(function(){
			var p = {};
			p['fromcity'] = $("#flight-fromcity").val();
			$("#flight-tocity").load("<?=site_url('flights/ajax_get_city')?>", p, function(){});
		});
		
		var availableHotelTags = [<?="\"".implode("\",\"", $arrhoteldestination)."\"";?>];
		$( "#hotel-location" ).autocomplete({
			source: availableHotelTags,
			minLength: 0
		}).bind('focus', function(){
			$(this).autocomplete("search");
		});
		
		$("#hotel-checkindate").datepicker(options);
		$("#hotel-checkoutdate").datepicker(options);
		
		$("#visa-arrivaldate").datepicker(options);
		$("#visa-exitdate").datepicker(options);
		
		$("a.vietnam-photo").fancybox();
		
		$("#change-region").click(function(){
			if ($("#region-detail").is(":hidden")) {
				$("#region-detail").slideDown();
			} else {
				$("#region-detail").slideUp();
			}
		});
	});
	
	function openSearchTab(tab)
	{
		$(".widget-menu").children('li').each(function(index) {
			$(this).removeClass("selected");
		});
		$($(".widget-menu").children("li").get(tab)).addClass("selected");

		$(".widget-content").children("div").each(function(index) {
			$(this).hide();
		});
		$($(".widget-content").children("div").get(tab)).fadeIn();
	}
</script>
<div id="home-wizban">
	<div id="travelslide">
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/HaLong/halong.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/HaLong/halong2.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="<?=site_url("tours")?>">Book Now</a>
			</span>
		</div>
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/DaNang/danang.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/DaNang/hoian.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="<?=site_url("tours")?>">Book Now</a>
			</span>
		</div>
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/DaLat/dalat.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/DaLat/nhatrang.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="<?=site_url("tours")?>">Book Now</a>
			</span>
		</div>
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/BenThanh/benthanh.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/BenThanh/cuchi.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="<?=site_url("tours")?>">Book Now</a>
			</span>
		</div>
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/Mekong/mekong.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/Mekong/mekong1.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="<?=site_url("tours")?>">Book Now</a>
			</span>
		</div>
	</div>
	<div id="search-widget">
		<h1 class="widget-title"><span>PREPARE FOR THE TRAVELING</span></h1>
		<ul class="widget-menu">
			<li class="selected" onclick="openSearchTab(0)"><a>TOURS</a></li>
			<li onclick="openSearchTab(1)"><a>FLIGHTS</a></li>
			<li onclick="openSearchTab(2)"><a>HOTELS</a></li>
			<li onclick="openSearchTab(3)"><a>VISA</a></li>
		</ul>
		<div class="widget-content">
			<div>
				<form id="tour-search-form" action="<?=site_url("tours/search")?>" method="POST">
					<div class="clearfix">
						<p class="text-form w180">
							<label>From date:</label>
							<span>
								<input type="text" id="tour-fromdate" name="tour-fromdate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
							</span>
						</p>
						<p class="text-form w180">
							<label>To date:</label>
							<span>
								<input type="text" id="tour-todate" name="tour-todate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
							</span>
						</p>
					</div>
					<div class="clearfix">
						<p class="text-form w180">
							<label>Leaving from:</label>
							<input type="text" id="tour-fromcity" name="tour-fromcity" class="text-input" placeholder="from city" />
						</p>
						<p class="text-form w180">
							<label>Going to:</label>
							<input type="text" id="tour-tocity" name="tour-tocity" class="text-input" placeholder="to city" />
						</p>
					</div>
					<div class="clearfix">
						<p class="text-form">
							<label>Tour style / type:</label>
							<select id="tour-category" name="tour-category">
								<option value="">All Type</option>
								<? foreach ($tour_categories as $category) {?>
								<option value="<?=$category->id?>"><?=$category->name?></option>
								<? } ?>
							</select>
						</p>
					</div>
					<div class="clearfix">
						<div class="text-form">
							<div class="map-ticker">
								<a href="<?=site_url("tours/interactive-maps")?>" class="viewmap"><img alt="" src="<?=IMG_URL?>map-ticker.png"></a>
							</div>
							<input type="submit" id="tour-search-button" class="search-button org-btn-large" value="SEARCH"/>
						</div>
					</div>
				</form>
			</div>
			<div style="display: none;">
				<form id="flight-search-form" action="<?=site_url("flights/search")?>" method="POST">
					<div class="clearfix">
						<p class="text-form">
							<input type="radio" id="oneway" name="direction" class="direction" value="oneway" style="float: left"/>
							<label for="oneway" style="float: left; line-height: 20px;">One way</label>
						</p>
						<p class="text-form">
							<input type="radio" id="return" name="direction" class="direction" value="return" checked="checked" style="float: left"/>
							<label for="return" style="float: left; line-height: 20px;">Return</label>
						</p>
					</div>
					<div class="clearfix">
						<p class="text-form w180">
							<label>Departure date:</label>
							<span>
								<input type="text" id="flight-departuredate" name="flight-departuredate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
							</span>
						</p>
						<p class="text-form w180 flight-returndate">
							<label>Return date:</label>
							<span>
								<input type="text" id="flight-returndate" name="flight-returndate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
							</span>
						</p>
					</div>
					<div class="clearfix">
						<p class="text-form w180">
							<label>Leaving from:</label>
							<select id="flight-fromcity" name="flight-fromcity">
								<option selected value="">Select</option>
								<optgroup label="Vietnam">
									<option value='BMV'>Buon Ma Thuot (BMV)</option>
									<option value='CAH'>Ca Mau (CAH)</option>
									<option value='VCA'>Can Tho (VCA)</option>
									<option value='VCL'>Chu Lai (VCL)</option>
									<option value='VCS'>Con Dao (VCS)</option>
									<option value='DLI'>Da Lat (DLI)</option>
									<option value='DAD'>Da Nang (DAD)</option>
									<option value='DIN'>Dien Bien (DIN)</option>
									<option value='VDH'>Dong Hoi (VDH)</option>
									<option value='HAN'>Ha Noi (HAN)</option>
									<option value='HPH'>Hai Phong (HPH)</option>
									<option value='SGN'>Ho Chi Minh City (SGN)</option>
									<option value='HUI'>Hue (HUI)</option>
									<option value='NHA'>Nha Trang (NHA)</option>
									<option value='PQC'>Phu Quoc (PQC)</option>
									<option value='PXU'>Pleiku (PXU)</option>
									<option value='UIH'>Quy Nhon (UIH)</option>
									<option value='VKG'>Rach Gia (VKG)</option>
									<option value='THD'>Thanh Hoa (THD)</option>
									<option value='TBB'>Tuy Hoa (TBB)</option>
									<option value='VII'>Vinh (VII)</option>
								</optgroup>
								<optgroup label="Australia">
									<option value='MEL'>Melbourne (MEL)</option>
									<option value='SYD'>Sydney (SYD)</option>
								</optgroup>
								<optgroup label="Europe">
									<option value='AMS'>Amsterdam (AMS) </option>
									<option value='BCN'>Barcelona (BCN) </option>
									<option value='FRA'>Frankfurt (FRA)</option>
									<option value='LON'>London (LON)</option>
									<option value='MOW'>Moscow (MOW)</option>
									<option value='NCE'>Nice (NCE)</option>
									<option value='PAR'>Paris (PAR)</option>
									<option value='PRG'>Prague (PRG) </option>
									<option value='ROM'>Rome (ROM) </option>
								</optgroup>
								<optgroup label="Indochina">
									<option value='LPQ'>Luang Prabang (LPQ)</option>
									<option value='PNH'>Phnom Penh (PNH)</option>
									<option value='REP'>Siem Riep (REP)</option>
									<option value='VTE'>Vientiane (VTE)</option>
								</optgroup>
								<optgroup label="North East Asia">
									<option value='BJS'>Beijing (BJS)</option>
									<option value='PUS'>Busan (PUS)</option>
									<option value='CTU'>Chengdu (CTU)</option>
									<option value='FUK'>Fukuoka (FUK)</option>
									<option value='CAN'>Guangzhou (CAN)</option>
									<option value='HKG'>Hong Kong (HKG)</option>
									<option value='KHH'>Kaohsiung (KHH)</option>
									<option value='NGO'>Nagoya (NGO)</option>
									<option value='OSA'>Osaka (OSA)</option>
									<option value='SEL'>Seoul (SEL)</option>
									<option value='SHA'>Shanghai (SHA)</option>
									<option value='TPE'>Taipei (TPE)</option>
									<option value='TYO'>Tokyo (TYO)</option>
								</optgroup>
								<optgroup label="South East Asia">
									<option value='BKK'>Bangkok (BKK)</option>
									<option value='JKT'>Jakarta (JKT) </option>
									<option value='KUL'>Kuala Lumpur (KUL)</option>
									<option value='MNL'>Manila (MNL)</option>
									<option value='SIN'>Singapore (SIN)</option>
									<option value='RGN'>Yangon (RGN)</option>
								</optgroup>
								<optgroup label="United States of America">
									<option value='ATL'>Atlanta Hartsfield (ATL)</option>
									<option value='AUS'>Austin (AUS)</option>
									<option value='BOS'>Boston, Logan (BOS)</option>
									<option value='CHI'>Chicago IL (CHI)</option>
									<option value='DFW'>Dallas Fort Worth (DFW)</option>
									<option value='DEN'>Denver (DEN)</option>
									<option value='HNL'>Honolulu (HNL)</option>
									<option value='LAX'>Los Angeles (LAX)</option>
									<option value='MIA'>Miami (MIA)</option>
									<option value='MSP'>Minneapolis/St.Paul (MSP)</option>
									<option value='PHL'>Philadelphia (PHL)</option>
									<option value='PDX'>Portland (PDX)</option>
									<option value='SFO'>San Francisco (SFO)</option>
									<option value='SEA'>Seattle, Tacoma (SEA)</option>
									<option value='STL'>St Louis, Lambert (STL)</option>
									<option value='WAS'>Washington (WAS)</option>
								</optgroup>
							</select>
						</p>
						<p class="text-form w180">
							<label>Going to:</label>
							<select id="flight-tocity" name="flight-tocity">
								<option selected value="">Select</option>
							</select>
						</p>
					</div>
					<div class="clearfix">
						<p class="text-form">
							<label>Adults:</label>
							<select name="" style="width: 50px">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
							</select>
						</p>
						<p class="text-form">
							<label>Children:</label>
							<select name="" style="width: 50px">
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
							</select>
						</p>
						<p class="text-form">
							<label>Infant:</label>
							<select name="" style="width: 50px">
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
							</select>
						</p>
					</div>
					<div class="clearfix">
						<div class="text-form">
							<div class="map-ticker">
								<a href="<?=site_url("tours/interactive-maps")?>" class="viewmap"><img alt="" src="<?=IMG_URL?>map-ticker.png"></a>
							</div>
							<input type="submit" id="flight-search-button" class="search-button org-btn-large" value="SEARCH"/>
						</div>
					</div>
				</form>
			</div>
			<div style="display: none;">
				<form id="hotel-search-form" action="<?=site_url("hotels/search")?>" method="POST">
					<div class="clearfix">
						<p class="text-form w180">
							<label>Check-in date:</label>
							<span>
								<input type="text" id="hotel-checkindate" name="hotel-checkindate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
							</span>
						</p>
						<p class="text-form w180">
							<label>Check-out date:</label>
							<span>
								<input type="text" id="hotel-checkoutdate" name="hotel-checkoutdate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
							</span>
						</p>
					</div>
					<div class="clearfix">
						<p class="text-form w180">
							<label>In city:</label>
							<input type="text" id="hotel-location" name="hotel-location" class="text-input" placeholder="select city" />
						</p>
					</div>
					<div class="clearfix">
						<p class="text-form">
							<label>Rooms:</label>
							<select name="" style="width: 50px">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
							</select>
						</p>
						<p class="text-form">
							<label>Adults:</label>
							<select name="" style="width: 50px">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
							</select>
						</p>
						<p class="text-form">
							<label>Children:</label>
							<select name="" style="width: 50px">
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
							</select>
						</p>
					</div>
					<div class="clearfix">
						<div class="text-form">
							<div class="map-ticker">
								<a href="<?=site_url("tours/interactive-maps")?>" class="viewmap"><img alt="" src="<?=IMG_URL?>map-ticker.png"></a>
							</div>
							<input type="submit" id="hotel-search-button" class="search-button org-btn-large" value="SEARCH"/>
						</div>
					</div>
				</form>
			</div>
			<div style="display: none;">
				<form id="visa-apply-form" action="<?=site_url("visa/apply")?>" method="POST">
					<div class="clearfix">
						<p class="text-form w180">
							<label>Arrival date:</label>
							<span>
								<input type="text" id="visa-arrivaldate" name="visa-arrivaldate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
							</span>
						</p>
						<p class="text-form w180">
							<label>Exit date:</label>
							<span>
								<input type="text" id="visa-exitdate" name="visa-exitdate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
							</span>
						</p>
					</div>
					<div class="clearfix">
						<p class="text-form w180">
							<label>Type of Visa:</label>
							<select name="">
								<option>1 month single entry</option>
								<option>3 months single entry</option>
								<option>1 month multiple entry</option>
								<option>3 months multiple entry</option>
							</select>
						</p>
						<p class="text-form w180">
							<label>Number of Visa:</label>
							<select name="">
								<option>Only 1 Applicant</option>
								<option>2 Applicants</option>
								<option>3 Applicants</option>
								<option>4 Applicants</option>
								<option>5 Applicants</option>
								<option>6 Applicants</option>
								<option>7 Applicants</option>
								<option>8 Applicants</option>
								<option>9 Applicants</option>
								<option>10 Applicants</option>
								<option>11 Applicants</option>
								<option>12 Applicants</option>
								<option>13 Applicants</option>
								<option>14 Applicants</option>
								<option>15 Applicants</option>
							</select>
						</p>
					</div>
					<div class="clearfix">
						<div class="text-form">
							<input type="submit" id="visa-apply-button" class="search-button org-btn-large" value="APPLY NOW"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="content">
	<div class="highlight-info">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="44%">
					<div class="highlight-of-vietnam">
						<h1 class="head-title"><span class="highlight"><?=$vietnam_highlight->title?></span></h1>
						<div class="content">
							<a class="left" style="padding-right: 10px" href="">
								<img src="<?=IMG_URL?>welcome.png" width="240px"/>
							</a>
							<div class="summary captain">
								<?=$vietnam_highlight->summary?>
							</div>
							<p class="viewmore"><a title="<?=$vietnam_highlight->title?>" href="<?=site_url("highlights/vietnam/{$vietnam_highlight->alias}")?>">» View more</a></p>
							<div class="clr"></div>
						</div>
					</div>
				</td>
				<td width="56%" style="padding-left: 40px">
					<div class="highlight-of-vietnam">
						<h1 class="head-title"><span class="highlight">TOP TRAVEL DESTINATIONS</span></h1>
						<div class="content">
							<div class="left" style="width: 50%">
								<div class="content">
								<?
									$travel_destinations = array(
										'da-lat',
										'ha-long',
										'ha-noi',
										'ho-chi-minh',
										'nha-trang',
										'phan-thiet',
									);
									
									$hotels	= $this->m_hotel->getItems(NULL, 1);
									$tours	= $this->m_tour->getItems(NULL, 1);
									$cnt	= 0;
									
									foreach ($travel_destinations as $destination_alias) {
										$cnt_hotels = 0;
										$cnt_tours  = 0;
										
										$destination = $this->m_hotel_destination->load($destination_alias);
										if (empty($destination)) {
											$destination = $this->m_tour_destination->load($destination_alias);
										}
										
										if (empty($destination)) {
											continue;
										}
										
										foreach ($hotels as $hotel) {
											if ($hotel->city_alias == $destination_alias) {
												$cnt_hotels ++;
											}
										}
										foreach ($tours as $tour) {
											if ($tour->city_alias == $destination_alias) {
												$cnt_tours ++;
											}
										}
										?>
										<div>
											<a class="thumb_105_75" title="<?=$destination->name?>" href="<?=site_url("destinations/vietnam/{$destination->alias}")?>">
												<img src="<?=$destination->thumbnail?>"/>
											</a>
											<div class="summary">
												<h3 class="title"><a title="<?=$destination->name?>" href="<?=site_url("destinations/vietnam/{$destination->alias}")?>"><?=$destination->name?></a></h3>
												<div><?=$cnt_hotels?> Hotels</div>
												<div><?=$cnt_tours?> Tours</div>
											</div>
											<div class="clr"></div>
										</div>
										<?
										$cnt ++;
										if ($cnt >= 3) {
											$cnt  = 0;
											?>
												</div>
											</div>
											<div class="left" style="width: 50%">
												<div class="content">
											<?
										}
									}
								?>
								</div>
							</div>
							<p class="viewmore"><a title="Top Travel Destinations" href="<?=site_url("destinations/vietnam")?>">» View more</a></p>
							<div class="clr"></div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="highlight-info" style="margin-top: 50px">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="100%" style="vertical-align: top">
					<div class="highlight-of-vietnam">
						<h1 class="head-title"><span class="highlight">VIETNAM HIGHLIGHT TOURS</span></h1>
						<? foreach ($vietnam_highlight_tours as $tour) { 
							$review_info->category_id	= 1;
							$review_info->ref_id		= $tour->id;
							$review_info->topLevel		= 1;
							$reviews = $this->m_review->getItems($review_info, 1);
							
							$avg_rating = 3;
							foreach ($reviews as $review) {
								$avg_rating += $review->rating;
							}
							$avg_rating = round($avg_rating / (sizeof($reviews)+1));
						?>
						<div class="left" style="width: 20%">
							<div class="content">
								<div>
									<a class="thumb_180_120" title="<?=$tour->name?>" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/".$tour->alias)?>">
										<img src="<?=$tour->thumbnail?>"/>
									</a>
									<div class="summary">
										<h3 class="title"><a title="<?=$tour->name?>" href="<?=site_url("tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/".$tour->alias)?>"><?=$tour->name?></a></h3>
										<ul class="tour-meta">
											<li><div class="left"><img src="<?=IMG_URL?>star<?=$avg_rating?>.png"></div><div class="left" style="margin-left: 10px">(<?=((sizeof($reviews) > 1) ? sizeof($reviews)." ratings" : sizeof($reviews)." rating")?>)</div><div class="clr"></div></li>
											<li><div class="colored-icon icon-1"></div>Style: <?=$tour->category_name?> - <?=(($tour->duration > 1) ? $tour->duration." days" : $tour->duration." day")?></li>
											<li><div class="colored-icon icon-3"></div>From: $<?=$tour->price?></li>
										</ul>
									</div>
									<div class="clr"></div>
								</div>
							</div>
						</div>
						<? } ?>
						<div class="clr"></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="highlight-info" style="margin-top: 50px">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="*">
					<div class="highlight-of-vietnam">
						<h1 class="head-title"><span class="highlight">ACCOMMODATIONS</span></h1>
						<div class="content" style="margin-top: -10px">
							<div class="left" style="margin-top: 10px; padding-right: 10px">
								<img src="<?=IMG_URL?>accommodation.jpg"/>
							</div>
							<div class="left" style="width: 160px">
								<h3 class="sub-title" style="padding-top: 10px">HOTELS</h3>
								<ul class="hotels">
									<?	$cnt = 0;
										foreach ($hotels as $hotel) {
										if ($hotel->accommodation_type == '1') {
											?>
											<li>
												<a class="left" title="<?=$hotel->name?>" href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>"><?=word_limiter($hotel->name, 2)?></a>
												<span class="right">fr. $<?=$hotel->price?></span>
												<div class="clr"></div>
											</li>
											<?
											$cnt ++;
											if ($cnt >= 5) {
												break;
											}
										}
									} ?>
								</ul>
								<p class="viewmore"><a title="Vietnam Hotels" href="<?=site_url("hotels/vietnam")?>">&raquo; View more</a></p>
							</div>
							<div class="right resort-shadow" style="width: 160px; padding-left: 30px">
								<h3 class="sub-title" style="padding-top: 10px">RESORTS</h3>
								<ul class="resorts">
									<?	$cnt = 0;
										foreach ($hotels as $hotel) {
										if ($hotel->accommodation_type == '2') {
											?>
											<li>
												<a class="left" title="<?=$hotel->name?>" href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>"><?=word_limiter($hotel->name, 2)?></a>
												<span class="right">fr. $<?=$hotel->price?></span>
												<div class="clr"></div>
											</li>
											<?
											$cnt ++;
											if ($cnt >= 5) {
												break;
											}
										}
									} ?>
								</ul>
								<p class="viewmore"><a title="Vietnam Resorts" href="<?=site_url("resorts/vietnam")?>">&raquo; View more</a></p>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				</td>
				<td width="340px" style="padding-left: 40px">
					<div class="highlight-of-vietnam">
						<h1 class="head-title"><span class="highlight">VIETNAM VISA ONLINE</span></h1>
						<div class="content">
							<div class="vietnam-visa">
								<ul class="visa-services">
									<li><a title="Apply Visa Online" href="<?=site_url("visa/apply")?>">Apply Vietnam visa online</a></li>
									<li><a title="Apply Rush Visa Online" href="<?=site_url("visa/rush")?>">Get Rush Vietnam visa online</a></li>
									<li><a title="Vietnam Visa Fees" href="<?=site_url("visa/fees")?>">Vietnam visa fees</a></li>
									<li><a title="Questions About Vietnam Visa" href="<?=site_url("visa/answers")?>">Questions about Vietnam visa</a></li>
									<li><a title="Vietnam Visa Frequently Asked Questions" href="<?=site_url("visa/faqs")?>">Frequently Asked Questions</a></li>
									<li><a title="Vietnam Visa Processing" href="<?=site_url("visa/processing")?>">Vietnam visa processing</a></li>
								</ul>
								<div class="apply-visa">
									<a title="Apply Visa Online" href="<?=site_url("visa/apply")?>"><img alt="" src="<?=IMG_URL?>icon-applynow.jpg"></a>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="highlight-info" style="margin-top: 50px">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="40%">
					<div class="highlight-of-vietnam">
						<h1 class="head-title"><span class="highlight">VIETNAMESE FOOD & DRINK</span></h1>
						<div class="content">
							<? foreach ($vietnam_cuisines as $cuisine) { ?>
							<div>
								<a class="thumb_105_75" title="<?=$cuisine->title?>" href="<?=site_url("cuisines/vietnam/{$cuisine->category_alias}/{$cuisine->alias}")?>">
									<img src="<?=$cuisine->thumbnail?>"/>
								</a>
								<div class="summary">
									<h3 class="title"><a title="<?=$cuisine->title?>" href="<?=site_url("cuisines/vietnam/{$cuisine->category_alias}/{$cuisine->alias}")?>"><?=$cuisine->title?></a></h3>
									<p><?=word_limiter(strip_tags($cuisine->summary), 25)?></p>
								</div>
								<div class="clr"></div>
							</div>
							<? } ?>
							<p class="viewmore"><a title="Vietnam Cuisines" href="<?=site_url("cuisines/vietnam")?>">» View more</a></p>
						</div>
					</div>
				</td>
				<td width="60%" style="padding-left: 40px">
					<div class="highlight-of-vietnam">
						<h1 class="head-title"><span class="highlight">TRANSPORTATIONS</span></h1>
						<div class="content">
							<a title="Vietnam Transportations" href="<?=site_url("flights")?>"><img alt="Vietnam Transportations" src="<?=IMG_URL?>transportation.jpg"></a>
						</div>
						<div class="clr"></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="highlight-info" style="margin-top: 50px">
		<div class="highlight-of-vietnam">
			<h1 class="head-title"><span class="highlight"></span></h1>
			<div class="content" style="margin-top: -10px">
				<div class="left" style="width: 320px">
					<h3 class="sub-title" style="padding-top: 10px">NEWS AND EVENTS</h3>
					<ul class="events">
						<? foreach ($vietnam_news as $news) { ?>
							<li>
								<a title="<?=$news->title?>" href="<?=site_url("news/view/".$news->alias)?>"><?=$news->title?></a>
								<?=word_limiter($news->summary, 12)?>
							</li>
						<? } ?>
					</ul>
					<p class="viewmore"><a title="Vietnam Travel News" href="<?=site_url("news")?>">&raquo; View more</a></p>
				</div>
				<div class="left resort-shadow" style="width: 272px; margin-left:10px; padding-left: 30px; min-height: 350px">
					<h3 class="sub-title" style="padding-top: 10px">ABOUT TRAVELOVIETNAM</h3>
					<div class="content" style="padding-top: 12px">
						<a class="youtube" title="Hello Vietnam" href="http://www.youtube.com/watch?v=bK2pak9tmRo"><img src="<?=IMG_URL?>travelovietnam-video.jpg"/></a>
					</div>
				</div>
				<div class="right" style="width: 300px; margin-left:10px; padding-left: 30px; min-height: 320px">
					<div class="fade-slider testimonials-slider fade-effect">
						<ul class="testimonials">
							<li class="current">
								<div class="quote">
									<div class="block-background">We had the most amazing honeymoon trip in Vietnam thanks to you. There is no question the trip far exceeded our expectation. Thank you for the marvelous trip you arranged for me. We could never have put together such a well-planned visit by ourselves.<br>Amazing!</div>
								</div>
								<h4 class="quote-author">Mary Templeton</h4>
							</li>
						</ul>
						<div class="controls"><a href="#" class="current"></a><a href="#"></a><a href="#"></a></div>
					</div>
				</div>
				<div class="clr"></div>
			</div>
		</div>
	</div>
</div>
<div class="clr"></div>
