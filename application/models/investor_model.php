<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Investor_model extends CI_Model {
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
										
					if ($pdf != "")
						$str .= '<li><a href="'.URL_STATIC.'pdf/investor/'.$pdf.'">'.$menu.'</a></li>';
					elseif ($pdf == "" && $rowx['url'] != "")
						$str .= '<li><a href="/corporate/'.$rowx['url'].'">'.$menu.'</a></li>';
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
    
    function showColumnHighlights($lang) {
		$i = 1;
		$str = '
		<div style="border:1px solid #ccc;margin-bottom:20px;">';
		
		$sql = "select * from investor_column_highlights where id_main=0 order by sort limit 2";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $row) {
				$div 	= ($i == 1) ? 'width:348px;border-right:1px solid #ccc;' : 'width:349px;';
				$bg 	= ($i == 1) ? '#E6E6FF' : '#FFF2C1';
				
				$str .= '
				<div style="float:left;'.$div.'">
					<div style="padding:8px 20px;background:'.$bg.';">'.$row['judul'].'</div>
					<div class="indexBox1">
						<ul>';
						
				$sqlx = "select * from investor_column_highlights where id_main=".$row['id']." order by sort";
				$queryx = $this->db->query($sqlx);
				foreach ($queryx->result_array() as $rowx) {
						if ($rowx['menu_id'] == "0") 
								$str .= '<li>'.$rowx['judul'].'</li>';
						else {
								$pdf = $this->getPDF($rowx['menu_id']);
								
								if ($lang == "english") {
										if (trim($pdf['pdf_en']) == "")
												$str .= '<li>'.$rowx['judul'].'</li>';
										else
												$str .= '<li><a href="'.URL_STATIC.'pdf/investor/'.$pdf['pdf_en'].'">'.$rowx['judul'].'</a></li>';
								} else {
										if (trim($pdf['pdf_id']) == "")
												$str .= '<li>'.$rowx['judul'].'</li>';
										else
												$str .= '<li><a href="'.URL_STATIC.'pdf/investor/'.$pdf['pdf_id'].'">'.$rowx['judul'].'</a></li>';
								}
						}
				}
				$queryx->free_result();
				
				$str .= '
						</ul>
					</div>
				</div>';
				
				$i++;
		}
		$query->free_result();
		
		$str .= '
			<div style="clear:left"></div>
		</div>';
		
		return $str;
    }
    
    function getPDF($menu_id) {
		$sql = "select pdf_id,pdf_en from investor_menu where id=$menu_id";
		$query = $this->db->query($sql);
		return $query->row_array();
    }
    
    function showFinancialHighlights() {
        $sql = "select * from investor_global where jenis='investor_fhl'";
        $query = $this->db->query($sql);
        $data = $query->row_array();
        $query->free_result();
        
        return (isset($data['isi'])) ? $data['isi'] : '';
    }
    
    function showFinancialHighlightsx() {
		$i = 1;
		$str = '
		<table width="100%" border=0 cellspacing=0 cellpadding=0>
		  <tr> 
		    <td bgcolor=#CCCCCC>
		    	<table width=100% border=0 cellspacing=1 cellpadding=2>';
		    	
		$sql = "select * from investor_financial_highlights where id_main=0 order by sort";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $row) {
				$str .= '
			      <tr>
			        <td width="70%" align="center" bgcolor="#ECECEC"><b>'.$row['col_title'].'</b></td>
			        <td width="30%" align="center" bgcolor="#D9D9FF"><b>'.$row['col_value'].'</b></td>
			      </tr>';
			  
				$sqlx = "select * from investor_financial_highlights where id_main=".$row['id']." order by sort";
				$queryx = $this->db->query($sqlx);
				foreach ($queryx->result_array() as $rowx) {
			      $str .= '
			      <tr>
			        <td bgcolor="#FFFFFF"><b><font size="1">'.$rowx['col_title'].'</font></b></td>
			        <td bgcolor="#F2F2FF" align="center"><font size="1">'.$rowx['col_value'].'</font></td>
			      </tr>';
				}
				$queryx->free_result();
		}
		$query->free_result();
		
		$str .= '
					</table>
				</td>
			</tr>
		</table>';
		
		return $str;
    }
    
    function getData($versi, $judul_url) {
		$sql = "select * from investor_menu where ".($versi == "english" ? 'judul_url_en' : 'judul_url_id')." = '$judul_url' limit 1";
		$query = $this->db->query($sql);
		return $query->row_array();
    }
}