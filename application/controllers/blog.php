<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index($cat=NULL)
	{
		$info = new stdClass();
		if ($cat) {
			$catinfo = $this->m_blog_category->load($cat);
			$info->cat_id = $catinfo->id;	
		}
		
		$items = $this->m_blog->getItems($info, 1);
		$categories = $this->m_blog_category->getItems();
		
		$view_data = "";
		$view_data['items'] = $items;
		$view_data["navindex"] = "blog";
		$view_data["tabindex"] = "blog";
		$view_data['categories'] = $categories;
		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("blog/index", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}

	public function category($cat=NULL)
	{
		if (is_null($cat)) {
			redirect('blog/index','location');
		}else{
			$category = $this->m_blog_category->load($cat);
			$info = new stdClass();
			$info->cat_id = $category->id;
			$items = $this->m_blog->getItems($info, 1);
			$categories = $this->m_blog_category->getItems();

			$view_data = "";
			$view_data['items'] = $items;
			$view_data["navindex"] = "blog";
			$view_data["tabindex"] = "blog";
			$view_data['categories'] = $categories;
			$tmpl_content = "";
			$tmpl_content['content'] = $this->load->view("blog/index", $view_data, TRUE);
			$this->load->view('layout/tour', $tmpl_content);
		}
	}

	public function tags($tag=NULL)
	{
		if (is_null($tag)) {
			redirect('blog/index','location');
		}else{
			$items = $this->m_blog->getByTag($tag, 1);
			$categories = $this->m_blog_category->getItems();

			$view_data = "";
			$view_data['items'] = $items;
			$view_data["navindex"] = "blog";
			$view_data["tabindex"] = "blog";
			$view_data['categories'] = $categories;
			$tmpl_content = "";
			$tmpl_content['content'] = $this->load->view("blog/index", $view_data, TRUE);
			$this->load->view('layout/tour', $tmpl_content);
		}
	}

	public function view($alias=NULL)
	{
		$view_data = "";
		$tmpl_content = "";
		$view_data["tabindex"] = "blog";
		$item = $this->m_blog->load($alias);
		if ($item) {
			$comments = $this->m_blog_comment->getItems($item,1);
			$admin_comments = $this->m_blog_comment->getItems($item);
			$categories = $this->m_blog_category->getItems();

			$view_data["item"]			= $item;
			$view_data['comments']		= $comments;
			$view_data['admin_comments']= $admin_comments;
			$view_data['categories'] = $categories;
			$view_data['catindex'] = $item->cat_id;
			$tmpl_content['meta']['title'] = $item->title;
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['content']   = $this->load->view("blog/detail", $view_data, TRUE);
			$this->load->view('layout/tour', $tmpl_content);
		}else{
			$tmpl_content['content']   = $this->load->view("error404", $view_data, TRUE);
			$this->load->view('layout/tour', $tmpl_content);
		}
		
		
	}

	public function comment()
	{
		$name 			= (strlen($this->input->post('name')) < 1 )? 'Guest': $this->input->post('name');
		$email 			= $this->input->post('email');
		$avatar 		= $this->input->post('avatar');
		$content 		= htmlentities($this->input->post('content'));
		$blog_id 		= $this->input->post('blog_id');
		$created_time 	= $this->input->post('created_time');
		$parent_id		= $this->util->getValueOf($this->input->post('parent_id'), 0);
		$review_code	= $this->input->post("review-code");
		$link			= $this->input->post("link");

		if ($review_code == $this->util->getSecurityCode())
		{
			$data = array(
				'name' 		=> $name,
				'email' 	=> $email,
				'avatar' 	=> $avatar,
				'content' 	=> $content,
				'blog_id' 	=> $blog_id,
				'parent_id' => $parent_id,
				'active'	=> 0
			);

			$this->m_blog_comment->add($data);

			$subject = "[NOTIFICATION]New incomming comment for Blog post";
			$tpl_data['CMT_ID'] = $this->db->insert_id();
			$tpl_data['link'] = $link;
			$tpl_data["RECEIVER"] = MAIL_ADMIN;
			$messageToAdmin  = $this->mail_tpl->blog_comment($tpl_data);
			
			// Send to SALE Department
			$mail = array(
				"subject"		=> $subject,
				"from_sender"	=> $email,
				"name_sender"	=> $name,
				"to_receiver"	=> MAIL_ADMIN,
				"message"		=> $messageToAdmin
			);
			$this->mail->config($mail);
			$this->mail->sendmail();

			$message = "You have successfully submit your comment. We'll approve as soon as possible.";
		}else{
			$message = "The code you have entered is not valid. Please try with another.";
		}

		$result = array($message);
		echo json_encode($result);
	}

	public function active_comment() {
		$id = $this->input->post('id');
		$active = $this->input->post('active');

		$data = array ('active' => $active);

		$where = array ("id" => $id);
		$this->m_blog_comment->update($data, $where);

		echo json_encode($id);
	}
}
?>