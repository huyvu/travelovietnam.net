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
