<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Controller {

	public function index()
	{
		$this->travel();
	}
	
	public function travel($alias=NULL)
	{
		$view_data = "";
		$view_data['team'] = $this->m_team->getItems();
		
		$tmpl_content = "";
		$tmpl_content['content']   = $this->load->view("team/travel", $view_data, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
}

?>