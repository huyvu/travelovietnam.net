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
	<h1 class="page-title">INQUIRY SUCCESSFULLY !</h1>
	<div id="inquiry-successful">
		<div class="view-content">
			<div class="detail">
				<div>
					<h3>
						Thank you for booking with TraveloVietnam!
					</h3>
					<p style="font-size:14px;">
						Kindly inform you that your tour inquiry has been received and your personal 
						travel consultant will contact you shortly for further assistance. Please check 
						your summary of your tour inquiry bellow:
					</p>
					<hr>
					<table class="info">
						<tr><td>Tour Name</td><td width="15">:</td><td><b><?=$tour->name?></b></td></tr>
						<tr><td>Tour Code</td><td>:</td><td><?=$tour->code?></td></tr>
						<tr><td>Duration</td><td>:</td><td><?=($tour->duration > 1) ? $tour->duration." days - ".($tour->duration-1)." nights" : $tour->duration." day"?> </td></tr>
						<tr><td>Start date</td><td>:</td><td><?=date('d M, Y', strtotime($booking->departure_date))?></td></tr>
						<tr><td>End date</td><td>:</td><td><?=($tour->daily && $tour->duration==1)? date('d M, Y', strtotime($booking->departure_date)) : date('d M, Y', strtotime($booking->departure_date.'+'.$tour->duration.'days'))?></td></tr>
						<tr><td>Group size</td><td>:</td><td><?=$adults.$children.$infants?></td></tr>
						<tr><td>Total cost</td><td>:</td><td><b>$ <?=number_format($booking->total_fee,2)?> USD</b></td></tr>
						<tr><td>Payment</td><td>:</td><td><b><?=$booking->payment_option?></b></td></tr>				
					</table><!-- end #info -->
					<hr>
					<p style="font-size:14px;margin-bottom:20px">Please check your email which registered with us to review our confirmation for your inquiry. 
						Should you have any question, please feel free to contact us at your convenience!<br/>
						We look forward to welcoming you to Vietnam.</p>
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
								<p style="word-spacing:2x;font-style:italic;color:#000;line-height:14px;">
									We love your feedback and read every word to improve services! 
									Please feel free to tell us how our support are at  <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> 
									or call <span style="color:#ff0000;font-style:normal"><?=HOTLINE?></span> 
								</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
