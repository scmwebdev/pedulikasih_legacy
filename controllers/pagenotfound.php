<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pagenotfound extends CI_Controller {	
	function index()
	{
		$this->load->view('pagenotfound');
	}
}