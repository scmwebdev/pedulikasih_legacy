<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pedulikomunitas_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
        //$this->obj =& get_instance();
        $this->DB = $this->load->database('default', true);
    }    
    
    function totalrecord($sql)    
    {
    	$result =  $this->DB->query($sql);
    	return $result->num_rows();
    }    

    function looprecord($sql)    
    {
    	return $this->DB->query($sql);	
    }

		function fetchResultArray($sql) {
				$data = array();
				$query 	= $this->db->query($sql);
				$data 	= $query->result_array();
				$query->free_result();
				
				return $data;
		}
		
		function fetchRowArray($sql) {
				$data = array();
				$query 	= $this->db->query($sql);
				$data 	= $query->row_array();
				$query->free_result();
				
				return $data;
		}
		
    function pagingbca($iNum,$sql,$totrecord,$batas,$segment,$totpenyumbang) {     
				$config['base_url'] = site_url("pedulikomunitas/bcaperorangan/page");
				$config['total_rows'] = $totrecord;
				$config['per_page'] = $batas;
				$config['uri_segment'] = $segment;
				$config['num_links'] = 5;
													
				$this->pagination->initialize($config); 
			
				$paging='
				<b>Total Penyumbang: '.$totpenyumbang.'</b>
			  <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:1px solid #333">
			    <tr bgcolor="#D6DFF7"> 
			      <td align="center" width="40"><b>NO</b></td>
			      <td><b>NAMA</b></td>
			      <td align="right"><b>DONASI</b></td>
						<td align="center"><b>TANGGAL</b></td>
			      <td align="center"><b>KOTA</b></td>
			    </tr>';
						
				$query = $this->pedulikomunitas_model->looprecord($sql);
				foreach ($query->result() as $row)
				{
			  	$iNum++;
			  	$bgcolor = ($iNum % 2 == 1) ? "#EFEFEF" : "#FFFFFF";
			  	
			  	$paging.='
			  	<tr bgcolor="'.$bgcolor.'">
			  		<td align="center">'.$iNum.'</td>
			  		<td>'.(($row->NAMA == "") ? "NN" : $row->NAMA).'</td>
			  		<td align="right">'.number_format($row->NILAI,0,',','.').'</td>
			  		<td align="right">'.date("d-m-Y",strtotime($row->TANGGAL)).'</td>
			  		<td align="center">'.(($row->KOTA == "") ? "&nbsp;" : $row->KOTA).'</td>
			  	</tr>';
				}
				$query->free_result();
			  $paging.= '
			  </table>
							<div class="paging">'.$this->pagination->create_links().'</div>';
				return $paging;							
		}					

    function pagingberita($url,$sql,$totrecord,$batas,$segment,$content="intro") {    
			$config['base_url'] = site_url($url);
			$config['total_rows'] = $totrecord;
			$config['per_page'] = $batas;
			$config['uri_segment'] = $segment;
			$config['num_links'] = 5;
						
			$this->pagination->initialize($config); 
			$paging="";
			$query = $this->pedulikomunitas_model->looprecord($sql);
			$totrecord = $query->num_rows();
			if ($totrecord>0) {
				foreach ($query->result() as $row)
				{
				$paging.='
					<div class="ContentJenisList RoundedBox8px">
						'.(($row->subjudul == "") ? '' : '<div class="SubJudulArtikelList">'.$row->subjudul.'</div>').'
						<h2><a href="'.$this->allfunction->makeArticleURL($row->id,$row->judul_url,$row->jenis_url).'" title="'.$row->judul.'">'.$row->judul.'</a></h2>
						'.(($row->img_list != "" && file_exists($this->config->item('PATH_IMAGES_V09').$row->folder.'/'.$row->img_list)) ? '<img width="100" height="85" src="'.$this->config->item('URL_IMAGES_V09').$row->folder.'/'.$row->img_list.'" align="left" alt="'.$row->judul.'" title="'.$row->judul.'" border="0" style="margin-right:5px" />' : '').$row->ringkasan.'
						<div style="clear:both"></div>
					</div>';		
				}	
			}	
			$query->free_result();
			$paging.='<div class="paging">'.$this->pagination->create_links().'</div>';	
			return $paging;
		}				

    function pagingrs($url,$sql,$totrecord,$batas,$segment,$content="intro") {    
			$config['base_url'] = site_url($url);
			$config['total_rows'] = $totrecord;
			$config['per_page'] = $batas;
			$config['uri_segment'] = $segment;
			$config['num_links'] = 5;
						
			$this->pagination->initialize($config); 
			$paging="";
			$query = $this->pedulikomunitas_model->looprecord($sql);
			$totrecord = $query->num_rows();
			if ($totrecord>0) {
				foreach ($query->result() as $row)
				{
				$paging.='
					<div class="ContentJenisList RoundedBox8px">
						<h2>'.$row->title.'</a></h2>'.
						str_replace("http://www.indosiar.com/pdf/pedulikomunitas/","http://static.indosiar.com/pdf/pedulikomunitas/",$row->introtext).'
						<div style="clear:both"></div>
					</div>';		
				}	
			}	
			$query->free_result();
			$paging.='<div class="paging">'.$this->pagination->create_links().'</div>';	
			return $paging;
		}
		
    function showMenu() {
		$site_url   = '/'.$this->uri->segment(1).'/'.$this->uri->segment(2);
		$str 		= '<div id="wmenu">';
		$sqlx 		= "select * from pedulikomunitas_menu where publish=1 and id_main=0 order by status_sort";
		$queryx 	= $this->db->query($sqlx);
		if ($queryx->num_rows() > 0) {			
			foreach ($queryx->result_array() as $rowx) {
				$link = '/pedulikomunitas/'.$rowx['judul_url'];
				if ($rowx['pdf'] != "") $link = URL_STATIC.'pdf/pedulikomunitas/'.$rowx['pdf'];
				if ($rowx['url'] != "") $link = '/pedulikomunitas/'.$rowx['url'];
				
				$css_sel = ($link == $site_url) ? ' wmenusel' : '';
				
				$sqlz = "select * from pedulikomunitas_menu where publish=1 and id_main=".$rowx['id']." order by status_sort";
				$queryz = $this->db->query($sqlz);
				if ($queryz->num_rows() > 0) {
    				//$str .= '<div class="wmenu"><a href="javascript:;" onclick="wmenuShow(\'#wmenu'.$rowx['id'].'\')">'.$rowx['judul_menu'].'</a></div><div id="wmenu'.$rowx['id'].'" class="whide">';
    				$str .= '<div class="wmenu'.$css_sel.'"><a href="javascript:;" onclick="wmenuShow(\'#wmenu'.$rowx['id'].'\')">'.$rowx['judul_menu'].'</a></div><div id="wmenu'.$rowx['id'].'">';
    				foreach ($queryz->result_array() as $rowz) {
    					$link = '/pedulikomunitas/'.$rowz['judul_url'];
    					if ($rowz['pdf'] != "") $link = URL_STATIC.'pdf/pedulikomunitas/'.$rowz['pdf'];
    					if ($rowz['url'] != "") $link = '/pedulikomunitas/'.$rowz['url'];
    					
						$css_sel = ($link == $site_url) ? ' wmenusel' : '';
						
    					$str 	.= '<div class="wmenu'.$css_sel.'"><a href="'.$link.'">&raquo; '.$rowz['judul_menu'].'</a></div>';
    				}
    				$str .= '</div>';
                } else {
                    $str .= '<div class="wmenu'.$css_sel.'"><a href="'.$link.'">'.$rowx['judul_menu'].'</a></div>';
                }
    			$queryz->free_result();
			}
		}
		$queryx->free_result();

		$str .= '</div>
		<script>
		function wmenuShow(div) {
		    $(div).slideToggle(400);
            return false;
		}
		</script>
		';
		return $str;
    }
    
    function showDonatur($iNum,$sql,$totrecord,$batas,$segment,$totpenyumbang) {     
			$config['base_url'] = site_url("pedulikomunitas/donatur/page");
			$config['total_rows'] = $totrecord;
			$config['per_page'] = $batas;
			$config['uri_segment'] = $segment;
			$config['num_links'] = 5;
												
			$this->pagination->initialize($config); 
		
			$paging='
			<div style="text-align:right;font-weight:bold;">Total Penyumbang: '.$totpenyumbang.'</div>
		  <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:1px solid #333">
		    <tr bgcolor="#D6DFF7"> 
		      <td align="center" width="40"><b>NO</b></td>
		      <td><b>NAMA</b></td>
		      <td align="right"><b>DONASI</b></td>
					<td align="center"><b>TANGGAL</b></td>
		      <td align="center"><b>KOTA</b></td>
		    </tr>';
					
			$query = $this->looprecord($sql);
			foreach ($query->result() as $row)
			{
		  	$iNum++;
		  	$bgcolor = ($iNum % 2 == 1) ? "#EFEFEF" : "#FFFFFF";
		  	
		  	$paging.='
		  	<tr bgcolor="'.$bgcolor.'">
		  		<td align="center">'.$iNum.'</td>
		  		<td>'.(($row->NAMA == "") ? "NN" : $row->NAMA).'</td>
		  		<td align="right">'.number_format($row->NILAI,0,',','.').'</td>
		  		<td align="right">'.date("d-m-Y",strtotime($row->TANGGAL)).'</td>
		  		<td align="center">'.(($row->KOTA == "") ? "&nbsp;" : $row->KOTA).'</td>
		  	</tr>';
			}
			$query->free_result();
		  $paging.= '
		  </table>
						<div class="paging">'.$this->pagination->create_links().'</div>';
			return $paging;							
	}
	
	function getMenuDetail($judul_url,$url="") {
			$data = array();
			//if (!$data = $this->ivmcache->get('pk:menu:'.$judul_url)) {
			    	$sql 	= "select * from pedulikomunitas_menu where publish=1 and ".(($url == "") ? "judul_url='$judul_url'" : "url='$url'")." limit 1";
					$query 	= $this->db->query($sql);
					$data 	= $query->row_array();
					$query->free_result();
					
					//$this->ivmcache->add('artikel'.$artikel_id, $dataArticle);
			//}

			return $data;
	}
	
	function getContentList($kategori,$limit=10,$excID="") {
			$data = array();
			//if (!$data = $this->ivmcache->get('pk:menu:'.$judul_url)) {
			    	$sql	= "select judul,judul_url,ringkasan,kategori,pdf from pedulikomunitas_content where kategori='$kategori' and publish=1 ".($excID == "" ? "" : "and id<>$excID")." order by id desc limit $limit";
					$query 	= $this->db->query($sql);
					$data 	= $query->result_array();
					$query->free_result();
					
					//$this->ivmcache->add('artikel'.$artikel_id, $dataArticle);
			//}

			return $data;
	}
	
	function getContentDetail($kategori,$judul_url) {
			$data = array();
			//if (!$data = $this->ivmcache->get('pk:menu:'.$judul_url)) {
			    	$sql 	= "select * from pedulikomunitas_content where kategori='$kategori' and judul_url='$judul_url' limit 1";
					$query 	= $this->db->query($sql);
					$data 	= $query->row_array();
					$query->free_result();
					
					//$this->ivmcache->add('artikel'.$artikel_id, $dataArticle);
			//}

			return $data;
	}
		
    function pagingContent($url,$sql,$totrecord,$batas,$segment,$content="intro") {    
			$config['base_url'] = site_url($url);
			$config['total_rows'] = $totrecord;
			$config['per_page'] = $batas;
			$config['uri_segment'] = $segment;
			$config['num_links'] = 5;
						
			$this->pagination->initialize($config); 
			$paging="";
			$query = $this->pedulikomunitas_model->looprecord($sql);
			$totrecord = $query->num_rows();
			if ($totrecord>0) {
				foreach ($query->result() as $row)
				{
				$paging.='
					<div class="ContentJenisList RoundedBox8px">
						<h2>'.$row->title.'</a></h2>'.
						str_replace("http://www.indosiar.com/pdf/pedulikomunitas/","http://static.indosiar.com/pdf/pedulikomunitas/",$row->introtext).'
						<div style="clear:both"></div>
					</div>';		
				}	
			}	
			$query->free_result();
			$paging.='<div class="paging">'.$this->pagination->create_links().'</div>';	
			return $paging;
	}
	
	function getAlbumDetail($judul_url) {
			$sql 	= "select * from pedulikomunitas_album where judul_url='$judul_url' limit 1";
			return $this->fetchRowArray($sql);
	}
	
	function getLastAlbum() {
			$sql 	= "select * from pedulikomunitas_album where publish=1 order by tanggal desc limit 1";
			return $this->fetchRowArray($sql);
	}
	
	function getPhotoList($id_album) {
			$sql 	= "select * from pedulikomunitas_album_foto where id_album=$id_album order by urutan asc";
			return $this->fetchResultArray($sql);
	}
		
	function getLastPhoto($id_album) {
		$sql 	= "select * from pedulikomunitas_album_foto where id_album=$id_album order by urutan asc limit 1";
		return $this->fetchRowArray($sql);
	}
	
	function getVideoList($id_album) {
		$sql 	= "select * from pedulikomunitas_album_video where id_album=$id_album order by urutan asc";
		return $this->fetchResultArray($sql);
	}
}
