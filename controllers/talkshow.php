<?php
class Talkshow extends CI_Controller {
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
		$data['artikel_jenis_id'] = 4;
		$data['artikel_jenis_judul'] = "Talk Show";
		$data['artikel_jenis_url'] = "talk-show";
		$data['HTMLPageTitle'] = "Talk Show Tv Indonesia, Bincang Bincang";

		//$this->output->cache(60*6);		
		$this->load->view('artikel', $data);
	}
}