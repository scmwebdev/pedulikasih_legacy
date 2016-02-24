<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Video extends CI_Controller {
	public function __construct() {
        parent::__construct();
	    $this->load->model('thevoiceindonesia/video_model');
	}
	    
	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

		$this->load->model('modules');
		$viewVars = array();
		$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
		$viewVars['kategori'] = $this->video_model->get_kategori();
		$this->load->view('thevoiceindonesia/video_views', $viewVars);
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
	   
	   echo $this->video_model->json($kategori,$keyword,$start,$limit,$page);
	}
		
    public function jsonitem() 
    {
        $data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
        $data = $this->video_model->getData($data_id);
        //$data['id'] = $data['id'];
        echo json_encode($data);
    }
			
    public function submitdata()
    {
        if ($this->input->post('judul')) $this->video_model->submit_data($this->input->post());
    }
		
	public function deletedata()
	{
		if ($this->input->post('postdata')) {
            $this->video_model->deleteData(base64_decode($this->input->post('postdata')));
		}
	}  
}