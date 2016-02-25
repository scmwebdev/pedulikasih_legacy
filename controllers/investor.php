<?php
class Investor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('investor_model');
	}
	
	function _remap($method) {
	    redirect('corporate');
		//$this->index();
  	}
  
	function index()
	{
		if ($this->uri->segment(2) == "english") {
			$versi 		= "english";
			$judul_url 	= trim($this->uri->segment(3));
		} else {
			$versi 		= "bahasa";
			$judul_url 	= trim($this->uri->segment(2));
		}
		
		$data["versi"] 					= $versi;
		$data["menu"] 					= $this->investor_model->showMenu($versi);
		
		if (($versi == "bahasa" && trim($this->uri->segment(2)) != "") || ($versi == "english" && trim($this->uri->segment(3)) != "")) {
			$data["isi"] 					= $this->investor_model->getData($versi, $judul_url);
			$this->load->view('investor/investor_detail', $data);
		} else {
			$data["ColumnHighlights"] 		= $this->investor_model->showColumnHighlights($versi);
			$data["FinancialHighlights"]	= $this->investor_model->showFinancialHighlights($versi);
			
			$this->load->view('investor/investor',$data);
		}
	}
}