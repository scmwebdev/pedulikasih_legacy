<?php
class Videoramadhan extends CI_Controller {
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
		$data['artikel_jenis_id'] = 11;
		$data['artikel_jenis_judul'] = "Video Ramadhan";
		$data['artikel_jenis_url'] = "video-ramadhan";
		$data['HTMLPageTitle'] = "Video Ramadhan Indosiar";
		
		//$this->output->cache(60*6);
		$this->load->view('artikel', $data);
	}
}