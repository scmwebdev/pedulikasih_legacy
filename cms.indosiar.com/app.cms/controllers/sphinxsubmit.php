<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sphinxsubmit extends CI_Controller {
	public function index()
	{
			$batas = 100;
			
			if (isset($_REQUEST['p'])) {
				$p 			= $_REQUEST['p'];
				$jenis 	= $_REQUEST['jenis'];
				$arrT 	= array("\r\n","\r","\n");
				$tmpArr = array();

				$sql = "select * from ivmweb2009_artikel_data limit $p, $batas";
				
			  $query 	= $this->db->query($sql);
				$tmpArr = $query->result_array();
				$query->free_result();
				
				$totArr = count($tmpArr);
				if ($totArr > 0) {
					$this->DBSPHINX = $this->load->database('sphinx', true);
					
					foreach($tmpArr as $row) {
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
					
					echo $p + $totArr;
				} else
					echo "DONE";
					
				exit();
			} else {
					$sql = "select count(id) as total from ivmweb2009_artikel_data";
					$jenis = "sinopsis";
				
				$query = $this->db->query($sql);
				$row = $query->row_array();
				$query->free_result();
				$totrecord = $row['total'];
				$totpage = ceil($totrecord/$batas);
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
		  url: '/?c=sphinxsubmit&jenis=<?=$jenis?>&p='+val,
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
	<a href="/?c=sphinxsubmit&jenis=sinopsis">SINOPSIS</a> | 
	<a href="/?c=sphinxsubmit&jenis=bio">BIO</a> | 
	<a href="/?c=sphinxsubmit&jenis=picture">PICTURE</a> | 
	<a href="/?c=sphinxsubmit&jenis=video">VIDEO</a> | 
	<a href="/?c=sphinxsubmit&jenis=content">CONTENT</a>
	<br /><br />
	Submit <?=$totrecord?> <?=strtoupper($jenis)?> Records to Sphinx DB
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
