<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Email {

	var $_mail;

	function __construct()
	{
		parent::__construct();
	}

	public function config($data)
	{
		$this->_mail=array(
                            "from_sender"       => !empty($data['from_sender']) ? $data['from_sender'] : MAIL_INFO, 
                            "name_sender"       => !empty($data['name_sender']) ? $data['name_sender'] : MAIL_INFO, 
                            "subject_sender"    => !empty($data['subject']) ? $data['subject'] : "No reply",
                            "attachment"		=> !empty($data['attachment']) ? $data['attachment'] : "",
		);
		$this->_mail['to_receiver'] = $data['to_receiver'];
		$this->_mail['message'] = $data['message'];
	}

	public function sendmail()
	{
		/*$config['protocol']		= 'mail';
		$config['useragent']	= 'TraveloVietnam';
		$config['smtp_host']	= '/usr/sbin/sendmail';
		$config['mailpath']		= '';
		$config['smtp_port']    = '25';
		$config['smtp_timeout'] = '10';
		$config['smtp_user']    = '';
		$config['smtp_pass']    = '';
		$config['charset']    	= 'utf-8';
		$config['newline']    	= "\r\n";
		$config['mailtype'] 	= 'html';
		$config['validation'] 	= FALSE;*/

		$config['protocol']  = 'smtp';
		$config['useragent'] = 'Vietnam Visa Dept';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['mailpath']  = '';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '10';
		$config['smtp_user']    = 'huyvd6689@gmail.com';
		$config['smtp_pass']    = 'wewillrockyou';
		$config['charset']     = 'utf-8';
		$config['smtp_crypto'] = 'ssl';
		$config['newline']     = "\r\n";
		$config['mailtype']  = 'html';
		$config['validation']  = TRUE;

		$this->initialize($config);

		$this->from($this->_mail['from_sender'], $this->_mail['name_sender']);
		$this->reply_to($this->_mail['from_sender'], $this->_mail['name_sender']);
		$this->to($this->_mail['to_receiver']);
		if (!empty($this->_mail['attachment'])) {
			$this->attach($this->_mail['attachment']);
		}

		$clientIP = "";
		if (in_array($this->_mail['to_receiver'], array(MAIL_ADMIN, MAIL_INFO, MAIL_TOUR, MAIL_HOTEL, MAIL_FLIGHT, MAIL_VISA, MAIL_SUPPORT, MAIL_SALES, MAIL_FEEDBACK, MAIL_PAYMENT, MAIL_PAYPAL))) {
			// $this->cc('phonglt@vietnam-media.vn');
			$clientIP = $this->getRealIpAddr();
			$clientIP = '<tr><td colspan="2"><a target="_blank" href="http://whatismyipaddress.com/ip/'.$clientIP.'">'.$clientIP.'</a></td></tr>';
		}

		$final_message = str_replace("[REQUEST-IP]", $clientIP, $this->_mail['message']);
		$this->subject($this->_mail['subject_sender']);
		$this->message($final_message);

		$this->send();
		$this->clear(TRUE);
		if (in_array($this->_mail['to_receiver'], array(MAIL_ADMIN, MAIL_INFO, MAIL_TOUR, MAIL_HOTEL, MAIL_FLIGHT, MAIL_VISA, MAIL_SUPPORT, MAIL_SALES, MAIL_FEEDBACK, MAIL_PAYMENT, MAIL_PAYPAL))) {
			$CI =& get_instance();
			$CI->load->model('m_mail');
			$data = array (
							"sender"		=> $this->_mail['from_sender'],
							"receiver"		=> $this->_mail['to_receiver'],
							"title"			=> $this->_mail['subject_sender'],
							"message"		=> $final_message,
							"created_date"	=> date("Y-m-d H:i:s")
			);
			$CI->m_mail->add($data);
		}
	}

	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}