<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller {

	public function hotel($alias)
	{
		if (!empty($_POST))
		{
			$alias			= (!empty($_POST['alias']) ? $_POST['alias'] : "");
			$from			= (!empty($_POST['from']) ? $_POST['from'] : "");
			$to				= (!empty($_POST['to']) ? $_POST['to'] : "");
			$subject		= (!empty($_POST['subject']) ? $_POST['subject'] : "");
			$message		= (!empty($_POST['message']) ? $_POST['message'] : "");
			$security_code	= (!empty($_POST['security-code']) ? $_POST['security-code'] : "");
			
			if ($security_code != $this->util->getSecurityCode()) {
				redirect('invite/hotel/'.$alias, 'location');
			}
			else {
				
				$mail_message = nl2br($message).'<br><br><p>Shared URL: '.'<a title="'.$subject.'" href="'.$url.'">'.$url.'</a>';
				
				// Send to SALE Department
				$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> $from,
	                            "name_sender"	=> $from,
								"to_receiver"	=> $to,
	                            "message"		=> $mail_message
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				$this->load->view('invite/sent');
			}
		}
		else {
			$view_data["item"] = $this->m_hotel->load($alias);
			$this->load->view('invite/hotel', $view_data);
		}
	}
}

?>