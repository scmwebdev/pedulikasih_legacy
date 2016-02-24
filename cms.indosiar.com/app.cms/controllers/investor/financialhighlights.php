<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Financialhighlights extends CI_Controller {
    public function __construct() {
	    parent::__construct();
	    $this->load->model('investor/financialhighlights_model');
	}

    public function index()
    {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
        if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
        
        $this->load->model('modules');
        $viewVars = array();
        $viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
        $this->load->view('investor/financialhighlights_views', $viewVars);
    }

	public function json()
	{	    	
    	echo $this->financialhighlights_model->json();
	}

	public function submitdata()
	{			
		if ($this->input->post('isi')) {
			$this->financialhighlights_model->submitData();							
			echo "{success: true}";
		}
	}
}