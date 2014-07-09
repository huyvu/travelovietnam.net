<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {

	public function send()
	{
		if (!empty($_POST))
		{
			$fullname = $this->input->post("fbname");
			$email = $this->input->post("fbemail");
			$content = $this->input->post("fbcontent");
			$security_code = $this->input->post("fcode");
				
			if (strtoupper($security_code) == strtoupper($this->util->getSecurityCode()))
			{
				// Inform by mail
				$mail = array(
					"subject"		=> "[Feedback] ".$fullname,
					"from_sender"	=> $email,
					"name_sender"	=> $fullname,
					"to_receiver"   => MAIL_INFO, 
					"message"       => $content
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
			}
		}
	}
}

?>