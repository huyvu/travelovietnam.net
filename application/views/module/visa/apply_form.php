<script type="text/javascript" src="<?=JS_URL?>newsticker.js"></script>
<script type="text/javascript">
$(document).ready(function($) {
	$(".application").change(function(){
		calFees();
	});
	$(".type_of_vs").change(function(){
		calFees();
	});
	$(".processing").change(function(){
		calFees();
	});
});
function calFees() {
	var p = {};
    p['group_size']  = $('.application').val();
    p['visa_type']   = $('.type_of_vs').val();
    p['processtime'] = $("input[name='processing']:checked").val();
    $('.total-fee-t').html("...");
	$('.total-fee-t').load("<?=site_url('visa/check-visa-fee')?>", p, function(){});
}
</script>

<div id="visa-search-widget">
	<div class="widget-content">
		<form name="frmApply" method="POST" action="<?=site_url("visa/apply")?>">
			<h1>VIETNAM VISA ONLINE</h1>
			<div class="detail">
				<div class="clearfix text-form">
					<label class="title">Number of Visa:</label>
					<select class="application" name="group_size" id="group_size">
						<option value="1">Only 1 Applicant</option>
						<option value="2">2 Applicants</option>
						<option value="3">3 Applicants</option>
						<option value="4">4 Applicants</option>
						<option value="5">5 Applicants</option>
						<option value="6">6 Applicants</option>
						<option value="7">7 Applicants</option>
						<option value="8">8 Applicants</option>
						<option value="9">9 Applicants</option>
						<option value="10">10 Applicants</option>
						<option value="11">11 Applicants</option>
						<option value="12">12 Applicants</option>
						<option value="13">13 Applicants</option>
						<option value="14">14 Applicants</option>
						<option value="15">15 Applicants</option>
					</select>
				</div>
				<div class="clearfix text-form">
					<label class="title">Type of Visa:</label>
					<select class="type_of_vs" name="visa_type" id="visa_type">
						<option value="1ms">1 month single</option>
						<option value="3ms">3 months single</option>
						<option value="1mm">1 month multiple</option>
						<option value="3mm">3 months multiple</option>
						<option value="3mme">3 months at Embassies or Consulates</option>
					</select>
				</div>
				<div class="clearfix text-form">
					<label class="title">Purpose of Visit:</label>
					<select class="purpose_vs" name="visit_purpose" id="visit_purpose">
						<option value="">Please Select..</option>
						<option value="Vacation">Vacation</option>
						<option value="Business">Business</option>
						<option value="Family/Friend visit">Family/Friend visit</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div class="clearfix text-form">
					<label class="title">Processing Time Option:</label>
					<div>
						<div style="width: 120px" class="left">
							<ul>
								<li><input type="radio" checked="checked" value="Normal" class="processing" id="normal" name="processing"> <label for="normal">Normal</label> <a tooltip="sticky1" href="#" class="red"><b>[?]</b></a></li>
								<li><input type="radio" value="Urgent" class="processing" id="urgent" name="processing"> <label for="urgent">Urgent</label> <a tooltip="sticky2" href="#" class="red"><b>[?]</b></a></li>
								<li><input type="radio" value="Emergency" class="processing" id="emergency" name="processing"> <label for="emergency">Emergency</label> <a tooltip="sticky3" href="#" class="red"><b>[?]</b></a></li>
							</ul>
						</div>
						<div class="right">
							<a title="Click to Verify - This site chose VeriSign SSL for secure for e-commerce and confidential communications." onclick="window.open('https://trustsealinfo.verisign.com/splash?form_file=fdf/splash.fdf&amp;dn=www.travelovietnam.com&amp;lang=en','VeriSign SSL','width=540,height=445,top=50,left=50');" href="javascript:void(0)">
								<img alt="VeriSign SSL" src="<?=IMG_URL?>verisign-seal.png">
							</a>
						</div>
					</div>
					<div class="clr"></div>
				</div>
				<div class="clearfix total-fee">
					<div class="left">
						<label>TOTAL SERVICE FEE:</label>
					</div>
					<div class="right">
						<label class="total-fee-t">20 USD</label>
					</div>
				</div>
				<div class="clearfix button-bar center">
					<input type="submit" value="SECURED APPLY" name="submitbtn" class="applynow">
				</div>
				<div class="clr"></div>
			</div>
			<div class="clearfix">
				<div class="signature">
					www.travelovietnam.com
				</div>
			</div>
		</form>
	</div>
</div>

<div id="stickytooltip" class="stickytooltip">
	<div id="sticky1" class="none">Your visa is processed from 24-48 hours.</div>
	<div id="sticky2" class="none">Your visa is processed from 4-8 hours, and plus 20 USD/person.</div>
	<div id="sticky3" class="none">Your visa is process from 30 mins to 4 hours, depend on how rush you need. Don't forget to call us to get confirmed.</div>
</div>
<script type="text/javascript" src="<?=JS_URL?>stickytooltip.js"></script>
<script>
	stickytooltip.init("*[tooltip]", "stickytooltip");
</script>