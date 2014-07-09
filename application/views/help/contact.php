<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<style type="text/css">
	.subiz_online { cursor: pointer; visibility: hidden; height: 32px; width: 166px; line-height: 32px; color: white; z-index: -1}
	.subiz_offline { cursor: pointer; visibility: hidden; height: 32px; width: 166px; line-height: 32px; color: white; z-index: -1}
	.contact-options #subiz_status a{background: none}
</style>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
$(document).ready(function() {
	var options = {
		zoom:14,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("mapcanvas"), options);
	geoclient = new google.maps.Geocoder();
    geoclient.geocode({'address': '<?=ADDRESS?>'}, function(results, status){
        if(status == google.maps.GeocoderStatus.OK){
            var location = new google.maps.LatLng(10.794082,106.669883);
            map.setCenter(location);
            var marker = new google.maps.Marker({
                map: map,
                position: location,
                title : '<?=ADDRESS?>'
            });
        }
    });
});
</script>

<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">Help Center
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="help-center">
		<div class="left help-content">
			<div class="main-banner">
				<div class="contact-banner"></div>
			</div>
			<div class="contact-options">
				<div class="left email-us">
					<a href="<?=site_url("help/emailus")?>"><div class="label">Email Us</div></a>
				</div>
				<div class="left new-ticket">
					<a href="<?=site_url("help/newticket")?>"><div class="label">Submit Ticket</div></a>
				</div>
				<div class="left live-chat">
					<a><div class="label">Chat Online</div><div id="subiz_status"></div></a>
				</div>
				<div class="left call-us">
					<a><div class="label">Call Us</div></a>
					<div class="call-details">
						<div class="contact-tellocal">Tollfree: <?=TOLL_FREE?></div>
						<div class="contact-hotline">Hotline: <?=HOTLINE?></div>
					</div>
				</div>
				<div class="clr"></div>
			</div>
			<div style="padding: 10px;">
				<div class="help-box process-box">
					<div class="hd">
						<h3>TRAVELOVIETNAM CO, LTD.</h3>
					</div>
					<div class="clearfix head-office">
						<div class="contact-address">Address: <?=ADDRESS?></div>
						<div class="contact-tellocal">Tollfree: <?=TOLL_FREE?></div>
						<div class="contact-hotline">Hotline: <?=HOTLINE?></div>
						<div class="contact-email">Email: <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a></div>
					</div>
				</div>
				<div class="popular-questions">
					<div class="hd">
						<h3>TRAVELOVIETNAM ON MAP</h3>
					</div>
					<div class="bd clearfix">
						<div class="googlemap">
							<div id="mapcanvas"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="right" style="width: 280px;">
			<? require_once(APPPATH."views/help/categories.php"); ?>
		</div>
		<div class="clr"></div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$(".call-us a").click(function(e){
		e.stopPropagation();
		var display = $('.call-details').css('display');
		if (display == 'none') {
			$('.call-details').css('display','block');
		} else{
			$('.call-details').css('display','none');
		}

	});

	$(document).click(function(e){
		var container = $(".call-details");
		console.log(container.is(e.target));
	   if(container.has(e.target).length === 0 && !container.is(e.target)) 
	   		$('.call-details').css('display','none');
	   	else
	   		$('.call-details').css('display','block');
	});
});
</script>