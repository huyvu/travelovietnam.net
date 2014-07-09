<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div class="toolbar" id="toolbar">
			<table class="toolbar">
				<tr>
					<td class="button" id="toolbar-new">
						<a href="#" onclick="javascript:hideMainMenu(); submitbutton('add')" class="toolbar">
						<span class="icon-32-new" title="New">
						</span>
						New
						</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="header icon-48-generic">
			Tour Departure Rates
		</div>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
<div class="clr"></div>
<div id="element-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div style="line-height: 30px">
			<? $tour = $this->m_tour->load($departure->tour_id); ?>
			<a href="<?=site_url("administrator/tour_departures/".$tour->id)?>"><?=date('Y-m-d', strtotime($departure->start)).' > '.date('Y-m-d', strtotime($departure->finish))?></a> : <?=$tour->name?>
		</div>
		<form method="POST" action="<?=site_url("administrator/update_tour_departure_rates_advanced")?>" name="adminForm">
			<input type="hidden" name="departure_id" value="<?=$departure->id?>" />
			<div id="editcell">
				<?
					$arrduration = array();
					$arrtype = array();
					$hassupplement = false;
					foreach ($items as $rate) {
						if (!in_array($rate->group_size, $arrduration) && !$rate->single_supplement) {
							$arrduration[$rate->group_size] = $rate->group_size;
						}
						if (!in_array($rate->name, $arrtype)) {
							$arrtype[$rate->name] = $rate->name;
						}
						if ($rate->single_supplement) {
							$hassupplement = true;
						}
					}
				?>
				<table class="adminlist">
					<thead>
						<tr>
							<td>Group Size</td>
							<? foreach ($arrduration as $duration => $val) { ?>
							<td>fr. <?=(($val < 2) ? $val." person" : $val." persons")?></td>
							<? } ?>
							<? if ($hassupplement) { ?>
							<td>Single Supp'</td>
							<? } ?>
						</tr>
					</thead>
					<tr>
						<?
							$irow = 0;
							foreach ($arrtype as $type => $valtype) {
								if ($irow++) {
									echo '</tr><tr>';
								}
								echo '<td class="first"><a href="'.site_url("administrator/edit_tour_departure_rates/".$departure->id.'/'.$valtype).'">'.$valtype.'</a></td>';
								foreach ($arrduration as $duration => $valduration) {
									$hasrate = 0;
									foreach ($items as $rate) {
										if ($rate->name == $valtype && $rate->group_size == $valduration && !$rate->single_supplement) {
											echo '<td><a href="'.site_url("administrator/edit_tour_departure_rate/".$rate->id).'">$'.number_format($rate->price,0,',','.').'</a></td>';
											$hasrate = 1;
											break;
										}
									}
									if (!$hasrate) {
										echo '<td>-</td>';
									}
								}
								if ($hassupplement) {
									$hasrate = 0;
									foreach ($items as $rate) {
										if ($rate->name == $valtype && $rate->single_supplement) {
											echo '<td><a href="'.site_url("administrator/edit_tour_departure_rate/".$rate->id).'">+ $'.number_format($rate->price,0,',','.').'</a></td>';
											$hasrate = 1;
											break;
										}
									}
									if (!$hasrate) {
										echo '<td>-</td>';
									}
								}
							}
						?>
					</tr>
				</table>
			</div>
			<div class="clr"></div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
