<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function tour($alias)
	{
	}
	
	public function hotel($alias)
	{
		if (!empty($_POST))
		{
			$alias			= (!empty($_POST['alias']) ? $_POST['alias'] : "");
			$item_name		= (!empty($_POST['item_name']) ? $_POST['item_name'] : "");
			$description	= (!empty($_POST['description']) ? $_POST['description'] : "");
			$photos			= (!empty($_POST['photos']) ? $_POST['photos'] : "");
			$maps			= (!empty($_POST['maps']) ? $_POST['maps'] : "");
			$message		= (!empty($_POST['message']) ? $_POST['message'] : "");
			$security_code	= (!empty($_POST['security-code']) ? $_POST['security-code'] : "");
			
			if ($security_code != $this->util->getSecurityCode()) {
				redirect('report/hotel/'.$alias, 'location');
			}
			else {
				
				$tpl_data = array (
						'item_name'		=> $item_name,
						'description'	=> $description,
						'photos'		=> $photos,
						'maps'			=> $maps,
						'message'		=> nl2br($message),
				);
				$mail_message = $this->mail_tpl->report($tpl_data);
				
				// Send to SALE Department
				$mail = array(
	                            "subject"		=> "[Report] - ".$item_name,
								"from_sender"	=> "no-reply@travelovietnam.com",
	                            "name_sender"	=> "No Reply",
								"to_receiver"	=> MAIL_INFO,
	                            "message"		=> $mail_message
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				$this->load->view('report/sent');
			}
		}
		else {
			$view_data["item"] = $this->m_hotel->load($alias);
			$this->load->view('report/hotel', $view_data);
		}
	}
}

?>