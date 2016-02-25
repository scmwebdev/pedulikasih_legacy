<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Daua_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
        //$this->obj =& get_instance();
        $this->DB = $this->load->database('default', true);
    }    
    
    function totalrecord($sql)    
    {
    	$result =  $this->DB->query($sql);
    	return $result->num_rows();
    }    

    function looprecord($sql)    
    {
    	return $this->DB->query($sql);	
    }
}
