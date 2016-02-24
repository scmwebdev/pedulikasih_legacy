<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sesschecked extends CI_Controller {

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		print json_encode(array('sess'=>$this->session->islogin));
	}
	
}