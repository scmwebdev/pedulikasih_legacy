<?
$artikel_url = $this->uri->segment(3);
$jenis_id 					= 1;
$jenis_judul 				= "Pengumuman";
$jenis_url					= "pengumuman";

if ($artikel_url == "") 
	include (APPPATH."views/dropbox_artikel_index.php");
else
	include (APPPATH."views/dropbox_artikel_detail.php");
?>