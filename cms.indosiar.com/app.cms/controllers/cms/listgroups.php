<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listgroups extends CI_Controller {

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		$this->load->model('auths');
		$this->load->model('modules');
		
		$viewVars = array();
		$start = ( isset($_REQUEST['start']) ? trim($_REQUEST['start']) : 0 );
		$limit = ( isset($_REQUEST['limit']) ? trim($_REQUEST['limit']) : 30 );		
		$sort = ( isset($_REQUEST['sort']) ? hsort($_REQUEST['sort']) : array() );
		$filter = ( isset($_REQUEST['filter']) ? hfilters($_REQUEST['filter']) : array() );
		
		switch ( isset($_REQUEST['act']) ? strtolower(trim($_REQUEST['act'])) : '' )
		{
			case 'data':
				if (isset($_REQUEST['del'])) $this->auths->deleteGroup($_REQUEST['del']);
				$viewVars['datatable'] = $this->auths->dataGroups($start, $limit, $sort, $filter);
				$viewVars['total'] = $this->auths->ttlRows;
				print json_encode($viewVars);
			break;
			default:
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule); 
				if (isset($viewVars['modAuths']['edit'])) {
					$viewVars['idmodule'] = $this->modules->getIdFromKeyName('add_groups');
				}
				$this->load->view('cms/listgroups', $viewVars);	
		}		
			
	}
	
}