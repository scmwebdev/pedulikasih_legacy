<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Jadwalacara_model extends CI_Model {    
    function showJadwalAcara($tgljadwal) {
				if (!$arrJadwal = $this->ivmcache->get('schedule'.$tgljadwal)) {
    				$arrJadwal = array();
    				$sql = "select * from ivmweb_jadwal_acara where date(tanggal)='$tgljadwal' order by tanggal";
    				$query = $this->db->query($sql);
    				foreach ($query->result_array() as $row) $arrJadwal[] = $row;
    				$query->free_result();
    				
    				$this->ivmcache->add('schedule'.$tgljadwal, $arrJadwal, 3600);
    		}
    		
    		return $arrJadwal;
    }
    
    function getJadwalAcaraArticle($tgl) {
    		$sql = "select id,jenis_url,judul_url from ivmweb2009_artikel_data where tgl_tayang='".$tgl."' limit 1";
    		$query = $this->db->query($sql);
				return $query->row_array();
    }
}