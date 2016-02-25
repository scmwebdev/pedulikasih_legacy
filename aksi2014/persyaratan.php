<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Persyaratan extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $data['HTMLPageTitle'] = "Persyaratan - Akademi Sahur Indonesia 2014";
    $this->load->view('aksi2014/header', $data);
    $this->load->view('aksi2014/persyaratan', $data);
    $this->load->view('aksi2014/footer', $data);
  }
}