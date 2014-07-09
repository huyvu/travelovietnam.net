<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail_Tpl {

	function template($content)
	{
		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
				<html xml:lang="EN" xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					</head>
					<body style="font-family: Arial,Tahoma,sans-serif; font-size: 12px;">
						<div style="border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;">
							<div style="padding: 0px 0px 10px 0px;">
								'.$content.'
							</div>
							<div style="padding: 15px 10px 0px 0px;">
								<table>
									<tr><td colspan="3"><b>Vietnam Travel Dept.</b></td></tr>
									<tr><td>Address</td><td>:</td><td>'.ADDRESS.'</td></tr>
									<tr><td>Tell</td><td>:</td><td>'.TELL.'</td></tr>
									<tr><td>Hotline</td><td>:</td><td>'.HOTLINE.'</td></tr>
									<tr><td>Website</td><td>:</td><td><a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a></td></tr>
									<tr><td>Email</td><td>:</td><td><a href="mailto:'.MAIL_INFO.'" target="_blank">'.MAIL_INFO.'</a></td></tr>
									<tr><td colspan="3">WE ALWAYS SUPPORT YOU 24/7</td></tr>
								</table>
							</div>
						</div>
					<body>
				</html>';
	}
	
	function tour_template($content){
		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<style type="text/css">
						a{ text-decoration: none; color: #00539e;}
						h2{font-size: 16px;margin-top: 25px;}
						p{line-height: 20px; font-size: 12px;}
						table.info, table#pax-info{font-size: 12px;}
						table.info tr > td:first-child{ font-weight: bold;width: 110px;}
						table.info tr{height: 25px;}
						table#pax-info tr td,table#pax-info tr th{border: 1px solid #e5e5e5; padding: 10px 15px; border-bottom:1px solid #fff;}
						table#pax-info{border-collapse: collapse;margin-top: 20px;}
						table#pax-info tr th{background: #e8e8e8;border-right: 1px solid #fff }
						table#pax-info tr th:last-child{background: #e8e8e8;border-right: 1px solid #e5e5e5 }
						table#pax-info tr:last-child td{border-bottom: 1px solid #e5e5e5 !important;}
					</style>
				</head>
				<body style="font-family:Arial,Tahoma,sans-serif;font-size: 14px" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix">

				<table id="topNav" class="wrap" width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" 
				style="color: #000;line-height: 20px;-webkit-font-smoothing: antialiased;
				font-smoothing: antialiased;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;
				width: 100%;margin: 0 auto;text-align:left;">
					<tbody>
						<tr valign="top">
							<td valign="top" class="wrapInner" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;
								padding: 0px 0;">
								<table style="margin-top:10px" width="700" border="0" align="center" cellpadding="0" cellspacing="0"> 
									<tr valign="top">
										<td style="padding:0 26px;">
										<p style="text-align:right;color:#00539e;font-size:18px;font-weight:bold;margin-bottom:5px;">TraveloVietnam.com</p>
											<hr style="background-color: #009daf;border:0;height: 1px;"/>
											'.$content.'
											<hr style="background-color: #009daf;border:0;height: 1px;"   />     
											<table width="0" border="0" style="margin-top:-10px;">
												<tr align="left" valign="top">
													<td style="padding-right:22px;">
														<p style="font-size:14px;font-weight:bold">Best regards</p>
														<p style="font-size:12px;">
															<strong><span style="color:#000">OPERATIONS MANAGER</span></strong><br>
															<span>Cellphone: (+84) 908.561.499</span>
														</p>
														<p>
															<img style="border:none;outline:none;" src="'.BASE_URL.IMG_URL.'travelovietnam.png" width="173" height="54" />
														</p>
													</td>
													<td>
														<p style="font-size:12px;">
															<b>Head Office</b>: 184/1A Le Van Sy, Ward 10, Phu Nhuan Distr., Ho Chi Minh, Vietnam<br />
															<b>Telephone :</b> (+84) 866.757.124<br />
															<b>Toll-Free:</b> +1-800-605-3168<br/>
															<b>Email:</b>  <a href="mailto:'.MAIL_INFO.'">'.MAIL_INFO.'</a><br />
															<b>Website:</b> <a href="'.BASE_URL.'">www.travelovietnam.com</a>
														</p>
														<p style="font-size:11px;font-style:italic;color:#000;line-height:14px;">
															We love your feedback and read every word to improve services! 
															Please feel free to tell us how our support are at  <a href="mailto:'.MAIL_INFO.'">'.MAIL_INFO.'</a> 
															or call <span style="color:#ff0000;font-style:normal">(+84) 909.343.525</span> 
														</p>
													</td>
												</tr>
											</table>
										</td>     
									</tr>     
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				</body>
				</html>';
	}

	function blank_template($content)
	{
		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
				<html xml:lang="EN" xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					</head>
					<body style="font-family: Arial,Tahoma,sans-serif; font-size: 12px;">
						<div style="border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;">
							<div style="padding: 0px 0px 10px 0px;">
								'.$content.'
							</div>
						</div>
					<body>
				</html>';
	}
	
	function visa_info($tpl_data)
	{
		$travelers = $tpl_data["TRAVELERS"];
		$numOfTraveler = sizeof($travelers);

		$embassies = "";
		if ($tpl_data["VISA_TYPE"] == "3 months at Embassy or Consulate") {
			$embassies = '<tr><td>Embassies/Consulates Location</td><td> : </td><td>'.$tpl_data["EMBASSIES"].'</td></tr>';
		}
		$txtCarPickup = "";
		if ($tpl_data["CAR_PICKUP"]) {
			$txtCarPickup = '<tr><td>Car Pick-up</td><td> : </td><td>'.$tpl_data["CAR_PICKUP_FEE"].' USD</td></tr>';
		}
		$airportFastCheckin = "";
		if ($tpl_data["AIRPORT_FAST_CHECKIN"] == 1) {
			$airportFastCheckin = '<tr><td>Airport Fast Track</td><td> : </td><td>'.$tpl_data["AIRPORT_FAST_CHECKIN_FEE"].' USD</td></tr>';
		}
		else if ($tpl_data["AIRPORT_FAST_CHECKIN"] == 2) {
			$airportFastCheckin = '<tr><td>VIP Fast Track</td><td> : </td><td>'.$tpl_data["AIRPORT_FAST_CHECKIN_FEE"].' USD</td></tr>';
		}
		$discount = "";
		if ($tpl_data["PROMOTION"]) {
			$discount = '<tr><td>Discount</td><td> : </td><td>'.$tpl_data["DISCOUNT"].' USD</td></tr>';
		}
		
		$flightNumber = "";
		$arrivalTime  = "";
		if ($tpl_data["PROCESSING_TIME"] == "Emergency") {
			$flightNumber = '<tr><td>Flight Number</td><td> : </td><td>'.$tpl_data["FLIGHT_NUMBER"].'</td></tr>';
			$arrivalTime  = '<tr><td>Arrival Time</td><td> : </td><td>'.$tpl_data["ARRIVAL_TIME"].'</td></tr>';
		}

		$trl_lines = "";
		$indians = 0;
		$non_indians = 0;
		$style = 'style="border: 1px solid #CCC;"';
		for ($i=0; $i<$numOfTraveler; $i++) {
			if ($travelers[$i]["nationality"] == "India") {
				$indians ++;
			} else {
				$non_indians ++;
			}
			$trl_lines .= '<tr><td align="center" '.$style.'>'.($i+1).'</td><td '.$style.'>'.$travelers[$i]["fullname"].'</td><td align="center" '.$style.'>'.$travelers[$i]["gender"].'</td><td align="center" '.$style.'>'.date("M/d/Y", strtotime($travelers[$i]["birthday"])).'</td><td align="center" '.$style.'>'.$travelers[$i]["nationality"].'</td><td align="center" '.$style.'>'.$travelers[$i]["passport"].'</td><td align="center" '.$style.'>'.date("M/d/Y",strtotime($tpl_data["ARRIVAL_DATE"])).'</td><td '.$style.'>'.$tpl_data["VISA_TYPE"].'</td></tr>';
		}
		
		$serviceFee = "";
		if ($indians > 0 && $non_indians == 0) {
			$serviceFee .= '<tr><td>Service Fee USD/pax</td><td> : </td><td>'.$tpl_data["INDIAN_SERVICE_FEE"].' USD</td></tr>';
		} else if ($indians == 0 && $non_indians > 0) {
			$serviceFee .= '<tr><td>Service Fee USD/pax</td><td> : </td><td>'.$tpl_data["SERVICE_FEE"].' USD</td></tr>';
		} else {
			$serviceFee .= '<tr><td>Service Fee USD/pax</td><td> : </td><td>'.$tpl_data["SERVICE_FEE"].' USD for non Indian</td></tr>';
			$serviceFee .= '<tr><td colspan="2"></td><td>'.$tpl_data["INDIAN_SERVICE_FEE"].' USD for Indian</td></tr>';
		}
		
		return '<fieldset style="border:1px solid #DADCE0; background-color: #FFFFFF;">
					<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Your Apply Visa Information Details</strong></legend>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							A. Information of Visa
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Visa Type</td><td> : </td><td>'.$tpl_data["VISA_TYPE"].'</td></tr>
								'.$embassies.'
								<tr><td>Date of Arrival</td><td> : </td><td>'.date("M/d/Y",strtotime($tpl_data["ARRIVAL_DATE"])).'</td></tr>
								<tr><td>Date of Exit</td><td> : </td><td>'.date("M/d/Y",strtotime($tpl_data["EXIT_DATE"])).'</td></tr>
								<tr><td>Port of Arrival</td><td> : </td><td>'.$tpl_data["ARRIVAL_PORT"].'</td></tr>
								'.$flightNumber.$arrivalTime.'
								<tr><td>Number of Applicants</td><td> : </td><td>'.$numOfTraveler.'</td></tr>
								'.$serviceFee.'
								<tr><td>Processing USD/pax</td><td> : </td><td>'.$tpl_data["RUSH_FEE"].' USD ('.$tpl_data["PROCESSING_TIME"].')</td></tr>
								'.$discount.$txtCarPickup.$airportFastCheckin.'
								<tr><td colspan="3" style="border-top: 1px dotted #CCCCCC; height: 1px;"></td></tr>
								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>'.$tpl_data["TOTAL_FEE"].' USD</b></td></tr>
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							B. Passport Detail of Applications
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table cellpadding="4" cellspacing="0" border="0" style="border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;">
								<tr>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Applicant</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Fullname</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Gender</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Date of Birth</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Nationality</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Passport Number</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Date of Arrival</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Type of Visa</th>
								</tr>
								'.$trl_lines.'
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							C. Contact Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Primary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["PRIMARY_EMAIL"].'">'.$tpl_data["PRIMARY_EMAIL"].'</a></td></tr>
								<tr><td>Secondary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["SECONDARY_EMAIL"].'">'.$tpl_data["SECONDARY_EMAIL"].'</a></td></tr>
								<tr><td>Special Request</td><td> : </td><td>'.$tpl_data["SPECIAL_REQUEST"].'</td></tr>
								[REQUEST-IP]
							</table>
						</div>
					</div>
				</fieldset>';
	}

	function visa_payment_successful($tpl_data)
	{
		$processing_time = "* This is confirmation from us to show that you are successful to apply visa to Vietnam. We will send you the visa letter in 24 hours to 48 hours from now via email.";
		if ($tpl_data["PROCESSING_TIME"] == "Urgent") {
			$processing_time = "* This is confirmation from us to show that you are successful to apply visa to Vietnam in Urgent case. We will send you the visa letter in 4 hours to 8 hours from now via email.";
		}
		else if ($tpl_data["PROCESSING_TIME"] == "Emergency") {
			$processing_time = "This is confirmation from us to show that you are successful to apply visa to Vietnam in Emergency case. We will send you the visa letter in 1 hour to 4 hours from now via email. Please give us a call to inform you need rush.";
		}
		
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>'.$processing_time.'</td></tr>
						<tr><td>* Payment successful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</td></tr>
						<tr><td>* Please print out the pre-approved letter as we will send you by email & 2 pieces of your picture 4x6cm for boarding the airplane and pick up your visa at Vietnam airports when you arrive. You will see "Landing Visa" sign and please come to Landing Visa Counter for pick up your visa.</td></tr>
						<tr><td>* Pay in cash for the stamp fee for collecting your visa : 45USD for single entry visa or 65USD for multiple entries visa.</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly as in your passport. Any change after approved will be charged.</b></td></tr>
					</table>
					<br>'.$this->visa_info($tpl_data);
		return $this->template($content);
	}
	
	function visa_payment_failure($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* This is confirmation from us to show that you was not successful to apply visa to Vietnam in this case. Because you can not settle the payment with our system. May your credit card issue some where and you are way from there. Or some reason for security. So you can chose paypal method for this case. It may help you better.</td></tr>
						<tr><td>* Payment unsuccessful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</td></tr>
						<tr><td>* Or we will send you the Payment Request in 1-2 hours with multiple Methods of Payment. You can chose and pay us for your visa. Hope this more convenience for you.</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly as in your passport. Any change after approved will be charged.</b></td></tr>
					</table>
					<br>'.$this->visa_info($tpl_data);
		return $this->template($content);
	}
	
	function vip_info($tpl_data)
	{
		if ($tpl_data["RECEIVER"] == MAIL_INFO) {
			return "";
		}
		
		return '<tr>
					<td style="color: red">
						<b>1. VIP Account:</b>
					</td>
				</tr>
				<tr>
					<td>
						For more convenience to check your status or discount on the next time. <br/>
						Please use this link to access your private VIP account with us.
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="4" cellspacing="0" border="0">
							<tr><td>Link: </td><td><a href="http://www.travelovietnam.com/member.html">http://www.travelovietnam.com/member.html</a></td></tr>
							<tr><td>Email: </td><td>'.$tpl_data["USER_LOGIN"].'</td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="color: red">
						<b>2. Confirmation Status:</b>
					</td>
				</tr>';
	}
	
	function visa_payment_remind($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* This is confirmation from us to show that we are reviewing your request for arranging visa to Vietnam. But you have not paid yet. Our staff will send you payment request for your visa in 1 - 2 hours.</td></tr>
						<tr><td>* Payment method: <b>'.$tpl_data["PAYMENT_METHOD"].'</b></td></tr>
						<tr><td>* You can pay us via Paypal address: '.MAIL_PAYMENT.'</td></tr>
						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly as in your passport. Any change after approved will be charged.</b></td></tr>
					</table>
					<br>'.$this->visa_info($tpl_data);
		
		return $this->template($content);
	}
	
	

	// New mail layout
	function tour_info($tpl_data)
	{
		$tour = $tpl_data['TOUR'];
		$paxs = $tpl_data['PAXS'];
		$balance = $tpl_data['TOTAL_FEE'] - $tpl_data['PAID'];
		$duration = ($tour->duration > 1) ? $tour->duration." days - ".($tour->duration-1)." nights" : $tour->duration." day";
		$endDate = ($tour->daily && $tour->duration==1)? date('d M, Y', strtotime($tpl_data["DEPARTURE_DATE"])) : date('d M, Y', strtotime($tpl_data['DEPARTURE_DATE'].'+'.$tour->duration.'days'));
		$request = '';
		if (!empty($tpl_data['MESSAGE'])) {
			$request = '<h2 style="font-size: 16px;margin-top: 25px;">SPECIAL REQUEST:</h2>
						<hr style="background-color: #ebebeb;border:0;height: 1px;">
						<p>'.$tpl_data['MESSAGE'].'</p>';
		}

		$adults = (substr("0".$tpl_data['ADULTS'], -2))." Adult".(($tpl_data['ADULTS']>1)? "s": "");
		$children = ($tpl_data['CHILDREN']>0)?(' + '.(substr("0".$tpl_data['CHILDREN'], -2)).'Children'):'';
		$infants = ($tpl_data['INFANTS']>0)?(' + '.(substr("0".$tpl_data['INFANTS'], -2)).(($tpl_data['INFANTS']>1)? " Infants": " Infant")):'';
		$i = 1;
		$tour_paxs = '';
		foreach ($paxs as $pax) {
			if ($i == sizeof($paxs)) {
				$tour_paxs .= '<tr><td style="border: 1px solid #e5e5e5; padding: 10px 15px;">'.$i.'</td>
				<td style="border: 1px solid #e5e5e5; padding: 10px 15px;">'.$pax->fullname.'</td>
				<td style="border: 1px solid #e5e5e5; padding: 10px 15px;">'.$pax->gender.'</td>
				<td style="border: 1px solid #e5e5e5; padding: 10px 15px;">'.strftime('%d %b, %Y',strtotime($pax->birthdate)).'</td>
				<td style="border: 1px solid #e5e5e5; padding: 10px 15px;">'.$pax->nationality.'</td></tr>';
			}else{
				$tour_paxs .= '<tr><td style="border: 1px solid #e5e5e5; padding: 10px 15px; border-bottom:1px solid #fff;">'.$i.'</td>
				<td style="border: 1px solid #e5e5e5; padding: 10px 15px; border-bottom:1px solid #fff;">'.$pax->fullname.'</td>
				<td style="border: 1px solid #e5e5e5; padding: 10px 15px; border-bottom:1px solid #fff;">'.$pax->gender.'</td>
				<td style="border: 1px solid #e5e5e5; padding: 10px 15px; border-bottom:1px solid #fff;">'.strftime('%d %b, %Y',strtotime($pax->birthdate)).'</td>
				<td style="border: 1px solid #e5e5e5; padding: 10px 15px; border-bottom:1px solid #fff;">'.$pax->nationality.'</td></tr>';
			}
			$i++;
		}

		return '<h2 style="font-size: 16px;margin-top: 25px;font-weight:bold">TOUR INFORMATION</h2>
				<hr style="background-color: #ebebeb;border:0;height: 1px;">
				<table class="info" style="font-size: 14px;">
					<tr><td width="110"><b>Tour Name</b></td><td width="15">:</td><td><b>'.$tour->name.'</b></td></tr>
					<tr><td><b>Tour Code</b></td><td>:</td><td>'.$tour->code.'</td></tr>
					<tr><td><b>Duration</b></td><td>:</td><td>'.$duration.' </td></tr>
					<tr><td><b>Start date</b></td><td>:</td><td>'.date('d M, Y', strtotime($tpl_data["DEPARTURE_DATE"])).'</td></tr>
					<tr><td><b>End date</b></td><td>:</td><td>'.$endDate.'</td></tr>
					<tr><td><b>Group size</b></td><td>:</td><td>'.$adults.$children.$infants.'</td></tr>
					<tr><td><b>Total cost</b></td><td>:</td><td><b>$'.number_format($tpl_data['TOTAL_FEE'],2).' USD</b></td></tr>
					<tr><td><b>Deposit</b></td><td>:</td><td><b>$'.number_format($tpl_data['PAID'],2).' USD</b></td></tr>
					<tr><td><b>Balance</b></td><td>:</td><td><b>$'.number_format($balance,2).' USD</b></td></tr>
					<tr><td><b>References</b></td><td>:</td><td><a href="'.BASE_URL.'/tours/vietnam/'.$tour->city_alias.'/'.$tour->category_alias.'/'.$tour->alias.'">Tour Program</a>, <a href="'.$tour->brochure.'">Brochure</a>, <a href="'.BASE_URL.'/tours/booking-conditions">Terms And Condition</a></td></tr>
				</table><!-- end #info -->
				<h2 style="font-size: 16px;padding-top: 20px;font-weight:bold">TRAVELLER INFORMATION</h2>
				<hr style="background-color: #ebebeb;border:0;height: 1px;">
				<table id="pax-info" style="font-size: 14px;border-collapse: collapse;margin-top: 20px;text-align:left">
					<tr>
						<th width="60" style="background: #e8e8e8;border-right: 1px solid #fff;padding: 10px 15px;">No.</th>
						<th style="background: #e8e8e8;border-right: 1px solid #fff;padding: 10px 15px;">Full name</th>
						<th width="80" style="background: #e8e8e8;border-right: 1px solid #fff;padding: 10px 15px;">Gender</th>
						<th width="130" style="background: #e8e8e8;border-right: 1px solid #fff;padding: 10px 15px;">Birth date</th>
						<th style="background: #e8e8e8;border-right: 1px solid #e5e5e5;padding: 10px 15px;">Nationality</th>
					</tr>
					'.$tour_paxs.'
				</table><!-- #pax-info -->
				<h2 style="font-size: 16px;padding-top: 20px;font-weight:bold">TRAVELLER CONTACT INFORMATION:</h2>
				<hr style="background-color: #ebebeb;border:0;height: 1px;">
				<table class="info" style="font-size: 14px;">
					<tr><td width="130"><b>Contact person</b></td><td width="15">:</td><td>'.$tpl_data['TITLE'].'. '.$tpl_data['FULLNAME'].'</td></tr>
					<tr><td><b>Email</b></td><td>:</td><td>'.$tpl_data['EMAIL'].'</td></tr>
					<tr><td><b>Phone</b></td><td>:</td><td>'.$tpl_data['PHONE'].'</td></tr>
					[REQUEST-IP]
				</table>
				<p>'.$request.'</p>';
	}

	/*function tour_info($tpl_data)
	{
		$paxs = $tpl_data["PAXS"];
		$numOfTraveler = sizeof($paxs);
		
		$discount = "";
		if ($tpl_data["PROMOTION"]) {
			$discount = '<tr><td>Discount</td><td> : </td><td>'.$tpl_data["DISCOUNT"].' USD</td></tr>';
		}
		
		$classtype = "";
		if ($tpl_data["TOUR"]->daily) {
			$classtype = '<tr><td>Class Type</td><td> : </td><td>'.$tpl_data["CLASSTYPE"].'</td></tr>';
		}
		
		$supplement = "";
		if ($tpl_data["SUPPLEMENTS"]) {
			$supplement = '<tr><td>Number of Supplements</td><td> : </td><td>'.$tpl_data["SUPPLEMENTS"].'</td></tr>';
		}

		$trl_lines = "";
		$style = 'style="border: 1px solid #CCC;"';
		for ($i=0; $i<$numOfTraveler; $i++) {
			$trl_lines .= '<tr><td align="center" '.$style.'>'.($i+1).'</td><td '.$style.'>'.$paxs[$i]->fullname.'</td><td align="center" '.$style.'>'.$paxs[$i]->gender.'</td><td align="center" '.$style.'>'.date("M/d/Y", strtotime($paxs[$i]->birthdate)).'</td><td align="center" '.$style.'>'.$paxs[$i]->nationality.'</td><td '.$style.'>'.(($paxs[$i]->supplement)?"Yes":"No").'</td></tr>';
		}
		
		$dest_lines = "";
		$destsize = sizeof($tpl_data["DESTINATIONS"]);
		for ($i=0; $i < $destsize; $i++) {
			$destination = $tpl_data["DESTINATIONS"][$i];
			$dest_lines .= '<a target="_blank" title="'.$destination->name.', '.$destination->name.' Vietnam, '.$destination->name.' travel guide" href="'.site_url("vietnam/top-destinations/".$destination->alias).'">'.$destination->name.'</a>';
			if ($i < $destsize-1) {
				$dest_lines .= '&nbsp; &rarr; &nbsp;';
			}
		}
		
		return '<fieldset style="border:1px solid #DADCE0; background-color: #FFFFFF;">
					<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Your Trip Information Details</strong></legend>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							A. Tour Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Tour</td><td> : </td><td>'.$tpl_data["TOUR"]->name.'</td></tr>
								<tr><td>Tour Code</td><td> : </td><td>'.$tpl_data["TOUR"]->code.'</td></tr>
								<tr><td>Duration</td><td> : </td><td>'.(($tpl_data["TOUR"]->duration > 1) ? $tpl_data["TOUR"]->duration." days - ".($tpl_data["TOUR"]->duration-1)." nights" : $tpl_data["TOUR"]->duration." day").'</td></tr>
								<tr><td>Destinations</td><td> : </td><td>'.$dest_lines.'</td></tr>
								<tr><td>Departure Date</td><td> : </td><td>'.date('D, M d, Y', strtotime($tpl_data["DEPARTURE_DATE"])).'</td></tr>
								<tr><td>Return Date</td><td> : </td><td>'.date('D, M d, Y', strtotime($tpl_data["DEPARTURE_DATE"]."+".($tpl_data["TOUR"]->duration-1)." days")).'</td></tr>
								'.$classtype.'
								<tr><td>Number of Adults</td><td> : </td><td>'.$tpl_data["ADULTS"].'</td></tr>
								<tr><td>Number of Children</td><td> : </td><td>'.$tpl_data["CHILDREN"].'</td></tr>
								<tr><td>Number of Infants</td><td> : </td><td>'.$tpl_data["INFANTS"].'</td></tr>
								'.$supplement.'
								'.$discount.'
								<tr><td colspan="3" style="border-top: 1px dotted #CCCCCC; height: 1px;"></td></tr>
								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>'.$tpl_data["TOTAL_FEE"].' USD</b></td></tr>
								<tr><td><b>'.$tpl_data["PAYMENT_OPTION"].'</b></td><td> : </td><td><b>'.$tpl_data["PAID"].' USD</b></td></tr>
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							B. Traveler Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table cellpadding="4" cellspacing="0" border="0" style="border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;">
								<tr>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Traveler</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Fullname</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Gender</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Date of Birth</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Nationality</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Supplement</th>
								</tr>
								'.$trl_lines.'
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							C. Contact Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Full Name</td><td> : </td><td>'.$tpl_data["FULLNAME"].'</td></tr>
								<tr><td>Email</td><td> : </td><td><a href="mailto:'.$tpl_data["EMAIL"].'">'.$tpl_data["EMAIL"].'</a></td></tr>
								<tr><td>Phone No.</td><td> : </td><td><a href="tel:'.$tpl_data["PHONE"].'">'.$tpl_data["PHONE"].'</a></td></tr>
								<tr><td>Additional Requirements</td><td> : </td><td>'.$tpl_data["MESSAGE"].'</td></tr>
								[REQUEST-IP]
							</table>
						</div>
					</div>
				</fieldset>';
	}*/

	function tour_payment_successful($tpl_data)
	{
		$message = "";
		if ($tpl_data['PAYMENT_OPTION'] == 'Full charge 100%') {
			$message = '<p style="font-size: 14px">Thank you for booking tour with us. Kindly confirm your booking 
			and your full payment of $'.number_format($tpl_data['PAID'],2).' USD are well received. Please check your 
			summary of your tour inquiry bellow:</p>';
		}elseif ($tpl_data['PAYMENT_OPTION'] == 'Deposit 40%') {
			$message = '<p style="font-size: 14px">Thank you for booking tour with us. Kindly confirm your booking and your 
			deposit of $'.number_format($tpl_data['PAID'],2).' USD are well received. Kindly settle your balance of $'.number_format($tpl_data['TOTAL_FEE']-$tpl_data['PAID'],2).' USD prior 
			20 days to departure to secure your booking. Please check your summary of your tour inquiry bellow:</p>';
		}

		$content = '<p style="font-size: 14px">Dear <b style="font-size: 14px">'.$tpl_data['TITLE'].'. '.$tpl_data['FULLNAME'].'</b>,</p>
					<p style="font-size: 14px">Warmest greeting from <a href="'.BASE_URL.'">www.travelovietnam.com</a> !</p>'.$message.$this->tour_info($tpl_data).'
					<p style="margin-top:10px;font-size:14px; line-height:20px">Any tour amendment should be made 14 days prior to departure to avoid unwanted fee. 
					Should you have any further request, please feel free to contact us at your convenience.<br/>
					We are looking forward to welcoming you to Vietnam.</p>';
		return $this->tour_template($content);
	}
	
	function tour_payment_failure($tpl_data)
	{
		$tpl_data['PAID'] = ($tpl_data['PAID'] == $tpl_data['TOTAL_FEE'])? 0 : $tpl_data['PAID'];
		$content = '<p style="font-size: 14px">Dear <b style="font-size: 14px">Travel Team</b>,</p>
					<p style="font-size: 14px">This is a notification from the system to let you know that the customer was not successful to booking our services in this case. Because the customer can not settle the payment for some reasons.</p>
					<p style="font-size: 14px">Payment unsuccessful via <b style="font-size: 14px">'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</p>
					<p style="font-size: 14px">Please check summary of the tour inquiry bellow:</p>'.$this->tour_info($tpl_data);
		return $this->tour_template($content);
	}
	
	/*function tour_payment_remind($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* This is confirmation from us to show that we are reviewing your request for planning tour in Vietnam. But you have not paid yet. Our staff will send you payment request for your booking in 1 - 2 hours.</td></tr>
						<tr><td>* Payment method: <b>'.$tpl_data["PAYMENT_METHOD"].'</b></td></tr>
						<tr><td>* You can pay us via Paypal address: '.MAIL_PAYMENT.'</td></tr>
						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>
					</table>
					<br>'.$this->tour_info($tpl_data);
		
		return $this->template($content);
	}*/
	
	function tour_payment_inquiry($tpl_data)
	{
		$tpl_data['PAID'] = 0;
		$content = '<p style="font-size: 14px">Hi <b style="font-size: 14px">Travel Team</b>,</p>
					<p style="margin-top:10px;font-size: 14px">This mail is sent to inform you that we have an incomming booking tour from a custommer</p>
					<p style="font-size: 14px">Tour payment option is <b style="font-size: 14px">'.$tpl_data['PAYMENT_OPTION'].'</b> with <b style="font-size: 14px">'.$tpl_data['PAYMENT_METHOD'].'</b> payment method.<br/> 
					Summary of booking tour inquiry bellow:</p>'.$this->tour_info($tpl_data);
		return $this->tour_template($content);
	}

	function tour_planning($tpl_data)
	{
		$content = '<p style="font-size: 14px">Hi <b style="font-size: 14px">Travel Team</b>,</p>
					<p style="margin-top:10px;font-size: 14px">This mail is sent to inform you that we have an incomming tour booking planning from a custommer</p>
					<p style="font-size: 14px"> Summary of booking tour inquiry bellow:</p>'.$this->tour_info($tpl_data);
		return $this->tour_template($content);
	}

	function flight_info($tpl_data)
	{
		$CI =& get_instance();
		$CI->load->library('util');
		
		$paxs = $tpl_data["PAXS"];
		$numOfTraveler = sizeof($paxs);
		
		$discount = "";
		if ($tpl_data["PROMOTION"]) {
			$discount = '<tr><td>Discount</td><td> : </td><td>'.$tpl_data["DISCOUNT"].' USD</td></tr>';
		}

		$trl_lines = "";
		$style = 'style="border: 1px solid #CCC;"';
		for ($i=0; $i<$numOfTraveler; $i++) {
			$trl_lines .= '<tr><td align="center" '.$style.'>'.($i+1).'</td><td '.$style.'>'.$paxs[$i]->fullname.'</td><td align="center" '.$style.'>'.$paxs[$i]->gender.'</td><td align="center" '.$style.'>'.date("M/d/Y", strtotime($paxs[$i]->birthdate)).'</td><td align="center" '.$style.'>'.$paxs[$i]->nationality.'</td></tr>';
		}
		
		$ticket_lines = "";
		if (!empty($tpl_data["DEPARTURE_FLIGHT"]->flight_id)) {
			$ticket_lines .= '<tr><td>Outbound Flight</td><td> : </td><td>'.date('D., M. d, Y', strtotime($tpl_data["DEPARTURE_DATE"])).' | '.$CI->util->getAirportCity($tpl_data["LEAVING_FROM"]).' to '.$CI->util->getAirportCity($tpl_data["GOING_TO"]).'</td></tr>';
		}
		if (!empty($tpl_data["RETURN_FLIGHT"]->flight_id)) {
			$ticket_lines .= '<tr><td>Return Flight</td><td> : </td><td>'.date('D., M. d, Y', strtotime($tpl_data["RETURN_DATE"])).' | '.$CI->util->getAirportCity($tpl_data["GOING_TO"]).' to '.$CI->util->getAirportCity($tpl_data["LEAVING_FROM"]).'</td></tr>';
		}
		
		return '<fieldset style="border:1px solid #DADCE0; background-color: #FFFFFF;">
					<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Your Apply Visa Information Details</strong></legend>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							A. Flight Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								'.$ticket_lines.'
								<tr><td>Number of Traveler</td><td> : </td><td>'.$numOfTraveler.'</td></tr>
								'.$discount.'
								<tr><td colspan="3" style="border-top: 1px dotted #CCCCCC; height: 1px;"></td></tr>
								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>'.$tpl_data["TOTAL_FEE"].' USD</b></td></tr>
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							B. Traveller Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table cellpadding="4" cellspacing="0" border="0" style="border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;">
								<tr>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Traveler</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Fullname</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Gender</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Date of Birth</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Nationality</th>
								</tr>
								'.$trl_lines.'
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							C. Contact Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Email</td><td> : </td><td><a href="mailto:'.$tpl_data["EMAIL"].'">'.$tpl_data["EMAIL"].'</a></td></tr>
								<tr><td>Phone No.</td><td> : </td><td><a href="tel:'.$tpl_data["PHONE"].'">'.$tpl_data["PHONE"].'</a></td></tr>
								<tr><td>Additional Requirements</td><td> : </td><td>'.$tpl_data["MESSAGE"].'</td></tr>
								[REQUEST-IP]
							</table>
						</div>
					</div>
				</fieldset>';
	}

	function flight_payment_successful($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* Payment successful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly. Any change after approved will be charged.</b></td></tr>
					</table>
					<br>'.$this->flight_info($tpl_data);
		return $this->template($content);
	}
	
	function flight_payment_failure($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* This is confirmation from us to show that you was not successful to booking our services in this case. Because you can not settle the payment with our system. May your credit card issue some where and you are way from there. Or some reason for security. So you can chose paypal method for this case. It may help you better.</td></tr>
						<tr><td>* Payment unsuccessful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</td></tr>
						<tr><td>* Or we will send you the Payment Request in 1-2 hours with multiple Methods of Payment. You can chose and pay us for your booking. Hope this more convenience for you.</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly. Any change after approved will be charged.</b></td></tr>
					</table>
					<br>'.$this->flight_info($tpl_data);
		return $this->template($content);
	}
	
	function flight_payment_remind($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* This is confirmation from us to show that we are reviewing your request for arranging flight ticket to Vietnam. But you have not paid yet. Our staff will send you payment request for your booking in 1 - 2 hours.</td></tr>
						<tr><td>* Payment method: <b>'.$tpl_data["PAYMENT_METHOD"].'</b></td></tr>
						<tr><td>* You can pay us via Paypal address: '.MAIL_PAYMENT.'</td></tr>
						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly. Any change after approved will be charged.</b></td></tr>
					</table>
					<br>'.$this->flight_info($tpl_data);
		
		return $this->template($content);
	}
	
	function hotel_info($tpl_data)
	{
		$rooms = $tpl_data["ROOMS"];
		$numOfRoom = sizeof($rooms);
		
		$paxs = $tpl_data["PAXS"];
		$numOfTraveler = sizeof($paxs);

		$discount = "";
		if ($tpl_data["PROMOTION"]) {
			$discount = '<tr><td>Discount</td><td> : </td><td>'.$tpl_data["DISCOUNT"].' USD</td></tr>';
		}
		
		$room_tr_lines = "";
		$style = 'style="border: 1px solid #CCC;"';
		for ($i=0; $i<$numOfRoom; $i++) {
			$room_tr_lines .= '<tr><td align="center" '.$style.'>'.($i+1).'</td><td '.$style.'>'.$rooms[$i]->name.'</td></tr>';
		}
		
		$pax_tr_lines = "";
		$style = 'style="border: 1px solid #CCC;"';
		for ($i=0; $i<$numOfTraveler; $i++) {
			$pax_tr_lines .= '<tr><td align="center" '.$style.'>'.($i+1).'</td><td '.$style.'>'.$paxs[$i]->fullname.'</td><td align="center" '.$style.'>'.$paxs[$i]->gender.'</td><td align="center" '.$style.'>'.date("M/d/Y", strtotime($paxs[$i]->birthdate)).'</td><td align="center" '.$style.'>'.$paxs[$i]->nationality.'</td></tr>';
		}
		
		return '<fieldset style="border:1px solid #DADCE0; background-color: #FFFFFF;">
					<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Your Apply Visa Information Details</strong></legend>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							A. Hotel Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Hotel</td><td> : </td><td>'.$tpl_data["HOTEL"]->name.'</td></tr>
								<tr><td>Address</td><td> : </td><td>'.$tpl_data["HOTEL"]->address.'</td></tr>
								<tr><td>Checkin</td><td> : </td><td>'.date("M/d/Y",strtotime($tpl_data["CHECKIN"])).'</td></tr>
								<tr><td>Checkout</td><td> : </td><td>'.date("M/d/Y",strtotime($tpl_data["CHECKOUT"])).'</td></tr>
								<tr><td>Number of Rooms</td><td> : </td><td>'.$numOfRoom.'</td></tr>
								<tr><td>Number of Traveler</td><td> : </td><td>'.$numOfTraveler.'</td></tr>
								'.$discount.'
								<tr><td colspan="3" style="border-top: 1px dotted #CCCCCC; height: 1px;"></td></tr>
								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>'.$tpl_data["TOTAL_FEE"].' USD</b></td></tr>
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							B. Room Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table cellpadding="4" cellspacing="0" border="0" style="border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;">
								<tr>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Room</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Name</th>
								</tr>
								'.$room_tr_lines.'
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							C. Traveler Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table cellpadding="4" cellspacing="0" border="0" style="border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;">
								<tr>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Traveler</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Fullname</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Gender</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Date of Birth</th>
									<th style="background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;">Nationality</th>
								</tr>
								'.$pax_tr_lines.'
							</table>
						</div>
					</div>
					<div>
						<div style="color: #005286;font-weight: bold;padding: 10px 0 10px 20px;">
							D. Contact Information
						</div>
						<div style="padding: 0 0 10px 40px;">
							<table>
								<tr><td>Email</td><td> : </td><td><a href="mailto:'.$tpl_data["EMAIL"].'">'.$tpl_data["EMAIL"].'</a></td></tr>
								<tr><td>Phone No.</td><td> : </td><td><a href="tel:'.$tpl_data["PHONE"].'">'.$tpl_data["PHONE"].'</a></td></tr>
								<tr><td>Additional Requirements</td><td> : </td><td>'.$tpl_data["MESSAGE"].'</td></tr>
								[REQUEST-IP]
							</table>
						</div>
					</div>
				</fieldset>';
	}

	function hotel_payment_successful($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* Payment successful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>
					</table>
					<br>'.$this->hotel_info($tpl_data);
		return $this->template($content);
	}
	
	function hotel_payment_failure($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* This is confirmation from us to show that you was not successful to booking our services in this case. Because you can not settle the payment with our system. May your credit card issue some where and you are way from there. Or some reason for security. So you can chose paypal method for this case. It may help you better.</td></tr>
						<tr><td>* Payment unsuccessful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</td></tr>
						<tr><td>* Or we will send you the Payment Request in 1-2 hours with multiple Methods of Payment. You can chose and pay us for your booking. Hope this more convenience for you.</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>
					</table>
					<br>'.$this->hotel_info($tpl_data);
		return $this->template($content);
	}
	
	function hotel_payment_remind($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for choosing <a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a>.</td></tr>
						'.$this->vip_info($tpl_data).'
						<tr><td>* This is confirmation from us to show that we are reviewing your request for arranging hotel in Vietnam. But you have not paid yet. Our staff will send you payment request for your booking in 1 - 2 hours.</td></tr>
						<tr><td>* Payment method: <b>'.$tpl_data["PAYMENT_METHOD"].'</b></td></tr>
						<tr><td>* You can pay us via Paypal address: '.MAIL_PAYMENT.'</td></tr>
						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>
						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>
					</table>
					<br>'.$this->hotel_info($tpl_data);
		
		return $this->template($content);
	}
	
	function payment_online_info($tpl_data)
	{
		return '<fieldset style="border:1px solid #DADCE0;">
					<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Payment Details</strong></legend>
					<div>
						<div style="padding: 10 0 10px 20px;">
							<table>
								<tr><td>Full Name</td><td> : </td><td>'.$tpl_data["FULLNAME"].'</td></tr>
								<tr><td>Email</td><td> : </td><td><a href="mailto:'.$tpl_data["PRIMARY_EMAIL"].'">'.$tpl_data["PRIMARY_EMAIL"].'</a></td></tr>
								<tr><td>Pay for</td><td> : </td><td>'.$tpl_data["PAY_FOR"].'</td></tr>
								<tr><td>Amount</td><td> : </td><td>'.$tpl_data["AMOUNT"].' USD</td></tr>
								<tr><td>Note for Payment</td><td> : </td><td>'.$tpl_data["NOT_4_PAYMENT"].'</td></tr>
								[REQUEST-IP]
							</table>
						</div>
					</div>
				</fieldset>';
	}

	function payment_online_successful($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for booking with us!.</td></tr>
						<tr><td>* This is confirmation from us to show that you are successful in payment online. We will have double check and send you a letter later.</td></tr>
						<tr><td>* Payment successful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</td></tr>
						<tr><td>* Total amount for service charge: <b>'.$tpl_data["AMOUNT"].'</b> USD.</td></tr>
					</table>
					<br>'.$this->payment_online_info($tpl_data);
		return $this->template($content);
	}
	
	function payment_online_failure($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for booking with us!.</td></tr>
						<tr><td>* This is confirmation from us to show that you was not successful in payment online. Because you can not settle the payment with our system. May your credit card issue some where and you are way from there. Or some reasons for security.</td></tr>
						<tr><td>* Payment unsuccessful via <b>'.$tpl_data["PAYMENT_METHOD"].'</b> payment gate.</td></tr>
						<tr><td>* If you wish to pay via Paypal, You can pay us directly to account: '.MAIL_PAYMENT.'</td></tr>
						<tr><td>* Total amount for service charge: <b>'.$tpl_data["AMOUNT"].'</b> USD.</td></tr>
					</table>
					<br>'.$this->payment_online_info($tpl_data);
		return $this->template($content);
	}
	
	function payment_online_remind($tpl_data)
	{
		$content = '<table cellpadding="4" cellspacing="0" border="0">
						<tr><td>Dear: <b>'.$tpl_data["FULLNAME"].'</b></td></tr>
						<tr><td>Thanks for booking with us!.</td></tr>
						<tr><td>* This is confirmation from us to show that you are making new payment online with us.</td></tr>
						<tr><td>* Payment method: <b>'.$tpl_data["PAYMENT_METHOD"].'</b></td></tr>
						<tr><td>* Total amount for service charge: <b>'.$tpl_data["AMOUNT"].'</b> USD</td></tr>
						<tr><td>* You can pay us via Paypal address: '.MAIL_PAYMENT.'</td></tr>
						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com (Please do not send us your credit cards detail)</td></tr>
					</table>
					<br>'.$this->payment_online_info($tpl_data);
		return $this->template($content);
	}
	
	function need_support($tpl_data)
	{
		$content = '<fieldset style="border:1px solid #DADCE0;">
						<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Request Support Details</strong></legend>
						<div>
							<div style="padding: 10 0 10px 20px;">
								<table>
									<tr><td>Primary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["PRIMARY_EMAIL"].'">'.$tpl_data["PRIMARY_EMAIL"].'</a></td></tr>
									<tr><td>Secondary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["SECONDARY_EMAIL"].'">'.$tpl_data["SECONDARY_EMAIL"].'</a></td></tr>
									<tr><td>Full Name</td><td> : </td><td>'.$tpl_data["FULLNAME"].'</td></tr>
									<tr><td>Hotel Booking</td><td> : </td><td>'.$tpl_data["HOTEL_BOOKING"].'</td></tr>
									<tr><td>Optional Tours</td><td> : </td><td>'.$tpl_data["OPTIONAL_TOUR"].'</td></tr>
									<tr><td>Domestic Flights</td><td> : </td><td>'.$tpl_data["DOMESTIC_FLIGHT"].'</td></tr>
								</table>
							</div>
						</div>
					</fieldset>';
		return $this->template($content);
	}
	
	function check_status($tpl_data)
	{
		$content = '<fieldset style="border:1px solid #DADCE0;">
						<legend style="border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px"><strong>Request Support Details</strong></legend>
						<div>
							<div style="padding: 10 0 10px 20px;">
								<table>
									<tr><td>Primary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["PRIMARY_EMAIL"].'">'.$tpl_data["PRIMARY_EMAIL"].'</a></td></tr>
									<tr><td>Secondary Email</td><td> : </td><td><a href="mailto:'.$tpl_data["SECONDARY_EMAIL"].'">'.$tpl_data["SECONDARY_EMAIL"].'</a></td></tr>
									<tr><td>Full Name</td><td> : </td><td>'.$tpl_data["FULLNAME"].'</td></tr>
									<tr><td>Passport</td><td> : </td><td>'.$tpl_data["PASSPORT"].'</td></tr>
									<tr><td>Message</td><td> : </td><td>'.$tpl_data["MESSAGE"].'</td></tr>
								</table>
							</div>
						</div>
					</fieldset>';
		return $this->template($content);
	}
	
	function ticket($tpl_data)
	{
		$content = '<div>
						<div style="padding: 10 0 10px 20px;">
							<table>';
		
		if (!empty($tpl_data->department)) {
			$content .= '<tr><td>To</td><td> : </td><td>'.$tpl_data->department.'</td>';
		}
		if (!empty($tpl_data->category)) {
			$content .= '<tr><td>Category</td><td> : </td><td>'.$tpl_data->category.'</td>';
		}
		if (!empty($tpl_data->fullname)) {
			$content .= '<tr><td>Full Name</td><td> : </td><td>'.$tpl_data->fullname.'</td>';
		}
		if (!empty($tpl_data->email)) {
			$content .= '<tr><td>Email</td><td> : </td><td>'.$tpl_data->email.'</td>';
		}
		if (!empty($tpl_data->phone)) {
			$content .= '<tr><td>Phone Number</td><td> : </td><td>'.$tpl_data->phone.'</td>';
		}
		if (!empty($tpl_data->application)) {
			$content .= '<tr><td>Application ID</td><td> : </td><td>#'.$tpl_data->application.'</td>';
		}
		if (!empty($tpl_data->expiration_date)) {
			$content .= '<tr><td>Expiration Date</td><td> : </td><td>'.$tpl_data->expiration_date.'</td>';
		}
		if (!empty($tpl_data->arrival_date)) {
			$content .= '<tr><td>Arrival Date</td><td> : </td><td>'.$tpl_data->arrival_date.'</td>';
		}
		if (!empty($tpl_data->arrival_time)) {
			$content .= '<tr><td>Arrival Time</td><td> : </td><td>'.$tpl_data->arrival_time.'</td>';
		}
		if (!empty($tpl_data->airport)) {
			$content .= '<tr><td>Airport</td><td> : </td><td>'.$tpl_data->airport.'</td>';
		}
		if (!empty($tpl_data->flight_number)) {
			$content .= '<tr><td>Flight Number</td><td> : </td><td>'.$tpl_data->flight_number.'</td>';
		}
		if (!empty($tpl_data->checkin_date)) {
			$content .= '<tr><td>Check-in Date</td><td> : </td><td>'.$tpl_data->checkin_date.' '.$tpl_data->checkin_time.'</td>';
		}
		if (!empty($tpl_data->checkout_date)) {
			$content .= '<tr><td>Check-out Date</td><td> : </td><td>'.$tpl_data->checkout_date.' '.$tpl_data->checkout_time.'</td>';
		}
		if (!empty($tpl_data->rooms)) {
			$content .= '<tr><td>Number of Rooms</td><td> : </td><td>'.$tpl_data->rooms.'</td>';
		}
		if (!empty($tpl_data->travellers)) {
			$content .= '<tr><td>Travellers</td><td> : </td><td>'.$tpl_data->travellers.'</td>';
		}
		if (!empty($tpl_data->budget)) {
			$content .= '<tr><td>Budget</td><td> : </td><td>'.$tpl_data->budget.' USD</td>';
		}
		if (!empty($tpl_data->star)) {
			$content .= '<tr><td>Star</td><td> : </td><td>'.$tpl_data->star.' star(s)</td>';
		}
		if (!empty($tpl_data->city)) {
			$content .= '<tr><td>City</td><td> : </td><td>'.$tpl_data->city.'</td>';
		}
		if (!empty($tpl_data->hotel_name)) {
			$content .= '<tr><td>Hotel Name</td><td> : </td><td>'.$tpl_data->hotel_name.'</td>';
		}
		if (!empty($tpl_data->departure_date)) {
			$content .= '<tr><td>Departure Date</td><td> : </td><td>'.$tpl_data->departure_date.'</td>';
		}
		if (!empty($tpl_data->from_city)) {
			$content .= '<tr><td>From City</td><td> : </td><td>'.$tpl_data->from_city.'</td>';
		}
		if (!empty($tpl_data->to_city)) {
			$content .= '<tr><td>To City</td><td> : </td><td>'.$tpl_data->to_city.'</td>';
		}
		if (!empty($tpl_data->direction)) {
			$content .= '<tr><td>Flight Direction</td><td> : </td><td>'.$tpl_data->direction.'</td>';
		}
		if (!empty($tpl_data->airway)) {
			$content .= '<tr><td>Airway</td><td> : </td><td>'.$tpl_data->airway.'</td>';
		}
		if (!empty($tpl_data->class_type)) {
			$content .= '<tr><td>Class</td><td> : </td><td>'.$tpl_data->class_type.'</td>';
		}
		if (!empty($tpl_data->tour_type)) {
			$content .= '<tr><td>Type of Tour</td><td> : </td><td>'.$tpl_data->tour_type.'</td>';
		}
		if (!empty($tpl_data->departure_from)) {
			$content .= '<tr><td>Departure From</td><td> : </td><td>'.$tpl_data->departure_from.'</td>';
		}
		if (!empty($tpl_data->duration)) {
			$content .= '<tr><td>Duration</td><td> : </td><td>'.$tpl_data->duration.'</td>';
		}
		if (!empty($tpl_data->needhotel)) {
			$content .= '<tr><td>Need hotel</td><td> : </td><td>'.$tpl_data->needhotel.'</td>';
		}
		if (!empty($tpl_data->message)) {
			$content .= '<tr><td>Message</td><td> : </td><td>'.str_ireplace('\n', '<br/>',$tpl_data->message).'</td>';
		}
		
		$content .= '		</table>
						</div>
					</div>';
		
		return $this->blank_template($content);
	}
	
	function forgot_password($tpl_data)
	{
		$content = '<div>
						<p>Dear <b>'.$tpl_data["FULLNAME"].'</b>,</p>
						<br>
						<p>We have received forgot password request for your account.</p>
						<p>Please return to the <a href="'.BASE_URL.'">'.SITE_NAME.'</a> website and log in using the following information:</p>
						<p>Email:  '.$tpl_data["EMAIL"].'</p>
						<p>Password:  '.$tpl_data["PASSWORD"].'</p>
						<br>
						<p>Please do not hesitate to contact us if you have any ideas!</p>
						<br>
						<p>Best regards,</p>
						<p><b>Vietnam Visa Dept.</b></p>
					</div>';
		return $content;
	}
	
	function tour_request($tpl_data)
	{
		$requests = "";
		if (!empty($tpl_data["fullname"])) {
			$requests .= '<tr>
							<td>
								<p><em>Name</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['fullname'].'</p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["email"])) {
			$requests .= '<tr>
							<td>
								<p><em>Email</em>:</p>
							</td>
							<td>
								<p><a href="mailto:'.$tpl_data['email'].'">'.$tpl_data['email'].'</a></p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["phone"])) {
			$requests .= '<tr>
							<td>
								<p><em>Phone number</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['phone'].'</p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["fromdate"])) {
			$requests .= '<tr>
							<td>
								<p><em>From date</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['fromdate'].'</p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["todate"])) {
			$requests .= '<tr>
							<td>
								<p><em>To date</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['todate'].'</p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["adults"])) {
			$requests .= '<tr>
							<td>
								<p><em>Adults</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['adults'].'</p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["children"])) {
			$requests .= '<tr>
							<td>
								<p><em>Children</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['children'].'</p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["infants"])) {
			$requests .= '<tr>
							<td>
								<p><em>Babies</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['infants'].'</p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["destinations"])) {
			$requests .= '<tr>
							<td>
								<p><em>Destinations</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['destinations'].'</p>
							</td>
						</tr>';
		}
		if (!empty($tpl_data["uri"])) {
			$requests .= '<tr>
							<td>
								<p><em>Reference</em>:</p>
							</td>
							<td>
								<p>'.$tpl_data['uri'].'</p>
							</td>
						</tr>';
		}
		return '<p><strong>Contactform applicant:</strong></p>
				<table border="0" cellpadding="0">
					<tbody>
						'.$requests.'
						[REQUEST-IP]
					</tbody>
				</table>
				<p><br /> <strong>Message:</strong><br /> '.$tpl_data['message'].'</p>';
	}
	
	function report($tpl_data)
	{
		$content = '<div>
						<div style="padding: 10 0 10px 20px;">
							<table>';
		
		if (!empty($tpl_data->item_name)) {
			$content .= '<tr><td>Name</td><td> : </td><td>'.$tpl_data->item_name.'</td>';
		}
		if (!empty($tpl_data->description)) {
			$content .= '<tr><td>Description</td><td> : </td><td>'.$tpl_data->description.'</td>';
		}
		if (!empty($tpl_data->photos)) {
			$content .= '<tr><td>Photos</td><td> : </td><td>'.$tpl_data->photos.'</td>';
		}
		if (!empty($tpl_data->maps)) {
			$content .= '<tr><td>Maps</td><td> : </td><td>'.$tpl_data->maps.'</td>';
		}
		if (!empty($tpl_data->message)) {
			$content .= '<tr><td>Other</td><td> : </td><td>'.$tpl_data->message.'</td>';
		}
		
		$content .= '		</table>
						</div>
					</div>';
		
		return $this->blank_template($content);
	}

	function reset_password($email,$fullname,$link)
	{
		$content = "<p>Hi ".$fullname.",</p><p>You are receiving this e-mail because a request has been made to change 
		the travelovietnam.com password associated with this address (".$email."). 
		If you would like to reset the password for this account simply click on the link below 
		or paste it into the url field on your favorite browser:</p>
		<a href='".$link."'>".$link."</a>
		<p>If you didnt request this email then you can just ignore it -- your details have not been disclosed to anyone.
		If you have any questions about the system, feel free to contact us anytime at ".MAIL_SUPPORT.".</p>";

		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
				<html xml:lang="EN" xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					</head>
					<body style="font-family: Arial,Tahoma,sans-serif; font-size: 12px;">
						<div style="border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;">
							<div style="padding: 0px 0px 10px 0px;">
								'.$content.'
							</div>
							<div style="padding: 15px 10px 0px 0px;">
								<table>
									<tr><td colspan="3"><b>Vietnam Travel Dept.</b></td></tr>
									<tr><td>Address</td><td>:</td><td>'.ADDRESS.'</td></tr>
									<tr><td>Tell</td><td>:</td><td>'.TELL.'</td></tr>
									<tr><td>Hotline</td><td>:</td><td>'.HOTLINE.'</td></tr>
									<tr><td>Website</td><td>:</td><td><a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a></td></tr>
									<tr><td>Email</td><td>:</td><td><a href="mailto:'.MAIL_INFO.'" target="_blank">'.MAIL_INFO.'</a></td></tr>
									<tr><td colspan="3">WE ALWAYS SUPPORT YOU 24/7</td></tr>
								</table>
							</div>
						</div>
					<body>
				</html>';
	}


	function register_successful($tpl_data){
		$loginInfo = "";
		if (isset($tpl_data['PROVIDER'])) {
			$loginInfo = '<p>Login using your registered '.ucfirst($tpl_data['PROVIDER']).' account.</p>';
		}else{
			$loginInfo ='<ul><li>Your username is: '.$tpl_data["RECEIVER"].'</li>
						 <li>Passwords: '.$tpl_data["PASSWORD"].'</li></ul>';
		}
		$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
		</head>
		<body style="font-family:Arial,Tahoma,sans-serif; width:648px" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix">

		<table id="topNav" class="wrap" width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" 
		style="color: #000;font-size: 14px;line-height: 20px;-webkit-font-smoothing: antialiased;
		font-smoothing: antialiased;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;
		width: 100%;margin: 0 auto;text-align:left;">
			<tbody>
				<tr valign="top">
					<td valign="top" class="wrapInner" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;
						padding: 0px 0;">
						<table style="margin-top:10px" width="648" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr align="center" valign="top">
								<td style="border:1px solid #CCC;border-radius: 0px 20px 0px 0px;
								-moz-border-radius: 0px 20px 0px 0px;-webkit-border-radius: 0px 20px 0px 0px;">
									<p style="font-family:impact,Arial;font-size:30px;font-style:italic;text-align:right;color:#4d4d4d;padding-right:26px;margin:15px 10px">LOGIN ACCOUNT</p>
								</td>
							</tr>
							<tr>
								<td style="font-size:14px;color:#fff;text-transform: uppercase;background-color:#0178b3;padding:8px 26px;border-radius: 0px 0px 0px 20px;
								-moz-border-radius: 0px 0px 0px 20px;
								-webkit-border-radius: 0px 0px 0px 20px;"><h1 style="font-size:16px;color:#fff;font-weight:bold">Welcome TO WWW.TRAVELOVIETNAM.COM !</h1>
								</td>
							</tr>		  
							<tr valign="top">
								<td style="padding:0 26px;">
									<p style="margin:15px 0">Dear '.$tpl_data["FULLNAME"].',</p>
									<p style="margin-bottom:20px; line-height:20px">Welcome to the TraveloVietnam.Com family! We know you have a lot of choices but we can\'t tell you how happy 
									we are that you\'ve chosen TraveloVietnam.Com as your registrar and web travel company. 
									Below we\'ve highlighted a few key things you should know about your account at TraveloVietnam.Com:</p>
									<p style="margin-bottom:10px"><strong>LOG IN</strong></p>
									<p>  You can <a href="'.BASE_URL.'/member/login">click here</a></span> to access your account. 
									If it doesn’t work, you can also cut and paste the link into your browse directly: <a href="'.BASE_URL.'/member/login">http://www.travelovietnam.com/member/login.html</a></p>
									'.$loginInfo.'
									<p><strong>GETTING STARTED WITH SERVICES WE OFFER:</strong></p>
									<ul>
										<li> <a href="#">Vietnam Tours</a></li>
										<li><a href="'.BASE_URL.'/hotels">Vietnam Hotels</a></li>
										<li> <a href="http://www.vietnam-evisa.org/">Vietnam Visa Online</a></li>
										<li> <a href="'.BASE_URL.'/flights">Vietnam Flights</a></li>
										<li> <a href="'.BASE_URL.'/vietnam/top-destinations">Top Destination in Vietnam</a></li>
									</ul>
			  						<hr style="border-top:0.1em solid #003cff"   />		  
			  						<table width="0" border="0" style="margin-top:-10px;">
			  							<tr align="left" valign="top">
											<td style="padding-right:40px;">
												<p style="font-size:14px;font-weight:bold">Best regards</p>
					  							<p style="font-size:18px;text-transform: uppercase;">
					  								<strong><span style="color:#008dd3">Administrator</span></strong>
					  							</p>
					  							<p>
					  								<img style="border:none;outline:none;" src="'.BASE_URL.IMG_URL.'travelovietnam.png" width="185" height="57" />
					  							</p>
				  							</td>
											<td>
												<p style="font-size:13px;font-weight:bold">
													Address: 184/1A Le Van Sy Street, Ward 10, Phu Nhuan Dist, Ho Chi Minh, Vietnam<br />
						  							Tel : (+84) 866.757.124<br />
													Hotline: <span style="color:#ff0000">(+84) 909.343.525</span><br />
													Email:  <a href="mailto:'.MAIL_INFO.'">'.MAIL_INFO.'</a><br />
												</p>
					  							<p style="font-size:10px;font-style:italic;color:#666">
						  							We love your feedback and read every word to improve services! 
						  							Please feel free to tell us how our support are at  <a href="mailto:'.MAIL_INFO.'">'.MAIL_INFO.'</a> 
						  							or call <span style="color:#ff0000">(+84) 909.343.525</span> 
					  							</p>
				  							</td>
			  							</tr>
									</table>
			  					</td>		  
			  				</tr>		  
			  				<tr style="background-color:#0178b3; margin-top:10px">
								<td style="padding:5px 26px;">
				  					<h1 style="margin: 0px !important;font-size:16px;color:#ffffff;line-height: 30px;text-transform:uppercase;font-weight:bold">
				 						Travelovietnam Account
				 					</h1>
				  				</td>
				  			</tr>
							<tr>
								<td style="background-color:#ffffff;border:1px solid #ccc; padding:10px 26px;">
				  					<p style="font-size:11px;color:#686868;">
				  					© 2008 TraveloVietnam Company Ltd. registered trademarks of  Vietnam National Administration Of Tourism.<br />
									If you would like to update your email address please<a href="'.BASE_URL.'/member/myprofile"> click here.</a><br />
									If you forgot login information, please <a href="'.BASE_URL.'/member/forgotpassword">click here</a> to reset account and receive the other login info.<br />
									Internet Marketing, <a href="'.BASE_URL.'">subscribe here</a> to receive a discount and promotion program when they’re available.
									</p>
								</td>
				  			</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		</body>
		</html>';
		return $content;
	}

	function blog_comment($tpl_data)
	{
		$content = '<p style="font-size: 14px">Hi <b style="font-size: 14px">Admin</b>,</p>
					<p style="margin-top:10px;font-size: 14px">This mail is sent to inform you that we have an incomming comment on a blog\'s post from a custommer</p>
					<p style="font-size: 14px"> Please be informed to approve this comment below</p><br/>
					<p><b>Blog\'s post link</b> : '.$tpl_data['link'].'</p>
					<p><b>Comment link</b> : '.site_url("administrator/edit_blog_comment/{$tpl_data['CMT_ID']}").'</p>';


		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
				<html xml:lang="EN" xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					</head>
					<body style="font-family: Arial,Tahoma,sans-serif; font-size: 12px;">
						<div style="border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;">
							<div style="padding: 0px 0px 10px 0px;">
								'.$content.'
							</div>
							<div style="padding: 15px 10px 0px 0px;">
								<table>
									<tr><td colspan="3"><b>Vietnam Travel Dept.</b></td></tr>
									<tr><td>Address</td><td>:</td><td>'.ADDRESS.'</td></tr>
									<tr><td>Tell</td><td>:</td><td>'.TELL.'</td></tr>
									<tr><td>Hotline</td><td>:</td><td>'.HOTLINE.'</td></tr>
									<tr><td>Website</td><td>:</td><td><a href="'.BASE_URL.'" target="_blank">'.SITE_NAME.'</a></td></tr>
									<tr><td>Email</td><td>:</td><td><a href="mailto:'.MAIL_INFO.'" target="_blank">'.MAIL_INFO.'</a></td></tr>
									<tr><td colspan="3">WE ALWAYS SUPPORT YOU 24/7</td></tr>
								</table>
							</div>
						</div>
					<body>
				</html>';
	}
}