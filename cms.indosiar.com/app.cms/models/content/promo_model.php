<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Promo_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function submitData() {
    		$promo_slug = $this->allfunction->judul2url($this->input->post('promo_judul'));
				$promo_image = $this->input->post('promo_image');
				$promo_video = $this->input->post('promo_video');

				if ($_FILES['promo_image_file']['name'] != "") {
						$this->load->library('image_lib');
						
						$file_type = $_FILES['promo_image_file']['type']; 
					  $file_name = $_FILES['promo_image_file']['name'];
						$temp_name = $_FILES['promo_image_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
						
						$upload_dir = STATIC_PATH.'images/promo/';
						$FILE_MIMES = array('image/jpeg','image/jpg','image/gif','image/png');
						$FILE_EXTS  = array('.jpeg','.jpg','.png','.gif');
				
						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $promo_slug.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) {
							  		list($width, $height, $type, $attr) = getimagesize($file_path);
										
										if ($width > 900) {	
												$config['image_library'] = 'gd2';
												$config['source_image'] = $file_path;
												$config['new_image'] = $file_path;
												$config['maintain_ratio'] = TRUE;
												$config['width'] = 900;
												$config['height'] = (900/$width)*$height;
												
												$this->image_lib->initialize($config);
												if (!$this->image_lib->resize()) die($this->image_lib->display_errors());
												$this->image_lib->clear(); 
												
												unset($config);
										}
										
							  		$promo_image = $file_name;
							  		
							  		// create thumb
							  		$file_path_new 	= $upload_dir.'th_'.$promo_slug.$file_ext;
							  		copy($file_path, $file_path_new);
							  		
							  		$file_path 			= $file_path_new;
							  		list($width, $height, $type, $attr) = getimagesize($file_path);
							  		
										$w = 150;
										$h = 170;
										
										if ($width != $w && $height != $h) {
												$master_dim = ($width-$w < $height-$h) ? 'width' : 'height';
												$perc = max((100*$w)/$width , (100*$h)/$height);
												$perc = round($perc, 0);
												$w_d = round(($perc*$width)/100, 0);
												$h_d = round(($perc*$height)/100, 0);
												
												$config['image_library'] = 'gd2';
												$config['source_image'] = $file_path;
												$config['new_image'] = $file_path;
												$config['maintain_ratio'] = TRUE;
												$config['master_dim'] = $master_dim;
												$config['width'] = $w_d + 1;
												$config['height'] = $h_d + 1;
												
												$this->image_lib->initialize($config);
												if (!$this->image_lib->resize()) die($this->image_lib->display_errors());
												$this->image_lib->clear(); 
												
												unset($config);
											
												list($width, $height, $type, $attr) = getimagesize($file_path);
												
												$config['image_library'] = 'gd2';
												$config['source_image'] = $file_path;
												$config['new_image'] = $file_path;
												$config['maintain_ratio'] = FALSE;
												$config['width'] = $w;
												$config['height'] = $h;
												$config['y_axis'] = 0;
												$config['x_axis'] = round(($width-$w) / 2);
											
												$this->image_lib->initialize($config);
												if (!$this->image_lib->crop()) die($this->image_lib->display_errors());
												$this->image_lib->clear();
												
												unset($config);
										}
							  }
						}
				}

				if ($_FILES['promo_video_file']['name'] != "") {						
						$file_type = $_FILES['promo_video_file']['type']; 
					  $file_name = $_FILES['promo_video_file']['name'];
						$temp_name = $_FILES['promo_video_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
						
						$upload_dir = STATIC_PATH.'video/promo/';
						$FILE_MIMES = array('video/mp4','video/x-flv');
						$FILE_EXTS  = array('.mp4','.flv');
				
						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $promo_slug.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) $promo_video = $file_name;
						}
				}
				
				$data = array(
					          'promo_judul'			=>	$this->input->post('promo_judul'),
					          'promo_slug'			=>	$promo_slug,
					          'promo_ringkasan'	=>	$this->input->post('promo_ringkasan'),
					          'promo_isi'				=>	$this->input->post('promo_isi'),
					          'promo_image'			=>	$promo_image,
					          'promo_video'			=>	$promo_video,
					          'promo_tanggal'		=>	date("Y-m-d H:i:s"),
					          'promo_publish'		=>	$this->input->post('promo_publish')
				        );

				$data_id = $this->input->post('promo_id');
				
				if ($data_id == "") {
						$this->db->insert('ivmweb_promo', $data);
						//$data_id = $this->db->insert_id();
				} else {
						$this->db->where('promo_id', $data_id);
						$this->db->update('ivmweb_promo', $data);
				}
		}
		
		function deleteData($data_id) {
				$sql = "delete from ivmweb_promo where id=$data_id";
				$this->db->query($sql);
		}

		function publishData($data_id,$set) {
				$sql = "update ivmweb_promo set status=$set where id=$data_id";
				$this->db->query($sql);
		}
		
    function getData($data_id) {
				$sql = "select * from ivmweb_promo where promo_id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				return $data;
    }
    
   
		function json() {
				$total = $this->db->count_all_results('ivmweb_promo');
				if ($total == 0) {
						$json = '{"success":true, "results":0, "rows": []}';
				} else {
						$json = '{"success":true,"results":'.$total.',"rows":';
						
						$sql = "select promo_id,promo_judul,promo_slug,promo_image,promo_video,promo_publish,promo_tanggal from ivmweb_promo order by promo_id desc";
						
			    	$data = array();
			    	$query = $this->db->query($sql);
			    	$data = $query->result_array();
			    	$query->free_result();
			    	
			    	$json .= json_encode($data);
			    	$json .= '}';
				}
				
				return $json;
		}
}