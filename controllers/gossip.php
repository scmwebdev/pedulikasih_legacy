<?php
class Gossip extends CI_Controller {
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
		$data['artikel_jenis_id'] = 2;
		$data['artikel_jenis_judul'] = "Gossip";
		$data['artikel_jenis_url'] = "gossip";
		$data['HTMLPageTitle'] = "Artis Indonesia, Gosip Selebriti Indonesia dan Dunia";
		
		//$this->output->cache(60*6);
		$this->load->view('artikel', $data);
	}
}