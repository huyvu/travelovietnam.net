<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deal extends CI_Controller {

	public function index()
	{
	}
	
	public function subscribe()
	{
		$info->email = (!empty($_POST["email"]) ? trim($_POST["email"]) : "");
		if (empty($info->email)) {
			echo "Please input your email.";
		} else {
			$email = $this->m_subscribe->getEmail($info);
			if (!empty($email)) {
				if ($email[0]->active != 1) {
					$data  = array('active' => 1);
					$where = array('email' => $info->email);
					$this->m_subscribe->update($data, $where);
					echo "Your email signup successful. Thank you!";
				} else {
					echo "Your email has been registered already. Please try with another email!";
				}
			} else {
				$data = array('email' => $info->email);
				$this->m_subscribe->add($data);
				echo "Your email signup successful. Thank you!";
			}
		}
	}
}

?>