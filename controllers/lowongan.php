<?php
class Lowongan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->load->model('lowongan_model');
	}
	
	function index()
	{
		$data['lowongan'] = $this->lowongan_model->getArticle();
		$this->load->view('lowongan',$data);
	}
}