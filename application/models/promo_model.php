<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Promo_model extends CI_Model {		
    function __construct()
    {
        parent::__construct();
    }

    function getPromo($slug) {
		    $sql = "select * from ivmweb_promo where promo_slug='$slug'";
				$query = $this->db->query($sql);
				$data = $query->row_array();
				$query->free_result();
				
				return $data;
    }
           
    function listPromo() {
		    $sql = "select promo_id,promo_judul,promo_slug,promo_ringkasan,promo_image from ivmweb_promo where promo_publish=1 order by promo_id desc limit 10";
				$query = $this->db->query($sql);
				$data = $query->result_array();
				$query->free_result();
				
				return $data;
    }
}