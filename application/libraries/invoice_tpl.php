<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_Tpl {

	public function invoice_template($tpl_data)
	{
		$discount = 0;
		$tour = $tpl_data['TOUR'];
		$booking = $tpl_data['BOOKING'];
		$groupsize = $booking->adults+$booking->children+$booking->infants;
		$adultTotalAmount = number_format($booking->adults*$booking->tour_rate,2,'.',',');
		$chidrenTotalAmount =number_format(round($booking->children*($booking->tour_rate * 0.7)),2,'.',',');
		$supTotalAmount = number_format($booking->supplements*$booking->supplement_rate,2,'.',',');
		$subTotal = number_format($booking->total_fee-($booking->total_fee*$discount),2,'.',',');
		$children = $infants = $supplements = '';
		if($booking->children>0){
			$children = '<tr>
						<td align="center">2</td>
						<td>Chidren</td>
						<td align="right">$'.number_format(round($booking->tour_rate * 0.7),2,'.',',').'</td>
						<td align="center">'.$booking->children.'</td>
						<td align="right">$'.$chidrenTotalAmount.'</td>
					</tr>';
		}

		if ($booking->infants>0) {
			$infants = '<tr>
						<td align="center">3</td>
						<td>Infants</td>
						<td align="right">$0.00</td>
						<td align="center">'.$booking->infants.'</td>
						<td align="right">$0.00</td>
					</tr>';
		}

		if ($booking->supplements>0) {
			$supplements = '<tr>
						<td align="center">4</td>
						<td>Supplement</td>
						<td align="right">$'.number_format($booking->supplement_rate,2,'.',',').'</td>
						<td align="center">'.$booking->supplements.'</td>
						<td align="right">$'.$supTotalAmount.'</td>
					</tr>';
		}
		
		$tourClass = '';
		if (!empty($booking->classtype)) {
			$tourClass = '<tr>
						<td align="right" style="font-weight:bold">Tour Class:</td>
						<td style="padding-left:15px">'.$booking->classtype.'</td>
						</tr>';
		}
		
		return '
		<html>
			<head>
				<style type="text/css">
					table#info tr td{
						border: 1px solid #b2b2b2;
					}
					table{
						border-collapse:collapse;
					}
					
				</style>
			</head>
			<body style="font-family: Arial; font-size: 12px">
				<table cellpadding="10" width="100%" border="0" style="padding-top:15px;">
					<tr>
						<td valign="middle" style="padding-right:20px;vertical-align:middle;;width:260px">
							<div style="width:100%;height:50px;display:block;"></div>
							<img align="middle" style="border:none;outline:none;padding-top:100px;" src="'.IMG_URL.'/travelo.jpg" />
						</td>
						<td style="width:450px">
							<h4 style="font-size:14px;color:#0077b3;font-weight:bold;">TRAVELOVIETNAM COMPANY LTD.</h4>
							<table cellpadding="4">
								<tr><td><b style="font-size:11px;">Address:</b><span style="font-size:11px;"> 184/1A Le Van Sy, Ward 10, Phu Nhuan Dist, Ho Chi Minh</span></td></tr>
								<tr><td><b style="font-size:11px;">Phone:</b><span style="font-size:11px;"> (+84) 866.757.124 - <b>Toll free:</b> 1-800-605-3168</span></td></tr>
								<tr><td><b style="font-size:11px;">Email:</b><span style="font-size:11px;"> '.MAIL_INFO.'</span></td></tr>
								<tr><td><b style="font-size:11px;">Website:</b><span style="font-size:11px;"> '.SITE_NAME.'</span></td></tr>
							</table>
						</td>
					</tr>
				</table>
				<h1>INVOICE</h1>
				<table width="640" style="font-size:12px;">
					<tr>
						<td width="320">
							<table cellpadding="4" width="100%">
								<tr> 
									<td width="105" style="font-weight:bold;">Invoice No.</td>
									<td width="215">T'.$booking->id.'</td>
								</tr>
								<tr>
									<td height="20" style="font-weight:bold">Invoice Date</td>
									<td>'.date('F d, Y', strtotime($booking->booking_date)).'</td>
								</tr>
								<tr>
									<td height="20" style="font-weight:bold">Bill To</td>
									<td>'.$booking->title.'. '.$booking->fullname.'</td>
								</tr>
								<tr>
									<td height="20" style="font-weight:bold">E-mail</td>
									<td>'.$booking->email.'</td>
								</tr>
								<tr>
									<td height="20" style="font-weight:bold">Phone</td>
									<td>'.$booking->phone.'</td>
								</tr>
							</table>
						</td>

						<td width="320">
							<table cellpadding="4" width="100%">
								<tr>
									<td width="180" align="right" style="font-weight:bold">Tour Code:</td>
									<td width="140" style="padding-left:15px">'.$tour->code.'</td>
								</tr>
								'.$tourClass.'
								<tr>
									<td align="right" style="font-weight:bold">Departure Date:</td>
									<td style="padding-left:15px">'.date('F d, Y', strtotime($tpl_data["DEPARTURE_DATE"])).'</td>
								</tr>
								<tr>
									<td align="right" style="font-weight:bold">Group size:</td>
									<td style="padding-left:15px">'.$groupsize.'</td>
								</tr>
								<tr>
									<td align="right" style="font-weight:bold">Deposit Received:</td>
									<td style="padding-left:15px">$'.number_format($booking->paid,2).'</td>
								</tr>
								<tr>
									<td align="right" style="font-weight:bold">Invoice total:</td>
									<td style="padding-left:15px">$'.number_format($booking->total_fee,2).'</td>
								</tr>
								<tr>
									<td align="right" style="font-weight:bold">Total Amount Due:</td>
									<td style="padding-left:15px">$'.number_format($booking->total_fee-$booking->paid,2).'</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div style="margin: 15px 0px; display:block"></div>
				<table id="info" cellpadding="8" width="640">
					<tr style="font-weight:bold;">
						<td width="40" align="center">No.</td>
						<td width="320">Description</td>
						<td width="110" align="center">Cost Per Pax</td>
						<td width="85" align="center">Quantity</td>
						<td width="120" align="right">Total Amount</td>
					</tr>
					<tr>
						<td align="center">1</td>
						<td>Adults</td>
						<td align="right">$'.number_format($booking->tour_rate,2,'.',',').'</td>
						<td align="center">'.$booking->adults.'</td>
						<td align="right">$'.$adultTotalAmount.'</td>
					</tr>
					'.$children.'
					'.$infants.'
					'.$supplements.'
					<tr>
						<td colspan="3" style="border:none;"></td>
						<td style="text-align:right;font-weight:bold;border:none;">Subtotal</td>
						<td style="text-align:right;font-weight:bold;color:#dc0000;border:none">$'.$subTotal.'</td>
					</tr>
					<tr>
						<td colspan="3" style="border:none;"></td>
						<td style="text-align:right;font-weight:bold;border:none;border-bottom:2px solid #000;">Discount</td>
						<td style="text-align:right;font-weight:bold;color:#dc0000;border:none;border-bottom:2px solid #000;">'.number_format($discount*100,1,'.',',').'%</td>
					</tr>
					<tr>
						<td colspan="3" style="border:none;"></td>
						<td style="text-align:right;font-weight:bold;border:none;">Total</td>
						<td style="text-align:right;font-weight:bold;color:#dc0000;border:none;">$'.number_format($booking->total_fee,2).'</td>
					</tr>
					<tr>
						<td colspan="2" style="border:none;"></td>
						<td colspan="2" style="font-size:10px;font-style:italic; line-height:25px;text-align:right;border:none;">( Included VAT & Service Charges )</td>
						<td style="border:none;"></td>
					</tr>
				</table>
			</body>
		</html>
		';
	} 
}