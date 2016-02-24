<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Jadwalacara_model extends CI_Model {
    function __construct() {
        parent::__construct();
        //$this->load->database();
    }
    
    function addZero($data) {
    		if (strlen($data) == 1) $data = '0'.$data;
    		return $data;
    }
    
    function addData() {
    		$tanggal = $this->input->post('sc_date').' '.$this->addZero($this->input->post('sc_slot_hh')).':'.$this->addZero($this->input->post('sc_slot_mm')).':00';
				
				$data = array(
					          'tanggal'			=>	$tanggal,
									  'keterangan'	=>	$this->input->post('sc_title')
				        );

				$this->db->insert('ivmweb_jadwal_acara', $data);
		}
		
		function editData($data_id) {
				$tanggal = $this->input->post('sc_date').' '.$this->addZero($this->input->post('sc_slot_hh')).':'.$this->addZero($this->input->post('sc_slot_mm')).':00';
				
				$data = array(
					          'tanggal'			=>	$tanggal,
									  'keterangan'	=>	$this->input->post('sc_title')
				        );
				$this->db->where('id', $data_id);
				$this->db->update('ivmweb_jadwal_acara', $data);
		}

		function deleteData($data_id) {
				$sql = "delete from ivmweb_jadwal_acara where id=$data_id";
				$this->db->query($sql);
		}
				
    function getData($data_id) {
    		if (is_numeric($data_id)) {
						$sql = "select * from ivmweb_jadwal_acara where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();

						return $data;
    		}
    }
    
    function json($sc_date,$start,$limit,$page) {
				$total = $this->db->where('date(tanggal)',$sc_date)->count_all_results('ivmweb_jadwal_acara');	
				if ($total == 0) {
						$json = '{"success":true,"results":0,"rows":[]}';
				} else {
						$json = '{"success":true,"results":'.$total.',"rows":';
			    	
			    	$data = array();
			    	
			    	$sql = "select * from ivmweb_jadwal_acara where date(tanggal)='$sc_date' order by tanggal";
			    	$query = $this->db->query($sql);
			    	foreach($query->result_array() as $row) {
			    			$arrx = array();
			    			$arrx['sc_id'] = base64_encode($row['id']);
			    			$arrx['sc_title'] = $row['keterangan'];
			    			$arrx['sc_date'] = date("Y-m-d", strtotime($row['tanggal']));
			    			$arrx['sc_slot'] = date("H:i", strtotime($row['tanggal']));
			    			$data[] = $arrx;
						}
			    	$query->free_result();
			    	
			    	$json .= json_encode($data);
			    	$json .= '}';
				}
				
				return $json;
		}
		    
    function jsonPreview($sc_date) {
				$i = 1;
	    	$data = array();
	    	
	    	$sql = "select * from ivmweb_jadwal_acara where date(tanggal)='$sc_date' order by tanggal";
	    	$query = $this->db->query($sql);
	    	foreach($query->result_array() as $row) $data[] = $row;
	    	$query->free_result();
	    	
	    	return json_encode($data);
    }
    
    function jsonItem($sc_id) {
				if ($sc_id == "") {
						$json = "[{'sc_id':'','sc_date':'".date("Y/m/d")."','sc_slot_hh':'0','sc_slot_mm':'0','sc_title':''}]";
				} else {
						$sc_id = base64_decode($sc_id);
						$data = $this->getData($sc_id);
						$data_tanggal = strtotime($data['tanggal']);
						$data['sc_date'] = date('Y-m-d', $data_tanggal);
						$data['sc_slot_hh'] = date('H', $data_tanggal);
						$data['sc_slot_mm'] = date('i', $data_tanggal);
						$data['sc_title'] = $data['keterangan'];
						$data['sc_id'] = base64_encode($sc_id);
						$json = json_encode($data);
				}
				
				return $json;
    }

		function isValidDate($dateTime)
		{
		    if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9])$/", $dateTime, $matches)) {
		        if (checkdate($matches[2], $matches[3], $matches[1])) {
		            if ($matches[4] > -1 && $matches[4] < 24 && $matches[5] > -1 && $matches[5] < 60) {
		            		return true;
		            }
		        }
		    }
		
		    return false;
		} 
		
		function isValidTime($hour, $minute) {
		    if ($hour > -1 && $hour < 24 && $minute > -1 && $minute < 60)
		        return true;
		    else
		    		return false;
		} 
	
    function InputMassal($jadwal) {
				$jadwal_arr = explode("\n",$jadwal);
				$lastDate = "";
				$res = "";
				for ($i=0; $i<count($jadwal_arr); $i++) {
						if ($jadwal_arr[$i] != "") {
								$jadwal_arrx = explode("#",$jadwal_arr[$i]);
								$tmpTglJam = trim($jadwal_arrx[0]);
								
								if ($this->isValidDate($tmpTglJam)) {
										$sql = "select id from ivmweb_jadwal_acara where date(tanggal)='".date('Y-m-d',strtotime($tmpTglJam))."' and hour(tanggal)='".date('G',strtotime($tmpTglJam))."' and minute(tanggal)='".intval(date('i',strtotime($tmpTglJam)))."'";
										$result = mysql_query($sql);
										if (mysql_num_rows($result) > 0) {
												$res .= $jadwal_arr[$i]." - ERROR -> Already Exist\n";
										} else {
												$sql = "insert into ivmweb_jadwal_acara (tanggal,keterangan) values ('".$tmpTglJam."','".mysql_escape_string($jadwal_arrx[1])."')";
												$resultx = mysql_query($sql);
												if ($resultx) {
														//$res .= $jadwal_arr[$i]." - OK\n";
														$lastDate = date('Y-m-d',strtotime($tmpTglJam));
												} else
														$res .= $jadwal_arr[$i]." -  ERROR -> ".mysql_error()."\n";
										}
										mysql_free_result($result);
								} else {
										$res .= $jadwal_arr[$i]." - ERROR -> Invalid Date\n";
								}
						}
				}
								
				$json = '{"success":true,"lastdate":"'.$lastDate.'","result":';
	    	$json .= json_encode($res);
	    	$json .= '}';
	    	
	    	return $json;
    }
}