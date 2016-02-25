<?php
class Menukuliner extends CI_Controller {
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
		$data['artikel_jenis_id'] = 12;
		$data['artikel_jenis_judul'] = "Menu Kuliner";
		$data['artikel_jenis_url'] = "menu-kuliner";
		$data['HTMLPageTitle'] = "Menu Kuliner Terbaru Indonesia";
		
		//$this->output->cache(60*6);
		$this->load->view('artikel', $data);
	}
}
?>