<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Demovideo extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{	
		$this->load->view('takemeout/demo_video');
	}
}