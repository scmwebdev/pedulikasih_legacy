<?php
class Updaterate extends CI_Controller {
	function _remap($method) {
  			$this->load->view('videofiesta/updaterate');
	}

	function index()
	{
		$this->load->view('videofiesta/updaterate');
	}
}