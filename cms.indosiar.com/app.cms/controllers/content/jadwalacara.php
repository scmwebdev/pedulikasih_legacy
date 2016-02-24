<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jadwalacara extends CI_Controller {
	  public function __construct() {
				parent::__construct();
		    $this->load->model('content/jadwalacara_model'); 
	  }
	    
		public function index()
		{
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('content/jadwalacara_views', $viewVars);
		}
		
		public function json()
		{
	    	if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
		    		$page 	= (isset($_GET['page'])) ? $_GET['page'] : 1;
		    		$start 	= (isset($_GET['start'])) ? $_GET['start'] : 0;
		    		$limit	= (isset($_GET['limit'])) ? $_GET['limit'] : 100;
	    	} else {
		    		$page 	= 1;
		    		$start 	= 0;
		    		$limit	= 100;
	    	}
				
				$tgl	= (isset($_GET['tgl'])) ? $_GET['tgl'] : "";
				$thn	= (isset($_GET['thn'])) ? $_GET['thn'] : "";
				$bln	= (isset($_GET['bln'])) ? $_GET['bln'] : "";
				
				$sc_date = ($tgl != "" && $bln != "" && $thn != "") ? $thn.'-'.$bln.'-'.$tgl : date("Y-m-d");
				
				echo $this->jadwalacara_model->json($sc_date,$start,$limit,$page);
		}
	
		public function jsonpreview()
		{
				$sc_date	= (isset($_GET['sc_date'])) ? $_GET['sc_date'] : date("Y-m-d");
				echo $this->jadwalacara_model->jsonPreview($sc_date);
		}
		
	
		public function jsonitem() 
		{
				$sc_id	= (isset($_GET['sc_id'])) ? $_GET['sc_id'] : "";
				echo $this->jadwalacara_model->jsonItem($sc_id);
		}
	
		public function submitdata()
		{			
				if ($this->input->post('sc_title')) {
					$data_id = base64_decode($this->input->post('sc_id'));
					
					if ($data_id == "")
						$this->jadwalacara_model->addData();
					else
						$this->jadwalacara_model->editData($data_id);
						
					echo "{success: true}";
				}
		}
		
		public function submitmassinput()
		{
				if ($this->input->post('jadwal')) echo $this->jadwalacara_model->InputMassal($this->input->post('jadwal'));
		}
		
		public function deletedata()
		{
				if ($this->input->post('postdata')) {
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->jadwalacara_model->deleteData(base64_decode($data_id));
				}
		}
		
		public function publishdata()
		{
				if ($this->input->post('postdata')) {
						$set = $this->input->post('set');
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->jadwalacara_model->publishData(base64_decode($data_id),$set);
				}
		}
		
		public function fixitdata()
		{
				if ($this->input->post('postdata')) {					
						$this->jadwalacara_model->fixitData($this->input->post('postdata'));
				}
		}
}