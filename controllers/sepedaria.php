<?php
class Sepedaria extends CI_Controller {
	function index()
	{
		//$this->output->cache(60*6);
		$this->load->view('sepedaria');
	}
}