<div class="box-mn-left">
	<h1 class="top-mn">Vietnam Tours By Destinations</h1>
	<ul>
		<? foreach ($destinations as $destination) { ?>
		<li><a title="<?=$destination->name?>" href="<?=site_url("tours/vietnam/".$destination->alias)?>"><?=$destination->name?></a></li>
		<? } ?>
	</ul>
	<span class="bot-mn">&nbsp;</span>
	<div class="clr"></div>
</div>