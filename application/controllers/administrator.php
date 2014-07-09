<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ($this->uri->segment(2) != "logon"
			&& $this->uri->segment(2) != "do_logon"
			&& $this->uri->segment(2) != "do_logout") {
			$this->util->requireAdminLogin();
		}
	}

	public function index()
	{
		$view_data = "";
		
		$tmpl_content['content']   = $this->load->view("admin/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function logon()
	{
		$view_data = "";
		
		$tmpl_content['content']   = $this->load->view("admin/login", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function do_logon()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('passwd');
		
		if ($this->m_user->login($username, $password) == FALSE) {
			$this->session->set_flashdata("status", "Invalid username or password.");
			redirect("administrator/logon", "back");
		} else {
			redirect("administrator/index", "location");
		}
	}
	
	public function do_logout()
	{
		$this->session->sess_destroy();
		redirect(ADMIN_URL, "location");
	}
	
	//------------------------------------------------------------------------------
	// Sitemap
	//------------------------------------------------------------------------------
	
	public function create_sitemap()
	{
		$sitename	= strtolower(SITE_NAME);
		
		$url80 = array();
		$url64 = array();
		
		/*
		 * Main Menu
		 */
		//$url80[] = "http://www.{$sitename}";
		$url80[] = "http://www.{$sitename}/tours.html";
		//$url80[] = "http://www.{$sitename}/flights.html";
		//$url80[] = "http://www.{$sitename}/hotels.html";
		//$url80[] = "http://www.{$sitename}/visa.html";
		//$url80[] = "http://www.{$sitename}/cuisines.html";
		$url80[] = "http://www.{$sitename}/contact.html";
		
		/*
		 * Footer Menu
		 */
		$url80[] = "http://www.{$sitename}/terms-of-use.html";
		$url80[] = "http://www.{$sitename}/privacy-policy.html";
		$url80[] = "http://www.{$sitename}/cancel-and-refund.html";
		$url80[] = "http://www.{$sitename}/money-back-guarantee.html";
		$url80[] = "http://www.{$sitename}/safety-payment.html";
		
		/*
		 * About Vietnam
		 */
		
		/*
		 * Things To Do
		 */
		
		/*
		 * Need To Know
		 */
		
		/*
		 * Tour Programs
		 */
		$tours = $this->m_tour->getItems(NULL, 1);
		foreach ($tours as $tour) {
			$url64[] = "http://www.{$sitename}/tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/{$tour->alias}.html";
			//$url64[] = "http://www.{$sitename}/tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/{$tour->alias}/availability.html";
			//$url64[] = "http://www.{$sitename}/tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/{$tour->alias}/tripnote.html";
			//$url64[] = "http://www.{$sitename}/tours/vietnam/{$tour->city_alias}/{$tour->category_alias}/{$tour->alias}/reviews.html";
		}
		
		$xmlstr  = '<?xml version="1.0" encoding="UTF-8"?>';
		$xmlstr .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';
		
		foreach ($url80 as $url) {
			$xmlstr .= '<url>';
			$xmlstr .= '<loc>'.$url.'</loc>';
			$xmlstr .= '<changefreq>daily</changefreq>';
			$xmlstr .= '<priority>0.80</priority>';
			$xmlstr .= '</url>';
		}
		
		foreach ($url64 as $url) {
			$xmlstr .= '<url>';
			$xmlstr .= '<loc>'.$url.'</loc>';
			$xmlstr .= '<changefreq>daily</changefreq>';
			$xmlstr .= '<priority>0.64</priority>';
			$xmlstr .= '</url>';
		}
		
		$xmlstr .= '</urlset>';
		
		chmod('sitemap.xml', 0777);
		
		$fp = fopen('sitemap.xml', 'w');
		fwrite($fp, $xmlstr);
		fclose($fp);
		
		chmod('sitemap.xml', 0664);
	}
	
	//------------------------------------------------------------------------------
	// Tour
	//------------------------------------------------------------------------------
	
	public function tour_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_category->getItems());
		$view_data['items']			= $this->m_tour_category->getItems(NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/tour/categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour_category($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_tour_category->load($id);

		$tmpl_content['content']   = $this->load->view("admin/tour/categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");

			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_tour_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_category/", "location");
			}
		}
		redirect("administrator/tour_categories", "location");
	}
	
	public function tour_activities()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_activity->getItems());
		$view_data['items']			= $this->m_tour_activity->getItems(NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/tour/activity/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour_activity($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_tour_activity->load($id);

		$tmpl_content['content']   = $this->load->view("admin/tour/activity/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_activities()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");

			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_tour_activity->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_activity->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_activity->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_activity->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_activity->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_activity/", "location");
			}
		}
		redirect("administrator/tour_activities", "location");
	}
	
	public function tour_destinations()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_destination->getItems());
		$view_data['items']			= $this->m_tour_destination->getItems(NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/tour/destinations/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour_destination($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_tour_destination->load($id);
		
		$tmpl_content['content']   = $this->load->view("admin/tour/destinations/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_destinations()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail	= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$region		= $this->util->getValueOf($this->input->post('region'), "");
			$glat		= $this->util->getValueOf($this->input->post('glat'), NULL);
			$glong		= $this->util->getValueOf($this->input->post('glong'), NULL);
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$tags		= $this->util->getValueOf($this->input->post('destinationTags'), "");
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"thumbnail"	=> $thumbnail,
							"region"	=> $region,
							"glat"		=> $glat,
							"glong"		=> $glong,
							"tags"		=> $tags,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_tour_destination->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_destination->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_destination->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_destination->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_destination->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_destination/", "location");
			}
		}
		redirect("administrator/tour_destinations", "location");
	}
	
	public function tours()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour->getItems());
		$view_data['items']			= $this->m_tour->getItems(NULL, NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/tour/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_tour->load($id);

		$tmpl_content['content']   = $this->load->view("admin/tour/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tours()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 				= $this->util->getValueOf($this->input->post('id'), 0);
			$name				= $this->util->getValueOf($this->input->post('name'), "");
			$code				= $this->util->getValueOf($this->input->post('code'), "");
			$sub_title			= $this->util->getValueOf($this->input->post('sub_title'), "");
			$note				= $this->util->getValueOf($this->input->post('note'), "");
			$alias				= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail			= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$promotion_image	= $this->util->getValueOf($this->input->post('promotion_image'), "");
			$map				= $this->util->getValueOf($this->input->post('map'), "");
			$brochure			= $this->util->getValueOf($this->input->post('brochure'), "");
			$meta_title			= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key			= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc			= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$category_id		= $this->util->getValueOf($this->input->post('category'), 0);
			$depart_from		= $this->util->getValueOf($this->input->post('depart_from'), "");
			$going_to			= $this->util->getValueOf($this->input->post('going_to'), "");
			$tags				= $this->util->getValueOf($this->input->post('tourTags'), "");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			if (empty($code)) {
				$code 	= $this->util->genItemCode("T", 6);
			}
			
			$arrcategory	= array();
			for ($i=0; $i<5; $i++) {
				$category = $this->util->getValueOf($this->input->post('category_'.$i), "");
				if (!empty($category)) {
					$arrcategory[] = $category;
				}
			}
			$categories	= implode(";", $arrcategory);
			
			$arractivity	= array();
			for ($i=0; $i<10; $i++) {
				$activity = $this->util->getValueOf($this->input->post('activity_'.$i), "");
				if (!empty($activity)) {
					$arractivity[] = $activity;
				}
			}
			$activities	= implode(";", $arractivity);
			
			$arrdestination	= array();
			for ($i=0; $i<20; $i++) {
				$destination = $this->util->getValueOf($this->input->post('destination_'.$i), "");
				if (!empty($destination)) {
					$arrdestination[] = $destination;
				}
			}
			$destinations	= implode(";", $arrdestination);
			
			$duration		= $this->util->getValueOf($this->input->post('duration'), 1);
			$original_price	= $this->util->getValueOf($this->input->post('original_price'), 0);
			$price			= $this->util->getValueOf($this->input->post('price'), 0);
			$start			= $this->util->getValueOf(date('Y-m-d', strtotime($this->input->post('start'))), null);
			$finish			= $this->util->getValueOf(date('Y-m-d', strtotime($this->input->post('finish'))), null);
			$summary		= $this->util->getValueOf($this->input->post('summary'), "");
			$highlight		= $this->util->getValueOf($this->input->post('highlight'), "");
			$price_inclusion= $this->util->getValueOf($this->input->post('price_inclusion'), "");
			$price_exclusion= $this->util->getValueOf($this->input->post('price_exclusion'), "");
			$detail			= $this->util->getValueOf($this->input->post('detail'), "");
			$featured		= $this->util->getValueOf($this->input->post('featured'), 0);
			//$package		= $this->util->getValueOf($this->input->post('package'), 0);
			//$short_tour	= $this->util->getValueOf($this->input->post('short_tour'), 0);
			$type			= $this->util->getValueOf($this->input->post('type'), 1);
			$daily			= (($type == 1) ? 1 : 0);
			$throughout		= (($type == 2) ? 1 : 0);
			//$daily			= $this->util->getValueOf($this->input->post('daily'), 0);
			//$throughout		= $this->util->getValueOf($this->input->post('throughout'), 0);
			$best_deal		= $this->util->getValueOf($this->input->post('best_deal'), 0);
			$popular		= $this->util->getValueOf($this->input->post('popular'), 0);
			$popular_image	= $this->util->getValueOf($this->input->post('popular_image'), "");
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"name"				=> $name,
							"code"				=> $code,
							"alias"				=> $alias,
							"sub_title"			=> $sub_title,
							"note"				=> $note,
							"thumbnail"			=> $thumbnail,
							"promotion_image"	=> $promotion_image,
							"map"				=> $map,
							"brochure"			=> $brochure,
							"meta_title"		=> $meta_title,
							"meta_key"			=> $meta_key,
							"meta_desc"			=> $meta_desc,
							"category_id"		=> $category_id,
							"categories"		=> $categories,
							"activities"		=> $activities,
							"depart_from"		=> $depart_from,
							"going_to"			=> $going_to,
							"destinations"		=> $destinations,
							"duration"			=> $duration,
							"original_price"	=> $original_price,
							"price"				=> $price,
							"start"				=> $start,
							"finish"			=> $finish,
							"summary"			=> $summary,
							"highlight"			=> $highlight,
							"price_inclusion"	=> $price_inclusion,
							"price_exclusion"	=> $price_exclusion,
							"detail"			=> $detail,
							"featured"			=> $featured,
							//"package"			=> $package,
							//"short_tour"		=> $short_tour,
							"daily"				=> $daily,
							"throughout"		=> $throughout,
							"best_deal"			=> $best_deal,
							"popular"			=> $popular,
							"popular_image"		=> $popular_image,
							"tags"				=> $tags,
							"active"			=> $active,
			);
			
			if ($action == "new") {
				$this->m_tour->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour/", "location");
			}
		}
		//redirect("administrator/tours", "location");
		$this->tours();
	}
	
	public function tour_itineraries($tour_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->tour_id = $tour_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_itinerary->getItems($info));
		$view_data['items']			= $this->m_tour_itinerary->getItems($info, NULL, $limit, $offset);
		$view_data['tour_id']		= $tour_id;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/itinerary/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour_itinerary($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$tour_id = $this->uri->segment(4);
		}
		
		$item = $this->m_tour_itinerary->load($id);
		
		if ($item != null) {
			$tour_id = $item->tour_id;
		}
		
		$view_data = "";
		$view_data['tour_id']	= $tour_id;
		$view_data['item']		= $item;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/itinerary/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_itineraries()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$tour_id	= $this->util->getValueOf($this->input->post('tour_id'), 0);
		
		if ($task == "save")
		{
			$id 				= $this->util->getValueOf($this->input->post('id'), 0);
			$title				= $this->util->getValueOf($this->input->post('title'), "");
			$activities			= $this->util->getValueOf($this->input->post('activities'), "");
			$meal				= $this->util->getValueOf($this->input->post('meal'), "");
			$detail				= $this->util->getValueOf($this->input->post('detail'), "");
			$file_path			= $this->util->getValueOf($this->input->post('file_path'), "");
			$file_name			= $this->util->getValueOf($this->input->post('file_name'), "");
			$active				= $this->util->getValueOf($this->input->post('active'), 1);
			$action				= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"title"				=> $title,
							"tour_id"			=> $tour_id,
							"activities"		=> $activities,
							"meal"				=> $meal,
							"detail"			=> $detail,
							"file_path"			=> $file_path,
							"file_name"			=> $file_name,
							"active"			=> $active,
			);

			if ($action == "new") {
				$this->m_tour_itinerary->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_itinerary->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_itinerary->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_itinerary->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_itinerary->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_itinerary/0/".$tour_id, "location");
			}
		}
		redirect("administrator/tour_itineraries/".$tour_id, "location");
	}
	
	public function _tour_rates($tour_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->tour_id = $tour_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_rate->getItems($info));
		$view_data['items']			= $this->m_tour_rate->getItems($info, NULL, $limit, $offset);
		$view_data['tour_id']		= $tour_id;
		
		$tmpl_content['content']   = $this->load->view("admin/tour_rates", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function tour_rates($tour_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->tour_id = $tour_id;
		$items = $this->m_tour_rate->getItems($info);
		
		$tour = $this->m_tour->load($tour_id);
		
		$view_data = "";
		$view_data['items']	= $this->m_tour_rate->getItems($info);
		$view_data['tour']	= $tour;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/rates/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour_rates($tour_id=NULL, $type=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$info->tour_id = $tour_id;
		$info->name = urldecode($type);
		$items = $this->m_tour_rate->getItems($info);
		
		$tour = $this->m_tour->load($tour_id);
		
		$view_data = "";
		$view_data['tour']	= $tour;
		$view_data['type']	= urldecode($type);
		$view_data['items']	= $items;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/rates/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_rates_advanced()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task			= $this->util->getValueOf($this->input->post('task'), "cancel");
		$tour_id		= $this->util->getValueOf($this->input->post('tour_id'), 0);
		$type			= $this->util->getValueOf($this->input->post('type'), "");
		
		if ($task == "save")
		{
			$name	= $this->util->getValueOf($this->input->post('name'), "");
			$active	= $this->util->getValueOf($this->input->post('active'), 1);
			$action	= $this->util->getValueOf($this->input->post('action'), "new");
			
			$info->tour_id = $tour_id;
			$info->name = $type;
			$items = $this->m_tour_rate->getItems($info);
			
			$is_supplement_updated = FALSE;
			
			foreach ($items as $item) {
				$group_size = 1;
				if (!$item->single_supplement) {
					$group_size	= $this->util->getValueOf($this->input->post('group_size_'.$item->id), 1);
					$price		= $this->util->getValueOf($this->input->post('price_'.$item->id), 0);
				} else {
					$price		= $this->util->getValueOf($this->input->post('single_supplement'), 0);
					$is_supplement_updated = TRUE;
				}
				
				if (empty($group_size) || empty($price) || $group_size <=0 || $price <= 0) {
					$this->m_tour_rate->delete(array ("id" => $item->id));
				}
				else {
					$data = array (
									"name"				=> $name,
									"group_size"		=> trim($group_size),
									"price"				=> trim($price),
									"active"			=> $active,
					);
					$where = array ("id" => $item->id);
					$this->m_tour_rate->update($data, $where);
				}
			}
			
			for ($i=0; $i<12; $i++) {
				$group_size	= $this->util->getValueOf($this->input->post('group_size_-'.$i), 1);
				$price		= $this->util->getValueOf($this->input->post('price_-'.$i), 0);
				
				if (!empty($group_size) && !empty($price) && $group_size > 0 && $price > 0 ) {
					$data = array (
									"name"				=> $name,
									"tour_id"			=> $tour_id,
									"group_size"		=> trim($group_size),
									"single_supplement"	=> 0,
									"price"				=> trim($price),
									"active"			=> $active,
					);
					$this->m_tour_rate->add($data);
				}
			}
			
			if (!$is_supplement_updated) {
				$group_size	= 1;
				$price		= $this->util->getValueOf($this->input->post('single_supplement'), 0);
				
				if (!empty($price) && $price > 0 ) {
					$data = array (
									"name"				=> $name,
									"tour_id"			=> $tour_id,
									"group_size"		=> trim($group_size),
									"single_supplement"	=> 1,
									"price"				=> trim($price),
									"active"			=> $active,
					);
					$this->m_tour_rate->add($data);
				}
			}
		}
		else
		{
			if ($task == "add") {
				redirect("administrator/edit_tour_rates/".$tour_id."/new_rate", "location");
			}
		}
		redirect("administrator/tour_rates/".$tour_id, "location");
	}
	
	public function edit_tour_rate($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$tour_id = $this->uri->segment(4);
		}
		
		$item = $this->m_tour_rate->load($id);
		
		if ($item != null) {
			$tour_id = $item->tour_id;
		}
		
		$view_data = "";
		$view_data['tour_id']	= $tour_id;
		$view_data['item']		= $item;
		
		$tmpl_content['content']   = $this->load->view("admin/edit/tour_rate", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_rates()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$tour_id	= $this->util->getValueOf($this->input->post('tour_id'), 0);
		
		if ($task == "save")
		{
			$id 				= $this->util->getValueOf($this->input->post('id'), 0);
			$name				= $this->util->getValueOf($this->input->post('name'), "");
			$room_type			= $this->util->getValueOf($this->input->post('room_type'), "");
			$group_size			= $this->util->getValueOf($this->input->post('group_size'), 1);
			$single_supplement	= $this->util->getValueOf($this->input->post('single_supplement'), 0);
			$price				= $this->util->getValueOf($this->input->post('price'), 0);
			$active				= $this->util->getValueOf($this->input->post('active'), 1);
			$action				= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"name"				=> $name,
							"tour_id"			=> $tour_id,
							"room_type"			=> $room_type,
							"group_size"		=> $group_size,
							"single_supplement"	=> $single_supplement,
							"price"				=> $price,
							"active"			=> $active,
			);

			if ($action == "new") {
				$this->m_tour_rate->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_rate->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_rate->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_rate->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_rate->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_rate/0/".$tour_id, "location");
			}
		}
		redirect("administrator/tour_rates/".$tour_id, "location");
	}
	
	public function tour_departures($tour_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->tour_id = $tour_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_departure->getItems($info));
		$view_data['items']			= $this->m_tour_departure->getItems($info, NULL, $limit, $offset);
		$view_data['tour_id']		= $tour_id;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/availability/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour_departure($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$tour_id = $this->uri->segment(4);
		}
		
		$item = $this->m_tour_departure->load($id);
		
		if ($item != null) {
			$tour_id = $item->tour_id;
		}
		
		$view_data = "";
		$view_data['tour_id']	= $tour_id;
		$view_data['item']		= $item;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/availability/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_departures()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$tour_id	= $this->util->getValueOf($this->input->post('tour_id'), 0);
		
		if ($task == "save")
		{
			$id 				= $this->util->getValueOf($this->input->post('id'), 0);
			$start				= $this->util->getValueOf(date('Y-m-d', strtotime($this->input->post('start'))), null);
			$finish				= $this->util->getValueOf(date('Y-m-d', strtotime($this->input->post('finish'))), null);
			$places				= $this->util->getValueOf($this->input->post('places'), 0);
			$price				= $this->util->getValueOf($this->input->post('price'), 0);
			$supplement			= $this->util->getValueOf($this->input->post('supplement'), 0);
			$active				= $this->util->getValueOf($this->input->post('active'), 1);
			$action				= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"tour_id"	=> $tour_id,
							"start"		=> $start,
							"finish"	=> $finish,
							"places"	=> $places,
							"price"		=> $price,
							"supplement"=> $supplement,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_tour_departure->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_departure->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_departure->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_departure->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_departure->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_departure/0/".$tour_id, "location");
			}
		}
		$this->tour_departures($tour_id);
	}
	
	public function _tour_departure_rates($departure_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->departure_id = $departure_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_departure_rate->getItems($info));
		$view_data['items']			= $this->m_tour_departure_rate->getItems($info, NULL, $limit, $offset);
		$view_data['departure_id']	= $departure_id;
		
		$tmpl_content['content']   = $this->load->view("admin/tour_departure_rates", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function tour_departure_rates($departure_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->departure_id = $departure_id;
		$items = $this->m_tour_departure_rate->getItems($info);
		
		$departure = $this->m_tour_departure->load($departure_id);
		
		$view_data = "";
		$view_data['departure']	= $departure;
		$view_data['items']		= $items;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/availability/rates/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour_departure_rates($departure_id=NULL, $type=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$info->departure_id = $departure_id;
		$info->name = urldecode($type);
		$items = $this->m_tour_departure_rate->getItems($info);
		
		$departure = $this->m_tour_departure->load($departure_id);
		
		$view_data = "";
		$view_data['departure']	= $departure;
		$view_data['type']		= urldecode($type);
		$view_data['items']		= $items;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/availability/rates/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_departure_rates_advanced()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task			= $this->util->getValueOf($this->input->post('task'), "cancel");
		$departure_id	= $this->util->getValueOf($this->input->post('departure_id'), 0);
		$type			= $this->util->getValueOf($this->input->post('type'), "");
		
		if ($task == "save")
		{
			$name	= $this->util->getValueOf($this->input->post('name'), "");
			$active	= $this->util->getValueOf($this->input->post('active'), 1);
			$action	= $this->util->getValueOf($this->input->post('action'), "new");
			
			$info->departure_id = $departure_id;
			$info->name = $type;
			$items = $this->m_tour_departure_rate->getItems($info);
			
			$is_supplement_updated = FALSE;
			
			foreach ($items as $item) {
				$group_size = 1;
				if (!$item->single_supplement) {
					$group_size	= $this->util->getValueOf($this->input->post('group_size_'.$item->id), 1);
					$price		= $this->util->getValueOf($this->input->post('price_'.$item->id), 0);
				} else {
					$price		= $this->util->getValueOf($this->input->post('single_supplement'), 0);
					$is_supplement_updated = TRUE;
				}
				
				if (empty($group_size) || empty($price) || $group_size <=0 || $price <= 0) {
					$this->m_tour_departure_rate->delete(array ("id" => $item->id));
				}
				else {
					$data = array (
									"name"				=> $name,
									"group_size"		=> trim($group_size),
									"price"				=> trim($price),
									"active"			=> $active,
					);
					$where = array ("id" => $item->id);
					$this->m_tour_departure_rate->update($data, $where);
				}
			}
			
			for ($i=0; $i<12; $i++) {
				$group_size	= $this->util->getValueOf($this->input->post('group_size_-'.$i), 1);
				$price		= $this->util->getValueOf($this->input->post('price_-'.$i), 0);
				
				if (!empty($group_size) && !empty($price) && $group_size > 0 && $price > 0 ) {
					$data = array (
									"name"				=> $name,
									"departure_id"		=> $departure_id,
									"group_size"		=> trim($group_size),
									"single_supplement"	=> 0,
									"price"				=> trim($price),
									"active"			=> $active,
					);
					$this->m_tour_departure_rate->add($data);
				}
			}
			
			if (!$is_supplement_updated) {
				$group_size	= 1;
				$price		= $this->util->getValueOf($this->input->post('single_supplement'), 0);
				
				if (!empty($price) && $price > 0 ) {
					$data = array (
									"name"				=> $name,
									"departure_id"		=> $departure_id,
									"group_size"		=> trim($group_size),
									"single_supplement"	=> 1,
									"price"				=> trim($price),
									"active"			=> $active,
					);
					$this->m_tour_departure_rate->add($data);
				}
			}
		}
		else
		{
			if ($task == "add") {
				redirect("administrator/edit_tour_departure_rates/".$departure_id."/new_rate", "location");
			}
		}
		redirect("administrator/tour_departure_rates/".$departure_id, "location");
	}
	
	public function edit_tour_departure_rate($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$departure_id = $this->uri->segment(4);
		}
		
		$item = $this->m_tour_departure_rate->load($id);
		
		if ($item != null) {
			$departure_id = $item->departure_id;
		}
		
		$view_data = "";
		$view_data['departure_id']	= $departure_id;
		$view_data['item']			= $item;
		
		$tmpl_content['content']   = $this->load->view("admin/edit/tour_departure_rate", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_departure_rates()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task			= $this->util->getValueOf($this->input->post('task'), "cancel");
		$departure_id	= $this->util->getValueOf($this->input->post('departure_id'), 0);
		
		if ($task == "save")
		{
			$id 				= $this->util->getValueOf($this->input->post('id'), 0);
			$name				= $this->util->getValueOf($this->input->post('name'), "");
			$room_type			= $this->util->getValueOf($this->input->post('room_type'), "");
			$group_size			= $this->util->getValueOf($this->input->post('group_size'), 1);
			$single_supplement	= $this->util->getValueOf($this->input->post('single_supplement'), 0);
			$price				= $this->util->getValueOf($this->input->post('price'), 0);
			$active				= $this->util->getValueOf($this->input->post('active'), 1);
			$action				= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"name"				=> $name,
							"departure_id"		=> $departure_id,
							"room_type"			=> $room_type,
							"group_size"		=> $group_size,
							"single_supplement"	=> $single_supplement,
							"price"				=> $price,
							"active"			=> $active,
			);
			
			if ($action == "new") {
				$this->m_tour_departure_rate->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_departure_rate->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_departure_rate->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_departure_rate->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_departure_rate->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_departure_rate/0/".$departure_id, "location");
			}
		}
		redirect("administrator/tour_departure_rates/".$departure_id, "location");
	}
	
	public function tour_tripnotes($tour_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->tour_id = $tour_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_tripnote->getItems($info));
		$view_data['items']			= $this->m_tour_tripnote->getItems($info, NULL, $limit, $offset);
		$view_data['tour_id']		= $tour_id;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/tripnotes/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tour_tripnote($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$tour_id = $this->uri->segment(4);
		}
		
		$item = $this->m_tour_tripnote->load($id);
		
		if ($item != null) {
			$tour_id = $item->tour_id;
		}
		
		$view_data = "";
		$view_data['tour_id']	= $tour_id;
		$view_data['item']		= $item;
		
		$tmpl_content['content']   = $this->load->view("admin/tour/tripnotes/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tour_tripnotes()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$tour_id	= $this->util->getValueOf($this->input->post('tour_id'), 0);
		
		if ($task == "save")
		{
			$id 				= $this->util->getValueOf($this->input->post('id'), 0);
			$title				= $this->util->getValueOf($this->input->post('title'), "");
			$content			= $this->util->getValueOf($this->input->post('content'), "");
			$active				= $this->util->getValueOf($this->input->post('active'), 1);
			$action				= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"title"		=> $title,
							"content"	=> $content,
							"tour_id"	=> $tour_id,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_tour_tripnote->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_tripnote->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());
			
			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_tripnote->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_tripnote->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_tripnote->delete(array ("id" => $id));
				}
				else if ($task == "saveorder") {
					for ($i=0; $i<sizeof($cids); $i++) {
						$data = array ("order_num" => $orders[$i]);
						$where = array ("id" => $cids[$i]);
						$this->m_tour_tripnote->update($data, $where);
					}
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_tripnote/0/".$tour_id, "location");
			}
		}
		//redirect("administrator/tour_tripnotes/".$tour_id, "location");
		$this->tour_tripnotes($tour_id);
	}
	
	function tour_request()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_request->getItems());
		$view_data['items']			= $this->m_tour_request->getItems();

		$tmpl_content['content']   = $this->load->view("admin/tour/request/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	//------------------------------------------------------------------------------
	// Hotel
	//------------------------------------------------------------------------------
	
	public function hotel_categories()
	{
		$this->util->requireEditRightLogin(USR_HOTEL);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_hotel_category->getItems());
		$view_data['items']			= $this->m_hotel_category->getItems(NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/hotel_categories", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_hotel_category($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_hotel_category->load($id);

		$tmpl_content['content']   = $this->load->view("admin/edit/hotel_category", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_hotel_categories()
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_hotel_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_hotel_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_hotel_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_hotel_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_hotel_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_hotel_category/", "location");
			}
		}
		redirect("administrator/hotel_categories", "location");
	}
	
	public function hotel_destinations()
	{
		$this->util->requireEditRightLogin(USR_HOTEL);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_hotel_destination->getItems());
		$view_data['items']			= $this->m_hotel_destination->getItems(NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/hotel_destinations", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_hotel_destination($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_hotel_destination->load($id);

		$tmpl_content['content']   = $this->load->view("admin/edit/hotel_destination", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_hotel_destinations()
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail	= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$region		= $this->util->getValueOf($this->input->post('region'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"thumbnail"	=> $thumbnail,
							"region"	=> $region,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_hotel_destination->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_hotel_destination->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_hotel_destination->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_hotel_destination->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_hotel_destination->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_hotel_destination/", "location");
			}
		}
		redirect("administrator/hotel_destinations", "location");
	}
	
	public function hotels()
	{
		$this->util->requireEditRightLogin(USR_HOTEL);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$info->sortby = "name";
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_hotel->getItems());
		$view_data['items']			= $this->m_hotel->getItems($info, NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/hotels", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_hotel($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_hotel->load($id);

		$tmpl_content['content']   = $this->load->view("admin/edit/hotel", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_hotels()
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), NULL);
		
		if ($offset != NULL) {
			
			$info->sortby = "name";
		
			$view_data = "";
			$view_data['limit']			= $limit;
			$view_data['pageidx']		= $offset/$limit + 1;
			$view_data['totalitems']	= sizeof($this->m_hotel->getItems());
			$view_data['items']			= $this->m_hotel->getItems($info, NULL, $limit, $offset);
			
			$tmpl_content['content']   = $this->load->view("admin/hotels", $view_data, TRUE);
			$this->load->view('layout/admin', $tmpl_content);
		}
		else {
		
			$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
	
			if ($task == "save")
			{
				$id 				= $this->util->getValueOf($this->input->post('id'), 0);
				$name				= $this->util->getValueOf($this->input->post('name'), "");
				$alias				= $this->util->getValueOf($this->input->post('alias'), "");
				$thumbnail			= $this->util->getValueOf($this->input->post('thumbnail'), "");
				$meta_title			= $this->util->getValueOf($this->input->post('meta_title'), "");
				$meta_key			= $this->util->getValueOf($this->input->post('meta_key'), "");
				$meta_desc			= $this->util->getValueOf($this->input->post('meta_desc'), "");
				$accommodation_type	= $this->util->getValueOf($this->input->post('accommodation_type'), 1);
				$category_id		= $this->util->getValueOf($this->input->post('category'), 0);
				$star				= $this->util->getValueOf($this->input->post('star'), 1);
				$city				= $this->util->getValueOf($this->input->post('city'), "");
				$address			= $this->util->getValueOf($this->input->post('address'), "");
				$story				= $this->util->getValueOf($this->input->post('story'), "");
				$original_price		= $this->util->getValueOf($this->input->post('original_price'), 0);
				$price				= $this->util->getValueOf($this->input->post('price'), 0);
				$summary			= $this->util->getValueOf($this->input->post('summary'), "");
				$amenities			= $this->util->getValueOf($this->input->post('amenities'), "");
				$highlight			= $this->util->getValueOf($this->input->post('highlight'), "");
				$detail				= $this->util->getValueOf($this->input->post('detail'), "");
				$featured			= $this->util->getValueOf($this->input->post('featured'), 0);
				$wifi				= $this->util->getValueOf($this->input->post('wifi'), 0);
				$breakfast			= $this->util->getValueOf($this->input->post('breakfast'), 0);
				$active				= $this->util->getValueOf($this->input->post('active'), 1);
				$action				= $this->util->getValueOf($this->input->post('action'), "new");
				
				if (empty($alias)) {
					$alias 	= $this->util->genTopicAlias($name);
				}
				
				$data = array (
								"name"					=> $name,
								"alias"					=> $alias,
								"thumbnail"				=> $thumbnail,
								"meta_title"			=> $meta_title,
								"meta_key"				=> $meta_key,
								"meta_desc"				=> $meta_desc,
								"accommodation_type"	=> $accommodation_type,
								"category_id"			=> $category_id,
								"star"					=> $star,
								"city"					=> $city,
								"address"				=> $address,
								"story"					=> $story,
								"original_price"		=> $original_price,
								"price"					=> $price,
								"summary"				=> $summary,
								"amenities"				=> $amenities,
								"highlight"				=> $highlight,
								"detail"				=> $detail,
								"featured"				=> $featured,
								"wifi"					=> $wifi,
								"breakfast"				=> $breakfast,
								"active"				=> $active,
				);
				
				if ($action == "new") {
					$this->m_hotel->add($data);
				}
				else {
					$where = array ("id" => $id);
					$this->m_hotel->update($data, $where);
				}
			}
			else
			{
				$ids = $this->util->getValueOf($this->input->post('cid'), array());
	
				foreach ($ids as $id) {
					if ($task == "publish") {
						$data = array ("active" => 1);
						$where = array ("id" => $id);
						$this->m_hotel->update($data, $where);
					}
					else if ($task == "unpublish") {
						$data = array ("active" => 0);
						$where = array ("id" => $id);
						$this->m_hotel->update($data, $where);
					}
					else if ($task == "remove") {
						$this->m_hotel->delete(array ("id" => $id));
					}
				}
				if ($task == "add") {
					redirect("administrator/edit_hotel/", "location");
				}
			}
			redirect("administrator/hotels", "location");
		}
	}
	
	public function rooms($hotel_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_HOTEL);
		
		$info->hotel_id = $hotel_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_room->getItems($info));
		$view_data['items']			= $this->m_room->getItems($info, NULL, $limit, $offset);
		$view_data['hotel_id']		= $hotel_id;
		
		$tmpl_content['content']   = $this->load->view("admin/rooms", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_room($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$hotel_id = $this->uri->segment(4);
		}
		
		$item = $this->m_room->load($id);
		
		if ($item != null) {
			$hotel_id = $item->hotel_id;
		}
		
		$view_data = "";
		$view_data['hotel_id']	= $hotel_id;
		$view_data['item']		= $item;
		
		$tmpl_content['content']   = $this->load->view("admin/edit/room", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_rooms()
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$task		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$hotel_id	= $this->util->getValueOf($this->input->post('hotel_id'), 0);
		
		if ($task == "save")
		{
			$id 				= $this->util->getValueOf($this->input->post('id'), 0);
			$name				= $this->util->getValueOf($this->input->post('name'), "");
			$thumbnail			= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$room_type			= $this->util->getValueOf($this->input->post('room_type'), "");
			$detail				= $this->util->getValueOf($this->input->post('detail'), "");
			$original_price		= $this->util->getValueOf($this->input->post('original_price'), 0);
			$price				= $this->util->getValueOf($this->input->post('price'), 0);
			$extra_bed			= $this->util->getValueOf($this->input->post('extra_bed'), 0);
			$breakfast			= $this->util->getValueOf($this->input->post('breakfast'), 0);
			$wifi				= $this->util->getValueOf($this->input->post('wifi'), 0);
			$policies			= $this->util->getValueOf($this->input->post('policies'), "");
			$active				= $this->util->getValueOf($this->input->post('active'), 1);
			$action				= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"name"					=> $name,
							"thumbnail"				=> $thumbnail,
							"hotel_id"				=> $hotel_id,
							"room_type"				=> $room_type,
							"detail"				=> $detail,
							"original_price"		=> $original_price,
							"price"					=> $price,
							"extra_bed"				=> $extra_bed,
							"breakfast"				=> $breakfast,
							"wifi"					=> $wifi,
							"policies"				=> $policies,
							"active"				=> $active,
			);

			if ($action == "new") {
				$this->m_room->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_room->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_room->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_room->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_room->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_room/0/".$hotel_id, "location");
			}
		}
		redirect("administrator/rooms/".$hotel_id, "location");
	}
	
	public function edit_room_rates($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$room  = $this->m_room->load($id);
		$rates = $this->m_room_rate->getItems($id);
		$solar_rates = $this->m_room_rate->getSolarRateItems($id);
		$lunar_rates = $this->m_room_rate->getLunarRateItems($id);
		
		$view_data = "";
		$view_data['room_id']		= $room->id;
		$view_data['rates']			= $rates;
		$view_data['solar_rates']	= $solar_rates;
		$view_data['lunar_rates']	= $lunar_rates;
		
		$tmpl_content['content']   = $this->load->view("admin/edit/room_rates", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_room_rates()
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$task		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$room_id	= $this->util->getValueOf($this->input->post('room_id'), 0);
		
		if ($task == "save")
		{
			$where = array ( "room_id"	=> $room_id );
			$this->m_room_rate->delete($where);
			$this->m_room_rate->deleteSolarRate($where);
			$this->m_room_rate->deleteLunarRate($where);
			
			for ($w=1; $w<=53; $w++)
			{
				$rate = new stdClass();
				$rate->{$w.'_MON'} = $this->util->getValueOf($this->input->post($w.'_MON'), 0);
				$rate->{$w.'_TUE'} = $this->util->getValueOf($this->input->post($w.'_TUE'), 0);
				$rate->{$w.'_WED'} = $this->util->getValueOf($this->input->post($w.'_WED'), 0);
				$rate->{$w.'_THU'} = $this->util->getValueOf($this->input->post($w.'_THU'), 0);
				$rate->{$w.'_FRI'} = $this->util->getValueOf($this->input->post($w.'_FRI'), 0);
				$rate->{$w.'_SAT'} = $this->util->getValueOf($this->input->post($w.'_SAT'), 0);
				$rate->{$w.'_SUN'} = $this->util->getValueOf($this->input->post($w.'_SUN'), 0);
				
				foreach ($rate as $key => $val) {
					/*if ($this->m_room_rate->isExist($room_id, $key)) {
						$data = array (
								"price"		=> trim($val)
						);
						$where = array (
								"room_id"	=> $room_id,
								"rate_date"	=> $key,
						);
						$this->m_room_rate->update($data, $where);
					} else {*/
						$data = array (
								"room_id"	=> $room_id,
								"rate_date"	=> $key,
								"price"		=> trim($val),
						);
						$this->m_room_rate->add($data);
					/*}*/
				}
				
				$solar_rate_d = $this->util->getValueOf($this->input->post('S_D_'.$w), '');
				$solar_rate_m = $this->util->getValueOf($this->input->post('S_M_'.$w), '');
				$solar_rate_p = $this->util->getValueOf($this->input->post('S_P_'.$w), 0);
				
				if (!empty($solar_rate_d) && !empty($solar_rate_m)) {
					/*if ($this->m_room_rate->isSolarRateExist($room_id, $solar_rate_d, $solar_rate_m)) {
						$data = array (
								"price"		=> trim($solar_rate_p)
						);
						$where = array (
								"room_id"	=> $room_id,
								"rate_day"	=> $solar_rate_d,
								"rate_month"=> $solar_rate_m,
						);
						$this->m_room_rate->updateSolarRate($data, $where);
					} else {*/
						$data = array (
								"room_id"	=> $room_id,
								"rate_day"	=> $solar_rate_d,
								"rate_month"=> $solar_rate_m,
								"price"		=> trim($solar_rate_p),
						);
						$this->m_room_rate->addSolarRate($data);
					/*}*/
				}
				
				$lunar_rate_d = $this->util->getValueOf($this->input->post('L_D_'.$w), '');
				$lunar_rate_m = $this->util->getValueOf($this->input->post('L_M_'.$w), '');
				$lunar_rate_p = $this->util->getValueOf($this->input->post('L_P_'.$w), 0);
				
				if (!empty($lunar_rate_d) && !empty($lunar_rate_m)) {
					/*if ($this->m_room_rate->isLunarRateExist($room_id, $lunar_rate_d, $lunar_rate_m)) {
						$data = array (
								"price"		=> trim($lunar_rate_p)
						);
						$where = array (
								"room_id"	=> $room_id,
								"rate_day"	=> $lunar_rate_d,
								"rate_month"=> $lunar_rate_m,
						);
						$this->m_room_rate->updateLunarRate($data, $where);
					} else {*/
						$data = array (
								"room_id"	=> $room_id,
								"rate_day"	=> $lunar_rate_d,
								"rate_month"=> $lunar_rate_m,
								"price"		=> trim($lunar_rate_p),
						);
						$this->m_room_rate->addLunarRate($data);
					/*}*/
				}
			}
		}
		redirect("administrator/rooms/".$this->m_room->load($room_id)->hotel_id, "location");
	}
	
	function hotel_request()
	{
		$this->util->requireEditRightLogin(USR_HOTEL);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_hotel_request->getItems());
		$view_data['items']			= $this->m_hotel_request->getItems();

		$tmpl_content['content']   = $this->load->view("admin/hotel_request", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	//------------------------------------------------------------------------------
	// Cuisine
	//------------------------------------------------------------------------------
	
	public function cuisine_categories()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_cuisine_category->getItems());
		$view_data['items']			= $this->m_cuisine_category->getItems(NULL, NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/cuisine_categories", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_cuisine_category($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_cuisine_category->load($id);
		
		$tmpl_content['content']   = $this->load->view("admin/edit/cuisine_category", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_cuisine_categories()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);
			
			if ($action == "new") {
				$this->m_cuisine_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_cuisine_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());
			
			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_cuisine_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_cuisine_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_cuisine_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_cuisine_category/", "location");
			}
		}
		redirect("administrator/cuisine_categories", "location");
	}
	
	public function cuisines()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_cuisine->getItems());
		$view_data['items']			= $this->m_cuisine->getItems(NULL, NULL, $limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/cuisines", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_cuisine($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_cuisine->load($id);
		$view_data['categories']  = $this->m_cuisine_category->getItems();
		
		$tmpl_content['content']   = $this->load->view("admin/edit/cuisine", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_cuisines()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$catid 		= $this->util->getValueOf($this->input->post('catid'), 0);
			$title		= $this->util->getValueOf($this->input->post('title'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail	= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title	= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key	= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc	= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$summary	= $this->util->getValueOf($this->input->post('summary'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$lang		= $this->util->getValueOf($this->input->post('lang'), "EN");
			$order_num	= $this->util->getValueOf($this->input->post('order_num'), 1);
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"		=> $title,
							"alias"		=> $alias,
							"thumbnail"	=> $thumbnail,
							"meta_title"=> $meta_title,
							"meta_key"	=> $meta_key,
							"meta_desc"	=> $meta_desc,
							"summary"	=> $summary,
							"content"	=> $content,
							"order_num"	=> $order_num,
							"active"	=> $active,
							"catid"		=> $catid,
							"lang"		=> $lang,
			);

			if ($action == "new") {
				$this->m_cuisine->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_cuisine->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_cuisine->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_cuisine->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_cuisine->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_cuisine->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_cuisine->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_cuisine->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_cuisine", "location");
			}
		}
		redirect("administrator/cuisines", "location");
	}
	
	//------------------------------------------------------------------------------
	// PHOTO
	//------------------------------------------------------------------------------
	
	public function photos($category_id=NULL, $ref_id=NULL)
	{
		//$this->util->requireEditRightLogin(USR_HOTEL);
		
		$info->category_id = $category_id;
		$info->ref_id = $ref_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_photo->getItems($info));
		$view_data['items']			= $this->m_photo->getItems($info, NULL, $limit, $offset);
		$view_data['category_id']	= $category_id;
		$view_data['ref_id']		= $ref_id;
		
		$tmpl_content['content']   = $this->load->view("admin/photos", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_photo($id=NULL)
	{
		//$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$category_id = $this->uri->segment(4);
		}
		if (!($this->uri->segment(5) === FALSE)) {
			$ref_id = $this->uri->segment(5);
		}
		
		$item = $this->m_photo->load($id);
		
		if ($item != null) {
			$category_id = $item->category_id;
			$ref_id = $item->ref_id;
		}
		
		$view_data = "";
		$view_data['category_id']	= $category_id;
		$view_data['ref_id']		= $ref_id;
		$view_data['item']			= $item;
		
		$tmpl_content['content']   = $this->load->view("admin/edit/photo", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_photos()
	{
		//$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$task			= $this->util->getValueOf($this->input->post('task'), "cancel");
		$category_id	= $this->util->getValueOf($this->input->post('category_id'), 0);
		$ref_id			= $this->util->getValueOf($this->input->post('ref_id'), 0);
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$name			= $this->util->getValueOf($this->input->post('name'), "");
			$description	= $this->util->getValueOf($this->input->post('description'), "");
			$file_path		= $this->util->getValueOf($this->input->post('file_path'), "");
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"name"				=> $name,
							"category_id"		=> $category_id,
							"ref_id"			=> $ref_id,
							"description"		=> $description,
							"file_path"			=> $file_path,
							"active"			=> $active,
			);

			if ($action == "new") {
				$this->m_photo->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_photo->update($data, $where);
			}
		}
		else
		{
			$ids 	= $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_photo->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_photo->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_photo->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_photo->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_photo->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_photo->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_photo/0/".$category_id."/".$ref_id, "location");
			}
		}
		redirect("administrator/photos/".$category_id."/".$ref_id, "location");
	}
	
	//------------------------------------------------------------------------------
	// CONTENT
	//------------------------------------------------------------------------------

	public function content($alias=null)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$cat = $this->m_content_category->load($alias);
		$info->catid = $this->util->getValueOf($cat->id, 0);

		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_content->getItems($info));
		$view_data['items']			= $this->m_content->getItems($info);
		$view_data['catid']			= $info->catid;

		$tmpl_content['content']   = $this->load->view("admin/content", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_content($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$catid = $this->uri->segment(4);
		}

		$item = $this->m_content->load($id);

		if ($item != null) {
			$catid = $item->catid;
		}

		$view_data = "";
		$view_data['catid'] = $catid;
		$view_data['item']  = $item;

		$tmpl_content['content']   = $this->load->view("admin/edit/content", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_content()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		$catid = $this->util->getValueOf($this->input->post('catid'), 0);
		
		$cat   = $this->m_content_category->load($catid);
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$title		= $this->util->getValueOf($this->input->post('title'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail	= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title	= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key	= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc	= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$summary	= $this->util->getValueOf($this->input->post('summary'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$lang		= $this->util->getValueOf($this->input->post('lang'), "EN");
			$order_num	= $this->util->getValueOf($this->input->post('order_num'), 1);
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"		=> $title,
							"alias"		=> $alias,
							"thumbnail"	=> $thumbnail,
							"meta_title"=> $meta_title,
							"meta_key"	=> $meta_key,
							"meta_desc"	=> $meta_desc,
							"summary"	=> $summary,
							"content"	=> $content,
							"order_num"	=> $order_num,
							"active"	=> $active,
							"catid"		=> $catid,
							"lang"		=> $lang,
			);

			if ($action == "new") {
				$this->m_content->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_content->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_content->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_content->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_content->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_content->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_content->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_content->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_content/0/".$catid, "location");
			}
		}
		redirect("administrator/content/".$cat->alias, "location");
	}

	//------------------------------------------------------------------------------
	// EMBASSY
	//------------------------------------------------------------------------------

	public function embassies()
	{
		$this->util->requireEditRightLogin(USR_VISA);
		
		$view_data = "";
		$view_data['items'] = $this->m_embassy->getItems();

		$tmpl_content['content']   = $this->load->view("admin/embassies", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_embassy($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_embassy->load($id);

		$tmpl_content['content']   = $this->load->view("admin/edit/embassy", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_embassy()
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$nation		= $this->util->getValueOf($this->input->post('nation'), "");
			$title		= $this->util->getValueOf($this->input->post('title'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");

			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"nation"	=> $nation,
							"alias"		=> $alias,
							"title"		=> $title,
							"content"	=> $content,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_embassy->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_embassy->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_embassy->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_embassy->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_embassy->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_embassy", "location");
			}
		}
		redirect("administrator/embassies", "location");
	}
	
	function messaging()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_mail->getItems());
		$view_data['items']			= $this->m_message->getItems($limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/message", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function user($id)
	{
		$view_data = "";
		$view_data['item'] = $this->m_user->load($id);

		$tmpl_content['content']   = $this->load->view("admin/user/detail", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function tour_booking()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task	= $this->util->getValueOf($this->input->post('task'), "cancel");
		$ids	= $this->util->getValueOf($this->input->post('cid'), array());
		foreach ($ids as $id) {
			if ($task == "remove") {
				$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
				$this->m_tour->delete_booking(array ("id" => $id));
				$this->m_tour->delete_pax(array ("book_id" => $id));
			}
		}
		
		$limit   		= $this->util->getValueOf($this->input->post('limit'), 20);
		$offset  		= $this->util->getValueOf($this->input->post('limitstart'), 0);
		$sortby  		= $this->util->getValueOf($this->input->post('sortby'), NULL);
		$orderby 		= $this->util->getValueOf($this->input->post('orderby'), "DESC");
		$search_text	= $this->util->getValueOf($this->input->post('search_text'), "");
		$search_by		= $this->util->getValueOf($this->input->post('search_by'), "Email");
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['sortby']		= $sortby;
		$view_data['orderby']		= (($orderby == "DESC")?"ASC":"DESC");
		$view_data['search_text']	= $search_text;
		$view_data['search_by']		= $search_by;
		$view_data['totalitems']	= sizeof($this->m_tour->getBookings());
		$view_data['items']			= $this->m_tour->getBookings($limit, $offset, $sortby, $orderby, $search_text, $search_by);
		
		$tmpl_content['content']   = $this->load->view("admin/tour/booking/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function tour_booking_detail($id)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item'] = $this->m_tour->getBooking($id);

		$tmpl_content['content']   = $this->load->view("admin/tour/booking/detail", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function search_flight_booking()
	{
		$this->util->requireEditRightLogin(USR_FLIGHT, MODE_WRITE);
		
		$search_text	= $this->util->getValueOf($this->input->post('search_text'), "");
		$search_by		= $this->util->getValueOf($this->input->post('search_by'), "Email");
		
		$view_data = "";
		$view_data['isSearching']	= 1;
		$view_data['limit']			= 1;
		$view_data['pageidx']		= 1;
		$view_data['totalitems']	= 1;
		$view_data['items']			= $this->m_flight->searchBookings($search_text, $search_by);
		
		$tmpl_content['content']   = $this->load->view("admin/flight/booking/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function flight_booking()
	{
		$this->util->requireEditRightLogin(USR_FLIGHT, MODE_WRITE);
		
		$task	= $this->util->getValueOf($this->input->post('task'), "cancel");
		$ids	= $this->util->getValueOf($this->input->post('cid'), array());
		foreach ($ids as $id) {
			if ($task == "remove") {
				$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
				$this->m_flight->delete_booking(array ("id" => $id));
				$this->m_flight->delete_pax(array ("book_id" => $id));
			}
		}
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_flight->getBookings());
		$view_data['items']			= $this->m_flight->getBookings($limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/flight/booking/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	function flight_booking_detail($id)
	{
		$this->util->requireEditRightLogin(USR_FLIGHT, MODE_WRITE);
		
		$view_data = "";
		$view_data['item'] = $this->m_flight->getBooking($id);

		$tmpl_content['content']   = $this->load->view("admin/flight/booking/detail", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function search_hotel_booking()
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$search_text	= $this->util->getValueOf($this->input->post('search_text'), "");
		$search_by		= $this->util->getValueOf($this->input->post('search_by'), "Email");
		
		$view_data = "";
		$view_data['isSearching']	= 1;
		$view_data['limit']			= 1;
		$view_data['pageidx']		= 1;
		$view_data['totalitems']	= 1;
		$view_data['items']			= $this->m_hotel->searchBookings($search_text, $search_by);
		
		$tmpl_content['content']   = $this->load->view("admin/hotel/booking/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function hotel_booking()
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$task	= $this->util->getValueOf($this->input->post('task'), "cancel");
		$ids	= $this->util->getValueOf($this->input->post('cid'), array());
		foreach ($ids as $id) {
			if ($task == "remove") {
				$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
				$this->m_hotel->delete_booking(array ("id" => $id));
				$this->m_hotel->delete_pax(array ("book_id" => $id));
			}
		}
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_hotel->getBookings());
		$view_data['items']			= $this->m_hotel->getBookings($limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/hotel/booking/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	function hotel_booking_detail($id)
	{
		$this->util->requireEditRightLogin(USR_HOTEL, MODE_WRITE);
		
		$view_data = "";
		$view_data['item'] = $this->m_hotel->getBooking($id);

		$tmpl_content['content']   = $this->load->view("admin/hotel/booking/detail", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function search_booking()
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$search_text	= $this->util->getValueOf($this->input->post('search_text'), "");
		$search_by		= $this->util->getValueOf($this->input->post('search_by'), "Email");
		
		$view_data = "";
		$view_data['isSearching']	= 1;
		$view_data['limit']			= 1;
		$view_data['pageidx']		= 1;
		$view_data['totalitems']	= 1;
		$view_data['items']			= $this->m_visa->searchBookings($search_text, $search_by);

		$tmpl_content['content']   = $this->load->view("admin/visa/booking/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function visa_booking()
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$task	= $this->util->getValueOf($this->input->post('task'), "cancel");
		$ids	= $this->util->getValueOf($this->input->post('cid'), array());
		foreach ($ids as $id) {
			if ($task == "remove") {
				$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
				$this->m_visa->delete_booking(array ("id" => $id));
				$this->m_visa->delete_traveller(array ("book_id" => $id));
			}
		}
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_visa->getBookings());
		$view_data['items']			= $this->m_visa->getBookings($limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/visa/booking/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	function visa_booking_detail($id)
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$view_data = "";
		$view_data['item'] = $this->m_visa->getBooking($id);

		$tmpl_content['content']   = $this->load->view("admin/visa/booking/detail", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function feedback()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$view_data = "";
		$view_data['items'] = $this->m_fb->getItems();

		$tmpl_content['content']   = $this->load->view("admin/feedback", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	function requirements()
	{
		$this->util->requireEditRightLogin(USR_VISA);
		
		$view_data = "";
		$view_data['items'] = $this->m_requirement->getItems();

		$tmpl_content['content']   = $this->load->view("admin/requirements", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_requirement($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_requirement->load($id);

		$tmpl_content['content']   = $this->load->view("admin/edit/requirement", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_requirement()
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$citizen	= $this->util->getValueOf($this->input->post('citizen'), "");
			$title		= $this->util->getValueOf($this->input->post('title'), "");
			$status		= $this->util->getValueOf($this->input->post('status'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($citizen);
			}
			
			$data = array (
							"citizen"	=> $citizen,
							"alias"		=> $alias,
							"title"		=> $title,
							"status"	=> $status,
							"content"	=> $content,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_requirement->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_requirement->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_requirement->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_requirement->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_requirement->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_requirement", "location");
			}
		}
		redirect("administrator/requirements", "location");
	}
	
	function answers()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		// Questions
		$info->topLevel = 1;
		
		$view_data = "";
		$view_data['limit']		= $limit;
		$view_data['pageidx']	= $offset/$limit + 1;
		$view_data['totalitems']= sizeof($this->m_question->getItems($info));
		$view_data['reviews']	= $this->m_question->getItems($info, NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/answers", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function edit_answer($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_question->load($id);
		
		$tmpl_content['content']   = $this->load->view("admin/edit/answer", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_answer()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$title		= $this->util->getValueOf($this->input->post('title'), "");
			$author		= $this->util->getValueOf($this->input->post('author'), "");
			$email		= $this->util->getValueOf($this->input->post('email'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$answer		= $this->util->getValueOf($this->input->post('answer'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}

			$data = array (
							"title"		=> $title,
							"alias"		=> $alias,
							"author"	=> $author,
							"email"		=> $email,
							"content"	=> $content,
							"active"	=> $active,
			);
			
			$where = array ("id" => $id);
			$this->m_question->update($data, $where);
			
			if (!empty($answer))
			{
				$data = array (
							"parent_id"	=> $id,
							"author"	=> "Vietnam Evisa Support",
							"email"		=> MAIL_INFO,
							"content"	=> $answer,
				);
				
				$this->m_question->add($data);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			
			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_question->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_question->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_question->delete(array ("id" => $id));
				}
			}
		}
		redirect("administrator/answers", "location");
	}
	
	// ---------------------------------------------------------------------------------------
	// Reviews
	// ---------------------------------------------------------------------------------------
	
	function reviews()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		// Reviews
		$info->topLevel = 1;
		
		$view_data = "";
		$view_data['limit']		= $limit;
		$view_data['pageidx']	= $offset/$limit + 1;
		$view_data['totalitems']= sizeof($this->m_review->getItems($info));
		$view_data['reviews']	= $this->m_review->getItems($info, NULL, $limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/reviews", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function edit_review($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_review->load($id);
		
		$tmpl_content['content']   = $this->load->view("admin/edit/review", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_review()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$title		= $this->util->getValueOf($this->input->post('title'), "");
			$author		= $this->util->getValueOf($this->input->post('author'), "");
			$email		= $this->util->getValueOf($this->input->post('email'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$answer		= $this->util->getValueOf($this->input->post('answer'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}

			$data = array (
							"title"		=> $title,
							"alias"		=> $alias,
							"author"	=> $author,
							"email"		=> $email,
							"content"	=> $content,
							"active"	=> $active,
			);
			
			$where = array ("id" => $id);
			$this->m_review->update($data, $where);
			
			if (!empty($answer))
			{
				$data = array (
							"parent_id"	=> $id,
							"author"	=> "TraveloVietnam Support",
							"email"		=> MAIL_INFO,
							"content"	=> $answer,
				);
				
				$this->m_review->add($data);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			
			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_review->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_review->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_review->delete(array ("id" => $id));
				}
			}
		}
		redirect("administrator/reviews", "location");
	}
	
	// ---------------------------------------------------------------------------------------
	// Testimonials
	// ---------------------------------------------------------------------------------------
	
	function testimonials()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$view_data = "";
		$view_data['items'] = $this->m_testimonial->getItems();

		$tmpl_content['content']   = $this->load->view("admin/testimonial/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function edit_testimonial($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_testimonial->load($id);
		
		$tmpl_content['content'] = $this->load->view("admin/testimonial/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_testimonial()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), "");
			$author			= $this->util->getValueOf($this->input->post('author'), "");
			$avatar			= $this->util->getValueOf($this->input->post('avatar'), "");
			$email			= $this->util->getValueOf($this->input->post('email'), "");
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$nationality	= $this->util->getValueOf($this->input->post('nationality'), "");
			$rating			= $this->util->getValueOf($this->input->post('rating'), 1);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
				"author"		=> $author,
				"avatar"		=> $avatar,
				"email"			=> $email,
				"title"			=> $title,
				"content"		=> $content,
				"nationality"	=> $nationality,
				"rating"		=> $rating,
				"active"		=> $active,
			);
			
			if ($action == "new") {
				$this->m_testimonial->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_testimonial->update($data, $where);
			}
		}
		else
		{
			$ids   = $this->util->getValueOf($this->input->post('cid'), array());
			
			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_testimonial->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_testimonial->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_testimonial->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_testimonial", "location");
			}
		}
		redirect("administrator/testimonials", "location");
	}
	
	// ---------------------------------------------------------------------------------------
	// Promotion
	// ---------------------------------------------------------------------------------------
	
	public function promotions()
	{
		$this->util->requireEditRightLogin(USR_ADMIN);
		
		$view_data = "";
		$view_data['items'] = $this->m_promotion->getItems();

		$tmpl_content['content']   = $this->load->view("admin/promotions", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_promotion($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_promotion->load($id);
		
		$tmpl_content['content'] = $this->load->view("admin/edit/promotion", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_promotion()
	{
		$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$code 		= $this->util->getValueOf($this->input->post('id'), "");
			$codes		= $this->util->getValueOf($this->input->post('codes'), 0);
			$visa_type	= $this->util->getValueOf($this->input->post('visa_type'), "");
			$discount	= $this->util->getValueOf($this->input->post('discount'), 0);
			$start_date	= $this->util->getValueOf($this->input->post('start_date'), "");
			$end_date	= $this->util->getValueOf($this->input->post('end_date'), "");
			$description= $this->util->getValueOf($this->input->post('content'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if ($action == "new") {
				if ($codes > 0) {
					for ($i=0; $i<$codes; $i++) {
						$code = substr(strtoupper(md5(date("Y-m-d H:i:s").$i.'H-o-l-y-S-p-i-r-i-t')), 0, 6);
						$data = array (
										"code"			=> $code,
										"visa_type"		=> $visa_type,
										"discount"		=> $discount,
										"start_date"	=> date("Y-m-d", strtotime($start_date)),
										"end_date"		=> date("Y-m-d", strtotime($end_date)),
										"description"	=> $description
						);
						$this->m_promotion->add($data);
					}
				}
			}
			else {
				$data = array (
					"visa_type"		=> $visa_type,
					"discount"		=> $discount,
					"start_date"	=> date("Y-m-d", strtotime($start_date)),
					"end_date"		=> date("Y-m-d", strtotime($end_date)),
					"description"	=> $description
				);
				
				$where = array ("code" => $code);
				$this->m_promotion->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("code" => $id);
					$this->m_promotion->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("code" => $id);
					$this->m_promotion->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_promotion->delete(array ("code" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_promotion", "location");
			}
		}
		redirect("administrator/promotions", "location");
	}
	
	// ---------------------------------------------------------------------------------------
	// Vietnam Visa Tips
	// ---------------------------------------------------------------------------------------
	
	public function vietnam_visa_tips()
	{
		$this->util->requireEditRightLogin(USR_VISA);
		
		$view_data = "";
		$view_data['items'] = $this->m_tips->getItems();

		$tmpl_content['content']   = $this->load->view("admin/vietnam_visa_tips", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_vietnam_visa_tip($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_tips->load($id);

		$tmpl_content['content']   = $this->load->view("admin/edit/vietnam_visa_tip", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_vietnam_visa_tip()
	{
		$this->util->requireEditRightLogin(USR_VISA, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$title		= $this->util->getValueOf($this->input->post('title'), 0);
			$nation		= $this->util->getValueOf($this->input->post('nation'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"		=> $title,
							"alias"		=> $alias,
							"nation"	=> $nation,
							"content"	=> $content,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_tips->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tips->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tips->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tips->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tips->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_vietnam_visa_tip", "location");
			}
		}
		redirect("administrator/vietnam_visa_tips", "location");
	}
	
	// ---------------------------------------------------------------------------------------
	// Redirect 301
	// ---------------------------------------------------------------------------------------
	
	public function redirects()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$view_data = "";
		$view_data['items'] = $this->m_redirect->getItems();

		$tmpl_content['content']   = $this->load->view("admin/redirects", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_redirect($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_redirect->load($id);

		$tmpl_content['content']   = $this->load->view("admin/edit/redirect", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_redirect()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$from_url	= $this->util->getValueOf($this->input->post('from_url'), "");
			$to_url		= $this->util->getValueOf($this->input->post('to_url'), "");
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"from_url"		=> $from_url,
							"to_url"		=> $to_url,
			);

			if ($action == "new") {
				$this->m_redirect->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_redirect->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "remove") {
					$this->m_redirect->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_redirect", "location");
			}
		}
		redirect("administrator/redirects", "location");
	}
	
	// ---------------------------------------------------------------------------------------
	// Meta config
	// ---------------------------------------------------------------------------------------
	
	public function metas()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$view_data = "";
		$view_data['items'] = $this->m_meta->getItems();

		$tmpl_content['content']   = $this->load->view("admin/metas", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_meta($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_meta->load($id);

		$tmpl_content['content']   = $this->load->view("admin/edit/meta", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_meta()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$url			= $this->util->getValueOf($this->input->post('url'), "");
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$keywords		= $this->util->getValueOf($this->input->post('keywords'), "");
			$description	= $this->util->getValueOf($this->input->post('description'), "");
			$canonical		= $this->util->getValueOf($this->input->post('canonical'), "");
			$addition_tags	= $this->util->getValueOf($this->input->post('addition_tags'), "");
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
							"url"			=> $url,
							"title"			=> $title,
							"keywords"		=> $keywords,
							"description"	=> $description,
							"canonical"		=> $canonical,
							"addition_tags"	=> $addition_tags,
							"active"		=> $active,
			);

			if ($action == "new") {
				$this->m_meta->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_meta->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_meta->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_meta->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_meta->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_meta", "location");
			}
		}
		redirect("administrator/metas", "location");
	}
	
	function mail()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$task	= $this->util->getValueOf($this->input->post('task'), "cancel");
		$ids	= $this->util->getValueOf($this->input->post('cid'), array());
		foreach ($ids as $id) {
			if ($task == "remove") {
				$this->util->requireEditRightLogin(USR_ADMIN);
				$this->m_mail->delete(array ("id" => $id));
			}
		}
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_mail->getItems());
		$view_data['items']			= $this->m_mail->getItems($limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/mail", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	function mail_detail($id)
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$view_data = "";
		$view_data['item'] = $this->m_mail->getItem($id);

		$tmpl_content['content']   = $this->load->view("admin/mail_detail", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function ticket()
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$task	= $this->util->getValueOf($this->input->post('task'), "cancel");
		$ids	= $this->util->getValueOf($this->input->post('cid'), array());
		foreach ($ids as $id) {
			if ($task == "remove") {
				$this->util->requireEditRightLogin(USR_ADMIN);
				$this->m_ticket->delete(array ("id" => $id));
			}
		}
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_ticket->getItems());
		$view_data['items']			= $this->m_ticket->getItems($limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/ticket", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function ticket_detail($id)
	{
		$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$view_data = "";
		$view_data['item'] = $this->m_ticket->getItem($id);

		$tmpl_content['content']   = $this->load->view("admin/ticket_detail", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function flights($alias)
	{
		$this->util->requireEditRightLogin(USR_FLIGHT);
		
		$airport = $this->m_flight->getAirport($alias);
		
		$info = new stdClass();
		$info->leaving_from = $airport->code;
		$info->going_to = NULL;
		
		$view_data = "";
		$view_data['airport']	= $airport;
		$view_data['items']		= $this->m_flight->getFlights($info);
		
		$tmpl_content['content']   = $this->load->view("admin/flight_routes", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_flight($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_FLIGHT, MODE_WRITE);
		
		$item = $this->m_flight->getFlight($id);
		
		$view_data = "";
		$view_data['airports']	= $this->m_flight->getAirports();
		$view_data['airport']	= $this->m_flight->getAirport($item->leaving_from);
		$view_data['item']		= $item;
		
		$tmpl_content['content']   = $this->load->view("admin/edit/flight_route", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_flight()
	{
		$this->util->requireEditRightLogin(USR_FLIGHT, MODE_WRITE);
		
		$task		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$airport	= $this->util->getValueOf($this->input->post('airport'), "");
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$leaving_from	= $this->util->getValueOf($this->input->post('leaving_from'), "");
			$going_to		= $this->util->getValueOf($this->input->post('going_to'), "");
			$airline		= $this->util->getValueOf($this->input->post('airline'), "");
			$flight			= $this->util->getValueOf($this->input->post('flight'), "");
			$aircraft		= $this->util->getValueOf($this->input->post('aircraft'), "");
			$stops			= $this->util->getValueOf($this->input->post('stops'), 0);
			$stop_detail	= $this->util->getValueOf($this->input->post('stop_detail'), "");
			$departure_time	= $this->util->getValueOf($this->input->post('departure_time'), "");
			$arrival_time	= $this->util->getValueOf($this->input->post('arrival_time'), "");
			$duration		= $this->util->getValueOf($this->input->post('duration'), "");
			$saverflex		= $this->util->getValueOf($this->input->post('saverflex'), 0);
			$economy		= $this->util->getValueOf($this->input->post('economy'), 0);
			$business		= $this->util->getValueOf($this->input->post('business'), 0);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			$airport = $this->m_flight->getAirport($leaving_from)->alias;
			
			$data = array (
							"leaving_from"		=> $leaving_from,
							"going_to"			=> $going_to,
							"airline"			=> $airline,
							"flight"			=> $flight,
							"aircraft"			=> $aircraft,
							"stops"				=> $stops,
							"stop_detail"		=> $stop_detail,
							"departure_time"	=> $departure_time,
							"arrival_time"		=> $arrival_time,
							"duration"			=> $duration,
							"saverflex"			=> $saverflex,
							"economy"			=> $economy,
							"business"			=> $business,
							"active"			=> $active,
			);

			if ($action == "new") {
				$this->m_flight->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_flight->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_flight->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_flight->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_flight->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_flight/", "location");
			}
		}
		redirect("administrator/flights/".$airport, "location");
	}
	
	public function flight_stop($route_id = NULL)
	{
        $this->util->requireEditRightLogin(USR_FLIGHT);

        $info->route_id = $route_id;

        $limit	= $this->util->getValueOf($this->input->post('limit'), 20);
        $offset	= $this->util->getValueOf($this->input->post('limitstart'), 0);

        $view_data = "";
        $view_data['limit']			= $limit;
        $view_data['pageidx']		= $offset / $limit + 1;
        $view_data['totalitems']	= sizeof($this->m_flight->getStops($info));
        $view_data['items']			= $this->m_flight->getStops($info, NULL, $limit, $offset);
        $view_data['route_id']		= $route_id;

        $tmpl_content['content'] = $this->load->view("admin/flight_stop", $view_data, TRUE);
        $this->load->view('layout/admin', $tmpl_content);
    }

    public function update_flight_stop()
    {
        $this->util->requireEditRightLogin(USR_FLIGHT, MODE_WRITE);

        $task		= $this->util->getValueOf($this->input->post('task'), "cancel");
        $route_id	= $this->util->getValueOf($this->input->post('route_id'), 0);
        
        if ($task == "save")
        {
            $action				= $this->util->getValueOf($this->input->post('action'), "new");
            
            $id					= $this->util->getValueOf($this->input->post('id'), 0);
            $route_id			= $this->util->getValueOf($this->input->post('route_id'), "");
            
            $departure_time1	= $this->util->getValueOf($this->input->post('departure_time1'), "");
            $arrival_time1		= $this->util->getValueOf($this->input->post('arrival_time1'), "");
            $duration1			= $this->util->getValueOf($this->input->post('duration1'), "");
            $leaving_from1		= $this->util->getValueOf($this->input->post('leaving_from1'), "");
            $going_to1			= $this->util->getValueOf($this->input->post('going_to1'), "");
            $airline1			= $this->util->getValueOf($this->input->post('airline1'), "");
            $flight1			= $this->util->getValueOf($this->input->post('flight1'), "");
            $layover1			= $this->util->getValueOf($this->input->post('layover1'), "");
            
            $departure_time2	= $this->util->getValueOf($this->input->post('departure_time2'), "");
            $arrival_time2		= $this->util->getValueOf($this->input->post('arrival_time2'), "");
            $duration2			= $this->util->getValueOf($this->input->post('duration2'), "");
            $leaving_from2		= $this->util->getValueOf($this->input->post('leaving_from2'), "");
            $going_to2			= $this->util->getValueOf($this->input->post('going_to2'), "");
            $airline2			= $this->util->getValueOf($this->input->post('airline2'), "");
            $flight2			= $this->util->getValueOf($this->input->post('flight2'), "");
            $layover2			= $this->util->getValueOf($this->input->post('layover2'), "");
            
            $departure_time3	= $this->util->getValueOf($this->input->post('departure_time3'), "");
            $arrival_time3		= $this->util->getValueOf($this->input->post('arrival_time3'), "");
            $duration3			= $this->util->getValueOf($this->input->post('duration3'), "");
            $leaving_from3		= $this->util->getValueOf($this->input->post('leaving_from3'), "");
            $going_to3			= $this->util->getValueOf($this->input->post('going_to3'), "");
            $airline3			= $this->util->getValueOf($this->input->post('airline3'), "");
            $flight3			= $this->util->getValueOf($this->input->post('flight3'), "");
            $layover3			= $this->util->getValueOf($this->input->post('layover3'), "");

            $data = array(
                "route_id"			=> $route_id,
                
                "departure_time1"	=> $departure_time1,
                "arrival_time1"		=> $arrival_time1,
                "duration1"			=> $duration1,
                "leaving_from1"		=> $leaving_from1,
                "going_to1"			=> $going_to1,
                "airline1"			=> $airline1,
                "flight1"			=> $flight1,
                "layover1"			=> $layover1,
                
                "departure_time2"	=> $departure_time2,
                "arrival_time2"		=> $arrival_time2,
                "duration2"			=> $duration2,
                "leaving_from2"		=> $leaving_from2,
                "going_to2"			=> $going_to2,
                "airline2"			=> $airline2,
                "flight2"			=> $flight2,
                "layover2"			=> $layover2,
                
                "departure_time3"	=> $departure_time3,
                "arrival_time3"		=> $arrival_time3,
                "duration3"			=> $duration3,
                "leaving_from3"		=> $leaving_from3,
                "going_to3"			=> $going_to3,
                "airline3"			=> $airline3,
                "flight3"			=> $flight3,
                "layover3"			=> $layover3,
            );

            if ($action == "new") {
                $this->m_flight->add_stop($data);
            } else {
                $where = array("id" => $id);
                $this->m_flight->update_stop($data, $where);
            }
        }
        else
        {
            $ids = $this->util->getValueOf($this->input->post('cid'), array());
			
            foreach ($ids as $id) {
                if ($task == "remove") {
                    $this->m_flight->delete_stop(array("id" => $id));
                }
            }
            if ($task == "add") {
                redirect("administrator/edit_flight_stop/0/" . $route_id, "location");
            }
        }
        redirect("administrator/flight_stop/" . $route_id, "location");
    }

    public function edit_flight_stop($id = NULL, $route_id = NULL) {
        $this->util->requireEditRightLogin(USR_FLIGHT, MODE_WRITE);
        
        $view_data = "";
        $view_data['route_id']	= $route_id;
        $view_data['item']		= $this->m_flight->getStop($route_id);
		
        $tmpl_content['content'] = $this->load->view("admin/edit/flight_stop", $view_data, TRUE);
        $this->load->view('layout/admin', $tmpl_content);
    }
    
	//------------------------------------------------------------------------------
	// Album
	//------------------------------------------------------------------------------
	
	public function album_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_album_category->getItems());
		$view_data['items']			= $this->m_album_category->getItems(NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/albums/categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_album_category($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_album_category->load($id);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/albums/categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_album_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");

			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);
			
			if ($action == "new") {
				$this->m_album_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_album_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());
			
			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_album_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_album_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_album_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_album_category/", "location");
			}
		}
		redirect("administrator/album_categories", "location");
	}
	
	public function albums()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_album->getItems());
		$view_data['items']			= $this->m_album->getItems(NULL, NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/albums/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_album($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  		= $this->m_album->load($id);
		$view_data['categories']	= $this->m_album_category->getItems();

		$tmpl_content['content']   = $this->load->view("admin/vietnam/albums/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_albums()
	{
		$task = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$name			= $this->util->getValueOf($this->input->post('name'), "");
			$alias			= $this->util->getValueOf($this->input->post('alias'), "");
			$category_id	= $this->util->getValueOf($this->input->post('category_id'), 0);
			$description	= $this->util->getValueOf($this->input->post('description'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$media_type		= $this->util->getValueOf($this->input->post('media_type'), 0);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias		= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"				=> $name,
							"alias"				=> $alias,
							"category_id"		=> $category_id,
							"description"		=> $description,
							"thumbnail"			=> $thumbnail,
							"media_type"		=> $media_type,
							"active"			=> $active,
			);
			
			if ($action == "new") {
				$this->m_album->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_album->update($data, $where);
			}
		}
		else
		{
			$ids 	= $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_album->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_album->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_album->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_album", "location");
			}
		}
		//redirect("administrator/albums", "location");
		$this->albums();
	}
	
	public function album_photos($album_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->album_id = $album_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_album_photo->getItems($info));
		$view_data['items']			= $this->m_album_photo->getItems($info, NULL, $limit, $offset);
		$view_data['album_id']		= $album_id;
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/albums/photos/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_album_photo($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$album_id = $this->uri->segment(4);
		}
		
		$item = $this->m_album_photo->load($id);
		
		if ($item != null) {
			$album_id = $item->album_id;
		}
		
		$view_data = "";
		$view_data['item']  	= $this->m_album_photo->load($id);
		$view_data['album_id']  = $album_id;

		$tmpl_content['content']   = $this->load->view("admin/vietnam/albums/photos/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_album_photos()
	{
		$task 		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$album_id	= $this->util->getValueOf($this->input->post('album_id'), 0);
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$name			= $this->util->getValueOf($this->input->post('name'), "");
			$alias			= $this->util->getValueOf($this->input->post('alias'), "");
			$description	= $this->util->getValueOf($this->input->post('summary'), "");
			$file_path		= $this->util->getValueOf($this->input->post('file_path'), "");
			$meta_title		= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key		= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc		= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias		= $this->util->genTopicAlias($name);
			}
			
			// Create thumbnail
			$thumbnail = $file_path;
			
			if (!empty($file_path)) {
				$path_parts = pathinfo($file_path);
				$thumbnail = $path_parts['dirname']."/thumbs/200x140/".$path_parts['basename'];
				if (!file_exists($path_parts['dirname']."/thumbs/200x140/")) {
					mkdir("/var/www/".$path_parts['dirname']."/thumbs/200x140/", 0755, TRUE);
				}
				
				$config['image_library']	= 'GD2';
				$config['source_image']		= "/var/www/".$file_path;
				$config['new_image']		= "/var/www/".$thumbnail;
				$config['thumb_marker']		= "";
				$config['create_thumb']		= TRUE;
				$config['maintain_ratio']	= TRUE;
				$config['width']			= 200;
				$config['height']			= 140;
				
				$this->load->library('image_lib', $config);
				
				if (!$this->image_lib->resize()) {
				    echo $this->image_lib->display_errors();
				}
				
				chmod($config['new_image'], 0644);
			}
			
			$data = array (
							"name"			=> $name,
							"alias"			=> $alias,
							"album_id"		=> $album_id,
							"description"	=> $description,
							"file_path"		=> $file_path,
							"thumbnail"		=> $thumbnail,
							"meta_title"	=> $meta_title,
							"meta_key"		=> $meta_key,
							"meta_desc"		=> $meta_desc,
							"active"		=> $active,
			);
			
			if ($action == "new") {
				$this->m_album_photo->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_album_photo->update($data, $where);
			}
		}
		else
		{
			$ids 	= $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_album_photo->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_album_photo->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_album_photo->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_album_photo/0/".$album_id, "location");
			}
		}
		//redirect("administrator/album_photos/".$album_id, "location");
		$this->album_photos($album_id);
	}
	
	public function album_video($album_id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$info->album_id = $album_id;
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_album_video->getItems($info));
		$view_data['items']			= $this->m_album_video->getItems($info, NULL, $limit, $offset);
		$view_data['album_id']		= $album_id;
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/albums/video/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_album_video($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$album_id = $this->uri->segment(4);
		}
		
		$item = $this->m_album_video->load($id);
		
		if ($item != null) {
			$album_id = $item->album_id;
		}
		
		$view_data = "";
		$view_data['item']  	= $this->m_album_video->load($id);
		$view_data['album_id']  = $album_id;

		$tmpl_content['content']   = $this->load->view("admin/vietnam/albums/video/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_album_video()
	{
		$task 		= $this->util->getValueOf($this->input->post('task'), "cancel");
		$album_id	= $this->util->getValueOf($this->input->post('album_id'), 0);
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$name			= $this->util->getValueOf($this->input->post('name'), "");
			$alias			= $this->util->getValueOf($this->input->post('alias'), "");
			$description	= $this->util->getValueOf($this->input->post('summary'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$embeded_video	= $this->util->getValueOf($this->input->post('embeded_video'), "");
			$meta_title		= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key		= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc		= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias		= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"			=> $name,
							"alias"			=> $alias,
							"album_id"		=> $album_id,
							"description"	=> $description,
							"thumbnail"		=> $thumbnail,
							"embeded_video"	=> $embeded_video,
							"meta_title"	=> $meta_title,
							"meta_key"		=> $meta_key,
							"meta_desc"		=> $meta_desc,
							"active"		=> $active,
			);
			
			if ($action == "new") {
				$this->m_album_video->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_album_video->update($data, $where);
			}
		}
		else
		{
			$ids 	= $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_album_video->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_album_video->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_album_video->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_album_video/0/".$album_id, "location");
			}
		}
		//redirect("administrator/album_video/".$album_id, "location");
		$this->album_video($album_id);
	}
	
	//------------------------------------------------------------------------------
	// Vietnam Destination
	//------------------------------------------------------------------------------
	
	public function vietnam_destinations()
	{
		//$this->util->requireEditRightLogin(USR_MODERATOR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_vietnam_destination->getItems());
		$view_data['items']			= $this->m_vietnam_destination->getItems();
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/destinations/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_vietnam_destination($id=NULL)
	{
		//$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$item = $this->m_vietnam_destination->load($id);
		$destinations = $this->m_tour_destination->getItems();
		
		$view_data = "";
		$view_data['item']  = $item;
		$view_data['destinations']  = $destinations;

		$tmpl_content['content']   = $this->load->view("admin/vietnam/destinations/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_vietnam_destinations()
	{
		//$this->util->requireEditRightLogin(USR_MODERATOR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$destination_id = $this->util->getValueOf($this->input->post('destination_id'), 0);
			$gmap_address	= $this->util->getValueOf($this->input->post('gmap_address'), "");
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$alias			= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title		= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key		= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc		= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$summary		= $this->util->getValueOf($this->input->post('summary'), "");
			$highlight		= $this->util->getValueOf($this->input->post('highlight'), "");
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$area			= $this->util->getValueOf($this->input->post('area'), "");
			$video			= $this->util->getValueOf($this->input->post('video'), "");
			$population		= $this->util->getValueOf($this->input->post('population'), "");
			$location		= $this->util->getValueOf($this->input->post('location'), "");
			$whentogo		= $this->util->getValueOf($this->input->post('whentogo'), "");
			$lang			= $this->util->getValueOf($this->input->post('lang'), "EN");
			$order_num		= $this->util->getValueOf($this->input->post('order_num'), 1);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			$video = str_replace('"',"'",$video);

			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"				=> $title,
							"destination_id"	=> $destination_id,
							"gmap_address"		=> $gmap_address,
							"alias"				=> $alias,
							"thumbnail"			=> $thumbnail,
							"meta_title"		=> $meta_title,
							"meta_key"			=> $meta_key,
							"meta_desc"			=> $meta_desc,
							"summary"			=> $summary,
							"highlight"			=> $highlight,
							"content"			=> $content,
							"area"				=> $area,
							"video"				=> $video,
							"population"		=> $population,
							"location"			=> $location,
							"whentogo"			=> $whentogo,
							"order_num"			=> $order_num,
							"active"			=> $active,
							"lang"				=> $lang,
			);
			
			if ($action == "new") {
				$this->m_vietnam_destination->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_vietnam_destination->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_vietnam_destination->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_vietnam_destination->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_vietnam_destination->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_vietnam_destination->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_vietnam_destination->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_vietnam_destination->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_vietnam_destination/", "location");
			}
		}
		redirect("administrator/vietnam_destinations", "location");
	}
	
	//------------------------------------------------------------------------------
	// Sight
	//------------------------------------------------------------------------------
	
	public function sight_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_sight_category->getItems());
		$view_data['items']			= $this->m_sight_category->getItems();
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/sights/categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_sight_category($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_sight_category->load($id);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/sights/categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_sight_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_sight_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_sight_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_sight_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_sight_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_sight_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_sight_category/", "location");
			}
		}
		//redirect("administrator/sight_categories", "location");
		$this->sight_categories();
	}
	
	public function sights()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		

		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_sight->getItems());
		$view_data['items']			= $this->m_sight->getItems(NULL, NULL, $limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/sights/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_sight($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$item = $this->m_sight->load($id);
		$categories = $this->m_sight_category->getItems();
		$destinations = $this->m_tour_destination->getItems();

		$view_data = "";
		$view_data['item'] = $item;
		$view_data['categories'] = $categories;
		$view_data['destinations'] = $destinations;

		$tmpl_content['content']   = $this->load->view("admin/vietnam/sights/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_sights()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);

			$arrcity	= array();
			for ($i=0; $i<20; $i++) {
				$city = $this->util->getValueOf($this->input->post('city_'.$i), "");
				if (!empty($city)) {
					$arrcity[] = $city;
				}
			}
			$city	= implode(";", $arrcity);

			$address		= $this->util->getValueOf($this->input->post('address'), "");
			$gmap_address	= $this->util->getValueOf($this->input->post('gmap_address'), "");
			$area			= $this->util->getValueOf($this->input->post('area'), "");
			$top_choice		= $this->util->getValueOf($this->input->post('top_choice'), 0);
			$open_time		= $this->util->getValueOf($this->input->post('open_time'), "");
			$catid 			= $this->util->getValueOf($this->input->post('catid'), 0);
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$alias			= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title		= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key		= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc		= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$summary		= $this->util->getValueOf($this->input->post('summary'), "");
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$lang			= $this->util->getValueOf($this->input->post('lang'), "EN");
			$order_num		= $this->util->getValueOf($this->input->post('order_num'), 1);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			

			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"			=> $title,
							"alias"			=> $alias,
							"thumbnail"		=> $thumbnail,
							"meta_title"	=> $meta_title,
							"meta_key"		=> $meta_key,
							"meta_desc"		=> $meta_desc,
							"summary"		=> $summary,
							"content"		=> $content,
							"order_num"		=> $order_num,
							"active"		=> $active,
							"city"			=> $city,
							"address"		=> $address,
							"gmap_address"	=> $gmap_address,
							"area"			=> $area,
							"top_choice"	=> $top_choice,
							"open_time"		=> $open_time,
							"catid"			=> $catid,
							"lang"			=> $lang,
			);
			
			if ($action == "new") {
				$this->m_sight->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_sight->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_sight->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_sight->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_sight->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_sight->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_sight->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_sight->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_sight", "location");
			}
		}
		//redirect("administrator/sights", "location");
		$this->sights();
	}
	
	//------------------------------------------------------------------------------
	// Entertainment
	//------------------------------------------------------------------------------
	
	public function entertainment_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_entertainment_category->getItems());
		$view_data['items']			= $this->m_entertainment_category->getItems();
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/entertainments/categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_entertainment_category($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_entertainment_category->load($id);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/entertainments/categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_entertainment_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_entertainment_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_entertainment_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_entertainment_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_entertainment_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_entertainment_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_entertainment_category/", "location");
			}
		}
		//redirect("administrator/entertainment_categories", "location");
		$this->entertainment_categories();
	}
	
	public function entertainments($alias=null)
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_entertainment->getItems());
		$view_data['items']			= $this->m_entertainment->getItems(NULL, NULL, $limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/entertainments/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_entertainment($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$item = $this->m_entertainment->load($id);
		$categories = $this->m_entertainment_category->getItems();
		$destinations = $this->m_tour_destination->getItems();
		
		$view_data = "";
		$view_data['item'] = $item;
		$view_data['categories'] = $categories;
		$view_data['destinations'] = $destinations;

		$tmpl_content['content']   = $this->load->view("admin/vietnam/entertainments/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_entertainments()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$city			= $this->util->getValueOf($this->input->post('city'), 0);
			$address		= $this->util->getValueOf($this->input->post('address'), "");
			$gmap_address	= $this->util->getValueOf($this->input->post('gmap_address'), "");
			$area			= $this->util->getValueOf($this->input->post('area'), "");
			$top_choice		= $this->util->getValueOf($this->input->post('top_choice'), 0);
			$open_time		= $this->util->getValueOf($this->input->post('open_time'), "");
			$catid 			= $this->util->getValueOf($this->input->post('catid'), 0);
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$alias			= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title		= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key		= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc		= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$summary		= $this->util->getValueOf($this->input->post('summary'), "");
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$glat			= $this->util->getValueOf($this->input->post('glat'), "");
			$glng			= $this->util->getValueOf($this->input->post('glng'), "");
			$lang			= $this->util->getValueOf($this->input->post('lang'), "EN");
			$order_num		= $this->util->getValueOf($this->input->post('order_num'), 1);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"			=> $title,
							"alias"			=> $alias,
							"thumbnail"		=> $thumbnail,
							"meta_title"	=> $meta_title,
							"meta_key"		=> $meta_key,
							"meta_desc"		=> $meta_desc,
							"summary"		=> $summary,
							"content"		=> $content,
							"order_num"		=> $order_num,
							"active"		=> $active,
							"city"			=> $city,
							"address"		=> $address,
							"gmap_address"	=> $gmap_address,
							"area"			=> $area,
							"top_choice"	=> $top_choice,
							"glat"			=> $glat,
							"glng"			=> $glng,
							"open_time"		=> $open_time,
							"catid"			=> $catid,
							"lang"			=> $lang,
			);

			if ($action == "new") {
				$this->m_entertainment->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_entertainment->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_entertainment->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_entertainment->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_entertainment->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_entertainment->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_entertainment->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_entertainment->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_entertainment", "location");
			}
		}
		//redirect("administrator/entertainments/", "location");
		$this->entertainments();
	}
	
	//------------------------------------------------------------------------------
	// Restaurant
	//------------------------------------------------------------------------------
	
	public function restaurant_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_restaurant_category->getItems());
		$view_data['items']			= $this->m_restaurant_category->getItems();
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/restaurants/categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_restaurant_category($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_restaurant_category->load($id);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/restaurants/categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_restaurant_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_restaurant_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_restaurant_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_restaurant_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_restaurant_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_restaurant_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_restaurant_category/", "location");
			}
		}
		//redirect("administrator/restaurant_categories", "location");
		$this->restaurant_categories();
	}
	
	public function restaurants()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_restaurant->getItems());
		$view_data['items']			= $this->m_restaurant->getItems(NULL, NULL, $limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/restaurants/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_restaurant($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$item = $this->m_restaurant->load($id);
		$categories = $this->m_restaurant_category->getItems();
		$destinations = $this->m_tour_destination->getItems();
		
		$view_data = "";
		$view_data['item'] = $item;
		$view_data['categories'] = $categories;
		$view_data['destinations'] = $destinations;
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/restaurants/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_restaurants()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			
			$arrcity	= array();
			for ($i=0; $i<20; $i++) {
				$city = $this->util->getValueOf($this->input->post('city_'.$i), "");
				if (!empty($city)) {
					$arrcity[] = $city;
				}
			}
			$city	= implode(";", $arrcity);

			$address		= $this->util->getValueOf($this->input->post('address'), "");
			$gmap_address	= $this->util->getValueOf($this->input->post('gmap_address'), "");
			$area			= $this->util->getValueOf($this->input->post('area'), "");
			$top_choice		= $this->util->getValueOf($this->input->post('top_choice'), 0);
			$open_time		= $this->util->getValueOf($this->input->post('open_time'), "");
			$catid 			= $this->util->getValueOf($this->input->post('catid'), 0);
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$alias			= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title		= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key		= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc		= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$summary		= $this->util->getValueOf($this->input->post('summary'), "");
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$glat			= $this->util->getValueOf($this->input->post('glat'), "");
			$glng			= $this->util->getValueOf($this->input->post('glng'), "");
			$lang			= $this->util->getValueOf($this->input->post('lang'), "EN");
			$order_num		= $this->util->getValueOf($this->input->post('order_num'), 1);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"			=> $title,
							"alias"			=> $alias,
							"thumbnail"		=> $thumbnail,
							"meta_title"	=> $meta_title,
							"meta_key"		=> $meta_key,
							"meta_desc"		=> $meta_desc,
							"summary"		=> $summary,
							"content"		=> $content,
							"order_num"		=> $order_num,
							"active"		=> $active,
							"city"			=> $city,
							"address"		=> $address,
							"gmap_address"	=> $gmap_address,
							"area"			=> $area,
							"top_choice"	=> $top_choice,
							"glat"			=> $glat,
							"glng"			=> $glng,
							"open_time"		=> $open_time,
							"catid"			=> $catid,
							"lang"			=> $lang,
			);

			if ($action == "new") {
				$this->m_restaurant->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_restaurant->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_restaurant->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_restaurant->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_restaurant->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_restaurant->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_restaurant->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_restaurant->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_restaurant", "location");
			}
		}
		//redirect("administrator/restaurants", "location");
		$this->restaurants();
	}
	
	//------------------------------------------------------------------------------
	// Shopping
	//------------------------------------------------------------------------------
	
	public function shopping_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_shopping_category->getItems());
		$view_data['items']			= $this->m_shopping_category->getItems();
		
		$tmpl_content['content']   = $this->load->view("admin/vietnam/shoppings/categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_shopping_category($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_shopping_category->load($id);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/shoppings/categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_shopping_categories()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_shopping_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_shopping_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_shopping_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_shopping_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_shopping_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_shopping_category/", "location");
			}
		}
		//redirect("administrator/shopping_categories", "location");
		$this->shopping_categories();
	}
	
	public function shoppings()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_shopping->getItems());
		$view_data['items']			= $this->m_shopping->getItems(NULL, NULL, $limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/vietnam/shoppings/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_shopping($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$item = $this->m_shopping->load($id);
		$categories = $this->m_shopping_category->getItems();
		$destinations = $this->m_tour_destination->getItems();
		
		$view_data = "";
		$view_data['item'] = $item;
		$view_data['categories'] = $categories;
		$view_data['destinations'] = $destinations;

		$tmpl_content['content']   = $this->load->view("admin/vietnam/shoppings/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_shoppings()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$city			= $this->util->getValueOf($this->input->post('city'), 0);
			$address		= $this->util->getValueOf($this->input->post('address'), "");
			$gmap_address	= $this->util->getValueOf($this->input->post('gmap_address'), "");
			$area			= $this->util->getValueOf($this->input->post('area'), "");
			$top_choice		= $this->util->getValueOf($this->input->post('top_choice'), 0);
			$open_time		= $this->util->getValueOf($this->input->post('open_time'), "");
			$catid 			= $this->util->getValueOf($this->input->post('catid'), 0);
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$alias			= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title		= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key		= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc		= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$summary		= $this->util->getValueOf($this->input->post('summary'), "");
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$glat			= $this->util->getValueOf($this->input->post('glat'), "");
			$glng			= $this->util->getValueOf($this->input->post('glng'), "");
			$lang			= $this->util->getValueOf($this->input->post('lang'), "EN");
			$order_num		= $this->util->getValueOf($this->input->post('order_num'), 1);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"			=> $title,
							"alias"			=> $alias,
							"thumbnail"		=> $thumbnail,
							"meta_title"	=> $meta_title,
							"meta_key"		=> $meta_key,
							"meta_desc"		=> $meta_desc,
							"summary"		=> $summary,
							"content"		=> $content,
							"order_num"		=> $order_num,
							"active"		=> $active,
							"city"			=> $city,
							"address"		=> $address,
							"gmap_address"	=> $gmap_address,
							"glat"			=> $glat,
							"glng"			=> $glng,
							"area"			=> $area,
							"top_choice"	=> $top_choice,
							"open_time"		=> $open_time,
							"catid"			=> $catid,
							"lang"			=> $lang,
			);
			
			if ($action == "new") {
				$this->m_shopping->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_shopping->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_shopping->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_shopping->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_shopping->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_shopping->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_shopping->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_shopping->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_shopping", "location");
			}
		}
		//redirect("administrator/shoppings", "location");
		$this->shoppings();
	}
	
	//------------------------------------------------------------------------------
	// Tooltips
	//------------------------------------------------------------------------------
	
	public function tooltips()
	{
		$this->util->requireEditRightLogin(USR_TOUR);
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tooltip->getItems());
		$view_data['items']			= $this->m_tooltip->getItems();
		
		$tmpl_content['content']   = $this->load->view("admin/tooltip/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_tooltip($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_tooltip->load($id);
		
		$tmpl_content['content']   = $this->load->view("admin/tooltip/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_tooltips()
	{
		$this->util->requireEditRightLogin(USR_TOUR, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"content"	=> str_replace("\"", "'", $content),
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_tooltip->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tooltip->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tooltip->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tooltip->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tooltip->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tooltip/", "location");
			}
		}
		redirect("administrator/tooltips", "location");
	}
	
	// ---------------------------------------------------------------------------------------
	// Promotion Text
	// ---------------------------------------------------------------------------------------
	
	public function promotion_txts()
	{
		$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
		
		$view_data = "";
		$view_data['items'] = $this->m_promotion_txt->getItems();

		$tmpl_content['content']   = $this->load->view("admin/promotion/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_promotion_txt($id=NULL)
	{
		$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
		
		$view_data = "";
		$view_data['item']  = $this->m_promotion_txt->load($id);
		
		$tmpl_content['content'] = $this->load->view("admin/promotion/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_promotion_txt()
	{
		$this->util->requireEditRightLogin(USR_ADMIN, MODE_WRITE);
		
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id				= $this->util->getValueOf($this->input->post('id'), "");
			$sender			= $this->util->getValueOf($this->input->post('sender'), "");
			$sender_email	= $this->util->getValueOf($this->input->post('sender_email'), "");
			$emails			= $this->util->getValueOf($this->input->post('emails'), "");
			$subject		= $this->util->getValueOf($this->input->post('subject'), "");
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			
			$data = array (
				"sender"		=> $sender,
				"sender_email"	=> $sender_email,
				"emails"		=> $emails,
				"subject"		=> $subject,
				"content"		=> $content,
				"active"		=> $active
			);
			
			if ($action == "new") {
				$this->m_promotion_txt->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_promotion_txt->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("code" => $id);
					$this->m_promotion_txt->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("code" => $id);
					$this->m_promotion_txt->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_promotion_txt->delete(array ("code" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_promotion_txt", "location");
			}
		}
		redirect("administrator/promotion_txts", "location");
	}
	
	public function test_promotion_txt()
	{
		$id = $this->input->post('id');
		$offset = $this->input->post('offset');
		
		$item = $this->m_promotion_txt->load($id);
		
		$item->emails[] = "ltp_mv_huflit@yahoo.com";
		$item->emails[] = "phanvuanhquoc@gmail.com";
		
		// Inform by mail
		$mail = array(
            	"subject"		=> $item->subject,
				"from_sender"	=> $item->sender_email,
            	"name_sender"	=> $item->sender,
				"to_receiver"   => trim($item->emails[$offset]),
				"message"       => $item->content
		);
		
		$this->mail->config($mail);
		$this->mail->sendmail();
		$this->sent();
		
		echo "Sending: ".$item->emails[$offset];
	}
	
	public function send2user_promotion_txt()
	{
	}
	
	public function send2email_promotion_txt()
	{
		$id = $this->input->post('id');
		$offset = $this->input->post('offset');
		
		$item = $this->m_promotion_txt->load($id);
		
		$item->emails = str_replace(array("\r\n", "\n", "\r"), "", $item->emails);
		$item->emails = str_replace(array(","), ";", $item->emails);
		$arremail = explode(";", $item->emails);
		
		// Inform by mail
		$mail = array(
            	"subject"		=> $item->subject,
				"from_sender"	=> $item->sender_email,
            	"name_sender"	=> $item->sender,
				"to_receiver"   => trim($arremail[$offset]),
				"message"       => $item->content
		);
		
		$this->mail->config($mail);
		$this->mail->sendmail();
		$this->sent();
		
		echo "Sending: ".$arremail[$offset];
	}
	
	//------------------------------------------------------------------------------
	// HELP CENTER
	//------------------------------------------------------------------------------
	
	public function help_categories()
	{
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_help_category->getItems());
		$view_data['items']			= $this->m_help_category->getItems(NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/help/categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function edit_help_category($id=NULL)
	{
		$view_data = "";
		$view_data['item']  = $this->m_help_category->load($id);

		$tmpl_content['content']   = $this->load->view("admin/help/categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_help_categories()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$name		= $this->util->getValueOf($this->input->post('name'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 	= $this->util->genTopicAlias($name);
			}
			
			$data = array (
							"name"		=> $name,
							"alias"		=> $alias,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_help_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_help_category->update($data, $where);
			}
		}
		else
		{
			$ids = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_help_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_help_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_help_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_help_category/", "location");
			}
		}
		redirect("administrator/help_categories", "location");
	}
	
	public function help_content()
	{
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_help_content->getItems(NULL));
		$view_data['items']			= $this->m_help_content->getItems(NULL, NULL, $limit, $offset);
		
		$tmpl_content['content']   = $this->load->view("admin/help/content/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_help_content($id=NULL)
	{
		if (!($this->uri->segment(3) === FALSE)) {
			$id = $this->uri->segment(3);
		}
		if (!($this->uri->segment(4) === FALSE)) {
			$catid = $this->uri->segment(4);
		}
		
		$item = $this->m_help_content->load($id);

		if ($item != null) {
			$catid = $item->catid;
		}
		
		$view_data = "";
		$view_data['categories'] = $this->m_help_category->getItems();
		$view_data['item']  = $item;
		
		$tmpl_content['content']   = $this->load->view("admin/help/content/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_help_content()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		$catid = $this->util->getValueOf($this->input->post('catid'), 0);

		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$catid 		= $this->util->getValueOf($this->input->post('catid'), 0);
			$title		= $this->util->getValueOf($this->input->post('title'), "");
			$alias		= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail	= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title	= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key	= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc	= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$summary	= $this->util->getValueOf($this->input->post('summary'), "");
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$lang		= $this->util->getValueOf($this->input->post('lang'), "EN");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$action		= $this->util->getValueOf($this->input->post('action'), "new");
			
			if (empty($alias)) {
				$alias 		= $this->util->genTopicAlias($title);
			}
			
			$data = array (
							"title"		=> $title,
							"alias"		=> $alias,
							"thumbnail"	=> $thumbnail,
							"meta_title"=> $meta_title,
							"meta_key"	=> $meta_key,
							"meta_desc"	=> $meta_desc,
							"summary"	=> $summary,
							"content"	=> $content,
							"active"	=> $active,
							"catid"		=> $catid,
							"lang"		=> $lang,
			);

			if ($action == "new") {
				$this->m_help_content->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_help_content->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			$orders = $this->util->getValueOf($this->input->post('order'), array());
			$cids   = $this->util->getValueOf($this->input->post('cids'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_help_content->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_help_content->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_help_content->delete(array ("id" => $id));
				}
				if ($task == "orderupList") {
					$this->m_help_content->orderUp($id);
				}
				if ($task == "orderdownList") {
					$this->m_help_content->orderDown($id);
				}
			}
			if ($task == "saveorder") {
				for ($i=0; $i<sizeof($cids); $i++) {
					$data = array ("order_num" => $orders[$i]);
					$where = array ("id" => $cids[$i]);
					$this->m_help_content->update($data, $where);
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_help_content/0/".$catid, "location");
			}
		}
		redirect("administrator/help_content/", "location");
	}
	
	
	function help_tickets()
	{
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$info->topLevel = 1;
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_help_question->getItems($info));
		$view_data['questions']		= $this->m_help_question->getItems($info, NULL, $limit, $offset);

		$tmpl_content['content']   = $this->load->view("admin/help/ticket/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function edit_help_ticket($id=NULL) {
		$view_data = "";
		$view_data['item']  = $this->m_help_question->load($id);
		
		$tmpl_content['content']   = $this->load->view("admin/help/ticket/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	public function update_help_ticket()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");
		
		if ($task == "save")
		{
			$id 		= $this->util->getValueOf($this->input->post('id'), 0);
			$title		= $this->util->getValueOf($this->input->post('title'), "");
			$status		= $this->util->getValueOf($this->input->post('ticket-status'), 0);
			$content	= $this->util->getValueOf($this->input->post('content'), "");
			$answer		= $this->util->getValueOf($this->input->post('answer'), "");
			$active		= $this->util->getValueOf($this->input->post('active'), 1);
			$alias		= $this->util->genTopicAlias($title);
			
			$data = array (
							"title"		=> $title,
							"alias"		=> $alias,
							"status"	=> $status,
							"content"	=> $content,
							"active"	=> $active,
			);
			
			$where = array ("id" => $id);
			$this->m_help_question->update($data, $where);
			
			if (!empty($answer))
			{
				$data = array (
							"parent_id"	=> $id,
							"author"	=> 1,
							"content"	=> $answer,
				);
				
				$this->m_help_question->add($data);
				
				$question = $this->m_help_question->load($id);
				
				$question_author = $this->m_user->load($question->author);
				
				$mail_data = array(
					'fullname'	=> $question_author->user_fullname,
					'question'	=> $question,
					'answer'	=> $answer,
				);
				
				$mail_tpl = $this->mail_tpl->ticket_reply($mail_data);
				
				// Mail to author
				$mail = array(
	            		"subject"		=> $question->title,
						"from_sender"	=> MAIL_INFO,
	            		"name_sender"	=> SITE_NAME,
						"to_receiver"   => $question_author->user_email,
						"message"       => $mail_tpl
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());
			
			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_help_question->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_help_question->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_help_question->delete(array ("id" => $id));
				}
			}
		}
		redirect("administrator/help_tickets", "location");
	}
	
	//------------------------------------------------------------------------------
	// TEAM
	//------------------------------------------------------------------------------

	public function team()
	{
		$view_data = "";
		$view_data['items'] = $this->m_team->getItems();

		$tmpl_content['content']   = $this->load->view("admin/team/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_member($id=NULL)
	{
		$item = $this->m_team->load($id);

		$view_data = "";
		$view_data['item']  = $item;

		$tmpl_content['content']   = $this->load->view("admin/team/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_member()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$alias 			= $this->util->getValueOf($this->input->post('alias'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$description	= $this->util->getValueOf($this->input->post('description'), "");
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");

			$data = array (
							"title"			=> $title,
							"alias"			=> $alias,
							"thumbnail"		=> $thumbnail,
							"description"	=> $description,
							"active"	=> $active,
			);

			if ($action == "new") {
				$this->m_team->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_team->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_team->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_team->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_team->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_member/", "location");
			}
		}
		redirect("administrator/team/", "location");
	}
	
	public function blog()
	{
		$view_data = "";
		$view_data['items'] = $this->m_blog->getItems();

		$tmpl_content['content']   = $this->load->view("admin/blog/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_blog($id=NULL)
	{
		$item = $this->m_blog->load($id);

		$view_data = "";
		$view_data['item']  = $item;

		$tmpl_content['content']   = $this->load->view("admin/blog/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_blog()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$userid			= $this->util->getValueOf($this->input->post('userid'), 1);
			$title			= $this->util->getValueOf($this->input->post('title'), "");
			$thumbnail		= $this->util->getValueOf($this->input->post('thumbnail'), "");
			$meta_title		= $this->util->getValueOf($this->input->post('meta_title'), "");
			$meta_key		= $this->util->getValueOf($this->input->post('meta_key'), "");
			$meta_desc		= $this->util->getValueOf($this->input->post('meta_desc'), "");
			$cat_id			= $this->util->getValueOf($this->input->post('cat_id'), null);
			$summary		= $this->util->getValueOf($this->input->post('summary'), "");
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$tags			= $this->util->getValueOf($this->input->post('blogTags'), "");
			$active			= $this->input->post('active');
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			//Generate alias if alias is left empty with format: title-id
			$aliasTitle		= str_replace(" ", "-", strtolower($title));
			$aliasID		= ($this->input->post('id') != 0)?$this->input->post('id'):$this->util->GetNextValue("tv_blog","id");
			$al 			= $aliasTitle.'-'.$aliasID;
			$alias 			= ($this->input->post('alias') != '')?$this->input->post('alias'):$al;


			$data = array (
							"user_id"		=> $userid,
							"title"			=> $title,
							"alias"			=> $alias,
							"thumbnail"		=> $thumbnail,
							"meta_title"	=> $meta_title,
							"meta_key"		=> $meta_key,
							"meta_desc"		=> $meta_desc,
							"cat_id"		=> $cat_id,
							"content"		=> $content,
							"summary"		=> $summary,
							"tags"			=> $tags,
							"active"		=> $active,
			);

			if ($action == "new") {
				$this->m_blog->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_blog->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_blog->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_blog->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_blog->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_blog/", "location");
			}
		}
		redirect("administrator/blog/", "location");
	}

	public function blog_categories()
	{
		$view_data = "";
		$view_data['items'] = $this->m_blog_category->getItems();

		$tmpl_content['content']   = $this->load->view("admin/blog/categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_blog_category($id=NULL)
	{
		$item = $this->m_blog_category->load($id);

		$view_data = "";
		$view_data['item']  = $item;

		$tmpl_content['content']   = $this->load->view("admin/blog/categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_blog_category()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$name			= $this->util->getValueOf($this->input->post('name'), "");
			$aliasName		= str_replace(" ", "-", strtolower($name));
			$alias 			= $this->util->getValueOf($this->input->post('alias'), $aliasName);
			$parent_id		= $this->util->getValueOf($this->input->post('parent_id'), "");
			$action			= $this->util->getValueOf($this->input->post('action'), "new");
			

			$data = array (
							"name"			=> $name,
							"alias"			=> $alias,
							"parent_id"		=> $parent_id
			);

			if ($action == "new") {
				$this->m_blog_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_blog_category->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_blog_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_blog_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_blog_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_blog_category/", "location");
			}
		}
		redirect("administrator/blog_categories/", "location");
	}

	public function blog_comments()
	{
		$view_data = "";
		$view_data['items'] = $this->m_blog_comment->getItems();

		$tmpl_content['content']   = $this->load->view("admin/blog/comments/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_blog_comment($id=NULL)
	{
		$item = $this->m_blog_comment->load($id);

		$view_data = "";
		$view_data['item']  = $item;

		$tmpl_content['content']   = $this->load->view("admin/blog/comments/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_blog_comment()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$content		= $this->util->getValueOf($this->input->post('content'), "");
			$name 			= $this->util->getValueOf($this->input->post('name'), "");
			$email 			= $this->util->getValueOf($this->input->post('email'), "");
			$avatar			= $this->util->getValueOf($this->input->post('avatar'), "");
			$blog_id		= $this->util->getValueOf($this->input->post('blog_id'), null);
			$parent_id		= $this->util->getValueOf($this->input->post('parent_id'), null);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");

			$data = array (
				"name"			=> $name,
				"email"			=> $email,
				"content"		=> $content,
				"avatar"		=> $avatar,
				"content"		=> $content,
				"blog_id"		=> $blog_id,
				"parent_id"		=> $parent_id,
				"active"		=> $active
			);

			if ($action == "new") {
				$this->m_blog_comment->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_blog_comment->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_blog_comment->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_blog_comment->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_blog_comment->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_blog_comment/", "location");
			}
		}
		redirect("administrator/blog_comments/", "location");
	}

	public function vietnam_holidays()
	{
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_vietnam_holiday->getItems());
		$view_data['items'] = $this->m_vietnam_holiday->getItems();

		$tmpl_content['content']   = $this->load->view("admin/vietnam/holidays/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_vietnam_holidays($id=NULL)
	{
		// echo $id;die();
		$item = $this->m_vietnam_holiday->load($id);
		// print_r($item).die();
		$view_data = "";
		$view_data['item']  = $item;

		$tmpl_content['content']   = $this->load->view("admin/vietnam/holidays/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_vietnam_holidays()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$name 			= $this->util->getValueOf($this->input->post('name'), "");
			$rate 			= $this->util->getValueOf($this->input->post('rate'), 0);
			$from			= $this->util->getValueOf(date('Y-m-d', strtotime($this->input->post('from'))), null);
			$to				= $this->util->getValueOf(date('Y-m-d', strtotime($this->input->post('to'))), null);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");

			$data = array (
				"name"			=> $name,
				"rate"			=> $rate,
				"from"			=> $from,
				"to"			=> $to,
				"active"		=> $active
			);

			if ($action == "new") {
				$this->m_vietnam_holiday->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_vietnam_holiday->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_vietnam_holiday->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_vietnam_holiday->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_vietnam_holiday->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_vietnam_holidays/", "location");
			}
		}
		redirect("administrator/vietnam_holidays", "location");
	}

	public function tour_options()
	{
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_option->getItems());
		$view_data['items'] 		= $this->m_tour_option->getItems();

		$tmpl_content['content']   = $this->load->view("admin/tour/options/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_tour_options($id=NULL)
	{
		// echo $id;die();
		$item = $this->m_tour_option->load($id);
		// print_r($item).die();
		$view_data = "";
		$view_data['item']  = $item;

		$tmpl_content['content']   = $this->load->view("admin/tour/options/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_tour_options()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$name 			= $this->util->getValueOf($this->input->post('name'), "");
			$price 			= $this->util->getValueOf($this->input->post('price'), 0);
			$tour_id		= $this->util->getValueOf($this->input->post('tour_id'), 0);
			$cat_id			= $this->util->getValueOf($this->input->post('cat_id'), 0);
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");

			$data = array (
				"name"			=> $name,
				"price"			=> $price,
				"tour_id"		=> $tour_id,
				"cat_id"		=> $cat_id,
				"active"		=> $active
			);

			if ($action == "new") {
				$this->m_tour_option->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_option->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_option->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_option->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_option->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_options/", "location");
			}
		}
		redirect("administrator/tour_options", "location");
	}

	public function tour_option_categories()
	{
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= sizeof($this->m_tour_option_category->getItems());
		$view_data['items'] 		= $this->m_tour_option_category->getItems();

		$tmpl_content['content']   = $this->load->view("admin/tour/option_categories/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function edit_tour_option_categories($id=NULL)
	{
		// echo $id;die();
		$item = $this->m_tour_option_category->load($id);
		// print_r($item).die();
		$view_data = "";
		$view_data['item']  = $item;

		$tmpl_content['content']   = $this->load->view("admin/tour/option_categories/edit", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}

	public function update_tour_option_categories()
	{
		$task  = $this->util->getValueOf($this->input->post('task'), "cancel");

		if ($task == "save")
		{
			$id 			= $this->util->getValueOf($this->input->post('id'), 0);
			$name 			= $this->util->getValueOf($this->input->post('name'), "");
			$active			= $this->util->getValueOf($this->input->post('active'), 1);
			$action			= $this->util->getValueOf($this->input->post('action'), "new");

			$data = array (
				"name"			=> $name,
				"active"		=> $active
			);

			if ($action == "new") {
				$this->m_tour_option_category->add($data);
			}
			else {
				$where = array ("id" => $id);
				$this->m_tour_option_category->update($data, $where);
			}
		}
		else
		{
			$ids    = $this->util->getValueOf($this->input->post('cid'), array());

			foreach ($ids as $id) {
				if ($task == "publish") {
					$data = array ("active" => 1);
					$where = array ("id" => $id);
					$this->m_tour_option_category->update($data, $where);
				}
				else if ($task == "unpublish") {
					$data = array ("active" => 0);
					$where = array ("id" => $id);
					$this->m_tour_option_category->update($data, $where);
				}
				else if ($task == "remove") {
					$this->m_tour_option_category->delete(array ("id" => $id));
				}
			}
			if ($task == "add") {
				redirect("administrator/edit_tour_option_categories/", "location");
			}
		}
		redirect("administrator/tour_option_categories", "location");
	}
	//------------------------------------------------------------------------------
	// PAYMENT REPORT
	//------------------------------------------------------------------------------
	
	function null2unknown($map, $key)
	{
	    if (array_key_exists($key, $map)) {
	        if (!is_null($map[$key])) {
	            return $map[$key];
	        }
	    }
	    return "No Value Returned";
	}
	
	function payment_report()
	{
		$this->util->requireEditRightLogin(USR_ADMIN);
		
		$fromdate = (!empty($_POST["fromdate"]) ? date('Y-m-d', strtotime($_POST["fromdate"])) : date('Y-m-d'));
		$todate = (!empty($_POST["todate"]) ? date('Y-m-d', strtotime($_POST["todate"])) : date('Y-m-d'));
		$payment_method = (!empty($_POST["payment_method"]) ? $_POST["payment_method"] : "");
		
		$limit  = $this->util->getValueOf($this->input->post('limit'), 20);
		$offset = $this->util->getValueOf($this->input->post('limitstart'), 0);
		
		$items = $this->m_payment->getPayments($fromdate, $todate, $payment_method);
		
		$sum_op  = 0;
		$sum_pp  = 0;
		$sum_g2s = 0;
		$sum_wu  = 0;
		$sum_bt  = 0;
		
		foreach ($items as $item) {
			if ($item->status == 1) {
				if ($item->payment_method == "OnePay") {
					$sum_op += $item->amount;
				} else if ($item->payment_method == "Paypal") {
					$sum_pp += $item->amount;
				} else if ($item->payment_method == "Credit Card") {
					$sum_g2s += $item->amount;
				} else if ($item->payment_method == "Western Union") {
					$sum_wu += $item->amount;
				} else if ($item->payment_method == "Bank Transfer") {
					$sum_bt += $item->amount;
				}
			}
		}
		
		$totalitems = sizeof($items);
		$items = $this->m_payment->getPayments($fromdate, $todate, $payment_method, $limit, $offset);
		
		$view_data = "";
		$view_data['fromdate']		= $fromdate;
		$view_data['todate']		= $todate;
		$view_data['payment_method']= $payment_method;
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['totalitems']	= $totalitems;
		$view_data['items']			= $items;
		$view_data['sum_op']		= $sum_op;
		$view_data['sum_pp']		= $sum_pp;
		$view_data['sum_g2s']		= $sum_g2s;
		$view_data['sum_wu']		= $sum_wu;
		$view_data['sum_bt']		= $sum_bt;
		
		$tmpl_content['content']   = $this->load->view("admin/payment/index", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
	
	function check_payment($txnref="")
	{
		$vpcURL = OP_QUERY_URL;
		
		$vpcOpt['vpc_Version']		= "1";
		$vpcOpt['vpc_Command']		= "queryDR";
		$vpcOpt['vpc_AccessCode']	= OP_ACCESSCODE;
		$vpcOpt['vpc_Merchant']		= OP_MERCHANT;
		$vpcOpt['vpc_MerchTxnRef']	= $txnref;
		$vpcOpt['vpc_User']			= "op01";
		$vpcOpt['vpc_Password']		= "op123456";
		
		// create a variable to hold the POST data information and capture it
		$postData = "";
		
		$ampersand = "";
		foreach ($vpcOpt as $k => $v) {
		    // create the POST data input leaving out any fields that have no value
		    if (strlen($v) > 0) {
		        $postData .= $ampersand . urlencode($k) . '=' . urlencode($v);
		        $ampersand = "&";
		    }
		}
		
		ob_start();

		// initialise Client URL object
		$ch = curl_init();
		
		// set the URL of the VPC
		curl_setopt($ch, CURLOPT_URL, $vpcURL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		curl_exec($ch);
		
		// get response
		$response = ob_get_contents();
		
		// turn output buffering off.
		ob_end_clean();
		
		// set up message paramter for error outputs
		$message = "";
		
		// serach if $response contains html error code
		if (strchr($response, "<html>") || strchr($response, "<html>")) {
		    $message = $response;
		} else {
		    // check for errors from curl
		    if (curl_error($ch))
		        $message = "%s: s" . curl_errno($ch) . "<br/>" . curl_error($ch);
		}
		
		// close client URL
		curl_close($ch);
		
		// Extract the available receipt fields from the VPC Response
		// If not present then let the value be equal to 'No Value Returned'
		$map = array();
		
		// process response if no errors
		if (strlen($message) == 0) {
		    $pairArray = split("&", $response);
		    foreach ($pairArray as $pair) {
		        $param = split("=", $pair);
		        $map[urldecode($param[0])] = urldecode($param[1]);
		    }
		    $message = $this->null2unknown($map, "vpc_Message");
		}
		
		$txnResponseCode = $this->null2unknown($map, "vpc_TxnResponseCode");
		
		if ($txnResponseCode == "0") {
			// Transaction successful
			if (substr($txnref, 0 , 3) == "po_") {
				$data  = array( 'status' => 1 );
				$where = array( 'payment_key' => $txnref );
				$this->m_payment->update($data, $where);
			}
			else if (substr($txnref, 0 , 3) == "ex_") {
				$data  = array( 'status' => 1 );
				$where = array( 'booking_key' => $txnref );
				$this->m_service->update_booking($data, $where);
			} else {
				$data  = array( 'status' => 1 );
				$where = array( 'booking_key' => $txnref );
				$this->m_visa->update_booking($data, $where);
			}
			echo "Transaction successful";
		} else if ($txnResponseCode != "0") {
			// Transaction failed
			echo "Transaction failed";
		} else {
			echo "/!\ System error.";
		}
		//redirect($_SERVER['HTTP_REFERER'], 'back');
	}
	
	function check_payment_detail($txnref="")
	{
		$vpcURL = OP_QUERY_URL;
		
		$vpcOpt['vpc_Version']		= "1";
		$vpcOpt['vpc_Command']		= "queryDR";
		$vpcOpt['vpc_AccessCode']	= OP_ACCESSCODE;
		$vpcOpt['vpc_Merchant']		= OP_MERCHANT;
		$vpcOpt['vpc_MerchTxnRef']	= $txnref;
		$vpcOpt['vpc_User']			= "op01";
		$vpcOpt['vpc_Password']		= "op123456";
		
		// create a variable to hold the POST data information and capture it
		$postData = "";
		
		$ampersand = "";
		foreach ($vpcOpt as $k => $v) {
		    // create the POST data input leaving out any fields that have no value
		    if (strlen($v) > 0) {
		        $postData .= $ampersand . urlencode($k) . '=' . urlencode($v);
		        $ampersand = "&";
		    }
		}
		
		ob_start();

		// initialise Client URL object
		$ch = curl_init();
		
		// set the URL of the VPC
		curl_setopt($ch, CURLOPT_URL, $vpcURL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		curl_exec($ch);
		
		// get response
		$response = ob_get_contents();
		
		// turn output buffering off.
		ob_end_clean();
		
		// set up message paramter for error outputs
		$message = "";
		
		// serach if $response contains html error code
		if (strchr($response, "<html>") || strchr($response, "<html>")) {
		    $message = $response;
		} else {
		    // check for errors from curl
		    if (curl_error($ch))
		        $message = "%s: s" . curl_errno($ch) . "<br/>" . curl_error($ch);
		}
		
		// close client URL
		curl_close($ch);
		
		// Extract the available receipt fields from the VPC Response
		// If not present then let the value be equal to 'No Value Returned'
		$map = array();
		
		// process response if no errors
		if (strlen($message) == 0) {
		    $pairArray = split("&", $response);
		    foreach ($pairArray as $pair) {
		        $param = split("=", $pair);
		        $map[urldecode($param[0])] = urldecode($param[1]);
		    }
		    $message = $this->null2unknown($map, "vpc_Message");
		}
		
		$txnResponseCode = $this->null2unknown($map, "vpc_TxnResponseCode");
		
		if ($txnResponseCode == "0") {
			// Transaction successful
			$this->load->view('admin/payment/detail', $map);
		} else if ($txnResponseCode != "0") {
			// Transaction failed
			$this->load->view('admin/payment/detail', $map);
		} else {
			echo "/!\ System error.";
		}
	}
	
	function ip_tracking()
	{
		$this->util->requireEditRightLogin(USR_ADMIN);
		
		$task	= $this->util->getValueOf($this->input->post('task'), "cancel");
		$ids	= $this->util->getValueOf($this->input->post('cid'), array());
		
		if ($task == "cleanall") {
			$this->m_user_online->deleteFreshIPs();
		}
		
		foreach ($ids as $id) {
			if ($task == "publish") {
				$item = $this->m_user_online->load($id);
				$data = array ("active" => 1);
				$where = array ("ip" => $item->ip);
				$this->m_user_online->update($data, $where);
			}
			else if ($task == "unpublish") {
				$item = $this->m_user_online->load($id);
				$data = array ("active" => 0);
				$where = array ("ip" => $item->ip);
				$this->m_user_online->update($data, $where);
			}
			else if ($task == "remove") {
				$this->m_user_online->delete(array ("id" => $id));
			}
			
			if ($task == "publish" || $task == "unpublish") {
				$lines = array();
				$file  = fopen(".htaccess", "r+");
				
				while(!feof($file)) {
					$fs = fgets($file);
					if (stripos($fs, "deny") !== false) {
						break;
					}
					$lines[] = $fs;
				}
				fclose($file);
				
				$file  = fopen(".htaccess", "w+");
				
				$arr_ip = array();
				$items  = $this->m_user_online->getItems(0);
				
				foreach ($items as $item) {
					if (!in_array($item->ip, $arr_ip)) {
						$arr_ip[] = $item->ip;
					}
				}
				
				foreach ($arr_ip as $ip) {
					$lines[] = "\r\ndeny from ".$ip;
				}
				
				fwrite($file, str_replace("\r\n\r\n", "\r\n", implode("", $lines)));
				fclose($file);
			}
		}
		
		$limit   		= $this->util->getValueOf($this->input->post('limit'), 100);
		$offset  		= $this->util->getValueOf($this->input->post('limitstart'), 0);
		$fromdate		= (!empty($_POST["fromdate"]) ? date('Y-m-d', strtotime($_POST["fromdate"])) : date('Y-m-d'));
		$todate			= (!empty($_POST["todate"]) ? date('Y-m-d', strtotime($_POST["todate"])) : date('Y-m-d'));
		$sortby  		= $this->util->getValueOf($this->input->post('sortby'), NULL);
		$orderby 		= $this->util->getValueOf($this->input->post('orderby'), "DESC");
		$search_text	= $this->util->getValueOf($this->input->post('search_text'), "");
		
		$totalitems = sizeof($this->m_user_online->getIPs());
		
		$items = $this->m_user_online->getIPs($fromdate, $todate, $limit, $offset, $sortby, $orderby, $search_text);
		
		$view_data = "";
		$view_data['limit']			= $limit;
		$view_data['pageidx']		= $offset/$limit + 1;
		$view_data['fromdate']		= $fromdate;
		$view_data['todate']		= $todate;
		$view_data['sortby']		= $sortby;
		$view_data['orderby']		= (($orderby == "DESC")?"ASC":"DESC");
		$view_data['search_text']	= $search_text;
		$view_data['totalitems']	= $totalitems;
		$view_data['items']			= $items;
		
		$tmpl_content['content']   = $this->load->view("admin/report/ip_tracking", $view_data, TRUE);
		$this->load->view('layout/admin', $tmpl_content);
	}
}

?>