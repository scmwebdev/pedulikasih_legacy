<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		redirect();exit;

		$data['HTMLPageTitle'] = "Registrasi - Akademi Fantasi Indosiar";
		$this->load->view('afi2013/header', $data);
		$this->load->view('afi2013/register', $data);
		$this->load->view('afi2013/footer', $data);
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

			$file_foto = $file_video = '';

			//$foto_dir 	= "/san/static/indosiar.com/afi2013/registrasi/";
			$foto_dir 	= "/srv/www/uploads/afi2013/";

			$FILE_MIMES = array('image/jpeg','image/jpg','image/png');
			$FILE_EXTS  = array('.jpeg','.jpg','.png');

			//if (!file_exists("/san/static/indosiar.com/afi2013")) mkdir("/san/static/indosiar.com/afi2013");
			//if (!file_exists("/san/static/indosiar.com/afi2013/registrasi")) mkdir("/san/static/indosiar.com/afi2013/registrasi");

			if (!file_exists("/srv/www/uploads/afi2013")) mkdir("/srv/www/uploads/afi2013");

			if ($_FILES['file_foto']) {
				$file_type 		= $_FILES['file_foto']['type'];
				$file_foto 	    = $_FILES['file_foto']['name'];
				$file_size 		= $_FILES['file_foto']['size'];
				$foto_ext 		= strtolower(substr($file_foto,strrpos($file_foto,".")));
				$temp_name 		= $_FILES['file_foto']['tmp_name'];
				$file_foto 	    = str_replace("\\","",$file_foto);
				$file_foto 	    = str_replace("'","",$file_foto);
				$foto_path 		= $foto_dir.$file_foto;

				if ($file_foto == "") die("File foto harus tersedia");

				if (!in_array($file_type, $FILE_MIMES) && !in_array($foto_ext, $FILE_EXTS) ) {
					echo "Sorry, $file_foto($file_type) is not allowed to be uploaded";
					exit();
				}

				if ($file_size > 8388608) {
					echo "Ukuran file $file_foto lebih dari 8 MB";
					exit();
				}

				$file_foto	    = time().$file_foto;
				$foto_path 		= $foto_dir.$file_foto;

				$result 		= move_uploaded_file($temp_name, $foto_path);
			}

			$FILE_MIMES = array('video/mp4','video/3gp');
			$FILE_EXTS  = array('.mp4','.3gp');

			if ($_FILES['file_video']) {
				$file_type 	= $_FILES['file_video']['type'];
				$file_video = $_FILES['file_video']['name'];
				$file_size 	= $_FILES['file_video']['size'];
				$foto_ext 	= strtolower(substr($file_video,strrpos($file_video,".")));
				$temp_name 	= $_FILES['file_video']['tmp_name'];
				$file_video = str_replace("\\","",$file_video);
				$file_video = str_replace("'","",$file_video);
				$foto_path 	= $foto_dir.$file_video;

				if ($file_video == "") die("File video harus tersedia");

				if (!in_array($file_type, $FILE_MIMES) && !in_array($foto_ext, $FILE_EXTS) ) {
					echo "Sorry, $file_video($file_type) is not allowed to be uploaded";
					exit();
				}

				if ($file_size > 10485760) {
					echo "Ukuran file $file_video lebih dari 10 MB";
					exit();
				}

				$file_video 		= time().$file_video;
				$foto_path 	= $foto_dir.$file_video;

				$result 	= move_uploaded_file($temp_name, $foto_path);
			}

			if ($file_foto == '') die("Foto harus diunggah");
			if ($file_video == '') die("Video harus diunggah");

			$data = array();

			foreach($this->db->list_fields('afi2013_registrasi') as $row) if (isset($_POST[$row])) $data[$row] = trim($_POST[$row]);

			$data['tanggal'] 		= date("Y-m-d H:i:s");

			$data['file_foto'] 	= $file_foto;
			$data['file_video'] = $file_video;

			$this->db->insert('afi2013_registrasi', $data);

			echo 'SUKSES';
		}
	}
}