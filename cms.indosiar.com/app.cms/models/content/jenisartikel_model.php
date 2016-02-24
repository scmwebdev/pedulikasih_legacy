<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Jenisartikel_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function submitDataJenis() {
    		if (trim($this->input->post('jenis_url_spesial')) == "") 
    				$jenis_url = $this->allfunction->judul2url($this->input->post('jenis'));
    		else
    				$jenis_url = trim($this->input->post('jenis_url_spesial'));
    				
				$jenis							= trim($this->input->post('jenis'));
				$folder							= trim($this->input->post('folder'));
				$folder_old					= trim($this->input->post('folder_old'));
				$kategori_id				= trim($this->input->post('kategori_id'));
	
				$data = array(
					          'kategori_id'		=>	$kategori_id,
					          'jenis'					=>	$jenis,
					          'jenis_url'			=>	$jenis_url,
									  'folder'				=>	$folder,
									  'status'				=>	$this->input->post('status')
				        );

				$data_id = $this->input->post('id');
				
				if ($data_id == "") {
						$this->db->insert('ivmweb2009_artikel_jenis', $data);
						$data_id = $this->db->insert_id();
						
						mkdir(STATIC_PATH.'images/v09/'.$folder);
				} else {
						$this->db->where('id', $data_id);
						$this->db->update('ivmweb2009_artikel_jenis', $data);
						
						$sql = "UPDATE ivmweb2009_artikel_data SET jenis_judul='$jenis', jenis_url='$jenis_url', kategori_id=$kategori_id, folder='$folder' WHERE jenis_id=$data_id";
						$this->db->query($sql);
				
						if ($folder_old != $folder) rename(STATIC_PATH.'images/v09/'.$folder_old, STATIC_PATH.'images/v09/'.$folder);
				}
		}
		
		function submitDataKategori() {
				$data = array(
					          'kategori'			=>	$this->input->post('katgeori'),
									  'status'				=>	$this->input->post('status')
				        );

				$data_id = $this->input->post('id');
				
				if ($data_id == "") {
						$this->db->insert('ivmweb2009_artikel_kategori', $data);
						$data_id = $this->db->insert_id();
				} else {
						$this->db->where('id', $data_id);
						$this->db->update('ivmweb2009_artikel_kategori', $data);
				}
		}
		
		function deleteDataJenis($data_id) {
				$total = $this->db->where('jenis_id',$data_id)->count_all_results('ivmweb2009_artikel_data');
				if ($total == 0) {
						$sql = "delete from ivmweb2009_artikel_jenis where id=$data_id";
						$this->db->query($sql);
				}
		}
		
		function deleteDataKategori($data_id) {
				$total = $this->db->where('kategori_id',$data_id)->count_all_results('ivmweb2009_artikel_jenis');
				if ($total == 0) {						
						$sql = "delete from ivmweb2009_artikel_kategori where id=$data_id";
						$this->db->query($sql);
				}
		}
		
		function publishDataJenis($data_id,$set) {
				$sql = "update ivmweb2009_artikel_jenis set status=$set where id=$data_id";
				$this->db->query($sql);
		}
		
		function publishDataKategori($data_id,$set) {
				$sql = "update ivmweb2009_artikel_kategori set status=$set where id=$data_id";
				$this->db->query($sql);
		}
		
    function getDataJenis($data_id) {
				$sql = "select * from ivmweb2009_artikel_jenis where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				$data['folder_old'] = $data['folder'];
				$data['jenis_url_spesial'] = '';
				if ($this->allfunction->judul2url($data['jenis']) != $data['jenis_url']) $data['jenis_url_spesial'] = $data['jenis_url'];
				
				return $data;
    }
    
    function getDataKategori($data_id) {
				$sql = "select * from ivmweb2009_artikel_kategori where id=$data_id";
				$query = $this->db->query($sql);
				$data = $query->row_array();				
				$query->free_result();
				
				return $data;
    }
    
		function jsonJenis() {
				$total = $this->db->count_all_results('ivmweb2009_artikel_jenis');
				if ($total == 0) {
						$json = '{"success":true,"results":0,"rows":[]}';
				} else {
						$json = '{"success":true,"results":'.$total.',"rows":';
						
						$sql = "select j.*,k.kategori from ivmweb2009_artikel_jenis j inner join ivmweb2009_artikel_kategori k on j.kategori_id=k.id order by j.kategori_id, j.jenis";
						
			    	$data = array();
			    	$query = $this->db->query($sql);
			    	$data = $query->result_array();
			    	$query->free_result();
			    	
			    	$json .= json_encode($data);
			    	$json .= '}';
				}
				
				return $json;
		}
    
    function jsonKategori() {
				$total = $this->db->count_all_results('ivmweb2009_artikel_kategori');
				if ($total == 0) {
						$json = '{"success":true,"results":0,"rows":[]}';
				} else {
						$json = '{"success":true,"results":'.$total.',"rows":';
						
						$sql = "select * from ivmweb2009_artikel_kategori order by kategori";
						
			    	$data = array();
			    	$query = $this->db->query($sql);
			    	foreach($query->result_array() as $row) {
								$data[] = $row;
			    	}
			    	$query->free_result();
			    	
			    	$json .= json_encode($data);
			    	$json .= '}';
				}
				
				return $json;
    }
    
    function jsonKategoriForm() {
				$sql = "select * from ivmweb2009_artikel_kategori where status=1 order by kategori";
	    	$query = $this->db->query($sql);
	    	$data = $query->result_array();
	    	$query->free_result();
			    	
			  return json_encode($data);
    }
}