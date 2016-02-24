<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		//$this->load->library('encrypt');
		$this->load->library('bcrypt');
		$this->load->library('form_validation');
		$this->load->model('auths');
		
		$viewVars = array();
		
		switch ( isset($_REQUEST['act']) ? strtolower(trim($_REQUEST['act'])) : '' )
		{
			case 'save':
				
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
				
				if ($this->auths->editProfile())
				{
					$this->session->set_userdata('name', trim($_POST['name']));
					$this->session->set_userdata('email', trim($_POST['email']));
					print '{success:true}';
				} else {
					print '{success:false, msg:"Proses menyimpan data gagal"}';
				}
				
				
			break;
			default:
				$this->load->view('cms/profile', $viewVars);	
		}
		
	}
	
}