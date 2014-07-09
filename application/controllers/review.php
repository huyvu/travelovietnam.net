<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller {

	public function tour($id)
	{
		$view_data = "";
		$view_data['category_id'] = 1;
		$view_data['ref_id'] = $id;
		
		echo $this->load->view("review/index", $view_data, TRUE);
	}
	
	public function hotel($id)
	{
		$view_data = "";
		$view_data['category_id'] = 3;
		$view_data['ref_id'] = $id;
		
		echo $this->load->view("review/index", $view_data, TRUE);
	}

	public function post()
	{
		$author			= $this->input->post("author");
		$email			= $this->input->post("email");
		$nationality	= $this->input->post("nationality");
		$rating			= $this->input->post("rating");
		$title			= $this->input->post("title");
		$content		= $this->input->post("content");
		$category_id	= $this->input->post("category_id");
		$ref_id			= $this->input->post("ref_id");
		$security_code	= $this->input->post("code");
		
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
				'category_id'	=> $category_id,
				'ref_id'		=> $ref_id,
			);
			$this->m_review->add($data);
		}
	}
}

?>