<?
$tags_url 				= $this->uri->segment(2);

if ($tags_url != "")
	include (APPPATH."views/tags_detail.php");
else
	include (APPPATH."views/tags_index.php");
?>