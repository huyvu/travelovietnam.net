<div class="left">
	<? require_once(APPPATH."views/module/visa/apply_form.php"); ?>
	<? require_once(APPPATH."views/module/visa/support_online.php"); ?>
	<? require_once(APPPATH."views/module/visa/confidence.php"); ?>
</div>
<div class="right" style="width: 710px">
	<div id="view-container">
		<div id="breadcrumbs">
			<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
			<img alt="" src="<?=IMG_URL?>arrow.png">
			<a class="pathway" title="Visa" href="<?=site_url("visa")?>">Visa</a>
			<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Visa News
			<? require_once(APPPATH."views/module/social.php"); ?>
		</div>
		<h1 class="headtitle">Vietnam Visa News</h1>
		<div id="view_body">
			<?php
				if (!empty($items) && sizeof($items)) {
					$cnt = $offset + 1;
					for ($i=$offset; $i<sizeof($items) && $cnt<=($offset+10); $i++) {
						$item = $items[$i];
						?>
						<div class="itemlist">
							<h1><a href="<?=site_url("news/view/".$item->alias)?>"><?=$cnt?>. <?=$item->title?></a></h1>
							<p class="view_content"><?=$item->summary?></p>
							<span class="view_more"><a href="<?=site_url("news/view/".$item->alias)?>">» View more</a></span>
						</div>
						<?
						$cnt ++;
					}
				}
			?>
		</div>
		<?= $this->util->pagination(BASE_URL."/news/index", sizeof($items), 10); ?>
	</div>
</div>
<div class="clr"></div>
