<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('galaxysuperstar_model');
		//redirect();
	}
	
	function index()
	{	
		$data['HTMLPageTitle'] = "Galaxy Superstar";
		$this->load->view('galaxysuperstar/galaxysuperstar_header', $data);
		$this->load->view('galaxysuperstar/galaxysuperstar_index', $data);
		$this->load->view('galaxysuperstar/galaxysuperstar_footer', $data);
	}
}