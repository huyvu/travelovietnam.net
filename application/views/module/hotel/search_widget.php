<?
	$destinations = $this->m_hotel_destination->getItems(1);
	$arrdestination = array();
	foreach ($destinations as $destination) {
		$arrdestination[] = $destination->name;
	}
?>
<script type="text/javascript">
	$(document).ready(function() {
		var options = {
				numberOfMonths : 2,
				minDate: 0
		};
		$("#hotel-checkindate").datepicker(options);
		$("#hotel-checkoutdate").datepicker(options);

		var availableTags = [<?="\"".implode("\",\"", $arrdestination)."\"";?>];
		$( "#hotel-location" ).autocomplete({
			source: availableTags,
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
	});
</script>
<div id="hotel-search-widget">
	<div class="widget-content">
		<form action="<?=site_url("hotels/search")?>" method="POST">
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
				<p class="text-form">
					<label>In city (or landmap):</label>
					<input type="text" id="hotel-location" name="hotel-location" class="text-input" placeholder="select city" />
				</p>
			</div>
			<div class="clearfix">
				<p class="text-form">
					<label>Rooms:</label>
					<select id="rooms" name="rooms" style="width: 50px">
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
					<select id="adults" name="adults" style="width: 50px">
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
					<select id="children" name="children" style="width: 50px">
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
					<input type="submit" class="search-button org-btn-large" value="SEARCH"/>
				</div>
			</div>
		</form>
	</div>
</div>