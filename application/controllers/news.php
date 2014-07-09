<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public function index($offset=0)
	{
		$info->catid = $this->m_content_category->load('travel-news')->id;
		$news = $this->m_content->getItems($info, 1);
		
		$view_data = "";
		$view_data['offset'] = $offset;
		$view_data['items']  = $news;
		
		$tmpl_content = "";
		$tmpl_content['content']   = $this->load->view("news/index", $view_data, TRUE);
		$this->load->view('layout/news', $tmpl_content);
	}
	
	public function view($alias="")
	{
		$info->alias = $alias;
		$item = $this->m_content->getItem($info, 1);
		
		$review_info->category_id	= 7; // news
		$review_info->ref_id		= $item->id;
		$review_info->topLevel		= 1;
		$reviews = $this->m_review->getItems($review_info, 1);
		
		$avg_rating = 3;
		foreach ($reviews as $review) {
			$avg_rating += $review->rating;
		}
		$avg_rating = round($avg_rating / (sizeof($reviews)+1));
		
		$view_data = "";
		$view_data['item'] = $item;
		$view_data["avg_rating"]		= $avg_rating;
		
		$review_data['category_id'] 	= $review_info->category_id;
		$review_data['ref_id']			= $item->id;
		$view_data["reviews"]			= $this->load->view("review/index", $review_data, TRUE);
		
		$question_data['category_id'] 	= $review_info->category_id;
		$question_data['ref_id']		= $item->id;
		$view_data["questions"]			= $this->load->view("answer/index", $question_data, TRUE);
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = $item->title;
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("news/detail", $view_data, TRUE);
		$this->load->view('layout/news', $tmpl_content);
	}
}

?>