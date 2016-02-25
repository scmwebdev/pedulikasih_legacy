<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		redirect();
	}

	function index()
	{
		$data['HTMLPageTitle'] = "Puteri Muslimah 2014";
		$data['assetsURL'] = base_url().'assets/puteri-muslimah2014/';

		$this->load->view('puterimuslimah2014/header', $data);
		$this->load->view('puterimuslimah2014/index', $data);
		$this->load->view('puterimuslimah2014/footer', $data);
	}
}