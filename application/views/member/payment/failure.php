<?php 
$adults = (substr("0".$booking->adults, -2))." Adult".(($booking->adults>1)? "s": "");
$children = ($booking->children>0)?(' + '.(substr("0".$booking->children, -2)).' Children'):'';
$infants = ($booking->infants>0)?(' + '.(substr("0".$booking->infants, -2)).(($tpl_data['INFANTS']>1)? " Infants": " Infant")):'';
?>
<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Vietnam Tours" href="<?=BASE_URL.'/tours'?>">Vietnam Tours</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Home" href="<?=BASE_URL?>/tours/search">Tour Search</a>		
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Home" href="<?=BASE_URL.'/tours/vietnam/'.$tour->city_alias.'/'.$tour->category_alias.'/'.$tour->alias?>"><?=$tour->name?></a>
		<img alt="" src="<?=IMG_URL?>arrow.png">Booking
	</div>
	<h1 class="page-title">PAYMENT FAILURE</h1>
	<div id="inquiry-successful">
		<div class="view-content">
			<div class="detail">
				<div>
					<p>
						Warmest greeting from <a href="<?=BASE_URL?>">www.travelovietnam.com</a> !
					</p>
					<p style="font-size:14px;">
						Thank you for booking your tour with us. Kindly confirm you that we have not 
						received your payment on time and we suggest you to double check if:
					</p>
					<ul style="list-style-type: disc; margin-left: 20px; margin-bottom:10px;">
						<li><span>You cancelled the payment.</span></li>
						<li><span>Your bank did not approved your payment.</span></li>
						<li><span>You stopped while it was processing.</span></li>
						<li><span>Your information is incorrect while filling the credit card information.</span></li>
					</ul>
					<p style="font-size:14px;">
						You might want to <a href="<?=BASE_URL.'/member/payment/'.$booking->id?>">click here</a> to process your payment again now and all payment must 
						be made prior 20 days prior to departure to secure your 
						booking. Any tour amendment should be made 14 days prior to departure to avoid unwanted fee.
					</p>
					<h2 style="font-size: 16px;margin-top: 25px;">SUMMARY OF YOUR TOUR INQUIRY</h2>
					<hr>
					<table class="info">
						<tr><td>Tour Name</td><td width="15">:</td><td><b><?=$tour->name?></b></td></tr>
						<tr><td>Tour Code</td><td>:</td><td><?=$tour->code?></td></tr>
						<tr><td>Duration</td><td>:</td><td><?=($tour->duration > 1) ? $tour->duration." days - ".($tour->duration-1)." nights" : $tour->duration." day"?> </td></tr>
						<tr><td>Start date</td><td>:</td><td><?=date('d M, Y', strtotime($booking->departure_date))?></td></tr>
						<tr><td>End date</td><td>:</td><td><?=($tour->daily && $tour->duration==1)? date('d M, Y', strtotime($booking->departure_date)) : date('d M, Y', strtotime($booking->departure_date.'+'.$tour->duration.'days'))?></td></tr>
						<tr><td>Group size</td><td>:</td><td><?=$adults.$children.$infants?></td></tr>
						<tr><td>Total cost</td><td>:</td><td><b>$<?=number_format($booking->total_fee,2)?> USD</b></td></tr>
						<tr><td>Payment</td><td>:</td><td><b>Failure</b></td></tr>				
					</table><!-- end #info -->
					<hr>
					<div id="try-again">
						<a id="btnTryAgain" href="<?=BASE_URL.'/member/payment/'.$booking->id?>">TRY AGAIN</a>
					</div>
					<p>Should you have any further request, please feel free to contact us at your 
						convenience.We look forward to welcoming you to Vietnam.<br/>
						Thank you for choosing TraveloVietnam to help you!
					</p>
					<hr style="background-color: #009daf;border:0;height: 1px;"   />
					<h1>TRAVELOVIETNAM COMPANY</h1>     
					<table width="550" border="0" style="margin-top:-10px;">
						<tr align="left" valign="top">
							<td>
								<p>
									<b>Head Office</b>: 184/1A Le Van Sy, Ward 10, Phu Nhuan Distr., Ho Chi Minh, Vietnam<br />
									<b>Telephone :</b> (+84) 866.757.124<br />
									<b>Toll-Free:</b> <?=TOLL_FREE?><br/>
									<b>Email:</b>  <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a><br />
								</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
