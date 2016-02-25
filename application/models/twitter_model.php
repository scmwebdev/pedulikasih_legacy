<?php
class Twitter_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('twitter');
	}
	
	function login($redirect) {
		if ($this->twitter->is_logged_in())
			redirect($redirect);
		else
			$this->twitter->login($redirect);
	}
	
	function logout($redirect) {
		$this->twitter->logout();
        redirect($redirect);
	}
	
	function getUserData() {
	    $data = $tw_data = array();
	    $data = $this->twitter->call('get', 'account/verify_credentials');
		if ( $data === NULL ) {
		} else {
			$tw_data = array(
				'source' 		=> 'tw',
				'email' 		=> '',
				'uid' 			=> $data['id'],
				'uname' 		=> $data['screen_name'],
				'name' 			=> $data['name']
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
		return $this->twitter->_get_access_token();
	}
	
	function sendFeed($msg, $link) {
		$this->twitter->call('get', 'account/verify_credentials');
		$this->twitter->call('post', 'statuses/update', array('status' => $msg));
	}
}