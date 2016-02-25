<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Homepage_model extends CI_Model {
    var $CacheRobot = "";
    
    function __construct() {
        parent::__construct();
        if (!$this->ivmcache->get('artikelrobot')) 
            $this->CacheRobot = $this->getCacheRobot();
        else
            $this->CacheRobot = $this->ivmcache->get('artikelrobot');
    }
    
    function getCacheRobot() {
        $sql = "select id,jenis_id,kategori_id,tgl_tayang,tgl_robot,img_index,img_list from ivmweb2009_artikel_data order by tgl_robot desc limit 100";
        $query = $this->db->query($sql);
        $tmpArr = $query->result_array();
        $query->free_result();
        
        if ($this->ivmcache->get('artikelrobot'))
          $this->ivmcache->replace('artikelrobot', $tmpArr);
        else
          $this->ivmcache->add('artikelrobot', $tmpArr);
        
        return $tmpArr;
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
    
    function showWhatsOnTheWeek($kategori_id,$strID,$limit=4,$tgl_tayang=true,$image='img_index') {       
        $strIDArr = str_replace(" and ", "", $strID);
        $strIDArr = explode("id<>", $strIDArr);
        $dataArticle = array();
        $now = time();
        $next = mktime(0, 0, 0, date("m"), date("d")+2, date("y"));
        $i = 0;
        $CacheRobot = ($tgl_tayang) ? array_reverse($this->CacheRobot, true) : $this->CacheRobot;
        foreach($CacheRobot as $arrRobot) {
          if (isset($arrRobot[$image]) && isset($arrRobot['kategori_id']) && isset($arrRobot['id']) && !in_array($arrRobot['id'], $strIDArr) && $arrRobot['kategori_id'] == $kategori_id && $arrRobot[$image] != "") {
            if ($tgl_tayang) {
              if ($arrRobot['tgl_tayang'] != '0000-00-00 00:00:00' && strtotime($arrRobot['tgl_robot']) >= $now && strtotime($arrRobot['tgl_robot']) <= $next) {
                $dataArticle[] = $this->getArticleContent($arrRobot['id']);
                $i++;
              }
            } else {
              if (strtotime($arrRobot['tgl_robot']) <= $now) {
                $dataArticle[] = $this->getArticleContent($arrRobot['id']);
                $i++;
              }
            }
          }
          if ($i == $limit) break;
        }
        
        if (count($dataArticle) == $limit)
          return $dataArticle;
        else {
          $sql = "select $image,id,subjudul,judul,judul_url,ringkasan,jenis_judul,jenis_url,tanggal,folder,tags,tgl_tayang from ivmweb2009_artikel_data where ".(($tgl_tayang) ? "tgl_tayang<>'0000-00-00 00:00:00' and " : "")."UNIX_TIMESTAMP(tgl_robot)".(($tgl_tayang) ? ">=" : "<=")."UNIX_TIMESTAMP() and $image<>'' and kategori_id=$kategori_id $strID order by tgl_robot".(($tgl_tayang) ? " " : " desc ")."limit $limit";
          $sql = str_replace('and id<> ','',$sql);
          $query = $this->db->query($sql);
          $dataArticle = $query->result_array();
          $query->free_result();
                
          return $dataArticle;
        }
    }

    function showSinopsis($strID, $limit=3) {
        $strIDArr = str_replace(" and ", "", $strID);
        $strIDArr = explode("id<>", $strIDArr);
        
        $dataArticle = array();
        $now = time();
        $i = 0;
        $CacheRobot = array_reverse($this->CacheRobot, true);
        foreach($CacheRobot as $arrRobot) {
          if (isset($arrRobot['tgl_robot']) && isset($arrRobot['tgl_tayang']) && isset($arrRobot['img_list']) && isset($arrRobot['jenis_id']) && isset($arrRobot['id']) && !in_array($arrRobot['id'], $strIDArr) && $arrRobot['jenis_id'] == "1" && $arrRobot['img_list'] != "" && $arrRobot['tgl_tayang'] != '0000-00-00 00:00:00' && strtotime($arrRobot['tgl_robot']) >= $now) {
              $dataArticle[] = $this->getArticleContent($arrRobot['id']);
              $i++;
          }
          if ($i == $limit) break;
        }
        
        if (count($dataArticle) == $limit)
          return $dataArticle;
        else {
          $sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where tgl_tayang<>'0000-00-00 00:00:00' and UNIX_TIMESTAMP(tgl_robot)>=UNIX_TIMESTAMP() and img_list<>'' and jenis_id=1 $strID order by tgl_robot limit $limit";
          $sql = str_replace('and id<> ','',$sql);
          $query = $this->db->query($sql);
          $dataArticle = $query->result_array();
          $query->free_result();
                
          return $dataArticle;
        }
    }

    function showArticleKategori($kategori_id,$strID,$limit=5) {        
        $strIDArr = str_replace(" and ", "", $strID);
        $strIDArr = explode("id<>", $strIDArr);
        
        $dataArticle = array();
        $now = time();
        $i = 0;
        foreach($this->CacheRobot as $arrRobot) {
          if (isset($arrRobot['tgl_robot']) && isset($arrRobot['kategori_id']) && isset($arrRobot['id']) && !in_array($arrRobot['id'], $strIDArr) && $arrRobot['kategori_id'] == $kategori_id && strtotime($arrRobot['tgl_robot']) <= $now) {
              $dataArticle[] = $this->getArticleContent($arrRobot['id']);
              //$strID .= " and id<>".$arrRobot['id'];
              $i++;
          }
          if ($i == $limit) break;
        }
        
        if (count($dataArticle) == $limit)
          return $dataArticle;
        else {      
          $sql = "select id,subjudul,jenis_id,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and kategori_id=$kategori_id $strID order by tgl_robot desc limit $limit";
          $sql = str_replace('and id<> ','',$sql);
          $query = $this->db->query($sql);
          $dataArticle = $query->result_array();
          $query->free_result();
                
          return $dataArticle;
        }
    }
    
    function showArticleJenis($jenis_id,$strID,$limit=6,$image='') {        
        $strIDArr = str_replace(" and ", "", $strID);
        $strIDArr = explode("id<>", $strIDArr);
        
        $dataArticle = array();
        $now = time();
        $i = 0;
        foreach($this->CacheRobot as $arrRobot) {
          if (isset($arrRobot['tgl_robot']) && isset($arrRobot['jenis_id']) && isset($arrRobot['id']) && !in_array($arrRobot['id'], $strIDArr) && $arrRobot['jenis_id'] == $jenis_id && strtotime($arrRobot['tgl_robot']) <= $now) {
              if ($image != "" && $arrRobot[$image] != "") {
                $dataArticle[] = $this->getArticleContent($arrRobot['id']);
                //$strID .= " and id<>".$arrRobot['id'];
                $i++;
              } else {
                $dataArticle[] = $this->getArticleContent($arrRobot['id']);
                //$strID .= " and id<>".$arrRobot['id'];
                $i++;
              }
          }
          if ($i == $limit) break;
        }
        
        if (count($dataArticle) == $limit)
          return $dataArticle;
        else {
          $sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang,folder,img_list from ivmweb2009_artikel_data where ".(($image == "") ? "" : "$image<>'' and ")."UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (jenis_id=$jenis_id) $strID order by tgl_robot desc limit $limit";
          $sql = str_replace('and id<> ','',$sql);
          $query = $this->db->query($sql);
          $dataArticle = $query->result_array();
          $query->free_result();
                
          return $dataArticle;
        }
    }
    
    function showArticleJenisTag($jenis_id, $limit=10) {
        if (!$tmpArticle = $this->ivmcache->get('artikeltag'.$jenis_id)) {
            $sql = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=$jenis_id group by tags order by rand() limit $limit";
            $query = $this->db->query($sql);
            $tmpArticle = $query->result_array();
            $query->free_result();
            
            $this->ivmcache->add('artikeltag'.$jenis_id, $tmpArticle, 300);
        }
        
        return $tmpArticle;
    }
    
    function showVideoFiesta($where,$limit=6) {
        $sql="select tbl_video.*,tbl_video_kategori.kategori from tbl_video inner join tbl_video_kategori on tbl_video.id_kategori=tbl_video_kategori.id".(($where == "") ? "" : " and $where")." order by tbl_video.id desc limit $limit";
        return $this->db->query($sql);
    }
}
