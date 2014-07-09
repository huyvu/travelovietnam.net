<script type="text/javascript" src="<?=JS_URL?>apply.visa.step1.js"></script>
<script type="text/javascript" src="<?=JS_URL?>stickytooltip.js"></script>

<div id="view-container">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Visa" href="<?=site_url("visa")?>">Visa</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Apply Visa Online - Applicant Detail
	</div>
	<div class="tab-step">
		<h1 class="note">Vietnam Visa Application Form</h1>
		<ul class="style-step">
			<li class="active"><font class="number">1.</font> Applicant Detail</li>
			<li><font class="number">2.</font> Review &amp; Payment</li>
		</ul>
	</div>
	<div class="clr"></div>
	<? if ($step1->entry_page == "rush-visa") { ?>
	<div class="rush-info">
	    <p>We provide "the Emergency Vietnam visa service" for those who would like to get visa right away, because some reasons out of your control.</p>
		<p>This problem usually happens to those who need to enter Vietnam in urgent but do not have time or forget to apply in advance.</p>
		<p>These information below will help you better to understand how rush for you to apply Vietnam visa services and how to choose on Emergency case.</p>
		<ul style="list-style-type: decimal; margin-left: 40px; line-height: 1.5em">
			<li style="margin-bottom: 8px;"><strong>Urgent Vietnam visa</strong>: This case for those who would like to get Vietnam visa in a few hours (4-8 hours).</li>
			<li style="margin-bottom: 8px;"><strong>Emergency Vietnam visa</strong>: This service takes you <b>maximum from 30 minutes to 4 hours</b>.</li>
			<li style="margin-bottom: 8px;"><strong>Penalty Vietnam visa service</strong>: for those who would like to arrive Vietnam on Saturday, Sunday, or public holiday. But forgotten to apply visa in advance.<br/>Please <a href="<?=site_url("contact")?>">contact us</a> if you are on this case. However, You will be charged you 200 USD/person in this case for single entry visa Vietnam. We can make this visa in 30 minutes and we have staff at the airport who will take care all procedures for you when you arrive.</li>
		</ul>
	</div>
	<br/>
	<p>We are always beside you for any cases. Please fill the form bellow for application Vietnam visa:</p>
	<br/>
	<? } ?>
	<?
		$iserror = ($this->session->flashdata('error')) ? true : false;
	?>
	<div id="error" class="b-error <?=(($iserror || $nationalityConfirm)?"":"none")?>">
		<? if ($iserror) {
			echo "<div class='marker'>".$this->session->flashdata('error')."</div>";
		} ?>
		<? if ($nationalityConfirm) { ?>
			<p>Because of your nationality is on special list of Vietnam Immigration, so we CAN process this visa for you but you have to pay us <?=$this->util->calIndianFee($step1->visa_type)?> USD/person for this case. If you agree, please click Next ! (if you need multiple entries, you will be required for invitation letter from Vietnam).</p>
			<a href="<?=BASE_URL_HTTPS."/visa/do-confirm-nationality"?>" class="red-btn">NEXT >></a>
		<? } ?>
	</div>
	<div class="detailvisa">
		<form id="frmApply" action="<?=BASE_URL_HTTPS."/visa/step2"?>" method="POST">
			<div class="colleft">
				<div class="group">
					<h2>VISA OPTIONS</h2>
					<div class="group_content">
						<table style="margin-left: 50px">
							<tr>
								<td style="width:200px;">
									<label>Number of Visa<span class="required">*</span></label>
								</td>
								<td>
									<select id="group_size" name="group_size" class="application change_price">
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
									<script> setValueHTML('group_size', '<?=$step1->group_size?>'); </script>
								</td>
							</tr>
							<tr>
								<td>
									<label>Type of Visa<span class="required">*</span></label>
								</td>
								<td>
									<select id="visa_type" name="visa_type" class="type_of_vs change_price">
										<option value="1ms">Vietnam Visa on Arrival - 1 month single</option>
										<option value="3ms">Vietnam Visa on Arrival - 3 months single</option>
										<option value="1mm">Vietnam Visa on Arrival - 1 month multiple</option>
										<option value="3mm">Vietnam Visa on Arrival - 3 months multiple</option>
										<option value="3mme">3 months at Embassies or Consulates</option>
									</select>
									<script> setValueHTML('visa_type', '<?=$step1->visa_type?>'); </script>
								</td>
							</tr>
							<tr class="visa_at_embassies none">
								<td><label>Embassies/Consulates Location<span class="required">*</span></label></td>
								<td>
									<input type="text" id="embassies" name="embassies" class="embassies" value="<?=$step1->embassies?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label>Purpose of Visit<span class="required">*</span></label>
								</td>
								<td>
									<select id="visit_purpose" name="visit_purpose" class="purpose_vs">
										<option value="">Please Select..</option>
										<option value="Vacation">Vacation</option>
										<option value="Business">Business</option>
										<option value="Family/Friend visit">Family/Friend visit</option>
										<option value="Other">Other</option>
									</select>
									<script> setValueHTML('visit_purpose', '<?=$step1->visit_purpose?>'); </script>
								</td>
							</tr>
							<tr>
								<td>
									<label>Arrival Port<span class="required">*</span></label>
								</td>
								<td>
									<select id="arrival_port" name="arrival_port" class="arrival_port">
										<option value="" selected="selected">Please Select..</option>
										<option value="Ha Noi">Ha Noi (Noi Bai)</option>
										<option value="Ho Chi Minh">Ho Chi Minh - Sai Gon (Tan Son Nhat)</option>
										<option value="Da Nang">Da Nang (Da Nang)</option>
									</select>
									<script> setValueHTML('arrival_port', '<?=$step1->arrival_port?>'); </script>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label>Processing Time ?</label>
								</td>
								<td style="text-align: left;" id="processtime_options">
								<? if ($step1->entry_page == "rush-visa") { ?>
									<div>
										<input id="processtime_special" class="processing_c change_price_click" type="radio" name="processtime" value="Emergency" checked="checked"/>
										<label for="processtime_special">Emergency (Within 30 minutes)</label>
										<a class="i-help" href="#" tooltip="sticky3">[?]</a>
									</div>
								<? } else { ?>
									<div>
										<input id="processtime_normal" class="processing_c change_price_click" type="radio" name="processtime" value="Normal" <?=($step1->processing_time=="Normal"?"checked='checked'":"")?>/>
										<label for="processtime_normal"> Normal (Guaranteed 2 working days)</label>
										<a class="i-help" href="#" tooltip="sticky1">[?]</a>
									</div>
									<div style="margin-top: 5px">
										<input id="processtime_urgent" class="processing_c change_price_click" type="radio" name="processtime" value="Urgent" <?=($step1->processing_time=="Urgent"?"checked='checked'":"")?>/>
										<label for="processtime_urgent">Urgent (Guaranteed 4-8 hours)</label>
										<a class="i-help" href="#" tooltip="sticky2">[?]</a>
									</div>
									<div style="margin-top: 5px">
										<input id="processtime_special" class="processing_c change_price_click" type="radio" name="processtime" value="Emergency" <?=($step1->processing_time=="Emergency"?"checked='checked'":"")?>/>
										<label for="processtime_special">Emergency (Within 30 minutes)</label>
										<a class="i-help" href="#" tooltip="sticky3">[?]</a>
									</div>
								<? } ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="group">
					<h2>PASSPORT INFORMATION</h2>
					<div class="group_content">
					<table class="tbapplicant">
						<tr>
							<th>No</th>
							<th><label>Full Name<span>*</span></label></th>
							<th><label>Gender<span>*</span></label></th>
							<th><label>Date of Birth<span>*</span></label></th>
							<th><label>Nationality<span>*</span></label></th>
							<th><label>Passport Number<span>*</span></label></th>
						</tr>
						<?
						for ($cnt=1; $cnt<=$step1->group_size; $cnt++) {
						?>
							<tr class="applicant_<?=$cnt?>">
								<td class="center applicantnumber_<?=$cnt?>"><?=$cnt?></td>
								<td>
									<input style="width: 100px" type="text" id="fullname_<?=$cnt?>" name="fullname_<?=$cnt?>" class="fullname_<?=$cnt?>" value="<?=$step1->fullname[$cnt]?>" />
								</td>
								<td>
									<select id="gender_<?=$cnt?>" name="gender_<?=$cnt?>" class="gender_<?=$cnt?>" style="width: 75px">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
									<script> setValueHTML('gender_<?=$cnt?>', '<?=$step1->gender[$cnt]?>'); </script>
								</td>
								<td>
									<select id="birthmonth_<?=$cnt?>" name="birthmonth_<?=$cnt?>" class="birthmonth_<?=$cnt?>" style="width: 60px">
										<option value="">--</option>
										<option value="1">Jan</option>
										<option value="2">Feb</option>
										<option value="3">Mar</option>
										<option value="4">Apr</option>
										<option value="5">May</option>
										<option value="6">Jun</option>
										<option value="7">Jul</option>
										<option value="8">Aug</option>
										<option value="9">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>
									<script> setValueHTML('birthmonth_<?=$cnt?>', '<?=$step1->birthmonth[$cnt]?>'); </script>
									
									<select id="birthdate_<?=$cnt?>" name="birthdate_<?=$cnt?>" class="birthdate_<?=$cnt?>" style="width: 50px; margin-left: 3px;">
										<option value="">--</option>
										<?
											for ($i=1; $i<=31; $i++) {
												echo "<option value='{$i}'>{$i}</option>";
											}
										?>
									</select>
									<script> setValueHTML('birthdate_<?=$cnt?>', '<?=$step1->birthdate[$cnt]?>'); </script>
									
									<select id="birthyear_<?=$cnt?>" name="birthyear_<?=$cnt?>" class="birthyear_<?=$cnt?>" style="width: 60px; margin-left: 3px;">
										<option value="">----</option>
										<?
											for ($i=1910; $i<=date("Y"); $i++) {
												echo "<option value='{$i}'>{$i}</option>";
											}
										?>
									</select>
									<script> setValueHTML('birthyear_<?=$cnt?>', '<?=$step1->birthyear[$cnt]?>'); </script>
								</td>
								<td>
									<select id="nationality_<?=$cnt?>" name="nationality_<?=$cnt?>" class="nationality_<?=$cnt?>" style="width: 100px">
										<option value="" selected="selected">Select...</option>
										<option value="United Kingdom">United Kingdom</option>
										<option value="United States">United States</option>
										<option value="Albania">Albania</option>
										<option value="Andorra">Andorra</option>
										<option value="American Samoa">American Samoa</option>
										<option value="Armenia">Armenia</option>
										<option value="Argentina">Argentina</option>
										<option value="Austria">Austria</option>
										<option value="Australia">Australia</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Barbados">Barbados</option>
										<option value="Belarus">Belarus</option>
										<option value="Belgium">Belgium</option>
										<option value="Belize">Belize</option>
										<option value="Bermuda">Bermuda</option>
										<option value="Bolivia">Bolivia</option>
										<option value="Bosnia&amp; Herzegonia">Bosnia&amp; Herzegonia</option>
										<option value="Bouvet">Bouvet</option>
										<option value="Brazil">Brazil</option>
										<option value="Brunei Darussalam">Brunei Darussalam</option>
										<option value="Bulgaria">Bulgaria</option>
										<option value="Cambodia">Cambodia</option>
										<option value="Canada">Canada</option>
										<option value="Cayman Islands">Cayman Islands</option>
										<option value="Central African">Central African</option>
										<option value="Chile">Chile</option>
										<option value="China">China</option>
										<option value="Colombia">Colombia</option>
										<option value="Cook Islands">Cook Islands</option>
										<option value="CostaRica">CostaRica</option>
										<option value="Croatia">Croatia</option>
										<option value="Cuba">Cuba</option>
										<option value="Cyprus">Cyprus</option>
										<option value="Czech">Czech</option>
										<option value="Denmark">Denmark</option>
										<option value="Dominica">Dominica</option>
										<option value="Dominican">Dominican</option>
										<option value="EastTimor">EastTimor</option>
										<option value="Ecuador">Ecuador</option>
										<option value="ElSalvador">ElSalvador</option>
										<option value="England">England</option>
										<option value="Estonia">Estonia</option>
										<option value="Falkland">Falkland</option>
										<option value="Faroe">Faroe</option>
										<option value="Fiji">Fiji</option>
										<option value="Finland">Finland</option>
										<option value="France">France</option>
										<option value="Georgia">Georgia</option>
										<option value="Germany">Germany</option>
										<option value="Gibraltar">Gibraltar</option>
										<option value="Great Britain">Great Britain</option>
										<option value="Greece">Greece</option>
										<option value="Greenland">Greenland</option>
										<option value="Grenada">Grenada</option>
										<option value="Guadeloupe">Guadeloupe</option>
										<option value="Guam">Guam</option>
										<option value="Guatemela">Guatemela</option>
										<option value="Guernsey">Guernsey</option>
										<option value="Guyana">Guyana</option>
										<option value="Honduras">Honduras</option>
										<option value="HongKong">HongKong</option>
										<option value="Hungary">Hungary</option>
										<option value="Iceland">Iceland</option>
										<option value="India" id="india">India</option>
										<option value="Indonesia">Indonesia</option>
										<option value="Ireland">Ireland</option>
										<option value="Israel">Israel</option>
										<option value="Italy">Italy</option>
										<option value="Jamaica">Jamaica</option>
										<option value="Japan">Japan</option>
										<option value="Jersey">Jersey</option>
										<option value="Kazakhstan">Kazakhstan</option>
										<option value="Kiribati">Kiribati</option>
										<option value="South Korea">South Korea</option>
										<option value="North Korea">North Korea</option>
										<option value="Kyrgyzstan">Kyrgyzstan</option>
										<option value="Laos">Laos</option>
										<option value="Latvia">Latvia</option>
										<option value="Liechtenstein">Liechtenstein</option>
										<option value="Lithuania">Lithuania</option>
										<option value="Luxembourg">Luxembourg</option>
										<option value="Macau">Macau</option>
										<option value="Macedonia">Macedonia</option>
										<option value="Malaysia">Malaysia</option>
										<option value="Malta">Malta</option>
										<option value="Maldives">Maldives</option>
										<option value="Mariana">Mariana</option>
										<option value="Marshall">Marshall</option>
										<option value="Martinique">Martinique</option>
										<option value="Mauritius">Mauritius</option>
										<option value="Mexico">Mexico</option>
										<option value="Micronesia">Micronesia</option>
										<option value="Moldova">Moldova</option>
										<option value="Monaco">Monaco</option>
										<option value="Mongolia">Mongolia</option>
										<option value="Montenegro">Montenegro</option>
										<option value="Montserrat">Montserrat</option>
										<option value="Myanmar">Myanmar</option>
										<option value="Nauru">Nauru</option>
										<option value="Nepal">Nepal</option>
										<option value="Netherlands">Netherlands</option>
										<option value="Netherland Antilles">Netherland Antilles</option>
										<option value="Neutral Zone">Neutral Zone</option>
										<option value="New Caledonia">New Caledonia</option>
										<option value="NewZealand">NewZealand</option>
										<option value="Nicaragua">Nicaragua</option>
										<option value="Niue">Niue</option>
										<option value="Norfolk Island">Norfolk Island</option>
										<option value="Northern Ireland">Northern Ireland</option>
										<option value="Norway">Norway</option>
										<option value="Palau">Palau</option>
										<option value="Panama">Panama</option>
										<option value="Papua New Guinea">Papua New Guinea</option>
										<option value="Paraguay">Paraguay</option>
										<option value="Peru">Peru</option>
										<option value="Philippines">Philippines</option>
										<option value="Pitcairn">Pitcairn</option>
										<option value="Poland">Poland</option>
										<option value="Polynesia">Polynesia</option>
										<option value="Portugal">Portugal</option>
										<option value="Puerto Rico">Puerto Rico</option>
										<option value="Romania">Romania</option>
										<option value="Russian">Russian</option>
										<option value="Saint Helena">Saint Helena</option>
										<option value="Saint Kitts">Saint Kitts</option>
										<option value="Saint Lucia">Saint Lucia</option>
										<option value="Saint Pierre">Saint Pierre</option>
										<option value="Saint Vincent">Saint Vincent</option>
										<option value="Samoa">Samoa</option>
										<option value="San Marino">San Marino</option>
										<option value="Scotland">Scotland</option>
										<option value="Serbia">Serbia</option>
										<option value="Singapore">Singapore</option>
										<option value="Slovakia">Slovakia</option>
										<option value="Slovenia">Slovenia</option>
										<option value="Solomon">Solomon</option>
										<option value="South Africa">South Africa</option>
										<option value="South Georgia">South Georgia</option>
										<option value="Spain">Spain</option>
										<option value="Suriname">Suriname</option>
										<option value="Svalbard">Svalbard</option>
										<option value="Swaziland">Swaziland</option>
										<option value="Sweden">Sweden</option>
										<option value="Switzerland">Switzerland</option>
										<option value="Taiwan">Taiwan</option>
										<option value="Tajikista">Tajikista</option>
										<option value="Thailand">Thailand</option>
										<option value="Tokelau">Tokelau</option>
										<option value="Timor Leste">Timor Leste</option>
										<option value="Tonga">Tonga</option>
										<option value="Trinidad and Tobago">Trinidad and Tobago</option>
										<option value="Turkmenistan">Turkmenistan</option>
										<option value="Turksand Caicos">Turksand Caicos</option>
										<option value="Tuvalu">Tuvalu</option>
										<option value="Ukraine">Ukraine</option>
										<option value="UAE">UAE</option>
										<option value="Uruguay">Uruguay</option>
										<option value="Uzbekistan">Uzbekistan</option>
										<option value="Vanuatu">Vanuatu</option>
										<option value="Vatican">Vatican</option>
										<option value="Venezuela">Venezuela</option>
										<option value="Vietnam">Vietnam</option>
										<option value="Virgin">Virgin</option>
										<option value="Wales">Wales</option>
										<option value="Western Sahara">Western Sahara</option>
										<option value="Western Samoa">Western Samoa</option>
										<option value="Yugoslavia">Yugoslavia</option>
									</select>
									<script> setValueHTML('nationality_<?=$cnt?>', '<?=$step1->nationality[$cnt]?>'); </script>
								</td>
								<td class="last">
									<input style="width: 80px" type="text" id="passportnumber_<?=$cnt?>" name="passportnumber_<?=$cnt?>" class="passportnumber_<?=$cnt?>" value="<?=$step1->passportnumber[$cnt]?>" />
								</td>
							</tr>
						<?
						}
						?>
						</table>
					</div>
				</div>
				<div class="group">
					<h2>WHEN YOU ARRIVE ?</h2>
					<div class="group_content">
						<table>
							<tr>
								<td align="right" style="width:120px;">
									<label>Date of Arrival<span>*</span></label>
								</td>
								<td style="width:6px;">:</td>
								<td>
									<select id="arrivalmonth" name="arrivalmonth" class="arrivalmonth" style="width: 90px">
										<option value="">Month...</option>
										<option value="1">January</option>
										<option value="2">Feburary</option>
										<option value="3">March</option>
										<option value="4">April</option>
										<option value="5">May</option>
										<option value="6">Jun</option>
										<option value="7">July</option>
										<option value="8">August</option>
										<option value="9">September</option>
										<option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
									<script> setValueHTML('arrivalmonth', '<?=$step1->arrivalmonth?>'); </script>
									
									<select id="arrivaldate" name="arrivaldate" class="arrivaldate" style="width: 70px; margin-left: 3px;">
										<option value="">Day...</option>
										<?
											for ($i=1; $i<=31; $i++) {
												echo "<option value='{$i}'>{$i}</option>";
											}
										?>
									</select>
									<script> setValueHTML('arrivaldate', '<?=$step1->arrivaldate?>'); </script>
									
									<select id="arrivalyear" name="arrivalyear" class="arrivalyear" style="width: 75px; margin-left: 3px;">
										<option value="">Year...</option>
										<?
											for ($i=date("Y"); $i<=date("Y")+2; $i++) {
												echo "<option value='{$i}'>{$i}</option>";
											}
										?>
									</select>
									<script> setValueHTML('arrivalyear', '<?=$step1->arrivalyear?>'); </script>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label>Date of Exit<span>*</span></label>
								</td>
								<td>:</td>
								<td>
									<select id="exitmonth" name="exitmonth" class="exitmonth" style="width: 90px">
										<option value="">Month...</option>
										<option value="1">January</option>
										<option value="2">Feburary</option>
										<option value="3">March</option>
										<option value="4">April</option>
										<option value="5">May</option>
										<option value="6">Jun</option>
										<option value="7">July</option>
										<option value="8">August</option>
										<option value="9">September</option>
										<option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
									<script> setValueHTML('exitmonth', '<?=$step1->exitmonth?>'); </script>
									
									<select id="exitdate" name="exitdate" class="exitdate" style="width: 70px; margin-left: 3px;">
										<option value="">Day...</option>
										<?
											for ($i=1; $i<=31; $i++) {
												echo "<option value='{$i}'>{$i}</option>";
											}
										?>
									</select>
									<script> setValueHTML('exitdate', '<?=$step1->exitdate?>'); </script>
									
									<select id="exityear" name="exityear" class="exityear" style="width: 75px; margin-left: 3px;">
										<option value="">Year...</option>
										<?
											for ($i=date("Y"); $i<=date("Y")+2; $i++) {
												echo "<option value='{$i}'>{$i}</option>";
											}
										?>
									</select>
									<script> setValueHTML('exityear', '<?=$step1->exityear?>'); </script>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<input type="hidden" id="task" name="task" value=""/>
				<div class="screen-overlay" id="emergencyOverlay" style="display:none"></div>
				<div id="paneEmergency" class="dialog" style="display:none">
					<table width="100%" cellpadding="4" cellspacing="4" border="0">
						<tr valign="top">
							<td class="cell-spacing">&nbsp;</td>
							<td class="cell-center">
								<div class="pane-view">
									<div class="block_r">
								        <div class="needhelp">Emergency Case !!!</div>
								        <p style="padding: 10px 0px">Sorry for this case put you to the Emergency. If you agree, you will be charged 50USD/person for processing service, and you get visa in 30 minutes after submit OR you must change the arrival date.</p>
										<table width="100%" cellpadding="4" cellspacing="4" border="0">
											<tr valign="top">
												<td width="100px">Flight Number *</td>
												<td>:</td>
												<td><input id="flightnumber2" name="flightnumber2"/></td>
											</tr>
											<tr valign="top">
												<td width="100px">Arrival Time *</td>
												<td>:</td>
												<td><input id="arrivaltime2" name="arrivaltime2"/><br/>(ie. 08:30 PM)</td>
											</tr>
											<tr valign="top">
												<td></td>
												<td></td>
												<td align="right">
													<button class="button" type="button" onclick="checkEmergencyForm()">I Agree</button>
													<button class="button" type="button" onclick="hideEmergencyAlert()">Cancel</button>
												</td>
											</tr>
										</table>
								    </div>
								</div>
							</td>
							<td class="cell-spacing">&nbsp;</td>
						</tr>
					</table>
				</div>
				<div class="group">
					<h2>NEEDING EXTRA SERVICES ?</h2>
					<div class="group_content">
						<table>
							<tr>
								<td align="right" style="width:120px;">
									<label>Airport fast track</label>
								</td>
								<td style="width:6px;">:</td>
								<td>
									<input type="radio" id="airport_fast_checkin_yes" name="airport_fast_checkin" class="airport_fast_checkin" value="1" <?=($step1->airport_fast_checkin==1?"checked='checked'":"")?>/> <label for="airport_fast_checkin_yes">Yes</label>
									<input type="radio" id="airport_fast_checkin_no" name="airport_fast_checkin" class="airport_fast_checkin" value="0" <?=($step1->airport_fast_checkin!=1?"checked='checked'":"")?>/> <label for="airport_fast_checkin_no">No</label> <a class="i-help" href="#" tooltip="sticky4">[?]</a>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label>VIP airport fast track</label>
								</td>
								<td>:</td>
								<td>
									<input type="radio" id="vip_fast_checkin_yes" name="vip_fast_checkin" class="vip_fast_checkin" value="2" <?=($step1->airport_fast_checkin==2?"checked='checked'":"")?>/> <label for="vip_fast_checkin_yes">Yes</label>
									<input type="radio" id="vip_fast_checkin_no" name="vip_fast_checkin" class="vip_fast_checkin" value="0" <?=($step1->airport_fast_checkin!=2?"checked='checked'":"")?>/> <label for="vip_fast_checkin_no">No</label> <a class="i-help" href="#" tooltip="sticky4">[?]</a>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label>Car pick up</label>
								</td>
								<td>:</td>
								<td>
									<input type="radio" id="car_pickup_yes" name="car_pickup" class="car_pickup" value="1" <?=($step1->car_pickup==1?"checked='checked'":"")?>/> <label for="car_pickup_yes">Yes</label>
									<input type="radio" id="car_pickup_no" name="car_pickup" class="car_pickup" value="0" <?=($step1->car_pickup!=1?"checked='checked'":"")?>/> <label for="car_pickup_no">No</label> <a class="i-help" href="#" tooltip="sticky5">[?]</a>
									<div class="car-select" id="car-select" style="<?=($step1->car_pickup==1?"display: none;":"")?> margin-top: 5px;">
										<label for="num_seat" style="padding: 6px; line-height: 2em">Seats</label>
										<select class="num_seat" name="num_seat" id="num_seat" style="width: 80px; float: right">
											<option value="4" selected="selected">4 seats</option>
											<option value="7">7 seats</option>
											<option value="16">16 seats</option>
											<option value="24">24 seats</option>
										</select>
										<script> setValueHTML('num_seat', '<?=$step1->num_seat?>'); </script>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="group" id="flightinfo">
					<h2>FLIGHT INFORMATION <span class="required">Optional but *required for: Emergency processing, Airport fast track and VIP fast track services</span></h2>
					<div class="group_content">
						<table>
							<tr>
								<td align="right" style="width:120px;">
									<label>Flight Number</label>
								</td>
								<td style="width:6px;">:</td>
								<td>
									<input type="text" id="flightnumber" name="flightnumber" class="flightnumber" value="<?=$step1->flightnumber?>" style="width: 100px"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label>Arrival Time</label>
								</td>
								<td>:</td>
								<td>
									<input type="text" id="arrivaltime" name="arrivaltime" class="arrivaltime" value="<?=$step1->arrivaltime?>" style="width: 100px"/> (ie. 08:30 PM)
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="group">
					<h2>CONTACT INFORMATION</h2>
					<div class="group_content">
						<table>
							<tr>
								<td align="right" style="width:120px;">
									<label>Your Email<span>*</span></label>
								</td>
								<td style="width:6px;">:</td>
								<td>
									<input type="text" id="contact_email" name="contact_email" value="<?=$step1->contact_email?>">
								</td>
							</tr>
							<tr>
								<td align="right" style="width:120px;">
									<label>Re-type Your Email<span>*</span></label>
								</td>
								<td>:</td>
								<td>
									<input type="text" id="confirm_contact_email" name="contact_email" value="<?=$step1->contact_email?>" autocomplete="off" onpaste="alert('You cannot directly copy and paste.'); this.value=''; return false;">
								</td>
							</tr>
							<tr>
								<td align="right">
									<label>Secondary Email</label>
								</td>
								<td>:</td>
								<td>
									<input type="text" id="contact_email2" name="contact_email2" value="<?=$step1->contact_email2?>">
								</td>
							</tr>
							<tr valign="top">
								<td align="right">
									<label>Special Request</label>
									<a href="#" tooltip="sticky1">[?]</a>
								</td>
								<td>:</td>
								<td>
									<textarea id="comment" name="comment"><?=$step1->comment?></textarea>
								</td>
							</tr>
							<tr valign="top">
								<td colspan="2"></td>
								<td>
									<div>
										<input type="checkbox" id="information_confirm" name="information_confirm" checked="checked"><label for="information_confirm">I would like to confirm the above information is correct.</label>
									</div>
									<div style="margin-top: 8px">
										<input type="checkbox" id="terms_conditions_confirm" name="terms_conditions_confirm" checked="checked"><label for="terms_conditions_confirm">I have read and agreed <a target="_blank" href="<?=site_url("terms-and-conditions")?>">Terms and Condition</a>.</label>
									</div>
								</td>
							</tr>
							<tr valign="top">
								<td colspan="2"></td>
								<td>
									<div class="">
										<input class="red-btn btn_next" type="submit" value="NEXT >>" />
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="colright">
				<div class="feepanel">
					<div class="arrow"></div>
					<ul>
						<li>
							<label>Number of Visa:</label>
							<span class="number_of_vs">1 Applicant</span>
						</li>
						<li>
							<label>Type of Visa:</label>
							<span class="visa_type">1 month single entry <br /> (30-day stay, only 1 time entry/exit)</span>
							<div class="clr"></div>
						</li>
						<li>
							<label>Purpose of Visit:</label>
							<span class="purpose_of_vs">Please Select..</span>
						</li>
						<li>
							<label>Arrival Port:</label>
							<span class="arrival_port_t">Please Select..</span>
							<div class="clr"></div>
						</li>
						<li>
							<label>Visa service fee:</label>
							<span class="total_visa_price price">$20</span>
						</li>
						<li id="yoursave_li" style="display: none">
							<label>Discount Visa service fee <span class="yoursavepercent_t"></span></label>
							<span class="yoursave_t price"></span>
						</li>
						<li id="discount_li" style="display: none">
							<label>Discount Visa service fee:</label>
							<span class="discount_t price">0 USD</span>
							<div class="clr"></div>
						</li>
						<li id="processint_time_li" style="display: none">
							<label>Processing Time:</label>
							<span class="processing_note_t">Normal (2 working days)</span>
							<div class="clr"></div>
							<span class="processing_t price">$0</span>
							<div class="clr"></div>
						</li>
						<li id="extra_service_li" style="display: none">
							<label>Extra services:</label>
							<table cellpadding="0" cellspacing="0" class="extra_service">
							</table>
							<div class="clr"></div>
						</li>
						<li class="total">
							<label>TOTAL FEES:</label>
							<span class="total_price">$20</span>
						</li>
					</ul>
					<div class="clr"></div>
					<div class="center">
						<a href="javascript:void(0)" onclick="window.open('https://trustsealinfo.verisign.com/splash?form_file=fdf/splash.fdf&dn=www.travelovietnam.com&lang=en','VeriSign SSL','width=540,height=445,top=50,left=50');" title="Click to Verify - This site chose VeriSign SSL for secure for e-commerce and confidential communications.">
							<img src="<?=IMG_URL?>verisign-seal.png" alt="VeriSign SSL" />
						</a>
					</div>
				</div>
			</div>
			<div class="clr"></div>
			<input type="hidden" id="entry_page" name="entry_page" value="<?=$step1->entry_page?>"/>
		</form>
	</div>
	
	<div class="applymore15">
		<p>For applying more than 15 applications, please <a href="<?=site_url("contact")?>">contact us.</a></p>
		<p>You can also manually submit the information to: <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a>. Download application form <a href="<?=site_url("download-visa-application-forms")?>" class="here">here</a>.</p>
	</div>
	<div class="clr"></div>
	
	<div id="stickytooltip" class="stickytooltip">
		<div id="sticky1" class="none">Your visa is processed from 24-48 hours.</div>
		<div id="sticky2" class="none">Your visa is processed from 4-8 hours, and plus 20 USD/person.</div>
		<div id="sticky3" class="none">Your visa is process from 30 mins to 4 hours, depend on how rush you need. Don't forget to call us to get confirmed.</div>
		<div id="sticky4" class="none">To avoid wasting your time and get line for getting visa stamp, our staff will handle all procedure for you. You will check in faster others.</div>
		<div id="sticky5" class="none">Our friendly drivers standing outside with you name on the welcome sign. He will pick you up at the airport to your hotel.</div>
	</div>
</div>
<script>
	stickytooltip.init("*[tooltip]", "stickytooltip");
</script>