<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nodes extends CI_Controller {

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		$this->load->model('modules');
		$this->load->model('auths');
		$this->load->helper('nodes');
		
		$viewVars = array();
		$node = (isset($_REQUEST['node'])?trim($_REQUEST['node']):0);
		$arrnode = explode('-', $node);
				
		switch ( isset($_REQUEST['act']) ? strtolower(trim($_REQUEST['act'])) : '' )
		{
			case 'auth':			
				$id = ( isset($_REQUEST['id']) ? trim($_REQUEST['id']) : 0 );
				$isuser = ( isset($_REQUEST['usr']) ? trim($_REQUEST['usr']) : 0 );
				
				$modules = $this->modules->nodesAuth($arrnode[0]);
				$auths = array();
				if(!empty($id))
				{
					$listmod = '';
					foreach($modules as $k=>$v)
					{
						if (!empty($listmod)) $listmod .= ',';
						$listmod .= $v['id'];
					}
					$auths = $this->auths->getEditAuth($id, $listmod, $isuser) ;
				}
				print '['.setNodeAuth($modules, $auths).']';
			break;
			case 'delmark':
				$this->auths->marktodelAuth();
			break;
			default:
		}		
			
	}
	
}