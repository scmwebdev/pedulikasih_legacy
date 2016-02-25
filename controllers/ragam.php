<?php
class Ragam extends CI_Controller {
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
		$data['artikel_jenis_id'] = 3;
		$data['artikel_jenis_judul'] = "Ragam";
		$data['artikel_jenis_url'] = "ragam";
		$data['HTMLPageTitle'] = "Ragam Indonesia, Aneka Indonesia";
		
		//$this->output->cache(60*6);
		$this->load->view('artikel', $data);
	}
}