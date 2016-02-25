<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Lowongan_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getArticle() {
    		$sql = "select * from ivmweb2009_lowongan where publish=1 order by tanggal desc";
    		$query = $this->db->query($sql);
				$content="";
 				foreach ($query->result() as $row) {
					$content.='<div class="ContentJenisList RoundedBox8px">
					'.$row->konten.'
					</div>'; 					
 				}
 				$query->free_result();
				return $content;
    }
      
}