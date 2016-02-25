<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sukses extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{	
		redirect('aksi');
		
		$data['HTMLPageTitle'] = "Registrasi Berhasil - Akademi Sahur Indonesia";
		$this->load->view('aksi/header', $data);
		$this->load->view('aksi/sukses', $data);
		$this->load->view('aksi/footer', $data);
	}
}