<?php
class Jadwalacara extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jadwalacara_model');
		$this->load->model('article_model');
	}
	
	function index()
	{	
		$this->load->view('jadwal_acara');
	}
}