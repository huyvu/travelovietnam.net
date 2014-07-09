<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuisines extends CI_Controller {

	public function index()
	{
		$cuisine_categories = $this->m_cuisine_category->getItems(NULL, 1);
		$cuisines = $this->m_cuisine->getItems(NULL, 1);
		$popular_cuisines = $this->m_cuisine->getItems(NULL, 1, 10);
		
		$view_data = "";
		$view_data['cuisine_categories']  = $cuisine_categories;
		$view_data['cuisines'] = $cuisines;
		$view_data['popular_cuisines']  = $popular_cuisines;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "Vietnam Cuisines - The favorite meals in Vietnam";
		$tmpl_content['content']   = $this->load->view("cuisine/index", $view_data, TRUE);
		$this->load->view('layout/cuisine', $tmpl_content);
	}
	
	public function category($category_alias=NULL)
	{
		$category = $this->m_cuisine_category->load($category_alias);
		$info->catid = $category->id;
		
		$cuisine_categories = $this->m_cuisine_category->getItems(NULL, 1);
		$cuisines = $this->m_cuisine->getItems($info, 1);
		$popular_cuisines = $this->m_cuisine->getItems($info, 1, 10);
		
		$view_data = "";
		$view_data['cuisine_category']  = $category;
		$view_data['cuisine_categories'] = $cuisine_categories;
		$view_data['cuisines'] = $cuisines;
		$view_data['popular_cuisines'] = $popular_cuisines;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "Vietnam Cuisines - The favorite meals in Vietnam";
		$tmpl_content['content']   = $this->load->view("cuisine/index", $view_data, TRUE);
		$this->load->view('layout/cuisine', $tmpl_content);
	}
	
	public function vietnam($category_alias=NULL, $cuisine_alias=NULL)
	{
		if (!empty($cuisine_alias)) {
			$this->view($cuisine_alias);
		}
		else if ($category_alias != NULL) {
			$this->category($category_alias);
		}
		else {
			$this->index();
		}
	}
	
	public function faqs()
	{
		$view_data = "";
		
		$tmpl_content['content']   = $this->load->view("cuisine/faqs", $view_data, TRUE);
		$this->load->view('layout/cuisine', $tmpl_content);
	}
	
	public function view($alias)
	{
		$item = $this->m_cuisine->load($alias);
		$related_cuisines = $this->m_cuisine->getRelatedItems($item->id);
		$cuisine_categories = $this->m_cuisine_category->getItems(NULL, 1);
		
		$review_info->category_id	= 5; // cuisine
		$review_info->ref_id		= $item->id;
		$review_info->topLevel		= 1;
		$reviews = $this->m_review->getItems($review_info, 1);
		
		$avg_rating = 3;
		foreach ($reviews as $review) {
			$avg_rating += $review->rating;
		}
		$avg_rating = round($avg_rating / (sizeof($reviews)+1));
		
		$view_data['cuisine_categories']= $cuisine_categories;
		
		$view_data["item"]				= $item;
		$view_data["avg_rating"]		= $avg_rating;
		$view_data["related_cuisines"]	= $related_cuisines;
		
		$review_data['category_id'] 	= $review_info->category_id;
		$review_data['ref_id']			= $item->id;
		$view_data["reviews"]			= $this->load->view("review/index", $review_data, TRUE);
		
		$question_data['category_id'] 	= $review_info->category_id;
		$question_data['ref_id']		= $item->id;
		$view_data["questions"]			= $this->load->view("answer/index", $question_data, TRUE);
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("cuisine/detail", $view_data, TRUE);
		$this->load->view('layout/cuisine', $tmpl_content);
	}
}

?>