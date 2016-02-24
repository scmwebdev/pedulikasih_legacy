<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Galeri extends CI_Controller {
	  public function __construct() {
			parent::__construct();
		    $this->load->model('kitapeduli/galeri_model'); 
	  }
	    
	  public function index()
	  {
			//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
			//if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);
	  
			$this->load->model('modules');
			$viewVars = array();
			$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
			$this->load->view('kitapeduli/galeri_views', $viewVars);
	  }
	  
	  public function json()
	  {	    	
			echo $this->galeri_model->json();
	  }
  
	  public function jsonitem() 
	  {
			  $data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
			  $data = $this->galeri_model->getData($data_id);
			  echo json_encode($data);
	  }
	  
	  public function jsonimage()
	  {	    	
		  $id_album	= (isset($_GET['id_album'])) ? $_GET['id_album'] : "";
		  echo $this->galeri_model->jsonImage($id_album);
	  }
	  
	  public function jsonimageitem() 
	  {
			  $data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
			  $data = $this->galeri_model->getImage($data_id);
			  echo json_encode($data);
	  }
	  
      public function jsonvideo()
	  {	    	
		  $id_album	= (isset($_GET['id_album'])) ? $_GET['id_album'] : "";
		  echo $this->galeri_model->jsonVideo($id_album);
	  }
	  
	  public function jsonvideoitem() 
	  {
			  $data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
			  $data = $this->galeri_model->getVideo($data_id);
			  echo json_encode($data);
	  }
	  
	  public function submitdata()
	  {			
			  if ($this->input->post('judul')) {
					  $this->galeri_model->submitData();							
					  echo "{success: true}";
			  }
	  }
	  
	  public function submitimage()
	  {			
			if ($this->input->post('id_album')) {
				$this->galeri_model->submitImage();
				echo "{success: true}";
			} else {
				print_r($_POST);
			}
	  }
	  
	  public function submitvideo()
	  {			
			if ($this->input->post('id_album')) {
				$this->galeri_model->submitVideo();
				echo "{success: true}";
			} else {
				print_r($_POST);
			}
	  }
	  
	  public function deletedata()
	  {
			  if ($this->input->post('postdata')) {
					  $arrdata = explode("|", $this->input->post('postdata'));
					  foreach($arrdata as $data_id) if ($data_id != "") $this->galeri_model->deleteData($data_id);
			  }
	  }
	  
	  public function deleteimage()
	  {
			  if ($this->input->post('postdata')) {
					  $arrdata = explode("|", $this->input->post('postdata'));
					  foreach($arrdata as $data_id) if ($data_id != "") $this->galeri_model->deleteImage($data_id);
			  }
	  }
	  
	  public function deletevideo()
	  {
			  if ($this->input->post('postdata')) {
					  $arrdata = explode("|", $this->input->post('postdata'));
					  foreach($arrdata as $data_id) if ($data_id != "") $this->galeri_model->deleteVideo($data_id);
			  }
	  }
	  
	  public function publishdata()
	  {
			  if ($this->input->post('postdata')) {
					  $set = $this->input->post('set');
					  $arrdata = explode("|", $this->input->post('postdata'));
					  foreach($arrdata as $data_id) if ($data_id != "") $this->galeri_model->publishData($data_id,$set);
			  }
	  }
}