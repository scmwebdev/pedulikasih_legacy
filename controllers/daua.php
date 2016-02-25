<?php
class Daua extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('daua_model');
	}
	
	function _remap($method) {
  			$method = strtolower($method);
	  		if ($method == "kontak") 
	  			$this->load->view('daua/kontak'); 			
	  		elseif ($method == "smile") 
	  			$this->load->view('daua/popup_smile'); 			
	  		elseif ($method == "save") 
	  			$this->load->view('daua/daua_save'); 			
	  		else
				$this->load->view('daua/daua');	  
	}
  
	function index()
	{
		$this->load->view('daua/daua');
	}

	function page()
	{
		$this->load->view('daua/daua');
	}	
}
?>