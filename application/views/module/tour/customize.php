<?
	$tour_customize_result = $this->session->flashdata('tour_customize_result');
	if (!empty($tour_customize_result)) {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			msgbox("<?=$tour_customize_result->message?>", "<?=$tour_customize_result->title?>");
		});
	</script>
<?
	}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#inquiry-button").click(function() {
			var err = 0;
			
			if ($("#planning-description").val() == "") {
				$("#planning-description").addClass("error");
				err++;
			} else {
				$("#planning-description").removeClass("error");
			}
			if ($("#planning-name").val() == "") {
				$("#planning-name").addClass("error");
				err++;
			} else {
				$("#planning-name").removeClass("error");
			}
			if ($("#planning-email").val() == "" || !isEmail($("#planning-email").val())) {
				$("#planning-email").addClass("error");
				err++;
			} else {
				$("#planning-email").removeClass("error");
			}
			if ($("#planning-phone").val() == "") {
				$("#planning-phone").addClass("error");
				err++;
			} else {
				$("#planning-phone").removeClass("error");
			}

			if ($("#planning-code").val() == "" || $("#planning-code").val().toUpperCase() != $(".security-code").html().toUpperCase()) {
				$("#planning-code").addClass("error");
				err++;
			} else {
				$("#planning-code").removeClass("error");
			}
			
			if (err == 0) {
				return true;
			}
			else {
				msgbox("Please fill-in all required fields are marked in red before submiting your message! Please try again.");
				return false;
			}
		});
	});
</script>
<div id="tour-view-planning">
	<form id="" name="" action="<?=site_url("tours/customize")?>" method="POST">
		<div class="widget-title">
			PLAN YOUR TRIP?
			<div class="widget-subtitle">Let us help you!</div>
		</div>
		<div class="widget-content">
			<div class="input">
				<textarea rows="" cols="" id="planning-description" name="planning-description" class="planning-description" placeholder="It is simple and free. Just tell us what you want to do and where to go, whatever about your group and we will get back to you with the itinerary, best offers..."></textarea>
			</div>
			<div class="input">
				<input type="text" id="planning-name" name="planning-name" class="planning-name" placeholder="Name">
			</div>
			<div class="input">
				<input type="text" id="planning-email" name="planning-email" class="planning-email" placeholder="Email">
			</div>
			<div class="input">
				<input type="text" id="planning-phone" name="planning-phone" class="planning-phone" placeholder="Phone">
			</div>
			<div class="input">
				<input type="text" id="planning-code" name="planning-code" class="planning-code" placeholder="Capcha" style="width: 60px;"> <label class="security-code planning-sercurity-code"><?=$this->util->createSecurityCode()?></label>
			</div>
			<div class="widget-button-bar">
				<input type="submit" id="inquiry-button" name="inquiry-button" class="inquiry-button" value="INQUIRY NOW">
			</div>
		</div>
		<input type="hidden" id="request-uri" name="request-uri" value="<?=current_url()?>">
	</form>
</div>