<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller {

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		$id = (isset($_REQUEST['id']) ? trim($_REQUEST['id']) : '');
		if (!empty($id)) $this->load->view('helps/'.$id);
	}
	
}