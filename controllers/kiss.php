<?php

class Kiss extends Controller {

	function Kiss()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->library('pagination');
		$this->load->view('videofiesta/index_kiss');
	}
}
?>