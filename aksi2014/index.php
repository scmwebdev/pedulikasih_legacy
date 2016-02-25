<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $data['HTMLPageTitle'] = "Akademi Sahur Indonesia 2014";
    $this->load->view('aksi2014/header', $data);
    $this->load->view('aksi2014/index', $data);
    $this->load->view('aksi2014/footer', $data);
  }
}
