<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {

	public function index()
	{
		$view_data = "";

		$tmpl_content = "";
		$tmpl_content['content'] = $this->load->view("support/index", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
}

?>