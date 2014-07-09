<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vietnam_Holiday extends CI_Controller {

	public function index($year = NULL)
	{
		if ($year) {
			$holidays = $this->m_vietnam_holiday->getItemsByYear($year);
		}else{
			$holidays = $this->m_vietnam_holiday->getItemsByYear(date('Y'));
			$year = date('Y');	
		}
		
		$view_data = "";
		$view_data['items'] = $holidays;
		$view_data["navindex"] = "about";
		$view_data["year"] = $year;
		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("vietnam_holiday", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}

	public function filterByYear(){
		$year = $this->input->post('year');
		$holidays = $this->m_vietnam_holiday->getItemsByYear($year);
		$view_data = "";
		$view_data['items'] = $holidays;
		$view_data["navindex"] = "about";
		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("vietnam_holiday", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
}

?>