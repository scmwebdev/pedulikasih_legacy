<?php
class Budaya extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
	}
	
	function _remap($method) {
		$this->index();
  }
  
	function index()
	{
		$data['artikel_jenis_id'] = 14;
		$data['artikel_jenis_judul'] = "Budaya";
		$data['artikel_jenis_url'] = "budaya";
		$data['HTMLPageTitle'] = "Budaya Indonesia";
		
		//$this->output->cache(60*6);
		$this->load->view('artikel', $data);
	}
}