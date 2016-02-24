<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Homepage_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function submitData() {				
				$data = array(
					          'id_main'			=>	$this->input->post('id_main'),
					          'col_title'				=>	$this->input->post('col_title'),
					          'col_value'	=>	$this->input->post('col_value'),
					          'sort'	=>	$this->input->post('sort'),
					          'tanggal'			=>	date("Y-m-d H:i:s")
				        );

				$data_id = $this->input->post('id');
				
				if ($data_id == "") {
						$this->db->insert('investor_financial_highlights', $data);
						//$data_id = $this->db->insert_id();
				} else {
						$this->db->where('id', $data_id);
						$this->db->update('investor_financial_highlights', $data);
				}
		}
		
		function deleteData($data_id) {
				$total = $this->db->where('id_main',$data_id)->count_all_results('investor_financial_highlights');
				if ($total == 0) {
						$sql = "delete from investor_financial_highlights where id=$data_id";
						$this->db->query($sql);
				}
		}
		
    function getData($data_id) {
				$sql = "select * from investor_financial_highlights where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				return $data;
    }
    
   
		function json() {
				$data = array();
				$sql = "select * from investor_financial_highlights where id_main=0 order by sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) {
						$data[] = $row;
						$sqlx = "select * from investor_financial_highlights where id_main=".$row['id']." order by sort";
						$queryx = $this->db->query($sqlx);
						foreach($queryx->result_array() as $rowx) {
								$rowx['col_title'] = '- '.$rowx['col_title'];
								$data[] = $rowx;
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
	    	$row['col_title'] = "--- TOP ---";
	    	$data[] = $row;
	    	
				$sql = "select id,col_title from investor_financial_highlights where id_main=0 order by sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) $data[] = $row;
				$query->free_result();
				
				return $data;
    }
    
    // COLUMN HIGHLIGHTS //
		function submitDataColumn() {
				$data = array(
					          'id_main'			=>	$this->input->post('id_main'),
					          'judul'				=>	$this->input->post('judul'),
					          'menu_id'	=>	$this->input->post('menu_id'),
					          'sort'	=>	$this->input->post('sort'),
					          'tanggal'			=>	date("Y-m-d H:i:s")
				        );

				$data_id = $this->input->post('id');
				
				if ($data_id == "") {
						$this->db->insert('investor_column_highlights', $data);
						//$data_id = $this->db->insert_id();
				} else {
						$this->db->where('id', $data_id);
						$this->db->update('investor_column_highlights', $data);
				}
		}
		
		function deleteDataColumn($data_id) {
				$total = $this->db->where('id_main',$data_id)->count_all_results('investor_column_highlights');
				if ($total == 0) {
						$sql = "delete from investor_column_highlights where id=$data_id";
						$this->db->query($sql);
				}
		}
		
    function getDataColumn($data_id) {
				$sql = "select * from investor_column_highlights where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				return $data;
    }
    
		function getMenuFile($id) {
				$sql = "select pdf_en,pdf_id from investor_menu where id=$id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				return $data;
		}
		
		function jsoncolumn() {
				$data = array();
				$sql = "select * from investor_column_highlights where id_main=0 order by sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) {
						if ($row['menu_id'] > 0) {
								$pdf = $this->getMenuFile($row['menu_id']);
								$row['pdf_id'] = $pdf['pdf_id'];
								$row['pdf_en'] = $pdf['pdf_id'];
						} else {
								$row['pdf_id'] = '';
								$row['pdf_en'] = '';
						}
						$data[] = $row;
						
						$sqlx = "select * from investor_column_highlights where id_main=".$row['id']." order by sort";
						$queryx = $this->db->query($sqlx);
						foreach($queryx->result_array() as $rowx) {
								if ($rowx['menu_id'] > 0) {
										$pdf = $this->getMenuFile($rowx['menu_id']);
										$rowx['pdf_id'] = $pdf['pdf_id'];
										$rowx['pdf_en'] = $pdf['pdf_id'];
								} else {
										$rowx['pdf_id'] = '';
										$rowx['pdf_en'] = '';
								}
								
								$rowx['judul'] = '- '.$rowx['judul'];
								$data[] = $rowx;
						}
					  $queryx->free_result();
				}
			  $query->free_result();
			    	
				$data = json_encode($data);
				
				return $data;
		}
		
		function jsonmainmenucolumn() {
				$row = array();
				$row['id'] = "0";
	    	$row['judul'] = "--- TOP ---";
	    	$data[] = $row;
	    	
				$sql = "select id,judul from investor_column_highlights where id_main=0 order by sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) $data[] = $row;
				$query->free_result();
				
				return $data;
    }
    
		function jsonmenu() {
				$data = array();
				$sql = "select * from investor_menu where id_main=0 order by status_sort";
				$query = $this->db->query($sql);
				foreach($query->result_array() as $row) {
						$row['judul_menu_id'] = '<b>'.$row['judul_menu_id'].'</b>';
						$data[] = $row;
						
						$sqlx = "select * from investor_menu where id_main=".$row['id']." order by status_sort";
						$queryx = $this->db->query($sqlx);
						foreach($queryx->result_array() as $rowx) {
								$rowx['judul_menu_id'] = '- '.$rowx['judul_menu_id'];
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
}