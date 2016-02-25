<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prologue extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('galaxysuperstar_model');
		//redirect();
	}
	
	function index()
	{	
		$data['HTMLPageTitle'] = "Prologue - The Voice Indonesia";
		$this->load->view('thevoiceindonesia/header', $data);
		$this->load->view('thevoiceindonesia/prologue', $data);
		$this->load->view('thevoiceindonesia/footer', $data);
	}
}