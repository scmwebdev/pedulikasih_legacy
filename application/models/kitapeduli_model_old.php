<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kitapeduli_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
        //$this->obj =& get_instance();
        $this->DB = $this->load->database('default', true);
        $this->load->model('article_model');
    }    
    
    function totalrecord($sql)    
    {
    	$result =  $this->DB->query($sql);
    	return $result->num_rows();
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
		
    function looprecord($sql)    
    {
    	return $this->DB->query($sql);	
    }

    function pagingbca($iNum,$sql,$totrecord,$batas,$segment,$totpenyumbang) {    
				$config['base_url'] = site_url("kitapeduli/bcaperorangan/page");
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
										
				$query = $this->kitapeduli_model->looprecord($sql);
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

    function pagingberita($url,$sql,$totrecord,$batas,$segment) {    
			$config['base_url'] = site_url($url);
			$config['total_rows'] = $totrecord;
			$config['per_page'] = $batas;
			$config['uri_segment'] = $segment;
			$config['num_links'] = 5;
						
			$this->pagination->initialize($config); 
			$paging="";
			$query = $this->kitapeduli_model->looprecord($sql);
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
		
		function getAlbumDetail($judul_url) {
				$sql 	= "select * from kitapeduli_album where judul_url='$judul_url' limit 1";
				return $this->fetchRowArray($sql);
		}
		
		function getPhotoList($id_album) {
				$sql 	= "select * from kitapeduli_album_foto where id_album=$id_album order by id desc";
				return $this->fetchResultArray($sql);
		}
}