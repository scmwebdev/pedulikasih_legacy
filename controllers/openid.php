<?php
class Openid extends CI_Controller {
	function __construct()
	{
        parent::__construct();
	}
	
	function index()
	{
		echo "OK";
	}
	
	function facebook($action)
	{
		$this->load->model('facebook_model');

		if ($action == "login") {
			$ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';
			$redirect = site_url('openid/facebook/redirect/in/'.$this->_txtenc($ref));
			//$loginURL = $this->facebook_model->getLoginURL(array('scope' => 'email,user_birthday,publish_stream', 'redirect_uri' => $redirect));
			$loginURL = $this->facebook_model->getLoginURL(array('redirect_uri' => $redirect));
			redirect($loginURL);
			//echo '<script type="text/javascript">window.location="'.$loginURL.'"</script>';
		}

		if ($action == "check") {
			if (isset($_POST['uid'])) {
				$sess = ($this->session->userdata('openid')) ? $this->session->userdata('openid') : array('uid'=>'');
				
				if (isset($sess['source']) && $sess['source'] == 'tw') die('no');
				
				if ($_POST['uid'] == $sess['uid']) {
					die(json_encode($sess));
				} else {
					if ($sess['uid'] != '') {
					    $this->session->unset_userdata('openid');
						die('no');
					}
					
					$fb_data = $this->facebook_model->getUserData();
					if (count($fb_data) > 0) {
						$this->session->set_userdata('openid', $fb_data);
						die(json_encode($fb_data));
					} else {
						die('ok');
					}
				}
			} else {
				die('no');
			}
		}
		
		if ($action == "socialcheck") {
			if (isset($_POST['uid'])) 
                echo $this->facebook_model->getUserSocial($_POST['uid']);
			else
				echo "0";
		}
		
		if ($action == "socialset") {
			if (isset($_POST['uid']) && isset($_POST['act'])) {
				if ($this->session->userdata('openid')) {
					$sess = $this->session->userdata('openid');
					$sess['social'] = $_POST['act'];
					$this->session->set_userdata('openid', $sess);
				}
				echo $this->facebook_model->setUserSocial($_POST['uid'],$_POST['act']);
			} else
				echo "0";
		}
		
		if ($action == "logout") {
			$ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';						
			$redirect = site_url('openid/facebook/redirect/out/'.$this->_txtenc($ref));
			$logoutURL = $this->facebook_model->getLogoutURL(array('next' => $redirect));
			redirect($logoutURL);
			//echo '<script type="text/javascript">window.location="'.$logoutURL.'"</script>';
		}
		
		if ($action == "redirect") {
			if ($this->uri->segment(4) == "in") {				
				$fb_data = $this->facebook_model->getUserData();
				if ($fb_data['id'] != "") {
				    if ($this->session->userdata('twitter_oauth_tokens')) $this->session->unset_userdata('twitter_oauth_tokens');
				    $this->session->set_userdata('openid', $fb_data);
                }   
			} else {
				$this->facebook->destroySession();
				$this->session->unset_userdata('openid');
			}
			
			$ref = $this->_txtdec($this->uri->segment(5));
			redirect($ref);
		}
		
		if ($action == "invite") {
			if (isset($_POST['uid']) && isset($_POST['request_ids'])) {
				$arr 	= explode(",", $_POST['request_ids']);
				$msg	= 'Watch exciting videos only at www.gaulbox.com';
				foreach($arr as $ids) {
					$ids = explode("_", $ids);
					$this->facebook_model->sendFeedTo($ids[1], $msg, $_POST['url'], $_POST['title'], $_POST['desc'], $_POST['image']);
				}
			}
		}
		
		if ($action == "read" || $action == "watch") {
            $success_result = 'false';
            
            if (isset($_REQUEST['signed_request'])) {
                $parsed_data = $this->facebook_model->parseSignedRequest($_REQUEST['signed_request']);
                if ($parsed_data != null) {
                    // Get the access token
                    $access_token = $parsed_data['oauth_token'];
                    // Get the object URL
                    $article = $parsed_data['objects'][0]['url'];
                    
                    // The Graph API endpoint for publishing a save action
                    $graph_url_publish = "https://graph.facebook.com/me/indosiardotcom:save?access_token=" . $access_token;
                    $postdata = http_build_query(
                        array(
                            'article' => $article
                        )
                    );
                    $opts = array('http' =>
                        array(
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/x-www-form-urlencoded',
                            'content' => $postdata
                        )
                    );
                    $context  = stream_context_create($opts);
                    // Publish the save action
                    $result = json_decode(file_get_contents($graph_url_publish, false, $context));
                    if (($result != null) && isset($result->id)) {
                        // Set the result flag to true
                        $success_result = 'true';
                    }
                }
            }
            
            // Print the output
            $success = array(
                'success' => $success_result
            );
            $output = json_encode($success);
            echo $output;
		}
	}
	
	function twitter($action)
	{
		$this->load->model('twitter_model');

		if ($action == "login") {
			$ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';
			if ($this->session->userdata('twitter_oauth_tokens')) $this->session->unset_userdata('twitter_oauth_tokens');
			$redirect = site_url('openid/twitter/redirect/in/'.$this->_txtenc($ref));
			$this->twitter_model->login($redirect);
		}

		if ($action == "logout") {
			$ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';					
			$redirect = site_url('openid/twitter/redirect/out/'.$this->_txtenc($ref));
			$this->twitter_model->logout($redirect);
		}				
		
		if ($action == "redirect") {
			if ($this->uri->segment(4) == "in") {
				$data = $this->twitter_model->getUserData();
				if (isset($data['uid'])) $this->session->set_userdata('openid', $data);
							
			} else {
				
				$this->session->unset_userdata('openid');
			}
			
			$ref = $this->_txtdec($this->uri->segment(5));
			redirect($ref);
		}
	}
	
	function _txtenc($str) {
	    return strtr(base64_encode($str), array('+' => '.', '=' => '-', '/' => '~'));
	}
	
	function _txtdec($str) {
	    return base64_decode(strtr($str, array('.' => '+', '-' => '=', '~' => '/')));
	}
}
?>