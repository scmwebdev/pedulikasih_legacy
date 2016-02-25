<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sitemapxml_model extends CI_Model {    
    function showArticleJenis() {
    		$sql = "select jenis_url from ivmweb2009_artikel_jenis";
    		return $this->db->query($sql);
    }
    
    function showArticle($jenis_url="") {
    		$sql = "select id,judul,judul_url,jenis_url,ringkasan,tgl_robot,folder,img_index,img_artikel,img_list,video from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() ".(($jenis_url == "") ? "" : "and jenis_url='$jenis_url'")." order by tgl_robot desc limit 1000";
    		return $this->db->query($sql);
    }
    
    function showVideoFiesta() {
    		$sql="select id,judul from tbl_video order by id desc limit 1000";
    		return $this->db->query($sql);
    }
}