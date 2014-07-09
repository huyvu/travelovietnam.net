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
	});
</script>
<div id="quick-finder">
	<form action="<?=site_url("hotels/search")?>" method="POST">
		<h1>HOTEL QUICK FINDER</h1>
		<div class="content">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td>
						<span class="title">Check-in date:</span>
						<span class="input">
							<input type="text" id="hotel-checkindate" name="hotel-checkindate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
						</span>
					</td>
					<td>
						<span class="title">Check-out date:</span>
						<span class="input">
							<input type="text" id="hotel-checkoutdate" name="hotel-checkoutdate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
						</span>
					</td>
				</tr>
				<tr>
					<td>
						<span class="title">Depart from:</span>
						<span class="input">
							<input type="text" id="hotel-location" name="hotel-location" class="text-input" placeholder="select city" />
						</span>
					</td>
				</tr>
			</table>
			<div class="quick-finder-button">
				<input type="submit" class="search-button" value="" />
			</div>
		</div>
	</form>
</div>