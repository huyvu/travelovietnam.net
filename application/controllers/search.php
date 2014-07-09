<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
		$searchCriteria->cx = !empty($_GET["searchCriteria"]) ? $_GET["searchCriteria"] : "";
		
		$view_data = "";
		$view_data['searchCriteria'] = $searchCriteria;
		
		$tmpl_content = "";
		$tmpl_content['content']   = $this->load->view("search/index", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>