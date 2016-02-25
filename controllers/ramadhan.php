<?php
class Ramadhan extends CI_Controller {
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
		$data['artikel_jenis_id'] = 10;
		$data['artikel_jenis_judul'] = "Ramadhan";
		$data['artikel_jenis_url'] = "ramadhan";
		$data['HTMLPageTitle'] = "Ramadhan";

		//$this->output->cache(10);		
		$this->load->view('ramadhan', $data);
	}
}