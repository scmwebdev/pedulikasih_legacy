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

				if ($jenis == "bio") 			$sql = "select * from tbl_bio_actress limit $p, $batas";
				if ($jenis == "picture") 	$sql = "select * from tbl_pictures limit $p, $batas";
				if ($jenis == "video") 		$sql = "select * from tbl_video limit $p, $batas";
				if ($jenis == "sinopsis")	$sql = "select * from tbl_sinopsis order by s_id desc limit $p, $batas";
				if ($jenis == "content")	$sql = "select * from tbl_content order by id desc limit $p, $batas";
				
			  $query 	= $this->db->query($sql);
				$tmpArr = $query->result_array();
				$query->free_result();
				
				$totArr = count($tmpArr);
				if ($totArr > 0) {
					$this->DBSPHINX = $this->load->database('sphinx', true);
					
					foreach($tmpArr as $row) {
						if ($jenis == "sinopsis") {
							$row['s_program_title'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['s_program_title']))));
							$row['s_story_line'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['s_story_line']))));
							$row['s_short_story'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['s_short_story']))));
							
							$sql 	= "REPLACE INTO sctvsinopsisrt (id,s_program_title,s_story_line,s_short_story,s_cat_program,s_publish,s_timestamp) VALUES ";
							$sql .= "(".$row['s_id'].",'".$row['s_program_title']."','".$row['s_story_line']."','".$row['s_short_story']."',".$row['s_cat_program'].",".$row['s_publish'].",".$row['s_timestamp'].")";
						}
						
						if ($jenis == "bio") {
							$row['bio_name'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['bio_name']))));
							$row['bio_fullname'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['bio_fullname']))));
							$row['bio_detail'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['bio_detail']))));
							$row['bio_timestamp'] = strtotime($row['bio_timestamp']);
							if ($row['bio_timestamp'] == "") $row['bio_timestamp'] = 0;
							
							$sql 	= "REPLACE INTO sctvbiort (id,bio_name,bio_fullname,bio_detail,bio_publish,bio_timestamp) VALUES ";
							$sql .= "(".$row['bio_id'].",'".$row['bio_name']."','".$row['bio_fullname']."','".$row['bio_detail']."',".$row['bio_publish'].",".$row['bio_timestamp'].")";
						}
						
						if ($jenis == "video") {
							$row['vid_title'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['vid_title']))));
							$row['vid_detail'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['vid_detail']))));
							$row['vid_timestamp'] = strtotime($row['vid_timestamp']);
							if ($row['vid_timestamp'] == "") $row['vid_timestamp'] = 0;
							
							$sql 	= "REPLACE INTO sctvvideort (id,vid_title,vid_detail,vid_parent_id,vid_publish,vid_timestamp) VALUES ";
							$sql .= "(".$row['vid_id'].",'".$row['vid_title']."','".$row['vid_detail']."',".$row['vid_parent_id'].",".$row['vid_publish'].",".$row['vid_timestamp'].")";
						}

						if ($jenis == "picture") {
							$row['caption'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['caption']))));
							$row['shortdesc'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['shortdesc']))));
							$row['timestamp'] = strtotime($row['timestamp']);
							if ($row['timestamp'] == "") $row['timestamp'] = 0;
							
							$headline = ($row['headline_image'] == "") ? 0 : 1;
							$big			= ($row['big_image'] == "") ? 0 : 1;
							$thumb		= ($row['thmb_image'] == "") ? 0 : 1;
							
							$sql 	= "REPLACE INTO sctvpicrt (id,caption,shortdesc,parent_id,publish,timestamp,headline,big,thumb) VALUES ";
							$sql .= "(".$row['id'].",'".$row['caption']."','".$row['shortdesc']."',".$row['parent_id'].",".$row['publish'].",".$row['timestamp'].",$headline,$big,$thumb)";
						}
						
						if ($jenis == "content") {
							$row['title'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['title']))));
							$row['shortdesc'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['shortdesc']))));
							$row['content'] = mysql_escape_string(str_replace($arrT," ",strip_tags(trim($row['content']))));
							$row['datetime'] = strtotime($row['datetime']);
							if ($row['datetime'] == "") $row['datetime'] = 0;
							
							$sql 	= "REPLACE INTO sctvcontentrt (id,title,shortdesc,content,c_id,publish,datetime) VALUES ";
							$sql .= "(".$row['id'].",'".$row['title']."','".$row['shortdesc']."','".$row['content']."',".$row['c_id'].",".$row['publish'].",".$row['datetime'].")";
						}
						
						$this->DBSPHINX->query($sql);
					}
					
					echo $p + $totArr;
				} else
					echo "DONE";
					
				exit();
			} else {
				if (isset($_REQUEST['jenis']) && trim($_REQUEST['jenis']) != "") {
					$jenis = $_REQUEST['jenis'];
					if ($jenis == "bio") $sql = "select count(bio_id) as total from tbl_bio_actress";
					if ($jenis == "picture") $sql = "select count(id) as total from tbl_pictures";
					if ($jenis == "video") $sql = "select count(vid_id) as total from tbl_video";
					if ($jenis == "sinopsis") $sql = "select count(s_id) as total from tbl_sinopsis";
					if ($jenis == "content") $sql = "select count(id) as total from tbl_content";
				} else {
					$sql = "select count(s_id) as total from tbl_sinopsis";
					$jenis = "sinopsis";
				}
				
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