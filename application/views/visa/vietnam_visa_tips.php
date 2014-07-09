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
			<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Visa Tips
		</div>
		<h1 class="headtitle">Vietnam Visa Tips</h1>
		<div id="tips">
			<ul>
				<?
					$l = 0;
					$r = sizeof($items)-1;
					while ($l <= $r) {
				?>
						<li class="flagleft">
							<a href="<?=site_url("vietnam-visa-tips/view/{$items[$l]->alias}")?>"><img src="<?=IMG_URL?>flags/<?=$items[$l]->nation?>.png"/> <?=$items[$l]->title?></a>
						</li>
				<?	if ($l != $r) { ?>
						<li class="flagright">
							<a href="<?=site_url("vietnam-visa-tips/view/{$items[$r]->alias}")?>"><img src="<?=IMG_URL?>flags/<?=$items[$r]->nation?>.png"/> <?=$items[$r]->title?></a>
						</li>
				<? } ?>
				<?
						$l += 1;
						$r -= 1;
					}
				?>
			</ul>
			<div class="clr"></div>
		</div>
	</div>
</div>
<div class="clr"></div>