<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ketentuan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		redirect();exit;

		$data['HTMLPageTitle'] = "Ketentuan - Akademi Fantasi Indosiar";
		$this->load->view('afi2013/header', $data);
		$this->load->view('afi2013/ketentuan', $data);
		$this->load->view('afi2013/footer', $data);
	}
}