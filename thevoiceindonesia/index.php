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
		$data['HTMLPageTitle'] = "The Voice Indonesia";
		//$this->load->view('thevoiceindonesia/header', $data);
		$this->load->view('thevoiceindonesia/index', $data);
		//$this->load->view('thevoiceindonesia/footer', $data);
	}
}