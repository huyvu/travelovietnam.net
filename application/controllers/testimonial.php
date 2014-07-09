<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial extends CI_Controller {

	public function index()
	{
		$view_data = "";
		$view_data['reviews'] = $this->m_testimonial->getItems(NULL, 1);
		
		$tmpl_content = "";
		$tmpl_content['content']   = $this->load->view("testimonial/index", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function post()
	{
		$author			= (!empty($_POST["author"]) ? $_POST["author"] : "");
		$email			= (!empty($_POST["email"]) ? $_POST["email"] : "");
		$nationality	= (!empty($_POST["nationality"]) ? $_POST["nationality"] : "");
		$rating			= (!empty($_POST["rating"]) ? $_POST["rating"] : 1);
		$title			= (!empty($_POST["title"]) ? $_POST["title"] : "");
		$content		= (!empty($_POST["content"]) ? $_POST["content"] : "");
		$security_code	= (!empty($_POST["code"]) ? $_POST["code"] : "");
		
		if ($security_code == $this->util->getSecurityCode())
		{
			// Save
			$data = array (
				'author'		=> $author,
				'email'			=> $email,
				'nationality'	=> $nationality,
				'rating'		=> $rating,
				'title'			=> $title,
				'content'		=> $content,
			);
			$this->m_testimonial->add($data);
		}
	}
}

?>