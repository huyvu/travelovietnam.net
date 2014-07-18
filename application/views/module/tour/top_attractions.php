<?if(isset($_GET['destination'])) :?>
<div class="blue-panel">
	<div class="panel-header">
		<img src="<?=IMG_URL?>attraction-icon.png" alt="">
		<h1>Top Attraction</h1>
	</div>
	<ul>
		<li><a href="">All Attractions...</a></li>
		<?
			$info->destinations = $_GET['destination'][0];
			$attractions = $this->m_sight->getItems($info,1);
			foreach($attractions as $attraction) {
		?>
			<li><a href="<?=site_url("sights/{$attraction->alias}")?>"><?=$attraction->title?></a></li>
		<?	} ?>
	</ul>
	<a class="all-things" href="">SEE ALL ATTRACTIONS </a>
</div>
<?endif?>