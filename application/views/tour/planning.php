<?
	$tour_planning_result = $this->session->flashdata('tour_planning_result');
	if (!empty($tour_planning_result)) {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			msgbox("<?=$tour_planning_result->message?>", "<?=$tour_planning_result->title?>");
		});
	</script>
<?
	}
?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
	var map;
	var centerLatLngs = new google.maps.LatLng(16.467695, 107.582703);
	var directionsDisplay = new google.maps.DirectionsRenderer();
	var directionsService = new google.maps.DirectionsService();

	function initmap() {
		var options = {
			zoom:5,
			center: centerLatLngs,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("mapcanvas"), options);
	}
	
	function calcRoute() {
		var start;
		var end;
		var destinations = new Array();
		$(".destination").each(function() {
			if ($(this).is(':checked')) {
				var point = {};
				point["location"] = $(this).val();
				destinations.push(point);
			}
		});

		var points = destinations.length;
		
		if (points > 0) {
			if (points <= 1) {
				start = end = destinations[0]["location"];
				destinations.pop();
			} else {
				start = destinations[0]["location"];
				end = destinations[destinations.length-1]["location"];
				destinations.shift();
				destinations.pop();
			}
			
			var request = {
				origin:start,
				destination:end,
				waypoints:destinations,
				travelMode: google.maps.TravelMode['DRIVING']
			};
			
			directionsService.route(request, function(result, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(result);
				}
			});
			
			directionsDisplay.setMap(map);
	
			if (points <= 1) {
				var listener = google.maps.event.addListener(map, "idle", function() { 
				  map.setZoom(5);
				  google.maps.event.removeListener(listener);
				});
			}
		}
	}
	
	function drawmap() {
		initmap();
		calcRoute();
	}

	$(document).ready(function() {
		var options = {
				numberOfMonths : 2,
				minDate: 0
		};
		
		$("#req_fromdate").datepicker(options);
		$("#req_todate").datepicker(options);

		$(".icon-destination").click(function() {
			$(".icon-destination").addClass("icon-destination-active");
			$(".icon-map").removeClass("icon-map-active");
			$(".view-destinations").show();
			$(".view-googlemap").hide();
			$(".btnCheckmap").html('Check map');
		});
		
		$(".icon-map").click(function() {
			$(".icon-destination").removeClass("icon-destination-active");
			$(".icon-map").addClass("icon-map-active");
			$(".view-destinations").hide();
			$(".view-googlemap").show();
			drawmap();
			$(".btnCheckmap").html('Close map');
		});

		$(".btnCheckmap").click(function(e) {
			e.preventDefault();
			if($(".icon-destination").hasClass('icon-destination-active')) {
				$(".icon-destination").removeClass("icon-destination-active");
				$(".icon-map").addClass("icon-map-active");
				$(".view-destinations").hide();
				$(".view-googlemap").show();
				drawmap();
				$(".btnCheckmap").html('Close map');
			}else{
				$(".icon-destination").addClass("icon-destination-active");
				$(".icon-map").removeClass("icon-map-active");
				$(".view-destinations").show();
				$(".view-googlemap").hide();
				$(".btnCheckmap").html('Check map');
			}
			
		});
	});
</script>

<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Tours" href="<?=site_url("tours/search")?>">Vietnam Tours</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Plan Your Own Trip
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div id="planning">
		<div class="planning-steps">
			<div class="planning-steps-detail">
				<div class="steps">
					<p class="planning-tip-title">
						HOW TO PLAN YOUR OWN TRIP?
					</p>
					<p class="planning-des">
						Some trips are scrimped and saved for, and others can be spontaneous and exciting. All trips are meant for adventure, relaxation and enjoyment. By planning well, you can ensure you that you and your family can enjoy a hassle-free trip!
					</p>
					<br/>
					<p class="planning-step"><span class="num">1</span> Send us your requirements</p>
					<p class="planning-step"><span class="num">2</span> We try our best to send you a suitable proposal</p>
					<p class="planning-step"><span class="num">3</span> Receive our booking confirmation and pay in advance</p>
					<p class="planning-step"><span class="num">4</span> Come to Vietnam and enjoy the trips</p>
				</div>
				<div class="clr"></div>
			</div>
		</div>
		<form name="requestform" id="requestform" action="<?=site_url("tours/send_request")?>" method="POST">
			<div class="step-container">
				<div class="step-title">
					1. PICK YOUR DESTINATIONS
					<div class="icons">
			            <div class="left icon-destination icon-destination-active" tooltip="Destination"></div>
			            <div class="left icon-map" tooltip="Map"></div>
			            <div class="clr"></div>
			        </div>
				</div>
				<div class="view-destinations">
					<div style="background-color: #FFFFFF; padding: 15px 15px 0px">
						<div class="field-header">Where you want to visit? <span class="required">*</span></div>
					</div>
					<div class="destinations">
						<ul>
							<?
							$destinations = $this->m_tour_destination->getItems(1);
							foreach ($destinations as $destination) { ?>
							<li><input type="checkbox" id="req_destination-<?=$destination->id?>" name="req_destinations[]" class="destination" value="<?=$destination->name?>"> <label for="req_destination-<?=$destination->id?>"><?=$destination->name?></label></li>
							<? } ?>
						</ul>
						<div class="clr"></div>
					</div>
				</div>
				<div class="view-googlemap none">
					<div class="googlemap">
						<div id="mapcanvas"></div>
					</div>
				</div>

				<button class="btnCheckmap" >Check map</button>
				<div class="clr"></div>
				<div class="step-title">2. YOUR TRIP PLANS</div>
				<div style="background-color: #FFFFFF; padding: 15px">
					<div>
						<div class="field-header">How long are you planning on travelling? <span class="required">*</span></div>
						<div class="field-body">
							<div class="left w200">
								<div>From date <span class="required">*</span></div>
								<div class="sline"><span class="calendar"><input type="text" name="req_fromdate" id="req_fromdate" placeholder="mm/dd/yyyy" alt="mm/dd/yyyy" required title="From date is Required!" x-moz-errormessage="From date is Required!"></span></div>
							</div>
							<div class="left w200">
								<div>To date <span class="required">*</span></div>
								<div class="sline"><span class="calendar"><input type="text" name="req_todate" id="req_todate" placeholder="mm/dd/yyyy" alt="mm/dd/yyyy" required title="To date is Required!" x-moz-errormessage="To date is Required!"></span></div>
							</div>
							<div class="clr"></div>
						</div>
					</div>
					
					<div>
						<div class="field-header">How many people are travelling? <span class="required">*</span></div>
						<div class="field-body">
							<div class="left w200">
								<div>Adults (10+ yrs)</div>
								<div class="sline">
									<select name="req_adult" id="req_adult">
									<? for ($i=1; $i<=20; $i++) { ?>
										<option value="<?=$i?>"><?=$i?></option>
									<? } ?>
									</select>
								</div>
							</div>
							<div class="left w200">
								<div>Children (5-10 yrs)</div>
								<div class="sline">
									<select name="req_children" id="req_children">
									<? for ($i=0; $i<=20; $i++) { ?>
										<option value="<?=$i?>"><?=$i?></option>
									<? } ?>
									</select>
								</div>
							</div>
							<div class="left w200">
								<div>Babies (&lt;5 yrs)</div>
								<div class="sline">
									<select name="req_infant" id="req_infant">
									<? for ($i=0; $i<=20; $i++) { ?>
										<option value="<?=$i?>"><?=$i?></option>
									<? } ?>
									</select>
								</div>
							</div>
							<div class="clr"></div>
						</div>
					</div>
					
					<div>
						<div class="field-header">Your plans</div>
						<div class="field-body">
							<div class="field-text">* Please give as much detail as possible</div>
							<div>
								<textarea cols="35" rows="4" name="req_content" id="req_content"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="step-title">3. YOUR CONTACT DETAILS</div>
				<div style="background-color: #FFFFFF; padding: 15px">
					<div>
						<div class="field-body">
							<div class="field-input-header">Your Name <span class="required">*</span></div>
							<div>
								<input type="text" class="field-input" name="req_fullname" id="req_fullname" required title="Your name is Required!" x-moz-errormessage="Your name is Required!">
							</div>
						</div>
					</div>
					<div>
						<div class="field-body">
							<div class="field-input-header">Your Email <span class="required">*</span></div>
							<div>
								<input type="text" class="field-input" name="req_email" id="req_email" required title="Your email is Required!" x-moz-errormessage="Your email is Required!">
							</div>
						</div>
					</div>
					<div>
						<div class="field-body">
							<div class="field-input-header">Your Phone <span class="required">*</span></div>
							<div>
								<input type="text" class="field-input" name="req_phone" id="req_phone" required title="Your phone is Required!" x-moz-errormessage="Your phone is Required!">
							</div>
						</div>
					</div>
					<div>
						<div class="field-body">
							<div class="field-input-header">Captcha <span class="required">*</span></div>
							<div>
								<input type="text" class="field-input" style="width: 60px;" name="req_code" id="req_code" required title="Captcha is Required!" x-moz-errormessage="Captcha is Required!"> <label class="security-code"><?=$this->util->createSecurityCode()?></label>
							</div>
						</div>
					</div>
				</div>
				<div class="request-btn">
					<button type="submit" class="red-btn">SEND REQUEST</button>
				</div>
			</div>
			<input type="hidden" id="request-uri" name="request-uri" value="<?=current_url()?>">
		</form>
	</div>
</div>