<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Videofiesta extends CI_Controller {
	  public function __construct() {
			parent::__construct();
	    $this->load->model('videofiesta/videofiesta_model'); 
	  }
	    
		public function index()
		{				
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('videofiesta/videofiesta_views', $viewVars);
		}
					
		public function json($artikel="")
		{
				if (isset($_REQUEST['search']) && $_REQUEST['search'] != "") {
					$artikel=trim($_REQUEST['search']);
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
					$sql = "select count(id) as total from tbl_video where judul like '%$artikel%' or keterangan like '%$artikel%'";			
				}else {
					$sql = "select count(id) as total from tbl_video";			
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
					$sql = "select * from tbl_video where judul like '%$artikel%' or keterangan like '%$artikel%' order by id desc limit $start,$limit";
				}else {
					$sql = "select * from tbl_video order by id desc limit $start,$limit";
				}
	    	$query = $this->db->query($sql);
	    	
	    	foreach($query->result() as $row) {
	    			$videoall="Video 1:".$row->file_flv." ,Video 2:".$row->file_flv2." ,Video 3:".$row->file_flv3." ,Video 4:".$row->file_flv4." ,Video 5:".$row->file_flv5." ,Video 6:".$row->file_flv2;
						$tmp .= '{"v_id":"'.base64_encode($row->id).'","id":"'.base64_encode($row->id).'","judul":'.json_encode($row->judul).',"tanggal":"'.$row->tanggal.'","id_kategori":"'.$row->id_kategori.'","videoall":"'.$videoall.'","file_flv":"'.$row->file_flv.'","file_flv2":"'.$row->file_flv2.'","file_flv3":"'.$row->file_flv3.'","file_flv4":"'.$row->file_flv4.'","file_flv5":"'.$row->file_flv5.'","file_flv6":"'.$row->file_flv6.'","file_flv7":"'.$row->file_flv7.'","filenameimage":"'.$row->image.'","filenamelogo":"'.$row->logo.'","image":"'.$row->image.'","logo":"'.$row->logo.'","link":"'.$row->link.'","keterangan":'.json_encode($row->keterangan).',"status_variety":"'.$row->status_variety.'","status_program":"'.$row->status_program.'","publish":"'.$row->status_video.'"},';
	    	}
	    	$query->free_result();
	    	$tmp = substr($tmp, 0, -1);
	    	echo $tmp;
	    	echo ']}';
		}

		public function jsoncategory()
		{
	    	if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
	    		$page 	= (isset($_GET['page'])) ? $_GET['page'] : 1;
	    		$start 	= (isset($_GET['start'])) ? $_GET['start'] : 0;
	    		$limit	= (isset($_GET['limit'])) ? $_GET['limit'] : 23;
	    	} else {
	    		$page 	= 1;
	    		$start 	= 0;
	    		$limit	= 23;
	    	}
							
				$sql = "select count(id) as total from tbl_video_kategori";			
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
				
				$sql = "select * from tbl_video_kategori order by id desc limit $start,$limit";
	    	$query = $this->db->query($sql);
	    	foreach($query->result() as $row) {
						$tmp .= '{"id":"'.$row->id.'","kategori":'.json_encode($row->kategori).'},';						
	    	}
	    	$query->free_result();
	    	$tmp = substr($tmp, 0, -1);
	    	
	    	echo $tmp;
	    	echo ']}';
		}	
		public function jsonitem($l_id="") 
		{			
				if (isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
					$l_id=trim($_REQUEST['id']);
				}else {
					$l_id="";
				}				
				if ($l_id == "") {
						echo "[{'judul':'','keterangan':'','publish':'0'}]";

				} else {
						$data=array();
						$l_id = base64_decode($l_id);
						$data = $this->videofiesta_model->getData($l_id);
						$data['v_id'] = base64_encode($data['id']);
						$data['publish']=$data['status_video'];
						$data['kategori']=$data['id_kategori'];
						$data['filenameimage']=$data['image'];						
						$data['filenamelogo']=$data['logo'];						
						$data['filenameimage_old']=$data['image'];						
						$data['filenamelogo_old']=$data['logo'];						
						if ($data['publish']=="" || $data['publish']=="0") {
							$data['publish'] = true;
						}else {
							if ($data['publish']==1) {	
								$data['publish'] = true;
							}else {
								$data['publish'] = false;
							}
						}						
						echo json_encode($data);
				}
		}		
	
		public function submitdata()
		{			
				if ($this->input->post('judul')) {
					$upload_dir = STATIC_PATH."images/videofiesta/"; //aslinya					
					$file_name_logo="";
					$file_name_image="";
					if (isset($_FILES['logo'])) {
						if ($_FILES['logo']) {
										$temp_name_logo = $_FILES['logo']['tmp_name'];
										$file_name_logo = $_FILES['logo']['name'];
										if (is_null($file_name_logo) || trim($file_name_logo)=="") {
											$file_name_logo="";
										}else {																					
											$file_name_logo=	str_replace(" ","-",strtolower($file_name_logo));
											$xfilename_logo = $upload_dir.$file_name_logo;											
											$result = move_uploaded_file($temp_name_logo, $xfilename_logo);											
										}
						}	
					}
					if (isset($_FILES['image'])) {
						if ($_FILES['image']) {
										$temp_name_image = $_FILES['image']['tmp_name'];
										$file_name_image = $_FILES['image']['name'];
										if (is_null($file_name_image) || trim($file_name_image)=="") {
											$file_name_image="";
										}else {																					
											$file_name_image=	str_replace(" ","-",strtolower($file_name_image));
											$xfilename_image = $upload_dir.$file_name_image;											
											$result = move_uploaded_file($temp_name_image, $xfilename_image);											
										}
						}	
					}
					
					$data_id = base64_decode($this->input->post('v_id'));
					
					if ($data_id == "")
						$this->videofiesta_model->addData($file_name_logo,$file_name_image);
					else
						$this->videofiesta_model->editData($file_name_logo,$file_name_image,$data_id);
						
					echo "{success: true}";
				}					
		    					
		}
		
	
		public function deletedata()
		{
				if ($this->input->post('postdata')) {
								//$upload_dir = ROOTBASEPATH."static/video/videofiesta/"; //aslinya				
								$upload_dir = STATIC_PATH."images/videofiesta/"; //aslinya						
								$data_id = $this->input->post('postdata');
								if ($data_id != "") {
										$data_id = base64_decode($data_id);
										$sql = "select image,logo from tbl_video where id=$data_id";
										$query = $this->db->query($sql);
										if ($query->num_rows() > 0) {
											$data = $query->row_array();
											if ($data['logo']!="") {
												@unlink($upload_dir.$data['logo']);
											}	
											if ($data['image']!="") {
												@unlink($upload_dir.$data['image']);
											}	
										}
										$sql = "delete from tbl_video where id=$data_id";
										$this->db->query($sql);	
										//echo $sql;										
								}
				}				
		}		

		public function publishdata()
		{
				if ($this->input->post('postdata')) {
						$set = $this->input->post('set');
						$data_id = $this->input->post('postdata');
						if ($data_id != "") $this->videofiesta_model->publishData(base64_decode($data_id),$set);
				}
		}				
}