<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		$this->load->model('modules');
		$this->load->helper('menu');
		$viewVars = array();
		
		$viewVars['menutoolbar'] = $this->modules->menuToolbars();
		$viewVars['key_name'] = 'menu_kiri_otorisasi';
		$viewVars['modtype'] = 'LEFT_TREE_PANEL';
		$viewVars['leftmenu'] = $this->modules->menuToolbars($this->modules->getIdFromKeyName($viewVars['key_name']), $viewVars['modtype']);
		$this->load->view('home', $viewVars);
	}
}