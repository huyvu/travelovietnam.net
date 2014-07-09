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
			<img alt="" src="<?=IMG_URL?>arrow.png"> Frequently Asked Questions
			<? require_once(APPPATH."views/module/social.php"); ?>
		</div>
		<h1 class="headtitle">Frequently Asked Questions</h1>
		<div class="faqs">
			<ul class="list1">
				<?php 
					if (!empty($items) && sizeof($items)) {
						$cnt = 1;
						foreach ($items as $item) {
							?>
							<li <?=($cnt==sizeof($items))?"class='last'":""?>>
								<div class="stt"><?=$cnt?>.</div>
								<div class="title"><a href="#q<?=$cnt?>"><?=$item->title?></a></div>
								<div class="clr"></div>
							</li>
							<?
							$cnt ++;
						}
					}
				?>
			</ul>
			<br/>
			<h1>Answers</h1>
			<ul class="list2">
				<?php 
					if (!empty($items) && sizeof($items)) {
						$cnt = 1;
						foreach ($items as $item) {
							?>
							<li class="item">
								<h2 class="title"><a name="q<?=$cnt?>"></a> <?=$cnt?>. <?=$item->title?></h2>
								<div class="detail">
								<?=$item->content?>
								</div>
								<div class="gotop">
									<a href="#">Back to top</a>
								</div>
							</li>
							<?
							$cnt ++;
						}
					}
				?>
			</ul>
		</div>
	</div>
</div>
<div class="clr"></div>
