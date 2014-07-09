<!-- TEST -->
<div id="flightmap" style="background-color: #fff;width:100%;height:400px">

<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
<script type='text/javascript'>
var Gmap = {};

Gmap.id = 'flight-map';
Gmap.icon = '<?=IMG_URL?>flight-big-icon.png';
Gmap.zoom = 16;
Gmap.arcColor = '#0000FF';

Gmap.showPoint = function(title, lat, lng) {
	var p = new google.maps.LatLng(lat, lng);
	var map = new google.maps.Map(document.getElementById(Gmap.id), {
		zoom: Gmap.zoom,
		center: p,
		mapTypeId: google.maps.MapTypeId.SATELLITE
	});
	new google.maps.Marker({position: p, map: map, icon: Gmap.icon, title: title});
}

Gmap.showArc = function(title1, lat1, lng1, title2, lat2, lng2) {
	var shadow = new google.maps.MarkerImage(
		'http://maps.gstatic.com/intl/en_us/mapfiles/shadow50.png',
		new google.maps.Size(37, 34),
		new google.maps.Point(0,0),
		new google.maps.Point(9, 35)
	);
	var p1 = new google.maps.LatLng(lat1, lng1);
	var p2 = new google.maps.LatLng(lat2, lng2);
	var map = new google.maps.Map(document.getElementById(Gmap.id), {mapTypeId: google.maps.MapTypeId.TERRAIN});
	new google.maps.Marker({position: p1, map: map, title: title1, icon: Gmap.icon, shadow: shadow});
	new google.maps.Marker({position: p2, map: map, title: title2, icon: Gmap.icon, shadow: shadow});
	new google.maps.Polyline({
		geodesic: true,
		map: map,
		path: [p1, p2],
		strokeColor: Gmap.arcColor,
		strokeOpacity: 0.50,
		strokeWeight: 2
	});
	var b = new google.maps.LatLngBounds();
	b.extend(p1);
	b.extend(p2);
	map.fitBounds(b);
}
</script>
<script type='text/javascript'>
Gmap.showArc('HAN', 21.22053, 105.80760, 'SGN', 10.8178, 106.6530);
</script>