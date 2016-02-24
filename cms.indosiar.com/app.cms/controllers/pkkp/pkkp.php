<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pkkp extends CI_Controller {
	  public function __construct() {
			parent::__construct();
			$this->load->model('pkkp/pkkp_model'); 
	  }
	    
		public function index()
		{				
				if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
				if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

				$this->load->model('modules');
				$viewVars = array();
				$viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
				$this->load->view('pkkp/pkkp_views', $viewVars);
		}
						
		public function submitdata()
		{			
					$upload_dir = STATIC_PATH."tmp/"; //aslinya					
					$file_name_excel="";
					$kategori=$this->input->post('pkkp');
					if (isset($_FILES['excel'])) {
						if ($_FILES['excel']) {
										$temp_name_excel = $_FILES['excel']['tmp_name'];
										$file_name_excel = $_FILES['excel']['name'];
										if (is_null($file_name_excel) || trim($file_name_excel)=="") {
											echo "{success: true}";
											exit();
										}else {																					
											$file_name_excel=	str_replace(" ","-",strtolower($file_name_excel));
											$xfilename_excel = $upload_dir.$file_name_excel;											
											$result = move_uploaded_file($temp_name_excel, $xfilename_excel);											
										}

										$fileExt	= substr($file_name_excel, strrpos($file_name_excel, '.') + 1);
										if ($fileExt != "xlsx") {
											echo "{success: false}";
											exit();
										}										
										$this->pkkp_model->submitData($file_name_excel,$kategori);											    																
						}	
					}					
		}
			
}