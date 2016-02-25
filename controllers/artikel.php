<?php
class Artikel extends CI_Controller {
	function index()
	{
		$this->load->library('pagination');
		$this->load->view('videofiesta/artikel');
	}
}
?>