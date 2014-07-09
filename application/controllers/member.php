<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'libraries/openid.php';

class Member extends CI_Controller {

	public function index()
	{
		$this->myaccount();
	}
	
	public function login()
	{
		if ($this->session->userdata('user')) {
			redirect('member/myaccount','location');
		}else{
			//create an openID object for Yahoo
			$yahoo = new Openid('www.travelovietnam.com');
			$yahoo->identity = 'https://me.yahoo.com';
			$yahoo->required = array(
				'namePerson',
				'contact/email',
				'person/gender' 
			);
			$yahoo->returnUrl = site_url('auth/openIDLogin');
			
			$view_data = "";
			$view_data['yahoo'] = $yahoo;
			$view_data['nations'] = $this->m_nation->getItems();
			$tmpl_content = "";
			$tmpl_content['content'] = $this->load->view("member/login", $view_data, TRUE);
			$this->load->view('layout/tour', $tmpl_content);
		}		
	}
	
	public function signup()
	{
		$task = $this->input->post("task");

		if ($task == "login") {
			$username = $this->input->post("username");
			$password = $this->input->post("password");
				
			if ($this->m_user->login($username, $password) == FALSE) {
				$this->session->set_flashdata("login_error", "Email or password is invalid. Try again.");
				redirect("member/login", "location");
			} else {
				//redirect to booking page to allow user to continue booking
				if($this->session->userdata('comeback_link')) {
					$redirect_url = $this->session->userdata('comeback_link');
					$this->session->unset_userdata('comeback_link');
					redirect($redirect_url);					
				}else{
					redirect("member/myaccount", "location");	
				}
			}
		}
		else if ($task == "register")
		{
			$nation				= explode("|", $this->input->post("nationality"));
			$fullname			= $this->input->post("fullname");
			$email				= $this->input->post("email");
			$nationality		= $nation[0];
			$phone				= '(+'.$nation[1].') '.$this->input->post("phone");
			$newpassword		= $this->input->post("newpassword");			
			$birthday			= $this->input->post("birthday");
			$title				= $this->input->post("gender");
			if ($title == 'Mr') {
				$gender = 1;
			}else{
				$gender = 0;
			}
			
			if ($this->m_user->isUserExist($email)) {
				$this->session->set_flashdata("register_error", "This email is in used. Please try with another.");
				redirect("member/login", "location");
			}
			
			$data = array(
				"username"		=> $email,
				"password"		=> md5($newpassword),
				"password_text"	=> $newpassword,
				"fullname"		=> $fullname,
				"email"			=> $email,
				"nationality"	=> $nationality,
				"phone"			=> $phone,
				"birthday"		=> date('Y-m-d', strtotime($birthday)),
				"title"			=> $title,
				"gender"		=> $gender,
				"user_type"		=> 2,
			);
			
			$this->m_user->add($data);
			//send email to user
			$tpl_data = "";
			$subject = "Welcome to Travelovietnam.com";
					
			$tpl_data["RECEIVER"] = $email;
			$tpl_data["FULLNAME"] = $fullname;
			$tpl_data["PASSWORD"] = $newpassword;
			$messageToClient = $this->mail_tpl->register_successful($tpl_data);

			// Send confirmation to user
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_INFO,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $email,
	                            "message"		=> $messageToClient
			);
			$this->mail->config($mail);
			$this->mail->sendmail();

			if ($this->m_user->login($email, $newpassword) == FALSE) {
				redirect("member/login", "location");
			} else {
				redirect("member/myaccount", "location");
			}
		}
		
		redirect("member/login", "location");
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("member/login", "location");
	}
	
	public function myaccount()
	{
		$this->util->requireUserLogin("member/login");
		
		$id = $this->session->userdata['user']['id'];
		$view_data = "";
		$view_data['nations']			= $this->m_nation->getItems();
		$view_data['tour_booking']		= $this->m_tour->bookByUser($id);
		$view_data['hotel_booking']		= $this->m_hotel->bookByUser($id);
		$view_data['flight_booking']	= $this->m_flight->bookByUser($id);
		$view_data['visa_booking']		= $this->m_visa->bookByUser($id);
		$tmpl_content = "";

		$uid      = $this->session->userdata['user']['uid'];
		$provider = $this->session->userdata['user']['provider'];
		//Get user that is not native user and don't have an email account
		$user = $this->m_user->getSocialUser($uid,$provider,'');
		//If user exists then navigate his/her to the profile tab of myaccount page
		if ($user != NULL) {
			if (empty($user->email)) {
				$view_data['focus'] = 'email';
				$view_data['user'] = $user;
				redirect("member/myprofile", "location");
			}   
		}	

		$tmpl_content['content'] = $this->load->view("member/myaccount", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);	    	
		
		
	}

	public function myprofile()
	{
		$this->load->helper('form');
		$view_data = "";
		$view_data['nations'] = $this->m_nation->getItems();
		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("member/editprofile", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}

	public function updateprofile()
	{
		$id 				= $this->input->post('user_id');
		$fullname			= $this->input->post("fullname");
		$email				= $this->input->post("email");
		$country_code		= $this->input->post('country_code');
		$phone				= '('.$country_code.')'.$this->input->post("phone");
		$nationality		= $this->input->post("nationality");
		$birthday			= $this->input->post("birthday");
		$gender				= $this->input->post("gender");
		$avatar				= $this->input->post("currentAvatar");

		$path = "./files/upload/user/$id/";
		if(!file_exists($path))
		{
		   mkdir($path);
		}
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $id;
		$config['max_size']	= '2000';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if ($_FILES['userfile']['name'] != ''){
			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('changepass_error', $this->upload->display_errors());
				redirect("member/myprofile", "location");
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());

				$image_data = $this->upload->data();
				$config = array(
					'source_image' => $image_data['full_path'] ,
					'new_image' => "./files/upload/user/$id/",
					'maintain_ratio' => true,
					'width' => 96,
					'height' => 96 
					);
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$avatar = base_url()."files/upload/user/$id/".$image_data['orig_name'];
			}
		}
		
		$data = array(
			"fullname"		=> $fullname,
			"email"			=> $email,
			"nationality"	=> $nationality,
			"phone"			=> $phone,
			"birthday"		=> date('Y-m-d', strtotime($birthday)),
			"gender"		=> $gender,
			'avatar'		=> $avatar
		);
		

		$this->m_user->update($data,array('id' => $id));
		//Update user session after editting their infomation
		$user = $this->m_user->load($id);
		$user_data = array();
		foreach($user as $key => $val){
			$user_data[$key] = $val;
		}
		
		$user_data["login"] = TRUE;
		$this->session->set_userdata('user', $user_data);
		$this->session->set_flashdata('changepass_success', 'Your information is successfully edited');
		redirect("member/myprofile", "location");
	}

	public function changepassword()
	{
		$view_data = "";
		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("member/changepassword", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}

	public function editpassword()
	{
		$id                 = $this->input->post('user_id');
		$currentPass        = $this->input->post('old-pass');
		$newPass            = $this->input->post('new-pass');

		$user = $this->m_user->load($id);
		if ($user != NULL) {
			if ($currentPass != $user->password_text) {
				//If user login with social account and doesn't have password before
				//then update their password without requiring current password
				if ($currentPass == '' && is_null($user->password_text)) {
					echo 'go here'; die();
					$this->m_user->update(array('password' => md5($newPass), 'password_text' => $newPass),array('id' => $id));
					$this->m_user->login($user->$email, $newPass);
					$this->session->set_flashdata('changepass_success','Your social password was successfully changed.');
					redirect("member/changepassword", "location");
				}
				else{
					//$view_data['tab'] = 'pass';
					$view_data['error_message'] = 'The current password is not correct. Please try again.';
					$tmpl_content['content'] = $this->load->view("member/changepassword", $view_data, TRUE);
					$this->load->view('layout/tour', $tmpl_content);	
				}
				
			}else {
				$this->m_user->update(array('password' => md5($newPass), 'password_text' => $newPass),array('id' => $id));
				$this->m_user->login($user->email, $newPass);
				$this->session->set_flashdata('changepass_success','Your password was successfully changed.');
				redirect("member/changepassword", "location");
			}
		}

	}

	public function forgotpassword()
	{
		$view_data = "";
		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("member/resetpassword", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}

	public function resetpassword()
	{
		$email = $this->input->post("email");
		$result = $this->m_user->getUserByEmail($email);
		if ($result != NULL) {
			$this->send_reset_password_email($email,$result->fullname);
			$view_data = "";
			$tmpl_content = "";
			$tmpl_content['content'] = $this->load->view("member/send_reset_pass_mail", $view_data, TRUE);
			$this->load->view('layout/tour', $tmpl_content);
		}else{
			$this->session->set_flashdata('reset_error','Sorry your email is not exist.Please try again or register new account.');
			redirect("member/forgotpassword", "location");
		}
	}

	public function send_reset_password_email($email,$fullname)
	{
		$email_code = md5(SITE_NAME.$fullname);
		$link		= site_url("member/reset_password_form/{$email}/{$email_code}");
		$tpl_data = "";
		$subject = "Request Reset password in Travelovietnam.com";
				
		$tpl_data["RECEIVER"] = $email;
		$messageToClient = $this->mail_tpl->reset_password($email,$fullname,$link);

		// Send confirmation to user
		$mail = array(
                            "subject"		=> $subject,
							"from_sender"	=> MAIL_INFO,
                            "name_sender"	=> SITE_NAME,
							"to_receiver"	=> $email,
                            "message"		=> $messageToClient
		);
		$this->mail->config($mail);
		$this->mail->sendmail();
	}

	public function reset_password_form($email, $email_code)
	{
		if (isset($email, $email_code)) {
			$email = rawurldecode($email);
			$email_hash = sha1($email.$email_code);
			$verified = $this->m_user->verify_reset_password_code($email,$email_code);

			if ($verified) {
				$view_data = "";
				$tmpl_content = "";
				$view_data['email'] = $email;
				$tmpl_content['content'] = $this->load->view("member/update_password", $view_data, TRUE);
				$this->load->view('layout/tour', $tmpl_content);
			}else{
				$view_data = "";
				$tmpl_content = "";
				$tmpl_content['content'] = $this->load->view("member/verify_reset_password_error", $view_data, TRUE);
				$this->load->view('layout/tour', $tmpl_content);
			}
		}
	}

	public function updatepassword()
	{
		$newPass 	= $this->input->post('newPass');
		$email 		= $this->input->post('email');

		$this->m_user->update(array('password' => md5($newPass), 'password_text' => $newPass),array('email' => $email));
		if ($this->m_user->login($email, $newPass) == FALSE) {
				$this->session->set_flashdata("login_error", "Email or password is invalid. Try again.");
				redirect("member/login", "location");
			} else {
				$this->session->set_flashdata('changepass_success','Your password was successfully changed.');
				redirect("member/myaccount", "location");
			}		
	}

	public function payment($book_id)
	{
		$this->util->requireUserLogin("member/login");
		
		$item = $this->m_tour->getBooking($book_id);
		if ($item->status == 1) {
			redirect("member/myaccount", "location");
		}
			
		$view_data = "";
		$view_data["book_id"] = $book_id;
		$view_data["item"] = $item;
		
		$tmpl_content['meta']['title'] = "Settle Payment";
		$tmpl_content['content']   = $this->load->view("member/payment", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function pay()
	{
		$this->util->requireUserLogin("member/login");
		
		if (!empty($_POST)) {
			
			$book_id = !empty($_POST["book_id"]) ? $_POST["book_id"] : 0;
			$payment = !empty($_POST["payment"]) ? $_POST["payment"] : "";
			
			$item = $this->m_tour->getBooking($book_id);
			
			$remaining = $item->total_fee;
			
			// Remaining amount have to pay
			if ($item->status) {
				$remaining = $item->total_fee - $item->paid;
			}
			
			if ($item->status == 1 && $remaining == 0) {
				redirect("member/myaccount", "location");
			}
			
			$data = array(
				"payment_method" => $payment,
			);
			$where = array("id" => $book_id, "user_id" => $this->session->userdata("logged_user")->id);
			$this->m_tour->update_booking($data, $where);
			
			// Payment
			if ($payment == 'OnePay') {
				//Redirect to OnePay
				$vpcURL = OP_PAYMENT_URL;
				
				$vpcOpt['Title']				= "Settle payment for Travelovietnam at ".SITE_NAME;
				$vpcOpt['AgainLink']			= urlencode($_SERVER['HTTP_REFERER']);
				$vpcOpt['vpc_Merchant']			= OP_MERCHANT;
				$vpcOpt['vpc_AccessCode']		= OP_ACCESSCODE;
				$vpcOpt['vpc_MerchTxnRef']		= 'm_'.$item->booking_key;
				$vpcOpt['vpc_OrderInfo']		= "T".$item->id;
				$vpcOpt['vpc_Amount']			= $remaining*100;
				$vpcOpt['vpc_ReturnURL']		= OP_RETURN_URL;
				$vpcOpt['vpc_Version']			= "2";
				$vpcOpt['vpc_Command']			= "pay";
				$vpcOpt['vpc_Locale']			= "en";
				$vpcOpt['vpc_TicketNo']			= $_SERVER['REMOTE_ADDR'];
				$vpcOpt['vpc_Customer_Email']	= $item->email;
				$vpcOpt['vpc_Customer_Id']		= $item->user_id;
				
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
			else if($payment == 'Paypal')
			{
				$totalAmount   = round($remaining);
				$item_name	= "Vietnam Tour booking";
				$quantity	= 1;
	
				$link = 'https://www.paypal.com/cgi-bin/webscr?';
				$link .= 'cmd=_xclick';
				$link .= '&business='.PAYPAL_BUSINESS;
				$link .= '&item_name='.$item_name;
				$link .= '&no_shipping=1';
				$link .= '&quantity='.$quantity;
				$link .= '&amount='.$totalAmount.' USD';
				$link .= '&no_note=1';
				$link .= '&currency_code=USD';
				$link .= '&return='.BASE_URL.'/payment/sucess/m_'.$item->booking_key;
				$link .= '&cancel_return='.BASE_URL.'/payment/failure/m_'.$item->booking_key;
				
				header('Location: '.$link);
				die();
			}
		}
		
		redirect("member/myaccount", "location");
	}
	
	function payment_success($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		if (!empty($key)) {
			$key = str_ireplace("m_", "", str_ireplace(".html", "", $key));
		}
		
		$booking = $this->m_tour->getBooking(NULL, $key);
		
		$data  = array( 'status' => 1, 'paid' => $booking->total_fee );
		$where = array( 'booking_key' => $key );
		
		$this->m_tour->update_booking($data, $where);
		
		$booking = $this->m_tour->getBooking(NULL, $key);
		if ($booking != null)
		{
			$tour = $this->m_tour->load($booking->tour_id);
			$paxs = $this->m_tour->getPaxs($booking->id);
			
			$arrdestination = explode(';', $tour->destinations);
			$destinations = array();
			
		    for ($i=0; $i < sizeof($arrdestination); $i++) {
		    	$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
		    }
		    
			// Create new account
			$user = $this->m_user->load($booking->user_id);
			
			// Send mail to sales department
			$tpl_data = array(
					"FULLNAME"					=> $booking->fullname,
					"TITLE"						=> $booking->title,
					"PROMOTION"					=> 0,
					"DISCOUNT"					=> 0,
					"TOUR_RATE"					=> $booking->tour_rate,
					"TOTAL_FEE"					=> $booking->total_fee,
					"PAID"						=> $booking->paid,
					"TOUR"						=> $tour,
					"DEPARTURE_DATE"			=> $booking->departure_date,
					"CLASSTYPE"					=> $booking->classtype,
					"DESTINATIONS"				=> $destinations,
					"PAXS"						=> $paxs,
					"ADULTS"					=> $booking->adults,
					"CHILDREN"					=> $booking->children,
					"INFANTS"					=> $booking->infants,
					"SUPPLEMENTS"				=> $booking->supplements,
					"SUPPLEMENT_RATE"			=> $booking->supplement_rate,
					"EMAIL"						=> $booking->email,
					"PHONE"						=> $booking->phone,
					"MESSAGE"					=> $booking->message,
					"PAYMENT_METHOD"			=> $booking->payment_method,
					"PAYMENT_OPTION"			=> "Full charge 100%",
					"NEW_ACCOUNT"				=> false,
					"USER_LOGIN"				=> $user->username,
					"PASSWORD"					=> $user->password_text,
			);
			
			$subject = "BOOKING #T".$booking->id.": Confirm Vietnam Tour ".$booking->payment_method." Payment Successful";
			
			$tpl_data["RECEIVER"] = MAIL_TOUR;
			$messageToAdmin  = $this->mail_tpl->tour_payment_successful($tpl_data);
			
			$tpl_data["RECEIVER"] = $booking->email;
			$messageToClient = $this->mail_tpl->tour_payment_successful($tpl_data);
				
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> $subject." - ".$booking->fullname,
								"from_sender"	=> $booking->email,
	                            "name_sender"	=> $booking->fullname,
								"to_receiver"	=> MAIL_TOUR,
	                            "message"		=> $messageToAdmin
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_TOUR,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $booking->email,
	                            "message"		=> $messageToClient
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
		}
		
		$view_data["client_name"] = $booking->fullname;
		
		$tmpl_content['content']  = $this->load->view("payment/success", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	function payment_failure($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		$errMsg = "";
		
		if (!empty($key))
		{
			$key = str_ireplace("m_", "", str_ireplace(".html", "", $key));
			
			$booking = $this->m_tour->getBooking(NULL, $key);
			if ($booking != null)
			{
				$tour = $this->m_tour->load($booking->tour_id);
				$paxs = $this->m_tour->getPaxs($booking->id);
				
				$arrdestination = explode(';', $tour->destinations);
				$destinations = array();
				
			    for ($i=0; $i < sizeof($arrdestination); $i++) {
			    	$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
			    }
			    
				// Create new account
				$user = $this->m_user->load($booking->user_id);
				
				$tpl_data = array(
						"FULLNAME"					=> $booking->fullname,
						"PROMOTION"					=> 0,
						"DISCOUNT"					=> 0,
						"TOUR_RATE"					=> $booking->tour_rate,
						"TOTAL_FEE"					=> $booking->total_fee,
						"PAID"						=> $booking->paid,
						"TOUR"						=> $tour,
						"DEPARTURE_DATE"			=> $booking->departure_date,
						"CLASSTYPE"					=> $booking->classtype,
						"DESTINATIONS"				=> $destinations,
						"PAXS"						=> $paxs,
						"ADULTS"					=> $booking->adults,
						"CHILDREN"					=> $booking->children,
						"INFANTS"					=> $booking->infants,
						"SUPPLEMENTS"				=> $booking->supplements,
						"SUPPLEMENT_RATE"			=> $booking->supplement_rate,
						"EMAIL"						=> $booking->email,
						"PHONE"						=> $booking->phone,
						"MESSAGE"					=> $booking->message,
						"PAYMENT_METHOD"			=> $booking->payment_method,
						"PAYMENT_OPTION"			=> "Full charge 100%",
						"NEW_ACCOUNT"				=> false,
						"USER_LOGIN"				=> $user->username,
						"PASSWORD"					=> $user->password_text,
				);
				
				$subject = "BOOKING #T".$booking->id.": Confirm Vietnam Tour ".$booking->payment_method." Payment Failure";
				
				$tpl_data["RECEIVER"] = MAIL_TOUR;
				$messageToAdmin  = $this->mail_tpl->tour_payment_failure($tpl_data);
				
				$tpl_data["RECEIVER"] = $booking->primary_email;
				$messageToClient = $this->mail_tpl->tour_payment_failure($tpl_data);
				
				// Send to SALE Department
				$mail = array(
		                            "subject"		=> $subject." - ".$booking->fullname,
									"from_sender"	=> $booking->email,
		                            "name_sender"	=> $booking->fullname,
									"to_receiver"	=> MAIL_TOUR,
		                            "message"		=> $messageToAdmin
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				// Send confirmation to SENDER
				$mail = array(
		                            "subject"		=> $subject,
									"from_sender"	=> MAIL_TOUR,
		                            "name_sender"	=> SITE_NAME,
									"to_receiver"	=> $booking->email,
		                            "message"		=> $messageToClient
				);
				//$this->mail->config($mail);
				//$this->mail->sendmail();
			}
		}
		
		$view_data["client_name"] = $booking->fullname;
		$view_data['booking'] = $booking;
		$view_data['tour'] = $tour;		
		$tmpl_content['content'] = $this->load->view("member/payment/failure", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
}
?>