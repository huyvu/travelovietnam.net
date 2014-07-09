<?
	$rest_arr = array();
	$rest = $this->m_restaurant->getGmapAddress(NULL,1);
	$rest = array(implode($rest, ','));
?>

	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript">


		$(document).ready(function () {
			

			var addresses = [<?=$rest[0]?>];

			for (var x = 0; x < addresses.length; x++) {
				console.log(addresses[x]);
				$.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
					console.log(data['results'][0].geometry.location.lat);
					console.log(data['results'][0].geometry.location.lng);

				});
			}
		});
	</script>

	<ul>
	<?foreach($items as $item){?>
		<li><?=$item?></li>
	<?}?>
	</ul>

	<div id="gmap">
		<input type="hidden" name='gmap' value="" />
	</div>
