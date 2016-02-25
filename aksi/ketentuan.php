<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ketentuan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{	
		redirect('aksi');
		
		$data['HTMLPageTitle'] = "Ketentuan - Akademi Sahur Indonesia";
		$this->load->view('aksi/header', $data);
		$this->load->view('aksi/ketentuan', $data);
		$this->load->view('aksi/footer', $data);
	}
}