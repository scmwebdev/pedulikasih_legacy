<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lnodes extends CI_Controller {

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		$this->load->model('modules');
		$this->load->helper('menu');		
		
		$node = (isset($_REQUEST['node'])?trim($_REQUEST['node']):0);
		print '['.setLeftMenuNodes($this->modules->leftMenuNodes($node, 'LEFT_TREE_PANEL', '')).']';
	}
	
}