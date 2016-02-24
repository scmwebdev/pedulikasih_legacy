<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Content_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function submitData() {
    		$judul_url = $this->allfunction->judul2url($this->input->post('judul'));
				$pdf = $this->input->post('pdf');

				$FILE_MIMES = array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf', 'text/x-pdf');
				$FILE_EXTS  = array('.pdf');
				
				$upload_dir = STATIC_PATH.'pdf/pedulikomunitas/content/';
				if (!file_exists($upload_dir)) @mkdir($upload_dir);
				//$curtime 		= date("YmdHis");
				
				if ($_FILES['pdf_file']['name'] != "") {
						$file_type = $_FILES['pdf_file']['type']; 
					  $file_name = $_FILES['pdf_file']['name'];
						$temp_name = $_FILES['pdf_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));

						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $judul_url.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) $pdf = $file_name;
						}
				}
				
				$data = array(
					          'kategori'		=>	$this->input->post('kategori'),
					          'judul'				=>	$this->input->post('judul'),
					          'judul_url'		=>	$judul_url,
					          'isi'					=>	$this->input->post('isi'),
					          'ringkasan'		=>	$this->input->post('ringkasan'),
					          'pdf'					=>	$pdf,
					          'tanggal'			=>	date("Y-m-d H:i:s"),
					          'publish'			=>	$this->input->post('publish')
				        );

				$data_id = $this->input->post('id');
				
				if ($data_id == "") {
						$this->db->insert('pedulikomunitas_content', $data);
						//$data_id = $this->db->insert_id();
				} else {
						$this->db->where('id', $data_id);
						$this->db->update('pedulikomunitas_content', $data);
				}
		}
		
		function deleteData($data_id) {
				$sql = "delete from pedulikomunitas_content where id=$data_id";
				$this->db->query($sql);
		}

		function publishData($data_id,$set) {
				$sql = "update pedulikomunitas_content set status=$set where id=$data_id";
				$this->db->query($sql);
		}
		
    function getData($data_id) {
				$sql = "select * from pedulikomunitas_content where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				return $data;
    }

		function json() {
				$data 	= array();
				$sql 		= "select * from pedulikomunitas_content order by id desc";
				$query 	= $this->db->query($sql);
				$data		=  $query->result_array();
			  
			  $query->free_result();
			  
				$data 	= json_encode($data);
				
				return $data;
		}
}