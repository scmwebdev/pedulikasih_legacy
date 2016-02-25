<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('galaxysuperstar_model');
		//redirect();
	}
	
	function index()
	{	
		$data['HTMLPageTitle'] = "Registrasi - Galaxy Superstar";
		$this->load->view('galaxysuperstar/galaxysuperstar_header', $data);
		$this->load->view('galaxysuperstar/galaxysuperstar_register', $data);
		$this->load->view('galaxysuperstar/galaxysuperstar_footer', $data);
	}
	
	function submit()
	{		
		redirect();
		/*$data = array();
		$data['tanggal'] = date("Y-m-d H:i:s");
		$data['pilihan_audisi_menyanyi'] = (isset($_POST['pilihan_audisi_menyanyi'])) ? trim($this->input->post('pilihan_audisi_menyanyi', TRUE)) : '';
		$data['pilihan_audisi_menari'] = (isset($_POST['pilihan_audisi_menari'])) ? trim($this->input->post('pilihan_audisi_menari', TRUE)) : '';
		$data['tgl_lahir'] = trim($this->input->post('tgl_lahir_yyyy', TRUE)).'-'.trim($this->input->post('tgl_lahir_mm', TRUE)).'-'.trim($this->input->post('tgl_lahir_dd', TRUE));
		$data['tgl_lahir_ortu_laki'] = trim($this->input->post('tgl_lahir_ortu_laki_yyyy', TRUE)).'-'.trim($this->input->post('tgl_lahir_ortu_laki_mm', TRUE)).'-'.trim($this->input->post('tgl_lahir_ortu_laki_dd', TRUE));
		$data['tgl_lahir_ortu_perempuan'] = trim($this->input->post('tgl_lahir_ortu_perempuan_yyyy', TRUE)).'-'.trim($this->input->post('tgl_lahir_ortu_perempuan_mm', TRUE)).'-'.trim($this->input->post('tgl_lahir_ortu_perempuan_dd', TRUE));
		
		$arrexclude = array('pilihan_audisi_menyanyi','pilihan_audisi_menari','submitnow','recaptcha_challenge_field','recaptcha_response_field','tgl_lahir_dd','tgl_lahir_mm','tgl_lahir_yyyy','tgl_lahir_ortu_laki_dd','tgl_lahir_ortu_laki_mm','tgl_lahir_ortu_laki_yyyy','tgl_lahir_ortu_perempuan_dd','tgl_lahir_ortu_perempuan_mm','tgl_lahir_ortu_perempuan_yyyy');
		
		foreach($this->input->post() as $key => $value) if (!in_array($key, $arrexclude)) $data[$key] = trim($this->input->post($key, TRUE));

    if (!is_numeric($data['pilihan_audisi_menyanyi_jml_group'])) $data['pilihan_audisi_menyanyi_jml_group'] = 0;
    if (!is_numeric($data['pilihan_audisi_menari_jml_group'])) $data['pilihan_audisi_menari_jml_group'] = 0;
    if (!is_numeric($data['pilihan_audisi_lainnya_jml_group'])) $data['pilihan_audisi_lainnya_jml_group'] = 0;
    
		if ($data['pilihan_audisi_menyanyi'] == "" && $data['pilihan_audisi_menari'] == "" && $data['pilihan_audisi_lainnya'] == "") {
			echo "Pilihan Audisi belum terisi";
			exit;
		}

		//if ($data['pilihan_audisi_menyanyi'] != "" && $data['pilihan_audisi_menari'] != "") {
		//	echo "Pilihan Audisi hanya boleh satu";
		//	exit;
		//}
		
		if ($data['nama_lengkap'] == "" || $data['nama_panggilan'] == "" || $data['email'] == "" || $data['no_telepon'] == "" || $data['kota_audisi'] == "") {
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
		$sql = "select id from galaxysuperstar where email='".$data['email']."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
				echo "Email sudah terdaftar";
				exit();
		}
		$query->free_result();
		
		$sql = "select id from galaxysuperstar where nomor_identitas='".$data['nomor_identitas']."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
				echo "Nomor Identitas sudah terdaftar";
				exit();
		}
		$query->free_result();
		
		$upload_dir = $this->config->item('PATH_ROOT_VIDEOS')."galaxysuperstar/";
		
		$FILE_MIMES = array('video/mp4','video/3gp');         
		$FILE_EXTS  = array('.mp4','.3gp');
		
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
				
				if ($file_size > 8388608) {
					echo "Ukuran file $file_name lebih dari 8 MB";
					exit();  	
				}
				
				$file_name = time().$file_name;
				$file_path = $upload_dir.$file_name;
				
			  $result = move_uploaded_file($temp_name, $file_path);
			  if ($result == true) {
			  	
				} else {
					switch ($_FILES['videofile']['error'])
         	{  case 1:
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
		
		$foto_dir = $this->config->item('PATH_ROOT_IMAGES')."galaxysuperstar/";
		
		$FILE_MIMES = array('image/jpeg','image/jpg','image/png');         
		$FILE_EXTS  = array('.jpeg','.jpg','.png');
		
		if ($_FILES['fotofile']) {
			$file_type = $_FILES['fotofile']['type']; 
		  $foto_name = $_FILES['fotofile']['name'];
		  $file_size = $_FILES['fotofile']['size'];
		  $foto_ext = strtolower(substr($foto_name,strrpos($foto_name,".")));
			$temp_name = $_FILES['fotofile']['tmp_name'];
		  $foto_name = str_replace("\\","",$foto_name);
		  $foto_name = str_replace("'","",$foto_name);
			$foto_path = $foto_dir.$foto_name;

			if ($foto_name == "") {
				echo "File foto harus tersedia";
				exit;
			} else {
			  if (!in_array($file_type, $FILE_MIMES) && !in_array($foto_ext, $FILE_EXTS) ) {
					echo "Sorry, $foto_name($file_type) is not allowed to be uploaded";
					exit();  	
			  }
				
				if ($file_size > 8388608) {
					echo "Ukuran file $foto_name lebih dari 8 MB";
					exit();  	
				}
				
				$foto_name = time().$foto_name;
				$foto_path = $foto_dir.$foto_name;
				
			  $result = move_uploaded_file($temp_name, $foto_path);
			  if ($result == true) {
			  	
				} else {
					switch ($_FILES['fotofile']['error'])
         	{  case 1:
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
         	echo "Error upload file: $foto_name($file_type)";
					exit(); 
				}
			}
		}
		
		$DBW = $this->load->database('dbwrite', TRUE);
		$DBW->insert('galaxysuperstar', $data); 
		
		$data_id = $DBW->insert_id();
		
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
    
    $foto = $no_registrasi.$foto_ext;
    rename($foto_path, $foto_dir.$foto);
    
    $sql = "update galaxysuperstar set no_registrasi='$no_registrasi',video='$video',photo='$foto' where id=$data_id";
    $DBW->query($sql);
    
    //kirim email
		$subject  = 'Registrasi Galaxy Superstar INDOSIAR';
		$message  = "Hallo ".$data['nama_lengkap'].",\r\n\r\nSelamat, Anda sudah terdaftar sebagai calon audisi untuk program acara Indosiar Galaxy Superstar.\r\n";
		$message .= "Silakan catat nomor registrasi di bawah ini:\r\n\r\n$no_registrasi\r\n\r\nBila terpilih kami akan menghubungi Anda untuk proses selanjutnya.\r\n\r\n";
		$message .= "Salam Hangat";

		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Galaxy Superstar INDOSIAR</title>
</head>
<body style="padding:0; margin:0; background:#ffffff">
<table width="100%" border="0" cellspacing="0" cellpadding="15" bgcolor="#ffffff">
	<tr>
		<td align="center" valign="top"><table width="580" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td align="center"><a href="http://www.indosiar.com"><img src="http://www.indosiar.com/assets/images/galaxysuperstar/logoemail.jpg" border="0" alt="INDOSIAR" /></a></td>
	        </tr>
		      </table></td>
	    </tr>
		  <tr>
		    <td style="font-size:0; line-height:0;">&nbsp;</td>
	    </tr>
		  <tr>
		    <td><br />
		      <table width="100%" border="0" cellspacing="0" cellpadding="0">
		        <tr>
		          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		            <tr>
		              <td><table width="100%" border="0" cellspacing="0" cellpadding="8" bgcolor="#efefef">
		                <tr>
		                  <td style="font-family: Arial; font-size:16px; line-height:16px; color:#000000; font-weight:bold; text-transform:uppercase; text-align:left; ">NOMOR REGISTRASI : '.$no_registrasi.'</td>
		                  </tr>
		                </table></td>
                </tr>
								<tr>
									<td align="right" style="color:#000000; font-size:11px; font-weight:bold; font-family:Arial; text-transform:uppercase;">'.date("l, d-F-Y").'</td>
        				</tr>
		            <tr>
		              <td><br />
		                <table width="100%" cellpadding="4" cellspacing="0">
		                  <tr>
		                    <td colspan="2"><div style="font-family: Arial; font-size:16px; line-height:14px; color:#000000; font-weight:bold; text-transform:uppercase; text-align:left; margin-top:15px; padding:10px 0px; border-bottom:3px solid #666666;">A. DATA PRIBADI</div></td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Nama Lengkap</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['nama_lengkap'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Nama Panggilan</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['nama_panggilan'].'</td>
	                    </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Usia</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['usia'].' Thn. </td>
	                    </tr>
	                    <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Jenis Kelamin</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['jenis_kelamin'].'</td>
	                    </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Tempat/Tgl. Lahir</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['tempat_lahir'].' / '.date("j-F-Y", strtotime($data['tgl_lahir'])).'</td>
	                    </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Identitas</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['jenis_identitas'].' / '.$data['nomor_identitas'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Pendidikan</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['pendidikan'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Alamat Sekolah</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['alamat_sekolah1'].'<br />
		                      '.$data['alamat_sekolah2'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Pekerjaan</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['pekerjaan'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" valign="top" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Alamat Tinggal</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['alamat1'].'<br />
		                      '.$data['alamat2'].'</td>
	                    </tr>
	                    <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">No. Telepon</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['no_telepon'].'</td>
	                    </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Email</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['email'].'</td>
	                      </tr>
		                  <tr>
		                    <td colspan="2"><div style="font-family: Arial; font-size:16px; line-height:14px; color:#000000; font-weight:bold; text-transform:uppercase; text-align:left; margin-top:15px; padding:10px 0px; border-bottom:3px solid #666666;">B. DATA ORANG TUA LAKI-LAKI</div></td>
	                    </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Nama</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['nama_ortu_laki'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Usia</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['usia_ortu_laki'].' Thn. </td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Tempat/Tgl. Lahir</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['tempat_lahir_ortu_laki'].' / '.date("j-F-Y", strtotime($data['tgl_lahir_ortu_laki'])).'</td>
	                      </tr>
		                  <tr>
		                    <td valign="top" width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Alamat Tinggal</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['alamat_ortu_laki1'].'<br />
		                      '.$data['alamat_ortu_laki2'].'</td>
	                      </tr>
		                  <tr>
		                    <td colspan="2"><div style="font-family: Arial; font-size:16px; line-height:14px; color:#000000; font-weight:bold; text-transform:uppercase; text-align:left; margin-top:15px; padding:10px 0px; border-bottom:3px solid #666666;">C. DATA ORANG TUA PEREMPUAN</div></td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Nama</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['nama_ortu_perempuan'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Usia</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['usia_ortu_perempuan'].' Thn. </td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Tempat/Tgl. Lahir</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['tempat_lahir_ortu_perempuan'].' / '.date("j-F-Y", strtotime($data['tgl_lahir_ortu_perempuan'])).'</td>
	                      </tr>
		                  <tr>
		                    <td valign="top width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Alamat Tinggal</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['alamat_ortu_perempuan1'].'<br />
		                      '.$data['alamat_ortu_perempuan2'].'</td>
	                      </tr>
		                  <tr>
		                    <td colspan="2"><div style="font-family: Arial; font-size:16px; line-height:14px; color:#000000; font-weight:bold; text-transform:uppercase; text-align:left; margin-top:15px; padding:10px 0px; border-bottom:3px solid #666666;">D. PRESTASI PRIBADI</div></td>
	                      </tr>
		                  <tr>
		                    <td colspan="2" style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.nl2br($data['prestasi_pribadi']).'</td>
	                      </tr>
		                  <tr>
		                    <td colspan="2"><div style="font-family: Arial; font-size:16px; line-height:14px; color:#000000; font-weight:bold; text-transform:uppercase; text-align:left; margin-top:15px; padding:10px 0px; border-bottom:3px solid #666666;">E. PILIHAN AUDISI</div></td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Menyanyi</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['pilihan_audisi_menyanyi'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">&nbsp;</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Jumlah Group: '.$data['pilihan_audisi_menyanyi_jml_group'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Menari</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['pilihan_audisi_menari'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">&nbsp;</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Jumlah Group: '.$data['pilihan_audisi_menari_jml_group'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;" valign="top">Lain-lain</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['pilihan_audisi_lainnya'].'</td>
	                      </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">&nbsp;</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Jumlah Group: '.$data['pilihan_audisi_lainnya_jml_group'].'</td>
	                    </tr>
		                  <tr>
		                    <td colspan="2"><div style="font-family: Arial; font-size:16px; line-height:14px; color:#000000; font-weight:bold; text-transform:uppercase; text-align:left; margin-top:15px; padding:10px 0px; border-bottom:3px solid #666666;">F. PILIHAN KOTA AUDISI</div></td>
	                    </tr>
		                  <tr>
		                    <td width="150" style="font-weight:bold; font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">Kota Audisi</td>
		                    <td style="font-family: Arial; font-size:12px; line-height:17px; text-align:left; color:#000000;">'.$data['kota_audisi'].'</td>
	                    </tr>
	                    <tr>
		                    <td colspan="2"><div style="font-family: Arial; font-size:16px; line-height:14px; color:#000000; font-weight:bold; text-transform:uppercase; text-align:left; margin-top:15px; padding:10px 0px; border-bottom:3px solid #666666;">G. TANDA TANGAN ORANG TUA / WALI</div></td>
	                    </tr>
		                  <tr>
		                    <td colspan="2" style="font-family: Arial; font-size:12px; line-height:17px; text-align:center; color:#000000;">
		                    <br /><br /><br /><br /><br /><br /><br /><br />
		                    (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
		                    </td>
	                    </tr>
	                    </table>
	                    <br /><br /><br />
	                   </td>
	                </tr>
		            </table></td>
	            </tr>
	          </table>
		      <br />
		      <br /></td>
	      </tr>
		  <tr>
		    <td><table width="100%" border="0" cellspacing="0" cellpadding="8" bgcolor="#efefef">
		      <tr>
		        <td style="font-family: Arial; font-size:10px; line-height:12px; text-align:center; color:#000000;">Silahkan print out formulir ini dan sertakan tanda tangan orang tua saat melakukan audisi dengan melampirkan pas photo 4R (1 lembar pas badan, 1 lembar close-up jika single atau duet), bersepatu dan berpakaian rapih .<br />
		          <br /><a href="http://www.indosiar.com" style="color:#333333; text-decoration:underline;" target="_blank">www.indosiar.com</a></td>
	          </tr>
		      </table></td>
	      </tr>
	    </table></td>
	</tr>
</table>
</body>
</html>';
    
		$this->load->library('email');
		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = '192.168.7.1';
		$config['smtp_port'] = '25';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		
		
		$this->email->initialize($config);

		$this->email->from('webadmin@indosiar.com', 'Galaxy Superstar INDOSIAR');
		$this->email->to($data['email']);
		
		$this->email->subject($subject);
		$this->email->message($message);
		
		$this->email->send();
		
		//echo $this->email->print_debugger();


		echo "SUKSES|$no_registrasi";*/
	}
}