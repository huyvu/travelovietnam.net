<div id="view-container">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Visa" href="<?=site_url("visa")?>">Visa</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Embassies
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="headtitle">Vietnam Embassies</h1>
	<div id="vietnam-embassies">
		<p>
			This page provides you a complete information on Vietnamese embassies' address and contacts in all countries by continent.<br/>
			Please click on the link below to get started.
		</p>
		
		<br><br>
		
		<div class="pagination">
		<?
			$char = "A";
			do {
				?>
				<a href="#eb_<?=$char?>"><?=$char?></a>
				<?
			} while ($char++ < "Z");
		?>
		</div>
		
		<div class="nations">
			<?
				$char = "A";
				do {
					?>
					<div class="embassies" id="eb_<?=$char?>">
						<div class="number"><?=$char?></div>
						<ul class="list">
						<?
						if (!empty($nations) && sizeof($nations)) {
							foreach ($nations as $nation) {
								if (substr($nation->name, 0, 1) == $char) {
									$info->nation = $nation->name;
									$embassy = $this->m_embassy->getItem($info);
								?>
								<li>
									<a href="<?=site_url("visa/vietnam-embassies/".$nation->alias)?>"><?=$nation->name?></a>
									<? if (!empty($embassy)) { ?>
									<img class="png" alt="Vietnam-visa in <?=$nation->name?>" title="Vietnam-visa in <?=$nation->name?>" src="<?=IMG_URL?>stick.png" />
									<? } ?>
								</li>
								<?
								}
							}
						}
						?>
						</ul>
					</div>
					<?
				} while ($char++ < "Z");
			?>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div class="clr"></div>