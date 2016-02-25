<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Rss_model extends CI_Model {
    function getArticleContentRSS($artikel_id) {
    	if (is_numeric($artikel_id)) {
    	    $dataArticle = $this->ivmcache->get('artikel'.$artikel_id);

    		if (!$dataArticle = $this->ivmcache->get('artikel'.$artikel_id)) {
    		    $sql = "select * from ivmweb2009_artikel_data where id=$artikel_id";
    			$query = $this->db->query($sql);
    			$dataArticle = $query->row_array();
    			$query->free_result();
    			
    			$this->ivmcache->add('artikel'.$artikel_id, $dataArticle);
    		}

    		return $dataArticle;
    	}
    }
    
    function showRSS($limit=20) {
		if (!$tmpArticle = $this->ivmcache->get('artikelhot')) {
			$sql = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() order by tgl_robot desc limit 20";
			$query = $this->db->query($sql);
			$tmpArticle = $query->result_array();
			$query->free_result();
			
			$this->ivmcache->add('artikelhot', $tmpArticle);
		}
        
		$dataArticle = array();
		$i = 1;
		foreach($tmpArticle as $artikel_id) {
			$dataArticle[] = $this->getArticleContentRSS($artikel_id['id']);
			if ($i == $limit) break;
			$i++;
		}
		
		return $dataArticle;
    }
}