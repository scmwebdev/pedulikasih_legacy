<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{	
		redirect('aksi');
		
		//if (isset($_POST)) {
			$data['HTMLPageTitle'] = "Registrasi - Akademi Sahur Indonesia";
			$this->load->view('aksi/header', $data);
			$this->load->view('aksi/register', $data);
			$this->load->view('aksi/footer', $data);
		//} else
		//	redirect('aksi');
	}
	
	function submit()
	{		
		if ($this->input->post('nama_lengkap', TRUE)) {
			require_once($this->config->item('ROOTBASEPATH').'phpx/recaptchalib.php');
			$resp = recaptcha_check_answer(RECAPTCHA_PRIVATE_KEY,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		
			if (!$resp->is_valid) {
				echo "The Security Code wasn't entered correctly. Go back and try it again.";
				exit();
			}		
			
			/*
			$foto_closeup = $foto_full = $video = '';
			
			$foto_dir 	= "/san/static/indosiar.com/aksi/registrasi/";
			$FILE_MIMES = array('image/jpeg','image/jpg','image/png');         
			$FILE_EXTS  = array('.jpeg','.jpg','.png');
			
			if (!file_exists("/san/static/indosiar.com/aksi")) mkdir("/san/static/indosiar.com/aksi");
			if (!file_exists("/san/static/indosiar.com/aksi/registrasi")) mkdir("/san/static/indosiar.com/aksi/registrasi");
			
			if ($_FILES['foto_closeup']) {
				$file_type 		= $_FILES['foto_closeup']['type']; 
				$foto_closeup 	= $_FILES['foto_closeup']['name'];
				$file_size 		= $_FILES['foto_closeup']['size'];
				$foto_ext 		= strtolower(substr($foto_closeup,strrpos($foto_closeup,".")));
				$temp_name 		= $_FILES['foto_closeup']['tmp_name'];
				$foto_closeup 	= str_replace("\\","",$foto_closeup);
				$foto_closeup 	= str_replace("'","",$foto_closeup);
				$foto_path 		= $foto_dir.$foto_closeup;
	
				if ($foto_closeup == "") die("File foto harus tersedia");

				if (!in_array($file_type, $FILE_MIMES) && !in_array($foto_ext, $FILE_EXTS) ) {
					echo "Sorry, $foto_closeup($file_type) is not allowed to be uploaded";
					exit();  	
				}
					
				if ($file_size > 8388608) {
					echo "Ukuran file $foto_closeup lebih dari 8 MB";
					exit();  	
				}

				$foto_closeup	= time().$foto_closeup;
				$foto_path 		= $foto_dir.$foto_closeup;
					
				$result 		= move_uploaded_file($temp_name, $foto_path);
			}
			
			if ($_FILES['foto_full']) {
				$file_type 	= $_FILES['foto_full']['type']; 
				$foto_full 	= $_FILES['foto_full']['name'];
				$file_size 	= $_FILES['foto_full']['size'];
				$foto_ext 	= strtolower(substr($foto_full,strrpos($foto_full,".")));
				$temp_name 	= $_FILES['foto_full']['tmp_name'];
				$foto_full 	= str_replace("\\","",$foto_full);
				$foto_full 	= str_replace("'","",$foto_full);
				$foto_path 	= $foto_dir.$foto_full;
	
				if ($foto_full == "") die("File foto harus tersedia");

				if (!in_array($file_type, $FILE_MIMES) && !in_array($foto_ext, $FILE_EXTS) ) {
					echo "Sorry, $foto_full($file_type) is not allowed to be uploaded";
					exit();  	
				}

				if ($file_size > 8388608) {
					echo "Ukuran file $foto_full lebih dari 8 MB";
					exit();  	
				}

				$foto_full 	= time().$foto_full;
				$foto_path 	= $foto_dir.$foto_full;

				$result 	= move_uploaded_file($temp_name, $foto_path);
			}
			
			$FILE_MIMES = array('video/mp4','video/3gp');         
			$FILE_EXTS  = array('.mp4','.3gp');
		
			if ($_FILES['video']) {
				$file_type 	= $_FILES['video']['type']; 
				$video 		= $_FILES['video']['name'];
				$file_size 	= $_FILES['video']['size'];
				$foto_ext 	= strtolower(substr($video,strrpos($video,".")));
				$temp_name 	= $_FILES['video']['tmp_name'];
				$video 		= str_replace("\\","",$video);
				$video 		= str_replace("'","",$video);
				$foto_path 	= $foto_dir.$video;
	
				if ($video == "") die("File video harus tersedia");

				if (!in_array($file_type, $FILE_MIMES) && !in_array($foto_ext, $FILE_EXTS) ) {
					echo "Sorry, $video($file_type) is not allowed to be uploaded";
					exit();  	
				}
					
				if ($file_size > 10485760) {
					echo "Ukuran file $video lebih dari 10 MB";
					exit();  	
				}
					
				$video 		= time().$video;
				$foto_path 	= $foto_dir.$video;
					
				$result 	= move_uploaded_file($temp_name, $foto_path);
			}
			
			if ($foto_closeup == '' || $foto_full == '') die("Semua foto harus diunggah");
			if ($video == '') die("Video harus diunggah");*/
			
			$data = array();
			
			foreach($this->db->list_fields('aksi_registrasi') as $row) if (isset($_POST[$row])) $data[$row] = trim($_POST[$row]);
			if (trim($_POST['ukuran_baju_lainnya']) != '') $data['ukuran_baju'] = trim($_POST['ukuran_baju_lainnya']);
			
			$data['tanggal'] 		= date("Y-m-d H:i:s");
			
			//$data['foto_closeup'] 	= $foto_closeup;
			//$data['foto_full'] 		= $foto_full;
			//$data['video'] 			= $video;
			
			$this->db->insert('aksi_registrasi', $data);
			
			echo 'SUKSES';
		}
	}
}