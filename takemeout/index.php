<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('takemeout_model');
		//redirect();
	}
	
	function index()
	{	
		$data['HTMLPageTitle'] = "Take Me Out";
		$this->load->view('takemeout/takemeout_header', $data);
		$this->load->view('takemeout/takemeout_index', $data);
		$this->load->view('takemeout/takemeout_footer', $data);
	}
}