<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotels extends CI_Controller {

	public function index()
	{
		$featured_info->featured = 1;
		$featured_hotels = $this->m_hotel->getItems($featured_info, 1, 4);
		
		$promotion_info->promotion = 1;
		$promotion_hotels = $this->m_hotel->getItems($promotion_info, 1, 4);
		
		$best_sale_info->city = 1;
		$best_sale_hotels = $this->m_hotel->getItems($best_sale_info, 1, 6);
		
		$view_data = "";
		$view_data['featured_hotels']  = $featured_hotels;
		$view_data['promotion_hotels'] = $promotion_hotels;
		$view_data['best_sale_hotels'] = $best_sale_hotels;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "Vietnam Hotels - Find the best hotels in Vietnam";
		$tmpl_content['content']   = $this->load->view("hotel/index", $view_data, TRUE);
		$this->load->view('layout/hotel', $tmpl_content);
	}
	
	public function vietnam($destination_alias=NULL, $hotel_alias=NULL)
	{
		if (!empty($hotel_alias)) {
			$this->view($hotel_alias);
		}
		else if ($destination_alias != NULL) {
			$this->destination($destination_alias);
		}
		else {
			$this->index();
		}
	}
	
	public function destination($alias=NULL)
	{
		$destination = $this->m_hotel_destination->load($alias);
		
		$hotel_search = $this->session->userdata("hotel_search");
		
		$hotel_search->city = $destination->id;
		
		$hotel_search->sortby = !empty($_GET["sortby"]) ? $_GET["sortby"] : "newest";
		
		$this->session->set_userdata("hotel_search", $hotel_search);
		
		$featured_info->featured = 1;
		$featured_info->city = $destination->id;
		$featured_hotels = $this->m_hotel->getItems($featured_info, 1, 4);
		
		$view_data = "";
		$view_data['featured_hotels'] = $featured_hotels;
		//$view_data['totalitems'] = sizeof($this->m_hotel->getItems($hotel_search, 1));
		$view_data['items']	= $this->m_hotel->getItems($hotel_search, 1);
		
		$tmpl_content['content']   = $this->load->view("hotel/search", $view_data, TRUE);
		$this->load->view('layout/hotel', $tmpl_content);
	}
	
	public function search()
	{
		if (!empty($_POST)) {
			$hotel_search->checkindate	= (!empty($_POST["hotel-checkindate"]) ? date('m/d/Y', strtotime($_POST["hotel-checkindate"])) : date("m/d/Y", strtotime("+1 days")));
			$hotel_search->checkoutdate	= (!empty($_POST["hotel-checkoutdate"]) ? date('m/d/Y', strtotime($_POST["hotel-checkoutdate"])) : date("m/d/Y", strtotime("+7 days")));
			$hotel_search->city_txt		= (!empty($_POST["hotel-location"]) ? $_POST["hotel-location"] : "");
		}
		
		if (!empty($hotel_search->city_txt)) {
			$destinations = $this->m_hotel_destination->search($hotel_search->city_txt, 1);
			foreach ($destinations as $destination) {
				$hotel_search->cities[] = $destination->id;
			}
		}
		
		$hotel_search->sortby = !empty($_GET["sortby"]) ? $_GET["sortby"] : "newest";
		
		$featured_info->featured = 1;
		$featured_hotels = $this->m_hotel->getItems($featured_info, 1, 4);
		
		$view_data = "";
		$view_data['featured_hotels']  = $featured_hotels;
		$view_data['items']	= $this->m_hotel->getItems($hotel_search, 1);
		
		$tmpl_content['content']   = $this->load->view("hotel/search", $view_data, TRUE);
		$this->load->view('layout/hotel', $tmpl_content);
	}
	
	public function faqs()
	{
		$view_data = "";
		
		$tmpl_content['content']   = $this->load->view("hotel/faqs", $view_data, TRUE);
		$this->load->view('layout/hotel', $tmpl_content);
	}
	
	public function view($alias)
	{
		$item = $this->m_hotel->load($alias);
		
		$room_info->hotel_id = $item->id;
		$rooms = $this->m_room->getItems($room_info, 1);
		
		$photo_info->category_id = 3;
		$photo_info->ref_id = $item->id;
		$photos = $this->m_photo->getItems($photo_info, 1);
		
		$hotel_info->category_id = $item->category_id;
		$hotel_info->city = $item->city;
		$more_hotels = $this->m_hotel->getItems($hotel_info, 1);
		
		$review_info->category_id	= 3;
		$review_info->ref_id		= $item->id;
		$review_info->topLevel		= 1;
		$reviews = $this->m_review->getItems($review_info, 1);
		
		$avg_rating = 3;
		foreach ($reviews as $review) {
			$avg_rating += $review->rating;
		}
		$avg_rating = round($avg_rating / (sizeof($reviews)+1));
		
		$view_data["item"]			= $item;
		$view_data["rooms"]			= $rooms;
		$view_data["photos"]		= $photos;
		$view_data["avg_rating"]	= $avg_rating;
		$view_data["more_hotels"]	= $more_hotels;
		
		$review_data['category_id'] = 3;
		$review_data['ref_id']		= $item->id;
		$view_data["reviews"]		= $this->load->view("review/index", $review_data, TRUE);
		
		$question_data['category_id'] 	= 3;
		$question_data['ref_id']		= $item->id;
		$view_data["questions"]			= $this->load->view("answer/index", $question_data, TRUE);
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("hotel/detail", $view_data, TRUE);
		$this->load->view('layout/hotel', $tmpl_content);
	}
	
	public function map($alias)
	{
		$view_data["item"] = $this->m_hotel->load($alias);
		$this->load->view('hotel/map', $view_data);
	}
	
	public function cal_fees()
	{
		$hotel_id 		= (!empty($_POST["hotel_id"]) ? $_POST["hotel_id"] : 0);
		$num_of_rooms	= (!empty($_POST["rooms"]) ? $_POST["rooms"] : 0);
		$checkin		= (!empty($_POST["checkin"]) ? $_POST["checkin"] : date('Y-m-d'));
		$checkout		= (!empty($_POST["checkout"]) ? $_POST["checkout"] : date('Y-m-d', strtotime(' +1 day')));
		
		$room_info->hotel_id = $hotel_id;
		$rooms = $this->m_room->getItems($room_info, 1);
		
		$total_fee = 0;
		$roomtypes = array();
		
		for ($i=1; $i<=$num_of_rooms; $i++)
		{
			$roomtype = (!empty($_POST["roomtype_".$i]) ? $_POST["roomtype_".$i] : 0);
			if (in_array($roomtype, $roomtypes))
			{
				$total_fee += $roomtypes[$roomtype];
			}
			else
			{
				$fee = 0;
				
				foreach ($rooms as $room)
				{
					if ($room->id == $roomtype)
					{
						$fromdate = date('Y-m-d', strtotime($checkin));
						
						while (strtotime($fromdate) < strtotime($checkout))
						{
							$duedt = explode("-", $fromdate);
							$date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
							$week  = (int)date('W', $date);
							$day   = (int)date('D', $date);
							
							$rate_date  = $week."_".$day;
							$rate_day   = $duedt[1];
							$rate_month = $duedt[2];
							$room_rates = $this->m_room_rate->getRate($room->id, $rate_date);
							$room_solar_rates = $this->m_room_rate->getSolarRate($room->id, $rate_day, $rate_month);
							
							// Solar to Lunar calendar
							$lunardate = $this->util->convertSolar2Lunar($rate_day, $rate_month, $duedt[0], 7);
							$rate_day   = $lunardate[0];
							$rate_month = $lunardate[1];
							$room_lunar_rates = $this->m_room_rate->getLunarRate($room->id, $rate_day, $rate_month);
							
							if (!empty($room_lunar_rates)) {
								$fee += $room_lunar_rates->price;
							}
							else if (!empty($room_solar_rates)) {
								$fee += $room_solar_rates->price;
							}
							else if (!empty($room_rates)) {
								$fee += $room_rates->price;
							}
							else {
								$fee += $room->price;
							}
							
							$fromdate = date('Y-m-d', strtotime($fromdate .' +1 day'));
						}
						
						break;
					}
				}
				
				$total_fee += $fee;
				$roomtypes[$roomtype] = $fee;
			}
		}
		
		echo $total_fee;
	}
	
	public function check_rate($room_id, $checkin, $checkout)
	{
		
	}
	
	public function booking($alias)
	{
		$item = $this->m_hotel->load($alias);
		
		$room_info->hotel_id = $item->id;
		$rooms = $this->m_room->getItems($room_info, 1);
		
		$view_data["item"]		= $item;
		$view_data["rooms"]		= $rooms;
		$view_data["nations"]	= $this->m_nation->getItems();
		
		$tmpl_content['meta']['title'] = "Vietnam Hotel Booking - " . (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("hotel/booking", $view_data, TRUE);
		$this->load->view('layout/hotel', $tmpl_content);
	}
	
	public function checkout()
	{
		$booking->hotel_id	= (!empty($_POST["hotel_id"]) ? $_POST["hotel_id"] : 0);
		$booking->travelers	= (!empty($_POST["adults"]) ? $_POST["adults"] : 0) + (!empty($_POST["children"]) ? $_POST["children"] : 0);
		$booking->numofroom	= (!empty($_POST["rooms"]) ? $_POST["rooms"] : 0);
		$booking->checkin	= (!empty($_POST["checkin"]) ? date('Y-m-d', strtotime($_POST["checkin"])) : date('Y-m-d'));
		$booking->checkout	= (!empty($_POST["checkout"]) ? date('Y-m-d', strtotime($_POST["checkout"])) : date('Y-m-d', strtotime(' +1 day')));
		$booking->fullname	= (!empty($_POST["fullname"]) ? $_POST["fullname"] : "");
		$booking->email		= (!empty($_POST["email"]) ? $_POST["email"] : "");
		$booking->phone		= (!empty($_POST["phone"]) ? $_POST["phone"] : "");
		$booking->message	= (!empty($_POST["message"]) ? $_POST["message"] : "");
		$booking->payment	= (!empty($_POST["payment"]) ? $_POST["payment"] : "");
		
		$hotel = $this->m_hotel->load($booking->hotel_id);
		
		$booking->class		= array();
		$booking->rooms		= array();
		$booking->paxs		= array();
		$booking->adults	= (!empty($_POST["adults"]) ? $_POST["adults"] : 0);
		$booking->children	= (!empty($_POST["children"]) ? $_POST["children"] : 0);
		
		for ($i=1; $i<=$booking->numofroom; $i++) {
			$class = new stdClass();
			$class->id	= (!empty($_POST["roomtype_".$i]) ? $_POST["roomtype_".$i] : 0);
			$booking->class[]	= $class;
		}
		
		for ($i=1; $i<=$booking->travelers; $i++) {
			$pax = new stdClass();
			$pax->fullname		= (!empty($_POST["firstname_".$i]) ? $_POST["firstname_".$i] : "") ." ". (!empty($_POST["lastname_".$i]) ? $_POST["lastname_".$i] : "");
			$pax->gender		= (!empty($_POST["gender_".$i]) ? $_POST["gender_".$i] : "Male");
			$pax->birthdate		= (!empty($_POST["birthdate_".$i]) ? $_POST["birthdate_".$i] : 0);
			$pax->nationality	= (!empty($_POST["nationality_".$i]) ? $_POST["nationality_".$i] : "");
			$booking->paxs[]	= $pax;
		}
		
		$room_info->hotel_id = $booking->hotel_id;
		$rooms = $this->m_room->getItems($room_info, 1);
		
		$booking->total_fee = 0;
		$roomtypes = array();
		
		foreach ($booking->class as $class)
		{
			if (in_array($class->id, $roomtypes))
			{
				$booking->total_fee += $roomtypes[$class->id];
			}
			else
			{
				$fee = 0;
				
				foreach ($rooms as $room)
				{
					if ($room->id == $class->id)
					{
						$booking->rooms[] = $room;
						
						$fromdate = date('Y-m-d', strtotime($booking->checkin));
						
						while (strtotime($fromdate) < strtotime($booking->checkout))
						{
							$duedt = explode("-", $fromdate);
							$date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
							$week  = (int)date('W', $date);
							$day   = (int)date('D', $date);
							
							$rate_date  = $week."_".$day;
							$rate_day   = $duedt[1];
							$rate_month = $duedt[2];
							$room_rates = $this->m_room_rate->getRate($room->id, $rate_date);
							$room_solar_rates = $this->m_room_rate->getSolarRate($room->id, $rate_day, $rate_month);
							
							// Solar to Lunar calendar
							$lunardate = $this->util->convertSolar2Lunar($rate_day, $rate_month, $duedt[0], 7);
							$rate_day   = $lunardate[0];
							$rate_month = $lunardate[1];
							$room_lunar_rates = $this->m_room_rate->getLunarRate($room->id, $rate_day, $rate_month);
							
							if (!empty($room_lunar_rates)) {
								$fee += $room_lunar_rates->price;
							}
							else if (!empty($room_solar_rates)) {
								$fee += $room_solar_rates->price;
							}
							else if (!empty($room_rates)) {
								$fee += $room_rates->price;
							}
							else {
								$fee += $room->price;
							}
							
							$fromdate = date('Y-m-d', strtotime($fromdate .' +1 day'));
						}
						
						break;
					}
				}
				
				$booking->total_fee += $fee;
				$roomtypes[$class->id] = $fee;
			}
		}
		
		/*
		 * Save
		 */
		
		// Create new account
		$is_new_account = false;
		$user = $this->m_user->getUserByEmail($booking->email);
		$password = "";
		if (empty($user)) {
			$password = $this->m_user->uuid();
			$data = array(
				'fullname'			=> $booking->fullname,
				'username'			=> $booking->email,
				'password'			=> md5($password),
				'password_text'		=> $password,
				'email'				=> $booking->email,
				'phone'				=> $booking->phone
			);
			$this->m_user->add($data);
			$is_new_account = true;
		}
		
		$user = $this->m_user->getUserByEmail($booking->email);
		$user_id = 0;
		if ($user != null) {
			$user_id  = $user->id;
			$password = $user->password_text;
		}
		
		// Get book id
		$booking->id = $this->util->GetNextValue("tv_hotel_booking", "id");
		
		// Booking key
		$booking->key = 'hotel_'.md5(time());
		
		// Add to booking list
		$data = array(
				'id'				=> $booking->id,
				'hotel_id'			=> $booking->hotel_id,
				'booking_key'		=> $booking->key,
				'rooms'				=> $booking->numofroom,
				'checkin'			=> $booking->checkin,
				'checkout'			=> $booking->checkout,
				'adults'			=> $booking->adults,
				'children' 			=> $booking->children,
				'total_fee'			=> $booking->total_fee,
				'fullname'			=> $booking->fullname,
				'email'				=> $booking->email,
				'phone'				=> $booking->phone,
				'message'			=> $booking->message,
				'payment_method' 	=> $booking->payment,
				'booking_date' 		=> date("Y-m-d H:i:s"),
				'promotion_code'	=> "",
				'discount'			=> 0,
				'user_id' 			=> $user_id,
				'status' 			=> 0,
		);
		
		$succed = true;
		
		if (!$this->m_hotel->add_booking($data)) {
			$succed = false;
		} else {
			foreach ($booking->class as $class) {
				$booking_class["book_id"]	= $booking->id;
				$booking_class["room_id"]	= $class->id;
				
				if (!$this->m_hotel->add_class($booking_class)) {
					$succed = false;
				}
			}
			
			foreach ($booking->paxs as $pax) {
				$booking_pax["book_id"]		= $booking->id;
				$booking_pax["fullname"]	= $pax->fullname;
				$booking_pax["gender"]		= $pax->gender;
				$booking_pax["birthdate"]	= date("Y-m-d", strtotime($pax->birthdate));
				$booking_pax["nationality"]	= $pax->nationality;
				
				if (!$this->m_hotel->add_pax($booking_pax)) {
					$succed = false;
				}
			}
		}

		if ($succed)
		{
			// Payment
			$payment = $booking->payment;
			
			// Send mail to sales department
			$tpl_data = array(
					"FULLNAME"					=> $booking->fullname,
					"PROMOTION"					=> 0,
					"DISCOUNT"					=> 0,
					"CHECKIN"					=> $booking->checkin,
					"CHECKOUT"					=> $booking->checkout,
					"TOTAL_FEE"					=> $booking->total_fee,
					"HOTEL"						=> $hotel,
					"ROOMS"						=> $booking->rooms,
					"PAXS"						=> $booking->paxs,
					"EMAIL"						=> $booking->email,
					"PHONE"						=> $booking->phone,
					"MESSAGE"					=> $booking->message,
					"PAYMENT_METHOD"			=> $booking->payment,
					"NEW_ACCOUNT"				=> $is_new_account,
					"USER_LOGIN"				=> $user->username,
					"PASSWORD"					=> $password,
			);
			
			$subject = "BOOKING #H".$booking->id.": Vietnam Hotel Payment Remind";
			
			$tpl_data["RECEIVER"] = MAIL_INFO;
			$messageToAdmin  = $this->mail_tpl->hotel_payment_remind($tpl_data);
			
			$tpl_data["RECEIVER"] = $booking->email;
			$messageToClient = $this->mail_tpl->hotel_payment_remind($tpl_data);
			
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> $subject." - ".$booking->fullname,
								"from_sender"	=> $booking->email,
	                            "name_sender"	=> $booking->fullname,
								"to_receiver"	=> MAIL_INFO,
	                            "message"		=> $messageToAdmin
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_INFO,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $booking->email,
	                            "message"		=> $messageToClient
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			if ($payment == 'OnePay')
			{
				//Redirect to OnePay
				$vpcURL = OP_PAYMENT_URL;
				
				$vpcOpt['Title']				= "Settle payment online at ".SITE_NAME;
				$vpcOpt['AgainLink']			= urlencode($_SERVER['HTTP_REFERER']);
				$vpcOpt['vpc_Merchant']			= OP_MERCHANT;
				$vpcOpt['vpc_AccessCode']		= OP_ACCESSCODE;
				$vpcOpt['vpc_MerchTxnRef']		= $booking->key;
				$vpcOpt['vpc_OrderInfo']		= "H".$booking->id;
				$vpcOpt['vpc_Amount']			= $booking->total_fee*100;
				$vpcOpt['vpc_ReturnURL']		= OP_RETURN_URL;
				$vpcOpt['vpc_Version']			= "2";
				$vpcOpt['vpc_Command']			= "pay";
				$vpcOpt['vpc_Locale']			= "en";
				$vpcOpt['vpc_TicketNo']			= $_SERVER['REMOTE_ADDR'];
				$vpcOpt['vpc_Customer_Email']	= $booking->email;
				$vpcOpt['vpc_Customer_Id']		= $user_id;
				
				$md5HashData = "";
				
				ksort($vpcOpt);
				
				$appendAmp = 0;
				
				foreach($vpcOpt as $k => $v) {
					// create the md5 input and URL leaving out any fields that have no value
					if (strlen($v) > 0) {
						// this ensures the first paramter of the URL is preceded by the '?' char
						if ($appendAmp == 0) {
							$vpcURL .= urlencode($k) . '=' . urlencode($v);
							$appendAmp = 1;
						} else {
							$vpcURL .= '&' . urlencode($k) . "=" . urlencode($v);
						}
						if ((strlen($v) > 0) && ((substr($k, 0,4)=="vpc_") || (substr($k,0,5) =="user_"))) {
							$md5HashData .= $k . "=" . $v . "&";
						}
					}
				}
				
				$md5HashData = rtrim($md5HashData, "&");
				$md5HashData = strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',OP_SECURE_SECRET)));
				
				$vpcURL .= "&vpc_SecureHash=" . $md5HashData;
				
				header("Location: ".$vpcURL);
				die();
			}
			else if($payment == 'Credit Card') {
				//Redirect to gate2shop
				$numberofitems = 1;
				$totalAmount   = $booking->total_fee;
				$productName   = "Vietnam Hotel booking";
				$productPrice  = $booking->total_fee/$booking->travelers;
				$productNum    = $booking->travelers;
				$datetime      = gmdate("Y-m-d H:i:s");
				
				// Cal checksum
				$checksum = md5(G2S_SECRET_KEY.G2S_MERCHANT_ID.G2S_CURRENTCY.$totalAmount.$productName.$productPrice.$productNum.$datetime);
	
				$link = 'https://secure.Gate2Shop.com/ppp/purchase.do?';
				$link .= 'version='.G2S_VERSION;
				$link .= '&merchant_id='.G2S_MERCHANT_ID;
				$link .= '&merchant_site_id='.G2S_MERCHANT_SITE_ID;
				$link .= '&total_amount='.$totalAmount;
				$link .= '&numberofitems='.$numberofitems;
				$link .= '&currency='.G2S_CURRENTCY;
				$link .= '&item_name_1='.$productName;
				$link .= '&item_amount_1='.$productPrice;
				$link .= '&item_quantity_1='.$productNum;
				$link .= '&time_stamp='.$datetime;
				$link .= '&checksum='.$checksum;
				$link .= '&customField1='.$booking->key;
				$link .= '&customField2='.$booking->email;
				
				header('Location: '.$link);
				die();
			}
			else if($payment == 'Paypal')
			{
				$amount		= $booking->total_fee;
				$item_name	= "Vietnam Hotel booking";
				$quantity	= $booking->travelers;
				
				$link = 'https://www.paypal.com/cgi-bin/webscr?';
				$link .= 'cmd=_xclick';
				$link .= '&business='.PAYPAL_BUSINESS;
				$link .= '&item_name='.$item_name;
				$link .= '&quantity='.$quantity;
				$link .= '&amount='.$amount.' USD';
				$link .= '&no_shipping=1';
				$link .= '&no_note=1';
				$link .= '&currency_code=USD';
				$link .= '&return='.BASE_URL.'/payment/sucess/'.$key;
				$link .= '&cancel_return='.BASE_URL.'/payment/failure/'.$key;
				
				header('Location: '.$link);
				die();
			}
		}
		
		$view_data["client_name"] = $booking->fullname;
		
		$tmpl_content['content'] = $this->load->view("payment/finish", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	
	function success($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		if (!empty($key)) {
			$key = str_ireplace(".html", "", $key);
		}
		
		$data  = array( 'status' => 1 );
		$where = array( 'booking_key' => $key );
		
		$this->m_hotel->update_booking($data, $where);
		
		$booking = $this->m_hotel->getBooking(NULL, $key);
		if ($booking != null)
		{
			$booking->hotel = $this->m_hotel->load($booking->hotel_id);
			$booking->paxs  = $this->m_hotel->getPaxs($booking->id);
			$booking->rooms = $this->m_hotel->getClasses($booking->id);
			
			// Create new account
			$user = $this->m_user->getUserByEmail($booking->email);
			
			// Send mail to sales department
			$tpl_data = array(
					"FULLNAME"					=> $booking->fullname,
					"PROMOTION"					=> 0,
					"DISCOUNT"					=> 0,
					"CHECKIN"					=> $booking->checkin,
					"CHECKOUT"					=> $booking->checkout,
					"TOTAL_FEE"					=> $booking->total_fee,
					"HOTEL"						=> $booking->hotel,
					"ROOMS"						=> $booking->rooms,
					"PAXS"						=> $booking->paxs,
					"EMAIL"						=> $booking->email,
					"PHONE"						=> $booking->phone,
					"MESSAGE"					=> $booking->message,
					"PAYMENT_METHOD"			=> $booking->payment,
					"NEW_ACCOUNT"				=> false,
					"USER_LOGIN"				=> $user->username,
					"PASSWORD"					=> $user->password_text,
			);
			
			$subject = "BOOKING #H".$booking->id.": Confirm Vietnam Hotel ".$booking->payment_method." Payment Successful";
			
			$tpl_data["RECEIVER"] = MAIL_INFO;
			$messageToAdmin  = $this->mail_tpl->hotel_payment_successful($tpl_data);
			
			$tpl_data["RECEIVER"] = $booking->email;
			$messageToClient = $this->mail_tpl->hotel_payment_successful($tpl_data);
				
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> $subject." - ".$booking->fullname,
								"from_sender"	=> $booking->email,
	                            "name_sender"	=> $booking->fullname,
								"to_receiver"	=> MAIL_INFO,
	                            "message"		=> $messageToAdmin
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_INFO,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $booking->email,
	                            "message"		=> $messageToClient
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
		}
		
		$view_data["client_name"] = $booking->fullname;
		
		$tmpl_content['content']  = $this->load->view("payment/success", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	
	function failure($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		$errMsg = "";
		
		if (!empty($key))
		{
			$key = str_ireplace(".html", "", $key);
			
			$booking = $this->m_hotel->getBooking(NULL, $key);
			if ($booking != null)
			{
				$booking->hotel = $this->m_hotel->load($booking->hotel_id);
				$booking->paxs  = $this->m_hotel->getPaxs($booking->id);
				$booking->rooms = $this->m_hotel->getClasses($booking->id);
				
				// Create new account
				$user = $this->m_user->getUserByEmail($booking->email);
				
				// Send mail to sales department
				$tpl_data = array(
						"FULLNAME"					=> $booking->fullname,
						"PROMOTION"					=> 0,
						"DISCOUNT"					=> 0,
						"CHECKIN"					=> $booking->checkin,
						"CHECKOUT"					=> $booking->checkout,
						"TOTAL_FEE"					=> $booking->total_fee,
						"HOTEL"						=> $booking->hotel,
						"ROOMS"						=> $booking->rooms,
						"PAXS"						=> $booking->paxs,
						"EMAIL"						=> $booking->email,
						"PHONE"						=> $booking->phone,
						"MESSAGE"					=> $booking->message,
						"PAYMENT_METHOD"			=> $booking->payment,
						"NEW_ACCOUNT"				=> false,
						"USER_LOGIN"				=> $user->username,
						"PASSWORD"					=> $user->password_text,
				);
				
				$subject = "BOOKING #H".$booking->id.": Confirm Vietnam Hotel ".$booking->payment_method." Payment Failure";
				
				$tpl_data["RECEIVER"] = MAIL_INFO;
				$messageToAdmin  = $this->mail_tpl->hotel_payment_failure($tpl_data);
				
				$tpl_data["RECEIVER"] = $booking->primary_email;
				$messageToClient = $this->mail_tpl->hotel_payment_failure($tpl_data);
				
				// Send to SALE Department
				$mail = array(
		                            "subject"		=> $subject." - ".$booking->fullname,
									"from_sender"	=> $booking->email,
		                            "name_sender"	=> $booking->fullname,
									"to_receiver"	=> MAIL_INFO,
		                            "message"		=> $messageToAdmin
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				// Send confirmation to SENDER
				$mail = array(
		                            "subject"		=> $subject,
									"from_sender"	=> MAIL_INFO,
		                            "name_sender"	=> SITE_NAME,
									"to_receiver"	=> $booking->email,
		                            "message"		=> $messageToClient
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
			}
		}
		
		$view_data["client_name"] = $booking->fullname;
		
		$tmpl_content['content'] = $this->load->view("payment/failure", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>