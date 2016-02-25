<?php
class Kitapeduli extends CI_Controller {
	function index()
	{
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('kitapeduli_model');
		$this->load->model('article_model');
		//$this->load->view('kitapeduli/kitapeduli');
		//$this->load->view('kitapeduli/kitapeduli');
		
        switch ($this->uri->segment(2)) {
            case "berita":
                $this->load->view('kitapeduli/kp_berita.php');
                break;
            case "bcaperorangan":
                $this->load->view('kitapeduli/kp_bcaperorangan.php');
                break;
            case "gallery":
                $this->_gallery();
                break;
            default:
                $this->load->view('kitapeduli/kp_bcaperorangan.php');
        }
	}
	
	function _gallery() {				
		if ($this->uri->segment(3) == "" || $this->uri->segment(3) == "page") {	
			$sqltot 	= "select id from kitapeduli_album";
			$totrecord	= $this->kitapeduli_model->totalrecord($sqltot);
			$this->data['pk_totrecord'] = $totrecord;
			
			if ($totrecord > 0) {
				$batas		= 10;
				$segment 	= 4;
				$page 		= trim($this->uri->segment($segment));
				if ($page == "" || !is_numeric($page)) $page = 0;

				$this->load->library('pagination');
				
				$config['base_url'] 		= '/kitapeduli/gallery/page';
				$config['total_rows'] 	= $totrecord;
				$config['per_page'] 		= $batas;
				$config['uri_segment'] 	= $segment;
				$config['num_links'] 		= 5;
							
				$this->pagination->initialize($config); 
				
				$this->data['pk_paging'] = '<div class="paging">'.$this->pagination->create_links().'</div>';
				
				$sql 	= "select id,judul,judul_url,ringkasan from kitapeduli_album order by id desc limit $page, $batas";
				$this->data['pk_data'] = $this->kitapeduli_model->fetchResultArray($sql);
			}
			
			$this->load->view('kitapeduli/gallery_index', $this->data);
		} else {
			$this->data['pk_data'] = $this->kitapeduli_model->getAlbumDetail($this->uri->segment(3));
			
			if ($this->data['pk_data'] > 0) 
			    $this->data['pk_foto'] = $this->kitapeduli_model->getPhotoList($this->data['pk_data']['id']);
			else
				redirect('kitapeduli/gallery');
					
			$this->load->view('kitapeduli/gallery_detail', $this->data);
		}
	}
}