<?php
class Patroli extends CI_Controller {
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
		$data['artikel_jenis_id'] = 6;
		$data['artikel_jenis_judul'] = "Patroli";
		$data['artikel_jenis_url'] = "patroli";
		$data['HTMLPageTitle'] = "Patroli, Berita Kriminal Indonesia";

		//$this->output->cache(60*6);		
		$this->load->view('artikel', $data);
	}
}