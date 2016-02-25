<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Article_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->DBWRITE = $this->load->database('dbwrite', true);
    }
    
    function getArticleJenis($jenis_url) {
		$sql = "select * from ivmweb2009_artikel_jenis where jenis_url='$jenis_url'";
		$query = $this->db->query($sql);
		return $query->row_array();
    }
    
    function getArticleContent($artikel_id) {
		if (is_numeric($artikel_id)) {
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

    function showBacaJuga($strID,$tags_sql,$limit=3) {
    		$sql = "select id,judul,judul_url,jenis_url from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and $strID and ($tags_sql) order by tgl_robot desc limit $limit";
    		return $this->db->query($sql);
    }
    
    function showMoreArticle($artikel_jenis_id,$strID,$limit=10) {
		if (!$tmpArticle = $this->ivmcache->get('artikeljenis'.$artikel_jenis_id)) {
			$sql = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=$artikel_jenis_id order by tgl_robot desc limit 50";
			$query = $this->db->query($sql);
			$tmpArticle = $query->result_array();
			$query->free_result();
			
			$this->ivmcache->add('artikeljenis'.$artikel_jenis_id, $tmpArticle);
		}
		
		$strID = str_replace(" and ", "", $strID);
		$strIDArr = explode("id<>", $strID);
		
		$dataArticle = array();
		$i = 1;
		foreach($tmpArticle as $artikel_id) {
			if (!in_array($artikel_id, $strIDArr)) {
				$dataArticle[] = $this->getArticleContent($artikel_id['id']);
				if ($i == $limit) break;
				$i++;
			}
		}
		
		return $dataArticle;
    }
 
 	function showHotArticle($strID="",$limit=5) {
		if (!$tmpArticle = $this->ivmcache->get('artikelhot')) {
			$sql = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() order by tgl_robot desc limit 20";
			$query = $this->db->query($sql);
			$tmpArticle = $query->result_array();
			$query->free_result();
			
			$this->ivmcache->add('artikelhot', $tmpArticle);
		}
		
		$strID = str_replace(" and ", "", $strID);
		$strIDArr = explode("id<>", $strID);
		
		$dataArticle = array();
		$i = 1;
		foreach($tmpArticle as $artikel_id) {
			if (!in_array($artikel_id, $strIDArr)) {
				$dataArticle[] = $this->getArticleContent($artikel_id['id']);
				if ($i == $limit) break;
				$i++;
			}
		}
		
		return $dataArticle;
    }
 				
    function showRandomTags($limit=20) {
		if (!$tmpArticle = $this->ivmcache->get('artikeltagrandom')) {
			$sql = "select tags,tags_url from ivmweb2009_artikel_tags group by tags order by rand() limit $limit";
			$query = $this->db->query($sql);
			$tmpArticle = $query->result_array();
			$query->free_result();
			
			$this->ivmcache->add('artikeltagrandom', $tmpArticle, 300);
		}
		
		return $tmpArticle;
    }
    
    function getPagingJenisNumRows($artikel_jenis_id) {
    	$sql = "select count(id) as num_rows from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=$artikel_jenis_id";
    	$query = $this->db->query($sql);
		return $query->row_array();
    }
    
    function showPagingJenis($artikel_jenis_id,$page,$batas) {
    	$sql = "select img_list,folder,id,judul,judul_url,subjudul,ringkasan from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id='$artikel_jenis_id' order by tgl_robot desc limit $page, $batas";
    	return $this->db->query($sql);
    }
    
    function getPagingTagNumRows($tags_url) {
    	$sql = "select count(a.id) as num_rows from ivmweb2009_artikel_data a inner join ivmweb2009_artikel_tags t on t.data_id=a.id where UNIX_TIMESTAMP(a.tgl_robot)<=UNIX_TIMESTAMP() and t.tags_url='$tags_url'";
    	$query = $this->db->query($sql);
			return $query->row_array();
    }
    
    function showPagingTag($tags_url,$page,$batas) {
    	$sql = "select a.id,a.judul,a.subjudul,a.judul_url,a.jenis_judul,a.jenis_url,a.ringkasan,a.img_list,a.folder from ivmweb2009_artikel_data a inner join ivmweb2009_artikel_tags t on t.data_id=a.id where UNIX_TIMESTAMP(a.tgl_robot)<=UNIX_TIMESTAMP() and t.tags_url='$tags_url' order by a.tgl_robot desc limit $page, $batas";
    	return $this->db->query($sql);
    }
    
    function getAllArticleJenis() {
        $sql = "select * from ivmweb2009_artikel_jenis";
        return $this->db->query($sql);
    }
    
    function getAllArticleJenisTag($artikel_jenis_id) {
        $sql = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=$artikel_jenis_id group by tags order by rand() limit 50";
        return $this->db->query($sql);
    }
    
    function getPagingCommentNumRows($artikel_id) {
        $sql = "select count(id) as num_rows from ivmweb_artikel_komentar where id_artikel=$artikel_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    function showPagingComment($artikel_id,$page,$batas) {
    	$sql = "select * from ivmweb_artikel_komentar where id_artikel=$artikel_id order by id desc limit $page, $batas";
    	return $this->db->query($sql);
    }
    
    function getArtikelSearchNumRows($keyword) {
    	//$sql = "select count(id) as num_rows from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (judul like '%$keyword%' or ringkasan like '%$keyword%')";
    	//$query = $this->db->query($sql);
			//return $query->row_array();
    }
    
    function showArtikelSearch($keyword,$page,$batas,$phrase="") {
    	//$sql = "select img_list,folder,id,subjudul,judul,judul_url,ringkasan,jenis_judul,jenis_url from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (judul like '%$keyword%' or ringkasan like '%$keyword%') order by tgl_robot desc limit $page, $batas";
    	//$sql = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (judul like '%$keyword%' or ringkasan like '%$keyword%') order by tgl_robot desc limit $page, $batas";
    	//return $this->db->query($sql);
    	
    	//include("sphinxapi.php");
			$s = new SphinxClient;
			//$s->setServer("127.0.0.1", 9312);
			$s->setServer("192.168.7.97", 9312);
			if ($phrase=="pk_kp") {				
				$s->setMatchMode(SPH_MATCH_PHRASE);
				$s->SetFilter ( "jenis_id", array (5) );
			}else {
				$s->setMatchMode(SPH_MATCH_ALL);
			}
			$s->setMaxQueryTime(3);
			$s->SetSortMode(SPH_SORT_ATTR_DESC, 'tgl_robot');
			$s->SetLimits(intval($page), intval($batas), 1000);
			
			$result = $s->query($keyword, 'indosiarrt');
			
			if (!empty($result["matches"]))
				return $result;
			else
				return 0;
    }
    
    function showArtikelJenis($page,$batas,$jenis) {
    	$sql = "select img_list,folder,id,subjudul,judul,judul_url,ringkasan,jenis_judul,jenis_url from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (judul like '%$keyword%' or ringkasan like '%$keyword%') order by tgl_robot desc limit $page, $batas";
    	$sql = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (judul like '%$keyword%' or ringkasan like '%$keyword%') order by tgl_robot desc limit $page, $batas";
    	return $this->db->query($sql);
    	
    	/*
    	//include("sphinxapi.php");
    	$keyword="a";
			$s = new SphinxClient;
			//$s->setServer("127.0.0.1", 9312);
			$s->setServer("192.168.7.97", 9312);
			$s->SetFilter ( "jenis_id", array ($jenis) );
			$s->setMatchMode(SPH_MATCH_ALL);
			$s->setMaxQueryTime(3);
			$s->SetSortMode(SPH_SORT_ATTR_DESC, 'tgl_robot');
			$s->SetLimits(intval($page), intval($batas), 1000);
			
			$result = $s->query($keyword, 'indosiarrt');
			
			if (!empty($result["matches"]))
				return $result;
			else
				return 0;
			*/
    }    
}