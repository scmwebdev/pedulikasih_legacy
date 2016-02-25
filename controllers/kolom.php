<?php
class Kolom extends CI_Controller {
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
		$data['artikel_jenis_id'] = 7;
		$data['artikel_jenis_judul'] = "Kolom";
		$data['artikel_jenis_url'] = "kolom";
		$data['HTMLPageTitle'] = "Artikel Indonesia, Kolom Indonesia, Magic Brain";

		//$this->output->cache(60*6);		
		$this->load->view('artikel', $data);
	}
}