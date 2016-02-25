<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->load->library('pagination');
	}
	
	function index()
	{
		$keyword = trim($this->input->post('qword', TRUE));
		if ($keyword == "") 
			$keyword = str_replace("-", " ", $this->uri->segment(2));
		else {
			$keyword = strip_tags($keyword);
			require_once($this->config->item('ROOTBASEPATH').'phpx/inc_badwords.php');
			$keyword = str_ireplace($arrBadWords, '', $keyword);
		}

		$data['keyword']		 = $keyword;
		$data['keyword_url'] = ($keyword == "") ? "" : $this->allfunction->judul2url($keyword);
		$data['page']		 		 = $this->uri->segment(3);
		
		$this->load->view('article/article_search', $data);
	}
}