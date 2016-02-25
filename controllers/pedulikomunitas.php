<?php
class Pedulikomunitas extends CI_Controller {
	var $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pedulikomunitas_model');
		$this->data['pk_menu'] = $this->pedulikomunitas_model->showMenu();
	}
	
	function index(){}
	
	public function _remap($method)
	{
		$arr = array("sejarah","kontak","persyaratan");
		if ($method == "index" || $method == "donatur") {
			$this->_gallery();
		} elseif ($method == "kegiatan" || $method == "pasien" || $method == "audit") {
			$this->_content($method);
		} elseif ($method == "gallery") {
			$this->_gallery();
		} elseif (in_array($method,$arr)) {
			$this->_menudetail($method);
		} else {
			$this->load->library('session');
			$this->load->library('pagination');
			$this->load->model('article_model');
			$this->load->view('pedulikomunitas/pedulikomunitas');
			
			//$this->_menudetail($method);
		}
	}
	
	function _content($kategori) {
		$kategoriArr = $this->pedulikomunitas_model->getMenuDetail($kategori, $kategori);
		if (count($kategoriArr) < 1) redirect('pedulikomunitas');
		
		$this->data['pk_kategori'] 			= $kategori;
		$this->data['pk_kategori_judul'] 	= $kategoriArr['judul'];
		$this->data['pk_kategori_desc']		= $kategoriArr['isi'];
		
		if ($this->uri->segment(3) == "" && $kategori != 'audit' && $kategori != 'kegiatan') {
			$this->data['pk_data'] = $kategoriArr;
			$this->data['pk_list'] = $this->pedulikomunitas_model->getContentList($kategori,5);
			$this->load->view('pedulikomunitas/content_index', $this->data);
			
		} elseif ($this->uri->segment(3) == "page" || $kategori == 'audit' || ($kategori == 'kegiatan' && $this->uri->segment(3) == "")) {
			$sqltot 					= "select id from pedulikomunitas_content where kategori='$kategori'";
			$totrecord					= $this->pedulikomunitas_model->totalrecord($sqltot);
			$this->data['pk_totrecord'] = $totrecord;
			
			if ($totrecord > 0) {
				$batas		= 10;
				$segment 	= 4;
				$page 		= trim($this->uri->segment($segment));
				if ($page == "" || !is_numeric($page)) $page = 0;

				$this->load->library('pagination');
				
				$config['base_url'] 	= '/pedulikomunitas/'.$kategori.'/page';
				$config['total_rows'] 	= $totrecord;
				$config['per_page'] 	= $batas;
				$config['uri_segment'] 	= $segment;
				$config['num_links'] 	= 5;
							
				$this->pagination->initialize($config); 

				$sql 						= "select id,judul,judul_url,ringkasan,kategori,pdf from pedulikomunitas_content where kategori='$kategori' order by id desc limit $page, $batas";
				$this->data['pk_data'] 		= $this->pedulikomunitas_model->fetchResultArray($sql);
				$this->data['pk_paging'] 	= '<div class="paging">'.$this->pagination->create_links().'</div>';
			}
			
			$this->load->view('pedulikomunitas/content_paging', $this->data);
			
		} else {
			$this->data['pk_data'] = $this->pedulikomunitas_model->getContentDetail($kategori,$this->uri->segment(3));
			if (count($this->data['pk_data']) < 1) redirect('pedulikomunitas');
			$this->load->view('pedulikomunitas/content_detail', $this->data);
		}
	}
	
	function _donatur() {
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->view('pedulikomunitas/donatur', $this->data);
	}
	
	function _gallery() {				
		if ($this->uri->segment(3) == "" || $this->uri->segment(3) == "page") {
			$menuArr = $this->pedulikomunitas_model->getMenuDetail('gallery','gallery');
			if (count($menuArr) < 1) redirect('pedulikomunitas');
			
			$this->data['pk_menu_judul']    = $menuArr['judul'];
			$this->data['pk_menu_desc']		= $menuArr['isi'];
	
			$sqltot 		= "select id from pedulikomunitas_album";
			$totrecord	= $this->pedulikomunitas_model->totalrecord($sqltot);
			$this->data['pk_totrecord'] = $totrecord;
			
			if ($totrecord > 0) {
				$batas		= 10;
				$segment 	= 4;
				$page 		= trim($this->uri->segment($segment));
				if ($page == "" || !is_numeric($page)) $page = 0;

				$this->load->library('pagination');
				
				$config['base_url'] 	= '/pedulikomunitas/gallery/page';
				$config['total_rows'] 	= $totrecord;
				$config['per_page'] 	= $batas;
				$config['uri_segment'] 	= $segment;
				$config['num_links'] 	= 5;
							
				$this->pagination->initialize($config); 
				
				$this->data['pk_paging'] = '<div class="paging">'.$this->pagination->create_links().'</div>';
				
				$sql 	= "select id,judul,judul_url,ringkasan,tanggal from pedulikomunitas_album order by tanggal desc limit $page, $batas";
				$this->data['pk_data'] = $this->pedulikomunitas_model->fetchResultArray($sql);
			}
			
			$this->load->view('pedulikomunitas/gallery_index', $this->data);
		} else {
			$this->data['pk_data'] = $this->pedulikomunitas_model->getAlbumDetail($this->uri->segment(3));
			
			if ($this->data['pk_data'] > 0) {
			    $this->data['pk_foto'] = $this->pedulikomunitas_model->getPhotoList($this->data['pk_data']['id']);
			    $this->data['pk_video'] = $this->pedulikomunitas_model->getVideoList($this->data['pk_data']['id']);
			} else
				redirect('pedulikomunitas/gallery');
					
			$this->load->view('pedulikomunitas/gallery_detail', $this->data);
		}
	}
	
    function _gallery_detail() {				
		$menuArr = $this->pedulikomunitas_model->getMenuDetail('gallery','gallery');
		if (count($menuArr) < 1) redirect('pedulikomunitas/gallery');
		
		$this->data['pk_menu_judul'] 	= $menuArr['judul'];
		$this->data['pk_menu_desc']		= $menuArr['isi'];

		$this->data['pk_data']    = $this->pedulikomunitas_model->getLastAlbum();
		
		if (!empty($this->data['pk_data'])) {		
			if ($this->data['pk_data'] > 0) 
			    $this->data['pk_foto'] = $this->pedulikomunitas_model->getPhotoList($this->data['pk_data']['id']);
			else
				redirect('pedulikomunitas/gallery');

			$this->load->view('pedulikomunitas/gallery_detail', $this->data);
		} else
		    redirect('pedulikomunitas/gallery');
	}   
	
	function _menudetail($judul_url) {
		$this->data['pk_data'] = $this->pedulikomunitas_model->getMenuDetail($judul_url);
		if (count($this->data['pk_data']) < 1) redirect('pedulikomunitas');
		$this->load->view('pedulikomunitas/menu_detail', $this->data);
	}
}