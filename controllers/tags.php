<?php
class Tags extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}
  
	function index()
	{
		//$this->output->cache(60*12);
		if ($this->uri->segment(2) == "")
			$this->load->view('article/article_tag_index');
		else {
			$sql = "select tags from ivmweb2009_artikel_tags where tags_url='".$this->uri->segment(2)."' limit 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$data['tags_judul'] = ucwords($row->tags);
			} else
				redirect('tag');
			$query->free_result();
				
			$data['tags_url'] = $this->uri->segment(2);
			
			$this->load->library('pagination');
			$this->load->view('article/article_tag_detail', $data);
		}
	}
}
?>
