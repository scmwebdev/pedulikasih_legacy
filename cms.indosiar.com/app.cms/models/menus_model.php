<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Menus_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
		function json($keyword,$start,$limit,$page) {
				if ($keyword == "")
						$sql = "select count(id) as total from cms_modules";
				else
						$sql = "select count(id) as total from cms_modules where title like '%$keyword%'";
						
				$query = $this->db->query($sql);
				if ($query->num_rows() == 0) {
						$json = '{"success":true, "results":0, "rows": []}';
						$query->free_result();
				} else {
						$row = $query->row();
						$total = $row->total;
						$query->free_result();
						
						$json = '{"success":true,"results":'.$total.',"rows":';
						
						if ($keyword == "")
								$sql = "select * from cms_modules order by modtype,parent,menutype desc,sort limit $start,$limit";
						else
								$sql = "select * from cms_modules where title like '%$keyword%' order by modtype desc,menutype desc,parent,sort limit $start,$limit";
		
			    	$data = array();
			    	$query = $this->db->query($sql);
			    	$data = $query->result_array();
			    	$query->free_result();
			    	
			    	$json .= json_encode($data);
			    	$json .= '}';
				}
				
				return $json;
		}
		
    function getData($data_id) {
    		if (is_numeric($data_id)) {
						$sql = "select * from cms_modules where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();
						
						return $data;
    		}
    }
    
    function addData() {				
				$data = array(
					          'title'				=>	$this->input->post('title'),
									  'iconcls'			=>	$this->input->post('iconcls'),
									  'desc'				=>	$this->input->post('desc'),
									  'parent'			=>	$this->input->post('parent'),
									  'folder'			=>	$this->input->post('folder'),
									  'controller'	=>	$this->input->post('controller'),
									  'modtype'			=>	$this->input->post('modtype'),
									  'menutype'		=>	$this->input->post('menutype'),
									  'auth'				=>	$this->input->post('auth'),
									  'status'			=>	1,
									  'separator'		=>	$this->input->post('separator'),
									  'sort'				=>	$this->input->post('sort'),
									  'key_name'		=>	$this->input->post('key_name')
				        );

				$this->db->insert('cms_modules', $data);
		}
		
		function editData($data_id) {
				$data = array(
					          'title'				=>	$this->input->post('title'),
									  'iconcls'			=>	$this->input->post('iconcls'),
									  'desc'				=>	$this->input->post('desc'),
									  'parent'			=>	$this->input->post('parent'),
									  'folder'			=>	$this->input->post('folder'),
									  'controller'	=>	$this->input->post('controller'),
									  'modtype'			=>	$this->input->post('modtype'),
									  'menutype'		=>	$this->input->post('menutype'),
									  'auth'				=>	$this->input->post('auth'),
									  'separator'		=>	$this->input->post('separator'),
									  'sort'				=>	$this->input->post('sort'),
									  'key_name'		=>	$this->input->post('key_name')
				        );
				$this->db->where('id', $data_id);
				$this->db->update('cms_modules', $data);
		}
		
		function deleteData($data_id) {
				$sql = "delete from cms_modules where id=$data_id";
				$this->db->query($sql);
		}
		
		function publishData($data_id,$set) {
				$sql = "update cms_modules set status=$set where id=$data_id";
				$this->db->query($sql);
		}
}