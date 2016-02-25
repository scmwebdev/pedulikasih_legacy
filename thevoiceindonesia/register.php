<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('thevoiceindonesia_model');
	}
	
	function index()
	{	
		$data['HTMLPageTitle'] = "Registrasi - The Voice Indonesia";
		$this->load->view('thevoiceindonesia/header', $data);
		$this->load->view('thevoiceindonesia/register', $data);
		$this->load->view('thevoiceindonesia/footer', $data);
	}
	
	function submit()
	{		
		if ($this->input->post()) {
    		$data = array();
    		$data['tanggal'] = date("Y-m-d H:i:s");
    		
    		$arrexclude = array('fotofile2','pernyataan','submitnow','recaptcha_challenge_field','recaptcha_response_field');
    		
    		foreach($this->input->post() as $key => $value) if (!in_array($key, $arrexclude)) $data[$key] = trim($this->input->post($key, TRUE));
    		
    		if ($data['nama_depan'] == "" || $data['nama_belakang'] == "" || $data['email'] == "" || $data['telp_rumah'] == "") {
    			echo "Semua field harus terisi";
    			exit;
    		}
    		
    		$this->load->helper('email');
    		if (!valid_email($data['email'])) {
    			echo "Invalid email address";
    			exit();
    		}
    		
    		require_once($this->config->item('ROOTBASEPATH').'phpx/recaptchalib.php');
    		$resp = recaptcha_check_answer(RECAPTCHA_PRIVATE_KEY,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
    	
    		if (!$resp->is_valid) {
    			echo "The Security Code wasn't entered correctly. Go back and try it again.";
    			exit();
    		}
    		
    		// cek existing email
    		/*$sql = "select id from thevoiceindonesia where email='".$data['email']."'";
    		$query = $this->db->query($sql);
    		if ($query->num_rows() > 0) {
    			echo "Email sudah terdaftar";
    			exit();
    		}
    		$query->free_result();*/
    		    		
    		$upload_dir = $this->config->item('PATH_ROOT_VIDEOS')."thevoiceindonesia/";
    		
    		$FILE_MIMES = array('video/mp4','video/3gp');
    		$FILE_EXTS  = array('.mp4','.3gp');
    		$max_video_size = 1024 * 1024 * 4;
    		
    		if ($_FILES['videofile']) {
    			$file_type = $_FILES['videofile']['type']; 
                $file_name = $_FILES['videofile']['name'];
                $file_size = $_FILES['videofile']['size'];
    		    $file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
    			$temp_name = $_FILES['videofile']['tmp_name'];
                $file_name = str_replace("\\","",$file_name);
                $file_name = str_replace("'","",$file_name);
    			$file_path = $upload_dir.$file_name;
    
    			if ($file_name == "") {
    				echo "File video harus tersedia";
    				exit;
    			} else {
                    if (!in_array($file_type, $FILE_MIMES) && !in_array($file_ext, $FILE_EXTS) ) {
                    	echo "Sorry, $file_name($file_type) is not allowed to be uploaded";
                    	exit();  	
                    }
    				
        			if ($file_size > $max_video_size) {
        				echo "Ukuran file $file_name lebih dari 4 MB";
        				exit();  	
        			}
    				
    				$file_name = time().$file_name;
    				$file_path = $upload_dir.$file_name;
    				
    			    $result = move_uploaded_file($temp_name, $file_path);
    			    if ($result == true) {
    			    } else {
    					switch ($_FILES['videofile']['error']) {  
    					    case 1:
                               print '<p> The file is bigger than this PHP installation allows</p>';
                               break;
                            case 2:
                               print '<p> The file is bigger than this form allows</p>';
                               break;
                            case 3:
                               print '<p> Only part of the file was uploaded</p>';
                               break;
                            case 4:
                               print '<p> No file was uploaded</p>';
                               break;
                     	}
                     	echo "Error upload file: $file_name($file_type)";
    					exit(); 
    				}
    			}
    		}
    		
    		$foto_dir = $this->config->item('PATH_ROOT_IMAGES')."thevoiceindonesia/";
    		
    		$FILE_MIMES = array('image/jpeg','image/jpg','image/png');
    		$FILE_EXTS  = array('.jpeg','.jpg','.png');
    		$max_photo_size = 1024 * 1024;
    		$foto_name1 = $foto_name2 = '';
    		
    		if ($_FILES['fotofile1']) {
    		    $file_type1 = $_FILES['fotofile1']['type']; 
    		    $foto_name1 = $_FILES['fotofile1']['name'];
    		    $file_size1 = $_FILES['fotofile1']['size'];
    		    $foto_ext1 = strtolower(substr($foto_name1,strrpos($foto_name1,".")));
    			$temp_name1 = $_FILES['fotofile1']['tmp_name'];
    		    $foto_name1 = str_replace("\\","",$foto_name1);
    		    $foto_name1 = str_replace("'","",$foto_name1);
    			$foto_path1 = $foto_dir.$foto_name1;
    
    			if ($foto_name1 == "") {
    				echo "Minimal 1 foto harus tersedia";
    				exit;
    			} else {
    			    if (!in_array($file_type1, $FILE_MIMES) && !in_array($foto_ext1, $FILE_EXTS) ) {
    					echo "Sorry, $foto_name1($file_type1) is not allowed to be uploaded";
    					exit();  	
    			    }
    				
    				if ($file_size1 > $max_photo_size) {
    					echo "Ukuran file $foto_name1 lebih dari 1 MB";
    					exit();  	
    				}
    				
    				$foto_name1 = time().$foto_name1;
    				$foto_path1 = $foto_dir.$foto_name1;
    				
    			    $result = move_uploaded_file($temp_name1, $foto_path1);
    			    if ($result == true) {
    			    } else {
    					switch ($_FILES['fotofile1']['error']) {  
    					    case 1:
                               print '<p> The file is bigger than this PHP installation allows</p>';
                               break;
                            case 2:
                               print '<p> The file is bigger than this form allows</p>';
                               break;
                            case 3:
                               print '<p> Only part of the file was uploaded</p>';
                               break;
                            case 4:
                               print '<p> No file was uploaded</p>';
                               break;
             	        }
             	        echo "Error upload file: $foto_name1($file_type1)";
    					exit(); 
    				}
    			}
    		}
    		
    		if (isset($_FILES['fotofile2'])) {
    		    $file_type2 = $_FILES['fotofile2']['type']; 
    		    $foto_name2 = $_FILES['fotofile2']['name'];
    		    $file_size2 = $_FILES['fotofile2']['size'];
    		    $foto_ext2 = strtolower(substr($foto_name2,strrpos($foto_name2,".")));
    			$temp_name2 = $_FILES['fotofile2']['tmp_name'];
    		    $foto_name2 = str_replace("\\","",$foto_name2);
    		    $foto_name2 = str_replace("'","",$foto_name2);
    			$foto_path2 = $foto_dir.$foto_name2;
    
    			if ($foto_name2 != "") {
    			    if (!in_array($file_type2, $FILE_MIMES) && !in_array($foto_ext2, $FILE_EXTS) ) {
    					echo "Sorry, $foto_name2($file_type2) is not allowed to be uploaded";
    					exit();  	
    			    }
    				
    				if ($file_size2 > $max_photo_size) {
    					echo "Ukuran file $foto_name2 lebih dari 1 MB";
    					exit();  	
    				}
    				
    				$foto_name2 = time().'2'.$foto_name2;
    				$foto_path2 = $foto_dir.$foto_name2;
    				
    			    $result = move_uploaded_file($temp_name2, $foto_path2);
    			    if ($result == true) {
    			    } else {
    					switch ($_FILES['fotofile2']['error']) {  
    					    case 1:
                               print '<p> The file is bigger than this PHP installation allows</p>';
                               break;
                            case 2:
                               print '<p> The file is bigger than this form allows</p>';
                               break;
                            case 3:
                               print '<p> Only part of the file was uploaded</p>';
                               break;
                            case 4:
                               print '<p> No file was uploaded</p>';
                               break;
             	        }
             	        echo "Error upload file: $foto_name2($file_type2)";
    					exit(); 
    				}
    			}
    		}
    		
			if ($foto_name1 == "" && $foto_name2 == "") {
				echo "Minimal 1 foto harus tersedia";
				exit;
			}
			
			$data['photo1'] = $foto_name1;
			$data['photo2'] = $foto_name2;
			$data['video'] = $file_name;
			
    		$DBW = $this->load->database('dbwrite', TRUE);
    		$DBW->insert('thevoiceindonesia', $data); 
    		
    		$no_registrasi = '';
    		
    		/*$data_id = $DBW->insert_id();
    		
    		switch (strlen($data_id)) {  
           		case 1:
                     $no_registrasi = 'WEB00000'.$data_id;
                     break;
                case 2:
                     $no_registrasi = 'WEB0000'.$data_id;
                     break;
                case 3:
                     $no_registrasi = 'WEB000'.$data_id;
                     break;
                case 4:
                     $no_registrasi = 'WEB00'.$data_id;
                     break;
                case 5:
                     $no_registrasi = 'WEB0'.$data_id;
                     break;
        		default:
                     $no_registrasi = 'WEB'.$data_id;
       	    }
        
            $video = $no_registrasi.$file_ext;
            rename($file_path, $upload_dir.$video);
        
            $foto1 = $no_registrasi.$foto_ext1;
            rename($foto_path1, $foto_dir.$foto1);
        
            if ($foto_name2 == '') 
                $foto2 = '';
            else {
                $foto2 = $no_registrasi.'-2'.$foto_ext2;
                rename($foto_path2, $foto_dir.$foto2);
            }
                        
            $sql = "update thevoiceindonesia set no_registrasi='$no_registrasi',video='$video',photo1='$foto1',photo2='$foto2' where id=$data_id";
            $DBW->query($sql);*/   
    
    		die("SUKSES|$no_registrasi");
    	}
	}
}