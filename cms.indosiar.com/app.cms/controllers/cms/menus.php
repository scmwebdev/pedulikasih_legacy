<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menus extends CI_Controller {
	  public function __construct() {
				parent::__construct();
		    $this->load->model('menus_model'); 
	  }
	    
		public function index()
		{
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('cms/menus', $viewVars);
		}
		
		public function json()
		{
	    	if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
		    		$page 	= (isset($_GET['page'])) ? $_GET['page'] : 1;
		    		$start 	= (isset($_GET['start'])) ? $_GET['start'] : 0;
		    		$limit	= (isset($_GET['limit'])) ? $_GET['limit'] : 50;
	    	} else {
		    		$page 	= 1;
		    		$start 	= 0;
		    		$limit	= 50;
	    	}
				
				$keyword = (isset($_GET['q'])) ? $_GET['q'] : "";
	    	
	    	echo $this->menus_model->json($keyword,$start,$limit,$page);
		}
		
		public function jsonitem() 
		{
				$data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
				
				//$data_id = base64_decode($data_id);
				$data = $this->menus_model->getData($data_id);
				$data['id_label'] = $data['id'];
				if ($data['desc'] == "") $data['desc'] = $data['name'];
				echo json_encode($data);
		}
		
		public function jsonicon()
		{
				$dir = FCPATH.'assets/images/icons/';
				$images = array();
				$d = dir($dir);
				while($name = $d->read()){
				    if(!preg_match('/\.(png)$/', $name)) continue;
				    $size = filesize($dir.$name);
				    $lastmod = filemtime($dir.$name)*1000;
				    $images[] = array('name'=>substr($name, 0, -4), 'filename'=>$name);
				}
				$d->close();
				$o = array('images'=>$images);
				echo json_encode($o);
		}
		
		public function submitdata()
		{			
				if ($this->input->post('title')) {
					$data_id = $this->input->post('id');
					
					if ($data_id == "")
						$this->menus_model->addData();
					else
						$this->menus_model->editData($data_id);
						
					echo "{success: true}";
				}
		}
		
		public function deletedata()
		{
				if ($this->input->post('postdata')) {
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->menus_model->deleteData($data_id);
				}
		}
		
		public function publishdata()
		{
				if ($this->input->post('postdata')) {
						$set = $this->input->post('set');
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->menus_model->publishData($data_id,$set);
				}
		}
}