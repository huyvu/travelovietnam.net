<div id="view-container">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Visa" href="<?=site_url("visa")?>">Visa</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Embassies" href="<?=site_url("visa/vietnam-embassies")?>">Vietnam Embassies</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<?=$nation->name?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
<?
	$info->alias = $nation->alias;
	$requirement = $this->m_requirement->getItem($info, 1);

	$info->nation = $nation->name;
	$tip = $this->m_visa_tips->getItem($info);
	
	$post = $this->session->flashdata("embassies_post");
	if ($post) {
		$title		= !empty($post->title) ? $post->title : "";
		$content	= !empty($post->content) ? $post->content : "";
		$fullname	= !empty($post->fullname) ? $post->fullname : "";
		$email		= !empty($post->email) ? $post->email : "";
	} else {
		$title		= "";
		$content	= "";
		$fullname	= "";
		$email		= "";
	}
	
	if (!empty($item)) {
?>
	<div class="embassy-l">
		<h3><?=$item->title?></h3>
		<div class="embassy-ct"><?=$item->content?></div>
		<p>--&gt;</p>
		<? if (!empty($requirement)) {?>
		<p><a href="<?=site_url("visa-requirements/view/".$requirement->citizen)?>"><?=$requirement->title?></a></p>
		<? } ?>
		<? if (!empty($tip)) {?>
		<p><a href="<?=site_url("vietnam-visa-tips/view/".$tip->alias)?>"><?=$tip->title?></a></p>
		<? } ?>
	</div>
<?
	} else {
?>
	<div class="embassy-l">
		<p>At present, there is no information about the Embassy of Vietnam in <?=$nation->name?>. </p>
		<p>- Visit the nearest Vietnam Embassy in the neighboring country to apply for a visa by yourself, or </p>
		<p>- Apply online at <a href="<?=BASE_URL_HTTPS."/visa/apply"?>"><?=SITE_NAME?></a> for a Vietnam visa on arrival (picked up at the arrival airport in Vietnam) </p>
		<p>--&gt;</p>
		<? if (!empty($requirement)) {?>
		<p><a href="<?=site_url("visa-requirements/view/".$requirement->citizen)?>"><?=$requirement->title?></a></p>
		<? } ?>
		<? if (!empty($tip)) {?>
		<p><a href="<?=site_url("vietnam-visa-tips/view/".$tip->alias)?>"><?=$tip->title?></a></p>
		<? } ?>
		<div style="margin-top:20px;">
			<p>If you have any queries or comments, kindly note down in the below form.</p>
			<? if ($this->session->flashdata('embassies_message')) { ?>
				<p class="message"><?=$this->session->flashdata('embassies_message')?></p>
			<? } if ($this->session->flashdata('embassies_error')) { ?>
				<div class="b-error">
					<div class='marker'>Your post contained errors. Please review and correct all field(s) as bellow:</div>
					<ul>
						<? foreach ($this->session->flashdata('embassies_error') as $error) { ?>
						<li style="list-style-type: square; padding-left: 4px; margin-left: 60px"><?=$error?></li>
						<? } ?>
					</ul>
				</div>
			<? } ?>
			<h1 class="title">New Post:</h1>
			<form method="POST" action="<?=site_url("vietnam-embassies/query")?>" id="form1">
				<input type="hidden" name="nation" value="<?=$nation->alias?>" />
				<ul class="listpost">
					<li>Title:<br>
						<input type="text" style="width:100%; " value="<?=$title?>" name="title"><br>
					</li>
					<li>Information:<br>
						<textarea rows="5" cols="20" name="content" style="width:100%;"><?=$content?></textarea><br>
					</li>
					<li>Your Name:<br>
						<input type="text" style="width:100%;" value="<?=$fullname?>" name="fullname"><br>
					</li>
					<li>Your Email:<br>
                    	<input type="text" style="width:100%;" value="<?=$email?>" name="email"><br>
					</li>
					<li>
						<br>
						<input class="button" type="submit" value="Sent Post" name="sbtContact" />
					</li>
				</ul>
			</form>
		</div>
	</div>
<?
	}
?>
	<div class="embassy-r">
		<b>Embassy of Vietnam in other countries</b>
		<div class="embassy-scroll">
		<?
			$char = "A";
			do {
				?>
				<div class="line-embassy">
					<div class="bgnumber"><?=$char?></div>
					<ul class="list-embassy">
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
	</div>
	<div class="clr"></div>
</div>
<div class="clr"></div>