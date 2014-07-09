<div class="box-mn-left">
	<h1 class="top-mn">Recommended Vietnam Tours</h1>
	<ul>
		<? foreach ($categories as $category) { ?>
		<li><a class="<?=($this->uri->segment(3) == $category->alias) ? "current" : ""?>" title="<?=$category->name?>" href="<?=site_url("tours/search/".$category->alias)?>"><?=$category->name?></a></li>
		<? } ?>
	</ul>
	<span class="bot-mn">&nbsp;</span>
	<div class="clr"></div>
</div>