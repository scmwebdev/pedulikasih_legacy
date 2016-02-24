<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jenisartikel extends CI_Controller {
	  public function __construct() {
				parent::__construct();
		    $this->load->model('content/jenisartikel_model'); 
	  }
	    
		public function index()
		{
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('content/jenisartikel_views', $viewVars);
		}
		
		public function jsonjenis()
		{	    	
	    	echo $this->jenisartikel_model->jsonJenis();
		}
	
		public function jsonitemjenis() 
		{
				$data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
				$data = $this->jenisartikel_model->getDataJenis($data_id);
				echo json_encode($data);
		}

		public function jsonkategori() 
		{
				echo $this->jenisartikel_model->jsonKategori();
		}
		
		public function jsonitemkategori() 
		{
				$data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
				$data = $this->jenisartikel_model->getDataKategori($data_id);
				echo json_encode($data);
		}
		
		public function jsonkategoriform() 
		{
				echo $this->jenisartikel_model->jsonKategoriForm();
		}
		
		public function submitjenis()
		{			
				if ($this->input->post('kategori_id')) {
						$this->jenisartikel_model->submitDataJenis();							
						echo "{success: true}";
				}
		}
		
		public function submitkategori()
		{			
				if ($this->input->post('kategori')) {
						$this->jenisartikel_model->submitDataKategori();
						echo "{success: true}";
				}
		}
		
		public function deletedatajenis()
		{
				if ($this->input->post('postdata')) {
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->jenisartikel_model->deleteDataJenis($data_id);
				}
		}
		
		public function deletedatakategori()
		{
				if ($this->input->post('postdata')) {
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->jenisartikel_model->deleteDataKategori($data_id);
				}
		}
		
		public function publishdatajenis()
		{
				if ($this->input->post('postdata')) {
						$set = $this->input->post('set');
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->jenisartikel_model->publishDataJenis($data_id,$set);
				}
		}
		
		public function publishdatakategori()
		{
				if ($this->input->post('postdata')) {
						$set = $this->input->post('set');
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->jenisartikel_model->publishDataKategori($data_id,$set);
				}
		}
}