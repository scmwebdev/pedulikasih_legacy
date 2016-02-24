<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Slideshow_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function json() {
        $data = array();
        $sql = "select * from investor_slideshow order by publish desc, urutan asc";
        $query = $this->db->query($sql);
        $data  = $query->result_array();
        $query->free_result();
        
        return json_encode($data);
	}
		
    function getData($data_id) {
		$sql = "select * from investor_slideshow where id=$data_id";
		$query = $this->db->query($sql);
		$data = $query->row_array();				
		$query->free_result();
		
		return $data;
    }
    
		
    function submitData() {
		$image_name	= $this->input->post('image');
		
		$FILE_MIMES = array('image/jpeg','image/jpg','image/gif','image/png');
		$FILE_EXTS  = array('.jpeg','.jpg','.png','.gif');
				
		$upload_dir = STATIC_PATH.'images/investor/slideshow/';
		if (!file_exists($upload_dir)) mkdir($upload_dir);

		if ($_FILES['image_file']['name'] != "") {
			$file_type = $_FILES['image_file']['type']; 
			$file_name = $_FILES['image_file']['name'];
			$temp_name = $_FILES['image_file']['tmp_name'];
			$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
				
			if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
				$file_name = date("Ymd-His").$file_ext;
				$file_path = $upload_dir.$file_name;
				$result = move_uploaded_file($temp_name, $file_path);
				if ($result == true) {
					$image_name = $file_name;
				} else {
					die('ERROR UPLOAD IMAGE');
				}
			} else {
				die('INVALID MIME or EXTENSION');
			}
		}
		
		$data = array(
					  'link'	    => $this->input->post('link'),
					  'urutan'		=> $this->input->post('urutan'),
					  'image'		=> $image_name,
					  'keterangan'	=> $this->input->post('keterangan'),
					  'publish'	=> $this->input->post('publish')
				);

		$data_id = $this->input->post('id');
		
		if ($data_id == "") {
			$this->db->insert('investor_slideshow', $data);
		} else {
			$this->db->where('id', $data_id);
			$this->db->update('investor_slideshow', $data);
		}
    }
		
	function deleteData($data_id) {
		$sql = "delete from investor_slideshow where id=$data_id";
		$this->db->query($sql);
	}

	function publishData($data_id,$set) {
		$sql = "update investor_slideshow set status=$set where id=$data_id";
		$this->db->query($sql);
	}
}