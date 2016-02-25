<?php
class kitapeduli extends CI_Controller {
	var $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kitapeduli_model');
		$this->data['pk_menu'] = $this->kitapeduli_model->showMenu();
	}
	
	function index(){}
	
	public function _remap($method)
	{
		$arr = array("sejarah","kontak","persyaratan");
		if ($method == "index" || $method == "donatur") {
			$this->_donatur();
		} elseif ($method == "kegiatan" || $method == "pasien" || $method == "audit") {
			$this->_content($method);
		} elseif ($method == "gallery") {
			$this->_gallery();
        } elseif ($method == "berita") {
            $this->load->library('pagination');
            $this->load->model('article_model');
			$this->load->view('kitapeduli/berita.php', $this->data);
		} elseif (in_array($method,$arr)) {
			$this->_menudetail($method);
		} else {
			$this->load->library('session');
			$this->load->library('pagination');
			$this->load->model('article_model');
			$this->load->view('kitapeduli/kitapeduli');
			
			//$this->_menudetail($method);
		}
	}
	
	function _content($kategori) {
		$kategoriArr = $this->kitapeduli_model->getMenuDetail($kategori, $kategori);
		if (count($kategoriArr) < 1) redirect('kitapeduli');
		
		$this->data['pk_kategori'] 			= $kategori;
		$this->data['pk_kategori_judul'] 	= $kategoriArr['judul'];
		$this->data['pk_kategori_desc']		= $kategoriArr['isi'];
		
		if ($this->uri->segment(3) == "" && $kategori != 'audit' && $kategori != 'kegiatan') {
			$this->data['pk_data'] = $kategoriArr;
			$this->data['pk_list'] = $this->kitapeduli_model->getContentList($kategori,5);
			$this->load->view('kitapeduli/content_index', $this->data);
			
		} elseif ($this->uri->segment(3) == "page" || $kategori == 'audit' || ($kategori == 'kegiatan' && $this->uri->segment(3) == "")) {
			$sqltot 					= "select id from kitapeduli_content where kategori='$kategori'";
			$totrecord					= $this->kitapeduli_model->totalrecord($sqltot);
			$this->data['pk_totrecord'] = $totrecord;
			
			if ($totrecord > 0) {
				$batas		= 10;
				$segment 	= 4;
				$page 		= trim($this->uri->segment($segment));
				if ($page == "" || !is_numeric($page)) $page = 0;

				$this->load->library('pagination');
				
				$config['base_url'] 	= '/kitapeduli/'.$kategori.'/page';
				$config['total_rows'] 	= $totrecord;
				$config['per_page'] 	= $batas;
				$config['uri_segment'] 	= $segment;
				$config['num_links'] 	= 5;
							
				$this->pagination->initialize($config); 

				$sql 						= "select id,judul,judul_url,ringkasan,kategori,pdf from kitapeduli_content where kategori='$kategori' order by id desc limit $page, $batas";
				$this->data['pk_data'] 		= $this->kitapeduli_model->fetchResultArray($sql);
				$this->data['pk_paging'] 	= '<div class="paging">'.$this->pagination->create_links().'</div>';
			}
			
			$this->load->view('kitapeduli/content_paging', $this->data);
			
		} else {
			$this->data['pk_data'] = $this->kitapeduli_model->getContentDetail($kategori,$this->uri->segment(3));
			if (count($this->data['pk_data']) < 1) redirect('kitapeduli');
			$this->load->view('kitapeduli/content_detail', $this->data);
		}
	}
	
	function _donatur() {
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->view('kitapeduli/donatur', $this->data);
	}
	
	function _gallery() {				
		if ($this->uri->segment(3) == "" || $this->uri->segment(3) == "page") {
			$menuArr = $this->kitapeduli_model->getMenuDetail('gallery','gallery');
			if (count($menuArr) < 1) redirect('kitapeduli');
			
			$this->data['pk_menu_judul'] 	= $menuArr['judul'];
			$this->data['pk_menu_desc']		= $menuArr['isi'];
	
			$sqltot 		= "select id from kitapeduli_album";
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
				
				$sql 	= "select id,judul,judul_url,ringkasan,tanggal from kitapeduli_album order by tanggal desc limit $page, $batas";
				$this->data['pk_data'] = $this->kitapeduli_model->fetchResultArray($sql);
			}
			
			$this->load->view('kitapeduli/gallery_index', $this->data);
		} else {
			$this->data['pk_data'] = $this->kitapeduli_model->getAlbumDetail($this->uri->segment(3));
			
			if ($this->data['pk_data'] > 0) {
			    $this->data['pk_foto'] = $this->kitapeduli_model->getPhotoList($this->data['pk_data']['id']);
				$this->data['pk_video'] = $this->kitapeduli_model->getVideoList($this->data['pk_data']['id']);
			} else
				redirect('kitapeduli/gallery');
					
			$this->load->view('kitapeduli/gallery_detail', $this->data);
		}
	}
	
	function _menudetail($judul_url) {
		$this->data['pk_data'] = $this->kitapeduli_model->getMenuDetail($judul_url);
		if (count($this->data['pk_data']) < 1) redirect('kitapeduli');
		$this->load->view('kitapeduli/menu_detail', $this->data);
	}
}