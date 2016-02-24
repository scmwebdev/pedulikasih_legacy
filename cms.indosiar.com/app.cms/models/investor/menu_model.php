<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Menu_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function submitData() {
    		$judul_url_id = $this->allfunction->judul2url($this->input->post('judul_id'));
    		$judul_url_en = $this->allfunction->judul2url($this->input->post('judul_en'));
				$pdf_id = $this->input->post('pdf_id');
				$pdf_en = $this->input->post('pdf_en');

				$FILE_MIMES = array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf', 'text/x-pdf');
				$FILE_EXTS  = array('.pdf');
				
				$upload_dir = STATIC_PATH.'pdf/investor/';
				//$curtime 		= date("YmdHis");
				
				if ($_FILES['pdf_id_file']['name'] != "") {
						$file_type = $_FILES['pdf_id_file']['type']; 
					  $file_name = $_FILES['pdf_id_file']['name'];
						$temp_name = $_FILES['pdf_id_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));

						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $judul_url_id.'_id'.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) $pdf_id = $file_name;
						}
				}
				
				if ($_FILES['pdf_en_file']['name'] != "") {
						$file_type = $_FILES['pdf_en_file']['type']; 
					  $file_name = $_FILES['pdf_en_file']['name'];
						$temp_name = $_FILES['pdf_en_file']['tmp_name'];
						$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));

						if (in_array($file_type, $FILE_MIMES) && in_array($file_ext, $FILE_EXTS) ) {
								$file_name = $judul_url_en.'_en'.$file_ext;
								$file_path = $upload_dir.$file_name;
								$result = move_uploaded_file($temp_name, $file_path);
							  if ($result == true) $pdf_en = $file_name;
						}
				}
				
				$data = array(
					          'id_main'			=>	$this->input->post('id_main'),
					          'judul_id'				=>	$this->input->post('judul_id'),
					          'judul_menu_id'	=>	$this->input->post('judul_menu_id'),
					          'judul_url_id'		=>	$judul_url_id,
					          'isi_id'					=>	$this->input->post('isi_id'),
					          'judul_en'				=>	$this->input->post('judul_en'),
					          'judul_menu_en'	=>	$this->input->post('judul_menu_en'),
					          'judul_url_en'		=>	$judul_url_en,
					          'isi_en'					=>	$this->input->post('isi_en'),
					          'status_sort'	=>	$this->input->post('status_sort'),
					          'pdf_id'			=>	$pdf_id,
					          'pdf_en'			=>	$pdf_en,
					          'tanggal'			=>	date("Y-m-d H:i:s"),
					          'publish'			=>	$this->input->post('publish'),
					          'url'			    =>	$this->input->post('url'),
					          'show_judul'			=>	$this->input->post('show_judul')
				        );

				$data_id = $this->input->post('id');
				
				if ($data_id == "") {
						$this->db->insert('investor_menu', $data);
						//$data_id = $this->db->insert_id();
				} else {
						$this->db->where('id', $data_id);
						$this->db->update('investor_menu', $data);
				}
		}
		
		function deleteData($data_id) {
				$total = $this->db->where('id_main',$data_id)->count_all_results('investor_menu');
				if ($total == 0) {
						$sql = "delete from investor_menu where id=$data_id";
						$this->db->query($sql);
				}
		}

		function publishData($data_id,$set) {
				$sql = "update investor_menu set status=$set where id=$data_id";
				$this->db->query($sql);
		}
		
    function getData($data_id) {
				$sql = "select * from investor_menu where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				return $data;
    }

		function json() {
				$data = array();
				$sql = "select * from investor_menu where id_main=0 order by status_sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) {
						$row['judul_menu_id'] = '<b>'.$row['judul_menu_id'].'</b>';
						$row['judul_menu_en'] = '<b>'.$row['judul_menu_en'].'</b>';
						$data[] = $row;
						
						$sqlx = "select * from investor_menu where id_main=".$row['id']." order by status_sort";
						$queryx = $this->db->query($sqlx);
						foreach($queryx->result_array() as $rowx) {
								$rowx['judul_menu_id'] = '- '.$rowx['judul_menu_id'];
								$rowx['judul_menu_en'] = '- '.$rowx['judul_menu_en'];
								$data[] = $rowx;
								
								$sqlz = "select * from investor_menu where id_main=".$rowx['id']." order by status_sort";
								$queryz = $this->db->query($sqlz);
								foreach($queryz->result_array() as $rowz) {
										$rowz['judul_menu_id'] = '&nbsp;&nbsp; -> '.$rowz['judul_menu_id'];
										$rowz['judul_menu_en'] = '&nbsp;&nbsp; -> '.$rowz['judul_menu_en'];
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
	    	$row['judul_menu_id'] = "--- TOP ---";
	    	$data[] = $row;
	    	
				$sql = "select id,judul_menu_id from investor_menu where id_main=0 order by status_sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) {
						$data[] = $row;
						
						$sqlx = "select id,judul_menu_id from investor_menu where id_main=".$row['id']." order by status_sort";
						$queryx = $this->db->query($sqlx);
						foreach($queryx->result_array() as $rowx) {
								$rowx['judul_menu_id'] = '- '.$rowx['judul_menu_id'];
								$data[] = $rowx;
						}
						$queryx->free_result();
				}
				$query->free_result();
				
				return $data;
    }
}