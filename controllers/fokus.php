<?php
class Fokus extends CI_Controller {
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
		$data['artikel_jenis_id'] = 5;
		$data['artikel_jenis_judul'] = "Fokus";
		$data['artikel_jenis_url'] = "fokus";
		$data['HTMLPageTitle'] = "Fokus, Berita Terbaru Indonesia";
		
		//$this->output->cache(60*6);
		$this->load->view('artikel', $data);
	}
}