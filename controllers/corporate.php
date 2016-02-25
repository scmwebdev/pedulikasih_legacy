<?php
class Corporate extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('corporate_model');
	}
	
	function _remap($method) {
		$this->index();
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
		
		$data["versi"] 			= $versi;
		$data["menu"] 			= $this->corporate_model->showMenu($versi);
		
		if (($versi == "bahasa" && $this->uri->segment(2) == "annualreport") || ($versi == "english" && trim($this->uri->segment(3)) == "annualreport")) {
			$data["annualreport"]= $this->corporate_model->getAnnualReport();
			$this->load->view('corporate/annualreport', $data);
		} elseif (($versi == "bahasa" && trim($this->uri->segment(2)) != "") || ($versi == "english" && trim($this->uri->segment(3)) != "")) {
			$data["isi"]        = $this->corporate_model->getData($versi, $judul_url);
			$this->load->view('corporate/detail', $data);
		} else {
			$data['slideshow']  = $this->corporate_model->getSlideshow();
			
			$this->load->view('corporate/index',$data);
		}
	}
}