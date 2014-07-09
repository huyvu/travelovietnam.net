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
			<img alt="" src="<?=IMG_URL?>arrow.png">
			<a class="pathway" title="Visa Tips" href="<?=site_url("visa/tips")?>">Visa Tips</a>
			<img alt="" src="<?=IMG_URL?>arrow.png"> <?=$item->title?>
			<? require_once(APPPATH."views/module/social.php"); ?>
		</div>
		<h1 class="headtitle">Vietnam Visa Tips</h1>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="100%" valign="top">
					<h1 class="main_title"><?=$item->title?></h1>
					<div id="view_body">
						<?=$item->content?>
						<div class="applyvisanow">
							<a class="red-button" href="<?=BASE_URL_HTTPS."/visa/apply"?>">APPLY VISA NOW >></a>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="clr"></div>