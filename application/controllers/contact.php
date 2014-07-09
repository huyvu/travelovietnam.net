<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index()
	{
		redirect("help", "location");
		
		$view_data = "";

		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("contact/index", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}

	public function message()
	{
		$fullname	= $this->input->post("fullname");
		$email		= $this->input->post("email");
		$phone		= $this->input->post("phone");
		$message	= $this->input->post("message");
		$security_code = $this->input->post("security_code");
		
		if ($security_code == $this->util->getSecurityCode())
		{
			// Save
			$data = array (
				'fullname' => $fullname,
				'email' => $email,
				'phone' => $phone,
				'message' => $message,
			);
			$this->m_message->add($data);
			
			// Inform by mail
			$mail = array(
	            	"subject"		=> "[Contact] ".$fullname.(!empty($phone)?" - ".$phone:""),
					"from_sender"	=> $email,
	            	"name_sender"	=> $fullname,
					"to_receiver"   => MAIL_INFO,
					"message"       => $message
			);
			
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			$this->sent();
		}
		else {
			redirect("contact", "back");
		}
	}

	public function sent()
	{
		$tmpl_content['content'] = $this->load->view("contact/sent", NULL, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>