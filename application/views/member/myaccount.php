<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>member.css" />
<script type="text/javascript" src="<?=JS_URL?>myaccount.js"></script>
<div class="maincontent">
<div class="info-bar">
	<div class="ico"></div>
	<?php
	if ($this->session->userdata('user')) {
		$user = $this->session->userdata('user');
		echo '<h1>Hi, '.$user["fullname"];
		if ($user['provider'] == 'facebook') {
	?>
		<span class="right-panel"><a href="#" onClick="facebookLogout('<?php echo site_url("member/logout") ?>')">» Log Out</a></span></h1>
	<?php
		}else{
		echo '<span class="right-panel"><a href="'.site_url('member/logout').'">» Log Out</a></span></h1>';	
		}
	}
	?>
</div>
<div class="menumember">
	<ul class=topmenu>
		<li class="order"><a class="current" href="<?=site_url("member/myaccount")?>">My Orders</a></li>
		<li class="ticket"><a target="_blank" href="<?=site_url("help/mytickets")?>">My Tickets</a></li>
		<li class="profile"><a href="<?=site_url("member/myprofile")?>">Edit Profile</a></li>
		<li class="password"><a href="<?=site_url("member/changepassword")?>">Change Password</a></li>
	</ul>
	<div class="tab-details">
		<div id="order" class="tab-contents">
			<div class='client-name'>
				<p>Client Name : <b style="font-size:16px; font-weight:bold"><?=$user['fullname']?></b></p>
				<p>Joined Date : <?=$this->util->dateLongFormat($user['created_date'])?></p>
			</div>
			<h3>Tour Booking</h3>
				<div class="booking-detail">
					<div class="linetb">
						<table cellspacing="0" cellpadding="0" width="100%" class="tablemb">
							<tbody>
								<?php if (sizeof($tour_booking) == 0) : ?>
									<tr >
										<td style="text-align: center;padding: 10px 0;">You don't have any tour booking.</td>
									</tr>
								<?php else :?>
								<tr class="title">
									<td><b>Application Number</b></td>
									<td class="right-text"><b>Total Price</b> (USD)</td>
									<td class="right-text"><b>Paid</b> (USD)</td>
									<td class="center-text"><b>Status</b></td>
									<td><b>Booking Date</b></td>
								</tr>
								<?php
								$iteration = 1;
								$item_count = sizeof($tour_booking) + sizeof($hotel_booking) + sizeof($flight_booking) + sizeof($visa_booking);
								foreach($tour_booking as $booking) :
									$book_id        = $booking->book_id;
									$tour_id        = $booking->tour_id;
									$status         = $booking->status;
									$total          = $booking->total_fee;
									$paid           = $booking->paid;
									$booking_date   = $booking->booking_date;
									$fullname       = $booking->fullname;
									$adults         = $booking->adults;
									$children       = $booking->children;
									$infants        = $booking->infants;
									// $supplements    = $booking->supplements;
									$class_type     = $booking->classtype;
									$departure_date = $booking->departure_date;
									$email          = $booking->email;
									$phone          = $booking->phone;
									$message        = $booking->message;
									$tour_pax       = $this->m_tour->getPaxs($book_id);
									$tour_info      = $this->m_tour->load($tour_id);
								?>
								<tr>
									<td><a id="f_<?= $iteration ?>" class="expandable_<?= $iteration ?> expand" href="javascript:void(0);" onclick="display_box('<?= $iteration ?>', '<?= $item_count ?>');">T<?= $book_id ?></a></td>
									<td class="right-text">$<?= number_format($total,2) ?></td>
									<td class="right-text">$<?= $status ? number_format($paid,2) : '0.00' ?></td>
									<td class="center-text"><?= $status ? 'Paid' : '<b style="color:red">UnPaid</b> ('.anchor("member/payment/$book_id",'Click to pay').')'?></td>
									<td><?= $this->util->dateShortFormat($booking_date) ?></td>
								</tr>
								<tr class="hidden" id="more_<?= $iteration ?>" style="display: none;">
									<td colspan="5" style="background-color: #f6f6f6">
										<span class="title-tb" style="padding-top: 4px">Tour Information</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Tour Name</td>
														<td>Code</td>
														<td>Duration (days)</td>
														<td>Depart From</td>
														<td>Destination</td>
													</tr>
													<tr>
														<td class="min"><?= $tour_info->name ?></td>
														<td width="60"><?= $tour_info->code ?></td>
														<td width="60"><?= $tour_info->duration ?></td>
														<td width="80"><?= $tour_info->city_name ?></td>
														<td width="180">
														<?php  
															$arrdestination = explode(';', $tour_info->destinations);
															$tour_destinations = array();
															for ($i=0; $i < sizeof($arrdestination); $i++) {
																$tour_destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
															}
															$destsize = sizeof($tour_destinations);
															for ($i=0; $i < $destsize; $i++) {
																$destination = $tour_destinations[$i];
																echo '<a target="_blank" title="'.$destination->name.', '.$destination->name.' Vietnam, '.$destination->name.' travel guide" href="'.site_url("vietnam/top-destinations/".$destination->alias).'">'.$destination->name.'</a>';
																if ($i < $destsize-1) {
																	echo '&nbsp;<img src="'.IMG_URL.'destination-arrow.gif'.'">&nbsp;';
																}
															}		
														?>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Booking Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Class Type</td>
														<td>Departure Date</td>
														<td class="center-text" width="100">Adults</td>
														<td class="center-text" width="100">Children</td>
														<td class="center-text" width="100">Infants</td>
													</tr>
													<tr>
														<td><?= !empty($class_type)? $class_type : '' ?></td>
														<td><?= $this->util->dateShortFormat($departure_date)?></td>
														<td class="center-text"><?= $adults ?></td>
														<td class="center-text"><?= $children ?></td>
														<td class="center-text"><?= $infants ?></td>
													</tr>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Passengers Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>&nbsp;</td>
														<td>Fullname</td>
														<td class="center-text">Gender</td>
														<td>Date of birth</td>
														<td>Nationality</td>
														<td class="center-text">Supplement</td>
													</tr>
													<?php 
													$j = 1; 
													foreach($tour_pax as $pax) :
													?>
													<tr>
														<td class="center-text" width="16"><?= $j ?></td>
														<td class="min"><?= $pax->fullname ?></td>
														<td class="center-text" width="60"><?= $pax->gender ?> </td>
														<td width="80"><?= $this->util->dateShortFormat($pax->birthdate) ?></td>
														<td width="120"><?= $pax->nationality ?></td>
														<td class="center-text" width="60"><?= ($pax->supplement)?"Yes":"No" ?></td>
													</tr>
													<?php
													$j++;
													endforeach; 
													?>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Contact Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Fullname</td>
														<td>Email</td>
														<td>Phone</td>
														<td>Additional Requirements</td>
													</tr>
													<tr>
														<td><?= $fullname ?></td>
														<td><?= $email ?></td>
														<td><?= $phone ?></td>
														<td><?= $message ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</td>
								</tr>
								<?php
								$iteration++; 
								endforeach; ?>
							<?php endif ?>
							</tbody>
						</table>
					</div><!-- .linetb -->
				</div><!-- .booking-detail -->
			<h3>Hotel Booking</h3>
				<div class="booking-detail">
					<div class="linetb">
						<table cellspacing="0" cellpadding="0" width="100%" class="tablemb">
							<tbody>
								<?php if (sizeof($hotel_booking) == 0) : ?>
									<tr >
										<td style="text-align: center;padding: 10px 0;">You don't have any hotel booking.</td>
									</tr>
								<?php else :?>
								<tr class="title">
									<td><b>Application Number</b></td>
									<td class="right-text"><b>Total Price</b> (USD)</td>
									<td class="center-text">Payment Method</td>
									<td class="center-text"><b>Status</b></td>
									<td><b>Booking Date</b></td>
								</tr>
								<?php
								foreach($hotel_booking as $booking) :
									$book_id        = $booking->book_id;
									$hotel_id       = $booking->hotel_id;
									$status         = $booking->status;
									$total          = $booking->total_fee;
									$payment_method = $booking->payment_method;
									$booking_date   = $booking->booking_date;
									$fullname       = $booking->fullname;
									$adults         = $booking->adults;
									$children       = $booking->children;
									$checkin        = $booking->checkin;
									$checkout       = $booking->checkout;
									$rooms          = $booking->rooms;
									$email          = $booking->email;
									$phone          = $booking->phone;
									$message        = $booking->message;
									$hotel_pax      = $this->m_hotel->getPaxs($book_id);
									$hotel_info     = $this->m_hotel->load($tour_id);
									$hotel_cat      = $this->m_hotel_category->load($hotel_info->category_id);
								?>
								<tr>
									<td><a id="f_<?= $iteration ?>" class="expandable_<?= $iteration ?> expand" href="javascript:void(0);" onclick="display_box('<?= $iteration ?>', '<?= $item_count ?>');">H<?= $book_id ?></a></td>
									<td class="right-text">$<?= number_format($total,2) ?></td>
									<td class="center-text"><?= $payment_method ?></td>
									<td class="center-text"><?= $status ? 'Paid' : '<b style="color:red">UnPaid</b>'?></td>
									<td><?= $this->util->dateShortFormat($booking_date) ?></td>
								</tr>
								<tr class="hidden" id="more_<?= $iteration ?>" style="display: none;">
									<td colspan="5" style="background-color: #f6f6f6">
										<span class="title-tb" style="padding-top: 4px">Hotel Information</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Hotel Name</td>
														<td>Class Type</td>
														<td>City</td>
														<td>Address</td>
													</tr>
													<tr>
														<td class="min"><?= $hotel_info->name ?></td>
														<td width="60"><?= $hotel_cat->name ?></td>
														<td width="60"><?= $hotel_info->city_name ?></td>
														<td width="180"><?= $hotel_info->address ?></td>
													</tr>
												</tbody>
											</table>
										</div>
										<span class="title-tb" style="padding-top: 4px">Booking Information</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Check in</td>
														<td>Check out</td>
														<td class="center-text">Rooms</td>
														<td class="center-text">Adults</td>
														<td class="center-text">Children</td>
													</tr>
													<tr>
														<td width="120"><?= $this->util->dateLongFormat($checkin) ?></td>
														<td width="120"><?= $this->util->dateLongFormat($checkout) ?></td>
														<td class="center-text" width="60"><?= $rooms ?></td>
														<td class="center-text" width="60"><?= $adults ?></td>
														<td class="center-text" width="60"><?= $children ?></td>
													</tr>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Passengers Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>&nbsp;</td>
														<td>Fullname</td>
														<td class="center-text">Gender</td>
														<td>Date of birth</td>
														<td>Nationality</td>
													</tr>
													<?php 
													$j = 1; 
													foreach($hotel_pax as $pax) :
													?>
													<tr>
														<td width="16" align="center"><?= $j ?></td>
														<td class="min"><?= $pax->fullname ?></td>
														<td class="center-text" width="60"><?= $pax->gender ?> </td>
														<td width="80"><?= $this->util->dateShortFormat($pax->birthdate) ?></td>
														<td width="120"><?= $pax->nationality ?></td>
													</tr>
													<?php
													$j++;
													endforeach; 
													?>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Contact Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Fullname</td>
														<td>Email</td>
														<td>Phone</td>
														<td>Additional Requirements</td>
													</tr>
													<tr>
														<td><?= $fullname ?></td>
														<td><?= $email ?></td>
														<td><?= $phone ?></td>
														<td><?= $message ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</td>
								</tr>
								<?php
								$iteration++; 
								endforeach; ?>
								<?php endif ?>
							</tbody>
						</table>
					</div><!-- .linetb -->
				</div><!-- .booking-detail -->
			<h3>Flight Booking</h3>
				<div class="booking-detail">
					<div class="linetb">
						<table cellspacing="0" cellpadding="0" width="100%" class="tablemb">
							<tbody>
								<?php if (sizeof($flight_booking) == 0) : ?>
									<tr >
										<td style="text-align: center;padding: 10px 0;">You don't have any flight booking.</td>
									</tr>
								<?php else :?>
								<tr class="title">
									<td><b>Application Number</b></td>
									<td class="right-text"><b>Total Price</b> (USD)</td>
									<td class="center-text">Payment Method</td>
									<td class="center-text"><b>Status</b></td>
									<td><b>Booking Date</b></td>
								</tr>
								<?php
								foreach($flight_booking as $booking) :
									$book_id        = $booking->book_id;
									$status         = $booking->status;
									$total          = $booking->total_fee;
									$payment_method = $booking->payment_method;
									$booking_date   = $booking->booking_date;
									$fullname       = $booking->fullname;
									$adults         = $booking->adults;
									$children       = $booking->children;
									$infants        = $booking->infants;
									$email          = $booking->email;
									$phone          = $booking->phone;
									$message        = $booking->message;
									$direction      = $booking->direction;
									$flight_pax     = $this->m_flight->getPaxs($book_id);
									$flight_ticket  = $this->m_flight->getTickets($book_id);
								?>
								<tr>
									<td><a id="f_<?= $iteration ?>" class="expandable_<?= $iteration ?> expand" href="javascript:void(0);" onclick="display_box('<?= $iteration ?>', '<?= $item_count ?>');">F<?= $book_id ?></a></td>
									<td class="right-text">$<?= number_format($total,2) ?></td>
									<td class="center-text"><?= $payment_method ?></td>
									<td class="center-text"><?= $status ? 'Paid' : '<b style="color:red">UnPaid</b>'?></td>
									<td><?= $this->util->dateShortFormat($booking_date) ?></td>
								</tr>
								<tr class="hidden" id="more_<?= $iteration ?>" style="display: none;">
									<td colspan="5" style="background-color: #f6f6f6">
										<span class="title-tb" style="padding-top: 4px">Ticket Information</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Flight Number</td>
														<td>Departure Date</td>
														<td>Arrival Date</td>
														<td>From</td>
														<td>To</td>
														<td>Stop</td>
														<td>Duration (hours)</td>
													</tr>
													<tr>
														<td class="min"><?= $flight_ticket->flight ?></td>
														<td width="120"><?= $this->util->dateLongFormat($flight_ticket->departure_date)   ?></td>
														<td width="120"><?= $this->util->dateLongFormat($flight_ticket->arrival_date) ?></td>
														<td width="120"><?= $flight_ticket->source ?></td>
														<td width="120"><?= $flight_ticket->dest ?></td>
														<td class="center-text" width="80"><?= $flight_ticket->stops ?></td>
														<td class="center-text"><?= $flight_ticket->duration ?></td>
													</tr>
												</tbody>
											</table>
										</div>
										<span class="title-tb" >Booking Information</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Class Type</td>
														<td>Airline</td>
														<td class="center-text">Direction</td>
														<td class="center-text">Adults</td>
														<td class="center-text">Children</td>
														<td class="center-text">Infants</td>
													</tr>
													<tr>
														<td width="120"><?= ucfirst($flight_ticket->class_type) ?></td>
														<td width="120"><?= $flight_ticket->airline ?></td>
														<td class="center-text" width="60"><?= $direction ?></td>
														<td class="center-text" width="60"><?= $adults ?></td>
														<td class="center-text" width="60"><?= $children ?></td>
														<td class="center-text" width="60"><?= $infants ?></td>
													</tr>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Passengers Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>&nbsp;</td>
														<td>Fullname</td>
														<td class="center-text">Gender</td>
														<td>Date of birth</td>
														<td>Nationality</td>
													</tr>
													<?php 
													$j = 1; 
													foreach($flight_pax as $pax) :
													?>
													<tr>
														<td width="16" align="center"><?= $j ?></td>
														<td class="min"><?= $pax->fullname ?></td>
														<td class="center-text" width="60"><?= $pax->gender ?> </td>
														<td width="80"><?= $this->util->dateShortFormat($pax->birthdate) ?></td>
														<td width="120"><?= $pax->nationality ?></td>
													</tr>
													<?php
													$j++;
													endforeach; 
													?>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Contact Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td width="200">Fullname</td>
														<td>Email</td>
														<td>Phone</td>
														<td>Additional Requirements</td>
													</tr>
													<tr>
														<td width="200"><?= $fullname ?></td>
														<td><?= $email ?></td>
														<td><?= $phone ?></td>
														<td><?= $message ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</td>
								</tr>
								<?php
								$iteration++; 
								endforeach; ?>
								<?php endif ?>
							</tbody>
						</table>
					</div><!-- .linetb -->
				</div><!-- .booking-detail -->
			<h3>Visa Booking</h3>
				<div class="booking-detail">
					<div class="linetb">
						<table cellspacing="0" cellpadding="0" width="100%" class="tablemb">
							<tbody>
								<?php if (sizeof($visa_booking) == 0) : ?>
									<tr >
										<td style="text-align: center;padding: 10px 0;">You don't have any visa booking.</td>
									</tr>
								<?php else :?>
								<tr class="title">
									<td><b>Application Number</b></td>
									<td class="right-text"><b>Total Price</b> (USD)</td>
									<td class="center-text">Payment Method</td>
									<td class="center-text"><b>Status</b></td>
									<td><b>Booking Date</b></td>
								</tr>
								<?php
								foreach($visa_booking as $booking) :
									$book_id        = $booking->book_id;
									$arrival        = $booking->arrival_date;
									$exit           = $booking->exit_date;
									$arrival_port   = $booking->arrival_port;
									$purpose        = $booking->visit_purpose;
									$type           = $booking->visa_type;
									$status         = $booking->status;
									$total          = $booking->total_fee;
									$payment_method = $booking->payment_method;
									$booking_date   = $booking->booking_date;
									$fullname       = $booking->fullname;
									$email          = $booking->email;
									$phone          = $booking->phone;
									$message        = $booking->special_request;
									$visa_pax       = $this->m_visa->getTravelers($book_id);
									$processing_time= '';
									if ($booking->rush_type == 1) {
										$processing_time = 'Urgent';
									}elseif ($booking->rush_type == 2) {
										$processing_time = 'Emergency';
									}else{
										$processing_time = 'Normal';
									}
								?>
								<tr>
									<td><a id="f_<?= $iteration ?>" class="expandable_<?= $iteration ?> expand" href="javascript:void(0);" onclick="display_box('<?= $iteration ?>', '<?= $item_count ?>');">V<?= $book_id ?></a></td>
									<td class="right-text">$<?= number_format($total,2) ?></td>
									<td class="center-text"><?= $payment_method ?></td>
									<td class="center-text"><?= $status ? 'Paid' : '<b style="color:red">UnPaid</b>'?></td>
									<td><?= $this->util->dateShortFormat($booking_date) ?></td>
								</tr>
								<tr class="hidden" id="more_<?= $iteration ?>" style="display: none;">
									<td colspan="5" style="background-color: #f6f6f6">
										<span class="title-tb" style="padding-top: 4px">Visa Information</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Type of Visa</td>
														<td>Date of Arrival</td>
														<td>Date of Exit</td>
														<td>Purpose of Visit</td>
														<td>Arrival Port</td>
														<td>Processing Time</td>
													</tr>
													<tr>
														<td width="100"><?= $type ?></td>
														<td width="100"><?= $this->util->dateLongFormat($arrival) ?></td>
														<td width="100"><?= $this->util->dateLongFormat($exit) ?></td>
														<td width="60"><?= $purpose ?></td>
														<td width="60"><?= $arrival_port ?></td>
														<td width="60"><?= $processing_time ?></td>
													</tr>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Passengers Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>&nbsp;</td>
														<td>Fullname</td>
														<td class="center-text">Gender</td>
														<td>Date of birth</td>
														<td>Nationality</td>
														<td>Passport Number</td>
													</tr>
													<?php 
													$j = 1; 
													foreach($visa_pax as $pax) :
													?>
													<tr>
														<td width="16" align="center"><?= $j ?></td>
														<td class="min"><?= $pax->fullname ?></td>
														<td class="center-text" width="60"><?= $pax->gender ?> </td>
														<td width="120"><?= $this->util->dateShortFormat($pax->birthdate) ?></td>
														<td width="120"><?= $pax->nationality ?></td>
														<td width = "100"><?= $pax->passport ?></td>
													</tr>
													<?php
													$j++;
													endforeach; 
													?>
												</tbody>
											</table>
										</div>
										<span class="title-tb">Contact Infomation</span>
										<div class="linetb noborder" style="border: none;">
											<table width="100%" cellspacing="0" cellpadding="0" class="tablemb">
												<tbody>
													<tr class="title">
														<td>Fullname</td>
														<td>Email</td>
														<td>Phone</td>
														<td>Additional Requirements</td>
													</tr>
													<tr>
														<td><?= $fullname ?></td>
														<td><?= $email ?></td>
														<td><?= $phone ?></td>
														<td><?= $message ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</td>
								</tr>
								<?php
								$iteration++; 
								endforeach; ?>
								<?php endif ?>
							</tbody>
						</table>
					</div><!-- .linetb -->
				</div><!-- .booking-detail -->
		</div><!-- #order -->
	</div><!-- .tab-details -->
</div><!-- .menumember -->
</div><!-- .maincontent -->
<div class="clear"></div>
<div id="fb-root"></div>

<script type="text/javascript" src = "<?=JS_URL?>facebook.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		/**TAB FOR MENU*/
		$("#order .booking-detail:not(:first)").hide();
		// Apply click event on H3 element
		$("#order h3").click(function(){
			// accordion for the element next to h3
			$accordion = $(this).next();
			// if it currently hide then show and hide all other element
			// If h3 is showing then hide it
			if ($accordion.is(':hidden') === true) {
				$("#order .booking-detail").slideUp();
				$accordion.slideDown('fast');
			} else {
				$accordion.slideUp();
			}
		});
	});
</script>


