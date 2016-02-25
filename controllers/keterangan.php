<?php
class Keterangan extends CI_Controller {	
	function _remap($method) {
  			$this->load->view('videofiesta/keterangan');
	}


	function index()
	{
		$this->load->view('videofiesta/keterangan');
	}
}
?>