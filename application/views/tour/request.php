<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>site.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>tour.css" rel="stylesheet" />
</head>
<body style="background: none">
	<div id="tour-request-form">
		<h1>REQUEST FOR YOUR TOUR IN VIETNAM</h1>
		<p class="desc">
			In case you do not find your desired itinerary/ tour programs on the website, please fill in the form below and send to us. We will work out some recommendations that meet your expectations and get back to you within 24 hours.
		</p>
		<form name="requestform" id="requestform" action="<?=site_url("tours/send_request")?>" method="POST">
			<h2>Contact information</h2>
			<table cellspacing="4" cellpadding="4" border="0" style="margin-left: 20px;">
				<tr valign="top">
					<td width="100px">Your name<span class="required">*</span></td><td></td>
					<td><input type="text" name="req_fullname" id="req_fullname" required title="Your name is Required!" x-moz-errormessage="Your name is Required!"></td>
				</tr>
				<tr valign="top">
					<td>Your email<span class="required">*</span></td><td></td>
					<td><input type="text" name="req_email" id="req_email" required title="Your email is Required!" x-moz-errormessage="Your email is Required!"></td>
				</tr>
				<tr valign="top">
					<td>Your phone</td><td></td>
					<td><input type="text" name="req_phone" id="req_phone"></td>
				</tr>
			</table>
			<h2>Travel information</h2>
			<table cellspacing="4" cellpadding="4" border="0" style="margin-left: 20px;">
				<tr valign="top">
					<td width="100px" style="vertical-align: top">From date<span class="required">*</span></td><td></td>
					<td><span class="calendar"><input type="text" name="req_fromdate" id="req_fromdate" placeholder="mm/dd/yyyy" alt="mm/dd/yyyy" required title="From date is Required!" x-moz-errormessage="From date is Required!"></span></td>
					<td style="vertical-align: top">To date<span class="required">*</span></td><td></td>
					<td><span class="calendar"><input type="text" name="req_todate" id="req_todate" placeholder="mm/dd/yyyy" alt="mm/dd/yyyy" required title="To date is Required!" x-moz-errormessage="To date is Required!"></span></td>
				</tr>
				<tr valign="top">
					<td>Group size<span class="required">*</span></td><td></td>
					<td>Adults (12+ yrs)
						<select name="req_adult" id="req_adult">
						<? for ($i=1; $i<=20; $i++) { ?>
							<option value="<?=$i?>"><?=$i?></option>
						<? } ?>
						</select>
					</td>
					<td colspan="3">Children (2-11 yrs)
						<select name="req_children" id="req_children">
						<? for ($i=0; $i<=20; $i++) { ?>
							<option value="<?=$i?>"><?=$i?></option>
						<? } ?>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<td style="vertical-align: top">Your plans</td><td style="vertical-align: top"></td>
					<td colspan="5"><textarea cols="35" rows="4" name="req_content" id="req_content"></textarea></td>
				</tr>
				<tr valign="top">
					<td>Captcha<span class="required">*</span></td><td></td>
					<td colspan="3"><input type="text" style="width: 60px;" name="req_code" id="req_code" required title="Captcha is Required!" x-moz-errormessage="Captcha is Required!"> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
				</tr>
				<tr valign="top">
					<td colspan="2"></td>
					<td align="right">
						<button type="submit" class="red-btn">Send Request</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>