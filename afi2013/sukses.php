<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sukses extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		redirect();exit;

		$data['HTMLPageTitle'] = "Registrasi Berhasil - Akademi Fantasi Indosiar";
		$this->load->view('afi2013/header', $data);
		$this->load->view('afi2013/sukses', $data);
		$this->load->view('afi2013/footer', $data);
	}
}