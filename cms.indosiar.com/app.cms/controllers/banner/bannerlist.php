<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bannerlist extends CI_Controller {
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
				$this->load->view('banner/banner_list_views', $viewVars);
		}
					
		public function json($artikel="")
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
	    		$limit	= 23;
	    	}
				
				if ($artikel!="") {				
					$sql = "select count(id) as total from banner where nama like '%$artikel%'";			
				}else {
					$sql = "select count(id) as total from banner";			
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
					if (is_numeric($artikel)) {
						$sql = "select * from banner where id=".$artikel." or nama like '%$artikel%' order by id desc limit $start,$limit";
					}else {
						$sql = "select * from banner where nama like '%$artikel%' order by id desc limit $start,$limit";
					}
				}else {
					$sql = "select * from banner order by id desc limit $start,$limit";
				}
	    	$query = $this->db->query($sql);
	    	
	    	foreach($query->result() as $row) {
						$tmp .= '{"b_id":"'.base64_encode($row->id).'","bannerid":"'.$row->id.'","id":"'.base64_encode($row->id).'","banner":'.json_encode($row->banner).',"nama":'.json_encode($row->nama).',"tanggal":"'.$row->tanggal.'","tanggal_akhir":"'.$row->tanggal_akhir.'","alternatif":"'.$row->alternatif.'","java_script":'.json_encode($row->java_script).',"link":"'.$row->link.'","linkalternatif":'.json_encode($row->linkalternatif).',"alt":"'.$row->alt.'","klik":'.json_encode($row->klik).',"lebar":"'.$row->lebar.'","tinggi":'.json_encode($row->tinggi).',"align":"'.$row->align.'","target":'.json_encode($row->target).'},';
	    	}
	    	$query->free_result();
	    	$tmp = substr($tmp, 0, -1);
	    	echo $tmp;
	    	echo ']}';
		}

		public function jsonitem() 
		{			
				if (isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
					$b_id=trim($_REQUEST['id']);
				}else {
					$b_id="";
				}				
				if ($b_id == "") {
						echo "[{'b_id':'','banner':'','link':''}]";

				} else {
						$data=array();
						$b_id = base64_decode($b_id);
						$data = $this->banner_model->getData($b_id);
						$data['b_id'] = base64_encode($data['id']);
						//echo $data['tinggi']."##",$data['lebar'];
						//exit();
						$data['tanggal_akhir'] = date("d/m/Y",strtotime($data['tanggal_akhir']));
						$data['filenamebanner']=$data['banner'];						
						$data['filenamebanneralternatif']=$data['alternatif'];						
						$data['filenamebanner_old']=$data['banner'];						
						$data['filenamealternatif_old']=$data['alternatif'];	
						echo json_encode($data);
				}
		}		

		public function submitdata()
		{			
				if ($this->input->post('nama')) {
					//$upload_dir = trim("/xampp/htdocs/cms.indosiar.com/staticpath/");
					$upload_dir = STATIC_PATH."banner/"; //aslinya
					$file_name_banner="";
					$file_name_laternatif="";
					if (isset($_FILES['banner'])) {
						if ($_FILES['banner']) {
										$temp_name_banner = $_FILES['banner']['tmp_name'];
										$file_name_banner = $_FILES['banner']['name'];
										if (is_null($file_name_banner) || trim($file_name_banner)=="") {
											$file_name_banner="";
										}else {																					
											$file_name_banner=	str_replace(" ","-",strtolower($file_name_banner));
											$xfilename_banner = $upload_dir.$file_name_banner;											
											$result = move_uploaded_file($temp_name_banner, $xfilename_banner);											
										}
						}	
					}
					if (isset($_FILES['alternatif'])) {
						if ($_FILES['alternatif']) {
										$temp_name_alternatif = $_FILES['alternatif']['tmp_name'];
										$file_name_alternatif = $_FILES['alternatif']['name'];
										if (is_null($file_name_alternatif) || trim($file_name_alternatif)=="") {
											$file_name_alternatif="";
										}else {																					
											$file_name_alternatif=	str_replace(" ","-",strtolower($file_name_alternatif));
											$xfilename_alternatif = $upload_dir.$file_name_alternatif;											
											$result = move_uploaded_file($temp_name_alternatif, $xfilename_alternatif);											
										}
						}	
					}


					$data_id = base64_decode($this->input->post('b_id'));
					
					if ($data_id == "")
						$this->banner_model->addData($file_name_banner,$file_name_alternatif);
					else
						$this->banner_model->editData($file_name_banner,$file_name_alternatif,$data_id);
						
					echo "{success: true}";
				}					
		    					
		}
		
		public function bannershow()
		{									
				$data_id = $_REQUEST['id'];
				if ($data_id != "") {
						$data_id = base64_decode($data_id);
						$data = $this->banner_model->getBanner($data_id);
						echo json_encode($data);
				}
		}	

		public function deletedata()
		{
				if ($this->input->post('postdata')) {
								$data_id = $this->input->post('postdata');
								if ($data_id != "") {
										//$upload_dir = trim("/xampp/htdocs/cms.indosiar.com/staticpath/");
										$upload_dir = STATIC_PATH."banner/"; //aslinya
										$data_id = base64_decode($data_id);										
										$data = $this->banner_model->getBanner($data_id);
										if (file_exists($upload_dir.$data['banner'])) {												
											unlink($upload_dir.$data['banner']);
										}
										if (file_exists($upload_dir.$data['alternatif'])) {												
											unlink($upload_dir.$data['alternatif']);
										}										
										$sql = "delete from banner where id=$data_id";
										$this->db->query($sql);	
								}
				}				
		}		
		
}