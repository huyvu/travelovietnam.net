<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tours extends CI_Controller {

	public function index()
	{
		$featured_tour_info = new stdClass();
		$featured_tour_info->featured = 1;
		$featured_tours = $this->m_tour->getItems($featured_tour_info, 1);
		
		$promotion_tour_info = new stdClass();
		$promotion_tour_info->promotion = 1;
		$promotion_tours = $this->m_tour->getItems($promotion_tour_info, 1);
		
		$popular_tour_info = new stdClass();
		$popular_tour_info->popular = 1;
		$popular_tours = $this->m_tour->getItems($popular_tour_info, 1);
		
		$categories = $this->m_tour_category->getItems(1);
		
		$destinations = $this->m_tour_destination->getItems(1);
		
		$view_data = "";
		$view_data['featured_tours']	= $featured_tours;
		$view_data['promotion_tours']	= $promotion_tours;
		$view_data['popular_tours']		= $popular_tours;
		$view_data['categories']		= $categories;
		$view_data['destinations']		= $destinations;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "Vietnam Tours - Planning tours to Vietnam with the best offers";
		$tmpl_content['content'] = $this->load->view("tour/index", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function ajax_get_destinations()
	{
		$fromcity = $this->input->post('fromcity');
		
		$tour_info->depart_from = $fromcity;
		$tours = $this->m_tour->getItems($tour_info, 1);
		
		$arr_destinations = array();
		foreach ($tours as $tour) {
			$arr_destinations = array_merge($arr_destinations, explode(";", $tour->destinations));
		}
		
		$arr_destinations = array_unique($arr_destinations);
		
		$destinations = $this->m_tour_destination->getItems(1);
		
        $return = '<option value="">All Destinations</option>';
        
		foreach ($destinations as $destination) {
			if (in_array($destination->id, $arr_destinations)) {
				$return .= '<option value="' . $destination->id . '">' . $destination->name . '</option>';
			}
		}
		
		echo $return;
    }
	
	public function vietnam($destination_alias=NULL, $category_alias=NULL, $tour_alias=NULL, $view=NULL)
	{
		if (!empty($tour_alias)) {
			if ($view == 'availability') {
				$this->availability($tour_alias);
			}
			else if ($view == 'tripnote') {
				$this->tripnote($tour_alias);
			}
			else if ($view == 'reviews') {
				$this->reviews($tour_alias);
			}
			else {
				$this->view($tour_alias);
			}
		}
		else if (!empty($category_alias)) {
			$this->style($category_alias);
		}
		else if (!empty($destination_alias)) {
			$this->destination($destination_alias);
		}
		else {
			$this->index();
		}
	}
	
	public function clear_filter()
	{
		redirect("tours/search", "location");
	}
	
	public function promotions()
	{
		$link = site_url("tours/search")."?smode=filter&price=&duration=&promotion=1";
		
		header('Location: '.$link);
	}
	
	public function popular()
	{
		$link = site_url("tours/search")."?smode=filter&price=&duration=&popular=1";
		
		header('Location: '.$link);
	}
	
	public function search()
	{
		$tour_search = new stdClass();
		
		if (!empty($_GET))
		{
			$tour_search->search_type = !empty($_GET["smode"]) ? $_GET["smode"] : "";
			
			if ($tour_search->search_type == "quick") {
				// Quick Finder
				$tour_search->search_text		= !empty($_GET["q"]) ? $_GET["q"] : "";
				
				$tour_search->duration			= "";
				$tour_search->price				= "";
				
				$tour_search->best_seller		= "";
				$tour_search->promotion			= "";
				$tour_search->popular			= "";
				
				$tour_search->types				= array();
				
				$tour_search->regions			= array();
				$tour_search->destinations		= array();
				$tour_search->categories		= array();
				
				$tour_search->depart_from		= "";
				$tour_search->going_to			= "";
				$tour_search->category_id		= "";
			}
			else if ($tour_search->search_type == "filter") {
				// Filter Options
				$tour_search->search_text		= "";
				
				$tour_search->duration			= !empty($_GET["duration"]) ? $_GET["duration"] : "";
				$tour_search->price				= !empty($_GET["price"]) ? $_GET["price"] : "";
				
				$tour_search->best_seller		= !empty($_GET["bestseller"]) ? $_GET["bestseller"] : "";
				$tour_search->promotion			= !empty($_GET["promotion"]) ? $_GET["promotion"] : "";
				$tour_search->popular			= !empty($_GET["popular"]) ? $_GET["popular"] : "";
				
				$tour_search->types				= !empty($_GET["type"]) ? $_GET["type"] : array();
				
				$tour_search->regions			= !empty($_GET["region"]) ? $_GET["region"] : array();
				$tour_search->destinations		= !empty($_GET["destination"]) ? $_GET["destination"] : array();
				$tour_search->categories		= !empty($_GET["category"]) ? $_GET["category"] : array();
				
				$tour_search->depart_from		= "";
				$tour_search->going_to			= "";
				$tour_search->category_id		= "";
			}
			else {
				// Normal Search
				$tour_search->search_text		= "";
				
				$tour_search->best_seller		= "";
				$tour_search->promotion			= "";
				$tour_search->popular			= "";
				
				$tour_search->types				= array();
				
				$tour_search->regions			= array();
				$tour_search->destinations		= array();
				$tour_search->categories		= array();
				
				$tour_search->depart_from		= !empty($_GET["fromcity"]) ? $_GET["fromcity"] : "";
				$tour_search->going_to			= !empty($_GET["tocity"]) ? $_GET["tocity"] : "";
				$tour_search->duration			= !empty($_GET["duration"]) ? $_GET["duration"] : "";
				$tour_search->price				= !empty($_GET["price"]) ? $_GET["price"] : "";
				$tour_search->category_id		= !empty($_GET["category"]) ? $_GET["category"] : "";
			}
			
			$tour_search->sortby  			= !empty($_GET["sortby"]) ? $_GET["sortby"] : "newest";
			$tour_search->orderby 			= !empty($_GET["orderby"]) ? $_GET["orderby"] : "asc";
		}
		
		// Exactly search
		$items = $this->m_tour->getItems($tour_search, 1);
		
		// Regular search
		$tour_search->search_regular = 1;
		$regular_items = $this->m_tour->getItems($tour_search, 1);
		
		// Remove duplicated tours
		foreach ($regular_items as $regular_item) {
			$found = FALSE;
			foreach ($items as $item) {
				if ($regular_item->id == $item->id) {
					$found = TRUE;
				}
			}
			if (!$found) {
				array_push($items, $regular_item);
			}
		}
		
		$view_data = "";
		$view_data['items']			= $items;
		$view_data['categories']	= $this->m_tour_category->getAndCountTourItems(1);
		$view_data['destinations']	= $this->m_tour_destination->getAndCountTourItems(1);
		$view_data['search']		= $tour_search;
		
		$tmpl_content['content']   = $this->load->view("tour/search", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function remove_shortlist()
	{
		$tour_id = (!empty($_POST["tour-id"]) ? $_POST["tour-id"] : 0);
		
		$shortlist = $this->session->userdata("tour_shortlist");
		if (!empty($shortlist)) {
			if (array_key_exists($tour_id, $shortlist)) {
				unset($shortlist[$tour_id]);
				$this->session->set_userdata("tour_shortlist", $shortlist);
			}
		}
		
		$this->session->set_userdata("tour_shortlist", $shortlist);
		
		$view_data = array();
		$view_data['shortlist'] = $shortlist;
		
		echo $this->load->view('module/tour/shortlist', $view_data);
	}
	
	public function shortlist()
	{
		$tour_id = (!empty($_POST["tour-id"]) ? $_POST["tour-id"] : 0);
		
		$shortlist = $this->session->userdata("tour_shortlist");
		if (empty($shortlist)) {
			$shortlist = array();
		}
		
		if (!array_key_exists($tour_id, $shortlist)) {
			$tour = $this->m_tour->load($tour_id);
			if (!empty($tour)) {
				$shortlist[$tour->id] = $tour;
			}
		}
		
		$this->session->set_userdata("tour_shortlist", $shortlist);
		
		$view_data = array();
		$view_data['shortlist'] = $shortlist;
		
		echo $this->load->view('module/tour/shortlist', $view_data);
	}
	
	public function myshortlist()
	{
		$shortlist = $this->session->userdata("tour_shortlist");
		
		$sortby  = !empty($_GET["sortby"]) ? $_GET["sortby"] : "newest";
		$orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : "asc";
		$remove  = !empty($_GET["remove"]) ? $_GET["remove"] : 0;
		
		if (!empty($remove)) {
			if (!empty($shortlist)) {
				if (array_key_exists($remove, $shortlist)) {
					unset($shortlist[$remove]);
					$this->session->set_userdata("tour_shortlist", $shortlist);
				}
			}
		}
		
		$items = array();
		
		foreach ($shortlist as $item) {
			$items[] = $item;
		}
		
		$length = sizeof($items);
		
		switch ($sortby)
		{
			case "newest":
				for ($i1=0; $i1 < $length-1; $i1++) {
					for ($i2=($i1+1); $i2 < $length; $i2++) {
						$canswap = false;
						if ($orderby == "asc") {
							if (strtotime($items[$i1]->created_date) > strtotime($items[$i2]->created_date)) {
								$canswap = true;
							}
						} else {
							if (strtotime($items[$i1]->created_date) < strtotime($items[$i2]->created_date)) {
								$canswap = true;
							}
						}
						if ($canswap) {
							$tmp = $items[$i1];
							$items[$i1]	= $items[$i2];
							$items[$i2]	= $tmp;
						}
					}
				}
				break;
			case "price":
				for ($i1=0; $i1 < $length-1; $i1++) {
					for ($i2=($i1+1); $i2 < $length; $i2++) {
						$canswap = false;
						if ($orderby == "asc") {
							if ($items[$i1]->price > $items[$i2]->price) {
								$canswap = true;
							}
						} else {
							if ($items[$i1]->price < $items[$i2]->price) {
								$canswap = true;
							}
						}
						if ($canswap) {
							$tmp = $items[$i1];
							$items[$i1]	= $items[$i2];
							$items[$i2]	= $tmp;
						}
					}
				}
				break;
			case "duration":
				for ($i1=0; $i1 < $length-1; $i1++) {
					for ($i2=($i1+1); $i2 < $length; $i2++) {
						$canswap = false;
						if ($orderby == "asc") {
							if ($items[$i1]->duration > $items[$i2]->duration) {
								$canswap = true;
							}
						} else {
							if ($items[$i1]->duration < $items[$i2]->duration) {
								$canswap = true;
							}
						}
						if ($canswap) {
							$tmp = $items[$i1];
							$items[$i1]	= $items[$i2];
							$items[$i2]	= $tmp;
						}
					}
				}
				break;
			case "name":
				for ($i1=0; $i1 < $length-1; $i1++) {
					for ($i2=($i1+1); $i2 < $length; $i2++) {
						$canswap = false;
						if ($orderby == "asc") {
							if ($items[$i1]->name > $items[$i2]->name) {
								$canswap = true;
							}
						} else {
							if ($items[$i1]->name < $items[$i2]->name) {
								$canswap = true;
							}
						}
						if ($canswap) {
							$tmp = $items[$i1];
							$items[$i1]	= $items[$i2];
							$items[$i2]	= $tmp;
						}
					}
				}
				break;
		}
		
		$view_data = array();
		$view_data['sortby']  = $sortby;
		$view_data['orderby'] = $orderby;
		$view_data['items']   = $items;
		
		$tmpl_content['content']   = $this->load->view("tour/myshortlist", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function package_tours()
	{
		$this->search();
	}
	
	public function short_tours()
	{
		$this->search();
	}
	
	public function daily_tours()
	{
		$this->search();
	}
	
	public function deals()
	{
		$this->search();
	}
	
	public function style($alias=NULL)
	{
		$category = $this->m_tour_category->load($alias);
		
		$link = site_url("tours/search")."?smode=filter&price=&duration=&category[]=".$category->id;
		
		header('Location: '.$link);
	}
	
	public function destination($alias=NULL)
	{
		$tour_search = new stdClass();
		
		if ($alias == 'throughout-vietnam') {
			//$tour_search->regions = array('Throughout');
			$link = site_url("tours/search")."?smode=filter&price=&duration=&type[]=throughout";
			header('Location: '.$link);
		}
		else if ($alias == 'northern-vietnam') {
			$tour_search->regions = array('Northern');
		}
		else if ($alias == 'central-vietnam') {
			$tour_search->regions = array('Central');
		}
		else if ($alias == 'southern-vietnam') {
			$tour_search->regions = array('Southern');
		}
		else {
			$destination = $this->m_tour_destination->load($alias);
			$tour_search->going_to = $destination->id;
		}
		
		if (!empty($tour_search->regions)) {
			$link = site_url("tours/search")."?smode=filter&price=&duration=&region[]=".$tour_search->regions[0];
			header('Location: '.$link);
		}
		else if (!empty($tour_search->going_to)) {
			$link = site_url("tours/search")."?smode=filter&price=&duration=&destination[]=".$tour_search->going_to;
			header('Location: '.$link);
		}
	}
	
	public function view($alias)
	{
		$item = $this->m_tour->load($alias);
		
		$itinerary_info->tour_id = $item->id;
		$itineraries = $this->m_tour_itinerary->getItems($itinerary_info, 1);
		
		$rate_info->tour_id = $item->id;
		$rates = $this->m_tour_rate->getItems($rate_info, 1);
		
		$photo_info->category_id = 1;
		$photo_info->ref_id = $item->id;
		$photos = $this->m_photo->getItems($photo_info, 1);
		
		$review_info->category_id	= 1;
		$review_info->ref_id		= $item->id;
		$review_info->topLevel		= 1;
		$reviews = $this->m_review->getItems($review_info, 1);
		
		$avg_rating = 3;
		foreach ($reviews as $review) {
			$avg_rating += $review->rating;
		}
		$avg_rating = round($avg_rating / (sizeof($reviews)+1));
		
		$tour_info->category_id = $item->category_id;
		$tour_info->going_to	= $item->going_to;
		$tour_info->exclude_id	= $item->id;
		$more_tours = $this->m_tour->getItems($tour_info, 1);
		
		$view_data["item"]			= $item;
		$view_data["itineraries"]	= $itineraries;
		$view_data["rates"]			= $rates;
		$view_data["photos"]		= $photos;
		$view_data["avg_rating"]	= $avg_rating;
		$view_data["more_tours"]	= $more_tours;
		
		$review_data['category_id'] = 1;
		$review_data['ref_id']		= $item->id;
		$view_data["reviews"]		= $this->load->view("review/index", $review_data, TRUE);
		
		$question_data['category_id'] 	= 1;
		$question_data['ref_id']		= $item->id;
		$view_data["questions"]			= $this->load->view("answer/index", $question_data, TRUE);
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("tour/detail", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function availability($alias)
	{
		$item = $this->m_tour->load($alias);
		
		$photo_info->category_id = 1;
		$photo_info->ref_id = $item->id;
		$photos = $this->m_photo->getItems($photo_info, 1);
		
		$review_info->category_id	= 1;
		$review_info->ref_id		= $item->id;
		$review_info->topLevel		= 1;
		$reviews = $this->m_review->getItems($review_info, 1);
		
		$avg_rating = 3;
		foreach ($reviews as $review) {
			$avg_rating += $review->rating;
		}
		$avg_rating = round($avg_rating / (sizeof($reviews)+1));
		
		$departure_info->tour_id = $item->id;
		$departure_info->start = date('Y-m-d');
		$departures = $this->m_tour_departure->getItems($departure_info, 1);
		
		$tour_info->category_id = $item->category_id;
		$tour_info->going_to	= $item->going_to;
		$tour_info->exclude_id	= $item->id;
		$more_tours = $this->m_tour->getItems($tour_info, 1);
		
		$view_data["item"]			= $item;
		$view_data["photos"]		= $photos;
		$view_data["avg_rating"]	= $avg_rating;
		$view_data["departures"]	= $departures;
		$view_data["more_tours"]	= $more_tours;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("tour/availability", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function check_availability()
	{
		$tour_id = (!empty($_POST["tour-id"]) ? $_POST["tour-id"] : 0);
		$start   = (!empty($_POST["start"]) ? date('Y-m-d', strtotime($_POST["start"])) : "");
		$finish  = (!empty($_POST["finish"]) ? date('Y-m-d', strtotime($_POST["finish"])) : "");
		
		$item = $this->m_tour->load($tour_id);
		
		$departure_info->tour_id = $tour_id;
		$departure_info->start   = $start;
		$departure_info->finish  = $finish;
		$departures = $this->m_tour_departure->getItems($departure_info, 1);
		
		$view_data["item"]			= $item;
		$view_data["departures"]	= $departures;
		
		echo $this->load->view('tour/ajax/availability', $view_data);
	}
	
	public function tripnote($alias)
	{
		$item = $this->m_tour->load($alias);
		
		$photo_info->category_id = 1;
		$photo_info->ref_id = $item->id;
		$photos = $this->m_photo->getItems($photo_info, 1);
		
		$review_info->category_id	= 1;
		$review_info->ref_id		= $item->id;
		$review_info->topLevel		= 1;
		$reviews = $this->m_review->getItems($review_info, 1);
		
		$avg_rating = 3;
		foreach ($reviews as $review) {
			$avg_rating += $review->rating;
		}
		$avg_rating = round($avg_rating / (sizeof($reviews)+1));
		
		$tripnote_info->tour_id = $item->id;
		$tripnotes = $this->m_tour_tripnote->getItems($tripnote_info, 1);
		
		$tour_info->category_id = $item->category_id;
		$tour_info->going_to	= $item->going_to;
		$tour_info->exclude_id	= $item->id;
		$more_tours = $this->m_tour->getItems($tour_info, 1);
		
		$view_data["item"]			= $item;
		$view_data["photos"]		= $photos;
		$view_data["avg_rating"]	= $avg_rating;
		$view_data["tripnotes"]		= $tripnotes;
		$view_data["more_tours"]	= $more_tours;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("tour/tripnote", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function reviews($alias)
	{
		$item = $this->m_tour->load($alias);
		
		$photo_info->category_id = 1;
		$photo_info->ref_id = $item->id;
		$photos = $this->m_photo->getItems($photo_info, 1);
		
		$review_info->category_id	= 1;
		$review_info->ref_id		= $item->id;
		$review_info->topLevel		= 1;
		$reviews = $this->m_review->getItems($review_info, 1);
		
		$avg_rating = 3;
		foreach ($reviews as $review) {
			$avg_rating += $review->rating;
		}
		$avg_rating = round($avg_rating / (sizeof($reviews)+1));
		
		$tour_info->category_id = $item->category_id;
		$tour_info->going_to	= $item->going_to;
		$tour_info->exclude_id	= $item->id;
		$more_tours = $this->m_tour->getItems($tour_info, 1);
		
		$view_data["item"]				= $item;
		$view_data["photos"]			= $photos;
		$view_data["avg_rating"]		= $avg_rating;
		$view_data["more_tours"]		= $more_tours;
		
		$review_data['category_id'] 	= 1;
		$review_data['ref_id']			= $item->id;
		$view_data["reviews"]			= $this->load->view("review/index", $review_data, TRUE);
		
		$question_data['category_id'] 	= 1;
		$question_data['ref_id']		= $item->id;
		$view_data["questions"]			= $this->load->view("answer/index", $question_data, TRUE);
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("tour/reviews", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function booking_conditions()
	{
		$catinfo->alias = "tour-booking-conditions";
		$cat = $this->m_content_category->load($catinfo->alias);
		
		$info->catid = $cat->id;
		$item = $this->m_content->getItem($info, 1);
		
		$view_data = "";
		$view_data['item'] = $item;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content']   = $this->load->view("tour/booking_conditions", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function planning()
	{
		$tmpl_content['tabindex']  = "planning";
		$tmpl_content['content']   = $this->load->view("tour/planning", NULL, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function planning_request()
	{
		
	}
	
	public function request()
	{
		$this->load->view('tour/request');
	}
	
	public function send_request()
	{
		$fullname		= $this->input->post("req_fullname");
		$email			= $this->input->post("req_email");
		$phone			= $this->input->post("req_phone");
		$fromdate		= $this->input->post("req_fromdate");
		$todate			= $this->input->post("req_todate");
		$adults			= $this->input->post("req_adult");
		$children		= $this->input->post("req_children");
		$infants		= $this->input->post("req_infant");
		$message		= $this->input->post("req_content");
		$destinations	= $this->input->post("req_destinations");
		$security_code	= $this->input->post("req_code");
		$request_uri	= $this->input->post("request-uri");
		
		if ($security_code == $this->util->getSecurityCode())
		{
			$id = $this->util->GetNextValue('tv_tour_request');
			// Save
			$data = array (
				'id'			=> $id,
				'fullname'		=> $fullname,
				'email'			=> $email,
				'phone'			=> $phone,
				'fromdate'		=> date('Y-m-d', strtotime($fromdate)),
				'todate'		=> date('Y-m-d', strtotime($todate)),
				'adults'		=> $adults,
				'children'		=> $children,
				'infants'		=> $infants,
				'message'		=> $message,
				'destinations'	=> implode(", ", $destinations),
			);
			$this->m_tour_request->add($data);
			
			$mail_message = $this->mail_tpl->tour_request($data);
			
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> "[Tour][Request] #TR{$id}: ".$fullname,
								"from_sender"	=> $email,
	                            "name_sender"	=> $fullname,
								"to_receiver"	=> MAIL_TOUR,
	                            "message"		=> $mail_message
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			$tour_planning_result = new stdClass();
			$tour_planning_result->title   = "Inquiry is sent.";
			$tour_planning_result->message = "Thanks for your information. We will review and contact to you soon.";
			$this->session->set_flashdata('tour_planning_result', $tour_planning_result);
		}
		
		redirect($request_uri, "location");
	}
	
	public function interactive_maps()
	{
		$this->load->view('tour/interactive_maps');
	}
	
	public function customize()
	{
		$fullname		= $this->input->post("planning-name");
		$email			= $this->input->post("planning-email");
		$phone			= $this->input->post("planning-phone");
		$message		= $this->input->post("planning-description");
		$security_code	= $this->input->post("planning-code");
		$request_uri	= $this->input->post("request-uri");
		
		if ($security_code == $this->util->getSecurityCode())
		{
			$id = $this->util->GetNextValue('tv_tour_request');
			// Save
			$data = array (
				'id'		=> $id,
				'fullname'	=> $fullname,
				'email'		=> $email,
				'phone'		=> $phone,
				'message'	=> $message,
				'uri'		=> $request_uri,
			);
			$this->m_tour_request->add($data);
			
			$mail_message = $this->mail_tpl->tour_request($data);
			
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> "[Tour][Request] #TR{$id}: ".$fullname,
								"from_sender"	=> $email,
	                            "name_sender"	=> $fullname,
								"to_receiver"	=> MAIL_TOUR,
	                            "message"		=> $mail_message
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			$tour_customize_result = new stdClass();
			$tour_customize_result->title   = "Inquiry is sent.";
			$tour_customize_result->message = "Thanks for your information. We will review and contact to you soon.";
			$this->session->set_flashdata('tour_customize_result', $tour_customize_result);
		}
		
		redirect($request_uri, "location");
	}
	
	public function faqs()
	{
		$view_data = "";
		
		$tmpl_content['content']   = $this->load->view("tour/faqs", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function cal_fees()
	{
		$tour_id		= (!empty($_POST["tour_id"]) ? $_POST["tour_id"] : 0);
		$departure_id	= (!empty($_POST["departure_id"]) ? $_POST["departure_id"] : 0);
		$departure_date	= (!empty($_POST["departure_date"]) ? $_POST["departure_date"] : date('Y-m-d'));
		$tour_option	= (!empty($_POST["tour_option"]) ? explode(",", $_POST["tour_option"]) : 0);
		$classtype		= (!empty($_POST["classtype"]) ? $_POST["classtype"] : "");
		$adults			= (!empty($_POST["adults"]) ? $_POST["adults"] : 1);
		$children		= (!empty($_POST["children"]) ? $_POST["children"] : 0);
		$infants		= (!empty($_POST["infants"]) ? $_POST["infants"] : 0);
		$supplements	= (!empty($_POST["supplements"]) ? $_POST["supplements"] : 0);
		$travelers		= $adults + $children + $infants;
		
		$item  = $this->m_tour->load($tour_id);
		
		$price = $item->price;
		$supplement = 0;
		//Get Holiday of the current year
		$vietnam_holiday = $this->m_vietnam_holiday->getItemsByYear(date('Y'));

		if ($item->daily) {
			$rate_info->tour_id = $item->id;
			$rates = $this->m_tour_rate->getItems($rate_info, 1);
			foreach ($rates as $rate) {
				if ($rate->name == $classtype) {
					if ($rate->group_size >= $adults) {
						$price = $rate->price;
						break;
					}
				}
			}
			foreach ($rates as $rate) {
				if ($rate->name == $classtype) {
					if ($rate->single_supplement) {
						$supplement = $rate->price;
						break;
					}
				}
			}

			//If today is Vietnam Holiday then price will be pre-calculate with different rate
			foreach ($vietnam_holiday as $holiday) {
				$from = strtotime($holiday->from);
				$to = strtotime($holiday->to);
				$today = strtotime($departure_date);
				if ($from <= $today && $today <= $to) {
					$price = $price*($holiday->rate/100);
					break;
				}
			}
		}
		else {
			$rates = $this->m_tour_departure->load($departure_id);
			$supplement = $rates->supplement;
			$price = $rates->price;
			//Loop through all tour and adding to final price
			if ($tour_option != 0) {
				for ($i=0; $i < sizeof($tour_option) ; $i++) { 
					$option = $this->m_tour_option->load($tour_option[$i]);
					$price += $option->price;
				}
			}
			
		}
		
		$result = array($price, $supplement);
		echo json_encode($result);
	}
	
	public function booking($alias, $departure_id=0)
	{
		$this->util->requireUserLogin("member/login");
		
		$user = $this->session->userdata('user');
		
		$item = $this->m_tour->load($alias);
		
		if ($item->daily && !empty($departure_id)) {
			$departure_id = 0;
		}
		if (!$item->daily && empty($departure_id)) {
			redirect("tours/availability/{$item->alias}", "location");
		}
		
		$booking = new stdClass();
		$booking->tour_id			= $item->id;
		$booking->departure_id		= $departure_id;
		$booking->departure_date	= (($item->daily) ? date("m/d/Y", strtotime("+3 days")) : $this->m_tour_departure->load($booking->departure_id)->start);
		$booking->classtype			= "";
		$booking->adults			= 1;
		$booking->children			= 0;
		$booking->infants			= 0;
		$booking->supplements		= 0;
		$booking->supplement_rate	= 0;
		$booking->travelers			= $booking->adults + $booking->children + $booking->infants;
		$booking->fullname			= $user['fullname'];
		$booking->title				= $user['title'];
		$booking->email				= $user['email'];
		$booking->phone				= $user['phone'];
		$booking->message			= "";
		$booking->tour_rate			= $item->price;
		$booking->total_fee			= ($booking->tour_rate * $booking->adults + round($booking->tour_rate * 0.7 * $booking->children));
		$booking->paxs				= array();
		$booking->payment_option	= "";
		$booking->payment_method	= "";
		$this->session->set_userdata("booking", $booking);
		
		$this->booking_planning();
	}
	
	public function booking_planning()
	{
		$user = $this->session->userdata('user');
		$booking = $this->session->userdata("booking");
		
		if (empty($booking)) {
			redirect("tours/vietnam", "location");
		}
		
		$item = $this->m_tour->load($booking->tour_id);
		$nations = $this->m_nation->getItems();
		
		$view_data["item"]		= $item;
		$view_data["booking"]	= $booking;
		$view_data["user"]		= $user;
		$view_data["nations"]	= $nations;
		
		$tmpl_content['meta']['title'] = "Vietnam Tour Booking - " . (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content'] = $this->load->view("tour/booking/step1", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function _booking_passengers()
	{
		$booking = $this->session->userdata("booking");
		
		if (empty($booking)) {
			redirect("tours/vietnam", "location");
		}
		
		if (!empty($_POST)) {
			$booking->tour_id			= (!empty($_POST["tour_id"]) ? $_POST["tour_id"] : 0);
			$booking->departure_id		= (!empty($_POST["departure_id"]) ? $_POST["departure_id"] : 0);
			$booking->departure_date	= (!empty($_POST["departure_date"]) ? $_POST["departure_date"] : $booking->departure_date);
			$booking->classtype			= (!empty($_POST["classtype"]) ? $_POST["classtype"] : 0);
			$booking->adults			= (!empty($_POST["adults"]) ? $_POST["adults"] : 1);
			$booking->children			= (!empty($_POST["children"]) ? $_POST["children"] : 0);
			$booking->infants			= (!empty($_POST["infants"]) ? $_POST["infants"] : 0);
			$booking->travelers			= $booking->adults + $booking->children + $booking->infants;
			$booking->fullname			= (!empty($_POST["fullname"]) ? $_POST["fullname"] : "");
			$booking->email				= (!empty($_POST["email"]) ? $_POST["email"] : "");
			$booking->phone				= (!empty($_POST["phone"]) ? $_POST["phone"] : "");
			$booking->message			= (!empty($_POST["message"]) ? $_POST["message"] : "");
		}
		
		$item  = $this->m_tour->load($booking->tour_id);
		
		$price = $item->price;
		
		if ($item->daily) {
			$rate_info->tour_id = $booking->tour_id;
			$rates = $this->m_tour_rate->getItems($rate_info, 1);
			
			foreach ($rates as $rate) {
				if ($rate->name == $booking->classtype) {
					if ($rate->group_size >= $booking->adults) {
						$price = $rate->price;
						break;
					}
				}
			}
		}
		else {
			$rates = $this->m_tour_departure->load($booking->departure_id);
			$price = $rate->price;
		}
		
		$booking->tour_rate	= $price;
		$booking->total_fee	= ($price * $booking->adults + round($price * 0.7 * $booking->children));
		
		$this->session->set_userdata("booking", $booking);
		
		$view_data["item"]		= $item;
		$view_data["booking"]	= $booking;
		$view_data["nations"]	= $this->m_nation->getItems();
		
		$tmpl_content['meta']['title'] = "Vietnam Tour Booking - " . (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content'] = $this->load->view("tour/booking/step2", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function booking_review()
	{
		$booking = $this->session->userdata("booking");

		if (empty($booking)) {
			redirect("tours/vietnam", "location");
		}
		
		if (!empty($_POST)) {
			$booking->tour_id			= (!empty($_POST["tour_id"]) ? $_POST["tour_id"] : 0);
			$booking->departure_id		= (!empty($_POST["departure_id"]) ? $_POST["departure_id"] : 0);
			$booking->departure_date	= (!empty($_POST["departure_date"]) ? $_POST["departure_date"] : $booking->departure_date);
			$booking->classtype			= (!empty($_POST["classtype"]) ? $_POST["classtype"] : "");
			$booking->adults			= (!empty($_POST["adults"]) ? $_POST["adults"] : 1);
			$booking->children			= (!empty($_POST["children"]) ? $_POST["children"] : 0);
			$booking->infants			= (!empty($_POST["infants"]) ? $_POST["infants"] : 0);
			$booking->travelers			= $booking->adults + $booking->children + $booking->infants;
			$booking->fullname			= (!empty($_POST["fullname"]) ? $_POST["fullname"] : "");
			$booking->title				= $_POST["title"];
			$booking->email				= (!empty($_POST["email"]) ? $_POST["email"] : "");
			$booking->phone				= (!empty($_POST["phone"]) ? $_POST["phone"] : "");
			$booking->message			= (!empty($_POST["message"]) ? $_POST["message"] : "");
			
			$booking->paxs = array();
			for ($i=0; $i<$booking->travelers; $i++) {
				$pax = new stdClass();
				$pax->fullname		= (!empty($_POST["fullname_".$i]) ? $_POST["fullname_".$i] : "");
				$pax->gender		= (!empty($_POST["gender_".$i]) ? $_POST["gender_".$i] : "Male");
				$pax->birthdate		= (!empty($_POST["birthdate_".$i]) ? $_POST["birthdate_".$i] : "");
				$pax->nationality	= (!empty($_POST["nationality_".$i]) ? $_POST["nationality_".$i] : "");
				$pax->supplement	= (!empty($_POST["supplement_".$i]) ? 1 : 0);
				$booking->paxs[]	= $pax;
			}

			$booking->supplements		= 0;
			$booking->supplement_rate	= 0;
			foreach ($booking->paxs as $pax) {
				if ($pax->supplement) {
					$booking->supplements++;
				}
			}
		}
		
		$item  = $this->m_tour->load($booking->tour_id);
		
		$price = $item->price;
		
		if ($item->daily) {
			$rate_info->tour_id = $booking->tour_id;
			$rates = $this->m_tour_rate->getItems($rate_info, 1);
			
			foreach ($rates as $rate) {
				if ($rate->name == $booking->classtype) {
					if ($rate->group_size >= $booking->adults) {
						$price = $rate->price;
						break;
					}
				}
			}
			foreach ($rates as $rate) {
				if ($rate->name == $booking->classtype) {
					if ($rate->single_supplement) {
						$booking->supplement_rate = $rate->price;
						break;
					}
				}
			}
		}
		else {
			$rates = $this->m_tour_departure->load($booking->departure_id);
			$price = $rates->price;
			$booking->supplement_rate = $rates->supplement;
		}
		
		$booking->tour_rate	= $price;
		$booking->total_fee	= ($price * $booking->adults + round($price * 0.7 * $booking->children)) + ($booking->supplement_rate * $booking->supplements);
		
		$this->session->set_userdata("booking", $booking);
		
		$item = $this->m_tour->load($booking->tour_id);
		
		// Send mail to sales department
		$tpl_data = array(
				"BOOKING"					=> $booking,
				"FULLNAME"					=> $booking->fullname,
				"TITLE"						=> $booking->title,
				"PROMOTION"					=> 0,
				"DISCOUNT"					=> 0,
				"TOUR_RATE"					=> $booking->tour_rate,
				"TOTAL_FEE"					=> $booking->total_fee,
				"PAID"						=> 0,
				"TOUR"						=> $item,
				"DEPARTURE_DATE"			=> $booking->departure_date,
				"CLASSTYPE"					=> $booking->classtype,
				"PAXS"						=> $booking->paxs,
				"ADULTS"					=> $booking->adults,
				"CHILDREN"					=> $booking->children,
				"INFANTS"					=> $booking->infants,
				"SUPPLEMENTS"				=> $booking->supplements,
				"SUPPLEMENT_RATE"			=> $booking->supplement_rate,
				"EMAIL"						=> $booking->email,
				"PHONE"						=> $booking->phone,
				"MESSAGE"					=> $booking->message,
		);
		
		$subject = "BOOKING: Vietnam Tour Planning";
		
		$tpl_data["RECEIVER"] = MAIL_TOUR;
		$messageToAdmin  = $this->mail_tpl->tour_planning($tpl_data);
		
		// Send to SALE Department
		$mail = array(
                            "subject"		=> $subject.'-'.$booking->fullname,
							"from_sender"	=> $booking->email,
                            "name_sender"	=> $booking->fullname,
							"to_receiver"	=> MAIL_TOUR,
                            "message"		=> $messageToAdmin
		);
		$this->mail->config($mail);
		$this->mail->sendmail();

		$view_data["booking"]	= $booking;
		$view_data["item"]		= $item;
		
		$tmpl_content['meta']['title'] = "Vietnam Tour Booking - " . (!empty($item->meta_title) ? $item->meta_title : $item->name);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content'] = $this->load->view("tour/booking/step3", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	public function checkout()
	{
		$user = $this->session->userdata('user');
		$booking = $this->session->userdata("booking");

		if (!empty($_POST)) {
			$booking->payment_option = (!empty($_POST["payment-option"]) ? $_POST["payment-option"] : "");
			$booking->payment_method = (!empty($_POST["payment-method"]) ? $_POST["payment-method"] : "");
			$this->session->set_userdata("booking", $booking);
		}
		
		$tour = $this->m_tour->load($booking->tour_id);
		
		/*
		 * Save
		 */
		
		// Get book id
		$booking->id = $this->util->GetNextValue("tv_tour_booking", "id");
		
		// Booking key
		$booking->key = 'tour_'.md5(time());
		
		$booking->paid = $booking->total_fee;
				
		if ($booking->payment_option == "Deposit 40%") {
			$booking->paid = round($booking->paid * 0.4);
		}

		// Add to booking list
		$data = array(
				'id'				=> $booking->id,
				'tour_id'			=> $booking->tour_id,
				'departure_id'		=> $booking->departure_id,
				'departure_date'	=> date("Y-m-d", strtotime($booking->departure_date)),
				'classtype'			=> $booking->classtype,
				'booking_key'		=> $booking->key,
				'adults'			=> $booking->adults,
				'children' 			=> $booking->children,
				'infants' 			=> $booking->infants,
				'supplements' 		=> $booking->supplements,
				'supplement_rate' 	=> $booking->supplement_rate,
				'tour_rate'			=> $booking->tour_rate,
				'total_fee'			=> $booking->total_fee,
				'paid'				=> $booking->paid,
				'fullname'			=> $booking->fullname,
				'title'				=> $booking->title,
				'email'				=> $booking->email,
				'phone'				=> $booking->phone,
				'message'			=> $booking->message,
				'payment_option' 	=> $booking->payment_option,
				'payment_method' 	=> $booking->payment_method,
				'booking_date' 		=> date("Y-m-d H:i:s"),
				'promotion_code'	=> "",
				'discount'			=> 0,
				'user_id' 			=> $user['id'],
				'status' 			=> 0,
		);
		
		$succed = true;
		
		if (!$this->m_tour->add_booking($data)) {
			$succed = false;
		} else {
			foreach ($booking->paxs as $pax) {
				$booking_pax["book_id"]		= $booking->id;
				$booking_pax["fullname"]	= $pax->fullname;
				$booking_pax["gender"]		= $pax->gender;
				$booking_pax["birthdate"]	= date("Y-m-d", strtotime($pax->birthdate));
				$booking_pax["nationality"]	= $pax->nationality;
				$booking_pax["supplement"]	= $pax->supplement;
				
				if (!$this->m_tour->add_pax($booking_pax)) {
					$succed = false;
				}
			}
		}
		
		if ($succed)
		{
			$arrdestination = explode(';', $tour->destinations);
			$destinations = array();
			
		    for ($i=0; $i < sizeof($arrdestination); $i++) {
		    	$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
		    }
			
			// Send mail to sales department
			$tpl_data = array(
					"BOOKING"					=> $booking,
					"FULLNAME"					=> $booking->fullname,
					"TITLE"						=> $booking->title,
					"PROMOTION"					=> 0,
					"DISCOUNT"					=> 0,
					"TOUR_RATE"					=> $booking->tour_rate,
					"TOTAL_FEE"					=> $booking->total_fee,
					"PAID"						=> $booking->paid,
					"TOUR"						=> $tour,
					"DEPARTURE_DATE"			=> $booking->departure_date,
					"CLASSTYPE"					=> $booking->classtype,
					"DESTINATIONS"				=> $destinations,
					"PAXS"						=> $booking->paxs,
					"ADULTS"					=> $booking->adults,
					"CHILDREN"					=> $booking->children,
					"INFANTS"					=> $booking->infants,
					"SUPPLEMENTS"				=> $booking->supplements,
					"SUPPLEMENT_RATE"			=> $booking->supplement_rate,
					"EMAIL"						=> $booking->email,
					"PHONE"						=> $booking->phone,
					"MESSAGE"					=> $booking->message,
					"PAYMENT_METHOD"			=> $booking->payment_method,
					"PAYMENT_OPTION"			=> $booking->payment_option,
					"NEW_ACCOUNT"				=> FALSE,
					"USER_LOGIN"				=> $user['username'],
					"PASSWORD"					=> $user['password_text'],
			);
			
			$subject = "BOOKING #T".$booking->id.": Vietnam Tour Inquiry";
			
			$tpl_data["RECEIVER"] = MAIL_TOUR;
			$messageToAdmin  = $this->mail_tpl->tour_payment_inquiry($tpl_data);
			
			$tpl_data["RECEIVER"] = $booking->email;
			$messageToClient = $this->mail_tpl->tour_payment_inquiry($tpl_data);
			
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> $subject." - ".$booking->fullname,
								"from_sender"	=> $booking->email,
	                            "name_sender"	=> $booking->fullname,
								"to_receiver"	=> MAIL_TOUR,
	                            "message"		=> $messageToAdmin
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			// Send confirmation to SENDER
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_TOUR,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $booking->email,
	                            "message"		=> $messageToClient
			);
			//$this->mail->config($mail);
			//$this->mail->sendmail();
			
			if ($booking->payment_option != 'Pay later')
			{
				if ($booking->payment_method == 'OnePay')
				{
					//Redirect to OnePay
					$vpcURL = $this->util->get_OP_PAYMENT_URL();

					$vpcOpt['Title']				= "Settle payment online at ".SITE_NAME;
					$vpcOpt['AgainLink']			= urlencode(BASE_URL);
					$vpcOpt['vpc_Merchant']			= $this->util->get_OP_MERCHANT();
					$vpcOpt['vpc_AccessCode']		= $this->util->get_OP_ACCESSCODE();
					$vpcOpt['vpc_MerchTxnRef']		= $booking->key;
					$vpcOpt['vpc_OrderInfo']		= "T".$booking->id;
					$vpcOpt['vpc_Amount']			= $booking->paid*100;
					$vpcOpt['vpc_ReturnURL']		= $this->util->get_OP_RETURN_URL();
					$vpcOpt['vpc_Version']			= "2";
					$vpcOpt['vpc_Command']			= "pay";
					$vpcOpt['vpc_Locale']			= "en";
					$vpcOpt['vpc_TicketNo']			= $_SERVER['REMOTE_ADDR'];
					$vpcOpt['vpc_Customer_Email']	= $booking->email;
					$vpcOpt['vpc_Customer_Id']		= $user['id'];
					
					$md5HashData = "";
					
					ksort($vpcOpt);
					
					$appendAmp = 0;
					
					foreach($vpcOpt as $k => $v) {
						// create the md5 input and URL leaving out any fields that have no value
						if (strlen($v) > 0) {
							// this ensures the first paramter of the URL is preceded by the '?' char
							if ($appendAmp == 0) {
								$vpcURL .= urlencode($k) . '=' . urlencode($v);
								$appendAmp = 1;
							} else {
								$vpcURL .= '&' . urlencode($k) . "=" . urlencode($v);
							}
							if ((strlen($v) > 0) && ((substr($k, 0,4)=="vpc_") || (substr($k,0,5) =="user_"))) {
								$md5HashData .= $k . "=" . $v . "&";
							}
						}
					}
					
					$md5HashData = rtrim($md5HashData, "&");
					$md5HashData = strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$this->util->get_OP_SECURE_SECRET())));
					
					$vpcURL .= "&vpc_SecureHash=" . $md5HashData;
					
					header("Location: ".$vpcURL);
					die();
				}
				else if($booking->payment_method == 'Credit Card') {
					//Redirect to gate2shop
					$numberofitems = 1;
					$totalAmount   = $booking->paid;
					$productName   = "Vietnam Tour booking";
					$productPrice  = $booking->paid;
					$productNum    = 1;
					$datetime      = gmdate("Y-m-d H:i:s");
					
					// Cal checksum
					$checksum = md5(G2S_SECRET_KEY.G2S_MERCHANT_ID.G2S_CURRENTCY.$totalAmount.$productName.$productPrice.$productNum.$datetime);
		
					$link = 'https://secure.Gate2Shop.com/ppp/purchase.do?';
					$link .= 'version='.G2S_VERSION;
					$link .= '&merchant_id='.G2S_MERCHANT_ID;
					$link .= '&merchant_site_id='.G2S_MERCHANT_SITE_ID;
					$link .= '&total_amount='.$totalAmount;
					$link .= '&numberofitems='.$numberofitems;
					$link .= '&currency='.G2S_CURRENTCY;
					$link .= '&item_name_1='.$productName;
					$link .= '&item_amount_1='.$productPrice;
					$link .= '&item_quantity_1='.$productNum;
					$link .= '&time_stamp='.$datetime;
					$link .= '&checksum='.$checksum;
					$link .= '&customField1='.$booking->key;
					$link .= '&customField2='.$booking->email;
					
					header('Location: '.$link);
					die();
				}
				else if($booking->payment_method == 'Paypal')
				{
					$amount		= round($booking->paid);
					$item_name	= "Vietnam Tour booking";
					$quantity	= 1;
					
					$link = 'https://www.paypal.com/cgi-bin/webscr?';
					$link .= 'cmd=_xclick';
					$link .= '&business='.PAYPAL_BUSINESS;
					$link .= '&item_name='.$item_name;
					$link .= '&quantity='.$quantity;
					$link .= '&amount='.$amount.' USD';
					$link .= '&no_shipping=1';
					$link .= '&no_note=1';
					$link .= '&currency_code=USD';
					$link .= '&return='.BASE_URL.'/payment/sucess/'.$booking->key;
					$link .= '&cancel_return='.BASE_URL.'/payment/failure/'.$booking->key;
					
					header('Location: '.$link);
					die();
				}
			}
		}
		
		$view_data["client_name"] = $booking->fullname;
		$view_data["booking"] = $booking;
		$view_data["tour"] = $tour;
		$tmpl_content['content'] = $this->load->view("payment/finish", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	function success($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		if (!empty($key)) {
			$key = str_ireplace(".html", "", $key);
		}
		
		$data  = array( 'status' => 1 );
		$where = array( 'booking_key' => $key );
		
		$this->m_tour->update_booking($data, $where);
		
		$booking = $this->m_tour->getBooking(NULL, $key);
		if ($booking != null)
		{
			$tour = $this->m_tour->load($booking->tour_id);
			$paxs = $this->m_tour->getPaxs($booking->id);
			
			$arrdestination = explode(';', $tour->destinations);
			$destinations = array();
			
		    for ($i=0; $i < sizeof($arrdestination); $i++) {
		    	$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
		    }
		    
			// Create new account
			$user = $this->m_user->load($booking->user_id);
			
			// Send mail to sales department
			$tpl_data = array(
					"BOOKING"					=> $booking,
					"FULLNAME"					=> $booking->fullname,
					"TITLE"						=> $booking->title,
					"PROMOTION"					=> 0,
					"DISCOUNT"					=> 0,
					"TOUR_RATE"					=> $booking->tour_rate,
					"TOTAL_FEE"					=> $booking->total_fee,
					"PAID"						=> $booking->paid,
					"TOUR"						=> $tour,
					"DEPARTURE_DATE"			=> $booking->departure_date,
					"CLASSTYPE"					=> $booking->classtype,
					"DESTINATIONS"				=> $destinations,
					"PAXS"						=> $paxs,
					"ADULTS"					=> $booking->adults,
					"CHILDREN"					=> $booking->children,
					"INFANTS"					=> $booking->infants,
					"SUPPLEMENTS"				=> $booking->supplements,
					"SUPPLEMENT_RATE"			=> $booking->supplement_rate,
					"EMAIL"						=> $booking->email,
					"PHONE"						=> $booking->phone,
					"MESSAGE"					=> $booking->message,
					"PAYMENT_METHOD"			=> $booking->payment_method,
					"PAYMENT_OPTION"			=> $booking->payment_option,
					"NEW_ACCOUNT"				=> false,
					"USER_LOGIN"				=> $user->username,
					"PASSWORD"					=> $user->password_text,
			);
			
			$subject = "BOOKING #T".$booking->id.": Confirm Vietnam Tour ".$booking->payment_method." Payment Successful";
			
			$tpl_data["RECEIVER"] = MAIL_TOUR;
			$messageToAdmin  = $this->mail_tpl->tour_payment_successful($tpl_data);
			
			$tpl_data["RECEIVER"] = $booking->email;
			$messageToClient = $this->mail_tpl->tour_payment_successful($tpl_data);
			
			//create invoice in pdf to attach to mail
			$this->create_pdf($tpl_data);
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> $subject." - ".$booking->fullname,
								"from_sender"	=> $booking->email,
	                            "name_sender"	=> $booking->fullname,
								"to_receiver"	=> MAIL_TOUR,
	                            "message"		=> $messageToAdmin,
	                            "attachment"	=> './files/invoice/T'.$booking->id.'.pdf'
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_TOUR,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $booking->email,
	                            "message"		=> $messageToClient,
	                            "attachment"	=> './files/invoice/T'.$booking->id.'.pdf'
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			//remove invoice pdf file after send mail
			unlink('./files/invoice/T'.$booking->id.'.pdf');
		}
		
		$view_data["client_name"] = $booking->fullname;
		$view_data['booking'] = $booking;
		$view_data['tour'] = $tour;
		$tmpl_content['content']  = $this->load->view("payment/success", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
	
	function failure($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		$errMsg = "";
		
		if (!empty($key))
		{
			$key = str_ireplace(".html", "", $key);
			
			$booking = $this->m_tour->getBooking(NULL, $key);
			if ($booking != null)
			{
				$tour = $this->m_tour->load($booking->tour_id);
				$paxs = $this->m_tour->getPaxs($booking->id);
				
				$arrdestination = explode(';', $tour->destinations);
				$destinations = array();
				
			    for ($i=0; $i < sizeof($arrdestination); $i++) {
			    	$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
			    }
			    
				// Create new account
				$user = $this->m_user->load($booking->user_id);
				
				$tpl_data = array(
						"FULLNAME"					=> $booking->fullname,
						"TITLE"						=> $booking->title,
						"PROMOTION"					=> 0,
						"DISCOUNT"					=> 0,
						"TOUR_RATE"					=> $booking->tour_rate,
						"TOTAL_FEE"					=> $booking->total_fee,
						"PAID"						=> $booking->paid,
						"TOUR"						=> $tour,
						"DEPARTURE_DATE"			=> $booking->departure_date,
						"CLASSTYPE"					=> $booking->classtype,
						"DESTINATIONS"				=> $destinations,
						"PAXS"						=> $paxs,
						"ADULTS"					=> $booking->adults,
						"CHILDREN"					=> $booking->children,
						"INFANTS"					=> $booking->infants,
						"SUPPLEMENTS"				=> $booking->supplements,
						"SUPPLEMENT_RATE"			=> $booking->supplement_rate,
						"EMAIL"						=> $booking->email,
						"PHONE"						=> $booking->phone,
						"MESSAGE"					=> $booking->message,
						"PAYMENT_METHOD"			=> $booking->payment_method,
						"PAYMENT_OPTION"			=> $booking->payment_option,
						"NEW_ACCOUNT"				=> false,
						"USER_LOGIN"				=> $user->username,
						"PASSWORD"					=> $user->password_text,
				);
				
				$subject = "BOOKING #T".$booking->id.": Confirm Vietnam Tour ".$booking->payment_method." Payment Failure";
				
				$tpl_data["RECEIVER"] = MAIL_TOUR;
				$messageToAdmin  = $this->mail_tpl->tour_payment_failure($tpl_data);
				
				$tpl_data["RECEIVER"] = $booking->primary_email;
				$messageToClient = $this->mail_tpl->tour_payment_failure($tpl_data);
				
				// Send to SALE Department
				$mail = array(
		                            "subject"		=> $subject." - ".$booking->fullname,
									"from_sender"	=> $booking->email,
		                            "name_sender"	=> $booking->fullname,
									"to_receiver"	=> MAIL_TOUR,
		                            "message"		=> $messageToAdmin
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				// Send confirmation to SENDER
				$mail = array(
		                            "subject"		=> $subject,
									"from_sender"	=> MAIL_TOUR,
		                            "name_sender"	=> SITE_NAME,
									"to_receiver"	=> $booking->email,
		                            "message"		=> $messageToClient
				);
				//$this->mail->config($mail);
				//$this->mail->sendmail();
			}
		}
		
		$view_data["client_name"] = $booking->fullname;
		$view_data['booking'] = $booking;
		$view_data['tour'] = $tour;
		$tmpl_content['content'] = $this->load->view("payment/failure", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}

	public function create_pdf($tpl_data) {
		$booking = $tpl_data['BOOKING'];
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
	 
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('TraveloVietnam.com');
		$pdf->SetTitle('Tour Invoice');
		$pdf->SetSubject('Tour Invoice');
		$pdf->SetKeywords('travelovietnam, invoice');   
	 
		// set default header data
		$pdf->setFooterData(array(0,64,0), array(0,64,128)); 
	 
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, 'alo', PDF_FONT_SIZE_DATA));  
	 
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
	 
		// set margins
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);    
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 0); 
	 
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
	 
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}   
	 
		// ---------------------------------------------------------    
	 
		// set default font subsetting mode
		$pdf->setFontSubsetting(true);   
	 
		// Set font
		$pdf->SetFont('dejavusans', '', 14, '', true);
		//$pdf->SetPrintHeader(false);
		// remove default header
		$pdf->setPrintHeader(false);
		// Add a page
		$pdf->AddPage();
		$img_file = K_PATH_IMAGES.'invoice.jpg';
		$pdf->Image($img_file, 5, 65, 197, 187, '', '', '', false, 300, '', false, false, 0);
		$pdf->setPageMark(); 
		// Set some content to print
		$html = $this->invoice_tpl->invoice_template($tpl_data);
	 
		// Print text using writeHTMLCell()
		$pdf->writeHTML($html, true, false, true, false, '');
		$newFile  = './files/invoice/T'.$booking->id.'.pdf';
		$pdf->Output($newFile, 'F');      
	}
}

?>