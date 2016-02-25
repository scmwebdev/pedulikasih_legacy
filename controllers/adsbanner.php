<?php
class Adsbanner extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

  function _remap($method) {
		$this->load->view('adsbanner/adsbanner');
  }	
	function index()
	{
		$this->load->view('adsbanner/adsbanner');
	}
}
?>