<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pilkada_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->DBTOOLS = $this->load->database('dbtools', true);
    }
    
    function getData() {
    		$sql = "select * from lsi_pilkada order by id limit 6";
    		$query = $this->DBTOOLS->query($sql);
				return $query->result_array();
    }
}