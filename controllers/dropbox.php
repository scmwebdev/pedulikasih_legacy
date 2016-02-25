<?php

class Dropbox extends Controller {

	function Dropbox()
	{
		parent::Controller();	
	}

 
	function index()
	{
		$this->load->view('dropbox_index');
	}

	function toa()
	{
		$this->load->view('toa');
	}

	function toasubmit()
	{
		$this->load->view('dropboxform');
	}

	function submit()
	{
		$this->load->view('dropbox_submit');
	}

	function photo()
	{
		$this->load->library('pagination');
		$this->load->view('dropbox_photo');
	}
	
	function pengumuman()
	{
		$this->load->view('dropbox_pengumuman');
	}
}
?>