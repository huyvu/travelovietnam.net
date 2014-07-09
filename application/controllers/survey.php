<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function index()
	{
		$view_data = "";
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "TraveloVietnam - Service Satisfaction Survey";
		$tmpl_content['content']   = $this->load->view("survey/index", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}

	public function thanks()
	{
		$view_data = "";
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "TraveloVietnam - Service Satisfaction Survey";
		$tmpl_content['content']   = $this->load->view("survey/thanks", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
}

?>