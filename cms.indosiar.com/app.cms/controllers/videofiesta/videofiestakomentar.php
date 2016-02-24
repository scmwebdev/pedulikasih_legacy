<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Videofiestakomentar extends CI_Controller {
	  public function __construct() {
			parent::__construct();
	  }
	    
		public function index()
		{				
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('videofiesta/videofiesta_komentar_views', $viewVars);
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
					$sql = "select count(vk.id) as total from tbl_video_komentar as vk inner join tbl_video as tv on vk.id_video=tv.id where vk.komentar like '%$artikel%'";			
				}else {
					$sql = "select count(vk.id) as total from tbl_video_komentar as vk inner join tbl_video as tv on vk.id_video=tv.id";			
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
					$sql = "select vk.*,tv.judul from tbl_video_komentar as vk inner join tbl_video as tv on vk.id_video=tv.id where vk.komentar like '%$artikel%' or vk.nama like '%$artikel%' order by vk.id desc limit $start,$limit";
				}else {
					$sql = "select vk.*,tv.judul from tbl_video_komentar as vk inner join tbl_video as tv on vk.id_video=tv.id order by vk.id desc limit $start,$limit";
				}
	    	$query = $this->db->query($sql);
	    	
	    	foreach($query->result() as $row) {
						$tmp .= '{"vk_id":"'.base64_encode($row->id).'","id":"'.base64_encode($row->id).'","judulvideo":'.json_encode($row->judul).',"nama":'.json_encode($row->nama).',"tanggal":"'.$row->tanggal.'","ip":"'.$row->ip.'","komentar":'.json_encode($row->komentar).'},';
	    	}
	    	$query->free_result();
	    	$tmp = substr($tmp, 0, -1);
	    	echo $tmp;
	    	echo ']}';
		}

		public function deletedata()
		{
				if ($this->input->post('postdata')) {
								$data_id = $this->input->post('postdata');
								if ($data_id != "") {
										$data_id = base64_decode($data_id);
										$sql = "delete from tbl_video_komentar where id=$data_id";
										$this->db->query($sql);	
								}
				}				
		}		
		
}