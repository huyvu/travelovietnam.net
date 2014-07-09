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
			<img alt="" src="<?=IMG_URL?>arrow.png"> Ask &amp; Answer
			<? require_once(APPPATH."views/module/social.php"); ?>
		</div>
		<h1 class="headtitle">Ask &amp; Answer</h1>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td width="100%" valign="top">
					<div id="customerquestion">
						<div class="content">
							<form id="frmQuestion" action="<?=site_url("answers")?>" method="POST">
								<h2>Hello! How can I help you now ?</h2>
								<input type="text" id="term" name="term" class="text" title="Search Questions" value="<?=(!empty($_POST["term"]) ? $_POST["term"] : "")?>" />
								<input type="submit" class="red-btn" value="SEARCH">
								<a href="<?=site_url("ask")?>" title="Ask a new question "><input type="button" class="red-btn" value="Ask a new question"></a>
							</form>
						</div>
					</div>
					<!-- contact form -->
					<!-- end contact form -->
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="clr"></div>
