<?
$artikel_url = $this->uri->segment(3);
$jenis_id 					= 2;
$jenis_judul 				= "Gallery Photo";
$jenis_url					= "photo";

if ($artikel_url == "") 
	include (APPPATH."views/dropbox_artikel_index.php");
else
	include (APPPATH."views/dropbox_photo_detail.php");
?>