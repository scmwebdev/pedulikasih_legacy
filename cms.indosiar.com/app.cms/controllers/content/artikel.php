<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Artikel extends CI_Controller {
	  public function __construct() {
				parent::__construct();
		    $this->load->model('content/artikel_model'); 
	  }
	    
		public function index()
		{
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('content/artikel_views', $viewVars);
		}
		
		public function json()
		{
	    	if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
		    		$page 	= (isset($_GET['page'])) ? $_GET['page'] : 1;
		    		$start 	= (isset($_GET['start'])) ? $_GET['start'] : 0;
		    		$limit	= (isset($_GET['limit'])) ? $_GET['limit'] : 50;
	    	} else {
		    		$page 	= 1;
		    		$start 	= 0;
		    		$limit	= 50;
	    	}
				
				$keyword = (isset($_GET['q'])) ? $_GET['q'] : "";
				$jenis_id = (isset($_GET['jenisid'])) ? $_GET['jenisid'] : "";
	    	
	    	echo $this->artikel_model->json($keyword,$jenis_id,$start,$limit,$page);
		}
	
		public function jsonitem() 
		{
				$data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
				$data = $this->artikel_model->getData($data_id);
				echo json_encode($data);
		}

		public function jsonjenis() 
		{
				echo $this->artikel_model->jsonJenis();
		}
		
		public function submitdata()
		{			
				if ($this->input->post('judul')) {
						$data_id = $this->input->post('id');
						
						if ($data_id == "")
								$this->artikel_model->addData();
						else
								$this->artikel_model->editData($data_id);
							
						echo "{success: true}";
				}
		}
		
		public function submitimage()
		{			
				if ($this->input->post('judul')) {
						$this->artikel_model->uploadImage();
						echo "{success: true}";
				}
		}
		
		public function submitvideo()
		{			
				if ($this->input->post('judul')) {
						$this->artikel_model->uploadVideo();
						echo "{success: true}";
				}
		}
		
		public function deletedata()
		{
				if ($this->input->post('postdata')) {
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->artikel_model->deleteData($data_id);
				}
		}
		
		public function publishdata()
		{
				if ($this->input->post('postdata')) {
						$set = $this->input->post('set');
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->artikel_model->publishData($data_id,$set);
				}
		}
}