<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function index()
	{
		$catinfo = "about-us";
		$cat = $this->m_content_category->load($catinfo);
		
		$info->catid = $cat->id;
		$item = $this->m_content->getItem($info, 1);
		
		$view_data = "";
		$view_data['item'] = $item;
		$view_data["navindex"] = "about";
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = $item->title;
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content'] = $this->load->view("about", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
}

?>