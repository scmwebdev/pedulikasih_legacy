<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Article extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}
	
	function index()
	{
		$dataJenis = $this->article_model->getArticleJenis($this->uri->segment(1));
		if (count($dataJenis) > 0) {
			$data['artikel_jenis_id'] 		= $dataJenis['id'];
			$data['artikel_jenis_judul'] 	= $dataJenis['jenis'];
			$data['artikel_jenis_url'] 		= $dataJenis['jenis_url'];
			$data['artikel_jenis_desc'] 	= $dataJenis['jenis_desc'];
		
			if ($this->uri->segment(2) == "" || $this->uri->segment(2) == "page") {
				$this->load->library('pagination');
				$this->load->view('article/article_jenis', $data);
			} else {
				if (is_numeric($this->uri->segment(2))) 
					$data['artikel_id'] = $this->uri->segment(2);
				else {
					$arrURI = explode("_", str_replace(".html", "", $this->uri->segment(2)));
					if (count($arrURI ) == 2 && is_numeric($arrURI[1]))
						$data['artikel_id'] = $arrURI[1];
					else
						redirect();
				}
				
				$this->load->view('article/article_detail', $data);
			}
		} else 
			redirect();
	}
}