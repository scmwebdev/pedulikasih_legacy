<?php
class Videofiesta extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('videofiesta_model');
	}

  function _remap($method) {
  	$method = strtolower($method);
  	if ($method == "" || $method == "index")
  		$this->load->view('videofiesta/master');
		elseif ($method == "kiss")
			$this->load->view('videofiesta/index_kiss');
		elseif ($method == "artikel")
			$this->load->view('videofiesta/artikel');
  	else
  		$this->load->view('videofiesta/master');
  }	

	function index()
	{
		$this->load->view('videofiesta/master');
	}



}
?>