<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dbcopy extends CI_Controller {
	public function index()
	{
			$batas = 100;
			
			if (isset($_REQUEST['p'])) {
				$p 			= $_REQUEST['p'];
				$jenis 	= $_REQUEST['jenis'];
				$arrT 	= array("\r\n","\r","\n");
				$tmpArr = array();

				if ($jenis == "schedule") 			$sql = "select * from tbl_schedule limit $p, $batas";
				if ($jenis == "sinopsis") 			$sql = "select * from tbl_sinopsis limit $p, $batas";
				if ($jenis == "content") 			$sql = "select * from tbl_content limit $p, $batas";
				if ($jenis == "content_cat") 			$sql = "select * from tbl_content_cat limit $p, $batas";
				
				if ($jenis == "user") 			{
					$sql = "select * from users limit $p, $batas";
					$query 	= $this->db->query($sql);
				} else {
					$this->DBOLD = $this->load->database('dbold', true);
				  $query 	= $this->DBOLD->query($sql);
				}
				
				$tmpArr = $query->result_array();
				$query->free_result();
				
				$totArr = count($tmpArr);
				if ($totArr > 0) {					
					foreach($tmpArr as $row) {
						if ($jenis == "schedule") {
							$row['sc_date'] = date("Y-m-d", $row['sc_date']);
 	 	 	 	 	 	 
							$data = array(
				          'sc_id'					=>	$row['sc_id'],
				          'sc_date'				=>	$row['sc_date'],
				          'sc_order'			=>	$row['sc_order'],
				          'sc_slot'				=>	$row['sc_slot'],
				          'sc_slotend'		=>	$row['sc_slotend'],
				          'sc_duration'		=>	$row['sc_duration'],
				          'sc_title'			=>	$row['sc_title'],
				          's_id'					=>	$row['sc_link_id'],
				          'sc_mainindex'	=>	$row['sc_mainindex'],
				          'sc_publish'		=>	1
				      );
				      
				      $this->db->insert('tbl_schedule', $data);
						}elseif ($jenis == "user") {
							$this->load->library('bcrypt');
							$this->db->query("update users set pass='".$this->bcrypt->hash('jakarta')."'");
						}elseif ($jenis == "sinopsis") {
							$s_air_time_slot_arr=array();
							if (trim($row['s_air_time'])=="") {
								$s_air_time_slot_arr[0]="";
								$s_air_time_slot_arr[1]="";
							}else {	
								$s_air_time_slot_arr=explode("-",$row['s_air_time']);
							}
							$data = array(
				          's_id'					=>	$row['s_id'],
				          's_timestamp'				=>	$row['s_timestamp'],
				          's_program_title'			=>	$row['s_program_title'],
				          'judul_url'				=>	$this->sctvlib->judul_url($row['s_program_title'],$row['s_id']),
				          's_episode'		=>	$row['s_episode'],
				          's_cat_program'		=>	$row['s_cat_program'],
				          's_starring'			=>	$row['s_starring'],
				          //'s_produksi'					=>	$row['s_produksi'],
				          's_director'	=>	$row['s_director'],
				          's_air_date'	=>	$row['s_air_date'],
				          's_air_date2'	=>	$row['s_air_date2'],
				          's_air_days'	=>	$row['s_air_date2'],
				          's_air_time'	=>	$row['s_air_time'],
				          's_air_time_slot'	=>	$s_air_time_slot_arr[0],
				          's_air_time_slot_end'	=>	$s_air_time_slot_arr[1],
				          's_story_line'	=>	$row['s_story_line'],
				          's_short_story'	=>	$row['s_short_story'],
				          's_writer'	=>	$row['s_writer'],
				          's_url'	=>	$row['s_url'],
				          's_publish'	=>	$row['s_publish'],
				          's_story_line'	=>	$row['s_story_line'],
				          's_sms'	=>	$row['s_sms'],
				          'ynewsfeed'	=>	$row['ynewsfeed'],
				          'liputan6'	=>	$row['liputan6'],
				          's_publish'		=>	1
				      );
				      
				      $this->db->insert('tbl_sinopsis', $data);							
						}elseif ($jenis == "content") {
							$data = array(
				          'id'					=>	$row['id'],
				          'c_id'				=>	$row['c_id'],
				          'title'			=>	$row['title'],
				          'judul_url'				=>	$this->sctvlib->judul_url($row['title'],$row['id']),
				          'datetime'		=>	$row['datetime'],
				          'shortdesc'		=>	$row['shortdesc'],
				          'content'			=>	$row['content'],
				          'publish'					=>	$row['publish'],
				          'pic_id'	=>	$row['pic_id']
				      );							
				      $this->db->insert('tbl_content', $data);		
						}elseif ($jenis == "content_cat") {
							$data = array(
				          'id'					=>	$row['id'],
				          'name'			=>	$row['name'],
				          'content_slug'				=>	$this->sctvlib->judul_url_no_id($row['name']),
				          'notes'		=>	$row['notes'],
				          'orders'	=>	$row['orders']
				      );							
				      $this->db->insert('tbl_content_cat', $data);		
						}
					}
					
					echo $p + $totArr;
				} else
					echo "DONE";
					
				exit();
			} else {
				if (isset($_REQUEST['jenis']) && trim($_REQUEST['jenis']) != "") {
					$jenis = $_REQUEST['jenis'];
					if ($jenis == "schedule") $sql = "select count(sc_id) as total from tbl_schedule";
					if ($jenis == "sinopsis") $sql = "select count(s_id) as total from tbl_sinopsis";
					if ($jenis == "content") $sql = "select count(id) as total from tbl_content";
					if ($jenis == "content_cat") $sql = "select count(id) as total from tbl_content_cat";
				} else {
					$sql = "select count(sc_id) as total from tbl_schedule";
					$jenis = "schedule";
				}
				
				if ($jenis == "user") {
					$sql = "select count(id) as total from users";
					$query = $this->db->query($sql);
					$row = $query->row_array();
					$query->free_result();
					$totrecord = $row['total'];
					$totpage = ceil($totrecord/$batas);
				}	else {
					$this->DBOLD = $this->load->database('dbold', true);
					$query = $this->DBOLD->query($sql);
					$row = $query->row_array();
					$query->free_result();
					$totrecord = $row['total'];
					$totpage = ceil($totrecord/$batas);
				}
			}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script>
  var totpage 	= <?=$totpage?>;
  var totrecord = <?=$totrecord?>;
	$(function() {
		$("#progressbar").progressbar({ value: 0 });
		//setTimeout(updateProgress, 500);
	});
	
	function updateProgress(val) {
	  var progress = (val/totrecord) * 100;
	  if (progress <= 100) {
			$("#progressbar").progressbar("option", "value", progress);
			$("#progresstext").html(progress + "%");
	  }
	}
	
	function lanjut(val) {
		$.ajax({
		  url: '/?c=dbcopy&jenis=<?=$jenis?>&p='+val,
		  success: function(data) {
		    data = parseInt(data);
		    $("#result").html(data + " of " + totrecord);
		    updateProgress(data);
		    if (data <= totrecord)
		    	lanjut(data);
		    else
		    	alert('Load was performed.');
		  }
		});
	}
  </script>
</head>
<body style="font-size:62.5%;">
<p align="center">
	<a href="/?c=dbcopy&jenis=schedule">SCHEDULE</a> | <a href="/?c=dbcopy&jenis=sinopsis">SINOPSIS</a> | <a href="/?c=dbcopy&jenis=content">EVENTS</a> | <a href="/?c=dbcopy&jenis=content_cat">EVENTS CATEGORY</a> | <a href="/?c=dbcopy&jenis=user">RESET USER PASSWORD</a>
	<br /><br />
	Copy <?=$totrecord?> <?=strtoupper($jenis)?> Records to New DB Table
</p>
<div style="margin:0 auto;width:500px;">
	<div id="progressbar"></div>
	<div id="progresstext" style="text-align:center"></div>
</div>
<div id="result" style="text-align:center;margin-top:10px;"><a href="javascript:lanjut(0)">SUBMIT NOW</a></div>
</body>
</html>
<?
	}
}