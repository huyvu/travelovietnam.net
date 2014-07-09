<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam" href="<?=site_url("vietnam/overview")?>">Vietnam</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Top Destinations
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div>
		<h1 class="page-title">VIETNAM TOP DESTINATIONS</h1>
		<div style="margin-top: -10px; margin-bottom: 15px">
			<img alt="" src="<?=IMG_URL?>vietnam/wizban/vietnam-destination.jpg">
		</div>
		<div id="vietnam-destinations">
			<div class="overview-summary">
				Vietnam is worldwide known as the peaceful country with long history, special traditional life, rich culture and numerous magical landscapes: Hanoi, Halong bay, Sapa, Hoi an, Mekong delta... The information below will help you have depth exploration about all stunning destinations in Vietnam.
			</div>
			<div class="destinations">
				<div class="regions">
					<ul class="left tabs">
						<li><a class="<?=((empty($region))?"selected":"")?>" href="<?=site_url("vietnam/top-destinations")?>">All</a></li>
						<li><a class="<?=((!empty($region) && strtolower($region)=="northern")?"selected":"")?>" href="<?=site_url("vietnam/top-destinations/northern")?>">Northern Vietnam</a></li>
						<li><a class="<?=((!empty($region) && strtolower($region)=="central")?"selected":"")?>" href="<?=site_url("vietnam/top-destinations/central")?>">Central Vietnam</a></li>
						<li><a class="<?=((!empty($region) && strtolower($region)=="southern")?"selected":"")?>" href="<?=site_url("vietnam/top-destinations/southern")?>">Southern Vietnam</a></li>
					</ul>
					<div class="right search-form">
						<form action="<?=site_url("vietnam/top-destinations")?>" method="get">
							<button type="submit" class="search-btn-component search-button" id="search-btn">
								<span class="search-button-icon"></span>
							</button>
							<div class="search-terms search-terms-border">
								<label><input type="text" title="Search destinations" value="<?=(!empty($_GET["search"]) ? $_GET["search"] : "")?>" name="search" class="search-term" placeholder="Search destinations"></label>
							</div>
						</form>
					</div>
					<div class="clr"></div>
				</div>
				<? if (!sizeof($items)) { ?>
				<div class="destination-noresult">No destinations found.</div>
				<? } ?>
				<?
					$idx = 1;
					$row = 1;
					$rowidx = 1;
					foreach ($items as $item) {
						$destination = $this->m_tour_destination->load($item->destination_id);
				?>
				<div class="destination destination<?=$idx?> row<?=$row?> <?=(($row>1)?"none":"")?>">
					<div class="flag">
						<img alt="" src="<?=IMG_URL?>vietnam/destination.png">
					</div>
					<div class="thumbnail">
						<a title="<?=$item->title?>" href="<?=site_url("vietnam/top-destinations/".$destination->alias)?>">
							<img alt="<?=$item->title?>" src="<?=$item->thumbnail?>">
						</a>
					</div>
					<div class="content">
						<h1 class="title">
							<a title="<?=$item->title?>" href="<?=site_url("vietnam/top-destinations/".$destination->alias)?>"><?=$item->title?></a>
						</h1>
						<div class="summary">
							<?=$item->summary?>
						</div>
					</div>
					<div class="extra">
						<p><a title="View all trips to <?=$item->title?>" href="<?=site_url("tours/vietnam/".$destination->alias)?>">&raquo; View all trips to <?=$destination->name?></a></p>
					</div>
				</div>
				<?
						$idx = ($idx%4) + 1;
						if ($rowidx == 8) {
							$row++;
						}
						$rowidx = ($rowidx%8) + 1;
					}
				?>
				<div class="clr"></div>
				<? if (($row) > 1 && sizeof($items) > 8) { ?>
				<div class="show-more-container">
					<a class="link more-destinations">Show more destinations</a>
				</div>
				<? } ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var row = 2;
	var maxrow = '<?=$row?>';
	$(document).ready(function() {
		$('.more-destinations').click(function() {
			$('.row'+row).show('fade');
			row = row + 1;
			if (row > maxrow) {
				$('.show-more-container').hide();
			}
		});
	});
</script>
