<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vietnam extends CI_Controller {

	public function index()
	{
		$this->overview();
	}
	
	public function overview()
	{
		$info->catid = $this->m_content_category->load('vietnam-overview')->id;
		$items = $this->m_content->getItems($info, 1);
		
		$view_data = "";
		$view_data['items'] = $items;
		
		$tmpl_content = "";
		$tmpl_content['tabindex'] = "travel-guide";
		$tmpl_content['content'] = $this->load->view("vietnam/overview", $view_data, TRUE);
		$this->load->view('layout/vietnam', $tmpl_content);
	}
	
	public function snapshot($alias=NULL)
	{
		if (!empty($alias)) {
			$item = $this->m_content->load($alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			
			$tmpl_content = "";
			$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/snapshot/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else {
			$info->catid = $this->m_content_category->load('best-time-to-visit-vietnam')->id;
			$items = $this->m_content->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/snapshot/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function culture_geography_history()
	{
		$info->catid = $this->m_content_category->load('vietnam-culture-and-history')->id;
		$items = $this->m_content->getItems($info, 1);
		
		$view_data = "";
		$view_data['items'] = $items;
		
		$tmpl_content = "";
		$tmpl_content['tabindex'] = "travel-guide";
		$tmpl_content['content'] = $this->load->view("vietnam/culture", $view_data, TRUE);
		$this->load->view('layout/vietnam', $tmpl_content);
	}
	
	public function life_style($alias=NULL)
	{
		if (!empty($alias)) {
			$item = $this->m_content->load($alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			
			$tmpl_content = "";
			$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/lifestyle/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else {
			$info->catid = $this->m_content_category->load('vietnam-life-style')->id;
			$items = $this->m_content->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/lifestyle/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function festivals_events($alias=NULL)
	{
		if (!empty($alias)) {
			$item = $this->m_content->load($alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			
			$tmpl_content = "";
			$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/events/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else {
			$info->catid = $this->m_content_category->load('festivals-events')->id;
			$items = $this->m_content->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/events/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function travel_guide_for_beginner($alias=NULL)
	{
		if (!empty($alias)) {
			$item = $this->m_content->load($alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			
			$tmpl_content = "";
			$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/4beginner/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else {
			$info->catid = $this->m_content_category->load('travel-guide-for-beginner')->id;
			$items = $this->m_content->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/4beginner/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function travel_tips($alias=NULL)
	{
		if (!empty($alias)) {
			$item = $this->m_content->load($alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			
			$tmpl_content = "";
			$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/tips/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else {
			$info->catid = $this->m_content_category->load('vietnam-travel-tips')->id;
			$items = $this->m_content->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/tips/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function travel_insurances($alias=NULL)
	{
		if (!empty($alias)) {
			$item = $this->m_content->load($alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			
			$tmpl_content = "";
			$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/insurances/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else {
			$info->catid = $this->m_content_category->load('vietnam-travel-insurances')->id;
			$items = $this->m_content->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/insurances/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function travel_visa($alias=NULL)
	{
		if (!empty($alias)) {
			$item = $this->m_content->load($alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			
			$tmpl_content = "";
			$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/visa/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else {
			$info->catid = $this->m_content_category->load('vietnam-travel-visa')->id;
			$items = $this->m_content->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/visa/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function money_cost($alias=NULL)
	{
		if (!empty($alias)) {
			$item = $this->m_content->load($alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			
			$tmpl_content = "";
			$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
			$tmpl_content['meta']['keywords'] = $item->meta_key;
			$tmpl_content['meta']['description'] = $item->meta_desc;
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/money/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else {
			$info->catid = $this->m_content_category->load('vietnam-money-cost')->id;
			$items = $this->m_content->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "travel-guide";
			$tmpl_content['content'] = $this->load->view("vietnam/money/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function faqs()
	{
		$info->catid = $this->m_content_category->load('vietnam-faqs')->id;
		$items = $this->m_content->getItems($info, 1);
		
		$view_data = "";
		$view_data['items'] = $items;
		
		$tmpl_content = "";
		$tmpl_content['tabindex'] = "travel-guide";
		$tmpl_content['content'] = $this->load->view("vietnam/faqs", $view_data, TRUE);
		$this->load->view('layout/vietnam', $tmpl_content);
	}
	
	public function top_destinations($alias=NULL)
	{
		if (!empty($alias)) {
			if (in_array($alias, array("northern", "central", "southern"))) {
				$destination_info->region = $alias;
				$items = $this->m_vietnam_destination->getItems($destination_info, 1);
				
				$view_data = "";
				$view_data['region'] = $alias;
				$view_data['items']  = $items;
				
				$tmpl_content = "";
				$tmpl_content['tabindex'] = "destination";
				$tmpl_content['content'] = $this->load->view("vietnam/destinations/index", $view_data, TRUE);
				$this->load->view('layout/vietnam', $tmpl_content);
			}
			else {
				$destination = $this->m_tour_destination->load($alias);
				// Check error before load page content
				$this->util->checkPageError($destination);
				
				$info->destination_id = $destination->id;
				$item = $this->m_vietnam_destination->getItem($info, 1);
				
				$photoinfo->category_id = 9;
				$photoinfo->ref_id = $item->id;
				$photos = $this->m_photo->getItems($photoinfo, 1);
				
				$tour_info->going_to = $item->destination_id;
				$tours = $this->m_tour->getItems($tour_info, 1);
				$tags = (!empty($destination->tags))?explode(",", $destination->tags):'';
				//Limit tour with 3 items when display in Destination detail page
				$popular_tours = $this->m_tour->getItemsByTags($tags, $tour_info, 1, 3);

				$sight_info->destinations = array($destination->id);

				//all sights of current destination
				$sights = $this->m_sight->getItems($sight_info, 1);
				//limit 3 sights to display in top attraction
				$sight_info->top_choice = 1;
				$top_sights = $this->m_sight->getItems($sight_info, 1, 3);

				$restaurant_info->destinations = array($item->destination_id);
				$restaurants = $this->m_restaurant->getItems($restaurant_info, 1);
				//limit 3 sights to display in top restaurants
				$top_restaurants = $this->m_restaurant->getItems($restaurant_info, 1, 3);

				$shopping_info->destinations = array($item->destination_id);
				$shoppings = $this->m_shopping->getItems($shopping_info, 1);
				//limit 3 sights to display in top shopping
				$top_shoppings = $this->m_shopping->getItems($shopping_info, 1, 3);
				
				$entertainment_info->destinations = array($item->destination_id);
				$entertainments = $this->m_entertainment->getItems($entertainment_info, 1);
				//limit 3 sights to display in top shopping
				$top_entertainments = $this->m_entertainment->getItems($entertainment_info, 1, 3);
				
				$view_data = "";
				$view_data['item']   			= $item;
				$view_data['photos'] 			= $photos;
				$view_data['tours']  			= $tours;
				$view_data['popular_tours']  	= $popular_tours;
				$view_data['sights']  			= $sights;
				$view_data['top_sights']  		= $top_sights;
				$view_data['top_shoppings']  	= $top_shoppings;
				$view_data['shoppings']  		= $shoppings;
				$view_data['top_entertainments']= $top_entertainments;
				$view_data['entertainments']  	= $entertainments;
				$view_data['restaurants']  		= $restaurants;
				$view_data['top_restaurants']  	= $top_restaurants;
				$view_data['destination']		= $destination;
				
				$tmpl_content = "";
				$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
				$tmpl_content['meta']['keywords'] = $item->meta_key;
				$tmpl_content['meta']['description'] = $item->meta_desc;
				$tmpl_content['tabindex'] = "destination";
				$tmpl_content['content'] = $this->load->view("vietnam/destinations/detail", $view_data, TRUE);
				$this->load->view('layout/vietnam', $tmpl_content);
			}
		}
		else {
			$info->search = (!empty($_GET["search"]) ? $_GET["search"] : "");
			$items = $this->m_vietnam_destination->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "destination";
			$tmpl_content['content'] = $this->load->view("vietnam/destinations/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function video($category_alias=NULL, $album_alias=NULL)
	{
		if (!empty($album_alias))
		{
			$album = $this->m_album->load($album_alias);
			
			$data  = array('hit' => $album->hit+1);
			$where = array('id'  => $album->id);
			
			$this->m_album->update($data, $where);
			
			$video_info->album_id = $album->id;
			$video = $this->m_album_video->getItems($video_info, 1);
			
			$data  = array('hit' => $video[0]->hit+1);
			$where = array('id'  => $video[0]->id);
			
			$this->m_album_video->update($data, $where);
			
			$related_info->media_type = 1;
			$related_items = $this->m_album->getItems($related_info, 1);
			
			$view_data = "";
			$view_data['item']			= $video[0];
			$view_data['related_items']	= $related_items;
			
			$review_data['category_id'] 	= 11;
			$review_data['ref_id']			= $video[0]->id;
			$view_data["reviews"]			= $this->load->view("review/index", $review_data, TRUE);
			
			$question_data['category_id'] 	= 11;
			$question_data['ref_id']		= $video[0]->id;
			$view_data["questions"]			= $this->load->view("answer/index", $question_data, TRUE);
			
			$tmpl_content = "";
			$tmpl_content['tabindex']	= "travel-guide";
			$tmpl_content['content']	= $this->load->view("vietnam/video/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else if (!empty($category_alias))
		{
			$category = $this->m_album_category->load($category_alias);
			
			$info->category_id = $category->id;
			$info->media_type = 1; // Video
			$items = $this->m_album->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex']	= "travel-guide";
			$tmpl_content['content']	= $this->load->view("vietnam/video/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else
		{
			$info->media_type = 1; // Video
			$items = $this->m_album->getItems($info, 1);
			
			$view_data = "";
			$view_data['items'] = $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex']	= "travel-guide";
			$tmpl_content['content']	= $this->load->view("vietnam/video/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function photos($category_alias=NULL, $album_alias=NULL, $photo_alias=NULL)
	{
		if (!empty($photo_alias))
		{
			$item = $this->m_album_photo->load($photo_alias);
			
			$view_data = "";
			$view_data['item'] = $item;
			$view_data['current_url'] = current_url();
			$view_data['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->name);
			$view_data['meta']['keywords'] = $item->meta_key;
			$view_data['meta']['description'] = $item->meta_desc;
			$this->load->view('vietnam/photos/comment', $view_data);
		}
		else if (!empty($album_alias))
		{
			$album = $this->m_album->load($album_alias);
			
			$data  = array('hit' => $album->hit+1);
			$where = array('id'  => $album->id);
			
			$this->m_album->update($data, $where);
			
			$photo_info->album_id = $album->id;
			$photos = $this->m_album_photo->getItems($photo_info, 1);
			
			$related_info->media_type = 0;
			$related_items = $this->m_album->getItems($related_info, 1);
			
			$category = $this->m_album_category->load($category_alias);
			
			$categories = $this->m_album_category->getItems(NULL, 1);
			
			$view_data = "";
			$view_data['album']				= $album;
			$view_data['photos']			= $photos;
			$view_data['related_items']		= $related_items;
			$view_data['categories']		= $categories;
			$view_data['selected_category'] = $category;
			
			$tmpl_content = "";
			$tmpl_content['tabindex']	= "travel-guide";
			$tmpl_content['content']	= $this->load->view("vietnam/photos/detail", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else if (!empty($category_alias))
		{
			$category = $this->m_album_category->load($category_alias);
			
			$info->category_id = $category->id;
			$info->media_type = 0; // Photo
			$items = $this->m_album->getItems($info, 1);
			
			$categories = $this->m_album_category->getItems(NULL, 1);
			
			$view_data = "";
			$view_data['items']				= $items;
			$view_data['categories']		= $categories;
			$view_data['selected_category'] = $category;
			
			$tmpl_content = "";
			$tmpl_content['tabindex']	= "travel-guide";
			$tmpl_content['content']	= $this->load->view("vietnam/photos/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
		else
		{
			$info->media_type = 0; // Photo
			$items = $this->m_album->getItems($info, 1);
			
			$categories = $this->m_album_category->getItems(NULL, 1);
			
			$view_data = "";
			$view_data['items']			= $items;
			$view_data['categories']	= $categories;
			
			$tmpl_content = "";
			$tmpl_content['tabindex']	= "travel-guide";
			$tmpl_content['content']	= $this->load->view("vietnam/photos/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function sights($alias = NULL) {
		$dest = $this->m_vietnam_destination->load($alias);
		$sight = $this->m_sight->load($alias);

		if (!is_null($alias)) {
			if (!is_null($dest)) {
				$info->destinations = array($dest->destination_id);
				$items = $this->m_sight->getItems($info);
				$categories		= $this->m_sight->getAndCountCategories(1);
				$destinations	= $this->m_sight->getAndCountDestinations(1);

				$view_data = "";
				$view_data['categories']	= $categories;
				$view_data['destinations']	= $destinations;
				$view_data['items']			= $items;
				$view_data['dest']			= $dest;

				$tmpl_content = "";
				$tmpl_content['tabindex'] = "destination";
				$tmpl_content['content'] = $this->load->view("vietnam/sights/index", $view_data, TRUE);
				$this->load->view('layout/vietnam', $tmpl_content);
			}elseif (!is_null($sight)) {
				$item = $this->m_sight->load($alias);

				if (!empty($item)) {
					$destination = $this->m_tour_destination->load($item->city);
					$dest_info->destination_id = $destination->id;
					$dest = $this->m_vietnam_destination->getItem($dest_info,1);
					$tour_info->going_to = $item->city;
					// $tours = $this->m_tour->getItems($tour_info, 1);
					$tags = (!empty($destination->tags))?explode(",", $destination->tags):'';
					$tours = $this->m_tour->getItemsByTags($tags, $tour_info, 1, 3);
					
					$photoinfo->category_id = 11;
					$photoinfo->ref_id = $item->id;
					$photos = $this->m_photo->getItems($photoinfo, 1);

					$reviewinfo->category_id = 11;
					$reviewinfo->ref_id = $item->id;
					$reviews = $this->m_review->getItems($reviewinfo, 1);

					$sight_info->destinations = array($dest->destination_id);
					$sights = $this->m_sight->getItems($sight_info);

					$view_data['sights']	= $sights;	
					$view_data['item']  	= $item;
					$view_data['tours'] 	= $tours;
					$view_data['dest']		= $dest;
					$view_data['photos']	= $photos;
					$view_data['reviews']	= $reviews;

					$tmpl_content = "";
					$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
					$tmpl_content['meta']['keywords'] = $item->meta_key;
					$tmpl_content['meta']['description'] = $item->meta_desc;
					$tmpl_content['tabindex'] = "destination";
					$tmpl_content['content'] = $this->load->view("vietnam/sights/detail", $view_data, TRUE);
					$this->load->view('layout/vietnam', $tmpl_content);
				}else{
					redirect("error404", "location");
				}
			}
		}else{
			$search->destinations	= !empty($_POST["destination"]) ? $_POST["destination"] : array();
			$search->categories		= !empty($_POST["category"]) ? $_POST["category"] : array();
			
			$categories		= $this->m_sight->getAndCountCategories(1);
			$destinations	= $this->m_sight->getAndCountDestinations(1);
			$items			= $this->m_sight->getItems($search, 1);
			
			$view_data = "";
			$view_data['search']		= $search;
			$view_data['categories']	= $categories;
			$view_data['destinations']	= $destinations;
			$view_data['items']			= $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "destination";
			$tmpl_content['content'] = $this->load->view("vietnam/sights/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}

	public function entertainments($alias = NULL) {
		$dest = $this->m_vietnam_destination->load($alias);
		$entertainment = $this->m_entertainment->load($alias);

		if (!is_null($alias)) {
			if (!is_null($dest)) {
				$info->destinations = array($dest->destination_id);
				$items = $this->m_entertainment->getItems($info);
				$categories		= $this->m_entertainment->getAndCountCategories(1);
					$destinations	= $this->m_entertainment->getAndCountDestinations(1);

				$view_data = "";
				$view_data['categories']	= $categories;
				$view_data['destinations']	= $destinations;
				$view_data['items']			= $items;
				$view_data['dest']			= $dest;

				$tmpl_content = "";
				$tmpl_content['tabindex'] = "destination";
				$tmpl_content['content'] = $this->load->view("vietnam/entertainments/index", $view_data, TRUE);
				$this->load->view('layout/vietnam', $tmpl_content);
			}elseif (!is_null($entertainment)) {
				$item = $this->m_entertainment->load($alias);
				if (!empty($item)) {
					$destination = $this->m_tour_destination->load($item->city);
					$dest_info->destination_id = $destination->id;
					$dest = $this->m_vietnam_destination->getItem($dest_info,1);
					$tour_info->going_to = $item->city;
					// $tours = $this->m_tour->getItems($tour_info, 1);
					$tags = (!empty($destination->tags))?explode(",", $destination->tags):'';
					$tours = $this->m_tour->getItemsByTags($tags, $tour_info, 1, 3);
					
					$photoinfo->category_id = 13;
					$photoinfo->ref_id = $item->id;
					$photos = $this->m_photo->getItems($photoinfo, 1);

					$reviewinfo->category_id = 13;
					$reviewinfo->ref_id = $item->id;
					$reviews = $this->m_review->getItems($reviewinfo, 1);

					$entertainment_info->destinations = array($dest->destination_id);
					$entertainments = $this->m_entertainment->getItems($entertainment_info);

					$view_data['entertainments']	= $entertainments;	
					$view_data['item']  	= $item;
					$view_data['tours'] 	= $tours;
					$view_data['dest']		= $dest;
					$view_data['photos']	= $photos;
					$view_data['reviews']	= $reviews;

					$tmpl_content = "";
					$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
					$tmpl_content['meta']['keywords'] = $item->meta_key;
					$tmpl_content['meta']['description'] = $item->meta_desc;
					$tmpl_content['tabindex'] = "destination";
					$tmpl_content['content'] = $this->load->view("vietnam/entertainments/detail", $view_data, TRUE);
					$this->load->view('layout/vietnam', $tmpl_content);
				}else{
					redirect("error404", "location");
				}
			}
		}else{
			$search->destinations	= !empty($_POST["destination"]) ? $_POST["destination"] : array();
			$search->categories		= !empty($_POST["category"]) ? $_POST["category"] : array();
			
			$categories		= $this->m_entertainment->getAndCountCategories(1);
			$destinations	= $this->m_entertainment->getAndCountDestinations(1);
			$items			= $this->m_entertainment->getItems($search, 1);
			
			$view_data = "";
			$view_data['search']		= $search;
			$view_data['categories']	= $categories;
			$view_data['destinations']	= $destinations;
			$view_data['items']			= $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "destination";
			$tmpl_content['content'] = $this->load->view("vietnam/entertainments/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function restaurants($alias = NULL) {
		$dest = $this->m_vietnam_destination->load($alias);
		$restaurant = $this->m_restaurant->load($alias);

		if (!is_null($alias)) {
			if (!is_null($dest)) {
				$info->destinations = array($dest->destination_id);
				$items = $this->m_restaurant->getItems($info);
				$categories		= $this->m_restaurant->getAndCountCategories(1);
					$destinations	= $this->m_restaurant->getAndCountDestinations(1);

				$view_data = "";
				$view_data['categories']	= $categories;
				$view_data['destinations']	= $destinations;
				$view_data['items']			= $items;
				$view_data['dest']			= $dest;

				$tmpl_content = "";
				$tmpl_content['tabindex'] = "destination";
				$tmpl_content['content'] = $this->load->view("vietnam/restaurants/index", $view_data, TRUE);
				$this->load->view('layout/vietnam', $tmpl_content);
			}elseif (!is_null($restaurant)) {
				$item = $this->m_restaurant->load($alias);
				if (!empty($item)) {
					$destination = $this->m_tour_destination->load($item->city);
					$dest_info->destination_id = $destination->id;
					$dest = $this->m_vietnam_destination->getItem($dest_info,1);
					$tour_info->going_to = $item->city;
					// $tours = $this->m_tour->getItems($tour_info, 1);
					$tags = (!empty($destination->tags))?explode(",", $destination->tags):'';
					$tours = $this->m_tour->getItemsByTags($tags, $tour_info, 1, 3);
					
					$photoinfo->category_id = 15;
					$photoinfo->ref_id = $item->id;
					$photos = $this->m_photo->getItems($photoinfo, 1);

					$reviewinfo->category_id = 15;
					$reviewinfo->ref_id = $item->id;
					$reviews = $this->m_review->getItems($reviewinfo, 1);

					$restaurant_info->destinations = array($dest->destination_id);
					$restaurants = $this->m_restaurant->getItems($restaurant_info);

					$view_data['restaurants']	= $restaurants;	
					$view_data['item']  	= $item;
					$view_data['tours'] 	= $tours;
					$view_data['dest']		= $dest;
					$view_data['photos']	= $photos;
					$view_data['reviews']	= $reviews;

					$tmpl_content = "";
					$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
					$tmpl_content['meta']['keywords'] = $item->meta_key;
					$tmpl_content['meta']['description'] = $item->meta_desc;
					$tmpl_content['tabindex'] = "destination";
					$tmpl_content['content'] = $this->load->view("vietnam/restaurants/detail", $view_data, TRUE);
					$this->load->view('layout/vietnam', $tmpl_content);
				}else{
					redirect("error404", "location");
				}
			}
		}else{
			$search->destinations	= !empty($_POST["destination"]) ? $_POST["destination"] : array();
			$search->categories		= !empty($_POST["category"]) ? $_POST["category"] : array();
			
			$categories		= $this->m_restaurant->getAndCountCategories(1);
			$destinations	= $this->m_restaurant->getAndCountDestinations(1);
			$items			= $this->m_restaurant->getItems($search, 1);
			
			$view_data = "";
			$view_data['search']		= $search;
			$view_data['categories']	= $categories;
			$view_data['destinations']	= $destinations;
			$view_data['items']			= $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "destination";
			$tmpl_content['content'] = $this->load->view("vietnam/restaurants/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}
	
	public function shopping($alias = NULL) {
		$dest = $this->m_vietnam_destination->load($alias);
		$shopping = $this->m_shopping->load($alias);

		if (!is_null($alias)) {
			if (!is_null($dest)) {
				$info->destinations = array($dest->destination_id);
				$items = $this->m_shopping->getItems($info);
				$categories		= $this->m_shopping->getAndCountCategories(1);
					$destinations	= $this->m_shopping->getAndCountDestinations(1);

				$view_data = "";
				$view_data['categories']	= $categories;
				$view_data['destinations']	= $destinations;
				$view_data['items']			= $items;
				$view_data['dest']			= $dest;

				$tmpl_content = "";
				$tmpl_content['tabindex'] = "destination";
				$tmpl_content['content'] = $this->load->view("vietnam/shopping/index", $view_data, TRUE);
				$this->load->view('layout/vietnam', $tmpl_content);
			}elseif (!is_null($shopping)) {
				$item = $this->m_shopping->load($alias);
				if (!empty($item)) {
					$destination = $this->m_tour_destination->load($item->city);
					$dest_info->destination_id = $destination->id;
					$dest = $this->m_vietnam_destination->getItem($dest_info,1);
					$tour_info->going_to = $item->city;
					// $tours = $this->m_tour->getItems($tour_info, 1);
					$tags = (!empty($destination->tags))?explode(",", $destination->tags):'';
					$tours = $this->m_tour->getItemsByTags($tags, $tour_info, 1, 3);
					
					$photoinfo->category_id = 17;
					$photoinfo->ref_id = $item->id;
					$photos = $this->m_photo->getItems($photoinfo, 1);

					$reviewinfo->category_id = 17;
					$reviewinfo->ref_id = $item->id;
					$reviews = $this->m_review->getItems($reviewinfo, 1);

					$shopping_info->destinations = array($dest->destination_id);
					$shoppings = $this->m_shopping->getItems($shopping_info);

					$view_data['shoppings']	= $shoppings;	
					$view_data['item']  	= $item;
					$view_data['tours'] 	= $tours;
					$view_data['dest']		= $dest;
					$view_data['photos']	= $photos;
					$view_data['reviews']	= $reviews;

					$tmpl_content = "";
					$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->title);
					$tmpl_content['meta']['keywords'] = $item->meta_key;
					$tmpl_content['meta']['description'] = $item->meta_desc;
					$tmpl_content['tabindex'] = "destination";
					$tmpl_content['content'] = $this->load->view("vietnam/shopping/detail", $view_data, TRUE);
					$this->load->view('layout/vietnam', $tmpl_content);
				}else{
					redirect("error404", "location");
				}
			}
		}else{
			$search->destinations	= !empty($_POST["destination"]) ? $_POST["destination"] : array();
			$search->categories		= !empty($_POST["category"]) ? $_POST["category"] : array();
			
			$categories		= $this->m_shopping->getAndCountCategories(1);
			$destinations	= $this->m_shopping->getAndCountDestinations(1);
			$items			= $this->m_shopping->getItems($search, 1);
			
			$view_data = "";
			$view_data['search']		= $search;
			$view_data['categories']	= $categories;
			$view_data['destinations']	= $destinations;
			$view_data['items']			= $items;
			
			$tmpl_content = "";
			$tmpl_content['tabindex'] = "destination";
			$tmpl_content['content'] = $this->load->view("vietnam/shopping/index", $view_data, TRUE);
			$this->load->view('layout/vietnam', $tmpl_content);
		}
	}


	/**
	 * Insert review from attraction
	 */
	public function insertReview(){
		$author 		= $this->input->post('author');
		$email 			= $this->input->post('email');
		$content 		= htmlentities($this->input->post('content'));
		$ref_id 		= $this->input->post('ref_id');
		$rating 		= $this->input->post('rating');
		$nationality	= $this->input->post('nationality');
		$category_id	= $this->input->post('category_id');

		$data = array(
			'author' 		=> $author,
			'email' 		=> $email,
			'content' 		=> $content,
			'rating'		=> $rating,
			'nationality'	=> $nationality,
			'ref_id' 		=> $ref_id,
			'category_id' 	=> $category_id,
			'active'		=> 0
		);

		$this->m_review->add($data);

		// $subject = "[NOTIFICATION]New incomming comment for Blog post";
		// $tpl_data['CMT_ID'] = $this->db->insert_id();
		// $tpl_data['link'] = $link;
		// $tpl_data["RECEIVER"] = MAIL_ADMIN;
		// $messageToAdmin  = $this->mail_tpl->blog_comment($tpl_data);
		
		// // Send to SALE Department
		// $mail = array(
		// 	"subject"		=> $subject,
		// 	"from_sender"	=> $email,
		// 	"name_sender"	=> $name,
		// 	"to_receiver"	=> MAIL_ADMIN,
		// 	"message"		=> $messageToAdmin
		// );
		// $this->mail->config($mail);
		// $this->mail->sendmail();

		$message = 1;

		$result = array($message);
		echo json_encode($result);
	}

	public function addLatLng() {
		$view_data = "";
		$items = $this->m_restaurant->getGmapAddress(NULL,1);
		$view_data['items']			= $items;
		
		$tmpl_content = "";
		$tmpl_content['tabindex'] = "destination";
		$tmpl_content['content'] = $this->load->view("add_gmap", $view_data, TRUE);
		$this->load->view('layout/vietnam', $tmpl_content);
	}
}

?>