<?php
class Twitter_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('tweet');
		$this->tweet->enable_debug(TRUE);
	}
	
	function login($redirect) {
		if (!$this->tweet->logged_in()) {
			$this->tweet->set_callback($redirect);
			$this->tweet->login();
		} else {
			redirect($redirect);
		}
	}
	
	function logout($redirect) {
		$this->tweet->set_callback($redirect);
		$this->tweet->logout();
	}
	
	function getUserData() {
	    $data = $tw_data = array();
	    $data = $this->tweet->call('get', 'account/verify_credentials');
		if ( $data === NULL ) {
		} else {
			$tw_data = array(
				'source' 		=> 'tw',
				'email' 		=> '',
				'uid' 			=> $data->id,
				'uname' 		=> $data->screen_name,
				'name' 			=> $data->name
			);

			if ($tw_data['uid'] != "") {			    
    			$datax = $this->getUserDetail($tw_data['uid']);
    			
    			if (isset($datax['uid'])) {
        		    $sql = "/*twitter_model:Update OpenID*/
        					update 
        						openid_users 
        					set
        						uname='".mysql_real_escape_string($tw_data['uname'])."',
        						name='".mysql_real_escape_string($tw_data['name'])."',
        						".($tw_data['email'] == "" ? "" : "email='".$tw_data['email']."',")."
        						lastview=now()
        					where
        						source='tw' and uid=".$datax['uid'];
    				$this->db->simple_query($sql);
    			} else {
        		    $sql = "/*twitter_model:Insert OpenID*/
    						insert into openid_users 
    							(source,uid,uname,name,email,lastview)
    						values 
    							('".$tw_data['source']."','".$tw_data['uid']."','".$tw_data['uname']."','".mysql_real_escape_string($tw_data['name'])."','".$tw_data['email']."',now())";
                    $this->db->simple_query($sql);
    			}
    			
    			$data = $this->getUserDetail($tw_data['uid']);
            }
		}
		
        return $data;
	}
	
	function getUserDetail($uid) {
		$sql = "/*twitter_model:getUserDetail*/
                select * from openid_users where source='tw' and uid='$uid'";
		$query = $this->db->query($sql);
		$data = $query->row_array();
		$query->free_result();
		
		return $data;
	}
	
	function getToken() {
		return $this->tweet->get_tokens();
	}
	
	function sendFeed($msg, $link) {
		$this->tweet->call('get', 'account/verify_credentials');
		$this->tweet->call('post', 'statuses/update', array('status' => $msg));
	}
}