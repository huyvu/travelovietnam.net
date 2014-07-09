<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {

	public function index()
	{
	}
	
	public function signup()
	{
		$info->email = (!empty($_POST["email"]) ? trim($_POST["email"]) : "");
		if (empty($info->email)) {
			$title   = 'Error';
			$message = "Please input your email.";
		} else {
			$email = $this->m_subscribe->getEmail($info);
			if (!empty($email)) {
				if ($email[0]->active != 1) {
					$data  = array('active' => 1);
					$where = array('email' => $info->email);
					$this->m_subscribe->update($data, $where);
					$title = "Successful";
					$message = "Your email signup successful. Thank you!";
				} else {
					$title = "Error";
					$message = "Your email has been registered already. Please try with another email!";
				}
			} else {
				$data = array('email' => $info->email);
				$this->m_subscribe->add($data);
				$title = "Successful";
				$message = "Your email signup successful. Thank you!";
			}
		}
		$result = array($title, $message);
		echo json_encode($result);
	}

	public function unsubscribe()
	{
		$info = new stdClass();
		$info->email = (!empty($_GET["e"]) ? trim($_GET["e"]) : "");
		if (empty($info->email)) {
			$message = "Email is not match.";
		} else {
			$email = $this->m_subscribe->getEmail($info);
			if (!empty($email)) {
				if ($email[0]->active != 0) {
					$data  = array('active' => 0);
					$where = array('email' => $info->email);
					$this->m_subscribe->update($data, $where);
					$message = "Your email unsubscribe successful. Thanks for your supporting us!";
				} else {
					$message = "Your email unsubscribe successful. Thanks for your supporting us!";
				}
			} else {
				$isExist = (!is_null($this->m_visa->bookByEmail($info->email)) || !is_null($this->m_user->getUserByEmail($info->email)));
				if ($isExist) {
					$data = array(
						'email' => $info->email,
						'active' => 0
					);
					$this->m_subscribe->add($data);
					$message = "Your email unsubscribe successful. Thanks for your supporting us!";
				} else {
					$message = "Email is not match.";
				}
			}
		}
		
		$view_data = "";
		$view_data['message'] = $message;
		
		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("deal/unsubscribe", $view_data, TRUE);
		$this->load->view('layout/view', $tmpl_content);
	}
}

?>