<?php
class Facebook_model extends CI_Model {
	private $_appID 	= '209188075876033';
  	private $_appSecret	= '6c1e25fc0b1d07061cabeae13c9da8bf';
		
	public function __construct()
	{
		parent::__construct();
		$config = array('appId' => $this->_appID, 'secret' => $this->_appSecret);
		$this->load->library('facebook', $config);
	}
	
	function getUserData() {
		$data = $fb_data = array();

		if ($this->facebook->getUser()) {
			try {
				$profile 			= $this->facebook->api('/me');
				$fb_data['source']  = 'fb';
				$fb_data['uid']		= $profile['id'];
				$fb_data['uname']	= $profile['username'];
				$fb_data['name']	= $profile['name'];
				$fb_data['email']	= $profile['email'];
			} catch (FacebookApiException $e) {
                error_log($e);
			}
		}

		if (count($fb_data) > 0) {
			$datax = $this->getUserDetail($fb_data['uid']);
			
			if (isset($datax['uid'])) {
    		    $sql = "/*facebook_model:Update OpenID*/
    					update 
    						openid_users 
    					set
    						uname='".mysql_real_escape_string($fb_data['uname'])."',
    						name='".mysql_real_escape_string($fb_data['name'])."',
    						".($fb_data['email'] == "" ? "" : "email='".$fb_data['email']."',")."
    						lastview=now()
    					where
    						source='fb' and uid=".$datax['uid'];
				$this->db->simple_query($sql);
			} else {
    		    $sql = "/*facebook_model:Insert OpenID*/
						insert into openid_users 
							(source,uid,uname,name,email,lastview)
						values 
							('".$fb_data['source']."','".$fb_data['uid']."','".$fb_data['uname']."','".mysql_real_escape_string($fb_data['name'])."','".$fb_data['email']."',now())";
                $this->db->simple_query($sql);
			}
			
			$data = $this->getUserDetail($fb_data['uid']);
		}
		
		return $data;
	}
	
	function getUserDetail($uid) {
		$sql = "/*facebook_model:getUserDetail*/
                select * from openid_users where source='fb' and uid='$uid'";
		$query = $this->db->query($sql);
		$data = $query->row_array();
		$query->free_result();
		
		return $data;
	}
	
	function getLoginURL($arr) {
        return $this->facebook->getLoginUrl($arr);
	}
	
	function getLogoutURL($arr) {
		return $this->facebook->getLogoutUrl($arr);
	}
	
	function sendFeed($msg, $link) {
		$user = $this->facebook->getUser();
		
		try {
            $this->facebook->api('/me/feed', 'POST', array('link' => $link, 'message' => $msg));
        } catch(FacebookApiException $e) {
            error_log($e->getType());
            error_log($e->getMessage());
        }
	}
	
	function sendFeedTo($uid, $msg, $link, $title, $desc, $image) {
        //message, picture, link, name, caption, description, source, place, tags
        try {
	        $this->facebook->api('/'.$uid.'/feed', 'POST', array(
	        		'link' => $link, 
	        		'message' => $msg, 
	        		'name' => $title, 
	        		'description' => $desc,
	        		'picture' => $image
	        ));
        } catch(FacebookApiException $e) {
            error_log($e->getType());
            error_log($e->getMessage());
        }
	}
	
	function getUserSocial($uid) {
		$data = $this->getUserDetail($uid);
		return (count($data) > 0) ? $data['social'] : '0';
	}
	
	function setUserSocial($uid,$act) {
		$sql = "/*GaulBOX:setUserSocial*/
                update openid_users set social=$act where source='fb' and uid='$uid'";
        $this->db->simple_query($sql);
			
		return $act;
	}
	
	function parseSignedRequest($signed_request) {
	    list($encoded_sig, $payload) = explode('.', $signed_request, 2);
	
	    $sig = $this->base64_url_decode($encoded_sig);
	    $data = json_decode($this->base64_url_decode($payload), true);
	
	    if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            error_log('Unknown algorithm. Expected HMAC-SHA256');
            return null;
	    }
	
	    // Check the signature
	    $expected_sig = hash_hmac('sha256', $payload, $this->_appSecret, $raw = true);
	    if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
	    }
	    return $data;
    }

    // Helper function for parsing signed request
    function base64_url_decode($input) {
    	return base64_decode(strtr($input, '-_', '+/'));
    }
}