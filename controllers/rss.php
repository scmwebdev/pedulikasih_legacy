<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rss extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rss_model');
	}
	
	public function index()
	{
		$this->load->view('rss');
	}
}