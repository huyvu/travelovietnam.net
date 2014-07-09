<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller {

	public function index()
	{
		$this->contact();
	}
	
	public function contact()
	{
		$info->topLevel = 1;
		$othertickets = $this->m_help_question->getItems($info, 1);
		
		$view_data = "";
		$view_data["othertickets"] = $othertickets;
		$view_data["navindex"] = "contact";

		$tmpl_content = "";
		$tmpl_content['tabindex']  = "support";
		$tmpl_content['content']   = $this->load->view("help/contact", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function support()
	{
		$info->topLevel = 1;
		$othertickets = $this->m_help_question->getItems($info, 1);
		
		$view_data = "";
		$view_data["othertickets"] = $othertickets;
		$view_data["navindex"] = "support";

		$tmpl_content = "";
		$tmpl_content['tabindex']  = "support";
		$tmpl_content['content']   = $this->load->view("help/emailus", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function search()
	{
		$query = (!empty($_GET["q"]) ? $_GET["q"] : "");
		
		$info->query = $query;
		$items = $this->m_help_content->getItems($info, 1);
		
		$view_data = "";
		$view_data['items'] = $items;
		
		$tmpl_content = "";
		$tmpl_content['tabindex']  = "support";
		$tmpl_content['content']   = $this->load->view("help/items", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);		
	}
	
	public function category($calias="", $alias="")
	{
		if (!empty($alias))
		{
			$category = $this->m_help_category->load($calias);
			
			$item = $this->m_help_content->load($alias);
			
			$info->catid = $category->id;
			$info->exclude = $item->id;
			$otheritems = $this->m_help_content->getItems($info, 1);
			
			$qinfo->topLevel = 1;
			$qinfo->category_id = $category->id;
			$qinfo->status = 2;
			$questions = $this->m_help_question->getItems($qinfo, 1, 10);
			
			$view_data = "";
			$view_data['category'] = $category;
			$view_data['item'] = $item;
			$view_data['otheritems'] = $otheritems;
			$view_data['questions'] = $questions;
			
			$tmpl_content = "";
			$tmpl_content['tabindex']  = "support";
			$tmpl_content['content']   = $this->load->view("help/detail", $view_data, TRUE);
			$this->load->view('layout/tour', $tmpl_content);
		}
		else
		{
			$category = $this->m_help_category->load($calias);
			
			$info->catid = $category->id;
			$items = $this->m_help_content->getItems($info, 1);
			
			$qinfo->topLevel = 1;
			$qinfo->category_id = $category->id;
			$qinfo->status = 2;
			$questions = $this->m_help_question->getItems($qinfo, 1, 10);
			
			$view_data = "";
			$view_data['category'] = $category;
			$view_data['items'] = $items;
			$view_data['questions'] = $questions;
			
			$tmpl_content = "";
			$tmpl_content['tabindex']  = "support";
			$tmpl_content['content']   = $this->load->view("help/items", $view_data, TRUE);
			$this->load->view('layout/tour', $tmpl_content);
		}
	}
	
	public function questions()
	{
		$info->topLevel = 1;
		$items = $this->m_help_question->getItems($info, 1);
		
		$view_data = "";
		$view_data["items"] = $items;
		
		$tmpl_content = "";
		$tmpl_content['tabindex']  = "support";
		$tmpl_content['content']   = $this->load->view("help/questions", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function question($alias="")
	{
		$item = $this->m_help_question->load($alias);
		
		$info->topLevel = 1;
		$info->author   = $this->session->userdata("logged_user")->id;
		$info->exclude  = $item->id;
		$othertickets   = $this->m_help_question->getItems($info, 1);
		
		$view_data = "";
		$view_data["item"] = $item;
		$view_data["othertickets"] = $othertickets;
		$view_data["navindex"] = "support";
		
		$tmpl_content = "";
		$tmpl_content['tabindex']  = "support";
		$tmpl_content['content']   = $this->load->view("help/question", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function emailus()
	{
		$view_data = "";
		$view_data["navindex"] = "support";
		
		if (!empty($_POST)) {
			$fullname		= $this->input->post("fullname");
			$email			= $this->input->post("email");
			$subject		= $this->input->post("subject");
			$content		= $this->input->post("content");
			$security_code	= $this->input->post("security-code");
			
			if (strtoupper($security_code) == strtoupper($this->util->getSecurityCode()))
			{
				// Inform by mail
				$mail = array(
	            		"subject"		=> $subject,
						"from_sender"	=> $email,
	            		"name_sender"	=> $fullname,
						"to_receiver"   => MAIL_INFO, 
						"message"       => $content
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				$view_data["send_status"] = "OK";
			}
		}
		
		$tmpl_content = "";
		$tmpl_content['tabindex']  = "support";
		$tmpl_content['content']   = $this->load->view("help/emailus", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function newticket()
	{
		$this->util->requireUserLogin("member/login");
		
		$view_data = "";
		$view_data["navindex"] = "support";
		
		if (!empty($_POST))
		{
			$category_id	= $this->input->post("category_id");
			$subject		= $this->input->post("subject");
			$content		= $this->input->post("content");
			$security_code	= $this->input->post("security-code");
			$author			= $this->session->userdata('logged_user')->id;
			
			if (strtoupper($security_code) == strtoupper($this->util->getSecurityCode()))
			{
				$data = array (
						"author"		=> $author,
						"category_id"	=> $category_id,
						"title" 		=> $subject,
						"alias" 		=> $this->util->genTopicAlias($subject),
						"content"		=> nl2br($content),
						"parent_id"		=> 0,
						"active"		=> 0,
				);
				$this->m_help_question->add($data);
				
				// Inform by mail
				$mail = array(
	            		"subject"		=> $subject,
						"from_sender"	=> $this->session->userdata('logged_user')->user_email,
	            		"name_sender"	=> $this->session->userdata('logged_user')->user_fullname,
						"to_receiver"   => MAIL_INFO, 
						"message"       => $content
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				$view_data["send_status"] = "OK";
			}
		}
		
		$view_data["categories"] = $this->m_help_category->getItems(1);
		
		$tmpl_content = "";
		$tmpl_content['tabindex']  = "support";
		$tmpl_content['content']   = $this->load->view("help/newticket", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function replyticket()
	{
		$this->util->requireUserLogin("member/login");
		
		$view_data = "";
		$view_data["navindex"] = "support";
		
		if (!empty($_POST))
		{
			$parent_id		= $this->input->post("parent_id");
			$content		= $this->input->post("content");
			$author			= $this->session->userdata('logged_user')->id;
			
			$question		= $this->m_help_question->load($parent_id);
			
			$data = array (
					"author"		=> $author,
					"content"		=> nl2br($content),
					"parent_id"		=> $parent_id,
					"active"		=> 0,
			);
			$this->m_help_question->add($data);
			
			$question_author = $this->m_user->load($question->author);
			$answer_author = $this->session->userdata('logged_user');
			
			$mail_data = array(
				'fullname'	=> $question_author->user_fullname,
				'question'	=> $question,
				'answer'	=> nl2br($content),
			);
			
			$mail_tpl = $this->mail_tpl->ticket_reply($mail_data);
			
			if (!($this->session->userdata('root_addmin_logged_in') && $this->session->userdata('addmin_logged_in')))
			{
				// Mail to admin
				$mail = array(
	            		"subject"		=> $question->title,
						"from_sender"	=> $answer_author->user_email,
	            		"name_sender"	=> $answer_author->user_fullname,
						"to_receiver"   => MAIL_INFO,
						"message"       => $mail_tpl
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
			}
			
			if ($question_author->id != $answer_author->id)
			{
				// Mail to author
				$mail = array(
	            		"subject"		=> $question->title,
						"from_sender"	=> $answer_author->user_email,
	            		"name_sender"	=> $answer_author->user_fullname,
						"to_receiver"   => $question_author->user_email,
						"message"       => $mail_tpl
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
			}
			
			redirect("help/question/".$question->alias, "location");
		}
		
		redirect("help/mytickets", "location");
	}
	
	public function mytickets()
	{
		$this->util->requireUserLogin("help/signin");
		
		$qinfo->topLevel = 1;
		$qinfo->author = $this->session->userdata("logged_user")->id;
		$mytickets = $this->m_help_question->getItems($qinfo);
		
		$qinfo2->topLevel = 1;
		$qinfo2->status = 2;
		$othertickets = $this->m_help_question->getItems($qinfo2, 1, 10);
		
		$view_data = "";
		$view_data["mytickets"] = $mytickets;
		$view_data["othertickets"] = $othertickets;
		$view_data["navindex"] = "support";
		
		$tmpl_content = "";
		$tmpl_content['tabindex']  = "support";
		$tmpl_content['content']   = $this->load->view("help/mytickets", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function reopen($id=0)
	{
		$ticket = $this->m_help_question->load($id);
		if (!empty($ticket) && $ticket->author == $this->session->userdata('logged_user')->id) {
			$data = array(
				"status" => 0
			);
			$where = array(
				"id" => $ticket->id
			);
			$this->m_help_question->update($data, $where);
		}
		
		redirect("help/mytickets", "location");
	}
}

?>