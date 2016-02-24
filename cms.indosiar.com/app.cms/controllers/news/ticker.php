<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticker extends CI_Controller {
    public function __construct() {
	    parent::__construct();
	    $this->load->model('news/ticker_model'); 
	}
	    
	public function index()
	{
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
		if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

		$this->load->model('modules');
		$viewVars = array();
		$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
		$this->load->view('news/ticker_views', $viewVars);
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
			$jenis_id = (isset($_GET['jenisid'])) ? $_GET['jenisid'] : "";
	    	
	    	echo $this->ticker_model->json($keyword,$jenis_id,$start,$limit,$page);
	}
	
		public function jsonitem() 
		{
				$data_id	= (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
				$data = $this->ticker_model->getData($data_id);
				echo json_encode($data);
		}
		
		public function jsonmaincontent()
		{	    	
	    	$data = $this->ticker_model->jsonmaincontent();
	    	echo json_encode($data);
		}
		
		public function submitdata()
		{			
				if ($this->input->post('judul')) {
						$this->ticker_model->submitData();							
						echo "{success: true}";
				}
		}
		
		public function deletedata()
		{
				if ($this->input->post('postdata')) {
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->ticker_model->deleteData($data_id);
				}
		}
		
		public function publishdata()
		{
				if ($this->input->post('postdata')) {
						$set = $this->input->post('set');
						$arrdata = explode("|", $this->input->post('postdata'));
						foreach($arrdata as $data_id) if ($data_id != "") $this->ticker_model->publishData($data_id,$set);
				}
		}
		
		public function generatedata()
		{
				if ($this->input->post('postdata')) {
                        //return file_get_contents('http://devil.cms.scm.co.id/newsticker/indosiar_ticker.php');
                        echo $this->_curl('http://devil.cms.scm.co.id/newsticker/indosiar_ticker.php');
				}
		}
		
        function _curl($url,$data="",$ref="") {
            if ($ref == "")     $ref = 'http://www.google.com/';
                       
            $ch = curl_init($url);
            
            if ($data != "") {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)");
            curl_setopt($ch, CURLOPT_REFERER, $ref);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        
            $source = curl_exec($ch);
            
            curl_close($ch);
    
            return $source;
        }
}