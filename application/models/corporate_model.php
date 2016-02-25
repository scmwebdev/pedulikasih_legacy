<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Corporate_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function showMenu($lang) {
		$i = 1;
		$str = '
		<div id="ddblueblockmenu">';
		
		$sql = "select * from investor_menu where publish=1 and id_main=0 order by status_sort";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $row) {
			$div 	= ($i == 1) ? 'width:348px;border-right:1px solid #ccc;' : 'width:349px;';
			$bg 	= ($i == 1) ? '#E6E6FF' : '#FFF2C1';
			
			$str .= '
			<div class="menutitle">'.(($lang=="english") ? $row['judul_menu_en'] : $row['judul_menu_id']).'</div>';
					
			$sqlx = "select * from investor_menu where publish=1 and id_main=".$row['id']." order by status_sort";
			$queryx = $this->db->query($sqlx);
			if ($queryx->num_rows() > 0) {
				$str .= '
				<ul>';
				
				foreach ($queryx->result_array() as $rowx) {
					if ($lang=="english") {
						$menu	= $rowx['judul_menu_en'];
						$pdf   	= $rowx['pdf_en'];
						$url	= '/corporate/english/'.$rowx['judul_url_en'];
						$isi   	= $rowx['isi_en'];
					} else {
						$menu	= $rowx['judul_menu_id'];
						$pdf   	= $rowx['pdf_id'];
						$url	= '/corporate/'.$rowx['judul_url_id'];
						$isi   	= $rowx['isi_id'];
					}										
					
					if ($rowx['url'] != "")
						$str .= '<li><a href="/corporate/'.$rowx['url'].'">'.$menu.'</a></li>';
					elseif ($pdf != "")
						$str .= '<li><a href="'.URL_STATIC.'pdf/investor/'.$pdf.'">'.$menu.'</a></li>';
					elseif ($pdf == "" && strlen($isi) > 10)
						$str .= '<li><a href="'.$url.'">'.$menu.'</a></li>';
					else
						$str .= '<li><a href="#">'.$menu.'</a></li>';
							
					$sqlz = "select * from investor_menu where publish=1 and id_main=".$rowx['id']." order by status_sort";
					$queryz = $this->db->query($sqlz);
					foreach ($queryz->result_array() as $rowz) {
							$menu	= ($lang=="english") ? $rowz['judul_menu_en'] : $rowz['judul_menu_id'];
							$pdf   	= ($lang=="english") ? $rowz['pdf_en'] : $rowz['pdf_id'];
							
							if ($pdf == "")
									$str .= '<li>&raquo; '.$menu.'</li>';
							else
									$str .= '<li><a href="'.URL_STATIC.'pdf/investor/'.$pdf.'">&raquo; '.$menu.'</a></li>';
					}
					$queryz->free_result();
				}
				
				$str .= '
				</ul>';
			}
			$queryx->free_result();
		}
		$query->free_result();
		
		$str .= '
		</div>
		<div class="bahasa"><a href="/corporate/'.(($lang == "english") ? '' : 'english').'">'.(($lang == "english") ? 'Versi Indonesia' : 'English Version').'</a></div>';
		
		return $str;
    }
        
    function getPDF($menu_id) {
		$sql = "select pdf_id,pdf_en from investor_menu where id=$menu_id";
		$query = $this->db->query($sql);
		return $query->row_array();
    }
    
    function getData($versi, $judul_url) {
		$sql = "select * from investor_menu where ".($versi == "english" ? 'judul_url_en' : 'judul_url_id')." = '$judul_url' limit 1";
		$query = $this->db->query($sql);
		return $query->row_array();
    }
    
    function getSlideshow() {
		$sql = "select * from investor_slideshow where publish=1 order by urutan";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    
    function getAnnualReport() {
        $sql = "select * from investor_annualreport where publish=1 order by tahun desc";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
}