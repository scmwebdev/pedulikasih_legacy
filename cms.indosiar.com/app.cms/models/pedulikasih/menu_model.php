<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Menu_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function submitData() {
    		$judul_url = $this->allfunction->judul2url($this->input->post('judul_menu'));
				$pdf = $this->input->post('pdf');

				$FILE_MIMES = array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf', 'text/x-pdf');
				$FILE_EXTS  = array('.pdf');
				
				$upload_dir = STATIC_PATH.'pdf/pedulikasih/';
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
					          'id_main'			=>	$this->input->post('id_main'),
					          'judul'				=>	$this->input->post('judul'),
					          'judul_menu'	=>	$this->input->post('judul_menu'),
					          'judul_url'		=>	$judul_url,
					          'isi'					=>	$this->input->post('isi'),
					          'url'					=>	$this->input->post('url'),
					          'status_sort'	=>	$this->input->post('status_sort'),
					          'pdf'					=>	$pdf,
					          'tanggal'			=>	date("Y-m-d H:i:s"),
					          'publish'			=>	$this->input->post('publish')
				        );

				$data_id = $this->input->post('id');
				
				if ($data_id == "") {
						$this->db->insert('pedulikasih_menu', $data);
						//$data_id = $this->db->insert_id();
				} else {
						$this->db->where('id', $data_id);
						$this->db->update('pedulikasih_menu', $data);
				}
		}
		
		function deleteData($data_id) {
				$total = $this->db->where('id_main',$data_id)->count_all_results('pedulikasih_menu');
				if ($total == 0) {
						$sql = "delete from pedulikasih_menu where id=$data_id";
						$this->db->query($sql);
				}
		}

		function publishData($data_id,$set) {
				$sql = "update pedulikasih_menu set status=$set where id=$data_id";
				$this->db->query($sql);
		}
		
    function getData($data_id) {
				$sql = "select * from pedulikasih_menu where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				return $data;
    }

		function json() {
				$data = array();
				$sql = "select * from pedulikasih_menu where id_main=0 order by status_sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) {
						$row['judul_menu'] = '<b>'.$row['judul_menu'].'</b>';
						$data[] = $row;
						
						$sqlx = "select * from pedulikasih_menu where id_main=".$row['id']." order by status_sort";
						$queryx = $this->db->query($sqlx);
						foreach($queryx->result_array() as $rowx) {
								$rowx['judul_menu'] = '- '.$rowx['judul_menu'];
								$data[] = $rowx;
								
								$sqlz = "select * from pedulikasih_menu where id_main=".$rowx['id']." order by status_sort";
								$queryz = $this->db->query($sqlz);
								foreach($queryz->result_array() as $rowz) {
										$rowz['judul_menu'] = '&nbsp;&nbsp; -> '.$rowz['judul_menu'];
										$data[] = $rowz;
								}
							  $queryz->free_result();
						}
					  $queryx->free_result();
				}
			  $query->free_result();
			    	
				$data = json_encode($data);
				
				return $data;
		}
		
		function jsonmainmenu() {
				$row = array();
				$row['id'] = "0";
	    	$row['judul_menu'] = "--- TOP ---";
	    	$data[] = $row;
	    	
				$sql = "select id,judul_menu from pedulikasih_menu where id_main=0 order by status_sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) {
						$data[] = $row;
						
						$sqlx = "select id,judul_menu from pedulikasih_menu where id_main=".$row['id']." order by status_sort";
						$queryx = $this->db->query($sqlx);
						foreach($queryx->result_array() as $rowx) {
								$rowx['judul_menu'] = '- '.$rowx['judul_menu'];
								$data[] = $rowx;
						}
						$queryx->free_result();
				}
				$query->free_result();
				
				return $data;
    }
}