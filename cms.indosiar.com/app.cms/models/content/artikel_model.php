<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Artikel_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function addData() {
				$arrJenis 	= $this->getJenisArtikel($this->input->post('jenis_id'));
				
				$tgl_tayang = ($this->input->post('tgl_tayang') != "" && $this->input->post('tgl_tayang_hh') != "" && $this->input->post('tgl_tayang_mn') != "") ? $this->input->post('tgl_tayang').' '.$this->input->post('tgl_tayang_hh').':'.$this->input->post('tgl_tayang_mn').':00' : "";
				$tgl_robot 	= $this->input->post('tgl_robot').' '.$this->input->post('tgl_robot_hh').':'.$this->input->post('tgl_robot_mn').':00';
	
				$tags 			= $this->input->post('tags');
				
				if ($tags != "") {
						$tags = strtolower($tags);
						$arr = explode(",", $tags);
						$arrTags = array();
						foreach ($arr as &$value) {
							$value = trim($value); 
							if ($value != "") $arrTags[] = $value;
						}
						
						$arrTags = array_unique($arrTags);
					
						$tags = "";
						foreach ($arrTags as &$value) $tags .= $value.", ";
						$tags = substr($tags, 0, strlen($tags)-2);
				}
			
				$data = array(
					          'judul'				=>	$this->input->post('judul'),
					          'judul_url'		=>	$this->allfunction->judul2url($this->input->post('judul')),
					          'subjudul'		=>	$this->input->post('subjudul'),
									  'ringkasan'		=>	$this->input->post('ringkasan'),
									  'isi'					=>	$this->input->post('isi'),
									  'status_tampil'	=>	$this->input->post('status_tampil'),
									  'tags'					=>	$tags,
									  
									  'jenis_id'		=>	$this->input->post('jenis_id'),
									  'jenis_judul'	=>	$arrJenis['jenis'],
									  'jenis_url'		=>	$arrJenis['jenis_url'],
									  'folder'			=>	$arrJenis['folder'],
									  'kategori_id'	=>	$arrJenis['kategori_id'],
									  
									  'tgl_robot'		=>	$tgl_robot,
									  'tgl_tayang'	=>	$tgl_tayang,
									  'tanggal'			=>	date("Y-m-d H:i:s")
				        );

				$this->db->insert('ivmweb2009_artikel_data', $data);
				$data_id = $this->db->insert_id();
				
				if ($tags != "") {
						foreach ($arrTags as &$value) {
								$sql = "insert into ivmweb2009_artikel_tags (kategori_id,jenis_id,data_id,tags,tags_url) values (".$arrJenis['kategori_id'].",".$this->input->post('jenis_id').",$data_id,'".mysql_escape_string($value)."','".$this->allfunction->judul2url($value)."')";
							  $this->db->query($sql);
						}
				}
				
				$cache = $this->setCache($data_id);
				$this->SphinxSubmit($cache);
		}
		
		function editData($data_id) {
				$arrJenis 	= $this->getJenisArtikel($this->input->post('jenis_id'));
				
				$tgl_tayang = ($this->input->post('tgl_tayang') != "" && $this->input->post('tgl_tayang_hh') != "" && $this->input->post('tgl_tayang_mn') != "") ? $this->input->post('tgl_tayang').' '.$this->input->post('tgl_tayang_hh').':'.$this->input->post('tgl_tayang_mn').':00' : "";
				$tgl_robot 	= $this->input->post('tgl_robot').' '.$this->input->post('tgl_robot_hh').':'.$this->input->post('tgl_robot_mn').':00';
	
				$tags 			= $this->input->post('tags');
				
				if ($tags != "") {
						$tags = strtolower($tags);
						$arr = explode(",", $tags);
						$arrTags = array();
						foreach ($arr as &$value) {
							$value = trim($value); 
							if ($value != "") $arrTags[] = $value;
						}
						
						$arrTags = array_unique($arrTags);
					
						$tags = "";
						foreach ($arrTags as &$value) $tags .= $value.", ";
						$tags = substr($tags, 0, strlen($tags)-2);
				}
			
				$data = array(
					          'judul'				=>	$this->input->post('judul'),
					          'judul_url'		=>	$this->allfunction->judul2url($this->input->post('judul')),
					          'subjudul'		=>	$this->input->post('subjudul'),
									  'ringkasan'		=>	$this->input->post('ringkasan'),
									  'isi'					=>	$this->input->post('isi'),
									  'status_tampil'	=>	$this->input->post('status_tampil'),
									  'tags'					=>	$tags,
									  
									  'jenis_id'		=>	$this->input->post('jenis_id'),
									  'jenis_judul'	=>	$arrJenis['jenis'],
									  'jenis_url'		=>	$arrJenis['jenis_url'],
									  'folder'			=>	$arrJenis['folder'],
									  'kategori_id'	=>	$arrJenis['kategori_id'],
									  
									  'tgl_robot'		=>	$tgl_robot,
									  'tgl_tayang'	=>	$tgl_tayang,
									  'tanggal'			=>	date("Y-m-d H:i:s")
				        );
				$this->db->where('id', $data_id);
				$this->db->update('ivmweb2009_artikel_data', $data);
				
				$sql = "delete from ivmweb2009_artikel_tags where data_id=$data_id";
				$this->db->query($sql);
				
				if ($tags != "") {
						foreach ($arrTags as &$value) {
								$sql = "insert into ivmweb2009_artikel_tags (kategori_id,jenis_id,data_id,tags,tags_url) values (".$arrJenis['kategori_id'].",".$this->input->post('jenis_id').",$data_id,'".mysql_escape_string($value)."','".$this->allfunction->judul2url($value)."')";
							  $this->db->query($sql);
						}
				}
				
				$cache = $this->setCache($data_id);
				$this->SphinxSubmit($cache);
		}
		
		function uploadImage() {
				$judul_url 	= $this->allfunction->judul2url($this->input->post('judul'));
				$data_id 		= $this->input->post('id');
				
				$img_artikel 	= trim($this->input->post('img_artikel'));
				$img_list 		= trim($this->input->post('img_list'));
				$img_index		= trim($this->input->post('img_index'));
				
				$FILE_MIMES = array('image/jpeg','image/jpg','image/gif','image/png');
				$FILE_EXTS  = array('.jpeg','.jpg','.png','.gif');
				
				$upload_dir = STATIC_PATH.'images/v09/'.$this->input->post('folder').'/';
				if (!file_exists($upload_dir)) mkdir($upload_dir);
				
				$this->load->library('image_lib');
				
				if ($_FILES['img_artikel_file']['name'] != "") {
						$file_type = $_FILES['img_artikel_file']['type']; 
					  $file_name = $_FILES['img_artikel_file']['name'];
						$temp_name = $_FILES['img_artikel_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
						
						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $judul_url.'_'.$data_id.'_artikel'.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) {
							  		list($width, $height, $type, $attr) = getimagesize($file_path);
										
										if ($width > 200) {	
												$config['image_library'] = 'gd2';
												$config['source_image'] = $file_path;
												$config['new_image'] = $file_path;
												$config['maintain_ratio'] = TRUE;
												$config['width'] = 200;
												$config['height'] = (200/$width)*$height;
												
												$this->image_lib->initialize($config);
												if (!$this->image_lib->resize()) die($this->image_lib->display_errors());
												$this->image_lib->clear(); 
												
												unset($config);
										}
										
							  		$img_artikel = $file_name;
							  }
						}
				}
				
				if ($_FILES['img_list_file']['name'] != "") {
						$file_type = $_FILES['img_list_file']['type']; 
					  $file_name = $_FILES['img_list_file']['name'];
						$temp_name = $_FILES['img_list_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
						
						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $judul_url.'_'.$data_id.'_list'.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) {
										list($width, $height, $type, $attr) = getimagesize($file_path);
										
										$w = 100;
										$h = 85;
										
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
										
							  		$img_list = $file_name;
							  }
						}
				}
				
				if ($_FILES['img_index_file']['name'] != "") {
						$file_type = $_FILES['img_index_file']['type']; 
					  $file_name = $_FILES['img_index_file']['name'];
						$temp_name = $_FILES['img_index_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
						
						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $judul_url.'_'.$data_id.'_index'.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) {
										list($width, $height, $type, $attr) = getimagesize($file_path);
										
										$w = 260;
										$h = 180;
										
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
										
							  		$img_index = $file_name;
							  }
						}
				}
				
				$data = array(
					          'img_artikel'	=>	$img_artikel,
					          'img_list'		=>	$img_list,
					          'img_index'		=>	$img_index
				        );
				$this->db->where('id', $data_id);
				$this->db->update('ivmweb2009_artikel_data', $data);
				
				$cache = $this->setCache($data_id);
				$this->SphinxSubmit($cache);
		}
		
		function uploadVideo() {
				$judul_url 	= $this->allfunction->judul2url($this->input->post('judul'));
				$data_id 		= $this->input->post('id');
				$video 			= trim($this->input->post('video'));
				
				$FILE_MIMES = array('video/mp4','video/x-flv');
				$FILE_EXTS  = array('.mp4','.flv');
				
				$upload_dir = STATIC_PATH.'video/'.$this->input->post('folder').'/';
				if (!file_exists($upload_dir)) mkdir($upload_dir);
				
				if ($_FILES['video_file']['name'] != "") {
						$file_type = $_FILES['video_file']['type']; 
					  $file_name = $_FILES['video_file']['name'];
						$temp_name = $_FILES['video_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
						
						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $judul_url.'_'.$data_id.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) $video = STATIC_URL.'video/'.$this->input->post('folder').'/'.$file_name;
						}
				}
				
				$data = array(
					          'video'	=>	$video
				        );
				$this->db->where('id', $data_id);
				$this->db->update('ivmweb2009_artikel_data', $data);
				
				$cache = $this->setCache($data_id);
				$this->SphinxSubmit($cache);
		}
		
		function deleteData($data_id) {
				$sql = "select * from ivmweb2009_artikel_data where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();
				$query->free_result();
			
				$sql = "delete from ivmweb2009_artikel_data where id=$data_id";
				$this->db->query($sql);

				$this->ivmcache->delete('artikel'.$data_id);
				$this->setCacheGeneral($data['jenis_id']);
				
				$this->DBSPHINX = $this->load->database('sphinx', true);
				$sql 	= "delete from indosiarrt where id=$data_id";
				$this->DBSPHINX->query($sql);
		}
		
		function publishData($data_id,$set) {
				$sql = "update ivmweb2009_artikel_data set status_tampil=$set where id=$data_id";
				$this->db->query($sql);
				
				$cache = $this->setCache($data_id);
				$this->SphinxSubmit($cache);
		}
		
    function getData($data_id) {
    		if (is_numeric($data_id)) {
						$sql = "select * from ivmweb2009_artikel_data where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();
						
						$tgl_robot_time = strtotime($data['tgl_robot']);
						$data['tgl_robot'] = date("Y-m-d", $tgl_robot_time);
						$data['tgl_robot_hh'] = date("G", $tgl_robot_time);
						$data['tgl_robot_mn'] = date("i", $tgl_robot_time);
						
						if ($data['tgl_tayang'] != "" && $data['tgl_tayang'] != "0000-00-00 00:00:00") {
								$tgl_tayang_time = strtotime($data['tgl_tayang']);
								$data['tgl_tayang'] = date("Y-m-d", $tgl_tayang_time);
								$data['tgl_tayang_hh'] = date("G", $tgl_tayang_time);
								$data['tgl_tayang_mn'] = date("i", $tgl_tayang_time);
						} else {
								$data['tgl_tayang'] = $data['tgl_tayang_hh'] = $data['tgl_tayang_mn'] = '';
						}
						
						return $data;
    		}
    }
    
    function getJenisArtikel($jenis_id) {
				$sql = "select kategori_id,jenis,jenis_url,folder from ivmweb2009_artikel_jenis where id=$jenis_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();
				$query->free_result();
				
				return $data;
    }
    
		function json($keyword,$jenis_id,$start,$limit,$page) {	
				if ($keyword == "") {
						if ($jenis_id == "")
								$total = $this->db->count_all_results('ivmweb2009_artikel_data');
						else
								$total = $this->db->where('jenis_id',$jenis_id)->count_all_results('ivmweb2009_artikel_data');
				} else {
						if ($jenis_id == "")
								$total = $this->db->like('judul',$keyword)->count_all_results('ivmweb2009_artikel_data');
						else
								$total = $this->db->where('jenis_id',$jenis_id)->like('judul',$keyword)->count_all_results('ivmweb2009_artikel_data');
				}
				
				if ($total == 0) {
						$json = '{"success":true, "results":0, "rows": []}';
				} else {
						$json = '{"success":true,"results":'.$total.',"rows":';
						
						if ($keyword == "") {
								if ($jenis_id == "")
										$sql = "select id,judul,subjudul,judul_url,ringkasan,jenis_judul,jenis_url,folder,img_index,img_artikel,img_list,video,tanggal,tgl_tayang,tgl_robot,status_tampil,total_view from ivmweb2009_artikel_data order by tgl_robot desc limit $start,$limit";
								else
										$sql = "select id,judul,subjudul,judul_url,ringkasan,jenis_judul,jenis_url,folder,img_index,img_artikel,img_list,video,tanggal,tgl_tayang,tgl_robot,status_tampil,total_view from ivmweb2009_artikel_data where jenis_id=$jenis_id order by tgl_robot desc limit $start,$limit";
						} else {
								if ($jenis_id == "")
										$sql = "select id,judul,subjudul,judul_url,ringkasan,jenis_judul,jenis_url,folder,img_index,img_artikel,img_list,video,tanggal,tgl_tayang,tgl_robot,status_tampil,total_view from ivmweb2009_artikel_data where judul like '%$keyword%' order by tgl_robot desc limit $start,$limit";
								else
										$sql = "select id,judul,subjudul,judul_url,ringkasan,jenis_judul,jenis_url,folder,img_index,img_artikel,img_list,video,tanggal,tgl_tayang,tgl_robot,status_tampil,total_view from ivmweb2009_artikel_data where judul like '%$keyword%' and jenis_id=$jenis_id order by tgl_robot desc limit $start,$limit";
						}
						
			    	$data = array();
			    	$query = $this->db->query($sql);
			    	foreach($query->result_array() as $row) {
			    			$row["tgl_tayang"] = ($row["tgl_tayang"] != "" && $row["tgl_tayang"] != "0000-00-00 00:00:00") ? $row["tgl_tayang"] : "-";
								$row["tgl_robot"] = ($row["tgl_robot"] != "" && $row["tgl_robot"] != "0000-00-00 00:00:00") ? $row["tgl_robot"] : "-";
								
								if (is_null($row["img_index"])) $row["img_index"] = "";
								if (is_null($row["img_artikel"])) $row["img_artikel"] = "";
								if (is_null($row["img_list"])) $row["img_list"] = "";
								if (is_null($row["video"])) $row["video"] = "";
								
								$data[] = $row;
			    	}
			    	$query->free_result();
			    	
			    	$json .= json_encode($data);
			    	$json .= '}';
				}
				
				return $json;
		}
    
    function jsonJenis() {
				$sql = "select id,jenis from ivmweb2009_artikel_jenis where status=1 order by jenis";								
	    	$query = $this->db->query($sql);
	    	$data = $query->result_array();
	    	$query->free_result();
			    	
			  return json_encode($data);
    }
    
		function setCache($data_id) {
  			$sql = "select * from ivmweb2009_artikel_data where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();
				$query->free_result();
				
				if ($this->ivmcache->get('artikel'.$data_id))
						$this->ivmcache->replace('artikel'.$data_id, $data);
				else
						$this->ivmcache->add('artikel'.$data_id, $data);
				
				$this->setCacheGeneral($data['jenis_id']);

				return $data;
		}
		
		function setCacheGeneral($jenis_id) {
            $sql    = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=$jenis_id order by tgl_robot desc limit 50";
            $query  = $this->db->query($sql);
            $tmpArr = $query->result_array();
            $query->free_result();
            if ($this->ivmcache->get('artikeljenis'.$jenis_id))
                $this->ivmcache->replace('artikeljenis'.$jenis_id, $tmpArr);
            else
                $this->ivmcache->add('artikeljenis'.$jenis_id, $tmpArr);
			  
            $sql    = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() order by tgl_robot desc limit 20";
            $query  = $this->db->query($sql);
            $tmpArr = $query->result_array();
            $query->free_result();
            if ($this->ivmcache->get('artikelhot'))
                $this->ivmcache->replace('artikelhot', $tmpArr);
            else
                $this->ivmcache->add('artikelhot', $tmpArr);
			  
            $sql    = "select id,jenis_id,kategori_id,tgl_tayang,tgl_robot,img_index,img_list from ivmweb2009_artikel_data order by tgl_robot desc limit 100";
            $query  = $this->db->query($sql);
            $tmpArr = $query->result_array();
            $query->free_result();
            if ($this->ivmcache->get('artikelrobot'))
                $this->ivmcache->replace('artikelrobot', $tmpArr);
            else
                $this->ivmcache->add('artikelrobot', $tmpArr);
		}
			
		function SphinxSubmit($row) {
				if (is_array($row)) {
						$arrT = array("\r\n","\r","\n");
						
						$id = $row['id'];
						$jenis_id 		= $row['jenis_id'];
						$kategori_id 	= $row['kategori_id'];
						
						$tgl_robot 	= strtotime($row['tgl_robot']);
						$tgl_tayang = strtotime($row['tgl_tayang']);
						
						if (trim($tgl_robot) == "") 	$tgl_robot = 0;
						if (trim($tgl_tayang) == "") 	$tgl_tayang = 0;
						
						$subjudul 	= mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['subjudul']))));
						$judul 			= mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['judul']))));
						$ringkasan 	= mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['ringkasan']))));
						$isi				= mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['isi']))));
						
						$img_list 		= (trim($row['img_list']) == "") ? 0 : 1;
						$img_index 		= (trim($row['img_index']) == "") ? 0 : 1;
						$img_artikel 	= (trim($row['img_artikel']) == "") ? 0 : 1;

						$this->DBSPHINX = $this->load->database('sphinx', true);
						
						$sql = "REPLACE INTO indosiarrt (id,jenis_id,kategori_id,judul,subjudul,ringkasan,isi,tgl_robot,tgl_tayang,img_list,img_index,img_artikel) VALUES ($id,$jenis_id,$kategori_id,'$judul','$subjudul','$ringkasan','$isi',$tgl_robot,$tgl_tayang,$img_list,$img_index,$img_artikel)";

						$this->DBSPHINX->query($sql);
				}
		}
}