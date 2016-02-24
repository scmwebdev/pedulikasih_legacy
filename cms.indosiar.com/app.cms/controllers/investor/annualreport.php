<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Annualreport extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('investor/annualreport_model'); 
    }
	    
	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

		$this->load->model('modules');
		$viewVars = array();
		$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
		$this->load->view('investor/annualreport_views', $viewVars);
	}
		
	public function json()
	{	    	
    	echo $this->annualreport_model->json();
	}
	
	public function jsonitem() 
	{
		$data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
		$data = $this->annualreport_model->getData($data_id);
		echo json_encode($data);
	}
		

	public function submitdata()
	{			
		if ($this->input->post('tahun')) {
            $this->annualreport_model->submitData();							
			echo "{success: true}";
		}
	}
		
	public function deletedata()
	{
		if ($this->input->post('postdata')) {
			$arrdata = explode("|", $this->input->post('postdata'));
			foreach($arrdata as $data_id) if ($data_id != "") $this->annualreport_model->deleteData($data_id);
		}
	}
		
	public function publishdata()
	{
		if ($this->input->post('postdata')) {
			$set = $this->input->post('set');
			$arrdata = explode("|", $this->input->post('postdata'));
			foreach($arrdata as $data_id) if ($data_id != "") $this->annualreport_model->publishData($data_id,$set);
		}
	}
}