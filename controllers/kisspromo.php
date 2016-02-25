<?php

class Kisspromo extends Controller {

	function Kisspromo()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->library('pagination');
		$this->load->view('videofiesta/index_kiss_promo');
	}
}
?>