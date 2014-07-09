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
			<img alt="" src="<?=IMG_URL?>arrow.png"> Check Visa Requirements
			<? require_once(APPPATH."views/module/social.php"); ?>
		</div>
	</div>
	<div id="check-requirement">
		<div class="content">
			<form method="POST" action="<?=site_url("visa/requirements")?>" id="frmCheckRequirement">
				<h3>CHECK IF YOU NEED A VISA TO VIETNAM</h3>
				<select class="select-nation" id="citizen" name="citizen">
					<option value="">Select your country</option>
					<? foreach($nations as $n) {
						echo "<option value='{$n->alias}'>{$n->name}</option>";
					} ?>
				</select>
				<script> setValueHTML('citizen', '<?=$citizen?>'); </script>
				<input type="submit" value="CHECK REQUIREMENT" class="red-btn">
			</form>
		</div>
	</div>
	<? 
		if (!empty($item)) {
	?>
			<div class="requirement_detail">
				<h3><?=$item->title?></h3>
				<p><?=$item->content?></p>
			</div>
	<?
		}
	?>
</div>
<div class="clr"></div>
