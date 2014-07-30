<?if(isset($destination)) :?>
<div class="blue-panel">
	<div class="panel-header">
		<img src="<?=IMG_URL?>attraction-icon.png" alt="">
		<h1>Top Attraction</h1>
	</div>
	<ul>
		<li><a href="">All Attractions...</a></li>
		<?
			$info->destinations = $destination->id;
			$attractions = $this->m_sight->getItems($info,1);
			$idx = 0;
			foreach($attractions as $attraction) {
			$idx++;
		?>
			<li class="<?=($idx>7)?'extra-attraction none':''?>"><a href="<?=site_url("sights/{$attraction->alias}")?>"><?=$attraction->title?></a></li>
		<?	} ?>
	</ul>
	<a class="all-things" href="javascript:void(0)">SEE ALL ATTRACTIONS </a>
	<a class="less-things none">SEE FEWER ATTRACTIONS</a>
</div>
<?endif?>

<script>
	// Show more & show fewer Attractions
	$(".all-things").click(function() {
			$(".extra-attraction").show('fade');
			$(".all-things").hide();
			$(".less-things").show();
		});
	$(".less-things").click(function() {
		$(".extra-attraction").hide('fade');
		$(".all-things").show();
		$(".less-things").hide();
	});
</script>