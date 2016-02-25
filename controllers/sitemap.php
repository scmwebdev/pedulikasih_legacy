<?php
class Sitemap extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}
	
	function index()
	{
		$this->load->view('sitemap');
	}
}