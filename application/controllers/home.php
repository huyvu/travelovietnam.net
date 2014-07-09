<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$tour_categories = $this->m_tour_category->getItems(1);
		$tour_destinations = $this->m_tour_destination->getItems(1);
		
		$hotel_destinations = $this->m_hotel_destination->getItems(1);
		
		$catinfo->alias = "vietnam-highlights";
		$cat = $this->m_content_category->load($catinfo->alias);
		$info->catid = $cat->id;
		$vietnam_highlight = $this->m_content->getItem($info, 1);
		
		$tourinfo = NULL;
		$vietnam_highlight_tours = $this->m_tour->getItems($tourinfo, 1, 5);
		
		$catinfo->alias = "travel-news";
		$cat = $this->m_content_category->load($catinfo->alias);
		$info->catid = $cat->id;
		$vietnam_news = $this->m_content->getItems($info, 1, 3);
		
		$vietnam_cuisines = $this->m_cuisine->getItems(NULL, 1, 2);
		
		$view_data = "";
		$view_data['tour_categories']			= $tour_categories;
		$view_data['tour_destinations']			= $tour_destinations;
		$view_data['hotel_destinations']		= $hotel_destinations;
		$view_data['vietnam_highlight']			= $vietnam_highlight;
		$view_data['vietnam_highlight_tours']	= $vietnam_highlight_tours;
		$view_data['vietnam_news']				= $vietnam_news;
		$view_data['vietnam_cuisines']			= $vietnam_cuisines;
		
		$tmpl_content['content']   = $this->load->view("home", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>