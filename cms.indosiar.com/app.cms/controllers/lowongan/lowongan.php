<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lowongan extends CI_Controller {
	  public function __construct() { 
			parent::__construct();
	    $this->load->model('lowongan/lowongan_model'); 
	  }
	    
		public function index()
		{				
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('lowongan/lowongan_views', $viewVars);
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
					$sql = "select count(id) as total from ivmweb2009_lowongan where judul like '%$artikel%' or ringkasan like '%$artikel%' or konten like '%$artikel%'";			
				}else {
					$sql = "select count(id) as total from ivmweb2009_lowongan";			
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
					$sql = "select * from ivmweb2009_lowongan where judul like '%$artikel%' or ringkasan like '%$artikel%' or konten like '%$artikel%' order by id desc limit $start,$limit";
				}else {
					$sql = "select * from ivmweb2009_lowongan order by id desc limit $start,$limit";
				}
	    	$query = $this->db->query($sql);
	    	
	    	foreach($query->result() as $row) {
						$tmp .= '{"l_id":"'.base64_encode($row->id).'","id":"'.base64_encode($row->id).'","judul":'.json_encode($row->judul).',"url_slug":"'.$row->url_slug.'","ringkasan":'.json_encode($row->ringkasan).',"konten":'.json_encode($row->konten).',"tanggal":"'.$row->tanggal.'","publish":"'.$row->publish.'"},';
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
						echo "[{'judul':'','ringkasan':'','publish':'0'}]";

				} else {
						$data=array();
						$l_id = base64_decode($l_id);
						$data = $this->lowongan_model->getData($l_id);
						$data['l_id'] = base64_encode($data['id']);
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
					$data_id = base64_decode($this->input->post('l_id'));
					
					if ($data_id == "")
						$this->lowongan_model->addData();
					else
						$this->lowongan_model->editData($data_id);
						
					echo "{success: true}";
				}					
		    					
		}
		
	
		public function deletedata()
		{
				if ($this->input->post('postdata')) {
								$data_id = $this->input->post('postdata');
								if ($data_id != "") {
										$data_id = base64_decode($data_id);
										//echo $data_id;
										$sql = "delete from ivmweb2009_lowongan where id=$data_id";
										$this->db->query($sql);	
										echo $sql;
								}
				}				
		}		

		public function publishdata()
		{
				if ($this->input->post('postdata')) {
						$set = $this->input->post('set');
						$data_id = $this->input->post('postdata');
						if ($data_id != "") $this->lowongan_model->publishData(base64_decode($data_id),$set);
				}
		}				
}