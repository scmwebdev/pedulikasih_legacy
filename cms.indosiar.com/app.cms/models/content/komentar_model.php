<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Komentar_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
		
		function deleteData($data_id) {			
				$sql = "delete from ivmweb_artikel_komentar where id=$data_id";
				$this->db->query($sql);
		}
		
		function publishData($data_id,$set) {
				$sql = "update ivmweb_artikel_komentar set status_tampil=$set where id=$data_id";
				$this->db->query($sql);
		}
    
		function json($keyword,$start,$limit,$page) {
				if ($keyword == "") {
						$total = $this->db->count_all_results('ivmweb_artikel_komentar');
				} else {
						$total = $this->db->like('komentar',$keyword)->count_all_results('ivmweb_artikel_komentar');
				}
				
				if ($total == 0) {
						$json = '{"success":true, "results":0, "rows": []}';
				} else {						
						$json = '{"success":true,"results":'.$total.',"rows":';
						
						if ($keyword == "") {
								$sql = "select * from ivmweb_artikel_komentar order by id desc limit $start,$limit";
						} else {
								$sql = "select * from ivmweb_artikel_komentar where komentar like '%$keyword%' order by id desc limit $start,$limit";
						}
						
			    	$query = $this->db->query($sql);
			    	$data = $query->result_array();
			    	$query->free_result();
			    	
			    	$json .= json_encode($data);
			    	$json .= '}';
				}
				
				return $json;
		}
		
		function getData($data_id) {
				$sql = "select k.*,a.judul,a.jenis_judul from ivmweb_artikel_komentar k inner join ivmweb2009_artikel_data a on k.id_artikel=a.id where k.id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();
				$query->free_result();
				
				if (count($data) > 0)
						$data['komentar'] = nl2br($data['komentar']);
				else
						$data = array();
				//{"id":"369949","tanggal":"2011-11-29 06:15:47","id_artikel":"90500","kategori":"1","jenis":"5","nama":"fiusernamer54","email":"89huin3ewso@gmail.com","komentar":"KONTAKT LENS SOL\u00dcSYONLARI          <br \/>\n          <br \/>\nModern kontakt lens bakiminda kontakt lens sol\u00fcsyonlari performansini artirmak i\u00e7in temel fakt\u00f6rler; rahatlik, temizlik, lens ile uyumluluk, hastaya uygunluk ve dezenfeksiyon\u2019dur. Kontakt lens sol\u00fcsyon \u00fcreticileri \u00e7ok adimli temizleme \u2013 durulama \u2013 dezenfeksiyon sol\u00fcsyonlari ile geri bildirimleri degerlendirerek son yillarda basit ve etkili, \u00e7ok ama\u00e7li tek sise sol\u00fcsyonlari \u00fcretmislerdir. Bunlar dezenfeksiyon i\u00e7in koruyucu i\u00e7eren, nemlendirici materyal bulunduran, temizleme ve durulama yapabilen sol\u00fcsyonlardir. Ayni sekilde renkli lens de saydam lensler de oldugu gibi dezenfeksiyon saglanmaktadir.          <br \/>\n          <br \/>\nKaynak: www.lensomani.com          <br \/>\nAnahtar kelimeler: Kontakt lens sol\u00fcsyonlari, Renkli lens, saydam lensler          <br \/>\n          <br \/>\nCONTACT LENS SOLUTIONS          <br \/>\n          <br \/>\nIn the modern care of contact lens, the main factors to increase the performance of lens solutions are comfort, hygiene, compatibility, compliance and disinfection contact lens solutions producers, after evaluating feedbacks from multi-step cleaning \u2013 rinsing \u2013 disinfecting solutions, started to produce simple and effective multi purpose one bottle solutions. These solutions have preservatives for disinfection, moisturizing material and can clean and rinse all at the same time. In the same way as in the color lens is a transparent lens disinfection is provided.          <br \/>\n          <br \/>\n[url=http:\/\/lensomani.com]Renkli Lens[\/url]   [url=http:\/\/lensomani.com]Kontakt Lens[\/url]    [url=http:\/\/lensomani.com]Saydam Lens[\/url]    [url=http:\/\/lensomani.com]Torik Lens[\/url]","ip":"210.87.250.147","judul":"IPB Tetap Tolak Umumkan Merk Susu","jenis_judul":"Fokus"}
				
				return $data;
    }
}