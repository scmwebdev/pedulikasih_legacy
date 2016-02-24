<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Homepage extends CI_Controller {
	  public function __construct() {
				parent::__construct();
		    $this->load->model('investor/homepage_model'); 
	  }
	    
		public function index()
		{
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('investor/homepage_views', $viewVars);
		}
		
		public function json()
		{	    	
	    	echo $this->homepage_model->json();
		}
	
		public function jsonitem() 
		{
				$data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
				$data = $this->homepage_model->getData($data_id);
				echo json_encode($data);
		}
		
		public function jsonmainmenu()
		{	    	
	    	$data = $this->homepage_model->jsonmainmenu();
	    	echo json_encode($data);
		}
		
		public function submitdata()
		{			
				if ($this->input->post('col_title')) {
						$this->homepage_model->submitData();							
						echo "{success: true}";
				}
		}
		
		public function deletedata()
		{
				if ($this->input->post('postdata')) {
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->homepage_model->deleteData($data_id);
				}
		}
		
		// COLUMN HIGHLIGHTS //
		public function jsoncolumn()
		{	    	
	    	echo $this->homepage_model->jsoncolumn();
		}
	
		public function jsonitemcolumn() 
		{
				$data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
				$data = $this->homepage_model->getDataColumn($data_id);
				echo json_encode($data);
		}
		
		public function jsonmainmenucolumn()
		{	    	
	    	$data = $this->homepage_model->jsonmainmenucolumn();
	    	echo json_encode($data);
		}
		
		public function submitdatacolumn()
		{			
				if ($this->input->post('judul')) {
						$this->homepage_model->submitDataColumn();							
						echo "{success: true}";
				}
		}
		
		public function deletedatacolumn()
		{
				if ($this->input->post('postdata')) {
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->homepage_model->deleteDataColumn($data_id);
				}
		}
		
		public function jsonmenu()
		{	    	
	    	echo $this->homepage_model->jsonmenu();
		}
}