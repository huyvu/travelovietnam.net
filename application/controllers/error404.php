<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error404 extends CI_Controller {

	public function index()
	{
		$tmpl_content['meta']['title'] = "Error 404 - Page Not Found!!!";
		$tmpl_content['content'] = $this->load->view("error404", NULL, TRUE);
		$this->load->view('layout/tour', $tmpl_content);
	}
}

?>