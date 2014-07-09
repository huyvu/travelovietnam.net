<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url()?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Survey
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title">Service Survey of TraveloVietnam.com</h1>
	<div style="margin-top: 10px">
		<div class="left" style="width: 680px">
			<div id="tour-booking-condition">
				<div class="content">
					<div id="survey-thanks">
						<p>
							Thank you for taking our survey !
						</p>
						<p>
							Your response is very important to us. We want to thank you for sharing your opinions about our service by an small gift, please also recheck your mail to get it! 
						</p>
						<p>
							If you have any additional questions or comments, please contact our support team via <a style="font-size:12px" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> or hotline <?=HOTLINE?>
						</p>
						<p>Best regards,</p>
						<p><b>TraveloVietnam Team</b></p>
					</div><!--/#survey-thanks -->
				</div>
			</div>
		</div>
		<div class="right">
			<? require_once(APPPATH."views/module/tour/search_widget.php"); ?>
			<? require_once(APPPATH."views/module/tour/customize.php"); ?>
			<div id="tour-view-shortlist-loader"></div>
		</div>
		<div class="clr"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
	});
</script>