<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Photo extends CI_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('thevoiceindonesia/photo_model');
		$this->load->model('modules'); 
    }
	    
    public function index()
    {
		$this->load->model('modules');
		$viewVars = array();
		$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
		$viewVars['kategori'] = $this->photo_model->get_kategori();
		$this->load->view('thevoiceindonesia/photo_views', $viewVars);
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
	   $kategori= (isset($_GET['kategori'])) ? $_GET['kategori'] : "";
	   if ($kategori == 'null') $kategori = '';
	   
	   echo $this->photo_model->json($kategori,$keyword,$start,$limit,$page);
    }  
	
	// Function selected Image
    public function jsonitem() 
    {
        $data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
        $data = $this->photo_model->getData($data_id);
        //$data['id'] = $data['id'];
        echo json_encode($data);
    }
		
    public function deletedata()
    {
			if ($this->input->post('postdata')) {
				$headline = 'headline';
				$photo = 'photo';                    
				$thumbnail = 'thumbnail';                    
				
				$data = $this->photo_model->getData($this->input->post('postdata'));
				
				if($data['big_image']!="") @unlink(STATIC_PATH.$photo.'/'.$data['big_image']);
				if($data['thmb_image']!="") @unlink(STATIC_PATH.$thumbnail.'/'.$data['thmb_image']);
				if($data['headline_image']!="") @unlink(STATIC_PATH.$headline.'/'.$data['headline_image']);
				if($data['medium_image']!="") @unlink(STATIC_PATH.'medium/'.$data['headline_image']);
				
				$this->photo_model->deleteData($this->input->post('postdata'));
			}
    }

    public function submitdata()
    {
        if ($this->input->post('judul')) $this->photo_model->submit_data($this->input->post());
    }
}