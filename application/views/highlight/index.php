<div id="view-container">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Highlights
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="left news">
		<h1 class="headtitle">Vietnam Highlights</h1>
		<div class="content">
			<?php
				if (!empty($items) && sizeof($items)) {
					$cnt = $offset + 1;
					for ($i=$offset; $i<sizeof($items) && $cnt<=($offset+10); $i++) {
						$item = $items[$i];
						?>
						<div class="detail">
							<a class="thumb_130_120" href="<?=site_url("highlights/".$item->alias)?>">
								<img src="<?=$item->thumbnail?>"/>
							</a>
							<h2 class="title">
								<a href="<?=site_url("highlights/".$item->alias)?>" class="link-title"><?=$item->title?></a>
							</h2>
							<h3 class="lead">
								<?=$item->summary?>
							</h3>
							<div class="clr"></div>
						</div>
						<?
						$cnt ++;
					}
				}
			?>
		</div>
		<?= $this->util->pagination(BASE_URL."/highlights/index", sizeof($items), 10); ?>
	</div>
	<div class="right categories">
		<div class="news-categories">
			<div class="title">CATEGORIES</div>
			<ul>
			</ul>
		</div>
	</div>
	<div class="clr"></div>
</div>