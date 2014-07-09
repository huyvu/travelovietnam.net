<script type="text/javascript" src="<?=JS_URL?>payment.online.js"></script>

<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>payment.css" />
<style type="text/css">
	.subiz_online { cursor: pointer; display: block; height: 32px; width: 166px; line-height: 32px; text-indent: -99999px; background: url(template/images/tour/icon/support-online.png) no-repeat scroll left center transparent; }
	.subiz_offline { cursor: pointer; display: block; height: 32px; width: 166px; line-height: 32px; text-indent: -99999px; background: url(template/images/tour/icon/support-offline.png) no-repeat scroll left center transparent; }
</style>
<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Secured Payment Online
	</div>
	<h1 class="page-title">SECURED PAYMENT ONLINE</h1>
	<div class="left" style="width: 680px">
		<div id="view-container">
			<div class="view-content">
				<div class="form-payment-online">
					<form id="frmPayment" action="<?=BASE_URL_HTTPS."/payment-online/proceed"?>" method="POST">
						<h3>1. Please fill in with your order information</h3>
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="100%" valign="top">
									<div style="line-height: 18px">
										<div id="pagecontact">
											<div style="margin:20px 15px;">
												<table class="tbl-order" width="100%" cellpadding="0" cellspacing="0" border="0">
													<tbody>
														<tr valign="top">
															<td width="125px">Your Fullname <span class="required">*</span></td><td>:</td>
															<td><input type="text" value="" name="fullname" id="fullname" class="clstext" /></td>
														</tr>
														<tr valign="top">
															<td>Email <span class="required">*</span></td><td>:</td>
															<td><input type="text" value="" name="email" id="email" class="clstext" /></td>
														</tr>
														<tr valign="top">
															<td>Pay for <span class="required">*</span></td><td>:</td>
															<td>
																<div class="left" style="width: 150px">
																	<div class="payfor-opt">
																		<input type="checkbox" id="payfor_tour" name="payfor[]" value="Tour booking"><label for="payfor_tour">Tour booking</label>
																	</div>
																	<div class="payfor-opt">
																		<input type="checkbox" id="payfor_flight" name="payfor[]" value="Flight booking"><label for="payfor_flight">Flight booking</label>
																	</div>
																</div>
																<div class="left">
																	<div class="payfor-opt">
																		<input type="checkbox" id="payfor_hotel" name="payfor[]" value="Hotel booking"><label for="payfor_hotel">Hotel booking</label>
																	</div>
																	<div class="payfor-opt">
																		<input type="checkbox" id="payfor_visa" name="payfor[]" value="Visa on arrival"><label for="payfor_visa">Visa on arrival</label>
																	</div>
																</div>
																<div class="clr"></div>
																<div class="left" style="width: 150px">
																	<div class="payfor-opt">
																		<input type="checkbox" id="payfor_other" name="payfor[]" value="Other"><label for="payfor_other">Other</label>
																	</div>
																</div>
																<div class="clr"></div>
															</td>
														</tr>
														<tr valign="top">
															<td>Amount <span class="required">*</span></td><td>:</td>
															<td>
																<input type="text" value="" name="amount" id="amount" class="clstext" style="width: 80px" onkeyup="checkNumber(this)" placeholder="E.g: 100.00"/> <strong>USD</strong>
															</td>
														</tr>
														<tr valign="top">
															<td>Payment description <span class="required">*</span></td><td>:</td>
															<td>
																<textarea name="note" id="note" placeholder="E.g: I would like to pay for..."></textarea>
															</td>
														</tr>
														<tr valign="top">
															<td>Captcha <span class="required">*</span></td><td>:</td>
															<td><input type="text" id="security_code" name="security_code" class="clstext" style="width: 80px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
						<h3>2. Select Your Payment Method</h3>
						<table class="tbl-payment-method" style="margin-left: 20px">
							<tr>
								<td colspan="3">
								After payment is made, you will receive an email confirming your order.
								</td>
							</tr>
							<tr valign="top">
								<td width="130px">&nbsp;</td>
								<td>
									<label for="payment1"><img width="110px" height="62px" src="<?=IMG_URL?>payment/onepay.png" alt="OnePay" /></label>
									<br />
									<input id="payment1" type="radio" name="payment" checked="checked" value="OnePay" />
									<label for="payment1">OnePay</label>
								</td>
								<td>
									<label for="payment2"><img width="98px" height="62px" src="<?=IMG_URL?>payment/paypal.png" alt="Paypal" /></label>
									<br />
									<input id="payment2" type="radio" name="payment" value="Paypal" />
									<label for="payment2">Paypal</label>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td colspan="4" align="center"><br /><input class="button" type="submit" value="PROCEED TO PAYMENT" id="proceed" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="right" style="width: 280px">
		<div id="support-online-widget">
			<div class="support-online-widget-title">SUPPORT ONLINE</div>
			<div class="support-online-widget-content">
				<table>
					<tr>
						<td>Toll free</td><td>:</td><td><?=TOLL_FREE?></td>
					</tr>
					<tr>
						<td>Hotline</td><td>:</td><td><?=HOTLINE?></td>
					</tr>
					<tr>
						<td colspan="3">
							<div id="subiz_status"></div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div id="booking-confidence-widget">
			<div class="booking-confidence-widget-title">
				APPLY WITH CONFIDENCE
			</div>
			<div class="booking-confidence-widget-content">
				<ul>
					<li>Secured payment online</li>
					<li>Support 24/7</li>
					<li>Money back guarantee</li>
					<li>Flexibility booking</li>
					<li>Competitive price</li>
				</ul>
			</div>
		</div>
	</div>
</div>