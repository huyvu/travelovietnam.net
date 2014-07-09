<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>site.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var map;
			var options = {
				zoom:12,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("mapcanvas"), options);
			geoclient = new google.maps.Geocoder();
		    geoclient.geocode({'address': '<?=$item->address?>'}, function(results, status){
		        if(status == google.maps.GeocoderStatus.OK){
		            map.setCenter(results[0].geometry.location);
		            var marker = new google.maps.Marker({
		                map: map,
		                position: results[0].geometry.location,
		                title : '<?=$item->address?>'
		            });
		        }
		    });
		});
	</script>
</head>
<body style="background: none">
	<div id="popup-map-container">
		<h1><?=$item->name?></h1>
		<p class="desc">
			<?=$item->address?>
		</p>
		<div class="googlemap">
			<div id="mapcanvas"></div>
		</div>
		<div class="clr"></div>
	</div>
</body>
</html>