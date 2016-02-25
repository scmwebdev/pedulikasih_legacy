<?php
class Teroka extends CI_Controller {
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
		$data['artikel_jenis_id'] = 75;
		$data['artikel_jenis_judul'] = "Teroka";
		$data['artikel_jenis_url'] = "teroka";
		$data['HTMLPageTitle'] = "Teroka, Berita Terbaru Indonesia";
		
		//$this->output->cache(60*6);
		$this->load->view('artikel', $data);
	}
}