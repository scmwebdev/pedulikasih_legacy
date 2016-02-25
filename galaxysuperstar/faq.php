<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Faq extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('galaxysuperstar_model');
		redirect();
	}
	
	function index()
	{	
		$data['HTMLPageTitle'] = "FAQ - Galaxy Superstar";
		$this->load->view('galaxysuperstar/galaxysuperstar_header', $data);
		$this->load->view('galaxysuperstar/galaxysuperstar_faq', $data);
		$this->load->view('galaxysuperstar/galaxysuperstar_footer', $data);
	}
}