<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		//$this->load->library('encrypt');
		$this->load->library('bcrypt');
		$this->load->library('form_validation');
		$this->load->model('auths');
		$this->load->model('modules');
		
		$viewVars = array();
		$id = ( isset($_REQUEST['id']) ? trim($_REQUEST['id']) : 0 );
		$auths = ( isset($_POST['auths']) ? trim($_POST['auths']) : '' );
		
		switch ( isset($_REQUEST['act']) ? strtolower(trim($_REQUEST['act'])) : '' )
		{
			case 'save':
						
						$exp = explode(' ', trim($_POST['uid']));
						if (@count($exp)==1) {
						
							
							if (!empty($_POST['pass']) || !empty($_POST['repass']))
							{
								if (trim($_POST['pass'])!==trim($_POST['repass']))
								{
									print '{success:false, msg:"Silakan menulis kembali teks re password harus sama dengan teks password"}';
									break;
								}
								
								$exp = explode(' ', trim($_POST['pass']));
								if (@count($exp)>1) {
									print '{success:false, msg:"Password harus tidak terdiri dari karakter spasi"}';
									break;
								}
								
								//$_POST['pass'] = $this->encrypt->encode(trim($_POST['pass']), $this->config->item('encryption_key'));
								$_POST['pass'] = $this->bcrypt->hash(trim($_POST['pass']));
							}
							
							if (!empty($_POST['email']))
							{
								if ($this->form_validation->valid_email(trim($_POST['email']))==false)
								{
									print '{success:false, msg:"Silahkan tulis alamat email dengan benar"}';
									break;
								}
							}
							
							if ($this->auths->checkUser($id)>0)
							{
								print '{success:false, msg:"Username telah di gunakan oleh orang lain"}';
								break;
							}
							
							
							if(!empty($id))
							{
								if ($this->auths->editUser())
								{
									$this->auths->deleteMarkAuth(trim($_POST['uniqid']));
									if (!empty($_POST['auths'])) $this->auths->addAuth($id, true);
									print '{success:true}';
								} else {
									print '{success:false, msg:"Proses menyimpan data gagal"}';
								}
							} else {
								if ($this->auths->addUser())
								{
									if (!empty($_POST['auths'])) $this->auths->addAuth($this->auths->lastId(), true);
									print '{success:true}';
								} else {
									print '{success:false, msg:"Proses menyimpan data gagal"}';
								}
							}
						
						} else {
							print '{success:false, msg:"Username harus tidak terdiri dari karakter spasi"}';
						}
						
			break;
			case 'edit':
				$viewVars['editData'] = $this->auths->getEditUser($id);
			default:
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('cms/users', $viewVars);	
		}
		
	}
	
}