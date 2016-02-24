<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ticker_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function json($keyword,$kategori,$start,$limit,$page) {	
		if ($keyword == "") {
				if ($kategori == "")
						$total = $this->db->count_all_results('news_ticker');
				else
						$total = $this->db->where('kategori',$kategori)->count_all_results('news_ticker');
		} else {
				if ($kategori == "")
						$total = $this->db->like('judul',$keyword)->count_all_results('news_ticker');
				else
						$total = $this->db->where('kategori',$kategori)->like('judul',$keyword)->count_all_results('news_ticker');
		}
		
		if ($total == 0) {
			$json = '{"success":true, "results":0, "rows": []}';
		} else {
			$json = '{"success":true,"results":'.$total.',"rows":';
			
			if ($keyword == "") {
					if ($kategori == "")
							$sql = "select * from news_ticker order by id desc limit $start,$limit";
					else
							$sql = "select * from news_ticker where kategori='$kategori' order by id desc limit $start,$limit";
			} else {
					if ($kategori == "")
							$sql = "select * from news_ticker where judul like '%$keyword%' order by id desc limit $start,$limit";
					else
							$sql = "select * from news_ticker where judul like '%$keyword%' and kategori='$kategori' order by id desc limit $start,$limit";
			}
				
	    	$data = $this->db->query($sql)->result_array();
	    	
	    	$json .= json_encode($data);
	    	$json .= '}';
		}
		
		return $json;
	}

	function deleteData($data_id) {
		$sql = "delete from news_ticker where id=$data_id";
		$this->db->query($sql);
	}

	function publishData($data_id,$set) {
		$sql = "update news_ticker set publish=$set, update_date=now(), update_by=".$this->session->userdata('id')." where id=$data_id";
		$this->db->query($sql);
	}
	
    function submitData() {				
		$data = array(
			          'kategori'		=>	$this->input->post('kategori'),
			          'judul'	        =>	$this->input->post('judul'),
			          'isi'				=>	$this->input->post('isi'),
			          'sort'			=>	$this->input->post('sort'),
			          'tanggal'			=>	date("Y-m-d H:i:s"),
			          'publish'			=>	$this->input->post('publish')
		        );

		$data_id = $this->input->post('id');
		
		if ($data_id == "") {
				$data['create_date'] = date("Y-m-d H:i:s");
				$data['create_by'] = $this->session->userdata('id');
				$this->db->insert('news_ticker', $data);
		} else {
				$data['update_date'] = date("Y-m-d H:i:s");
				$data['update_by'] = $this->session->userdata('id');
				$this->db->where('id', $data_id);
				$this->db->update('news_ticker', $data);
		}
	}
		
		
    function getData($data_id) {
		$sql = "select * from news_ticker where id=$data_id";
		$data = $this->db->query($sql)->row_array();
		
		$data['create_by'] = $this->getUserName($data['create_by']);
		$data['update_by'] = ($data['update_by'] == '0') ? '' : $this->getUserName($data['update_by']);
		
		return $data;
    }

    function getUserName($uid) {
		$sql = "select name from cms_users where id=$uid";
		$data = $this->db->query($sql)->row_array();
		
		return $data['name'];
    }
}