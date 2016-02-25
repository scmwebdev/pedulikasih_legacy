<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sitemapxml extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sitemapxml_model');
	}
	
	public function index()
	{
		$data['jenis_url'] = str_replace(array('.xml','sitemap-'), '', $this->uri->segment(1));
		$this->load->view('sitemapxml', $data);
	}
}