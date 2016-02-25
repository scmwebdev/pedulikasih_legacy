<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{	
		$data['HTMLPageTitle'] = "Akademi Fantasi Indosiar";
		$this->load->view('afi2013/header', $data);
		$this->load->view('afi2013/index', $data);
		$this->load->view('afi2013/footer', $data);
	}
}