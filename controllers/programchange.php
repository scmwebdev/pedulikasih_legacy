<?php
class Programchange extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}
	
	function index()
	{
		$this->load->view('programchange');
	}
}