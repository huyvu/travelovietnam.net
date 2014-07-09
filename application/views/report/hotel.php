<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>site.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#report-submit-btn").click(function(){
				if ($("#security-code").val() == "" || $("#security-code").val() != $(".security-code").html()) {
					$("#security-code").addClass("error");
				} else {
					$("#frmReport").submit();
				}
			});
		});
	</script>
</head>
<body style="background: none">
	<div id="popup-map-container">
		<h1><?=$item->name?></h1>
		<p class="desc">
			<strong>Please give us feedback about this hotel description</strong>
		</p>
		<p>
			Spotted something wrong? Something we missed? Here is where you can tell us.
		</p>
		<form id="frmReport" name="frmReport" action="<?=site_url("report/hotel/".$item->alias)?>" method="POST">
			<div id="report-header">
				I'd like to comment about the: (fill out all that apply)
			</div>
			<div id="report-container">
				<div class="report-form">
					<table class="tbl-report" cellpadding="4" cellspacing="0" border="0">
						<tr>
							<td>Hotel description</td><td>:</td>
							<td><input type="text" id="description" name="description" /></td>
						</tr>
						<tr>
							<td>Photos</td><td>:</td>
							<td><input type="text" id="photos" name="photos" /></td>
						</tr>
						<tr>
							<td>Maps</td><td>:</td>
							<td><input type="text" id="maps" name="maps" /></td>
						</tr>
						<tr>
							<td width="200px">Anything else?<br/>We welcome all feedback</td><td>:</td>
							<td><textarea rows="" cols="" id="message" name="message"></textarea></td>
						</tr>
						<tr>
							<td>Captcha<span class="required">*</span></td><td>:</td>
							<td><input type="text" id="security-code" name="security-code" style="width: 60px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>
								<input type="button" id="report-submit-btn" name="report-btn" class="report-btn" value="Submit" />
							</td>
						</tr>
					</table>
				</div>
			</div>
			<input type="hidden" name="alias" value="<?=$item->alias?>">
			<input type="hidden" name="item_name" value="<?=$item->name?>">
		</form>
		<div class="clr"></div>
	</div>
</body>
</html>