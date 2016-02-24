<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Video_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->DBW = $this->load->database('db_thevoiceindonesia_www_write', TRUE);
    }
    
    function json($kategori,$keyword,$start,$limit,$page) {
        if ($kategori != '') $kategori = 'AND id_kategori='.$kategori;
        if ($keyword == "")
            $sql = "select count(id) as total from video WHERE publish=1 $kategori";
        else
            $sql = "select count(id) as total from video where publish=1 AND judul like '%$keyword%' $kategori";
        
        $query = $this->DBW->query($sql);
        
        if ($query->num_rows() == 0) {
            $json = '{"success":true, "results":0, "rows": []}';
            $query->free_result();
        } else {
            $row = $query->row();
            $total = $row->total;
            $query->free_result();
            
            $json = '{"success":true,"results":'.$total.',"rows":';
            
            if ($keyword == "")
                $sql = "select * from video WHERE publish=1 $kategori order by id desc limit $start,$limit";
            else
                $sql = "select * from video WHERE publish=1 AND judul like '%$keyword%' $kategori order by id desc limit $start,$limit";
            
            $data = $this->DBW->query($sql)->result_array();

            $json .= json_encode($data);
            $json .= '}';
        }
        
        return $json;
    }

    function get_kategori() {
        return $this->DBW->order_by("sort")->get_where('video_kategori', array('publish' => 1))->result_array();
    }
    
    function submit_data($data) {
        $data_id            = $data['id'];
        $data['tanggal']    = date("Y-m-d H:i:s");
        $data['judul_url']  = url_title($data['judul'], '-', TRUE);

		$upload_dir = STATIC_PATH.'thevoiceindonesia/video/';
		//if (!file_exists($upload_dir)) mkdir($upload_dir);
        
		$FILE_MIMES = array('video/mp4','video/x-flv');
		$FILE_EXTS  = array('.mp4','.flv');
				
        if ($_FILES['video_file']['name'] != "") {
            $file_type = $_FILES['video_file']['type'];
            $file_name = $_FILES['video_file']['name'];
			$temp_name = $_FILES['video_file']['tmp_name'];
			$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
				
			if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
                //$file_name = $judul_url.'_'.$data_id.'_artikel'.$file_ext;
				$file_path = $upload_dir.$file_name;
                $result = move_uploaded_file($temp_name, $file_path);
				if ($result == true) $data['video'] = $file_name;
            }
		}
		
		$FILE_MIMES = array('image/jpeg','image/jpg','image/gif','image/png');
		$FILE_EXTS  = array('.jpeg','.jpg','.png','.gif');

		if ($_FILES['image_thumb_file']['name'] != "") {
            $file_type = $_FILES['image_thumb_file']['type'];
            $file_name = $_FILES['image_thumb_file']['name'];
			$temp_name = $_FILES['image_thumb_file']['tmp_name'];
			$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
				
			if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
                //$file_name = $judul_url.'_'.$data_id.'_artikel'.$file_ext;
				$file_path = $upload_dir.'thumb/'.$file_name;
                $result = move_uploaded_file($temp_name, $file_path);
				if ($result == true) $data['image_thumb'] = $file_name;
            }
		}

		if ($_FILES['image_medium_file']['name'] != "") {
            $file_type = $_FILES['image_medium_file']['type']; 
            $file_name = $_FILES['image_medium_file']['name'];
			$temp_name = $_FILES['image_medium_file']['tmp_name'];
			$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
				
			if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
                //$file_name = $judul_url.'_'.$data_id.'_artikel'.$file_ext;
				$file_path = $upload_dir.'medium/'.$file_name;
                $result = move_uploaded_file($temp_name, $file_path);
				if ($result == true) $data['image_medium'] = $file_name;
            }
		}
		
		if ($_FILES['image_big_file']['name'] != "") {
            $file_type = $_FILES['image_big_file']['type']; 
            $file_name = $_FILES['image_big_file']['name'];
			$temp_name = $_FILES['image_big_file']['tmp_name'];
			$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
				
			if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
                //$file_name = $judul_url.'_'.$data_id.'_artikel'.$file_ext;
				$file_path = $upload_dir.'big/'.$file_name;
                $result = move_uploaded_file($temp_name, $file_path);
				if ($result == true) $data['image_big'] = $file_name;
            }
		}
			
        if($data_id == '') {
            $this->DBW->insert('video', $data);
        } else {
            $this->DBW->where('id', $data_id);
            $this->DBW->update('video', $data); 
        }
        
        echo "{success: true}";
    }
    
    function deletedata($data_id) {
        $sql = "delete from video where id=$data_id";
        $this->DBW->query($sql);
    }
		
    function getData($data_id) {
        if (is_numeric($data_id)) {
            $sql = "select * from video where id=$data_id";
            $query = $this->DBW->query($sql);
            $data = $query->row_array();
            $query->free_result();
						
            return $data;
        }
    }
}