<?php
class Shoutbox extends CI_Controller {
	function index()
	{
		$this->load->view('shoutbox');
	}
	
	function submit()
	{
		$this->load->view('shoutbox_submit');
	}
	
	function generate()
	{
		$this->load->view('shoutbox_generate');
	}
}