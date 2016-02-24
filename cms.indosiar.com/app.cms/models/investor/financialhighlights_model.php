<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Financialhighlights_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function submitData() {
        $data = array('isi' => $this->input->post('isi'));
		$this->db->where('jenis', 'investor_fhl');
		$this->db->update('investor_global', $data);
    }
		
    function json() {
        $sql = "select * from investor_global where jenis='investor_fhl'";
        $query = $this->db->query($sql);
        $data = $query->row_array();
        $query->free_result();
        
        return json_encode($data);
    }
}