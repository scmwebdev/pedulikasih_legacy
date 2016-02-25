<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		redirect();
	}

	function index()
	{
		$data['HTMLPageTitle'] = "Akademi Sahur Indonesia";
		$this->load->view('aksi/header', $data);
		$this->load->view('aksi/peserta', $data);
		$this->load->view('aksi/footer', $data);
	}
}