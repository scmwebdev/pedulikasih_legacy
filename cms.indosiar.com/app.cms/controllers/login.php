<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
		
		//$this->load->library('encrypt');
		$this->load->library('bcrypt');
		$this->load->model('auths');
		
		$token = ( isset($_POST['token']) ? $_POST['token'] : '' );
		if (!empty($token) && $token==$this->session->get_uniqid())
		{
			$login = $this->auths->login();
			if(!empty($login))
			{
				//$pass = $this->encrypt->decode(trim($login['pass']), $this->config->item('encryption_key'));
				$pass = $login['pass'];
				//$sha1 = sha1(trim($_POST['pass']));				
				$sha1 = $this->bcrypt->verify(trim($_POST['pass']), $pass);
				
				//if ($sha1==$pass)
				if ($sha1)
				{					
					
					$sess = array(
						'islogin' => 1,
						'id' => $login['id'],
						'name' => $login['name'],
						'grp' => $login['grp'],
						'email' => $login['email'],
						'themes' => $login['themes']
					);
					
					$this->session->set_userdata($sess);
					//print_r($this->session->all_userdata());
					//die;
					 
					print '{success:true}';
				} else {
					print '{success:false, msg:"Login failed, wrong password"}';
				}
				
			} else {
				print '{success:false, msg:"Login failed, wrong username"}';
			}
		} else {
			print '{success:true}';
		}
	}
	
}