<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller {
	public function index()
	{
		//if (substr($_SERVER['REQUEST_URI'],0,10) != '/index.php') redirect();
		
		$this->load->model('modules');
		$viewVars = array();
		
		$this->load->view('main', $viewVars);
	}
}