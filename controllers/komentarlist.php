<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Komentarlist extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}
	
	function index()
	{		
		$data['artikel_id'] = $this->uri->segment(2);
		$data['page'] = $this->uri->segment(3);
		$data['batas'] = 10;
		
		$this->load->view('article/article_comment_list', $data);
	}
}