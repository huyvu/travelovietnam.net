<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answer extends CI_Controller {

	public function post()
	{
		$fullname		= $this->input->post("fullname");
		$email			= $this->input->post("email");
		$nationality	= $this->input->post("nationality");
		$title			= $this->input->post("title");
		$content		= $this->input->post("content");
		$category_id	= $this->input->post("category_id");
		$ref_id			= $this->input->post("ref_id");
		$security_code	= $this->input->post("code");
		
		if ($security_code == $this->util->getSecurityCode())
		{
			// Save
			$data = array (
				'fullname'		=> $fullname,
				'email'			=> $email,
				'nationality'	=> $nationality,
				'title'			=> $title,
				'content'		=> $content,
				'category_id'	=> $category_id,
				'ref_id'		=> $ref_id,
			);
			$this->m_question->add($data);
		}
	}
}

?>