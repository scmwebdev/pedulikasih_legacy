<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Theme extends CI_Controller {

	public function index()
	{	
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		$this->load->model('auths');
		$this->auths->setTheme();
		$this->session->set_userdata('themes', trim($_POST['theme']));
		print json_encode(array('success'=> true));
	}
	
}