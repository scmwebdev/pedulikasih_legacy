<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		$this->load->model('auths');
		$this->load->model('modules');
		
		$viewVars = array();
		$id = ( isset($_REQUEST['id']) ? trim($_REQUEST['id']) : 0 );
		$auths = ( isset($_POST['auths']) ? trim($_POST['auths']) : '' );
		
		switch ( isset($_REQUEST['act']) ? strtolower(trim($_REQUEST['act'])) : '' )
		{
			case 'combo':
				$disp = ( isset($_REQUEST['disp']) ? trim($_REQUEST['disp']) : '' );
				print json_encode($this->auths->getComboBoxGroup($disp));
			break;
			case 'save':
					if (!empty($auths))
					{
						if(!empty($id))
						{
							if ($this->auths->editGroup()) {
								$this->auths->deleteMarkAuth(trim($_POST['uniqid']));
								if (!empty($_POST['auths'])) $this->auths->addAuth($id, false);
								print '{success:true}';
							} else {
								print '{success:false, msg:"Proses menyimpan data gagal"}';
							}
						} else {
							if ($this->auths->addGroup()) {
								if (!empty($_POST['auths'])) $this->auths->addAuth($this->auths->lastId(), false);
								print '{success:true}';
							} else {
								print '{success:false, msg:"Proses menyimpan data gagal"}';
							}
						}
						
					} else {
						print '{success:false, msg:"Silahkan pilih salah satu atau lebih dari daftar otorisasi dari modul yang tersedia"}';
					}
			break;
			case 'edit':
				$viewVars['editData'] = $this->auths->getEditGroup($id);
			default:
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('cms/groups', $viewVars);	
		}		
			
	}
	
}