<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_Online extends CI_Controller {

	public function index()
	{
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "Payment Online";
		$tmpl_content['content']   = $this->load->view("payment/online/index", NULL, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	function proceed()
	{
		if (!empty($_POST))
		{
			$checkOK	= true;
			$fullname	= (!empty($_POST["fullname"]) ? $_POST["fullname"] : "");
			$email		= (!empty($_POST["email"]) ? $_POST["email"] : "");
			$email2		= (!empty($_POST["email2"]) ? $_POST["email2"] : "");
			$booking_id	= (!empty($_POST["application_id"]) ? $_POST["application_id"] : "");
			$payfor		= (!empty($_POST["payfor"]) ? $_POST["payfor"] : "");
			$amount		= (!empty($_POST["amount"]) ? $_POST["amount"] : "");
			$note		= (!empty($_POST["note"]) ? $_POST["note"] : "");
			$payment	= (!empty($_POST["payment"]) ? $_POST["payment"] : "");
			$security_code = (!empty($_POST["security_code"]) ? $_POST["security_code"] : "");
			
			$checkOK = !empty($fullname) && !empty($email) && !empty($amount) && !empty($note) && !empty($payment);
			if ($checkOK == false)
			{
				redirect(BASE_URL_HTTPS."/payment-online.html", "back");
			}
			else
			{
				// Get book id
				$book_id = $this->util->GetNextValue("tv_payment", "id");
				
				// Booking key
				$key = "po_".md5(time());
				
				// Add to payment list
				$data = array(
					'id'				=> $book_id,
					'payment_key'		=> $key,
					'fullname'			=> $fullname,
					'primary_email'		=> $email,
					'secondary_email'	=> $email2,
					'booking_id'		=> $booking_id,
					'payfor'			=> implode(", ", $payfor),
					'amount'			=> $amount,
					'message'			=> $note,
					'payment_method'	=> $payment,
					'payment_date' 		=> date("Y-m-d H:i:s")
				);
				
				if ($this->m_payment->add($data))
				{
					if ($payment == 'Paypal')
					{
						// Send mail to sales department
						$tpl_data = array(
								"FULLNAME"				=> $fullname,
								"AMOUNT"				=> $amount,
								"PRIMARY_EMAIL"			=> $email,
								"SECONDARY_EMAIL"		=> $email2,
								"APPLICATION_ID"		=> $booking_id,
								"PAY_FOR"				=> implode(", ", $payfor),
								"NOT_4_PAYMENT"			=> $note,
								"PAYMENT_METHOD"		=> $payment,
						);
						
						$subject = "Payment #PO".$book_id.": Secure Payment Online Remind PP";
						$message = $this->mail_tpl->payment_online_remind($tpl_data);
						
						// Send to SALE Department
						$mail = array(
				                            "subject"		=> $subject." - ".$fullname,
											"from_sender"	=> $email,
				                            "name_sender"	=> $fullname,
											"to_receiver"	=> MAIL_INFO,
				                            "message"		=> $message
						);
						$this->mail->config($mail);
						$this->mail->sendmail();
						
						// Send confirmation to SENDER
						$mail = array(
				                            "subject"		=> $subject,
											"from_sender"	=> MAIL_INFO,
				                            "name_sender"	=> SITE_NAME,
											"to_receiver"	=> $email,
				                            "message"		=> $message
						);
						$this->mail->config($mail);
						$this->mail->sendmail();
					}
					
					// Payment
					if ($payment == 'OnePay') {
						//Redirect to OnePay
						$vpcURL = OP_PAYMENT_URL;
						
						$vpcOpt['Title']				= "Secure Payment Online";
						$vpcOpt['AgainLink']			= urlencode($_SERVER['HTTP_REFERER']);
						$vpcOpt['vpc_Merchant']			= OP_MERCHANT;
						$vpcOpt['vpc_AccessCode']		= OP_ACCESSCODE;
						$vpcOpt['vpc_MerchTxnRef']		= $key;
						$vpcOpt['vpc_OrderInfo']		= "PO".$book_id;
						$vpcOpt['vpc_Amount']			= $amount*100;
						$vpcOpt['vpc_ReturnURL']		= OP_RETURN_URL;
						$vpcOpt['vpc_Version']			= "2";
						$vpcOpt['vpc_Command']			= "pay";
						$vpcOpt['vpc_Locale']			= "en";
						$vpcOpt['vpc_TicketNo']			= $_SERVER['REMOTE_ADDR'];
						$vpcOpt['vpc_Customer_Email']	= $email;
						//$vpcOpt['vpc_Customer_Id']		= $user_id;
						
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
						$totalAmount   = round($amount);
						$productName   = "Secure Payment Online";
						$productNum    = 1;
						
						$link = 'https://www.paypal.com/cgi-bin/webscr?';
						$link .= 'cmd=_xclick';
						$link .= '&business='.PAYPAL_BUSINESS;
						$link .= '&item_name='.$productName;
						$link .= '&item_number='.$productNum;
						$link .= '&no_shipping=1';
						$link .= '&amount='.$totalAmount.' USD';
						$link .= '&no_note=1';
						$link .= '&currency_code=USD';
						$link .= '&return='.BASE_URL.'/payment/sucess/'.$key;
						$link .= '&cancel_return='.BASE_URL.'/payment/failure/'.$key;
						
						header('Location: '.$link);
						die();
					}
				}
			}
		}
		redirect(BASE_URL_HTTPS."/payment-online.html", "location");
	}
	
	function success($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		if (!empty($key)) {
			$key = str_ireplace(".html", "", $key);
		}
		
		// Redirect if this payment is not found or succed
		$payment = $this->m_payment->getItem(NULL, $key);
		if ($payment == null || $payment->status)
		{
			redirect(BASE_URL, "location");
			die();
		}
		// End redirect
		
		$client_name = "";
		
		$data  = array( 'status' => 1 );
		$where = array( 'payment_key' => $key );
		
		$this->m_payment->update($data, $where);
		
		$payment = $this->m_payment->getItem(NULL, $key);
		if ($payment != null)
		{
			$client_name = $payment->fullname;
			
			// Send mail to sales department
			$tpl_data = array(
					"FULLNAME"				=> $client_name,
					"AMOUNT"				=> $payment->amount,
					"PRIMARY_EMAIL"			=> $payment->primary_email,
					"SECONDARY_EMAIL"		=> $payment->secondary_email,
					"APPLICATION_ID"		=> $payment->booking_id,
					"PAY_FOR"				=> $payment->payfor,
					"NOT_4_PAYMENT"			=> $payment->message,
					"PAYMENT_METHOD"		=> $payment->payment_method,
			);
			
			$subject = "Payment #PO".$payment->id.": Secure Payment Online ".$payment->payment_method." Successful";
			$message = $this->mail_tpl->payment_online_successful($tpl_data);
			
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> $subject." - ".$client_name,
								"from_sender"	=> $payment->primary_email,
	                            "name_sender"	=> $client_name,
								"to_receiver"	=> MAIL_INFO,
	                            "message"		=> $message
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_INFO,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $payment->primary_email,
	                            "message"		=> $message
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
		}
		
		$view_data["client_name"] = $client_name;
		$tmpl_content['content']  = $this->load->view("payment/online/success", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	function failure($key="")
	{
		$client_name = "";
		
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		if (!empty($key))
		{
			$key = str_ireplace(".html", "", $key);
			
			$payment = $this->m_payment->getItem(NULL, $key);
			if ($payment != null) {
				$client_name = $payment->fullname;;
				
				// Send mail to sales department
				$tpl_data = array(
						"FULLNAME"				=> $client_name,
						"AMOUNT"				=> $payment->amount,
						"PRIMARY_EMAIL"			=> $payment->primary_email,
						"SECONDARY_EMAIL"		=> $payment->secondary_email,
						"APPLICATION_ID"		=> $payment->booking_id,
						"PAY_FOR"				=> $payment->payfor,
						"NOT_4_PAYMENT"			=> $payment->message,
						"PAYMENT_METHOD"		=> $payment->payment_method,
				);
				
				$subject = "Payment #PO".$payment->id.": Secure Payment Online ".$payment->payment_method." Failure";
				$message = $this->mail_tpl->payment_online_failure($tpl_data);
				
				// Send to SALE Department
				$mail = array(
		                            "subject"		=> $subject." - ".$client_name,
									"from_sender"	=> $payment->primary_email,
		                            "name_sender"	=> $client_name,
									"to_receiver"	=> MAIL_INFO,
		                            "message"		=> $message
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				// Send confirmation to SENDER
				$mail = array(
		                            "subject"		=> $subject,
									"from_sender"	=> MAIL_INFO,
		                            "name_sender"	=> SITE_NAME,
									"to_receiver"	=> $payment->primary_email,
		                            "message"		=> $message
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
			}
		}
		
		$view_data["client_name"] = $client_name;
		$view_data["errMsg"] = $this->session->flashdata('payment_error');
		$tmpl_content['content']   = $this->load->view("payment/online/cancel", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
}

?>