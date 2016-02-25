<?php
class Beritaterkini extends CI_Controller {
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
		$data['artikel_jenis_id'] = 8;
		$data['artikel_jenis_judul'] = "Berita Terkini";
		$data['artikel_jenis_url'] = "berita-terkini";
		$data['HTMLPageTitle'] = "Berita Terkini";
		
		$this->load->view('artikel', $data);
	}
}