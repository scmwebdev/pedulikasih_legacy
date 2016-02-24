<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session {
	
	var $islogin = false;
	var $idmodule = 0;
	var $foldering = '';
    
	public function __construct()
    {
        parent::__construct();
		
		$this->foldering = ( isset($_REQUEST['d']) ? trim($_REQUEST['d']).'/' : '' );
		$this->foldering = str_replace($this->CI->config->item('directory_separator'), '/', $this->foldering);
		$this->idmodule = ( isset($_REQUEST['mods']) ? trim($_REQUEST['mods']) : 0 );
		$this->islogin = $this->userdata('islogin');
		$this->islogin = ($this->islogin==1 ? true : false);
		if ($this->islogin==true) $this->get_uniqid();
		
    }
	
	public function set_uniqid()
	{
		$uniqid = MD5(uniqid('uniqid', true));
		$this->set_userdata('uniqid', $uniqid);
		return $uniqid;
	}
	
	public function get_uniqid()
	{
		if (!$this->islogin)
		{
			$uniqid = $this->userdata('uniqid');
			return $uniqid;
		} else {
			$this->unset_userdata('uniqid');
			return '';
		}
	}
	
	
}