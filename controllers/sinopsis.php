<?php
class Sinopsis extends CI_Controller {
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
		$data['artikel_jenis_id'] = 1;
		$data['artikel_jenis_judul'] = "Sinopsis";
		$data['artikel_jenis_url'] = "sinopsis";
		$data['HTMLPageTitle'] = "Sinopsis Cerita Indonesia, Sinopsis Tv";
		
		//if (is_numeric($this->uri->segment(2)))
			//$this->output->cache(60*6);
		//else
			//$this->output->cache(60*2);
			
		$this->load->view('artikel', $data);
	}
}