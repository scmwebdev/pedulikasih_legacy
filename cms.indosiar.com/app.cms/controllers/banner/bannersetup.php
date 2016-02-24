<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bannersetup extends CI_Controller {
	  public function __construct() {
			parent::__construct();
			$this->load->model('banner/banner_model');  
	  }
	    
		public function index()
		{				
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('banner/banner_setup_views', $viewVars);
		}
					
		public function jsonsetup($artikel="")
		{
				if (isset($_REQUEST['q']) && $_REQUEST['q'] != "") {
					$artikel=trim($_REQUEST['q']);
				}else {
					$artikel="";
				}			
			
	    	if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
	    		$page 	= (isset($_GET['page'])) ? $_GET['page'] : 1;
	    		$start 	= (isset($_GET['start'])) ? $_GET['start'] : 0;
	    		$limit	= (isset($_GET['limit'])) ? $_GET['limit'] : 23;
	    	} else {
	    		$page 	= 1;
	    		$start 	= 0;
	    		$limit	= 30;
	    	}
				
				if ($artikel!="") {				
					if (is_numeric($artikel)) {
						$sql = "select count(bi.id) as total from banner_inc as bi inner join banner as b on bi.id_banner=b.id where bi.id=$artikel or bi.keterangan like '%$artikel%'";			
					}else {
						$sql = "select count(bi.id) as total from banner_inc as bi inner join banner as b on bi.id_banner=b.id where bi.keterangan like '%$artikel%'";			
					}
				}else {
					$sql = "select count(bi.id) as total from banner_inc as bi inner join banner as b on bi.id_banner=b.id";			
				}
				$query = $this->db->query($sql);
				if ($query->num_rows() == 0) {
						echo '{
		    		"success":true, 
		    		"results":0, 
		    		"rows": []}';	
						exit();
				}
				$row = $query->row();
				$total = $row->total;
				$query->free_result();
				
				echo '{"success":true,"results":'.$total.',"rows": [';
	    	
	    	$tmp = "";
				if ($artikel!="") {	
					$sql = "select bi.tanggal,bi.id,b.id as bannerid,bi.keterangan,b.lebar,b.nama,b.id as banid, b.tinggi,b.banner,b.alternatif,b.link,b.linkalternatif from banner_inc as bi inner join banner as b on bi.id_banner=b.id where bi.keterangan like '%$artikel%' order by bi.id desc limit $start,$limit";
				}else {
					$sql = "select bi.tanggal,bi.id,b.id as bannerid,bi.keterangan,b.lebar,b.nama,b.id as banid,b.tinggi,b.banner,b.alternatif,b.link,b.linkalternatif from banner_inc as bi inner join banner as b on bi.id_banner=b.id order by bi.id desc limit $start,$limit";
				}
	    	$query = $this->db->query($sql);
	    	  
	    	foreach($query->result() as $row) {
						$tmp .= '{"s_id":"'.base64_encode($row->id).'","bannerid":"'.base64_encode($row->bannerid).'","idbanner":"'.base64_encode($row->bannerid).'","idpos":"'.$row->id.'","id":"'.base64_encode($row->id).'","keterangan":'.json_encode($row->keterangan).',"banner":'.json_encode('['.$row->banid.'] '.$row->banner).',"nama":'.json_encode($row->nama).',"tanggal":"'.$row->tanggal.'","alternatif":'.json_encode($row->alternatif).',"link":'.json_encode($row->link).',"linkalternatif":'.json_encode($row->linkalternatif).',"lebar":"'.$row->lebar.'","tinggi":'.json_encode($row->tinggi).'},';
	    	}
	    	$query->free_result();
	    	$tmp = substr($tmp, 0, -1);
	    	echo $tmp;
	    	echo ']}';
		}

		public function jsonbanner()
		{
	    	if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
	    		$page 	= (isset($_GET['page'])) ? $_GET['page'] : 1;
	    		$start 	= (isset($_GET['start'])) ? $_GET['start'] : 0;
	    		$limit	= (isset($_GET['limit'])) ? $_GET['limit'] : 2000;
	    	} else {
	    		$page 	= 1;
	    		$start 	= 0; 
	    		$limit	= 2000;
	    	}

				if (isset($_REQUEST['tinggi']) && $_REQUEST['lebar'] != "") {
					$sql = "select count(id) as total from banner where tinggi=".$_REQUEST['tinggi']." and lebar=".$_REQUEST['lebar'];	
				}else {
					$sql = "select count(id) as total from banner";	
				}		
							
						
				$query = $this->db->query($sql);
				if ($query->num_rows() == 0) {
						echo '{
		    		"success":true, 
		    		"result":0, 
		    		"rows": []}';	
						exit();
				}
				$row = $query->row();
				$total = $row->total;
				$query->free_result();
				
				echo '{"success":true,"result":'.$total.',"rows": [';
	    	
	    	$tmp = "";   	
				if (isset($_REQUEST['tinggi']) && $_REQUEST['lebar'] != "") {				
					$sql = "select * from banner where tinggi=".$_REQUEST['tinggi']." and lebar=".$_REQUEST['lebar']." order by id desc limit $start,$limit";
				}else {
					$sql = "select * from banner order by id desc limit $start,$limit";
				}
	    	$query = $this->db->query($sql);
	    	foreach($query->result() as $row) {
						$tmp .= '{"s_id":"'.base64_encode($row->id).'","idbanner":"'.base64_encode($row->id).'","bannerid":"'.base64_encode($row->id).'","id":"'.base64_encode($row->id).'","nama":"['.$row->id.']['.$row->banner.'] '.$row->nama.' - ukuran:'.$row->lebar.' - '.$row->tinggi.'","tinggi":"'.$row->tinggi.'","lebar":"'.$row->tinggi.'"},';						
	    	}
	    	$query->free_result();
	    	$tmp = substr($tmp, 0, -1);
	    	
	    	echo $tmp;
	    	echo ']}';
		}	

		public function jsonitemsetup() 
		{			
				if (isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
					$s_id=trim($_REQUEST['id']);
				}else {
					$s_id="";
				}				
				if ($s_id == "") {
						echo "[{'s_id':'','banner':'','link':''}]";

				} else {
						$data=array();
						$s_id = base64_decode($s_id);
						$data = $this->banner_model->getDatasetup($s_id);
						$data['s_id'] = base64_encode($data['id']);
						$data['idbanner']=base64_encode($data['idbanner']);
						$data['nama']=$data['nama'].' - ukuran:'.$data['lebar'].' - '.$data['tinggi'];
						$data['tanggal'] = date("d/m/Y",strtotime($data['tanggal']));
						echo json_encode($data);
				}
		}		

		public function submitdata()
		{			
				if ($this->input->post('keterangan')) {										
					if ($this->input->post('s_id') == "") {
						$this->banner_model->addDatasetup();
					}else {
						$data_id = base64_decode($this->input->post('s_id'));
						$this->banner_model->editDatasetup($data_id);
					}	
					echo "{success: true}";
				}					
		    					
		}
		
		public function bannershow()
		{									
				$data_id = $_REQUEST['id'];
				if ($data_id != "") {
						$data_id = base64_decode($data_id);
						$data = $this->banner_model->getBannersetup($data_id);
						echo json_encode($data);
				}
		}	
		public function bannersetupshow()
		{									
				$data_id = $_REQUEST['id'];
				if ($data_id != "") {
						$data_id = base64_decode($data_id);
						$data = $this->banner_model->getDatasetup($data_id);
						echo json_encode($data);
				}
		}			

		public function deletedatasetup()
		{
				if ($this->input->post('postdata')) {
								$data_id = $this->input->post('postdata');
								if ($data_id != "") {
										$data_id = base64_decode($data_id);
										$sql = "delete from banner_inc where id=$data_id";
										$this->db->query($sql);	
										$this->ivmcache->delete('banner'.$data_id); 
								}
				}				
		}		
		
}