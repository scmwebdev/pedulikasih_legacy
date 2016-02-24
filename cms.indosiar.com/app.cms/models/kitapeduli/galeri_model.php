<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Galeri_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function submitData() {
		$judul_url  = $this->allfunction->judul2url($this->input->post('judul'));
		$tanggal    = $this->input->post('tanggal').' '.$this->input->post('tanggal_hh').':'.$this->input->post('tanggal_mn').':00';
		
		$data = array(
					'judul'			=>	$this->input->post('judul'),
					'judul_url'		=>	$judul_url,
					'isi'		    =>	$this->input->post('isi'),
					'ringkasan'		=>	$this->input->post('ringkasan'),
					'lokasi'		=>	$this->input->post('lokasi'),
					'lokasi_gmap'	=>	$this->input->post('lokasi_gmap'),
					'tanggal'		=>	$tanggal,
					'publish'		=>	$this->input->post('publish')
				);

		$data_id = $this->input->post('id');
		
		if ($data_id == "") {
			$this->db->insert('kitapeduli_album', $data);
			//$data_id = $this->db->insert_id();
		} else {
			$this->db->where('id', $data_id);
			$this->db->update('kitapeduli_album', $data);
		}
	}
		
	function submitImage() {
		$judul_url = $this->allfunction->judul2url($this->input->post('judul_album'));
		$image_name	= $this->input->post('image');
		
		$FILE_MIMES = array('image/jpeg','image/jpg','image/gif','image/png');
		$FILE_EXTS  = array('.jpeg','.jpg','.png','.gif');
		
		$upload_dir = STATIC_PATH.'images/kitapeduli/gallery/';
		if (!file_exists($upload_dir)) mkdir($upload_dir);

		if ($_FILES['image_file']['name'] != "") {
			$file_type = $_FILES['image_file']['type']; 
			$file_name = $_FILES['image_file']['name'];
			$temp_name = $_FILES['image_file']['tmp_name'];
			$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
				
			if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
				$file_name = $judul_url.'-'.time().$file_ext;
				$file_path = $upload_dir.$file_name;
				$result = move_uploaded_file($temp_name, $file_path);
				if ($result == true) {
					$this->load->library('image_lib');

					list($width, $height, $type, $attr) = getimagesize($file_path);
					
					$w 			= 150;
					$h 			= 110;
					$th_file 	= $upload_dir.'th_'.$file_name;
					
					$master_dim = ($width-$w < $height-$h) ? 'width' : 'height';
					$perc = max((100*$w)/$width , (100*$h)/$height);
					$perc = round($perc, 0);
					$w_d = round(($perc*$width)/100, 0);        
					$h_d = round(($perc*$height)/100, 0);
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $file_path;
					$config['new_image'] = $th_file;
					$config['maintain_ratio'] = TRUE;
					$config['master_dim'] = $master_dim;
					$config['width'] = $w_d + 1;
					$config['height'] = $h_d + 1;
					
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) die($this->image_lib->display_errors());
					$this->image_lib->clear(); 
					
					unset($config);
				
					list($width, $height, $type, $attr) = getimagesize($th_file);
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $th_file;
					$config['new_image'] = $th_file;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = $w;
					$config['height'] = $h;
					$config['y_axis'] = 0;
					$config['x_axis'] = round(($width-$w) / 2);
				
					$this->image_lib->initialize($config);
					if (!$this->image_lib->crop()) die($this->image_lib->display_errors());
					$this->image_lib->clear();
						
					$image_name = $file_name;
				} else {
					die('ERROR UPLOAD IMAGE');
				}
			} else {
				die('INVALID MIME or EXTENSION');
			}
		}
		
		$data = array(
					  'id_album'	=> $this->input->post('id_album'),
					  'urutan'		=> $this->input->post('urutan'),
					  'image'		=> $image_name,
					  'keterangan'	=> $this->input->post('keterangan'),
					  'tanggal'		=> date("Y-m-d H:i:s")
				);

		$data_id = $this->input->post('id');
		
		if ($data_id == "") {
			$this->db->insert('kitapeduli_album_foto', $data);
		} else {
			$this->db->where('id', $data_id);
			$this->db->update('kitapeduli_album_foto', $data);
		}
	}

    function submitVideo() {
		$judul_url      = $this->allfunction->judul2url($this->input->post('judul_album'));
		$video_url      = $this->input->post('video_url');
		$video_url_id   = (preg_match('@^(?:http://(?:www\.)?youtube.com/)(watch\?v=|v/)([a-zA-Z0-9_\-]*)@', $this->input->post('video_url'), $match)) ? $match[2] : '';
	
		$data = array(
					  'id_album'	    => $this->input->post('id_album'),
					  'urutan'		    => $this->input->post('urutan'),
					  'video_url'		=> $video_url,
					  'video_url_id'    => $video_url_id,
					  'keterangan'	    => $this->input->post('keterangan'),
					  'tanggal'		    => date("Y-m-d H:i:s")
				);

		$data_id = $this->input->post('id');
		
		if ($data_id == "") {
			$this->db->insert('kitapeduli_album_video', $data);
		} else {
			$this->db->where('id', $data_id);
			$this->db->update('kitapeduli_album_video', $data);
		}
	}
	
	function deleteData($data_id) {
		$total = $this->db->where('id_album',$data_id)->count_all_results('kitapeduli_album_foto');
		if ($total == 0) {
			$sql = "delete from kitapeduli_album where id=$data_id";
			$this->db->query($sql);
		}
	}

	function deleteImage($data_id) {
		$sql = "delete from kitapeduli_album_foto where id=$data_id";
		$this->db->query($sql);
	}
	
	function deleteVideo($data_id) {
		$sql = "delete from kitapeduli_album_video where id=$data_id";
		$this->db->query($sql);
	}
	
	function publishData($data_id,$set) {
		$sql = "update kitapeduli_album set status=$set where id=$data_id";
		$this->db->query($sql);
	}
	
	function getData($data_id) {
		$sql 	= "select * from kitapeduli_album where id=$data_id";
		$query 	= $this->db->query($sql);
		$data 	= $query->row_array();				
		$query->free_result();
		
		$tanggal_time 		= strtotime($data['tanggal']);
		$data['tanggal'] 	= date("Y-m-d", $tanggal_time);
		$data['tanggal_hh'] = date("G", $tanggal_time);
		$data['tanggal_mn'] = date("i", $tanggal_time);
		
		return $data;
	}

	function getImage($data_id) {
		$sql 	= "select * from kitapeduli_album_foto where id=$data_id";
		$query 	= $this->db->query($sql);
		$data 	= $query->row_array();				
		$query->free_result();
		
		return $data;
	}
	
	function getVideo($data_id) {
		$sql 	= "select * from kitapeduli_album_video where id=$data_id";
		$query 	= $this->db->query($sql);
		$data 	= $query->row_array();				
		$query->free_result();
		
		return $data;
	}

	function json() {
		$data 	= array();
		$sql 	= "select * from kitapeduli_album order by tanggal desc";
		$query 	= $this->db->query($sql);
		$data	= $query->result_array();
	  
		$query->free_result();
	  
		$data 	= json_encode($data);
		
		return $data;
	}
	
	function jsonImage($id_album) {
		$data 	= array();
		$sql 	= "select * from kitapeduli_album_foto where id_album='$id_album' order by urutan asc";
		$query 	= $this->db->query($sql);
		$data	= $query->result_array();
	  
		$query->free_result();
	  
		$data 	= json_encode($data);
		
		return $data;
	}
	
	function jsonVideo($id_album) {
		$data 	= array();
		$sql 	= "select * from kitapeduli_album_video where id_album='$id_album' order by urutan asc";
		$query 	= $this->db->query($sql);
		$data	= $query->result_array();
	  
		$query->free_result();
	  
		$data 	= json_encode($data);
		
		return $data;
	}
}